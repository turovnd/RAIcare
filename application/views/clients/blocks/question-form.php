<h3 class="section__heading">

    <? if ($client->status == 1 || $client->status == 0) : ?>

        <? if ($client->status == 1) : ?>

            <a onclick="clients.status.reject()" role="button" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r">отклонить</a>
            <a onclick="clients.status.accept()" role="button" class="btn btn--brand btn--sm m-b-0 fl_r">принять</a>

        <? endif; ?>

        <? if ( $client->status == 0) : ?>

            <a onclick="clients.status.reestablish()" role="button" class="btn btn--brand btn--sm m-b-0 fl_r">восстановить</a>

        <? endif; ?>

    <? // Module Clients => permission: CREATE_USER_BASED_ON_FORM = 9
    elseif ($client->status == 2 && in_array(9, $user->permissions)): ?>

        <a onclick="clients.status.delete()" role="button" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
        <a onclick="clients.create.user();" role="button" class="btn btn--brand btn--sm m-b-0 fl_r">Создать пользователя</a>

    <? else: ?>

        <a role="button" data-toggle="collapse" data-area="questionForm" data-opened="false" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r collapse-btn"></a>

    <? endif; ?>

    Анкета клиента #<?=$client->id; ?>

    <?
        $label = "";
        switch ($client->status) {
            case 0:  $label = "<span class=\"label label--brand\">удалена</span>"; break;
            case 1:  $label = "<span class=\"label label--brand\">новая анкета</span>"; break;
            case 2:  $label = "<span class=\"label label--brand\">на рассмотрение</span>"; break;
        }
    ?>

    <small> <?= $label; ?> </small>

</h3>

<div id="questionForm" class="<?= $client->status == 3  ? 'row collapse' : 'row'?>">

    <div class="col-xs-12">

        <form id="application" class="form">

            <div class="form__body">

                <fieldset class="js-field-name">
                    <label for="clientName" class="col-sm-3 col-md-2 form-group__label">Имя</label>
                    <div class="col-xs-12 col-sm-9 col-md-10">
                        <p class="form-group__control-static">
                            <span class="js-client-info"><?= $client->profile->name ?: $client->name; ?></span>
                            <? if ($client->status == 2) : ?>
                                <a onclick="clients.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <? endif; ?>
                        </p>
                        <? if ($client->status == 2) : ?>
                            <div class="form-group__control-group hide">
                                <input id="clientName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->name; ?>" maxlength="256">
                                <label onclick="clients.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                <label onclick="clients.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                            </div>
                        <? endif; ?>
                    </div>
                </fieldset>

                <? if ($client->status == 3) : ?>
                    <fieldset class="js-field-name">
                        <label class="col-sm-3 col-md-2 form-group__label">Логин</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span><?= $client->profile->username ?></span>
                            </p>
                        </div>
                    </fieldset>
                <? endif; ?>

                <fieldset class="js-field-name">
                    <label for="clientEmail" class="col-sm-3 col-md-2 form-group__label">Эл. почта</label>
                    <div class="col-xs-12 col-sm-9 col-md-10">
                        <p class="form-group__control-static">
                            <span class="js-client-info"><?= $client->profile->email ?: $client->email; ?></span>
                            <? if ($client->status == 2) : ?>
                                <a onclick="clients.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <? endif; ?>
                        </p>
                        <? if ($client->status == 2) : ?>
                            <div class="form-group__control-group hide">
                                <input id="clientEmail" name="email" type="email" class="form-group__control form-group__control-group-input" value="<?= $client->email; ?>" maxlength="64">
                                <label onclick="clients.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                <label onclick="clients.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                            </div>
                        <? endif; ?>
                    </div>
                </fieldset>

                <fieldset class="js-field-name">
                    <label for="clientOrganization" class="col-sm-3 col-md-2 form-group__label">Организация</label>
                    <div class="col-xs-12 col-sm-9 col-md-10">
                        <p class="form-group__control-static">
                            <span class="js-client-info"><?= $client->organization; ?></span>
                            <? if ($client->status == 2) : ?>
                                <a onclick="clients.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <? endif; ?>
                        </p>
                        <? if ($client->status == 2) : ?>
                            <div class="form-group__control-group hide">
                                <input id="clientOrganization" name="organization" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->organization; ?>">
                                <label onclick="clients.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                <label onclick="clients.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                            </div>
                        <? endif; ?>
                    </div>
                </fieldset>

                <fieldset class="js-field-name">
                    <label for="clientCity" class="col-sm-3 col-md-2 form-group__label">Город</label>
                    <div class="col-xs-12 col-sm-9 col-md-10">
                        <p class="form-group__control-static">
                            <span class="js-client-info"><?= $client->profile->city ?: $client->city; ?></span>
                            <? if ($client->status == 2) : ?>
                                <a onclick="clients.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <? endif; ?>
                        </p>
                        <? if ($client->status == 2) : ?>
                            <div class="form-group__control-group hide">
                                <input id="clientCity" name="city" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->city; ?>">
                                <label onclick="clients.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                <label onclick="clients.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                            </div>
                        <? endif; ?>
                    </div>
                </fieldset>

                <fieldset class="js-field-name">
                    <label for="clientPhone" class="col-sm-3 col-md-2 form-group__label">Телефон</label>
                    <div class="col-xs-12 col-sm-9 col-md-10">
                        <p class="form-group__control-static">
                            <span class="js-client-info"><?= $client->profile->phone ?: $client->phone; ?></span>
                            <? if ($client->status == 2) : ?>
                                <a onclick="clients.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <? endif; ?>
                        </p>
                        <? if ($client->status == 2) : ?>
                            <div class="form-group__control-group hide">
                                <input id="clientPhone" name="phone" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->phone; ?>" maxlength="20">
                                <label onclick="clients.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                <label onclick="clients.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                            </div>
                        <? endif; ?>
                    </div>
                </fieldset>

                <fieldset class="js-field-name m-b-0 p-b-10">
                    <label for="clientComment" class="col-sm-3 col-md-2 form-group__label">Комментарий</label>
                    <div class="col-xs-12 col-sm-9 col-md-10">
                        <p class="form-group__control-static">
                            <span class="js-client-info"><?= $client->comment; ?></span>
                            <? if ($client->status == 2) : ?>
                                <a onclick="clients.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <? endif; ?>
                        </p>
                        <? if ($client->status == 2) : ?>
                            <div class="form-group__control-group hide">
                                <textarea name="comment" id="clientComment" rows="5" class="form-group__control form-group__control-group-input"><?= $client->comment; ?></textarea>
                                <label onclick="clients.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                <label onclick="clients.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                            </div>
                        <? endif; ?>
                    </div>
                </fieldset>

            </div>

            <input id="clientId" type="hidden" value="<?= $client->id; ?>">

        </form>

    </div>

</div>