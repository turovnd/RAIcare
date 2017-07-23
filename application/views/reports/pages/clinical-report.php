<div class="section__content">

    <h3 class="section__heading">
        <a role="button" onclick="window.history.back()" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn">Назад</a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-print" aria-hidden="true"></i></a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>

        <? // WATCH_ALL_SURVEYS = 37
        if (in_array(37, $user->permissions)) : ?>
            Клинический отчет #<?= $survey->pk; ?>
        <? else: ?>
            Клинический отчет #<?= $survey->id; ?>
        <? endif; ?>

    </h3>

    <div class="row">
        <div class="col-xs-12">

            <?= View::factory('reports/block/patient-info', array('survey' => $survey)); ?>

            <h3 class="section__heading">
                <a role="button" data-area="raiscales" data-opened="true" data-textclosed="показать все" data-textopened="показать только выявленные" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Шкалы RAI
            </h3>

            <div class="block">

                <div class="block__body">

                    <table data-tablesaw-sortable width="100%" class="table-style--raiscales" id="raiscales">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th width="40%" data-tablesaw-sortable-col data-tablesaw-sortable-default-col>Название шкалы</th>
                                <th width="30%">Значение</th>
                                <th width="20%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody valign="middle">
                            <tr data-triggered="<?= $raiscales->PURS < 4 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->PURS < 4 ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Pressure Ulcer Risk Scale (PURS)</td>
                                <td>
                                    <? foreach (Kohana::$config->load('RAIScales.PURS') as $PURS) {
                                        if (is_array($PURS['key']) ? in_array($raiscales->PURS, $PURS['key']) : $raiscales->PURS == $PURS['key']) {
                                            echo $PURS['name'];
                                        }
                                    }; ?>
                                </td>
                                <td>
                                    <canvas data-min="0" data-max="8" data-value="<?= $raiscales->PURS; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->PURS < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= $raiscales->CPS < 4 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->CPS < 4 ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Cognitive Performance Scale (CPS)</td>
                                <td>
                                    <? foreach (Kohana::$config->load('RAIScales.CPS') as $CPS) {
                                        if (is_array($CPS['key']) ? in_array($raiscales->CPS, $CPS['key']) : $raiscales->CPS == $CPS['key']) {
                                            echo $CPS['name'];
                                        }
                                    }; ?>
                                </td>
                                <td>
                                    <canvas data-min="0" data-max="6" data-value="<?= $raiscales->CPS; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->CPS < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                             <tr data-triggered="<?= $raiscales->BMI >= 20 && $raiscales->BMI < 20 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->BMI >= 20 && $raiscales->BMI < 20 ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Body Mass Index (BMI)</td>
                                <td>
                                    BMI = <?= $raiscales->BMI; ?>
                                </td>
                                <td>
                                    <canvas data-min="20" data-max="25" data-value="<?= $raiscales->BMI; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="false" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->BMI >= 20 && $raiscales->BMI < 20 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                             <tr data-triggered="<?= $raiscales->SRD < 5 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->SRD < 5 ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Self Rated Depression (SRD)</td>
                                <td>
                                    SRD = <?= $raiscales->SRD; ?>
                                </td>
                                <td>
                                    <canvas data-min="0" data-max="9" data-value="<?= $raiscales->SRD; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="false" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->SRD < 5 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                             <tr data-triggered="<?= $raiscales->DRS < 9 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->DRS < 9 ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Depression Rating Scale (DRS)</td>
                                <td>
                                    <? foreach (Kohana::$config->load('RAIScales.DRS') as $DRS) {
                                        if (is_array($DRS['key']) ? in_array($raiscales->DRS, $DRS['key']) : $raiscales->DRS == $DRS['key']) {
                                            echo $DRS['name'];
                                        }
                                    }; ?>
                                </td>
                                <td>
                                    <canvas data-min="0" data-max="14" data-value="<?= $raiscales->DRS; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->DRS < 9 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                             <tr data-triggered="<?= $raiscales->Pain < 3 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->Pain < 3 ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Pain Scale (Pain)</td>
                                <td>
                                    <? foreach (Kohana::$config->load('RAIScales.Pain') as $Pain) {
                                        if (is_array($Pain['key']) ? in_array($raiscales->Pain, $Pain['key']) : $raiscales->Pain == $Pain['key']) {
                                            echo $Pain['name'];
                                        }
                                    }; ?>
                                </td>
                                <td>
                                    <canvas data-min="0" data-max="4" data-value="<?= $raiscales->Pain; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->Pain < 3 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                             <tr data-triggered="<?= $raiscales->COMM < 4 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->COMM < 4 ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Communication Scale (COMM)</td>
                                <td>
                                    <? foreach (Kohana::$config->load('RAIScales.COMM') as $COMM) {
                                        if (is_array($COMM['key']) ? in_array($raiscales->COMM, $COMM['key']) : $raiscales->COMM == $COMM['key']) {
                                            echo $COMM['name'];
                                        }
                                    }; ?>
                                </td>
                                <td>
                                    <canvas data-min="0" data-max="8" data-value="<?= $raiscales->COMM; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->COMM < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                             <tr data-triggered="<?= $raiscales->CHESS < 4 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->CHESS < 4 ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Changes in Health, End-Stage Disease, Signs, and Symptoms Scale (CHESS)</td>
                                <td>
                                    <? foreach (Kohana::$config->load('RAIScales.CHESS') as $CHESS) {
                                        if (is_array($CHESS['key']) ? in_array($raiscales->CHESS, $CHESS['key']) : $raiscales->CHESS == $CHESS['key']) {
                                            echo $CHESS['name'];
                                        }
                                    }; ?>
                                </td>
                                <td>
                                    <canvas data-min="0" data-max="5" data-value="<?= $raiscales->CHESS; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->CHESS < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                             <tr data-triggered="<?= $raiscales->ADLH < 4 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->ADLH < 4  ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Activities of Daily Living Hierarchy (ADLH)</td>
                                <td>
                                    <? foreach (Kohana::$config->load('RAIScales.ADLH') as $ADLH) {
                                        if (is_array($ADLH['key']) ? in_array($raiscales->ADLH, $ADLH['key']) : $raiscales->ADLH == $ADLH['key']) {
                                            echo $ADLH['name'];
                                        }
                                    }; ?>
                                </td>
                                <td>
                                    <canvas data-min="0" data-max="6" data-value="<?= $raiscales->ADLH; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->ADLH < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                             <tr data-triggered="<?= $raiscales->ABS < 6 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->ABS < 6 ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Aggressive Behaviour Scale (ABS)</td>
                                <td>
                                    <? foreach (Kohana::$config->load('RAIScales.ABS') as $ABS) {
                                        if (is_array($ABS['key']) ? in_array($raiscales->ABS, $ABS['key']) : $raiscales->ABS == $ABS['key']) {
                                            echo $ABS['name'];
                                        }
                                    }; ?>
                                </td>
                                <td>
                                    <canvas data-min="0" data-max="12" data-value="<?= $raiscales->ABS; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->ABS < 6 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                             <tr data-triggered="<?= $raiscales->ADLLF < 15 ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <?= $raiscales->ADLLF < 15 ? 'text-brand' : 'text-danger'; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Activities of Daily Living Long Form (ADLLF)</td>
                                <td>
                                    ADLLF = <?= $raiscales->ADLLF; ?>
                                </td>
                                <td>
                                    <canvas data-min="0" data-max="28" data-value="<?= $raiscales->ADLLF; ?>" data-fontsize="16" width="150" height="25" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="false" data-showlabels="true" class="js-progress" data-linecolor="<?= $raiscales->ADLLF < 15 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" data-area="protocols" data-opened="true" data-textclosed="показать все" data-textopened="показать только выявленные" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Протоколы оценки
            </h3>

            <div class="block">

                <div class="block__body">

                    <table data-tablesaw-sortable width="100%" class="table-style--protocols" id="protocols">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th width="45%" data-tablesaw-sortable-col data-tablesaw-sortable-default-col>Название протокола</th>
                                <th width="45%">Значение</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody valign="middle">
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P1')[$protocols->P1]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P1 == Kohana::$config->load('Protocols.P1')[$protocols->P1]['key']) { echo Kohana::$config->load('Protocols.P1')[$protocols->P1]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Проблемное поведение</td>
                                <td>
                                    <? $P1 = Kohana::$config->load('Protocols.P1')[$protocols->P1];
                                        if ($protocols->P1 == $P1['key']) {
                                            echo $P1['key'] . '. ' . $P1['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P2')[$protocols->P2]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P2 == Kohana::$config->load('Protocols.P2')[$protocols->P2]['key']) { echo Kohana::$config->load('Protocols.P2')[$protocols->P2]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Коммуникация</td>
                                <td>
                                    <? $P2 = Kohana::$config->load('Protocols.P2')[$protocols->P2];
                                        if ($protocols->P2 == $P2['key']) {
                                            echo $P2['key'] . '. ' . $P2['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P3')[$protocols->P3]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P3 == Kohana::$config->load('Protocols.P3')[$protocols->P3]['key']) { echo Kohana::$config->load('Protocols.P3')[$protocols->P3]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Деменция</td>
                                <td>
                                    <? $P3 = Kohana::$config->load('Protocols.P3')[$protocols->P3];
                                        if ($protocols->P3 == $P3['key']) {
                                            echo $P3['key'] . '. ' . $P3['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P4')[$protocols->P4]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P4 == Kohana::$config->load('Protocols.P4')[$protocols->P4]['key']) { echo Kohana::$config->load('Protocols.P4')[$protocols->P4]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Настроение</td>
                                <td>
                                    <? $P4 = Kohana::$config->load('Protocols.P4')[$protocols->P4];
                                        if ($protocols->P4 == $P4['key']) {
                                            echo $P4['key'] . '. ' . $P4['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P5')[$protocols->P5]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P5 == Kohana::$config->load('Protocols.P5')[$protocols->P5]['key']) { echo Kohana::$config->load('Protocols.P5')[$protocols->P5]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Сердечно-дыхательная недостаточность</td>
                                <td>
                                    <? $P5 = Kohana::$config->load('Protocols.P5')[$protocols->P5];
                                        if ($protocols->P5 == $P5['key']) {
                                            echo $P5['key'] . '. ' . $P5['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P6')[$protocols->P6]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P6 == Kohana::$config->load('Protocols.P6')[$protocols->P6]['key']) { echo Kohana::$config->load('Protocols.P6')[$protocols->P6]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Дегидратация</td>
                                <td>
                                    <? $P6 = Kohana::$config->load('Protocols.P6')[$protocols->P6];
                                        if ($protocols->P6 == $P6['key']) {
                                            echo $P6['key'] . '. ' . $P6['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P7')[$protocols->P7]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P7 == Kohana::$config->load('Protocols.P7')[$protocols->P7]['key']) { echo Kohana::$config->load('Protocols.P7')[$protocols->P7]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Падения</td>
                                <td>
                                    <? $P7 = Kohana::$config->load('Protocols.P7')[$protocols->P7];
                                        if ($protocols->P7 == $P7['key']) {
                                            echo $P7['key'] . '. ' . $P7['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P8')[$protocols->P8]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P8 == Kohana::$config->load('Protocols.P8')[$protocols->P8]['key']) { echo Kohana::$config->load('Protocols.P8')[$protocols->P8]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Питательная трубка</td>
                                <td>
                                    <? $P8 = Kohana::$config->load('Protocols.P8')[$protocols->P8];
                                        if ($protocols->P8 == $P8['key']) {
                                            echo $P8['key'] . '. ' . $P8['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P9')[$protocols->P9]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P9 == Kohana::$config->load('Protocols.P9')[$protocols->P9]['key']) { echo Kohana::$config->load('Protocols.P9')[$protocols->P9]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Недостаточное питание</td>
                                <td>
                                    <? $P9 = Kohana::$config->load('Protocols.P9')[$protocols->P9];
                                        if ($protocols->P9 == $P9['key']) {
                                            echo $P9['key'] . '. ' . $P9['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P10')[$protocols->P10]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P10 == Kohana::$config->load('Protocols.P10')[$protocols->P10]['key']) { echo Kohana::$config->load('Protocols.P10')[$protocols->P10]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Повреждения</td>
                                <td>
                                    <? $P10 = Kohana::$config->load('Protocols.P10')[$protocols->P10];
                                        if ($protocols->P10 == $P10['key']) {
                                            echo $P10['key'] . '. ' . $P10['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P11')[$protocols->P11]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P11 == Kohana::$config->load('Protocols.P11')[$protocols->P11]['key']) { echo Kohana::$config->load('Protocols.P11')[$protocols->P11]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Табак и алкоголь</td>
                                <td>
                                    <? $P11 = Kohana::$config->load('Protocols.P11')[$protocols->P11];
                                        if ($protocols->P11 == $P11['key']) {
                                            echo $P11['key'] . '. ' . $P11['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P12')[$protocols->P12]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P12 == Kohana::$config->load('Protocols.P12')[$protocols->P12]['key']) { echo Kohana::$config->load('Protocols.P12')[$protocols->P12]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Тяжелые пролежни</td>
                                <td>
                                    <? $P12 = Kohana::$config->load('Protocols.P12')[$protocols->P12];
                                        if ($protocols->P12 == $P12['key']) {
                                            echo $P12['key'] . '. ' . $P12['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P13')[$protocols->P13]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P13 == Kohana::$config->load('Protocols.P13')[$protocols->P13]['key']) { echo Kohana::$config->load('Protocols.P13')[$protocols->P13]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Недержание мочи</td>
                                <td>
                                    <? $P13 = Kohana::$config->load('Protocols.P13')[$protocols->P13];
                                        if ($protocols->P13 == $P13['key']) {
                                            echo $P13['key'] . '. ' . $P13['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P14')[$protocols->P14]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P14 == Kohana::$config->load('Protocols.P14')[$protocols->P14]['key']) { echo Kohana::$config->load('Protocols.P14')[$protocols->P14]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Физическая сдержанность</td>
                                <td>
                                    <? $P14 = Kohana::$config->load('Protocols.P14')[$protocols->P14];
                                        if ($protocols->P14 == $P14['key']) {
                                            echo $P14['key'] . '. ' . $P14['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P15')[$protocols->P15]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P15 == Kohana::$config->load('Protocols.P15')[$protocols->P15]['key']) { echo Kohana::$config->load('Protocols.P15')[$protocols->P15]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Активность</td>
                                <td>
                                    <? $P15 = Kohana::$config->load('Protocols.P15')[$protocols->P15];
                                        if ($protocols->P15 == $P15['key']) {
                                            echo $P15['key'] . '. ' . $P15['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P16')[$protocols->P16]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P16 == Kohana::$config->load('Protocols.P16')[$protocols->P16]['key']) { echo Kohana::$config->load('Protocols.P16')[$protocols->P16]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Physical Activities Promotion</td>
                                <td>
                                    <? $P16 = Kohana::$config->load('Protocols.P16')[$protocols->P16];
                                        if ($protocols->P16 == $P16['key']) {
                                            echo $P16['key'] . '. ' . $P16['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P17')[$protocols->P17]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P17 == Kohana::$config->load('Protocols.P17')[$protocols->P17]['key']) { echo Kohana::$config->load('Protocols.P17')[$protocols->P17]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Prevention</td>
                                <td>
                                    <? $P17 = Kohana::$config->load('Protocols.P17')[$protocols->P17];
                                        if ($protocols->P17 == $P17['key']) {
                                            echo $P17['key'] . '. ' . $P17['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr data-triggered="<?= Kohana::$config->load('Protocols.P18')[$protocols->P18]['class'] == 'text-brand' ? 'false' : 'true'; ?>">
                                <td>
                                    <i class="fa fa-flag <? if ($protocols->P18 == Kohana::$config->load('Protocols.P18')[$protocols->P18]['key']) { echo Kohana::$config->load('Protocols.P18')[$protocols->P18]['class']; }; ?>" aria-hidden="true"></i>
                                </td>
                                <td>Cognitive Loss</td>
                                <td>
                                    <? $P18 = Kohana::$config->load('Protocols.P18')[$protocols->P18];
                                        if ($protocols->P18 == $P18['key']) {
                                            echo $P18['key'] . '. ' . $P18['name'];
                                        }
                                    ?>
                                </td>
                                <td>
                                    <i class="fa fa-2x fa-angle-right" aria-hidden="true"></i>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>

</div>


<!--<div class="modal" id="" tabindex="-1">-->
<!--    <div class="modal__content">-->
<!--        <div class="modal__header">-->
<!--            <button type="button" class="modal__title-close" data-close="modal">-->
<!--                <i class="fa fa-close" aria-hidden="true"></i>-->
<!--            </button>-->
<!--            <h4 class="modal__title"></h4>-->
<!--        </div>-->
<!--        <div class="modal__body">-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<script type="text/javascript">
    function ready() {
        raisoft.table.init();
        raisoft.table.create();
        raisoft.progress.init();
    }

    document.addEventListener("DOMContentLoaded", ready);
</script>