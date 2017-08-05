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
            ->clearcache($this->patient)
            ->clearcache($this->pk)
            ->execute();

        return $this->get_($result);
    }

    public function update()
    {
        $insert = Dao_Surveys::update();

        foreach ($this as $fieldname => $value) {
            if (property_exists($this, $fieldname)) $insert->set($fieldname, $value);
        }

        $insert->clearcache($this->pk)
               ->clearcache($this->patient);

        $insert->where('pk', '=', $this->pk);

        $insert->execute();

        return $this->get_($this->pk);
    }

    public static function getFillingSurveyByPatientAndPension($patient, $pension)
    {
        $select = Dao_Surveys::select()
            ->where('pension','=', $pension)
            ->where('patient','=', $patient)
            ->where('status','=', 1)
            ->limit(1)
            ->execute();

        $form = new Model_Survey();

        return $form->fill_by_row($select);

    }

    public static function getAll($offset, $limit)
    {
        $select = Dao_Surveys::select()
            ->offset($offset)
            ->limit($limit)
            ->execute();

        $forms = array();

        if (empty($select)) return $forms;

        foreach ($select as $item) {
            $form = new Model_Survey();
            $form->fill_by_row($item);
            $form->organization = new Model_Organization($form->organization);
            $form->pension = new Model_Pension($form->pension);
            $form->patient = new Model_Patient($form->patient);
            $form->creator = new Model_User($form->creator);
            $forms[] = $form;
        }

        return $forms;
    }



    public static function getAllSurveysByPatientAndPension($patient, $pension, $offset, $limit)
    {
        $select = Dao_Surveys::select()
            ->where('pension','=', $pension)
            ->where('patient','=', $patient)
            ->where('status','=', 2)
            ->offset($offset)
            ->limit($limit)
            ->order_by('dt_finish', 'DESC')
            ->execute();

        $forms = array();

        if (empty($select)) return $forms;

        foreach ($select as $item) {
            $form = new Model_Survey();
            $form->fill_by_row($item);
            $form->organization = new Model_Organization($form->organization);
            $form->pension = new Model_Pension($form->pension);
            $form->creator = new Model_User($form->creator);
            $form->creator->role = new Model_Role($form->creator->role);
            $forms[] = $form;
        }

        return $forms;
    }



    public static function searchForms($offset, $limit, $name)
    {
        if ($name == "") {
            $select = Dao_Surveys::select('pk')
                ->offset($offset)
                ->limit($limit)
                ->execute();
        } else {
            echo Debug::vars();

            $select = DB::query(Database::SELECT,
                'SELECT `Surveys`.`pk` AS `pk` '.
                    'FROM `Surveys` '.
                        'JOIN `Patients` ON (`Surveys`.`patient` = `Patients`.`pk`)'.
                        'JOIN `Pensions` ON (`Surveys`.`pension` = `Pensions`.`id`)'.
                    'WHERE `Patients`.`name` LIKE \'%'. $name .'%\' '.
                        'OR `Pensions`.`name` LIKE \'%'. $name .'%\' '.
                    ' LIMIT '. $limit .
                    ' OFFSET '. $offset)
                ->execute()
                ->as_array();
        }

        $forms = array();

        if (empty($select)) return $forms;

        foreach ($select as $item) {
            $form = new Model_Survey($item['pk']);
            $form->organization = new Model_Organization($form->organization);
            $form->patient = new Model_Patient($form->patient);
            $form->pension = new Model_Pension($form->pension);
            $form->creator = new Model_User($form->creator);
            $forms[] = $form;
        }

        return $forms;
    }




    public static function getAllFormsByPatients($patients, $offset, $limit)
    {
        $sql = "";
        $key = 0;

        foreach ($patients as $patient) {
            $key++;
            if ($key == count($patients)) {
                $sql .= '`patient` = ' . $patient;
            } else {
                $sql .= '`patient` = ' . $patient . ' OR ';
            }
        }

        $select = DB::query(Database::SELECT,'SELECT * from Surveys WHERE `status` = 2 AND (' . $sql . ') ORDER BY `dt_finish` DESC LIMIT ' .  $offset . ', ' . $limit)
            ->execute()
            ->as_array();

        $forms = array();

        if (empty($select)) return $forms;

        foreach ($select as $item) {
            $form = new Model_Survey();
            $form->fill_by_row($item);
            $form->organization = new Model_Organization($form->organization);
            $form->pension = new Model_Pension($form->pension);
            $form->creator = new Model_User($form->creator);
            $form->creator->role = new Model_Role($form->creator->role);
            $forms[] = $form;
        }

        return $forms;
    }


    public static function getFirstSurvey($pension, $patient)
    {
        $select = Dao_Surveys::select()
            ->where('pension', '=', $pension)
            ->where('patient', '=', $patient)
            ->where('status', '=', 2)
            ->where('type', '=', 1)
            ->limit(1)
            ->execute();

        $survey = new Model_Survey();
        return $survey->fill_by_row($select);
    }

    public static function getProgress($pk)
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

}