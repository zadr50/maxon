<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Purchase_retur extends CI_Controller {
        private $limit=10;
        private $sql="select purchase_order_number,po_date,amount,i.posted, i.po_ref,
                i.supplier_number,c.supplier_name,c.city,i.warehouse_code,i.comments,i.doc_type
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
		$this->load->model("retur_toko_model"); 
        $this->load->model('purchase_order_lineitems_model');
        $this->load->model('jurnal_model');
        $this->load->model('purchase_retur_model');
        $this->load->model('periode_model');
        $this->load->model(array("sysvar_model",'inventory_products_model'));
        
	}
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
            $data['mode']='';
            $data['message']='';
            if($record==NULL){
                $data['purchase_order_number']="AUTO";  //$this->nomor_bukti();
    			$data['po_date']= date("Y-m-d");
                $data['potype']='R';
    			$data['closed']=0;
    			$data['posted']=0;
                $data['type_of_invoice']="1";
                $data['warehouse_code']=current_gudang();
            }
			$data['lookup_doc_type']=$this->sysvar_model->lookup(array(
				"dlgBindId"=>"doc_type","dlgId"=>"doc_type_retur_beli"
			));

			$data['warehouse_list']=$this->shipping_locations_model->select_list();
            
            $setting['dlgBindId']="type_of_invoice";
            $setting['dlgRetFunc']="$('#type_of_invoice').val(row.varvalue);";
            $setting['dlgCols']=array( 
                        array("fieldname"=>"varvalue","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
                    );          
            $data['lookup_type_of_invoice']=$this->list_of_values->render($setting);
            
            
            $setsupp['dlgBindId']="suppliers";
            $setsupp['dlgRetFunc']="$('#supplier_number').val(row.supplier_number);
            $('#supplier_name').html(row.supplier_name);
            ";
            $setsupp['dlgCols']=array( 
                        array("fieldname"=>"supplier_name","caption"=>"Nama Supplier","width"=>"180px"),
                        array("fieldname"=>"supplier_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"first_name","caption"=>"Kontak","width"=>"50px"),
                        array("fieldname"=>"city","caption"=>"Kota","width"=>"200px")
                    );          
            $data['lookup_suppliers']=$this->list_of_values->render($setsupp);

            $data['lookup_retur_toko']=$this->retur_toko_model->lookup(
                array("dlgRetFunc"=>"
                    add_item_retur_toko(row.shipment_id);
                "));
            $data['lookup_warehouse']=$this->shipping_locations_model->lookup();
            
            $data['lookup_coa_inventory']=$this->list_of_values->render(
                array("dlgBindId"=>"inventory_account",
                "dlgRetFunc"=>"$('#inventory_account').val(row.account); 
                $('#coa_inventory').val(row.account_description);",
                'dlgCols'=>array(
                    array("fieldname"=>"account","caption"=>"Account","width"=>"80px"),
                    array("fieldname"=>"account_description","caption"=>"Account Description","width"=>"300px")                    
                ))
            );
            $data['lookup_inventory']=$this->list_of_values->lookup_inventory();
            $data['lookup_sumber_outlet']=$this->list_of_values->render(
				array(
					"dlgBindId"=>"sumber_outlet",
					"dlgId"=>"sumber_outlet",
					"dlgUrlQuery"=>"gudang/browse_data",
					"dlgCols"=>array(
						array("fieldname"=>"location_number","caption"=>"Oulet","width"=>"80px"),
						array("fieldname"=>"attention_name","caption"=>"Keterangan")
					),
					"dlgRetFunc"=>"$('#branch_code').val(row.location_number);"
				)
			);
                                    
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
	    $data=$this->input->post();
        
		$mode=$data['mode'];
        unset($data['mode']);
        unset($data['sub_total']);
		if($mode=="add"){
	        $id=$this->nomor_bukti();
            $data['potype']='R';
		} else {
			$id=$data['purchase_order_number'];			
		}
		$data['purchase_order_number']=$id;
        if(!isset($data['terms']))$data['terms']="KREDiT";
		if($data['terms']=="")$data["terms"]="KREDIT";
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
        $this->db->where("purchase_order_number",$id)->update("purchase_order_lineitems",
            array("warehouse_code"=>current_gudang()));
        
	}
	
	function save_old(){
		
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
		'Nama Supplier','DocType','Kota','Gudang','Keterangan');
		$data['fields']=array('purchase_order_number','po_date','amount','posted','po_ref', 
                'supplier_number','supplier_name','doc_type','city','warehouse_code','comments');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
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
        if($this->input->get("tb_search")){
            $tb_search=$this->input->get("tb_search");
            $sql=$this->sql." and (purchase_order_number like '%$tb_search%' 
                or i.supplier_number like '%$tb_search%' or c.supplier_name like '%$tb_search%' 
                )";
        }
        $sort_by=$this->my_setting->sort_by();
        if($sort_by=='1'){
            $sql.=" order by po_date desc";
        } else {
            $sql.=" order by purchase_order_number";
        }
        
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }	 
  
	function delete($id){
		if(!allow_mod2('_40063'))return false;   
		$id=urldecode($id);
				
		
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
		echo $this->purchase_order_lineitems_model->browse($nomor);
    }
    function add_item(){            
        if(!$this->input->get('purchase_order_number')){
        	echo "Nomor bukti tidak diisi.";
			return false;
		}
        $data['purchase_order_number']=$this->input->post('purchase_order_number');
        $data['item_lookup']=$this->inventory_model->item_list();
        $this->load->view('purchase/purchase_retur_add_item',$data);
    }   
        function save_item(){
        	if(!$this->input->post('item_number')){
        		echo "Pilih nama barang !";return false;
        	} 
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
			$data['invoice']=$invoice;
			$this->load->view('purchase/print_retur',$data);
        }
		function posting($nomor)	{
		if(!allow_mod2('_40065'))return false;   
			$nomor=urldecode($nomor);
			$this->purchase_retur_model->posting($nomor);			
			$this->view($nomor);
		}
	function unposting($nomor) {
		if(!allow_mod2('_40065'))return false;   
		$nomor=urldecode($nomor);
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
	function add_item_retur($shipment_id,$nomor_retur){
	    $data["success"]=false;
        $data["msg"]="Tidak bisa simpan";
        if($q=$this->inventory_products_model->get_by_id($shipment_id)){
            foreach($q->result() as $row){
                $data["success"]=true;
                $data["msg"]="Success data sudah tersimpan";
                
                $item["purchase_order_number"]=$nomor_retur;
                $item["item_number"]=$row->item_number;
                $item["unit"]=$row->unit;
                $item["quantity"]=$row->quantity_received;
                $item["price"]=$row->cost;
                $item["from_line_doc"]=$shipment_id;
                $item["from_line_number"]=$row->id;
                $item["from_line_type"]="retur_toko";
                $this->purchase_order_lineitems_model->save($item);
            }
        }
        echo json_encode($data);
	}	
}
