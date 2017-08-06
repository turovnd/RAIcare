<div class="section__content">

    <h3 class="section__heading">
        <a role="button" data-toggle="modal" data-area="newPatientModalForm" class="btn btn--brand btn--sm m-0 fl_r">Новый пациент</a>
        Все пациенты пансионата - <?= $pension->name; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <form class="search" data-search="pensions">
                <input id="search" type="search" placeholder="Начните вводить ФИО пациента или номер СНИЛСа" class="search__input" oninput="patient.get.search(this)" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                <label for="search" class="search__submit">
                    <i class="fa fa-search search__submit-icon" aria-hidden="true"></i>
                </label>
            </form>


            <div class="row block-wrapper" id="patients">

                <? foreach ($patients as $patient) : ?>

                    <?= View::factory('patients/blocks/search-block', array('patient' => $patient)); ?>

                <? endforeach; ?>

            </div>

            <div class="text-center m-t-20 m-b-50">
                <button id="getMorePatientsBtn" onclick="patient.get.patients(this)" data-offset="<?= count($patients); ?>" class="btn btn--lg btn--default btn--round p-r-50 p-l-50 m-0">
                    Загрузить ещё
                </button>
            </div>

        </div>

    </div>

    <?= View::factory('patients/blocks/new'); ?>

    <input type="hidden" id="pensionID" value="<?=$pension->id; ?>">

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/patient.min.js?v=<?= filemtime("assets/frontend/bundles/patient.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>