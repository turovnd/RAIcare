<div id="profile" class="form">

    <div class="form__body">

        <fieldset class="js-field-name">
            <label for="profileName" class="col-sm-3 col-md-2 form-group__label">Имя</label>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <p class="form-group__control-static">
                    <span class="js-profile-info"><?= $profile->name; ?></span>
                    <? if ($profile->can_edit) : ?>
                    <a onclick="profile.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <? endif; ?>
                </p>
                <? if ($profile->can_edit) : ?>
                <div class="form-group__control-group hide">
                    <input id="profileName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $profile->name; ?>" maxlength="256">
                    <label onclick="profile.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                    <label onclick="profile.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                </div>
                <? endif; ?>
            </div>
        </fieldset>

        <fieldset class="js-field-name">
            <label for="profileEmail" class="col-sm-3 col-md-2 form-group__label">Эл.почта</label>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <div class="form-group__control-static">
                    <span class="js-profile-info"><?= $profile->email; ?></span>
                    <? if ($profile->can_edit) : ?>
                        <a onclick="profile.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <? if (!$profile->is_confirmed) : ?>
                            <label class="label label--warning display-table m-t-5">не подтверждена</label>
                            <button onclick="profile.sendConfirm()" class="btn btn--default m-t-5 m-b-0 display-table">Выслать подтверждение</button>
                        <? else: ?>
                            <label class="label label--brand display-table m-t-5">подтверждена</label>
                        <? endif; ?>
                    <? endif; ?>
                </div>
                <? if ($profile->can_edit) : ?>
                    <div class="form-group__control-group hide">
                        <input id="profileEmail" name="email" type="email" class="form-group__control form-group__control-group-input" value="<?= $profile->email; ?>" maxlength="64">
                        <label onclick="profile.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                        <label onclick="profile.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                    </div>
                <? endif; ?>
            </div>
        </fieldset>

        <fieldset class="js-field-name">
            <label for="profileUserName" class="col-sm-3 col-md-2 form-group__label">Логин</label>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <p class="form-group__control-static">
                    <span class="js-profile-info"><?= $profile->username; ?></span>
                    <? if ($profile->can_edit) : ?>
                        <a onclick="profile.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <? endif; ?>
                </p>
                <? if ($profile->can_edit) : ?>
                    <div class="form-group__control-group hide">
                        <input id="profileUserName" name="username" type="text" class="form-group__control form-group__control-group-input" value="<?= $profile->username; ?>" maxlength="30">
                        <label onclick="profile.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                        <label onclick="profile.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                    </div>
                <? endif; ?>
            </div>
        </fieldset>

        <? if ($profile->can_edit) : ?>
            <fieldset class="js-field-name">
                <label class="col-sm-3 col-md-2 form-group__label">Пароль</label>
                <div class="col-xs-12 col-sm-9 col-md-10">
                    <p class="form-group__control-static">
                        <a data-toggle="modal" data-area="changePasswordModal" role="button" class="link">изменить</a>
                    </p>
                </div>
            </fieldset>
        <? endif; ?>

        <fieldset class="js-field-name">
            <label class="col-sm-3 col-md-2 form-group__label">Роль</label>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <p class="form-group__control-static">
                    <?= $profile->role->name; ?>
                </p>
            </div>
        </fieldset>


        <fieldset class="js-field-name">
            <label for="profileCity" class="col-sm-3 col-md-2 form-group__label">Город</label>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <p class="form-group__control-static">
                    <span class="js-profile-info"><?= $profile->city; ?></span>
                    <? if ($profile->can_edit) : ?>
                        <a onclick="profile.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <? endif; ?>
                </p>
                <? if ($profile->can_edit) : ?>
                    <div class="form-group__control-group hide">
                        <input id="profileCity" name="city" type="text" class="form-group__control form-group__control-group-input" value="<?= $profile->city; ?>">
                        <label onclick="profile.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                        <label onclick="profile.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                    </div>
                <? endif; ?>
            </div>
        </fieldset>

        <fieldset class="js-field-name m-b-0 p-b-10">
            <label for="profilePhone" class="col-sm-3 col-md-2 form-group__label">Телефон</label>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <p class="form-group__control-static">
                    <span class="js-profile-info"><?= $profile->phone; ?></span>
                    <? if ($profile->can_edit) : ?>
                        <a onclick="profile.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <? endif; ?>
                </p>
                <? if ($profile->can_edit) : ?>
                    <div class="form-group__control-group hide">
                        <input id="profilePhone" name="phone" type="text" class="form-group__control form-group__control-group-input" value="<?= $profile->phone; ?>">
                        <label onclick="profile.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                        <label onclick="profile.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                    </div>
                <? endif; ?>
            </div>
        </fieldset>

    </div>

</div>


<? if ($profile->can_edit) : ?>
    <form class="modal" id="changePasswordModal" tabindex="-1">
        <div class="modal__content">
            <div class="modal__wrapper">
                <div class="modal__header">
                    <button type="button" class="modal__title-close" data-close="modal">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal__title">Смена пароля</h4>
                </div>
                <div class="modal__body">

                    <fieldset>
                        <div class="form-group">
                            <label for="oldPassword" class="form-group__label">Старый пароль</label>
                            <input type="password" id="oldPassword" name="oldpassword" class="form-group__control">
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label for="newPassword" class="form-group__label">Новый пароль</label>
                            <input type="password" id="newPassword" name="newpassword" class="form-group__control">
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label for="newPassword2" class="form-group__label">Повторите новый пароль</label>
                            <input type="password" id="newPassword2" name="newpassword2" class="form-group__control">
                        </div>
                    </fieldset>

                </div>
                <div class="modal__footer">
                    <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
                    <button onclick="profile.changepassword()" type="button" class="btn btn--brand">Изменить</button>
                </div>
            </div>
        </div>
    </form>
<? endif; ?>