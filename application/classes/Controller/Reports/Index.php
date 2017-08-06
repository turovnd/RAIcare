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
     * Patient Full Survey Report (based on questions)
     */
//    public function action_fullreport()
//    {
//        $pk = $this->request->param('pk');
//
//        $this->getSurveyData('pk', $pk);
//        $this->getUnitsData();
//
//        $this->template->title = "Детальный отчет #" . $this->survey->pk;
//        $this->template->section = View::factory('reports/pages/full-report')
//            ->set('survey', $this->survey);
//    }

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
     * Patient Protocols Report
     */
//    public function action_protocolsreport()
//    {
//
//        $pk = $this->request->param('pk');
//
//        $this->getSurveyData('pk', $pk);
//
//        $this->report = new Model_ReportProtocols($pk);
//
//        if (!$this->report->pk) {
//            $this->getUnitsData();
//            $this->createProtocolsReport();
//        }
//
//        $this->template->title = "Итоговый протокол оценки #" . $this->survey->pk;
//        $this->template->section = View::factory('reports/pages/protocols-report')
//            ->set('survey', $this->survey)
//            ->set('protocols', $this->report);
//    }

    /**
     * Patient Protocols Report On Pension Page
     */
    public function action_pen_protocolsreport()
    {
        $this->report = Model_ReportProtocols::getByPension($this->survey->pk, $this->pension->id);

        if (!$this->report->pk) {
            $this->getUnitsData();
            $this->createProtocolsReport();
        }

        $this->template->title = "Итоговый протокол оценки #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/protocols-report')
            ->set('survey', $this->survey)
            ->set('protocols', $this->report);
    }

    /**
     * Patient RAI Scales Report
     */
//    public function action_raiscalesreport()
//    {
//        $pk = $this->request->param('pk');
//
//        $this->getSurveyData('pk', $pk);
//
//        $this->report = new Model_ReportRAIScales($pk);
//
//        if (!$this->report->pk) {
//            $this->getUnitsData();
//            $this->createRAIScales();
//        }
//
//        $this->template->title = "Отчет по шкалам RAI #" . $this->survey->pk;
//        $this->template->section = View::factory('reports/pages/rai-scales-report')
//            ->set('survey', $this->survey)
//            ->set('report', $this->report);
//    }

    /**
     * Patient RAI Scales Report On Pension Page
     */
    public function action_pen_raiscalesreport()
    {
        $this->report = Model_ReportRAIScales::getByPension($this->survey->pk, $this->pension->id);

        if (!$this->report->pk) {
            $this->getUnitsData();
            $this->createRAIScales();
        }

        $this->template->title = "Отчет по шкалам RAI #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/rai-scales-report')
            ->set('survey', $this->survey)
            ->set('report', $this->report);
    }

    /**
     * Patient Personal Report
     */
//    public function action_personalreport()
//    {
//        $pk = $this->request->param('pk');
//
//        $this->getSurveyData('pk', $pk);
//
//        $this->report = new Model_ReportRAIScales($pk);
//
//        if (!$this->report->pk) {
//            $this->getUnitsData();
//            $this->createRAIScales();
//        }
//
//        $this->template->title = "Персональный отчет #" . $this->survey->pk;
//        $this->template->section = View::factory('reports/pages/personal-report')
//            ->set('survey', $this->survey)
//            ->set('report', $this->report);
//    }

    /**
     * Patient Personal Report On Pension Page
     */
    public function action_pen_personalreport()
    {
        $this->report = Model_ReportRAIScales::getByPension($this->survey->pk, $this->pension->id);

        $this->getUnitsData();
        if (!$this->report->pk) {
            $this->createRAIScales();
        }

        $this->template->title = "Персональный отчет #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/personal-report')
            ->set('survey', $this->survey)
            ->set('report', $this->report);
    }

    /**
     * Patient Personal Report
     */
//    public function action_clinicalreport()
//    {
//        $pk = $this->request->param('pk');
//
//        $this->getSurveyData('pk', $pk);
//
//        $this->report = new Model_ReportRAIScales($pk);
//
//        if (!$this->report->pk) {
//            $this->getUnitsData();
//            $this->createRAIScales();
//        }
//
//        $raiscales = $this->report;
//
//        $this->report = new Model_ReportProtocols($pk);
//
//        if (!$this->report->pk) {
//            $this->getUnitsData();
//            $this->createProtocolsReport();
//        }
//
//        $protocols = $this->report;
//
//        $this->template->title = "Клинический отчет #" . $this->survey->pk;
//        $this->template->section = View::factory('reports/pages/clinical-report')
//            ->set('survey', $this->survey)
//            ->set('protocols', $protocols)
//            ->set('raiscales', $raiscales);
//    }

    /**
     * Patient Personal Report On Pension Page
     */
    public function action_pen_clinicalreport()
    {
        $this->report = Model_ReportRAIScales::getByPension($this->survey->pk, $this->pension->id);

        $this->getUnitsData();
        if (!$this->report->pk) {
            $this->createRAIScales();
        }

        $raiscales = $this->report;

        $this->report = Model_ReportProtocols::getByPension($this->survey->pk, $this->pension->id);

        if (!$this->report->pk) {
            $this->createProtocolsReport();
        }

        $protocols = $this->report;

        $this->template->title = "Клинический отчет #" . $this->survey->id;
        $this->template->section = View::factory('reports/pages/clinical-report')
            ->set('survey', $this->survey)
            ->set('protocols', $protocols)
            ->set('raiscales', $raiscales);
    }

    /**
     * Create Protocols Report
     */
    private function createProtocolsReport()
    {
        $C3 = json_encode($this->survey->unitC->C3);
        $E1 = json_encode($this->survey->unitE->E1);
        $E3 = json_encode($this->survey->unitE->E3);
        $F2 = json_encode($this->survey->unitF->F2);
        $G1 = json_encode($this->survey->unitG->G1);
        $G3 = json_encode($this->survey->unitG->G3);
        $G4 = json_encode($this->survey->unitG->G4);
        $I1 = json_decode($this->survey->unitI->I1);
        $J3 = json_decode($this->survey->unitJ->J3);
        $J6 = json_decode($this->survey->unitJ->J6);
        $J9 = json_decode($this->survey->unitJ->J9);
        $K2 = json_decode($this->survey->unitK->K2);
        $O1 = json_encode($this->survey->unitO->O1);
        $O7 = json_encode($this->survey->unitO->O7);

        $this->report = new Model_ReportProtocols();

        $this->report->pk = $this->survey->pk;
        $this->report->id = $this->survey->id;
        $this->report->pension = $this->pension->id;

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
        $P12 = $this->survey->unitL->L1 >= 2 ? 1 : $this->survey->unitL->L1 == 1 ? 2 : (($this->getADLH() == 5 || $this->getADLH() == 6) && ($this->survey->unitL->L2 == 1 || $this->survey->unitL->L3 == 1 || $this->survey->unitL->L4 == 1 || $this->survey->unitL->L5 == 1 || $this->survey->unitL->L6 == 1)) ? 3 : 0;
        $this->report->P12 = $P12;

        // Urinary Incontinence - Недержание мочи
        $P13 = ($this->getCPS() >= 5) ? 0 :
            (($this->survey->unitH->H1 >= 2 && $this->getCPS() <= 3 && ($this->survey->unitO->O2[8] == 0 || $this->survey->unitI->I1[0] >= 1 || $this->survey->unitG->G5 == 2 || $this->survey->unitH->H2 == 2 || $this->survey->unitI->I1[17] >= 1 || $this->survey->unitJ->J3[12] >= 1)) ? 2 :
            (($this->survey->unitH->H1 >= 2 && $this->survey->unitC->C1 < 2 && $this->getADLH() < 6 && $this->survey->unitG->G1[5] < 4 && ($this->survey->unitO->O2[8] == 0 || $this->survey->unitI->I1[0] >= 1 || $this->survey->unitG->G5 == 2 || $this->survey->unitH->H2 == 2 || $this->survey->unitI->I1[17] >= 1 || $this->survey->unitJ->J3[12] >= 1)) ? 3 : 1));
        $this->report->P13 = $P13;

        // Physical restraint - Физическая сдержанность
        $P14 = (($O7[0] > 0 || $O7[1] > 0 || $O7[2] > 0) && $this->getADLH() <= 2) ? 2 :
            (($O7[0] > 0 || $O7[1] > 0 || $O7[2] > 0) && ($this->getADLH() <= 4 && $this->getADLH() > 2)) ? 1 : 0;
        $this->report->P14 = $P14;

        // Activities - Активность
        $P15count = 0;
        if ($E1[8] > 0) $P15count++;
        if ($E1[9] > 0 ) $P15count++;
        if ($F2[0] == 0 ) $P15count++;
        if ($F2[1] == 0) $P15count++;

        $P15 = ($this->survey->unitM->M1 < 3 && $this->survey->unitC->C1 <= 3 && $P15count >= 2) ? 1 : 0;
        $this->report->P15 = $P15;

        // Physical Activities Promotion
        // TODO про тот триггер оставь звездочку что там могут быть еще условия потом
        $P16 = $G3[0] <= 2 && ($G1[5] < 3 || $G4[0] == 1 || $G4[1] == 1) ? 1 : 0;
        $this->report->P16 = $P16;

        // Prevention
        $P17check = ($O1[0] == 0 || $O1[1] == 0 || $O1[2] == 0 || $O1[3] == 0 || $O1[4] == 0 || $O1[5] == 0 || $O1[6] == 0 || $O1[7] == 0) ? true : false;
        $P17 = ($this->survey->unitO->O5 < 7 && $P17check) ? 2 : (($this->survey->unitO->O5 > 7 && $P17check) ? 1 : 0);
        $this->report->P17 = $P17;

        // Cognitive Loss
        $P18count = 0;
        if ($I1[2] >= 2) $P18count++;
        if ($I1[3] >= 2) $P18count++;
        if ($this->survey->unitD->D1 == 4) $P18count++;
        if ($this->survey->unitD->D2 == 4) $P18count++;
        if ($E1[3] >= 2) $P18count++;
        if ($E1[4] >= 2) $P18count++;
        if ($E1[7] >= 2) $P18count++;
        if ($E3[0] >= 2) $P18count++;
        if ($E3[2] >= 2) $P18count++;
        if ($C3[0] == 2) $P18count++;
        if ($C3[1] == 2) $P18count++;
        if ($C3[2] == 2) $P18count++;
        if ($this->survey->unitC->C4 == 1) $P18count++;
        if ($this->survey->unitC->C5 == 2) $P18count++;

        $P18 = $this->getCPS() <= 2 ? ($P18count >= 2 ? 2 : ($P18count == 1 ? 1 : 0)) : 0;
        $this->report->P18 = $P18;

        // Appropriate Medications
        // TODO do it in future
        $P19 = 0;
        $this->report->P19 = $P19;

        $this->report->save();
    }

    /**
     * Create RAI Scales Report
     */
    private function createRAIScales()
    {
        $this->report = new Model_ReportRAIScales();

        $this->report->pk = $this->survey->pk;
        $this->report->id = $this->survey->id;
        $this->report->pension = $this->survey->pension->id;

        $this->report->PURS = $this->getPURS();
        $this->report->CPS = $this->getCPS();
        $this->report->BMI = $this->getBMI();
        $this->report->SRD = $this->getSRD();
        $this->report->DRS = $this->getDRS();
        $this->report->Pain = $this->getPain();
        $this->report->COMM = $this->getCOMM();
        $this->report->CHESS = $this->getCHESS();
        $this->report->ADLH = $this->getADLH();
        $this->report->ABS = $this->getABS();
        $this->report->ADLLF = $this->getADLLF();

        $this->report->save();
    }

    // Get All Units Data
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


    // Pressure Ulcer Risk Scale
    private function getPURS()
    {
        $G1 = json_decode($this->survey->unitG->G1);
        $K2 = json_decode($this->survey->unitK->K2);
        $J6 = json_decode($this->survey->unitJ->J6);

        $purs = 0;
        if ( $G1[8] >=4 ) $purs++;
        if ( $G1[4] >=4 ) $purs++;
        if ( $this->survey->unitH->H3 >= 2 ) $purs++;
        // TODO add condition - https://github.com/kolyasha/RAIcare/issues/26
        if ( $K2[0] == 1 ) $purs++;
        if ( $J6[0] == 3 ) $purs++;
        if ( $this->survey->unitJ->J4 >= 2 ) $purs++;

        return $purs;
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

    // Body Mass Index
    private function getBMI()
    {
        $K1 = json_decode($this->survey->unitK->K1);
        return number_format ($K1[1] / ($K1[0] * $K1[0]) * 10000, 2);
    }

    // Self Rated Depression
    private function getSRD()
    {
        $E2 = json_decode($this->survey->unitE->E2);
        return ($E2[0] == 8 ? 0 : $E2[0]) + ($E2[1] == 8 ? 0 : $E2[1]) + ($E2[2] == 8 ? 0 : $E2[2]);
    }

    // Depression Rating Scale
    private function getDRS()
    {
        $E1 = json_decode($this->survey->unitE->E1);
        $drs = 0;
        $drs += $E1[0] == 0 ? 0 : (($E1[0] == 1 || $E1[0] == 2) ? 1 : 2);
        $drs += $E1[1] == 0 ? 0 : (($E1[1] == 1 || $E1[1] == 2) ? 1 : 2);
        $drs += $E1[2] == 0 ? 0 : (($E1[2] == 1 || $E1[2] == 2) ? 1 : 2);
        $drs += $E1[3] == 0 ? 0 : (($E1[3] == 1 || $E1[3] == 2) ? 1 : 2);
        $drs += $E1[4] == 0 ? 0 : (($E1[4] == 1 || $E1[4] == 2) ? 1 : 2);
        $drs += $E1[5] == 0 ? 0 : (($E1[5] == 1 || $E1[5] == 2) ? 1 : 2);
        $drs += $E1[6] == 0 ? 0 : (($E1[6] == 1 || $E1[6] == 2) ? 1 : 2);
        return $drs;
    }

    // Pain Scale
    private function getPain()
    {
        $J6 = json_decode($this->survey->unitJ->J6);
        if ($J6[0] == 0 || $J6[1] == 0) return 0;
        if ($J6[0] < 3) return 1;
        if ($J6[1] < 3) return 2;
        if ($J6[1] == 3) return 3;
        return 4;
    }

    // Communication Scale
    private function getCOMM()
    {
        return $this->survey->unitD->D1 + $this->survey->unitD->D2;
    }

    // Changes in Health, End-Stage Disease, Signs, and Symptoms Scale
    private function getCHESS()
    {
        $J3 = json_decode($this->survey->unitJ->J3);
        $J7 = json_decode($this->survey->unitJ->J7);
        $K2 = json_decode($this->survey->unitK->K2);

        $CHESS = 0;
        $count = 0;

        if ( $this->survey->unitC->C5 == 2 ) $CHESS++;
        if ( $this->survey->unitG->G5 == 2 ) $CHESS++;
        if ( $J7[2] == 1 ) $CHESS++;

        if ($count <= 2 && $K2[1] == 1 && $K2[3] == 1) $count++;
        if ($count <= 2 && $K2[0] == 1) $count++;
        if ($count <= 2 && $K2[2] == 1) $count++;
        // может оказаться что J4>1
        if ($count <= 2 && $this->survey->unitJ->J4 != 0) $count++;
        if ($count <= 2 && $J3[13] == 1) $count++;
        if ($count <= 2 && $J3[20] == 1) $count++;

        return $CHESS + $count;
    }

    // Activities of Daily Living (Hierarchy)
    private function getADLH()
    {
        //Personal hygiene  $this->survey->unitG->G1[1] => G1b
        //Toilet use        $this->survey->unitG->G1[7] => G1h
        //Locomotion        $this->survey->unitG->G1[5] => G1f
        //Eating            $this->survey->unitG->G1[9] => G1j
        $G1 =  json_decode($this->survey->unitG->G1);
        return  ($G1[1] >= 6 && $G1[5] >= 6 && $G1[7] >= 6 && $G1[9] >= 6) ? 6 :
            ($G1[9] >= 6 || $G1[5] >= 6) ? 5 :
            (($G1[9] < 6 && $G1[5] < 6) && ($G1[9] == 4 || $G1[5] == 4)) ? 4 :
            (($G1[1] == 4 || $G1[7] == 4) && ($G1[9] < 4 && $G1[5] < 4)) ? 3 :
            (($G1[1] < 4 && $G1[7] < 4 && $G1[9] < 4 && $G1[5] < 4) && ($G1[1] == 3 || $G1[7] == 3 || $G1[9] == 3 || $G1[5] == 3)) ? 2 :
            (($G1[1] < 3 && $G1[7] < 3 && $G1[9] < 3 && $G1[5] < 3) && ($G1[1] == 2 || $G1[7] == 2 || $G1[9] == 2 || $G1[5] == 2)) ? 1 : 0;
    }

    // Aggressive Behaviour Scale
    private function getABS()
    {
        $E3 =  json_decode($this->survey->unitE->E3);
        return $E3[1] + $E3[2] + $E3[3] + $E3[5];
    }

    // Activities of Daily Living (Long Form)
    private function getADLLF()
    {
        $G1 =  json_decode($this->survey->unitG->G1);
        $ADLLF = 0;
        $ADLLF += ($G1[1] == 0 || $G1[1] == 1) ? 0 : ($G1[1] == 2 ? 1 : ($G1[1] == 3 ? 2 : ($G1[1] == 4 ? 3 : 4)));
        $ADLLF += ($G1[2] == 0 || $G1[2] == 1) ? 0 : ($G1[2] == 2 ? 1 : ($G1[2] == 3 ? 2 : ($G1[2] == 4 ? 3 : 4)));
        $ADLLF += ($G1[3] == 0 || $G1[3] == 1) ? 0 : ($G1[3] == 2 ? 1 : ($G1[3] == 3 ? 2 : ($G1[3] == 4 ? 3 : 4)));
        $ADLLF += ($G1[5] == 0 || $G1[5] == 1) ? 0 : ($G1[5] == 2 ? 1 : ($G1[5] == 3 ? 2 : ($G1[5] == 4 ? 3 : 4)));
        $ADLLF += ($G1[7] == 0 || $G1[7] == 1) ? 0 : ($G1[7] == 2 ? 1 : ($G1[7] == 3 ? 2 : ($G1[7] == 4 ? 3 : 4)));
        $ADLLF += ($G1[8] == 0 || $G1[8] == 1) ? 0 : ($G1[8] == 2 ? 1 : ($G1[8] == 3 ? 2 : ($G1[8] == 4 ? 3 : 4)));
        $ADLLF += ($G1[9] == 0 || $G1[9] == 1) ? 0 : ($G1[9] == 2 ? 1 : ($G1[9] == 3 ? 2 : ($G1[9] == 4 ? 3 : 4)));
        return $ADLLF;
    }

}