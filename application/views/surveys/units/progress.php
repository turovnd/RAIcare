<?
    if (!empty($survey->unitB)) $survey->unitB->B5 = json_decode($survey->unitB->B5);
    $survey->unitC->C3 = json_decode($survey->unitC->C3);

    $unitA = 70 + (($survey->unitA->A10 == NULL || $survey->unitA->A10 == "") ? 0 : 15) + (($survey->unitA->A11 == NULL || $survey->unitA->A11 == -1) ? 0 : 15);
    $unitB = empty($survey->unitB) ? 100 : (($survey->unitB->B1 == NULL || $survey->unitB->B1 == "-1") ? 0 : 11) + (($survey->unitB->B2 == NULL || $survey->unitB->B2 == "0000-00-00") ? 0 : 11) + (($survey->unitB->B3 == NULL || $survey->unitB->B3 == "null") ? 0 : 11) + (($survey->unitB->B4 == NULL || $survey->unitB->B4 == "-1") ? 0 : 11) + ((($survey->unitB->B5 == NULL || ($survey->unitB->B5[0] == "-1" && $survey->unitB->B5[1] == "-1") ? 0 : ($survey->unitB->B5[0] != "-1" && $survey->unitB->B5[1] != "-1")) ? 11 : (($survey->unitB->B5[0] != "-1" && $survey->unitB->B5[1] == "-1" || $survey->unitB->B5[0] == "-1" && $survey->unitB->B5[1] != "-1") ? 6 : 0))) + (($survey->unitB->B6 == NULL || $survey->unitB->B6 == "") ? 0 : 11) + (($survey->unitB->B7 == NULL || $survey->unitB->B7 == "-1") ? 0 : 11) + (($survey->unitB->B8 == NULL || $survey->unitB->B8 == "null") ? 0 : 12) + (($survey->unitB->B9 == NULL || $survey->unitB->B9 == "-1") ? 0 : 11);
    $unitC = $survey->unitC->C1 == 5 ? 100 : (($survey->unitC->C1 == NULL || $survey->unitC->C1 == "-1") ? 0 : 14) + (($survey->unitC->C2 == NULL || $survey->unitC->C2 == "null") ? 0 : 14) + (($survey->unitC->C3 == NULL || ($survey->unitC->C3[0] == "-1" && $survey->unitC->C3[1] == "-1" && $survey->unitC->C3[2] == "-1")) ? 0 : ($survey->unitC->C3[0] != "-1" && $survey->unitC->C3[1] != "-1" && $survey->unitC->C3[2] != "-1") ? '44' : ((($survey->unitC->C3[0] != "-1" && $survey->unitC->C3[1] == "-1" && $survey->unitC->C3[2] == "-1") || ($survey->unitC->C3[0] == "-1" && $survey->unitC->C3[1] != "-1" && $survey->unitC->C3[2] == "-1") || ($survey->unitC->C3[0] == "-1" && $survey->unitC->C3[1] == "-1" && $survey->unitC->C3[2] != "-1")) ? '15' : (($survey->unitC->C3[0] != "-1" && $survey->unitC->C3[1] != "-1" && $survey->unitC->C3[2] == "-1") || ($survey->unitC->C3[0] == "-1" && $survey->unitC->C3[1] != "-1" && $survey->unitC->C3[2] != "-1") || ($survey->unitC->C3[0] != "-1" && $survey->unitC->C3[1] == "-1" && $survey->unitC->C3[2] != "-1")) ? '30' : '0')) + (($survey->unitC->C4 == NULL || $survey->unitC->C4 == "-1") ? 0 : 14) + (($survey->unitC->C1 == NULL || $survey->unitC->C5 == "-1") ? 0 : 14);

    echo Debug::vars();
?>

<h3 class="section__heading">
    Прогресс заполнения формы оценки
</h3>

<div class="row">

    <div class="col-xs-12">

        <div class="block">
            <div class="block__body">
                Пациент #<?= $survey->patient->id; ?> - <span class="text-bold"><?=$survey->patient->name; ?></span> - (д.р. <?= date('d M Y', strtotime($survey->patient->birthday)); ?>)
            </div>
        </div>

        <div class="block">
            <div class="block__body">
                <a href="#unitA" class="col-sm-3 col-xs-6 text-center">
                    <p>Персональная информация</p>
                    <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?=$unitA; ?>" data-speed="20" data-linecolor="rgba(0,141,167,1)" data-remaininglinecolor="rgba(0,141,167,.15)" data-fontcolor="rgba(31,110,125,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                </a>
                <? if (!empty($survey->unitB)) : ?>
                    <a href="#unitB" class="col-sm-3 col-xs-6 text-center">
                        <p>Первоначальная история</p>
                        <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?=$unitB; ?>" data-speed="20" data-linecolor="rgba(39,194,76,1)" data-remaininglinecolor="rgba(39,194,76,.15)" data-fontcolor="rgba(30,152,59,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                    </a>
                <? endif; ?>
                <a href="#unitC" class="col-sm-3 col-xs-6 text-center">
                    <p>Когнитивные способности</p>
                    <canvas data-diameter="60" data-fontsize="30px" data-percentage="<?=$unitC; ?>" data-speed="20" data-linecolor="rgba(255,144,43,1)" data-remaininglinecolor="rgba(255,144,43,.15)" data-fontcolor="rgba(247,118,0,1)" data-linewidth="2" width="150px" height="150" class="js-loader"></canvas>
                </a>

            </div>
        </div>

        <? echo Debug::vars($survey->unitD); ?>
    </div>

</div>