<?
    if (empty($survey->type == 5)) return;

    $R2 = Kohana::$config->load('Units.R.R2');
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitR" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    РАЗДЕЛ R. Выписка
</h3>

<form class="row" id="unitR" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>
                    <div class="form-group">
                        <label for="R1" class="form-group__label col-xs-12">
                            R1. Последний день пребывания в лечебном учреждении
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="R1" name="R1" type="date" class="form-group__control" value="<?= $survey->unitR->R1; ?>">
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitR->R1) && $survey->unitR->R1 != "0000-00-00" ? date('d M Y', strtotime($survey->unitR->R1)) : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="R2" class="form-group__label col-xs-12">
                            R2. Жилищные условия после выписки
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="R2" id="R2" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($R2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitR->R2 != NULL && $key == $survey->unitR->R2 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitR->R2 != NULL && $survey->unitR->R2 != -1 ? $R2[$survey->unitR->R2] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            R3. Пациенту дано направление на получение услуг по уходу на дому после выписки
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="R3_1" name="R3" type="radio" class="radio" value="1" <?= $survey->unitR->R3 != NULL && $survey->unitR->R3 == 1 ? 'checked' : '' ?> >
                                    <label for="R3_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="R3_2" name="R3" type="radio" class="radio" value="0" <?= $survey->unitR->R3 != NULL && $survey->unitR->R3 == 0 ? 'checked' : '' ?> >
                                    <label for="R3_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitR->R3 != NULL) { if ($survey->unitR->R3 == 1) { echo 'Да'; } elseif ($survey->unitR->R3 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <button role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitR');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </div>

</form>