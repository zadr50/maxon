<?
$CI =& get_instance();
$CI->load->model('company_model');
$model=$CI->company_model->get_by_id($this->access->cid)->row();
$date1= date('Y-m-d H:i:s', strtotime($this->input->post('txtDateFrom')));
$date2= date('Y-m-d H:i:s', strtotime($this->input->post('txtDateTo')));
$category=$this->input->post('text1');
$supplier=$this->input->post('text2');
$sql="select s.category,ic.category as cat_name,il.item_number,il.description,
sum(il.amount) as amount_sale,sum(il.quantity) as qty_sales
from invoice i  
left join invoice_lineitems il on il.invoice_number=i.invoice_number
left join inventory s on s.item_number=il.item_number
left join suppliers sup on sup.supplier_number=s.supplier_number
left join inventory_categories ic on ic.kode=s.category
where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  
";
if($category!="")$sql.=" and s.category='$category'";
if($supplier!="")$sql.=" and s.supplier_number='$supplier'";
$sql.=" group by s.category,ic.category,il.item_number,il.description";
//$sql.=" limit (0,10)";
$sql.=" order by amount_sale desc";

$data['content']=browse_select( array('sql'=>$sql,'show_action'=>false,
    "fields_sum"=>array("amount_sale","qty_sales")  
    ));    
    
$data['caption']='TOP TEN SALES BY AMOUNT';
echo load_view('simple_print.php',$data);    

?>
