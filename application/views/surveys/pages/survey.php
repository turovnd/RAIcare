<div class="section__content">

    <h3 class="section__heading">
        Форма оценки #<?= $survey->id; ?>
    </h3>

    <div class="row">
        <? echo json_encode($survey) ?>
    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>