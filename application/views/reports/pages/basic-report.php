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
                                        <div class="form-group__label col-xs-12">
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
                                        <div class="form-group__label col-xs-12">
                                            Когнетивные способности в области принятия повседневных решений
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.C.C1')[$survey->unitC->C1];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitC->C1 <= 2 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
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
                                        <div class="form-group__label col-xs-12">
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
                                        <div class="form-group__label col-xs-12">
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
                                        <div class="form-group__label col-xs-12">
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

            <h3 class="section__heading">
                <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="comAndVision" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Коммуникация и зрение
            </h3>

            <div id="comAndVision">

                <div class="block" >
                    <div class="block__body p-t-20">

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Communication Scale [COMM]
                                            <div class="text-normal p-t-5">
                                                <? foreach (Kohana::$config->load('RAIScales.COMM') as $COMM) {

                                                    if (is_array($COMM['key'])) {
                                                        foreach ($COMM['key'] as $key) {
                                                            if ($key == $report->COMM) echo $COMM['name'];
                                                        }
                                                    } else {
                                                        if ($COMM['key'] == $report->COMM) echo $COMM['name'];
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="0" data-max="8" data-value="<?= $report->COMM; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->COMM < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Способность слышать
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.D.D3a')[json_decode($survey->unitD->D3)[0]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitD->D3)[0] < 3 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Способность видеть при адекватном освещении
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.D.D4a')[json_decode($survey->unitD->D4)[0]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitD->D4)[0] < 3 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="funPerform" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Функциональное состояние
            </h3>

            <div id="funPerform">

                <div class="block" >
                    <div class="block__body p-t-20">

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Activities of Daily Living Hierarchy [ADLH]
                                            <div class="text-normal p-t-5">
                                                <? foreach (Kohana::$config->load('RAIScales.ADLH') as $ADLH) {

                                                    if (is_array($ADLH['key'])) {
                                                        foreach ($ADLH['key'] as $key) {
                                                            if ($key == $report->ADLH) echo $ADLH['name'];
                                                        }
                                                    } else {
                                                        if ($ADLH['key'] == $report->ADLH) echo $ADLH['name'];
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="0" data-max="6" data-value="<?= $report->ADLH; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->ADLH < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Activities of Daily Living Long Form [ADLLF]
                                            <div class="text-normal p-t-5">
                                                ADLLF = <?= $report->ADLLF; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="0" data-max="28" data-value="<?= $report->ADLLF; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->ADLLF < 15 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Личная гигиена
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G1')[json_decode($survey->unitG->G1)[1]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G1)[1] < 2 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Одевание верхней части тела
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G1')[json_decode($survey->unitG->G1)[2]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G1)[2] < 2 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Одевание нижней части тела
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G1')[json_decode($survey->unitG->G1)[3]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G1)[3] < 2 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Передвижение
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G1')[json_decode($survey->unitG->G1)[5]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G1)[5] < 2 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Пользование туалетом
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G1')[json_decode($survey->unitG->G1)[7]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G1)[7] < 2 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Перемещения в кровати
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G1')[json_decode($survey->unitG->G1)[8]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G1)[8] < 2 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Прием пищи
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G1')[json_decode($survey->unitG->G1)[9]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G1)[9] < 2 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Основной способ передвижения
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G2a')[json_decode($survey->unitG->G2)[0]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G2)[0] == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Общее число часов упражнений или физической активности
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G3a')[json_decode($survey->unitG->G3)[0]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G3)[0] != 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Пациент полагает, что он способен повысить эффективность своих физических функций
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G4')[json_decode($survey->unitG->G4)[0]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G4)[0] == 1 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Специалист в области ухода полагает, что пациент способен повысить эффективность своих физических функций
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.G.G4')[json_decode($survey->unitG->G4)[1]];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitG->G4)[1] == 1 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
