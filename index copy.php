<?php
// ✨ SEO SETTINGS
$title = "Glen Brian G. Decado — Full-Stack Web Developer (Philippines)";
$description = "Professional Full-Stack Web Developer from the Philippines. I build responsive, SEO-friendly websites and Progressive Web Apps (PWAs) that convert.";
$url = "https://glendecado.page.gd";
$image = "https://glendecado.page.gd/preview.jpg";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($description) ?>" />
    <link rel="icon" type="image/png" href="/favicon.png" />
<!--     <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/hero.css">
    <link rel="stylesheet" href="css/loading.css"> -->
    <link rel="stylesheet" href="css/min/style.min.css">


</head>

<body>
    <?php include 'components/loading.php' ?>
    <header>
        <?php include 'components/nav.php' ?>
    </header>

    <main>
        <div>
            <?php include 'pages/home.php' ?>

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