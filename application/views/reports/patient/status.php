<div class="section__content">

    <h3 class="section__heading">
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
        Текущее состояние пациента #<?= $patient->id; ?>
    </h3>

    <?= View::factory('reports/block/patient-info', array('pension' => $pension, 'patient' => $patient, 'survey' => $survey)); ?>

    <div class="block">

        <div class="block__body">

            <table>
                <thead>
                    <tr>
                        <th>ADL support provided</th>
                        <th>No activity</th>
                        <th>Given support</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>G1j - Eating (0..6 || 8) - Прием пищи</td>
                        <td><?= $survey->unitG->G1[9] == 8 ? 'yes' : ''; ?></td>
                        <td><?= $survey->unitG->G1[9] . '/6'; ?></td>
                    </tr>
                    <tr>
                        <td>G1b - Personal hygiene (0..6 || 8) - Личная гигиена</td>
                        <td><?= $survey->unitG->G1[1] == 8 ? 'yes' : ''; ?></td>
                        <td><?= $survey->unitG->G1[1] . '/6'; ?></td>
                    </tr>
                    <tr>
                        <td>G1g - Transfer toilet (0..6 || 8) - Доступ к туалету</td>
                        <td><?= $survey->unitG->G1[6] == 8 ? 'yes' : ''; ?></td>
                        <td><?= $survey->unitG->G1[6] . '/6'; ?></td>
                    </tr>
                    <tr>
                        <td>G1h - Toilet use (0..6 || 8) -  Пользование туалетом</td>
                        <td><?= $survey->unitG->G1[7] == 8 ? 'yes' : ''; ?></td>
                        <td><?= $survey->unitG->G1[7] . '/6'; ?></td>
                    </tr>
                    <tr>
                        <td>G1a - Bathing (0..6 || 8) - Ванные процедуры</td>
                        <td><?= $survey->unitG->G1[0] == 8 ? 'yes' : ''; ?></td>
                        <td><?= $survey->unitG->G1[0] . '/6'; ?></td>
                    </tr>
                    <tr>
                        <td>G1c - Dressing upper body (0..6 || 8) - Одевание верхней части тела</td>
                        <td><?= $survey->unitG->G1[2] == 8 ? 'yes' : ''; ?></td>
                        <td><?= $survey->unitG->G1[2] . '/6'; ?></td>
                    </tr>
                    <tr>
                        <td>G1d - Dressing lower body (0..6 || 8) - Одевание нижней части тела</td>
                        <td><?= $survey->unitG->G1[3] == 8 ? 'yes' : ''; ?></td>
                        <td><?= $survey->unitG->G1[3] . '/6'; ?></td>
                    </tr>
                    <tr>
                        <td>G1i - Bed mobility (0..6 || 8) - Перемещения в кровати</td>
                        <td><?= $survey->unitG->G1[8] == 8 ? 'yes' : ''; ?></td>
                        <td><?= $survey->unitG->G1[8] . '/6'; ?></td>
                    </tr>
                    <tr>
                        <td>G1e - Walking (0..6 || 8) - Ходьба</td>
                        <td><?= $survey->unitG->G1[4] == 8 ? 'yes' : ''; ?></td>
                        <td><?= $survey->unitG->G1[4] . '/6'; ?></td>
                    </tr>
                    <tr>
                        <td>G1f - Locomotion (0..6 || 8) - Передвижение</td>
                        <td><?= $survey->unitG->G1[5] == 8 ? 'yes' : ''; ?></td>
                        <td><?= $survey->unitG->G1[5] . '/6'; ?></td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

    <div class="row">
        <div class=" col-xs-12 col-sm-6">

            <div class="block">

                <div class="block__body">

                    <table>
                        <thead>
                            <tr>
                                <th>Hearing / Vision - Слух и зрение</th>
                                <th>Given support</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>D3a - Hearing (0..4) - Восприятие на слух (способность слышать)</td>
                                <td><?= $survey->unitD->D3[0] . '/4'; ?></td>
                            </tr>
                            <tr>
                                <td>D4a - Vision (0..4) - Зрение (способность видеть)</td>
                                <td><?= $survey->unitD->D4[0] . '/4'; ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>


        <div class=" col-xs-12 col-sm-6">

            <div class="block">

                <div class="block__body">

                    <table>
                        <thead>
                            <tr>
                                <th>Communication - Коммуникация</th>
                                <th>Given support</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>D1 - Making self understood (0..4) - Способность передавать информацию</td>
                                <td><?= $survey->unitD->D1 . '/4'; ?></td>
                            </tr>
                            <tr>
                                <td>D2 - Ability to understand others (0..4) - Способность воспринимать информацию</td>
                                <td><?= $survey->unitD->D2 . '/4'; ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>


</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/report.min.js?v=<?= filemtime("assets/frontend/bundles/report.min.js") ?>"></script>