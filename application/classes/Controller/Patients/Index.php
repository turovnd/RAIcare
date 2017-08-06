<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Patients_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Patients_Index extends Dispatch
{

    public $template = 'main';

    /** Current Organization */
    protected $organization = null;

    /** Current Pension */
    protected $pension = null;

    /** Current Patient */
    protected $patient = null;


    public function before()
    {
        parent::before();

        $org_uri = Request::$subdomain;

        $this->organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (!$this->organization->id && !in_array($org_uri, self::PRIVATE_SUBDOMIANS)) {
            throw new HTTP_Exception_404();
        }

        if (!self::isLogged()) self::gotoLoginPage();

        $pen_uri = $this->request->param('pen_uri');
        $this->pension = Model_Pension::getByFieldName('uri', $pen_uri);

        if (!$this->pension->id || $this->pension->organization != $this->organization->id) {
            throw new HTTP_Exception_404();
        }

        $this->pension->users = Model_UserPension::getUsers($this->pension->id);

        if (! ( in_array($this->user->role,self::PEN_AVAILABLE_ROLES) ||
            $this->user->role == self::ROLE_PEN_CREATOR ||
            in_array($this->user->id, $this->pension->users) || $this->user->role == 1) ) {

            throw new HTTP_Exception_403();

        }

        $data = array(
            'aside_type' => 'pension',
            'pension'    => $this->pension,
            'action'     => $this->request->action()
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);
    }


//    public function action_all_patients()
//    {
//        self::hasAccess(self::WATCH_ALL_PATIENTS_PROFILES);
//
//        $patients = Model_Patient::getAll(0,10);
//
//        $this->template->title = "База данных пациентов всех пансионатов";
//        $this->template->section = View::factory('patients/pages/all-patients')
//            ->set('patients', $patients);
//    }
//
//
//    public function action_all_patient()
//    {
//        self::hasAccess(self::WATCH_ALL_PATIENTS_PROFILES);
//
//        $this->getPatient();
//
//        $pensions   = array();
//        $sameSnils  = array();
//
//        $same_patients = Model_Patient::getSamePatients($this->patient);
//
//        foreach ($same_patients as $same_patient) {
//            $sameSnils[] = $same_patient['pat_id'];
//            $pension = new Model_Pension($same_patient['pen_id']);
//            $pension->organization = new Model_Organization($pension->organization );
//            $pension->owner = new Model_User($pension->owner);
//            $pension->creator = new Model_User($pension->creator);
//            $pensions[] = $pension;
//        }
//
//        $surveys = Model_Survey::getAllFormsByPatients($sameSnils, 0, 10);
//
//        $this->patient->creator   = new Model_User($this->patient->creator);
//        $this->patient->pensions  = $pensions;
//        $this->patient->sameSnils = $sameSnils;
//        $this->patient->surveys   = $surveys;
//        $this->patient->full_info = true;
//
//        $this->template->title = "Профиль пациента " . $this->patient->name;
//        $this->template->section = View::factory('patients/pages/profile-full')
//            ->set('patient', $this->patient);
//    }


    public function action_patients()
    {
        if (! ($this->user->role == self::ROLE_PEN_CREATOR ||
            $this->user->role == self::ROLE_PEN_QUALITY_MANAGER ||
            $this->user->role == self::ROLE_PEN_NURSE) ) {

            throw new HTTP_Exception_403;
        }

        $patients = Model_Patient::getByPension($this->pension->id, 0, 10);

        foreach ($patients as $key => $patient) {
            $patients[$key]->survey = Model_Survey::getFillingSurveyByPatientAndPension($patient->pk, $this->pension->id);
        }

        $this->template->title = "Все пациенты пансионата - " . $this->pension->name;
        $this->template->section = View::factory('patients/pages/patients-in-pension')
            ->set('pension', $this->pension)
            ->set('patients', $patients);
    }


    public function action_patient()
    {
        if (! ($this->user->role == self::ROLE_PEN_CREATOR ||
            $this->user->role == self::ROLE_PEN_QUALITY_MANAGER ||
            $this->user->role == self::ROLE_PEN_NURSE) ) {

            throw new HTTP_Exception_403;
        }

        $pat_id = $this->request->param('id');

        $this->patient = Model_Patient::getByPensionAndID($this->pension->id, $pat_id);

        if (!$this->patient->pk) {
            throw new HTTP_Exception_404();
        }

        $surveys = Model_Survey::getAllFinishedByPatientAndPension($this->patient->pk, $this->pension->id, 0, 10);

        $this->patient->creator = new Model_User($this->patient->creator);
        $this->patient->surveys = $surveys;
        $this->patient->full_info = true;

        if ( $this->user->role == self::ROLE_PEN_QUALITY_MANAGER || $this->user->role == self::ROLE_PEN_NURSE ) {
            $this->patient->can_edit = true;
        } else {
            $this->patient->can_edit = false;
        }

        $this->template->title = "Профиль пациента " . $this->patient->name;
        $this->template->section = View::factory('patients/pages/profile')
            ->set('patient', $this->patient);
    }


}