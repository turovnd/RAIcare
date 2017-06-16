<div class="col-xs-12 col-sm-6">
    <div class="block">
        <a href="<?=URL::site('pension/' . $pension_id . '/patient/' . $patient->id); ?>" class="block__heading js-searching-name">
            <?= $patient->name; ?>
        </a>

        <div class="block__body">
            <div class="row">

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Дата рождения
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <?=$patient->birthday; ?>
                        </p>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        СНИЛС
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static" data-id="<?= $patient->creator->id; ?>">
                            <?= chunk_split($patient->snils, 3); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <a class="block__footer clear-fix text-center text-brand text-bold">
                Выбрать
        </a>


    </div>
</div>