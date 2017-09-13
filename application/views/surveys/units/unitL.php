<?
    $L1 = Kohana::$config->load('Units.L.L1');
    $L7 = Kohana::$config->load('Units.L.L7');
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitL" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    РАЗДЕЛ L. Состояние кожи
</h3>

<form class="row" id="unitL" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <div class="form-group">
                        <label for="L1" class="form-group__label col-xs-12 f-s-1">
                            L1. Самые тяжелые пролежни
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="L1" id="L1" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($L1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitL->L1 != NULL && $key == $survey->unitL->L1? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitL->L1 != NULL && $survey->unitL->L1 != -1 ? $L1[$survey->unitL->L1] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12 f-s-1">
                            L2. Наличие пролежней в прошлом
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="L2_1" name="L2" type="radio" class="radio" value="0" <?= $survey->unitL->L2 != NULL && $survey->unitL->L2 == 0 ? 'checked' : '' ?> >
                                    <label for="L2_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="L2_2" name="L2" type="radio" class="radio" value="1" <?= $survey->unitL->L2 != NULL && $survey->unitL->L2 == 1 ? 'checked' : '' ?> >
                                    <label for="L2_1" class="radio-label">Да</label>
                                </span>
                            <? else: ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitL->L2 != NULL) { if ($survey->unitL->L2 == 1) { echo 'Да'; } elseif ($survey->unitL->L2 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12 f-s-1">
                            L3. Наличие иных кожных язв, помимо пролежней
                            <small class="text-italic text-normal">Например: венозных язв,
                            артериальных язв, смешанных венозно-артериальных язв или язвы диабетической
                            стопы.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="L3_1" name="L3" type="radio" class="radio" value="0" <?= $survey->unitL->L3 != NULL && $survey->unitL->L3 == 0 ? 'checked' : '' ?> >
                                    <label for="L3_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="L3_2" name="L3" type="radio" class="radio" value="1" <?= $survey->unitL->L3 != NULL && $survey->unitL->L3 == 1 ? 'checked' : '' ?> >
                                    <label for="L3_2" class="radio-label">Да</label>
                                </span>
                            <? else: ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitL->L3 != NULL) { if ($survey->unitL->L3 == 1) { echo 'Да'; } elseif ($survey->unitL->L3 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12 f-s-1">
                            L4. Значительные проблемы с кожей
                            <small class="text-italic text-normal">Например: поражения, ожоги второй и третьей
                                степени, а также заживающие послеоперационные раны.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="L4_1" name="L4" type="radio" class="radio" value="0" <?= $survey->unitL->L4 != NULL && $survey->unitL->L4 == 0 ? 'checked' : '' ?> >
                                    <label for="L4_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="L4_2" name="L4" type="radio" class="radio" value="1" <?= $survey->unitL->L4 != NULL && $survey->unitL->L4 == 1 ? 'checked' : '' ?> >
                                    <label for="L4_2" class="radio-label">Да</label>
                                </span>
                            <? else: ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitL->L4 != NULL) { if ($survey->unitL->L4 == 1) { echo 'Да'; } elseif ($survey->unitL->L4 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12 f-s-1">
                            L5. Разрывы или порезы кожи
                            <small class="text-italic text-normal">Кроме хирургических разрезов.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="L5_1" name="L5" type="radio" class="radio" value="0" <?= $survey->unitL->L5 != NULL && $survey->unitL->L5 == 0 ? 'checked' : '' ?> >
                                    <label for="L5_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="L5_2" name="L5" type="radio" class="radio" value="1" <?= $survey->unitL->L5 != NULL && $survey->unitL->L5 == 1 ? 'checked' : '' ?> >
                                    <label for="L5_2" class="radio-label">Да</label>
                                </span>
                            <? else: ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitL->L5 != NULL) { if ($survey->unitL->L5 == 1) { echo 'Да'; } elseif ($survey->unitL->L5 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12 f-s-1">
                            L6. Другте патологические состояния кожи или изменения в состоянии кожи
                            <small class="text-italic text-normal">Например: гематомы, высыпания, чесотка, пятнистое поражение кожи,
                                опоясывающий герпес, опрелости или экзема.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="L6_1" name="L6" type="radio" class="radio" value="0" <?= $survey->unitL->L6 != NULL && $survey->unitL->L6 == 0 ? 'checked' : '' ?> >
                                    <label for="L6_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="L6_2" name="L6" type="radio" class="radio" value="1" <?= $survey->unitL->L6 != NULL && $survey->unitL->L6 == 1 ? 'checked' : '' ?> >
                                    <label for="L6_2" class="radio-label">Да</label>
                                </span>
                            <? else: ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitL->L6 != NULL) { if ($survey->unitL->L6 == 1) { echo 'Да'; } elseif ($survey->unitL->L6 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label for="L7" class="form-group__label col-xs-12 f-s-1">
                            L7. Проблемы со ступнями
                            <small class="text-italic text-normal">Например: бурсит большого пальца, молоткообразное
                            искривление пальца ноги, суперпозиция пальцев, структурные проблемы,
                            инфекции и язвы.</small>
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="L7" id="L7" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($L7 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitL->L7 != NULL && $key == $survey->unitL->L7? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitL->L7 != NULL && $survey->unitL->L7 != -1 ? $L7[$survey->unitL->L7] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <button type="button" role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitL');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </div>

</form>