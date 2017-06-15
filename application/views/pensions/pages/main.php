<div class="section__content section__content--unwrap">

    <?= View::factory('pensions/blocks/cover', array('pension' => $pension)); ?>

    <div class="row">

        <div class="col-xs-12 col-md-9">

            <? // Module Pensions => TIME_LINE_PENSION = 31
            if (!in_array(31, $user->permissions)) : ?>

                    <div class="h3 text-center text-brand m-t-20 m-b-50">Лента новостей не доступна</div>

            <? else: ?>

                <?= View::factory('pensions/blocks/timeline'); ?>

            <? endif; ?>

        </div>

        <div class="col-xs-12 col-md-3">

            <? // Module Pensions => EDIT_PENSION = 27
            if (in_array(27, $user->permissions)) : ?>
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <a href="<?=URL::site('pension/' . $pension->id . '/settings'); ?>" class="btn btn--lg btn--default col-xs-12 m-b-20 m-r-0">Настройка</a>
                    </div>
            <? endif; ?>

            <? // Module Pensions => STATISTIC_PENSION = 30
            if (in_array(30, $user->permissions)) : ?>
                <div class="col-xs-12 col-sm-6 col-md-12">
                    <a href="<?=URL::site('pension/' . $pension->id . '/statistic'); ?>" class="btn btn--lg btn--default col-xs-12 m-b-20 m-r-0">Статистика</a>
                </div>
            <? endif; ?>

            <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="block">
                    <div class="block__heading">
                        <h4 class="m-0">
                            <? // Module Pensions => INVITE_CO_WORKER = 28
                            if (in_array(28, $user->permissions)) : ?>
                                <a data-toggle="modal" data-area="inviteCoWorkerModal" role="button" class="fl_r">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                </a>
                            <? endif; ?>
                            Сотрудники
                        </h4>
                    </div>

                    <?= View::factory('pensions/blocks/co-workers', array('pension' => $pension)); ?>

                </div>
            </div>

        </div>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/pension.min.js?v=<?= filemtime("assets/frontend/bundles/pension.min.js") ?>"></script>
<script type="text/javascript">
    raisoft.parallax.init();
</script>

