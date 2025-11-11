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

// ✅ Cache Control — 30 days
$cacheDuration = 2592000; // 30 days in seconds
header("Cache-Control: public, max-age=$cacheDuration, immutable");
header("Pragma: public");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + $cacheDuration) . " GMT");
?> <!doctype html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Glen Brian G. Decado — Full-Stack Web Developer (Philippines)</title><meta name="description" content="Meet Glen Brian Decado, a passionate Full-Stack Web Developer from the Philippines who builds fast, SEO-friendly websites and PWA's websites"><meta name="keywords" content="Glen, Glen Decado, Glen Brian, Full Stack Developer, Web Developer Philippines, PHP Developer, Laravel Developer, JavaScript Developer, SEO Expert"><meta property="og:title" content="Glen — Full-Stack Web Developer from the Philippines"><meta property="og:description" content="Professional Full-Stack Developer specializing in SEO-friendly websites and web apps."><meta property="og:url" content="https://glendecado.page.gd"><meta property="og:image" content="https://glendecado.page.gd/preview.jpg"><meta property="og:type" content="website"><script type="application/ld+json">{
            "@context": "https://schema.org",
            "@type": "Person",
            "name": "Glen Brian Decado",
            "alternateName": "Glen Decado",
            "url": "https://glendecado.page.gd",
            "jobTitle": "Full-Stack Web Developer",
            "address": {
                "@type": "PostalAddress",
                "addressCountry": "Philippines"
            },
            "sameAs": [
                "https://facebook.com/glendecado",
                "https://github.com/glendecado",
                "https://linkedin.com/in/glendecado"
            ]
        }</script><link rel="icon" type="image/png" href="/favicon.png"><link rel="stylesheet" href="css/min/style.min.css"></head><body> <?php include 'components/min/loading.php'; ?> <header> <?php include 'components/min/nav.php'; ?> </header><main><div> <?php include 'pages/min/home.php'; ?> <section id="skills" class="section"><h1>Skills</h1></section><section id="certificates" class="section"><h1>Certificates</h1></section><section id="contact" class="section"><h1>Contact</h1></section></div></main><script src="js/min/script.min.js"></script><script src="js/three.r134.min.js"></script><script src="js/vanta.net.min.js"></script><script src="js/min/vanta.min.js"></script><script src="js/min/loader.min.js"></script></body></html> <?php
// ✅ Flush output (gzip or normal)
ob_end_flush();
?>