<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Авторизация | <?= $GLOBALS['SITE_NAME']; ?></title>
    <meta charset="UTF-8">
    <meta name="author" content="<?= $GLOBALS['SITE_NAME']; ?>" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>static/img/favicon.png" />

    <meta name="description" content="Страница авторизации сотрудника организации" />
    <meta name="keywords" content="<?=strtolower($GLOBALS['SITE_NAME']); ?>, авторизация, страница организации" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="<?=$assets; ?>vendor/font-awesome/css/font-awesome.css?v=<?= filemtime("assets/vendor/font-awesome/css/font-awesome.css") ?>">

    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/raicare.min.css?v=<?= filemtime("assets/frontend/bundles/raicare.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/raicare.min.js?v=<?= filemtime("assets/frontend/bundles/raicare.min.js") ?>"></script>

</head>

<body>

    <header class="header clear-fix">

        <div class="container">

            <a href="/" class="header__brand fl_l"><?= $GLOBALS['SITE_NAME']; ?></a>

        </div>

    </header>

    <section class="section">

        <?= $section; ?>

    </section>

</body>

</html>


