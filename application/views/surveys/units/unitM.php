<?
    $M1 = Kohana::$config->load('Units.M.M1');
    $M2 = Kohana::$config->load('Units.M.M2');
    $M3 = Kohana::$config->load('Units.M.M3');

    $survey->unitM->M2 = json_decode($survey->unitM->M2);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitM" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Досуг
</h3>

<form class="row" id="unitM" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <div class="form-group">
                        <label for="M1" class="form-group__label col-xs-12">
                            Средняя длительность участия в колективной деятельности
                            <small class="text-italic text-normal">Например: самостоятельной или групповой. Примечание: когда пациент бодрствует и не
                            получает уход в области повседневной деятельности.</small>
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M1" id="M1" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M1 != NULL && $key == $survey->unitM->M1? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M1 != NULL && $survey->unitM->M1 != -1 ? $M1[$survey->unitM->M1] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Предпочитаемая и осуществляемая деятельность (в рамках текущих возможностей)
                    </p>

                    <div class="form-group">
                        <label for="M2a" class="form-group__label col-xs-12">
                            Карты, игры или головоломки
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2a" id="M2a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[0] != -1 ? $M2[$survey->unitM->M2[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2b" class="form-group__label col-xs-12">
                            Занятия за компьютером
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2b" id="M2b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[1] != -1 ? $M2[$survey->unitM->M2[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2c" class="form-group__label col-xs-12">
                            Беседа или телефонный разговор
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2c" id="M2c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[2] != -1 ? $M2[$survey->unitM->M2[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2d" class="form-group__label col-xs-12">
                            Ремесла или искусства
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2d" id="M2d" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[3] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[3] != -1 ? $M2[$survey->unitM->M2[3]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2e" class="form-group__label col-xs-12">
                            Танцы
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2e" id="M2e" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[4] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[4] != -1 ? $M2[$survey->unitM->M2[4]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2f" class="form-group__label col-xs-12">
                            Обсуждения / воспоминания о жизни
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2f" id="M2f" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[5] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[5] != -1 ? $M2[$survey->unitM->M2[5]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2g" class="form-group__label col-xs-12">
                            Упражнения или спорт
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2g" id="M2g" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[6] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[6] != -1 ? $M2[$survey->unitM->M2[6]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2h" class="form-group__label col-xs-12">
                            Садоводство или уход за растениями
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2h" id="M2h" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[7] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[7] != -1 ? $M2[$survey->unitM->M2[7]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2i" class="form-group__label col-xs-12">
                            Помощь другим людям
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2i" id="M2i" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[8] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[8] != -1 ? $M2[$survey->unitM->M2[8]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2j" class="form-group__label col-xs-12">
                            Музыка или пение
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2j" id="M2j" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[9] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[9] != -1 ? $M2[$survey->unitM->M2[9]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2k" class="form-group__label col-xs-12">
                            Домашние животные
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2k" id="M2k" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[10] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[10] != -1 ? $M2[$survey->unitM->M2[10]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2l" class="form-group__label col-xs-12">
                            Чтение, письмо или решение кроссвордов
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2l" id="M2l" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[11] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[11] != -1 ? $M2[$survey->unitM->M2[11]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2m" class="form-group__label col-xs-12">
                            Духовные или религиозные мероприятия
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2m" id="M2m" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[12] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[12] != -1 ? $M2[$survey->unitM->M2[12]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2n" class="form-group__label col-xs-12">
                            Поездки или покупки
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2n" id="M2n" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[13] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[13] != -1 ? $M2[$survey->unitM->M2[13]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2o" class="form-group__label col-xs-12">
                            Пешеходные прогулки или прогулки в инвалидной коляске
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2o" id="M2o" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[14] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[14] != -1 ? $M2[$survey->unitM->M2[14]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="M2p" class="form-group__label col-xs-12">
                            Просмотр телевизионных или прослушивание радиопередач
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M2p" id="M2p" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M2 != NULL && $key == $survey->unitM->M2[15] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M2 != NULL && $survey->unitM->M2[15] != -1 ? $M2[$survey->unitM->M2[15]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label for="M3" class="form-group__label col-xs-12">
                            Длительность дневного сна
                        </label>

                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="M3" id="M3" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($M3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitM->M3 != NULL && $key == $survey->unitM->M3? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitM->M3 != NULL && $survey->unitM->M3 != -1 ? $M3[$survey->unitM->M3] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a type="button" role="button" class="form__submit text-center text-brand text-bold" onclick="survey.send.updateunit('unitM');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>