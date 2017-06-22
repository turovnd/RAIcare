<div class="section__content">

    <h3 class="text-brand">Загрузка ...</h3>

</div>

<input type="hidden" id="surveyID" value="<?=$survey->pk; ?>">
<input type="hidden" id="pensionID" value="<?=$survey->pension->id; ?>">

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>

<script type="text/javascript">

    document.getElementById('pen_survey').classList.remove('hide');

    function ready() {
        survey.get.unitstart();
    }

    document.addEventListener("DOMContentLoaded", ready);


</script>