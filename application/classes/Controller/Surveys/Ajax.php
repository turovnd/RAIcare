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

        $html = View::factory('surveys/units/' . $unit, array('survey' => $this->survey))->render();

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

        $this->survey->patient = new Model_Patient($this->survey->patient);
    }
}