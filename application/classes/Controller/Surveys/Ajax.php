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
        $type = Arr::get($_POST,'type');

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

        $first_survey = Model_Survey::getFirstSurvey($this->pension->id, $this->patient->id);
//echo Debug::vars($first_survey );
        $survey               = new Model_Survey();
        $survey->id           = $count_forms;
        $survey->patient      = $this->patient->pk;
        $survey->pension      = $this->pension->id;
        $survey->organization = $this->pension->organization;
        $survey->type         = $type;
        $survey->creator      = $this->user->id;
        $survey->unitB        = $first_survey->unitB;
        $survey->save();

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
        $this->getSurveyUnits();

        $this->survey->pension = new Model_Pension($this->survey->pension);
        $this->survey->patient = new Model_Patient($this->survey->patient);
        $this->survey->patient->can_edit = true;
        $this->survey->patient->creator = new Model_User($this->survey->patient->creator);


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

        if (!$this->survey->pk || $this->survey->pension != $pension || $this->survey->status == 3) {
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
    }

    private function getSurveyUnits()
    {
        $first_survey = Model_Survey::getFirstSurvey($this->survey->pension, $this->survey->patient);
        $this->survey->dt_first_survey = !empty($first_survey->pk) ? $first_survey->dt_create : $this->survey->dt_create;

        $this->survey->unitA = new Model_SurveyUnitA($this->survey->unitA);

        if ($this->survey->type == 1)
            $this->survey->unitB = new Model_SurveyUnitB($this->survey->unitB);

        $this->survey->unitC = new Model_SurveyUnitC($this->survey->unitC);
        $this->survey->unitD = new Model_SurveyUnitD($this->survey->unitD);
        $this->survey->unitE = new Model_SurveyUnitE($this->survey->unitE);
        $this->survey->unitF = new Model_SurveyUnitF($this->survey->unitF);
        $this->survey->unitG = new Model_SurveyUnitG($this->survey->unitG);
        $this->survey->unitH = new Model_SurveyUnitH($this->survey->unitH);
        $this->survey->unitI = new Model_SurveyUnitI($this->survey->unitI);
        $this->survey->unitJ = new Model_SurveyUnitJ($this->survey->unitJ);
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
            case 'unitH': $this->update_unitH(); break;
            case 'unitI': $this->update_unitI(); break;
            case 'unitJ': $this->update_unitJ(); break;
        }
    }

    private function update_unitA()
    {
        $A10 = Arr::get($_POST,'A10');
        $A11 = Arr::get($_POST,'A11');

        $unitA = new Model_SurveyUnitA($this->survey->unitA);

        $unitA->A10 = $A10;
        $unitA->A11 = $A11;

        if (!$unitA->pk) {
            $unitA = $unitA->save();
            $this->survey->unitA = $unitA->pk;
            $this->survey->update();
        } else {
            $unitA->update();
        }

        if (empty($unitA->A10) || $unitA->A11 == -1) {
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
        $B3 = Arr::get($_POST,'B3');
        $B4 = Arr::get($_POST,'B4');
        $B5 = Arr::get($_POST,'B5');
        $B6 = Arr::get($_POST,'B6');
        $B7 = Arr::get($_POST,'B7');
        $B8 = Arr::get($_POST,'B8');
        $B9 = Arr::get($_POST,'B9');

        if (!empty($B6) && (!Valid::exact_length($B6, 9) || !Valid::digit($B6))) {
            $response = new Model_Response_Survey('SURVEY_UNIT_POST_CODE_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $unitB = new Model_SurveyUnitB($this->survey->unitB);

        $unitB->B1 = $B1;
        $unitB->B2 = $B2;
        $unitB->B3 = json_encode($B3);
        $unitB->B4 = $B4;
        $unitB->B5 = json_encode($B5);
        $unitB->B6 = $B6;
        $unitB->B7 = $B7;
        $unitB->B8 = json_encode($B8);
        $unitB->B9 = $B9;

        if (!$unitB->pk) {
            $unitB = $unitB->save();
            $this->survey->unitB = $unitB->pk;
            $this->survey->update();
        } else {
            $unitB->update();
        }

        if ($B1 == NULL || $B2 == NULL || $B2 == "0000-00-00" || $B3 == NULL || $B3 == "null" || $B4 == NULL  ||
            $B5 == NULL || $B6 == NULL || $B7 == NULL || $B8 == NULL || $B8 == "null" || $B9 == NULL)
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
        $C2  = Arr::get($_POST,'C2');
        $C3a = Arr::get($_POST,'C3a','-1');
        $C3b = Arr::get($_POST,'C3b', '-1');
        $C3c = Arr::get($_POST,'C3c', '-1');
        $C4  = Arr::get($_POST,'C4');
        $C5  = Arr::get($_POST,'C5');

        $unitC = new Model_SurveyUnitC($this->survey->unitC);

        $need_update = false;
        if ($unitC->C1 == 5 && $C1 != 5 || $unitC->C1 != 5 && $C1 ==5) $need_update = true;

        $unitC->C1 = $C1;

        if ($C1 == 5) {
            $unitC->C2 = NULL;
            $unitC->C3 = json_encode(array('-1', '-1', '-1'));
            $unitC->C4 = NULL;
            $unitC->C5 = -1;
        } else {
            $unitC->C2 = json_encode($C2);
            $unitC->C3 = json_encode(array($C3a, $C3b, $C3c));
            $unitC->C4 = $C4;
            $unitC->C5 = $C5;
        }

        if (!$unitC->pk) {
            $unitC = $unitC->save();
            $this->survey->unitC = $unitC->pk;
            $this->survey->update();
        } else {
            $unitC->update();
        }

        if ($need_update) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WITH_REFRESH_SUCCESS', 'success');
        } else if ($C1 == NULL || $C2 == NULL || $C2 == "null" || $C3a == -1 || $C3b == -1 ||
                    $C3c == -1 || $C4 == NULL || $C5 == NULL )
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
        $D3a = Arr::get($_POST,'D3a', '-1');
        $D3b = Arr::get($_POST,'D3b', '-1');
        $D4a = Arr::get($_POST,'D4a', '-1');
        $D4b = Arr::get($_POST,'D4b', '-1');

        $unitD = new Model_SurveyUnitD($this->survey->unitD);

        $unitD->D1 = $D1;
        $unitD->D2 = $D2;
        $unitD->D3 = json_encode(array($D3a, $D3b));
        $unitD->D4 = json_encode(array($D4a, $D4b));

        if (!$unitD->pk) {
            $unitD = $unitD->save();
            $this->survey->unitD = $unitD->pk;
            $this->survey->update();
        } else {
            $unitD->update();
        }

        if ($D1 == NULL || $D2 == NULL || $D3a == -1 || $D3b == -1 || $D4a == -1 || $D4b == -1)
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

        $unitE = new Model_SurveyUnitE($this->survey->unitE);

        $unitE->E1 = json_encode($E1);
        $unitE->E2 = json_encode($E2);
        $unitE->E3 = json_encode($E3);

        if (!$unitE->pk) {
            $unitE = $unitE->save();
            $this->survey->unitE = $unitE->pk;
            $this->survey->update();
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

        $unitF = new Model_SurveyUnitF($this->survey->unitF);

        $unitF->F1 = json_encode($F1);
        $unitF->F2 = json_encode($F2);
        $unitF->F3 = json_encode($F3);
        $unitF->F4 = $F4;
        $unitF->F5 = json_encode($F5);

        if (!$unitF->pk) {
            $unitF = $unitF->save();
            $this->survey->unitF = $unitF->pk;
            $this->survey->update();
        } else {
            $unitF->update();
        }

        $empty = false;
        if (!$empty) { foreach ($F1 as $f1) { if ($f1 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($F2 as $f2) { if ($f2 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($F3 as $f3) { if ($f3 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($F5 as $f5) { if ($f5 == -1) { $empty = true; break; } } }

        if ($empty || $F4 == NULL) {
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

        $unitG = new Model_SurveyUnitG($this->survey->unitG);

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
            $unitG = $unitG->save();
            $this->survey->unitG = $unitG->pk;
            $this->survey->update();
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

    private function update_unitH()
    {
        $H1 = Arr::get($_POST,'H1');
        $H2 = Arr::get($_POST,'H2');
        $H3 = Arr::get($_POST,'H3');
        $H4 = Arr::get($_POST,'H4');

        $unitH = new Model_SurveyUnitH($this->survey->unitH);

        $unitH->H1 = $H1;
        $unitH->H2 = $H2;
        $unitH->H3 = $H3;
        $unitH->H4 = $H4;

        if (!$unitH->pk) {
            $unitH = $unitH->save();
            $this->survey->unitH = $unitH->pk;
            $this->survey->update();
        } else {
            $unitH->update();
        }

        if ($H1 == NULL || $H2 == NULL || $H3 == NULL || $H4 == NULL) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitI()
    {
        $I1 = Arr::get($_POST,'I1');
        $I2 = Arr::get($_POST,'I2', '[]');

        $unitI = new Model_SurveyUnitI($this->survey->unitI);

        $unitI->I1 = json_encode($I1);
        $unitI->I2 = json_encode($I2);

        if (!$unitI->pk) {
            $unitI = $unitI->save();
            $this->survey->unitI = $unitI->pk;
            $this->survey->update();
        } else {
            $unitI->update();
        }

        $empty = false;
        if (!$empty) { foreach ($I1 as $i1) { if ($i1 == -1) { $empty = true; } } }

        if ($empty || $I2 == '[]') {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitJ()
    {
        $J1 = Arr::get($_POST,'J1');
        $J2 = Arr::get($_POST,'J2');
        $J3 = Arr::get($_POST,'J3');
        $J4 = Arr::get($_POST,'J4');
        $J5 = Arr::get($_POST,'J5');
        $J6a = Arr::get($_POST,'J6a', '-1');
        $J6b = Arr::get($_POST,'J6b', '-1');
        $J6c = Arr::get($_POST,'J6c', '-1');
        $J6d = Arr::get($_POST,'J6d', '-1');
        $J6e = Arr::get($_POST,'J6e', '-1');
        $J7a = Arr::get($_POST,'J7a', '-1');
        $J7b = Arr::get($_POST,'J7b', '-1');
        $J7c = Arr::get($_POST,'J7c', '-1');
        $J8 = Arr::get($_POST,'J8');
        $J9 = Arr::get($_POST,'J9');

        $unitJ = new Model_SurveyUnitJ($this->survey->unitJ);

        $unitJ->J1 = $J1;
        $unitJ->J2 = $J2;
        $unitJ->J3 = json_encode($J3);
        $unitJ->J4 = $J4;
        $unitJ->J5 = $J5;
        $unitJ->J6 = json_encode(array($J6a, $J6b, $J6c, $J6d, $J6e));
        $unitJ->J7 = json_encode(array($J7a, $J7b, $J7c));
        $unitJ->J8 = $J8;
        $unitJ->J9 = json_encode($J9);

        if (!$unitJ->pk) {
            $unitJ = $unitJ->save();
            $this->survey->unitJ = $unitJ->pk;
            $this->survey->update();
        } else {
            $unitJ->update();
        }

        $empty = false;
        if (!$empty) { foreach ($J3 as $j3) { if ($j3 == -1) { $empty = true; } } }
        if (!$empty) { foreach ($J9 as $j9) { if ($j9 == -1) { $empty = true; } } }

        if ($J1 == NULL || $J4 == NULL || $J5 == NULL || $J8 == NULL || $empty ||
            $J6a == NULL || $J6b == NULL || $J6c == NULL || $J6d == NULL ||$J6e == NULL ||
            $J7a == NULL || $J7b == NULL || $J7c == NULL) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

}
