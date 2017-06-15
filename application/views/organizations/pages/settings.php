<div class="section__content">

    <h3 class="section__heading">
        Основная информация
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <div id="organization" class="form">

                <div class="form__body">

                    <fieldset class="js-field-name">
                        <label for="organizationName" class="col-sm-3 col-md-2 form-group__label">Название</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-organization-info"><?= $organization->name; ?></span>
                                <? // Module Organizations => EDIT_ORGANIZATION = 17
                                if (in_array(17, $user->permissions)) : ?>
                                    <a onclick="organization.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? // Module Organizations => EDIT_ORGANIZATION = 17
                            if (in_array(17, $user->permissions)) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="organizationName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $organization->name; ?>" maxlength="256">
                                    <label onclick="organization.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="organization.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="js-field-name m-0 p-b-10">
                        <label for="organizationURI" class="col-sm-3 col-md-2 form-group__label">Адрес (URI)</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-organization-info"><?= $organization->uri; ?></span>
                                <? // Module Organizations => EDIT_ORGANIZATION = 17
                                if (in_array(17, $user->permissions)) : ?>
                                    <a onclick="organization.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? // Module Organizations => EDIT_ORGANIZATION = 17
                            if (in_array(17, $user->permissions)) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="organizationURI" name="uri" type="text" class="form-group__control form-group__control-group-input" value="<?= $organization->uri; ?>" maxlength="64">
                                    <label onclick="organization.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="organization.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                </div>

            </div>

        </div>

    </div>


    <h3 class="section__heading">
        <? // Module Organizations => INVITE_CO_WORKER = 18
        if (in_array(18, $user->permissions)) : ?>
            <a data-toggle="modal" data-area="inviteCoWorkerModal" role="button" class="fl_r">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
            </a>
        <? endif; ?>
        Сотрдники
    </h3>

    <div class="row">
        <div class="col-xs-12">
            <div class="block">
                <?= View::factory('organizations/blocks/co-workers', array('organization' => $organization)); ?>
            </div>
        </div>
    </div>

    <input type="hidden" id="organizationID" value="<?=$organization->id; ?>">
</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/organization.min.js?v=<?= filemtime("assets/frontend/bundles/organization.min.js") ?>"></script>