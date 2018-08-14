<?php
class Booking_dom_model extends CI_Model {

	private $primary_key='book_no';
	private $table_name='booking_dom';
    private $book_no='';

	function __construct(){
		parent::__construct();        
        
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['customer']))$nama=$_GET['customer'];
		if($nama!='')$this->db->where("customer like '%$nama%'");
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
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->get($this->table_name);
		return $ok;
	}
	function save($data){
	    $this->book_no=$data['book_no'];
        $data["tarif_berat"]=c_($data["tarif_berat"]);
        $data["tarif_volume"]=c_($data["tarif_volume"]);        
		$lok=$this->db->insert($this->table_name,$data);
		return $lok;
	}
	function update($id,$data){
        $this->book_no=$id;
        //$data["tarif_berat"]=c_($data["tarif_berat"]);
        ///$data["tarif_volume"]=c_($data["tarif_volume"]);
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		return $ok;
	}
	function delete($id){
	    $this->db->where("book_no",$id)->delete("booking_dom_detail");
		$this->db->where($this->primary_key,$id);        
		return $this->db->delete($this->table_name);
	}
    function items($id){
        $this->db->where("book_no",$id);
        return $this->db->get("booking_dom_detail");
    }
    function recalc($id){
        $content="";
        $dimension="";
        $this->book_no=$id;
        $s="select sum(qty) as z_qty,sum(weight) as z_weight,sum(v) as z_vol, 
            sum(total_berat) as z_weight_amt,sum(total_volume) as z_vol_amount,
            sum(biaya) as z_biaya 
            from booking_dom_detail 
            where book_no='$this->book_no'";
        $book=$this->db->query($s)->row();
        
        $s="select item,dimension from booking_dom_detail where item<>'' 
            and book_no='$id' limit 1";
        if($q=$this->db->query($s)){
            if($item=$q->row()){
                $content=$item->item;
                $dimension=$item->dimension;
            }
        }
        $data['pcs']=$book->z_qty;
        $data['weight']=$book->z_weight;
        $data['volume']=$book->z_vol;
        $data['total_amount']=$book->z_biaya;
        
        $data['content']=$content;
        $data['dimension']=$dimension;
        
        $this->update($id,$data);        
    }
}

?>
