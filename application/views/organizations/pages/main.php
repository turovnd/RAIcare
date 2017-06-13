<div class="section__content section__content--unwrap">

    <?= View::factory('organizations/blocks/cover', array('organization' => $organization)); ?>

    <div class="col-xs-12 col-md-9">

        <? // Module Organizations => TIME_LINE_ORGANIZATION = 21
            if (!in_array(21, $user->permissions)) : ?>

                <div class="h3 text-center text-brand m-t-20 m-b-50">Лента новостей не доступна</div>

        <? else: ?>

            <?= View::factory('organizations/blocks/timeline'); ?>

        <? endif; ?>

    </div>

    <div class="col-xs-12 col-md-3">

        <? // Module Organizations => EDIT_ORGANIZATION = 17
            if (in_array(17, $user->permissions)) : ?>
                <a href="<?=URL::site('organization/' . $organization->id . '/settings'); ?>" class="btn btn--lg btn--default col-xs-12 fl_n m-b-20">Настройка</a>
        <? endif; ?>

        <? // Module Organizations => STATISTIC_ORGANIZATION = 20
            if (in_array(20, $user->permissions)) : ?>
                <a href="<?=URL::site('organization/' . $organization->id . '/statistic'); ?>" class="btn btn--lg btn--default col-xs-12 fl_n m-b-20">Статистика</a>
        <? endif; ?>

        <div class="block">
            <div class="block__heading">
                <h4 class="m-0">
                    <a href="" class="fl_r">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </a>
                    Пансионаты
                </h4>
            </div>
            <div id="pensions" class="block__body p-0">
                <fieldset id="pension_1" class="p-0 m-0">
                    <a href="/" class="p-15 display-block text-brand">Панисонат 1</a>
                </fieldset>
                <fieldset id="pension_2" class="p-0 m-0">
                    <a href="/" class="p-15 display-block text-brand">Панисонат 2</a>
                </fieldset>
            </div>
        </div>


        <div class="block">
            <div class="block__heading">
                <h4 class="m-0">
                    <? // Module Organizations => INVITE_CO_WORKER = 18
                        if (in_array(18, $user->permissions)) : ?>
                            <a role="button" class="fl_r">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </a>
                    <? endif; ?>
                    Сотрудники
                </h4>
            </div>
            <div id="co_workers" class="block__body p-0">
                <fieldset id="co_worker_1" class="p-15 m-b-0">
                    <? // Module Organizations => EXCLUDE_CO_WORKER = 19
                        if (in_array(19, $user->permissions)) : ?>
                            <a href="" class="fl_r m-l-5">
                                <i class="fa fa-user-times" aria-hidden="true"></i>
                            </a>
                    <? endif; ?>
                    <img src="/" alt="" class="img img--small img--circle fl_l m-r-10">
                    <div class="display-table">Имя фамилия </div>
                </fieldset>

            </div>
        </div>

    </div>

</div>


<script type="text/javascript">
    raisoft.parallax.init();
</script>