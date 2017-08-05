<div class="section__content">

    <h3 class="section__heading">
        <a role="button" data-toggle="modal" data-area="newCoWorker" class="btn btn--brand btn--sm m-0 fl_r">Новый сотрудник</a>
        Сотрудники пансионата
    </h3>

    <div class="row block-wrapper" id="coWorkers">

        <? foreach ($co_workers as $co_worker) : ?>

            <?= View::factory('pensions/blocks/co-worker', array('co_worker' => $co_worker, 'roles' => $roles)); ?>

        <? endforeach; ?>

    </div>

    <input type="hidden" id="pensionID" value="<?= $pension->id; ?>">

    <?= View::factory('pensions/blocks/co-worker-new', array('roles' => $roles)); ?>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/pension.min.js?v=<?= filemtime("assets/frontend/bundles/pension.min.js") ?>"></script>