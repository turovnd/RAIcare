<div class="section__content">

    <h3 class="section__heading">
        Добро пожаловать, <?=$user->name; ?>
    </h3>

    <div class="block">

        <div class="block__body">

            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/roles'; ?>" class="btn btn--default m-b-0">Роли</a>

            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/users'; ?>" class="btn btn--default m-b-0">Пользователи</a>

            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/organizations'; ?>" class="btn btn--default m-b-0">Организации</a>

            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/pensions'; ?>" class="btn btn--default m-b-0">Пансионаты</a>

        </div>

    </div>

</div>