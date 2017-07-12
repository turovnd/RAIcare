<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Reports_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Reports_Index extends Dispatch
{
    CONST WATCH_ALL_SURVEYS = 37;
    CONST WATCH_PEN_SURVEY  = 39;
    CONST WATCH_ALL_REPORTS = 38;
    CONST WATCH_PEN_REPORT  = 40;

    public $template = 'main';

    protected $report = null;
    protected $survey = null;

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

    /**
     * Patient Full Survey Report (based on questions)
     * @throws HTTP_Exception_404
     */
    public function action_fullreport()
    {
        self::hasAccess(self::WATCH_ALL_SURVEYS);

        $pk = $this->request->param('pk');
        $this->survey = new Model_Survey($pk);

        if (!$this->survey->pk) throw new HTTP_Exception_404();

        $this->getFullReportData();

        $this->template->title = "Полный отчет формы оценки #" . $this->survey->pk;
        $this->template->section = View::factory('reports/pages/full-report')
            ->set('survey', $this->survey);
    }

    /**
     * Patient Full Survey Report On Pension Page (based on questions)
     * @throws HTTP_Exception_404
     */
    public function action_pen_fullreport()
    {
        self::hasAccess(self::WATCH_PEN_SURVEY);
        $this->checkUsersPensionAccess();

        $id = $this->request->param('sur_id');
        $this->survey = Model_Survey::getByFieldName('id', $id);

        if (!$this->survey->pk) throw new HTTP_Exception_404();

        $this->getFullReportData();

        $this->template->title = "Полный отчет формы оценки #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/full-report')
            ->set('survey', $this->survey);
    }

    private function getFullReportData()
    {
        $first_survey = Model_Survey::getFirstSurvey($this->survey->pension, $this->survey->patient);
        $this->survey->dt_first_survey = !empty($first_survey->pk) ? $first_survey->dt_create : $this->survey->dt_create;

        $this->survey->patient = new Model_Patient($this->survey->patient);
        $this->survey->creator = new Model_User($this->survey->creator);
        $this->survey->pension = new Model_Pension($this->survey->pension);
        $this->survey->patient->can_edit = false;
        $this->survey->patient->full_info = true;

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

    private function checkUsersPensionAccess()
    {
        $pension = $this->request->param('pen_id');
        $pension = new Model_Pension($pension);

        if (!$pension->id) throw new HTTP_Exception_404();

        $usersIDs = Model_UserPension::getUsers($pension->id);

        if (!(in_array($this->user->id, $usersIDs))) {
            if ( $this->user->role != 1 ) {
                throw new HTTP_Exception_403();
            }
        }
    }

}