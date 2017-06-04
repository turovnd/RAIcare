<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?=$title . ' | ' . $GLOBALS['SITE_NAME']; ?></title>
    <meta charset="UTF-8">
    <meta name="author" content="<?=$content; ?>" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>static/img/favicon.png" />

    <meta name="description" content="<?=$description; ?>" />
    <meta name="keywords" content="<?=$keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="<?=$assets; ?>vendor/font-awesome/css/font-awesome.css?v=<?= filemtime("assets/vendor/font-awesome/css/font-awesome.css") ?>">

    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/app.min.css?v=<?= filemtime("assets/frontend/bundles/app.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/app.min.js?v=<?= filemtime("assets/frontend/bundles/app.min.js") ?>"></script>

    <script type="text/javascript">
        function ready() {
            raisoft.header.init('app');
            raisoft.collapse.init();
            raisoft.aside.init();
            raisoft.parallax.init();
            raisoft.notification.createHolder();
        }

        document.addEventListener("DOMContentLoaded", ready);
    </script>

</head>

<body>

    <header class="header clear-fix">

        <?= $header; ?>

    </header>

    <aside class="aside">

        <?= $aside; ?>

    </aside>


    <section class="section">

        <?=$section; ?>

    </section>

    <div class="backdrop hide"></div>
</body>

</html>
