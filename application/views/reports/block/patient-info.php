<div class="block">
    <div class="block__body">
        <div class="form-group">
            <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Пациент</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static"><?= $survey->patient->name; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата рождения</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static"><?= date('d M Y', strtotime($survey->patient->birthday)); ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Возраст</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static"><?= Methods_Time::relativeTimeWithPlural(intval((time()-strtotime($survey->patient->birthday))/Date::YEAR), false, 'yy'); ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Пол</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static"><?= $survey->patient->sex == 1 ? 'мужской' : 'женский'; ?></p>
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
                <p class="form-group__control-static"><?= date('d M Y H:i', strtotime($survey->dt_first_survey)); ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата начала прохождения оценки</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static"><?= date('d M Y H:i', strtotime($survey->dt_create)); ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата окончания прохождения оценки</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static"><?= date('d M Y H:i', strtotime($survey->dt_finish)); ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Пансионат</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static">
                    <a class="link" href="<?=URL::site('pension/'. $survey->pension->id); ?>"><?= $survey->pension->name; ?></a>
                </p>
            </div>
        </div>
    </div>
</div>