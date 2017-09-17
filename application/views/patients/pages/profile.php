<div class="section__content">

    <h3 class="section__heading">
        <a role="button" data-toggle="collapse" data-area="personalInfo" data-opened="false" data-textclosed="подробно" data-textopened="кратко" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r collapse-btn"></a>
        Личное дело #<?=$patient->id; ?>
    </h3>


    <?= View::factory('patients/blocks/profile-info', array('patient' => $patient))?>



    <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/patient/' . $patient->id .'/careplan'; ?>" class="btn btn--lg btn--brand m-t-10 m-r-30">
        План ухода
    </a>

    <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/patient/' . $patient->id .'/status'; ?>" class="btn btn--lg btn--brand m-t-10 m-r-30">
        Текущее состояние
    </a>

    <div class="btn btn--lg btn--default m-t-10 pointer-events--none">
        Следующее
        <span class="js-date" data-timestamp="<?= $patient->survey->dt_create_timestamp + Date::MONTH * 3; ?>">
            <?= date('d.m.Y',$patient->survey->dt_create_timestamp + Date::MONTH * 3); ?>
        </span>
    </div>



    <h3 class="section__heading">
        <a id="openCompareBtn" role="button" data-toggle="collapse" data-area="compareReportsBlock" data-opened="false" data-textclosed="cравнить" data-textopened="отмена" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r collapse-btn"></a>
        История анкетирований
    </h3>

    <div id="compareReportsBlock" class="collapse block">
        <div class="block__body">
            <div class="text-italic">
                Для того чтобы произвести сравнение анкет, отметьте их галочкой в таблице и нажмите на кнопку
            </div>
            <button id="compareBtn" class="btn btn--brand m-t-10 m-b-0">Сравнить отчеты</button>
        </div>
    </div>

    <div class="block">
        <div class="block__body">
            <table id="surveysHistory">
                <thead>
                <tr>
                    <th data-sortable="true" width="5%">#</th>
                    <th data-sortable="true" data-type="date" data-format="DD MMM YYYY" width="20%">Дата</th>
                    <th data-sortable="true" width="20%">Текущий статус</th>
                    <th data-sortable="true" width="20%">Ответственный</th>
                    <th class="text-center" data-sortable="false" width="30%">Отчеты</th>
                    <th class="text-center" data-sortable="false" width="5%">
                        <input id="checkAll" type="checkbox" class="checkbox">
                        <label for="checkAll" class="checkbox-label"></label>
                    </th>
                </tr>
                </thead>
                <tbody>

                    <? foreach ($surveys as $survey) : ?>

                        <tr>
                            <td>
                                <?= $survey->id; ?>
                            </td>
                            <td class="js-date" data-timestamp="<?= strtotime($survey->dt_create); ?>">
                                <?= date('d.m.Y',strtotime($survey->dt_create)); ?>
                            </td>
                            <td>
                                <? switch ($survey->status) {
                                    case 1: echo "заполняется"; break;
                                    case 2: echo "завершена"; break;
                                    case 3: echo "удалена"; break;
                                } ?>
                            </td>
                            <td>
                                <?= $survey->creator->name; ?>
                            </td>
                            <td class="text-center">
                                <? if ($survey->status == 1): ?>
                                    <small class="text-bold <?= ($survey->dt_create_timestamp + Date::DAY * 3 - time()) < Date::DAY / 2 ? 'text-danger' : 'text-brand'; ?>">
                                        <span class="f-s-1_2"><?= Model_Survey::getTotalProgress($survey->pk) . '%'; ?></span>
                                        <br>
                                        <span>Завершиться</span>
                                        <br>
                                        <span class="js-data-fromNow" data-timestamp="<?= $survey->dt_create_timestamp + Date::DAY * 3; ?>"> </span>
                                    </small>
                                    <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/survey/' . $survey->id; ?>" class="btn btn--sm m-5 <?= ($survey->dt_create_timestamp + Date::DAY * 3 - time()) < Date::DAY / 2 ? 'btn--danger' : 'btn--brand'; ?>">
                                        Подробно
                                    </a>
                                <? elseif ($survey->status == 2) :?>
                                    <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/report/' . $survey->id .'/personal'; ?>" class="btn btn--sm btn--default m-5">
                                        Персональный
                                    </a>
                                    <br>
                                    <a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/report/' . $survey->id .'/clinical'; ?>" class="btn btn--sm btn--default m-5">
                                        Клинический
                                    </a>
                                <? else: ?>
                                    <small class="text-danger text-bold">
                                        <span>Удалена</span>
                                        <br>
                                        <span>проведите снова</span>
                                    </small>
                                <? endif; ?>
                            </td>
                            <td class="text-center">
                                <? if ($survey->status == 2) :?>
                                    <input id="checkSurvey_<?= $survey->id; ?>" type="checkbox" class="checkbox" value="<?= $survey->pk; ?>">
                                    <label for="checkSurvey_<?= $survey->id; ?>" class="checkbox-label"></label>
                                <? endif; ?>
                            </td>
                        </tr>

                    <? endforeach; ?>

                </tbody>

            </table>
        </div>
    </div>

    <input type="hidden" id="pensionID" value="<?= $patient->pension; ?>">
    <input type="hidden" id="patientPK" value="<?= $patient->pk; ?>">

</div>

<script type="text/javascript" src="<?=$assets; ?>vendor/moment/min/moment-with-locales.min.js?v=<?= filemtime("assets/vendor/moment/min/moment-with-locales.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/patient.min.js?v=<?= filemtime("assets/frontend/bundles/patient.min.js") ?>"></script>
