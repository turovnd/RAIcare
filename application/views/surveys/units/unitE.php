<?
$E1 = array(
    '0' => 'Отсутствует',
    '1' => 'Признак присутствует, но не проявлялся за последние 3 дня',
    '2' => 'Признак проявлялся на протяжении 1—2 дней из последних 3 дней',
    '3' => 'Признак проявлялся ежедневно на протяжении последних 3 дней'
);
$E2 = array(
    '0' => 'За последние 3 дня такого психологического состояния не было',
    '1' => 'За последние 3 дня такого психологического состояния не было, но часто оно бывает',
    '2' => 'В течение 1-2 дней из последних 3 дней',
    '3' => 'Ежедневно на протяжении последних 3 дней',
    '8' => 'Пациент не смог (не захотел) ответить'
);
$E3 = array(
    '0' => 'Отсутствует',
    '1' => 'Признак присутствует, но не проявлялся за последние 3 дня',
    '2' => 'Признак проявлялся на протяжении 1—2 дней из последних 3 дней',
    '3' => 'Признак проявлялся ежедневно на протяжении последних 3 дней'
);
$survey->unitE->E1 = json_decode($survey->unitE->E1);
$survey->unitE->E2 = json_decode($survey->unitE->E2);
$survey->unitE->E3 = json_decode($survey->unitE->E3);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitE" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Настроение и поведение
</h3>

<form class="row" id="unitE" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>
                    <p class="col-xs-12 text-bold">
                        Признаки возможного наличия подавленного, тревожного или грустного настроения у пациента
                        <small class="text-italic text-normal">Запишите признаки, наблюдавшиеся в последние 3 дня, вне зависимости от их предполагаемой причины. Примечание: при любой возможности задавайте вопросы пациенту</small>
                    </p>

                    <div class="form-group">
                        <label for="E1a" class="form-group__label col-xs-12">
                            Пациент высказывал утверждения негативного характера
                            <small class="text-italic text-normal">Например: "Все равно", "Скорей бы умереть", "К чему все это?", "Зачем я прожил так долго", "Дайте мне спокойно умереть."</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[0] != -1 ? $E1[$survey->unitE->E1[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E1b" class="form-group__label col-xs-12">
                            Постоянная злость на себя или окружающих
                            <small class="text-italic text-normal">Например: пациент быстро раздражается, его легко разозлить в ходе осуществления ухода за ним</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[1] != -1 ? $E1[$survey->unitE->E1[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E1c" class="form-group__label col-xs-12">
                            Выражения, в т.ч. невербальные, демонстрирующие необоснованные страхи пациента
                            <small class="text-italic text-normal">Например: боязнь быть покинутым, остаться одному или, наоборот, с другими; сильная боязнь конкретных объектов или ситуаций</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[2] != -1 ? $E1[$survey->unitE->E1[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E1d" class="form-group__label col-xs-12">
                            Повторяющиеся жалобы на здоровье
                            <small class="text-italic text-normal">Например: пациент, не переставая, требует внимания врачей, постоянно озабочен функционированием своего организма</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1d" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[3] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[3] != -1 ? $E1[$survey->unitE->E1[3]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E1e" class="form-group__label col-xs-12">
                            Повторяющиеся жалобы / выражение озабоченности (не связанное со здоровьем)
                            <small class="text-italic text-normal">Например: пациент, не переставая, требует внимания / поддержки в вопросах режима дня, приема пищи, стирки, выбора одежды и отношений с другими людьми</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1e" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[4] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[4] != -1 ? $E1[$survey->unitE->E1[4]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E1f" class="form-group__label col-xs-12">
                            Грустное, искаженное болью или взволнованное выражение лица
                            <small class="text-italic text-normal">Например: пациент морщит брови и постоянно хмурится</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1f" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[5] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[5] != -1 ? $E1[$survey->unitE->E1[5]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E1g" class="form-group__label col-xs-12">
                            Плач, слезливость
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1g" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[6] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[6] != -1 ? $E1[$survey->unitE->E1[6]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E1h" class="form-group__label col-xs-12">
                            Повторяющиеся утверждения о том, что вот-вот произойдет нечто ужасное
                            <small class="text-italic text-normal">Например: пациент считает, что он вот-вот умрет или с ним случится инфаркт</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1h" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[7] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[7] != -1 ? $E1[$survey->unitE->E1[7]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E1i" class="form-group__label col-xs-12">
                            Отказ от ранее интересных для пациента занятий
                            <small class="text-italic text-normal">Например: от давних многолетних занятий, проведения времени с семьей или друзьями</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1i" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[8] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[8] != -1 ? $E1[$survey->unitE->E1[8]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E1j" class="form-group__label col-xs-12">
                            Уменьшение социальных контактов
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1j" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[9] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[9] != -1 ? $E1[$survey->unitE->E1[9]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E1k" class="form-group__label col-xs-12">
                            Выражения, в том числе невербальные, говорящие о потере чувства радости
                            <small class="text-italic text-normal">Например: пациент говорит: "Мне больше ничего не приносит удовольствия"</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E1[]" id="E1k" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E1) && $key == $survey->unitE->E1[10] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E1) && $survey->unitE->E1[10] != -1 ? $E1[$survey->unitE->E1[10]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <p class="col-xs-12 text-bold">
                        Пациент о своем настроении
                    </p>

                    <div class="form-group">
                        <label for="E2a" class="form-group__label col-xs-12">
                            Задайте вопрос: "На протяжении последних 3 дней как часто вы испытывали слабый интерес или удовольствие от вещей, которые вам обычно нравятся?"
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E2[]" id="E2a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E2) && $key == $survey->unitE->E2[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E2) && $survey->unitE->E2[0] != -1 ? $E2[$survey->unitE->E2[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E2b" class="form-group__label col-xs-12">
                            Задайте вопрос: "На протяжении последних 3 дней как часто вы испытывали тревогу, беспокойство, неловкость?"
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E2[]" id="E2b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E2) && $key == $survey->unitE->E2[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E2) && $survey->unitE->E2[1] != -1 ? $E2[$survey->unitE->E2[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E2c" class="form-group__label col-xs-12">
                            Задайте вопрос: "На протяжении последних 3 дней как часто вы испытывали грусть, депрессию или безысходность?"
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E2[]" id="E2c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E2) && $key == $survey->unitE->E2[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E2) && $survey->unitE->E2[2] != -1 ? $E2[$survey->unitE->E2[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <p class="col-xs-12 text-bold">
                        Поведенческие симптомы
                        <small class="text-italic text-normal">Запишите признаки, наблюдавшиеся в последние 3 дня, вне зависимости от их предполагаемой причины</small>
                    </p>

                    <div class="form-group">
                        <label for="E3a" class="form-group__label col-xs-12">
                            Бесцельное перемещение
                            <small class="text-italic text-normal">Пациент бродил без ясной, рационально объяснимой цели</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E3[]" id="E3a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E3) && $key == $survey->unitE->E3[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E3) && $survey->unitE->E3[0] != -1 ? $E3[$survey->unitE->E3[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E3b" class="form-group__label col-xs-12">
                            Словесная агрессия
                            <small class="text-italic text-normal">Например: пациент угрожал, кричал на окружающих или проклинал их.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E3[]" id="E3b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E3) && $key == $survey->unitE->E3[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E3) && $survey->unitE->E3[1] != -1 ? $E3[$survey->unitE->E3[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E3c" class="form-group__label col-xs-12">
                            Физическое насилие
                            <small class="text-italic text-normal">Например: пациент бил, толкал, царапал или осуществлял развратные действия по отношению к окружающим.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E3[]" id="E3c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E3) && $key == $survey->unitE->E3[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E3) && $survey->unitE->E3[2] != -1 ? $E3[$survey->unitE->E3[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E3d" class="form-group__label col-xs-12">
                            Социально неприемлемое или нарушающее порядок поведение
                            <small class="text-italic text-normal">Пациент издавал звуки или производил шумы, нарушающие порядок в отделении, что-нибудь выкрикивал, размазывал или бросал пищу или фекалии, прятал чужие вещи или рылся в них.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E3[]" id="E3d" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E3) && $key == $survey->unitE->E3[3] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E3) && $survey->unitE->E3[3] != -1 ? $E3[$survey->unitE->E3[3]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E3e" class="form-group__label col-xs-12">
                            Непристойное публичное сексуальное поведение или публичное обнажение
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E3[]" id="E3e" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E3) && $key == $survey->unitE->E3[4] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E3) && $survey->unitE->E3[4] != -1 ? $E3[$survey->unitE->E3[4]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="E3f" class="form-group__label col-xs-12">
                            Пациент противится уходу за ним
                            <small class="text-italic text-normal">Например: пациент сопротивлялся приему лекарств/уколам, толкал представителей персонала в процессе оказания помощи в повседневной деятельности, еде.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="E3[]" id="E3f" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($E3 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= !empty($survey->unitE->E3) && $key == $survey->unitE->E3[5] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitE->E3) && $survey->unitE->E3[5] != -1 ? $E3[$survey->unitE->E3[5]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a role="button" class="form__submit text-center text-brand text-bold" onclick="survey.send.updateunit('unitE');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>