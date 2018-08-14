<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Tarif extends CI_Controller {
    private $limit=100;
    private $table_name='tarif_zone';
    private $file_view='courier/tarif';
    private $controller='courier/tarif';
    private $primary_key='id';
    private $sql="";
	private $title="DAFTAR TARIF ZONE";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->model(array('courier/tarif_model','courier/zone_model',
            'courier/booking_dom_model'));
        
		$this->load->library(array('sysvar','template','form_validation'));

		$this->sql="select * from tarif_zone";
		if($this->help=="")$this->help=$this->table_name;
    }
	function nomor_bukti($add=false) {
		$key="Book Dom Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!BKD~$000001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!BKD~$000001');
				$rst=$this->booking_dom_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}

	
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
		$data=data_table($this->table_name,$record);
        $data['mode']='add';
        $data['title']=$this->title;
        $data['help']=$this->help;
        $data['message']='';
        $data['form_controller']=$this->controller;
        $data['field_key']=$this->primary_key;
		if($record) {
            $data['update_by']=user_id();
            $data['update_date']=date("Y-m-d H:i:s");            
		} else {
            $data['create_by']=user_id();
            $data['create_date']=date("Y-m-d H:i:s");
		}
        $data['lov_zone_to']=$this->list_of_values->render(
            array("dlgBindId"=>"zone",
                "dlgRetFunc"=>"$('#zone_to').val(row.code);",
                "dlgCols"=>array(
                    array("fieldname"=>"zone_name","caption"=>"Zone","width"=>"100px"),
                    array("fieldname"=>"code","caption"=>"Code")
                    )
            )
        );        
        $data['lov_service']=$this->list_of_values->render(
            array("dlgBindId"=>"service","sysvar_lookup"=>"service")        
        );
        $data['lov_customer']=$this->list_of_values->render(
            array("dlgBindId"=>"customers",
                "dlgRetFunc"=>"$('#cust_no').val(row.customer_number);
                    $('#nama_cust').html(row.company);",
                "dlgCols"=>array(
                    array("fieldname"=>"company","caption"=>"Nama","width"=>"100px"),
                    array("fieldname"=>"customer_number","caption"=>"Code")
                    )
            )
        );        
        $data['lov_service2']=$this->list_of_values->render(
            array("dlgBindId"=>"service2","sysvar_lookup"=>"service")        
        );
        
		return $data;
    }
    function index(){
		$this->browse();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add()   {
		$data=$this->set_defaults();
		$this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['data']=$data;
			$this->tarif_model->save($data);
			$data['message']='update success';
			$data['mode']='view';
			$this->browse();
		} else {
			$data['data']=$data;
			$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
		$id=urldecode($data['id']);
		$mode=$data["mode"];	
		unset($data['mode']);
		if($mode=="add"){
			$ok=$this->tarif_model->save($data);            
            $id=$this->tarif_model->id;
		} else {
			$ok=$this->tarif_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true,"id"=>$id));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
		
	}	
    function view($id,$show_tool=true)	{
		$id=urldecode($id);
		$data[$this->primary_key]=$id;
		$model=$this->tarif_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);				
		$data['mode']='edit';
		$data['show_tool']=$show_tool;
		$this->template->display_form_input($this->file_view,$data);
    }
    function _set_rules(){}
    function valid_date($str){
     if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str)){
             $this->form_validation->set_message('valid_date',
             'date format is not valid. yyyy-mm-dd');
             return false;
     } else {
            return true;
     }
    }
   function browse($offset=0,$limit=50,$order_column="",$order_type='asc'){
		if($order_column=="")$order_column=$this->primary_key;
		$data['controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Tujuan","sid_nama");
		$faa[]=criteria("Service","sid_servie");
		$data['criteria']=$faa;
		$data['fields_caption']=array('Zone To','Service',
		      'Darat Wg','Laut Wg',"Udara Wg","Darat Vol","Laut Vol","Udara Vol");
		$data['fields']=array('zone_to','service','tarif','tarif_laut',
            'tarif_udara','tarif_darat_vol','tarif_udara_vol','tarif_laut_vol');
		$data['msg_left']="<i>Silahkan  isi criteria pencetakan...</i>";
        $data['fields_format_numeric']=array("tarif","tarif_laut","tarif_udara",
            "tarif_darat_vol","tarif_udara_vol","tarif_laut_vol");
				
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		$sql=$this->sql." where 1=1";
		$tujuan=urldecode($this->input->get('sid_nama'));        
        $service=$this->input->post("sid_service");
        $via=$this->input->post("sid_via");
		if($tujuan!='')$sql.=" and zone_to like '$tujuan%'";
		if($service!="")$sql .= " and service='$service'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
		if($this->tarif_model->delete($id)){
			$this->browse();
		} else {
			show_error("Tidak bisa dihapus !");		
		}		
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $this->table_name where zone_to='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function items($cmd="",$id=''){
		if ($cmd=="save") {
			$this->add_item();
		} else if($cmd=="delete") {
			$this->db->where("id",$id)->delete("tarif_zone");
            $data['success']=true;
            echo json_encode($data);
            
		} else if ($cmd=="view") {
			if($row=$this->db->where("id",$id)
				->get("tarif_zone")->row()){
				$data=(array)$row;
				$data['success']=true;
				echo json_encode($data);
			}				
			
		} else {
		    $id=$cmd;		    
			$sql="select * from tarif_zone where id='$id'";
			echo datasource($sql);
		}
	}
	function add_item(){
		$data=$this->input->post();		
		$id=$data['id'];
        unset($data['id']);
		$data['book_no']=$data['book_no'];
		if($id==""){
			$ok=$this->db->insert('booking_dom_detail',$data);
            $id=$this->db->insert_id();
		} else {
			$ok=$this->db->where("id",$id)->update('booking_dom_detail',$data);
		}
		if($ok){
			echo json_encode(array("success"=>true,"id"=>$id));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
	}
    function get_tarif(){
        $data=$this->input->post();
        $zone_from=$this->zone_model->get_by_kecamatan($data["origin"]);
        $zone_to=$this->zone_model->get_by_kecamatan($data["destination"]);
        
        if($zone_to!=""){
            $data_ret=$this->tarif_model->get_tarif($zone_to,$data["service"],
                $data["ship_type"],$data["sender"],$data["plt_ratio"]);
            $data_ret["jenis_biaya"]="BERAT";
            if($data['plt_ratio']>0)$data_ret["jenis_biaya"]="VOLUME";
        } else {
            $data_ret['tarif']=0;
            $data_ret['tarif_volume']=0;
            $data_ret['jenis_biaya']="BERAT";            
        }
        echo json_encode(array("success"=>true,"data"=>(object)$data_ret));
    }
    function customer($cmd,$id="",$extra=""){
        if($cmd=="load"){
            $s="select a.*,c.company as cust_name from customer_rate a 
                left join customers c 
                on a.cust_no=c.customer_number where a.zone='$id'";
            if($extra!="")$s.=" and c.company like '$extra%'";
            echo datasource($s);
        }
        if($cmd=="load_by_cust_no"){
            $s="select a.*,c.company as cust_name from customer_rate a 
                left join customers c 
                on a.cust_no=c.customer_number where a.cust_no='$id'";
            echo datasource($s);
        }
        
        if($cmd=="delete"){
            $ok=$this->db->where("id",$id)->delete("customer_rate");
            echo json_encode(array("success"=>$ok,"msg"=>$ok?"Success":"Not Success"));
        }
        if($cmd=="save"){
            $zone=urldecode($id);
            $data=$this->input->post();
            $data['zone']=$zone;
            $data['rate']=$data['darat_wg'];
            unset($data['darat_wg']);
            $id=$data["id"];
            unset($data["id"]);
            $cust_no=$data["cust_no"];
            if($id=="" || $id==0){
                $ok=$this->db->insert("customer_rate",$data);
            } else {
                $ok=$this->db->where("id",$id)->update("customer_rate",$data);
            }
            echo json_encode(array("success"=>$ok,"msg"=>$ok?"Success":"Not Success"));
        }
    }
}
?>
