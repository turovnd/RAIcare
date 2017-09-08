<div class="section__content">

    <h3 class="section__heading">
        <div class="f-s-0_9 fl_r">
            <? if ($survey->status == 1) : ?>
                <? if (Methods_Time::getSurveyLeftTime($survey->dt_create, $survey->dt_finish, true) < Date::DAY / 2) : ?>
                    <span class="label label--danger">на заполнении</span>
                <? else : ?>
                    <span class="label label--warning">на заполнении</span>
                <? endif; ?>
            <? elseif ($survey->status == 2) : ?>
                <span class="label label--brand">заполнение завершено</span>
            <? endif; ?>
        </div>
        Форма оценки #<?= $survey->id; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <?= View::factory('surveys/blocks/progress-info', array('patient' => $patient, 'survey' => $survey)); ?>

            <? if ($survey->status == 1 || $survey->status == 3) : ?>

                <?= View::factory('surveys/blocks/progress-addition', array('patient' => $patient, 'survey' => $survey)); ?>

            <? elseif ($survey->status == 2) : ?>

                <div class="block">
                    <div class="block__heading">Отчеты</div>
                    <div class="block__body">
                        <ol class="col-xs-12 m-0">
                            <? foreach (Kohana::$config->load('reports.patient') as $report) : ?>
                                <li class="m-l-5 m-b-5"><a href="<?= '/\/' . $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/survey/' . $survey->id . '/' . $report['hash']; ?>" class="link p-10 p-t-5 display-inline-block"><?=$report['name']; ?></a></li>
                            <? endforeach; ?>
                        </ol>
                    </div>
                </div>

            <? endif; ?>

        </div>

    </div>

</div>