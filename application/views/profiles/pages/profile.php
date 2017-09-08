<div class="section__content">

    <h3 class="section__heading">
        Профиль - <?=$profile->name; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

             <?= View::factory('profiles/blocks/main-info', array('profile' => $profile)); ?>

        </div>

    </div>

</div>

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>static/js/profile.js?v<?= filemtime("assets/static/js/profile.js") ?>"></script>