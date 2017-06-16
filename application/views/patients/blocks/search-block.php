<div class="col-xs-12 col-sm-6">
    <div class="block">
        <a href="<?=URL::site('pension/' . $pension->id); ?>" class="block__heading js-searching-name">
            <?= $pension->name; ?>
        </a>

        <div class="block__body">
            <div class="row">

                <? if ($pension->is_removed) : ?>
                    <label class="label label--danger fl_r m-r-20 m-b-10">удалена</label>
                <? endif; ?>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Адрес
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <a class="link" href="<?=URL::site('pension/' . $pension->id); ?>"><?= 'https://' . $pension->organization->uri . '.' .$_SERVER["HTTP_HOST"] . '/' . $pension->uri; ?></a>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Организация
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <a class="link" href="<?=URL::site('organization/' . $pension->organization->id); ?>"><?= $pension->organization->name; ?></a>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Основатель
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static" data-id="<?= $pension->owner->id; ?>">
                            <a class="link" href="<?=URL::site('profile/' . $pension->owner->id); ?>"><?= $pension->owner->name; ?></a>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Создатель
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static" data-id="<?= $pension->creator->id; ?>">
                            <a class="link" href="<?=URL::site('profile/' . $pension->creator->id); ?>"><?= $pension->creator->name; ?></a>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Дата создания
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <?= $pension->dt_create; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <? // Module Admin => permission: ADMIN_EDIT_PENSION = 4
        if (in_array(4, $user->permissions)) : ?>

            <div class="block__footer clear-fix">
                <button type="button" class="btn btn--default m-0 fl_r">Редактировать</button>
            </div>

        <? endif; ?>

    </div>
</div>