<div class="section__content">

    <h3 class="section__heading">
        Профиль - <?=$profile->name; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

             <?= View::factory('profiles/blocks/main-info', array('profile' => $profile)); ?>

        </div>

    </div>

    <? if($profile->additional_info) : ?>

        <h3 class="section__heading">
            Дополнительная информация
        </h3>

        <div class="row">

            <div class="col-xs-12">

                <?= View::factory('profiles/blocks/additional-info', array('profile' => $profile)); ?>

            </div>

        </div>

    <? endif; ?>

</div>

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/profile.min.js?v<?= filemtime("assets/frontend/bundles/profile.min.js") ?>"></script>