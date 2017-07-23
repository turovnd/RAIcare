<?
    $K3 = Kohana::$config->load('Units.K.K3');
    $K4 = Kohana::$config->load('Units.K.K4');

    $survey->unitK->K1 = json_decode($survey->unitK->K1);
    $survey->unitK->K2 = json_decode($survey->unitK->K2);
    $survey->unitK->K5 = json_decode($survey->unitK->K5);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitK" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Вопросы питания и состояние ротовой области
</h3>

<form class="row" id="unitK" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Рост и вес
                        <small class="text-italic text-normal">Запишите рост в сантиметрах (a) и вес в килограммах (b). Основывайтесь на самых свежих данных за ПОСЛЕДНИЕ 30 ДНЕЙ.</small>
                    </p>

                    <div class="form-group">
                        <label for="K1a" class="form-group__label col-xs-12">
                            Рост (в см)
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="K1a" name="K1a" type="number" class="form-group__control" value="<?= $survey->unitK->K1 != NULL ? $survey->unitK->K1[0] : '-1'; ?>" min="100" max="500">
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitK->K1 != NULL && $survey->unitK->K1[1] != -1 ?  $survey->unitK->K1[0] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="K1b" class="form-group__label col-xs-12">
                            Вес (в кг)
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="K1b" name="K1b" type="number" class="form-group__control" value="<?= $survey->unitK->K1 != NULL ? $survey->unitK->K1[1] : '-1'; ?>" min="10" max="300">
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitK->K1 != NULL && $survey->unitK->K1[1] != -1 ? $survey->unitK->K1[1] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Проблемы питания
                    </p>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Потеря веса в 5% или более за ПОСЛЕДНИЕ 30 ДНЕЙ или 10% или более за ПОСЛЕДНИЕ 180 ДНЕЙ
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="K2a_1" name="K2a" type="radio" class="radio" value="1" <?= $survey->unitK->K2 != NULL && $survey->unitK->K2[0] == 1 ? 'checked' : '' ?> >
                                    <label for="K2a_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="K2a_2" name="K2a" type="radio" class="radio" value="0" <?= $survey->unitK->K2 != NULL && $survey->unitK->K2[0] == 0 ? 'checked' : '' ?> >
                                    <label for="K2a_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitK->K2 != NULL) { if ($survey->unitK->K2[0] == 1) { echo 'Да'; } elseif ($survey->unitK->K2[0] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Обезвоживание или соотношение АМК/креатинин > 25
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="K2b_1" name="K2b" type="radio" class="radio" value="1" <?= $survey->unitK->K2 != NULL && $survey->unitK->K2[1] == 1 ? 'checked' : '' ?> >
                                    <label for="K2b_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="K2b_2" name="K2b" type="radio" class="radio" value="0" <?= $survey->unitK->K2 != NULL && $survey->unitK->K2[1] == 0 ? 'checked' : '' ?> >
                                    <label for="K2b_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitK->K2 != NULL) { if ($survey->unitK->K2[1] == 1) { echo 'Да'; } elseif ($survey->unitK->K2[1] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Прием жидкости в объеме менее 1000 см3 в день
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="K2c_1" name="K2c" type="radio" class="radio" value="1" <?= $survey->unitK->K2 != NULL && $survey->unitK->K2[2] == 1 ? 'checked' : '' ?> >
                                    <label for="K2c_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="K2c_2" name="K2c" type="radio" class="radio" value="0" <?= $survey->unitK->K2 != NULL && $survey->unitK->K2[2] == 0 ? 'checked' : '' ?> >
                                    <label for="K2c_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitK->K2 != NULL) { if ($survey->unitK->K2[2] == 1) { echo 'Да'; } elseif ($survey->unitK->K2[2] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Объем выведенной жидкости превышает объем принятой жидкости
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="K2d_1" name="K2d" type="radio" class="radio" value="1" <?= $survey->unitK->K2 != NULL && $survey->unitK->K2[3] == 1 ? 'checked' : '' ?> >
                                    <label for="K2d_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="K2d_2" name="K2d" type="radio" class="radio" value="0" <?= $survey->unitK->K2 != NULL && $survey->unitK->K2[3] == 0 ? 'checked' : '' ?> >
                                    <label for="K2d_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitK->K2 != NULL) { if ($survey->unitK->K2[3] == 1) { echo 'Да'; } elseif ($survey->unitK->K2[3] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <p class="col-xs-12 text-bold">
                            Способ приема пищи
                        </p>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($K3 as $key => $value) :?>
                                    <p>
                                        <input id="K3<?= $key; ?>" name="K3" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitK->K3 != NULL && $key == $survey->unitK->K3 ? 'checked' : '' ?> >
                                        <label for="K3<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitK->K3 != NULL ? $K3[$survey->unitK->K3] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <p class="col-xs-12 text-bold">
                            Парентеральный или энтеральный прием
                            <small class="text-italic text-normal">Соотношение ОБЩЕГО ЧИСЛА калорий, полученных парентерально или через зонд, за ПОСЛЕДНИЕ 3 ДНЯ</small>
                        </p>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($K4 as $key => $value) :?>
                                    <p>
                                        <input id="K4<?= $key; ?>" name="K4" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitK->K4 != NULL && $key == $survey->unitK->K4 ? 'checked' : '' ?> >
                                        <label for="K4<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitK->K4 != NULL ? $K4[$survey->unitK->K4] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Проблемы с зубами или ротовой полостью
                    </p>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Пациент носит «вставные зубы» (съемный протез)
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="K5a_1" name="K5a" type="radio" class="radio" value="1" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[0] == 1 ? 'checked' : '' ?> >
                                    <label for="K5a_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="K5a_2" name="K5a" type="radio" class="radio" value="0" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[0] == 0 ? 'checked' : '' ?> >
                                    <label for="K5a_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitK->K5 != NULL) { if ($survey->unitK->K5[0] == 1) { echo 'Да'; } elseif ($survey->unitK->K5[0] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Свои (естественные) зубы пациента сломаны, фрагментированы, шатаются или иным образом повреждены
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="K5b_1" name="K5b" type="radio" class="radio" value="1" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[1] == 1 ? 'checked' : '' ?> >
                                    <label for="K5b_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="K5b_2" name="K5b" type="radio" class="radio" value="0" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[1] == 0 ? 'checked' : '' ?> >
                                    <label for="K5b_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitK->K5 != NULL) { if ($survey->unitK->K5[1] == 1) { echo 'Да'; } elseif ($survey->unitK->K5[1] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Пациент сообщает о боли/дискомфорте в области лица или ротовой полости
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="K5c_1" name="K5c" type="radio" class="radio" value="1" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[2] == 1 ? 'checked' : '' ?> >
                                    <label for="K5c_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="K5c_2" name="K5c" type="radio" class="radio" value="0" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[2] == 0 ? 'checked' : '' ?> >
                                    <label for="K5c_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitK->K5 != NULL) { if ($survey->unitK->K5[2] == 1) { echo 'Да'; } elseif ($survey->unitK->K5[2] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Пациент сообщает о сухости во рту
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="K5d_1" name="K5d" type="radio" class="radio" value="1" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[3] == 1 ? 'checked' : '' ?> >
                                    <label for="K5d_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="K5d_2" name="K5d" type="radio" class="radio" value="0" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[3] == 0 ? 'checked' : '' ?> >
                                    <label for="K5d_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitK->K5 != NULL) { if ($survey->unitK->K5[3] == 1) { echo 'Да'; } elseif ($survey->unitK->K5[3] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Пациент сообщает о трудностях при жевании
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="K5e_1" name="K5e" type="radio" class="radio" value="1" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[4] == 1 ? 'checked' : '' ?> >
                                    <label for="K5e_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="K5e_2" name="K5e" type="radio" class="radio" value="0" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[4] == 0 ? 'checked' : '' ?> >
                                    <label for="K5e_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitK->K5 != NULL) { if ($survey->unitK->K5[4] == 1) { echo 'Да'; } elseif ($survey->unitK->K5[4] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            У пациента воспаление или кровотечение десен (мягких тканей),
                            расположенных в непосредственной близости от естественных зубов или их
                            фрагментов
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="K5f_1" name="K5f" type="radio" class="radio" value="1" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[5] == 1 ? 'checked' : '' ?> >
                                    <label for="K5f_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="K5f_2" name="K5f" type="radio" class="radio" value="0" <?= $survey->unitK->K5 != NULL && $survey->unitK->K5[5] == 0 ? 'checked' : '' ?> >
                                    <label for="K5f_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitK->K5 != NULL) { if ($survey->unitK->K5[5] == 1) { echo 'Да'; } elseif ($survey->unitK->K5[5] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a type="button" role="button" class="form__submit text-center text-brand text-bold" onclick="survey.send.updateunit('unitK');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>