<div class="section__content">

    <?= View::factory('clients/blocks/question-form', array('client' => $client)); ?>

    <? if ($client->status == 3) : ?>

        <?= View::factory('clients/blocks/organizations', array('organizations' => $organizations)); ?>

        <?= View::factory('clients/blocks/pensions', array('pensions' => $pensions, 'organizations' => $organizations)); ?>

        <input id="userId" type="hidden" value="<?= $client->user_id; ?>">

    <? endif; ?>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/clients.min.js?v=<?= filemtime("assets/frontend/bundles/clients.min.js") ?>"></script>