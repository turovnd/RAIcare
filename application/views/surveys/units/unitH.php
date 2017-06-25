<?
$H1 = array(
    '0' => 'Не страдает недержанием - полный контроль за мочеиспусканием; НЕ ИСПОЛЬЗУЕТ катетер или другое устройство для сбора мочи.',
    '1' => 'Полный контроль с помощью катетера или стомы за последние 3 дня',
    '2' => 'Редкие эпизоды недержания - в течение последних 3 дней не было эпизодов недержания, но такие эпизоды имеются',
    '3' => 'Периодические эпизоды недержания - эпизоды недержания мочи случаются не каждый день',
    '4' => 'Частые эпизоды недержания - ежедневные случаи недержания, но присутствует некоторая степень контроля',
    '5' => 'Постоянное недержание - неконтролируемое мочеиспускание',
    '8' => 'Не было мочеиспускания - из мочевого пузыря не было выхода мочи за последние 3 дня'
);
$H2 = array(
    '0' => 'Не используется',
    '1' => 'Внешний катетер типа "презерватив"',
    '2' => 'Внутренний катетер',
    '3' => 'Цистостома, нефростома, уретростома'
);
$H3 = array(
    '0' => 'Не страдает недержанием - полный контроль функций кишечника; пациент НЕ ИСПОЛЬЗУЕТ какие-либо устройства-стомы',
    '1' => 'Контроль с помощью стомы - контроль с помощью устройства-стомы на протяжении последних 3 дней',
    '2' => 'Редкие эпизоды недержания - за последние 3 дня эпизодов недержания не было, но такие эпизоды имеются',
    '3' => 'Периодические эпизоды недержания - эпизоды недержания происходили не каждый день',
    '4' => 'Частые эпизоды недержания - ежедневные эпизоды, но присутствует некоторая степень контроля',
    '5' => 'Постоянное недержание - отсутствует контроль за содержимым кишечника',
    '8' => 'Не было дефекации - в течение последних 3 дней не было кишечной перистальтики'
);
$survey->unitH->H1 = json_decode($survey->unitH->H1);
$survey->unitH->H2 = json_decode($survey->unitH->H2);
$survey->unitH->H3 = json_decode($survey->unitH->H3);

?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitH" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Недержание
</h3>

<form class="row" id="unitH" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="block">

            <div class="block__body">

                <fieldset>

                    <div class="form-group">
                        <p class="col-xs-12 text-bold">
                            Недержание мочи
                        </p>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($H1 as $key => $value) :?>
                                    <p>
                                        <input id="H1<?= $key; ?>" name="H1" type="radio" class="checkbox" value="<?= $key; ?>" <?= !empty($survey->unitH->H1) && $key == $survey->unitH->H1 ? 'checked' : '' ?> >
                                        <label for="H1<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitH->H1) ? $H1[$survey->unitH->H1] : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <p class="col-xs-12 text-bold">
                            Устройство для сбора мочи
                        </p>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($H2 as $key => $value) :?>
                                    <p>
                                        <input id="H2<?= $key; ?>" name="H2" type="radio" class="checkbox" value="<?= $key; ?>" <?= !empty($survey->unitH->H2) && $key == $survey->unitH->H2 ? 'checked' : '' ?> >
                                        <label for="H2<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitH->H2) ? $H2[$survey->unitH->H2] : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <p class="col-xs-12 text-bold">
                            Недержание кишечного содержания
                        </p>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($H3 as $key => $value) :?>
                                    <p>
                                        <input id="H3<?= $key; ?>" name="H3" type="radio" class="checkbox" value="<?= $key; ?>" <?= !empty($survey->unitH->H3) && $key == $survey->unitH->H3 ? 'checked' : '' ?> >
                                        <label for="H3<?= $key; ?>" class="checkbox-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitH->H3) ? $H3[$survey->unitH->H3] : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <p class="col-xs-12 text-bold">
                            Наличие стомы
                        </p>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="H4_1" name="H4" type="radio" class="checkbox" value="0" <?= !empty($survey->unitH->H4) && $survey->unitH->H4 == 0 ? 'checked' : '' ?> >
                                    <label for="H4_1" class="checkbox-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="H4_2" name="H4" type="radio" class="checkbox" value="1" <?= !empty($survey->unitH->H4) && $survey->unitH->H4 == 1 ? 'checked' : '' ?> >
                                    <label for="H4_2" class="checkbox-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitH->H4 == 0 ? 'Нет' : $survey->unitH->H4 == 1 ? 'Да' : 'не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a type="button" role="button" class="block__footer text-center text-brand text-bold" onclick="survey.send.updateunit('unitH');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>