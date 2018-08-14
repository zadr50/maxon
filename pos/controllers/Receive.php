<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Receive extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_products';
    private $sql="select shipment_id,ip.item_number,i.description
        ,date_received,quantity_received,ip.unit,ip.cost,ip.warehouse_code
                from inventory_products ip left join inventory i
                on ip.item_number=i.item_number
                where receipt_type='ETC_IN' 
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
            $data['mode']='';
            $data['message']='';
            $data['item_number_list']=$this->inventory_model->item_list();
			$data['date_received']=date("Y-m-d H:i:s");
			if($record==NULL)$data['shipment_id']=$this->nomor_bukti();			
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
            $data['receipt_type']='etc_in';
			$data['shipment_id']=$this->nomor_bukti();
			$id=$this->inventory_products_model->save($data);
			$this->nomor_bukti(true);
            $data['message']='update success';
            $data['mode']='view';
			$this->syslog_model->add($id,"receive","add");

            $this->browse();
		} else {
			$data['mode']='add';
            $data['warehouse_list']=$this->shipping_locations_model->select_list();
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
		 $data['shipment_id']=$id;
		 $model=$this->inventory_products_model->get_by_id($id)->row();	
		 $data=$this->set_defaults($model);
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
	function browse($offset=0,$limit=10,$order_column='shipment_id',$order_type='asc')
	{
        $data['caption']='DAFTAR PENERIMAAN BARANG NON PURCHASE ORDER';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Nomor Bukti','Kode Barang','Nama Barang','Tanggal',
		'Qty','Unit','Cost','Gudang');
		$data['fields']=array('shipment_id','item_number','description','date_received',
		'quantity_received','unit','cost','warehouse_code');
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
		if($no!=''){
			$sql.=" and shipment_id='".$no."'";
		} else {
			$sql.=" and date_received between '$d1' and '$d2'";
			if($nama!='')$sql.=" and supplier_name like '$nama%'";	
		}
		if($gudang!="")$sql.=" and warehouse_code='".$gudang."'";
		if($item_no!="")$sql.=" and ip.item_number='".$item_no."'";
		$sql.=" and warehouse_code='".$this->access->current_gudang()."'";
        //$sql.=" limit $offset,$limit";
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
    function save_item(){
        $item_no=$this->input->post('item_number');
		$id=$this->input->post('shipment_id');
		$line=$this->input->post('line_number');
        $data['item_number']=$item_no;
        $data['quantity_received']=$this->input->post('quantity');
        $item=$this->inventory_model->get_by_id($data['item_number'])->row();
       	$cost=item_cost($item_no);
        $data['cost']=$cost;
        $data['unit']=$this->input->post('unit');
        $data['shipment_id']=$id;
        $data['warehouse_code']=$this->input->post('warehouse_code');
        $data['total_amount']=$data['quantity_received']*$data['cost'];
		$data['receipt_type']='ETC_IN';
		$data['date_received']=$this->input->post('date_received');;
		$data['comments']=$this->input->post('comments');;
		
		if($line>0){
			$ok=$this->inventory_products_model->update($line,$data);			
		} else {
			$ok=$this->inventory_products_model->save($data);
		}
		if ($ok){
			echo json_encode(array('success'=>true,'shipment_id'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
            
        
        
	}         
    function print_bukti($nomor){
		$nomor=urldecode($nomor);
        $adj=$this->inventory_products_model->get_by_id($nomor)->row();
		$data['shipment_id']=$adj->shipment_id;
		$data['date_received']=$adj->date_received;
		$data['warehouse_code']=$adj->warehouse_code;
		$data['comments']=$adj->comments;
		$data['content']=load_view('inventory/rpt/print_receive_etc',$data);
		$this->load->view('pdf_print',$data);

    }
    function del_item(){
    	$id=$this->input->post('line_number');
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
		p.unit,p.cost,p.id as line_number
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
