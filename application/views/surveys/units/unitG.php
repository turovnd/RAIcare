<?
    $G1 = Kohana::$config->load('Units.G.G1');
    $G2a = Kohana::$config->load('Units.G.G2a');
    $G2c = Kohana::$config->load('Units.G.G2c');
    $G2d = Kohana::$config->load('Units.G.G2d');
    $G3a = Kohana::$config->load('Units.G.G3a');
    $G3b = Kohana::$config->load('Units.G.G3b');
    $G4 = Kohana::$config->load('Units.G.G4');
    $G5 = Kohana::$config->load('Units.G.G5');

    $survey->unitG->G1 = json_decode($survey->unitG->G1);
    $survey->unitG->G2 = json_decode($survey->unitG->G2);
    $survey->unitG->G3 = json_decode($survey->unitG->G3);
    $survey->unitG->G4 = json_decode($survey->unitG->G4);
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitG" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    РАЗДЕЛ G. Функциональное состояние
</h3>

<form class="row" id="unitG" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <div class="col-xs-12">
                        <span class="text-bold">G1. Эффективность действий резидента в области повседневной деятельности</span>
                        <small>
                            <p class="text-italic">
                                Изучите все эпизоды за 3-дневный период. Если действия во всех эпизодах выполняются на одном и том же уровне,
                                выберите код эффективности действий резидента, соответствующий этому уровню. Если какие-то эпизоды характеризуются
                                уровнем зависимости 6, а другие меньшим уровнем зависимости, то выберите код эффективности действий резидента 5.
                                В противном случае отталкивайтесь от трех эпизодов с наивысшим уровнем зависимости [или от всех эпизодов, если их было
                                менее 3]. Если эпизод с наивысшим уровнем зависимости - это уровень 1, то выберите код эффективности действий резидента 1.
                                Если нет, выберите код, соответствующий наименьшему уровню зависимости из всех имеющихся эпизодов (уровни 2-5).
                            </p>
                            <p>
                                <b>0 - независим</b> - ни в одном из эпизодов не требовалось никакой физической помощи, помощи в подаче предметов или присмотра.
                                <br> <b>1 - независим, помощь только при подаче предметов</b> - резиденту передают или кладут в пределах его досягаемости нужный предмет или устройство; ни в одном из эпизодов не требуется никакой физической помощи или присмотра.
                                <br> <b>2 - присмотр</b> - наблюдение / подсказки
                                <br> <b>3 - ограниченная помощь</b> - управление движениями рук, ног; помогающий руководит движениями, но не принимает на себя весовую нагрузку.
                                <br> <b>4 - обширная помощь</b> - один помогающий принимает на себя весовую нагрузку (включая поднятие конечностей), причем резидент по-прежнему выполняет не менее 50% подзадач.
                                <br> <b>5 - максимальная помощь</b> - два или больше помогающих принимают на себя весовую нагрузку (включая поднятие конечностей) - ИЛИ-поддержка с принятием весовой нагрузки требуется в 50% подзадач или более.
                                <br> <b>6 - полная зависимость</b> - во всех эпизодах требуется полная поддержка со стороны окружающих.
                                <br> <b>8 - деятельность не осуществлялась на протяжении всего периода</b>
                            </p>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="G1a" class="form-group__label col-xs-12">
                            a. Ванные процедуры
                            <small class="text-italic text-normal">Как резидент принимает ванну или душ целиком. Сюда входят
                            вопросы о том, как резидент залезает и вылезает из душевой кабины или ванны и как он
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
                            b. Личная гигиена
                            <small class="text-italic text-normal">Как резидент осуществляет личную гигиену, в т. ч. причесывается, чистит
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
                            c. Одевание верхней части тела
                            <small class="text-italic text-normal">Как резидент надевает и снимает уличную одежду, нижнее
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
                            d. Одевание нижней части тела
                            <small class="text-italic text-normal">Как резидент надевает и снимает уличную одежду,
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
                            e. Ходьба
                            <small class="text-italic text-normal">Как резидент переходит из одного места в другое в пределах одного этажа здания</small>
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
                            f. Передвижение
                            <small class="text-italic text-normal">Как резидент передвигается из одного места в другое в пределах
                                одного этажа (пешком или на инвалидной коляске). Если резидент пользуется
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
                            g. Доступ к туалету
                            <small class="text-italic text-normal">Как резидент садится и поднимается с унитаза или переносного стула-туалета для инвалидов.</small>
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
                            h. Пользование туалетом
                            <small class="text-italic text-normal">Как резидент пользуется туалетной комнатой (или
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
                            i. Перемещения в кровати
                            <small class="text-italic text-normal">Как резидент принимает лежачее положение и меняет его,
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
                            j. Прием пищи
                            <small class="text-italic text-normal">Как резидент ест и пьет (вне зависимости от навыков). Этот пункт
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
                        G2. Передвижение / ходьба
                    </p>

                    <div class="form-group">
                        <label for="G2a" class="form-group__label col-xs-12">
                            a. Основной способ передвижения
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
                            b. Скорость преодоления 4-метрового расстояния пешком
                            <small class="text-italic text-normal">
                                <p>
                                    Проложите прямую траекторию, не загроможденную какими-либо
                                    предметами. Пусть резидент встанет спокойно, касаясь обеими ногами
                                    линии старта. Затем скажите: "Пожалуйста, когда я попрошу Вас,
                                    начните идти своим нормальным шагом (с тростью или ходунками,
                                    если используете их). Это не тест на предельную скорость, с
                                    которой Вы можете ходить. Остановитесь, когда я Вам скажу. Вы
                                    меня поняли?" Лицо, проводящее оценку, может показать, как нужно
                                    проходить этот тест. Затем скажите: "Теперь начинайте идти".
                                    Запустите секундомер (в качестве альтернативы вы можете начать
                                    громко отсчитывать секунды: "одна секунда", "две секунды" и т.д.,), когда
                                    нога резидента коснется земли при первом шаге. Прекратите отсчет,
                                    когда нога резидента опустится за отметку в 4 метра. Затем скажите:
                                    "Теперь Вы можете остановиться".
                                </p>
                                <p>
                                    <b>Введите время в секундах</b>, если оно составило <b>менее 30 секунд</b>
                                    <br> <b>30 - чтобы пройти 4 метра потребовалось 30 секунд или более</b>
                                    <br> <b>77 - резидент остановился, не завершив тест</b>
                                    <br> <b>88 - резидент отказался проходить тест</b>
                                    <br> <b>99 - тестировение не проводилось</b> - например: потому что резидент не ходит самостоятельно
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
                            c. Пройденное расстояние
                            <small class="text-italic text-normal">Наибольшее расстояние, пройденное резидентом за один раз, не садясь, за ПОСЛЕДНИЕ 3 ДНЯ (при необходимости - с посторонней помощью)</small>
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
                            d. Расстояние, которое резидент самостоятельно проезжал на инвалидной коляске
                            <small class="text-italic text-normal">Расстояние, которое резидент самостоятельно проезжал на инвалидной коляске за ПОСЛЕДНИЕ 3 ДНЯ.</small>
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
                        G3. Уровень физической нагрузки
                    </p>

                    <div class="form-group">
                        <label for="G3a" class="form-group__label col-xs-12">
                            a. Общее число часов упражнений или физической активности за ПОСЛЕДНИЕ 3 ДНЯ
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
                            b. Число дней ЗА ПОСЛЕДНИЕ 3 ДНЯ, когда резидент выходил из дома/здания, в котором он проживает
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
                        G4. Потенциал улучшения функционального состояния резидента
                    </p>

                    <div class="form-group">
                        <label for="G4a" class="form-group__label col-xs-12">
                            a. Резидент полагает, что он способен повысить эффективность своих физических функций
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
                            b. Специалист в области ухода полагает, что резидент способен повысить эффективность своих физических функций
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
                        <label for="G5" class="form-group__label col-xs-12 f-s-1">
                            G5. Изменение эффективности действий резидента в области повседневной деятельности за последние 90 дней или со дня предыдущей оценки, если она проводилась менее 90 дней назад
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
                <button type="button" role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitG');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </div>

</form>