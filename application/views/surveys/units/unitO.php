<?
    $O2 = Kohana::$config->load('Units.O.O2');
    $O7 = Kohana::$config->load('Units.O.O7');

    $survey->unitO->O1 = json_decode($survey->unitO->O1);
    $survey->unitO->O2 = json_decode($survey->unitO->O2);
    $survey->unitO->O3 = json_decode($survey->unitO->O3);
    $survey->unitO->O4 = json_decode($survey->unitO->O4);
    $survey->unitO->O7 = json_decode($survey->unitO->O7);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitO" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    РАЗДЕЛ O. Лечебные мероприятия и процедуры
</h3>

<form class="row" id="unitO" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        O1. Проведенные профилактические процедуры
                    </p>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            a. Измерение артериального давления за ПОСЛЕДНИЙ ГОД
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="O1a_1" name="O1a" type="radio" class="radio" value="0" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[0] == 0 ? 'checked' : ''; ?> >
                                    <label for="O1a_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="O1a_2" name="O1a" type="radio" class="radio" value="1" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[0] == 1 ? 'checked' : ''; ?> >
                                    <label for="O1a_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitO->O1[0] == 1) { echo 'Да'; } elseif ($survey->unitO->O1[0] == 0) { echo 'Нет'; } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            b. Колоноскопия за ПОСЛЕДНИЕ 5 ЛЕТ
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="O1b_1" name="O1b" type="radio" class="radio" value="0" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[1] == 0 ? 'checked' : ''; ?> >
                                    <label for="O1b_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="O1b_2" name="O1b" type="radio" class="radio" value="1" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[1] == 1 ? 'checked' : ''; ?> >
                                    <label for="O1b_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitO->O1[1] == 1) { echo 'Да'; } elseif ($survey->unitO->O1[1] == 0) { echo 'Нет'; } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            c. Осмотр состояния зубов за ПОСЛЕДНИЙ ГОД
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="O1c_1" name="O1c" type="radio" class="radio" value="0" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[2] == 0 ? 'checked' : ''; ?> >
                                    <label for="O1c_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="O1c_2" name="O1c" type="radio" class="radio" value="1" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[2] == 1 ? 'checked' : ''; ?> >
                                    <label for="O1c_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitO->O1[2] == 1) { echo 'Да'; } elseif ($survey->unitO->O1[2] == 0) { echo 'Нет'; } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            d. Осмотр состояния глаз за ПОСЛЕДНИЙ ГОД
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="O1d_1" name="O1d" type="radio" class="radio" value="0" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[3] == 0 ? 'checked' : ''; ?> >
                                    <label for="O1d_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="O1d_2" name="O1d" type="radio" class="radio" value="1" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[3] == 1 ? 'checked' : ''; ?> >
                                    <label for="O1d_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitO->O1[3] == 1) { echo 'Да'; } elseif ($survey->unitO->O1[3] == 0) { echo 'Нет'; } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            e. Проверка слуха за ПОСЛЕДНИЕ 2 ГОДА
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="O1e_1" name="O1e" type="radio" class="radio" value="0" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[4] == 0 ? 'checked' : ''; ?> >
                                    <label for="O1e_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="O1e_2" name="O1e" type="radio" class="radio" value="1" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[4] == 1 ? 'checked' : ''; ?> >
                                    <label for="O1e_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitO->O1[4] == 1) { echo 'Да'; } elseif ($survey->unitO->O1[4] == 0) { echo 'Нет'; } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            f. Противигриппозная вакцинация за ПОСЛЕДНИЙ ГОД
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="O1f_1" name="O1f" type="radio" class="radio" value="0" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[5] == 0 ? 'checked' : ''; ?> >
                                    <label for="O1f_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="O1f_2" name="O1f" type="radio" class="radio" value="1" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[5] == 1 ? 'checked' : ''; ?> >
                                    <label for="O1f_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitO->O1[5] == 1) { echo 'Да'; } elseif ($survey->unitO->O1[5] == 0) { echo 'Нет'; } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>


                    <? if ($survey->patient->sex == 2) : ?>

                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                g. Маммография или осмотр груди за ПОСЛЕДНИЕ 2 ГОДА (для женщин)
                            </label>
                            <div class="col-xs-12">
                                <? if ($can_conduct) : ?>
                                    <span>
                                        <input id="O1g_1" name="O1g" type="radio" class="radio" value="0" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[6] == 0 ? 'checked' : ''; ?> >
                                        <label for="O1g_1" class="radio-label">Нет</label>
                                    </span>
                                    <span class="m-l-20">
                                        <input id="O1g_2" name="O1g" type="radio" class="radio" value="1" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[6] == 1 ? 'checked' : ''; ?> >
                                        <label for="O1g_2" class="radio-label">Да</label>
                                    </span>
                                <? else : ?>
                                    <p class="form-group__control-static p-l-0"> <? if ($survey->unitO->O1[6] == 1) { echo 'Да'; } elseif ($survey->unitO->O1[6] == 0) { echo 'Нет'; } else { echo 'Не указано'; } ?> </p>
                                <? endif; ?>
                            </div>
                        </div>

                    <? endif; ?>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            h. Вакцинация за ПОСЛЕДНИЕ 5 ЛЕТ
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="O1h_1" name="O1h" type="radio" class="radio" value="0" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[7] == 0 ? 'checked' : ''; ?> >
                                    <label for="O1h_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="O1h_2" name="O1h" type="radio" class="radio" value="1" <?= $survey->unitO->O1 != NULL && $survey->unitO->O1[7] == 1 ? 'checked' : ''; ?> >
                                    <label for="O1h_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitO->O1[7] == 1) { echo 'Да'; } elseif ($survey->unitO->O1[7] == 0) { echo 'Нет'; } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        O2. Лечебные мероприятия и программы, назначенные или
                        пройденные пациентом за последние 3 дня (или со дня
                        последней оценки, если со времени ее проведения прошло
                        менее 3 дней)
                    </p>

                    <p class="col-xs-12 text-bold text-italic m-t-10 f-s-0_9">
                        Лечебные мероприятия
                    </p>

                    <div class="form-group">
                        <label for="O2a" class="form-group__label col-xs-12">
                            a. Химиотерапия
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) : ?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[0] ? 'selected' : '' ?> > <?= $option; ?> </option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[0] != -1 ? $O2[$survey->unitO->O2[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2b" class="form-group__label col-xs-12">
                            b. Диализ
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[1] != -1 ? $O2[$survey->unitO->O2[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2c" class="form-group__label col-xs-12">
                            c. Инфекционный контроль
                            <small class="text-italic text-normal">Например: карантин или изоляция.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[2] != -1 ? $O2[$survey->unitO->O2[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2d" class="form-group__label col-xs-12">
                            d. Внутривенное введение лекарств
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2d" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[3] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[3] != -1 ? $O2[$survey->unitO->O2[3]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2e" class="form-group__label col-xs-12">
                            e. Кислородная терапия
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2e" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[4] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[4] != -1 ? $O2[$survey->unitO->O2[4]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2f" class="form-group__label col-xs-12">
                            f. Радиационная терапия
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2f" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[5] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[5] != -1 ? $O2[$survey->unitO->O2[5]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2g" class="form-group__label col-xs-12">
                            g. Отсасывание жидкости
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2g" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[6] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[6] != -1 ? $O2[$survey->unitO->O2[6]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2h" class="form-group__label col-xs-12">
                            h. Уход после трахеостомии
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2h" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[7] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[7] != -1 ? $O2[$survey->unitO->O2[7]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2i" class="form-group__label col-xs-12">
                            i. Переливание
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2i" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[8] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[8] != -1 ? $O2[$survey->unitO->O2[8]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2j" class="form-group__label col-xs-12">
                            j. Вентилятор или респиратор
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2j" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[9] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[9] != -1 ? $O2[$survey->unitO->O2[9]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2k" class="form-group__label col-xs-12">
                            k. Уход за ранами
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2k" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[10] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[10] != -1 ? $O2[$survey->unitO->O2[10]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic m-t-10 f-s-0_9">
                        Программы
                    </p>

                    <div class="form-group">
                        <label for="O2l" class="form-group__label col-xs-12">
                            l. Программа-график туалетных процедур
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2l" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[11] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[11] != -1 ? $O2[$survey->unitO->O2[11]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2m" class="form-group__label col-xs-12">
                            m. Программа паллиативной терапии
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2m" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[12] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[12] != -1 ? $O2[$survey->unitO->O2[12]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O2n" class="form-group__label col-xs-12">
                            n. Программа переворачивания / перемены положения
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O2[]" id="O2n" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O2 != NULL && $key == $survey->unitO->O2[13] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O2 != NULL && $survey->unitO->O2[13] != -1 ? $O2[$survey->unitO->O2[13]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        O3. Терапия / сестринские услуги за последние 7 дней
                        <small class="text-italic text-normal">
                            <span class="m-b-5">Например: действия практического врача или ассистента под руководством врача. Примечание: учитывается только терапия, проводимая после поступления в данное медицинское учреждение</span>
                            <br> <span class="m-b-5"><b>A. Число дней</b> из ПОСЛЕДНИХ 7 ДНЕЙ, <b>на которые было назначено проведение лечебных мероприятий</b> [от 0 до 7]</span>
                            <br> <span class="m-b-5"><b>B. Число дней</b> из ПОСЛЕДНИХ 7 ДНЕЙ, <b>когда какие-либо лечебные мероприятия проводились дольше 15 минут</b> [от 0 до 7]</span>
                            <br> <span class="m-b-5"><b>C. Общее число минут, когда проводились лечебные мероприятия,</b>
                                                        за ПОСЛЕДНИЕ 7 ДНЕЙ (или число минут, на которые было назначено поведение лечебных мероприятий, если число дней проведения лечебных
                                                        мероприятий = 0 и число дней, на которые было назначено проведение лечебных мероприятий > 0) [от 0 до 999]</span>
                        </small>
                    </p>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            a. Лечебная физкультура
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3a_A" class="form-group__label m-0 p-5"> А </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3a_A" name="O3a[]" type="number" min="0" max="7" class="form-group__control" value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[0][0] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3a_B" class="form-group__label m-0 p-5"> B </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3a_B" name="O3a[]" type="number" min="0" max="7" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[0][1] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3a_C" class="form-group__label m-0 p-5"> C </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3a_C" name="O3a[]" type="number" min="0" max="999" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[0][2] : '-1' ?>">
                                        </div>
                                    </div>
                                </div>
                            <? else : ?>
                                <div class="form-group__control-static p-l-0">
                                    <div class="row">
                                        <p class="col-xs-12 col-sm-4">
                                            <b>A:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[0][0] != '-1' ? $survey->unitO->O3[0][0] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>B:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[0][1] != '-1' ? $survey->unitO->O3[0][1] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>C:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[0][2] != '-1' ? $survey->unitO->O3[0][2]  . ' мин.': 'Не указано' ?>
                                        </p>
                                    </div>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            b. Эрготерапия
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3b_A" class="form-group__label m-0 p-5"> А </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3b_A" name="O3b[]" type="number" min="0" max="7" class="form-group__control" value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[1][0] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3b_B" class="form-group__label m-0 p-5"> B </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3b_B" name="O3b[]" type="number" min="0" max="7" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[1][1] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3b_C" class="form-group__label m-0 p-5"> C </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3b_C" name="O3b[]" type="number" min="0" max="999" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[1][2] : '-1' ?>">
                                        </div>
                                    </div>
                                </div>
                            <? else : ?>
                                <div class="form-group__control-static p-l-0">
                                    <div class="row">
                                        <p class="col-xs-12 col-sm-4">
                                            <b>A:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[1][0] != '-1' ? $survey->unitO->O3[1][0] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>B:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[1][1] != '-1' ? $survey->unitO->O3[1][1] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>C:</b> <?= $survey->unitO->O3 != NULL && $survey->unitO->O3[1][2] != '-1' ? $survey->unitO->O3[1][2]  . ' мин.': 'Не указано' ?>
                                        </p>
                                    </div>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            c. Услуги в области языковых, речевых патологий и аудиологии
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3c_A" class="form-group__label m-0 p-5"> А </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3c_A" name="O3c[]" type="number" min="0" max="7" class="form-group__control" value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[2][0] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3c_B" class="form-group__label m-0 p-5"> B </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3c_B" name="O3c[]" type="number" min="0" max="7" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[2][1] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3c_C" class="form-group__label m-0 p-5"> C </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3c_C" name="O3c[]" type="number" min="0" max="999" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[2][2] : '-1' ?>">
                                        </div>
                                    </div>
                                </div>
                            <? else : ?>
                                <div class="form-group__control-static p-l-0">
                                    <div class="row">
                                        <p class="col-xs-12 col-sm-4">
                                            <b>A:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[2][0] != '-1' ? $survey->unitO->O3[2][0] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>B:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[2][1] != '-1' ? $survey->unitO->O3[2][1] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>C:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[2][2] != '-1' ? $survey->unitO->O3[2][2]  . ' мин.': 'Не указано' ?>
                                        </p>
                                    </div>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            d. Респираторная терапия
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3d_A" class="form-group__label m-0 p-5"> А </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3d_A" name="O3d[]" type="number" min="0" max="7" class="form-group__control" value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[3][0] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3d_B" class="form-group__label m-0 p-5"> B </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3d_B" name="O3d[]" type="number" min="0" max="7" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[3][1] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3d_C" class="form-group__label m-0 p-5"> C </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3d_C" name="O3d[]" type="number" min="0" max="999" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[3][2] : '-1' ?>">
                                        </div>
                                    </div>
                                </div>
                            <? else : ?>
                                <div class="form-group__control-static p-l-0">
                                    <div class="row">
                                        <p class="col-xs-12 col-sm-4">
                                            <b>A:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[3][0] != '-1' ? $survey->unitO->O3[3][0] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>B:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[3][1] != '-1' ? $survey->unitO->O3[3][1] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>C:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[3][2] != '-1' ? $survey->unitO->O3[3][2]  . ' мин.': 'Не указано' ?>
                                        </p>
                                    </div>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            e. Функциональная реабилитация или программа восстановления навыков ходьбы с лицензированной медсестрой
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3e_A" class="form-group__label m-0 p-5"> А </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3e_A" name="O3e[]" type="number" min="0" max="7" class="form-group__control" value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[4][0] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3e_B" class="form-group__label m-0 p-5"> B </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3e_B" name="O3e[]" type="number" min="0" max="7" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[4][1] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3e_C" class="form-group__label m-0 p-5"> C </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3e_C" name="O3e[]" type="number" min="0" max="999" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[4][2] : '-1' ?>">
                                        </div>
                                    </div>
                                </div>
                            <? else : ?>
                                <div class="form-group__control-static p-l-0">
                                    <div class="row">
                                        <p class="col-xs-12 col-sm-4">
                                            <b>A:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[4][0] != '-1' ? $survey->unitO->O3[4][0] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>B:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[4][1] != '-1' ? $survey->unitO->O3[4][1] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>C:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[4][2] != '-1' ? $survey->unitO->O3[4][2]  . ' мин.': 'Не указано' ?>
                                        </p>
                                    </div>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            f. Психологическая терапия (проводит специалист в области душевного здоровья)
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3f_A" class="form-group__label m-0 p-5"> А </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3f_A" name="O3f[]" type="number" min="0" max="7" class="form-group__control" value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[5][0] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3f_B" class="form-group__label m-0 p-5"> B </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3f_B" name="O3f[]" type="number" min="0" max="7" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[5][1] : '-1' ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 valign m-b-10">
                                        <label for="O3f_C" class="form-group__label m-0 p-5"> C </label>
                                        <div class="col-xs-12 p-l-0 p-r-0">
                                            <input id="O3f_C" name="O3f[]" type="number" min="0" max="999" class="form-group__control"  value="<?= $survey->unitO->O3 != NULL ? $survey->unitO->O3[5][2] : '-1' ?>">
                                        </div>
                                    </div>
                                </div>
                            <? else : ?>
                                <div class="form-group__control-static p-l-0">
                                    <div class="row">
                                        <p class="col-xs-12 col-sm-4">
                                            <b>A:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[5][0] != '-1' ? $survey->unitO->O3[5][0] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>B:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[5][1] != '-1' ? $survey->unitO->O3[5][1] . ' дн.' : 'Не указано' ?>
                                        </p>
                                        <p class="col-xs-12 col-sm-4">
                                            <b>C:</b> <?=$survey->unitO->O3 != NULL && $survey->unitO->O3[5][2] != '-1' ? $survey->unitO->O3[5][2]  . ' мин.': 'Не указано' ?>
                                        </p>
                                    </div>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        O4. Госпитализация и посещение отделений неотложной помощи
                        <small class="text-italic text-normal">
                            Введите число соответствующее числу раз госпитализации или посещений отделений неотложной помощи
                            за ПОСЛЕДНИЕ 90 ДНЕЙ (или со дня последней оценки, если со времени ее проведения прошло МЕНЕЕ 90 ДНЕЙ) [от 0 до 99]
                        </small>
                    </p>

                    <div class="form-group">
                        <label for="O4a" class="form-group__label col-xs-12">
                            a. Госпитализация в стационар (с оставлением на ночь) для получения неотложной помощи
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="O4a" name="O4[]" type="number" min="0" max="99" class="form-group__control" value="<?= $survey->unitO->O4 != NULL ? $survey->unitO->O4[0] : '-1' ?>">
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?=$survey->unitO->O4 != NULL && $survey->unitO->O4[0] != '-1' ? $survey->unitO->O4[0] . ' раз(а)' : 'Не указано' ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O4b" class="form-group__label col-xs-12">
                            b. Посещение отделения неотложной помощи (без оставления на ночь)
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="O4b" name="O4[]" type="number" min="0" max="99" class="form-group__control" value="<?= $survey->unitO->O4 != NULL ? $survey->unitO->O4[1] : '-1' ?>">
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?=$survey->unitO->O4 != NULL && $survey->unitO->O4[1] != '-1' ? $survey->unitO->O4[1] . ' раз(а)' : 'Не указано' ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label for="O5" class="form-group__label col-xs-12 f-s-1">
                            O5. Посещение терапевта
                            <small class="text-italic text-normal">
                                Число дней, когда пациента посещал терапевт, за ПОСЛЕДНИЕ 14 ДНЕЙ
                                (либо с момента последней оценки, если она проводилась менее 14 дней
                                назад). Сюда также входят имеющий соответствующий допуск помощник
                                врача или фельдшер / медсестра / скорая и неотложная помощь. Введите
                                «0», если посещений не было. [от 0 до 99]
                            </small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="O5" name="O5" type="number" min="0" max="99" class="form-group__control" value="<?= $survey->unitO->O5 != NULL ? $survey->unitO->O5 : '-1' ?>">
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?=$survey->unitO->O5 != NULL && $survey->unitO->O5 != '-1' ? $survey->unitO->O5 . ' дн.' : 'Не указано' ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label for="O6" class="form-group__label col-xs-12 f-s-1">
                            O6. Предписания терапевта
                            <small class="text-italic text-normal">
                                Число дней за ПОСЛЕДНИЕ 14 ДНЕЙ (либо с момента последней оценки, если
                                она проводилась менее 14 дней назад), когда терапевт менял назначения
                                пациента. Сюда также входят имеющий соответствующий допуск
                                помощник врача или фельдшер / медсестра /врач скорой и неотложной
                                помощи. Сюда не входят случаи продления назначений без внесения
                                изменений. Введите «0», если изменений не было. [от 0 до 99]
                            </small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="O6" name="O6" type="number" min="0" max="99" class="form-group__control" value="<?= $survey->unitO->O6 != NULL ? $survey->unitO->O6 : '-1' ?>">
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?=$survey->unitO->O6 != NULL && $survey->unitO->O6 != '-1' ? $survey->unitO->O6 . ' дн.' : 'Не указано' ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        O7. Ограничивающие устройства
                    </p>

                    <div class="form-group">
                        <label for="O7a" class="form-group__label col-xs-12">
                            a. Полные рамы со всех открытых сторон кровати
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O7[]" id="O7a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O7 as $key => $option) : ?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O7 != NULL && $key == $survey->unitO->O7[0] ? 'selected' : '' ?> > <?= $option; ?> </option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O7 != NULL && $survey->unitO->O7[0] != -1 ? $O7[$survey->unitO->O7[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O7b" class="form-group__label col-xs-12">
                            b. Обездвиживание тела
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O7[]" id="O7b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O7 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O7 != NULL && $key == $survey->unitO->O7[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O7 != NULL && $survey->unitO->O7[1] != -1 ? $O7[$survey->unitO->O7[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="O7c" class="form-group__label col-xs-12">
                            c. Удерживающие стулья
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="O7[]" id="O7c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($O7 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitO->O7 != NULL && $key == $survey->unitO->O7[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitO->O7 != NULL && $survey->unitO->O7[2] != -1 ? $O7[$survey->unitO->O7[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <button type="button" role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitO');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </div>

</form>