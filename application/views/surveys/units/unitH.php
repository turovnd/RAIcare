<?
    $H1 = Kohana::$config->load('Units.H.H1');
    $H2 = Kohana::$config->load('Units.H.H2');
    $H3 = Kohana::$config->load('Units.H.H3');
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitH" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    РАЗДЕЛ H. Недержание
</h3>

<form class="row" id="unitH" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <div class="form-group">
                        <p class="col-xs-12 text-bold">
                            H1. Недержание мочи
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
                            H2. Устройство для сбора мочи
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
                            H3. Недержание кишечного содержания
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
                            H4. Наличие стомы
                        </p>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="H4_1" name="H4" type="radio" class="radio" value="0" <?= $survey->unitH->H4 != NULL && $survey->unitH->H4 == 0 ? 'checked' : '' ?> >
                                    <label for="H4_1" class="radio-label">Нет</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="H4_2" name="H4" type="radio" class="radio" value="1" <?= $survey->unitH->H4 != NULL && $survey->unitH->H4 == 1 ? 'checked' : '' ?> >
                                    <label for="H4_2" class="radio-label">Да</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitH->H4 != NULL) { if ($survey->unitH->H4 == 1) { echo 'Да'; } elseif ($survey->unitH->H4 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>

                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <button type="button" role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitH');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </div>

</form>