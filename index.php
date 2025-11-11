<?php
// ✅ Universal Gzip Setup — Compatible with All Browsers
if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
    if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false) {
        ob_start('ob_gzhandler'); // Compress if supported
    } else {
        ob_start(); // Normal output if gzip not supported
    }
} else {
    ob_start(); // Fallback if zlib not available
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Glen Brian G. Decado — Full-Stack Web Developer (Philippines)</title>
    <meta name="description" content="Professional Full-Stack Web Developer from the Philippines. I build responsive, SEO-friendly websites and Progressive Web Apps (PWAs) that convert.">
    <meta name="keywords" content="Glen Brian Decado, Full Stack Developer, Web Developer Philippines, Laravel Developer, PHP Developer, JavaScript Developer, SEO, PWA, Frontend, Backend">
    <meta name="author" content="Glen Brian G. Decado">

    <!-- Open Graph / Social Preview -->
    <meta property="og:title" content="Glen Brian G. Decado — Full-Stack Web Developer (Philippines)">
    <meta property="og:description" content="Professional Full-Stack Web Developer from the Philippines. I build responsive, SEO-friendly websites and Progressive Web Apps (PWAs) that convert.">
    <meta property="og:image" content="https://glendecado.page.gd/preview.jpg">
    <meta property="og:url" content="https://glendecado.page.gd">
    <meta property="og:type" content="website">

    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="stylesheet" href="css/min/style.min.css">
</head>

<body>
    <?php include 'components/loading.php'; ?>
    <header>
        <?php include 'components/nav.php'; ?>
    </header>

    <main>
        <div>
            <?php include 'pages/home.php'; ?>

            <section id="skills" class="section">
                <h1>Skills</h1>
            </section>

            <section id="certificates" class="section">
                <h1>Certificates</h1>
            </section>

            <section id="contact" class="section">
                <h1>Contact</h1>
            </section>
        </div>
    </main>

    <!-- Scripts -->
    <script src="js/min/script.min.js"></script>
    <script src="js/three.r134.min.js"></script>
    <script src="js/vanta.net.min.js"></script>
    <script src="js/min/vanta.min.js"></script>
    <script src="js/min/loader.min.js"></script>
</body>

</html>

<?php
// ✅ Flush output (gzip or normal)
ob_end_flush();
?>
