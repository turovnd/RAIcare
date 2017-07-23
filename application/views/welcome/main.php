<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?=$title; ?> | <?=$GLOBALS["SITE_NAME"]; ?></title>
    <meta charset="UTF-8">
    <meta name="author" content="<?=$content; ?>" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>static/img/favicon.png" />

    <meta name="description" content="<?=$description; ?>" />
    <meta name="keywords" content="<?=$keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="<?=$assets; ?>vendor/font-awesome/css/font-awesome.css?v=<?= filemtime("assets/vendor/font-awesome/css/font-awesome.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/raicare.min.css?v=<?= filemtime("assets/frontend/bundles/raicare.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/raicare.min.js?v=<?= filemtime("assets/frontend/bundles/raicare.min.js") ?>"></script>

    <script type="text/javascript">
        function ready() {
            raicare.header.init('welcome');
            raicare.parallax.init();
            raicare.notification.createHolder();
        }
        document.addEventListener("DOMContentLoaded", ready);
    </script>

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/welcome.css?v=<?= filemtime("assets/static/css/welcome.css") ?>">

</head>

<body>

    <header class="header header--default animated fade__in clear-fix">

        <?= View::factory('welcome/blocks/header'); ?>

    </header>

    <section>

        <?=$section; ?>

    </section>

    <footer class="footer">

        <?= View::factory('welcome/blocks/footer'); ?>

    </footer>

</body>

</html>
