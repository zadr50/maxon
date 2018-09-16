<?php
//var_dump($_POST);
?>
<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
     $date_from="";
     $date_to="";
     $closed=0;
     $with_header=false;        
     $period=$this->input->post("text1");
     $CI->load->model("periode_model");
     
     if($qprd=$CI->periode_model->get_by_id($period)){
         if($rprd=$qprd->row()){
             $closed=$rprd->closed;
         }
     }
    $CI->load->model('chart_of_accounts_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
<?php if($with_header) { ?>	
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>NERACA SALDO</h2></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?=$model->street?></td><td></td>     	
     </tr>
     <tr>
     	<td colspan='2'><?=$model->suite?></td>     	
     </tr>
     <tr>
     	<td>
     		<?=$model->city_state_zip_code?> - Phone: <?=$model->phone_number?>
     	</td>
     </tr>
     <tr>
     	<td>
     		Periode : <?=$period?>
     	</td>
     </tr>
<?php } ?>     
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Kode Akun</td><td>Nama Akun</td>
	     				<td colspan='3'>Saldo Awal</td>
	     				<td colspan='3'>Mutasi</td>
	     				<td colspan='3'>Saldo Akhir</td>
	     			</tr>
	     			<tr><td></td><td></td>
	     				<td>Debit</td><td>Kredit</td><td>Saldo</td>
	     				<td>Debit</td><td>Kredit</td><td>Saldo</td>
	     				<td>Debit</td><td>Kredit</td><td>Saldo</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select account,account_description,id from chart_of_accounts
	            order by account_type,account ";
     			$rst_coa=$CI->db->query($sql);
				$total_awal_cr=0;$total_awal_db=0;
				$total_cr=0;$total_db=0;
				$total_akhir_cr=0;$total_akhir_db=0;
				foreach ($rst_coa->result() as $row_coa) {
	
	 		       $sql="select sum(g.debit) as sum_debit,sum(g.credit) as sum_credit 
	                from gl_transactions g
	                where g.account_id='".$row_coa->id."' and g.date<='$date1'"; 
			        $query=$CI->db->query($sql)->row();
					if($query){
						$sld_db=$query->sum_debit;
						$sld_cr=$query->sum_credit;
					} else {
						$sld_db=0;
						$sld_cr=0;
					}
	
	
	 		       $sql="select sum(g.debit) as sum_debit,sum(g.credit) as sum_credit 
	                from gl_transactions g
	                where g.account_id='".$row_coa->id."' and g.date between '$date1' and '$date2'"; 
			        $query=$CI->db->query($sql)->row();
					if($query){
						$mut_db=$query->sum_debit;
						$mut_cr=$query->sum_credit;
					} else {
						$mut_db=0;
						$mut_cr=0;
					}
					$saldo=($sld_db+$mut_db)-($sld_cr+$mut_cr);
		     		$tbl="";
					if($saldo!=0){
	                    $tbl.="<tr>";
	                    $tbl.="<td>".$row_coa->account."</td>";
	                    $tbl.="<td>".$row_coa->account_description."</td>";
	                    $tbl.="<td align='right'>".number_format($sld_db)."</td>";
	                    $tbl.="<td align='right'>".number_format($sld_cr)."</td>";
	                    $tbl.="<td align='right'>".number_format($sld_db-$sld_cr)."</td>";
						$total_awal_db=$total_awal_db+$sld_db;
						$total_awal_cr=$total_awal_cr+$sld_cr;
	
	                    $tbl.="<td align='right'>".number_format($mut_db)."</td>";
	                    $tbl.="<td align='right'>".number_format($mut_cr)."</td>";
	                    $tbl.="<td align='right'>".number_format($mut_db-$mut_cr)."</td>";
						$total_db=$total_db+$mut_db;
						$total_cr=$total_cr+$mut_cr;
	
	                    $tbl.="<td align='right'>".number_format($sld_db+$mut_db)."</td>";
	                    $tbl.="<td align='right'>".number_format($sld_cr+$mut_cr)."</td>";
	                    $tbl.="<td align='right'>".number_format($saldo)."</td>";
						$total_akhir_db=$total_akhir_db+$sld_db+$mut_db;
						$total_akhir_cr=$total_akhir_cr+$sld_cr+$mut_cr;
	
	                    $tbl.="</tr>";
	                    $tbl.="<tr>";
                    }				   

					echo $tbl;
					
				};
				$tbl="<tr>";
				$tbl.="<td>TOTAL</td>";
				$tbl.="<td></td>";
				$tbl.="<td align='right'>".number_format($total_awal_db)."</td>";
				$tbl.="<td align='right'>".number_format($total_awal_cr)."</td>";
				$tbl.="<td align='right'>".number_format($total_awal_db-$total_awal_cr)."</td>";

				$tbl.="<td align='right'>".number_format($total_db)."</td>";
				$tbl.="<td align='right'>".number_format($total_cr)."</td>";
				$tbl.="<td align='right'>".number_format($total_db-$total_cr)."</td>";

				$tbl.="<td align='right'>".number_format($total_akhir_db)."</td>";
				$tbl.="<td align='right'>".number_format($total_akhir_cr)."</td>";
				$tbl.="<td align='right'>".number_format($total_akhir_db-$total_akhir_cr)."</td>";

				$tbl.="</tr>";
				$tbl.="<tr>";
				
				echo $tbl;
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
