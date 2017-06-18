<?php defined('SYSPATH') or die('No direct script access.');


Class Model_PensionPatient {

    public $pen_id;
    public $pat_id;

    public static function add($pension, $patient)
    {
        Dao_PensionsPatients::insert()
            ->set('pen_id', $pension)
            ->set('pat_id', $patient)
            ->execute();
    }

    public static function delete($pension, $patient)
    {
        Dao_PensionsPatients::delete()
            ->where('pen_id', '=', $pension)
            ->where('pat_id', '=', $patient)
            ->limit(1)
            ->execute();
    }

    public static function getPensions($patient)
    {
        $select = Dao_PensionsPatients::select()
            ->where('pat_id', '=', $patient)
            ->order_by('pen_id', 'DESC')
            ->execute();

        $pensions = array();

        if (empty($select)) return $pensions ;

        foreach ($select as $item) {
            $pensions[] = $item['pen_id'];
        }

        return $pensions;
    }

    public static function getPatients($pension)
    {
        $select = Dao_PensionsPatients::select()
            ->where('pen_id', '=', $pension)
            ->order_by('pat_id', 'ASC')
            ->execute();

        $patients = array();

        if (empty($select)) return $patients;

        foreach ($select as $item) {
            $patients[] = $item['pat_id'];
        }

        return $patients;
    }

}