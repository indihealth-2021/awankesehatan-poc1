<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require '././vendor/autoload.php';
require dirname(__FILE__,3).'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class Setpdf {	
	public function get_pdf($html) {	
				    
		$css = '<style>';
		$css .= '.pracetak, .viewer{margin-top: 50px; text-align:left;}';
		$css .= 'tr,td{text-align:left;}';
		$css .= '.border-table{border:2px solid #000;margin-bottom:10px; width: 99%;}';
		$css .= '.preview-area{position:absolute;background:#CCC;left:10px;top:10px;right:10px;bottom:50px;overflow-y:scroll;box-shadow:inset 0px 0px 5px #888888;border:1px solid rgba(0,0,0,.2)}';
		$css .= '</style>';		
		
		$html2pdf = new Html2Pdf('P', 'A4');		
		$html2pdf->writeHTML($css.$html);
		$html2pdf->output('berkas.pdf','F');			
		header("Content-type:application/pdf");						
		header("Content-Transfer-Encoding: binary");		
		echo file_get_contents("berkas.pdf");
	}

	public function get_rekapitulasi($html) {
		$css = '<style>';
		$css .= '.pracetak, .viewer{margin-top: 50px; text-align:left;}';
		$css .= '.preview-area{position:absolute;background:#CCC;left:10px;top:10px;right:10px;bottom:50px;overflow-y:scroll;box-shadow:inset 0px 0px 5px #888888;border:1px solid rgba(0,0,0,.2)}';
		$css .= 'table { table-layout:fixed !important; border-collapse:collapse; margin-bottom:20px; }';
		$css .= '#table-two { border: 1px solid black; }';
		$css .= 'td { word-wrap: break-word; }';
		$css .= '#table-two td, #table-two th { border: 1px solid black; } td, th{padding: 3px;}';
		$css .= '#table-two th { text-align: center; }';
		$css .= 'td, th {  font-size:11px; }';
		$css .= '</style>';
		$html2pdf = new Html2Pdf('P', 'A4');
		$html2pdf->writeHTML($css . $html);
		$html2pdf->output('Rekapitulasi Pelayanan Telemedicine.pdf','F');
		header("Content-type:application/pdf");						
		header("Content-Transfer-Encoding: binary");		
		echo file_get_contents("Rekapitulasi Pelayanan Telemedicine.pdf");
	}
}