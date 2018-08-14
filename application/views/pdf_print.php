<?php
$CI =& get_instance();

$CI->load->helper('mylib');

if(!isset($pdf_output))$pdf_output='output.pdf';
if(!isset($title))$title='';
if(!isset($header)){
	$CI->load->model('company_model');
	$model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$alamat=$model->street.' '.$model->suite.' '.$model->city_state_zip_code.' Phone: '.$model->phone_number; 	
	$header=$model->company_name;	
}
if(!isset($content))$content='Empty Page';
$format_print=$this->sysvar->getvar('format_print');

if($format_print=="html" || $format_print==""){
    echo "<link rel='stylesheet' type='text/css' 
        href='".base_url()."themes/standard/style_print.css'>";
    echo $content;
        
} else{
        
    $CI->load->helper('pdf_helper');        
    
    tcpdf();
    
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle($title);
    $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $header,$alamat);
    //$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    //$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    //$obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    //$obj_pdf->SetFont('dejavuserifcondensed', '', 8);
    //$obj_pdf->setFontSubsetting(false);
    $obj_pdf->AddPage();
    //echo $content;
    $obj_pdf->writeHTML($content, true, false, true, false, '');
    $obj_pdf->Output($pdf_output, 'I');

}
 
 
?>
