<?php if(!defined('BASEPATH'))	exit('No direct script access allowd');
 
class Stock_mutasi extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_moving';
    private $sql="select distinct ip.transfer_id,
        date_format(date_trans,'%Y-%m-%d') as date_trans,ip.from_location,ip.to_location
        ,ip.status
                from inventory_moving ip 
                where  ip.from_location<>ip.to_location 
                ";
    private $file_view='inventory/stock_mutasi';
    private $primary_key='transfer_id';
    private $controller='stock_mutasi';
	function __construct()
	{
		parent::__construct();        
      
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','browse_select'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('inventory_moving_model');
        $this->load->library('sysvar');
        $this->load->library('javascript');
		$this->load->model('shipping_locations_model');
		$this->load->model('inventory_model');
		$this->load->model('syslog_model');
		$this->load->library("list_of_values");
		
	}
	function index()
	{
		if(!allow_mod2('_80040'))return false;   
        $this->browse();
	}
	function nomor_bukti($add=false)
	{
		$key="Transfer Stock Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!TRX~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!TRX~$00001');
				$rst=$this->inventory_moving_model->get_by_id($no)->row();
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
            $data['mode']='add';
            $data['message']='';
			if($record==NULL) {
				$data['transfer_id']="AUTO";    //$this->nomor_bukti();			
				$data['date_trans']=date("Y-m-d H:i:s");
			}
			$data['doc_type']="MUTASI";
			$data['status_list']=array("0"=>"Not Verified","1"=>"Verified","2"=>"Canceled");
			$data['doc_type_list']=array("MUTASI"=>"MUTASI","ROLLING"=>"ROLLING");

            $setwh['dlgBindId']="warehouse";
            $setwh['dlgRetFunc']="$('#from_location').val(row.location_number);";
            $setwh['dlgCols']=array( 
                        array("fieldname"=>"location_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"attention_name","caption"=>"Nama Toko","width"=>"180px"),
                        array("fieldname"=>"company_name","caption"=>"Kode Pers","width"=>"50px"),
                        array("fieldname"=>"company","caption"=>"Perusahaan","width"=>"200px")
                    );          
            $data['lookup_gudang']=$this->list_of_values->render($setwh);
			
			$data['lookup_gudang2']=$this->list_of_values->render(
			array(
				"dlgBindId"=>"warehouse2",
				"dlgRetFunc"=>"$('#to_location').val(row.location_number);",
				"dlgCols"=>array(
                        array("fieldname"=>"location_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"attention_name","caption"=>"Nama Toko","width"=>"180px"),
                        array("fieldname"=>"company_name","caption"=>"Kode Pers","width"=>"50px"),
                        array("fieldname"=>"company","caption"=>"Perusahaan","width"=>"200px")					
				)
			));
			$data['lookup_inventory']=$this->list_of_values->lookup_inventory();
			
            return $data;
	}	
	function get_posts(){
		$data['transfer_id']=$this->input->post('transfer_id');
		$data['from_location']=$this->input->post('from_location');
		$data['to_location']=$this->input->post('to_location');
		$data['date_trans']=$this->input->post('date_trans');
		$data['from_qty']=$this->input->post('from_qty');              
		$data['item_number']=$this->input->post('item_number');              
		$data['unit']=$this->input->post('unit');              
		$data['status']=$this->input->post('status');       
		$data['doc_type']=$this->input->post("doc_type");
                
		return $data;
	}
	function add()
	{
		if(!allow_mod2('_80041'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();		 
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['from_location']=current_gudang();
			$data['transfer_id']=$this->nomor_bukti();
			$id=$this->inventory_moving_model->save($data);
			$this->nomor_bukti(true);
            $data['message']='update success';
            $data['mode']='view';
			$this->syslog_model->add($id,"stock_mutasi","add");

            $this->browse();
		} else {
			$data['mode']='add';
			$data['message']='';			 
			$this->load->model("user_model");
			$gudang=$this->user_model->roles_gudang();
			if(is_array($gudang))$gudang=$gudang[0];
            $data['from_location']=current_gudang();
            $data['warehouse_list']=$this->shipping_locations_model->select_list();
			$this->template->display_form_input('inventory/stock_mutasi',$data);			
		}
	}
	function update()
	{
       	 $data=$this->get_posts();
 		 $id=$data['transfer_id'];
		 $ok=$this->inventory_moving_model->update($id,$data);
		 if($ok){		 	
		    $msg='Update Success';
			$this->syslog_model->add($id,"stock_mutasi","edit");
		} else {
			$msg='Error Update';
		}	  
 		echo json_encode(array("success"=>$ok,"msg"=>$msg));
	}
	
	function view($id,$message=null){
		$id=urldecode($id);
		 $data['transfer_id']=$id;
		 $model=$this->inventory_moving_model->get_by_id($id)->row();	
		 //var_dump($model);
		 $data=$this->set_defaults($model);
		 $data['doc_type']=$model->doc_type;
		 $data['mode']='view';
         $data['warehouse_list']=$this->shipping_locations_model->select_list();
		$this->template->display_form_input('inventory/stock_mutasi',$data);
	}
	function items($nomor,$type='')
	{
		$nomor=urldecode($nomor);
            $sql="select p.item_number,i.description,p.from_qty, 
            p.unit,p.cost,p.id as line_number,p.multi_unit,p.mu_qty,p.cost_account,
            concat(c.account,' - ',c.account_description) as account,p.total_amount
            from inventory_moving p
            left join inventory i on i.item_number=p.item_number
            left join chart_of_accounts c on p.cost_account=c.id
            where transfer_id='$nomor'";
			 
			echo datasource($sql);
	}
	
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('transfer_id','Transfer Number', 'required|trim');
		 $this->form_validation->set_rules('date_trans','Tanggal', 'required|trim');
	}
	
	 // date_validation callback
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',$str))
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
        $data['caption']='DAFTAR TRANSFER STOCK';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Gudang Sumber',
		  'Gudang Tujuan','Keterangan','Status');
		$data['fields']=array('transfer_id', 'date_trans',
		  'from_location','to_location','comments','status');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		  		$data['field_key']='transfer_id';
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","sid_nomor");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
		$sql=$this->sql;
		$no=$this->input->get('sid_nomor');
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));

		if($no!=''){
			$sql.=" and transfer_id='".$no."'";
		} else {
			$sql.=" and date_trans between '$d1' and '$d2'";
		}
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        echo datasource($sql);
    }
	 
	function delete($id){
		if(!allow_mod2('_80043'))return false;   
		$id=urldecode($id);
	 	$this->inventory_moving_model->delete($id);
		$this->syslog_model->add($id,"stock_mutasi","delete");

	 	$this->browse();
	}	
	 
    function save_item(){
			$this->load->model("user_model");
			$gudang=$this->user_model->roles_gudang();

            $item_no=$this->input->post('item_number');
			$id=$this->input->post('transfer_id');
            if($id=="AUTO"){
                $id=$this->nomor_bukti();
                $this->nomor_bukti(true);
            }
            $data['item_number']=$item_no;
            $data['from_qty']=$this->input->post('quantity');
            $data['to_qty']=$this->input->post('quantity');
			$data["cost"]=$this->input->post("cost");
			$data['total_amount']=$this->input->post('total_amount');
            $data['unit']=$this->input->post('unit');
			if($data['cost']==0 || $data["cost"]==""){
	            $item=$this->inventory_model->get_by_id($data['item_number'])->row();
	            if($item){
	            	$data['cost']=$item->cost;
				}				
			}
			$data['total_amount']=$data['cost']*$data['from_qty'];
            $data['transfer_id']=$id;
            $data['from_location']=$this->input->post('from_location');
			if(!$data['from_location']){
				if(is_array($gudang))$gudang=$gudang[0];
				$data['from_location']=$gudang;
			}
            $data['to_location']=$this->input->post('to_location');
			$data['date_trans']=$this->input->post('date_trans');;
			$data['comments']=$this->input->post('comments');
			$data['status']=$this->input->post('status');
			$data['doc_type']=$this->input->post("doc_type");
			$data['multi_unit']=$this->input->post('multi_unit');
			$data['mu_qty']=$this->input->post("mu_qty");
			$data['cost_account']=account_id($this->input->post("cost_account"));
			
			$line=$this->input->post('id');
			if($line==""){
				$ok=$this->inventory_moving_model->save($data);
			} else {
				$ok=$this->inventory_moving_model->update($line,$data);				
			}
			if ($ok){
				echo json_encode(array('success'=>true,'transfer_id'=>$id));
			} else {
				echo json_encode(array('msg'=>'Some errors occured.'));
			}
	}         
    function print_bukti($nomor){
		if(!allow_mod2('_80044'))return false;   
		$nomor=urldecode($nomor);
        $mov=$this->inventory_moving_model->get_by_id($nomor)->row();
		$data['transfer_id']=$mov->transfer_id;
		$data['item_number']=$mov->item_number;
		$data['from_location']=$mov->from_location;
		$data['to_location']=$mov->to_location;
		$data['quantity']=$mov->from_qty;
		$data['date_trans']=$mov->date_trans;
		$data['comments']=$mov->comments;
		$data['content']=load_view('inventory/rpt/print_mutasi',$data);
		$this->load->view('pdf_print',$data);
    }
    function del_item($id){
    	$id=urldecode($id);
        $ok=$this->inventory_moving_model->delete_item($id);
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
    }        
	function verify($nomor){
		$nomor=urldecode($nomor);
		$status=$this->db->select("status")->where("transfer_id",$nomor)
			->get("inventory_moving")
			->row()->status;
		if($status=="0" || $status==""){
			$data["verify_by"]=user_id();
			$data["verify_date"]=date("Y-m-d H:i:s");
			$data["status"]=$this->input->get("status");
			$this->db->where("transfer_id",$nomor)->update("inventory_moving",$data);
			echo "Sukses nomor sudah diupdate statusnya.";
		} else {
			echo "Nomor ini tidak bisa diubah statusnya";
		}
	}
	function posting($nomor){
		$this->inventory_moving_model->posting($nomor);
		redirect("stock_mutasi/view/$nomor");
	}
	function unposting($nomor){
		$this->inventory_moving_model->unposting($nomor);
		redirect("stock_mutasi/view/$nomor");		
	}

}
