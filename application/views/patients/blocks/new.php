<form class="modal" id="newPatientModalForm" tabindex="-1">
    <div class="modal__content">
        <div class="modal__wrapper">

            <div class="modal__header">
                <button type="button" class="modal__title-close" data-close="modal">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4 class="modal__title">Новый пациент</h4>
            </div>
            <div class="modal__body">
                <div class="text-danger m-b-15">
                    <i>Все поля обязательны для заполнения</i>
                </div>
                <fieldset>
                    <div class="form-group">
                        <label for="newPatientName" class="form-group__label">Фамилия Имя Отчество</label>
                        <input type="text" id="newPatientName" name="name" class="form-group__control" maxlength="80">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="form-group__label">Пол</label>
                        <span class="m-l-15">
                            <input id="maleSex" type="radio" name="sex" class="radio" value="1">
                            <label for="maleSex" class="radio-label">мужской</label>
                        </span>
                        <span class="m-l-15">
                            <input id="femaleSex" type="radio" name="sex" class="radio" value="2">
                            <label for="femaleSex" class="radio-label">женский</label>
                        </span>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="newPatientBirthday" class="form-group__label">Дата рождения</label>
                        <input type="date" id="newPatientBirthday" name="birthday" class="form-group__control">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="newPatientRelation" class="form-group__label">Семейное положение</label>
                        <select id="newPatientRelation" name="relation" class="form-group__control">
                            <option value="-1" disabled selected>Не выбрано</option>
                            <? foreach (Kohana::$config->load('form_relations') as $key => $value) : ?>
                                <option value="<?= $key; ?>"><?= $value; ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="newPatientSnils" class="form-group__label">Номер СНИЛС</label>
                        <input type="text" id="newPatientSnils" name="snils" class="form-group__control letter-spacing--5" maxlength="11">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="newPatientOms" class="form-group__label">Номер полиса ОМС или документа, его заменяющего</label>
                        <input type="text" id="newPatientOms" name="oms" class="form-group__control letter-spacing--5" maxlength="16">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="newPatientDisabilityCertificate" class="form-group__label">Номер справки об инвалидности</label>
                        <input type="text" id="newPatientDisabilityCertificate" name="disability_certificate" class="form-group__control letter-spacing--5" maxlength="18">
                    </div>
                </fieldset>

                <fieldset class="m-b-0">
                    <div class="form-group" id="sources">
                        <label class="form-group__label">Текущие источники оплаты пребывания в пансионате</label>
                        <? foreach (Kohana::$config->load('form_sources') as $key => $value) : ?>
                            <div class="m-b-5">
                                <input id="sources<?=$key;?>" type="checkbox" name="sources[]" class="checkbox" value="<?=$key;?>">
                                <label for="sources<?=$key;?>" class="checkbox-label"><?=$value;?></label>
                            </div>
                        <? endforeach; ?>
                    </div>
                </fieldset>
            </div>
            <div class="modal__footer">
                <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
                <button onclick="survey.send.newpatientform()" type="button" class="btn btn--brand">Создать</button>
            </div>
        </div>
    </div>
</form>