<div class="section__content">

    <h3 class="section__heading">
        База данных пациентов всех пансионатов
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <form class="search" data-search="pensions">
                <input id="search" type="search" placeholder="Начните вводить ФИО пациента или номер СНИЛСа" class="search__input" oninput="survey.get.search(this, 'getAll')" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                <label for="search" class="search__submit">
                    <i class="fa fa-search search__submit-icon" aria-hidden="true"></i>
                </label>
            </form>

            <div class="row block-wrapper" id="patients">

                <? foreach ($patients as $patient) : ?>

                    <?= View::factory('patients/blocks/search-block', array('patient' => $patient)); ?>

                <? endforeach; ?>

            </div>

            <div class="text-center m-t-20 m-b-10">
                <button id="getMorePatientsBtn" onclick="survey.get.patients(this, 'getAll')" data-offset="<?= count($patients); ?>" class="btn btn--lg btn--default btn--round p-r-50 p-l-50">
                    Загрузить ещё
                </button>
            </div>

        </div>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>