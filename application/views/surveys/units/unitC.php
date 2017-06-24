<?
$C1 = array(
    '0' => 'Не зависит от окружающих - решения пациента были непротиворечивыми, разумными и безопасными',
    '1' => 'Условно не зависит от окружающих - некоторые трудности при принятии решений в необычных ситуациях',
    '2' => 'Минимальная зависимость - в определенных повторяющихся ситуациях принимались нерациональные или небезопасные решения, и в это время пациенту требовались подсказки или присмотр',
    '3' => 'Средняя зависимость - пациент регулярно принимал неразумные или небезопасные решения, требовались напоминания, подсказки или присмотр',
    '4' => 'Значительная зависимость - пациент никогда не принимал решений или принимал их редко',
    '5' => 'Нет признаков сознания, кома [Перейдите к "Функциональное состояние"]'
);
$C2 = array(
    'a' => 'Кратковременная память в порядке - пациент может вспомнить информацию, полученную 5 минут назад',
    'b' => 'Долговременная память в порядке - пациент может вспомнить информацию, полученную в отдаленном прошлом',
    'c' => 'Процедурная память в порядке - пациент может выполнять все или почти все шаги многозадачной последовательности без подсказок',
    'd' => 'Ситуационная память в порядке - пациент одновременно узнает имена и лица представителей обслуживающего персонала, с которыми часто сталкивается, И помнит расположение регулярно посещаемых мест (например, спальни, столовой, комнаты для физических упражнений, процедурной комнаты)'
);
$C2_get = json_decode($survey->unitC->C2);
$C3 = array(
    '0' => 'Характерные поведенческие проявления отсутствуют',
    '1' => 'Характерные поведенческие проявления присутствуют и соответствуют обычным параметрам когнитивной деятельности пациента',
    '2' => 'Характерные поведенческие проявления присутствуют и не соответствуют обычным параметрам когнитивной деятельности пациента (например: новое проявление заболевания или ухудшение состояния по сравнению с состоянием несколькими неделями раньше)',
);
$C5 = array(
    '0' => 'Улучшилась',
    '1' => 'Не изменилась',
    '2' => 'Ухудшилась',
    '8' => 'Невозможно дать определенный ответ',
);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitC" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Когнитивные способности
</h3>

<form class="row" id="unitC">

    <div class="col-xs-12">

        <div class="block">

            <div class="block__body">

                <fieldset>
                    <div class="form-group">
                        <label for="C1" class="form-group__label col-xs-12">
                            Когнетивные способности в области принятия повседневных решений
                            <small class="text-normal">Принятие решений о каждодневных задачах (напр.: когда встать или пообедать, какую одежду надеть или чем заниматься)</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($C1 as $key => $value) :?>
                                    <p>
                                        <input id="C1<?= $key; ?>" name="C1" type="radio" class="checkbox" value="<?= $key; ?>" <?= !empty($survey->unitC->C1) && $key == $survey->unitC->C1 ? 'checked' : '' ?> >
                                        <label for="C1<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitC->C1) ? $C1[$survey->unitC->C1] : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="C2" class="form-group__label col-xs-12">
                            Способность запоминать / вспоминать
                            <small class="text-normal">Не отмечено - память в порядке. Отмечено - проблемы с памятью.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($C2 as $key => $value) : ?>
                                    <p>
                                        <input id="C2<?= $key; ?>" name="C2[]" type="checkbox" class="checkbox" value="<?= $key; ?>" <?= !empty($C2_get) && in_array($key, $C2_get) ? 'checked' : '' ?>>
                                        <label for="C2<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach;?>
                            <? else : ?>
                                <ol class="form-group__control-static p-l-20">
                                    <? if (!empty($C2_get)) : foreach ($C2_get as $item) : ?>
                                        <li><?= $C2[$item]; ?></li>
                                    <? endforeach; endif; ?>
                                </ol>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <p class="col-xs-12">
                        <span class="text-bold">Периоды беспорядочности мышления или спутанности сознания</span>
                        <small>[Примечание: Для точной оценки необходимо побеседовать с персоналом, семьей и другими лицами, владеющими информацией о поведении пациента в течение соответствующего времени]</small>
                    </p>

                    <div class="form-group">
                        <label for="C3a" class="form-group__label col-xs-12">
                            Легко отвлекается
                            <small class="text-normal">Например: имеют место эпизодические трудности с концентрацией внимания; пациент уходит от темы</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($C3 as $key => $value) :?>
                                    <p>
                                        <input id="C3a<?= $key; ?>" name="C3a" type="radio" class="checkbox" value="<?= $key; ?>" <?= !empty($survey->unitC->C3a) && $key == $survey->unitC->C3a ? 'checked' : '' ?> >
                                        <label for="C3a<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitC->C3a) ? $C3[$survey->unitC->C3a] : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="C3b" class="form-group__label col-xs-12">
                            Отмечены эпизоды беспорядочной речи
                            <small class="text-normal">Например: бессмысленная речь, пациент теряет нить рассуждения</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($C3 as $key => $value) :?>
                                    <p>
                                        <input id="C3b<?= $key; ?>" name="C3b" type="radio" class="checkbox" value="<?= $key; ?>" <?= !empty($survey->unitC->C3b) && $key == $survey->unitC->C3b ? 'checked' : '' ?> >
                                        <label for="C3b<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitC->C3b) ? $C3[$survey->unitC->C3b] : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="C3a" class="form-group__label col-xs-12">
                            Мыслительные способности меняются в течение дня
                            <small class="text-normal">Например: временами лучше, временами хуже</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($C3 as $key => $value) :?>
                                    <p>
                                        <input id="C3c<?= $key; ?>" name="C3c" type="radio" class="checkbox" value="<?= $key; ?>" <?= !empty($survey->unitC->C3c) && $key == $survey->unitC->C3c ? 'checked' : '' ?> >
                                        <label for="C3c<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitC->C3c) ? $C3[$survey->unitC->C3c] : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="C4" class="form-group__label col-xs-12">
                            Острое изменение состояния мыслительных способностей пациента по сравнению с его обычным состоянием
                            <small class="text-normal">Например: возбужденное состояние, заторможенность, трудности при пробуждении или неадекватное восприятие окружающей действительности</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <p>
                                    <input id="C4_1" name="C4" type="radio" class="checkbox" value="0" <?= !empty($survey->unitC->C4) && $survey->unitC->C4 == 0 ? 'checked' : '' ?>>
                                    <label for="C4_1" class="checkbox-label">Нет</label>
                                </p>
                                <p>
                                    <input id="C4_2" name="C4" type="radio" class="checkbox" value="1" <?= !empty($survey->unitC->C4) && $survey->unitC->C4 == 1 ? 'checked' : '' ?>>
                                    <label for="C4_2" class="checkbox-label">Да</label>
                                </p>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitC->C4 == 1 ? 'Да' : $survey->unitC->C4 == 0 ? 'Нет' : 'не указано'?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="C5" class="form-group__label col-xs-12">
                            Динамика способности пациента к принятию решений за последние 90 дней
                            <small class="text-normal">Или за меньший срок, если последняя оценка проводилась меньше, чем 90 дней назад</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="C5" id="C5" class="form-group__control">
                                    <option value="-1"></option>
                                    <? foreach ($C5 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitC->C5) && $key == $survey->unitC->C5 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitC->C5) ? $C5[$survey->unitC->C5] : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a role="button" class="block__footer text-center text-brand text-bold" onclick="survey.send.updateunit('unitC');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>