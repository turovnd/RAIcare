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

    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/raisoft.min.css?v=<?= filemtime("assets/frontend/bundles/raisoft.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/raisoft.min.js?v=<?= filemtime("assets/frontend/bundles/raisoft.min.js") ?>"></script>

    <script type="text/javascript">
        function ready() {
            raisoft.header.init('app');
            raisoft.collapse.init();
            raisoft.aside.init();
            raisoft.notification.createHolder();
            raisoft.modal.init();
            raisoft.loader.init();
        }

        document.addEventListener("DOMContentLoaded", ready);
    </script>

</head>

<body>

    <div class="wrapper">

        <header class="header clear-fix">

            <?=View::factory('global_blocks/header');?>

        </header>

        <aside class="aside">

            <?= $aside; ?>

        </aside>


        <section class="section">

            <?= $section; ?>

        </section>

        <footer class="footer">

            <?=View::factory('global_blocks/footer');?>

        </footer>

        <input type="hidden" id="csrf" name="csrf" value="<?=Security::token();?>">

    </div>

</body>

</html>


