<div class="section__content">

    <h3 class="section__heading">
        Добро пожаловать, <?= $user->name; ?>
    </h3>

    <div class="block">
        <div class="block__body">
            <p>
                Вы состоите в организации: <span class="text-brand text-bold"><?= $organization->name; ?></span>.
                Вам доступен пансионат:
            </p>
            <? foreach ($organization->pensions as $pension) : ?>
                <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/' . $pension->uri; ?>" class="btn btn--default m-b-0"><?= $pension->name; ?></a>
            <? endforeach; ?>
        </div>
    </div>


    <? foreach ($organization->pensions as $pension) : ?>

        <div class="block">
            <div class="block__heading">
                В пансионате <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/' . $pension->uri; ?>" class="link"><?= $pension->name; ?></a>, есть возможности
            </div>
            <div class="block__body">
                <ol>

                    <li class="m-b-15">
                        <p>Изменять основную информацию о пансионате</p>
                        <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/settings'; ?>" class="btn btn--default m-b-0">Настройки</a>
                    </li>

                    <li class="m-b-15">
                        <p>Редактировать список сотрудников, имеющих доступ к пансионату (исключать, приглашать новых)</p>
                        <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/manage'; ?>" class="btn btn--default m-b-0">Сотрудники</a>
                    </li>

                    <li class="m-b-15">
                        <label class="label label--danger fl_r">скоро</label>
                        <p>Совсем скоро будет готов модуль статистики пансионата по результатам анкетирований резидентов.</p>
                        <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/control'; ?>" class="btn btn--default m-b-0">Динамика пансионата</a>
                    </li>

                    <li class="m-b-15">
                        <p>Все резиденты пансионата доступны по ссылке</p>
                        <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/patients'; ?>" class="btn btn--default m-b-0">Резиденты</a>
                    </li>

                    <li class="m-b-15">
                        <p>Все формы оценки (отчеты) доступны по ссылке</p>
                        <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/surveys'; ?>" class="btn btn--default m-b-0">Отчеты</a>
                    </li>

                </ol>
            </div>
        </div>

    <? endforeach; ?>


</div>