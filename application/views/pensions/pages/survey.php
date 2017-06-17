<div class="section__content">

    <?
    switch ($unit) {
        case 'progress' :
            echo View::factory('long-term-form/progress', array('form' => $form));
            break;
    }
    ?>


    <input type="hidden" id="pensionID" value="<?=$pension->id; ?>">
    <input type="hidden" id="formID" value="<?= $form ? $form->id : ''; ?>">

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>