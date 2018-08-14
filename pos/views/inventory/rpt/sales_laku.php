<?php 
	$CI =& get_instance();
	$data['caption']='TOP 10 SALES';
	if(!$CI->input->post('cmdPrint')){
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;
		$data['criteria1']=true;
		$data['label1']='Kelompok Barang';
		$data['text1']='';
		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
		$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
		$kel=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
		
		$sql="select i.category from invoice_lineitems il 
			left join inventory i on i.item_number=il.item_number 
			left join invoice h on h.invoice_number=il.invoice_number 
			where h.invoice_type='I' and h.invoice_date 
			between '$date1' and '$date2'";
			
		if($kel!="")$sql.=" and i.category='$kel'";
		$sql.="	group by i.category";		 

		$tbl="<table class='titem' width='100%'>
		<tr><thead><th>Kode Barang</th><th>Nama Barang</th>
		<th>Quantity</th><th>Sales Amount</th></thead>";
		if($qcat=$CI->db->query($sql))
		{
			foreach($qcat->result() as $cat) 
			{
				$sql="select il.item_number,i.description,
					sum(quantity) as z_qty, sum(il.amount) as z_amount
					from invoice_lineitems il 
					left join inventory i on i.item_number=il.item_number 
					left join invoice h on h.invoice_number=il.invoice_number 
					where h.invoice_type='I' and h.invoice_date 
					between '$date1' and '$date2'
					and i.category='$cat->category' 
					group by il.item_number,i.description 
					order by sum(il.quantity) desc
					limit 10";
				$tbl.="<tr><td colspan='5'><h1>$cat->category</h1></td></tr>";
				if($qitem=$CI->db->query($sql))
				{
					foreach($qitem->result() as $item)
					{
						$tbl .= "<tr><td>$item->item_number</td>
						<td>$item->description</td>
						<td>$item->z_qty</td>
						<td align='right'>".number_format($item->z_amount)."</td>
						</tr>";
						
					}
				}
			}
		}
		$tbl.="</table>";
		$data['content']=$tbl;
		$this->load->view('simple_print.php',$data);    		

	}

?>