<div class="section__content">

    <h3 class="section__heading">
        <div class="f-s-0_9 fl_r">
            <? if (Methods_Time::getSurveyLeftTime($survey->dt_create, $survey->dt_finish, true) < Date::DAY / 2) : ?>
                <span class="label label--danger">на заполнении</span>
            <? else : ?>
                <span class="label label--warning">на заполнении</span>
            <? endif; ?>
        </div>
        Прогресс заполнения анкеты #<?= $survey->id; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <?= View::factory('surveys/blocks/progress-info', array('patient' => $patient, 'survey' => $survey)); ?>

            <?= View::factory('surveys/blocks/progress-addition', array('patient' => $patient, 'survey' => $survey)); ?>

        </div>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>