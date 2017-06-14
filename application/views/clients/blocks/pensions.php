<h3 class="section__heading">
    Пансионаты

    <? // Module Pensions => permission: CREATE_PENSION = 23
    if (in_array(23, $user->permissions)) : ?>
        <button data-toggle="modal" data-area="createPensionModal" class="btn btn--brand btn--sm m-b-0 m-r-0 fl_r">Создать пансионат</button>
    <? endif; ?>

    <small>У клиента может быть не ограниченное количество пансионатов. Каждый пансионат принадлежить конкретной организации. Пансионаты создаются только через сотрдника <?=$GLOBALS['SITE_NAME']; ?> при запросе. Основатель пансионата имеет право приглашать сотрдников и распределять между ними роли.</small>

</h3>

<div class="row">

    <div class="col-xs-12">

        <ul id="pensions" class="list-style--none block-wrapper">

            <? if (empty($pensions)) : ?>

                <li class="h3 text-center text-brand m-t-10 m-b-10">Пансионаты не созданы</li>

            <? else: ?>

                <? foreach ($pensions as $pension) : ?>

                    <li class="col-xs-12 col-md-6">

                        <?= View::factory('pensions/blocks/list-item',array('pension' => $pension)); ?>

                    </li>

                <? endforeach; ?>

            <? endif; ?>

        </ul>

    </div>

</div>


<? // Module Pensions => permission: CREATE_PENSION = 23
if (in_array(23, $user->permissions)) : ?>

    <form class="modal" id="createPensionModal" tabindex="-1">
        <div class="modal__content">
            <div class="modal__header">
                <button type="button" class="modal__title-close" data-close="modal">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4 class="modal__title">Новый пансионат</h4>
            </div>
            <div class="modal__body">

                <fieldset>
                    <div class="form-group">
                        <label for="createPensionName" class="form-group__label">Название <span class="text-danger">*</span></label>
                        <input type="text" id="createPensionName" name="name" class="form-group__control" maxlength="256">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="createPensionURI" class="form-group__label">Адрес (URI) <span class="text-danger">*</span></label>
                        <input type="text" id="createPensionURI" name="uri" class="form-group__control" maxlength="64">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="createPensionOrganization" class="form-group__label">Организация <span class="text-danger">*</span></label>
                        <select name="organization" id="createPensionOrganization" class="form-group__control">

                            <? foreach ($organizations as $organization) : ?>

                                <option value="<?=$organization->id?>"><?= $organization->name; ?></option>

                            <? endforeach; ?>

                        </select>
                    </div>
                </fieldset>

            </div>
            <div class="modal__footer">
                <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
                <button onclick="clients.create.pension()" type="button" class="btn btn--brand">Создать</button>
            </div>
        </div>
    </form>

<?  endif;  ?>