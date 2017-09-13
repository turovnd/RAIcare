<?
    $total_progress = Model_Survey::getTotalProgress($survey->pk);
    $time = Methods_Time::getSurveyLeftTime($survey->dt_create, $survey->dt_finish, false);
    $timestamp = Methods_Time::getSurveyLeftTime($survey->dt_create, $survey->dt_finish, true);
?>

<div class="block" id="progressInfo">
    <div class="block__body p-t-0 p-b-0 text-center">
        <div class="col-xs-12 col-sm-4 m-b-10 m-t-10">
            <span class="text-bold text-brand"><?=$patient->name; ?></span>
            <small class="text-italic p-t-5">СНИЛС: <?= $patient->snils; ?></small>
        </div>
        <div class="col-xs-12 col-sm-4 m-b-10 m-t-10">
            <? if ($timestamp < Date::DAY / 2) : ?>
                <div class="text-bold text-danger">
                    <div>Осталось</div>
                    <?= $time; ?>
                </div>
            <? else: ?>
                <div class="text-bold text-brand">
                    <div>Осталось</div>
                    <?= $time; ?>
                </div>
            <? endif; ?>
        </div>
        <div class="col-xs-12 col-sm-4 m-b-10 m-t-10">
            <canvas data-diameter="19" data-fontsize="14px" data-percentage="<?= $total_progress; ?>" data-speed="5"
                <? if ($timestamp < Date::DAY / 2 ) : ?>
                    data-linecolor="rgba(244,80,80,1)"
                    data-remaininglinecolor="rgba(244,80,80,.15)"
                    data-fontcolor="rgba(236,33,33,1)"
                <? else: ?>
                    data-linecolor="rgba(0,141,167,1)"
                    data-remaininglinecolor="rgba(0,141,167,.15)"
                    data-fontcolor="rgba(31,110,125,1)"
                <? endif; ?>
                    data-linewidth="2" width="40px" height="40px" class="js-loader"></canvas>
        </div>
    </div>
</div>