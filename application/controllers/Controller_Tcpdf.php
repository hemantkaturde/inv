<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Tcpdf extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->not_logged_in();
		$this->load->model('Model_inquiry');
	}
	

	public function quotation($id)
	{

		$inquiry_data = $this->Model_inquiry->getInquiryCustomerData($_SESSION['company_id'],$id);

		// echo "<pre>";
		// print_r($inquiry_data);
		//  exit;
		$company_name = $inquiry_data[0]['company_name'];
		$company_address = $inquiry_data[0]['company_address'];
		$company_phone = $inquiry_data[0]['phone'];
		$company_email = $inquiry_data[0]['email1'];
		$company_factory_address = $inquiry_data[0]['company_factory_address'];
		

		$this->load->library('MYPDF');

		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CRM');
		$pdf->SetTitle('Quotation');
		$pdf->SetSubject('Quotation');
		// $pdf->SetKeywords('TCPDF, PDF, example, test, codeigniter');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'035', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$pdf->SetMargins(10, 40, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set font
		// $pdf->SetFont('times', 'BI', 12);
		$pdf->SetFont('times', '', 11, '');
		
		// add a page
		$pdf->AddPage();

		$ref_no = $inquiry_data[0]['inquiry_number'];
		$date = date('F j, Y', strtotime($inquiry_data[0]['inquiry_date']));
		$name = $inquiry_data[0]['customername'];
		$address = $inquiry_data[0]['delivery_address'];
		$email = $inquiry_data[0]['email'];
		$mobile = $inquiry_data[0]['customermobile'];
		$phone = $inquiry_data[0]['customerphone'];
		$gst_no = $inquiry_data[0]['gst_number'];
		// set some text to print
		$txt = "";
		$txt .= <<<EOD
			<table cellspacing="0" cellpadding="1" border="0">
    			<tr>
        			<td width="40%"><b>Factory</b> : $company_factory_address</td>
					<td width="20%"></td>
					<td width="40%"><b>Regd. Office</b> : $company_address<br/>$company_phone<br/>$company_email</td>
    			</tr>
				<tr> 
				<td></td>
				<td></td>
				</tr>
				<tr>
        			<td width="50%">REF : $ref_no</td>
					<td width="50%" style="text-align:right">$date</td>
    			</tr>
			</table>
EOD;
		$txt .= <<<EOD
		<table cellspacing="0" cellpadding="2">
			<p>
				To<br/>
				$name<br/>$address<br/>Email : $email<br/>Phone : $phone / $mobile<br/> GST : $gst_no
			</p>
			<br/>
				<p style="text-align:center;font-weight:bold;text-decoration: underline;">Quotation</p>
			
		</table>
EOD;
		$txt .= <<<EOD
		<table cellspacing="0" cellpadding="2" border="1">
			<tr>
				<th>Description of Material</th>
				<th>MOQ nos</th>
				<th>Unit</th>
				<th>Unit Price (Rs)/- nett</th>
				<th>Amount (Rs)</th>
			</tr>
		</table>
EOD;
	$i =1;
	$total_rate = 0;
	$total_qty = 0;
	$total_final_amt = 0;
	foreach($inquiry_data as $key => $value):
		$name = isset($value['productname']) ? $value['productname'] : "";
		$qty = isset($value['inquiry_qty']) ? $value['inquiry_qty'] : 1;
		$rate = isset($value['rate']) ? $value['rate'] : "";
		$final_amount = isset($value['final_amount']) ? $value['final_amount'] : "";
		$product_type = isset($value['product_type']) ? $value['product_type'] : "";
		$freight_charges = isset($value['freight_charges']) ? $value['freight_charges'] : "";
		$txt .= <<<EOD
		<table cellspacing="0" cellpadding="4" border="1">
			<tr>
				<td>$name<br>$product_type</td>
				<td>$qty</td>
				<td>Nos</td>
				<td>$rate</td>
				<td>$final_amount</td>
			</tr>
		</table>
EOD;
	$i++;
	$total_rate = $rate + $total_rate;
	$total_qty = $qty + $total_qty;
	$total_final_amt = $final_amount + $total_final_amt;
	endforeach;
	$gst = ($total_final_amt + $freight_charges) * (18/100);
	$total = $total_final_amt+$freight_charges+$gst;
		$txt .= <<<EOD
		<table cellspacing="0" cellpadding="4" border="1">
			<tr>
				<td>+ Freight</td>
				<td></td>
				<td></td>
				<td></td>
				<td>$freight_charges</td>
			</tr>
			<tr>
				<td>+ GST 18%</td>
				<td></td>
				<td></td>
				<td></td>
				<td>$gst</td>
			</tr>
			<tr>
				<td>TOTAL</td>
				<td>$total_qty</td>
				<td></td>
				<td>$total_rate</td>
				<td>$total</td>
			</tr>
		</table>
EOD;
		
$txt .= <<<EOD
<table cellspacing="0" cellpadding="2"><br/><br/><b>Term & Conditions</b><br/></table>
EOD;

$txt .= <<<EOD
<table cellspacing="0" cellpadding="2">
	<tr>
		<td style="width:15%;text-decoration:underline">Delivery :</td>
		<td style="width:95%">immediate on receipt of payment</td>
	</tr>
	<tr>
		<td style="width:15%;text-decoration:underline">Freight :</td>
		<td style="width: 95%">By XPS on freight paid basis</td>
	</tr>
	<tr>
		<td style="width:15%;text-decoration:underline">Payment</td>
		<td style="width:95%">
			By Neft / RTGS<br/>
			Union Bank of India - 21 Veena Chambers, Dalal St, Fort branch (Br No 24) Mumbai - 400023<br/>
			Account: Hitech Electrocomponent Pvt Ltd<br/>
			A / C No: 560101000107110 &nbsp;&nbsp;&nbsp;&nbsp; (current a/c)<br/>
			RTGS No: UBIN0902217
		</td>
	</tr>
	<tr>
		<td style="width:15%;text-decoration:underline">Our GSTIN :</td>
		<td style="width:95%">29AACCH1761N1Z8</td>
	</tr>
	<tr>
	<td style="width:100%"><br/><br/>For Hitech Electrocomponents Pvt Ltd<br/><br/>Sd/-<br/><br/>Satish Shenoy</td>
	</tr>
</table>
EOD;

		// $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
		$pdf->writeHTML($txt, true, false, false, false, 'J');
		// ---------------------------------------------------------
		 ob_clean();
		//Close and output PDF document
		$pdf->Output('Quotation.pdf', 'D');
	}


	public function sales_order($id)
	{

		$inquiry_data = $this->Model_inquiry->getInquiryCustomerData($_SESSION['company_id'],$id);
		$company_name = $inquiry_data[0]['company_name'];
		$company_address = $inquiry_data[0]['company_address'];
		$company_phone = $inquiry_data[0]['phone'];
		$company_email = $inquiry_data[0]['email1'];
		$company_factory_address = $inquiry_data[0]['company_factory_address'];

		$sales_order_done_by_id = $inquiry_data[0]['sales_order_by'];

		if($sales_order_done_by_id){
			$sales_order_done_by_name = $this->Model_inquiry->getSalesorderdonebyData($_SESSION['company_id'],$sales_order_done_by_id);
			$sales_order_done_by=	$sales_order_done_by_name[0]['firstname'].' '.$sales_order_done_by_name[0]['firstname'].'-'.$sales_order_done_by_name[0]['department'];
		}else{
			$sales_order_done_by ="";
		}
		

		$this->load->library('MYPDF');

		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CRM');
		$pdf->SetTitle('Sales Order');
		$pdf->SetSubject('Sales Order');
		// $pdf->SetKeywords('TCPDF, PDF, example, test, codeigniter');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'035', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$pdf->SetMargins(10, 40, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set font
		// $pdf->SetFont('times', 'BI', 12);
		$pdf->SetFont('times', '', 11, '');
		
		// add a page
		$pdf->AddPage();

		$ref_no = $inquiry_data[0]['inquiry_number'];
		$date = date('F j, Y', strtotime($inquiry_data[0]['inquiry_date']));
		$customername = $inquiry_data[0]['customername'];
		$address = $inquiry_data[0]['delivery_address'];
		$add = $inquiry_data[0]['address'];
		$email = $inquiry_data[0]['email'];
		$mobile = $inquiry_data[0]['customermobile'];
		$phone = $inquiry_data[0]['customerphone'];
		$gst_no = $inquiry_data[0]['gst_number'];

		$phone = $inquiry_data[0]['customerphone'];
		$gst_no = $inquiry_data[0]['gst_number'];

		$sales_order_number = $inquiry_data[0]['sales_order_number'];

        if($inquiry_data[0]['sales_order_date']){
			$sales_order_date =  date("d-m-Y", strtotime($inquiry_data[0]['sales_order_date']));
		}else{
			$sales_order_date ='';
		}

		$po_number = $inquiry_data[0]['po_number'];


		if($inquiry_data[0]['po_date']){
			$po_date =  date("d-m-Y", strtotime($inquiry_data[0]['po_date']));
		}else{
			$po_date ='';
		}

		if($inquiry_data[0]['delivery_date']){
			$delivery_date = date("d-m-Y", strtotime($inquiry_data[0]['delivery_date']));
		}else{
			$delivery_date ='';
		}
		
		$freight_charges = $inquiry_data[0]['freight_charges'];

		// set some text to print
		$txt = "";
		$txt .= <<<EOD
		
        			<div><b>Slaes Order NO</b> : $sales_order_number</div>
					<div><b>DATE</b> : $sales_order_date</div>
					<div><b>CUSTOMER NAME</b> : $customername</div>
					<div><b>PO NO</b> : $po_number</div>
					<div><b>PO DATE</b> : $po_date</div>
					<div><b>DELIVERY ADDRESS</b> : $address</div>
					<div><b>BILLING ADDRESS</b> :$add</div>
					<div><b>Fright</b> : $freight_charges</div>
					<div><b>GST NO</b> : $gst_no</div>
					<br/>
					<br/>
    		
EOD;
		
		$txt .= <<<EOD
		<table cellspacing="0" cellpadding="2" border="1">
			<tr>
				<th>S.No</th>
				<th>ITEM</th>
				<th>DESCRIPTION</th>
				<th>QTY</th>
				<th>Delivery Dt</th>
				<th>Rate</th>
				<th>DISC</th>
				<th>Total</th>
			</tr>
		</table>
EOD;
	$i =1;
	$total_rate = 0;
	$total_qty = 0;
	$total_final_amt = 0;
	foreach($inquiry_data as $key => $value):
		$pname = isset($value['name']) ? $value['name'] : "";
		$description = isset($value['description']) ? $value['description'] : "";
		$qty = isset($value['qty']) ? $value['qty'] : 1;
		$rate = isset($value['rate']) ? $value['rate'] : "";
		$final_amount = isset($value['final_amount']) ? $value['final_amount'] : "";
		$product_type = isset($value['product_type']) ? $value['product_type'] : "";
		$freight_charges = isset($value['freight_charges']) ? $value['freight_charges'] : "";
		$txt .= <<<EOD
		<table cellspacing="0" cellpadding="4" border="1">
			<tr>
			    <td>$i</td>
				<td>$pname<br>$product_type</td>
				<td>$description</td>
				<td>$qty</td>
				<td>$delivery_date</td>
				<td>$rate</td>
				<td></td>
				<td>$final_amount</td>
			</tr>
		</table>
EOD;
	$i++;
	$total_rate = $rate + $total_rate;
	$total_qty = $qty + $total_qty;
	$total_final_amt = $final_amount + $total_final_amt;
	endforeach;
	$gst = ($total_final_amt + $freight_charges) * (18/100);
	$total = $total_final_amt+$freight_charges+$gst;
		$txt .= <<<EOD
		<table cellspacing="0" cellpadding="4" border="1">
			<tr>
				<td>+ Freight</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>$freight_charges</td>
			</tr>
			<tr>
				<td>+ GST 18%</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>$gst</td>
			</tr>
			<tr>
				<td>TOTAL</td>
				<td></td>
				<td></td>
				<td>$total_qty</td>
				<td></td>
				<td>$total_rate</td>
				<td></td>
				<td>$total</td>
			</tr>
		</table>
EOD;
		
$txt .= <<<EOD
<table cellspacing="0" cellpadding="2"><br/><br/><b>Note : </b><br/></table>
EOD;

$txt .= <<<EOD
<table cellspacing="0" cellpadding="2"><br/><br/> Inspection report should be send along with material<br/></table>
EOD;

$txt .= <<<EOD
<table cellspacing="0" cellpadding="2"><br/><br/><b>ENTERED BY : </b> $sales_order_done_by  -/sd<br/><br/></table>
EOD;

$txt .= <<<EOD
<table cellspacing="0" cellpadding="2"><br/><br/><b> Signature : </b>   </table>
EOD;

$txt .= <<<EOD
<table cellspacing="0" cellpadding="2"><br/><br/><b> Date : </b>    <br/></table>
EOD;

$txt .= <<<EOD
<table cellspacing="0" cellpadding="2"><br/><br/><b> NOTE : </b>Please confirm with me before dispatch.<br/></table>
EOD;


		// $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
		$pdf->writeHTML($txt, true, false, false, false, 'J');
		// ---------------------------------------------------------
		 ob_clean();
		//Close and output PDF document
		$pdf->Output('Sale Order.pdf', 'D');
	}

}