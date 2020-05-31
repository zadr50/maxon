<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Purchase_DbMemo extends CI_Controller {
    private $limit=10;
    private $sql="select kodecrdb,tanggal,docnumber,amount, cm.posted,keterangan,c.account, 
    	c.account_description,cm.cust_supp
     from crdb_memo cm left join chart_of_accounts c on c.id=cm.accountid 
     where transtype='PO-DEBIT MEMO'";
    private $controller='purchase_dbmemo';
    private $primary_key='kodecrdb';
    private $file_view='purchase/debit_memo';
    private $table_name='crdb_memo';
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('crdb_model');
		$this->load->model('supplier_model');
		$this->load->model('purchase_order_model');
		$this->load->model('syslog_model');
		$this->load->model('sysvar_model');
	}
	function nomor_bukti($add=false)
	{
		$key="Purchase CrDB Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!CRDBP~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!CRDBP~$00001');
				$rst=$this->crdb_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}
	function index()
	{	
		if(!allow_mod2('_40100'))return false;   
        $this->browse();
	}
    function browse($offset=0,$limit=50,$order_column='',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Faktur','Jumlah','Supplier','Posted','Keterangan','Kode Akun','Perkiraan');
		$data['fields']=array('kodecrdb','tanggal','docnumber','amount','cust_supp','posted','keterangan','account','account_description');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='kodecrdb';
		$data['caption']='DAFTAR DEBIT MEMO';
		$data['posting_visible']=true;

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor Bukti","sid_number");
		$faa[]=criteria("Posted","sid_posted");
		
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
        $sql=$this->sql;
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
        }
        
    	if($this->input->get('sid_number')){
    		$sql.=" and kodecrdb='".$this->input->get('sid_number')."'";
        } else if ($search!=""){
            $sql.=" and kodecrdb='$search'";
		} else {
			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
			$sql.=" and tanggal between '".$d1."' and '".$d2."'";
			if($this->input->get('sid_posted')!=''){
				if($this->input->get('sid_posted')=='1'){
					$sql.=" and posted=true";
				} else {
					$sql.=" and (posted=false or posted is null)";				
				}
			}

		}
        
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
	
	function add()
	{
		if(!allow_mod2('_40101'))return false;   
		$data=$this->set_defaults();
		$data['kodecrdb']="AUTO"; 
		$data['tanggal']=date('Y-m-d H:i:s');
		$data['docnumber']='';
		$data['amount']=0;
		$data['keterangan']="";
		$data['mode']='add';
		$data['posted']=false;
		$data['supplier_number']="";
		$this->template->display_form_input('purchase/debit_memo',$data,'');			
		
	}
	function save()
	{
		 
		$invoice_number=$this->input->post('docnumber');
		if($invoice_number)
		{
		    $no=$this->nomor_bukti();
            if($no=="AUTO")$no=$this->nomor_bukti();
			$data['kodecrdb']=$no;
			$data['tanggal']=$this->input->post('tanggal');
			$data['docnumber']=$invoice_number;
			$data['amount']=$this->input->post('amount');
			$data['keterangan']=$this->input->post('keterangan');
			$data['transtype']=$this->input->post('transtype');
            $data['prc_value']=$this->input->post('prc_value');
			$data['cust_supp']=$this->input->post("supplier_number");
			$data['doc_type']=$this->input->post('doc_type');
			$data['outlet']=$this->input->post("outlet");
			$this->crdb_model->save($data);
			$this->nomor_bukti(true);
			$this->syslog_model->add($data['kodecrdb'],"crdb","edit");

		} else {echo 'Save: Invalid Invoice Number';}
	
	}
	function view($id,$message=null){
		
		if(!allow_mod2('_40100'))return false;  
		 
		$id=urldecode($id);
		
		 $data['id']=$id;
		 $model=$this->crdb_model->get_by_id($id)->result_array();
		 
		 $data=$this->set_defaults($model[0]);
		 
		 $data['mode']='view';
		 $docnumber=$data['docnumber'];
		 
		 $supplier_number=$data['cust_supp'];
		 
		 $faktur_amount=0;
		 $po_date="";
		 $street="";
		 $city="";
		 $supplier_name="";
		 if($supplier_number==""){
			 if($qs=$this->purchase_order_model->get_by_id($docnumber)){
			 	if($q=$qs->row()){
			 		$supplier_number=$q->supplier_number;
					$po_date=$q->po_date;
					$faktur_amount=$q->amount;
			 	}	
			 }		 	
		 }
		 $data['supplier_number']=$supplier_number;
		 $data['faktur_info']=$po_date." Rp. ".number_format($faktur_amount,2);
		 
		 if($q1=$this->supplier_model->get_by_id($supplier_number)){
		 	if($q=$q1->row()){
		 		$supplier_name=$q->supplier_name;
				$street=$q->street;
				$city=$q->city;
		 	}	
		 };
		 
		 $data['supplier_name']=$supplier_name;
		 $data['supplier_info']=$supplier_name." ".$street." ".$city;
		 
         $this->template->display('purchase/debit_memo',$data);                 
	}
   
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
		$data['mode']='';
		$data['message']='';
		$data['supplier_info']="";
		$data['faktur_info']="";
		if(!$record){
        	$data['supplier_number']="";		    
		}
        $data['lookup_suppliers']=$this->supplier_model->lookup();
		
		$data['lookup_faktur']=$this->list_of_values->render(
			array("dlgBindId"=>'purchase_invoice',
                'dlgCols'=>array(
                    array("fieldname"=>"purchase_order_number","caption"=>"Faktur#","width"=>"80px"),
                    array("fieldname"=>"po_date","caption"=>"Tanggal","width"=>"80px"),
                    array("fieldname"=>"terms","caption"=>"Termin","width"=>"80px"),
                    array("fieldname"=>"nomor_recv","caption"=>"Ref1","width"=>"80px"),
                    array("fieldname"=>"nomor_po","caption"=>"Ref2","width"=>"80px"),
                    array("fieldname"=>"warehouse_code","caption"=>"Gudang","width"=>"80px"),
                    array("fieldname"=>"supplier_name","caption"=>"Supplier","width"=>"180px")
                ),
                "dlgRetFunc"=>"$('#docnumber').val(row.purchase_order_number); 
                	find_faktur();",
                "dlgBeforeLookup"=>"search_id=$('#supplier_number').val();"
                
                				
			)
		);
		
		$data['lookup_doc_type']=$this->sysvar_model->lookup(array(
			"dlgBindId"=>"doc_type","dlgId"=>"doc_type_podb"
		));
			
            $setwh['dlgBindId']="outlet";
            $setwh['dlgRetFunc']="$('#outlet').val(row.location_number);";
            $setwh['dlgCols']=array( 
                        array("fieldname"=>"location_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"attention_name","caption"=>"Nama Toko","width"=>"180px"),
                        array("fieldname"=>"company_name","caption"=>"Kode Pers","width"=>"50px"),
                        array("fieldname"=>"company","caption"=>"Perusahaan","width"=>"200px")
                    );          
            $setwh['show_date_range']=false;
            $data['lookup_gudang']=$this->list_of_values->render($setwh);
            
            if($data['outlet']=='') $data['outlet']=$this->session->userdata('session_outlet','');
            if($data['outlet']=='') $data['outlet']=current_gudang();          
		
		return $data;
	}
	function posting($nomor) {
		$nomor=urldecode($nomor);
		$this->crdb_model->posting($nomor);
		$this->view($nomor);
	}	
	function unposting($nomor) {
		$nomor=urldecode($nomor);
		$this->crdb_model->unposting($nomor);
		$this->view($nomor);
	}	
	function delete($nomor) {
		$nomor=urldecode($nomor);
		$this->crdb_model->delete($nomor);
		$this->syslog_model->add($nomor,"crdb","delete");

	}
	function posting_all() {
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
		$sql="select distinct kodecrdb from crdb_memo"; 
		$sql.=" where  transtype='PO-DEBIT MEMO'
		and (posted is null or posted=false) and tanggal between '$d1' and '$d2'";
		
		if($q=$this->db->query($sql)){
			foreach($q->result() as $r){
				echo "<p>Posting..
				<a href=".base_url()."index.php/purchase_dbmemo/view/".$r->kodecrdb."
				class='info_link'>".$r->kodecrdb."</a> : ";
				$message=$this->crdb_model->posting($r->kodecrdb);
				if($message!=''){
					echo ': '.$message;
				}
				echo "</p>";
			}
		}
		echo "<p>Finish.</p>";
	}		
}