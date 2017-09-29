<div class="section__content">

    <h3 class="section__heading">
        Пансионат #<?= $pension->id; ?>
    </h3>

    <div class="block" id="pensionInfo">

        <div class="block__body p-b-0">

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="pensionName" class="form-group__label col-xs-12 col-sm-4 col-md-3">Название</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <span class="js-pension-info">
                                <?=$pension->name; ?>
                            </span>
                            <a onclick="admin.pensions.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <input id="pensionName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $pension->name; ?>" maxlength="256">
                            <label onclick="admin.pensions.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.pensions.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="pensionUri" class="form-group__label col-xs-12 col-sm-4 col-md-3">URI</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <span class="js-pension-info">
                                <?=$pension->uri; ?>
                            </span>
                            <a onclick="admin.pensions.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <input id="pensionUri" name="uri" type="text" class="form-group__control form-group__control-group-input" value="<?= $pension->uri; ?>" maxlength="64">
                            <label onclick="admin.pensions.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.pensions.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="pensionOrganization" class="form-group__label col-xs-12 col-sm-4 col-md-3">Организация</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/organization/' . $pension->organization->id; ?>" class="js-pension-info link">
                                <?= $pension->organization->name; ?>
                            </a>
                            <a onclick="admin.pensions.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <select name="organization" id="pensionOrganization" class="form-group__control form-group__control-group-input">
                                <option value="<?= $pension->organization->id; ?>" selected>
                                    <?= $pension->organization->name; ?>
                                </option>
                            </select>
                            <label onclick="admin.pensions.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.pensions.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="pensionPlaces" class="form-group__label col-xs-12 col-sm-4 col-md-3">Кол-во мест</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <span class="js-pension-info">
                                <?=$pension->places; ?>
                            </span>
                            <a onclick="admin.pensions.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <input id="pensionPlaces" name="places" type="number" class="form-group__control form-group__control-group-input" value="<?= $pension->places; ?>">
                            <label onclick="admin.pensions.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.pensions.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5">
                    <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Создатель</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/user/' . $pension->creator; ?>" class="link">
                                user #<?=$pension->creator; ?>
                            </a>
                        </p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5">
                    <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата создания</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <?= strftime('%d %b %Y', strtotime($pension->dt_create)); ?>
                        </p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="pensionUsers" class="form-group__label col-xs-12 col-sm-4 col-md-3">Пользователи</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">

                            <? foreach ($pension->users as $user) : ?>
                                <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/user/' . $user->id; ?>" class="js-pension-info link m-r-10">
                                    <?= $user->name . ' (' . $user->username . ')'; ?>
                                </a>
                            <? endforeach; ?>

                            <a onclick="admin.pensions.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <select multiple name="users[]" id="pensionUsers" class="form-group__control form-group__control-group-input js-search-user">
                                <? foreach ($pension->users as $user) : ?>
                                    <option value="<?= $user->id?>" selected>
                                        <?= $user->name . ' (' . $user->username . ')'; ?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                            <label onclick="admin.pensions.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.pensions.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

        </div>

    </div>

    <input type="hidden" id="pensionID" value="<?= $pension->id; ?>">

</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>
<script type="text/javascript">
    admin.pensions.init();
</script>