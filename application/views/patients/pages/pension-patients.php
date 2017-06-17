<div class="section__content">

    <h3 class="section__heading">
        <? // Module Patients && Pensions => CAN_CONDUCT_A_SURVEY = 36
        if (in_array(36, $user->permissions)) : ?>
            <a role="button" data-toggle="modal" data-area="newPatientModalForm" class="btn btn--brand btn--sm m-0 fl_r">Новый пациент</a>
        <? endif; ?>
        База данных пациентов пансионата
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <form class="search" data-search="pensions">
                <input id="search" type="search" placeholder="Начните вводить ФИО пациента или номер СНИЛСа" class="search__input" oninput="survey.get.search(this,'get')" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                <label for="search" class="search__submit">
                    <i class="fa fa-search search__submit-icon" aria-hidden="true"></i>
                </label>
            </form>

            <div class="row block-wrapper" id="patients">

                <? foreach ($patients as $patient) : ?>

                    <?= View::factory('patients/blocks/search-block', array('patient' => $patient)); ?>

                <? endforeach; ?>

            </div>

            <div class="text-center m-t-20 m-b-10">
                <button id="getMorePatientsBtn" onclick="survey.get.patients(this, 'get')" data-offset="<?= count($patients); ?>" class="btn btn--lg btn--default btn--round p-r-50 p-l-50">
                    Загрузить ещё
                </button>
            </div>

        </div>

    </div>

<? // Module Patients && Pensions => CAN_CONDUCT_A_SURVEY = 36
if (in_array(36, $user->permissions)) : ?>

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
                            <input id="maleSex" type="radio" name="sex" class="checkbox" value="1">
                            <label for="maleSex" class="checkbox-label">мужской</label>
                        </span>
                            <span class="m-l-15">
                            <input id="femaleSex" type="radio" name="sex" class="checkbox" value="2">
                            <label for="femaleSex" class="checkbox-label">женский</label>
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
                                <option value=""></option>
                                <option value="1">Никогда не состоял(а) в браке</option>
                                <option value="2">Состоит в браке</option>
                                <option value="3">Есть партнер / близкий</option>
                                <option value="4">Вдовец / вдова</option>
                                <option value="5">Проживает отдельно от жены / мужа</option>
                                <option value="6">Разведен(а)</option>
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
                            <p class="m-b-5">
                                <input id="sources1" type="checkbox" name="sources[]" class="checkbox" value="1">
                                <label for="sources1" class="checkbox-label">Бюджет</label>
                            </p>
                            <div class="m-b-5">
                                <input id="sources2" type="checkbox" name="sources[]" class="checkbox" value="2">
                                <label for="sources2" class="checkbox-label">Софинансирование государства</label>
                            </div>
                            <div class="m-b-5">
                                <input id="sources3" type="checkbox" name="sources[]" class="checkbox" value="3">
                                <label for="sources3" class="checkbox-label">Полную стоимость каждого дня пребывания в стационаре оплачивает сам пациент или его семья</label>
                            </div>
                            <div class="m-b-5">
                                <input id="sources4" type="checkbox" name="sources[]" class="checkbox" value="4">
                                <label for="sources4" class="checkbox-label">Благотворительная организация</label>
                            </div>
                            <div class="m-b-5">
                                <input id="sources5" type="checkbox" name="sources[]" class="checkbox" value="5">
                                <label for="sources5" class="checkbox-label">Страховка (добровольное страхование жизни)</label>
                            </div>
                            <div class="m-b-5">
                                <input id="sources6" type="checkbox" name="sources[]" class="checkbox" value="6">
                                <label for="sources6" class="checkbox-label">Организация, в которой ранее работал человек</label>
                            </div>
                            <div class="m-b-5">
                                <input id="sources7" type="checkbox" name="sources[]" class="checkbox" value="7">
                                <label for="sources7" class="checkbox-label">Иной источник покрытия расходов по пребыванию в стационаре</label>
                            </div>
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

<? endif; ?>

    <input type="hidden" id="pensionID" value="<?=$pension->id; ?>">

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>