<div class="block">
    <div class="block__body">
        <a role="button" data-toggle="collapse" data-area="patientInfo" data-opened="false" data-textclosed="подробно" data-textopened="кратко" class="pos-absolute right-0 btn btn--sm btn--default m-b-0 m-r-15 collapse-btn" style="z-index: 1"></a>
        <div class="form-group">
            <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Пациент</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static">
                    <a class="link" href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/patient/'. $patient->id; ?>"><?= $patient->name; ?></a>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата рождения</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static"><?= strftime('%e %b %Y', strtotime($patient->birthday)) . '  ('. Methods_Time::relativeTimeWithPlural(intval((time()-strtotime($patient->birthday))/Date::YEAR), false, 'yy') . ')'; ?></p>
            </div>
        </div>
        <div class="fl_l collapse" id="patientInfo">
            <div class="form-group">
                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Пол</label>
                <div class="col-xs-12 col-sm-8 col-md-9">
                    <p class="form-group__control-static"><?= $patient->sex == 1 ? 'мужской' : 'женский'; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Причина прохождения оценки</label>
                <div class="col-xs-12 col-sm-8 col-md-9">
                    <p class="form-group__control-static"><?= Kohana::$config->load('form_type.new')[$survey->type]; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата поступления</label>
                <div class="col-xs-12 col-sm-8 col-md-9">
                    <p class="form-group__control-static"><?= strftime('%e %b %Y', strtotime($patient->dt_first_survey)); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата начала прохождения оценки</label>
                <div class="col-xs-12 col-sm-8 col-md-9">
                    <p class="form-group__control-static"><?= strftime('%e %b %Y', strtotime($survey->dt_create)); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата окончания прохождения оценки</label>
                <div class="col-xs-12 col-sm-8 col-md-9">
                    <p class="form-group__control-static"><?= strftime('%e %b %Y', strtotime($survey->dt_finish)); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Пансионат</label>
                <div class="col-xs-12 col-sm-8 col-md-9">
                    <p class="form-group__control-static"><?= $pension->name; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>