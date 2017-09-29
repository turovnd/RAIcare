<div class="section__content">

    <h3 class="section__heading">
        Организация #<?= $organization->id; ?>
    </h3>

    <div class="block" id="organizationInfo">

        <div class="block__body p-b-0">

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="organizationName" class="form-group__label col-xs-12 col-sm-4 col-md-3">Название</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <span class="js-organization-info">
                                <?=$organization->name; ?>
                            </span>
                            <a onclick="admin.organizations.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <input id="organizationName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $organization->name; ?>" maxlength="256">
                            <label onclick="admin.organizations.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.organizations.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="organizationUri" class="form-group__label col-xs-12 col-sm-4 col-md-3">URI</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <span class="js-organization-info">
                                <?=$organization->uri; ?>
                            </span>
                            <a onclick="admin.organizations.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <input id="organizationUri" name="uri" type="text" class="form-group__control form-group__control-group-input" value="<?= $organization->uri; ?>" maxlength="64">
                            <label onclick="admin.organizations.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.organizations.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="organizationOwner" class="form-group__label col-xs-12 col-sm-4 col-md-3">Владелец</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">
                            <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/user/' . $organization->owner->id; ?>" class="js-organization-info link">
                                <?= $organization->owner->name . ' (' . $organization->owner->username . ')'; ?>
                            </a>
                            <a onclick="admin.organizations.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <select name="owner" id="organizationOwner" class="form-group__control form-group__control-group-input js-search-user">
                                <option value="<?= $organization->owner->id; ?>" selected>
                                    <?= $organization->owner->name . ' (' . $organization->owner->username . ')'; ?>
                                </option>
                            </select>
                            <label onclick="admin.organizations.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.organizations.update(this)" class="cursor-pointer form-group__control-group-addon">
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
                            <a href="<?= '/\/' .$_SERVER['HTTP_HOST'] . '/user/' . $organization->creator; ?>" class="link">
                                user #<?=$organization->creator; ?>
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
                            <?= strftime('%d %b %Y', strtotime($organization->dt_create)); ?>
                        </p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5 js-field-name">
                    <label for="organizationUsers" class="form-group__label col-xs-12 col-sm-4 col-md-3">Пользователи</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">

                            <? foreach ($organization->users as $user) : ?>
                                <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/user/' . $user->id; ?>" class="js-organization-info link m-r-10">
                                    <?= $user->name . ' (' . $user->username . ')'; ?>
                                </a>
                            <? endforeach; ?>

                            <a onclick="admin.organizations.edit(this)" role="button" class="m-l-5">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                        <div class="form-group__control-group hide">
                            <select multiple name="users[]" id="organizationUsers" class="form-group__control form-group__control-group-input js-search-user">
                                <? foreach ($organization->users as $user) : ?>
                                    <option value="<?= $user->id?>" selected>
                                        <?= $user->name . ' (' . $user->username . ')'; ?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                            <label onclick="admin.organizations.edit(this)" class="bl-0 cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </label>
                            <label onclick="admin.organizations.update(this)" class="cursor-pointer form-group__control-group-addon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group m-b-5">
                    <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Пансионаты</label>
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <p class="form-group__control-static">

                            <? foreach ($organization->pensions as $pension) : ?>
                                <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/pension/' . $pension->id; ?>" class="js-organization-info link m-r-10">
                                    <?= $pension->name; ?>
                                </a>
                            <? endforeach; ?>
                        </p>
                    </div>
                </div>
            </fieldset>

        </div>

    </div>

    <input type="hidden" id="organizationID" value="<?= $organization->id; ?>">

</div>

<!-----------  PAGE SCRIPT  ----------->
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/admin.min.js?v=<?= filemtime("assets/frontend/bundles/admin.min.js") ?>"></script>
<script type="text/javascript">
    admin.organizations.init();
</script>