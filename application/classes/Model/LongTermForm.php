<?php defined('SYSPATH') or die('No direct script access.');


Class Model_LongTermForm {

    public $id;
    public $type;
    public $patient;
    public $pension;
    public $dt_create;
    public $creator;

    
    public function __construct($id = null) {

        if ( !empty($id) ) {
            $this->get_($id);
        }

    }

    private function fill_by_row($db_selection) {

        if (empty($db_selection['id'])) return $this;

        foreach ($db_selection as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $this->$fieldname = $value;
        }

        return $this;

    }

    
    private function get_($id) {

        $select = Dao_LongTermForms::select()
            ->where('id', '=', $id)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $id)
            ->execute();

        return $this->fill_by_row($select);

    }


    public static function getByFieldName($field, $value) {

        $select = Dao_LongTermForms::select()
            ->where($field, '=', $value)
            ->limit(1)
            ->execute();

        $patient = new Model_LongTermForm($select['id']);
        return $patient->fill_by_row($select);

    }


    public function save()
    {
        $this->dt_create = Date::formatted_time('now');

        $insert = Dao_LongTermForms::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $insert = Dao_LongTermForms::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->id);
        $insert->where('id', '=', $this->id);

        $insert->execute();

        return $this->get_($this->id);
    }



    public static function getAll($offset, $limit = 10, $name = "")
    {
        if ($name == "") {
            $select = Dao_LongTermForms::select()
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();

        } else {
            $select = Dao_LongTermForms::select()
                ->where('name','LIKE', '%' . $name . '%')
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();
        }

        $patients = array();

        if ( empty($select) ) return $patients;

        foreach ($select as $item) {
            $patient = new Model_LongTermForm();
            $patient = $patient->fill_by_row($item);
            $patients[] = $patient;
        }

        return $patients;
    }


    public static function getByPension($id, $offset, $limit = 10, $name = "")
    {

        if ($name == "") {
            $select = Dao_LongTermForms::select()
                ->where('pension','=', $id)
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();

        } else {
            $select = Dao_LongTermForms::select()
                ->where('pension','=', $id)
                ->or_having('name', '%' . $name . '%')
                ->or_having('snils', '%' . $name . '%')
                ->order_by('dt_create', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->execute();
        }


        $patients = array();

        if ( empty($select) ) return $patients;

        foreach ($select as $item) {
            $patient = new Model_LongTermForm();
            $patient = $patient->fill_by_row($item);
            $patient->pension = new Model_Pension($patient->pension);
            $patient->creator = new Model_User($patient->creator);
            $patients[] = $patient;
        }

        return $patients;
    }


    public static function checkBySnilsAndPension($snils, $pension)
    {
        return (bool) Dao_LongTermForms::select()
            ->where('pension','=', $pension)
            ->where('snils','=', $snils)
            ->limit(1)
            ->execute();
    }

}