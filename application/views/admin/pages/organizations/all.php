
<div class="section__content">

    <h3 class="section__heading">
        <a role="button" data-toggle="modal" data-area="newOrganizationModal" class="btn btn--brand btn--sm m-0 fl_r">Новая организация</a>
        Организации
    </h3>

    <div class="block">

        <div class="block__body overflow--hidden">

            <table id="organizations">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>URI</th>
                        <th>Основатель</th>
                        <th>Создатель</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($organizations as $organization) : ?>
                        <tr>
                            <td><?= $organization->id; ?></td>
                            <td>
                                <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/organization/' . $organization->id; ?>" class="link">
                                    <?= $organization->name; ?>
                                </a>
                            </td>
                            <td> <?= $organization->uri; ?> </td>
                            <td>
                                <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/user/' . $organization->owner; ?>" class="link">
                                    <?= 'user #' . $organization->owner; ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?= '//'  . $_SERVER['HTTP_HOST'] . '/user/' . $organization->creator; ?>" class="link">
                                    <?= 'user #' . $organization->creator; ?>
                                </a>
                            </td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <form class="modal" id="newOrganizationModal" tabindex="-1">
        <div class="modal__content">
            <div class="modal__wrapper">
                <div class="modal__header">
                    <button type="button" class="modal__title-close" data-close="modal">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal__title">Новая организация</h4>
                </div>
                <div class="modal__body">
                    <fieldset>
                        <div class="form-group">
                            <label for="newOrganizationName" class="form-group__label">Название</label>
                            <input type="text" name="name" id="newOrganizationName" class="form-group__control" maxlength="256">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="newOrganizationURI" class="form-group__label">URI</label>
                            <input type="text" name="uri" id="newOrganizationURI" class="form-group__control" maxlength="64">
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="organizationOwner" class="form-group__label">
                                Основатель
                            </label>
                            <select name="owner" id="organizationOwner" class="form-group__control form-group__control-group-input js-search-user">

                            </select>
                        </div>
                    </fieldset>
                </div>
                <div class="modal__footer">
                    <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
                    <button type="submit" class="btn btn--brand">Создать</button>
                    <input type="hidden" name="csrf" value="<?=Security::token();?>">
                </div>
            </div>
        </div>
    </form>

</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>
<script type="text/javascript">
    admin.organizations.init('all');
</script>