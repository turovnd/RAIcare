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
     */
    public function action_fullreport()
    {
        self::hasAccess(self::WATCH_ALL_SURVEYS);

        $pk = $this->request->param('pk');

        $this->getSurveyData('pk', $pk);
        $this->getUnitsData();

        $this->template->title = "Полный отчет формы оценки #" . $this->survey->pk;
        $this->template->section = View::factory('reports/pages/full-report')
            ->set('survey', $this->survey);
    }

    /**
     * Patient Full Survey Report On Pension Page (based on questions)
     */
    public function action_pen_fullreport()
    {
        self::hasAccess(self::WATCH_PEN_SURVEY);
        $this->checkUsersPensionAccess();

        $id = $this->request->param('sur_id');

        $this->getSurveyData('id', $id);
        $this->getUnitsData();

        $this->template->title = "Полный отчет формы оценки #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/full-report')
            ->set('survey', $this->survey);
    }


    /**
     * Patient Protocols Report
     */
    public function action_protocolsreport()
    {
        self::hasAccess(self::WATCH_ALL_REPORTS);

        $pk = $this->request->param('pk');

        $this->getSurveyData('pk', $pk);

        $this->report = new Model_ReportProtocols($pk);

        if (!$this->report->pk) {
            $this->getUnitsData();
            $this->createProtocolsReport();
        }

        $this->template->title = "Итоговый протокол оценки #" . $this->survey->pk;
        $this->template->section = View::factory('reports/pages/protocols-report')
            ->set('survey', $this->survey)
            ->set('report', $this->report);
    }

    /**
     * Patient Protocols Report On Pension Page
     */
    public function action_pen_protocolsreport()
    {
        self::hasAccess(self::WATCH_PEN_REPORT);
        $this->checkUsersPensionAccess();

        $pension = $this->request->param('pen_id');
        $id = $this->request->param('sur_id');

        $this->getSurveyData('id', $id);

        $this->report = Model_ReportProtocols::getByPension($id, $pension);

        if (!$this->report->pk) {
            $this->getUnitsData();
            $this->createProtocolsReport();
        }

        $this->template->title = "Итоговый протокол оценки #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/protocols-report')
            ->set('survey', $this->survey)
            ->set('report', $this->report);
    }



    /**
     * Create Protocols Report
     */
    private function createProtocolsReport()
    {
        $E1 = json_encode($this->survey->unitE->E1);
        $F2 = json_encode($this->survey->unitF->F2);
        $I1 = json_decode($this->survey->unitI->I1);
        $J3 = json_decode($this->survey->unitJ->J3);
        $J6 = json_decode($this->survey->unitJ->J6);
        $J9 = json_decode($this->survey->unitJ->J9);
        $K2 = json_decode($this->survey->unitK->K2);
        $O2 = json_encode($this->survey->unitO->O2);
        $O7 = json_encode($this->survey->unitO->O7);

        $this->report = new Model_ReportProtocols();

        $this->report->pk = $this->survey->pk;
        $this->report->id = $this->survey->id;
        $this->report->pension = $this->survey->pension->id;

        // Behaviour - проблемное поведение
        $P1 = 0;
        foreach (json_decode($this->survey->unitE->E3) as $item) { if ($item == 3) { $P1 = 2; } elseif ($item == 2 && $P1 < 2) { $P1 = 1; } }
        $this->report->P1 = $P1;

        // Communication - Коммуникация
        $P2 = ($this->survey->unitC->C1 >= 3 && $this->survey->unitD->D1 < 3 && $this->survey->unitD->D2 < 3) ? 2 :
                (($this->survey->unitC->C1 < 3 && $this->survey->unitD->D1 >=2 && $this->survey->unitD->D2 >= 2) ? 1 : 0);
        $this->report->P2 = $P2;

        // Delirium - деменция
        $P3 = $this->survey->unitC->C4 == 1 ? 1 : 0;
        if ($P3 == 0) { foreach (json_decode($this->survey->unitC->C3) as $item) { if ($item == 2) { $P3 = 1; break; } } }
        $this->report->P3 = $P3;

        // Mood - Настроение
        $P4 = $this->getDRS();
        $this->report->P4 = $P4 >= 3 ? 2 : ($P4 == 1 || $P4 == 2) ? 1 : 0;

        // Cardio-respiratory - Сердечно-дыхательная недостаточность
        $P5 = ($J3[2] >= 2 || $J3[4] >= 2 || $this->survey->unitJ->J4 >= 2 || $I1[10] >= 2 || $I1[11] >= 2 || $I1[12] >= 2) ? 1 : 0;
        $this->report->P5 = $P5;

        // Dehydration - Дегидратация
        $P6 = $K2[1] == 1 ? (($K2[0] == 1 || $J3[2] >= 2 || $J3[8] >= 2 || $J3[12] >= 2 || $J3[13] >= 2 || $J3[17] >= 2) ? 2 : 1) : 0;
        $this->report->P6 = $P6;

        // Falls - Падения
        $P7 = $this->survey->unitJ->J1 == 3 ? 2 : $this->survey->unitJ->J1 == 0 ? 0 : 1;
        $this->report->P7 = $P7;

        // Feeding Tube - Питательная трубка
        $P8 = ($this->survey->unitK->K3 < 5 || $this->survey->unitK->K3 == 9) ? 0 : (($this->survey->unitC->C1 >= 0 && $this->survey->unitC->C1 <=3) ? 2 : 1);
        $this->report->P8 = $P8;

        // Nutrition - Питание
        $P9 = $this->getBMI() < 19 ? 2 : $this->getBMI() > 21 ? 0 : 1;
        $this->report->P9 = $P9;

        // Pain - Повреждения
        $P10 = ($J6[1] == 3 || $J6[1] == 4) ? 2 : (($J6[1] == 1 || $J6[1] == 2) && $J6[0] == 3) ? 1 : 0;
        $this->report->P10 = $P10;

        // Smoking and Drinking
        $P11 = ($J9[0] >= 1 || $J9[1] == 3) ? 1 : 0;
        $this->report->P11 = $P11;

        // Pressure Ulcer - Тяжелые пролежни
        $P12 = $this->survey->unitL->L1 >= 2 ? 1 : $this->survey->unitL->L1 == 1 ? 2 : (($this->getADL() == 5 || $this->getADL() == 6) && ($this->survey->unitL->L2 == 1 || $this->survey->unitL->L3 == 1 || $this->survey->unitL->L4 == 1 || $this->survey->unitL->L5 == 1 || $this->survey->unitL->L6 == 1)) ? 3 : 0;
        $this->report->P12 = $P12;

        // Urinary Incontinence - Недержание мочи
        $P13 = ($this->getCPS() >= 5) ? 0 :
            (($this->survey->unitH->H1 >= 2 && $this->getCPS() <= 3 && ($this->survey->unitO->O2[8] == 0 || $this->survey->unitI->I1[0] >= 1 || $this->survey->unitG->G5 == 2 || $this->survey->unitH->H2 == 2 || $this->survey->unitI->I1[17] >= 1 || $this->survey->unitJ->J3[12] >= 1)) ? 2 :
            (($this->survey->unitH->H1 >= 2 && $this->survey->unitC->C1 < 2 && $this->getADL() < 6 && $this->survey->unitG->G1[5] < 4 && ($this->survey->unitO->O2[8] == 0 || $this->survey->unitI->I1[0] >= 1 || $this->survey->unitG->G5 == 2 || $this->survey->unitH->H2 == 2 || $this->survey->unitI->I1[17] >= 1 || $this->survey->unitJ->J3[12] >= 1)) ? 3 : 1));
        $this->report->P13 = $P13;

        // Physical restraint - Физическая сдержанность
        $P14 = (($O7[0] > 0 || $O7[1] > 0 || $O7[2] > 0) && $this->getADL() <= 2) ? 2 :
            (($O7[0] > 0 || $O7[1] > 0 || $O7[2] > 0) && ($this->getADL() <= 4 && $this->getADL() > 2)) ? 1 : 0;
        $this->report->P14 = $P14;

        // Activities - Активность
        $P15count = 0;
        if ($E1[8] > 0) $P15count++;
        if ($E1[9] > 0 ) $P15count++;
        if ($F2[0] == 0 ) $P15count++;
        if ($F2[1] == 0) $P15count++;

        $P15 = ($this->survey->unitM->M1 < 3 && $this->survey->unitC->C1 <= 3 && $P15count >= 2) ? 1 : 0;
        $this->report->P15 = $P15;

        //$this->report->save();
    }




    private function getSurveyData($mod, $id)
    {
        if ($mod == 'pk') $this->survey = new Model_Survey($id);
        elseif ($mod == 'id') $this->survey = Model_Survey::getByFieldName('id', $id);
        else throw new HTTP_Exception_404();

        if (!$this->survey->pk) throw new HTTP_Exception_404();

        $first_survey = Model_Survey::getFirstSurvey($this->survey->pension, $this->survey->patient);
        $this->survey->dt_first_survey = !empty($first_survey->pk) ? $first_survey->dt_create : $this->survey->dt_create;

        $this->survey->patient = new Model_Patient($this->survey->patient);
        $this->survey->creator = new Model_User($this->survey->creator);
        $this->survey->pension = new Model_Pension($this->survey->pension);
        $this->survey->patient->can_edit = false;
        $this->survey->patient->full_info = true;
    }

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

    // Depression Rating Scale, DRS 
    private function getDRS()
    {
        $drs = 0;
        $E1 = json_decode($this->survey->unitE->E1);
        $drs += $E1[0] == 0 ? 0 : ($E1[0] == 1 || $E1[0] == 2) ? 1 : 2;
        $drs += $E1[1] == 0 ? 0 : ($E1[1] == 1 || $E1[1] == 2) ? 1 : 2;
        $drs += $E1[2] == 0 ? 0 : ($E1[2] == 1 || $E1[2] == 2) ? 1 : 2;
        $drs += $E1[3] == 0 ? 0 : ($E1[3] == 1 || $E1[3] == 2) ? 1 : 2;
        $drs += $E1[4] == 0 ? 0 : ($E1[4] == 1 || $E1[4] == 2) ? 1 : 2;
        $drs += $E1[5] == 0 ? 0 : ($E1[5] == 1 || $E1[5] == 2) ? 1 : 2;
        $drs += $E1[6] == 0 ? 0 : ($E1[6] == 1 || $E1[6] == 2) ? 1 : 2;
        return $drs;
    }

    // Body Mass Index, BMI
    private function getBMI()
    {
        $K1 = json_decode($this->survey->unitK->K1);
        return $K1[1] / ($K1[0] * $K1[0]);
    }

    // Activities of Daily Living (Hierarchy), ADLH
    private function getADL()
    {
        //Personal hygiene  $this->survey->unitG->G1[1] => G1b
        //Toilet use        $this->survey->unitG->G1[7] => G1h
        //Locomotion        $this->survey->unitG->G1[5] => G1f
        //Eating            $this->survey->unitG->G1[9] => G1j

        return  ($this->survey->unitG->G1[1] >= 6 && $this->survey->unitG->G1[5] >= 6 && $this->survey->unitG->G1[7] >= 6 && $this->survey->unitG->G1[9] >= 6) ? 6 :
                ($this->survey->unitG->G1[9] >= 6 || $this->survey->unitG->G1[5] >= 6) ? 5 :
                (($this->survey->unitG->G1[9] < 6 && $this->survey->unitG->G1[5] < 6) && ($this->survey->unitG->G1[9] == 4 || $this->survey->unitG->G1[5] == 4)) ? 4 :
                (($this->survey->unitG->G1[1] == 4 || $this->survey->unitG->G1[7] == 4) && ($this->survey->unitG->G1[9] < 4 && $this->survey->unitG->G1[5] < 4)) ? 3 :
                (($this->survey->unitG->G1[1] < 4 && $this->survey->unitG->G1[7] < 4 && $this->survey->unitG->G1[9] < 4 && $this->survey->unitG->G1[5] < 4) && ($this->survey->unitG->G1[1] == 3 || $this->survey->unitG->G1[7] == 3 || $this->survey->unitG->G1[9] == 3 || $this->survey->unitG->G1[5] == 3)) ? 2 :
                (($this->survey->unitG->G1[1] < 3 && $this->survey->unitG->G1[7] < 3 && $this->survey->unitG->G1[9] < 3 && $this->survey->unitG->G1[5] < 3) && ($this->survey->unitG->G1[1] == 2 || $this->survey->unitG->G1[7] == 2 || $this->survey->unitG->G1[9] == 2 || $this->survey->unitG->G1[5] == 2)) ? 1 : 0;
    }

    // Cognitive Performance Scale
    private function getCPS()
    {
        switch ($this->survey->unitC->C1) {
            case 5:
                return 6;
                break;
            case 4:
                $G1j = json_decode($this->survey->unitG->G1)[9];
                if ($G1j == 6 || $G1j == 8) return 6;
                else return 5;
                break;
            default:
                // Impairment Count
                $imp_count = 0;
                if ($this->survey->unitC->C1 > 0) $imp_count++;
                if (json_decode($this->survey->unitC->C2)[0] == 1) $imp_count++;
                if ($this->survey->unitD->D1 > 0 || $this->survey->unitD->D2 > 0) $imp_count++;
                switch ($imp_count) {
                    case 0: return 0; break;
                    case 1: return 1; break;
                    default:
                        // Severe Impairment Count
                        $sev_imp_count = 0;
                        if ($this->survey->unitC->C1 == 3) $sev_imp_count++;
                        if ($this->survey->unitD->D1 >= 3 || $this->survey->unitD->D2 >= 3) $sev_imp_count++;
                        switch ($sev_imp_count) {
                            case 0: return 2; break;
                            case 1: return 3; break;
                            case 2: return 4; break;
                        }
                        break;
                }
                break;
        }
    }

    // Communication Scale, COMM
    private function getCOMM()
    {
        return $this->survey->unitD->D1 + $this->survey->unitD->D2;
    }

}