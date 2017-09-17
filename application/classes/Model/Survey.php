<?php defined('SYSPATH') or die('No direct script access.');


Class Model_Survey {

    public $pk;         // primary key - autoincrement (unique in global)
    public $id;         // not unique in  global + getting via redis
    public $type;
    public $status;     //	1 - filling, 2 - finished, 3 - deleted
    public $patient;
    public $pension;    // pension + id - unique index for form in pension
    public $organization;
    public $dt_create;
    public $dt_finish;
    public $creator;
    public $unitA;
    public $unitB;
    public $unitC;
    public $unitD;
    public $unitE;
    public $unitF;
    public $unitG;
    public $unitH;
    public $unitI;
    public $unitJ;
    public $unitK;
    public $unitL;
    public $unitM;
    public $unitN;
    public $unitO;
    public $unitP;
    public $unitQ;
    public $unitR;

    
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

        $select = Dao_Surveys::select()
            ->where('pk', '=', $pk)
            ->limit(1)
            ->cached(Date::MINUTE * 5, $pk)
            ->execute();

        return $this->fill_by_row($select);

    }


    public static function getByFieldName($field, $value)
    {
        $select = Dao_Surveys::select()
            ->where($field, '=', $value)
            ->limit(1)
            ->execute();

        $patient = new Model_Survey($select['pk']);
        return $patient->fill_by_row($select);

    }


    public function save()
    {
        $this->dt_create = Date::formatted_time('now');
        $this->status = 1;

        $insert = Dao_Surveys::insert();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $result = $insert
            ->clearcache($this->pk)
            ->clearcache('pension_' . $this->pension . '_id_' . $this->id)
            ->clearcache('count_pension_' . $this->pension)
            ->clearcache('first_pension_' . $this->pension . '_patient_' . $this->patient)
            ->clearcache('last_pension_' . $this->pension . '_patient_' . $this->patient)
            ->clearcache('all_pension_' . $this->pension . '_patient_' . $this->patient)
            ->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $insert = Dao_Surveys::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert
            ->clearcache($this->pk)
            ->clearcache('pension_' . $this->pension . '_id_' . $this->id)
            ->clearcache('count_pension_' . $this->pension)
            ->clearcache('first_pension_' . $this->pension . '_patient_' . $this->patient)
            ->clearcache('last_pension_' . $this->pension . '_patient_' . $this->patient)
            ->clearcache('all_pension_' . $this->pension . '_patient_' . $this->patient);


        $insert->where('pk', '=', $this->pk);

        $insert->execute();

        return $this->get_($this->pk);
    }


    /**
     * Get Survey by Pension and ID
     * @param $pension - pension->id
     * @param $id - survey->id
     * @return Model_Survey
     * @internal param $patient - patient->pk
     */
    public static function getByPensionAndID($pension, $id)
    {
        $select = Dao_Surveys::select()
            ->where('pension', '=', $pension)
            ->where('id', '=', $id)
            ->cached(Date::MINUTE * 5, 'pension_' . $pension . '_id_' . $id)
            ->limit(1)
            ->execute();

        $survey = new Model_Survey();
        return $survey->fill_by_row($select);
    }

    /**
     * Get First Survey for Patient
     * @param $pension - pension->id
     * @param $patient - patient->pk
     * @return Model_Survey
     */
    public static function getFirstByPensionPatient($pension, $patient)
    {
        $select = Dao_Surveys::select()
            ->where('pension', '=', $pension)
            ->where('patient', '=', $patient)
            ->where('status', '=', 2)
            ->where('type', '=', 1)
            ->cached(Date::MINUTE * 5, 'first_pension_' . $pension . '_patient_' . $patient)
            ->limit(1)
            ->execute();

        $survey = new Model_Survey();
        return $survey->fill_by_row($select);
    }


    /**
     * Get Last Survey for Patient
     * @param $pension - pension->id
     * @param $patient - patient->pk
     * @param null $status
     * @return Model_Survey
     */
    public static function getLastByPensionPatient($pension, $patient, $status = NULL)
    {
        $select = Dao_Surveys::select()
            ->where('pension', '=', $pension)
            ->where('patient', '=', $patient);

        if ($status != NULL) {
            $select->where('status', '=', $status);
        }

        $select = $select
            ->order_by('pk', 'desc')
            ->cached(Date::MINUTE * 5, 'last_pension_' . $pension . '_patient_' . $patient)
            ->limit(1)
            ->execute();

        $survey = new Model_Survey();
        return $survey->fill_by_row($select);
    }


    /**
     * Get All Surveys for Patient
     * @param $pension - pension->id
     * @param $patient - patient->pk
     * @return array of Model_Survey
     */
    public static function getAllByPensionPatient($pension, $patient)
    {
        $select = Dao_Surveys::select()
            ->where('pension','=', $pension)
            ->where('patient','=', $patient)
            ->cached(Date::MINUTE * 5, 'all_pension_' . $pension . '_patient_' . $patient)
            ->execute();

        $surveys = array();

        if (empty($select)) return $surveys;

        foreach ($select as $db_selection) {
            $survey = new Model_Survey();
            $survey->fill_by_row($db_selection);
            $survey->dt_create_timestamp = strtotime($survey->dt_create);
            $survey->creator = new Model_User($survey->creator);
            $surveys[] = $survey;
        }

        return $surveys;
    }


    /**
     * Total Progress For Survey
     * @param $pk - survey->pk
     * @return int
     */
    public static function getTotalProgress($pk)
    {
        $survey = new Model_Survey($pk);
        $unitA = new Model_SurveyUnitA($survey->unitA);
        $unitB = new Model_SurveyUnitB($survey->unitB);
        $unitC = new Model_SurveyUnitC($survey->unitC);
        $unitD = new Model_SurveyUnitD($survey->unitD);
        $unitE = new Model_SurveyUnitE($survey->unitE);
        $unitF = new Model_SurveyUnitF($survey->unitF);
        $unitG = new Model_SurveyUnitG($survey->unitG);
        $unitH = new Model_SurveyUnitH($survey->unitH);
        $unitI = new Model_SurveyUnitI($survey->unitI);
        $unitJ = new Model_SurveyUnitJ($survey->unitJ);
        $unitK = new Model_SurveyUnitK($survey->unitK);
        $unitL = new Model_SurveyUnitL($survey->unitL);
        $unitM = new Model_SurveyUnitM($survey->unitM);
        $unitN = new Model_SurveyUnitN($survey->unitN);
        $unitO = new Model_SurveyUnitO($survey->unitO);
        $unitP = new Model_SurveyUnitP($survey->unitP);
        $unitQ = new Model_SurveyUnitQ($survey->unitQ);
        $unitR = new Model_SurveyUnitR($survey->unitR);

        $progress = 0;
        $count = 17;

        $progress += !empty($unitA->progress) ? $unitA->progress : 0;

        if ($survey->type != 1) {
            $count -= 1;
        } else {
            $progress += !empty($unitB->progress) ? $unitB->progress : 0;
        }

        $progress += !empty($unitC->progress) ? $unitC->progress : 0;

        if ($unitC->C1 == 5) {
            $count -= 3;
        } else {
            $progress += !empty($unitD->progress) ? $unitD->progress : 0;
            $progress += !empty($unitE->progress) ? $unitE->progress : 0;
            $progress += !empty($unitF->progress) ? $unitF->progress : 0;
        }

        $progress += !empty($unitG->progress) ? $unitG->progress : 0;
        $progress += !empty($unitH->progress) ? $unitH->progress : 0;
        $progress += !empty($unitI->progress) ? $unitI->progress : 0;
        $progress += !empty($unitJ->progress) ? $unitJ->progress : 0;
        $progress += !empty($unitK->progress) ? $unitK->progress : 0;
        $progress += !empty($unitL->progress) ? $unitL->progress : 0;
        $progress += !empty($unitM->progress) ? $unitM->progress : 0;
        $progress += !empty($unitN->progress) ? $unitN->progress : 0;
        $progress += !empty($unitO->progress) ? $unitO->progress : 0;
        $progress += !empty($unitP->progress) ? $unitP->progress : 0;

        if ($survey->type == 5 ) {
            $progress += !empty($unitR->progress) ? $unitR->progress : 0;
        } else {
            $progress += !empty($unitQ->progress) ? $unitQ->progress : 0;
        }

        return intval($progress / $count);
    }


    /**
     * Count Surveys By Pension
     * @param $pension - pension->id
     * @return int
     */
    public static function countByPension($pension)
    {
        $select = Dao_Surveys::select()
            ->where('pension', '=', $pension)
            ->cached(Date::MONTH * 5, 'count_pension_' . $pension)
            ->execute();

        return count($select);
    }

}