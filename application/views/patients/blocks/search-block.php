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
                        <p class="form-group__control-static">
                            <?= chunk_split($patient->snils, 3); ?>
                        </p>
                    </div>
                </div>

                <? // Module Pensions Survey => WATCH_PATIENTS_PROFILES_IN_PEN = 35
                if (in_array(35, $user->permissions)) : ?>

                    <div class="form-group">
                        <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                            Пансионат
                        </label>
                        <div class="col-xs-12 col-md-7 col-lg-8">
                            <a href="<?=URL::site('pension/' . $patient->pension->id); ?>" class="form-group__control-static"">
                                <?= $patient->pension->name; ?>
                            </a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                            Создатель
                        </label>
                        <div class="col-xs-12 col-md-7 col-lg-8">
                            <a href="<?=URL::site('profile/' . $patient->creator->id); ?>" class="form-group__control-static"">
                                <?= $patient->creator->name; ?>
                            </a>
                        </div>
                    </div>

                <? endif; ?>

                <? // Module Pensions Survey => CAN_CONDUCT_A_SURVEY = 36
                if (in_array(36, $user->permissions)) : ?>

                    <div class="form-group collapse" id="formType<?=$patient->id; ?>">
                        <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                            Причина прохождения оценки
                        </label>
                        <div class="col-xs-12 col-md-7 col-lg-8 p-b-10">
                            <select class="form-group__control js-form-type">
                                <option value=""></option>
                                <option value="2">Плановая переоценка</option>
                                <option value="3">Оценка при возвращении</option>
                                <option value="4">Переоценка в связи с существенным изменением состояния</option>
                                <option value="5">Оценка при выписке, покрывает 3 последних дня медицинского обслуживания</option>
                                <option value="6">Отслеживание только в связи с выпиской</option>
                                <option value="6">Другая—напр., проведение исследования</option>
                            </select>
                        </div>
                    </div>

                <? endif; ?>


            </div>
        </div>


        <? // Module Pensions Survey => CAN_CONDUCT_A_SURVEY = 36
        if (in_array(36, $user->permissions)) : ?>

            <a data-toggle="collapse" data-area="formType<?=$patient->id; ?>" data-opened="false" class="block__footer clear-fix text-center text-brand text-bold user-select--none" onclick="this.classList.add('hide'); document.getElementById('openForm<?=$patient->id; ?>').classList.remove('hide')">
                Выбрать
            </a>
            <a id="openForm<?=$patient->id; ?>" class="block__footer clear-fix text-center text-brand text-bold user-select--none hide" data-pk="<?=$patient->id; ?>" data-area="formType<?=$patient->id; ?>" onclick="survey.send.newpatientformwithtype(this)">
                Продолжить
            </a>

        <? endif; ?>


    </div>
</div>