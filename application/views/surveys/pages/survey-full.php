<div class="section__content">

    <h3 class="section__heading">
        Форма оценки #<?= $survey->pk; ?>
    </h3>

    <div class="row">
    <? echo json_encode($survey) ?>
    </div>


    <?= View::factory('surveys/units/unitA', array('survey' => $survey, 'can_conduct' => false)); ?>
    <?= View::factory('surveys/units/unitB', array('survey' => $survey, 'can_conduct' => false)); ?>

</div>