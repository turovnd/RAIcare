<div class="section__content">


    <h3 class="section__heading">
        <a role="button" onclick="window.history.back()" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn">Назад</a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-print" aria-hidden="true"></i></a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>

        <? // WATCH_ALL_SURVEYS = 37
        if (in_array(37, $user->permissions)) : ?>
            Итоговый протокол оценки #<?= $survey->pk; ?>
        <? else: ?>
            Итоговый протокол оценки #<?= $survey->id; ?>
        <? endif; ?>

    </h3>

    <div class="row">
        <div class="col-xs-12">

            <?= View::factory('reports/block/patient-info', array('survey' => $survey)); ?>

            <div class="block">
                <div class="block__body">

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Pressure Ulcer Risk Scale (PURS)
                                    </label>
                                    <div class="col-xs-12">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">
                                            <li class="p-b-10 <?= $report->PURS == 0 ? 'text-brand' : ''; ?>">
                                                <? if ($report->PURS == 0) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                                <? endif; ?>
                                                0 Very low risk
                                            </li>
                                            <li class="p-b-10 <?= $report->PURS == 1 || $report->PURS == 2 ? 'text-brand' : ''; ?>">
                                                <? if ($report->PURS == 1 || $report->PURS == 2) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                                <? endif; ?>
                                                1 - 2 Low risk
                                            </li>
                                            <li class="p-b-10 <?= $report->PURS == 3 ? 'text-danger' : ''; ?>">
                                                <? if ($report->PURS == 3) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                                <? endif; ?>
                                                3 Moderate risk
                                            </li>
                                            <li class="p-b-10 <?= $report->PURS == 4 || $report->PURS == 5 ? 'text-danger' : ''; ?>">
                                                <? if ($report->PURS == 4 || $report->PURS == 5) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                                <? endif; ?>
                                                4 - 5 High risk
                                            </li>
                                            <li class="p-b-10 <?= $report->PURS == 6 || $report->PURS == 7 || $report->PURS == 8 ? 'text-danger' : ''; ?>">
                                                <? if ($report->PURS == 6 || $report->PURS == 7 || $report->PURS == 8) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                                <? endif; ?>
                                                6 - 8 Very high risk
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="8" data-value="<?= $report->PURS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->PURS < 3 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->PURS < 3 ? 'text-brand' : 'text-danger'; ?>">
                                    PURS = <?= $report->PURS; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Cognitive Performance Scale (CPS)
                                    </label>
                                    <div class="col-xs-12">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">
                                            <li class="p-b-10 <?= $report->CPS == 0 ? 'text-brand' : ''; ?>">
                                                <? if ($report->CPS == 0) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                0 Intact
                                            </li>
                                            <li class="p-b-10 <?= $report->CPS == 1 ? 'text-brand' : ''; ?>">
                                                <? if ($report->CPS == 1) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                1 Borderline intact
                                            </li>
                                            <li class="p-b-10 <?= $report->CPS == 2 ? 'text-brand' : ''; ?>">
                                                <? if ($report->CPS == 2) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                2 Mild impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->CPS == 3 ? 'text-danger' : ''; ?>">
                                                <? if ($report->CPS == 3) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                3 Moderate impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->CPS == 4 ? 'text-danger' : ''; ?>">
                                                <? if ($report->CPS == 4) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                4 Moderate / severe impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->CPS == 5 ? 'text-danger' : ''; ?>">
                                                <? if ($report->CPS == 5) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                5 Severe impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->CPS == 6 ? 'text-danger' : ''; ?>">
                                                <? if ($report->CPS == 6) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                6 Very severe impairment
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="6" data-value="<?= $report->CPS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->CPS < 3 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->CPS < 3 ? 'text-brand' : 'text-danger'; ?>">
                                    CPS = <?= $report->CPS; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Body Mass Index (BMI)
                                    </label>
                                    <div class="col-xs-12">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">
                                            <li class="p-b-10 <?= $report->BMI < 20 ? 'text-danger' : ''; ?>">
                                                <? if ($report->BMI < 20) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                Less than normal BMI
                                            </li>
                                            <li class="p-b-10 <?= $report->BMI <= 20 && $report->BMI >= 25 ? 'text-brand' : ''; ?>">
                                                <? if ($report->BMI <= 20 && $report->BMI >= 25) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                Normal MBI
                                            </li>
                                            <li class="p-b-10 <?= $report->BMI > 25 ? 'text-danger' : ''; ?>">
                                                <? if ($report->BMI > 25) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                Large than normal BMI
                                            </li>
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
                                <canvas data-min="0" data-max="9" data-value="<?= $report->SRD; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="false" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->SRD <= 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->SRD <= 4 ? 'text-brand' : 'text-danger'; ?>">
                                    SRD = <?= $report->SRD; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Depression Rating Scale (DRS)
                                    </label>
                                    <div class="col-xs-12">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">
                                            <li class="p-b-10 <?= $report->DRS <= 2 ? 'text-brand' : ''; ?>">
                                                <? if ($report->DRS <= 2) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                0 - 2 No depression
                                            </li>
                                            <li class="p-b-10 <?= $report->DRS < 9 && $report->DRS > 2 ? 'text-brand' : ''; ?>">
                                                <? if ($report->DRS < 9 && $report->DRS > 2) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                3 - 8 Depressive symptoms, likelihood of at least mild depression
                                            </li>
                                            <li class="p-b-10 <?= $report->DRS >= 9 ? 'text-brand' : ''; ?>">
                                                <? if ($report->DRS >= 9 ) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                9 - 14 Depressive symptoms, high likelihood of major depression
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="14" data-value="<?= $report->DRS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->DRS <= 2 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->DRS <= 2 ? 'text-brand' : 'text-danger'; ?>">
                                    DRS = <?= $report->DRS; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Pain Scale (Pain)
                                    </label>
                                    <div class="col-xs-12">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">
                                            <li class="p-b-10 <?= $report->Pain == 0 ? 'text-brand' : ''; ?>">
                                                <? if ($report->Pain == 0) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                0 No pain
                                            </li>
                                            <li class="p-b-10 <?= $report->Pain == 1 ? 'text-brand' : ''; ?>">
                                                <? if ($report->Pain == 1) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                1 Less than daily pain
                                            </li>
                                            <li class="p-b-10 <?= $report->Pain == 2 ? 'text-danger' : ''; ?>">
                                                <? if ($report->Pain == 2) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                2 Daily pain but not severe
                                            </li>
                                            <li class="p-b-10 <?= $report->Pain == 3 ? 'text-danger' : ''; ?>">
                                                <? if ($report->Pain == 3) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                3 Daily severe pain
                                            </li>
                                            <li class="p-b-10 <?= $report->Pain == 4 ? 'text-danger' : ''; ?>">
                                                <? if ($report->Pain == 4) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                4 Daily excruciating pain
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="4" data-value="<?= $report->Pain; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->Pain < 2 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->Pain < 2 ? 'text-brand' : 'text-danger'; ?>">
                                    Pain = <?= $report->Pain; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Communication Scale (COMM)
                                    </label>
                                    <div class="col-xs-12">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">
                                            <li class="p-b-10 <?= $report->COMM == 0 ? 'text-brand' : ''; ?>">
                                                <? if ($report->COMM == 0) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                0 Intact
                                            </li>
                                            <li class="p-b-10 <?= $report->COMM == 1 ? 'text-brand' : ''; ?>">
                                                <? if ($report->COMM == 1) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                1 Borderline intact
                                            </li>
                                            <li class="p-b-10 <?= $report->COMM == 2 ? 'text-brand' : ''; ?>">
                                                <? if ($report->COMM == 2) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                2 Mild impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->COMM == 3 ? 'text-brand' : ''; ?>">
                                                <? if ($report->COMM == 3) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                3 Mild / moderate impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->COMM == 4 ? 'text-danger' : ''; ?>">
                                                <? if ($report->COMM == 4) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                4 Moderate impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->COMM == 5 ? 'text-danger' : ''; ?>">
                                                <? if ($report->COMM == 5) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                5 Moderate / severe impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->COMM == 6 ? 'text-danger' : ''; ?>">
                                                <? if ($report->COMM == 6) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                6 Severe impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->COMM == 7 ? 'text-danger' : ''; ?>">
                                                <? if ($report->COMM == 7) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                7 Severe / very severe impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->COMM == 8 ? 'text-danger' : ''; ?>">
                                                <? if ($report->COMM == 8) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                8 Very severe impairment
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="8" data-value="<?= $report->COMM; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->COMM <= 3 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->COMM <= 3 ? 'text-brand' : 'text-danger'; ?>">
                                    COMM = <?= $report->COMM; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Changes in Health, End-Stage Disease, Signs, and Symptoms Scale (CHESS)
                                    </label>
                                    <div class="col-xs-12">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">
                                            <li class="p-b-10 <?= $report->CHESS == 0 ? 'text-brand' : ''; ?>">
                                                <? if ($report->CHESS == 0) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                0 No health instability
                                            </li>
                                            <li class="p-b-10 <?= $report->CHESS == 1 ? 'text-brand' : ''; ?>">
                                                <? if ($report->CHESS == 1) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                1 Minimal health instability
                                            </li>
                                            <li class="p-b-10 <?= $report->CHESS == 2 ? 'text-brand' : ''; ?>">
                                                <? if ($report->CHESS == 2) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                2 Low health instability
                                            </li>
                                            <li class="p-b-10 <?= $report->CHESS == 3 ? 'text-brand' : ''; ?>">
                                                <? if ($report->CHESS == 3) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                3 Moderate health instability
                                            </li>
                                            <li class="p-b-10 <?= $report->CHESS == 4 ? 'text-danger' : ''; ?>">
                                                <? if ($report->CHESS == 4) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                4 High health instability
                                            </li>
                                            <li class="p-b-10 <?= $report->CHESS == 5 ? 'text-danger' : ''; ?>">
                                                <? if ($report->CHESS == 5) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                5 Very high health instability
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="5" data-value="<?= $report->CHESS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->CHESS < 3 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->CHESS < 3 ? 'text-brand' : 'text-danger'; ?>">
                                    CHESS = <?= $report->CHESS; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Activities of Daily Living Hierarchy (ADLH)
                                    </label>
                                    <div class="col-xs-12">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">
                                            <li class="p-b-10 <?= $report->ADLH == 0 ? 'text-brand' : ''; ?>">
                                                <? if ($report->ADLH == 0) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                0 Independent
                                            </li>
                                            <li class="p-b-10 <?= $report->ADLH == 1 ? 'text-danger' : ''; ?>">
                                                <? if ($report->ADLH == 1) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                1 Supervision required
                                            </li>
                                            <li class="p-b-10 <?= $report->ADLH == 2 ? 'text-danger' : ''; ?>">
                                                <? if ($report->ADLH == 2) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                2 Limited impairment
                                            </li>
                                            <li class="p-b-10 <?= $report->ADLH == 3 || $report->ADLH == 4 ? 'text-danger' : ''; ?>">
                                                <? if ($report->ADLH == 3 || $report->ADLH == 4) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                3 - 4 Extensive assistance required - 1
                                            </li>
                                            <li class="p-b-10 <?= $report->ADLH == 5 ? 'text-danger' : ''; ?>">
                                                <? if ($report->ADLH == 5) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                5 Dependent
                                            </li>
                                            <li class="p-b-10 <?= $report->ADLH == 6 ? 'text-danger' : ''; ?>">
                                                <? if ($report->ADLH == 6) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                6 Total dependence
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="6" data-value="<?= $report->ADLH; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->ADLH == 0 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->ADLH == 0 ? 'text-brand' : 'text-danger'; ?>">
                                    ADLH = <?= $report->ADLH; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="form-group">
                                    <label class="form-group__label col-xs-12">
                                        Aggressive Behaviour Scale (ABS)
                                    </label>
                                    <div class="col-xs-12">
                                        <ul class="m-0 pos-relative p-l-20 list-style--none">
                                            <li class="p-b-10 <?= $report->ABS == 0 ? 'text-brand' : ''; ?>">
                                                <? if ($report->ABS == 0) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                0 No aggressive behavior
                                            </li>
                                            <li class="p-b-10 <?= $report->ABS >= 1 && $report->ABS <= 5 ? 'text-danger' : ''; ?>">
                                                <? if ($report->ABS >= 1 && $report->ABS <= 5) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                1 - 5 Mild to moderate aggressive behavior
                                            </li>
                                            <li class="p-b-10 <?= $report->ABS >= 6 && $report->ABS <= 12 ? 'text-danger' : ''; ?>">
                                                <? if ($report->ABS >= 6 && $report->ABS <= 12) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                6 - 12 Severe aggressive behavior
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                <canvas data-min="0" data-max="12" data-value="<?= $report->ABS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->ABS == 0 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->ABS == 0 ? 'text-brand' : 'text-danger'; ?>">
                                    ABS = <?= $report->ABS; ?>
                                </div>
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
                                <canvas data-min="0" data-max="28" data-value="<?= $report->ADLLF; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="false" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->ADLLF <= 10 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                <div class="text-bold m-t-5 <?= $report->ADLLF <= 10 ? 'text-brand' : 'text-danger'; ?>">
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
