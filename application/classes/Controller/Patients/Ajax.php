<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Patients_Ajax
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Patients_Ajax extends Ajax
{
    public function action_new()
    {
        if (!( $this->user->role == self::ROLE_PEN_QUALITY_MANAGER || $this->user->role == self::ROLE_PEN_NURSE )) {
            throw new HTTP_Exception_403();
        }

        $name                    = trim(Arr::get($_POST,'name'));
        $sex                     = Arr::get($_POST,'sex');
        $birthday                = Date::formatted_time(Arr::get($_POST,'birthday'));
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

        if (!Valid::exact_length($oms, 16) || !Valid::digit($oms)) {
            $response = new Model_Response_Patients('PATIENTS_OMS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::exact_length($disability_certificate, 18) || !Valid::digit($disability_certificate)) {
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

        $count_patients = $this->redis->get(getenv('REDIS_PATIENT_HASHES') . $pension->id . ':patients');
        $count_patients = $count_patients == false ? 1 : $count_patients + 1;
        $this->redis->set(getenv('REDIS_PATIENT_HASHES') . $pension->id . ':patients', $count_patients);

        $patient = new Model_Patient();

        $patient->id                     = $count_patients;
        $patient->pension                = $pension->id;
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

        // create new survey
        $count_surveys = $this->redis->get(getenv('REDIS_PATIENT_HASHES') . $pension->id . ':surveys');
        $count_surveys = $count_surveys == false ? 1 : $count_surveys + 1;
        $this->redis->set(getenv('REDIS_PATIENT_HASHES') . $pension->id . ':surveys', $count_surveys);

        $survey = new Model_Survey();
        $survey->id           = $count_surveys;
        $survey->patient      = $patient->pk;
        $survey->pension      = $pension->id;
        $survey->organization = $pension->organization;
        $survey->type         = 1;
        $survey->creator      = $this->user->id;
        $survey->save();

        $response = new Model_Response_Patients('PATIENTS_CREATE_SUCCESS', 'success', array('id' => $count_surveys));
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_get()
    {
        if (! ($this->user->role == self::ROLE_PEN_CREATOR ||
            $this->user->role == self::ROLE_PEN_QUALITY_MANAGER ||
            $this->user->role == self::ROLE_PEN_NURSE) ) {

            throw new HTTP_Exception_403;
        }

        $mode    = Arr::get($_POST, 'mode');
        $name    = Arr::get($_POST, 'name');
        $offset  = Arr::get($_POST, 'offset');
        $pension = Arr::get($_POST, 'pension');

        $pension = new Model_Pension($pension);

        if (!$pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $patients = Model_Patient::getByPension($pension->id, $offset, 10, $name);

        $html = "";
        foreach ($patients as $patient) {
            $patient->survey = Model_Survey::getFillingSurveyByPatientAndPension($patient->pk, $pension->id);
            $html .= View::factory('patients/blocks/search-block', array('patient' => $patient))->render();
        }

        $response = new Model_Response_Patients('PATIENTS_GET_SUCCESS', 'success', array('html'=>$html, 'number'=>count($patients)));
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_update()
    {
        if (!( $this->user->role == self::ROLE_PEN_QUALITY_MANAGER || $this->user->role == self::ROLE_PEN_NURSE )) {
            throw new HTTP_Exception_403();
        }

        $pk      = Arr::get($_POST, 'pk');
        $name    = Arr::get($_POST, 'name');
        $value   = Arr::get($_POST, 'value');
        $pension = Arr::get($_POST, 'pension');

        if (empty($value)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'birthday' && !Valid::date($value)) {
            $response = new Model_Response_Patients('PATIENTS_BIRTHDAY_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'name' && substr_count($value, ' ') != 2) {
            $response = new Model_Response_Patients('PATIENTS_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'snils' && (!Valid::exact_length($value, 11) || !Valid::digit($value))) {
            $response = new Model_Response_Patients('PATIENTS_SNILS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'oms' && (!Valid::exact_length($value, 16) || !Valid::digit($value))) {
            $response = new Model_Response_Patients('PATIENTS_OMS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'disability_certificate' && (!Valid::exact_length($value, 18) || !Valid::digit($value))) {
            $response = new Model_Response_Patients('PATIENTS_DISABILITY_CERTIFICATE_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $patient = new Model_Patient($pk);

        if (!$patient->pk) {
            $response = new Model_Response_Patients('PATIENTS_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($patient->$name == $value) {
            $response = new Model_Response_Patients('PATIENTS_UPDATE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension = new Model_Pension($pension);

        if (!$pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($patient->pension != $pension->id) {
            $response = new Model_Response_Patients('PATIENT_PENSION_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'snils' && Model_Patient::checkBySnilsAndPension($value, $pension->id)) {
            $response = new Model_Response_Patients('PATIENTS_SNILS_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $patient->$name = $value;
        $patient->update();

        $response = new Model_Response_Patients('PATIENTS_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

}