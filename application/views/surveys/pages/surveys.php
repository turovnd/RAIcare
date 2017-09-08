<div class="section__content" id="surveys">

    <h3 class="section__heading">
        Все формы оценки - <?= $pension->name; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <div class="block" id="progressInfo">
                <div class="block__body">
                    <table class="tablesaw table-style--surveys" data-tablesaw-mode="stack">
                        <thead>
                            <tr>
                                <th width="30%" >Пациент</th>
                                <th width="15%">Прогресс</th>
                                <th width="20%">Время</th>
                                <th width="30%">Ответственный</th>
                            </tr>
                        </thead>
                        <tbody valign="middle" id="allSurveyItems">

                            <? foreach ($surveys as $survey) {
                                echo View::factory('surveys/blocks/all-surveys-item',array('survey' => $survey, 'pen_uri' => $pension->uri));
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="text-center m-t-20 m-b-10">
            <button id="loadMoreBtn" onclick="survey.load.surveys()" data-pension="<?= $pension->id; ?>" data-offset="<?= count($surveys); ?>" class="btn btn--lg btn--default btn--round p-r-50 p-l-50">
                Загрузить ещё
            </button>
        </div>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>

<script>
    raicare.table.init();
    raicare.table.create();
    survey.load.init();
</script>