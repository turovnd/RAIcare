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

        if (!self::isLogged()) self::gotoLoginPage();

        $org_uri = Request::$subdomain;
        $this->organization = Model_Organization::getByUri($org_uri);

        if (!$this->organization->id && !in_array($org_uri, self::PRIVATE_SUBDOMIANS)) {
            throw new HTTP_Exception_404();
        }

        $pen_uri = $this->request->param('pen_uri');
        $this->pension = Model_Pension::getByUri($pen_uri);

        if (!$this->pension->id || $this->pension->organization != $this->organization->id) {
            throw new HTTP_Exception_404();
        }

        $this->pension->users = Model_UserPension::getUsers($this->pension->id);

        if (! ( ( in_array($this->user->id, $this->pension->users) && (
                $this->user->role == self::ROLE_PEN_CREATOR ||
                $this->user->role == self::ROLE_PEN_QUALITY_MANAGER ||
                $this->user->role == self::ROLE_PEN_NURSE ) ) ||
            $this->user->role == self::ROLE_ORG_CREATOR ||
            $this->user->role == self::ROLE_ORG_QUALITY_MANAGER ||
            $this->user->role == self::ROLE_ADMIN ||
            $this->user->role == self::ROLE_DEMO ) ) {

            throw new HTTP_Exception_403;
        }

        $data = array(
            'aside_type' => 'patient',
            'pension'    => $this->pension,
            'action'     => $this->request->action()
        );

        $this->template->aside = View::factory('global-blocks/aside', $data);
    }


    /**
     * Patients Page in Pension
     * @throws HTTP_Exception_403
     */
    public function action_patients()
    {
        $patients_selections = Model_Patient::getAllByPensionStatus($this->pension->id, 1, false);

        $patients = array();

        foreach ($patients_selections as $item) {
            $patient = new Model_Patient();
            $patient = $patient->fill_by_row($item);
            $patient->survey = Model_Survey::getLastByPensionPatient($patient->pension, $patient->pk);
            $patient->survey->creator = new Model_User($patient->survey->creator);
            $patient->survey->dt_create_timestamp = strtotime($patient->survey->dt_create);
            $patients[] = $patient;
        }

        $this->template->title = "Резиденты пансионата - " . $this->pension->name;
        $this->template->section = View::factory('patients/pages/patients-in-pension')
            ->set('pension', $this->pension)
            ->set('patients', $patients);
    }


    /**
     * Patient Profile Page in pension
     * @throws HTTP_Exception_403
     * @throws HTTP_Exception_404
     */
    public function action_patient()
    {
        $pat_id = $this->request->param('id');

        $this->patient = Model_Patient::getByPensionPatID($this->pension->id, $pat_id);

        if (!$this->patient->pk) {
            throw new HTTP_Exception_404();
        }

        $surveys = Model_Survey::getAllByPensionPatient($this->pension->id, $this->patient->pk);

        $this->patient->creator = new Model_User($this->patient->creator);
        $this->patient->survey = Model_Survey::getLastByPensionPatient($this->pension->id, $this->patient->pk, 2);
        $this->patient->survey->dt_create_timestamp = strtotime($this->patient->survey->dt_create);

        if ( $this->user->role == self::ROLE_PEN_QUALITY_MANAGER ) {
            $this->patient->can_edit = true;
        } else {
            $this->patient->can_edit = false;
        }

        $this->template->title = "Личное дело #" . $this->patient->id;
        $this->template->section = View::factory('patients/pages/profile')
            ->set('pension', $this->pension)
            ->set('surveys', $surveys)
            ->set('patient', $this->patient);
    }


    /**
     * Patient Status Report On Pension Page
     * - report is base on the last finished survey
     * @throws HTTP_Exception_404
     */
    public function action_status()
    {
        $pat_id = $this->request->param('id');

        $this->patient = Model_Patient::getByPensionPatID($this->pension->id, $pat_id);

        if (!$this->patient->pk)
            throw new HTTP_Exception_404();

        $survey = Model_Survey::getLastByPensionPatient($this->pension->id, $this->patient->pk, 2);

        if (! $survey->pk )
            throw new HTTP_Exception_404();


        $this->patient->dt_first_survey = Model_Survey::getFirstByPensionPatient($this->pension->id, $this->patient->pk)->dt_create;

        $survey->unitC = new Model_SurveyUnitC($survey->unitC);

        $survey->unitD = new Model_SurveyUnitD($survey->unitD);
        $survey->unitD->D3 = json_decode($survey->unitD->D3);
        $survey->unitD->D4 = json_decode($survey->unitD->D4);

        $survey->unitG = new Model_SurveyUnitG($survey->unitG);
        $survey->unitG->G1 = json_decode($survey->unitG->G1);


        $this->template->title = "Текущее состояние резидента #" . $this->patient->id;
        $this->template->section = View::factory('reports/patient/status')
            ->set('pension', $this->pension)
            ->set('patient', $this->patient)
            ->set('survey', $survey);
    }
}