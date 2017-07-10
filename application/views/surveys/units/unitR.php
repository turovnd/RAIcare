<?
if (empty($survey->type == 5)) return;
$R2 = array(
    '1' => 'Частный дом / квартира / арендуемая комната',
    '2' => 'Дом-интернат для престарелых',
    '3' => 'Специализированный дом социального назначения',
    '4' => 'Психоневрологический интернат',
    '5' => 'Дом-интернат для людей с физической инвалидностью',
    '7' => 'Психиатрическая больница или отделение',
    '8' => 'Бездомный (проживающий в приюте или вне его)',
    '9' => 'Лечебное учреждение для долговременного ухода (отделение сестринского ухода, гериатрическое отделение)',
    '10' => 'Больница / отделение реабилитации',
    '11' => 'Хоспис / отделение паллиативной медицины',
    '12' => 'Больница экстренной медицинской помощи',
    '13' => 'Исправительное учреждение',
    '14' => 'Другое',
    '15' => 'Пациент умер'
);

?>

<h3 class="section__heading">
    <? if (!$can_conduct) : ?>
        <a role="button" onclick="raisoft.collapse.toggle(this)" data-area="unitR" data-opened="true" data-textclosed="показать" data-textopened="скрыть" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"></a>
    <? endif; ?>
    Выписка
</h3>

<form class="row" id="unitR" onsubmit="event.preventDefault()">

    <div class="col-xs-12">

        <div class="form">

            <div class="form__body">

                <fieldset>
                    <div class="form-group">
                        <label for="R1" class="form-group__label col-xs-12">
                            Последний день пребывания в лечебном учреждении
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <input id="R1" name="R1" type="date" class="form-group__control" value="<?= $survey->unitR->R1; ?>">
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= !empty($survey->unitR->R1) && $survey->unitR->R1 != "0000-00-00" ? date('d M Y', strtotime($survey->unitR->R1)) : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="R2" class="form-group__label col-xs-12">
                            Жилищные условия после выписки
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <select name="R2" id="R2" class="form-group__control js-single-select">
                                    <option selected disabled value="-1">Не выбрано</option>
                                    <? foreach ($R2 as $key => $option) :?>
                                        <option value="<?= $key; ?>" <?= $survey->unitR->R2 != NULL && $key == $survey->unitR->R2 ? 'selected' : '' ?>><?= $option; ?></option>
                                    <? endforeach; ?>
                                </select>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <?= $survey->unitR->R2 != NULL && $survey->unitR->R2 != -1 ? $R2[$survey->unitR->R2] : 'Не указано'; ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="form-group__label col-xs-12">
                            Пациенту дано направление на получение услуг по уходу на дому после выписки
                        </label>
                        <div class="col-xs-12">
                            <? if ($can_conduct) : ?>
                                <span>
                                    <input id="R3_1" name="R3" type="radio" class="radio" value="1" <?= $survey->unitR->R3 != NULL && $survey->unitR->R3 == 1 ? 'checked' : '' ?> >
                                    <label for="R3_1" class="radio-label">Да</label>
                                </span>
                                <span class="m-l-20">
                                    <input id="R3_2" name="R3" type="radio" class="radio" value="0" <?= $survey->unitR->R3 != NULL && $survey->unitR->R3 == 0 ? 'checked' : '' ?> >
                                    <label for="R3_2" class="radio-label">Нет</label>
                                </span>
                            <? else : ?>
                                <p class="form-group__control-static p-l-0"> <? if ($survey->unitR->R3 != NULL) { if ($survey->unitR->R3 == 1) { echo 'Да'; } elseif ($survey->unitR->R3 == 0) { echo 'Нет'; } else { echo 'Не указано'; } } else { echo 'Не указано'; } ?> </p>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

            </div>

            <? if ($can_conduct) : ?>
                <a role="button" class="form__submit text-center text-brand text-bold" onclick="survey.send.updateunit('unitR');">
                    Сохранить
                </a>
            <? endif; ?>

        </div>

    </div>

</form>