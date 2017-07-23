<?
    $C1 = Kohana::$config->load('Units.C.C1');
    $C2 = Kohana::$config->load('Units.C.C2');
    $C3 = Kohana::$config->load('Units.C.C3');
    $C5 = Kohana::$config->load('Units.C.C5');

    $survey->unitC->C2 = json_decode($survey->unitC->C2);
    $survey->unitC->C3 = json_decode($survey->unitC->C3);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitC" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Когнитивные способности
</h3>

<form class="row" id="unitC" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>
                    <div class="form-group">
                        <label for="C1" class="form-group__label col-xs-12">
                            Когнетивные способности в области принятия повседневных решений
                            <small class="text-italic text-normal">Принятие решений о каждодневных задачах (напр.: когда встать или пообедать, какую одежду надеть или чем заниматься)</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($C1 as $key => $value) :?>
                                    <p>
                                        <input id="C1<?= $key; ?>" name="C1" type="radio" class="radio" value="<?= $key; ?>" <?= !empty($survey->unitC->C1) && $key == $survey->unitC->C1 ? 'checked' : '' ?> >
                                        <label for="C1<?= $key; ?>" class="radio-label" onclick=" if (<?= $key; ?> === 5) document.getElementById('unitC_block').classList.add('hide'); else document.getElementById('unitC_block').classList.remove('hide'); "><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitC->C1) ? $C1[$survey->unitC->C1] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <div id="unitC_block" class="<?= $survey->unitC->C1 == 5 ? 'hide' : ''; ?>">
                    <fieldset>
                        <div class="form-group">
                            <p class="col-xs-12">
                                <span class="text-bold">Способность запоминать / вспоминать</span>
                            </p>


                            <div class="form-group">
                                <label for="C2a" class="form-group__label col-xs-12">
                                    Кратковременная память
                                    <small class="text-italic text-normal">Пациент может вспомнить информацию, полученную 5 минут назад</small>
                                </label>
                                <div class="col-xs-12">
                                    <? if ($can_conduct) : ?>
                                        <? foreach ($C2 as $key => $value) :?>
                                            <span class="m-r-20">
                                                <input id="C2a<?= $key; ?>" name="C2a" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitC->C2[0] != NULL && $key == $survey->unitC->C2[0] ? 'checked' : '' ?> >
                                                <label for="C2a<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                            </span>
                                        <? endforeach; ?>
                                    <? else : ?>
                                        <p class="form-group__control-static p-l-0"> <?= $survey->unitC->C2 != NULL && $survey->unitC->C2[0] != -1 ? $C2[$survey->unitC->C2[0]] : 'Не указано'; ?> </p>
                                    <? endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="C2b" class="form-group__label col-xs-12">
                                    Долговременная память
                                    <small class="text-italic text-normal">Пациент может вспомнить информацию, полученную в отдаленном прошлом</small>
                                </label>
                                <div class="col-xs-12">
                                    <? if ($can_conduct) : ?>
                                        <? foreach ($C2 as $key => $value) :?>
                                            <span class="m-r-20">
                                                <input id="C2b<?= $key; ?>" name="C2b" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitC->C2[1] != NULL && $key == $survey->unitC->C2[1] ? 'checked' : '' ?> >
                                                <label for="C2b<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                            </span>
                                        <? endforeach; ?>
                                    <? else : ?>
                                        <p class="form-group__control-static p-l-0"> <?= $survey->unitC->C2 != NULL && $survey->unitC->C2[1] != -1 ? $C2[$survey->unitC->C2[1]] : 'Не указано'; ?> </p>
                                    <? endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="C2c" class="form-group__label col-xs-12">
                                    Процедурная память
                                    <small class="text-italic text-normal">Пациент может выполнять все или почти все шаги многозадачной последовательности без подсказок</small>
                                </label>
                                <div class="col-xs-12">
                                    <? if ($can_conduct) : ?>
                                        <? foreach ($C2 as $key => $value) :?>
                                            <span class="m-r-20">
                                                <input id="C2c<?= $key; ?>" name="C2c" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitC->C2[2] != NULL && $key == $survey->unitC->C2[2] ? 'checked' : '' ?> >
                                                <label for="C2c<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                            </span>
                                        <? endforeach; ?>
                                    <? else : ?>
                                        <p class="form-group__control-static p-l-0"> <?= $survey->unitC->C2 != NULL && $survey->unitC->C2[2] != -1 ? $C2[$survey->unitC->C2[2]] : 'Не указано'; ?> </p>
                                    <? endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="C2d" class="form-group__label col-xs-12">
                                    Ситуационная память
                                    <small class="text-italic text-normal">Пациент одновременно узнает имена и лица представителей обслуживающего персонала, с которыми часто сталкивается, И помнит расположение регулярно посещаемых мест (например, спальни, столовой, комнаты для физических упражнений, процедурной комнаты)</small>
                                </label>
                                <div class="col-xs-12">
                                    <? if ($can_conduct) : ?>
                                        <? foreach ($C2 as $key => $value) :?>
                                            <span class="m-r-20">
                                                <input id="C2d<?= $key; ?>" name="C2d" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitC->C2[3] != NULL && $key == $survey->unitC->C2[3] ? 'checked' : '' ?> >
                                                <label for="C2d<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                            </span>
                                        <? endforeach; ?>
                                    <? else : ?>
                                        <p class="form-group__control-static p-l-0"> <?= $survey->unitC->C2 != NULL && $survey->unitC->C2[3] != -1 ? $C2[$survey->unitC->C2[3]] : 'Не указано'; ?> </p>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <p class="col-xs-12">
                            <span class="text-bold">Периоды беспорядочности мышления или спутанности сознания</span>
                            <small class="text-italic">Примечание: Для точной оценки необходимо побеседовать с персоналом, семьей и другими лицами, владеющими информацией о поведении пациента в течение соответствующего времени</small>
                        </p>

                        <div class="form-group">
                            <label for="C3a" class="form-group__label col-xs-12">
                                Легко отвлекается
                                <small class="text-italic text-normal">Например: имеют место эпизодические трудности с концентрацией внимания; пациент уходит от темы</small>
                            </label>
                            <div class="col-xs-12">
                                <? if ($can_conduct) : ?>
                                    <? foreach ($C3 as $key => $value) :?>
                                        <p>
                                            <input id="C3a<?= $key; ?>" name="C3a" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitC->C3[0] != NULL && $key == $survey->unitC->C3[0] ? 'checked' : '' ?> >
                                            <label for="C3a<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                        </p>
                                    <? endforeach; ?>
                                <? else : ?>
                                    <p class="form-group__control-static p-l-0"> <?= $survey->unitC->C3 != NULL && $survey->unitC->C3[0] != -1 ? $C3[$survey->unitC->C3[0]] : 'Не указано'; ?> </p>
                                <? endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="C3b" class="form-group__label col-xs-12">
                                Отмечены эпизоды беспорядочной речи
                                <small class="text-italic text-normal">Например: бессмысленная речь, пациент теряет нить рассуждения</small>
                            </label>
                            <div class="col-xs-12">
                                <? if ($can_conduct) : ?>
                                    <? foreach ($C3 as $key => $value) :?>
                                        <p>
                                            <input id="C3b<?= $key; ?>" name="C3b" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitC->C3 != NULL && $key == $survey->unitC->C3[1] ? 'checked' : '' ?> >
                                            <label for="C3b<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                        </p>
                                    <? endforeach; ?>
                                <? else : ?>
                                    <p class="form-group__control-static p-l-0"> <?= $survey->unitC->C3 != NULL && $survey->unitC->C3[1] != -1 ? $C3[$survey->unitC->C3[1]] : 'Не указано'; ?> </p>
                                <? endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="C3a" class="form-group__label col-xs-12">
                                Мыслительные способности меняются в течение дня
                                <small class="text-italic text-normal">Например: временами лучше, временами хуже</small>
                            </label>
                            <div class="col-xs-12">
                                <? if ($can_conduct) : ?>
                                    <? foreach ($C3 as $key => $value) :?>
                                        <p>
                                            <input id="C3c<?= $key; ?>" name="C3c" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitC->C3 != NULL && $key == $survey->unitC->C3[2] ? 'checked' : '' ?> >
                                            <label for="C3c<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                        </p>
                                    <? endforeach; ?>
                                <? else : ?>
                                    <p class="form-group__control-static p-l-0"> <?= $survey->unitC->C3 != NULL && $survey->unitC->C3[2] != -1 ? $C3[$survey->unitC->C3[2]] : 'Не указано'; ?> </p>
                                <? endif; ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="C4" class="form-group__label col-xs-12">
                                Острое изменение состояния мыслительных способностей пациента по сравнению с его обычным состоянием
                                <small class="text-italic text-normal">Например: возбужденное состояние, заторможенность, трудности при пробуждении или неадекватное восприятие окружающей действительности</small>
                            </label>
                            <div class="col-xs-12">
                                <? if ($can_conduct) : ?>
                                    <span>
                                        <input id="C4_1" name="C4" type="radio" class="radio" value="1" <?= $survey->unitC->C4 != NULL && $survey->unitC->C4 == 1 ? 'checked' : '' ?>>
                                        <label for="C4_1" class="radio-label">Да</label>
                                    </span>
                                    <span class="m-l-20">
                                        <input id="C4_2" name="C4" type="radio" class="radio" value="0" <?= $survey->unitC->C4 != NULL && $survey->unitC->C4 == 0 ? 'checked' : '' ?>>
                                        <label for="C4_2" class="radio-label">Нет</label>
                                    </span>
                                <? else : ?>
                                    <p class="form-group__control-static p-l-0"> <? if ($survey->unitC->C4 != NULL) { if ($survey->unitC->C4 == 1) { echo 'Да'; } elseif ($survey->unitC->C4 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                                <? endif; ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="C5" class="form-group__label col-xs-12">
                                Динамика способности пациента к принятию решений за последние 90 дней
                                <small class="text-italic text-normal">Или за меньший срок, если последняя оценка проводилась меньше, чем 90 дней назад</small>
                            </label>
                            <div class="col-xs-12">
                                <? if ($can_conduct) : ?>
                                    <? foreach ($C5 as $key => $value) :?>
                                        <p>
                                            <input id="C5b<?= $key; ?>" name="C5" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitC->C5 != NULL && $key == $survey->unitC->C5 ? 'checked' : '' ?> >
                                            <label for="C5b<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                        </p>
                                    <? endforeach; ?>
                                <? else : ?>
                                    <p class="form-group__control-static p-l-0"> <?= $survey->unitC->C5 != NULL && $survey->unitC->C5 != -1 ? $C5[$survey->unitC->C5] : 'Не указано'; ?> </p>
                                <? endif; ?>
                            </div>
                        </div>
                    </fieldset>
                </div>

            </div>

            <? if ($can_conduct) : ?>
                <a role="button" class="form__submit text-center text-brand text-bold" onclick="survey.send.updateunit('unitC');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>