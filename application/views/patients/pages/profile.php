<div class="section__content">

    <h3 class="section__heading">
        <a role="button" data-toggle="collapse" data-area="personalInfo" data-opened="false" data-textclosed="подробно" data-textopened="кратко" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r collapse-btn"></a>
        Персональные данные пациента #<?=$patient->pk; ?>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <div class="block">

                <div class="block__body">

                    <div class="form-group m-b-5">
                        <label class="form-group__label col-xs-12 col-sm-4 col-md-3">ФИО</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static"><?=$patient->name; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-b-5">
                        <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата рождения</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static"><?=$patient->birthday; ?></p>
                        </div>
                    </div>
                    <div class="form-group m-b-5">
                        <label class="form-group__label col-sm-4 col-md-3 col-md-3 col-xs-12">СНИЛС</label>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            <p class="form-group__control-static"><?=$patient->snils; ?></p>
                        </div>
                    </div>
                    <div class="col-xs-12 collapse" id="personalInfo">
                        <div class="row">
                            <div class="form-group m-b-5">
                                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Пол</label>
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <p class="form-group__control-static"><?= $patient->sex == 1 ? '<i class="fa fa-male" aria-hidden="true"></i> мужской': '<i class="fa fa-female" aria-hidden="true"></i> женский'; ?></p>
                                </div>
                            </div>
                            <div class="form-group m-b-5">
                                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Семейное положение</label>
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <p class="form-group__control-static"><?= Kohana::$config->load('form_relations')[$patient->relation]; ?></p>
                                </div>
                            </div>
                            <div class="form-group m-b-5">
                                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Номер полиса ОМС или документа, его заменяющего</label>
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <p class="form-group__control-static"><?=$patient->oms; ?></p>
                                </div>
                            </div>
                            <div class="form-group m-b-5">
                                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Номер справки об инвалидности</label>
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <p class="form-group__control-static"><?=$patient->disability_certificate; ?></p>
                                </div>
                            </div>
                            <div class="form-group m-b-5">
                                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Текущие источники оплаты пребывания в пансионате</label>
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <ol class="form-group__control-static p-l-20">
                                        <? foreach (json_decode($patient->sources) as $source) : ?>
                                            <li><?= Kohana::$config->load('form_sources')[$source]; ?></li>
                                        <? endforeach; ?>
                                    </ol>
                                </div>
                            </div>
                            <div class="form-group m-b-5">
                                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Дата первичной оценки в пансионате</label>
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <p class="form-group__control-static"><?= $patient->dt_create; ?></p>
                                </div>
                            </div>
                            <div class="form-group m-b-5 p-b-10">
                                <label class="form-group__label col-xs-12 col-sm-4 col-md-3">Создатель</label>
                                <div class="col-xs-12 col-sm-8 col-md-9">
                                    <p class="form-group__control-static">
                                        <a class="link" href="<?= URL::site('profile/' . $patient->creator->id); ?>"><?=$patient->creator->name; ?></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <h3 class="section__heading">
        Последние анкетирования
    </h3>

    <div class="row">

        <?= View::factory('patients/blocks/timeline', array('surveys' => $patient->surveys, 'sameSnils' => '', 'type' => 'id'));?>

    </div>

    <input type="hidden" id="pensionID" value="<?= $patient->pension->id; ?>">
    <input type="hidden" id="patientID" value="<?= $patient->pk; ?>">

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/survey.min.js?v=<?= filemtime("assets/frontend/bundles/survey.min.js") ?>"></script>