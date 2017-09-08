<?php defined('SYSPATH') or die('No direct script access.');


Class Model_ReportRAIScales {

    public $pk;         // primary key - copy from survey.pk
    public $id;         // copy from survey.id
    public $pension;    // pension.id
    public $PURS;       // Pressure Ulcer Risk Scale
    public $CPS;        // Cognitive Performance Scale
    public $BMI;        // Body Mass Index
    public $SRD;        // Self Rated Depression
    public $DRS;        // Depression Rating Scale
    public $Pain;       // Pain Scale
    public $COMM;       // Communication Scale
    public $CHESS;      // Changes in Health, End-Stage Disease, Signs, and Symptoms Scale
    public $ADLH;       // Activities of Daily Living (Hierarchy)
    public $ABS;        // Aggressive Behaviour Scale
    public $ADLLF;      // Activities of Daily Living (Long Form)

    public function __construct($id = null) {

        if ( !empty($id) ) {
            $this->get_($id);
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

        $select = Dao_ReportsRAIScales::select()
            ->where('pk', '=', $pk)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $pk)
            ->execute();

        return $this->fill_by_row($select);
    }

    public function save()
    {
        $insert = Dao_ReportsRAIScales::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert
            ->clearcache($this->pk)
            ->execute();

        return $this->get_($result);
    }

    public static function delete($pk)
    {
        Dao_ReportsRAIScales::delete()
            ->where('pk', '=', $pk)
            ->clearcache($pk)
            ->execute();
    }


}