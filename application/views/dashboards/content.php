<div class="section__content">

    <? echo Debug::vars($user->role); ?>

    dashboard
    <br><br>
    Делаем для каждой роли свою панель

    <br><br>
    <p>Роль: основатель организации = 10</p>
    <span class="btn btn--default">всё, что может "менеджер по кадрам" и "менеджер по качеству"</span>

    <br><br>
    <p>Роль: менеджер по кадрам = 11</p>
    <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/manage'; ?>" class="btn btn--default">Список сотрудников</a>
    <a href="" class="btn btn--default"></a>

    <br><br>
    <p>Роль: менеджер по качеству = 12</p>
    <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/control/organization'; ?>" class="btn btn--default">Динамика организации</a>
    <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/control/pension'; ?>" class="btn btn--default">Динамика пансионата</a>
    <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/control/patient'; ?>" class="btn btn--default">Динамика пациента</a>


</div>