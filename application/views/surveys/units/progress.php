<?
    $total_progress = Model_Survey::getProgress($survey->pk);
?>

<h3 class="section__heading">
    Прогресс заполнения формы оценки
</h3>

<div class="row">

    <div class="col-xs-12">

        <div class="form" id="progressForm">
            <div class="form__body">
                <table class="tablesaw" data-tablesaw-mode="stack">
                    <thead>
                        <tr>
                            <th class="hide">Пациент</th>
                            <th class="hide">Прогресс</th>
                            <th class="hide">Время</th>
                        </tr>
                    </thead>
                    <tbody valign="middle">
                        <tr class="b-b-0">
                            <td>
                                <span class="text-bold"><?=$survey->patient->name; ?></span>
                                <small>д.р. <?= date('d M Y', strtotime($survey->patient->birthday)); ?>, ОМС: <?= $survey->patient->oms; ?></small>
                            </td>
                            <td>
                                <canvas data-diameter="25" data-fontsize="16px" data-percentage="<?= $total_progress; ?>" data-speed="20" data-linecolor="rgba(0,141,167,1)" data-remaininglinecolor="rgba(0,141,167,.15)" data-fontcolor="rgba(31,110,125,1)" data-linewidth="2" width="65px" height="65px" class="js-loader"></canvas>
                            </td>
                            <td>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <? if ($total_progress == 100) : ?>
                    <button onclick="survey.send.complete()" class="btn btn--brand m-t-10 m-l-10">Завершить заполнение анкеты</button>
                    <input type="hidden" id="patientID" value="<?= $survey->patient->id; ?>">
                <? endif; ?>
            </div>
        </div>

        <div class="block">
            <div class="block__body">
                <div class="block-wrapper block-wrapper--flex-end">
                    <a href="#unitA" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Персональная информация</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitA->progress) ? $survey->unitA->progress : 0; ?>" data-speed="20" data-linecolor="rgba(0,141,167,1)" data-remaininglinecolor="rgba(0,141,167,.15)" data-fontcolor="rgba(31,110,125,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <? if ($survey->type == 1) : ?>
                        <a href="#unitB" class="col-sm-3 col-xs-6 text-center">
                            <p class="word-wrap--break-word">Первоначальная история</p>
                            <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitB->progress) ? $survey->unitB->progress : 0; ?>" data-speed="20" data-linecolor="rgba(39,194,76,1)" data-remaininglinecolor="rgba(39,194,76,.15)" data-fontcolor="rgba(30,152,59,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                        </a>
                    <? endif; ?>
                    <a href="#unitC" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Когнитивные способности</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitC->progress) ? $survey->unitC->progress : 0; ?>" data-speed="20" data-linecolor="rgba(255,144,43,1)" data-remaininglinecolor="rgba(255,144,43,.15)" data-fontcolor="rgba(247,118,0,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <? if ($survey->unitC->C1 != 5) : ?>
                        <a href="#unitD" class="col-sm-3 col-xs-6 text-center">
                            <p class="word-wrap--break-word">Коммуникация и зрение</p>
                            <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitD->progress) ? $survey->unitD->progress : 0; ?>" data-speed="20" data-linecolor="rgba(244,80,80,1)" data-remaininglinecolor="rgba(244,80,80,.15)" data-fontcolor="rgba(236,33,33,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                        </a>
                        <a href="#unitE" class="col-sm-3 col-xs-6 text-center">
                            <p class="word-wrap--break-word">Настроение и поведение</p>
                            <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitE->progress) ? $survey->unitE->progress : 0; ?>" data-speed="20" data-linecolor="rgba(245,50,229,1)" data-remaininglinecolor="rgba(245,50,229,.15)" data-fontcolor="rgba(233,11,214,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                        </a>
                        <a href="#unitF" class="col-sm-3 col-xs-6 text-center">
                            <p class="word-wrap--break-word">Психосоциальное благополучие</p>
                            <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitF->progress) ? $survey->unitF->progress : 0; ?>" data-speed="20" data-linecolor="rgba(55,188,155,1)" data-remaininglinecolor="rgba(55,188,155,.15)" data-fontcolor="rgba(43,149,122,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                        </a>
                    <? endif; ?>
                    <a href="#unitG" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Функциональное состояние</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitG->progress) ? $survey->unitG->progress : 0; ?>" data-speed="20" data-linecolor="rgba(250,215,50,1)" data-remaininglinecolor="rgba(250,215,50,.15)" data-fontcolor="rgba(226,188,8,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <a href="#unitH" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Недержание</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitH->progress) ? $survey->unitH->progress : 0; ?>" data-speed="20" data-linecolor="rgba(0,141,167,1)" data-remaininglinecolor="rgba(0,141,167,.15)" data-fontcolor="rgba(31,110,125,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <a href="#unitI" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Диагнозы</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitI->progress) ? $survey->unitI->progress : 0; ?>" data-speed="20" data-linecolor="rgba(39,194,76,1)" data-remaininglinecolor="rgba(39,194,76,.15)" data-fontcolor="rgba(30,152,59,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <a href="#unitJ" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Нарушения состояния здоровья</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitJ->progress) ? $survey->unitJ->progress : 0; ?>" data-speed="20" data-linecolor="rgba(255,144,43,1)" data-remaininglinecolor="rgba(255,144,43,.15)" data-fontcolor="rgba(247,118,0,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <a href="#unitK" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Вопросы питания и состояние ротовой области</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitK->progress) ? $survey->unitK->progress : 0; ?>" data-speed="20" data-linecolor="rgba(244,80,80,1)" data-remaininglinecolor="rgba(244,80,80,.15)" data-fontcolor="rgba(236,33,33,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <a href="#unitL" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Состояние кожи</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitL->progress) ? $survey->unitL->progress : 0; ?>" data-speed="20" data-linecolor="rgba(245,50,229,1)" data-remaininglinecolor="rgba(245,50,229,.15)" data-fontcolor="rgba(233,11,214,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <a href="#unitM" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Досуг</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitM->progress) ? $survey->unitM->progress : 0; ?>" data-speed="20" data-linecolor="rgba(55,188,155,1)" data-remaininglinecolor="rgba(55,188,155,.15)" data-fontcolor="rgba(43,149,122,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <a href="#unitN" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Лекарственные средства</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitN->progress) ? $survey->unitN->progress : 0; ?>" data-speed="20" data-linecolor="rgba(250,215,50,1)" data-remaininglinecolor="rgba(250,215,50,.15)" data-fontcolor="rgba(226,188,8,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <a href="#unitO" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Лечебные мероприятия и процедуры</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitO->progress) ? $survey->unitO->progress : 0; ?>" data-speed="20" data-linecolor="rgba(0,141,167,1)" data-remaininglinecolor="rgba(0,141,167,.15)" data-fontcolor="rgba(31,110,125,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <a href="#unitP" class="col-sm-3 col-xs-6 text-center">
                        <p class="word-wrap--break-word">Правовая ответственность и распоряжения</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitP->progress) ? $survey->unitP->progress : 0; ?>" data-speed="20" data-linecolor="rgba(39,194,76,1)" data-remaininglinecolor="rgba(39,194,76,.15)" data-fontcolor="rgba(30,152,59,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                    <? if ($survey->type != 5) : ?>
                        <a href="#unitQ" class="col-sm-3 col-xs-6 text-center">
                            <p class="word-wrap--break-word">Перспективы выписки</p>
                            <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitQ->progress) ? $survey->unitQ->progress : 0; ?>" data-speed="20" data-linecolor="rgba(255,144,43,1)" data-remaininglinecolor="rgba(255,144,43,.15)" data-fontcolor="rgba(247,118,0,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                        </a>
                    <? endif; ?>
                    <? if ($survey->type == 5) : ?>
                        <a href="#unitR" class="col-sm-3 col-xs-6 text-center">
                            <p class="word-wrap--break-word">Выписка</p>
                            <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?= !empty($survey->unitR->progress) ? $survey->unitR->progress : 0; ?>" data-speed="20" data-linecolor="rgba(244,80,80,1)" data-remaininglinecolor="rgba(244,80,80,.15)" data-fontcolor="rgba(236,33,33,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                        </a>
                    <? endif; ?>
                </div>
            </div>
        </div>

    </div>

</div>