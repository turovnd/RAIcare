<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Patients_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Patients_Ajax extends Ajax
{
    CONST WATCH_ALL_PATIENTS_PROFILES    = 34;
    CONST WATCH_PATIENTS_PROFILES_IN_PEN = 35;
    CONST CAN_CONDUCT_A_SURVEY           = 36;

    public function action_new()
    {
        self::hasAccess(self::CAN_CONDUCT_A_SURVEY);

        $name                    = trim(Arr::get($_POST,'name'));
        $sex                     = Arr::get($_POST,'sex');
        $birthday                = Arr::get($_POST,'birthday');
        $relation                = Arr::get($_POST,'relation');
        $snils                   = Arr::get($_POST,'snils');
        $oms                     = Arr::get($_POST,'oms');
        $disability_certificate  = Arr::get($_POST,'disability_certificate');
        $pension                 = Arr::get($_POST,'pension');
        $sources                 = Arr::get($_POST,'sources');

        if (empty($name) || empty($sex) || empty($relation) || empty($snils) || count($sources) == 0) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::date($birthday)) {
            $response = new Model_Response_Patients('PATIENTS_BIRTHDAY_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (substr_count($name, ' ') != 2) {
            $response = new Model_Response_Patients('PATIENTS_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::exact_length($snils, 11) || !Valid::digit($snils)) {
            $response = new Model_Response_Patients('PATIENTS_SNILS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!empty($oms) && (!Valid::exact_length($oms, 16) || !Valid::digit($oms))) {
            $response = new Model_Response_Patients('PATIENTS_OMS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!empty($disability_certificate) && (!Valid::exact_length($disability_certificate, 18) || !Valid::digit($disability_certificate))) {
            $response = new Model_Response_Patients('PATIENTS_DISABILITY_CERTIFICATE_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension = new Model_Pension($pension);

        if (!$pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (Model_Patient::checkBySnilsAndPension($snils, $pension->id)) {
            $response = new Model_Response_Patients('PATIENTS_SNILS_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $count_patients = $this->redis->get(self::REDIS_PACKAGE . ':pensions:' . $pension->id . ':patients');
        $count_patients = $count_patients == false ? 1 : $count_patients + 1;
        $this->redis->set(self::REDIS_PACKAGE . ':pensions:' . $pension->id . ':patients', $count_patients);

        $patient = new Model_Patient();

        $patient->id                     = $count_patients;
        $patient->name                   = $name;
        $patient->sex                    = $sex;
        $patient->birthday               = $birthday;
        $patient->relation               = $relation;
        $patient->snils                  = $snils;
        $patient->oms                    = $oms;
        $patient->disability_certificate = $disability_certificate;
        $patient->sources                = json_encode($sources);
        $patient->creator                = $this->user->id;

        $patient = $patient->save();

        Model_PensionPatient::add($pension->id, $patient->pk);

        $count_forms = $this->redis->get(self::REDIS_PACKAGE . ':pensions:' . $pension->id . ':longtermforms');
        $count_forms = $count_forms == false ? 1 : $count_forms + 1;
        $this->redis->set(self::REDIS_PACKAGE . ':pensions:' . $pension->id . ':longtermforms', $count_forms);

        $form = new Model_LongTermForm();
        $form->id           = $count_forms;
        $form->patient      = $patient->pk;
        $form->pension      = $pension->id;
        $form->organization = $pension->organization;
        $form->type         = 1;
        $form->creator      = $this->user->id;
        $form->save();

        $response = new Model_Response_Patients('PATIENTS_CREATE_SUCCESS', 'success', array('id' => $count_forms));
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_get()
    {
        self::hasAccess(self::WATCH_PATIENTS_PROFILES_IN_PEN);

        $name    = Arr::get($_POST, 'name');
        $pension = Arr::get($_POST, 'pension');
        $offset  = Arr::get($_POST, 'offset');

        $pension = new Model_Pension($pension);

        if (!$pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $patients = Model_Patient::getByPension($pension->id, $offset, 10, $name);

        $html = "";
        foreach ($patients as $patient) {
            $patient->form = Model_LongTermForm::getFillingFormByPatientAndPension($patient->pk, $pension->id);
            $html .= View::factory('patients/blocks/search-block', array('patient' => $patient))->render();
        }

        $response = new Model_Response_Patients('PATIENTS_GET_SUCCESS', 'success', array('html'=>$html, 'number'=>count($patients)));
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_getAll()
    {
        self::hasAccess(self::WATCH_ALL_PATIENTS_PROFILES);

        $name    = Arr::get($_POST, 'name');
        $offset  = Arr::get($_POST, 'offset');

        $patients = Model_Patient::getAll($offset, 10, $name);


        $html = "";
        foreach ($patients as $patient) {
            $html .= View::factory('patients/blocks/search-block', array('patient' => $patient))->render();
        }

        $response = new Model_Response_Patients('PATIENTS_GET_SUCCESS', 'success', array('html'=>$html, 'number'=>count($patients)));
        $this->response->body(@json_encode($response->get_response()));
    }
}