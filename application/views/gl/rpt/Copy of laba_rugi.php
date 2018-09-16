<?php
//var_dump($_POST);
?>
<?php
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
<?php if($with_header) { ?>	
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>LAPORAN LABA RUGI</h2></td>     	
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
<?php } ?>     
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Kode Akun</td><td>Nama Akun</td>
	     				<td >This Period</td>
	     				<td >Year To Date</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select account,account_description,id from chart_of_accounts
				where account_type>3
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
					//and year(g.date)=".substr($date2,0,4); 
					
			        $query=$CI->db->query($sql)->row();
					
					if($query){
						$saldo=$query->sum_debit-$query->sum_credit;
					} else {
						$saldo=0;
					}
					$total=$total+$saldo;
					// this periode
	 		        $sql="select sum(g.debit) as sum_debit,sum(g.credit) as sum_credit 
	                from gl_transactions g
	                where g.account_id='".$row_coa->id."' and g.date between '$date1' and '$date2'"; 
					
			        $query=$CI->db->query($sql)->row();
					
					if($query){
						$saldo_this_period=$query->sum_debit-$query->sum_credit;
					} else {
						$saldo_this_period=0;
					}
					$total_this_period=$total_this_period+$saldo_this_period;
					if($saldo!=0){
						$tbl.="<tr>";
						$tbl.="<td>".$row_coa->account."</td>";
						$tbl.="<td>".$row_coa->account_description."</td>";
						$tbl.="<td align='right'>".number_format($saldo_this_period)."</td>";
						$tbl.="<td align='right'>".number_format($saldo)."</td>";
						$tbl.="</tr>";					
					}
				};
				$tbl.="<tr>";
				$tbl.="<td>TOTAL</td>";
				$tbl.="<td></td>";
				$tbl.="<td align='right'>".number_format($total_this_period)."</td>";
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
