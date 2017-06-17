<div class="section__content">

    <?
    switch ($unit) {
        case 'start' :
            echo View::factory('long-term-form/start', array('pension' => $pension));
            break;
        case 'progress' :
            echo View::factory('long-term-form/progress', array('form' => $form));
            break;
    }
    ?>



</div>

<input type="hidden" id="pensionID" value="<?=$pension->id; ?>">
<input type="hidden" id="formID" value="<?= $form ? $form->id : ''; ?>">


<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>