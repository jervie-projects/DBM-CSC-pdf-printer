<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use TCPDF;

class PdfController extends Controller {

    public function generate() {
        if (ob_get_length()) ob_end_clean();
        $data = json_decode($this->request->getBody());

        // Set paper to Long Bond (215.9mm x 330.2mm) 
        $pdf = new TCPDF('P', 'mm', array(215.9, 330.2), true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 8);

        $chk = function($v) { $symbol = (isset($v) && ($v === true || $v === 'true')) ? '☑' : '☐';
        return '<span style="font-family:dejavusans;">'.$symbol.'</span>';};


            $html = '<table border="0" cellpadding="4" cellspacing="0" width="100%">

            <!-- HEADER -->
            <!-- 1st -->
            <tr>
                <td colspan="6" align="center" style="font-family: Times;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;">
                    <span style="font-size: 9px; font-weight: bold;">Republic of the Philippines</span><br>
                    <span style="font-size: 10px; font-weight: bold;">POSITION DESCRIPTION FORM</span><br>
                    <span style="font-size: 9px; font-weight: bold;">DBM-CSC Form No. 1</span><br>
                    <span style="font-size: 6px; font-weight: bold;">(Revised Version No. 1, s. 2017)</span>
                </td>
                <td colspan="6" style="font-weight: bold; background-color:#d9d9d9; border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;">
                    1. POSITION TITLE (as approved by authorized agency) with parenthetical title
                </td>
            </tr>
              <!-- 2nd -->
            <tr>
                <td colspan="6" style="border-left:1px solid #000; border-right:1px solid #000;">&nbsp;</td>
                <td colspan="6" style="font-weight: bold; border-right:1px solid #000; border-bottom:1px solid #000;"border-right:1px solid #000;>
                    '.($data->positionTitle ?? '').'
                </td>
            </tr>

            <!-- 3rd -->
            <tr>
                <td colspan="6" style="border-left:1px solid #000;border-bottom:1px solid #000;">&nbsp;</td>
                <td colspan="6" style="font-weight: bold; background-color:#d9d9d9; border-left:1px solid #000;border-right:1px solid #000; border-bottom:1px solid #000;"> 3. SALARY GRADE</td>
            </tr>

              <!--4th -->
            <tr>
               <td colspan="6" style="border-left:1px solid #000; border-right:1px solid #000;height: 30px;">&nbsp;</td>
                <td colspan="6" style="font-weight: bold; border-right:1px solid #000; border-bottom:1px solid #000; border-right:1px solid #000;border-bottom:1px solid #000; text-align: center">
                    '.($data->salaryGrade ?? '').'
                </td>
            </tr>

              <!-- 5th -->
            <tr>
                <td colspan="12" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    4. FOR LOCAL GOVERNMENT POSITION, ENUMERATE GOVERNMENTAL UNIT AND CLASS
                </td>
            </tr>
            
             <!-- 6th -->
            <tr>
            <td colspan="12" style="border:1px solid #000;">
                <table border="0" width="100%" cellpadding="4">
                    <tr>
                        <td width="33%" style="border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;">
                            '.$chk($data->lgProvince ?? false).' Province<br>
                            '.$chk($data->lgCity ?? false).' City<br>
                            '.$chk($data->lgMunicipality ?? false).' Municipality
                        </td>
                        <td width="33%" style="padding:4px;border-bottom:1px solid #000;border-top:1px solid #000;">
                            '.$chk($data->class1 ?? false).' 1st Class<br>
                            '.$chk($data->class2 ?? false).' 2nd Class<br>
                            '.$chk($data->class3 ?? false).' 3rd Class<br>
                            '.$chk($data->class4 ?? false).' 4th Class
                        </td>
                        <td width="34%" style="padding:4px;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;">
                            '.$chk($data->class5 ?? false).' 5th Class<br>
                            '.$chk($data->class6 ?? false).' 6th Class<br>
                            '.$chk($data->classSpecial ?? false).' Special
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

             <!-- 7th -->
            <tr>
            <td colspan="6" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                5. DEPARTMENT, CORPORATION OR AGENCY/LOCAL GOVERNMENT
            </td>
            <td colspan="6" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                6. BUREAU OR OFFICE
            </td>
        </tr>

        <tr>
            <!-- VALUES -->
            <td colspan="6" style="border:1px solid #000;height: 30px;">
                '.strtoupper($data->department ?? '').'
            </td>
            <td colspan="6" style="border:1px solid #000;">
                '.($data->bureau ?? '').'
            </td>
        </tr>

             <!-- 8th -->
             <tr>
                <!-- LABELS -->
                <td colspan="6" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    7. DEPARTMENT / BRANCH / DIVISION
                </td>
                <td colspan="6" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    8. WORKSTATION / PLACE OF WORK
                </td>
            </tr>

            <tr>
                <!-- VALUES -->
                <td colspan="6" style="border:1px solid #000;height: 30px;">
                    '.($data->branch ?? '').'
                </td>
                <td colspan="6" style="border:1px solid #000;">
                    '.($data->workstation ?? '').'
                </td>
            </tr>
         

             <!-- 9th -->

             <tr>
                <td colspan="3" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    9. PRESENT APPROP ACT
                </td>
                <td colspan="3" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    10. PREVIOUS APPROP ACT
                </td>
                <td colspan="3" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    11. SALARY AUTHORIZED
                </td>
                <td colspan="3" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    12. OTHER COMPENSATION
                </td>
            </tr>

            <!-- 9–12 VALUES -->
            <tr>
                <td colspan="3" style="border-left:1px solid #000;height: 30px;">
                    '.($data->presentAppropriation ?? '').'
                </td>
                <td colspan="3" style="border-right:1px solid #000;">
                   '.($data->previousAppropriation ?? '').'
                </td>
                <td colspan="3">
                   '.($data->previousAppropriation ?? '').'
                </td>
                <td colspan="3" style="border-right:1px solid #000;">
                   '.($data->otherCompensation ?? '').'
                </td>
            </tr>
        
             <!-- 10th -->
             <tr>
                <!-- LABELS -->
                <td colspan="6" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    13. POSITION TITLE OF IMMEDIATE SUPERVISOR
                </td>
                <td colspan="6" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    14. POSITION TITLE OF NEXT HIGHER SUPERVISOR
                </td>
            </tr>

            <tr>
                <!-- VALUES -->
                <td colspan="6" style="border:1px solid #000;height: 30px;">
                   '.($data->immediateSupervisor ?? '').'
                </td>
                <td colspan="6" style="border:1px solid #000;">
                   '.($data->nextSupervisor ?? '').'
                </td>
            </tr>

             <!-- 11th -->
            <tr>
                <td colspan="12" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    15. POSITION TITLE, AND ITEM OF THOSE DIRECTLY SUPERVISED
                </td>
            </tr>

            <!-- 15 NOTE / SUBTEXT -->
            <tr>
                <td colspan="12" style="font-size:8px; border:1px solid #000; text-align:center;">
                    (if more than seven (7) list only by their item numbers and titles)
                </td>
            </tr>

             <!-- 12th -->
            <tr align="center" style="font-weight:bold;">
                <td colspan="6" style="border:1px solid #000;">POSITION TITLE</td>
                <td colspan="6" style="border:1px solid #000;">ITEM NUMBER</td>
            </tr>';

            // --- Supervised Positions ---
            for ($i=0; $i<7; $i++) {
                $t = $data->supervisedList[$i]->title ?? '';
                $n = $data->supervisedList[$i]->itemNumber ?? '';
                $html .= '<tr>
                    <td colspan="6" style="border-left:1px solid #000;border-right:1px solid #000;  text-align:center;">'.$t.'</td>
                    <td colspan="6" style="border-right:1px solid #000;  text-align:center;">'.$n.'</td>
                </tr>';
            }

            $html .= '

            <!-- 13th -->
            <tr>
                <!-- 16 LABEL + VALUE WITH MINIMUM HEIGHT -->
                <td colspan="12" style="font-weight:bold;border:1px solid #000; vertical-align:top; min-height:80px; padding:4px; background-color:#d9d9d9">
                    16. MACHINE, EQUIPMENT, TOOLS, ETC., USED REGULARLY
                </td>
            </tr>
            <tr>
            <td colspan="12" style="height: 50px;border:1px solid #000; vertical-align:top; min-height:80px; padding:4px;">
               '.nl2br(htmlspecialchars($data->equipment ?? '')).'
            </td>
        </tr>


            <!-- 14th -->
            <tr>
                <td colspan="12" style="font-weight:bold; background-color:#d9d9d9; border:1px solid #000;">
                    17. CONTACTS / CLIENTS / STAKEHOLDERS
                </td>
            </tr>

            <!-- 15th -->

            <!-- 17a/17b LABELS -->
            <tr style=" background-color:#d9d9d9;">
                <td colspan="2" style="border:1px solid #000;">
                    <b>17a. Internal</b>
                </td>
                <td colspan="2" style="border:1px solid #000;">
                    <b> Occasional</b>
                </td>
                <td colspan="2" style="border:1px solid #000;">
                    <b>Frequent</b>
                </td>
                <td colspan="2" style="border:1px solid #000;">
                    <b>17b. External</b>
                </td>
                <td colspan="2" style="border:1px solid #000;">
                    <b> Occasional</b>
                </td>
                <td colspan="2" style="border:1px solid #000;">
                    <b>Frequent</b>
                    
                </td>
            </tr>

            <!-- 17a/17b VALUES -->
            <tr>
                <td colspan="2"style=" border-left:1px solid #000; padding:4px;">Executive/Managerial</td>
                <td colspan="2"style=""></td>
                <td colspan="2"style=""></td>
                <td colspan="2"style=" padding:4px;">General Public</td>
                <td colspan="2"style=" text-align:center;">'.$chk($data->contactsB->occasional->generalPublic ?? false).'</td>
                <td colspan="2"style=" text-align:center;border-right:1px solid #000;">'.$chk($data->contactsB->frequent->generalPublic ?? false).'</td>
            </tr>

            <tr>
                <td colspan="2" style="  border-left:1px solid #000;padding:4px;">Supervisor</td>
                <td colspan="2" style="text-align:center;"> '.$chk($data->contactsA->occasional->managerial ?? false).'</td>
                <td colspan="2" style=" text-align:center;"> '.$chk($data->contactsA->frequent->managerial ?? false).'</td>
                <td colspan="2" style=" padding:4px;">Other Agencies</td>
                <td colspan="2" style=" text-align:center;">'.$chk($data->contactsB->occasional->otherAgencies ?? false).'</td>
                <td colspan="2" style=" text-align:center;border-right:1px solid #000;">'.$chk($data->contactsB->frequent->otherAgencies ?? false).'</td>
            </tr>

            <tr>
                <td colspan="2" style=" border-left:1px solid #000; padding:4px;">Non-Supervisor</td>
                <td colspan="2" style="text-align:center;"> '.$chk($data->contactsA->occasional->nonSupervisory ?? false).'</td>
                <td colspan="2" style="text-align:center;"> '.$chk($data->contactsA->frequent->nonSupervisory ?? false).'</td>
                <td colspan="2" style=" padding:4px;">Others</td>
                <td colspan="2" style="text-align:center;">'.$chk($data->contactsB->occasional->others ?? false).'</td>
                <td colspan="2" style="text-align:center; border-right:1px solid #000;">'.$chk($data->contactsB->frequent->others ?? false).'</td>
            </tr>

            <tr>
                <td colspan="2"style=" border-left:1px solid #000;">Staff</td>
                <td colspan="2"style=" text-align:center;"> '.$chk($data->contactsA->occasional->staff ?? false).'</td>
                <td colspan="2"style=" text-align:center;"> '.$chk($data->contactsA->frequent->staff ?? false).'</td>
                <td colspan="6" style="text-align:center; padding:4px;border-right:1px solid #000;">'.
                        (!empty($data->contactsB->occasional->othersSpecify) ? '<u>'.$data->contactsB->occasional->othersSpecify.'</u><br>' : '').
                        (!empty($data->contactsB->frequent->othersSpecify) ? '<u>'.$data->contactsB->frequent->othersSpecify.'</u>' : '&nbsp;').
                    '</td>
            </tr>

            <!-- 18 LABEL ROW -->
            <tr>
                <td colspan="12" style="border:1px solid #000; font-weight:bold; background-color:#d9d9d9; padding:4px;">
                    18. WORKING CONDITION
                </td>
            </tr>

            <!-- 18 VALUE ROW -->
            <tr>
                <td colspan="6" style=" border-left:1px solid #000;padding:4px;">
                    Office Work '.$chk($data->workingCondition->officeWork ?? false).'
                </td>
                <td colspan="3" style="padding:4px; ">
                    '.$chk($data->workingCondition->others ?? false).' Others (Please Specify)
                </td>
                <td colspan="3" style="border-right:1px solid #000;padding:4px; ">
                    <u>'.($data->workingCondition->othersSpecify ?? false).'</u>
                </td>

            </tr>
            <tr>
             <td colspan="12" style="border-left:1px solid #000; border-right:1px solid #000;padding:4px;">
                    Field Work '.$chk($data->workingCondition->fieldWork ?? false).' 
                </td>
            </tr>

           <tr>
                <td colspan="12" style="background-color:#d9d9d9; border:1px solid #000; font-weight:bold; padding:4px;">
                    19. BRIEF DESCRIPTION OF THE GENERAL FUNCTION OF THE UNIT OR SECTION
                </td>
            </tr>
            <!-- 19 VALUE ROW -->

            

            </table>';
        $pdf->writeHTML($html, true, false, true, false, '');

        // --- PAGE 2 ---
        $pdf->AddPage();

        $html2 = '<table border="0" cellpadding="3" cellspacing="0" width="100%">';

            // --- SECTION 20: Job Summary ---
            $html2 .= '
            <tr>
             <td colspan="12" height="40" style="border-top:1px solid #000;border-left:1px solid #000; border-right:1px solid #000;padding:4px;">
                    '.($data->unitFunction ?? false).' 
                </td>
            </tr>
            
            
            <tr bgcolor="#d9d9d9">
                <td colspan="12" style="border-right:1px solid black;border-left:1px solid black;border-top:1px solid black;border-bottom:1px solid black;"><b>20. BRIEF DESCRIPTION OF THE GENERAL FUNCTION OF THE POSITION (Job Summary)</b></td>
            </tr>
            <tr>
                <td colspan="12" height="50px" style="border-right:1px solid black;border-left:1px solid black;border-bottom:1px solid black;">'.($data->jobSummary ?? '').'</td>
            </tr>';

            // --- SECTION 21: Qualification Standards ---
            $html2 .= '
            <tr bgcolor="#d9d9d9">
                <td colspan="12" style="border-right:1px solid black;border-left:1px solid black;border-bottom:1px solid black;"><b>21. QUALIFICATION STANDARDS</b></td>
            </tr>';

            // 21a-d headers
            $html2 .= '
            <tr bgcolor="#d9d9d9" align="center">
                <td colspan="3"style="border-right:1px solid black;border-left:1px solid black;border-bottom:1px solid black;"><b>21a. Education</b></td>
                <td colspan="3" style="border-right:1px solid black;border-bottom:1px solid black;"><b>21b. Experience</b></td>
                <td colspan="3" style="border-right:1px solid black;border-bottom:1px solid black;"><b>21c. Training</b></td>
                <td colspan="3" style="border-right:1px solid black;border-bottom:1px solid black;"><b>21d. Eligibility</b></td>
            </tr>';

            // 21a-d dynamic content
            $education = !empty($data->educationList) ? implode('<br>', $data->educationList) : '';
            $experience = !empty($data->experienceList) ? implode('<br>', $data->experienceList) : '';
            $training = !empty($data->trainingList) ? implode('<br>', $data->trainingList) : '';
            $eligibility = !empty($data->eligibilityList) ? implode('<br>', $data->eligibilityList) : '';

            $html2 .= '
            <tr>
                <td colspan="3" height="80" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;">'.$education.'</td>
                <td colspan="3" height="80" style="border-right:1px solid black;border-bottom:1px solid black;">'.$experience.'</td>
                <td colspan="3" height="80" style="border-right:1px solid black;border-bottom:1px solid black;">'.$training.'</td>
                <td colspan="3" height="80" style="border-right:1px solid black;border-bottom:1px solid black;">'.$eligibility.'</td>
            </tr>';

            // 21e: Core Competencies
            $coreCompetencies = $coreLevels = '';
            if (!empty($data->coreCompetenciesList)) {
                foreach ($data->coreCompetenciesList as $row) {
                    $coreCompetencies .= ($row->competency ?? '') . '<br>';
                    $coreLevels .= ($row->level ?? '') . '<br>';
                }
            }
            
            $html2 .= '
            <tr bgcolor="#d9d9d9">
                <td colspan="9" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;"><b>21e. Core Competencies</b></td>
                <td colspan="3"style="border-right:1px solid black;border-bottom:1px solid black;"><b>Competency Level</b></td>
            </tr>
            <tr>
                <td colspan="9" height="50px" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;">'.$coreCompetencies.'</td>
                <td colspan="3" height="50px" style="border-right:1px solid black;border-bottom:1px solid black;">'.$coreLevels.'</td>
            </tr>';

            // 21f: Leadership Competencies
            $leadershipCompetencies = $leadershipLevels = '';
            if (!empty($data->leadershipCompetenciesList)) {
                foreach ($data->leadershipCompetenciesList as $row) {
                    $leadershipCompetencies .= ($row->competency ?? '') . '<br>';
                    $leadershipLevels .= ($row->level ?? '') . '<br>';
                }
            }
            $html2 .= '
            <tr bgcolor="#d9d9d9">
                <td colspan="9" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;"><b>21f. Leadership Competencies</b></td>
                <td colspan="3" style="border-right:1px solid black;border-bottom:1px solid black;"><b>Competency Level</b></td>
            </tr>
            <tr>
                <td colspan="9" height="50px" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;">'.$leadershipCompetencies.'</td>
                <td colspan="3" height="50px" style="border-right:1px solid black;border-bottom:1px solid black;">'.$leadershipLevels.'</td>
            </tr>';

            // 22: Duties and Responsibilities
            $percentages = $duties = $competencyLevels = '';
            if (!empty($data->dutiesList)) {
                foreach ($data->dutiesList as $row) {
                    $percentages .= ($row->percentage ?? '') . '<br>';
                    $duties .= ($row->duty ?? '') . '<br>';
                    $competencyLevels .= ($row->competencyLevel ?? '') . '<br>';
                }
            }
            $html2 .= '
            <tr bgcolor="#d9d9d9">
                <td colspan="9" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;"><b>22. STATEMENT OF DUTIES AND RESPONSIBILITIES</b></td>
                <td colspan="3" style="border-right:1px solid black;border-bottom:1px solid black;"><b>Competency Level</b></td>
            </tr>
            <tr>
                <td colspan="3" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black; text-align:center;"><i>Percentage of Working Time</i></td>
                <td colspan="6" style="border-right:1px solid black;border-bottom:1px solid black;"></td>
                <td colspan="3" style="border-right:1px solid black"></td>
            </tr>
            <tr>
                <td colspan="3" height="120" style="border-left:1px solid black; text-align:center;border-right:1px solid black;border-bottom:1px solid black;">'.$percentages.'</td>
                <td colspan="6" height="120" style="border-right:1px solid black;">'.$duties.'</td>
                <td colspan="3" height="120" style="border-right:1px solid black;b">'.$competencyLevels.'</td>
            </tr>
            
            
            <tr>
                <td colspan="3" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;"></td>
                <td colspan="6" style="border-right:1px solid black;border-bottom:1px solid black;"></td>
                <td colspan="3" style="border-right:1px solid black;border-bottom:1px solid black;"></td>
            </tr>';

            

            // 23: Acknowledgment and Acceptance
            $html2 .= '
                <tr bgcolor="#d9d9d9">
                    <td colspan="12" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;">
                        <b>23. ACKNOWLEDGMENT AND ACCEPTANCE:</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" height="50" style="font-size:8pt; text-align:justify; text-indent:20px; border-left:1px solid black;border-right:1px solid black;">
                        I have received a copy of this position description. It has been discussed with me and I have freely chosen to comply with
                        the performance and behavior/conduct expectations contained herein.
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="center" style="padding-top:10px; border-left: 1px solid #000;  border-bottom: 1px solid #000;">
                        <u>'.($data->employeeName ?? '').'/ '.($data->employeeDate ?? '').'</u><br>
                        <b>Employee\'s Name, Date and Signature</b>
                    </td>
                    <td colspan="6" align="center" style="padding-top:10px; border-right: 1px solid #000;  border-bottom: 1px solid #000;">
                        <u>'.($data->supervisorName ?? '').'/ '.($data->supervisorDate ?? '').'</u><br>
                        <b>Supervisor\'s Name, Date and Signature</b>
                    </td>
                </tr>';


        $html2 .= '</table>';

        // Write Page 2
        $pdf->writeHTML($html2, true, false, true, false, '');
        return $this->response->setHeader('Content-Type', 'application/pdf')->setBody($pdf->Output('form.pdf', 'S'));
    }
}