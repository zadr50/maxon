<?php
class Inventory_moving_model extends CI_Model {

private $primary_key='transfer_id';
private $table_name='inventory_moving';
public $amount=0;

function __construct(){
	parent::__construct();        
	$this->load->model("inventory_prices_model");
	$this->load->model('company_model');
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
		if (empty($order_column)||empty($order_type))
		$this->db->order_by($this->primary_key,'asc');
		else
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
        $this->transfer_id=$id;
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		$data['date_trans']= date( 'Y-m-d H:i:s', strtotime($data['date_trans']));
	// apabila default satuan tidak sama dg inputan 
		$lFoundOnPrice=false;
		$item=null;
		$item_number=$data['item_number'];
		if($q=$this->db->query("select unit_of_measure,cost_from_mfg,cost from inventory where item_number='$item_number'")){
			$item=$q->row();
		}
		if($item){
			if($item->unit_of_measure!=$data['unit']) {
				if($unit_price=$this->inventory_prices_model->get_by_id($data['item_number'],
					$data['unit'])->row())
				{
					 
					$lFoundOnPrice=true;
					if($unit_price->quantity_high>0) $data['mu_qty']=$data['to_qty']*$unit_price->quantity_high;
					$data['mu_price']=$item->cost_from_mfg;
					if($data['mu_price']==0)$data['mu_price']=$item->cost;			
					$data['multi_unit']=$item->unit_of_measure;			
				}
			}
		}
		if($unit=exist_unit($data['unit']) && !$lFoundOnPrice ){
			$lFoundOnPrice=true;
			$data['mu_qty']=$data['to_qty']*$unit['unit_value'];
			$data['mu_price']=item_cost($data['item_number']);
			$data['multi_unit']=$unit['from_unit'];					
		} 
		if(!$lFoundOnPrice || !isset($data["mu_qty"])){
			$data['mu_qty']=$data['to_qty'];
			$data['mu_price']=$data['cost'];
			$data['multi_unit']=$data['unit'];
		}	

		$data['total_amount']=floatval($data['to_qty'])*floatval($data['cost']);
        $data['create_by']=user_id();
        $data['create_date']=date( 'Y-m-d H:i:s');
		
				
		
		$ok=$this->db->insert($this->table_name,$data);
        $item_no=$data['item_number']; item_need_update($item_no);
		return $ok;
		//$this->db->insert_id();
	}
	function update($id,$data){
		$data['date_trans']= date( 'Y-m-d H:i:s', strtotime($data['date_trans']));
		$this->db->where("id",$id);
        $item_no=$data['item_number']; item_need_update($item_no);
		if($data['mu_qty']==""){
			$data['mu_qty']=$data["to_qty"];
			$data['multi_unit']=$data['unit'];	
			if($data['mu_qty']==0)$data['mu_qty']=1;
		}
		return $this->db->where("id",$id)->update($this->table_name,$data);
	}
	function delete($id){
	    $id=urldecode($id);
	    $this->db->query("insert into zzz_item_need_update(item_no) 
	       select item_number from inventory_moving where transfer_id='$id'");
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
		$this->db->where('transfer_id',$id);
		$this->db->delete('inventory_moving');
        
	}

	function add_item($data){
            $this->db->insert('inventory_moving',$data);
            return $this->db->insert_id();
    } 			
	function nomor_bukti($add=false)
	{
		$key="Transfer Stock Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!TRX~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!TRX~$00001');
				$rst=$this->inventory_moving_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}
	function list_trx_new($d1,$d2){
		$sql="select im.transfer_id,im.date_trans,im.from_location,
			im.to_location, im.item_number,i.description, 
			im.from_qty 
			from inventory_moving im left join inventory i on i.item_number=im.item_number 
			where im.from_location<>im.to_location and im.date_trans between '$d1' and '$d2' 
			and (im.status is null or im.status=0)";
		return $this->db->query($sql);
	}
	function delete_item($id){
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	function unposting($transfer_id){
		$this->load->model("jurnal_model");		
        $sql="update inventory_moving set posted=0 where transfer_id='$transfer_id'";
        $this->db->query($sql);	    
        $this->jurnal_model->unposting($transfer_id);
	    return true;
	}
	function posting($transfer_id){
		$this->load->model("jurnal_model");
	    $retval=false;
	    $total=0;
		$date="";
		$cogs_setting=$this->company_model->setting("inventory_cogs");
		$inv_setting=$this->company_model->setting("inventory");
		$gl_id="";
	    if($q=$this->db->where("transfer_id",$transfer_id)->get($this->table_name)){
	        foreach($q->result() as $row){
	            $inv=0;
                $cogs=0;
                if($gl_id=="") $gl_id=$row->transfer_id;
                if($date=="")$data=$row->date_trans;                
                $amount=$row->total_amount;
				if($amount==0){
	                if($qinv=$this->inventory_model->get_by_id($row->item_number)){
	                    if($rinv=$qinv->row()){
	                        $inv=$rinv->inventory_account;
	                        $cogs=$rinv->cogs_account;
	                        if($total==0){
	                            $amount=$rinv->cost*$row->to_qty;
	                        }
	                        if($total==0){
	                            $amount=$rinv->cost_from_mfg*$row->to_qty;
	                        }
	                    }
	                }
					
				}
                if($row->cost_account!="" || $row->cost_account!="0"){
                    $cogs=$row->cost_account;
                }
                
                if($cogs==0 || $cogs==""){
                    $cogs=$cogs_setting;
                }
                if($inv==0 || $inv==""){
                    $inv=$inv_setting;                    
                }
                $total+=$amount;
                $account_id=$inv;
                $debit=$amount;
                $credit=0;
                $operation="Mutasi Stock Inventory";
                $source=$row->comments;
                $cid=cid();
                $ref=$row->item_number;
                
                $this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,
                    $source,$cid,$ref);
                    
                $account_id=$cogs;
                $debit=0;
                $credit=$amount;
                
                $operation="Mutasi Stock Cogs";
                $this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,
                    $source,$cid,$ref);
                    
                $retval=true;    
                    
	        }
	    }
        $sql="update inventory_moving set posted=1 where transfer_id='$transfer_id'";
        $this->db->query($sql);
	    return $retval;
	}
	
	
}
