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
            <label class="label label--danger fl_r">new</label>
            <p>
                Совсем скоро будет готов модуль пансионата или организации по результатам анкетирований пациентов.
                Информация будет оступна по следующим ссылкам:
            </p>
            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/control/organization'; ?>" class="btn btn--default m-b-0">Динамика организации</a>
            <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/control/pension'; ?>" class="btn btn--default m-b-0">Динамика пансионата</a>
        </div>
    </div>

</div>