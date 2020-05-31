<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    
    $salesman=$CI->input->post("text1");
    $customer=$CI->input->post("text2");
    $outlet=$CI->input->post("text3");
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>DAFTAR FAKTUR PENJUALAN</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
     		Salesman: <?=$salesman?>, Customer: <?=$customer?>, 
     		Outlet: <?=$outlet?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Nomor Faktur</td><td>Tanggal</td><td>Kode Pelanggan</td><td>Nama Pelanggan</td>
	     				<td>Nomor SO</td><td>Termin</td><td>Salesman</td><td>Jumlah</td>
						<td>Payment</td><td>Retur</td><td>Cr Memo</td><td>Dr Memo</td>
						<td>Saldo</td><td>Outlet</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select * from qry_invoice where invoice_date 
				between '$date1' and '$date2'  ";
				$logged_in=$this->session->userdata('logged_in');
				if($logged_in['flag1']=='1'){
					$sql.=" and salesman='".$logged_in['username']."'";
				}
				if($salesman!=""){
				    $sql.=" and salesman='$salesman'";
				}
                if($customer!=""){
                    $sql.=" and sold_to_customer='$customer'";
                }
                $sql.=" order by invoice_number";
				//echo "</br>".$sql;
				
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
				$z_amount=0;		$z_payment=0;
				$z_retur=0;			$z_cr_amount=0;
				$z_db_amount=0;		$z_saldo=0;
                 foreach($rst_so->result() as $row){
                    $warehouse_code="";
                    if($q=$CI->db->select("warehouse_code")->where("invoice_number",$row->invoice_number)
                        ->where("warehouse_code<>''")->limit(1)->get("invoice_lineitems")){
                            if($r=$q->row()){
                                $warehouse_code=$r->warehouse_code;
                            }
                        } 
                    if($outlet==$warehouse_code || $outlet==""){
                        $tbl.="<tr>";
                        $tbl.="<td>".$row->invoice_number."</td>";
                        $tbl.="<td>".date("Y-m-d",strtotime($row->invoice_date))."</td>";
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
    					$saldo=$row->amount-$row->payment-$row->retur-$row->cr_amount+$row->db_amount;
                        $tbl.="<td align='right'>".number_format($saldo)."</td>";
                        $tbl.="<td>$warehouse_code</td>";
                        $tbl.="</tr>";
    					$z_amount=$z_amount+$row->amount;
    					$z_payment=$z_payment+$row->payment;
    					$z_retur=$z_retur+$row->retur;
    					$z_cr_amount=$z_cr_amount+$row->cr_amount;
    					$z_db_amount=$z_db_amount+$row->db_amount;
    					$z_saldo=$z_saldo+$saldo;
					}
               };
			   
			   $tbl.="<tr><td><b>TOTAL</b></td><td></td><td></td><td></td>
	     				<td></td><td></td><td></td><td align='right'><b>".number_format($z_amount)."</b></td>
						<td align='right'><b>".number_format($z_payment)."</b></td>
						<td align='right'><b>".number_format($z_retur)."</b></td>
						<td align='right'><b>".number_format($z_cr_amount)."</b></td>
						<td align='right'><b>".number_format($z_db_amount)."</b></td>
						<td align='right'><b>".number_format($z_saldo)."</b></td></tr>";
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
