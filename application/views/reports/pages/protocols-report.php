<div class="section__content">


    <h3 class="section__heading">
        <a role="button" onclick="window.history.back()" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn">Назад</a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-print" aria-hidden="true"></i></a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>

        <? // WATCH_ALL_SURVEYS = 37
        if (in_array(37, $user->permissions)) : ?>
            Итоговый протокол оценки #<?= $survey->pk; ?>
        <? else: ?>
            Итоговый протокол оценки #<?= $survey->id; ?>
        <? endif; ?>

    </h3>

    <div class="row">
        <div class="col-xs-12">

            <?= View::factory('reports/block/patient-info', array('survey' => $survey)); ?>

            <h3 class="section__heading">
                Протоколы клинической оценки
            </h3>

            <div class="block">
                <div class="block__body">

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P1 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Проблемное поведение
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P1 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P1 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P1 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P1 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - снижение инцидентов ежедневного проблемного поведения
                                        </li>
                                        <li class="<?= $report->P1 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P1 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - предотвращение ежедневных инцидентов проблемного поведения
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P2 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Коммуникация
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P2 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P2 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P2 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P2 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - потенциал для улучшения
                                        </li>
                                        <li class="<?= $report->P2 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P2 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - риск снижения
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P3 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Деменция
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P3 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P3 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P3 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P3 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P4 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Настроение
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P4 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P4 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P4 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P4 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - низкий риск
                                        </li>
                                        <li class="p-b-10 <?= $report->P4 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P4 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - высокий риск
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P5 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Сердечно-дыхательная недостаточность
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P5 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P5 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P5 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P5 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P6 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Дегидратация
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P6 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P6 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P6 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P6 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - низкий уровень дегидратация
                                        </li>
                                        <li class="p-b-10 <?= $report->P6 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P6 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - высокий уровень дегидратация
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P7 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Падения
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P7 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P7 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P7 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P7 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - низкий риск
                                        </li>
                                        <li class="p-b-10 <?= $report->P7 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P7 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - высокий риск
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P8 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Питательная трубка
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P8 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P8 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P8 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P8 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - низкий риск
                                        </li>
                                        <li class="p-b-10 <?= $report->P8 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P8 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - высокий риск
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P9 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Недостаточное питание
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P9 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P9 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P9 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P9 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - в зоне риска
                                        </li>
                                        <li class="p-b-10 <?= $report->P9 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P9 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - в зоне высокого риск
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P10 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Повреждения
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P10 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P10 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P10 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P10 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - средний приоритет
                                        </li>
                                        <li class="p-b-10 <?= $report->P10 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P10 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - высокий приоритет
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P11 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Табак и алкоголь
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P11 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P11 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P11 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P11 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P12 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Тяжелые пролежни
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P12 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P12 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P12 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P12 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - has stage 2 ulcer
                                        </li>
                                        <li class="p-b-10 <?= $report->P12 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P12 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - at risk, has stage 1 ulcer
                                        </li>
                                        <li class="p-b-10 <?= $report->P12 == 3 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P12 == 3) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - at risk, no ulcer now
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P13 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Недержание мочи
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P13 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P13 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено - poor decision making at baseline
                                        </li>
                                        <li class="p-b-10 <?= $report->P13 == 1 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P13 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено - continent at baseline
                                        </li>
                                        <li class="p-b-10 <?= $report->P13 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P13 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - prevent decline
                                        </li>
                                        <li class="p-b-10 <?= $report->P13 == 3 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P13 == 3) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено -  facilitate improvement
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P14 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Физическая сдержанность
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P14 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P14 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P14 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P14 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - Little ADL ability
                                        </li>
                                        <li class="p-b-10 <?= $report->P14 == 2 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P14 == 2) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено - ADL ability present
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $report->P15 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Активность
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">
                                        <li class="p-b-10 <?= $report->P15 == 0 ? 'text-brand' : ''; ?>">
                                            <? if ($report->P15 == 0) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Не выявлено
                                        </li>
                                        <li class="p-b-10 <?= $report->P15 == 1 ? 'text-danger' : ''; ?>">
                                            <? if ($report->P15 == 1) : ?>
                                                <span class="fl_l pos-absolute left-0">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </span>
                                            <? endif; ?>
                                            Выявлено
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </div>
            </div>

        </div>
    </div>

</div>
