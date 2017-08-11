<div class="section__content">

    <h3 class="section__heading">
        Добро пожаловать, <?= $user->name; ?>
    </h3>

    <div class="block">
        <div class="block__body">
            <p>
                В вашей организации: <span class="text-brand text-bold"><?= count($organization->pensions) . ' ' . mb_strtolower(Methods_Plural::getWithPlural(count($organization->pensions), 'pensions')); ?></span>.
                Вы можете посмотреть из страницы по ссылкам:
            </p>
            <? foreach ($organization->pensions as $pension) : ?>
                <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/' . $pension->uri; ?>" class="btn btn--default m-b-0"><?= $pension->name; ?></a>
            <? endforeach; ?>
        </div>
    </div>

    <div class="block">
        <div class="block__body">
            <p>
                Вы можете исключить текущего сотрудника из организации или прегласить нового. Для этого, Вам неоходимо перейти на страницу
            </p>
            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/manage'; ?>" class="btn btn--default m-b-0">Сотрудники</a>
        </div>
    </div>

</div>