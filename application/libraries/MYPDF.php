<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once 'TCPDF/tcpdf.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {

        $CI =& get_instance();
        $CI->load->model('Model_inquiry');
        $result = $CI->Model_inquiry->GetCompanyName($_SESSION['company_id']);
        // Logo
        $this->SetY(10);
        $this->SetFont('helvetica', 'B', 15);
        // Title
        // $this->Cell(0, 20, $result[0]['company_name'], 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // $this->SetY(20);
        // $this->Cell(0, 20, 'Manufacturers of : CAPACITORS & ANCILLARIES', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $company_name = $result[0]['company_name'];
        $tbl_header = '';
$tbl_header .= <<<EOD
         <table style="border-bottom:4px solid #000;" cellpadding="13">
             <tr>
                 <td style="text-align:center;font-size:19px; font-weight:bold;">$company_name</td>
             </tr>
             <tr>
                 <td style="text-align:center;font-size:17px; font-weight:bold;">Manufacturers of : CAPACITORS & ANCILLARIES</td>
             </tr>
        </table>
    
EOD;
            $this->writeHTML($tbl_header, true, false, false, false, '');
    
    }

//     // Page footer
//     public function Footer() {
//         // Position at 15 mm from bottom
//         $this->SetY(-20);
//         // Set font
//         $this->SetFont('times', '',8);
//         // Page number

//         $html = <<<EOD
//         <font size="+1"><span><strong>Footer Example</span></strong></font>
//         <hr />
//         FooterText
// EOD;


//         $this->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
//         // print a block of text using Write()
//         //$this->Write(-60, $FooterText , '', 0, 'C', true, 0, false, false, 12);
//     }
}


?>
