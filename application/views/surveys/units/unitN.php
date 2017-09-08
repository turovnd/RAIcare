<?
    $N1c = Kohana::$config->load('Units.N.N1c');
    $N1d = Kohana::$config->load('Units.N.N1d');
    $N1e = Kohana::$config->load('Units.N.N1e');

    $survey->unitN->N1 = !empty($survey->unitN->N1) ? json_decode($survey->unitN->N1) : array();
?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raicare.collapse.toggle(this)" data-area="unitN" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Лекарственные средства
</h3>

<form class="row" id="unitN" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>

                    <div class="col-xs-12 text-bold">
                        Список всех лекартсвенных средств
                        <small class="text-italic text-normal">
                            <p>Перечислите все действующие предписания, а также все безрецептурные
                            лекарства, которые принимал пациент за ПОСЛЕДНИЕ 3 ДНЯ.</p>
                            <p><b>Дозировка</b> - положительное число, например: 0,5; 5; 150; 300.</p>
                            <p><b>Единицы измерения:</b> мЭкв (миллиэквивалент), ингаляция, капли, г (граммы),
                                мг (миллиграммы), % (проценты), л (литры), мл (миллилитры), единицы, мкг (микрограммы),
                                унции, др. (другое).</p>
                            <p><b>Способ приема:</b> PO (через рот / перорально), REC (ректально), ET (с помощью энтеральной трубки),
                                SL (сублингвально), TOP (наружно), TD (внутрикожно;трансдермально), IM (внутримышечно), IH (ингаляция),
                                EYE (в глаз), IV (внутривенно), NAS (назально), SubQ (подкожно), OTH (другое).</p>
                            <p><b>Частота приема:</b> Q1H (каждый час), Q2H (каждые 2 часа), Q3H (каждые 3 часа),
                                Q4H (каждые 4 часа), Q6H (каждые 6 часов), Q8H (каждые 8 часов), 5D (5 раз в день),
                                02D (раз в 2 дня), Q3D (раз в 3 дня),
                                <b>Ежедневно:</b> BED (перед сном), BID (2 раза в день;в т.ч. каждые 12 ч.), TID (3 раз в день), QID (4 раза в день),
                                <b>Еженедельно:</b> 2W (2 раза в неделю), 3W (3 раза в неделю), 4W (4 раза в неделю), 5W (5 раза в неделю), 6W (6 раза в неделю),
                                1M (ежемесячно),  2M (дважды в месяц), OTH (другое)</p>
                            <p><b>PRN</b> - прием по мере необходимости (Да/Нет)</p>
                        </small>
                    </div>

<!--                    <table class="tablesaw" data-tablesaw-mode="stack" id="N1">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th scope="col">Наименование</th>-->
<!--                            <th scope="col">Дозировка</th>-->
<!--                            <th scope="col">Ед.измер.</th>-->
<!--                            <th scope="col">Способ приема</th>-->
<!--                            <th scope="col">Частота приема</th>-->
<!--                            <th scope="col">PRN (по мере необх.)</th>-->
<!--                            --><?// if ($can_conduct) : ?>
<!--                                <th scope="col" class="hide">Выбрать</th>-->
<!--                            --><?// endif; ?>
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody valign="middle">-->
<!---->
<!--                            --><?// foreach ($survey->unitN->N1 as $N1_key => $N1) : ?>
<!---->
<!--                                <tr>-->
<!--                                    <td width="30%">-->
<!--                                        <div class="form-group">-->
<!--                                            <select name="N1[--><?//= $N1_key; ?><!--][0]" class="form-group__control">-->
<!--                                                <option selected disabled value="-1">Не выбрано</option>-->
<!--                                                <option value="--><?//= !empty($N1) ? $N1[0] : ''; ?><!--"> --><?////= Model_::getByName($N1[0])?><!-- </option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                    <td width="13%">-->
<!--                                        <div class="form-group">-->
<!--                                            <input name="N1[--><?//= $N1_key; ?><!--][1]" type="number" min="0" step=".01" class="form-group__control" value="--><?//= !empty($N1) ? $N1[1] : ''; ?><!--">-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                    <td width="13%">-->
<!--                                        <div class="form-group">-->
<!--                                            <select name="N1[--><?//= $N1_key; ?><!--][2]" class="form-group__control">-->
<!--                                                <option selected disabled value="-1">Не выбрано</option>-->
<!--                                                --><?// foreach ($N1c as $key => $value) :?>
<!--                                                    <option value="--><?//= $key; ?><!--" --><?// echo !empty($N1) && $key == $N1[2] ? 'selected': '' ?><!-- > --><?//= $value; ?><!-- </option>-->
<!--                                                --><?// endforeach; ?>
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                    <td width="13%">-->
<!--                                        <div class="form-group">-->
<!--                                            <select name="N1[--><?//= $N1_key; ?><!--][3]" class="form-group__control">-->
<!--                                                <option selected disabled value="-1">Не выбрано</option>-->
<!--                                                --><?// foreach ($N1d as $key => $value) :?>
<!--                                                    <option value="--><?//= $key; ?><!--" --><?// echo !empty($N1) && $key == $N1[3] ? 'selected': '' ?><!-- > --><?//= $value; ?><!-- </option>-->
<!--                                                --><?// endforeach; ?>
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                    <td width="13%">-->
<!--                                        <div class="form-group">-->
<!--                                            <select name="N1[--><?//= $N1_key; ?><!--][4]" class="form-group__control">-->
<!--                                                <option selected disabled value="-1">Не выбрано</option>-->
<!--                                                --><?// foreach ($N1e as $key => $value) :?>
<!--                                                    <option value="--><?//= $key; ?><!--" --><?// echo !empty($N1) && $key == $N1[4] ? 'selected': '' ?><!-- > --><?//= $value; ?><!-- </option>-->
<!--                                                --><?// endforeach; ?>
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                    <td width="13%">-->
<!--                                        <div class="form-group">-->
<!--                                            <select name="N1[--><?//= $N1_key; ?><!--][5]" class="form-group__control">-->
<!--                                                <option selected disabled value="-1">Не выбрано</option>-->
                                                <!--<option value="1" <?// echo !empty($N1) && $N1[5] == 1 ? 'selected': '' ?>>Да</option>-->
                                                <!--<option value="0" <?// echo !empty($N1) && $N1[5] == 0 ? 'selected': '' ?>>Нет</option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                    --><?// if ($can_conduct) : ?>
<!--                                    <td width="5%">-->
<!--                                        <input id="N1_checkbox--><?//= $N1_key; ?><!--" class="checkbox" type="checkbox" data-row="--><?//=$N1_key;?><!--">-->
<!--                                        <label for="N1_checkbox--><?//= $N1_key; ?><!--" class="checkbox-label"></label>-->
<!--                                    </td>-->
<!--                                    --><?// endif; ?>
<!--                                </tr>-->
<!---->
<!--                            --><?// endforeach; ?>
<!---->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                    --><?// if ($can_conduct) : ?>
<!--                        <button class="btn btn--brand m-l-10 m-t-20 m-b-0" onclick="survey.table.addRow('N1')">Добавить</button>-->
<!--                        <button class="btn btn--brand m-l-10 m-t-20 m-b-0" onclick="survey.table.removeRow('N1')">Удалить</button>-->
<!--                    --><?// endif; ?>
                </fieldset>

                <fieldset>

                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Аллергия на какие-либо лекартсва
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="N2_1" name="N2" type="radio" class="radio" value="1" <?= $survey->unitN->N2 != NULL && $survey->unitN->N2 == 1 ? 'checked' : '' ?> >
                                    <label for="N2_1" class="radio-label">Есть</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="N2_2" name="N2" type="radio" class="radio" value="0" <?= $survey->unitN->N2 != NULL && $survey->unitN->N2 == 0 ? 'checked' : '' ?> >
                                    <label for="N2_2" class="radio-label">Аллергические реакции неизвестны</label>
                                </span>
                            <? else: ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitN->N2 != NULL) { if ($survey->unitN->N2 == 1) { echo 'Есть'; } elseif ($survey->unitN->N2 == 0) { echo 'Аллергические реакции неизвестны'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                    
                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <button type="button" role="button" class="form__submit text-center text-bold link" onclick="survey.send.updateunit('unitN');">
                    Сохранить
                </button>
            <? endif; ?>

        </div>

    </div>

</form>

<input type="hidden" id="N1cOptions" value='<?= json_encode($N1c)?>'>
<input type="hidden" id="N1dOptions" value='<?= json_encode($N1d)?>'>
<input type="hidden" id="N1eOptions" value='<?= json_encode($N1e)?>'>