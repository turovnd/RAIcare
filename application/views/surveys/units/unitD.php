<?
    $D1 = Kohana::$config->load('Units.D.D1');
    $D2 = Kohana::$config->load('Units.D.D2');
    $D3 = Kohana::$config->load('Units.D.D3');
    $D4 = Kohana::$config->load('Units.D.D4');

    $survey->unitD->D3 = json_decode($survey->unitD->D3);
    $survey->unitD->D4 = json_decode($survey->unitD->D4);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitD" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Коммуникация и зрение
</h3>

<form class="row" id="unitD" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>
                    <div class="form-group">
                        <label for="D1" class="form-group__label col-xs-12">
                            Способность доносить сообщения (Передача информации)
                            <small class="text-italic text-normal">Способность выражать информационные сообщения - вербальные и невербальные</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($D1 as $key => $value) :?>
                                    <p>
                                        <input id="D1<?= $key; ?>" name="D1" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitD->D1 != NULL && $key == $survey->unitD->D1 ? 'checked' : '' ?> >
                                        <label for="D1<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitD->D1 != NULL ? $D1[$survey->unitD->D1] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="D2" class="form-group__label col-xs-12">
                            Способность понимать окружающих (Восприятие информации)
                            <small class="text-italic text-normal">Способность пациента распознавать вербальную информацию (сообщенную пациенту любым способом; при включенном слуховом аппарате, если он используется)</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($D2 as $key => $value) : ?>
                                    <p>
                                        <input id="D2<?= $key; ?>" name="D2" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitD->D2 != NULL && $key == $survey->unitD->D2 ? 'checked' : '' ?>>
                                        <label for="D2<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach;?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitD->D2 != NULL ? $D2[$survey->unitD->D2] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <p class="col-xs-12 text-bold">
                        Восприятие на слух
                    </p>
                    <div class="form-group">
                        <label for="D3a" class="form-group__label col-xs-12">
                            Способность слышать
                            <small class="text-italic text-normal">С помощью вспомогательных устройств, если они используются</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($D3 as $key => $value) : ?>
                                    <p>
                                        <input id="D3a<?= $key; ?>" name="D3a" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitD->D3 != NULL && $key == $survey->unitD->D3[0] ? 'checked' : '' ?>>
                                        <label for="D3a<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach;?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitD->D3 != NULL && $survey->unitD->D3[0] != -1 ? $D3[$survey->unitD->D3[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="D3b" class="form-group__label col-xs-12">
                            Использование слухового аппарата
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="D3b_1" name="D3b" type="radio" class="radio" value="1" <?= $survey->unitD->D3 != NULL && $survey->unitD->D3[1] == 1 ? 'checked' : '' ?>>
                                    <label for="D3b_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="D3b_2" name="D3b" type="radio" class="radio" value="0" <?= $survey->unitD->D3 != NULL  && $survey->unitD->D3[1] == 0 ? 'checked' : '' ?>>
                                    <label for="D3b_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitD->D3 != NULL) { if ($survey->unitD->D3[1] == 1) { echo 'Да'; } elseif ($survey->unitD->D3[1] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <p class="col-xs-12 text-bold">
                        Зрение
                    </p>
                    <div class="form-group">
                        <label for="D4a" class="form-group__label col-xs-12">
                            Способность видеть при адекватном освещении
                            <small class="text-italic text-normal">В очках или с помощью других оптических приборов, которыми обычно пользуется пациент</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($D4 as $key => $value) : ?>
                                    <p>
                                        <input id="D4a<?= $key; ?>" name="D4a" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitD->D4 != NULL && $key == $survey->unitD->D4[0] ? 'checked' : '' ?>>
                                        <label for="D4a<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach;?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitD->D4 != NULL && $survey->unitD->D4[0] != -1 ? $D4[$survey->unitD->D4[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="D3b" class="form-group__label col-xs-12">
                            Используется приспособление для корректировки зрения
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="D4b_1" name="D4b" type="radio" class="radio" value="1" <?= $survey->unitD->D4 != NULL && $survey->unitD->D4[1] == 1 ? 'checked' : '' ?>>
                                    <label for="D4b_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="D4b_2" name="D4b" type="radio" class="radio" value="0" <?= $survey->unitD->D4 != NULL && $survey->unitD->D4[1] == 0 ? 'checked' : '' ?>>
                                    <label for="D4b_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitD->D4 != NULL) { if ($survey->unitD->D4[1] == 1) { echo 'Да'; } elseif ($survey->unitD->D4[1] == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a role="button" class="form__submit text-center text-brand text-bold" onclick="survey.send.updateunit('unitD');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>