<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Supplier extends CI_Controller {

    private $limit=10;
    private $offset=0;
    private $sql=""; 
    private $table_name=""; 
    private $file_view="purchase/supplier";
	private $controller="supplier";
	function __construct()
	{
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		if(!$this->access->is_login())redirect(base_url());
		
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('supplier_model');
        $this->load->model('chart_of_accounts_model');
		$this->load->model('type_of_payment_model');
		$this->load->model('sysvar_model');
		$this->load->library("list_of_values");
        $this->load->model('syslog_model');        
		
		$this->table_name=cidt().'suppliers';
		$this->sql="select * from ".cidt()."suppliers where 1=1";		
	}
	function select($search=''){
		$sql="select supplier_name,supplier_number, city,country,first_name 
		from ".cidt()."suppliers 
		where supplier_name like '%$search%' or supplier_number='$search'
		order by supplier_name ";
        
        $limit=getvar("max_row");
        
        $offset=0;      $limit=10;
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset==1)$offset=0;
        $offset=10*$offset;
        $sql.=" limit $offset,$limit";
                
		echo datasource($sql);
		//var_dump($sql);
	}

	function set_defaults($record=NULL){
        $data=data_table($this->table_name,$record); 
		$data['mode']='';
		$data['message']='';
        $data['akun_list']=$this->chart_of_accounts_model->select_list();
        $data['terms_list']=$this->type_of_payment_model->select_list();
		$data['type_of_vendor_list']=$this->sysvar_model->value_list('type_of_vendor');
		$data['active']='1';
		$data['saldo']=0;
        $data["class"]="Stock";

		$setting['dlgBindId']="payment_terms";
		$setting['dlgCols']=array( 
			array("fieldname"=>"type_of_payment","caption"=>"Termin","width"=>"280px")
		);
		$setting['dlgRetFunc']="$('#payment_terms').val(row.type_of_payment);";
		$data['lookup_payment_terms']=$this->list_of_values->render($setting);

		$setting['dlgBindId']="type_of_vendor";
		$setting['dlgCols']=array( 
			array("fieldname"=>"type_id","caption"=>"Kode","width"=>"80px"),
			array("fieldname"=>"type_name","caption"=>"Nama Kelompok","width"=>"200px")
		);
		$setting['dlgRetFunc']="$('#type_of_vendor').val(row.type_id+' - '+row.type_name);";
		$data['lookup_type_of_vendor']=$this->list_of_values->render($setting);

        $setting['dlgBindId']="type_of_invoice";
        $setting['dlgRetFunc']="$('#sistim_bayar').val(row.varvalue);";
        $setting['dlgCols']=array( 
                    array("fieldname"=>"varvalue","caption"=>"Kode","width"=>"80px"),
                    array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
                );          
        $data['lookup_po_type']=$this->list_of_values->render($setting);

		
		return $data;
	}
	function index()
	{	
		if(!allow_mod2('_40010'))return false;
		$this->browse();		 
	}
	function get_posts(){
        $data=data_table_post($this->table_name);
		return $data;
	}
	function add()
	{
		if(!allow_mod('_40011')){
			echo "<span class='not_access'>Anda tidak diijinkan menjalankan proses module ini. _40011</span>";
			return false;
		};			
		 $data=$this->set_defaults();
         if($data['supplier_number']=="AUTO"){
             $data['supplier_number']=$this->nomor();
         }
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$this->supplier_model->save($data);
            if($id)$this->nomor(true);
            $data['mode']='view';
            $this->browse();
		} else {
			$data['mode']='add';
            $this->template->display_form_input($this->file_view,$data,'');
		
		}
	}
    function nomor($add=false)
    {
        $key="Supplier Number Numbering";
        $no='';
        if($add){
            $this->sysvar->autonumber_inc($key);
        } else {            
            $no=$this->sysvar->autonumber($key,0,'$0001');
         
            for($i=0;$i<100;$i++){          
                $no=$this->sysvar->autonumber($key,0,'$0001');
                $rst=$this->supplier_model->get_by_id($no)->row();
                if($rst){
                    $this->sysvar->autonumber_inc($key);
                } else {
                    break;                  
                }
            }
        }
        return $no;
    }	
	function save(){
		$data=$this->input->post();
		$id=$this->input->post("supplier_number");
        if($id=="AUTO"){
            $id=$this->nomor();
            $data['supplier_number']=$id;
        }
		$mode=$data["mode"];
		$data['supplier_account_number']=account_id($data['supplier_account_number']);
		$data['acc_biaya']=account_id($data['acc_biaya']);		 
		
	 	unset($data['mode']);
		if($mode=="add"){ 
			$ok=$this->supplier_model->save($data);
            if($ok)$this->nomor(true);
			$this->syslog_model->add($id,"supplier","add");
            
		} else {
			$ok=$this->supplier_model->update($id,$data);		
			$this->syslog_model->add($id,"supplier","edit");
			
		}
		if($ok){
			echo json_encode(array("success"=>true,'supplier_number'=>$id));
		} else {
			echo json_encode(array("success"=>false,"msg"=>"Error ".mysql_error()));
		}
		
	}
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('supplier_number');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$data['supplier_account_number']=account_id($data['supplier_account_number']);
			$data['acc_biaya']=account_id($data['acc_biaya']);		 
			$this->supplier_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"supplier","edit");

            $this->browse();
		} else {
			$message='Error Update';
     		$this->view($id,$message);		
		}	  
	}
	
	function view($id="",$message=null){
		if(!allow_mod2('_40010'))return false;
		$id=urldecode($id);
		if($id=="") { 
			echo "Supplier Number not found !";
			return false;
		}
		 $id=urldecode($id);
		 $model=$this->supplier_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['saldo']=$this->supplier_model->saldo($id);
		 $data['id']=$id;
		 $data['mode']='view';
		 $data['message']=$message;
		 $data['supplier_account_number']=account($data['supplier_account_number']);
		 $data['acc_biaya']=account($data['acc_biaya']);		 
		 $this->template->display_form_input($this->file_view,$data,'');
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('supplier_number','Supplier Number', 'required|trim');
		 $this->form_validation->set_rules('supplier_name','Supplier Name',	 'required');
	}
	function browse($offset=0,$limit=10,$order_column='suppliers',$order_type='asc')
	{
        $data['caption']='DAFTAR MASTER SUPPLIER';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Kode','Nama Supplier','Kota','Phone','Fax',
		'Email','Contact','Street','Suite');
		$data['fields']=array('supplier_number','supplier_name','city','phone','fax',
        'email','first_name','street','suite'
        );
		$data['field_key']='supplier_number';
		$data['list_info_visible']=true;
		
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_kode");
		$faa[]=criteria("Nama","sid_nama");
		$faa[]=criteria("Kota","sid_city");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=20,$nama=''){
        $limit=getvar("max_row");
        if($limit=="")$limit=20;        
        if($limit<10)$limit=20;
        
    	$sql=$this->sql;
		if($this->input->get("tb_search")){
		    $search=$this->input->get("tb_search");
			$sql.=" and (supplier_name like '%$search%' or supplier_number='$search')";
		}  else {
			if($this->input->get('sid_kode'))$sql.=" and supplier_number like '".$this->input->get('sid_kode')."%'";
			if($this->input->get('sid_nama'))$sql.=" and supplier_name like '".$this->input->get('sid_nama')."%'";
			if($this->input->get('sid_city'))$sql.=" and city='".$this->input->get('city')."'";		
		}
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset==1)$offset=0;
        $offset=10*$offset;
        $sql.=" limit $offset,$limit";
        
        echo datasource($sql);		
    }
	function delete($id){
		$id=urldecode($id);
		if(!allow_mod('_40013')){
			echo json_encode(array("success"=>false,"msg"=>"Anda tidak diijinkan menjalankan proses module ini."));
			return false;
		};			
	 	$cnt=$this->supplier_model->delete($id);
		if($cnt){
			echo json_encode(array("success"=>false,"msg"=>"Masih ada transaksi tidak bisa dihapus"));
		} else {
			$this->syslog_model->add($id,"supplier","delete");
			echo json_encode(array("success"=>true,"msg"=>"Berhasil hapus supplier ini."));
		}
	}
	
	function kartu_hutang($supplier_number)
	{
		$supplier_number=urldecode($supplier_number);
		$date_from= $this->input->get('d1');
		$date_from=  date('Y-m-d H:i:s', strtotime($date_from));
		$date_to= $this->input->get('d2');
		$date_to = date('Y-m-d H:i:s', strtotime($date_to));
		
		$sql="select sum(amount) as z_amt from ".cidt()."qry_kartu_hutang where supplier_number='$supplier_number' 
			and tanggal<'$date_from'";

        $query=$this->db->query($sql);
		$awal=$query->row()->z_amt;
		$rows[0]=array("no_bukti"=>"SALDO","tanggal"=>"SALDO","jenis"=>"SALDO","amount"=>number_format($awal),"saldo"=>number_format($awal));

		$sql="select no_bukti,tanggal,jenis,amount from ".cidt()."qry_kartu_hutang where supplier_number='$supplier_number' 
			and tanggal between '$date_from' and '$date_to' order by tanggal";

        $query=$this->db->query($sql);
		 
        $i=1;
		if($query)foreach($query->result_array() as $row) {
			$awal=$awal+$row['amount'];
			$row['amount']=number_format($row['amount']);
			$row["saldo"]=number_format($awal);
			$rows[$i++]=$row;
		};	
        $data['total']=$i;
        $data['rows']=$rows;
                    
        echo json_encode($data);

	}
	function list_info($offset=0){
		if(isset($_GET['offset'])){
			$offset=$_GET['offset'];
		}
		$data['offset']=$offset;
		$this->load->library('search_criteria');
		if($this->input->get('sid_nama') or $this->input->get('sid_nama')==''){
			$sid_nama=$this->input->get('sid_nama');
			$this->session->set_userdata('sid_nama',$sid_nama);
		} else {
			$sid_nama=$this->session->userdata('sid_nama');		
		}
		if($this->input->get('sid_city')  or $this->input->get('sid_city')==''){
			$sid_city=$this->input->get('sid_city');
			$this->session->set_userdata('sid_city',$sid_city);
		} else {
			$sid_city=$this->session->userdata('sid_city');
		}
	
		$faa[]=criteria("Nama","sid_nama",null,$sid_nama);
		$faa[]=criteria("Kota","sid_city",null,$sid_city);
		$data['criteria']=$faa;
		$data['criteria_text']=criteria_text($faa);
		$data['sid_nama']=$sid_nama;
		$data['sid_city']=$sid_city;
		
		$this->template->display_form_input('purchase/supplier_info_list',$data);	
	}
	function po_list($supplier_number)
	{
		$supplier_number=urldecode($supplier_number);
		$date_from= $this->input->get('d1');
		$date_from=  date('Y-m-d', strtotime($date_from));
		$date_to= $this->input->get('d2');
		$date_to = date('Y-m-d H:i:s', strtotime($date_to));

		$sql="select purchase_order_number,po_date,due_date,amount 
			from ".cidt()."purchase_order where potype='O' and  supplier_number='$supplier_number' 
			and po_date between '$date_from' and '$date_to' order by po_date";

        $query=$this->db->query($sql);
		$row=null; 
        $i=0;
		if($query)foreach($query->result_array() as $row) {
			$row['amount']=number_format($row['amount']);
			$rows[$i++]=$row;
		};	
        $data['total']=$i;
        $data['rows']=$rows;
                    
        echo json_encode($data);

	}
	function invoice_list($supplier_number)
	{
		$supplier_number=urldecode($supplier_number);
		$date_from= $this->input->get('d1');
		$date_from=  date('Y-m-d', strtotime($date_from));
		$date_to= $this->input->get('d2');
		$date_to = date('Y-m-d H:i:s', strtotime($date_to));

		$sql="select purchase_order_number as invoice,po_date,due_date,amount,saldo_invoice,paid 
			from ".cidt()."purchase_order where potype='I' and  supplier_number='$supplier_number' 
			and po_date between '$date_from' and '$date_to' order by po_date";

        $query=$this->db->query($sql);
		$row=null; 
        $i=0;
		if($query)foreach($query->result_array() as $row) {
			$row['amount']=number_format($row['amount']);
			$rows[$i++]=$row;
		};	
        $data['total']=$i;
        $data['rows']=$rows;
                    
        echo json_encode($data);
	}
	function kelompok($action="",$key="",$value="")
	{
		$this->load->library("crud");
		$this->crud->set_table("supplier_type");
		$this->crud->set_controller("supplier/kelompok");
		$this->crud->set_action($action,$key,$value);
		if($action=="save" ){
			$data=$this->input->post();
			echo $this->crud->save($data);
		} elseif ( $action=="delete" ) {
			echo $this->crud->delete($key,$value);
		} elseif ( $action=="edit" ) {
			echo $this->crud->set_value($key,$value);
			echo $this->crud->set_mode($action);
			$data["content"]=$this->crud->render();
			$this->template->display("blank", $data);
		} elseif ( $action=="browse_data") {
			$data=$this->input->post();
			echo $this->crud->browse_data($data);				
		} else {	// default browse
			$data["content"]=$this->crud->render();
			$this->template->display("blank",$data);
		}		 
	}
}
