<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'patient' => array(
        '1' => array(
            'name' => 'Детальный отчет (ответы на вопросы анкеты)',
            'hash' => 'fullreport',
        ),
        '2' => array(
            'name' => 'Персональный отчет',
            'hash' => 'personalreport',
        ),
        '3' => array(
            'name' => 'Отчет по шкалам RAI',
            'hash' => 'raiscalesreport',
        ),
        '4' => array(
            'name' => 'Итоговый протокол оценки',
            'hash' => 'protocolsreport',
        ),
        '5' => array(
            'name' => 'Клинический отчет по пациенту',
            'hash' => 'clinicalreport',
        )
    )

);
