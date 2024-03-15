<?php
require 'aws.phar'; // SDK AWS PHP
require 'config.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

function renderErrorPage($errorMessage) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PiRAva.Cloud - Error</title>
        <meta name="description" content="Error while downloading the file from PiRAva.Cloud">
        <meta name="keywords" content="error, download, PiRAva.Cloud">
        <meta name="author" content="PiRAva.Cloud">
        <meta property="og:title" content="Error while downloading the file from PiRAva.Cloud">
        <meta property="og:description" content="<?php echo $errorMessage; ?>">
        <meta property="og:url" content="https://pirava.cloud">
        <meta property="og:image" content="https://pirava.cloud/image.jpg">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="en_US">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="ad-top">Ad Here</div>
        <div class="container">
            <h1>PiRAva.Cloud</h1>
            <div class="error-notification"><?php echo $errorMessage; ?></div>
            <div class="error-notification">You will be redirected in <span id="countdown">15</span> seconds.</div>
        </div>
        <div class="ad-bottom">Ad Here</div>
        <div class="footer">
            <p><a href="https://pirava.cloud/">Home</a>| <a href="https://pirava.cloud/dmca">DMCA</a> | Made in Brazil.</p> 
        </div>
        <script>
            var countdownElement = document.getElementById('countdown');
            var countdown = 15;
            var countdownInterval = setInterval(function() {
                countdown--;
                countdownElement.innerText = countdown;
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = 'https://www.pirava.cloud/';
                }
            }, 1000);
        </script>
    </body>
    </html>
    <?php
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['download_code'])) {
    $download_code = $_POST['download_code'];

    // Inicializa o cliente S3
    $s3Client = new S3Client([
        'version' => 'latest',
        'region' => $region,
        'endpoint' => $endpoint,
        'credentials' => [
            'key' => $access_key,
            'secret' => $secret_key,
        ],
    ]);

    try {
        // Verifica se o objeto existe no Wasabi Storage
        $result = $s3Client->listObjectsV2([
            'Bucket' => $bucket,
            'Prefix' => $download_code . '_', // Prefixo usado para buscar arquivos com o código
            'MaxKeys' => 1, // Limita a busca a um único arquivo
        ]);

        // Se encontrou algum arquivo, faz o download e descriptografa
        if ($result['Contents']) {
            $objectKey = $result['Contents'][0]['Key'];
            $temp_file_encrypted = tempnam(sys_get_temp_dir(), 'download_enc_');
            $s3Client->getObject([
                'Bucket' => $bucket,
                'Key' => $objectKey,
                'SaveAs' => $temp_file_encrypted,
            ]);

            // Chave de criptografia AES-256 (gerada a partir do código de download)
            $encryptionKey = hash_hmac('sha256', $download_code, $download_code);

            // Descriptografa o arquivo baixado
            $temp_file_decrypted = tempnam(sys_get_temp_dir(), 'download_dec_');
            $fileContent = file_get_contents($temp_file_encrypted);
            $iv = substr($fileContent, 0, 16); // Extrai o IV do início do arquivo
            $encryptedContent = substr($fileContent, 16); // Extrai o conteúdo criptografado
            $encryptionSuccess = openssl_decrypt($encryptedContent, 'aes-256-cbc', $encryptionKey, OPENSSL_RAW_DATA, $iv);

            if ($encryptionSuccess !== false) {
                file_put_contents($temp_file_decrypted, $encryptionSuccess);

                // Extrai o nome e a extensão do arquivo do objeto no Wasabi Storage
                $objectName = basename($objectKey);
                $fileInfo = pathinfo($objectName);
                $downloadFilename = $fileInfo['filename'] . '.' . $fileInfo['extension'];

                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $downloadFilename . '"');
                header('Content-Length: ' . filesize($temp_file_decrypted));
                readfile($temp_file_decrypted);

                // Exclui os arquivos temporários após o download
                unlink($temp_file_encrypted);
                unlink($temp_file_decrypted);
                exit();
            } else {
                // Erro ao descriptografar o arquivo
                renderErrorPage("Error decrypting the file.");
            }
        } else {
            // Arquivo não encontrado
            renderErrorPage("File not found.");
        }
    } catch (AwsException $e) {
        // Erro ao acessar o Wasabi
        renderErrorPage("Error downloading the file. Please try again.");
    }
}

// Redirecionamento
renderErrorPage("Você será redirecionado em 15 segundos.");
?>
