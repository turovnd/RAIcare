<div class="section__content">

    <?= View::factory('form-of-long-term-care/start', array('pension' => $pension)); ?>

</div>

<input type="hidden" id="pensionID" value="<?=$pension->id; ?>">
<input type="hidden" id="patientID" value="">


<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>