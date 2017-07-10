<?
$G1 = array(
    '0' => '0 - независим',
    '1' => '1 - независим, помощь только при подаче предметов',
    '2' => '2 - присмотр',
    '3' => '3 - ограниченная помощь',
    '4' => '4 - обширная помощь',
    '5' => '5 - максимальная помощь',
    '6' => '6 - полная зависимость',
    '8' => '8 - деятельность не осуществлялась на протяжении всего периода'
);
$G2a = array(
    '0' => 'Ходьба без использования вспомогательных приспособлений',
    '1' => 'Ходьба с использованием вспомогательных приспособлений',
    '2' => 'Инвалидная коляска, скутер',
    '3' => 'Прикован к постели'
);
$G2c = array(
    '0' => 'Не ходил',
    '1' => 'Менее 5 метров',
    '2' => '5 – 49 метров',
    '3' => '50 – 99 метров',
    '4' => 'Более 100 метров',
    '5' => 'Более 1 километра'
);
$G2d = array(
    '0' => 'Пациента везли окружающие',
    '1' => 'Пациент использовал инвалидную коляску/скутер с двигателем',
    '2' => 'Пациент самостоятельно проехал менее 5 метров',
    '3' => 'Пациент самостоятельно проехал 5 – 49 метров',
    '4' => 'Пациент самостоятельно проехал 50 – 99 метров',
    '5' => 'Пациент самостоятельно проехал более 100 метров',
    '8' => 'Не использовал инвалидную коляску'
);
$G3a = array(
    '0' => 'Никакой физической активности',
    '1' => 'Менее 1 часа',
    '2' => '1-2 часа',
    '3' => '3-4 часа',
    '4' => 'Более 4 часов'
);
$G3b = array(
    '0' => 'Не выходил ни разу',
    '1' => 'Не выходил за последние 3 дня, но обычно выходит хотя бы раз в 3 дня',
    '2' => '1-2 дня',
    '3' => '3 дня'
);
$G4 = array(
    '0' => 'Нет',
    '1' => 'Да'
);
$G5 = array(
    '0' => 'Повысилась',
    '1' => 'Не изменилась',
    '2' => 'Понизилась',
    '8' => 'Невозможно сказать определенно'
);
$survey->unitG->G1 = json_decode($survey->unitG->G1);
$survey->unitG->G2 = json_decode($survey->unitG->G2);
$survey->unitG->G3 = json_decode($survey->unitG->G3);
$survey->unitG->G4 = json_decode($survey->unitG->G4);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitG" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Функциональное состояние
</h3>

<form class="row" id="unitG" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <div class="col-xs-12">
                        <span class="text-bold">Эффективность действий пациента в области повседневной деятельности</span>
                        <small>
                            <p class="text-italic">
                                Изучите все эпизоды за 3-дневный период. Если действия во всех эпизодах выполняются на одном и том же уровне,
                                выберите код эффективности действий пациента, соответствующий этому уровню. Если какие-то эпизоды характеризуются
                                уровнем зависимости 6, а другие меньшим уровнем зависимости, то выберите код эффективности действий пациента 5.
                                В противном случае отталкивайтесь от трех эпизодов с наивысшим уровнем зависимости [или от всех эпизодов, если их было
                                менее 3]. Если эпизод с наивысшим уровнем зависимости - это уровень 1, то выберите код эффективности действий пациента 1.
                                Если нет, выберите код, соответствующий наименьшему уровню зависимости из всех имеющихся эпизодов (уровни 2-5).
                            </p>
                            <p>
                                <b>0 - независим</b> - ни в одном из эпизодов не требовалось никакой физической помощи, помощи в подаче предметов или присмотра.
                                <br> <b>1 - независим, помощь только при подаче предметов</b> - пациенту передают или кладут в пределах его досягаемости нужный предмет или устройство; ни в одном из эпизодов не требуется никакой физической помощи или присмотра.
                                <br> <b>2 - присмотр</b> - наблюдение / подсказки
                                <br> <b>3 - ограниченная помощь</b> - управление движениями рук, ног; помогающий руководит движениями, но не принимает на себя весовую нагрузку.
                                <br> <b>4 - обширная помощь</b> - один помогающий принимает на себя весовую нагрузку (включая поднятие конечностей), причем пациент по-прежнему выполняет не менее 50% подзадач.
                                <br> <b>5 - максимальная помощь</b> - два или больше помогающих принимают на себя весовую нагрузку (включая поднятие конечностей) - ИЛИ-поддержка с принятием весовой нагрузки требуется в 50% подзадач или более.
                                <br> <b>6 - полная зависимость</b> - во всех эпизодах требуется полная поддержка со стороны окружающих.
                                <br> <b>8 - деятельность не осуществлялась на протяжении всего периода</b>
                            </p>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="G1a" class="form-group__label col-xs-12">
                            Ванные процедуры
                            <small class="text-italic text-normal">Как пациент принимает ванну или душ целиком. Сюда входят
                            вопросы о том, как пациент залезает и вылезает из душевой кабины или ванны и как он
                            моет каждую часть тела: руки, икры, бедра, грудь, живот, паховую область - СЮДА НЕ
                            ВХОДИТ ВОПРОС О МЫТЬЕ СПИНЫ И ВОЛОС</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G1[]" id="G1a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G1 != NULL && $key == $survey->unitG->G1[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G1 != NULL && $survey->unitG->G1[0] != -1 ? $G1[$survey->unitG->G1[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G1b" class="form-group__label col-xs-12">
                            Личная гигиена
                            <small class="text-italic text-normal">Как пациент осуществляет личную гигиену, в т. ч. причесывается, чистит
                            зубы, бреется, применяет косметические средства, умывается и сушит лицо и руки - СЮДА
                            НЕ ВХОДИТ ВОПРОС О ПРИНЯТИИ ВАННЫ ИЛИ ДУША.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G1[]" id="G1b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G1 != NULL && $key == $survey->unitG->G1[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G1 != NULL && $survey->unitG->G1[1] != -1 ? $G1[$survey->unitG->G1[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G1c" class="form-group__label col-xs-12">
                            Одевание верхней части тела
                            <small class="text-italic text-normal">Как пациент надевает и снимает уличную одежду, нижнее
                            белье и иные предметы, относящееся к верхней части тела, в том числе протезы,
                            ортопедические элементы, застежки, пуловеры и т.д.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G1[]" id="G1c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G1 != NULL && $key == $survey->unitG->G1[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G1 != NULL && $survey->unitG->G1[2] != -1 ? $G1[$survey->unitG->G1[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G1d" class="form-group__label col-xs-12">
                            Одевание нижней части тела
                            <small class="text-italic text-normal">Как пациент надевает и снимает уличную одежду,
                                нижнее белье и иные предметы, относящееся к части тела от пояса и ниже, в том
                                числе протезы, ортопедические элементы (например, противоэмболические чулки),
                                пояса, трусы, юбки, ботинки, застежки и т.д.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G1[]" id="G1d" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G1 != NULL && $key == $survey->unitG->G1[3] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G1 != NULL && $survey->unitG->G1[3] != -1 ? $G1[$survey->unitG->G1[3]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G1e" class="form-group__label col-xs-12">
                            Ходьба
                            <small class="text-italic text-normal">Как пациент переходит из одного места в другое в пределах одного этажа здания</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G1[]" id="G1e" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G1 != NULL && $key == $survey->unitG->G1[4] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G1 != NULL && $survey->unitG->G1[4] != -1 ? $G1[$survey->unitG->G1[4]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G1f" class="form-group__label col-xs-12">
                            Передвижение
                            <small class="text-italic text-normal">Как пациент передвигается из одного места в другое в пределах
                                одного этажа (пешком или на инвалидной коляске). Если пациент пользуется
                                инвалидной коляской, то следует учитывать именно этот период.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G1[]" id="G1f" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G1 != NULL && $key == $survey->unitG->G1[5] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G1 != NULL && $survey->unitG->G1[5] != -1 ? $G1[$survey->unitG->G1[5]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G1g" class="form-group__label col-xs-12">
                            Доступ к туалету
                            <small class="text-italic text-normal">Как пациент садится и поднимается с унитаза или переносного стула-туалета для инвалидов.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G1[]" id="G1g" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G1 != NULL && $key == $survey->unitG->G1[6] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G1 != NULL && $survey->unitG->G1[6] != -1 ? $G1[$survey->unitG->G1[6]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G1h" class="form-group__label col-xs-12">
                            Пользование туалетом
                            <small class="text-italic text-normal">Как пациент пользуется туалетной комнатой (или
                                переносным стулом-туалетом для инвалидов, судном или мочеприемником), очищает
                                себя после пользования туалетом или случаев недержания, меняет наматрасник,
                                управляется со стомой или катетером и приводит в порядок одежду. В ЭТОТ ПУНКТ
                                НЕ ВХОДИТ ПЕРЕМЕЩЕНИЕ В ТУАЛЕТ И ИЗ ТУАЛЕТА</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G1[]" id="G1h" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G1 != NULL && $key == $survey->unitG->G1[7] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G1 != NULL && $survey->unitG->G1[7] != -1 ? $G1[$survey->unitG->G1[7]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G1i" class="form-group__label col-xs-12">
                            Перемещения в кровати
                            <small class="text-italic text-normal">Как пациент принимает лежачее положение и меняет его,
                                переворачивается с боку на бок и принимает то или иное положение, находясь в
                                кровати</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G1[]" id="G1i" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G1 != NULL && $key == $survey->unitG->G1[8] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G1 != NULL && $survey->unitG->G1[8] != -1 ? $G1[$survey->unitG->G1[8]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G1j" class="form-group__label col-xs-12">
                            Прием пищи
                            <small class="text-italic text-normal">Как пациент ест и пьет (вне зависимости от навыков). Этот пункт
                                включает в себя получение питания и другими способами (например, зондовое
                                кормление или полностью парентеральное питание).</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G1[]" id="G1j" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G1 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G1 != NULL && $key == $survey->unitG->G1[9] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G1 != NULL && $survey->unitG->G1[9] != -1 ? $G1[$survey->unitG->G1[9]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Передвижение / ходьба
                    </p>

                    <div class="form-group">
                        <label for="G2a" class="form-group__label col-xs-12">
                            Основной способ передвижения
                            <small class="text-italic text-normal">Вспомогательных приспособленя: трость, ходунки, костыли или толкание инвалидной коляски перед собой</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G2[]" id="G2a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G2a as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G2 != NULL && $key == $survey->unitG->G2[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G2 != NULL && $survey->unitG->G2[0] != -1 ? $G2a[$survey->unitG->G2[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G2b" class="form-group__label col-xs-12">
                            Скорость преодоления 4-метрового расстояния пешком
                            <small class="text-italic text-normal">
                                <p>
                                    Проложите прямую траекторию, не загроможденную какими-либо
                                    предметами. Пусть пациент встанет спокойно, касаясь обеими ногами
                                    линии старта. Затем скажите: "Пожалуйста, когда я попрошу Вас,
                                    начните идти своим нормальным шагом (с тростью или ходунками,
                                    если используете их). Это не тест на предельную скорость, с
                                    которой Вы можете ходить. Остановитесь, когда я Вам скажу. Вы
                                    меня поняли?" Лицо, проводящее оценку, может показать, как нужно
                                    проходить этот тест. Затем скажите: "Теперь начинайте идти".
                                    Запустите секундомер (в качестве альтернативы вы можете начать
                                    громко отсчитывать секунды: "одна секунда", "две секунды" и т.д.,), когда
                                    нога пациента коснется земли при первом шаге. Прекратите отсчет,
                                    когда нога пациента опустится за отметку в 4 метра. Затем скажите:
                                    "Теперь Вы можете остановиться".
                                </p>
                                <p>
                                    <b>Введите время в секундах</b>, если оно составило <b>менее 30 секунд</b>
                                    <br> <b>30 - чтобы пройти 4 метра потребовалось 30 секунд или более</b>
                                    <br> <b>77 - пациент остановился, не завершив тест</b>
                                    <br> <b>88 - пациент отказался проходить тест</b>
                                    <br> <b>99 - тестировение не проводилось</b> - например: потому что пациент не ходит самостоятельно
                                </p>
                            </small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="G2b" name="G2[]" type="number" class="form-group__control" value="<?= $survey->unitG->G2 != NULL ? $survey->unitG->G2[1] : -1; ?>" min="1" max="99">
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G2 != NULL && $survey->unitG->G2[1] != "-1" ? $survey->unitG->G2[1] . ' сек.' : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G2c" class="form-group__label col-xs-12">
                            Пройденное расстояние
                            <small class="text-italic text-normal">Наибольшее расстояние, пройденное пациентом за один раз, не садясь, за ПОСЛЕДНИЕ 3 ДНЯ (при необходимости - с посторонней помощью)</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G2[]" id="G2c" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G2c as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G2 != NULL && $key == $survey->unitG->G2[2] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G2 != NULL && $survey->unitG->G2[2] != -1 ? $G2c[$survey->unitG->G2[2]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G2d" class="form-group__label col-xs-12">
                            Расстояние, которое пациент самостоятельно проезжал на инвалидной коляске
                            <small class="text-italic text-normal">Расстояние, которое пациент самостоятельно проезжал на инвалидной коляске за ПОСЛЕДНИЕ 3 ДНЯ.</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G2[]" id="G2d" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G2d as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G2 != NULL && $key == $survey->unitG->G2[3] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G2 != NULL && $survey->unitG->G2[3] != -1 ? $G2d[$survey->unitG->G2[3]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Уровень физической нагрузки
                    </p>

                    <div class="form-group">
                        <label for="G3a" class="form-group__label col-xs-12">
                            Общее число часов упражнений или физической активности за ПОСЛЕДНИЕ 3 ДНЯ
                            <small class="text-italic text-normal">Например: ходьбы</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G3[]" id="G3a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G3a as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G3 != NULL && $key == $survey->unitG->G3[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G3 != NULL && $survey->unitG->G3[0] != -1 ? $G3a[$survey->unitG->G3[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G3b" class="form-group__label col-xs-12">
                            Число дней ЗА ПОСЛЕДНИЕ 3 ДНЯ, когда пациент выходил из дома/здания, в котором он проживает
                            <small class="text-italic text-normal">Длительность прогулки не имеет значения</small>
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G3[]" id="G3b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G3b as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G3 != NULL && $key == $survey->unitG->G3[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G3 != NULL && $survey->unitG->G3[1] != -1 ? $G3b[$survey->unitG->G3[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <p class="col-xs-12 text-bold">
                        Потенциал улучшения функционального состояния пациента
                    </p>

                    <div class="form-group">
                        <label for="G4a" class="form-group__label col-xs-12">
                            Пациент полагает, что он способен повысить эффективность своих физических функций
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G4[]" id="G4a" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G4 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G4 != NULL && $key == $survey->unitG->G4[0] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G4 != NULL && $survey->unitG->G4[0] != -1 ? $G4[$survey->unitG->G4[0]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="G4b" class="form-group__label col-xs-12">
                            Специалист в области ухода полагает, что пациент способен повысить эффективность своих физических функций
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G4[]" id="G4b" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G4 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G4 != NULL && $key == $survey->unitG->G4[1] ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G4 != NULL && $survey->unitG->G4[1] != -1 ? $G4[$survey->unitG->G4[1]] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label for="G5" class="form-group__label col-xs-12">
                            Изменение эффективности действий пациента в области повседневной деятельности за последние 90 дней или со дня предыдущей оценки, если она проводилась менее 90 дней назад
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="G5" id="G5" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($G5 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitG->G5 != NULL && $key == $survey->unitG->G5 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitG->G5 != NULL && $survey->unitG->G5 != -1 ? $G5[$survey->unitG->G5] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a type="button" role="button" class="form__submit text-center text-brand text-bold" onclick="survey.send.updateunit('unitG');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>