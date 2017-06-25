<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Surveys_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Surveys_Ajax extends Ajax
{
    CONST WATCH_ALL_PATIENTS_PROFILES    = 34;
    CONST WATCH_PATIENTS_PROFILES_IN_PEN = 35;
    CONST CAN_CONDUCT_A_SURVEY           = 36;
    CONST WATCH_ALL_SURVEYS              = 37;
    CONST WATCH_SURVEY_IN_PEN            = 38;

    protected $pension  = null;
    protected $patient  = null;
    protected $survey   = null;


    public function action_new()
    {
        self::hasAccess(self::CAN_CONDUCT_A_SURVEY);

        $this->getPatientAndPensionData();
        $type    = Arr::get($_POST,'type');

        if (empty($type)) {
            $response = new Model_Response_Survey('SURVEY_TYPE_EMPTY_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $survey = Model_Survey::getFirstSurvey($this->pension->id, $this->patient->pk);
        if ($survey->id && $survey->type == $type) {
            $response = new Model_Response_Survey('SURVEY_WITH_TYPE_1_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }


        $count_forms = $this->redis->get(self::REDIS_PACKAGE . ':pensions:' . $this->pension->id . ':Surveys');
        $count_forms = $count_forms == false ? 1 : $count_forms + 1;
        $this->redis->set(self::REDIS_PACKAGE . ':pensions:' . $this->pension->id . ':Surveys', $count_forms);

        $form               = new Model_Survey();
        $form->id           = $count_forms;
        $form->patient      = $this->patient->pk;
        $form->pension      = $this->pension->id;
        $form->organization = $this->pension->organization;
        $form->type         = $type;
        $form->creator      = $this->user->id;
        $form->save();

        $response = new Model_Response_Survey('SURVEY_CREATED_SUCCESS', 'success', array('id' => $count_forms));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_get()
    {
        $patients = json_decode(Arr::get($_POST,'patients'));
        $type     = Arr::get($_POST,'type');
        $offset   = Arr::get($_POST,'offset');
        $forms = array();
        switch ($type) {
            case 'json':
                self::hasAccess(self::WATCH_ALL_PATIENTS_PROFILES);
                self::hasAccess(self::WATCH_ALL_SURVEYS);
                $formsModel = Model_Survey::getAllFormsByPatients($patients, $offset, 10);
                foreach ($formsModel as $key => $form) {
                    $forms[] = array(
                        'date' => Date('M Y', strtotime($form->dt_finish)),
                        'html' => View::factory('patients/blocks/timeline-item', array('form' => $form))->render()
                    );
                }
                break;
            case 'id':
                self::hasAccess(self::WATCH_PATIENTS_PROFILES_IN_PEN);
                self::hasAccess(self::WATCH_SURVEY_IN_PEN);
                $this->getPatientAndPensionData();
                $formsModel = Model_Survey::getAllFormsByPatientAndPension($this->patient->pk, $this->pension->id, $offset, 10);
                foreach ($formsModel as $key => $form) {
                    $forms[] = array(
                        'date' => Date('M Y', strtotime($form->dt_finish)),
                        'html' => View::factory('patients/blocks/timeline-item', array('form' => $form))->render()
                    );
                }
                break;
        }

        $response = new Model_Response_Survey('SURVEY_GET_SUCCESS', 'success', array('forms' => $forms, 'number' => count($forms)));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_search()
    {
        self::hasAccess(self::WATCH_ALL_SURVEYS);
        $name   = Arr::get($_POST,'name');
        $offset = Arr::get($_POST,'offset');

        $surveys = Model_Survey::searchForms($offset, 10, $name);

        $html = "";
        foreach ($surveys as $survey) {
            $html .= View::factory('surveys/blocks/search-block', array('survey' => $survey))->render();
        }

        $response = new Model_Response_Survey('SURVEY_GET_SUCCESS', 'success', array('html' => $html, 'number' => count($surveys)));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_getunit()
    {
        self::hasAccess(self::CAN_CONDUCT_A_SURVEY);

        $unit = Arr::get($_POST,'unit');

        $this->getSurvey();
        //$this->checkUnit($unit);

        $html = View::factory('surveys/units/' . $unit, array('survey' => $this->survey, 'can_conduct' => true))->render();

        $response = new Model_Response_Survey('SURVEY_UNIT_GET_SUCCESS', 'success', array('html' => $html));
        $this->response->body(@json_encode($response->get_response()));
    }

    private function getPatientAndPensionData()
    {
        $pension = Arr::get($_POST,'pension');
        $patient = Arr::get($_POST,'patient');

        $this->pension = new Model_Pension($pension);

        if (!$this->pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $usersIDs = Model_UserPension::getUsers($this->pension->id);

        if (!(in_array($this->user->id, $usersIDs))) {
            throw new HTTP_Exception_403();
        }

        $this->patient = new Model_Patient($patient);

        if (!$this->patient->pk) {
            $response = new Model_Response_Patients('PATIENTS_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }
    }

    private function getSurvey()
    {
        $survey  = Arr::get($_POST,'survey');
        $pension = Arr::get($_POST,'pension');
        $this->survey = new Model_Survey($survey);

        if (!$this->survey->id || $this->survey->pension != $pension || $this->survey->status == 3) {
            $response = new Model_Response_Survey('SURVEY_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($this->survey->status == 1 && strtotime(Date::formatted_time('now')) - strtotime($this->survey->dt_create) > Date::DAY * 3) {
            $this->survey->status= 3;
            $this->survey->update();
            $response = new Model_Response_Survey('SURVEY_HAS_BEEN_DELETED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $first_survey = Model_Survey::getFirstSurvey($this->survey->pension, $this->survey->patient);
        $this->survey->dt_first_survey = $first_survey->dt_create;
        $this->survey->unitB = new Model_SurveyUnitB($this->survey->pk);
        $this->survey->unitC = new Model_SurveyUnitC($this->survey->pk);
        $this->survey->unitD = new Model_SurveyUnitD($this->survey->pk);
        $this->survey->unitE = new Model_SurveyUnitE($this->survey->pk);
        $this->survey->unitF = new Model_SurveyUnitF($this->survey->pk);
        $this->survey->unitG = new Model_SurveyUnitG($this->survey->pk);
        $this->survey->pension = new Model_Pension($this->survey->pension);
        $this->survey->patient = new Model_Patient($this->survey->patient);
        $this->survey->patient->can_edit = true;
        $this->survey->patient->creator = new Model_User($this->survey->patient->creator);
    }



    /**
     * Update
     */
    public function action_updateunit()
    {
        self::hasAccess(self::CAN_CONDUCT_A_SURVEY);

        $unit = Arr::get($_POST,'unit');

        $this->getSurvey();
        //$this->checkUnit($unit);

        switch ($unit) {
            case 'unitA': $this->update_unitA(); break;
            case 'unitB': $this->update_unitB(); break;
            case 'unitC': $this->update_unitC(); break;
            case 'unitD': $this->update_unitD(); break;
            case 'unitE': $this->update_unitE(); break;
            case 'unitF': $this->update_unitF(); break;
            case 'unitG': $this->update_unitG(); break;
        }
    }


    private function update_unitA()
    {
        $A10 = Arr::get($_POST,'A10');
        $A11 = Arr::get($_POST,'A11');

        $survey = new Model_Survey($this->survey->pk);

        $survey->A10 = $A10;
        $survey->A11 = $A11;
        $survey->update();

        if (empty($survey->A10) || empty($survey->A11))
        {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitB()
    {

        $B1 = Arr::get($_POST,'B1');
        $B2 = Arr::get($_POST,'B2');
        $B3 = json_encode(Arr::get($_POST,'B3'));
        $B4 = Arr::get($_POST,'B4');
        $B5a = Arr::get($_POST,'B5b');
        $B5b = Arr::get($_POST,'B5a');
        $B6 = Arr::get($_POST,'B6');
        $B7 = Arr::get($_POST,'B7');
        $B8 = json_encode(Arr::get($_POST,'B8'));
        $B9 = Arr::get($_POST,'B9');

        if (!empty($B6) && (!Valid::exact_length($B6, 9) || !Valid::digit($B6))) {
            $response = new Model_Response_Survey('SURVEY_UNIT_POST_CODE_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $unitB = new Model_SurveyUnitB($this->survey->pk);

        if (!$unitB->pk) {
            $unitB = new Model_SurveyUnitB();
        }

        $unitB->B1 = $B1;
        $unitB->B2 = $B2;
        $unitB->B3 = $B3;
        $unitB->B4 = $B4;
        $unitB->B5a = $B5a;
        $unitB->B5b = $B5b;
        $unitB->B6 = $B6;
        $unitB->B7 = $B7;
        $unitB->B8 = $B8;
        $unitB->B9 = $B9;

        if (!$unitB->pk) {
            $unitB->pk = $this->survey->pk;
            $unitB->save();
        } else {
            $unitB->update();
        }

        if (empty($unitB->B1) || empty($unitB->B2) || empty($unitB->B3) || $unitB->B3 == "null" || empty($unitB->B4) || empty($unitB->B5a)
            || empty($unitB->B5b) || empty($unitB->B6) || empty($unitB->B7) || empty($unitB->B8) || $unitB->B8 == "null"  || $unitB->B9 == NULL)
        {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitC()
    {
        $C1  = Arr::get($_POST,'C1');
        $C2  = json_encode(Arr::get($_POST,'C2'));
        $C3a = Arr::get($_POST,'C3a');
        $C3b = Arr::get($_POST,'C3b');
        $C3c = Arr::get($_POST,'C3c');
        $C4  = Arr::get($_POST,'C4');
        $C5  = Arr::get($_POST,'C5');

        $unitC = new Model_SurveyUnitC($this->survey->pk);

        $need_update = false;
        if ($unitC->C1 == 5 && $C1 != 5 || $unitC->C1 != 5 && $C1 ==5) $need_update = true;

        if (!$unitC->pk) {
            $unitC = new Model_SurveyUnitC();
        }

        $unitC->C1 = $C1;
        if ($C1 == 5) goto finish;

        $unitC->C2 = $C2;
        $unitC->C3a = $C3a;
        $unitC->C3b = $C3b;
        $unitC->C3c = $C3c;
        $unitC->C4 = $C4;
        $unitC->C5 = $C5;

        finish:
        if (!$unitC->pk) {
            $unitC->pk = $this->survey->pk;
            $unitC->save();
        } else {
            $unitC->update();
        }

        if ($need_update) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WITH_REFRESH_SUCCESS', 'success');
        } else if (empty($unitC->C1) || empty($unitC->C2) || $unitC->C2 == "null" || empty($unitC->C3a)
            || empty($unitC->C3b) || empty($unitC->C3c) || empty($unitC->C4) || empty($unitC->C5) )
        {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitD()
    {
        $D1  = Arr::get($_POST,'D1');
        $D2  = Arr::get($_POST,'D2');
        $D3a = Arr::get($_POST,'D4a');
        $D3b = Arr::get($_POST,'D4b');
        $D4a = Arr::get($_POST,'D4a');
        $D4b = Arr::get($_POST,'D4b');

        $unitD = new Model_SurveyUnitD($this->survey->pk);

        if (!$unitD->pk) {
            $unitD = new Model_SurveyUnitD();
        }

        $unitD->D1 = $D1;
        $unitD->D2 = $D2;
        $unitD->D3a = $D3a;
        $unitD->D3b = $D3b;
        $unitD->D4a = $D4a;
        $unitD->D4b = $D4b;

        if (!$unitD->pk) {
            $unitD->pk = $this->survey->pk;
            $unitD->save();
        } else {
            $unitD->update();
        }

        if (empty($unitD->D1) || empty($unitD->D2) || empty($unitD->D3a)
            || empty($unitD->D3b) || empty($unitD->D4a) || empty($unitD->D4b))
        {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitE()
    {
        $E1 = Arr::get($_POST,'E1');
        $E2 = Arr::get($_POST,'E2');
        $E3 = Arr::get($_POST,'E3');

        $unitE = new Model_SurveyUnitE($this->survey->pk);

        if (!$unitE->pk) {
            $unitE = new Model_SurveyUnitE();
        }

        $unitE->E1 = json_encode($E1);
        $unitE->E2 = json_encode($E2);
        $unitE->E3 = json_encode($E3);

        if (!$unitE->pk) {
            $unitE->pk = $this->survey->pk;
            $unitE->save();
        } else {
            $unitE->update();
        }

        $empty = false;
        if (!$empty) { foreach ($E1 as $e1) { if ($e1 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($E2 as $e2) { if ($e2 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($E3 as $e3) { if ($e3 == -1) { $empty = true; break; } } }

        if ($empty) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitF()
    {
        $F1 = Arr::get($_POST,'F1');
        $F2 = Arr::get($_POST,'F2');
        $F3 = Arr::get($_POST,'F3');
        $F4 = Arr::get($_POST,'F4');
        $F5 = Arr::get($_POST,'F5');

        $unitF = new Model_SurveyUnitF($this->survey->pk);

        if (!$unitF->pk) {
            $unitF = new Model_SurveyUnitF();
        }

        $unitF->F1 = json_encode($F1);
        $unitF->F2 = json_encode($F2);
        $unitF->F3 = json_encode($F3);
        $unitF->F4 = json_encode($F4);
        $unitF->F5 = json_encode($F5);

        if (!$unitF->pk) {
            $unitF->pk = $this->survey->pk;
            $unitF->save();
        } else {
            $unitF->update();
        }

        $empty = false;
        if (!$empty) { foreach ($F1 as $f1) { if ($f1 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($F2 as $f2) { if ($f2 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($F3 as $f3) { if ($f3 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($F5 as $f5) { if ($f5 == -1) { $empty = true; break; } } }

        if ($empty) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitG()
    {
        $G1 = Arr::get($_POST,'G1');
        $G2 = Arr::get($_POST,'G2');
        $G3 = Arr::get($_POST,'G3');
        $G4 = Arr::get($_POST,'G4');
        $G5 = Arr::get($_POST,'G5');

        $unitG = new Model_SurveyUnitG($this->survey->pk);

        if (!$unitG->pk) {
            $unitG = new Model_SurveyUnitG();
        }

        $unitG->G1 = json_encode($G1);
        $unitG->G2 = json_encode($G2);
        $unitG->G3 = json_encode($G3);
        $unitG->G4 = json_encode($G4);
        $unitG->G5 = $G5;

        if ($G2[1] != -1 && !($G2[1] < 30 || $G2[1] == 30 || $G2[1] == 77 || $G2[1] == 88 || $G2[1] == 99)) {
            $response = new Model_Response_Survey('SURVEY_UNIT_G2B_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!$unitG->pk) {
            $unitG->pk = $this->survey->pk;
            $unitG->save();
        } else {
            $unitG->update();
        }

        $empty = false;
        if (!$empty) { foreach ($G1 as $g1) { if ($g1 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($G2 as $g2) { if ($g2 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($G3 as $g3) { if ($g3 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($G4 as $g4) { if ($g4 == -1) { $empty = true; break; } } }
        if (!$empty) { if ($G5 == -1) { $empty = true; } }

        if ($empty) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

}
