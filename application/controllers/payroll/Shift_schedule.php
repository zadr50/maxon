<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Shift_schedule extends CI_Controller {
    private $limit=10;
    private $offset=0;
    private $table_name='employee_shift';
	private $sql="select distinct tcid,keterangan from employee_shift ";
    private $file_view="payroll/shift_schedule";
    private $primary_key="id";
    private $controller="payroll/shift_schedule";
    
	function __construct()
	{
		parent::__construct();
        if(!$this->access->is_login())header("location:".base_url());
         
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
	 	 $this->load->model(array("payroll/shift_model","payroll/employee_model",
	 	     "payroll/shift_schedule_model","payroll/shift_model"));
	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        $data['mode']='';
        $data['message']='';
        $data['lov_employee_group']=$this->list_of_values->render(
            array("dlgBindId"=>"kelompok","sysvar_lookup"=>"employee_group")        
        );
        $data["kelompok"]="";
        $data['tcid']=date("YmdHis");
        $data["date_from"]=date("Y-m-d");
        $data["date_to"]=date("Y-m-d");
        return $data;
	}
	function index(){$this->browse();}

	function add()	{
		$data=$this->set_defaults();           
	 	$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input($this->file_view,$data);
	}
	function save(){
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->input->post();
			$id=$data[$this->primary_key];
			$mode=$data["mode"];
		 	unset($data['mode']);
			if($mode=="add"){ 
				$ok=$this->shift_schedule_model->save($data);
			} else {
				$ok=$this->shift_schedule_model->update($id,$data);				
			}
			if($ok){echo json_encode(array("success"=>true,"id"=>$id));} 
			else {echo json_encode(array("success"=>false,"msg"=>mysql_error()));}
		 }  
		 else {echo json_encode(array("success"=>false,"msg"=>validation_errors()));}
	}
	function view($id,$message=null){
		 $id=urldecode($id);
		 $data=$this->set_defaults();
		 $data['tcid']=$id;
		 $data['mode']='view';
         if($id!=""){
             $ret=sqlinto("select * from employee_shift where tcid='$id' limit 1");
             if($ret){
                 $data["kelompok"]=$ret['shift_group'];
                 $data["date_from"]=$ret["tanggal"];
                 $data["date_to"]=$ret["tanggal"];
             }
         }
		 $data['message']=$message;
		 $this->template->display_form_input($this->file_view,$data);
	}
	function _set_rules(){	
		 $this->form_validation->set_rules('nip','Isi nomor induk karyawan', 'required|trim');
	}
 	function search(){$this->browse();}
 	       
	function browse($offset=0,$limit=10,$order_column='company',$order_type='asc')	{
        $data['caption']='JADWAL KERJA SHIFT';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Kode','Keterangan');
		$data['fields']=array("tcid",'keterangan');
		$data['field_key']='tcid';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","tcid");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql." where 1=1";
		$s=$this->input->get();		
		if($s['tcid']!=''){
			$sql.=" and tcid='".$s['tcid']."'";
		}  			
        echo datasource($sql);		
    }
      
	function delete($id){
		$id=urldecode($id);
        $this->db->where("tcid",$id)->delete("employee_shift");
        echo "Data sudah dihapus [$id], silahkan close...";
	}
    function item_save(){
        $data=$this->input->post();
        for($i=1;$i<31;$i++){
            if($data['nip']!=""){
                $tgl=date("Y-m-").$i;
                $shift=$data["col".$i];
                $val['nip']=$data["nip"];
                $val['tanggal']=$tgl;
                $val['kode_shift']=$shift;
                $this->db->insert("employee_shift",$val);
            }
        }
        return true;
    }
    function item_update(){
        $data=$this->input->post();
        $id=$data['id'];
        $shift=$data['kode_shift'];
        $this->db->where("id",$id)->update("employee_shift",array("kode_shift"=>$shift));
        echo json_encode(array("success"=>true));
    }
    function item_delete(){
        
    }
    function itemsx(){
        $param=$this->input->get();
        $kode=$param['tcid'];
        $kel=$param['kelompok'];
        $date_from=$param['date1'];
        $date_to=$param['date2'];
        $sql="select nip,nama,dept,shift_group from employee order by nama";
        //$s.=" where is_resigned is null and shift_group='$kelompok'"
        $query=$this->db->query($sql);
        $rows=array();
        
        foreach($query->result_array() as $row){
            for($i=0;$i<31;$i++){
                $col="col".($i+1);
                $nip=$row["nip"]."[]";
                $row[$col]="";
            }
            $rows[]=$row;            
        }
//                        $row["ck"]=form_checkbox("ck[]",$row[$primary_key],'',"style='width:50px' ");
        $data['total']=count($rows);
        $data['rows']=$rows;
        echo json_encode($data);
    }
    function items(){
        $param=$this->input->get();
        $kode=$param['tcid'];
        $kel=$param['kelompok'];
        $date_from=$param['date1'];
        $date_to=$param['date2'];
        $days=my_date_diff($date_from,$date_to);
        $tanggal=new DateTime($date_from);
        //var_dump($tanggal);
        $tgl=$tanggal->format("Y-m-d");
        //echo "days: $days, tanggal: ".$tgl;
        for($i=0;$i<$days;$i++){
            $tgl=$tanggal->format("Y-m-d");
            $q=$this->db->query("select id from employee_shift  
                    where tcid='$kode' and shift_group='$kel' and tanggal='$tgl'");
            if($q->num_rows()==0){
                $val["shift_group"]=$kel;
                $val['tcid']=$kode;
                $val['tanggal']=$tgl;
                $val['kode_shift']="";
                $val['keterangan']="Date: $date_from, To: $date_to, Kel: $kel";
                $this->db->insert("employee_shift",$val);                    
            }
            $tanggal->add(new DateInterval('P1D'));
            $tgl=$tanggal->format("Y-m-d");
            //echo "<br>Tanggal: ".$tgl;
        }
        $sql="select * from employee_shift where tcid='$kode' order by tanggal";
        echo datasource($sql);
    }
    
    function employee(){
        $param=$this->input->get();
        $kode=$param['tcid'];
        $kel=$param['kelompok'];
        $date_from=$param['date1'];
        $date_to=$param['date2'];
        $sql="select nip,nama,dept,shift_group from employee order by nama";
        //$s.=" where is_resigned is null and shift_group='$kelompok'"
        $query=$this->db->query($sql);
        $rows=array();
        foreach($query->result_array() as $row){
            $rows[]=$row;            
        }
        $data['total']=count($rows);
        $data['rows']=$rows;
        echo json_encode($data);
    }
    
}
