<?
    $I1 = Kohana::$config->load('Units.I.I1');

    $survey->unitI->I1 = json_decode($survey->unitI->I1);
    $survey->unitI->I2 = json_decode($survey->unitI->I2);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitI" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Диагнозы
</h3>

<form class="row" id="unitI" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Диагнозы
                    </p>
                    <p class="col-xs-12 text-bold text-italic">
                        Заболевания костно-мышечной системы
                    </p>

                    <div class="form-group">
                        <label for="I1a" class="form-group__label col-xs-12">
                            Перелом бедренной или тазовой кости в течение последних 30 дней
                            <small class="text-italic text-normal">Или с момента последней оценки, если она проводилась менее чем 30 дней назад.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[0] != -1 ? $I1[$survey->unitI->I1[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1b" class="form-group__label col-xs-12">
                            Другие переломы в течение последних 30 дней
                            <small class="text-italic text-normal">Или с момента последней оценки, если она проводилась менее чем 30 дней назад.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[1] != -1 ? $I1[$survey->unitI->I1[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic">
                        Неврологические заболевания
                    </p>

                    <div class="form-group">
                        <label for="I1c" class="form-group__label col-xs-12">
                            Болезнь Альцгеймера
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[2] != -1 ? $I1[$survey->unitI->I1[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1d" class="form-group__label col-xs-12">
                            Иной, нежели болезнь Альцгецмера, вид деменции
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1d" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[3] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[3] != -1 ? $I1[$survey->unitI->I1[3]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1e" class="form-group__label col-xs-12">
                            Односторонний паралич
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1e" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[4] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[4] != -1 ? $I1[$survey->unitI->I1[4]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1f" class="form-group__label col-xs-12">
                            Рассеянный склероз
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1f" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[5] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[5] != -1 ? $I1[$survey->unitI->I1[5]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1g" class="form-group__label col-xs-12">
                            Параплегия
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1g" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[6] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[6] != -1 ? $I1[$survey->unitI->I1[6]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1h" class="form-group__label col-xs-12">
                            Болезнь Паркинсона
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1h" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[7] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[7] != -1 ? $I1[$survey->unitI->I1[7]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1i" class="form-group__label col-xs-12">
                            Квадриплегия
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1i" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[8] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[8] != -1 ? $I1[$survey->unitI->I1[8]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1j" class="form-group__label col-xs-12">
                            Инсульт / острое нарушение мозгового кровообращения
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1j" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[9] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[9] != -1 ? $I1[$survey->unitI->I1[9]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic">
                        Кардиологические или пульмонологические заболевания
                    </p>

                    <div class="form-group">
                        <label for="I1k" class="form-group__label col-xs-12">
                            Ишемическая болезнь сердца
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1k" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[10] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[10] != -1 ? $I1[$survey->unitI->I1[10]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1l" class="form-group__label col-xs-12">
                            Хроническое обструктивное заболевание легких
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1l" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[11] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[11] != -1 ? $I1[$survey->unitI->I1[11]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1m" class="form-group__label col-xs-12">
                            Застойная сердечная недостаточность
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1m" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[12] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[12] != -1 ? $I1[$survey->unitI->I1[12]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic">
                        Психиатрические заболевания
                    </p>

                    <div class="form-group">
                        <label for="I1n" class="form-group__label col-xs-12">
                            Тревожность
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1n" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[13] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[13] != -1 ? $I1[$survey->unitI->I1[13]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1o" class="form-group__label col-xs-12">
                            Биполярное расстройство
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1o" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[14] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[14] != -1 ? $I1[$survey->unitI->I1[14]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1p" class="form-group__label col-xs-12">
                            Депрессия
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1p" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[15] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[15] != -1 ? $I1[$survey->unitI->I1[15]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1q" class="form-group__label col-xs-12">
                            Шизофрения
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1q" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[16] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[16] != -1 ? $I1[$survey->unitI->I1[16]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic">
                        Инфекции
                    </p>

                    <div class="form-group">
                        <label for="I1r" class="form-group__label col-xs-12">
                            Пневмония
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1r" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[17] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[17] != -1 ? $I1[$survey->unitI->I1[17]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1s" class="form-group__label col-xs-12">
                            Инфекции мочевыводящих путей за последние 30 дней
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1s" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[18] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[18] != -1 ? $I1[$survey->unitI->I1[18]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <p class="col-xs-12 text-bold text-italic">
                        Иные общие или серьезные заболевания
                    </p>

                    <div class="form-group">
                        <label for="I1t" class="form-group__label col-xs-12">
                            Рак
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1t" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[19] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[19] != -1 ? $I1[$survey->unitI->I1[19]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="I1u" class="form-group__label col-xs-12">
                            Сахарный диабет
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="I1[]" id="I1u" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($I1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitI->I1 != NULL && $key == $survey->unitI->I1[20] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitI->I1 != NULL && $survey->unitI->I1[20] != -1 ? $I1[$survey->unitI->I1[20]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label for="I2" class="form-group__label col-xs-12">
                            Другие диагнозы
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select class="form-group__control" name="I2[]" id="I2" multiple>
                                    <? if ($survey->unitI->I2 != NULL && $survey->unitI->I2 != "[]") : ?>
                                        <? foreach ($survey->unitI->I2 as $key) :?>
                                            <? $mkb10 = new Model_MKB10($key); ?>
                                            <option value="<?=$key; ?>" selected><?=$mkb10->name . ' (' . $mkb10->code . ')'; ?></option>
                                        <? endforeach; ?>
                                    <? endif; ?>
                                </select>
                            <? else : ?>
                                <div class="form-group__control-static p-l-0">
                                    <? if ($survey->unitI->I2 == NULL) : ?>
                                        Не указано
                                    <? else : ?>
                                    <ol class="p-l-20">
                                        <? foreach ($survey->unitI->I2 as $key) : ?>
                                            <? $mkb10 = new Model_MKB10($key); ?>
                                            <li><?= $mkb10->name . ' (' . $mkb10->code . ')'; ?></li>
                                        <? endforeach; ?>
                                    </ol>
                                    <? endif; ?>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a type="button" role="button" class="form__submit text-center text-brand text-bold" onclick="survey.send.updateunit('unitI');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>
