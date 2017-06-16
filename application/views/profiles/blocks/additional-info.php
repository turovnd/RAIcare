<div id="additionalInfo" class="form">

    <div class="form__body">

        <fieldset class="js-field-name">
            <label class="col-sm-3 col-md-2 form-group__label">Анкета</label>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <p class="form-group__control-static">
                    <a class="link" href="<?= URL::site('client/' . $profile->client->id); ?>">Клиент #<?= $profile->client->id; ?></a>
                </p>
            </div>
        </fieldset>

        <fieldset class="js-field-name m-b-0 p-b-10">
            <label class="col-sm-3 col-md-2 form-group__label">Роль и права</label>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <div class="form-group__control-static">

                <p class="text-bold"><?= $profile->role->name; ?></p>
                <ul>
                    <? foreach ($profile->role->permissions as $permission) : ?>
                        <li><?=$permission->name; ?></li>
                    <? endforeach; ?>
                </ul>

                </div>
            </div>
        </fieldset>

    </div>

</div>