<div class="section__content">

    <h3 class="section__heading">
        <? // ROLE_PEN_NURSE => 23;
        if ($user->role == 23) : ?>
            <a role="button" data-toggle="modal" data-area="newPatientModalForm" class="btn btn--brand btn--sm m-0 fl_r">Новый пациент</a>
        <? endif; ?>
        Пациенты пансионата - <?= $pension->name; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <div class="block">
                <div class="block__body">
                    <table class="" id="patients">
                        <thead>
                            <tr>
                                <th data-sortable="true" width="5%">#</th>
                                <th data-sortable="true" width="20%">Пациент</th>
                                <th data-sortable="true" data-type="date" data-format="DD MMM YYYY" width="15%">Посл.анкетир.</th>
                                <th data-sortable="true" width="20%">Ответственный</th>
                                <th class="text-center" data-sortable="false" width="20%">Текущий статус</th>
                                <th class="text-center" data-sortable="false" width="20%">Отчеты</th>
                            </tr>
                        </thead>
                        <tbody>

                            <? foreach ($patients as $patient) : ?>

                                <tr>
                                    <td>
                                        <?=$patient->id; ?>
                                    </td>
                                    <td>
                                        <span class="text-bold text-brand"> <?=$patient->name; ?> </span>
                                        <br>
                                        СНИЛС: <?= $patient->snils; ?>
                                    </td>
                                    <td class="js-date" data-timestamp="<?= $patient->survey->dt_create_timestamp; ?>">
                                        <?= date('d.m.Y',$patient->survey->dt_create_timestamp); ?>
                                    </td>
                                    <td>
                                        <?= $patient->survey->creator->name; ?>
                                    </td>
                                    <td class="text-center">

                                        <? if ($patient->survey->status == 1) : ?>
                                            <small class="text-bold <?= ($patient->survey->dt_create_timestamp + Date::DAY * 3 - time()) < Date::DAY / 2 ? 'text-danger' : 'text-brand'; ?>">
                                                <span class="f-s-1_2"><?= Model_Survey::getTotalProgress($patient->survey->pk) . '%'; ?></span>
                                                <br>
                                                <span>Завершиться</span>
                                                <br>
                                                <span class="js-data-fromNow" data-timestamp="<?= $patient->survey->dt_create_timestamp + Date::DAY * 3; ?>"> </span>
                                            </small>
                                            <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/survey/' . $patient->survey->id; ?>" class="btn btn--sm m-5 <?= ($patient->survey->dt_create_timestamp + Date::DAY * 3 - time()) < Date::DAY / 2 ? 'btn--danger' : 'btn--brand'; ?>">
                                                <?= // ROLE_PEN_NURSE => 23;
                                                ($user->role == 23) ? 'Продолжить' : 'Подробно'; ?>
                                            </a>
                                        <? elseif ($patient->survey->status == 2): ?>
                                            <small class="text-italic text-gray">
                                                <span>Рекомендуем</span>
                                                <br>
                                                <span class="js-date" data-timestamp="<?= $patient->survey->dt_create_timestamp + Date::MONTH * 3; ?>">
                                                    <?= date('d.m.Y',$patient->survey->dt_create_timestamp + Date::MONTH * 3); ?>
                                                </span>
                                            </small>
                                            <? // ROLE_PEN_NURSE => 23;
                                            if ($user->role == 23) : ?>
                                                <button class="btn btn--sm m-5 <?= $patient->survey->dt_create_timestamp + Date::MONTH * 3 - time() < 0 ? 'btn--brand' : 'btn--default'; ?>"
                                                        data-pk="<?= $patient->pk; ?>" onclick="survey.new.createModal(this);">
                                                    Новая оценка
                                                </button>
                                            <? endif; ?>
                                        <? else: ?>
                                            <small class="text-danger text-bold">
                                                <span>Удалена</span>
                                                <br>
                                                <span>проведите снова</span>
                                            </small>
                                            <? // ROLE_PEN_NURSE => 23;
                                            if ($user->role == 23) : ?>
                                                <button class="btn btn--sm btn--danger m-5" data-pk="<?= $patient->pk; ?>" onclick="survey.new.createModal(this);">
                                                    Новая оценка
                                                </button>
                                            <? endif; ?>
                                        <? endif; ?>

                                    </td>

                                    <td class="text-center">
                                        <? // ROLE_PEN_CREATOR || ROLE_PEN_QUALITY_MANAGER => 20 || 22
                                        if ($user->role == 20 || $user->role == 22) : ?>
                                            <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/patient/' . $patient->id; ?>" class="btn btn--sm btn--default m-5">
                                                Личное дело
                                            </a>
                                        <? endif; ?>
                                        <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/report/' . $patient->survey->id .'/careplan'; ?>" class="btn btn--sm btn--default m-5">
                                            План ухода
                                        </a>
                                        <br>
                                        <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/report/' . $patient->survey->id .'/status'; ?>" class="btn btn--sm btn--default m-5">
                                            Текущее состояние
                                        </a>
                                    </td>
                                </tr>

                            <? endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Пациент</th>
                                <th>Посл.анкетир.</th>
                                <th>Ответственный</th>
                                <th class="text-center">Текущий статус</th>
                                <th class="text-center">Отчеты</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>

    </div>


    <? // ROLE_PEN_NURSE => 23;
    if ($user->role == 23) : ?>

        <?= View::factory('patients/blocks/new'); ?>

        <div id="surveyReasonOptions" class="hide" data-html='<? foreach (Kohana::$config->load('form_type.new') as $key => $type) : ?><option value="<?= $key; ?>"><?= $type; ?></option><? endforeach; ?>'></div>

    <? endif; ?>

    <input type="hidden" id="pensionID" value="<?=$pension->id; ?>">

</div>

<script type="text/javascript" src="<?=$assets; ?>vendor/moment/min/moment-with-locales.min.js?v=<?= filemtime("assets/vendor/moment/min/moment-with-locales.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/patient.min.js?v=<?= filemtime("assets/frontend/bundles/patient.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>

<script type="text/javascript">
    patient.table.initAllPatients();
    patient.new.init();
    survey.new.init();
</script>