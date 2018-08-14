<?php
class Zone_model extends CI_Model {

	private $primary_key='id';
	private $table_name='zone';
    public $id=0;
    
	function __construct(){
		parent::__construct();        
      
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['zone']))$nama=$_GET['zone'];
		if($nama!='')$this->db->where("zone like '%$nama%'");
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
    function get_by_kecamatan($kec){
        //-- pertama cari kabupaten
        $s = "select kab from kecamatan where kec='$kec'";
        $data=sqlinto($s);
        $kab="";
        if($data)$kab=$data["kab"];
        //-- dari kabupaten cari zona
        $s = "select zone_code from zone_detail where city_name='$kab'";
        $data=sqlinto($s);      //'-- bisa jadi satu kota ada dua zone
        $zone="";
        if($data)$zone=$data["zone_code"];
         
        return $zone;        
    }
}

?>
