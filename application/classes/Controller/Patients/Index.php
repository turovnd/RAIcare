<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Patients_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Patients_Index extends Dispatch
{
    CONST WATCH_ALL_PATIENTS_PROFILES    = 34;
    CONST WATCH_PATIENTS_PROFILES_IN_PEN = 35;
    CONST CAN_CREATE_EVALUATION_FORMS    = 36;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        $data = array(
            'action'    => $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    public function action_all_patients()
    {
        self::hasAccess(self::WATCH_ALL_PATIENTS_PROFILES);

        $patients = Model_Patient::getAll(0,10);

        $this->template->title = "База данных пациентов всех пансионатов";
        $this->template->section = View::factory('patients/pages/all-patients')
            ->set('patients', $patients);
    }


    public function action_patient()
    {
        self::hasAccess(self::WATCH_ALL_PATIENTS_PROFILES);

        $id = $this->request->param('id');
        $patient = new Model_Pension($id);

        if (!$patient->id)
            throw new HTTP_Exception_404();

        $this->template->title = "Профиль пациента " . $patient->name;
        $this->template->section = View::factory('patients/pages/profile-full')
            ->set('patient', $patient);
    }


    public function action_pension_patients()
    {
        self::hasAccess(self::WATCH_PATIENTS_PROFILES_IN_PEN);

        $id = $this->request->param('id');
        $pension = new Model_Pension($id);

        if (!$pension->id)
            throw new HTTP_Exception_404();

        $patients = Model_Patient::getByPension($pension->id);

        $this->template->title = "База данных пациентов пансионата " . $pension->name;
        $this->template->section = View::factory('patients/pages/pension-patients')
            ->set('pension', $pension)
            ->set('patients', $patients);
    }


    public function action_pension_patient()
    {
        $pension_id = $this->request->param('pension_id');
        $patient_id = $this->request->param('patient_id');

        if (in_array(self::WATCH_ALL_PATIENTS_PROFILES, $this->user->permissions)) {
            HTTP::redirect('patient/' . $patient_id);
        }

        self::hasAccess(self::WATCH_PATIENTS_PROFILES_IN_PEN);

        $pension = new Model_Pension($pension_id);
        $patient = new Model_Patient($patient_id);

        if (!$pension->id || !$patient ->id)
            throw new HTTP_Exception_404();


        $usersIDs = Model_UserPension::getUsers($pension->id);

        if (!(in_array($this->user->id, $usersIDs)))
            throw new HTTP_Exception_403();


        $this->template->title = "Профиль " . $patient->name;
        $this->template->section = View::factory('patient/pages/profile')
            ->set('patient', $patient)
            ->set('pension', $pension);
    }


}