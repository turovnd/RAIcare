<div class="section__content">

    <h3 class="section__heading">
        Профиль пользователя #<?=$user->id; ?>
    </h3>

    <div class="block" id="userInfo">

        <div class="block__body p-b-0">

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="userName" class="form-group__label col-xs-12 col-sm-4 col-md-3">Имя</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <span class="js-user-info">
                                <?=$user->name; ?>
                            </span>
                            <a onclick="admin.users.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <input id="userName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $user->name; ?>" maxlength="256">
                            <label onclick="admin.users.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.users.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="userEmail" class="form-group__label col-xs-12 col-sm-4 col-md-3">Эл.почта</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <span class="js-user-info">
                                <?=$user->email; ?>
                            </span>
                            <? if ($user->is_confirmed) : ?>
                                <br>
                                <span class="label label--brand">Подтверждена</span>
                            <? else: ?>
                                <a onclick="admin.users.edit(this)" role="button" class="m-l-5">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <br>
                                <span class="label label--warning">Не подтверждена</span>
                            <? endif; ?>
                        </p>
                        <div class="form-group__control-group hide">
                            <input id="userEmail" name="email" type="email" class="form-group__control form-group__control-group-input" value="<?= $user->email; ?>" maxlength="64">
                            <label onclick="admin.users.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.users.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="userUserName" class="form-group__label col-xs-12 col-sm-4 col-md-3">Логин</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <span class="js-user-info">
                                <?=$user->username; ?>
                            </span>
                            <a onclick="admin.users.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <input id="userUserName" name="username" type="text" class="form-group__control form-group__control-group-input" value="<?= $user->username; ?>" maxlength="30">
                            <label onclick="admin.users.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.users.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="userPassword" class="form-group__label col-xs-12 col-sm-4 col-md-3">Пароль</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <a onclick="admin.users.edit(this)" role="button" class="link">
                                изменить
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <input id="userPassword" name="password" type="text" class="form-group__control form-group__control-group-input">
                            <label onclick="admin.users.randompassword(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-random" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.users.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.users.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="userRole" class="form-group__label col-xs-12 col-sm-4 col-md-3">Роль</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <span class="js-user-info">
                                <? foreach ($roles as $role) : ?>
                                    <?= $role->id == $user->role ? $role->name: ''; ?>
                                <? endforeach; ?>
                            </span>
                            <a onclick="admin.users.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <select name="role" id="userRole" class="form-group__control form-group__control-group-input js-single-select">
                                <? foreach ($roles as $role) : ?>
                                    <option value="<?= $role->id; ?>" <?= $role->id == $user->role ? 'selected': ''?>><?= $role->name; ?></option>
                                <? endforeach; ?>
                            </select>
                            <label onclick="admin.users.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.users.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5">
                    <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Город</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <?= $user->city ?: 'Не указано'; ?>
                        </p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5">
                    <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Телефон</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <?= $user->phone ?: 'Не указано'; ?>
                        </p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5">
                    <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата создания</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <?= strftime('%d %b %Y', strtotime($user->dt_create)); ?>
                        </p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5">
                    <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Создатель</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/user/' . $user->creator; ?>" class="link">user #<?=$user->creator; ?></a>
                        </p>
                    </div>
                </div>
            </fieldset>


            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="userOrganization" class="form-group__label col-xs-12 col-sm-4 col-md-3">Организация</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/organization/' . $user->organization->id; ?>" class="js-user-info link">
                                <?= $user->organization->name ?: 'Не указано'; ?>
                            </a>
                            <a onclick="admin.users.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <select name="organization" id="userOrganization" class="form-group__control form-group__control-group-input">

                                <option value="<?= $user->organization->id; ?>" selected>
                                    <?= $user->organization->name; ?>
                                </option>

                            </select>
                            <label onclick="admin.users.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.users.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="userPensions" class="form-group__label col-xs-12 col-sm-4 col-md-3">Пансионаты</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">

                            <? foreach ($user->pensions as $pension) : ?>
                                <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/pension/' . $pension->id; ?>" class="js-user-info link m-r-10">
                                    <?= $pension->name; ?>
                                </a>
                            <? endforeach; ?>

                            <a onclick="admin.users.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <select multiple name="pensions[]" id="userPensions" class="form-group__control form-group__control-group-input">
                                <? foreach ($user->pensions as $pension) : ?>
                                    <option value="<?= $pension->id; ?>" selected>
                                        <?= $pension->name ; ?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                            <label onclick="admin.users.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.users.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

        </div>

    </div>

    <input type="hidden" id="userID" value="<?= $user->id; ?>">

</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>
<script type="text/javascript">
    admin.users.init();
</script>