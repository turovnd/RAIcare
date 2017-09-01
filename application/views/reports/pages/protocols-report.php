<div class="section__content">


    <h3 class="section__heading">
        <a role="button" onclick="window.history.back()" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn">Назад</a>
        <a role="button" onclick="" class="btn btn--default btn--sm m-b-0 fl_r collapse-btn"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
        Итоговый протокол оценки #<?= $survey->id; ?>
    </h3>

    <div class="row">
        <div class="col-xs-12">

            <?= View::factory('reports/block/patient-info', array('survey' => $survey)); ?>

            <h3 class="section__heading">
                Протоколы клинической оценки
            </h3>

            <div class="block">
                <div class="block__body">

                    <? if ($protocols->P1 != -1) : ?>

                        <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P1 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Проблемное поведение
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P1') as $P1) : ?>

                                            <li class="p-b-10 <?= $protocols->P1 == $P1['key'] ? $P1['class'] : ''; ?>">
                                                <? if ($protocols->P1 == $P1['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P1['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <? endif; ?>

                    <? if ($protocols->P2 != -1) : ?>

                        <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P2 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Коммуникация
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P2') as $P2) : ?>

                                            <li class="p-b-10 <?= $protocols->P2 == $P2['key'] ? $P2['class'] : ''; ?>">
                                                <? if ($protocols->P2 == $P2['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P2['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <? endif; ?>

                    <? if ($protocols->P3 != -1) : ?>

                        <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P3 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Деменция
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P3') as $P3) : ?>

                                            <li class="p-b-10 <?= $protocols->P3 == $P3['key'] ? $P3['class'] : ''; ?>">
                                                <? if ($protocols->P3 == $P3['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P3['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <? endif; ?>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P4 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Настроение
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P4') as $P4) : ?>

                                            <li class="p-b-10 <?= $protocols->P4 == $P4['key'] ? $P4['class'] : ''; ?>">
                                                <? if ($protocols->P4 == $P4['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P4['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P5 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Сердечно-дыхательная недостаточность
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P5') as $P5) : ?>

                                            <li class="p-b-10 <?= $protocols->P5 == $P5['key'] ? $P5['class'] : ''; ?>">
                                                <? if ($protocols->P5 == $P5['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P5['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P6 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Дегидратация
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P6') as $P6) : ?>

                                            <li class="p-b-10 <?= $protocols->P6 == $P6['key'] ? $P6['class'] : ''; ?>">
                                                <? if ($protocols->P6 == $P6['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P6['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P7 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Падения
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P7') as $P7) : ?>

                                            <li class="p-b-10 <?= $protocols->P7 == $P7['key'] ? $P7['class'] : ''; ?>">
                                                <? if ($protocols->P7 == $P7['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P7['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P8 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Питательная трубка
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P8') as $P8) : ?>

                                            <li class="p-b-10 <?= $protocols->P8 == $P8['key'] ? $P8['class'] : ''; ?>">
                                                <? if ($protocols->P8 == $P8['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P8['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P9 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Недостаточное питание
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P9') as $P9) : ?>

                                            <li class="p-b-10 <?= $protocols->P9 == $P9['key'] ? $P9['class'] : ''; ?>">
                                                <? if ($protocols->P9 == $P9['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P9['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P10 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Повреждения
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P10') as $P10) : ?>

                                            <li class="p-b-10 <?= $protocols->P10 == $P10['key'] ? $P10['class'] : ''; ?>">
                                                <? if ($protocols->P10 == $P10['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P10['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P11 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Табак и алкоголь
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P11') as $P11) : ?>

                                            <li class="p-b-10 <?= $protocols->P11 == $P11['key'] ? $P11['class'] : ''; ?>">
                                                <? if ($protocols->P11 == $P11['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P11['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P12 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Тяжелые пролежни
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P12') as $P12) : ?>

                                            <li class="p-b-10 <?= $protocols->P12 == $P12['key'] ? $P12['class'] : ''; ?>">
                                                <? if ($protocols->P12 == $P12['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P12['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P13 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Недержание мочи
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P13') as $P13) : ?>

                                            <li class="p-b-10 <?= $protocols->P13 == $P13['key'] ? $P13['class'] : ''; ?>">
                                                <? if ($protocols->P13 == $P13['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P13['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P14 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Физическая сдержанность
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P14') as $P14) : ?>

                                            <li class="p-b-10 <?= $protocols->P14 == $P14['key'] ? $P14['class'] : ''; ?>">
                                                <? if ($protocols->P14 == $P14['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P14['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <? if ($protocols->P15 != -1) : ?>

                        <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P15 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Активность
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P15') as $P15) : ?>

                                            <li class="p-b-10 <?= $protocols->P15 == $P15['key'] ? $P15['class'] : ''; ?>">
                                                <? if ($protocols->P15 == $P15['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P15['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <? endif; ?>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P16 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Physical Activities Promotion
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P16') as $P16) : ?>

                                            <li class="p-b-10 <?= $protocols->P16 == $P16['key'] ? $P16['class'] : ''; ?>">
                                                <? if ($protocols->P16 == $P16['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P16['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P17 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Prevention
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P17') as $P17) : ?>

                                            <li class="p-b-10 <?= $protocols->P17 == $P17['key'] ? $P17['class'] : ''; ?>">
                                                <? if ($protocols->P17 == $P17['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P17['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <? if ($protocols->P18 != -1) : ?>

                        <fieldset>
                        <div class="form-group">
                            <label class="form-group__label col-xs-12">
                                <span class="fl_r f-s-1_25 <?= $protocols->P18 == 0 ? 'text-brand' : 'text-danger'; ?>"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                Cognitive Loss
                            </label>
                            <div class="col-xs-12">
                                <div class="form-group__control-static p-0">
                                    <ol start="0" class="m-0 pos-relative p-l-50">

                                        <? foreach (Kohana::$config->load('Protocols.P18') as $P18) : ?>

                                            <li class="p-b-10 <?= $protocols->P18 == $P18['key'] ? $P18['class'] : ''; ?>">
                                                <? if ($protocols->P18 == $P18['key']) : ?>
                                                    <span class="fl_l pos-absolute left-0">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </span>
                                                <? endif; ?>
                                                <?= $P18['name']; ?>
                                            </li>

                                        <? endforeach; ?>

                                    </ol>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <? endif; ?>

                </div>
            </div>

        </div>
    </div>

</div>
