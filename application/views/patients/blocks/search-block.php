<div class="col-xs-12 col-sm-6">
    <div class="block">

        <? // Module Patients => WATCH_ALL_PATIENTS_PROFILES = 34
        if (in_array(34, $user->permissions)) : ?>
        <a href="<?=URL::site('/patient/' . $patient->pk); ?>" class="block__heading valign link">
            <i class="fa fa-id-card-o fa-3x" aria-hidden="true"></i>
            <p class="m-0 m-l-15 text-bold">
                <?= $patient->name; ?>
                <small class="text-gray">
                    <?= date('d M Y', strtotime($patient->birthday)) . '  ('. Methods_Time::relativeTimeWithPlural(intval((time()-strtotime($patient->birthday))/Date::YEAR), false, 'yy') . ')'; ?>
                </small>
            </p>
        </a>
        <? endif; ?>

        <? // Module Patients => WATCH_PATIENTS_PROFILES_IN_PEN
        if (in_array(35, $user->permissions)) : ?>
        <a href="<?=URL::site('pension/' . $patient->pension->id . '/patient/' . $patient->id); ?>" class="block__heading valign link">
            <i class="fa fa-id-card-o fa-3x" aria-hidden="true"></i>
            <p class="m-0 m-l-15 text-bold">
                <?= $patient->name; ?>
                <small class="text-gray">
                    <?= date('d M Y', strtotime($patient->birthday)) . '  ('. Methods_Time::relativeTimeWithPlural(intval((time()-strtotime($patient->birthday))/Date::YEAR), false, 'yy') . ')'; ?>
                </small>
            </p>
        </a>
        <? endif; ?>


        <div class="block__body">
            <div class="row">

                <div class="clear-fix m-b-10">
                    <label class="col-xs-12 col-md-5 col-lg-4 text-bold">
                        СНИЛС
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <?= chunk_split($patient->snils, 3); ?>
                    </div>
                </div>

                <? // Module Patients => WATCH_ALL_PATIENTS_PROFILES = 34
                if (in_array(34, $user->permissions)) : ?>

                    <div class="clear-fix m-b-10">
                        <label class="col-xs-12 col-md-5 col-lg-4 text-bold">
                            Пансионат
                        </label>
                        <div class="col-xs-12 col-md-7 col-lg-8">
                            <a href="<?=URL::site('pension/' . $patient->pension->id); ?>" class="link">
                                <?= $patient->pension->name; ?>
                            </a>
                        </div>
                    </div>

                <? endif; ?>

                <div class="clear-fix m-b-10">
                    <label class="col-xs-12 col-md-5 col-lg-4 text-bold">
                        Дата создания
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <?= date('d M Y', strtotime($patient->dt_create)); ?>
                    </div>
                </div>


                <div class="clear-fix">
                    <label class="col-xs-12 col-md-5 col-lg-4 text-bold">
                        Создатель
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <? // Module Profile => CONST WATCH_CERTAIN_USER = 11
                        if (in_array(11, $user->permissions)) : ?>
                            <a href="<?=URL::site('profile/' . $patient->creator->id); ?>" class="link">
                                <?= $patient->creator->name; ?>
                            </a>
                        <? else: ?>
                            <p class="m-0"> <?= $patient->creator->name; ?> </p>
                        <? endif; ?>
                    </div>
                </div>

                <? // Module Patients && Pensions => CAN_CONDUCT_A_SURVEY = 36
                if (in_array(36, $user->permissions)) : ?>

                    <div class="form-group collapse m-t-15" id="surveyType<?=$patient->id; ?>">
                        <label for="surveyReason" class="col-xs-12 form-group__label p-t-0">
                            Причина прохождения оценки
                        </label>
                        <div class="col-xs-12">
                            <select id="surveyReason" class="form-group__control js-form-type js-single-select">
                                    <option value="-1" disabled selected>Не выбрано</option>
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

            <a href="<?= URL::site('pension/' . $patient->pension->id . '/survey/' . $patient->survey->id); ?>" class="block__footer clear-fix text-center text-brand text-bold user-select--none <?= $patient->survey->id ? '' : 'hide'; ?>">
                Продолжить оценивание
            </a>

            <a data-area="surveyType<?=$patient->id; ?>" data-opened="false" class="block__footer clear-fix text-center text-brand text-bold user-select--none <?= $patient->survey->id ? 'hide' : ''; ?>" onclick="this.classList.add('hide'); document.getElementById('openForm<?=$patient->id; ?>').classList.remove('hide'); raisoft.collapse.toggle(this)">
                Новая оценка
            </a>

            <a id="openForm<?=$patient->id; ?>" class="block__footer clear-fix text-center text-brand text-bold user-select--none hide" data-pk="<?=$patient->pk; ?>" data-area="surveyType<?=$patient->id; ?>" onclick="survey.send.newpatientformwithtype(this)">
                Продолжить
            </a>

        <? endif; ?>


    </div>
</div>