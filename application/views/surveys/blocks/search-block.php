<div class="col-xs-12 col-sm-6">
    <div class="block">

        <? // Module Reports=> WATCH_ALL_SURVEYS = 37
        if (in_array(37, $user->permissions)) : ?>
            <a href="<?=URL::site('/survey/' . $survey->pk); ?>" class="block__heading">
                Форма оценки #<?= $survey->pk; ?>
            </a>
        <? endif; ?>

        <? // Module Reports => WATCH_SURVEY_IN_PEN = 39
        if (in_array(39, $user->permissions)) : ?>
            <a href="<?=URL::site('pension/' . $survey->pension->id . '/survey/' . $survey->id); ?>" class="block__heading">
                Форма оценки #<?= $survey->id; ?>
            </a>
        <? endif; ?>


        <div class="block__body">
            <div class="row">

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Тип
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <?= Kohana::$config->load('form_type.new')[$survey->type]; ?>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Статус
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <? switch ($survey->status) {
                                case 1:
                                    echo 'на заполнение';
                                    break;
                                case 2:
                                    echo 'заполнена';
                                    break;
                                case 3:
                                    echo 'удалена';
                                    break;
                                }; ?>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Пациент
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <? // Module Reports=> CONST WATCH_ALL_SURVEYS = 37
                            if (in_array(37, $user->permissions)) : ?>
                                <a class="link" href="<?=URL::site('patient/' . $survey->patient->pk)?>"><?=$survey->patient->name; ?></a>
                            <? endif; ?>
                            <? // Module Reports => WATCH_SURVEY_IN_PEN = 39
                            if (in_array(39, $user->permissions)) : ?>
                                <a class="link" href="<?=URL::site('patient/' . $survey->patient->id)?>"><?=$survey->patient->name; ?></a>
                            <? endif; ?>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Пансионат
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <a class="link" href="<?=URL::site('pension/' . $survey->pension->id)?>"><?=$survey->pension->name; ?></a>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Организация
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <a class="link" href="<?=URL::site('organization/' . $survey->organization->id)?>"><?=$survey->organization->name; ?></a>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Даты
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <?= Date('d M Y H:i', strtotime($survey->dt_create)) . ' - ' . Date('d M Y H:i', strtotime($survey->dt_finish)) ; ?>
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-md-5 col-lg-4 form-group__label">
                        Создатель
                    </label>
                    <div class="col-xs-12 col-md-7 col-lg-8">
                        <p class="form-group__control-static">
                            <a class="link" href="<?=URL::site('profile/' . $survey->creator->id)?>"><?=$survey->creator->name; ?></a>
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>