<div class="section__content m-b-50">

    <h3 class="section__heading">
        <a role="button" data-toggle="modal" data-area="newCoWorker" class="btn btn--brand btn--sm m-0 fl_r">Новый сотрудник</a>
        Сотрудники организации и пансионатов
    </h3>

    <div class="row block-wrapper" id="coWorkers">

        <? foreach ($co_workers as $co_worker) : ?>

            <?= View::factory('organizations/blocks/co-worker', array('co_worker' => $co_worker, 'roles' => $roles, 'pensions' => $pensions, 'orgRolesID' => $orgRolesID)); ?>

        <? endforeach; ?>

    </div>

    <input type="hidden" id="organizationID" value="<?= $orgID; ?>">

    <?= View::factory('organizations/blocks/co-worker-new', array('roles' => $roles, 'pensions' => $pensions)); ?>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/organization.min.js?v=<?= filemtime("assets/frontend/bundles/organization.min.js") ?>"></script>