<div class="section__content">

    <h3 class="section__heading">
        Добро пожаловать, <?=$user->name; ?>
    </h3>

    <div class="block">

        <div class="block__body p-b-5">

            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/roles'; ?>" class="btn btn--default">Роли</a>

            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/users'; ?>" class="btn btn--default">Пользователи</a>

            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/organizations'; ?>" class="btn btn--default">Организации</a>

            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/pensions'; ?>" class="btn btn--default">Пансионаты</a>

            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/clients'; ?>" class="btn btn--default">Клиенты</a>

        </div>

    </div>

</div>