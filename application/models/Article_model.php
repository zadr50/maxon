<?php
class Article_model extends CI_Model {

private $primary_key='doc_name';
private $table_name='articles';

function __construct(){
	parent::__construct();        
      
}
	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
                $nama='';
                if(isset($_GET['nama'])){
                    $nama=$_GET['nama'];
                }
                if($nama!='')$this->db->where("category like '%$nama%'");

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
		return $this->db->get($this->table_name);		 
	}
	function save($data){
		$data['date_post']= date( 'Y-m-d H:i:s', strtotime($data['date_post']));
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		unset($data['id']);
		$data['date_post']= date( 'Y-m-d H:i:s', strtotime($data['date_post']));
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function categories(){
		$cats=null;
		$i=0;
		if($q=$this->db->query("select distinct category 
			from articles a group by category")){
			foreach($q->result() as $row){
				$cnt=$this->db->query("select count(1) as cnt 
				from articles where category='".$row->category."'")->row()->cnt;
				$cats[$i]=array($row->category,$cnt);
				$i++;
			}
		}
		return $cats;
	}

}
