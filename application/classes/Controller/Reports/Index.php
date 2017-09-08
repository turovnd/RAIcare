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

        $survey = $this->request->param('id');
        $this->survey = Model_Survey::getByFieldName('id', $survey);

        if (!$this->survey->pk || $this->survey->pension != $this->pension->id || $this->survey->status != 2) {
            throw new HTTP_Exception_404();
        }

        $this->pension->users = Model_UserPension::getUsers($this->pension->id);

        if (! ( in_array($this->user->role,self::PEN_AVAILABLE_ROLES) ||
            $this->user->role == self::ROLE_PEN_CREATOR ||
            in_array($this->user->id, $this->pension->users) || $this->user->role == 1) ) {

            throw new HTTP_Exception_403();

        }

        $first_survey = Model_Survey::getFirstSurvey($this->survey->pension, $this->survey->patient);
        $this->survey->dt_first_survey = !empty($first_survey->pk) ? $first_survey->dt_create : $this->survey->dt_create;

        $this->survey->patient = new Model_Patient($this->survey->patient);
        $this->survey->creator = new Model_User($this->survey->creator);
        $this->survey->pension = new Model_Pension($this->survey->pension);

        $data = array(
            'aside_type' => 'report',
            'pension'    => $this->pension,
            'action'     => $this->request->action()
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);
    }

    /**
     * Patient Full Survey Report On Pension Page (based on questions)
     */
    public function action_pen_fullreport()
    {
        $this->getUnitsData();

        $this->survey->patient->can_edit = false;
        $this->survey->patient->full_info = true;
        $this->survey->patient->creator = new Model_User($this->survey->patient->creator);

        $this->template->title = "Детальный отчет #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/full-report')
            ->set('survey', $this->survey);
    }


    /**
     * Patient Protocols Report On Pension Page
     * @throws HTTP_Exception_404
     */
    public function action_pen_protocolsreport()
    {
        $this->report = new Model_ReportProtocols($this->survey->pk);

        if (!$this->report->pk) throw new HTTP_Exception_404();

        $this->template->title = "Итоговый протокол оценки #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/protocols-report')
            ->set('survey', $this->survey)
            ->set('protocols', $this->report);
    }


    /**
     * Patient RAI Scales Report On Pension Page
     * @throws HTTP_Exception_404
     */
    public function action_pen_raiscalesreport()
    {
        $this->report = new Model_ReportRAIScales($this->survey->pk);

        if (!$this->report->pk) throw new HTTP_Exception_404();

        $this->template->title = "Отчет по шкалам RAI #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/rai-scales-report')
            ->set('survey', $this->survey)
            ->set('report', $this->report);
    }


    /**
     * Patient Personal Report On Pension Page
     */
    public function action_pen_personalreport()
    {
        $this->report = new Model_ReportRAIScales($this->survey->pk);

        if (!$this->report->pk) throw new HTTP_Exception_404();

        $this->getUnitsData();

        $this->template->title = "Персональный отчет #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/personal-report')
            ->set('survey', $this->survey)
            ->set('report', $this->report);
    }


    /**
     * Patient Personal Report On Pension Page
     */
    public function action_pen_clinicalreport()
    {
        $raiscales = new Model_ReportRAIScales($this->survey->pk);

        if (!$raiscales->pk) throw new HTTP_Exception_404();

        $protocols = new Model_ReportProtocols($this->survey->pk);

        if (!$protocols->pk) throw new HTTP_Exception_404();

        $this->getUnitsData();

        $this->template->title = "Клинический отчет #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/clinical-report')
            ->set('survey', $this->survey)
            ->set('protocols', $protocols)
            ->set('raiscales', $raiscales);
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