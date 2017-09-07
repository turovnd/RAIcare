<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?=$title; ?> | <?=$GLOBALS["SITE_NAME"]; ?></title>
    <meta charset="UTF-8">

    <meta name="author" content="<?=$GLOBALS['SITE_NAME']; ?>" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="white">

    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>static/img/favicon.png" />
    <link rel="apple-touch-icon" href="<?=$assets; ?>static/img/favicon.png">

    <meta name="description" content="<?= $GLOBALS['SITE_NAME']; ?> - Универсальное система для измерения качества и эффективности ухода за пожилыми людьми." />
    <meta name="keywords" content="<?=strtolower($GLOBALS['SITE_NAME']); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="<?=$assets; ?>vendor/font-awesome/css/font-awesome.css?v=<?= filemtime("assets/vendor/font-awesome/css/font-awesome.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/raicare.min.css?v=<?= filemtime("assets/frontend/bundles/raicare.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/raicare.min.js?v=<?= filemtime("assets/frontend/bundles/raicare.min.js") ?>"></script>

    <script type="text/javascript">
        function ready() {
            raicare.parallax.init();
            raicare.notification.createHolder();
        }
        document.addEventListener("DOMContentLoaded", ready);
    </script>

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/welcome.css?v=<?= filemtime("assets/static/css/welcome.css") ?>">

</head>

<body>

    <? if ($action == 'login'): ?>
        <header class="header">
            <?= View::factory('welcome/blocks/header-login'); ?>
        </header>
    <? else: ?>
        <header class="header header--default animated fade__in clear-fix">
            <?= View::factory('welcome/blocks/header'); ?>
        </header>
        <script type="text/javascript">
            raicare.header.init('welcome');
        </script>
    <? endif; ?>

    <section>

        <?=$section; ?>

    </section>

    <footer class="footer">
        <? if ($action == 'login') {
            echo View::factory('welcome/blocks/footer-login');
        }  else {
            echo View::factory('welcome/blocks/footer');
        } ?>
    </footer>

</body>

</html>
