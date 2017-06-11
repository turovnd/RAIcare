<div class="section__content">

    <h3 class="section__heading">
        Анкета клиента
        <a role="button" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r js-request-reject <? echo $client->status == 1 ? '' : 'hide'; ?>">отклонить</a>
        <a role="button" class="btn btn--brand btn--sm m-b-0 fl_r js-request-accept <? echo $client->status == 1 ? '' : 'hide'; ?>">принять</a>
        <? // Module Clients => permission: CREATE_USER_BASED_ON_FORM = 9
           if ($client->status != 1 && $client->status != 0 && empty($client->user_id) && in_array(9, $user->permissions)) : ?>
            <a onclick="clients.create.user();" role="button" class="btn btn--brand btn--sm m-b-0 fl_r">Создать пользователя</a>
        <? endif; ?>
    </h3>

    <div class="row">
        <div class="col-xs-12">
            <div id="application" class="form">

                <div class="form__body">

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientName" class="col-sm-3 col-md-2 form-group__label">Имя</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-client-info"><?= $cl_user->name ?: $client->name; ?></span>
                                <? if ($client->status != 1 && $client->status != 0 && empty($client->user_id)) : ?>
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0 && empty($client->user_id)) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->name; ?>" maxlength="256">
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <? if ($client->status != 1 && $client->status != 0 && !empty($client->user_id)) : ?>
                        <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                            <label for="clientName" class="col-sm-3 col-md-2 form-group__label">Логин</label>
                            <div class="col-xs-12 col-sm-9 col-md-10">
                                <p class="form-group__control-static">
                                    <span><?= $cl_user->username ?></span>
                                </p>
                            </div>
                        </fieldset>
                    <? endif; ?>

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientEmail" class="col-sm-3 col-md-2 form-group__label">Эл. почта</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-client-info"><?= $cl_user->email ?: $client->email; ?></span>
                                <? if ($client->status != 1 && $client->status != 0 && empty($client->user_id)) : ?>
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0 && empty($client->user_id)) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientEmail" name="email" type="email" class="form-group__control form-group__control-group-input" value="<?= $client->email; ?>" maxlength="64">
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientOrganization" class="col-sm-3 col-md-2 form-group__label">Организация</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-client-info"><?= $client->organization; ?></span>
                                <? if ($client->status != 1 && $client->status != 0) : ?>
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientOrganization" name="organization" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->organization; ?>">
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientCity" class="col-sm-3 col-md-2 form-group__label">Город</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-client-info"><?= $cl_user->city ?: $client->city; ?></span>
                                <? if ($client->status != 1 && $client->status != 0 && empty($client->user_id)) : ?>
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0 && empty($client->user_id)) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientCity" name="city" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->city; ?>">
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientPhone" class="col-sm-3 col-md-2 form-group__label">Телефон</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-client-info"><?= $cl_user->phone ?: $client->phone; ?></span>
                                <? if ($client->status != 1 && $client->status != 0 && empty($client->user_id)) : ?>
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0 && empty($client->user_id)) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientPhone" name="phone" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->phone; ?>" maxlength="20">
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientComment" class="col-sm-3 col-md-2 form-group__label">Комментарий</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-client-info"><?= $client->comment; ?></span>
                                <? if ($client->status != 1 && $client->status != 0) : ?>
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0) : ?>
                                <div class="form-group__control-group hide">
                                    <textarea name="comment" id="clientComment" rows="5" class="form-group__control form-group__control-group-input"><?= $client->comment; ?></textarea>
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>
                </div>
                <input id="clientId" type="hidden" value="<?= $client->id; ?>">
            </div>
        </div>

    </div>

    <? if ($client->status != 1 && $client->status != 0) : ?>

        <h3 class="section__heading">
            Организации
            <? // Module Organization => permission: CREATE_ORGANIZATION = 13
               if (in_array(13, $user->permissions)) : ?>
                    <button data-toggle="modal" data-area="createOrganizationModal" class="btn btn--brand btn--sm m-b-0 m-r-0 fl_r js-create-organization">Создать организацию</button>
            <? endif; ?>
            <small>У клиента есть хотя бы одна организация. Клиент может самостоятельно пригласить/исключить сотрдников для просмотра отчетов и статистики.</small>
        </h3>

        <div class="row">
            <div class="col-xs-12">

                <? if (empty($organizations)) : ?>

                    <div class="h3 text-center text-brand m-t-10 m-b-10">Организации не созданы</div>

                <? else: ?>

                    <ul id="organizations" class="list-style--none">

                        <? foreach ($organizations as $organization) : ?>

                            <li>

                                <?= View::factory('organizations/blocks/card',array('organization' => $organization)); ?>

                            </li>

                        <? endforeach; ?>

                    </ul>

                <? endif; ?>

            </div>
        </div>


        <h3 class="section__heading">
            Пансионаты
            <small>У клиента может быть не ограниченное количество пансионатов. Каждый пансионат принадлежить конкретной организации. Пансионаты создаются только через сотрдника <?=$GLOBALS['SITE_NAME']; ?> при запросе. Основатель пансионата имеет право приглашать сотрдников и распределять между ними роли.</small>
        </h3>

        <div class="row">
            <div class="col-xs-12">

                <button class="btn btn--brand">Создать пансионат</button>

                <div id="" class="block">
                    выф
                </div>

            </div>

        </div>

        <input id="userId" type="hidden" value="<?= $client->user_id; ?>">

    <? endif; ?>

</div>
<?  // Module Organization => permission: CREATE_ORGANIZATION = 13
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

<!--            <fieldset>-->
<!--                <div class="form-group">-->
<!--                    <label for="addClientCity" class="form-group__label">Город</label>-->
<!--                    <input type="text" id="addClientCity" name="city" class="form-group__control">-->
<!--                </div>-->
<!--            </fieldset>-->

        </div>
        <div class="modal__footer">
            <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
            <button onclick="clients.create.organization('createOrganizationModal')" type="button" class="btn btn--brand">Создать</button>
        </div>
    </div>
</form>

<?  endif;  ?>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/clients.min.js?v=<?= filemtime("assets/frontend/bundles/clients.min.js") ?>"></script>
<script type="text/javascript">
    function ready() {
        <? if ($client->status == 1) : ?>
            clients.request.init();
        <? endif; ?>

        <? if ($client->status != 1 && $client->status != 0) : ?>
            clients.edit.init();
        <? endif; ?>


    }
    document.addEventListener("DOMContentLoaded", ready);
</script>

