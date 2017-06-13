<h3 class="section__heading">
    Организации

    <? // Module Organizations => permission: CREATE_ORGANIZATION = 13
    if (in_array(13, $user->permissions)) : ?>
        <button data-toggle="modal" data-area="createOrganizationModal" class="btn btn--brand btn--sm m-b-0 m-r-0 fl_r">Создать организацию</button>
    <? endif; ?>

    <small>У клиента есть хотя бы одна организация. Клиент может самостоятельно пригласить/исключить сотрдников для просмотра отчетов и статистики.</small>

</h3>

<div class="row">

    <div class="col-xs-12">

        <ul id="organizations" class="list-style--none block-wrapper">

            <? if (empty($organizations)) : ?>

                <li class="h3 text-center text-brand m-t-10 m-b-10">Организации не созданы</li>

            <? else: ?>

                <? foreach ($organizations as $organization) : ?>

                    <?= View::factory('organizations/blocks/list-item',array('organization' => $organization)); ?>

                <? endforeach; ?>

            <? endif; ?>

        </ul>

    </div>

</div>


<?  // Module Organizations => permission: CREATE_ORGANIZATION = 13
if (in_array(13, $user->permissions)) : ?>

    <form class="modal" id="createOrganizationModal" tabindex="-1">
        <div class="modal__content">
            <div class="modal__header">
                <button type="button" class="modal__title-close" data-close="modal">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4 class="modal__title">Новая организация</h4>
            </div>
            <div class="modal__body">

                <fieldset>
                    <div class="form-group">
                        <label for="createOrganizationName" class="form-group__label">Название <span class="text-danger">*</span></label>
                        <input type="text" id="createOrganizationName" name="name" class="form-group__control" maxlength="256">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="createOrganizationURI" class="form-group__label">Адрес (URI) <span class="text-danger">*</span></label>
                        <input type="text" id="createOrganizationURI" name="uri" class="form-group__control" maxlength="64">
                    </div>
                </fieldset>

            </div>
            <div class="modal__footer">
                <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
                <button onclick="clients.create.organization('createOrganizationModal')" type="button" class="btn btn--brand">Создать</button>
            </div>
        </div>
    </form>

<?  endif;  ?>