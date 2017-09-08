<div class="section__content">


    <h3 class="section__heading">
        <a role="button" onclick="window.history.back()" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn">Назад</a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
        Отчет по шкалам RAI #<?= $survey->id; ?>
    </h3>

    <div class="row">
        <div class="col-xs-12">

            <?= View::factory('reports/block/patient-info', array('survey' => $survey)); ?>

            <h3 class="section__heading">
                Шкалы RAI
            </h3>

            <div class="block user-select--none">
                <div class="block__body">

                    <fieldset>
                        <div class="row cursor-pointer" data-toggle="collapse" data-area="PURS" data-opened="false">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12 cursor-pointer">
                                        Pressure Ulcer Risk Scale (PURS)
                                        <small class="text-normal text-italic">подробнее</small>
                                    </label>
                                    <div class="col-xs-12 collapse" id="PURS">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">


                                            <? foreach (Kohana::$config->load('RAIScales.PURS') as $PURS) : ?>

                                                <li class="p-b-10 <?= is_array($PURS['key']) ? in_array($report->PURS, $PURS['key']) : $report->PURS == $PURS['key'] ? $PURS['class'] : ''; ?>">
                                                    <? if (is_array($PURS['key']) ? in_array($report->PURS, $PURS['key']) : $report->PURS == $PURS['key']) : ?>
                                                        <span class="fl_l pos-absolute left-0">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </span>
                                                    <? endif; ?>
                                                    <?= $PURS['name']; ?>
                                                </li>

                                            <? endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="8" data-value="<?= $report->PURS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->PURS < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->PURS < 4 ? 'text-brand' : 'text-danger'; ?>">
                                    PURS = <?= $report->PURS; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row cursor-pointer" data-toggle="collapse" data-area="CPS" data-opened="false">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12 cursor-pointer">
                                        Cognitive Performance Scale (CPS)
                                        <small class="text-normal text-italic">подробнее</small>
                                    </label>
                                    <div class="col-xs-12 collapse" id="CPS">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">

                                            <? foreach (Kohana::$config->load('RAIScales.CPS') as $CPS) : ?>

                                                <li class="p-b-10 <?= is_array($CPS['key']) ? in_array($report->CPS, $CPS['key']) : $report->CPS == $CPS['key'] ? $CPS['class'] : ''; ?>">
                                                    <? if (is_array($CPS['key']) ? in_array($report->CPS, $CPS['key']) : $report->CPS == $CPS['key']) : ?>
                                                        <span class="fl_l pos-absolute left-0">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </span>
                                                    <? endif; ?>
                                                    <?= $CPS['name']; ?>
                                                </li>

                                            <? endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="6" data-value="<?= $report->CPS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->CPS < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->CPS < 4 ? 'text-brand' : 'text-danger'; ?>">
                                    CPS = <?= $report->CPS; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row" data-toggle="collapse" data-area="BMI" data-opened="false">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12 cursor-pointer">
                                        Body Mass Index (BMI)
                                        <small class="text-normal text-italic">подробнее</small>
                                    </label>
                                    <div class="col-xs-12 collapse" id="BMI">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">

                                            <? foreach (Kohana::$config->load('RAIScales.BMI') as $BMI) : ?>

                                                <li class="p-b-10 <?= is_array($BMI['key']) ? in_array(intval($report->BMI), $BMI['key']) : $report->BMI == $BMI['key'] ? $BMI['class'] : ''; ?>">
                                                    <? if (is_array($BMI['key']) ? in_array(intval($report->BMI), $BMI['key']) : $report->BMI == $BMI['key']) : ?>
                                                        <span class="fl_l pos-absolute left-0">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </span>
                                                    <? endif; ?>
                                                    <?= $BMI['name']; ?>
                                                </li>

                                            <? endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="20" data-max="25" data-value="<?= $report->BMI; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="false" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->BMI >= 20 && $report->BMI < 20 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->BMI <= 20 && $report->BMI >= 25? 'text-brand' : 'text-danger'; ?>">
                                    BMI = <?= $report->BMI; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Self Rated Depression (SRD)
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <? if ($report->SRD == -1) : ?>
                                    Пациент не смог (не захотел) ответить
                                <? else: ?>
                                    <canvas data-min="0" data-max="9" data-value="<?= $report->SRD; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="false" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->SRD < 5 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                    <div class="text-bold m-t-5 <?= $report->SRD < 5 ? 'text-brand' : 'text-danger'; ?>">
                                        SRD = <?= $report->SRD; ?>
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row" data-toggle="collapse" data-area="DRS" data-opened="false">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12 cursor-pointer">
                                        Depression Rating Scale (DRS)
                                        <small class="text-normal text-italic">подробнее</small>
                                    </label>
                                    <div class="col-xs-12 collapse" id="DRS">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">

                                            <? foreach (Kohana::$config->load('RAIScales.DRS') as $DRS) : ?>

                                                <li class="p-b-10 <?= is_array($DRS['key']) ? in_array($report->DRS, $DRS['key']) : $report->DRS == $DRS['key'] ? $DRS['class'] : ''; ?>">
                                                    <? if (is_array($DRS['key']) ? in_array($report->DRS, $DRS['key']) : $report->DRS == $DRS['key']) : ?>
                                                        <span class="fl_l pos-absolute left-0">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </span>
                                                    <? endif; ?>
                                                    <?= $DRS['name']; ?>
                                                </li>

                                            <? endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <? if ($report->DRS == -1) : ?>
                                    Пациент не смог (не захотел) ответить
                                <? else: ?>
                                    <canvas data-min="0" data-max="14" data-value="<?= $report->DRS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->DRS < 9 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                    <div class="text-bold m-t-5 <?= $report->DRS < 9 ? 'text-brand' : 'text-danger'; ?>">
                                        DRS = <?= $report->DRS; ?>
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row" data-toggle="collapse" data-area="Pain" data-opened="false">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12 cursor-pointer">
                                        Pain Scale (Pain)
                                        <small class="text-normal text-italic">подробнее</small>
                                    </label>
                                    <div class="col-xs-12 collapse" id="Pain">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">

                                            <? foreach (Kohana::$config->load('RAIScales.Pain') as $Pain) : ?>

                                                <li class="p-b-10 <?= is_array($Pain['key']) ? in_array($report->Pain, $Pain['key']) : $report->Pain == $Pain['key'] ? $Pain['class'] : ''; ?>">
                                                    <? if (is_array($Pain['key']) ? in_array($report->Pain, $Pain['key']) : $report->Pain == $Pain['key']) : ?>
                                                        <span class="fl_l pos-absolute left-0">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </span>
                                                    <? endif; ?>
                                                    <?= $Pain['name']; ?>
                                                </li>

                                            <? endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="4" data-value="<?= $report->Pain; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->Pain < 3 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->Pain < 3 ? 'text-brand' : 'text-danger'; ?>">
                                    Pain = <?= $report->Pain; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row" data-toggle="collapse" data-area="COMM" data-opened="false">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12 cursor-pointer">
                                        Communication Scale (COMM)
                                        <small class="text-normal text-italic">подробнее</small>
                                    </label>
                                    <div class="col-xs-12 collapse" id="COMM">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">

                                            <? foreach (Kohana::$config->load('RAIScales.COMM') as $COMM) : ?>

                                                <li class="p-b-10 <?= is_array($COMM['key']) ? in_array($report->COMM, $COMM['key']) : $report->COMM == $COMM['key'] ? $COMM['class'] : ''; ?>">
                                                    <? if (is_array($COMM['key']) ? in_array($report->COMM, $COMM['key']) : $report->COMM == $COMM['key']) : ?>
                                                        <span class="fl_l pos-absolute left-0">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </span>
                                                    <? endif; ?>
                                                    <?= $COMM['name']; ?>
                                                </li>

                                            <? endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <? if ($report->COMM == -1) : ?>
                                    Пациент не смог (не захотел) ответить
                                <? else: ?>
                                    <canvas data-min="0" data-max="8" data-value="<?= $report->COMM; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->COMM < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                    <div class="text-bold m-t-5 <?= $report->COMM < 4 ? 'text-brand' : 'text-danger'; ?>">
                                        COMM = <?= $report->COMM; ?>
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row" data-toggle="collapse" data-area="CHESS" data-opened="false">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12 cursor-pointer">
                                        Changes in Health, End-Stage Disease, Signs, and Symptoms Scale (CHESS)
                                        <small class="text-normal text-italic">подробнее</small>
                                    </label>
                                    <div class="col-xs-12 collapse" id="CHESS">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">

                                            <? foreach (Kohana::$config->load('RAIScales.CHESS') as $CHESS) : ?>

                                                <li class="p-b-10 <?= is_array($CHESS['key']) ? in_array($report->CHESS, $CHESS['key']) : $report->CHESS == $CHESS['key'] ? $CHESS['class'] : ''; ?>">
                                                    <? if (is_array($CHESS['key']) ? in_array($report->CHESS, $CHESS['key']) : $report->CHESS == $CHESS['key']) : ?>
                                                        <span class="fl_l pos-absolute left-0">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </span>
                                                    <? endif; ?>
                                                    <?= $CHESS['name']; ?>
                                                </li>

                                            <? endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <? if ($report->CHESS == -1) : ?>
                                    Пациент не смог (не захотел) ответить
                                <? else: ?>
                                    <canvas data-min="0" data-max="5" data-value="<?= $report->CHESS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->CHESS < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                    <div class="text-bold m-t-5 <?= $report->CHESS < 4 ? 'text-brand' : 'text-danger'; ?>">
                                        CHESS = <?= $report->CHESS; ?>
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row" data-toggle="collapse" data-area="ADLH" data-opened="false">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12 cursor-pointer">
                                        Activities of Daily Living Hierarchy (ADLH)
                                        <small class="text-normal text-italic">подробнее</small>
                                    </label>
                                    <div class="col-xs-12 collapse" id="ADLH">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">

                                            <? foreach (Kohana::$config->load('RAIScales.ADLH') as $ADLH) : ?>

                                                <li class="p-b-10 <?= is_array($ADLH['key']) ? in_array($report->ADLH, $ADLH['key']) : $report->ADLH == $ADLH['key'] ? $ADLH['class'] : ''; ?>">
                                                    <? if (is_array($ADLH['key']) ? in_array($report->ADLH, $ADLH['key']) : $report->ADLH == $ADLH['key']) : ?>
                                                        <span class="fl_l pos-absolute left-0">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </span>
                                                    <? endif; ?>
                                                    <?= $ADLH['name']; ?>
                                                </li>

                                            <? endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="6" data-value="<?= $report->ADLH; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->ADLH < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->ADLH < 4 ? 'text-brand' : 'text-danger'; ?>">
                                    ADLH = <?= $report->ADLH; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row" data-toggle="collapse" data-area="ABS" data-opened="false">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12 cursor-pointer">
                                        Aggressive Behaviour Scale (ABS)
                                        <small class="text-normal text-italic">подробнее</small>
                                    </label>
                                    <div class="col-xs-12 collapse" id="ABS">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">

                                            <? foreach (Kohana::$config->load('RAIScales.ABS') as $ABS) : ?>

                                                <li class="p-b-10 <?= is_array($ABS['key']) ? in_array($report->ABS, $ABS['key']) : $report->ABS == $ABS['key'] ? $ABS['class'] : ''; ?>">
                                                    <? if (is_array($ABS['key']) ? in_array($report->ABS, $ABS['key']) : $report->ABS == $ABS['key']) : ?>
                                                        <span class="fl_l pos-absolute left-0">
                                                            <i class="fa fa-play" aria-hidden="true"></i>
                                                        </span>
                                                    <? endif; ?>
                                                    <?= $ABS['name']; ?>
                                                </li>

                                            <? endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <? if ($report->ABS == -1) : ?>
                                    Пациент не смог (не захотел) ответить
                                <? else: ?>
                                    <canvas data-min="0" data-max="12" data-value="<?= $report->ABS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->ABS < 6 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                    <div class="text-bold m-t-5 <?= $report->ABS < 6 ? 'text-brand' : 'text-danger'; ?>">
                                        ABS = <?= $report->ABS; ?>
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Activities of Daily Living Long Form (ADLLF)
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="28" data-value="<?= $report->ADLLF; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="false" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->ADLLF < 15 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->ADLLF < 15 ? 'text-brand' : 'text-danger'; ?>">
                                    ADLLF = <?= $report->ADLLF; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </div>
            </div>

        </div>
    </div>

</div>
