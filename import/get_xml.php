<?php 
include "koneksi.php";
header('Content-type: text/xml');
$table=strtolower($_POST['table_name']);
$key_field=strtolower($_POST['key_field']);
$key_value=strtolower($_POST['key_value']);
	
	$sql="select * from $table where $key_field='$key_value'";
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
//					echo $name."</br>";
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