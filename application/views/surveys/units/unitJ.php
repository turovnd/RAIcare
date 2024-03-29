<?
    $J1 = Kohana::$config->load('Units.J.J1');
    $J3 = Kohana::$config->load('Units.J.J3');
    $J4 = Kohana::$config->load('Units.J.J4');
    $J5 = Kohana::$config->load('Units.J.J5');
    $J6a = Kohana::$config->load('Units.J.J6a');
    $J6b = Kohana::$config->load('Units.J.J6b');
    $J6c = Kohana::$config->load('Units.J.J6c');
    $J6e = Kohana::$config->load('Units.J.J6e');
    $J8 = Kohana::$config->load('Units.J.J8');
    $J9a = Kohana::$config->load('Units.J.J9a');
    $J9b = Kohana::$config->load('Units.J.J9b');

    $survey->unitJ->J3 = json_decode($survey->unitJ->J3);
    $survey->unitJ->J6 = json_decode($survey->unitJ->J6);
    $survey->unitJ->J7 = json_decode($survey->unitJ->J7);
    $survey->unitJ->J9 = json_decode($survey->unitJ->J9);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitJ" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    РАЗДЕЛ J. Нарушения состояния здоровья
</h3>

<form class="row" id="unitJ" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <div class="form-group">
                        <p class="col-xs-12 text-bold">
                            J1. Падения
                        </p>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($J1 as $key => $value) : ?>
                                    <p>
                                        <input id="J1<?= $key; ?>" name="J1" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitJ->J1 != NULL && $key == $survey->unitJ->J1 ? 'checked' : ''; ?> >
                                        <label for="J1<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J1 != NULL ? $J1[$survey->unitJ->J1] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <? if (empty($survey->unitB)) : ?>

                    <fieldset>

                        <div class="form-group">
                            <p class="col-xs-12 text-bold">
                                J2. Недавние падения
                            </p>
                            <div class="col-xs-12">
                                <? if ($can_conduct) : ?>
                                    <span>
                                        <input id="J2_1" name="J2" type="radio" class="radio" value="0" <?= $survey->unitJ->J2 != NULL && $survey->unitJ->J2 == 0 ? 'checked' : '' ?> >
                                        <label for="J2_1" class="radio-label">Нет</label>
                                    </span>
                                    <span class="m-l-20">
                                        <input id="J2_2" name="J2" type="radio" class="radio" value="1" <?= $survey->unitJ->J2 != NULL && $survey->unitJ->J2 == 1 ? 'checked' : '' ?> >
                                        <label for="J2_2" class="radio-label">Да</label>
                                    </span>
                                <? else : ?>
                                    <p class="form-group__control-static p-l-0"> <? if ($survey->unitJ->J2 != NULL) { if ($survey->unitJ->J2 == 1) { echo 'Да'; } elseif ($survey->unitJ->J2 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                                <? endif; ?>
                            </div>
                        </div>

                    </fieldset>

                <? endif; ?>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        J3. Частота возникновения проблем
                    </p>
                    <p class="col-xs-12 text-bold text-italic m-t-10 f-s-0_9">
                        Равновесие
                    </p>
                    <div class="form-group">
                        <label for="J3a" class="form-group__label col-xs-12">
                            a. Неспособность привести себя в вертикальное положение без посторонней помощи или затруднения при этом действии
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) : ?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[0] ? 'selected' : '' ?> > <?= $option; ?> </option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[0] != -1 ? $J3[$survey->unitJ->J3[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3b" class="form-group__label col-xs-12">
                            b. Неспособность развернуться и встать в противоположном направлении или затруднения при этом действии
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[1] != -1 ? $J3[$survey->unitJ->J3[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3c" class="form-group__label col-xs-12">
                            c. Головокружение
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[2] != -1 ? $J3[$survey->unitJ->J3[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3d" class="form-group__label col-xs-12">
                            d. Неверная походка
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3d" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[3] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[3] != -1 ? $J3[$survey->unitJ->J3[3]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic m-t-10 f-s-0_9">
                        Сердечные или легочные нарушения
                    </p>
                    <div class="form-group">
                        <label for="J3e" class="form-group__label col-xs-12">
                            e. Боль в груди
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3e" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[4] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[4] != -1 ? $J3[$survey->unitJ->J3[4]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3f" class="form-group__label col-xs-12">
                            f. Трудности при удалении выделений дыхательных путей
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3f" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[5] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[5] != -1 ? $J3[$survey->unitJ->J3[5]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic m-t-10 f-s-0_9">
                        Психиатрические нарушения
                    </p>
                    <div class="form-group">
                        <label for="J3g" class="form-group__label col-xs-12">
                            g. Аномальный процесс мышления
                            <small class="text-italic text-normal">Например: беспорядочный поток ассоциаций,
                                блокирование мыслей, вихрь идей, тангенциальность мышления, излишняя
                                детализация, ассоциация слов по звуковому сходству, бессвязная речь, неологизмы,
                                каламбуры</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3g" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[6] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[6] != -1 ? $J3[$survey->unitJ->J3[6]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3h" class="form-group__label col-xs-12">
                            h. Бредовые идеи - стойкие ложные представления
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3h" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[7] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[7] != -1 ? $J3[$survey->unitJ->J3[7]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3i" class="form-group__label col-xs-12">
                            i. Галлюцинации - ложные сенсорные восприятия
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3i" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[8] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[8] != -1 ? $J3[$survey->unitJ->J3[8]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic m-t-10 f-s-0_9">
                        Неврологические нарушения
                    </p>
                    <div class="form-group">
                        <label for="J3j" class="form-group__label col-xs-12">
                            j. Афазия
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3j" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[9] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[9] != -1 ? $J3[$survey->unitJ->J3[9]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic m-t-10 f-s-0_9">
                        Состояние желудочно-кишечного тракта
                    </p>
                    <div class="form-group">
                        <label for="J3k" class="form-group__label col-xs-12">
                            k. Кислотный рефлюкс - регургитация кислоты из желудка в глотку
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3k" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[10] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[10] != -1 ? $J3[$survey->unitJ->J3[10]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3l" class="form-group__label col-xs-12">
                            l. Запор
                            <small class="text-italic text-normal">Отсутствие дефекации на протяжении 3 дней или тяжелая проходимость твердого стула.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3l" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[11] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[11] != -1 ? $J3[$survey->unitJ->J3[11]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3m" class="form-group__label col-xs-12">
                            m. Диарея
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3m" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[12] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[12] != -1 ? $J3[$survey->unitJ->J3[12]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3n" class="form-group__label col-xs-12">
                            n. Рвота
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3n" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[13] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[13] != -1 ? $J3[$survey->unitJ->J3[13]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic m-t-10 f-s-0_9">
                        Проблемы со сном
                    </p>
                    <div class="form-group">
                        <label for="J3o" class="form-group__label col-xs-12">
                            o. Трудности с засыпанием или сном
                            <small class="text-italic text-normal">Слишком раннее пробуждение / возбужденное состояние / беспокойный сон.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3o" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[14] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[14] != -1 ? $J3[$survey->unitJ->J3[14]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3p" class="form-group__label col-xs-12">
                            p. Слишком долгий сон
                            <small class="text-italic text-normal">Избыточная длительность сна, которая влияет на нормальное функционирование резидента.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3p" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[15] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[15] != -1 ? $J3[$survey->unitJ->J3[15]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic m-t-10 f-s-0_9">
                        Другое
                    </p>
                    <div class="form-group">
                        <label for="J3q" class="form-group__label col-xs-12">
                            q. Аспирация
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3q" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[16] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[16] != -1 ? $J3[$survey->unitJ->J3[16]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3r" class="form-group__label col-xs-12">
                            r. Жар
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3r" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[17] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[17] != -1 ? $J3[$survey->unitJ->J3[17]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3s" class="form-group__label col-xs-12">
                            s. Желудочно-кишечное или урогенитальное кровотечение
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3s" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[18] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[18] != -1 ? $J3[$survey->unitJ->J3[18]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3t" class="form-group__label col-xs-12">
                            t. Проблемы с гигиеной
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3t" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[19] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[19] != -1 ? $J3[$survey->unitJ->J3[19]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J3u" class="form-group__label col-xs-12">
                            u. Периферический отек
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J3[]" id="J3u" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J3 != NULL && $key == $survey->unitJ->J3[20] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J3 != NULL && $survey->unitJ->J3[20] != -1 ? $J3[$survey->unitJ->J3[20]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label for="J4" class="form-group__label col-xs-12 f-s-1">
                            J4. Одышка (затрудненное дыхание)
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($J4 as $key => $value) :?>
                                    <p>
                                        <input id="J4<?= $key; ?>" name="J4" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitJ->J4 != NULL && $key == $survey->unitJ->J4 ? 'checked' : ''; ?> >
                                        <label for="J4<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J4 != NULL ? $J4[$survey->unitJ->J4] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label for="J5" class="form-group__label col-xs-12 f-s-1">
                            J5. Утомляемость
                            <small class="text-italic text-normal">Неспособность выполнять обычные задачи - например: в рамках повседневной деятельности</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($J5 as $key => $value) : ?>
                                    <p>
                                        <input id="J5<?= $key; ?>" name="J5" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitJ->J5 != NULL && $key == $survey->unitJ->J5 ? 'checked' : ''; ?> >
                                        <label for="J5<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J5 != NULL ? $J5[$survey->unitJ->J5] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        J6. Болевые симптомы
                        <small class="text-italic text-normal">Примечание: Всегда спрашивайте резидента о частоте и интенсивности
                            боли, а также об обезболивании. Наблюдайте за резидентом и задавайте
                            вопросы лицам, контактирующим с резидентом.</small>
                    </p>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            a. Частота, с которой резидент жалуется на боль или демонстрирует ее
                            <small class="text-italic text-normal">В т.ч. гримасами, сжатием зубов, стоном, отшатыванием при касании или иными невербальными знаками, говорящими о боли, а также сторонится прикосновений</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($J6a as $key => $value) : ?>
                                    <p>
                                        <input id="J6a<?= $key; ?>" name="J6a" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitJ->J6 != NULL && $key == $survey->unitJ->J6[0] ? 'checked' : ''; ?> >
                                        <label for="J6a<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J6 != NULL && $survey->unitJ->J6[0] != -1 ? $J6a[$survey->unitJ->J6[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            b. Самый высокий уровень интенсивности испытываемой боли
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($J6b as $key => $value) : ?>
                                    <p>
                                        <input id="J6b<?= $key; ?>" name="J6b" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitJ->J6 != NULL && $key == $survey->unitJ->J6[1] ? 'checked' : ''; ?> >
                                        <label for="J6b<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J6 != NULL && $survey->unitJ->J6[1] != -1 ? $J6b[$survey->unitJ->J6[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            c. Устойчивость боли - частота боли
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($J6c as $key => $value) : ?>
                                    <p>
                                        <input id="J6с<?= $key; ?>" name="J6c" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitJ->J6 != NULL && $key == $survey->unitJ->J6[2] ? 'checked' : ''; ?> >
                                        <label for="J6с<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J6 != NULL && $survey->unitJ->J6[2] != -1 ? $J6c[$survey->unitJ->J6[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            d. Прорыв боли
                            <small class="text-italic text-normal">В течение ПОСЛЕДНИХ 3 ДНЕЙ резидент испытал один или несколько внезапных резких приступов боли</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="J6d_1" name="J6d" type="radio" class="radio" value="0" <?= $survey->unitJ->J6 != NULL && $survey->unitJ->J6[3] == 0 ? 'checked' : ''; ?> >
                                    <label for="J6d_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="J6d_2" name="J6d" type="radio" class="radio" value="1" <?= $survey->unitJ->J6 != NULL && $survey->unitJ->J6[3] == 1 ? 'checked' : ''; ?> >
                                    <label for="J6d_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J6 != NULL ? $survey->unitJ->J6[3] == 0 ? "Нет" : $survey->unitJ->J6[3] == 1 ? "Да" : 'Не указано' : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            e. Управление болью (болеутоление)
                            <small class="text-italic text-normal">Адекватность текущего лечебного режима в области болеутоления (с точки зрения резидента)</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($J6e as $key => $value) : ?>
                                    <p>
                                        <input id="J6e<?= $key; ?>" name="J6e" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitJ->J6 != NULL && $key == $survey->unitJ->J6[4] ? 'checked' : ''; ?> >
                                        <label for="J6e<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J6 != NULL && $survey->unitJ->J6[4] != -1 ? $J6e[$survey->unitJ->J6[4]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>


                <fieldset>

                    <p class="col-xs-12 text-bold">
                        J7. Нестабильность в состоянии здоровья
                    </p>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            a. Нарушения состояния здоровья / заболевания проводят к нестабильности
                            (колебаниям, неустойчивости или ухудшению) когнитивной деятельности,
                            повседневной деятельности, настроения или поведения резидента
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="J7a_1" name="J7a" type="radio" class="radio" value="0" <?= $survey->unitJ->J7 != NULL && $survey->unitJ->J7[0] == 0 ? 'checked' : ''; ?> >
                                    <label for="J7a_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="J7a_2" name="J7a" type="radio" class="radio" value="1" <?= $survey->unitJ->J7 != NULL && $survey->unitJ->J7[0] == 1 ? 'checked' : ''; ?> >
                                    <label for="J7a_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitJ->J7 != NULL) { if ($survey->unitJ->J7[0] == 1) { echo 'Да'; } elseif ($survey->unitJ->J7[0] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            b. Острый эпизод рецидивирующей или хронической проблемы со здоровьем
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="J7b_1" name="J7b" type="radio" class="radio" value="0" <?= $survey->unitJ->J7 != NULL && $survey->unitJ->J7[1] == 0 ? 'checked' : ''; ?> >
                                    <label for="J7b_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="J7b_2" name="J7b" type="radio" class="radio" value="1" <?= $survey->unitJ->J7 != NULL && $survey->unitJ->J7[1] == 1 ? 'checked' : ''; ?> >
                                    <label for="J7b_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitJ->J7 != NULL) { if ($survey->unitJ->J7[1] == 1) { echo 'Да'; } elseif ($survey->unitJ->J7[1] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            c. Заболевание в терминальной стадии, резиденту осталось жить 6 месяцев или менее
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="J7c_1" name="J7c" type="radio" class="radio" value="0" <?= $survey->unitJ->J7 != NULL && $survey->unitJ->J7[2] == 0 ? 'checked' : ''; ?> >
                                    <label for="J7c_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="J7c_2" name="J7c" type="radio" class="radio" value="1" <?= $survey->unitJ->J7 != NULL && $survey->unitJ->J7[2] == 1 ? 'checked' : ''; ?> >
                                    <label for="J7c_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitJ->J7 != NULL) { if ($survey->unitJ->J7[2] == 1) { echo 'Да'; } elseif ($survey->unitJ->J7[2] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label for="J8" class="form-group__label col-xs-12 f-s-1">
                            J8. Оценка резидентом своего состояния здоровья
                            <small class="text-italic text-normal">Задайте резиденту общий вопрос: "Как бы вы оценили свое состояние здоровья в целом?"</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J8" id="J8" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J8 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J8 != NULL && $key == $survey->unitJ->J8 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J8 != NULL && $survey->unitJ->J8 != -1 ? $J8[$survey->unitJ->J8] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        J9. Табак и алкоголь
                    </p>

                    <div class="form-group">
                        <label for="J9a" class="form-group__label col-xs-12">
                            a. Резидент курит табак ежедневно
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J9[]" id="J9a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J9a as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J9 != NULL && $key == $survey->unitJ->J9[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J9 != NULL && $survey->unitJ->J9[0] != -1 ? $J9a[$survey->unitJ->J9[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="J9b" class="form-group__label col-xs-12">
                            b. Алкоголь
                            <small class="text-italic text-normal">Наибольшее число доз (дринков), выпитых за один раз за ПОСЛЕДНИЕ 14 ДНЕЙ</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="J9[]" id="J9b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($J9b as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitJ->J9 != NULL && $key == $survey->unitJ->J9[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitJ->J9 != NULL && $survey->unitJ->J9[1] != -1 ? $J9b[$survey->unitJ->J9[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>


            </div>

            <? if ($can_conduct) : ?>
                <button type="button" role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitJ');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </div>

</form>