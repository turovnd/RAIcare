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

    <meta name="description" content="<?= $GLOBALS['SITE_NAME']; ?> - универсальное система для измерения качества и эффективности ухода за пожилыми людьми." />
    <meta name="keywords" content="<?=strtolower($GLOBALS['SITE_NAME']); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="<?=$assets; ?>vendor/font-awesome/css/font-awesome.css?v=<?= filemtime("assets/vendor/font-awesome/css/font-awesome.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/raicare.min.css?v=<?= filemtime("assets/frontend/bundles/raicare.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/raicare.min.js?v=<?= filemtime("assets/frontend/bundles/raicare.min.js") ?>"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/welcome.js?v=<?= filemtime("assets/static/js/welcome.js") ?>"></script>

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/welcome.css?v=<?= filemtime("assets/static/css/welcome.css") ?>">

</head>

<body>

    <header class="header <?= ($action == 'login' || $action == 'join' || $action == 'reset') ? '' : 'header--default animated fade__in clear-fix'; ?>">
        <? if ($action == 'login') {
            echo View::factory('welcome/blocks/header-login');
        }  else {
            echo View::factory('welcome/blocks/header');
        } ?>
    </header>

    <section>

        <?= $section; ?>

    </section>

    <footer class="footer">
        <? if ($action == 'login' || $action == 'reset') {
            echo View::factory('welcome/blocks/footer-login');
        }  else {
            echo View::factory('welcome/blocks/footer');
        } ?>
    </footer>

</body>

<script type="text/javascript">
    function ready() {
        raicare.initWelcome();
        welcome.init( <?= ($action == 'login' || $action == 'join' || $action == 'reset') ? "['footer']" : "['header','footer']"; ?> );
    }
    document.addEventListener("DOMContentLoaded", ready);
</script>

<? if ( getenv('KOHANA_ENV') == 'PRODUCTION' ): ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter45880809 = new Ya.Metrika({ id:45880809, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/45880809" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
<? endif; ?>

</html>
