<?php
class Ticket_type_model extends CI_Model {

	private $primary_key="id";
	private $table_name='ticket_type';
	public $fields=null;
	public $message='';

	function __construct(){
		parent::__construct();
		$this->fields[]=array('name'=>'ticket_type','type'=>'nvarchar','size'=>50,'caption'=>"Jenis Ticket",'control'=>'text');
		$this->fields[]=array('name'=>'active','type'=>'int','size'=>50,'caption'=>"Aktif",'control'=>'text');
		$this->fields[]=array('name'=>'description','type'=>'nvarchar','size'=>250,'caption'=>"Keterangan",'control'=>'text');
		$this->fields[]=array('name'=>'price','type'=>'double','size'=>50,'caption'=>"Harga",'control'=>'text');
		$this->fields[]=array('name'=>'prc1','type'=>'real','size'=>50,'caption'=>"Percent",'control'=>'text');
		$this->fields[]=array('name'=>'coa1','type'=>'int','size'=>50,'caption'=>"Akun",'control'=>'text');
		$this->fields[]=array('name'=>'prc2','type'=>'real','size'=>50,'caption'=>"Percent",'control'=>'text');
		$this->fields[]=array('name'=>'coa2','type'=>'int','size'=>50,'caption'=>"Akun",'control'=>'text');
		$this->fields[]=array('name'=>'prc3','type'=>'real','size'=>50,'caption'=>"Percent",'control'=>'text');
		$this->fields[]=array('name'=>'coa3','type'=>'int','size'=>50,'caption'=>"Akun",'control'=>'text');
		$this->fields[]=array('name'=>'prc4','type'=>'real','size'=>50,'caption'=>"Percent",'control'=>'text');
		$this->fields[]=array('name'=>'coa4','type'=>'int','size'=>50,'caption'=>"Akun",'control'=>'text');
		$this->fields[]=array('name'=>'prc5','type'=>'real','size'=>50,'caption'=>"Percent",'control'=>'text');
		$this->fields[]=array('name'=>'coa5','type'=>'int','size'=>50,'caption'=>"Akun",'control'=>'text');
		$this->fields[]=array('name'=>'id','type'=>'int','size'=>50,'caption'=>"Akun",'control'=>'text');
		
		$this->load->model(array("jurnal_model","setting_model","bank_accounts_model"));
		
	}
	function message_text(){
		return $this->message;
	}
	function create_new_table(){
		$this->load->dbforge();
		if(!$this->db->table_exists($this->table_name)){	
			foreach($this->fields as $fld){
				$size="";$type=$fld['type'];
				if($fld['type']=="nvarchar")$size="(".$fld['size'].")";
				if($fld['name']=="id"){
					$type="";
				} else {
					$type =" ".$type.' '.$size;
				}
				$this->dbforge->add_field($fld['name'].$type);
			}
//			$this->dbforge->add_field("id");
//			$this->dbforge->add_key($this->primary_key,TRUE);
			$this->dbforge->create_table($this->table_name);
			
			//konversi dari system_variables
			$this->load->model("sysvar_model");
			if($q=$this->sysvar_model->get_by_varname("lookup.ticket_type")){
				foreach($q->result() as $r){
					$s="insert into ticket_type(ticket_type,active,description,price) 
					values('$r->varvalue','1','$r->varvalue','$r->keterangan')";
					$this->db->query($s);
				}
			}
		
		}	
		
	}
	function get_paged_list($limit=100,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
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
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		return $this->db->insert($this->table_name,$data);            
	}
	function update($id,$data){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return  $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$id=urldecode($id);
		$this->db->where($this->primary_key,$id);
		return $this->db->delete($this->table_name);
	}
	function lookup($param=null){
		$dlgBindId="ticket_type";
		$dlgRetFunc="$('#ticket_type').val(row.ticket_type);$('#price').val(row.price);";
		if($param){
			if(is_array($param)){
				if(isset($param['dlgRetFunc'])){
					$dlgRetFunc=$param['dlgRetFunc'];
				}
				if(isset($param['dlgBindId'])){
					$dlgBindId=$param['dlgBindId'];
				}
			}			
		}
        return $this->list_of_values->render(
	        array('dlgBindId'=>$dlgBindId,'dlgRetFunc'=>$dlgRetFunc,
	        'dlgCols'=>array( 
                    array("fieldname"=>"ticket_type","caption"=>"Jenis Ticket","width"=>"180px"),
                    array("fieldname"=>"price","caption"=>"Harga","width"=>"80px"),
                    array("fieldname"=>"id","caption"=>"Id","width"=>"80px")
                )
			)
		);          
		
	}
	
	
}