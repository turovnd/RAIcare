<div class="section__content">

    <h3 class="text-brand">Загрузка ...</h3>

</div>

<input type="hidden" id="surveyPK" value="<?=$survey->pk; ?>">
<input type="hidden" id="pensionID" value="<?=$pension->id; ?>">
<input type="hidden" id="patientPK" value="<?=$survey->patient; ?>">
<input type="hidden" id="pensionURI" value="<?=$pension->uri; ?>">
<input type="hidden" id="unavailableUnits" value='<?= $survey->unavailable_units; ?>'>


<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/patient.min.js?v=<?= filemtime("assets/frontend/bundles/patient.min.js") ?>"></script>

<script type="text/javascript">

    function ready() {
        survey.get.unitstart();
    }

    document.addEventListener("DOMContentLoaded", ready);


</script>