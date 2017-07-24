<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Surveys_Ajax
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Surveys_Ajax extends Ajax
{
    CONST WATCH_ALL_PATIENTS_PROFILES    = 34;
    CONST WATCH_PATIENTS_PROFILES_IN_PEN = 35;
    CONST CAN_CONDUCT_A_SURVEY           = 36;
    CONST WATCH_ALL_SURVEYS              = 37;

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


        $count_forms = $this->redis->get($_SERVER['REDIS_PENSION_HASHES'] . $this->pension->id . ':surveys');
        $count_forms = $count_forms == false ? 1 : $count_forms + 1;
        $this->redis->set($_SERVER['REDIS_PENSION_HASHES'] . $this->pension->id . ':surveys', $count_forms);

        $first_survey = Model_Survey::getFirstSurvey($this->pension->id, $this->patient->id);

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
        $this->survey->patient->full_info = true;
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
        $this->survey->unitK = new Model_SurveyUnitK($this->survey->unitK);
        $this->survey->unitL = new Model_SurveyUnitL($this->survey->unitL);
        $this->survey->unitM = new Model_SurveyUnitM($this->survey->unitM);
        $this->survey->unitN = new Model_SurveyUnitN($this->survey->unitN);
        $this->survey->unitO = new Model_SurveyUnitO($this->survey->unitO);
        $this->survey->unitP = new Model_SurveyUnitP($this->survey->unitP);
        $this->survey->unitQ = new Model_SurveyUnitQ($this->survey->unitQ);
        $this->survey->unitR = new Model_SurveyUnitR($this->survey->unitR);
    }


    /**
     * Update
     */
    public function action_updateunit()
    {
        self::hasAccess(self::CAN_CONDUCT_A_SURVEY);

        $unit = Arr::get($_POST,'unit');

        $this->getSurvey();

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
            case 'unitK': $this->update_unitK(); break;
            case 'unitL': $this->update_unitL(); break;
            case 'unitM': $this->update_unitM(); break;
            case 'unitN': $this->update_unitN(); break;
            case 'unitO': $this->update_unitO(); break;
            case 'unitP': $this->update_unitP(); break;
            case 'unitQ': $this->update_unitQ(); break;
            case 'unitR': $this->update_unitR(); break;
        }
    }

    private function update_unitA()
    {
        $A10 = Arr::get($_POST,'A10');
        $A11 = Arr::get($_POST,'A11');

        $unitA = new Model_SurveyUnitA($this->survey->unitA);

        $unitA->A10 = $A10;
        $unitA->A11 = $A11;
        $unitA->progress =  70 + (($unitA->A10 == NULL || $unitA->A10 == "") ? 0 : 15) +
            (($unitA->A11 == NULL || $unitA->A11 == -1) ? 0 : 15);

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
        $B9 = Arr::get($_POST,'B9','-1');

        if (!empty($B6) && (!Valid::exact_length($B6, 9) || !Valid::digit($B6))) {
            $response = new Model_Response_Survey('SURVEY_UNIT_B6_ERROR', 'error');
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
        $unitB->progress =  $this->survey->type == 1 ? 100 : (($unitB->B1 == NULL || $unitB->B1 == "-1") ? 0 : 11) +
            (($unitB->B2 == NULL || $unitB->B2 == "0000-00-00") ? 0 : 11) +
            (($unitB->B3 == NULL || $unitB->B3 == "null") ? 0 : 11) +
            (($unitB->B4 == NULL || $unitB->B4 == "-1") ? 0 : 11) +
            ($unitB->B5 == NULL ? 0 : $this->countNotEmptyInArray($unitB->B5) * 6) +
            (($unitB->B6 == NULL || $unitB->B6 == "") ? 0 : 11) +
            (($unitB->B7 == NULL || $unitB->B7 == "-1") ? 0 : 11) +
            (($unitB->B8 == NULL || $unitB->B8 == "null") ? 0 : 11) +
            (($unitB->B9 == NULL || $unitB->B9 == "-1") ? 0 : 11);

        if (!$unitB->pk) {
            $unitB = $unitB->save();
            $this->survey->unitB = $unitB->pk;
            $this->survey->update();
        } else {
            $unitB->update();
        }

        if ($B1 == NULL || $B2 == NULL || $B2 == "0000-00-00" || $B3 == NULL || $B3 == "null" || $B4 == NULL  ||
            $B5 == NULL || $B6 == NULL || $B7 == NULL || $B8 == NULL || $B8 == "null" || $B9 == -1)
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
        $C1  = Arr::get($_POST,'C1', '-1');
        $C2a = Arr::get($_POST,'C2a','-1');
        $C2b = Arr::get($_POST,'C2b', '-1');
        $C2c = Arr::get($_POST,'C2c', '-1');
        $C2d = Arr::get($_POST,'C2d', '-1');
        $C3a = Arr::get($_POST,'C3a','-1');
        $C3b = Arr::get($_POST,'C3b', '-1');
        $C3c = Arr::get($_POST,'C3c', '-1');
        $C4  = Arr::get($_POST,'C4', '-1');
        $C5  = Arr::get($_POST,'C5','-1');

        $unitC = new Model_SurveyUnitC($this->survey->unitC);

        $need_update = false;
        if ($unitC->C1 == 5 && $C1 != 5 || $unitC->C1 != 5 && $C1 ==5) $need_update = true;

        $unitC->C1 = $C1;

        if ($C1 == 5) {
            $unitC->C2 = json_encode(array('-1', '-1', '-1', '-1'));
            $unitC->C3 = json_encode(array('-1', '-1', '-1'));
            $unitC->C4 = -1;
            $unitC->C5 = -1;
        } else {
            $unitC->C2 = json_encode(array($C2a, $C2b, $C2c, $C2d));
            $unitC->C3 = json_encode(array($C3a, $C3b, $C3c));
            $unitC->C4 = $C4;
            $unitC->C5 = $C5;
        }

        $unitC->progress = $unitC->C1 == 5 ? 100 :
            (($unitC->C1 == NULL || $unitC->C1 == "-1") ? 0 : 10) +
            ($unitC->C2 == NULL ? 0 : $this->countNotEmptyInArray($unitC->C2) * 10)+
            ($unitC->C3 == NULL ? 0 : $this->countNotEmptyInArray($unitC->C3) * 10)+
            (($unitC->C4 == NULL || $unitC->C4 == "-1") ? 0 : 10) +
            (($unitC->C5 == NULL || $unitC->C5 == "-1") ? 0 : 10);

        if (!$unitC->pk) {
            $unitC = $unitC->save();
            $this->survey->unitC = $unitC->pk;
            $this->survey->update();
        } else {
            $unitC->update();
        }

        if ($need_update) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WITH_REFRESH_SUCCESS', 'success');
        } else if ($C1 == NULL || $C2a == -1 || $C2b == -1 || $C2c == -1 || $C2d == -1 ||
                $C3a == -1 || $C3b == -1 || $C3c == -1 || $C4 == -1 || $C5 == -1 )
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
        $D1  = Arr::get($_POST,'D1', '-1');
        $D2  = Arr::get($_POST,'D2', '-1');
        $D3a = Arr::get($_POST,'D3a', '-1');
        $D3b = Arr::get($_POST,'D3b', '-1');
        $D4a = Arr::get($_POST,'D4a', '-1');
        $D4b = Arr::get($_POST,'D4b', '-1');

        $unitD = new Model_SurveyUnitD($this->survey->unitD);

        $unitD->D1 = $D1;
        $unitD->D2 = $D2;
        $unitD->D3 = json_encode(array($D3a, $D3b));
        $unitD->D4 = json_encode(array($D4a, $D4b));
        $unitD->progress = (($unitD->D1 == NULL || $unitD->D1 == "-1") ? 0 : 18)  +
            (($unitD->D2 == NULL || $unitD->D2 == "-1") ? 0 : 18) +
            ($unitD->D3 == NULL ? 0 : $this->countNotEmptyInArray($unitD->D3) * 16) +
            ($unitD->D4 == NULL ? 0 : $this->countNotEmptyInArray($unitD->D4) * 16);

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
        $unitE->progress = ($unitE->E1 == NULL ? 0 : $this->countNotEmptyInArray($unitE->E1) * 5) +
        ($unitE->E2 == NULL ? 0 : $this->countNotEmptyInArray($unitE->E2) * 5) +
        ($unitE->E3 == NULL ? 0 : $this->countNotEmptyInArray($unitE->E3) * 5);

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
        $unitF->progress = ($unitF->F1 == NULL ? 0 : $this->countNotEmptyInArray($unitF->F1) * 5) +
            ($unitF->F2 == NULL ? 0 : $this->countNotEmptyInArray($unitF->F2) * 5) +
            ($unitF->F3 == NULL ? 0 : $this->countNotEmptyInArray($unitF->F3) * 5) +
            (($unitF->F4 == NULL || $unitF->F4 == "-1") ? 0 : 10) +
            ($unitF->F5 == NULL ? 0 : $this->countNotEmptyInArray($unitF->F5) * 5);

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
        $unitG->progress = ($unitG->G1 == NULL ? 0 : $this->countNotEmptyInArray($unitG->G1) * 5) +
            ($unitG->G2 == NULL ? 0 : $this->countNotEmptyInArray($unitG->G2) * 5) +
            ($unitG->G3 == NULL ? 0 : $this->countNotEmptyInArray($unitG->G3) * 5) +
            ($unitG->G4 == NULL ? 0 : $this->countNotEmptyInArray($unitG->G4) * 5) +
            (($unitG->G5 == NULL || $unitG->G5 == "-1") ? 0 : 10);

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
        $unitH->progress = ($unitH->H1 == NULL ? 0 : 25) +
            ($unitH->H2 == NULL ? 0 : 25) +
            ($unitH->H3 == NULL ? 0 : 25) +
            ($unitH->H4 == NULL ? 0 : 25);

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
        $unitI->I2 = $I2 == '[]' ? '[]' : json_encode($I2);
        $unitI->progress = ($unitI->I1 == NULL ? 0 : $this->countNotEmptyInArray($unitI->I1) * 4.76);

        if (!$unitI->pk) {
            $unitI = $unitI->save();
            $this->survey->unitI = $unitI->pk;
            $this->survey->update();
        } else {
            $unitI->update();
        }

        $empty = false;
        if (!$empty) { foreach ($I1 as $i1) { if ($i1 == -1) { $empty = true; } } }

        if ($empty) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitJ()
    {
        $J1 = Arr::get($_POST,'J1','-1');
        $J2 = Arr::get($_POST,'J2','-1');
        $J3 = Arr::get($_POST,'J3');
        $J4 = Arr::get($_POST,'J4','-1');
        $J5 = Arr::get($_POST,'J5','-1');
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
        $unitJ->progress = (($unitJ->J1 == NULL || $unitJ->J1 == "-1") ? 0 : 2.6) +
            2.6 +
            ($unitJ->J3 == NULL ? 0 : $this->countNotEmptyInArray($unitJ->J3) * 2.8) +
            (($unitJ->J4 == NULL || $unitJ->J4 == "-1") ? 0 : 2.6) +
            (($unitJ->J5 == NULL || $unitJ->J5 == "-1") ? 0 : 2.6) +
            ($unitJ->J6 == NULL ? 0 : $this->countNotEmptyInArray($unitJ->J6) * 2.8) +
            ($unitJ->J7 == NULL ? 0 : $this->countNotEmptyInArray($unitJ->J7) * 2.8) +
            (($unitJ->J8 == NULL || $unitJ->J8 == "-1") ? 0 : 2.6) +
            ($unitJ->J9 == NULL ? 0 : $this->countNotEmptyInArray($unitJ->J9) * 2.8);

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

    private function update_unitK()
    {
        $K1a = Arr::get($_POST,'K1a');
        $K1b = Arr::get($_POST,'K1b');
        $K2a = Arr::get($_POST,'K2a', '-1');
        $K2b = Arr::get($_POST,'K2b', '-1');
        $K2c = Arr::get($_POST,'K2c', '-1');
        $K2d = Arr::get($_POST,'K2d', '-1');
        $K3 = Arr::get($_POST,'K3','-1');
        $K4 = Arr::get($_POST,'K4','-1');
        $K5a = Arr::get($_POST,'K5a', '-1');
        $K5b = Arr::get($_POST,'K5b', '-1');
        $K5c = Arr::get($_POST,'K5c', '-1');
        $K5d = Arr::get($_POST,'K5d', '-1');
        $K5e = Arr::get($_POST,'K5e', '-1');
        $K5f = Arr::get($_POST,'K5f', '-1');

        if ($K1a != -1 && ($K1a < 100 || $K1a > 500)) {
            $response = new Model_Response_Survey('SURVEY_UNIT_K1a_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($K1b != -1 && ($K1b < 10 || $K1b > 300)) {
            $response = new Model_Response_Survey('SURVEY_UNIT_K1b_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $unitK = new Model_SurveyUnitK($this->survey->unitK);

        $unitK->K1 = json_encode(array($K1a, $K1b));
        $unitK->K2 = json_encode(array($K2a, $K2b, $K2c, $K2d));
        $unitK->K3 = $K3;
        $unitK->K4 = $K4;
        $unitK->K5 = json_encode(array($K5a, $K5b, $K5c, $K5d, $K5e, $K5f));
        $unitK->progress = ($unitK->K1 == NULL ? 0 : $this->countNotEmptyInArray($unitK->K1) * 7) +
            ($unitK->K2 == NULL ? 0 : $this->countNotEmptyInArray($unitK->K2) * 7) +
            (($unitK->K3 == NULL || $unitK->K3 == "-1") ? 0 : 8) +
            (($unitK->K4 == NULL || $unitK->K4 == "-1") ? 0 : 8) +
            ($unitK->K5 == NULL ? 0 : $this->countNotEmptyInArray($unitK->K5) * 7);

        if (!$unitK->pk) {
            $unitK = $unitK->save();
            $this->survey->unitK = $unitK->pk;
            $this->survey->update();
        } else {
            $unitK->update();
        }

        if ($K1a == 0 || $K1b == 0 || $K2a == -1 || $K2b == -1 || $K2c == -1 || $K2d == -1 || $K3 == NULL ||
            $K4 == NULL || $K5a == -1 || $K5b == -1 || $K5c == -1 || $K5d == -1 || $K5e == -1 || $K5f == -1) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitL()
    {
        $L1 = Arr::get($_POST,'L1','-1');
        $L2 = Arr::get($_POST,'L2','-1');
        $L3 = Arr::get($_POST,'L3','-1');
        $L4 = Arr::get($_POST,'L4','-1');
        $L5 = Arr::get($_POST,'L5','-1');
        $L6 = Arr::get($_POST,'L6','-1');
        $L7 = Arr::get($_POST,'L7','-1');

        $unitL = new Model_SurveyUnitL($this->survey->unitL);

        $unitL->L1 = $L1;
        $unitL->L2 = $L2;
        $unitL->L3 = $L3;
        $unitL->L4 = $L4;
        $unitL->L5 = $L5;
        $unitL->L6 = $L6;
        $unitL->L7 = $L7;
        $unitL->progress = (($unitL->L1 == NULL || $unitL->L1 == "-1") ? 0 : 14.28) +
            (($unitL->L2 == NULL || $unitL->L2 == "-1") ? 0 : 14.28) +
            (($unitL->L3 == NULL || $unitL->L3 == "-1") ? 0 : 14.28) +
            (($unitL->L4 == NULL || $unitL->L4 == "-1") ? 0 : 14.28) +
            (($unitL->L5 == NULL || $unitL->L5 == "-1") ? 0 : 14.28) +
            (($unitL->L6 == NULL || $unitL->L6 == "-1") ? 0 : 14.28) +
            (($unitL->L7 == NULL || $unitL->L7 == "-1") ? 0 : 14.28);

        if (!$unitL->pk) {
            $unitL = $unitL->save();
            $this->survey->unitL = $unitL->pk;
            $this->survey->update();
        } else {
            $unitL->update();
        }

        if ($L1 == -1 || $L2 == NULL || $L3 == NULL || $L4 == NULL || $L5 == NULL || $L6 == NULL || $L7 == -1) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitM()
    {
        $M1 = Arr::get($_POST,'M1');
        $M2a = Arr::get($_POST,'M2a', '-1');
        $M2b = Arr::get($_POST,'M2b', '-1');
        $M2c = Arr::get($_POST,'M2c', '-1');
        $M2d = Arr::get($_POST,'M2d', '-1');
        $M2e = Arr::get($_POST,'M2e', '-1');
        $M2f = Arr::get($_POST,'M2f', '-1');
        $M2g = Arr::get($_POST,'M2g', '-1');
        $M2h = Arr::get($_POST,'M2h', '-1');
        $M2i = Arr::get($_POST,'M2i', '-1');
        $M2j = Arr::get($_POST,'M2j', '-1');
        $M2k = Arr::get($_POST,'M2k', '-1');
        $M2l = Arr::get($_POST,'M2l', '-1');
        $M2m = Arr::get($_POST,'M2m', '-1');
        $M2n = Arr::get($_POST,'M2n', '-1');
        $M2o = Arr::get($_POST,'M2o', '-1');
        $M2p = Arr::get($_POST,'M2p', '-1');
        $M3 = Arr::get($_POST,'M3');

        $unitM = new Model_SurveyUnitM($this->survey->unitM);

        $unitM->M1 = $M1;
        $unitM->M2 = json_encode(array($M2a,$M2b,$M2c,$M2d,$M2e,$M2f,$M2g,$M2h,$M2i,$M2j,$M2k,$M2l,$M2m,$M2n,$M2o,$M2p));
        $unitM->M3 = $M3;
        $unitM->progress = (($unitM->M1 == NULL || $unitM->M1 == "-1") ? 0 : 6) +
            ($unitM->M2 == NULL ? 0 : $this->countNotEmptyInArray($unitM->M2) * 5.5) +
            (($unitM->M3 == NULL || $unitM->M3 == "-1") ? 0 : 6);

        if (!$unitM->pk) {
            $unitM = $unitM->save();
            $this->survey->unitM = $unitM->pk;
            $this->survey->update();
        } else {
            $unitM->update();
        }

        if ($M1 == -1 || $M2a == -1 || $M2b == -1 || $M2c == -1 || $M2d == -1 || $M2e == -1 || $M2f == -1 || $M2g == -1 || $M2h == -1
            || $M2i == -1 || $M2j == -1 || $M2k == -1 || $M2l == -1 || $M2m == -1 || $M2n == -1 || $M2o == -1 || $M2p == -1 || $M3 == -1 ) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitN()
    {
        $N1 = Arr::get($_POST,'N1', '[]');
        $N2 = Arr::get($_POST,'N2', '-1');

        $empty = false;

        if ($N1 != '[]') {
            foreach ($N1 as $key => $n1) {
                echo Debug::vars($n1);
                if (empty($n1[0])) { $N1[$key][0] = ""; $empty = true; }
                if (empty($n1[1])) { $N1[$key][1] = ""; $empty = true; }
                if (empty($n1[2]) && $n1[2] != 0) { $N1[$key][2] = "-1"; $empty = true; }
                if (empty($n1[3]) && $n1[3] != 0) { $N1[$key][3] = "-1"; $empty = true;}
                if (empty($n1[4]) && $n1[4] != 0) { $N1[$key][4] = "-1"; $empty = true;}
                if (empty($n1[5]) && $n1[5] != 0) { $N1[$key][5] = "-1"; $empty = true;}

                if ($N1[$key][0] == "") {
                    $response = new Model_Response_Survey('SURVEY_UNIT_N1_0_ERROR', 'error');
                    $this->response->body(@json_encode($response->get_response()));
                    return;
                }
                if ($N1[$key][1] <= 0) {
                    $response = new Model_Response_Survey('SURVEY_UNIT_N1_1_ERROR', 'error');
                    $this->response->body(@json_encode($response->get_response()));
                    return;
                }
            }
        }

        $unitN = new Model_SurveyUnitN($this->survey->unitN);
        $unitN->N1 = $N1 == '[]' ? '[]' : json_encode($N1);
        $unitN->N2 = $N2;
        $unitN->progress = ($unitN->N1 == NULL ? 0 : $unitN->N2 == "[]" ? 50 : 50) +
            (($unitN->N2 == NULL || $unitN->N2 == "-1") ? 0 : 50);

        if (!$unitN->pk) {
            $unitN = $unitN->save();
            $this->survey->unitN = $unitN->pk;
            $this->survey->update();
        } else {
            $unitN->update();
        }

        if ($empty || $N2 == -1) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitO()
    {
        $O1a = Arr::get($_POST,'O1a', '-1');
        $O1b = Arr::get($_POST,'O1b', '-1');
        $O1c = Arr::get($_POST,'O1c', '-1');
        $O1d = Arr::get($_POST,'O1d', '-1');
        $O1e = Arr::get($_POST,'O1e', '-1');
        $O1f = Arr::get($_POST,'O1f', '-1');
        $O1g = Arr::get($_POST,'O1g', '-1');
        $O1h = Arr::get($_POST,'O1h', '-1');
        $O2 = Arr::get($_POST,'O2');
        $O3a = Arr::get($_POST,'O3a');
        $O3b = Arr::get($_POST,'O3b');
        $O3c = Arr::get($_POST,'O3c');
        $O3d = Arr::get($_POST,'O3d');
        $O3e = Arr::get($_POST,'O3e');
        $O3f = Arr::get($_POST,'O3f');
        $O4 = Arr::get($_POST,'O4');
        $O5 = Arr::get($_POST,'O5');
        $O6 = Arr::get($_POST,'O6');
        $O7 = Arr::get($_POST,'O7');

        $unitO = new Model_SurveyUnitO($this->survey->unitO);

        $O1 = array($O1a,$O1b,$O1c,$O1d,$O1e,$O1f,$O1g,$O1h);
        $O3 = array($O3a,$O3b,$O3c,$O3d,$O3e,$O3f);

        $empty = false;
        foreach ($O3 as $o3) {
            if (($o3[0] != -1 && ($o3[0] < 0 || $o3[0] > 7)) || ($o3[1] != -1 && ($o3[1] < 0 || $o3[1] > 7)) || ($o3[2] != -1 && ($o3[2] < 0 || $o3[2] > 999))) {
                $response = new Model_Response_Survey('SURVEY_UNIT_O3_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;
            }
            if (!$empty && ($o3[0] == -1 || $o3[1] == -1 || $o3[2] == -1)) { $empty = true; }
        }

        if (($O4[0] != -1 && ($O4[0] < 0 || $O4[0] > 99)) || ($O4[1] != -1 && ($O4[1] < 0 || $O4[1] > 99))) {
            $response = new Model_Response_Survey('SURVEY_UNIT_O4_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($O5 != -1 && ($O5 < 0 || $O5 > 99)) {
            $response = new Model_Response_Survey('SURVEY_UNIT_O5_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($O6 != -1 && ($O6 < 0 || $O6 > 99)) {
            $response = new Model_Response_Survey('SURVEY_UNIT_O6_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $unitO->O1 = json_encode($O1);
        $unitO->O2 = json_encode($O2);
        $unitO->O3 = json_encode($O3);
        $unitO->O4 = json_encode($O4);
        $unitO->O5 = $O5;
        $unitO->O6 = $O6;
        $unitO->O7 = json_encode($O7);
        $unitO->progress = ($unitO->O1 == NULL ? 0 : $this->countNotEmptyInArray($unitO->O1) * 2.2) +
            ($unitO->O2 == NULL ? 0 : $this->countNotEmptyInArray($unitO->O2) * 2.2) +
            ($unitO->O3 == NULL ? 0 : ($this->countNotEmptyInArray(json_encode($O3[0]))+$this->countNotEmptyInArray(json_encode($O3[1]))+$this->countNotEmptyInArray(json_encode($O3[2]))+$this->countNotEmptyInArray(json_encode($O3[3]))+$this->countNotEmptyInArray(json_encode($O3[4]))+$this->countNotEmptyInArray(json_encode($O3[5]))) * 2.2) +
            ($unitO->O4 == NULL ? 0 : $this->countNotEmptyInArray($unitO->O4) * 2.2) +
            (($unitO->O5 == NULL || $unitO->O5 == "-1") ? 0 : 1.6) +
            (($unitO->O6 == NULL || $unitO->O6 == "-1") ? 0 : 1.6) +
            ($unitO->O7 == NULL ? 0 : $this->countNotEmptyInArray($unitO->O7) * 2.2);

        if (!$unitO->pk) {
            $unitO = $unitO->save();
            $this->survey->unitO = $unitO->pk;
            $this->survey->update();
        } else {
            $unitO->update();
        }

        if (!$empty) { foreach ($O1 as $ind => $o1) { if ($ind != 6 && $o1 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($O2 as $o2) { if ($o2 == -1) { $empty = true; break; } } }
        if (!$empty) { foreach ($O7 as $o7) { if ($o7 == -1) { $empty = true; break; } } }

        if ($empty || $O4[0] == -1 || $O4[1] == -1 || $O5 == -1 || $O6 == -1) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitP()
    {
        $P1a = Arr::get($_POST,'P1a', '-1');
        $P1b = Arr::get($_POST,'P1b', '-1');
        $P1c = Arr::get($_POST,'P1c', '-1');
        $P1d = Arr::get($_POST,'P1d', '-1');
        $P1e = Arr::get($_POST,'P1e', '-1');
        $P2a = Arr::get($_POST,'P2a', '-1');
        $P2b = Arr::get($_POST,'P2b', '-1');
        $P2c = Arr::get($_POST,'P2c', '-1');
        $P2d = Arr::get($_POST,'P2d', '-1');
        $P2e = Arr::get($_POST,'P2e', '-1');


        $unitP = new Model_SurveyUnitP($this->survey->unitP);

        $unitP->P1 = json_encode(array($P1a,$P1b,$P1c,$P1d,$P1e));
        $unitP->P2 = json_encode(array($P2a,$P2b,$P2c,$P2d,$P2e));
        $unitP->progress = ($unitP->P1 == NULL ? 0 : $this->countNotEmptyInArray($unitP->P1) * 10) +
            ($unitP->P2 == NULL ? 0 : $this->countNotEmptyInArray($unitP->P2) * 10);

        if (!$unitP->pk) {
            $unitP = $unitP->save();
            $this->survey->unitP = $unitP->pk;
            $this->survey->update();
        } else {
            $unitP->update();
        }

        if ($P1a == -1 || $P1b == -1 || $P1c == -1 || $P1d == -1 || $P1e == -1 ||
            $P2a == -1 || $P2b == -1 || $P2c == -1 || $P2d == -1 || $P2e == -1) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitQ()
    {
        $Q1a = Arr::get($_POST,'Q1a', '-1');
        $Q1b = Arr::get($_POST,'Q1b', '-1');
        $Q1c = Arr::get($_POST,'Q1c', '-1');
        $Q2 = Arr::get($_POST,'Q2');

        $unitQ = new Model_SurveyUnitQ($this->survey->unitQ);

        $unitQ->Q1 = json_encode(array($Q1a,$Q1b,$Q1c));
        $unitQ->Q2 = $Q2;
        $unitQ->progress = ($unitQ->Q1 == NULL ? 0 : $this->countNotEmptyInArray($unitQ->Q1) * 25) +
            (($unitQ->Q2 == NULL || $unitQ->Q2 == "-1") ? 0 : 25);

        if (!$unitQ->pk) {
            $unitQ = $unitQ->save();
            $this->survey->unitQ = $unitQ->pk;
            $this->survey->update();
        } else {
            $unitQ->update();
        }

        if ($Q1a == -1 || $Q1b == -1 || $Q1c == -1 || $Q2 == -1) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function update_unitR()
    {
        $R1 = Arr::get($_POST,'R1');
        $R2 = Arr::get($_POST,'R2');
        $R3 = Arr::get($_POST,'R3', '-1');

        $unitR = new Model_SurveyUnitR($this->survey->unitR);

        $unitR->R1 = $R1;
        $unitR->R2 = $R2;
        $unitR->R3 = $R3;
        $unitR->progress = ((($unitR->R1 == NULL || $unitR->R1 == "0000-00-00") ? 0 : 34) +
            (($unitR->R2 == NULL || $unitR->R2 == "-1") ? 0 : 33) +
            (($unitR->R3 == NULL || $unitR->R3 == "-1") ? 0 : 33));

        if (!$unitR->pk) {
            $unitR = $unitR->save();
            $this->survey->unitR = $unitR->pk;
            $this->survey->update();
        } else {
            $unitR->update();
        }

        if ( $R1 == NULL || $R1 == "0000-00-00" || $R2 == -1 || $R3 == NULL) {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_WARMING', 'warning');
        } else {
            $response = new Model_Response_Survey('SURVEY_UNIT_UPDATE_SUCCESS', 'success');
        }

        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    private function countNotEmptyInArray($array) {
        $array = json_decode($array);
        $count = 0;
        foreach ($array as $item) {
            if ($item != '-1') $count++;
        }
        return $count;
    }

    public function action_complete()
    {
        $this->getSurvey();

        $this->survey->status = 2;
        $this->survey->dt_finish = Date::formatted_time('now');
        $this->survey->update();

        $response = new Model_Response_Survey('SURVEY_COMPLETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
        return;
    }
}
