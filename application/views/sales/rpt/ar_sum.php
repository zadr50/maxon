<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $CI->load->model('sales_order_model');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>DAFTAR PIUTANG PELANGGAN</h2></td>     	
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
	     			<tr><td>Kode</td><td>Pelanggan</td><td>Awal</td><td>Debit</td><td>Credit</td>
					<td>Saldo</td><td>Kota</td>	<td>Telp</td><td>Alamat</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
				$sql="select distinct p.customer_number,company,city,phone,street
					from qry_kartu_piutang p left join customers c on c.customer_number=p.customer_number 
					where tanggal< '$date2' ";
				$rst_cust=$CI->db->query($sql);
				$tbl="";
				$z_awal_tot=0; 	$z_db_tot=0; 	$z_cr_tot=0;
				
				foreach($rst_cust->result() as $rst_cust_row) {
					$z_awal=0;
					$sql="select sum(amount) as z_awal
					from qry_kartu_piutang i 
					where i.tanggal<'$date1' and i.customer_number='".$rst_cust_row->customer_number."'";
					if($q=$CI->db->query($sql)){
						$qq=$q->row();
						$z_awal=$qq->z_awal;
					}

					$sql="select i.customer_number,c.company,c.city,c.phone,c.street,sum(amount) as z_amount
					 from qry_kartu_piutang i left join customers c on c.customer_number=i.customer_number
					where i.tanggal between '$date1' and '$date2'  and i.customer_number='".$rst_cust_row->customer_number."' 
					and i.amount>0
					group by i.customer_number,c.company,c.city,c.phone,c.street ";
					$row_db=null;
					$row_db[0]=array("customer_number"=>$rst_cust_row->customer_number,"company"=>"","z_amount"=>0,
						"city"=>"","phone"=>"","street"=>"");
					if($q=$CI->db->query($sql))	$row_db=$q->row();

					$sql="select i.customer_number,c.company,c.city,c.phone,c.street,sum(amount) as z_amount
					 from qry_kartu_piutang i left join customers c on c.customer_number=i.customer_number
					where i.tanggal between '$date1' and '$date2'  and i.customer_number='".$rst_cust_row->customer_number."' 
					and i.amount<0
					group by i.customer_number,c.company,c.city,c.phone,c.street ";
					$row_cr=null;
					$row_cr[0]=array("customer_number"=>$rst_cust_row->customer_number,"company"=>"","z_amount"=>0);
					if($q=$CI->db->query($sql))	$row_cr=$q->row();
					$db=0;$cr=0;
					if($row_db!=null)$db=$row_db->z_amount;
					if($row_cr!=null)$cr=abs($row_cr->z_amount);
					$tbl.="<tr>";
					$tbl.="<td>".$rst_cust_row->customer_number."</td>";
					$tbl.="<td>".$rst_cust_row->company."</td>";
					$tbl.="<td align='right'>".number_format($z_awal)."</td>";
					$tbl.="<td align='right'>".number_format($db)."</td>";
					$tbl.="<td align='right'>".number_format($cr)."</td>";
					$saldo=$z_awal+$db-$cr;
					$tbl.="<td align='right'>".number_format($saldo)."</td>";
					$tbl.="<td>".$rst_cust_row->city."</td>";
					$tbl.="<td>".$rst_cust_row->phone."</td>";
					$tbl.="<td>".$rst_cust_row->street."</td>";
					$tbl.="</tr>";
					$z_awal_tot=$z_awal_tot+$z_awal;
					$z_db_tot=$z_db_tot+$db;
					$z_cr_tot=$z_cr_tot+$cr;
				};
				$tbl.="<tr>";
				$tbl.="<td><strong>TOTAL</strong></td>";
				$tbl.="<td></td>";
				$tbl.="<td align='right'><strong>".number_format($z_awal_tot)."</strong></td>";
				$tbl.="<td align='right'><strong>".number_format($z_db_tot)."</strong></td>";
				$tbl.="<td align='right'><strong>".number_format($z_cr_tot)."</strong></td>";
				$saldo=$z_awal_tot+$z_db_tot-$z_cr_tot;
				$tbl.="<td align='right'><strong>".number_format($saldo)."</strong></td>";
				$tbl.="<td></td>";
				$tbl.="<td></td>";
				$tbl.="<td></td>";
				$tbl.="</tr>";
				 
				
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
