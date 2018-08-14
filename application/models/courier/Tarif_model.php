<?php
class Tarif_model extends CI_Model {

	private $primary_key='id';
	private $table_name='tarif_zone';
    public $id=0;
    
	function __construct(){
		parent::__construct();        
        
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['zone_to']))$nama=$_GET['zone_to'];
		if($nama!='')$this->db->where("zone_to like '%$nama%'");
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
		$lok=$this->db->insert($this->table_name,$data);
        $this->id=$this->db->insert_id();
		return $lok;
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
        $this->id=$id;
		return $ok;
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
    function get_tarif($zone_to,$service,$ship_type,$sender,$plt_ratio){
        $s="select * from tarif_zone where zone_to='$zone_to' and service='$service'";
        $data=sqlinto($s);
        $ret["tarif"]=0;
        if($data){
            if($ship_type==1){
                $ret["tarif"]=$data["tarif_laut"];
                $ret["tarif_vol"]=$data["tarif_laut_vol"];
            } else if ($ship_type==2){
                $ret["tarif"]=$data["tarif_udara"];
                $ret["tarif_vol"]=$data["tarif_udara_vol"];
            } else {
                $ret["tarif"]=$data["tarif"];
                $ret["tarif_vol"]=$data["tarif_darat_vol"];
            }
            
        }
        $tarif_cust=sqlinto("select * from customer_rate where zone='$zone_to' 
            and service='$service'");
        if($tarif_cust){
            $tarif_wg=0;
            $tarif_vol=0;
            if($ship_type==1){
                $tarif_wg=$tarif_cust["laut_wg"];
                $tarif_vol=$tarif_cust["laut_vol"];
            } else if ($ship_type==2){
                $tarif_wg=$tarif_cust["udara_wg"];
                $tarf_vol=$tarif_cust["udara_vol"];
             
            } else {
                $tarif_wg=$tarif_cust["rate"];
                $tarif_vol=$tarif_cust["darat_vol"];
            }
            if($tarif_wg>0)$ret["tarif"]=$tarif_wg;
            if($tarif_vol>0)$ret["tarif_vol"]=$tarif_vol;
        }
        return $ret;
    }    
}

?>
