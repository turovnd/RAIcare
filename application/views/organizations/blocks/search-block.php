<div class="col-xs-12 col-sm-6">
    <div class="block">
        <a href="<?=URL::site('organization/' . $organization->id); ?>" class="block__heading js-searching-name">
            <?= $organization->name; ?>
        </a>

        <div class="block__body">
            <div class="row">

                <? if ($organization->is_removed) : ?>
                    <label class="label label--danger fl_r m-r-20 m-b-10">удалена</label>
                <? endif; ?>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Адрес
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <a class="link" href="<?=URL::site('organization/' . $organization->id); ?>"><?= 'https://' . $organization->uri . '.' .$_SERVER["HTTP_HOST"]; ?></a>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Основатель
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static" data-id="<?= $organization->owner->id; ?>">
                            <a class="link" href="<?=URL::site('profile/' . $organization->owner->id); ?>"><?= $organization->owner->name; ?></a>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Создатель
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static" data-id="<?= $organization->creator->id; ?>">
                            <a class="link" href="<?=URL::site('profile/' . $organization->creator->id); ?>"><?= $organization->creator->name; ?></a>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Дата создания
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <?= $organization->dt_create; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <? // Module Admin => permission: ADMIN_EDIT_ORGANIZATION = 3
        if (in_array(3, $user->permissions)) : ?>

            <div class="block__footer clear-fix">
                <button type="button" class="btn btn--default m-0 fl_r">Редактировать</button>
            </div>

        <? endif; ?>

    </div>
</div>