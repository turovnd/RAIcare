<?
    $unitA_11 = array(
        '0' => 'Не был(а) госпитализирован(а) за последние 90 дней',
        '1' => 'Госпитализация 31-90 дней назад',
        '2' => 'Госпитализация 15-30 дней назад',
        '3' => 'Госпитализация 8-14 дней назад',
        '4' => 'Госпитализация в течение последних 7 дней',
        '5' => 'Госпитализирован(а) в настоящее время'
    );
?>

<h3 class="section__heading">
    <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="personalInfo" data-opened="false" data-textclosed="подробно" data-textopened="кратко" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r collapse-btn"></a>
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitA" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Персональная информация
</h3>

<div class="row" id="unitA">

    <div class="col-xs-12">

        <?= View::factory('patients/blocks/profile-info', array('patient' => $survey->patient)); ?>

    </div>

    <div class="col-xs-12">

        <div class="block">

            <div class="block__body">

                <div class="form-group">
                    <label class="form-group__label col-xs-12">
                        Дата первичной оценки в учреждение
                    </label>
                    <div class="col-xs-12">
                        <p class="form-group__control-static p-l-0 p-r-0"> <?= date('d M Y', strtotime($survey->dt_first_survey)); ?> </p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="unitA_10" class="form-group__label col-xs-12">
                        Цели получения медицинской помощи, выраженные пациентом
                    </label>
                    <div class="col-xs-12">
                        <? if ($can_conduct) : ?>
                            <textarea name="unitA_10" id="unitA_10" rows="5" class="form-group__control"><?= $survey->unitA_10; ?></textarea>
                        <? else : ?>
                            <p class="form-group__control-static p-l-0 p-r-0"> <?= $survey->unitA_10; ?> </p>
                        <? endif; ?>
                    </div>
                </div>

                <div class="form-group m-b-15">
                    <label for="unitA_11" class="form-group__label col-xs-12">
                        Время с момента последнего пребываения в стационаре за последние 90 дней
                    </label>
                    <div class="col-xs-12">
                        <? if ($can_conduct) : ?>
                            <select name="unitA_11" id="unitA_11" class="form-group__control">
                                <option value=""></option>
                                <? foreach ($unitA_11 as $key => $option) :?>
                                    <option value="<?= $key; ?>" <?= $survey->unitA_11 != NULL  && $key == $unitA_11[$survey->unitA_11] ? 'selected' : '' ?>><?= $option; ?></option>
                                <? endforeach; ?>
                            </select>
                        <? else : ?>
                            <p class="form-group__control-static p-l-0 p-r-0"> <?= $survey->unitA_11 != NULL ? $unitA_11[$survey->unitA_11] : 'NULL'; ?> </p>
                        <? endif; ?>
                    </div>
                </div>

            </div>

            <? if ($can_conduct) : ?>
                <a role="button" class="block__footer text-center text-brand text-bold">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</div>