<?php
class Inventory_products_model extends CI_Model {

private $primary_key='shipment_id';
private $table_name='inventory_products';

    function __construct(){
    	parent::__construct();               
        $this->load->model("inventory_model");
        $this->load->model("inventory_prices_model");
        $this->load->model("jurnal_model");
        $this->load->model("company_model");
    }
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		$itemno=$data['item_number'];
		$item=$this->inventory_model->get_by_id($itemno)->row();
		if($item){			 
			if(trim($data['unit'])=="") $data['unit']=$item->unit_of_measure;
			if($data['cost']=="") $data['cost']=$item->cost;
			if($data['cost']==0) $data['cost']=$item->cost;
		}

		$data['date_received']= date( 'Y-m-d H:i:s', strtotime($data['date_received']));
		
		// apabila default satuan tidak sama dg inputan 
		$lFoundOnPrice=false;
		if($item){
			if($item->unit_of_measure!=$data['unit']) {
				if($unit_price=$this->inventory_prices_model->get_by_id($data['item_number'],
					$data['unit'])->row())
				{
					 
					$lFoundOnPrice=true;
					if($unit_price->quantity_high>0) $data['mu_qty']=$data['quantity_received']*$unit_price->quantity_high;
					$data['mu_price']=$item->cost_from_mfg;
					if($data['mu_price']==0)$data['mu_price']=$item->cost;			
					$data['multi_unit']=$item->unit_of_measure;			
				}
			}
		}
		if($unit=exist_unit($data['unit']) && !$lFoundOnPrice ){
			$lFoundOnPrice=true;
			$data['mu_qty']=$data['quantity_received']*$unit['unit_value'];
			$data['mu_price']=item_cost($data['item_number']);
			$data['multi_unit']=$unit['from_unit'];					
		} 
		if(!$lFoundOnPrice || !isset($data["mu_qty"])){
			$data['mu_qty']=$data['quantity_received'];
			$data['mu_price']=$data['cost'];
			$data['multi_unit']=$data['unit'];
		}	

		$data['total_amount']=floatval($data['quantity_received'])*floatval($data['cost']);
        $data['create_by']=user_id();
        $data['create_date']=date( 'Y-m-d H:i:s');
		$ok=$this->db->insert($this->table_name,$data);
        
        $item_no=$data['item_number']; 
        item_need_update($item_no);
		//return $this->db->insert_id();
        return $ok;
	}
    function update_header($id,$data){
        if(isset($data['cost_account'])){
            $data['cost_account']=account_id($data['cost_account']);
        }
        $data['date_received']= date( 'Y-m-d H:i:s', strtotime($data['date_received']));
        return $this->db->where("shipment_id",$id)->update($this->table_name,$data);
        
    }
	function update($id,$data){
		$itemno=$data['item_number'];
		$item=$this->inventory_model->get_by_id($itemno)->row();
		if($item){			 
			 
			if(trim($data['unit'])=="") $data['unit']=$item->unit_of_measure;
			if($data['cost']=="") $data['cost']=$item->cost;
			if($data['cost']=="0") $data['cost']=$item->cost;
		}
		
		$data['date_received']= date( 'Y-m-d H:i:s', strtotime($data['date_received']));
		// apabila default satuan tidak sama dg inputan 
		$lFoundOnPrice=false;
		if($item){
			if($item->unit_of_measure!=$data['unit']) {
				if($unit_price=$this->inventory_prices_model->get_by_id($data['item_number'],
					$data['unit'])->row())
				{
					$lFoundOnPrice=true;
					if($unit_price->quantity_high>0) $data['mu_qty']=$data['quantity_received']*$unit_price->quantity_high;
					$data['mu_price']=$item->cost_from_mfg;
					if($data['mu_price']==0)$data['mu_price']=$item->cost;			
					$data['multi_unit']=$item->unit_of_measure;			
				}
			}
		}
		if($unit=exist_unit($data['unit']) && !$lFoundOnPrice ){
			$lFoundOnPrice=true;
			$data['mu_qty']=$data['quantity_received']*$unit['unit_value'];
			$data['mu_price']=item_cost($data['item_number']);
			$data['multi_unit']=$unit['from_unit'];					
		} 
		if(!$lFoundOnPrice){
			$data['mu_qty']=$data['quantity_received'];
			$data['mu_price']=$data['cost'];
			$data['multi_unit']=$data['unit'];
		}	
		$data['total_amount']=floatval($data['quantity_received'])*floatval($data['cost']);
        $data['update_by']=user_id();
        $data['update_date']=date( 'Y-m-d H:i:s');

        $item_no=$data['item_number']; item_need_update($item_no);
        
		$this->db->where("id",$id);
		return $this->db->update($this->table_name,$data);
	}
	function validate_delete_receive_po($nomor_receive)
	{
		$cnt=$this->db->query("select count(1) as cnt from purchase_order_lineitems pol
			join inventory_products ip on ip.id=pol.from_line_number
			where ip.shipment_id='$nomor_receive'")->row()->cnt;
		if(intval($cnt)>0) {
			return false;
		} else {
			return true;
		}
	}
	function has_invoice($shipment_id){
		return $this->validate_delete_receive_po($shipment_id);
	}
	function delete($id){
        $item_no=$id; item_need_update($item_no);
	    
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function delete_by_id($id){
		$this->db->where('id',$id);
		$this->db->delete($this->table_name);
	}
	function delete_item($id){
		$this->db->where('id',$id);
		return $this->db->delete($this->table_name);
	}
	function list_receive($purchase_order_number)
	{
		$query=$this->db->query("select distinct shipment_id,
			date_received,warehouse_code,receipt_by 
			from inventory_products
			where receipt_type='PO' 
			and purchase_order_number='$purchase_order_number'");
		return $query;
	}
	function unposting($shipment_id){
        $sql="update inventory_products set posted=0 where shipment_id='$shipment_id'";
        $this->db->query($sql);	    
        $this->jurnal_model->unposting($shipment_id);
	    return true;
	}
	function posting($shipment_id){
	    $retval=false;
	    $total=0;
	    if($q=$this->db->where("shipment_id",$shipment_id)->get($this->table_name)){
	        foreach($q->result() as $row){
	            $inv=0;
                $cogs=0;
                $amount=$row->total_amount;
                if($qinv=$this->inventory_model->get_by_id($row->item_number)){
                    if($rinv=$qinv->row()){
                        $inv=$rinv->inventory_account;
                        $cogs=$rinv->cogs_account;
                        if($total==0){
                            $amount=$rinv->cost*$row->quantity_received;
                        }
                        if($total==0){
                            $amount=$rinv->cost_from_mfg*$row->quantity_received;
                        }
                    }
                }
                if($row->ref1!="" || $row->ref1!="0"){
                    $cogs=$row->ref1;
                }
                if($cogs=="")$cogs=0;
                if($inv=="")$inv=0;
                
                if($cogs==0){
                    $cogs=$this->company_model->setting("inventory_cogs");
                }
                if($inv==0){
                    $inv=$this->company_model->setting("inventory");                    
                }
                $total+=$amount;
                $gl_id=$row->shipment_id;
                $account_id=$inv;
                $debit=$amount;
                $credit=0;
				if($row->receipt_type=="ETC_OUT"){
					$debit=0;
					$credit=$amount;					
				}
                $operation="Posting $row->receipt_type";
                $source=$row->comments;
                $cid=cid();
                $ref=$row->item_number;
                
                $this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,
                    $source,$cid="",$ref="");
                    
                $account_id=$cogs;
                $debit=0;
                $credit=$amount;
				if($row->receipt_type=="ETC_OUT"){
					$debit=$amount;
					$credit=0;					
				}
                
                $this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,
                    $source,$cid="",$ref="");
                    
                $retval=true;    
                    
	        }
	    }
        $sql="update inventory_products set posted=1 where shipment_id='$shipment_id'";
        $this->db->query($sql);
	    return $retval;
	}

}
?>