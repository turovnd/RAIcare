<div class="section__content">

    <h3 class="section__heading">
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
        Текущее состояние резидента #<?= $patient->id; ?>
    </h3>

    <?= View::factory('reports/block/patient-info', array('pension' => $pension, 'patient' => $patient, 'survey' => $survey)); ?>


    <div class="row">

        <div class="col-xs-12 col-sm-6">

            <div class="block">

                <div class="block__body overflow--hidden">

                    <table id="adlSupport">
                        <thead>
                        <tr >
                            <th class="f-s-1_2 valign-middle text-center">Эффективность действий резидента</th>
                            <th class="text-center">
                                <img src="/assets/static/img/status-report/adl-self-0.svg" alt="">
                                <small>самостоятельность</small>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/eating.svg" alt="">
                                <small> Прием пищи </small>
                            </td>
                            <td>
                                <img src="/assets/static/img/status-report/adl-self-<?= $survey->unitG->G1[9]; ?>.svg" alt="">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/hygiene.svg" alt="">
                                <small> Личная гигиена </small>
                            </td>
                            <td>
                                <img src="/assets/static/img/status-report/adl-self-<?= $survey->unitG->G1[1]; ?>.svg" alt="">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/transfer-toilet.svg" alt="">
                                <small> Доступ к туалету </small>
                            </td>
                            <td>
                                <img src="/assets/static/img/status-report/adl-self-<?= $survey->unitG->G1[6]; ?>.svg" alt="">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/toilet-use.svg" alt="">
                                <small> Пользование туалетом </small>
                            </td>
                            <td>
                                <img src="/assets/static/img/status-report/adl-self-<?= $survey->unitG->G1[7]; ?>.svg" alt="">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/bathing.svg" alt="">
                                <small> Ванные процедуры </small>
                            </td>
                            <td>
                                <img src="/assets/static/img/status-report/adl-self-<?= $survey->unitG->G1[0]; ?>.svg" alt="">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/dressing-upper.svg" alt="">
                                <small> Одевание верхней части тела </small>
                            </td>
                            <td>
                                <img src="/assets/static/img/status-report/adl-self-<?= $survey->unitG->G1[2]; ?>.svg" alt="">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/dressing-lower.svg" alt="">
                                <small> Одевание нижней части тела </small>
                            </td>
                            <td>
                                <img src="/assets/static/img/status-report/adl-self-<?= $survey->unitG->G1[3]; ?>.svg" alt="">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/bed-mobility.svg" alt="">
                                <small> Перемещения в кровати </small>
                            </td>
                            <td>
                                <img src="/assets/static/img/status-report/adl-self-<?= $survey->unitG->G1[8]; ?>.svg" alt="">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/walking-man.svg" alt="" style="width: 64px">
                                <small> Ходьба </small>
                            </td>
                            <td>
                                <img src="/assets/static/img/status-report/adl-self-<?= $survey->unitG->G1[4]; ?>.svg" alt="">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/locomotion.svg" alt="">
                                <small> Передвижение </small>
                            </td>
                            <td>
                                <img src="/assets/static/img/status-report/adl-self-<?= $survey->unitG->G1[5]; ?>.svg" alt="">
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>


        <div class="col-xs-12 col-sm-6">


            <div class="block">

                <div class="block__body overflow--hidden">

                    <table id="vision">
                        <thead>
                        <tr>
                            <th class="f-s-1_2 valign-middle text-center">Кома</th>
                            <th class="text-center">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center">
                            <td>
                                <img src="/assets/static/img/status-report/coma.svg" alt="">
                                <small> Нет признаков <br> сознания </small>
                            </td>
                            <td>
                                <? if ( $survey->unitC->C1 == 5 ) : ?>
                                    <img src="/assets/static/img/status-report/coma.svg" alt="">
                                <? else: ?>
                                    <img src="/assets/static/img/status-report/no-coma.svg" alt="">
                                <? endif; ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>


            <? if ( $survey->unitC->C1 != 5 ) : ?>


                <div class="block">

                    <div class="block__body overflow--hidden">

                        <table id="hearing">
                            <thead>
                            <tr>
                                <th class="f-s-1_2 valign-middle text-center">Слух</th>
                                <th class="text-center">
                                    <img src="/assets/static/img/status-report/hearing-4.svg" alt="">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td>
                                    <img src="/assets/static/img/status-report/hearing.svg" alt="">
                                    <small> Восприятие на слух <br> (способность слышать) </small>
                                </td>
                                <td>
                                    <img src="/assets/static/img/status-report/hearing-<?= $survey->unitD->D3[0]; ?>.svg" alt="">
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>


                <div class="block">

                    <div class="block__body overflow--hidden">

                        <table id="vision">
                            <thead>
                            <tr>
                                <th class="f-s-1_2 valign-middle text-center">Зрение</th>
                                <th class="text-center">
                                    <img src="/assets/static/img/status-report/vision-4.svg" alt="">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td>
                                    <img src="/assets/static/img/status-report/vision.svg" alt="">
                                    <small> Зрение <br> (способность видеть) </small>
                                </td>
                                <td>
                                    <img src="/assets/static/img/status-report/vision-<?= $survey->unitD->D4[0]; ?>.svg" alt="">
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>


                <div class="block">

                    <div class="block__body overflow--hidden">

                        <table id="communication">
                            <thead>
                            <tr>
                                <th class="f-s-1_2 valign-middle text-center">Коммуникация</th>
                                <th class="text-center">
                                    <img src="/assets/static/img/status-report/communication-4.svg" alt="">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td>
                                    <img src="/assets/static/img/status-report/communication-man.svg" alt="">
                                    <small> Способность передавать <br> информацию </small>
                                </td>
                                <td>
                                    <img src="/assets/static/img/status-report/communication-<?= $survey->unitD->D1; ?>.svg" alt="">
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td>
                                    <img src="/assets/static/img/status-report/communication-med.svg" alt="">
                                    <small> Способность воспринимать <br> информацию </small>
                                </td>
                                <td>
                                    <img src="/assets/static/img/status-report/communication-<?= $survey->unitD->D1; ?>.svg" alt="">
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            <? endif; ?>

        </div>

    </div>


</div>

<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/report.min.js?v=<?= filemtime("assets/frontend/bundles/report.min.js") ?>"></script>
<script type="text/javascript">
    report.table.initStatus();
</script>