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
        $patient = new Model_Patient($id);

        if (!$patient->pk)
            throw new HTTP_Exception_404();

        $forms      = array();
        $pensions   = array();
        $sameSnils  = array();

        $same_patients = Model_Patient::getSamePatients($patient);

        if (count($same_patients) == 1) goto finish;

        foreach ($same_patients as $same_patient) {
            $sameSnils[] = $same_patient['pat_id'];
            $pension = new Model_Pension($same_patient['pen_id']);
            $pension->organization = new Model_Organization($pension->organization );
            $pension->owner = new Model_User($pension->owner);
            $pension->creator = new Model_User($pension->creator);
            $pensions[] = $pension;
        }

        $forms = Model_LongTermForm::getAllFormsByPatients($sameSnils, 0, 10);

        finish:
        $patient->creator   = new Model_User($patient->creator);
        $patient->pensions  = $pensions;
        $patient->sameSnils = $sameSnils;
        $patient->forms     = $forms;

        $this->template->title = "Профиль пациента " . $patient->name;
        $this->template->section = View::factory('patients/pages/profile-full')
            ->set('patient', $patient);
    }



}