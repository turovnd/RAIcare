<div class="col-xs-12 col-sm-6">
    <div class="block">

        <? // Module Patients => WATCH_ALL_PATIENTS_PROFILES = 34
        if (in_array(34, $user->permissions)) : ?>
        <a href="<?=URL::site('/patient/' . $patient->pk); ?>" class="block__heading js-searching-name">
            <?= $patient->name; ?>
        </a>
        <? endif; ?>

        <? // Module Patients => WATCH_PATIENTS_PROFILES_IN_PEN
        if (in_array(35, $user->permissions)) : ?>
            <a href="<?=URL::site('pension/' . $patient->pension->id . '/patient/' . $patient->id); ?>" class="block__heading js-searching-name">
                <?= $patient->name; ?>
            </a>
        <? endif; ?>


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

                <? // Module Patients => WATCH_ALL_PATIENTS_PROFILES = 34
                if (in_array(34, $user->permissions)) : ?>

                    <div class="form-group">
                        <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                            Пансионат
                        </label>
                        <div class="col-xs-12 col-md-7 col-lg-8">
                            <a href="<?=URL::site('pension/' . $patient->pension->id); ?>" class="form-group__control-static link">
                                <?= $patient->pension->name; ?>
                            </a>
                        </div>
                    </div>

                <? endif; ?>

                <? // Module Patients => WATCH_PATIENTS_PROFILES_IN_PEN = 35 || WATCH_ALL_PATIENTS_PROFILES = 34
                if (in_array(35, $user->permissions) || in_array(34, $user->permissions)) : ?>

                    <div class="form-group">
                        <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                            Создатель
                        </label>
                        <div class="col-xs-12 col-md-7 col-lg-8">
                            <? // Module Profile => CONST WATCH_CERTAIN_USER = 11
                            if (in_array(11, $user->permissions)) : ?>
                                <a href="<?=URL::site('profile/' . $patient->creator->id); ?>" class="form-group__control-static link">
                                    <?= $patient->creator->name; ?>
                                </a>
                            <? else: ?>
                            <p class="form-group__control-static"> <?= $patient->creator->name; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                <? endif; ?>

                <? // Module Patients && Pensions => CAN_CONDUCT_A_SURVEY = 36
                if (in_array(36, $user->permissions)) : ?>

                    <div class="form-group collapse" id="formType<?=$patient->id; ?>">
                        <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                            Причина прохождения оценки
                        </label>
                        <div class="col-xs-12 col-md-7 col-lg-8 p-b-10">
                            <select class="form-group__control js-form-type">
                                    <option value=""></option>
                                <? foreach (Kohana::$config->load('form_type.new') as $key => $type) : ?>
                                    <option value="<?= $key; ?>"><?= $type; ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                    </div>

                <? endif; ?>


            </div>
        </div>


        <? // Module Patients && Pensions => CAN_CONDUCT_A_SURVEY = 36
        if (in_array(36, $user->permissions)) : ?>

            <a href="<?= URL::site('pension/' . $patient->pension->id . '/survey/' . $patient->form->id); ?>" class="block__footer clear-fix text-center text-brand text-bold user-select--none <?= $patient->form->id ? '' : 'hide'; ?>">
                Продолжить оценивание
            </a>

            <a data-area="formType<?=$patient->id; ?>" data-opened="false" class="block__footer clear-fix text-center text-brand text-bold user-select--none <?= $patient->form->id ? 'hide' : ''; ?>" onclick="this.classList.add('hide'); document.getElementById('openForm<?=$patient->id; ?>').classList.remove('hide'); raisoft.collapse.toggle(this)">
                Новая оценка
            </a>

            <a id="openForm<?=$patient->id; ?>" class="block__footer clear-fix text-center text-brand text-bold user-select--none hide" data-pk="<?=$patient->pk; ?>" data-area="formType<?=$patient->id; ?>" onclick="survey.send.newpatientformwithtype(this)">
                Продолжить
            </a>

        <? endif; ?>


    </div>
</div>