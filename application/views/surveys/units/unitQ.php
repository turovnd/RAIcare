<?
    if (empty($survey->type != 5)) return;

    $Q2 = Kohana::$config->load('Units.Q.Q2');

    $survey->unitQ->Q1 = json_decode($survey->unitQ->Q1);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitQ" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    РАЗДЕЛ Q. Перспективы выписки
</h3>

<form class="row" id="unitQ" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Q1. Перспективы выписки
                    </p>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            a. Резидент выражает желание вернуться в свое домашнее окружение или оставаться там
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="Q1a_1" name="Q1a" type="radio" class="radio" value="0" <?= $survey->unitQ->Q1 != NULL && $survey->unitQ->Q1[0] == 0 ? 'checked' : '' ?> >
                                    <label for="Q1a_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="Q1a_2" name="Q1a" type="radio" class="radio" value="1" <?= $survey->unitQ->Q1 != NULL && $survey->unitQ->Q1[0] == 1 ? 'checked' : '' ?> >
                                    <label for="Q1a_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitQ->Q1 != NULL) { if ($survey->unitQ->Q1[0] == 1) { echo 'Да'; } elseif ($survey->unitQ->Q1[0] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            b. У резидента есть поддерживающее лицо, которое положительно смотрит на
                            выписку резидента или на продолжение его жизни в местном сообществе
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="Q1b_1" name="Q1b" type="radio" class="radio" value="0" <?= $survey->unitQ->Q1 != NULL && $survey->unitQ->Q1[1] == 0 ? 'checked' : '' ?> >
                                    <label for="Q1b_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="Q1b_2" name="Q1b" type="radio" class="radio" value="1" <?= $survey->unitQ->Q1 != NULL && $survey->unitQ->Q1[1] == 1 ? 'checked' : '' ?> >
                                    <label for="Q1b_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitQ->Q1 != NULL) { if ($survey->unitQ->Q1[1] == 1) { echo 'Да'; } elseif ($survey->unitQ->Q1[1] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            c. У резидента есть в распоряжении жилье, где он может проживать
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="Q1c_1" name="Q1c" type="radio" class="radio" value="0" <?= $survey->unitQ->Q1 != NULL && $survey->unitQ->Q1[2] == 0 ? 'checked' : '' ?> >
                                    <label for="Q1c_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="Q1c_2" name="Q1c" type="radio" class="radio" value="1" <?= $survey->unitQ->Q1 != NULL && $survey->unitQ->Q1[2] == 1 ? 'checked' : '' ?> >
                                    <label for="Q1c_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitQ->Q1 != NULL) { if ($survey->unitQ->Q1[2] == 1) { echo 'Да'; } elseif ($survey->unitQ->Q1[2] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>
                    
                    <div class="form-group">
                        <label for="Q2" class="form-group__label col-xs-12">
                            Q2. Сколько времени резидент предположительно проведет в данном
                            учреждении или будет пользоваться медицинскими услугами этого
                            учреждения до момента выписки
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="Q2" id="Q2" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($Q2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitQ->Q2 != NULL && $key == $survey->unitQ->Q2 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitQ->Q2 != NULL && $survey->unitQ->Q2 != -1 ? $Q2[$survey->unitQ->Q2] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <button type="button" role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitQ');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </div>

</form>