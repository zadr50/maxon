<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $com=$CI->company_model->get_by_id($CI->access->cid)->row();
	$company="";
	if($com){
		$company=$com->company_name;
	}


?>
<table > 
<tr>
	<td align='center' colspan="4"><b><?=$company?></b></td>	
</tr>
<tr>
	<td align='center' colspan="4"><b>SLIP GAJI</b></td>
	<td></td>
</tr>
<tr>
	<td>Nomor</td><td><b><?=$pay->pay_no?></b></td>
	<td>NIP</td><td><b><?=$emp->nip?></b></td>
</tr>      	
<tr>
	<td>Tahun</td><td><b><?=date("Y",strtotime($pay->pay_date))?></b></td>
	<td>Nama</td><td><b><?=$emp->nama?></b></td>
</tr>
<tr><td>Bulan</td><td><b><?=date("M",strtotime($pay->pay_date))?></b></td>
	<td>Jabatan</td><td><b><?=$emp->position?></b></td>
</tr>
<tr>
	<td>Departement</td><td><b><?=$emp->dept?></b></td>
	<td>Divisi</td><td><b><?=$emp->divisi?></b></td>
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

 
