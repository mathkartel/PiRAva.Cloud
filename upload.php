<?php
require 'aws.phar'; // Inclua o arquivo aws.phar para usar o SDK AWS para PHP

// Incluindo o arquivo de configuração
require 'config.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

function generateCode($length = 10) {
    // Definindo todos os caracteres possíveis para o código
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    
    // Gera o código até que um código único seja encontrado
    do {
        // Gera uma sequência aleatória de caracteres do comprimento especificado
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        // Verifica se o código já existe nos arquivos do diretório de upload
        $existing_files = glob(UPLOAD_DIRECTORY . '*_' . $code . '_*');
    } while (!empty($existing_files));

    return strtoupper($code);
}

define('UPLOAD_DIRECTORY', 'uploads/');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
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

    // Geração de código único
    $code = generateCode();

    // Caminho e nome do arquivo no servidor
    $filename = UPLOAD_DIRECTORY . $code . '_' . basename($_FILES['file']['name']);

    // Move o arquivo para o diretório de upload
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filename)) {
        $retryCount = 2; // Número de tentativas de upload
        $uploaded = false;

        // Loop para tentar o upload várias vezes
        while ($retryCount > 0 && !$uploaded) {
            try {
                // Envia o arquivo para o Wasabi Storage
                $result = $s3Client->putObject([
                    'Bucket' => $bucket,
                    'Key' => $code . '_' . basename($_FILES['file']['name']),
                    'Body' => fopen($filename, 'r'),
                ]);
                echo $code;
                $uploaded = true; // Marca o upload como bem-sucedido
            } catch (AwsException $e) {
                // Reduz o número de tentativas restantes
                $retryCount--;
                // Aguarda 1 segundo antes de tentar novamente (opcional)
                sleep(1);
            }
        }

        if (!$uploaded) {
            http_response_code(500); // Internal Server Error
            echo "Erro ao fazer upload do arquivo após tentativas.";
        }
    } else {
        http_response_code(500); // Internal Server Error
        echo "Erro ao fazer upload do arquivo: " . error_get_last()['message']; // Exibe o último erro ocorrido
    }

    // Exclui o arquivo local após enviar para o Wasabi
    unlink($filename);
} else {
    http_response_code(400); // Bad Request
    echo "Nenhum arquivo enviado.";
}
?>
