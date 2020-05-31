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
        
        
		//if(!$this->access->is_login())redirect(base_url());
		
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

    function select($search=""){
        
        $search=urldecode($search);
        $sql=$this->sql;

        if($search!=""){
            $sql.=" and (supplier_number like '$search%' 
                or supplier_name like '$search%')";
        }
        $sql.=" order by supplier_number";

        $offset=0; $limit=10;
        if($this->input->post("page"))$offset=$this->input->post("page");
        if($this->input->post("rows"))$limit=$this->input->post("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";        
        
        echo datasource($sql);
    }
    function select2(){
        
        $sql="select supplier_number,supplier_name from suppliers where 1=1";
        if($search=$this->input->get("q")){
            if($search!="")$sql.=" and (supplier_number like '%$search%' 
                or supplier_name like '%$search%')";
        }
        $sql.=" order by supplier_number";
        $sql.=" limit 0,50";
        
        $output="";
        if($qry=$this->db->query($sql)){
            foreach($qry->result() as $row){
                $output.=$row->supplier_number." - ".$row->supplier_name."|".$row->supplier_number."|".$row->supplier_name."\n";
            }
        }
        echo $output;
        
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
        
		$data["lookup_jenis_partisipasi"]=$this->list_of_values->render(array(
			'dlgBindId'=>'jenis_partisipasi','sysvar_lookup'=>'jenis_partisipasi',
			'dlgRetFunc'=>"$('#jenis_partisipasi').val(row.varvalue);"
		));

		
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
		if(isset($data['supplier_account_number']))$data['supplier_account_number']=account_id($data['supplier_account_number']);
		if(isset($data['acc_biaya']))$data['acc_biaya']=account_id($data['acc_biaya']);		 
		
	 	unset($data['mode']);
	 	if(isset($data['d1']))unset($data['d1']);
        if(isset($data['d2']))unset($data['d2']);
		if(!isset($data['show_only_item']))$data['show_only_item']=0;
        
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
			
			if(!isset($data['show_only_item']))$data['show_only_item']=0;
			if($data['show_only_item']=='')$data['show_only_item']=1;
					 
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
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='supplier_number';
		$data['list_info_visible']=true;
        $data['import_visible']=true;
		
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Kode","sid_kode");
		$faa[]=criteria("Nama","sid_nama");
		$faa[]=criteria("Kota","sid_city");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
    	
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
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        echo datasource($sql);		
    }
	function delete($id){
		$id=urldecode($id);
		if(!allow_mod('_40013')){
			//echo json_encode(array("success"=>false,"msg"=>"Anda tidak diijinkan menjalankan proses module ini."));
			//return false;
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
        $rows=null;
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
		$this->crud->set_table("type_of_vendor");
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
    
    function import_supplier(){
        if(!$this->input->post()){
            $data['caption']="IMPORT DATA MASTER SUPPLIER";
            $this->template->display("purchase/import_supplier",$data);
        } else {
            $this->import_supplier_run();
        }
    }
    function input_col($colname){
        $c=0;
        if($this->input->post($colname)!=""){
            $c=65-ord(strtoupper($this->input->post($colname)));
        }
        return abs($c);
    }
    function import_supplier_run(){
        $c_kode=$this->input_col('kode');
        $c_nama=$this->input_col('nama');
        $c_alamat1=$this->input_col('alamat1');
        $c_alamat2=$this->input_col('alamat2');
        $c_kota=$this->input_col('kota');
        $c_wilayah=$this->input_col('wilayah');
        $c_provinsi=$this->input_col('provinsi');
        $c_negara=$this->input_col('negara');
        $c_telpon=$this->input_col('telpon');
        $c_fax=$this->input_col('fax');
        $c_hp=$this->input_col('hp');
        $c_salesman=$this->input_col('salesman');
        $c_kelompok=$this->input_col('kelompok');
        $c_kontak=$this->input_col('first_name');
        $c_email=$this->input_col('email');
        $c_no_telp2=$this->input_col('no_telp2');
        $c_saldo=$this->input_col('saldo');
        $c_credit_limit=$this->input_col('credit_limit');
        $c_payment_terms=$this->input_col('payment_terms');
        $c_tgl_tagih=$this->input_col('tgl_tagih');

        $filename=$_FILES["file_excel"]["tmp_name"];
        if($_FILES["file_excel"]["size"] > 0)
        {
            $file = fopen($filename, "r");
            $i=0;
            $ok=false;
            $total_hutang=0;
            $this->db->trans_begin();
            ($emapData = fgetcsv($file, 10000, chr(9)));    //header
            while (($emapData = fgetcsv($file, 10000, chr(9))) !== FALSE)
            {
                //print_r($emapData[$c_kode]);
                //exit();
                $kode=$emapData[$c_kode];
                if(! ($kode == null or $kode == "" or $kode == "kode" ) ) {
                    $i=1;
                    $data=null;;;
                    $data["supplier_number"]=$kode;
                    if($c_nama>0)$data["supplier_name"]=$emapData[$c_nama];
                    if($c_alamat1>0)$data["street"]=$emapData[$c_alamat1];
                    if($c_alamat2>0)$data["suite"]=$emapData[$c_alamat2];
                    if($c_kota>0)$data["city"]=$emapData[$c_kota];
                    if($c_wilayah>0)$data["region"]=$emapData[$c_wilayah];
                    //if($c_provinsi>0)$data["province"]=$emapData[$c_provinsi];
                    if($c_negara>0)$data["country"]=$emapData[$c_negara];
                    if($c_telpon>0)$data["phone"]=$emapData[$c_telpon];
                    if($c_fax>0)$data["fax"]=$emapData[$c_fax];
                    if($c_hp>0)$data["nomor_hp"]=$emapData[$c_hp];
                    if($c_salesman>0)$data["salesman"]=$emapData[$c_salesman];
                    if($c_kontak>0)$data["first_name"]=$emapData[$c_kontak];
                    if($c_email>0)$data["email"]=$emapData[$c_email];
                    if($c_no_telp2>0)$data["no_telp2"]=$emapData[$c_no_telp2];
                    if($c_saldo>0){
                        $data['credit_balance']=c_($emapData[$c_saldo]);
                        $data['current_balance']=c_($emapData[$c_saldo]);
                        $total_hutang+=c_($emapData[$c_saldo]);                        
                    }
                    if($c_credit_limit>0){
                        $data['credit_limit']=c_($emapData[$c_credit_limit]);
                        $data['plafon_hutang']=c_($emapData[$c_credit_limit]);   
                    }
                    if($c_kelompok>0)$data['type_of_vendor']=$emapData[$c_kelompok];
                    if($c_payment_terms>0)$data['payment_terms']=$emapData[$c_payment_terms];
                    
                    $data["create_by"]=user_id();
                    $data['active']="1";
                    if($this->supplier_model->exist($kode)){
                        unset($data['supplier_number']);
                        $ok=$this->supplier_model->update($kode,$data)==1;
                        echo "Update: ".$kode."</br>";
                    } else {
                        $ok=$this->supplier_model->save($data)==1;
                        echo "Insert: ".$kode."</br>";
                    }
                    if($c_saldo>0){
                        $this->create_saldo_awal($kode,c_($emapData[$c_saldo]));
                    }
                    
                }
            }
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }           
            fclose($file);
            
            if($this->input->post("chkUpdateCoaHutang")){
                $this->update_saldo_coa($total_hutang);
            }
            
            
            if ($ok){echo json_encode(array("success"=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}      
        }
    
        echo "<div class='alert alert-success'>FINISH.</div>";
    }    
    function create_saldo_awal($supplier_number,$saldo){
        $this->load->model("purchase_invoice_model");
        $coa_hutang=0;
        if($qpref=$this->db->select("accounts_payable")->get("preferences")){
            if($rpref=$qpref->row()){
                $coa_hutang=$rpref->accounts_payable;
            }
        }
        if($qsupp=$this->db->select("default_account")->where("supplier_number",$supplier_number)->get("suppliers")){
            if($rsupp=$qsupp->row()){
                if($rsupp->default_account>0){
                    $coa_hutang=$rsupp->default_account;
                }
            }
        }
        $nomor_bukti="SALDO-$supplier_number";
        $data['po_date']=date("Y-m-1");
        $data['purchase_order_number']=$nomor_bukti;
        $data['potype']='I';
        $data['supplier_number']=$supplier_number;
        $data['terms']="KREDIT";
        $data['due_date']=$data['po_date'];
        $data['comments']="SALDO AWAL";
        $data['account_id']=$coa_hutang;
        $data['amount']=$saldo;
        $data['saldo_invoice']=$saldo;
        $data['warehouse_code']=current_gudang();
        
        $this->purchase_invoice_model->save($data);
        
        $detail['purchase_order_number']=$nomor_bukti;
        $detail['item_number']="SALDO";
        $detail['description']="SALDO";
        $detail['quantity']=1;
        $detail["price"]=$saldo;
        $detail['total_price']=$saldo;
        $detail['sub_total']=$saldo;
        $detail['warehouse_code']=current_gudang();
        
        $this->purchase_invoice_model->save_item($detail);
    }
    function update_saldo_coa($amount){
        $coa_hutang=0;
        if($qpref=$this->db->select("accounts_payable")->get("preferences")){
            if($rpref=$qpref->row()){
                $coa_hutang=$rpref->accounts_payable;
            }
        }
        $s="update chart_of_accounts set beginning_balance='$amount' where id='$coa_hutang'";
        $this->db->query($s);
    }
    function rpt($id="",$d1="",$d2="",$rek=""){
		 $data['date_from']=date('Y-m-d 00:00:00');
         if($d1!="")$data["date_from"]=$d1;
		 $data['date_to']=date('Y-m-d 23:59:59');
         if($d2!="")$data["date_to"]=$d2;
		 $data['select_date']=true;
    	 switch ($id) {
			 case 'mutasi':
				 $data['criteria1']=true;
				 $data['label1']='Rekening';
				 $data['text1']='';
				 break;			 
			 default:
				 break;
		 }
		 $rpt='supplier/rpt/'.$id;
		 $data['rpt_controller']=$rpt;
		 
		if(!$this->input->post('cmdPrint')){
			$this->template->display_form_input('criteria',$data,'');
		} else {
			$this->load->view('purchase/rpt/'.$id);
		}
   }	


}
