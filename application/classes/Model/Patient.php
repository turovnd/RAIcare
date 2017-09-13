<?php defined('SYSPATH') or die('No direct script access.');


Class Model_Patient {

    public $pk;                     // primary key - autoincrement (unique in global)
    public $id;                     // not unique in  global + getting via redis
    public $pension;
    public $name;
    public $status;                 // 1 - в пансионате, 2 - в архиве
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

    public function fill_by_row($db_selection) {

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

        $insert
            ->clearcache($this->pk)
            ->clearcache('id_' . $this->id)
            ->clearcache('pension_' . $this->pension)
            ->clearcache('pension_' . $this->pension . '_status_' . $this->status)
            ->clearcache('count_pension_' . $this->pension);

        $result = $insert->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $insert = Dao_Patients::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert
            ->clearcache($this->pk)
            ->clearcache('id_' . $this->id)
            ->clearcache('pension_' . $this->pension)
            ->clearcache('pension_' . $this->pension . '_status_' . $this->status)
            ->clearcache('count_pension_' . $this->pension);

        $insert->where('pk', '=', $this->pk);

        $insert->execute();

        return $this->get_($this->pk);
    }


    /**
     * Get All Patients by Pension and Status
     * @param $pension - pension->id
     * @param $status - patient->status
     * @param bool $as_model
     * @return array|Dao_Patients
     */
    public static function getAllByPensionStatus($pension, $status, $as_model = true)
    {
        $select = Dao_Patients::select()
            ->where('pension','=', $pension)
            ->where('status','=', $status)
            ->order_by('id', 'ASC')
            ->cached(Date::MINUTE * 5, 'pension_' . $pension . '_status_' . $status)
            ->execute();

        $patients = array();

        if (empty($select)) return $patients;

        if (!$as_model) return $select;

        foreach ($select as $db_selection) {
            $patient = new Model_Patient();
            $patients[] = $patient->fill_by_row($db_selection);
        }

        return $patients;
    }

    /**
     * Get All Patients by Pension
     * @param $pension - pension->id
     * @return array of Model_Patient
     */
    public static function getAllByPension($pension)
    {
        $select = Dao_Patients::select()
            ->where('pension', '=', $pension)
            ->cached(Date::MINUTE * 5, 'pension_' . $pension)
            ->execute();

        $patients = array();

        if (empty($select)) return $patients;

        foreach ($select as $key => $db_selection) {
            $patient = new Model_Patient();
            $patients[$key] = $patient->fill_by_row($db_selection);
            $patients[$key]->age = intval((time()-strtotime($patients[$key]->birthday))/Date::YEAR);
        }

        return $patients;
    }


    /**
     * Get Patent
     * @param $pension - pension->id
     * @param $patient - patient->id
     * @return Model_Patient
     */
    public static function getByPensionPatID($pension, $patient)
    {
        $select = Dao_Patients::select()
            ->where('id','=', $patient)
            ->where('pension','=', $pension)
            ->cached(Date::MINUTE * 5, 'id_' . $patient)
            ->limit(1)
            ->execute();

        $patient = new Model_Patient();
        return $patient->fill_by_row($select);
    }


    /**
     * Check Patient SNILS on exist
     * @param $snils - patient->snils
     * @param $pension - pension->id
     * @return bool
     */
    public static function checkBySnilsAndPension($snils, $pension)
    {
        return (bool) Dao_Patients::select()
            ->where('snils','=', $snils)
            ->where('pension','=', $pension)
            ->limit(1)
            ->execute();
    }


    /**
     * Count Patients By Pension
     * @param $pension - pension->id
     * @return int
     */
    public static function countByPension($pension)
    {
        $select = Dao_Patients::select()
            ->where('pension', '=', $pension)
            ->cached(Date::MONTH * 5, 'count_pension_' . $pension)
            ->execute();

        return count($select);
    }

}