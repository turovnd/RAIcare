<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ошибка <?= $code; ?>. Неверный запрос</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link type="image/x-icon" rel="shortcut icon" href="/assets/static/img/favicon.png" />
		<link rel='stylesheet' href="<?= URL::site('assets/static/css/error.css'); ?>">
	</head>
	<body class="error-block">
		<div class="error-block__center">
            <h1 class="error-block__title"> RAIcare </h1>
			<p class="error-block__text"><b>Ошибка <?= $code; ?>.</b> <?= $message; ?></p>
			<a href="/" class="error-block__link">Главная</a>
            <a class="error-block__link" onclick = "window.history.back()">Назад</a>
        </div>
	</body>
</html>
