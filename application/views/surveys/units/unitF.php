<?
    $F1 = Kohana::$config->load('Units.F.F1');
    $F2 = Kohana::$config->load('Units.F.F2');
    $F3 = Kohana::$config->load('Units.F.F3');
    $F5 = Kohana::$config->load('Units.F.F5');

    $survey->unitF->F1 = json_decode($survey->unitF->F1);
    $survey->unitF->F2 = json_decode($survey->unitF->F2);
    $survey->unitF->F3 = json_decode($survey->unitF->F3);
    $survey->unitF->F5 = json_decode($survey->unitF->F5);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitF" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    РАЗДЕЛ F. Психосоциальное благополучие
</h3>

<form class="row" id="unitF" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        F1. Социальные взаимоотношения
                        <small class="text-italic text-normal">Примечание: При возможности задавайте вопросы пациенту, сотрудникам, осуществляющим непосредственный уход за пациентом, и членам его семьи.</small>
                    </p>

                    <div class="form-group">
                        <label for="F1a" class="form-group__label col-xs-12">
                            a. Участие в социальных мероприятиях, представляющих устойчивый интерес
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F1[]" id="F1a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F1) && $key == $survey->unitF->F1[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F1) && $survey->unitF->F1[0] != -1 ? $F1[$survey->unitF->F1[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F1b" class="form-group__label col-xs-12">
                            b. Личное общение со старым знакомым или членом семьи
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F1[]" id="F1b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F1) && $key == $survey->unitF->F1[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F1) && $survey->unitF->F1[1] != -1 ? $F1[$survey->unitF->F1[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F1c" class="form-group__label col-xs-12">
                            c. Иное взаимодействие со старым знакомым или членом семьи
                            <small class="text-italic text-normal">Например: по телефону или по электронной почте</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F1[]" id="F1c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F1) && $key == $survey->unitF->F1[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F1) && $survey->unitF->F1[2] != -1 ? $F1[$survey->unitF->F1[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        F2. Чувство вовлеченности
                    </p>

                    <div class="form-group">
                        <label for="F2a" class="form-group__label col-xs-12">
                            a. Легко взаимодействует с окружающими
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F2[]" id="F2a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F2) && $key == $survey->unitF->F2[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F2) && $survey->unitF->F2[0] != -1 ? $F2[$survey->unitF->F2[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F2b" class="form-group__label col-xs-12">
                            b. Легко участвует в спланированных или организованных мероприятиях
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F2[]" id="F2b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F2) && $key == $survey->unitF->F2[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F2) && $survey->unitF->F2[1] != -1 ? $F2[$survey->unitF->F2[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F2c" class="form-group__label col-xs-12">
                            c. Принимает приглашения на большинство групповых мероприятий
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F2[]" id="F2c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F2) && $key == $survey->unitF->F2[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F2) && $survey->unitF->F2[2] != -1 ? $F2[$survey->unitF->F2[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F2d" class="form-group__label col-xs-12">
                            d. Стремится участвовать в жизни учреждения
                            <small class="text-normal">Например: заводит друзей и поддерживает дружеские отношения, участвует в групповых мероприятиях, позитивно реагирует на новые мероприятия, помогает в проведении религиозных служб.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F2[]" id="F2d" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F2) && $key == $survey->unitF->F2[3] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F2) && $survey->unitF->F2[3] != -1 ? $F2[$survey->unitF->F2[3]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F2e" class="form-group__label col-xs-12">
                            e. Инициирует взаимодействие с окружающими
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F2[]" id="F2e" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F2) && $key == $survey->unitF->F2[4] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F2) && $survey->unitF->F2[4] != -1 ? $F2[$survey->unitF->F2[4]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F2f" class="form-group__label col-xs-12">
                            f. Положительно реагирует на предложения окружающих о взаимодействии
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F2[]" id="F2f" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F2) && $key == $survey->unitF->F2[5] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F2) && $survey->unitF->F2[5] != -1 ? $F2[$survey->unitF->F2[5]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F2g" class="form-group__label col-xs-12">
                            g. Принимает приглашения на большинство групповых мероприятий
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F2[]" id="F2g" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F2) && $key == $survey->unitF->F2[6] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F2) && $survey->unitF->F2[6] != -1 ? $F2[$survey->unitF->F2[6]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        F3. Неурегулированные взаимоотношения
                    </p>

                    <div class="form-group">
                        <label for="F3a" class="form-group__label col-xs-12">
                            a. Конфликт или повторяющаяся критика других получателей медицинского ухода
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F3[]" id="F3a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F3) && $key == $survey->unitF->F3[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F3) && $survey->unitF->F3[0] != -1 ? $F3[$survey->unitF->F3[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F3b" class="form-group__label col-xs-12">
                            b. Конфликт или повторяющаяся критика персонала
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F3[]" id="F3b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F3) && $key == $survey->unitF->F3[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F3) && $survey->unitF->F3[1] != -1 ? $F3[$survey->unitF->F3[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F3c" class="form-group__label col-xs-12">
                            c. Персонал сообщает о стойком чувстве стресса при взаимодействии с пациентом
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F3[]" id="F3c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F3) && $key == $survey->unitF->F3[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F3) && $survey->unitF->F3[2] != -1 ? $F3[$survey->unitF->F3[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F3d" class="form-group__label col-xs-12">
                            d. Члены семьи или близкие друзья сообщают, что они подавлены болезнью пациента
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F3[]" id="F3d" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F3) && $key == $survey->unitF->F3[3] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F3) && $survey->unitF->F3[3] != -1 ? $F3[$survey->unitF->F3[3]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F3e" class="form-group__label col-xs-12">
                            e. Пациент говорит или показывает, что чувствует себя одиноко
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F3[]" id="F3e" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F3) && $key == $survey->unitF->F3[4] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F3) && $survey->unitF->F3[4] != -1 ? $F3[$survey->unitF->F3[4]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label for="F4" class="form-group__label col-xs-12 f-s-1">
                            F4. Источники сильного стресса за последние 90 дней
                            <small class="text-italic text-normal">Например: серьезная болезнь пациента, смерть или серьезная болезнь члена семьи или друга, потеря дома пациентом, значительная потеря дохода или активов, совершение в отношении пациента преступления (ограбления или нападения), потеря водительских прав или машины пациента.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F4" id="F4" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <option value="0" <?= $survey->unitF->F4 != NULL && $survey->unitF->F4 == 0 ? 'selected' : '' ?>>Нет</option>
                                    <option value="1" <?= $survey->unitF->F4 != NULL && $survey->unitF->F4 == 1 ? 'selected' : '' ?>>Да</option>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitF->F4 != NULL) { if ($survey->unitF->F4 == 1) { echo 'Да'; } elseif ($survey->unitF->F4 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        F5. Сильные стороны пациента
                    </p>

                    <div class="form-group">
                        <label for="F5a" class="form-group__label col-xs-12">
                            a. Устойчивое позитивное мироощущение
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F5[]" id="F5a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F5 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F5) && $key == $survey->unitF->F5[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F5) && $survey->unitF->F5[0] != -1 ? $F5[$survey->unitF->F5[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F5b" class="form-group__label col-xs-12">
                            b. Пациент видит смысл в своей повседневной жизни
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F5[]" id="F5b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F5 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F5) && $key == $survey->unitF->F5[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F5) && $survey->unitF->F5[1] != -1 ? $F5[$survey->unitF->F5[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="F5c" class="form-group__label col-xs-12">
                            c. Сильная связь с семьей и поддержка со стороны семьи
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="F5[]" id="F5c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($F5 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitF->F5) && $key == $survey->unitF->F5[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitF->F5) && $survey->unitF->F5[2] != -1 ? $F5[$survey->unitF->F5[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <button role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitF');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </div>

</form>