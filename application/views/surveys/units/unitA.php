<?
    $A11 = Kohana::$config->load('Units.A.A11');
?>

<h3 class="section__heading">
    <a role="button" onclick="raicare.collapse.toggle(this)" data-area="personalInfo" data-opened="false" data-textclosed="подробно" data-textopened="кратко" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r collapse-btn"></a>
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitA" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    РАЗДЕЛ A. Персональная информация
</h3>

<div class="row">

    <div class="col-xs-12">

        <?= View::factory('patients/blocks/profile-info', array('patient' => $survey->patient)); ?>

    </div>

    <form class="col-xs-12" id="unitA" onsubmit="event.preventDefault()">

        <div class="form">

            <div class="form__body">
                <fieldset>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Дата первичной оценки в учреждение
                        </label>
                        <div class="col-xs-12">
                            <p class="form-group__control-static p-l-0 p-r-0"> <?= strftime('%e %b %Y', strtotime($survey->dt_first_survey)); ?> </p>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="A10" class="form-group__label col-xs-12">
                            Цели получения медицинской помощи, выраженные резидентом
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <textarea name="A10" id="A10" rows="5" class="form-group__control" maxlength="512"><?= $survey->unitA->A10; ?></textarea>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitA->A10) ? $survey->unitA->A10 : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="A11" class="form-group__label col-xs-12">
                            Время с момента последнего пребываения в стационаре за последние 90 дней
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="A11" id="A11" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($A11 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitA->A11) && $key == $survey->unitA->A11 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitA->A11 != NULL && $survey->unitA->A11 != -1 ? $A11[$survey->unitA->A11] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <button role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitA');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </form>

</div>