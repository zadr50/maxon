<?php
$CI =& get_instance();
$CI->load->model('company_model');
$model=$CI->company_model->get_by_id($this->access->cid)->row();
$date1= date('Y-m-d H:i:s', strtotime($this->input->post('txtDateFrom')));
$date2= date('Y-m-d H:i:s', strtotime($this->input->post('txtDateTo')));
$category=$this->input->post('text1');
$supplier=$this->input->post('text2');

function sales_qty($item,$item_name,$d1,$d2){
	$CI =& get_instance();
	
$sql="select 
sum(
	case when month(i.invoice_date)=1 then il.quantity else 0 end
) as qty_jan,

sum(
	case when month(i.invoice_date)=2 then il.quantity else 0 end
) as qty_feb,


sum(
	case when month(i.invoice_date)=3 then il.quantity else 0 end
) as qty_mar,


sum(
	case when month(i.invoice_date)=4 then il.quantity else 0 end
) as qty_apr,


sum(
	case when month(i.invoice_date)=5 then il.quantity else 0 end
) as qty_may,


sum(
	case when month(i.invoice_date)=6 then il.quantity else 0 end
) as qty_jun,


sum(
	case when month(i.invoice_date)=7 then il.quantity else 0 end
) as qty_jul,


sum(
	case when month(i.invoice_date)=8 then il.quantity else 0 end
) as qty_aug,


sum(
	case when month(i.invoice_date)=9 then il.quantity else 0 end
) as qty_sep,


sum(
	case when month(i.invoice_date)=10 then il.quantity else 0 end
) as qty_oct,


sum(
	case when month(i.invoice_date)=11 then il.quantity else 0 end
) as qty_nov,

sum(
	case when month(i.invoice_date)=12 then il.quantity else 0 end
) as qty_dec,
sum(il.quantity) as qty_total,

sum(
	case when month(i.invoice_date)=1 then il.amount else 0 end
) as sale_jan,
sum(
	case when month(i.invoice_date)=2 then il.amount else 0 end
) as sale_feb,
sum(
	case when month(i.invoice_date)=3 then il.amount else 0 end
) as sale_mar,
sum(
	case when month(i.invoice_date)=4 then il.amount else 0 end
) as sale_apr,
sum(
	case when month(i.invoice_date)=5 then il.amount else 0 end
) as sale_may,
sum(
	case when month(i.invoice_date)=6 then il.amount else 0 end
) as sale_jun,
sum(
	case when month(i.invoice_date)=7 then il.amount else 0 end
) as sale_jul,
sum(
	case when month(i.invoice_date)=8 then il.amount else 0 end
) as sale_aug,
sum(
	case when month(i.invoice_date)=9 then il.amount else 0 end
) as sale_sep,
sum(
	case when month(i.invoice_date)=10 then il.amount else 0 end
) as sale_oct,
sum(
	case when month(i.invoice_date)=11 then il.amount else 0 end
) as sale_nov,
sum(
	case when month(i.invoice_date)=12 then il.amount else 0 end
) as sale_dec,

sum(il.amount) as sale_total,

sum(
	case when month(i.invoice_date)=1 then (il.cost*il.quantity) else 0 end
) as cost_jan,
sum(
	case when month(i.invoice_date)=2 then (il.cost*il.quantity) else 0 end
) as cost_feb,
sum(
	case when month(i.invoice_date)=3 then (il.cost*il.quantity) else 0 end
) as cost_mar,
sum(
	case when month(i.invoice_date)=4 then (il.cost*il.quantity) else 0 end
) as cost_apr,
sum(
	case when month(i.invoice_date)=5 then (il.cost*il.quantity) else 0 end
) as cost_may,
sum(
	case when month(i.invoice_date)=6 then (il.cost*il.quantity) else 0 end
) as cost_jun,
sum(
	case when month(i.invoice_date)=7 then (il.cost*il.quantity) else 0 end
) as cost_jul,
sum(
	case when month(i.invoice_date)=8 then (il.cost*il.quantity) else 0 end
) as cost_aug,
sum(
	case when month(i.invoice_date)=9 then (il.cost*il.quantity) else 0 end
) as cost_sep,
sum(
	case when month(i.invoice_date)=10 then (il.cost*il.quantity) else 0 end
) as cost_oct,
sum(
	case when month(i.invoice_date)=11 then (il.cost*il.quantity) else 0 end
) as cost_nov,
sum(
	case when month(i.invoice_date)=12 then (il.cost*il.quantity) else 0 end
) as cost_dec,

sum(il.cost*il.quantity) as cost_total,

sum(
	case when month(i.invoice_date)=1 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_jan,
sum(
	case when month(i.invoice_date)=2 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_feb,
sum(
	case when month(i.invoice_date)=3 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_mar,
sum(
	case when month(i.invoice_date)=4 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_apr,
sum(
	case when month(i.invoice_date)=5 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_may,
sum(
	case when month(i.invoice_date)=6 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_jun,
sum(
	case when month(i.invoice_date)=7 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_jul,
sum(
	case when month(i.invoice_date)=8 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_aug,
sum(
	case when month(i.invoice_date)=9 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_sep,
sum(
	case when month(i.invoice_date)=10 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_oct,
sum(
	case when month(i.invoice_date)=11 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_nov,
sum(
	case when month(i.invoice_date)=12 then (il.amount-(il.cost*il.quantity)) else 0 end
) as profit_dec,

sum(il.amount-(il.cost*il.quantity)) as profit_total,


(sum(il.amount-(il.cost*il.quantity))/sum(il.amount))*100 as profit_prc 
from invoice i 
left join invoice_lineitems il on il.invoice_number=i.invoice_number
left join inventory s on s.item_number=il.item_number
where i.invoice_type='I' and i.invoice_date between '$d1' and '$d2' 
and il.item_number='$item'  
";
//if($category!="")$sql.=" and s.category='$category'";
//if($supplier!="")$sql.=" and s.supplier_number='$supplier'";
	
	if($q2=$CI->db->query($sql)){
		if($r2=$q2->row()){
			if($r2->qty_total>0){
				
			echo "<tr><td><b>$item</b></td><td><b>$item_name</b></td><td><b>Qty Sale</b></td>
				<td align='right'>".number_format($r2->qty_jan)."</td>
				<td align='right'>".number_format($r2->qty_feb)."</td>
				<td align='right'>".number_format($r2->qty_mar)."</td>
				<td align='right'>".number_format($r2->qty_apr)."</td>
				<td align='right'>".number_format($r2->qty_may)."</td>
				<td align='right'>".number_format($r2->qty_jun)."</td>
				<td align='right'>".number_format($r2->qty_jul)."</td>
				<td align='right'>".number_format($r2->qty_aug)."</td>
				<td align='right'>".number_format($r2->qty_sep)."</td>
				<td align='right'>".number_format($r2->qty_oct)."</td>
				<td align='right'>".number_format($r2->qty_nov)."</td>
				<td align='right'>".number_format($r2->qty_dec)."</td>
				<td align='right'>".number_format($r2->qty_total)."</td>
				</tr>";
			echo "<tr><td>$item</td><td>$item_name</td><td>Sales Amount</td>
				<td align='right'>".number_format($r2->sale_jan)."</td>
				<td align='right'>".number_format($r2->sale_feb)."</td>
				<td align='right'>".number_format($r2->sale_mar)."</td>
				<td align='right'>".number_format($r2->sale_apr)."</td>
				<td align='right'>".number_format($r2->sale_may)."</td>
				<td align='right'>".number_format($r2->sale_jun)."</td>
				<td align='right'>".number_format($r2->sale_jul)."</td>
				<td align='right'>".number_format($r2->sale_aug)."</td>
				<td align='right'>".number_format($r2->sale_sep)."</td>
				<td align='right'>".number_format($r2->sale_oct)."</td>
				<td align='right'>".number_format($r2->sale_nov)."</td>
				<td align='right'>".number_format($r2->sale_dec)."</td>
				<td align='right'>".number_format($r2->sale_total)."</td>
				</tr>";
			echo "<tr><td>$item</td><td>$item_name</td><td>Cost</td>
				<td align='right'>".number_format($r2->cost_jan)."</td>
				<td align='right'>".number_format($r2->cost_feb)."</td>
				<td align='right'>".number_format($r2->cost_mar)."</td>
				<td align='right'>".number_format($r2->cost_apr)."</td>
				<td align='right'>".number_format($r2->cost_may)."</td>
				<td align='right'>".number_format($r2->cost_jun)."</td>
				<td align='right'>".number_format($r2->cost_jul)."</td>
				<td align='right'>".number_format($r2->cost_aug)."</td>
				<td align='right'>".number_format($r2->cost_sep)."</td>
				<td align='right'>".number_format($r2->cost_oct)."</td>
				<td align='right'>".number_format($r2->cost_nov)."</td>
				<td align='right'>".number_format($r2->cost_dec)."</td>
				<td align='right'>".number_format($r2->cost_total)."</td>
				</tr>";
			echo "<tr><td>$item</td><td>$item_name</td><td>Profit</td>
				<td align='right'>".number_format($r2->profit_jan)."</td>
				<td align='right'>".number_format($r2->profit_feb)."</td>
				<td align='right'>".number_format($r2->profit_mar)."</td>
				<td align='right'>".number_format($r2->profit_apr)."</td>
				<td align='right'>".number_format($r2->profit_may)."</td>
				<td align='right'>".number_format($r2->profit_jun)."</td>
				<td align='right'>".number_format($r2->profit_jul)."</td>
				<td align='right'>".number_format($r2->profit_aug)."</td>
				<td align='right'>".number_format($r2->profit_sep)."</td>
				<td align='right'>".number_format($r2->profit_oct)."</td>
				<td align='right'>".number_format($r2->profit_nov)."</td>
				<td align='right'>".number_format($r2->profit_dec)."</td>
				<td align='right'>".number_format($r2->profit_total)."</td>
				</tr>";

			}
																
		}
	}
} 
$content="";
$sql="select item_number,description from inventory ";
$sql.=" order by item_number";

echo "<h1>RUGI LABA PENJUALAN PER ITEM BULANAN</LEGED></h1>";
echo "<p>Periode: $date1 to $date2 </p>";

echo "<table border=1><tr>
<th>Item</th><th>Description</th><th>Keterangan</th>
<th align='right'>Jan</th><th align='right'>Feb</th><th align='right'>Mar</th>
<th align='right'>Apr</th><th align='right'>May</th><th align='right'>Jun</th>
<th align='right'>Jul</th><th align='right'>Aug</th><th align='right'>Sep</th>
<th align='right'>Oct</th><th align='right'>Nov</th><th align='right'>Dec</th>
<th align='right'>Total</th>
</tr>";
if($q=$CI->db->query($sql)){
	foreach($q->result() as $r){
		sales_qty($r->item_number,$r->description,$date1,$date2);
	}
}
echo "</table>";

$data['content']=''; 
$data['caption']='';
echo load_view('simple_print.php',$data);    

?>
