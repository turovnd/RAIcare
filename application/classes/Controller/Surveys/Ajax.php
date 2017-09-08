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
    protected $pension  = null;
    protected $patient  = null;
    protected $survey   = null;

    public function action_new()
    {
        if (!$this->getPatientAndPensionData()) return;
        $type = Arr::get($_POST,'type');

        if (empty($type)) {
            $response = new Model_Response_Survey('SURVEY_TYPE_EMPTY_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $first_survey = Model_Survey::getFirstSurvey($this->pension->id, $this->patient->pk);
        if ($first_survey->pk && $first_survey->type == $type) {
            $response = new Model_Response_Survey('SURVEY_WITH_TYPE_1_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $filling_survey = Model_Survey::getFillingSurveyByPatientAndPension($this->patient->pk, $this->pension->id);
        if ($filling_survey->pk) {
            $response = new Model_Response_Survey('HAS_NO_COMPLETE_SURVEY_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $count_surveys = $this->redis->get($_SERVER['REDIS_PENSION_HASHES'] . $this->pension->id . ':surveys');
        $count_surveys = $count_surveys == false ? 1 : $count_surveys + 1;
        $this->redis->set($_SERVER['REDIS_PENSION_HASHES'] . $this->pension->id . ':surveys', $count_surveys);

        $survey               = new Model_Survey();
        $survey->id           = $count_surveys;
        $survey->patient      = $this->patient->pk;
        $survey->pension      = $this->pension->id;
        $survey->organization = $this->pension->organization;
        $survey->type         = $type;
        $survey->creator      = $this->user->id;
        $survey->unitB        = $first_survey->unitB;
        $survey->save();

        $response = new Model_Response_Survey('SURVEY_CREATED_SUCCESS', 'success', array('id' => $count_surveys));
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_get()
    {
        $offset   = Arr::get($_POST,'offset');
        $surveys = array();

        if (!$this->getPatientAndPensionData()) return;

        $surveysModel = Model_Survey::getAllFinishedByPatientAndPension($this->patient->pk, $this->pension->id, $offset, 10);

        foreach ($surveysModel as $key => $survey) {
            $surveys[] = array(
                'date' => Date('M Y', strtotime($survey->dt_finish)),
                'html' => View::factory('patients/blocks/timeline-item', array('survey' => $survey))->render()
            );
        }

        $response = new Model_Response_Survey('SURVEY_GET_SUCCESS', 'success', array('surveys' => $surveys, 'number' => count($surveys)));
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_load()
    {
        $offset  = Arr::get($_POST,'offset');
        if (!$this->getPensionData()) return;

        $surveys = Model_Survey::getAllByPension($this->pension->id, $offset, 10);

        $html = "";
        foreach ($surveys as $survey) {
            $html .= View::factory('surveys/blocks/all-surveys-item', array('survey' => $survey, 'pen_uri' => $this->pension->uri))->render();
        }

        $response = new Model_Response_Survey('SURVEY_GET_SUCCESS', 'success', array('html' => $html, 'number' => count($surveys)));
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_getunit()
    {
        $unit = Arr::get($_POST,'unit');

        if (!$this->getSurvey()) return;
        $this->getSurveyUnits($unit);

        if ($unit == 'progress' || $unit == 'unitA' || $unit == 'unitO') {
            $this->survey->patient = new Model_Patient($this->survey->patient);
        }
        if ($unit == 'unitA') {
            $this->survey->pension = new Model_Pension($this->survey->pension);
            $this->survey->patient->can_edit = true;
            $this->survey->patient->full_info = true;
            $this->survey->patient->creator = new Model_User($this->survey->patient->creator);
        }


        $html = View::factory('surveys/units/' . $unit, array('survey' => $this->survey, 'can_conduct' => true))->render();

        $response = new Model_Response_Survey('SURVEY_UNIT_GET_SUCCESS', 'success', array('html' => $html));
        $this->response->body(@json_encode($response->get_response()));
    }

    private function getPensionData()
    {
        $pension = Arr::get($_POST,'pension');
        $this->pension = new Model_Pension($pension);

        if (!$this->pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return false;
        }

        $usersIDs = Model_UserPension::getUsers($this->pension->id);

        if (!(in_array($this->user->id, $usersIDs))) {
            throw new HTTP_Exception_403();
        }
        return true;
    }

    private function getPatientAndPensionData()
    {
        $pension = Arr::get($_POST,'pension');
        $patient = Arr::get($_POST,'patient');

        $this->pension = new Model_Pension($pension);

        if (!$this->pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return false;
        }

        $usersIDs = Model_UserPension::getUsers($this->pension->id);

        if (!(in_array($this->user->id, $usersIDs))) {
            throw new HTTP_Exception_403();
        }

        $this->patient = new Model_Patient($patient);

        if (!$this->patient->pk) {
            $response = new Model_Response_Patients('PATIENTS_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return false;
        }
        return true;
    }

    private function getSurvey()
    {
        $survey  = Arr::get($_POST,'survey');
        $pension = Arr::get($_POST,'pension');
        $this->survey = new Model_Survey($survey);

        if (!$this->survey->pk || $this->survey->pension != $pension || $this->survey->status == 3) {
            $response = new Model_Response_Survey('SURVEY_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return false;
        }

        if ($this->survey->status == 1 && strtotime(Date::formatted_time('now')) - strtotime($this->survey->dt_create) > Date::DAY * 3) {
            $this->survey->status= 3;
            $this->survey->update();
            $response = new Model_Response_Survey('SURVEY_HAS_BEEN_DELETED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return false;
        }
        return true;
    }

    private function getSurveyUnits($unit = 'progress')
    {
        if ($unit == 'progress' || $unit == 'unitA') {
            $first_survey = Model_Survey::getFirstSurvey($this->survey->pension, $this->survey->patient);
            $this->survey->dt_first_survey = !empty($first_survey->pk) ? $first_survey->dt_create : $this->survey->dt_create;
            $this->survey->unitA = new Model_SurveyUnitA($this->survey->unitA);
        }
        if ($unit == 'progress' || $unit == 'unitB') {
            $this->survey->unitB = new Model_SurveyUnitB($this->survey->unitB);
        }
        if ($unit == 'progress' || $unit == 'unitC') {
            $this->survey->unitC = new Model_SurveyUnitC($this->survey->unitC);
        }
        if ($unit == 'progress' || $unit == 'unitD') {
            $this->survey->unitD = new Model_SurveyUnitD($this->survey->unitD);
        }
        if ($unit == 'progress' || $unit == 'unitE') {
            $this->survey->unitE = new Model_SurveyUnitE($this->survey->unitE);
        }
        if ($unit == 'progress' || $unit == 'unitF') {
            $this->survey->unitF = new Model_SurveyUnitF($this->survey->unitF);
        }
        if ($unit == 'progress' || $unit == 'unitG') {
            $this->survey->unitG = new Model_SurveyUnitG($this->survey->unitG);
        }
        if ($unit == 'progress' || $unit == 'unitH') {
            $this->survey->unitH = new Model_SurveyUnitH($this->survey->unitH);
        }
        if ($unit == 'progress' || $unit == 'unitI') {
            $this->survey->unitI = new Model_SurveyUnitI($this->survey->unitI);
        }
        if ($unit == 'progress' || $unit == 'unitJ') {
            $this->survey->unitJ = new Model_SurveyUnitJ($this->survey->unitJ);
        }
        if ($unit == 'progress' || $unit == 'unitK') {
            $this->survey->unitK = new Model_SurveyUnitK($this->survey->unitK);
        }
        if ($unit == 'progress' || $unit == 'unitL') {
            $this->survey->unitL = new Model_SurveyUnitL($this->survey->unitL);
        }
        if ($unit == 'progress' || $unit == 'unitM') {
            $this->survey->unitM = new Model_SurveyUnitM($this->survey->unitM);
        }
        if ($unit == 'progress' || $unit == 'unitN') {
            $this->survey->unitN = new Model_SurveyUnitN($this->survey->unitN);
        }
        if ($unit == 'progress' || $unit == 'unitO') {
            $this->survey->unitO = new Model_SurveyUnitO($this->survey->unitO);
        }
        if ($unit == 'progress' || $unit == 'unitP') {
            $this->survey->unitP = new Model_SurveyUnitP($this->survey->unitP);
        }
        if ($unit == 'progress' || $unit == 'unitQ') {
            $this->survey->unitQ = new Model_SurveyUnitQ($this->survey->unitQ);
        }
        if ($unit == 'progress' || $unit == 'unitR') {
            $this->survey->unitR = new Model_SurveyUnitR($this->survey->unitR);
        }
    }


    /**
     * Update
     */
    public function action_updateunit()
    {
        $unit = Arr::get($_POST,'unit');

        if (!$this->getSurvey()) return;

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
        $B2 = Date::formatted_time(Arr::get($_POST,'B2'));
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
            (($unitB->B2 == "0000-00-00") ? 0 : 11) +
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

        if ($B1 == NULL || $B2 == "0000-00-00" || $B3 == NULL || $B3 == "null" || $B4 == NULL  ||
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
        $R1 = Date::formatted_time(Arr::get($_POST,'R1'));
        $R2 = Arr::get($_POST,'R2');
        $R3 = Arr::get($_POST,'R3', '-1');

        $unitR = new Model_SurveyUnitR($this->survey->unitR);


        $unitR->R1 = $R1;
        $unitR->R2 = $R2;
        $unitR->R3 = $R3;
        $unitR->progress = ((($unitR->R1 == "0000-00-00") ? 0 : 34) +
            (($unitR->R2 == NULL || $unitR->R2 == "-1") ? 0 : 33) +
            (($unitR->R3 == NULL || $unitR->R3 == "-1") ? 0 : 33));

        if (!$unitR->pk) {
            $unitR = $unitR->save();
            $this->survey->unitR = $unitR->pk;
            $this->survey->update();
        } else {
            $unitR->update();
        }

        if ( $R1 == "0000-00-00" || $R2 == -1 || $R3 == NULL) {
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
        if (!$this->getSurvey()) return;

        $this->survey->status = 2;
        $this->survey->dt_finish = Date::formatted_time('now');
        $this->survey->update();

        $this->getUnitsData();
        $this->createProtocolsReport();
        $this->createRAIScales();

        $response = new Model_Response_Survey('SURVEY_COMPLETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
        return;
    }









    /*************************************
     *
     *
     * Functions for creating @reports
     *
     *
     *************************************/


    /**
     * Get Units Data
     */
    private function getUnitsData()
    {
        $this->survey->unitC = new Model_SurveyUnitC($this->survey->unitC);
        $this->survey->unitC->C2 = json_decode($this->survey->unitC->C2);
        $this->survey->unitC->C3 = json_decode($this->survey->unitC->C3);

        $this->survey->unitD = new Model_SurveyUnitD($this->survey->unitD);
        $this->survey->unitD->D3 = json_decode($this->survey->unitD->D3);
        $this->survey->unitD->D4 = json_decode($this->survey->unitD->D4);

        $this->survey->unitE = new Model_SurveyUnitE($this->survey->unitE);
        $this->survey->unitE->E1 = json_decode($this->survey->unitE->E1);
        $this->survey->unitE->E2 = json_decode($this->survey->unitE->E2);
        $this->survey->unitE->E3 = json_decode($this->survey->unitE->E3);

        $this->survey->unitF = new Model_SurveyUnitF($this->survey->unitF);
        $this->survey->unitF->F1 = json_decode($this->survey->unitF->F1);
        $this->survey->unitF->F2 = json_decode($this->survey->unitF->F2);
        $this->survey->unitF->F3 = json_decode($this->survey->unitF->F3);
        $this->survey->unitF->F5 = json_decode($this->survey->unitF->F5);

        $this->survey->unitG = new Model_SurveyUnitG($this->survey->unitG);
        $this->survey->unitG->G1 = json_decode($this->survey->unitG->G1);
        $this->survey->unitG->G2 = json_decode($this->survey->unitG->G2);
        $this->survey->unitG->G3 = json_decode($this->survey->unitG->G3);
        $this->survey->unitG->G4 = json_decode($this->survey->unitG->G4);

        $this->survey->unitH = new Model_SurveyUnitH($this->survey->unitH);

        $this->survey->unitI = new Model_SurveyUnitI($this->survey->unitI);
        $this->survey->unitI->I1 = json_decode($this->survey->unitI->I1);

        $this->survey->unitJ = new Model_SurveyUnitJ($this->survey->unitJ);
        $this->survey->unitJ->J3 = json_decode($this->survey->unitJ->J3);
        $this->survey->unitJ->J6 = json_decode($this->survey->unitJ->J6);
        $this->survey->unitJ->J7 = json_decode($this->survey->unitJ->J7);
        $this->survey->unitJ->J9 = json_decode($this->survey->unitJ->J9);

        $this->survey->unitK = new Model_SurveyUnitK($this->survey->unitK);
        $this->survey->unitK->K1 = json_decode($this->survey->unitK->K1);
        $this->survey->unitK->K2 = json_decode($this->survey->unitK->K2);
        $this->survey->unitK->K5 = json_decode($this->survey->unitK->K5);

        $this->survey->unitL = new Model_SurveyUnitL($this->survey->unitL);

        $this->survey->unitM = new Model_SurveyUnitM($this->survey->unitM);
        $this->survey->unitM->M2 = json_decode($this->survey->unitM->M2);

        $this->survey->unitN = new Model_SurveyUnitN($this->survey->unitN);

        $this->survey->unitO = new Model_SurveyUnitO($this->survey->unitO);
        $this->survey->unitO->O1 = json_decode($this->survey->unitO->O1);
        $this->survey->unitO->O2 = json_decode($this->survey->unitO->O2);
        $this->survey->unitO->O3 = json_decode($this->survey->unitO->O3);
        $this->survey->unitO->O4 = json_decode($this->survey->unitO->O4);
        $this->survey->unitO->O7 = json_decode($this->survey->unitO->O7);

        $this->survey->unitP = new Model_SurveyUnitP($this->survey->unitP);
        $this->survey->unitP->P1 = json_decode($this->survey->unitP->P1);
        $this->survey->unitP->P2 = json_decode($this->survey->unitP->P2);

        $this->survey->unitQ = new Model_SurveyUnitQ($this->survey->unitQ);
        $this->survey->unitQ->Q1 = json_decode($this->survey->unitQ->Q1);
    }



    /**
     * Create Protocols Report
     */
    private function createProtocolsReport()
    {
        $C1 = $this->survey->unitC->C1;
        $C3 = $this->survey->unitC->C3;
        $C4 = $this->survey->unitC->C4;
        $C5 = $this->survey->unitC->C5;
        $D1 = $this->survey->unitD->D1;
        $D2 = $this->survey->unitD->D2;
        $E1 = $this->survey->unitE->E1;
        $E3 = $this->survey->unitE->E3;
        $F2 = $this->survey->unitF->F2;
        $G1 = $this->survey->unitG->G1;
        $G3 = $this->survey->unitG->G3;
        $G4 = $this->survey->unitG->G4;
        $G5 = $this->survey->unitG->G5;
        $H1 = $this->survey->unitH->H1;
        $H2 = $this->survey->unitH->H2;
        $I1 = $this->survey->unitI->I1;
        $J1 = $this->survey->unitJ->J1;
        $J3 = $this->survey->unitJ->J3;
        $J4 = $this->survey->unitJ->J4;
        $J6 = $this->survey->unitJ->J6;
        $J7 = $this->survey->unitJ->J7;
        $J9 = $this->survey->unitJ->J9;
        $K2 = $this->survey->unitK->K2;
        $K3 = $this->survey->unitK->K3;
        $K4 = $this->survey->unitK->K4;
        $L1 = $this->survey->unitL->L1;
        $L2 = $this->survey->unitL->L2;
        $L3 = $this->survey->unitL->L3;
        $L4 = $this->survey->unitL->L4;
        $L5 = $this->survey->unitL->L5;
        $M1 = $this->survey->unitM->M1;
        $O1 = $this->survey->unitO->O1;
        $O2 = $this->survey->unitO->O2;
        $O5 = $this->survey->unitO->O5;
        $O7 = $this->survey->unitO->O7;
        $BMI = $this->getBMI();
        $ADLH = $this->getADLH();
        $CPS = $this->getCPS();

        $report = new Model_ReportProtocols();
        $report->pk = $this->survey->pk;

        // Behaviour - проблемное поведение
        $P1 = 0;
        if ($C1 != 5) {
            foreach ($E3 as $item) { if ($item == 3) { $P1 = 2; } elseif ($item == 2 && $P1 < 2) { $P1 = 1; } }
        } else {
            $P1 = -1;
        }
        $report->P1 = $P1;

        // Communication - Коммуникация
        if ($C1 == 5) {

            $P2 = -1;

        } elseif ($C1 < 2) {

            if (($D1 + $D2) >= 2) {
                $P2 = 1;
            } else {
                $P2 = 0;
            }

        } elseif ($C1 == 3 && $D1 == 3 && $D2 == 3) {
            $P2 = 1;
        } else {
            if( ($C1 == 2 && $D1 == 1 && $D2 == 1) || ($C1 == 3 && $D1 == 1 && $D2 == 1) ||
                (($C1 == 2 || $C1 == 3) && ($D1 >= 3 || $D2 >= 3 || $D1 + $D2 > 2)) ||
                ($C1 == 4 && ($D1 >= 4 || $D2 >= 4 || $D1 + $D2 > 5)) )
            {
                $P2 = 0;
            } else {
                $P2 = 2;
            }
        }
        $report->P2 = $P2;

        // Delirium - деменция
        if ($C1 != 5) {
            $P3 = $C4 == 1 ? 1 : 0;
            if ($P3 == 0) { foreach ($C3 as $item) { if ($item == 2) { $P3 = 1; break; } } }
        } else {
            $P3 = -1;
        }

        $report->P3 = $P3;

        // Mood - Настроение
        $P4 = $this->getDRS();
        $report->P4 = $P4 >= 3 ? 2 : (($P4 == 1 || $P4 == 2) ? 1 : ($P4 != -1 ? 0 : -1));

        // Cardio-respiratory - Сердечно-дыхательная недостаточность
        $P5 = ($J3[2] >= 1 || $J3[4] >= 1 || $J4 >= 1) ? 1 : 0;
        $report->P5 = $P5;

        // Dehydration - Дегидратация
        // Возможно Delirum
        if ($C1 == 5) {
            $P6 = -1;
        } else {
            $P6 = ($K2[1] == 1 || $K2[2] == 1) ? (($K4 >= 1 || $K2[0] == 1 || $J3[2] >= 1 || $J3[11] >= 1 || $J3[12] >= 1 || $J3[13] >= 1 || $J3[17] >= 1) ? 2 : 1) : 0;
        }
        $report->P6 = $P6;

        // Falls - Падения
        $P7 = $J1 == 3 ? 2 : ($J1 == 0 ? 0 : 1);
        $report->P7 = $P7;

        // Feeding Tube - Питательная трубка
        $P8 = ($K3 < 5 || $K3 == 9) ? 0 : (($C1 >= 0 && $C1 <=3) ? 2 : ($C1 != 5 ? 1 : -1));
        $report->P8 = $P8;

        // Nutrition - Питание
        $P9 = ($BMI < 19 && $J7[2] != 1) ? 2 : (($BMI > 22 || $J7[2] == 1) ? 0 : 1);
        $report->P9 = $P9;

        // Pain - Повреждения
        $P10 = ($J6[1] == 3 || $J6[1] == 4) ? 2 : ((($J6[1] == 1 || $J6[1] == 2) && $J6[0] == 3) ? 1 : 0);
        $report->P10 = $P10;

        // Smoking and Drinking
        $P11 = ($J9[0] >= 1 || $J9[1] == 3) ? 1 : 0;
        $report->P11 = $P11;

        // Pressure Ulcer - Тяжелые пролежни
        if ( $C1 == 5 ) {
            $P12 = 3;
        } else {
            $P12 = $L1 >= 2 ? 1 :
                ($L1 == 1 ? 2 :
                    ((($ADLH == 5 || $ADLH == 6) && ($L2 == 1 || $L3 == 1 || $L4 == 1 || $L5 == 1) && $G1[8] >= 4 && $O2 >= 4) ? 3 : 0));
        }
        $report->P12 = $P12;

        // Urinary Incontinence - Недержание мочи
        $P13 = ($H1 <= 1) ? ($C1 < 4 ? 1 : 0) : (
            ($C1 < 2 && $G1[5] < 4 && ($O2[11] == 0 || ($I1[0] > 0 || ($G5 > 1 && $G5 < 8)) || $H2 == 2 || $I1[17] > 0 || $J3[12] > 0)) ? 3 :
                (($C1 < 4 && $H2 != 2 && $I1[17] == 0) ? 2 : 0) );
        $report->P13 = $P13;

        // Physical restraint - Физическая сдержанность
        $P14 = (($O7[1] > 0 || $O7[2] > 0) && $ADLH <= 3) ? 2 :
            ((($O7[1] > 0 || $O7[2] > 0) && $ADLH > 3) ? 1 : 0);
        $report->P14 = $P14;

        // Activities - Активность
        if ($C1 != 5) {
            $P15count = 0;
            if ($E1[8] > 0) $P15count++;
            if ($E1[9] > 0 ) $P15count++;
            if ($F2[0] == 0 ) $P15count++;
            if ($F2[1] == 0) $P15count++;
            if ($F2[4] == 0 ) $P15count++;
            $P15 = ($M1 != 0 && $M1 <= 3 && $C1 <= 3 && $P15count >= 2) ? 1 : 0;
        } else {
            $P15 = -1;
        }
        $report->P15 = $P15;

        // Physical Activities Promotion
        // TODO про тот триггер оставь звездочку что там могут быть еще условия потом
        $P16 = $G3[0] <= 2 && ($G1[5] < 3 || $G4[0] == 1 || $G4[1] == 1) ? 1 : 0;
        $report->P16 = $P16;

        // Prevention
        $P17check = ($O1[0] == 0 || $O1[1] == 0 || $O1[2] == 0 || $O1[3] == 0 || $O1[4] == 0 || $O1[5] == 0 || $O1[6] == 0 || $O1[7] == 0) ? true : false;
        $P17 = ($O5 < 7 && $P17check) ? 2 : (($O5 > 7 && $P17check) ? 1 : 0);
        $report->P17 = $P17;

        // Cognitive Loss
        if ($C1 != 5) {
            $P18count = 0;
            if ($I1[2] >= 2) $P18count++;
            if ($I1[3] >= 2) $P18count++;
            if ($D1 == 4) $P18count++;
            if ($D2 == 4) $P18count++;
            if ($E1[3] >= 2) $P18count++;
            if ($E1[4] >= 2) $P18count++;
            if ($E1[7] >= 2) $P18count++;
            if ($E3[0] >= 2) $P18count++;
            if ($E3[2] >= 2) $P18count++;
            if ($C3[0] == 2) $P18count++;
            if ($C3[1] == 2) $P18count++;
            if ($C3[2] == 2) $P18count++;
            if ($C4 == 1) $P18count++;
            if ($C5 == 2) $P18count++;

            $P18 = $CPS <= 2 ? ($P18count >= 2 ? 2 : ($P18count == 1 ? 1 : 0)) : 0;
        } else {
            $P18 = -1;
        }

        $report->P18 = $P18;

        // Appropriate Medications
        // TODO do it in future
        $P19 = 0;
        $report->P19 = $P19;

        $report->save();
    }



    /**
     * Create RAI Scales Report
     */
    private function createRAIScales()
    {
        $report = new Model_ReportRAIScales();
        $report->pk = $this->survey->pk;

        $report->PURS = $this->getPURS();
        $report->CPS = $this->getCPS();
        $report->BMI = $this->getBMI();
        $report->SRD = $this->getSRD();
        $report->DRS = $this->getDRS();
        $report->Pain = $this->getPain();
        $report->COMM = $this->getCOMM();
        $report->CHESS = $this->getCHESS();
        $report->ADLH = $this->getADLH();
        $report->ABS = $this->getABS();
        $report->ADLLF = $this->getADLLF();

        $report->save();
    }



    /**
     * Pressure Ulcer Risk Scale
     */
    private function getPURS()
    {
        $G1 = $this->survey->unitG->G1;
        $K2 = $this->survey->unitK->K2;

        $J6 = $this->survey->unitJ->J6;
        $purs = 0;
        if ( $G1[8] > 3 ) $purs++;
        if ( $G1[4] > 3 ) $purs++;
        if ( $this->survey->unitH->H3 > 2 ) $purs++;
        if ( $K2[0] == 1 ) $purs++;
        if ( $J6[0] == 3 ) $purs++;
        if ( $this->survey->unitL->L2 == 1 ) $purs = $purs + 2;
        if ( $this->survey->unitJ->J4 >= 2 ) $purs++;

        return $purs;
    }


    /**
     * Cognitive Performance Scale
     */
    private function getCPS()
    {
        switch ($this->survey->unitC->C1) {
            case 5:
                return 6;
                break;
            case 4:
                $G1j = $this->survey->unitG->G1[9];
                if ($G1j == 6 || $G1j == 8) return 6;
                else return 5;
                break;
            default:
                // Impairment Count
                $imp_count = 0;
                if ($this->survey->unitC->C1 > 0) $imp_count++;
                if ($this->survey->unitC->C2[0] == 1) $imp_count++;
                if ($this->survey->unitD->D1 > 0) $imp_count++;
                switch ($imp_count) {
                    case 0: return 0; break;
                    case 1: return 1; break;
                    default:
                        // Severe Impairment Count
                        $sev_imp_count = 0;
                        if ($this->survey->unitC->C1 == 3) $sev_imp_count++;
                        if ($this->survey->unitD->D1 >= 3) $sev_imp_count++;
                        switch ($sev_imp_count) {
                            case 0: return 2; break;
                            case 1: return 3; break;
                            case 2: return 4; break;
                        }
                        break;
                }
                break;
        }
    }


    /**
     * Body Mass Index
     */
    private function getBMI()
    {
        $K1 = $this->survey->unitK->K1;
        return number_format ($K1[1] / ($K1[0] * $K1[0]) * 10000, 2);
    }


    /**
     * Self Rated Depression
     */
    private function getSRD()
    {
        $C1 = $this->survey->unitC->C1;
        $E2 = $this->survey->unitE->E2;

        if ($E2[0] == 8 || $E2[1] == 8 || $E2[2] == 8 || $C1 == 5)
            return -1;
        else
            return $E2[0] + $E2[1] + $E2[2];
    }


    /**
     * Depression Rating Scale
     */
    private function getDRS()
    {
        if ($this->survey->unitC->C1 == 5)
            return -1;

        $E1 = $this->survey->unitE->E1;
        $drs = 0;
        $drs += $E1[0] == 0 ? 0 : (($E1[0] == 1 || $E1[0] == 2) ? 1 : 2);
        $drs += $E1[1] == 0 ? 0 : (($E1[1] == 1 || $E1[1] == 2) ? 1 : 2);
        $drs += $E1[2] == 0 ? 0 : (($E1[2] == 1 || $E1[2] == 2) ? 1 : 2);
        $drs += $E1[3] == 0 ? 0 : (($E1[3] == 1 || $E1[3] == 2) ? 1 : 2);
        $drs += $E1[4] == 0 ? 0 : (($E1[4] == 1 || $E1[4] == 2) ? 1 : 2);
        $drs += $E1[5] == 0 ? 0 : (($E1[5] == 1 || $E1[5] == 2) ? 1 : 2);
        $drs += $E1[6] == 0 ? 0 : (($E1[6] == 1 || $E1[6] == 2) ? 1 : 2);
        return $drs;
    }


    /**
     * Pain Scale
     */
    private function getPain()
    {
        $J6 = $this->survey->unitJ->J6;

        if ($J6[0] == 3) {
            if ($J6[1] >= 3) return 3;
            return 2;
        }

        if ($J6[0] > 0) return 1;

        return 0;
    }


    /**
     * Communication Scale
     */
    private function getCOMM()
    {
        if ($this->survey->unitC->C1 == 5)
            return -1;

        return $this->survey->unitD->D1 + $this->survey->unitD->D2;
    }


    /**
     * Changes in Health, End-Stage Disease, Signs, and Symptoms Scale
     */
    private function getCHESS()
    {
        if ( ( $this->survey->unitG->G5 == 8) ) {

            return -1;

        } else {

            $J3 = $this->survey->unitJ->J3;
            $J7 = $this->survey->unitJ->J7;
            $K2 = $this->survey->unitK->K2;

            $CHESS = 0;
            $count = 0;

            if ( $this->survey->unitC->C5 == 2 ) $CHESS++;
            if ( $this->survey->unitG->G5 == 2 ) $CHESS++;
            if ( $J7[2] == 1 ) $CHESS++;

            if ($count < 2 &&$K2[1] == 1 && $K2[3] == 1) $count++;
            if ($count < 2 &&$K2[0] == 1) $count++;
            if ($count < 2 &&$K2[2] == 1) $count++;
            // может оказаться что J4>1
            if ($count < 2 &&$this->survey->unitJ->J4 != 0) $count++;
            if ($count < 2 &&$J3[13] == 2) $count++;
            if ($count < 2 &&$J3[20] == 2) $count++;

            return $CHESS + $count ;
        }

    }


    /**
     * Activities of Daily Living (Hierarchy)
     */
    private function getADLH()
    {
        //Personal hygiene  $this->survey->unitG->G1[1] => G1b
        //Toilet use        $this->survey->unitG->G1[7] => G1h
        //Locomotion        $this->survey->unitG->G1[5] => G1f
        //Eating            $this->survey->unitG->G1[9] => G1j
        $G1 =  $this->survey->unitG->G1;
        return ($G1[1] >= 6 && $G1[5] >= 6 && $G1[7] >= 6 && $G1[9] >= 6) ? 6 :
            (($G1[9] >= 6 || $G1[5] >= 6) ? 5 :
                ((($G1[9] < 6 && $G1[5] < 6) && ($G1[9] > 3 || $G1[5] > 3)) ? 4 :
                    ((($G1[1] > 3 || $G1[7] > 3) && ($G1[9] < 4 && $G1[5] < 4)) ? 3 :
                        ((($G1[1] < 4 && $G1[7] < 4 && $G1[9] < 4 && $G1[5] < 4) && ($G1[1] == 3 || $G1[7] == 3 || $G1[9] == 3 || $G1[5] == 3)) ? 2 :
                            ((($G1[1] < 3 && $G1[7] < 3 && $G1[9] < 3 && $G1[5] < 3) && ($G1[1] == 2 || $G1[7] == 2 || $G1[9] == 2 || $G1[5] == 2)) ? 1 : 0)))));
    }


    /**
     * Aggressive Behaviour Scale
     */
    private function getABS()
    {
        if ($this->survey->unitC->C1 == 5)
            return -1;

        $E3 =  $this->survey->unitE->E3;
        return $E3[1] + $E3[2] + $E3[3] + $E3[5];
    }


    /**
     * Activities of Daily Living (Long Form)
     */
    private function getADLLF()
    {
        $G1 =  $this->survey->unitG->G1;
        $ADLLF = 0;
        $ADLLF += ($G1[1] == 0 || $G1[1] == 1) ? 0 : ($G1[1] == 2 ? 1 : ($G1[1] == 3 ? 2 : (($G1[1] == 4 || $G1[1] == 5) ? 3 : 4)));
        $ADLLF += ($G1[2] == 0 || $G1[2] == 1) ? 0 : ($G1[2] == 2 ? 1 : ($G1[2] == 3 ? 2 : (($G1[2] == 4 || $G1[2] == 5) ? 3 : 4)));
        $ADLLF += ($G1[3] == 0 || $G1[3] == 1) ? 0 : ($G1[3] == 2 ? 1 : ($G1[3] == 3 ? 2 : (($G1[3] == 4 || $G1[3] == 5) ? 3 : 4)));
        $ADLLF += ($G1[5] == 0 || $G1[5] == 1) ? 0 : ($G1[5] == 2 ? 1 : ($G1[5] == 3 ? 2 : (($G1[5] == 4 || $G1[5] == 5) ? 3 : 4)));
        $ADLLF += ($G1[7] == 0 || $G1[7] == 1) ? 0 : ($G1[7] == 2 ? 1 : ($G1[7] == 3 ? 2 : (($G1[7] == 4 || $G1[7] == 5) ? 3 : 4)));
        $ADLLF += ($G1[8] == 0 || $G1[8] == 1) ? 0 : ($G1[8] == 2 ? 1 : ($G1[8] == 3 ? 2 : (($G1[8] == 4 || $G1[8] == 5) ? 3 : 4)));
        $ADLLF += ($G1[9] == 0 || $G1[9] == 1) ? 0 : ($G1[9] == 2 ? 1 : ($G1[9] == 3 ? 2 : (($G1[9] == 4 || $G1[9] == 5) ? 3 : 4)));

        return $ADLLF;
    }

}
