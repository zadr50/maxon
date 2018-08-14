<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Purchase_retur extends CI_Controller {
        private $limit=10;
        private $sql="select purchase_order_number,po_date,amount,i.posted, i.po_ref,
                i.supplier_number,c.supplier_name,c.city,i.warehouse_code
                from purchase_order i
                left join suppliers c on c.supplier_number=i.supplier_number
                where i.potype='R'";
        private $controller='purchase_retur';
        private $primary_key='nomor_bukti';
        private $file_view='purchase/retur';
        private $table_name='purchase_order';
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
        

		if(!$this->access->is_login()){redirect('home', 'refresh');exit;}            

 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('purchase_order_model');
		$this->load->model('supplier_model');
		$this->load->model('inventory_model');
        $this->load->model('shipping_locations_model');
		$this->load->model('syslog_model');
		 
	}
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
            if($record==NULL)$data['purchase_order_number']=$this->nomor_bukti();
			$data['po_date']= date("Y-m-d");
            $data['potype']='R';
			$data['closed']=0;
			$data['posted']=0;
			$data['warehouse_list']=$this->shipping_locations_model->select_list();
			return $data;
	}
	function nomor_bukti($add=false)
	{
		$key="Retur Pembelian Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {
			$no=$this->sysvar->autonumber($key,0,'!PR~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!PR~$00001');
				$rst=$this->purchase_order_model->get_by_id($no)->row();
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
		if(!allow_mod2('_40060'))return false;   
        $this->browse();
           
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}
	function save(){
		$mode=$this->input->post('mode');
        $data['potype']='R';
		if($mode=="add"){
	        $id=$this->nomor_bukti();
		} else {
			$id=$this->input->post('purchase_order_number');			
		}
		$data['purchase_order_number']=$id;
		$data['po_date']=$this->input->post('po_date');
        $data['supplier_number']=$this->input->post('supplier_number');
        $data['terms']=$this->input->post('terms');
        $data['due_date']=$this->input->post('due_date');
        $data['comments']=$this->input->post('comments');
        $data['po_ref']=$this->input->post('po_ref');
		$data['warehouse_code']=$this->input->post('warehouse_code');
		
		$this->purchase_order_model->recalc($id);
		
		if($mode=="add"){
			$ok=$this->purchase_order_model->save($data);
			$this->syslog_model->add($id,"purchase_retur","add");

		} else {
			$ok=$this->purchase_order_model->update($id,$data);	
			$this->syslog_model->add($id,"purchase_retu","edit");
			
		}

		if ($ok){
			if($mode=="add") $this->nomor_bukti(true);
			echo json_encode(array('success'=>true,'purchase_order_number'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	
	function save_old(){
		$this->load->model('purchase_order_lineitems_model');
		$this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['potype']='R';
			//-- save header --- //
			$nomor=$this->nomor_bukti();
			$data['purchase_order_number']=$nomor;
			$this->purchase_order_model->save($data);
			$this->nomor_bukti(true);
			//-- save detail --- //
			$qty=$this->input->post('qty');
			$line=$this->input->post('line_number');
			 
			for($i=0;$i<count($qty);$i++){
				if($qty[$i]>0){
					$rpoline=$this->purchase_order_lineitems_model->get_by_id($line[$i])->result_array();
					if($rpoline[0]){
						$rpoline['purchase_order_number']=$nomor;
						unset($rpoline[0]['line_number']);
						$this->purchase_order_lineitems_model->save($rpoline[0]);
					}
				}
			}
			$this->purchase_order_model->recalc($nomor);
            header('location: '.base_url().'index.php/purchase_retur/view/'.$nomor);
         }
	}
	function add()	{
		if(!allow_mod2('_40061'))return false;   
	    $data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
        $data['supplier_info']=$this->supplier_model->info($data['supplier_number']);
		$this->template->display_form_input('purchase/retur',$data,'');			
	}
	function add_single($nomor_faktur)
	{
		$nomor_faktur=urldecode($nomor_faktur);
		$this->load->model('purchase_order_lineitems_model');
	    $data=$this->set_defaults();
		$data['mode']='add';
		$data['message']='';
        $data['supplier_list']=$this->supplier_model->select_list();
		$faktur=$this->purchase_order_model->get_by_id($nomor_faktur)->row();
		$data['supplier_number']=$faktur->supplier_number;
		$data['supplier_info']=$this->supplier_model->info($faktur->supplier_number);
		$data['po_ref']=$nomor_faktur;
		$data['items']=$this->purchase_order_lineitems_model->lineitems($nomor_faktur);
		$this->template->display_form_input('purchase/retur_proses',$data,'');			
	}
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 $id=$this->input->post('purchase_order_number');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
		 	$data['potype']='R';
			$this->purchase_order_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"purchase_retur","edit");

		} else {
			$message='Error Update';
		}
                
 		$this->view($id,$message);		
	}
	 
        
	function view($id,$message=null){
		if(!allow_mod2('_40060'))return false;   
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->purchase_order_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['id']=$id;
		 $data['purchase_order_number']=$id;
		 $data['mode']='view';
         $data['message']=$message;
         $data['supplier_list']=$this->supplier_model->select_list();  
         $data['supplier_info']=$this->supplier_model->info($data['supplier_number']);

		 if($model) {
			$data['posted']=$model->posted;
		} else {
			$data['posted']=false;
		}
		 $this->load->model('periode_model');
		 $data['closed']=$this->periode_model->closed($data['po_date']);

		 $this->session->set_userdata('_right_menu','');
         $this->session->set_userdata('purchase_order_number',$id);
         $this->template->display('purchase/retur',$data);                 
	}
   
	function _set_rules(){	
		 $this->form_validation->set_rules('purchase_order_number','Nomor Bukti Retur', 'required|trim');
		 $this->form_validation->set_rules('po_date','Tanggal','callback_valid_date');
	}
    function browse($offset=0,$limit=50,$order_column='purchase_order_number',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Jumlah','Posted','Faktur','Kode Supplier',
		'Nama Supplier','Kota','Gudang');
		$data['fields']=array('purchase_order_number','po_date','amount','posted','po_ref', 
                'supplier_number','supplier_name','city','warehouse_code');
		$data['field_key']='purchase_order_number';
		$data['caption']='DAFTAR PURCHASE RETUR';
		$data['posting_visible']=true;

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor BUkti","sid_po_number");
		$faa[]=criteria("Supplier","sid_supplier");
		$faa[]=criteria("Posted","sid_posted");

		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
    	if($this->input->get('sid_po_number')){
    		$sql=$this->sql." and purchase_order_number='".$this->input->get('sid_po_number')."'";
		} else {
			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
			$sql=$this->sql." and po_date between '".$d1."' and '".$d2."'";
			if($this->input->get('sid_supplier'))$sql.=" and supplier_name like '".$this->input->get('sid_supplier')."%'";
			if($this->input->get('sid_posted')!=''){
				if($this->input->get('sid_posted')=='1'){
					$sql.=" and posted=true";
				} else {
					$sql.=" and (posted=false or posted is null)";				
				}
			}
		}
        echo datasource($sql);
    }	 
  
	function delete($id){
		if(!allow_mod2('_40063'))return false;   
		$id=urldecode($id);
		$this->load->model('jurnal_model');
		if($q=$this->jurnal_model->get_by_gl_id($id)){
			if($r=$q->row()){
				$message="Tidak bisa hapus retur [$id] ! Karena sudah dijurnal.";
				$this->view($id,$message);
				return false;
			}
		}
		$this->purchase_order_model->delete($id);
		$this->syslog_model->add($id,"purchase_retur","delete");

		$this->browse();
	}
	function lineitems($nomor){
		$nomor=urldecode($nomor);
		$this->load->model('purchase_order_lineitems_model');
		echo $this->purchase_order_lineitems_model->browse($nomor);
    }
    function add_item(){            
        if(!$this->input->get('purchase_order_number')){
        	echo "Nomor bukti tidak diisi.";
			return false;
		}
        $data['purchase_order_number']=$this->input->post('purchase_order_number');
        $this->load->model('inventory_model');
        $data['item_lookup']=$this->inventory_model->item_list();
        $this->load->view('purchase/purchase_retur_add_item',$data);
    }   
        function save_item(){
        	if(!$this->input->post('item_number')){
        		echo "Pilih nama barang !";return false;
        	} 
            $this->load->model('purchase_order_lineitems_model');
            $item_no=$this->input->post('item_number');
            $data['purchase_order_number']=$this->input->post('purchase_order_number');
            $data['item_number']=$item_no;
            $data['quantity']=$this->input->post('quantity');
            $data['description']=$this->inventory_model->get_by_id($data['item_number'])->row()->description;
            $data['unit']=$this->input->post('unit');
            $data['price']=$this->input->post('price');
            $data['total_price']=$data['quantity']*$data['price'];
            $this->purchase_order_lineitems_model->save($data);
        }        
        function delete_item($id){
			$id=urldecode($id);
            $this->load->model('purchase_order_lineitems_model');
            return $this->purchase_order_lineitems_model->delete($id);
        }        
        function print_retur($nomor){
		    $nomor=urldecode($nomor);
			$this->load->helper('mylib');
			$this->load->helper('pdf_helper');			
            $invoice=$this->purchase_order_model->get_by_id($nomor)->row();
			$saldo=$this->purchase_order_model->recalc($nomor);
			$data['po_number']=$invoice->purchase_order_number;
			$data['tanggal']=$invoice->po_date;
			$data['supplier']=$invoice->supplier_number;
			$data['terms']=$invoice->terms;
			$data['amount']=$invoice->amount;
			$data['sub_total']=$invoice->subtotal;
			$data['discount']=$invoice->discount;
			$data['disc_amount']=$invoice->subtotal*$invoice->discount;
			$data['freight']=$invoice->freight;
			$data['others']=$invoice->other;
			$data['tax']=$invoice->tax;
			$data['tax_amount']=$invoice->tax*($data['sub_total']-$data['disc_amount']);
			$data['comments']=$invoice->comments;
			$this->load->view('purchase/print_retur',$data);
        }
		function posting($nomor)	{
		if(!allow_mod2('_40065'))return false;   
			$nomor=urldecode($nomor);
			$this->load->model('purchase_retur_model');
			$this->purchase_retur_model->posting($nomor);			
			$this->view($nomor);
		}
	function unposting($nomor) {
		if(!allow_mod2('_40065'))return false;   
		$nomor=urldecode($nomor);
		$this->load->model('purchase_retur_model');
		$this->purchase_retur_model->unposting($nomor);			
		$this->view($nomor);
	}		
	function posting_all() {
		$this->load->model("purchase_retur_model");
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
		$sql="select distinct purchase_order_number from purchase_order"; 
		$sql.=" where potype='R'
		and (posted is null or posted=false) 
		and po_date  between '$d1' and '$d2'";
		
		if($q=$this->db->query($sql)){
			foreach($q->result() as $r){
				echo "<p>Posting..
				<a href=".base_url()."index.php/purchase_retur/view/".$r->purchase_order_number."
				class='info_link'>".$r->purchase_order_number."</a> : ";
				$message=$this->purchase_retur_model->posting($r->purchase_order_number);
				if($message!=''){
					echo ': '.$message;
				}
				echo "</p>";
			}
		}
		echo "<p>Finish.</p>";
	}	
		
}
