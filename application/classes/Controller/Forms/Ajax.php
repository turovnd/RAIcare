<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Forms_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Forms_Ajax extends Ajax
{
    CONST WATCH_ALL_PATIENTS_PROFILES    = 34;
    CONST WATCH_PATIENTS_PROFILES_IN_PEN = 35;
    CONST CAN_CONDUCT_A_SURVEY           = 36;
    public $pension  = null;
    public $usersIDs = null;
    public $patient  = null;

    /**
     * Creating new Long-Term-Form
     */
    public function action_longterm_create()
    {
        self::hasAccess(self::CAN_CONDUCT_A_SURVEY);
        $this->getPatintAndPensionData();
        $type    = Arr::get($_POST,'type');

        if (empty($type)) {
            $response = new Model_Response_Longtermform('FORM_TYPE_EMPTY_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $count_forms = $this->redis->get(self::REDIS_PACKAGE . ':pensions:' . $this->pension->id . ':longtermforms');
        $count_forms = $count_forms == false ? 1 : $count_forms + 1;
        $this->redis->set(self::REDIS_PACKAGE . ':pensions:' . $this->pension->id . ':longtermforms', $count_forms);

        $form               = new Model_LongTermForm();
        $form->id           = $count_forms;
        $form->patient      = $this->patient->pk;
        $form->pension      = $this->pension->id;
        $form->organization = $this->pension->organization;
        $form->type         = $type;
        $form->creator      = $this->user->id;
        $form->save();

        $response = new Model_Response_Longtermform('FORM_CREATED_SUCCESS', 'success', array('id' => $count_forms));
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_update()
    {

    }

    public function action_longterm_get()
    {
        $patients = json_decode(Arr::get($_POST,'patients'));
        $type     = Arr::get($_POST,'type');
        $offset   = Arr::get($_POST,'offset');
        $forms = array();
        switch ($type) {
            case 'json':
                self::hasAccess(self::WATCH_ALL_PATIENTS_PROFILES);
                $formsModel = Model_LongTermForm::getAllFormsByPatients($patients, $offset, 10);
                foreach ($formsModel as $key => $form) {
                    $forms[] = array(
                        'date' => date('M Y', strtotime($form->dt_finish)),
                        'html' => View::factory('patients/blocks/timeline-item', array('key' => $key + $offset, 'form' => $form))->render()
                    );
                }
                break;
            case 'id':
                self::hasAccess(self::WATCH_PATIENTS_PROFILES_IN_PEN);
                $this->getPatintAndPensionData();
                break;
        }

        $response = new Model_Response_Longtermform('FORM_GET_SUCCESS', 'success', array('forms' => $forms, 'number' => count($forms)));
        $this->response->body(@json_encode($response->get_response()));
    }



    private function getPatintAndPensionData()
    {
        $pension = Arr::get($_POST,'pension');
        $patient = Arr::get($_POST,'patient');

        $this->pension = new Model_Pension($pension);

        if (!$this->pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $this->usersIDs = Model_UserPension::getUsers($this->pension->id);

        if (!(in_array($this->user->id, $this->usersIDs))) {
            throw new HTTP_Exception_403();
        }

        $this->patient = new Model_Patient($patient);

        if (!$this->patient->pk) {
            $response = new Model_Response_Patients('PATIENTS_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }
    }
}
