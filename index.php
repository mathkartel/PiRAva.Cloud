<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>PiRAva.Cloud - File Sharing with Code-Enabled Downloads</title>

    <meta name="description" content="PiRAva.Cloud - File Sharing with Code-Enabled Downloads">
    <meta name="keywords" content="file sharing, code-enabled downloads, PiRAva.Cloud">
    <meta name="author" content="PiRAva.Cloud">
    <meta name="google-adsense-account" content="ca-pub-1363964936046549">

    <meta property="og:title" content="PiRAva.Cloud - File Sharing with Code-Enabled Downloads">
    <meta property="og:description" content="PiRAva.Cloud - File Sharing with Code-Enabled Downloads">
    <meta property="og:url" content="https://pirava.cloud">
    <meta property="og:image" content="https://pirava.cloud/assets/img/image.jpg">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "PiRAva.Cloud",
        "url": "https://pirava.cloud/"
    }
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1363964936046549"
        crossorigin="anonymous"></script>

    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="ad-top">Ad Here</div>
    <div class="container">
        <h1>PiRAva.Cloud</h1>

        <form action="upload" class="dropzone dz-clickable" id="upload-form">
            <div class="dz-default dz-message">
                <button class="dz-button" type="button">Drop files here to upload</button>
            </div>
        </form>

        <hr>

        <div id="file-list"></div>

        <div class="notification" id="copy-notification">Code Copied!</div>

        <form action="download" method="post">
            <input type="text" name="download_code" placeholder="File Code" required>
            <input type="submit" value="Download">
        </form>
    </div>
    <div class="ad-bottom">Ad Here</div>

    <div class="footer">
        <p><a href="https://pirava.cloud/dmca">DMCA</a> | Made in Brazil.</p> 
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
