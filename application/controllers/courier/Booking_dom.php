<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Booking_dom extends CI_Controller {
    private $limit=100;
    private $table_name='booking_dom';
    private $file_view='courier/booking_dom';
    private $controller='courier/booking_dom';
    private $primary_key='book_no';
    private $sql="";
	private $title="DAFTAR BOOKING DOMESTIK";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->model('courier/booking_dom_model');
        $this->load->model(array('customer_model','courier/tarif_model'));
        
		$this->load->library(array('sysvar','template','form_validation'));

		$this->sql="select * from booking_dom";
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
            $data['book_no']="AUTO";
            $data['bk_date']=date("Y-m-d H:i:s");
            $data['create_by']=user_id();
            $data['create_date']=$data['bk_date'];
            $data['service']='REG';
            $data['thirdty_party']="DEF";
            $data['country']="ID";
            $data['shipping']=0;
            $data['sub_ship']=0;            
		}
        $data['lov_origin']=$this->list_of_values->render(
            array("dlgBindId"=>"kecamatan",
                "dlgRetFunc"=>"$('#origin').val(row.kec);calc_tarif();",
                "dlgCols"=>array(
                    array("fieldname"=>"kec","caption"=>"Kecamatan","width"=>"100px")
                    )
            )
        );        
        $data['lov_destination']=$this->list_of_values->render(
            array("dlgBindId"=>"kecamatan2",
                "dlgRetFunc"=>"$('#destination').val(row.kec);calc_tarif();",
                "dlgCols"=>array(
                    array("fieldname"=>"kec","caption"=>"Kecamatan","width"=>"100px")
                    )
            )
        );        
        $data['lov_service']=$this->list_of_values->render(
            array("dlgBindId"=>"service","sysvar_lookup"=>"service",
            "dlgRetFunc"=>"calc_tarif();")        
        );
        $data['lov_sender']=$this->list_of_values->render(
            array("dlgBindId"=>"customers",
                "dlgRetFunc"=>"$('#sender').val(row.customer_number);
                    $('#company').val(row.company);
                    $('#address1').val(row.street);
                    $('#address2').val(row.suite);
                    $('#country').val(row.country);
                    $('#city').val(row.city);
                    calc_tarif();",
                "dlgCols"=>array(
                array("fieldname"=>"company","caption"=>"Nama","width"=>"200px"),
                array("fieldname"=>"customer_number","caption"=>"Kode"),
                array("fieldname"=>"street","caption"=>'Alamat',"width"=>"300px"),
                array("fieldname"=>"city","caption"=>"Kota","width"=>"100px")
                )
            )
        );
        $data['lov_ship_type']=$this->list_of_values->render(
            array("dlgBindId"=>"ship_type","sysvar_lookup"=>"ship_type",
            "dlgRetFunc"=>"calc_tarif();")                
        );
        $data['lov_sub_ship']=$this->list_of_values->render(
            array("dlgBindId"=>"sub_ship","sysvar_lookup"=>"sub_ship")                
        );
        $data['lov_ce_name']=$this->list_of_values->render(
            array("dlgBindId"=>"customers2",
                "dlgRetFunc"=>"$('#ce_name').val(row.customer_number);
                    $('#ce_company').val(row.company);
                    $('#ce_address1').val(row.street);
                    $('#ce_address2').val(row.suite);
                    $('#ce_country').val(row.country);
                    $('#ce_city').val(row.city);",
                "dlgCols"=>array(
                array("fieldname"=>"company","caption"=>"Nama","width"=>"200px"),
                array("fieldname"=>"customer_number","caption"=>"Kode"),
                array("fieldname"=>"street","caption"=>'Alamat',"width"=>"300px"),
                array("fieldname"=>"city","caption"=>"Kota","width"=>"100px")
                )
            )
        
        );
        $data['lov_status']=$this->list_of_values->render(
            array("dlgBindId"=>"status","sysvar_lookup"=>"status_booking_dom")                        
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
			$this->booking_dom_model->save($data);
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
		$id=urldecode($data['book_no']);
		$mode=$data["mode"];	
		unset($data['mode']);
		if($mode=="add"){
		    $data['book_no']=$this->nomor_bukti(); 
			if($ok=$this->booking_dom_model->save($data))$this->nomor_bukti(true);	
		} else {
			$ok=$this->booking_dom_model->update($id,$data);				
		}
        
		if($ok){
		    $this->booking_dom_model->recalc($data['book_no']);
			echo json_encode(array("success"=>true,"book_no"=>$data["book_no"]));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
		
	}	
    function view($id,$show_tool=true)	{
		$id=urldecode($id);
		$data[$this->primary_key]=$id;
		$model=$this->booking_dom_model->get_by_id($id)->row();
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
		$faa[]=criteria("Pengirim","sid_nama");
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor Booking","sid_number");
		$data['criteria']=$faa;
		$data['fields_caption']=array('Nomor','Tanggal','Pengirim','Penerima','Tujuan','Via','Status');
		$data['fields']=array('book_no','bk_date','sender','ce_name','destination','ship_type','status');
		$data['msg_left']="<i>Isi range tanggal pengajuan atau isi nomor pengajuan, lalu klik tombol cari.</i>";
		
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		//if(user_admin() or $this->access->cid=="ALL"){
		$sql=$this->sql." where 1=1";
		//} else {
		//$sql=$this->sql." where am.create_by='".user_id()."'";
		//}
		
		$no=urldecode($this->input->get('sid_number'));        
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $nama=$this->input->post("sid_name");
        
        
		if($no!=''){
			$sql.=" and book_no='$no";
		} else {
			$sql.=" and bk_date between '$d1' and '$d2'";
		}
		
		if($nama!="")$sql .= " and company like '%$nama%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
		if($this->booking_dom_model->delete($id)){
			echo json_encode(array("success"=>true));
		} else {
			show_error("Tidak bisa dihapus !");		
		}		
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $this->table_name where book_no='$nomor'");
		echo json_encode($query->row_array());
 	}	
	function items($cmd="",$id=''){
	    $book_no=$cmd;
		if ($cmd=="save") {
			$this->add_item();
		} else if($cmd=="delete") {
			$this->db->where("id",$id)->delete("booking_dom_detail");
            $data['success']=true;
            echo json_encode($data);
            
		} else if ($cmd=="view") {
			if($row=$this->db->where("id",$id)
				->get("booking_dom_detail")->row()){
				$data=(array)$row;
				$data['success']=true;
				echo json_encode($data);
			}				
			
		} else {		    
			$sql="select * from booking_dom_detail where book_no='$book_no'";
			echo datasource($sql);
		}
	}
	function add_item(){
		$data=$this->input->post();		
		$id=$data['id'];
        unset($data['id']);
        
		$data['book_no']=$data['book_no'];
        $data['biaya']=c_($data['biaya']);
        $data['tarif_berat']=c_($data['tarif_berat']);
        $data['tarif_volume']=c_($data['tarif_volume']);
        $data['total_volume']=c_($data['total_volume']);
        $data['total_berat']=c_($data['total_berat']);
        

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
	function print_nomor($book_no){
	    $book_no=urldecode($book_no);
        $book=$this->booking_dom_model->get_by_id($book_no)->row();
        if(!$book){
            echo "<p>Booking [$book_no] not found !";
            return false;
        }
        $items=$this->booking_dom_model->items($book_no);
        $data["book"]=$book;
        $data["items"]=$items;
        echo load_view('courier/rpt/booking_dom',$data);                
	}
	
}
?>
