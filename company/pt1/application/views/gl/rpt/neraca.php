<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	 if(isset($date_from)){
		 $date1=$date_from;
		 $date2=$date_to;
		 $with_header=false;	 	
	 } else {
		$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
		$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
		$with_header=true;
	 }
    $CI->load->model('chart_of_accounts_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
<? if($with_header) { ?>	
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>LAPORAN NERACA</h2></td>     	
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
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     	</td>
     </tr>
<? } ?>     
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Kode Akun</td><td>Nama Akun</td>
	     				<td >Total</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
				$coa_rl=$model->earning_account;
				
     			$sql="select account,account_description,id from chart_of_accounts
				where account_type<4
	            order by account_type,account ";
     			$rst_coa=$CI->db->query($sql);
				$total=0;
				$tbl='';
				$total_this_period=0;
				foreach ($rst_coa->result() as $row_coa) {
					// year to date
	 		        $sql="select sum(g.debit) as sum_debit,sum(g.credit) as sum_credit 
	                from gl_transactions g
	                where g.account_id='".$row_coa->id."' and g.date<='$date2'"; 
					
			        $query=$CI->db->query($sql)->row();
					
					if($query){
						$saldo=$query->sum_debit-$query->sum_credit;
					} else {
						$saldo=0;
					}
					if($row_coa->id==$coa_rl) {	// apabila akun rugi laba berjalan tambah 
						$sql="select sum(g.debit)-sum(g.credit) as saldo 
						from gl_transactions g left join chart_of_accounts c on c.id=g.account_id
						where c.account_type>3 and g.date<='$date2'";
//						and year(g.date)=".substr($date2,0,4); 
						
						if($query=$CI->db->query($sql)->row()){
							$saldo=$saldo+$query->saldo;
						}
					}
					$total=$total+$saldo;
					if($saldo!=0){
						$tbl.="<tr>";
						$tbl.="<td>".$row_coa->account."</td>";
						$tbl.="<td>".$row_coa->account_description."</td>";
						$tbl.="<td align='right'>".number_format($saldo)."</td>";
						$tbl.="</tr>";					
					}
				};
				$tbl.="<tr>";
				$tbl.="<td>TOTAL</td>";
				$tbl.="<td></td>";
				$tbl.="<td align='right'>".number_format($total)."</td>";
				$tbl.="</tr>";
				$tbl.="<tr>";
				
				echo $tbl;
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
