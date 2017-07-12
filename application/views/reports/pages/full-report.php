<div class="section__content">


    <h3 class="section__heading">
        <a role="button" onclick="window.history.back()" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn">Назад</a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-print" aria-hidden="true"></i></a>

        <? // CONST WATCH_ALL_SURVEYS = 37
        if (in_array(37, $user->permissions)) : ?>
            Полный отчет формы оценки #<?= $survey->pk; ?>
        <? else: ?>
            Полный отчет формы оценки #<?= $survey->id; ?>
        <? endif; ?>

    </h3>

    <div class="row">
        <div class="col-xs-12">
            <div class="block">
                <div class="block__body">
                    <div class="form-group">
                        <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Продолжительность</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static"><?= Methods_Time::getTimeFromTime($survey->dt_finish,$survey->dt_create); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата создания</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static"><?= date('d M Y H:i', strtotime($survey->dt_create)); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата завершения</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static"><?= date('d M Y H:i', strtotime($survey->dt_finish)); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Создатель</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static">
                                <? // WATCH_CERTAIN_USER = 11;
                                if (in_array(11, $user->permissions)) : ?>
                                    <a class="link" href="<?=URL::site('profile/'. $survey->creator->id); ?>"><?= $survey->creator->name; ?></a>
                                <? else: ?>
                                    <?= $survey->creator->name; ?>
                                <? endif; ?>
                            </p>
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
            <??>
        </div>
    </div>

    <?= View::factory('surveys/units/unitA', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitB', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitC', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitD', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitE', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitF', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitG', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitH', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitI', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitJ', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitK', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitL', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitM', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitN', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitO', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitP', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitQ', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitR', array('survey' => $survey, 'can_conduct' => false)); ?>

</div>

<script type="text/javascript">
    raisoft.table.init();
</script>