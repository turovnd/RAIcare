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
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitH" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Недержание
</h3>

<form class="row" id="unitH" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <div class="form-group">
                        <p class="col-xs-12 text-bold">
                            Недержание мочи
                        </p>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <? foreach ($H1 as $key => $value) :?>
                                    <p>
                                        <input id="H1<?= $key; ?>" name="H1" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitH->H1 != NULL && $key == $survey->unitH->H1 ? 'checked' : '' ?> >
                                        <label for="H1<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitH->H1 != NULL ? $H1[$survey->unitH->H1] : 'Не указано'; ?> </p>
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
                                        <input id="H2<?= $key; ?>" name="H2" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitH->H2 != NULL && $key == $survey->unitH->H2 ? 'checked' : '' ?> >
                                        <label for="H2<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitH->H2 != NULL ? $H2[$survey->unitH->H2] : 'Не указано'; ?> </p>
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
                                        <input id="H3<?= $key; ?>" name="H3" type="radio" class="radio" value="<?= $key; ?>" <?= $survey->unitH->H3 != NULL && $key == $survey->unitH->H3 ? 'checked' : '' ?> >
                                        <label for="H3<?= $key; ?>" class="radio-label"><?= $value; ?></label>
                                    </p>
                                <? endforeach; ?>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitH->H3 != NULL ? $H3[$survey->unitH->H3] : 'Не указано'; ?> </p>
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
                                    <input id="H4_1" name="H4" type="radio" class="radio" value="1" <?= $survey->unitH->H4 != NULL && $survey->unitH->H4 == 1 ? 'checked' : '' ?> >
                                    <label for="H4_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="H4_2" name="H4" type="radio" class="radio" value="0" <?= $survey->unitH->H4 != NULL && $survey->unitH->H4 == 0 ? 'checked' : '' ?> >
                                    <label for="H4_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitH->H4 != NULL) { if ($survey->unitH->H4 == 1) { echo 'Да'; } elseif ($survey->unitH->H4 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a type="button" role="button" class="form__submit text-center text-brand text-bold" onclick="survey.send.updateunit('unitH');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>