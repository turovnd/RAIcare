<div class="block" id="patientInfo">

    <div class="block__body clear-fix">

        <div class="form-group m-b-5 js-field-name">
            <label for="patientName" class="form-group__label col-xs-12 col-sm-4 col-md-3">Пациент</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static">
                    <span class="js-patient-info">
                        <?=$patient->name; ?>
                    </span>
                    <? if ($patient->can_edit) : ?>
                        <a onclick="patient.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <? endif; ?>
                </p>
                <? if ($patient->can_edit) : ?>
                    <div class="form-group__control-group hide">
                        <input id="patientName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $patient->name; ?>" maxlength="80">
                        <label onclick="patient.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                        <label onclick="patient.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                    </div>
                <? endif; ?>
            </div>
        </div>
        <div class="form-group m-b-5 js-field-name">
            <label for="patientBirthday" class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата рождения</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static">
                    <span class="js-patient-info">
                        <?= date('d M Y', strtotime($patient->birthday)); ?>
                        <span class="f-s-0_8">
                        <?= '  ('. Methods_Time::relativeTimeWithPlural(intval((time()-strtotime($patient->birthday))/Date::YEAR), false, 'yy') . ')'; ?>
                    </span>
                    </span>
                    <? if ($patient->can_edit) : ?>
                        <a onclick="patient.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <? endif; ?>
                </p>
                <? if ($patient->can_edit) : ?>
                    <div class="form-group__control-group hide">
                        <input id="patientBirthday" name="birthday" type="date" class="form-group__control form-group__control-group-input" value="<?= $patient->birthday; ?>">
                        <label onclick="patient.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                        <label onclick="patient.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                    </div>
                <? endif; ?>
            </div>
        </div>
        <div class="form-group m-b-5 js-field-name">
            <label for="patientSnils"  class="form-group__label col-xs-12 col-sm-4 col-md-3">СНИЛС</label>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="form-group__control-static letter-spacing--5">
                    <span class="js-patient-info"><?= chunk_split($patient->snils, 3); ?></span>
                    <? if ($patient->can_edit) : ?>
                        <a onclick="patient.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <? endif; ?>
                </p>
                <? if ($patient->can_edit) : ?>
                    <div class="form-group__control-group hide">
                        <input id="patientSnils" name="snils" type="text" class="form-group__control form-group__control-group-input letter-spacing--5" value="<?= $patient->snils; ?>" maxlength="11">
                        <label onclick="patient.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                        <label onclick="patient.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                    </div>
                <? endif; ?>
            </div>
        </div>

        <? if ($patient->full_info) : ?>

            <div class="col-xs-12 collapse" id="personalInfo">
                <div class="row">
                    <div class="form-group m-b-5 js-field-name">
                        <label for="patientSex" class="form-group__label col-xs-12 col-sm-4 col-md-3">Пол</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static">
                                <span class="js-patient-info"><?= $patient->sex == 1 ? '<i class="fa fa-male" aria-hidden="true"></i> мужской': '<i class="fa fa-female" aria-hidden="true"></i> женский'; ?></span>
                                <? if ($patient->can_edit) : ?>
                                    <a onclick="patient.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($patient->can_edit) : ?>
                                <div class="form-group__control-group hide">
                                    <select name="sex" id="patientSex" class="form-group__control form-group__control-group-input js-single-select">
                                        <option value="1" <?= $patient->sex == 1 ? 'selected': ''; ?>>мужской</option>
                                        <option value="2" <?= $patient->sex == 2 ? 'selected': ''; ?>>женский</option>
                                    </select>
                                    <label onclick="patient.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="patient.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group m-b-5 js-field-name">
                        <label for="patientRelation" class="form-group__label col-xs-12 col-sm-4 col-md-3">Семейное положение</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static">
                                <span class="js-patient-info"><?= Kohana::$config->load('form_relations')[$patient->relation]; ?></span>
                                <? if ($patient->can_edit) : ?>
                                    <a onclick="patient.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($patient->can_edit) : ?>
                                <div class="form-group__control-group hide">
                                    <select name="relation" id="patientRelation" class="form-group__control form-group__control-group-input js-single-select">
                                        <? foreach (Kohana::$config->load('form_relations') as $key => $value) : ?>
                                            <option value="<?= $key; ?>" <?= $patient->relation == $key ? 'selected' : ''?>><?= $value; ?></option>
                                        <? endforeach; ?>
                                    </select>
                                    <label onclick="patient.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="patient.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group m-b-5 js-field-name">
                        <label for="patientOms" class="form-group__label col-xs-12 col-sm-4 col-md-3">Номер полиса ОМС или документа, его заменяющего</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static letter-spacing--5">
                                <span class="js-patient-info"><?= chunk_split($patient->oms, 3); ?></span>
                                <? if ($patient->can_edit) : ?>
                                    <a onclick="patient.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($patient->can_edit) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="patientOms" name="oms" type="text" class="form-group__control form-group__control-group-input letter-spacing--5" value="<?= $patient->oms; ?>" maxlength="16">
                                    <label onclick="patient.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="patient.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group m-b-5 js-field-name">
                        <label for="patientDisCer" class="form-group__label col-xs-12 col-sm-4 col-md-3">Номер справки об инвалидности</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static letter-spacing--5">
                                <span class="js-patient-info"><?= chunk_split($patient->disability_certificate, 3); ?></span>
                                <? if ($patient->can_edit) : ?>
                                    <a onclick="patient.edit.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($patient->can_edit) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="patientDisCer" name="disability_certificate" type="text" class="form-group__control form-group__control-group-input letter-spacing--5" value="<?= $patient->disability_certificate; ?>" maxlength="18">
                                    <label onclick="patient.edit.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="patient.edit.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group m-b-5 js-field-name">
                        <label for="patientSources" class="form-group__label col-xs-12 col-sm-4 col-md-3">Текущие источники оплаты пребывания в пансионате</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <div class="form-group__control-static">
                                <ol class="js-patient-info">
                                    <? foreach (json_decode($patient->sources) as $source) : ?>
                                        <li class="p-b-5"><?= Kohana::$config->load('form_sources')[$source]; ?></li>
                                    <? endforeach; ?>
                                </ol>
                                <? if ($patient->can_edit) : ?>
                                    <a onclick="patient.edit.toggle(this)" role="button" class="btn btn--default"><i class="fa fa-pencil" aria-hidden="true"> изменить</i></a>
                                <? endif; ?>
                            </div>
                            <? if ($patient->can_edit) : ?>
                                <div class="form-group__control-group display-block hide">
                                    <? foreach (Kohana::$config->load('form_sources') as $key => $value) : ?>
                                        <div class="m-b-5">
                                            <input id="sources<?=$key;?>" type="checkbox" name="sources" class="form-group__control checkbox" value="<?=$key;?>" <?=  in_array($key, json_decode($patient->sources)) ? 'checked' : ''?>>
                                            <label for="sources<?=$key;?>" class="checkbox-label"><?=$value;?></label>
                                        </div>
                                    <? endforeach; ?>
                                    <label onclick="patient.edit.save(this)" class="cursor-pointer btn btn--brand fl_r m-r-0"><i class="fa fa-check" aria-hidden="true"></i> сохранить</label>
                                    <label onclick="patient.edit.toggle(this)" class="cursor-pointer btn btn--default fl_r"><i class="fa fa-times" aria-hidden="true"></i> отменить</label>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="form-group m-b-5">
                        <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата создания</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static"><?= date('d M Y', strtotime($patient->dt_create)); ?></p>
                        </div>
                    </div>
                    <div class="form-group m-b-5">
                        <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Создатель</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static"><?= $patient->creator->name; ?></p>
                        </div>
                    </div>
                </div>
            </div>

        <? endif; ?>

        <input type="hidden" id="patientPK" value="<?=$patient->pk;?>">

    </div>
</div>