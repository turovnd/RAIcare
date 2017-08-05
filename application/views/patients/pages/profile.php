<div class="section__content">

    <h3 class="section__heading">
        <a role="button" data-toggle="collapse" data-area="personalInfo" data-opened="false" data-textclosed="подробно" data-textopened="кратко" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r collapse-btn"></a>
        Персональные данные пациента #<?=$patient->id; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <?= View::factory('patients/blocks/profile-info', array('patient' => $patient))?>

        </div>

    </div>


    <h3 class="section__heading">
        Последние анкетирования
    </h3>

    <div class="row">

        <?= View::factory('patients/blocks/timeline', array('surveys' => $patient->surveys, 'sameSnils' => '', 'type' => 'id'));?>

    </div>

    <input type="hidden" id="pensionID" value="<?= $patient->pension->id; ?>">
    <input type="hidden" id="patientID" value="<?= $patient->pk; ?>">

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/patient.min.js?v=<?= filemtime("assets/frontend/bundles/patient.min.js") ?>"></script>