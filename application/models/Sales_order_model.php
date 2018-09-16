<?php
class Sales_order_model extends CI_Model 
{
	private $primary_key='sales_order_number';
	private $table_name='sales_order';
	public $amount_paid=0;
	public $saldo=0;
	public $amount=0;
	public $sub_total=0;
	public $disc_amount_1=0;
	public $tax=0;
	private $sql="select s.sales_order_number,s.sales_date,s.sold_to_customer,
	c.company,s.amount 
	from sales_order_number";
	function __construct(){
		parent::__construct();        
         
        
	}
	function amount(){return $this->amount;}  
	function recalc($nomor){
	     
		$this->load->model('sales_order_lineitems_model');
	    $this->sub_total=$this->sales_order_lineitems_model->total_amount($nomor);

    	$so=$this->get_by_id($nomor)->row();
		$disc_amount=0;
		$tax_amount=0;
		
		if($so){
			$disc_amount=$so->discount*$this->sub_total;
			$this->disc_amount_1=$disc_amount;
			$this->amount=$this->sub_total-$disc_amount;
			$tax_amount=$so->sales_tax_percent*$this->amount;
			
			$this->tax=$tax_amount;
			
			$this->amount=$this->amount+$tax_amount;
			$this->amount=$this->amount+$so->freight;
			$this->amount=$this->amount+$so->other;
		}

		$this->db->where($this->primary_key,$nomor);
		$this->db->update($this->table_name,array('amount'=>$this->amount,
		'subtotal'=>$this->sub_total,'disc_amount_1'=>$disc_amount,'tax'=>$tax_amount));
		
	    $this->load->model('payment_model');
	    $this->amount_paid=$this->payment_model->total_amount($nomor);
	    $this->saldo= $this->amount-$this->amount_paid;
		
	    return $this->saldo;
	}
	
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')
	{
	    $nama=$this->input->get('nama');
		$sql=$this->sql;
		if($nama!='')$sql.=" where c.company like '%$nama%'";
		if($order_column!=''){
			$sql.=" order_by $order_column";
			$sql.=" $order_type ";
		}
	    return $this->db->query($sql,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function get_salesman($so_number){
		$salesman='';
		if($row=$this->db->query("select salesman from sales_order 
			where sales_order_number='$so_number'")->row()){
				$salesman=$row->salesman;
			}
		return $salesman;
	}
	function save($data){
		$data['delivered']=='1'?$data['delivered']=true:$data['delivered']=false;
		$data['sales_date']= date( 'Y-m-d H:i:s', strtotime($data['sales_date']));
		$data['due_date']= date( 'Y-m-d H:i:s', strtotime($data['due_date']));
        if(!isset($data['warehouse_code']))$data['warehouse_code']=current_gudang();
        
		return $this->db->insert($this->table_name,$data);
		//return $this->db->insert_id();
	}
	function update($id,$data){
		$data['delivered']=='1'?$data['delivered']=true:$data['delivered']=false;
		$data['sales_date']= date( 'Y-m-d H:i:s', strtotime($data['sales_date']));
		$data['due_date']= date( 'Y-m-d H:i:s', strtotime($data['due_date']));
        if(!isset($data['warehouse_code']))$data['warehouse_code']=current_gudang();

		$this->db->where($this->primary_key,$id);
		return $this->db->update($this->table_name,$data);
	}
	function delete($id){
	  	$this->db->where($this->primary_key,$id);
		$this->db->delete('sales_order_lineitems');        
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
     function add_item($id,$item,$qty){
        $sql="select description,retail,cost,unit_of_measure
            from inventory where item_number='".$item."'";
        
        $query=$this->db->query($sql);
        $row = $query->row_array(); 
         
        $data = array('sales_order_number' => $id, 'item_number' => $item, 
            'quantity' => $qty,'description'=>$row['description'],
            'price' => $row['retail'],'amount'=>$row['retail']*$qty,
            'unit'=>$row['unit_of_measure']
            );
        $str = $this->db->insert_string('sales_order_lineitems', $data);
        $query=$this->db->query($str);
		$this->recalc($id);
    }
    function del_item($line){
        $query=$this->db->query("delete from sales_order_lineitems where line_number=".$line);
    }  	 
	function select_list_not_delivered(){
       	$query=$this->db->query("select sales_order_number from sales_order where (delivered=false or delivered is null)");
        $ret=array();$ret['']='- Select -';
        foreach ($query->result() as $row){$ret[$row->sales_order_number]=$row->sales_order_number;}		 
        return $ret;
	}
	function recalc_ship_qty($nomor_so) {
	
		$s="update  sales_order_lineitems 
			left join (

			select from_line_number,sum(quantity) as qty_do
			from invoice_lineitems il
			where from_line_doc='$nomor_so' 
			group by from_line_number

			) ip
			on ip.from_line_number=sales_order_lineitems.line_number 

			set ship_qty=qty_do 

			where sales_order_lineitems.sales_order_number='$nomor_so'";
			
		$this->db->query($s);
		
		
		$s="update sales_order_lineitems set shipped=true where quantity=ship_qty 
		and sales_order_number='$nomor_so'";
		$this->db->query($s);

		$s="update sales_order_lineitems set shipped=false where quantity=ship_qty 
		and sales_order_number='$nomor_so'";
		$this->db->query($s);
		
		$s="select i.invoice_date from invoice i 
		where invoice_type='D' and sales_order_number='$nomor_so'
		order by invoice_date desc  limit 1";
		$ship_date='1970-01-01';
		if($q=$this->db->query($s)->row()){
			$ship_date=$q->invoice_date;
		}
		$delivered=0;
		$rstatus=$this->db->select("status")->where("sales_order_number",$nomor_so)
			->get("sales_order")->row();
		if($rstatus){
			$status=$rstatus->status;
		} else {
			$status="0";
		}
		if ($q=$this->db->select("sum(quantity) as z_qty,
		sum(ship_qty) as z_ship_qty")->where("sales_order_number",$nomor_so)
		->get("sales_order_lineitems")) {
			if($r=$q->row()){
				if($r->z_ship_qty>=$r->z_qty){
					$delivered=1;
					$status="2";
				}
			}
		}
		$s="update sales_order set delivered='$delivered',
		ship_date='$ship_date',status='$status' 
		where  sales_order_number='$nomor_so'";
		
		$this->db->query($s);
		
	}
	function nomor_bukti($add=false)
	{
		$key="Sales Order Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!SO~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!SO~$00001');
				$rst=$this->sales_order_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}
	function list_so_new($d1,$d2){
		$sql="select so.sales_order_number,so.sales_date,so.sold_to_customer,
			c.company,sol.item_number,sol.description,sol.quantity
			from sales_order so left join sales_order_lineitems sol 
			on so.sales_order_number=sol.sales_order_number 
			left join customers c on c.customer_number=so.sold_to_customer
			where so.sales_date between '$d1' and '$d2' 
			and (so.status is null  or so.status=0)";
		return $this->db->query($sql);
	}
	
}
