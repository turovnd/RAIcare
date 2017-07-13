<div class="section__content">


    <h3 class="section__heading">
        <a role="button" onclick="window.history.back()" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn">Назад</a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-print" aria-hidden="true"></i></a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>

        <? // CONST WATCH_ALL_SURVEYS = 37
        if (in_array(37, $user->permissions)) : ?>
            Полный отчет формы оценки #<?= $survey->pk; ?>
        <? else: ?>
            Полный отчет формы оценки #<?= $survey->id; ?>
        <? endif; ?>

    </h3>

    <div class="row">
        <div class="col-xs-12">
            <?= View::factory('reports/block/patient-info', array('survey' => $survey)); ?>
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