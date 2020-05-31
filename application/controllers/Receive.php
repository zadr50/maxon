<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Receive extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_products';
    private $sql="select distinct shipment_id,
        concat(year(date_received),'-',month(date_received),'-',day(date_received)) as date_received,        
        ip.warehouse_code,ip.supplier_number,ip.doc_type,ip.doc_status,ip.receipt_by,ip.comments
                from inventory_products ip 
                where receipt_type in ('ETC_IN','ETC') 
                ";
    private $file_view='inventory/receive';
    private $primary_key='shipment_id';
    private $controller='receive';
    
	function __construct()
	{
		parent::__construct();        
       
 		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('inventory_products_model');
		$this->load->model('inventory_model');
		$this->load->model('shipping_locations_model');
		$this->load->model('syslog_model');
		$this->load->model("chart_of_accounts_model");
		
	}
	function nomor_bukti($add=false)
	{
		$key="Other Receivement Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!EIN~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!EIN~$00001');
				$rst=$this->inventory_products_model->get_by_id($no)->row();
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
			$data=data_table($this->table_name,$record);
//            $data['item_number_list']=$this->inventory_model->item_list();
			if($record==NULL){
			    $data['shipment_id']="AUTO"; //$this->nomor_bukti();			
                $data['mode']='';
                $data['message']='';
                $data["warehouse_code"]=current_gudang();
                $data["receipt_by"]=user_id();
                $data['date_received']=date("Y-m-d H:i:s");
            }   
            $data["ref1"]=account($data["ref1"]);
            $setwh['dlgBindId']="warehouse";
            $setwh['dlgRetFunc']="$('#warehouse_code').val(row.location_number);";
            $setwh['dlgCols']=array( 
                        array("fieldname"=>"location_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"attention_name","caption"=>"Nama Toko","width"=>"180px"),
                        array("fieldname"=>"company_name","caption"=>"Kode Pers","width"=>"50px"),
                        array("fieldname"=>"company","caption"=>"Perusahaan","width"=>"200px")
                    );          
            $data['lookup_gudang']=$this->list_of_values->render($setwh);
			$data['lookup_inventory']=$this->list_of_values->lookup_inventory();

            
            
            return $data;
	}
	function index()
	{	
		if(!allow_mod2('_80060'))return false;   
            $this->browse();
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		if(!allow_mod2('_80061'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['receipt_type']='ETC_IN';            
			$data['shipment_id']=$this->nomor_bukti();
			$id=$this->inventory_products_model->save($data);
			$this->nomor_bukti(true);
            $data['message']='update success';
            $data['mode']='view';
			$this->syslog_model->add($id,"receive","add");

            $this->browse();
		} else {
			$data['mode']='add';
            $this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function update()
	{
	 
		 $data=$this->set_defaults();
 
		 $this->_set_rules();
 		 $id=$this->input->post($this->primary_key);
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();                    
	        unset($data['id']);
	        $this->inventory_products_model->update($id,$data);
	        $message='Update Success';
			$this->syslog_model->add($id,"receive","edit");

	        $this->browse();
		} else {
			$message='Error Update';
     		$this->view($id,$message);		
		}		
	}
	
	function view($id,$message=null){
		if(!allow_mod2('_80060'))return false;   
		$id=urldecode($id);
         $q=$this->inventory_products_model->get_by_id($id);
	     if($row=$q->row()){
            $model=$row;
	     }
         $data=$this->set_defaults($model);
         
         $data['shipment_id']=$id;
		 $data['mode']='view';
         $data['warehouse_list']=$this->shipping_locations_model->select_list();
		$this->template->display_form_input('inventory/receive',$data);
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules($this->primary_key,'Nomor Bukti', 'required|trim');
	}
	
	 // date_validation callback
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date',
		 'date format is not valid. yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
    function posting($shipment_id){
        $shipment_id=urldecode($shipment_id);
        $this->inventory_products_model->posting($shipment_id);
        redirect("receive/view/$shipment_id");
    }
    function unposting($shipment_id){
        $shipment_id=urldecode($shipment_id);
        $this->inventory_products_model->unposting($shipment_id);
        redirect("receive/view/$shipment_id");
    }
    
	function browse($offset=0,$limit=10,$order_column='shipment_id',$order_type='asc')
	{
        $data['caption']='DAFTAR PENERIMAAN BARANG NON PURCHASE ORDER';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Nomor Bukti','Tanggal',
		'Gudang','Sumber','Doc Type','Doc Status','Receipt By','Comments');
		$data['fields']=array('shipment_id','date_received',
		'warehouse_code','supplier_number','doc_type','doc_status','receipt_by','comments');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['field_key']='shipment_id';
		$data['import_visible']=true;
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","sid_nomor");
		$faa[]=criteria("Supplier","sid_supplier");
		$faa[]=criteria("Gudang","sid_gudang");
		$faa[]=criteria("Kode Barang","sid_item");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql;
    	$nama=$this->input->get('sid_supplier');
		$no=$this->input->get('sid_nomor');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
		$gudang=$this->input->get("sid_gudang");
		$item_no=$this->input->get("sid_item");
		if($this->input->get("tb_search")){
			$no=$this->input->get("tb_search");
		}
		if($no!=''){
			$sql.=" and shipment_id='".$no."'";
		} else {
			$sql.=" and date_received between '$d1' and '$d2'";
			if($nama!='')$sql.=" and supplier_name like '$nama%'";	
		}
		if($gudang!="")$sql.=" and warehouse_code='".$gudang."'";
		if($item_no!="")$sql.=" and ip.item_number='".$item_no."'";
		
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }
	function delete($id){
		if(!allow_mod2('_80063'))return false;   
		$id=urldecode($id);
	 	$this->inventory_products_model->delete($id);
		$this->syslog_model->add($id,"receive","delete");

	 	$this->browse();
	}
    function detail(){
        $data['shipment_id']=isset($_GET['shipment_id'])?$_GET['shipment_id']:'';
		$data['shipment_id']=$this->nomor_bukti();
        $data['date_received']=isset($_GET['date_received'])?$_GET['date_received']:'';
        $data['supplier_number']=isset($_GET['supplier_number'])?$_GET['supplier_number']:'';
        $data['comments']=isset($_GET['comments'])?$_GET['comments']:'';
		$this->nomor_bukti(true);
        $this->template->display('inventory/receive_detail',$data);
    }
	function view_detail($nomor){
		$nomor=urldecode($nomor);
        $sql="select ip.item_number,i.description,ip.quantity_received as qty
        ,ip.unit,ip.cost,ip.id
        from inventory_products ip
        left join inventory i on i.item_number=ip.item_number
        where shipment_id='$nomor'";
        $s="
            <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
            <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
            <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
            <script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
        ";
        echo $s." ".browse_simple($sql);
    }
    function acc_id($account){
        $account=urldecode($account);
        $data=explode(" - ", $account);
        $coa=$this->chart_of_accounts_model->get_by_id($data[0])->row();
        if($coa){
            return $coa->id;
        } else {
            return 0;
        }
    }
    
    function save_item(){
        $item_no=$this->input->post('item_number');
		$id=$this->input->post('shipment_id');
        if($id=="AUTO"){
            $id=$this->nomor_bukti();
            $this->nomor_bukti(true);
        }
        
		$line=$this->input->post('id');
        $data['item_number']=$item_no;
        $data['quantity_received']=$this->input->post('quantity_received');
        $item=$this->inventory_model->get_by_id($data['item_number'])->row();
       	if($this->input->post("cost")){
       		$cost=$this->input->post("cost");
       	} else {
	       	$cost=item_cost($item_no);
       		
       	}
        $data['cost']=$cost;
		
        $data['unit']=$this->input->post('unit');
        $data['shipment_id']=$id;
        $data['warehouse_code']=$this->input->post('warehouse_code');
        $data['total_amount']=$data['quantity_received']*$data['cost'];
		$data['receipt_type']='ETC_IN';
		$data['date_received']=$this->input->post('date_received');;
		$data['comments']=$this->input->post('comments');;
		$data['supplier_number']=$this->input->post("supplier_number");
        $data['doc_type']=$this->input->post("doc_type");
        $data['doc_status']=$this->input->post("doc_status");
        $data['ref1']=$this->acc_id($this->input->post("ref1"));
        $data['receipt_by']=$this->input->post("receipt_by");;
        $data["other_doc_number"]=$this->input->post("other_doc_number");
		$data["mu_qty"]=$this->input->post("mu_qty");
	
		$data['multi_unit']=$this->input->post("multi_unit");
//		$data['total_amount']=$this->input->post("total_amount");
		$data['mu_price']=$this->input->post("mu_price");
        
		if($line>0){
			$data['id']=$line;
			$ok=$this->inventory_products_model->update($line,$data);			
		} else {
			$ok=$this->inventory_products_model->save($data);
		}
        $err_msg="";
        if($err=$this->db->error()){
            //$err_msg=$err["error"];
        }
//        var_dump($ok);
        
		if ($ok){
			echo json_encode(array('success'=>true,'shipment_id'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured. <br>'.$err_msg));
		}
            
        
        
	}         
    function print_bukti($nomor){
		$nomor=urldecode($nomor);
        $adj=$this->inventory_products_model->get_by_id($nomor)->row();
		$data['shipment_id']=$adj->shipment_id;
		$data['date_received']=$adj->date_received;
		$data['warehouse_code']=$adj->warehouse_code;
		$data['comments']=$adj->comments;
        $data['supplier_number']=$adj->supplier_number;
		$data['content']=load_view('inventory/rpt/print_receive_etc',$data);
		$this->load->view('pdf_print',$data);

    }
    function del_item($id){
        $ok=$this->inventory_products_model->delete_item($id);
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
    }        
	
	function items($nomor,$type='')
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.quantity_received as quantity, 
		p.unit,p.cost,p.id as line_number,p.mu_qty,p.multi_unit,p.cost,p.total_amount,p.mu_price,
		p.warehouse_code,p.supplier_number
		from inventory_products p
		left join inventory i on i.item_number=p.item_number
		where shipment_id='$nomor'";
		 
		echo datasource($sql);
	}
	function import_receive(){
		if(!$this->input->post()){
			$data['caption']="IMPORT TRANSAKSI PENERIMAAN BARANG";
			$this->template->display("inventory/import_receive",$data);
		} else {
			$this->import_receive_run();
		}
	}
	function input_col($colname){
		$c=0;
		if($this->input->post($colname)!=""){
			$c=65-ord(strtoupper($this->input->post($colname)));
		}
		return abs($c);
	}
	function import_receive_run(){
		//var_dump($this->input->post());
		$c_gudang=$this->input_col('gudang');
		$c_tanggal=$this->input_col('tanggal');
		$c_person=$this->input_col('person');
		$c_item_no=$this->input_col('item_no');
		$c_qty=$this->input_col('qty');
		$c_unit=$this->input_col('unit');
		$c_cost=$this->input_col('cost');
		$filename=$_FILES["file_excel"]["tmp_name"];
		if($_FILES["file_excel"]["size"] > 0)
		{
			$file = fopen($filename, "r");
			$i=0;
			$ok=false;
			$data['shipment_id']=$this->nomor_bukti();
            $data['receipt_type']='etc_in';
			$this->db->trans_begin();
			while (($emapData = fgetcsv($file, 10000, chr(9))) !== FALSE)
			{
				//var_dump($emapData);
				 
				//exit();
				$kode=$emapData[$c_item_no];
				if(! ($kode == null or $kode == "" or $kode == "item_no" ) ) {
					$i=1;
					$data["item_number"]=$kode;
					if($c_gudang>=0)$data["warehouse_code"]=$emapData[$c_gudang];
					if($c_tanggal>=0)$data["date_received"]=$emapData[$c_tanggal];
					if($c_person>=0)$data["receipt_by"]=$emapData[$c_person];
					if($c_qty>=0)$data["quantity_received"]=$emapData[$c_qty];
					if($c_unit>=0)$data["unit"]=$emapData[$c_unit];
					if($c_cost>=0 ) {
						if(count($emapData)-1>5) {
							$data["cost"]=$emapData[$c_cost];
						} else {
							$data["cost"]=0;
						}
					}
					$data["create_by"]=user_id();
					$ok=$this->inventory_products_model->save($data);
				}
			}
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
				$this->nomor_bukti(true);
			}			
			fclose($file);
			if ($ok){echo json_encode(array("success"=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
		}
		echo "<div class='alert alert-success'>FINISH.</div>";
	}
	
    
}
