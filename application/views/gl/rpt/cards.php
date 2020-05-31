<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
 
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	$account_from= $CI->input->post('text1');
	$account_to= $CI->input->post('text2');
     $CI->load->model('chart_of_accounts_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>KARTU GENERAL LEDGER</h2></td>     	
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
     		 Dari Akun: <?=$account_from?> - <?=$account_to?>
     	</td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
     			<?php
     			$sql="select account,account_description,id,account_type from chart_of_accounts 
     			where account";
                if($account_from!="")$sql.=" between '$account_from' and '$account_to' ";
     			$sql.=" order by account";
		        $rst_coa=$CI->db->query($sql);
				foreach($rst_coa->result() as $row_coa){
					$account=$row_coa->account;

					echo "<h3>".$row_coa->account." - ".$row_coa->account_description."</h3>";
		     		ECHO "<table class='titem'>
		     		<thead>
		     			<tr><td>Tanggal</td><td>No Bukti</td><td>Keterangan</td><td>Akun</td><td>Debit</td>
		     				<td>Kredit</td><td>Saldo</td><td>Operation</td>
		     			</tr>
		     		</thead>
		     		<tbody>";
	 		       $sql="select sum(g.debit)-sum(g.credit) as saldo 
		                from gl_transactions g
		                left join chart_of_accounts c on c.id=g.account_id
		                where g.date<'$date1' and account='$account'";
			        $rst=$CI->db->query($sql)->row();
					$saldo=0;
					if($rst)$saldo=$rst->saldo;
	 		       $sql="select g.date,g.gl_id,g.source,g.operation,c.account,g.debit,g.credit 
			                from gl_transactions g
			                left join chart_of_accounts c on c.id=g.account_id
			                where g.date between '$date1' and '$date2' and account='$account' 
			                order by g.date";
			        $query=$CI->db->query($sql);
	
	     			$tbl="";
	                $tbl.="<tr>";
	                $tbl.="<td>SALDO AWAL</td>";
	                $tbl.="<td></td>";
	                $tbl.="<td></td>";
	                $tbl.="<td></td>";
	                $tbl.="<td align='right'>".number_format(0)."</td>";
	                $tbl.="<td align='right'>".number_format(0)."</td>";
	                $tbl.="<td align='right'>".number_format($saldo)."</td>";
	                $tbl.="<td></td>";
	                $tbl.="</tr>";
	                 foreach($query->result() as $row){
	                    if($row_coa->account_type<3){
                            $saldo=$saldo+($row->debit-$row->credit);
	                        
	                    } else  {
                            $saldo=$saldo+($row->credit-$row->debit);
	                        
	                        
	                    }
	                    $tbl.="<tr>";
	                    $tbl.="<td>".$row->date."</td>";
	                    $tbl.="<td>".$row->gl_id."</td>";
	                    $tbl.="<td align='left'>".($row->source)."</td>";
	                    $tbl.="<td>".$row->account."</td>";
	                    $tbl.="<td align='right'>".number_format($row->debit)."</td>";
	                    $tbl.="<td align='right'>".number_format($row->credit)."</td>";
	                    $tbl.="<td align='right'>".number_format($saldo)."</td>";
	                    $tbl.="<td>".$row->operation."</td>";
	                    $tbl.="</tr>";
	               };
				   echo $tbl;

				echo "     		</tbody>
		     		</table>";

				};
    			?>
     	
     	
     	</td>
     </tr>
</table>

