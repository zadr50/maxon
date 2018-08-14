<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $CI->load->model('chart_of_accounts_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>JURNAL TRANSAKSI</h2></td>     	
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
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Tanggal</td><td>No Bukti</td><td>Akun</td><td>Nama Akun</td>
	     				<td>Debit</td><td>Kredit</td><td>Keterangan</td><td>Operation</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select distinct gl_id from gl_transactions g
	            where g.date between '$date1' and '$date2'  ";
     			$rst_gl=$CI->db->query($sql);
				foreach ($rst_gl->result() as $row_gl) {
	 		       $sql="select g.date,g.gl_id,g.source,g.operation,
	 		       c.account,c.account_description,g.debit,g.credit 
			                from gl_transactions g
			                left join chart_of_accounts c on c.id=g.account_id
			                where g.gl_id='".$row_gl->gl_id."'  
			                order by g.gl_id";
			        $query=$CI->db->query($sql);
					$total_db=0;
					$total_cr=0;
	     			$tbl="";
	                 foreach($query->result() as $row){
	                    $tbl.="<tr>";
	                    $tbl.="<td>".$row->date."</td>";
	                    $tbl.="<td>".$row->gl_id."</td>";
	                    $tbl.="<td>".($row->account)."</td>";
	                    $tbl.="<td>".$row->account_description."</td>";
	                    $tbl.="<td align='right'>".number_format($row->debit)."</td>";
	                    $tbl.="<td align='right'>".number_format($row->credit)."</td>";
	                    $tbl.="<td>".$row->source."</td>";
	                    $tbl.="<td>".$row->operation."</td>";
	                    $tbl.="</tr>";
	                    $total_db=$total_db+$row->debit;
	                    $total_cr=$total_cr+$row->credit;
	                    	                    
	               };
                    $tbl.="<tr>";
                    $tbl.="<td><h3>Sub Total</h3></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td></td>";
                    $tbl.="<td align='right'><h3>".number_format($total_db)."</h3></td>";
                    $tbl.="<td align='right'><h3>".number_format($total_cr)."</h3></td>";
                    $tbl.="<td align='right'><h3>".number_format($total_db-$total_cr)."</h3></td>";
                    $tbl.="<td></td>";
                    $tbl.="</tr>";
				   				   
				   echo $tbl;
					
				}
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
