<h3 class="section__heading">
    Анкета клиента #<?=$client->id; ?>

    <? if ($client->status == 1 || $client->status == 0) : ?>

        <a role="button" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r js-request-reject <? echo $client->status == 1 ? '' : 'hide'; ?>">отклонить</a>
        <a role="button" class="btn btn--brand btn--sm m-b-0 fl_r js-request-accept <? echo $client->status == 1 ? '' : 'hide'; ?>">принять</a>
        <a role="button" class="btn btn--brand btn--sm m-b-0 fl_r js-request- <? echo $client->status == 0 ? '' : 'hide'; ?>">восстановить</a>

    <? // Module Clients => permission: CREATE_USER_BASED_ON_FORM = 9
    elseif ($client->status == 2 && in_array(9, $user->permissions)): ?>

        <a onclick="clients.create.user();" role="button" class="btn btn--brand btn--sm m-b-0 fl_r">Создать пользователя</a>

    <? else: ?>

        <a role="button" data-toggle="collapse" data-area="questionForm" data-opened="false" data-textclosed="развернуть" data-textopened="свернуть" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r collapse-btn"></a>

    <? endif; ?>

</h3>

<div id="questionForm" class="<?= $client->status == 3  ? 'row collapse' : 'row'?>">

    <div class="col-xs-12">

            <div id="application" class="form">

                <div class="form__body">

                    <fieldset class="js-field-name">
                        <label for="clientName" class="col-sm-3 col-md-2 form-group__label">Имя</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-client-info"><?= $client->profile->name ?: $client->name; ?></span>
                                <? if ($client->status == 2) : ?>
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status == 2) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->name; ?>" maxlength="256">
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <? if ($client->status == 3) : ?>
                        <fieldset class="js-field-name">
                            <label for="clientName" class="col-sm-3 col-md-2 form-group__label">Логин</label>
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
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status == 2) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientEmail" name="email" type="email" class="form-group__control form-group__control-group-input" value="<?= $client->email; ?>" maxlength="64">
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
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
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status == 2) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientOrganization" name="organization" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->organization; ?>">
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
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
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status == 2) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientCity" name="city" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->city; ?>">
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
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
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status == 2) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientPhone" name="phone" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->phone; ?>" maxlength="20">
                                    <label class="cursor-pointer form-group__control-group-addon js-save-info"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="js-field-name">
                        <label for="clientComment" class="col-sm-3 col-md-2 form-group__label">Комментарий</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-client-info"><?= $client->comment; ?></span>
                                <? if ($client->status == 2) : ?>
                                    <a role="button" class="m-l-5 js-edit-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status == 2) : ?>
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