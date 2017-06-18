<?php defined('SYSPATH') or die('No direct script access.');


Class Model_LongTermForm {

    public $pk;         // primary key - autoincrement (unique in global)
    public $id;         // not unique in  global + getting via redis
    public $type ;
    public $status;     //	1 - filling, 2 - finished, 3 - deleted
    public $patient;
    public $pension;    // pension + id - unique index for form in pension
    public $organization;
    public $dt_create;
    public $dt_finish;
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


    public static function getByFieldName($field, $value)
    {
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
        $this->status = 1;

        $insert = Dao_LongTermForms::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert
            ->clearcache($this->id)
            ->execute();

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

    public static function getByPatientAndPension($patient, $pension)
    {
        $select = Dao_LongTermForms::select()
            ->where('pension','=', $pension)
            ->where('patient','=', $patient)
            ->where('status','=', 1)
            ->limit(1)
            ->execute();

        $form = new Model_LongTermForm();

        return $form->fill_by_row($select);

    }

    public static function getByPatient($patient)
    {
        $select = Dao_LongTermForms::select()
            ->where('patient','=', $patient)
            ->execute();

        $forms = array();

        if (empty($select)) return $forms;

        foreach ($select as $item) {
            $form = new Model_LongTermForm();
            $form->fill_by_row($item);
            $forms[] = $form;
        }

        return $forms;
    }

}