<?
$survey->unitP->P1 = json_decode($survey->unitP->P1);
$survey->unitP->P2 = json_decode($survey->unitP->P2);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitP" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Правовая ответственность и распоряжения
</h3>

<form class="row" id="unitP" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Правовая ответственность / законный опекун
                    </p>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Законный опекун
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="P1a_1" name="P1a" type="radio" class="radio" value="1" <?= $survey->unitP->P1 != NULL && $survey->unitP->P1[0] == 1 ? 'checked' : '' ?> >
                                    <label for="P1a_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="P1a_2" name="P1a" type="radio" class="radio" value="0" <?= $survey->unitP->P1 != NULL && $survey->unitP->P1[0] == 0 ? 'checked' : '' ?> >
                                    <label for="P1a_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitP->P1 != NULL) { if ($survey->unitP->P1[0] == 1) { echo 'Да'; } elseif ($survey->unitP->P1[0] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Иные формы правового надзора
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="P1b_1" name="P1b" type="radio" class="radio" value="1" <?= $survey->unitP->P1 != NULL && $survey->unitP->P1[1] == 1 ? 'checked' : '' ?> >
                                    <label for="P1b_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="P1b_2" name="P1b" type="radio" class="radio" value="0" <?= $survey->unitP->P1 != NULL && $survey->unitP->P1[1] == 0 ? 'checked' : '' ?> >
                                    <label for="P1b_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitP->P1 != NULL) { if ($survey->unitP->P1[1] == 1) { echo 'Да'; } elseif ($survey->unitP->P1[1] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Долгосрочная доверенность на медицинский уход
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="P1c_1" name="P1c" type="radio" class="radio" value="1" <?= $survey->unitP->P1 != NULL && $survey->unitP->P1[2] == 1 ? 'checked' : '' ?> >
                                    <label for="P1c_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="P1c_2" name="P1c" type="radio" class="radio" value="0" <?= $survey->unitP->P1 != NULL && $survey->unitP->P1[2] == 0 ? 'checked' : '' ?> >
                                    <label for="P1c_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitP->P1 != NULL) { if ($survey->unitP->P1[2] == 1) { echo 'Да'; } elseif ($survey->unitP->P1[2] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Долгосрочная доверенность на финансовые операции
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="P1d_1" name="P1d" type="radio" class="radio" value="1" <?= $survey->unitP->P1 != NULL && $survey->unitP->P1[3] == 1 ? 'checked' : '' ?> >
                                    <label for="P1d_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="P1d_2" name="P1d" type="radio" class="radio" value="0" <?= $survey->unitP->P1 != NULL && $survey->unitP->P1[3] == 0 ? 'checked' : '' ?> >
                                    <label for="P1d_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitP->P1 != NULL) { if ($survey->unitP->P1[3] == 1) { echo 'Да'; } elseif ($survey->unitP->P1[3] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Ответственный член семьи
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="P1e_1" name="P1e" type="radio" class="radio" value="1" <?= $survey->unitP->P1 != NULL && $survey->unitP->P1[4] == 1 ? 'checked' : '' ?> >
                                    <label for="P1e_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="P1e_2" name="P1e" type="radio" class="radio" value="0" <?= $survey->unitP->P1 != NULL && $survey->unitP->P1[4] == 0 ? 'checked' : '' ?> >
                                    <label for="P1e_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitP->P1 != NULL) { if ($survey->unitP->P1[4] == 1) { echo 'Да'; } elseif ($survey->unitP->P1[4] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Заблаговременные распоряжения
                    </p>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Законный опекун
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="P2a_1" name="P2a" type="radio" class="radio" value="1" <?= $survey->unitP->P2 != NULL && $survey->unitP->P2[0] == 1 ? 'checked' : '' ?> >
                                    <label for="P2a_1" class="radio-label">Представлены</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="P2a_2" name="P2a" type="radio" class="radio" value="0" <?= $survey->unitP->P2 != NULL && $survey->unitP->P2[0] == 0 ? 'checked' : '' ?> >
                                    <label for="P2a_2" class="radio-label">Не предствлены</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitP->P2 != NULL) { if ($survey->unitP->P2[0] == 1) { echo 'Представлены'; } elseif ($survey->unitP->P2[0] == 0) { echo 'Не предствлены'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Иные формы правового надзора
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="P2b_1" name="P2b" type="radio" class="radio" value="1" <?= $survey->unitP->P2 != NULL && $survey->unitP->P2[1] == 1 ? 'checked' : '' ?> >
                                    <label for="P2b_1" class="radio-label">Представлены</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="P2b_2" name="P2b" type="radio" class="radio" value="0" <?= $survey->unitP->P2 != NULL && $survey->unitP->P2[1] == 0 ? 'checked' : '' ?> >
                                    <label for="P2b_2" class="radio-label">Не предствлены</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitP->P2 != NULL) { if ($survey->unitP->P2[1] == 1) { echo 'Представлены'; } elseif ($survey->unitP->P2[1] == 0) { echo 'Не предствлены'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Долгосрочная доверенность на медицинский уход
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="P2c_1" name="P2c" type="radio" class="radio" value="1" <?= $survey->unitP->P2 != NULL && $survey->unitP->P2[2] == 1 ? 'checked' : '' ?> >
                                    <label for="P2c_1" class="radio-label">Представлены</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="P2c_2" name="P2c" type="radio" class="radio" value="0" <?= $survey->unitP->P2 != NULL && $survey->unitP->P2[2] == 0 ? 'checked' : '' ?> >
                                    <label for="P2c_2" class="radio-label">Не предствлены</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitP->P2 != NULL) { if ($survey->unitP->P2[2] == 1) { echo 'Представлены'; } elseif ($survey->unitP->P2[2] == 0) { echo 'Не предствлены'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Долгосрочная доверенность на финансовые операции
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="P2d_1" name="P2d" type="radio" class="radio" value="1" <?= $survey->unitP->P2 != NULL && $survey->unitP->P2[3] == 1 ? 'checked' : '' ?> >
                                    <label for="P2d_1" class="radio-label">Представлены</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="P2d_2" name="P2d" type="radio" class="radio" value="0" <?= $survey->unitP->P2 != NULL && $survey->unitP->P2[3] == 0 ? 'checked' : '' ?> >
                                    <label for="P2d_2" class="radio-label">Не предствлены</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitP->P2 != NULL) { if ($survey->unitP->P2[3] == 1) { echo 'Представлены'; } elseif ($survey->unitP->P2[3] == 0) { echo 'Не предствлены'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Ответственный член семьи
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="P2e_1" name="P2e" type="radio" class="radio" value="1" <?= $survey->unitP->P2 != NULL && $survey->unitP->P2[4] == 1 ? 'checked' : '' ?> >
                                    <label for="P2e_1" class="radio-label">Представлены</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="P2e_2" name="P2e" type="radio" class="radio" value="0" <?= $survey->unitP->P2 != NULL && $survey->unitP->P2[4] == 0 ? 'checked' : '' ?> >
                                    <label for="P2e_2" class="radio-label">Не предствлены</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitP->P2 != NULL) { if ($survey->unitP->P2[4] == 1) { echo 'Представлены'; } elseif ($survey->unitP->P2[4] == 0) { echo 'Не предствлены'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a type="button" role="button" class="form__submit text-center text-brand text-bold" onclick="survey.send.updateunit('unitP');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>