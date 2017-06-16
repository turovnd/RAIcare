<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Pensions_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Pensions_Index extends Dispatch
{
    CONST WATCH_ALL_PENSIONS_PAGE        = 24;
    CONST WATCH_CREATED_PENSIONS_PAGE    = 25;
    CONST WATCH_MY_PEN_PAGE              = 26;
    CONST EDIT_PENSION                   = 27;
    CONST STATISTIC_PENSION              = 30;
    CONST WATCH_ALL_PATIENTS_PROFILES    = 34;
    CONST WATCH_PATIENTS_PROFILES_IN_PEN = 35;
    CONST CAN_CONDUCT_A_SURVEY           = 36;
    CONST AVAILABLE_PERMISSIONS_PEN      = array(27,28,29,30,31,32,36);

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        $data = array(
            'action'    => 'pen_' . $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    public function action_all()
    {
        self::hasAccess(self::WATCH_ALL_PENSIONS_PAGE);

        $pensions = Model_Pension::getAll(0,10);

        $this->template->title = "Все пансионаты";
        $this->template->section = View::factory('pensions/pages/pensions')
            ->set('title', $this->template->title)
            ->set('pensions', $pensions)
            ->set('type', 'all_pensions');
    }


    public function action_created()
    {
        self::hasAccess(self::WATCH_CREATED_PENSIONS_PAGE);

        $pensions = Model_Pension::getByCreator($this->user->id, 0, 10);

        $this->template->title = "Созданные пансионаты";
        $this->template->section = View::factory('pensions/pages/pensions')
            ->set('title', $this->template->title)
            ->set('pensions', $pensions)
            ->set('type', 'created_pensions');
    }


    public function action_my()
    {
        self::hasAccess(self::WATCH_MY_PEN_PAGE);

        $pensionsID = Model_UserPension::getPensions($this->user->id);

        $pensions = array();

        if (!empty($pensionsID)) {
            foreach ($pensionsID as $id) {
                $pension = new Model_Pension($id);
                $pension->creator = new Model_User($pension->creator);
                $pension->owner = new Model_User($pension->owner);
                $pension->organization = new Model_Organization($pension->organization);
                $pensions[] = $pension;
            }
        }

        $this->template->title = "Мои пансионаты";
        $this->template->section = View::factory('pensions/pages/my-pensions')
            ->set('pensions', $pensions);
    }


    public function action_pension()
    {
        $id = $this->request->param('id');
        $pension = new Model_Pension($id);

        if (!$pension->id)
            throw new HTTP_Exception_404();

        $usersIDs = Model_UserPension::getUsers($pension->id);

        if (!(in_array($this->user->id, $usersIDs) || $pension->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

        $users = array();
        foreach ($usersIDs as $userID) {
            $user = new Model_User($userID);
            $user->role = new Model_Role($user->role);
            $users[] = $user;
        }

        $permissions = array();
        foreach (self::AVAILABLE_PERMISSIONS_PEN as $permission) {
            $permissions[] = new Model_Permission($permission);
        }

        $roles = array();
        $availableRoles = Model_Role::getByType('organization', $pension->id);
        foreach ($availableRoles as $role) {
            $roles[] = new Model_Role($role->id);
        }

        $pension->users       = $users;
        $pension->permissions = $permissions;
        $pension->roles       = $roles;

        $this->template->title = $pension->name;
        $this->template->section = View::factory('pensions/pages/main')
            ->set('pension', $pension);

    }


    public function action_settings()
    {
        $id = $this->request->param('id');
        $pension = new Model_Pension($id);

        if (!$pension->id)
            throw new HTTP_Exception_404();

        self::hasAccess(self::EDIT_PENSION);

        $usersIDs = Model_UserPension::getUsers($pension->id);

        if (!(in_array($this->user->id, $usersIDs) || $pension->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

        $users = array();
        foreach ($usersIDs as $userID) {
            $user = new Model_User($userID);
            $user->role = new Model_Role($user->role);
            $users[] = $user;
        }

        $permissions = array();
        foreach (self::AVAILABLE_PERMISSIONS_PEN as $permission) {
            $permissions[] = new Model_Permission($permission);
        }

        $roles = array();
        $availableRoles = Model_Role::getByType('organization', $pension->id);
        foreach ($availableRoles as $role) {
            $roles[] = new Model_Role($role->id);
        }

        $pension->users       = $users;
        $pension->permissions = $permissions;
        $pension->roles       = $roles;

        $this->template->title = $pension->name;
        $this->template->section = View::factory('pensions/pages/settings')
            ->set('pension', $pension);

    }


    public function action_statistic()
    {
        $id = $this->request->param('id');
        $pension = new Model_Pension($id);

        if (!$pension->id)
            throw new HTTP_Exception_404();

        self::hasAccess(self::STATISTIC_PENSION);

        $usersIDs = Model_UserPension::getUsers($pension->id);

        if (!(in_array($this->user->id, $usersIDs) || $pension->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

        $this->template->title = $pension->name;
        $this->template->section = View::factory('pensions/pages/statistic')
            ->set('pension', $pension);
    }


    public function action_survey()
    {
        $id = $this->request->param('id');
        $pension = new Model_Pension($id);

        if (!$pension->id)
            throw new HTTP_Exception_404();

        self::hasAccess(self::CAN_CONDUCT_A_SURVEY);

        $usersIDs = Model_UserPension::getUsers($pension->id);

        if (!(in_array($this->user->id, $usersIDs)))
            throw new HTTP_Exception_403();


        $this->template->title = "Анкетирование";
        $this->template->section = View::factory('pensions/pages/survey')
            ->set('pension', $pension);
    }


    public function action_patients()
    {
        $id = $this->request->param('id');
        $pension = new Model_Pension($id);

        if (!$pension->id)
            throw new HTTP_Exception_404();

        //$patients = Model_Patient::getByPension($pension->id);

        $this->template->title = "База данных пациентов пансионата " . $pension->name;
        $this->template->section = View::factory('patients/pages/pension-patients')
            ->set('pension', $pension);
            //->set('patients', $patients);
    }


    public function action_patient()
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