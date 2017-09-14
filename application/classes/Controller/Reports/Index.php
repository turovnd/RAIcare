<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Reports_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Reports_Index extends Dispatch
{
    public $template = 'main';

    /** Current Organization */
    protected $organization = null;

    /** Current Pension */
    protected $pension = null;

    /** Current Patient */
    protected $patient = null;

    /** Current Survey */
    protected $survey   = null;

    /** Current Report */
    protected $report = null;


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

        if (! ( in_array($this->user->role,self::PEN_AVAILABLE_ROLES) ||
            $this->user->role == self::ROLE_PEN_CREATOR ||
            in_array($this->user->id, $this->pension->users) || $this->user->role == 1) ) {

            throw new HTTP_Exception_403();

        }

        $patient_actions = array('personal', 'clinical', 'status', 'careplan');

        $data = array(
            'aside_type' => in_array($this->request->action(), $patient_actions ) ? 'patient' : 'report',
            'pension'    => $this->pension,
            'action'     => $this->request->action()
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);
    }

    /**
     * Patient Personal Report On Pension Page
     * @throws HTTP_Exception_404
     */
    public function action_personal()
    {
        $id = $this->request->param('id');
        $this->report = Model_ReportRAIScales::getByPensionAndID($this->pension->id, $id);

        if (!$this->report->pk) throw new HTTP_Exception_404();

        $this->survey = new Model_Survey($this->report->pk);
        $this->patient = new Model_Patient($this->survey->patient);
        $this->patient->dt_first_survey = Model_Survey::getFirstByPensionPatient($this->pension->id, $this->patient->pk)->dt_create;

        if (! ($this->survey->pk && $this->patient->pk) ) throw new HTTP_Exception_404();

        $this->getUnitsData();

        $this->template->title = "Персональный отчет #" . $this->survey->id;
        $this->template->section = View::factory('reports/patient/personal')
            ->set('pension', $this->pension)
            ->set('patient', $this->patient)
            ->set('survey', $this->survey)
            ->set('report', $this->report);
    }


    /**
     * Patient Clinical Report On Pension Page
     * @throws HTTP_Exception_404
     */
    public function action_clinical()
    {
        $id = $this->request->param('id');

        $raiscales = Model_ReportRAIScales::getByPensionAndID($this->pension->id, $id);
        $protocols = Model_ReportProtocols::getByPensionAndID($this->pension->id, $id);

        if (! ( $raiscales->pk && $protocols->pk) ) throw new HTTP_Exception_404();

        $this->survey = new Model_Survey($raiscales->pk);
        $this->patient = new Model_Patient($this->survey->patient);
        $this->patient->dt_first_survey = Model_Survey::getFirstByPensionPatient($this->pension->id, $this->patient->pk)->dt_create;

        if (! ($this->survey->pk && $this->patient->pk) ) throw new HTTP_Exception_404();

        $this->template->title = "Клинический отчет #" . $this->survey->id;
        $this->template->section = View::factory('reports/patient/clinical')
            ->set('pension', $this->pension)
            ->set('patient', $this->patient)
            ->set('survey', $this->survey)
            ->set('protocols', $protocols)
            ->set('raiscales', $raiscales);
    }


    /**
     * Patient Status Report On Pension Page
     * @throws HTTP_Exception_404
     */
    public function action_status()
    {
        $id = $this->request->param('id');

        $this->survey = Model_Survey::getByPensionAndID($this->pension->id, $id);

        if (! $this->survey->pk ) throw new HTTP_Exception_404();

        $this->patient = new Model_Patient($this->survey->patient);

        if (! $this->patient->pk ) throw new HTTP_Exception_404();

        $this->patient->dt_first_survey = Model_Survey::getFirstByPensionPatient($this->pension->id, $this->patient->pk)->dt_create;

        $this->survey->unitD = new Model_SurveyUnitD($this->survey->unitD);
        $this->survey->unitD->D3 = json_decode($this->survey->unitD->D3);
        $this->survey->unitD->D4 = json_decode($this->survey->unitD->D4);

        $this->survey->unitG = new Model_SurveyUnitG($this->survey->unitG);
        $this->survey->unitG->G1 = json_decode($this->survey->unitG->G1);



        $this->template->title = "Текущее состояние пациента #" . $this->patient->id;
        $this->template->section = View::factory('reports/patient/status')
            ->set('pension', $this->pension)
            ->set('patient', $this->patient)
            ->set('survey', $this->survey);
    }




    /**
     * Get All Units Data
     */
    private function getUnitsData()
    {
        $this->survey->unitA = new Model_SurveyUnitA($this->survey->unitA);
        $this->survey->unitB = new Model_SurveyUnitB($this->survey->unitB);
        $this->survey->unitC = new Model_SurveyUnitC($this->survey->unitC);
        $this->survey->unitD = new Model_SurveyUnitD($this->survey->unitD);
        $this->survey->unitE = new Model_SurveyUnitE($this->survey->unitE);
        $this->survey->unitF = new Model_SurveyUnitF($this->survey->unitF);
        $this->survey->unitG = new Model_SurveyUnitG($this->survey->unitG);
        $this->survey->unitH = new Model_SurveyUnitH($this->survey->unitH);
        $this->survey->unitI = new Model_SurveyUnitI($this->survey->unitI);
        $this->survey->unitJ = new Model_SurveyUnitJ($this->survey->unitJ);
        $this->survey->unitK = new Model_SurveyUnitK($this->survey->unitK);
        $this->survey->unitL = new Model_SurveyUnitL($this->survey->unitL);
        $this->survey->unitM = new Model_SurveyUnitM($this->survey->unitM);
        $this->survey->unitN = new Model_SurveyUnitN($this->survey->unitN);
        $this->survey->unitO = new Model_SurveyUnitO($this->survey->unitO);
        $this->survey->unitP = new Model_SurveyUnitP($this->survey->unitP);
        $this->survey->unitQ = new Model_SurveyUnitQ($this->survey->unitQ);
        $this->survey->unitR = new Model_SurveyUnitR($this->survey->unitR);
    }

}