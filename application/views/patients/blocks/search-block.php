<div class="col-xs-12 col-sm-6">
    <div class="block">

        <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $patient->pension->uri . '/patient/' . $patient->id; ?>" class="block__heading valign link">
            <i class="fa fa-id-card-o fa-3x" aria-hidden="true"></i>
            <p class="m-0 m-l-15 text-bold">
                <?= $patient->name; ?>
                <small class="text-gray">
                    <?= date('d M Y', strtotime($patient->birthday)) . '  ('. Methods_Time::relativeTimeWithPlural(intval((time()-strtotime($patient->birthday))/Date::YEAR), false, 'yy') . ')'; ?>
                </small>
            </p>
        </a>

        <div class="block__body">

            <div class="form-group m-b-0">
                <div class="form-group__label col-xs-12 col-md-5 col-lg-4 p-l-0 m-b-0">
                    СНИЛС
                </div>
                <div class="form-group__control-static col-xs-12 col-md-7 col-lg-8 p-l-0">
                    <?= chunk_split($patient->snils, 3); ?>
                </div>
            </div>

            <div class="form-group m-b-0">
                <div class="form-group__label col-xs-12 col-md-5 col-lg-4 p-l-0 m-b-0">
                    Создатель
                </div>
                <div class="form-group__control-static col-xs-12 col-md-7 col-lg-8 p-l-0">
                    <?= $patient->creator->name; ?>
                </div>
            </div>

            <? // ROLE_PEN_QUALITY_MANAGER => 22;
            if ($user->role == 22 && $patient->survey->id) : ?>
                <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $patient->pension->uri . '/survey/' . $patient->survey->id; ?>" class="form-group m-b-0 link">
                    <div class="col-xs-12 col-md-5 col-lg-4 p-l-0 m-b-0 f-s-0_9 text-bold p-t-5">
                        Текущая анкета
                    </div>
                    <div class="form-group__control-static col-xs-12 col-md-7 col-lg-8 p-l-0 <?= Methods_Time::getSurveyLeftTime($patient->survey->dt_create, $patient->survey->dt_finish, true) < Date::DAY / 2 ? 'text-danger text-bold' : ''; ?>">
                        Осталось <?= Methods_Time::getSurveyLeftTime($patient->survey->dt_create, $patient->survey->dt_finish); ?>
                    </div>
                </a>
            <? endif; ?>

            <? // ROLE_PEN_NURSE => 23;
            if ($user->role == 23) : ?>

                <div class="form-group collapse m-b-0" id="surveyType<?=$patient->id; ?>">
                    <label for="surveyReason" class="col-xs-12 form-group__label p-l-0">
                        Причина прохождения оценки
                    </label>
                    <div class="col-xs-12 p-0">
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

        <? // ROLE_PEN_NURSE => 23;
        if ($user->role == 23) : ?>
            <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $patient->pension->uri . '/survey/' . $patient->survey->id; ?>" class="block__footer clear-fix text-center text-brand text-bold user-select--none <?= $patient->survey->id ? '' : 'hide'; ?>">
                Продолжить оценивание
            </a>

            <a data-area="surveyType<?=$patient->id; ?>" data-opened="false" class="block__footer clear-fix text-center text-brand text-bold user-select--none <?= $patient->survey->id ? 'hide' : ''; ?>" onclick="this.classList.add('hide'); document.getElementById('openForm<?=$patient->id; ?>').classList.remove('hide'); raicare.collapse.toggle(this)">
                Новая оценка
            </a>

            <a id="openForm<?=$patient->id; ?>" class="block__footer clear-fix text-center text-brand text-bold user-select--none hide" data-pk="<?=$patient->pk; ?>" data-area="surveyType<?=$patient->id; ?>" onclick="survey.send.newpatientformwithtype(this)">
                Продолжить
            </a>
        <? endif; ?>

    </div>
</div>