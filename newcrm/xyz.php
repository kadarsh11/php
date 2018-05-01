<?php 
$iv='INV-551.pdf';
		$ivname='./invoices/'.$iv;
		$dir = dirname(__FILE__);
		
		// Get the contents of the pdf into a variable for later
		ob_start();
		require_once($dir.'/invoice_html/invoice551.html');
		$pdf_html = ob_get_contents();
		ob_end_clean();
		
		// Load the dompdf files
		
		require_once($dir."/mpdf60/mpdf.php");
		$mpdf = new mPDF('utf-8', array(210,297));
		$mpdf->WriteHTML($pdf_html);
		$pdf_content = $mpdf->Output('', 'S');
		$q=file_put_contents($ivname,$pdf_content);
