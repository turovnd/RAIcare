<?
    $B1 = Kohana::$config->load('Units.B.B1');
    $B3 = Kohana::$config->load('Units.B.B3');
    $B4 = Kohana::$config->load('Units.B.B4');
    $B5 = Kohana::$config->load('Units.B.B5');
    $B7 = Kohana::$config->load('Units.B.B7');
    $B8 = Kohana::$config->load('Units.B.B8');

    $survey->unitB->B3 = json_decode($survey->unitB->B3);
    $survey->unitB->B5 = json_decode($survey->unitB->B5);
    $survey->unitB->B8 = json_decode($survey->unitB->B8);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitB" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Первоначальная история
</h3>

<form class="row" id="unitB" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>
                    <div class="form-group">
                        <label for="B1" class="form-group__label col-xs-12">
                            Степень самостоятельности пациента при принятии решение о поступление в лечебное учреждение по уходу
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="B1" id="B1" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($B1 as $key => $option) :?>
                                    <option value="<?= $key; ?>" <?= $survey->unitB->B1 != NULL && $key == $survey->unitB->B1 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitB->B1 != NULL && $survey->unitB->B1 != -1 ? $B1[$survey->unitB->B1] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="B2" class="form-group__label col-xs-12">
                            Дата начала пребывания
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="B2" name="B2" type="date" class="form-group__control" value="<?= $survey->unitB->B2; ?>">
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitB->B2) && $survey->unitB->B2 != "0000-00-00" ? date('d M Y', strtotime($survey->unitB->B2)) : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="B3" class="form-group__label col-xs-12">
                            Национальность и раса
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($B3 as $key => $value) : ?>
                                    <p>
                                        <input id="B3<?= $key; ?>" name="B3[]" type="checkbox" class="checkbox" value="<?= $key; ?>" <?= !empty($survey->unitB->B3) && in_array($key, $survey->unitB->B3) ? 'checked' : '' ?>>
                                        <label for="B3<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach;?>
                            <? else : ?>
                                <div class="form-group__control-static p-l-0">
                                    <? if (empty($survey->unitB->B3)) : ?>
                                        Не указано
                                    <? else : ?>
                                        <ol class="p-l-20">
                                            <? foreach ($survey->unitB->B3 as $item) : ?>
                                                <li><?= $B3[$item]; ?></li>
                                            <? endforeach; ?>
                                        </ol>
                                    <? endif; ?>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="B4" class="form-group__label col-xs-12">
                            Основной язык
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="B4" id="B4" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($B4 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitB->B4 != NULL && $key == $survey->unitB->B4 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitB->B4 != NULL && $survey->unitB->B4 != -1 ? $B4[$survey->unitB->B4] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="B5a" class="form-group__label col-xs-12">
                            Местоположение, из которого поступил пациент
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="B5[]" id="B5a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($B5 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitB->B5 != NULL && $key == $survey->unitB->B5[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitB->B5 != NULL && $survey->unitB->B5[0] != -1 ? $B5[$survey->unitB->B5[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="B5b" class="form-group__label col-xs-12">
                            Постоянное место проживания пациента
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="B5[]" id="B5b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($B5 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitB->B5 != NULL && $key == $survey->unitB->B5[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitB->B5 != NULL && $survey->unitB->B5[1] != -1 ? $B5[$survey->unitB->B5[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="B6" class="form-group__label col-xs-12">
                            Почтовый индекс постоянного места проживания до поступления в лечебное учреждение
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="B6" name="B6" type="text" class="form-group__control letter-spacing--5" value="<?= $survey->unitB->B6 ?>" maxlength="9">
                            <? else : ?>
                                <div class="form-group__control-static p-l-0">
                                    <? if (empty($survey->unitB->B6)) : ?>
                                        Не указано
                                    <? else: ?>
                                        <span class="letter-spacing--5"> <?= chunk_split($survey->unitB->B6, 3); ?> </span>
                                    <? endif; ?>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="B7" class="form-group__label col-xs-12">
                            С кем проживал пациент до поступления в лечебное учреждение
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="B7" id="B7" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($B7 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitB->B7 != NULL && $key == $survey->unitB->B7 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitB->B7 != NULL && $survey->unitB->B7 != -1 ? $B7[$survey->unitB->B7] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="B8" class="form-group__label col-xs-12">
                            История проживания пациента в учреждениях с коллективным проживание за последних 5 лет
                            <small class="text-italic text-normal">Отметьте все жилищные условия, в которых пациент жил за последние 5 ЛЕТ перед поступлением в лечебное учреждение</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($B8 as $key => $value) : ?>
                                    <p>
                                        <input id="B8<?= $key; ?>" name="B8[]" type="checkbox" class="checkbox" value="<?= $key; ?>" <?= !empty($survey->unitB->B8) && in_array($key, $survey->unitB->B8) ? 'checked' : '' ?>>
                                        <label for="B8<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach;?>
                            <? else : ?>
                                <div class="form-group__control-static p-l-0">
                                    <? if (empty($survey->unitB->B8)) : ?>
                                        Не указано
                                    <? else : ?>
                                        <ol class="p-l-20">
                                            <? foreach ($survey->unitB->B8 as $item) : ?>
                                                <li><?= $B8[$item]; ?></li>
                                            <? endforeach; ?>
                                        </ol>
                                    <? endif; ?>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="B9" class="form-group__label col-xs-12">
                            Душевное здоровье
                            <small class="text-italic text-normal">Эта запись показывает наличие/отсутствие душевного заболевания или умственной отсталости</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="B9_1" name="B9" type="radio" class="radio" value="1" <?= $survey->unitB->B9 != NULL && $survey->unitB->B9 == 1 ? 'checked' : '' ?>>
                                    <label for="B9_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="B9_2" name="B9" type="radio" class="radio" value="0" <?= $survey->unitB->B9 != NULL && $survey->unitB->B9 == 0 ? 'checked' : '' ?>>
                                    <label for="B9_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitB->B9 != NULL) { if ($survey->unitB->B9 == 1) { echo 'Да'; } elseif ($survey->unitB->B9 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <button role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitB');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </div>

</form>