<div class="section__content">


    <h3 class="section__heading">
        <a role="button" onclick="window.history.back()" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn">Назад</a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-print" aria-hidden="true"></i></a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>

        <? // WATCH_ALL_SURVEYS = 37
        if (in_array(37, $user->permissions)) : ?>
            Базовый персональный отчет #<?= $survey->pk; ?>
        <? else: ?>
            Базовый персональный отчет #<?= $survey->id; ?>
        <? endif; ?>

    </h3>

    <div class="row">
        <div class="col-xs-12">

            <?= View::factory('reports/block/patient-info', array('survey' => $survey)); ?>

            <h3 class="section__heading">
                <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="cognition" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Когнитивные способности
            </h3>

            <div id="cognition">

                <div class="block" >
                    <div class="block__body p-t-20">
                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12 cursor-pointer">
                                            Cognitive Performance Scale [CPS]
                                            <div class="text-normal p-t-5">
                                                <? foreach (Kohana::$config->load('RAIScales.CPS') as $CPS) {

                                                    if (is_array($CPS['key'])) {
                                                        foreach ($CPS['key'] as $key) {
                                                            if ($key == $report->CPS) echo $CPS['name'];
                                                        }
                                                    } else {
                                                        if ($CPS['key'] == $report->CPS) echo $CPS['name'];
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="0" data-max="6" data-value="<?= $report->CPS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->CPS < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12 cursor-pointer">
                                            Decision-making [C1]
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.C.C1')[$survey->unitC->C1];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitC->C1 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12 cursor-pointer">
                                            Кратковременная память
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.C.C2')[json_decode($survey->unitC->C2)[0]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitC->C2)[0] == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12 cursor-pointer">
                                            Долговременная память
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.C.C2')[json_decode($survey->unitC->C2)[1]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitC->C2)[1] == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12 cursor-pointer">
                                            Процедурная память
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.C.C2')[json_decode($survey->unitC->C2)[2]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitC->C2)[2] == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12 cursor-pointer">
                                            Ситуационная память
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.C.C2')[json_decode($survey->unitC->C2)[3]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitC->C2)[3] == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
