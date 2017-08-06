<h3 class="section__heading">
    <? if ($can_conduct && Model_Survey::getTotalProgress($survey->pk) == 100) : ?>
        <a onclick="survey.send.complete()" role="button" class="btn btn--brand btn--sm m-b-0 fl_r">Завершить</a>
    <? endif; ?>
    Прогресс заполнения формы оценки
</h3>

<div class="row">

    <div class="col-xs-12">

        <?= View::factory('surveys/blocks/progress-info', array('patient' => $survey->patient, 'survey' => $survey)); ?>
        <?= View::factory('surveys/blocks/progress-addition', array('patient' => $survey->patient, 'survey' => $survey)); ?>

    </div>

</div>