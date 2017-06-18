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
        $patient = new Model_Pension($id);

        if (!$patient->pk)
            throw new HTTP_Exception_404();

        $this->template->title = "Профиль пациента " . $patient->name;
        $this->template->section = View::factory('patients/pages/profile-full')
            ->set('patient', $patient);
    }



}