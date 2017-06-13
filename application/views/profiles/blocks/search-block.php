<div class="col-xs-12 col-sm-6">
    <div class="block">
        <a href="<?=URL::site('profile/' . $profile->id); ?>" class="block__heading js-searching-name link">
            <?= $profile->name . ' (' . $profile->username . ')'; ?>
        </a>

        <div class="block__body">
            <div class="row">

                <? if (!$profile->is_confirmed) : ?>
                    <label class="label label--warning m-l-15 m-b-10 fl_l">пользователь не подтвердил эл.почту</label>
                <? endif; ?>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Эл.почта
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <?= $profile->email; ?>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Роль
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static" data-id="<?= $profile->role->id; ?>">
                            <?= $profile->role->name; ?>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Создатель
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static" data-id="<?= $profile->creator->id; ?>">
                            <a class="link" href="<?=URL::site('profile/' . $profile->creator->id); ?>"><?= $profile->creator->name; ?></a>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Дата создания
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <?= $profile->dt_create; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <? // Module Users => permission: CHANGE_USER_ROLE = 33 RESET_USER_PASSWORD = 12
        if (in_array(33, $user->permissions) || in_array(12, $user->permissions)) : ?>

            <div class="block__footer clear-fix">

                <? // Module Users => permission: RESET_USER_PASSWORD = 12
                if (in_array(12, $user->permissions)) : ?>

                        <button type="button" class="btn btn--brand m-0 fl_l">Сбросить пароль</button>

                <? endif; ?>

                <? // Module Users => permission: CHANGE_USER_ROLE = 33
                if (in_array(33, $user->permissions)) : ?>

                        <button type="button" class="btn btn--default m-0 fl_r">Редактировать</button>

                <? endif; ?>

            </div>

        <? endif; ?>

    </div>
</div>