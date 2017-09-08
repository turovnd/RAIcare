<div class="section__content">

    <h3 class="text-brand">Загрузка ...</h3>

</div>

<input type="hidden" id="surveyID" value="<?=$survey->pk; ?>">
<input type="hidden" id="pensionID" value="<?=$survey->pension; ?>">
<input type="hidden" id="unavailableUnits" value='<?= $survey->unavailable_units; ?>'>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/patient.min.js?v=<?= filemtime("assets/frontend/bundles/patient.min.js") ?>"></script>



<script type="text/javascript">

    raicare.table.init();

    function ready() {
        survey.get.unitstart();
    }

    document.addEventListener("DOMContentLoaded", ready);


</script>