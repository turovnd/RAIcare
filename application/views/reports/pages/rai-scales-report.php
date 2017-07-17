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
                                        <ol start="0" class="m-0 pos-relative p-l-20 list-style--none">
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
                                        </ol>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30">
                                <canvas data-min="0" data-max="15" data-value="<?= 10;//$report->PURS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress"></canvas>
                            </div>
                        </div>
                    </fieldset>

                </div>
            </div>

        </div>
    </div>

</div>
