<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(

    'PURS' => array(
        '0' => array(
            'name' => '0 Very low risk',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 - 2 Low risk',
            'key'  => array(1, 2),
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '3 Moderate risk',
            'key'  => 3,
            'class' => 'text-brand'
        ),
        '3' => array(
            'name' => '4 - 5 High risk',
            'key'  => array(4, 5),
            'class' => 'text-danger'
        ),
        '4' => array(
            'name' => '6 - 8 Very high risk',
            'key'  => array(6, 7, 8),
            'class' => 'text-danger'
        ),
    ),

    'CPS' => array(
        '0' => array(
            'name' => '0 Intact',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 Borderline intact',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '2 Mild impairment',
            'key'  => 2,
            'class' => 'text-brand'
        ),
        '3' => array(
            'name' => '3 Moderate impairment',
            'key'  => 3,
            'class' => 'text-brand'
        ),
        '4' => array(
            'name' => '4 Moderate / severe impairment',
            'key'  => 4,
            'class' => 'text-danger'
        ),
        '5' => array(
            'name' => '5 Severe impairment',
            'key'  => 5,
            'class' => 'text-danger'
        ),
        '6' => array(
            'name' => '6 Very severe impairment',
            'key'  => 6,
            'class' => 'text-danger'
        ),
    ),

    'BMI' => array(
        '0' => array(
            'name' => '20 Minimum for normal BMI ',
            'key'  => 20,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '25 Maximum for normal BMI',
            'key'  => 25,
            'class' => 'text-brand'
        )
    ),

    'DRS' => array(
        '0' => array(
            'name' => '0 - 2 No depression',
            'key'  => array(0,1,2),
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '3 - 8 Depressive symptoms, likelihood of at least mild depression',
            'key'  => array(3,4,5,6,7,8),
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '9 - 14 Depressive symptoms, high likelihood of major depression',
            'key'  => array(9,10,11,12,13,14),
            'class' => 'text-danger'
        ),
    ),

    'Pain' => array(
        '0' => array(
            'name' => '0 No pain',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 Less than daily pain',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '2 Daily pain but not severe',
            'key'  => 2,
            'class' => 'text-brand'
        ),
        '3' => array(
            'name' => '3 Daily severe pain',
            'key'  => 3,
            'class' => 'text-danger'
        ),
        '4' => array(
            'name' => '4 Daily excruciating pain',
            'key'  => 4,
            'class' => 'text-danger'
        ),
    ),

    'COMM' => array(
        '0' => array(
            'name' => '0 Intact',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 Borderline intact',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '2 Mild impairment',
            'key'  => 2,
            'class' => 'text-brand'
        ),
        '3' => array(
            'name' => '3 Mild / moderate impairment',
            'key'  => 3,
            'class' => 'text-brand'
        ),
        '4' => array(
            'name' => '4 Moderate impairment',
            'key'  => 4,
            'class' => 'text-danger'
        ),
        '5' => array(
            'name' => '5 Moderate / severe impairment',
            'key'  => 5,
            'class' => 'text-danger'
        ),
        '6' => array(
            'name' => '6 Severe impairment',
            'key'  => 6,
            'class' => 'text-danger'
        ),
        '7' => array(
            'name' => '7 Severe / very severe impairment',
            'key'  => 7,
            'class' => 'text-danger'
        ),
        '8' => array(
            'name' => '8 Very severe impairment',
            'key'  => 8,
            'class' => 'text-danger'
        ),
    ),

    'CHESS' => array(
        '0' => array(
            'name' => '0 No health instability',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 Minimal health instability',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '2 Low health instability',
            'key'  => 2,
            'class' => 'text-brand'
        ),
        '3' => array(
            'name' => '3 Moderate health instability',
            'key'  => 3,
            'class' => 'text-brand'
        ),
        '4' => array(
            'name' => '4 High health instability',
            'key'  => 4,
            'class' => 'text-danger'
        ),
        '5' => array(
            'name' => '5 Very high health instability',
            'key'  => 5,
            'class' => 'text-danger'
        ),
    ),

    'ADLH' => array(
        '0' => array(
            'name' => '0 Independent',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 Supervision required',
            'key'  => 1,
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '2 Limited impairment',
            'key'  => 2,
            'class' => 'text-brand'
        ),
        '3' => array(
            'name' => '3 Maximal',
            'key'  => 3,
            'class' => 'text-brand'
        ),
        '4' => array(
            'name' => '4 Extensive assistance required - 1',
            'key'  => 4,
            'class' => 'text-danger'
        ),
        '5' => array(
            'name' => '5 Dependent',
            'key'  => 5,
            'class' => 'text-danger'
        ),
        '6' => array(
            'name' => '6 Total dependence',
            'key'  => 6,
            'class' => 'text-danger'
        ),
    ),

    'ABS' => array(
        '0' => array(
            'name' => '0 No aggressive behavior',
            'key'  => 0,
            'class' => 'text-brand'
        ),
        '1' => array(
            'name' => '1 - 5 Mild to moderate aggressive behavior',
            'key'  => array(1,2,3,4,5),
            'class' => 'text-brand'
        ),
        '2' => array(
            'name' => '6 - 12 Severe aggressive behavior',
            'key'  => array(6,7,8,9,10,11,12),
            'class' => 'text-danger'
        ),
    ),

);