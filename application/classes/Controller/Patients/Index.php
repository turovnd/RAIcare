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

    protected $pension  = null;
    protected $patient  = null;

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


    public function action_all_patient()
    {
        self::hasAccess(self::WATCH_ALL_PATIENTS_PROFILES);

        $this->getPatient();

        $forms      = array();
        $pensions   = array();
        $sameSnils  = array();

        $same_patients = Model_Patient::getSamePatients($this->patient);

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
        $this->patient->creator   = new Model_User($this->patient->creator);
        $this->patient->pensions  = $pensions;
        $this->patient->sameSnils = $sameSnils;
        $this->patient->forms     = $forms;

        $this->template->title = "Профиль пациента " . $this->patient->name;
        $this->template->section = View::factory('patients/pages/profile-full')
            ->set('patient', $this->patient);
    }


    public function action_pen_patients()
    {
        if (!in_array(self::WATCH_ALL_PATIENTS_PROFILES, $this->user->permissions)) {
            if (!in_array(self::WATCH_PATIENTS_PROFILES_IN_PEN, $this->user->permissions)) {
                throw new HTTP_Exception_403;
            }
        }

        $this->getPension();
        $patients = Model_Patient::getByPension($this->pension->id, 0, 10);

        foreach ($patients as $key => $patient) {
            $patients[$key]->form = Model_LongTermForm::getFillingFormByPatientAndPension($patient->pk, $this->pension->id);
        }

        $this->template->title = "База данных пациентов пансионата " . $this->pension->name;
        $this->template->section = View::factory('patients/pages/pension-patients')
            ->set('pension', $this->pension)
            ->set('patients', $patients);
    }


    public function action_pen_patient()
    {
        self::hasAccess(self::WATCH_PATIENTS_PROFILES_IN_PEN);

        $this->getPatient();
        $this->getPension();

        $forms = Model_LongTermForm::getAllFormsByPatientAndPension($this->patient->pk, $this->pension->id, 0, 10);

        $this->patient->creator = new Model_User($this->patient->creator);
        $this->patient->pension = $this->pension;
        $this->patient->forms   = $forms;

        $this->template->title = "Профиль пациента " . $this->patient->name;
        $this->template->section = View::factory('patients/pages/profile')
            ->set('patient', $this->patient);
    }


    private function getPension()
    {
        $pension = $this->request->param('pen_id');

        $this->pension = new Model_Pension($pension);

        if (!$this->pension->id) {
            throw new HTTP_Exception_404();
        }

        $usersIDs = Model_UserPension::getUsers($this->pension->id);

        if (!(in_array($this->user->id, $usersIDs))) {
            if ( $this->user->role != 1 ) {
                throw new HTTP_Exception_403();
            }
        }
    }


    private function getPatient()
    {
        $patient = $this->request->param('pat_pk');
        $this->patient = new Model_Patient($patient);

        if (!$patient) {
            $patient = $this->request->param('pat_id');
            $this->patient = Model_Patient::getByFieldName('id', $patient);
        }

        if (!$this->patient->pk) {
            throw new HTTP_Exception_404();
        }

    }


}