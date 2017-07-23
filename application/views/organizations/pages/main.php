<div class="section__content section__content--unwrap">

    <?= View::factory('organizations/blocks/cover', array( 'organization' => $organization )); ?>

    <div class="row">

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
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <a href="<?=URL::site('organization/' . $organization->id . '/settings'); ?>" class="btn btn--lg btn--default col-xs-12 m-b-20 m-r-0">Настройка</a>
                    </div>
            <? endif; ?>

            <? // Module Organizations => STATISTIC_ORGANIZATION = 20
            if (in_array(20, $user->permissions)) : ?>
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <a href="<?=URL::site('organization/' . $organization->id . '/statistic'); ?>" class="btn btn--lg btn--default col-xs-12 m-b-20 m-r-0">Статистика</a>
                    </div>
            <? endif; ?>

            <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="block">
                    <div class="block__heading">
                        <h4 class="m-0">
                            Пансионаты
                        </h4>
                    </div>
                    <div id="pensions" class="block__body p-0">

                        <? if ( empty($organization->pensions) ) : ?>
                            <fieldset class="p-0 m-0">
                                <div class="p-15">Пансионаты не созданы</div>
                            </fieldset>
                        <? endif; ?>

                        <? foreach ($organization->pensions as $pension) : ?>

                            <fieldset class="p-0 m-0">
                                <a href="<?=URL::site('pension/' . $pension->id)?>" class="p-15 display-block text-brand"><?= $pension->name; ?></a>
                            </fieldset>

                        <? endforeach; ?>

                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-12">

                <div class="block">
                    <div class="block__heading">
                        <h4 class="m-0">
                            <? // Module Organizations => INVITE_CO_WORKER = 18
                            if (in_array(18, $user->permissions)) : ?>
                                <a data-toggle="modal" data-area="inviteCoWorkerModal" role="button" class="fl_r">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                </a>
                            <? endif; ?>
                            Сотрудники
                        </h4>
                    </div>

                    <?= View::factory('organizations/blocks/co-workers', array('organization' => $organization)); ?>

                </div>



            </div>
        </div>
    </div>

    <input type="hidden" id="organizationID" value="<?=$organization->id; ?>">

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/organization.min.js?v=<?= filemtime("assets/frontend/bundles/organization.min.js") ?>"></script>

<script type="text/javascript">
    raicare.parallax.init();
</script>