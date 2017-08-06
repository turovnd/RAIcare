<div class="section__content">

    <h3 class="section__heading">
        Все формы оценки - <?= $pension->name; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <div class="block" id="progressInfo">
                <div class="block__body">
                    <table class="tablesaw table-style--surveys" data-tablesaw-mode="stack">
                        <thead>
                            <tr>
                                <th width="30%" >Пациент</th>
                                <th width="15%">Прогресс</th>
                                <th width="20%">Время</th>
                                <th width="30%">Ответственный</th>
                            </tr>
                        </thead>
                        <tbody valign="middle">

                            <? foreach ($surveys as $survey) : ?>

                                <?
                                    $total_progress = Model_Survey::getTotalProgress($survey->pk);
                                    $time = Methods_Time::getSurveyLeftTime($survey->dt_create, $survey->dt_finish, false);
                                    $timestamp = Methods_Time::getSurveyLeftTime($survey->dt_create, $survey->dt_finish, true);
                                ?>

                                <tr onclick="window.location = '<?= '/\/'. $_SERVER['HTTP_HOST'] . '/' . $pension->uri . '/survey/' . $survey->id; ?>'">
                                    <td>
                                        <span class="text-bold"><?=$survey->patient->name; ?></span>
                                        <small>
                                            д.р.: <?= date('d M Y', strtotime($survey->patient->birthday)); ?>
                                            <br>
                                            СНИЛС: <?= $survey->patient->snils; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <canvas data-diameter="25" data-fontsize="16px" data-percentage="<?= $total_progress; ?>" data-speed="5"
                                            <? if ($survey->status == 1 && $timestamp < Date::DAY / 2 || $survey->status == 3) : ?>
                                                data-linecolor="rgba(244,80,80,1)"
                                                data-remaininglinecolor="rgba(244,80,80,.15)"
                                                data-fontcolor="rgba(236,33,33,1)"
                                            <? else: ?>
                                                data-linecolor="rgba(0,141,167,1)"
                                                data-remaininglinecolor="rgba(0,141,167,.15)"
                                                data-fontcolor="rgba(31,110,125,1)"
                                            <? endif; ?>
                                                data-linewidth="2" width="65px" height="65px" class="js-loader"></canvas>
                                    </td>
                                    <td class="f-s-0_9">
                                        <? if ( $survey->status == 1 ) : ?>
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
                                        <? elseif ($survey->status == 2) : ?>
                                            <div class="text-bold text-brand">
                                                <div class="">Завершено</div>
                                                <?= $time; ?>
                                            </div>
                                        <? else: ?>
                                            <div class="text-bold text-danger">
                                                Удалена
                                            </div>
                                        <? endif; ?>
                                    </td>
                                    <td>
                                        <?= $survey->creator->name; ?>
                                    </td>
                                </tr>

                            <? endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                raicare.table.init();
                raicare.table.create();
            </script>

        </div>

    </div>

</div>