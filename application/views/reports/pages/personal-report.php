<div class="section__content">


    <h3 class="section__heading">
        <a role="button" onclick="window.history.back()" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn">Назад</a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
        Персональный отчет #<?= $survey->id; ?>
    </h3>

    <div class="row">
        <div class="col-xs-12">

            <?= View::factory('reports/block/patient-info', array('survey' => $survey)); ?>

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="cognition" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
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

                        <? if ($survey->unitC->C1 != 5) : ?>

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

                        <? endif; ?>

                    </div>
                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="comAndVision" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
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

                        <? if ($survey->unitC->C1 != 5) : ?>

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

                        <? endif; ?>

                    </div>
                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="funPerform" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
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

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="mentalHealth" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Душевное здоровье
            </h3>

            <div id="mentalHealth">

                <div class="block" >
                    <div class="block__body p-t-20">

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Depression Rating Scale [DRS]
                                            <div class="text-normal p-t-5">
                                                <? foreach (Kohana::$config->load('RAIScales.DRS') as $DRS) {

                                                    if (is_array($DRS['key'])) {
                                                        foreach ($DRS['key'] as $key) {
                                                            if ($key == $report->DRS) echo $DRS['name'];
                                                        }
                                                    } else {
                                                        if ($DRS['key'] == $report->DRS) echo $DRS['name'];
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="0" data-max="14" data-value="<?= $report->DRS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->DRS < 9 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Self Rated Depression [SRD]
                                            <div class="text-normal p-t-5">
                                                SRD = <?= $report->SRD; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="0" data-max="9" data-value="<?= $report->SRD; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->SRD < 5 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Aggressive Behavior Scale [ABS]
                                            <div class="text-normal p-t-5">
                                                <? foreach (Kohana::$config->load('RAIScales.ABS') as $ABS) {

                                                    if (is_array($ABS['key'])) {
                                                        foreach ($ABS['key'] as $key) {
                                                            if ($key == $report->ABS) echo $ABS['name'];
                                                        }
                                                    } else {
                                                        if ($ABS['key'] == $report->ABS) echo $ABS['name'];
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="0" data-max="12" data-value="<?= $report->ABS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->ABS < 6 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <? if ($survey->unitC->C1 != 5) : ?>

                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-9">
                                        <div class="form-group">
                                            <div class="form-group__label col-xs-12">
                                                Бесцельное перемещение
                                                <div class="text-normal p-t-5">
                                                    <?= Kohana::$config->load('Units.E.E3')[json_decode($survey->unitE->E3)[0]]; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                        <span class="f-s-1_25 <?= json_decode($survey->unitE->E3)[0] < 2 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-9">
                                        <div class="form-group">
                                            <div class="form-group__label col-xs-12">
                                                Словесная агрессия
                                                <div class="text-normal p-t-5">
                                                    <?= Kohana::$config->load('Units.E.E3')[json_decode($survey->unitE->E3)[1]]; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                        <span class="f-s-1_25 <?= json_decode($survey->unitE->E3)[1] < 2 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-9">
                                        <div class="form-group">
                                            <div class="form-group__label col-xs-12">
                                                Физическое насилие
                                                <div class="text-normal p-t-5">
                                                    <?= Kohana::$config->load('Units.E.E3')[json_decode($survey->unitE->E3)[2]]; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                        <span class="f-s-1_25 <?= json_decode($survey->unitE->E3)[2] < 2 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-9">
                                        <div class="form-group">
                                            <div class="form-group__label col-xs-12">
                                                Пациент противится уходу за ним
                                                <div class="text-normal p-t-5">
                                                    <?= Kohana::$config->load('Units.E.E3')[json_decode($survey->unitE->E3)[5]]; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                        <span class="f-s-1_25 <?= json_decode($survey->unitE->E3)[5] < 2 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </fieldset>

                        <? endif; ?>

                    </div>
                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="continence" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Недержание
            </h3>

            <div id="continence">

                <div class="block" >
                    <div class="block__body p-t-20">

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Недержание мочи
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.H.H1')[$survey->unitH->H1]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitH->H1 == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Устройство для сбора мочи
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.H.H2')[$survey->unitH->H2]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitH->H2 == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Недержание кишечного содержания
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.H.H3')[$survey->unitH->H3]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitH->H3 == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="healthConditions" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Нарушения состояния здоровья
            </h3>

            <div id="healthConditions">

                <div class="block" >
                    <div class="block__body p-t-20">

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Pain Scale [Pain]
                                            <div class="text-normal p-t-5">
                                                <? foreach (Kohana::$config->load('RAIScales.Pain') as $Pain) {

                                                    if (is_array($Pain['key'])) {
                                                        foreach ($Pain['key'] as $key) {
                                                            if ($key == $report->Pain) echo $Pain['name'];
                                                        }
                                                    } else {
                                                        if ($Pain['key'] == $report->Pain) echo $Pain['name'];
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="0" data-max="4" data-value="<?= $report->Pain; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->Pain < 3 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Changes in Health, End-Stage Disease, Signs, and Symptoms Scale [CHESS]
                                            <div class="text-normal p-t-5">
                                                <? foreach (Kohana::$config->load('RAIScales.CHESS') as $CHESS) {

                                                    if (is_array($CHESS['key'])) {
                                                        foreach ($CHESS['key'] as $key) {
                                                            if ($key == $report->CHESS) echo $CHESS['name'];
                                                        }
                                                    } else {
                                                        if ($CHESS['key'] == $report->CHESS) echo $CHESS['name'];
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="0" data-max="5" data-value="<?= $report->CHESS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->CHESS < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Падения
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.J.J1')[$survey->unitJ->J1]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitJ->J1 == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Проблемы равновесия
                                            <div class="text-normal p-t-5">
                                                <?
                                                    $J3 = json_decode($survey->unitJ->J3);
                                                    echo  Kohana::$config->load('Units.J.J3')[max($J3[0], $J3[1], $J3[2], $J3[3])];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= max($J3[0], $J3[1], $J3[2], $J3[3]) == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Одышка
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.J.J4')[$survey->unitJ->J4]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitJ->J4 == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Утомляемость
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.J.J5')[$survey->unitJ->J5]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitJ->J5 == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Оценка пациентом своего состояния здоровья
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.J.J8')[$survey->unitJ->J8]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitJ->J8 < 3 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="nutrition" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Вопросы питания
            </h3>

            <div id="nutrition">

                <div class="block" >
                    <div class="block__body p-t-20">

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Body Mass Index [BMI]
                                            <div class="text-normal p-t-5">
                                                BMI = <?= $report->BMI; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="20" data-max="25" data-value="<?= $report->BMI; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="false" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->BMI >= 20 && $report->BMI <= 25 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Потеря веса
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.K.K2')[json_decode($survey->unitK->K2)[0]]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitK->K2)[0] == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Обезвоживание
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.K.K2')[json_decode($survey->unitK->K2)[1]]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= json_decode($survey->unitK->K2)[1] == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Способ приема пищи
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.K.K3')[$survey->unitK->K3]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitK->K3 == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="skinCondition" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Состояние кожи
            </h3>

            <div id="skinCondition">

                <div class="block" >
                    <div class="block__body p-t-20">

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Pressure Ulcer Risk Scale [PURS]
                                            <div class="text-normal p-t-5">
                                                <? foreach (Kohana::$config->load('RAIScales.PURS') as $PURS) {

                                                    if (is_array($PURS['key'])) {
                                                        foreach ($PURS['key'] as $key) {
                                                            if ($key == $report->PURS) echo $PURS['name'];
                                                        }
                                                    } else {
                                                        if ($PURS['key'] == $report->PURS) echo $PURS['name'];
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <canvas data-min="0" data-max="8" data-value="<?= $report->PURS; ?>" data-fontsize="22" width="200" height="35" data-speed="80" data-animate="true" data-inpercent="false" data-showtext="true" data-showlabels="true" class="js-progress" data-linecolor="<?= $report->PURS < 4 ? '#008DA7' : '#f05050'; ?>"></canvas>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Самые тяжелые пролежни
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.L.L1')[$survey->unitL->L1]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitL->L2 == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Наличие иных кожных язв, помимо пролежней
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.L.L3')[$survey->unitL->L3]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitL->L3 == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Проблемы со ступнями
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.L.L7')[$survey->unitL->L7]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitL->L7 < 2 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="socialLife" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Досуг
            </h3>

            <div id="socialLife">

                <div class="block" >
                    <div class="block__body p-t-20">

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Средняя длительность участия в колективной деятельности
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.M.M1')[$survey->unitM->M1]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitM->M1 == 0 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <div class="form-group">
                                        <div class="form-group__label col-xs-12">
                                            Длительность дневного сна
                                            <div class="text-normal p-t-5">
                                                <?= Kohana::$config->load('Units.M.M3')[$survey->unitM->M3]; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 p-l-30 p-r-30 text-center m-t-10">
                                    <span class="f-s-1_25 <?= $survey->unitM->M3 < 2 ?  'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="therapies" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Лечебные мероприятия
            </h3>

            <div id="therapies">

                <div class="block" >
                    <div class="block__body p-t-20">

                        <p><span class="text-bold">A:</span> Число дней из ПОСЛЕДНИХ 7 ДНЕЙ, на которые было назначено проведение лечебных мероприятий</p>
                        <p><span class="text-bold">B:</span> Число дней из ПОСЛЕДНИХ 7 ДНЕЙ, когда какие-либо лечебные мероприятия проводились дольше 15 минут</p>
                        <p><span class="text-bold">C:</span> Общее число минут, когда проводились лечебные мероприятия, за ПОСЛЕДНИЕ 7 ДНЕЙ</p>

                        <? $O3 = json_decode($survey->unitO->O3); ?>
                        <table class="tablesaw" data-tablesaw-mode="stack">
                            <thead>
                                <tr>
                                    <th class="f-s-0_8">Мероприятие</th>
                                    <th class="f-s-0_8">A</th>
                                    <th class="f-s-0_8">B</th>
                                    <th class="f-s-0_8">C</th>
                                </tr>
                            </thead>
                            <tbody valign="middle">
                                <tr class="bb-0">
                                    <td>Лечебная физкультура</td>
                                    <td><?= $O3[0][0]; ?> дн.</td>
                                    <td><?= $O3[0][1]; ?> дн.</td>
                                    <td><?= $O3[0][2]; ?> мин.</td>
                                </tr>
                                <tr>
                                    <td>Эрготерапия</td>
                                    <td><?= $O3[1][0]; ?> дн.</td>
                                    <td><?= $O3[1][1]; ?> дн.</td>
                                    <td><?= $O3[1][2]; ?> мин.</td>
                                </tr>
                                <tr>
                                    <td>Речевая терапия</td>
                                    <td><?= $O3[2][0]; ?> дн.</td>
                                    <td><?= $O3[2][1]; ?> дн.</td>
                                    <td><?= $O3[2][2]; ?> мин.</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <h3 class="section__heading">
                <a role="button" onclick="raicare.collapse.toggle(this)" data-area="diagnoses" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
                Диагнозы
            </h3>

            <div id="diagnoses">

                <div class="block" >
                    <div class="block__body p-t-20">
                        <?
                            $diagnoses = array(
                                '0' => 'Заболевания костно-мышечной системы Перелом бедренной или тазовой кости в течение последних 30 дней',
                                '1' => 'Другие переломы в течение последних 30 дней',
                                '2' => 'Альцгеймера',
                                '3' => 'Иной, нежели болезнь Альцгецмера, вид деменции',
                                '4' => 'Односторонний паралич',
                                '5' => 'Рассеянный склероз',
                                '6' => 'Параплегия',
                                '7' => 'Болезнь Паркинсона',
                                '8' => 'Квадриплегия',
                                '9' => 'Инсульт / острое нарушение мозгового кровообращения',
                                '10' => 'Ишемическая болезнь сердца',
                                '11' => 'Хроническое обструктивное заболевание легких',
                                '12' => 'Застойная сердечная недостаточность',
                                '13' => 'Тревожность',
                                '14' => 'Биполярное расстройство',
                                '15' => 'Депрессия',
                                '16' => 'Шизофрения',
                                '17' => 'Пневмония',
                                '18' => 'Инфекции мочевыводящих путей за последние 30 дней',
                                '19' => 'Рак',
                                '20' => 'Сахарный диабет'
                            );

                            $diagnoseType1 = array_keys(json_decode($survey->unitI->I1),1);
                            $diagnoseType2 = array_keys(json_decode($survey->unitI->I1),2);
                            $diagnoseType3 = array_keys(json_decode($survey->unitI->I1),3);

                        ?>


                        <? if(!empty($diagnoseType1)) : ?>
                            <fieldset>
                                <p class="text-bold">Основной диагноз (основные диагнозы) для текущего пребывания в стационаре</p>
                                <ul class="m-b-0">
                                    <? foreach ($diagnoseType1 as $diagnose) : ?>
                                        <li class="p-b-5"><?= $diagnoses[$diagnose]; ?></li>
                                    <? endforeach; ?>

                                    <? foreach (json_decode($survey->unitI->I2) as $id) : ?>
                                        <? $el = new Model_MKB10($id); ?>
                                        <li class="p-b-5"><?= $el->name . ' (' . $el->code . ')'; ?></li>
                                    <? endforeach; ?>
                                </ul>
                            </fieldset>
                        <? endif; ?>

                        <? if(!empty($diagnoseType2)) : ?>
                            <fieldset>
                                <p class="text-bold">Диагноз установлен - пациент получает активное лечение</p>
                                <ul class="m-b-0">
                                    <? foreach ($diagnoseType2 as $diagnose) : ?>
                                        <li class="p-b-5"><?= $diagnoses[$diagnose]; ?></li>
                                    <? endforeach; ?>
                                </ul>
                            </fieldset>
                        <? endif; ?>

                        <? if(!empty($diagnoseType3)) : ?>
                            <fieldset>
                                <p class="text-bold">Диагноз установлен - пациент наблюдается, но не получает активного лечения</p>
                                <ul class="m-b-0">
                                    <? foreach ($diagnoseType3 as $diagnose) : ?>
                                        <li class="p-b-5"><?= $diagnoses[$diagnose]; ?></li>
                                    <? endforeach; ?>
                                </ul>
                            </fieldset>
                        <? endif; ?>

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
