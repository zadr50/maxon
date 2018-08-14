<?php 
	include "koneksi.php";
	header('Content-type: text/xml');
	$sql=strtolower($_POST['sql']);
	$result=mysql_query($sql);		
	$writer = new XMLWriter();
	$writer->openUri('php://output');
	$writer->startDocument();
	if($result){
		$writer->startElement('recordset');
		while ($row = mysql_fetch_assoc($result)) 
		{
			$writer->startElement('record');
			foreach($row as $name => $value) {
				$writer->startElement($name);
				$value=htmlspecialchars_decode($value);					
				$writer->text($value);
				$writer->endElement();
			}
			$writer->endElement();
		}
		$writer->endElement();
	}
	$writer->endDocument();	
 ?>