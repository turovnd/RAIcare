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
                                <a onclick="pension.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </p>
                            <div class="form-group__control-group hide">
                                <input id="pensionName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $pension->name; ?>" maxlength="256">
                                <label onclick="pension.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                <label onclick="pension.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="js-field-name m-0 p-b-10">
                        <label for="pensionURI" class="col-sm-3 col-md-2 form-group__label">Адрес (URI) </label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span class="js-pension-info"><?= $pension->uri; ?></span>
                                <a onclick="pension.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </p>
                            <div class="form-group__control-group hide">
                                <input id="pensionURI" name="uri" type="text" class="form-group__control form-group__control-group-input" value="<?= $pension->uri; ?>" maxlength="64">
                                <label onclick="pension.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                <label onclick="pension.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                            </div>
                        </div>
                        <small class="col-xs-12 text-normal text-italic text-danger">
                            После изменения адреса пансионата, страница на которой Вы находитесь будет не доступна. Для того, чтобы попасть на новую страницу пансионта, необходимо перейти на <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/dashboard'; ?>" class="link">главную</a> и выбрать пансионат.
                        </small>
                    </fieldset>

                </div>

            </div>

        </div>

    </div>

    <input type="hidden" id="pensionID" value="<?=$pension->id; ?>">
</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/pension.min.js?v=<?= filemtime("assets/frontend/bundles/pension.min.js") ?>"></script>