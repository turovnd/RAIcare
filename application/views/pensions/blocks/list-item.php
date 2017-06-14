
<div class="block">
    <div class="block__body">
        <div class="row">

            <div class="form-group">
                <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                    Название
                </label>
                <div class="col-xs-12 col-md-7 col-lg-8">
                    <p class="form-group__control-static">
                        <?= $pension->name; ?>
                    </p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                    Организация
                </label>
                <div class="col-xs-12 col-md-7 col-lg-8">
                    <p class="form-group__control-static">
                        <a class="link" href="<?= URL::site('organization/' . $pension->organization->id); ?>"><?= $pension->organization->name; ?></a>
                    </p>
                </div>
            </div>

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

</div>