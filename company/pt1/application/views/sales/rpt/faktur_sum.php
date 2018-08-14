<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $CI->load->model('sales_order_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>DAFTAR FAKTUR PENJUALAN</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Tanggal</td><td>Nomor Faktur</td><td>Kode Pelanggan</td><td>Nama Pelanggan</td>
	     				<td>Nomor SO</td><td>Termin</td><td>Salesman</td><td>Jumlah</td>
						<td>Payment</td><td>Retur</td><td>Cr Memo</td><td>Dr Memo</td>
						<td>Saldo</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select * from qry_invoice where invoice_date 
				between '$date1' and '$date2'  ";
				$logged_in=$this->session->userdata('logged_in');
				if($logged_in['flag1']!=''){
					$sql.=" and salesman='".$logged_in['username']."'";
				}
				
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
				$z_amount=0;		$z_payment=0;
				$z_retur=0;			$z_cr_amount=0;
				$z_db_amount=0;		$z_saldo=0;
                 foreach($rst_so->result() as $row){
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->invoice_date."</td>";
                    $tbl.="<td>".$row->invoice_number."</td>";
                    $tbl.="<td>".($row->sold_to_customer)."</td>";
                    $tbl.="<td>".$row->company."</td>";
                    $tbl.="<td>".$row->sales_order_number."</td>";
                    $tbl.="<td>".$row->payment_terms."</td>";
                    $tbl.="<td>".$row->salesman."</td>";
                    $tbl.="<td align='right'>".number_format($row->amount)."</td>";
                    $tbl.="<td align='right'>".number_format($row->payment)."</td>";
                    $tbl.="<td align='right'>".number_format($row->retur)."</td>";
                    $tbl.="<td align='right'>".number_format($row->cr_amount)."</td>";
                    $tbl.="<td align='right'>".number_format($row->db_amount)."</td>";
					$saldo=$row->amount-$row->payment-$row->cr_amount+$row->db_amount;
                    $tbl.="<td align='right'>".number_format($saldo)."</td>";
                    $tbl.="</tr>";
					$z_amount=$z_amount+$row->amount;
					$z_payment=$z_payment+$row->payment;
					$z_retur=$z_retur+$row->retur;
					$z_cr_amount=$z_cr_amount+$row->cr_amount;
					$z_db_amount=$z_db_amount+$row->db_amount;
					$z_saldo=$z_saldo+$saldo;
               };
			   
			   $tbl.="<tr><td>TOTAL</td><td></td><td></td><td></td>
	     				<td></td><td></td><td></td><td align='right'>".number_format($z_amount)."</td>
						<td align='right'>".number_format($z_payment)."</td>
						<td align='right'>".number_format($z_retur)."</td>
						<td align='right'>".number_format($z_cr_amount)."</td>
						<td align='right'>".number_format($z_db_amount)."</td>
						<td align='right'>".number_format($z_saldo)."</td></tr>";
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
