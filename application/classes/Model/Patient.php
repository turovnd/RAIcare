<?php defined('SYSPATH') or die('No direct script access.');


Class Model_Patient {

    public $pk;                     // primary key - autoincrement (unique in global)
    public $id;                     // not unique in  global + getting via redis
    public $name;
    public $sex;                    // 1 - male, 2 - female
    public $birthday;
    public $relation;               // семейное положение
    public $snils;                  // номер СНИЛС
    public $oms;                    // номер полиса ОМС или документа, его заменяющего
    public $disability_certificate; // номер справки об инвалидности
    public $sources;                // текущие источники оплаты пребывания в пансионате
    public $dt_create;              // дата первичной оценки в пансионате
    public $creator;

    public function __construct($pk = null) {

        if ( !empty($pk) ) {
            $this->get_($pk);
        }

    }

    private function fill_by_row($db_selection) {

        if (empty($db_selection['pk'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }

        return $this;

    }

    
    private function get_($pk) {

        $select = Dao_Patients::select()
            ->where('pk', '=', $pk)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $pk)
            ->execute();

        return $this->fill_by_row($select);

    }


    public static function getByFieldName($field, $value) {

        $select = Dao_Patients::select()
            ->where($field, '=', $value)
            ->limit(1)
            ->execute();

        $patient = new Model_Patient($select['pk']);
        return $patient->fill_by_row($select);

    }


    public function save()
    {
        $this->dt_create = Date::formatted_time('now');

        $insert = Dao_Patients::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $insert = Dao_Patients::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->pk);
        $insert->where('pk', '=', $this->pk);

        $insert->execute();

        return $this->get_($this->pk);
    }



    public static function getAll($offset, $limit = 10, $name = "")
    {
        if ($name == "") {
            $select = Dao_Patients::select()
                ->join('Pensions_Patients')
                ->on('pk','=','pat_id')
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();

        } else {
            $select = Dao_Patients::select()
                ->or_having('name', '%' . $name . '%')
                ->or_having('snils', '%' . $name . '%')
                ->join('Pensions_Patients')
                ->on('pk','=','pat_id')
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();
        }

        $patients = array();

        if ( empty($select) ) return $patients;

        foreach ($select as $item) {
            $patient = new Model_Patient();
            $patient = $patient->fill_by_row($item);
            $patient->creator = new Model_User($patient->creator);
            $patient->pension = new Model_Pension($item['pen_id']);
            $patients[] = $patient;
        }

        return $patients;
    }


    public static function getByPension($id, $offset, $limit = 10, $name = "")
    {

        if ($name == "") {
            $select = Dao_Patients::select()
                ->join('Pensions_Patients')
                ->on('pk','=','pat_id')
                ->where('pen_id','=', $id)
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();

        } else {
            $select = Dao_Patients::select()
                ->or_having('name', '%' . $name . '%')
                ->or_having('snils', '%' . $name . '%')
                ->join('Pensions_Patients')
                ->on('pk','=','pat_id')
                ->where('pen_id','=', $id)
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();
        }


        $patients = array();

        if ( empty($select) ) return $patients;

        foreach ($select as $item) {
            $patient = new Model_Patient();
            $patient = $patient->fill_by_row($item);
            $patient->creator = new Model_User($patient->creator);
            $patient->pension = new Model_Pension($item['pen_id']);
            $patients[] = $patient;
        }

        return $patients;
    }


    public static function checkBySnilsAndPension($snils, $pension)
    {
        return (bool) Dao_Patients::select()
            ->where('snils','=', $snils)
            ->join('Pensions_Patients')
            ->on('pk','=','pat_id')
            ->where('pen_id','=', $pension)
            ->limit(1)
            ->execute();
    }

    public static function getByPensionAndID($pension, $patient)
    {
        $select = Dao_Patients::select()
            ->where('id','=', $patient)
            ->join('Pensions_Patients')
            ->on('pk','=','pat_id')
            ->where('pen_id','=', $pension)
            ->limit(1)
            ->execute();

        $patient = new Model_Patient();

        return $patient->fill_by_row($select);
    }

    public static function getSamePatients($patient)
    {
        return Dao_Patients::select(array('pen_id' , 'pat_id'))
            ->where('snils','=', $patient->snils)
            ->join('Pensions_Patients')
            ->on('pk','=','pat_id')
            ->order_by('dt_create', 'DESC')
            ->execute();

    }

}