<?
$B1 = array(
    '0' => 'Полностью самостоятельное решение',
    '1' => 'Некоторое участие в принятии решения',
    '2' => 'Минимальное или никакого участие в принятии решения',
    '8' => 'Не смог или не захотел ответить'
);
$B3 = array(
    'a' => 'Испаноязычный или латиноамериканец',
    'b' => 'Индеец или коренной житель Аляски',
    'c' => 'Азиат',
    'd' => 'Чернокожий или афроамериканец',
    'e' => 'Коренной житель Гавайских островов или житель Океании',
    'f' => 'Белый'
);
$B3_get = json_decode($survey->unitB->B3);
$B4 = array(
    '1' => 'Русский язык',
    '2' => 'Английский язык',
    '3' => 'Испанский язык',
    '4' => 'Французский язык',
);
$B5 = array(
    '1' => 'Частный дом / квартира / арендуемая комната',
    '2' => 'Дом-интернат для престарелых',
    '3' => 'Специализированный дом социального назначения',
    '4' => 'Психоневрологический интернат',
    '5' => 'Дом-интернат для людей с физической инвалидностью',
    '7' => 'Психиатрическая больница или отделение',
    '8' => 'Бездомный (проживающий в приюте или вне его)',
    '9' => 'Лечебное учреждение для долговременного ухода (отделение сестринского ухода, гериатрическое отделение)',
    '10' => 'Больница / отделение реабилитации',
    '11' => 'Хоспис / отделение паллиативной медицины',
    '12' => 'Больница экстренной медицинской помощи',
    '13' => 'Исправительное учреждение',
    '14' => 'Другое'
);
$B7 = array(
    '1' => 'Одинокий',
    '2' => 'Только с супругом(ой)/партнером',
    '3' => 'С супругом(ой)/партнером и другим(и)',
    '4' => 'С ребенком (без супруга / партнера)',
    '5' => 'С родителем (родителями) или опекуном (опекунами)',
    '6' => 'С братьями/сестрами',
    '7' => 'С другим родственником',
    '8' => 'С лицом (лицами), не являющим(и)ся родственником (родственниками)'
);
$B8 = array(
    'a' => 'Лечебное учреждение для долговременного ухода — напр., центр сестринского ухода или гериатрическое отделение',
    'b' => 'Дом-интернат для престарелых',
    'c' => 'Психоневрологичесикй интернат',
    'd' => 'Психиатрическая больница или отделение'
);
$B8_get = json_decode($survey->unitB->B8);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitB" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Первоначальная история
</h3>

<form class="row" id="unitB" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="block">

            <div class="block__body">

                <fieldset>
                    <div class="form-group">
                        <label for="B1" class="form-group__label col-xs-12">
                            Степень самостоятельности пациента при принятии решение о поступление в лечебное учреждение по уходу
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="B1" id="B1" class="form-group__control">
                                    <option value="-1"></option>
                                    <? foreach ($B1 as $key => $option) :?>
                                    <option value="<?= $key; ?>" <?= !empty($survey->unitB->B1) && $key == $survey->unitB->B1 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitB->B1) && $survey->unitB->B1 != -1 ? $B1[$survey->unitB->B1] : 'не указано'; ?> </p>
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
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitB->B2) ? date('d M Y', strtotime($survey->unitB->B2)) : 'не указано'; ?> </p>
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
                                        <input id="B3<?= $key; ?>" name="B3[]" type="checkbox" class="checkbox" value="<?= $key; ?>" <?= !empty($B3_get) && in_array($key, $B3_get) ? 'checked' : '' ?>>
                                        <label for="B3<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach;?>
                            <? else : ?>
                                <ol class="form-group__control-static p-l-20">
                                    <? if (empty($B3_get)) : echo 'не указано'; else : foreach ($B3_get as $item) : ?>
                                        <li><?= $B3[$item]; ?></li>
                                    <? endforeach; endif; ?>
                                </ol>
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
                                <select name="B4" id="B4" class="form-group__control">
                                    <option value="-1"></option>
                                    <? foreach ($B4 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitB->B4) && $key == $survey->unitB->B4 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitB->B4) && $survey->unitB->B4 != -1 ? $B4[$survey->unitB->B4] : 'не указано'; ?> </p>
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
                                <select name="B5a" id="B5a" class="form-group__control">
                                    <option value="-1"></option>
                                    <? foreach ($B5 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitB->B5a) && $key == $survey->unitB->B5a ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitB->B5a) && $survey->unitB->B5a != -1 ? $B5[$survey->unitB->B5a] : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="B5b" class="form-group__label col-xs-12">
                            Постоянное место проживания пациента
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="B5b" id="B5b" class="form-group__control">
                                    <option value="-1"></option>
                                    <? foreach ($B5 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitB->B5b) && $key == $survey->unitB->B5b ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitB->B5b) && $survey->unitB->B5b != -1 ? $B5[$survey->unitB->B5b] : 'не указано'; ?> </p>
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
                                <p class="form-group__control-static p-l-0 letter-spacing--5">
                                    <?= !empty($survey->unitB->B6) ? chunk_split($survey->unitB->B6, 3) : 'не указано'; ?>
                                </p>
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
                                <select name="B7" id="B7" class="form-group__control">
                                    <option value="-1"></option>
                                    <? foreach ($B7 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitB->B7) && $key == $survey->unitB->B7 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitB->B7) && $survey->unitB->B7 != -1 ? $B7[$survey->unitB->B7] : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="B8" class="form-group__label col-xs-12">
                            История проживания пациента в учреждениях с коллективным проживание за последних 5 лет
                            <small class="text-normal">Отметьте все жилищные условия, в которых пациент жил за последние 5 ЛЕТ перед поступлением в лечебное учреждение</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($B8 as $key => $value) : ?>
                                    <p>
                                        <input id="B8<?= $key; ?>" name="B8[]" type="checkbox" class="checkbox" value="<?= $key; ?>" <?= !empty($B8_get) && in_array($key, $B8_get) ? 'checked' : '' ?>>
                                        <label for="B8<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach;?>
                            <? else : ?>
                                <ol class="form-group__control-static p-l-20">
                                    <? if (empty($B8_get)) : echo 'не указано'; else : foreach ($B8_get as $item) : ?>
                                        <li><?= $B8[$item]; ?></li>
                                    <? endforeach; endif; ?>
                                </ol>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="B9" class="form-group__label col-xs-12">
                            Душевное здоровье
                            <small class="text-normal">Эта запись показывает наличие/отсутствие душевного заболевания или умственной отсталости</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <p>
                                    <input id="B9a" name="B9" type="radio" class="checkbox" value="0" <?= !empty($survey->unitB->B9) && $survey->unitB->B9 == 0 ? 'checked' : '' ?>>
                                    <label for="B9a" class="checkbox-label">Нет</label>
                                </p>
                                <p>
                                    <input id="B9b" name="B9" type="radio" class="checkbox" value="1" <?= !empty($survey->unitB->B9) && $survey->unitB->B9 == 1 ? 'checked' : '' ?>>
                                    <label for="B9b" class="checkbox-label">Да</label>
                                </p>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitB->B9 == 0 ? 'Нет' : $survey->unitB->B9 == 1 ? 'Да' : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a role="button" class="block__footer text-center text-brand text-bold" onclick="survey.send.updateunit('unitB');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>