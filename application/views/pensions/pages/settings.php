<div class="section__content">

    <h3 class="section__heading">
        Основная информация
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <div id="pension" class="form">

                <div class="form__body">

                    <fieldset class="js-field-name">
                        <label for="pensionName" class="col-sm-3 col-md-2 form-group__label">Название</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-pension-info"><?= $pension->name; ?></span>
                                <? // Module Pensions => EDIT_PENSION = 27
                                if (in_array(27, $user->permissions)) : ?>
                                    <a onclick="pension.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? // Module Pensions => EDIT_PENSION = 27
                            if (in_array(27, $user->permissions)) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="pensionName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $pension->name; ?>" maxlength="256">
                                    <label onclick="pension.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="pension.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="js-field-name m-0 p-b-10">
                        <label for="pensionURI" class="col-sm-3 col-md-2 form-group__label">Адрес (URI)</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-pension-info"><?= $pension->uri; ?></span>
                                <? // Module Pensions => EDIT_PENSION = 27
                                if (in_array(27, $user->permissions)) : ?>
                                    <a onclick="pension.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? // Module Pensions => EDIT_PENSION = 27
                            if (in_array(27, $user->permissions)) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="pensionURI" name="uri" type="text" class="form-group__control form-group__control-group-input" value="<?= $pension->uri; ?>" maxlength="64">
                                    <label onclick="pension.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="pension.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                </div>

            </div>

        </div>

    </div>


    <h3 class="section__heading">
        <? // Module Pensions => INVITE_CO_WORKER = 28
        if (in_array(28, $user->permissions)) : ?>
            <a data-toggle="modal" data-area="inviteCoWorkerModal" role="button" class="fl_r">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
            </a>
        <? endif; ?>
        Сотрдники
    </h3>

    <div class="row">
        <div class="col-xs-12">
            <div class="block">
                <?= View::factory('pensions/blocks/co-workers', array('pension' => $pension)); ?>
            </div>
        </div>
    </div>

    <input type="hidden" id="pensionID" value="<?=$pension->id; ?>">
</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/pension.min.js?v=<?= filemtime("assets/frontend/bundles/pension.min.js") ?>"></script>