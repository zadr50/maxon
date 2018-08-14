<table > 
<tr><td align='center'><h1>SLIP GAJI</h1></td><td></td>
	<td></td><td></td>
</tr>
<tr><td>Nomor</td><td><h3><?=$pay->pay_no?></h3></td>
	<td><h2>NIP</h2></td><td><?=$emp->nip?></td>
</tr>      	
<tr><td>Tanggal</td><td><?=$pay->pay_date?></td>
	<td>Nama</td><td><?=$emp->nama?></td>
</tr>
<tr><td>Periode</td><td><?=$pay->pay_period?></td>
	<td>Jabatan</td><td><?=$emp->position?></td>
</tr>
<tr><td>From Date</td><td><?=$pay->from_date?></td>
	<td>Departement</td><td><?=$emp->dept?></td>
</tr>
<tr><td>To Date</td><td><?=$pay->to_date?></td>
	<td>Divisi</td><td><?=$emp->divisi?></td>
</tr>
</table>
 

<div class='col-md-4'>
<table cellspacing="4" cellpadding="1" border="1" >
	<tr><td colspan="2"><h2>PENDAPATAN</h2></td>
	<td colspan="2"><h2>POTONGAN</h2></td>
	</tr>
<?php 
	$tot_potong=0;
	$tot_dapat=0;
	for($y=0;$y<20;$y++){
		$tbl="";
		$jenis="";
		$amount="0";
		$jenisp="";
		$amountp="0";
			if($y<count($pendapatan)){
				 $row=$pendapatan[$y];
				 $jenis=$row['salary_com_name'];
				 $amount=$row['amount'];
				 if($row['sifat']<>"Absensi"){
					$tot_dapat=$tot_dapat+$amount;
				 }
			};
			if($y<count($potongan)){
				$rowp=$potongan[$y];
				$jenisp=$rowp['salary_com_name'];
				$amountp=$rowp['amount'];
				$tot_potong=$tot_potong+$amountp;
			}
			if($amount+$amountp>0){
				$tbl.="<tr>";
				$tbl.="<td>".$jenis."</td>";
				$s="";$s1="";
				if($amount<>0)$s=number_format($amount);
				if($amountp<>0)$s1=number_format($amountp);
				$tbl.="<td align=\"right\">".$s."</td>";
				$tbl.="<td>".$jenisp."</td>";
				$tbl.="<td align=\"right\">".$s1."</td>";
				$tbl.="</tr>";
			}
			
	   echo $tbl;
	   
	}
	   $tbl="<tr><td><strong>Total</strong></td>
		<td align=\"right\"><strong>".number_format($tot_dapat)."</strong></td>
		<td><strong>Total</strong></td><td align=\"right\"><strong>".number_format($tot_potong)."</strong></td></tr>";
	   echo $tbl;
?>	 
     <tr><td colspan="3"><h1><strong>Jumlah </strong></h1></td>
	 <td align="right"><h1><strong><?=number_format($tot_dapat-$tot_potong)?></strong></h1></td></tr>
</table>

 
