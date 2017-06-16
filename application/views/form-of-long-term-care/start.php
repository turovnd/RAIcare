<h3 class="section__heading">
    <a role="button" class="btn btn--brand btn--sm m-0 fl_r">Новый пациент</a>
    Анкетирование - выберите пациента
</h3>

<div class="row">

    <div class="col-xs-12">

        <form class="search" data-search="pensions">
            <input id="search" type="search" placeholder="Начните вводить ФИО пациента или номер СНИЛСа" class="search__input" oninput="survey.get.search(this)" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            <label for="search" class="search__submit">
                <i class="fa fa-search search__submit-icon" aria-hidden="true"></i>
            </label>
        </form>

        <div class="row block-wrapper" id="patients">

            <?
                $patients = Model_Patient::getByPension($pension->id,0,10);

                foreach ($patients as $patient) {

                    echo View::factory('patients/blocks/search-block', array('patient' => $patient, 'pension_id' =>$pension->id));

                }
            ?>

        </div>

        <div class="text-center m-t-20 m-b-10">
            <button id="getMorePatientsBtn" onclick="survey.get.patients(this)" data-offset="<?= count($patients); ?>" class="btn btn--lg btn--default btn--round p-r-50 p-l-50">
                Загрузить ещё
            </button>
        </div>

    </div>
    

</div>