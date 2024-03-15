<?php
define('UPLOAD_DIRECTORY', 'uploads/');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['filecode'])) {
    $file_code = $_GET['filecode'];
    $file_to_download = glob(UPLOAD_DIRECTORY . $file_code . '_*')[0] ?? null;

    if ($file_to_download !== null) {
        // Obter o nome do arquivo
        $file_name = basename($file_to_download);

        // Iniciar o download
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiRAva.Cloud - File Sharing</title>
    <meta name="description" content="File Sharing on PiRAva.Cloud">
    <meta name="keywords" content="file sharing, PiRAva.Cloud">
    <meta name="author" content="PiRAva.Cloud">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <style>
        .download-btn {
            display: block;
            margin: 20px auto;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .download-btn:hover {
            background-color: #0056b3;
        }

        .countdown-container {
            text-align: center;
            margin-top: 20px;
            display: none; /* Oculta o contador inicialmente */
        }

        .countdown {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }

        .file-info {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="ad-top">Ad Here</div>
    <div class="container">
        <h1>PiRAva.Cloud</h1>
        <div class="file-info"><strong>File Name:</strong> <?php echo $file_name; ?></div>
        <div class="countdown-container">
            <div class="countdown" id="countdown">5</div>
        </div>
        <form id="download-form" action="download" method="post">
            <input type="hidden" name="download_code" value="<?php echo $file_code; ?>">
            <button class="download-btn" type="button" onclick="startCountdown()">Download</button>
        </form>
    </div>
    <div class="ad-bottom">Ad Here</div>
    <div class="footer">
        <p><a href="https://pirava.cloud/">Home</a> | <a href="https://pirava.cloud/dmca">DMCA</a> | Made in Brazil.</p> 
    </div>
    <script>
        function startCountdown() {
            var countdownElement = document.getElementById('countdown');
            var countdownContainer = document.getElementsByClassName('countdown-container')[0];
            var downloadForm = document.getElementById('download-form');
            var countdown = 5;

            // Exibe o contador
            countdownContainer.style.display = 'block';

            var countdownInterval = setInterval(function() {
                countdown--;
                countdownElement.innerText = countdown;
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    downloadForm.submit(); // Inicia o download
                    setTimeout(function() {
                        window.location.href = 'https://pirava.cloud/'; // Redireciona após o download
                    }, 3000); // Aguarda 2 segundos antes de redirecionar
                }
            }, 1000);
        }
    </script>
</body>
</html>

        <?php
        exit();
    } else {
        // Código inválido
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>PiRAva.Cloud - Error</title>
            <meta name="description" content="Invalid file code on PiRAva.Cloud">
            <meta name="keywords" content="error, invalid code, PiRAva.Cloud">
            <meta name="author" content="PiRAva.Cloud">
            <link rel="icon" href="/favicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <div class="ad-top">Ad Here</div>
            <div class="container">
                <h1>PiRAva.Cloud</h1>
                <div class="error-notification">Invalid file code. Please check the code and try again.</div>
            </div>
            <div class="ad-bottom">Ad Here</div>
            <div class="footer">
                <p><a href="https://pirava.cloud/">Home</a> | <a href="https://pirava.cloud/dmca">DMCA</a> | Made in Brazil.</p> 
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = 'https://pirava.cloud/'; // Redireciona após o erro
                }, 2000); // Aguarda 5 segundos antes de redirecionar
            </script>
        </body>
        </html>
        <?php
        exit();
    }
} else {
   // Sem código de arquivo fornecido
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiRAva.Cloud - Share File</title>
    <meta name="description" content="Share a file on PiRAva.Cloud">
    <meta name="keywords" content="file sharing, PiRAva.Cloud">
    <meta name="author" content="PiRAva.Cloud">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <style>
        .share-form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .share-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .share-input:focus {
            border-color: #007bff;
            outline: none;
        }

        .share-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .share-btn:hover {
            background-color: #0056b3;
        }

        .error-notification {
            margin-top: 16px;
            color: #dc3545;
        }

        .share-link {
            margin-top: 16px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 4px;
            cursor: pointer;
        }

        .share-link:hover {
            background-color: #e9ecef;
        }

        .share-link input[type="text"] {
            border: none;
            outline: none;
            width: 100%;
            background-color: transparent;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #212529;
        }
    </style>
</head>
<body>
    <div class="ad-top">Ad Here</div>
    <div class="container">
        <h1>PiRAva.Cloud</h1>
        <form class="share-form" action="share.php" method="post">
            <textarea name="filecodes" class="share-input" placeholder="Enter file code(s) here, one per line" rows="4"></textarea>
            <button type="submit" class="share-btn">Generate Share Link(s)</button>
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filecodes'])) {
                $file_codes = explode("\n", $_POST['filecodes']);
                foreach ($file_codes as $file_code) {
                    $file_code = trim($file_code);
                    if (!empty($file_code)) {
                        $share_link = 'https://www.pirava.cloud/share?filecode=' . urlencode($file_code);
                        echo '<div class="share-link" onclick="copyLink(this)"><input type="text" value="' . $share_link . '" readonly></div>';
                    }
                }
            }
        ?>
    </div>
    <div class="ad-bottom">Ad Here</div>
    <div class="footer">
        <p><a href="https://pirava.cloud/">Home</a> | <a href="https://pirava.cloud/dmca">DMCA</a> | Made in Brazil.</p> 
    </div>
    <script>
        function copyLink(element) {
            var input = element.querySelector('input');
            input.select();
            document.execCommand('copy');
            alert('Link copied to clipboard');
        }
    </script>
</body>
</html>
    <?php
    exit();
}
?>
