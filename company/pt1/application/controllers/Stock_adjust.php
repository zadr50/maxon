<?php if(!defined('BASEPATH'))	exit('No direct script access allowd');
 
class Stock_adjust extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_products';
    private $sql="select shipment_id,ip.item_number,i.description
        ,date_received,quantity_received,ip.unit,ip.cost,ip.warehouse_code
                from inventory_products ip left join inventory i
                on ip.item_number=i.item_number
                where receipt_type='adj' 
                ";
    private $file_view='inventory/stock_adjust';
    private $primary_key='shipment_id';
    private $controller='receive';
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
		$this->load->helper(array('url','form','browse_select'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('inventory_products_model');
        $this->load->library('sysvar');
        $this->load->library('javascript');
		$this->load->model('shipping_locations_model');
		$this->load->model('inventory_model');
		$this->load->model('syslog_model');
	}
	function index()
	{
		if(!allow_mod2('_80120'))return false;   
        $this->browse();
	}
	function nomor_bukti($add=false)
	{
		$key="Adjust Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!ADJ~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!ADJ~$00001');
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
            $data['mode']='add';
            $data['message']='';
			if($record==NULL) {
				$data['shipment_id']="AUTO";    //$this->nomor_bukti();			
				$data['date_received']=date("Y-m-d H:i:s");
			}
            return $data;
	}	
	function get_posts(){
		$data['shipment_id']=$this->input->post('shipment_id');
		$data['supplier_number']=$this->input->post('supplier_number');
		$data['date_received']=$this->input->post('date_received');
		$data['package_no']=$this->input->post('package_no');              
                $data['receipt_type']='ADJ';
                
		return $data;
	}
	function add()
	{
		if(!allow_mod2('_80121'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();		 
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['receipt_type']='ADJ';
            $data['warehouse_code']=$this->access->cid;
			$data['shipment_id']=$this->nomor_bukti();
			$id=$this->inventory_products_model->save($data);
			$this->nomor_bukti(true);
            $data['message']='update success';
            $data['mode']='view';
			$this->syslog_model->add($id,"stock_adjust","add");

            $this->browse();
		} else {
			$data['mode']='add';
			$data['message']='';			 
            $data['warehouse_list']=$this->shipping_locations_model->select_list();
			$this->template->display_form_input('inventory/stock_adjust',$data);			
		}
	}
	function update()
	{
		 $data=$this->set_defaults(); 
        	 $data=$this->get_posts();
		 $this->_set_rules();
 		 $id=$this->input->post('shipment_id');
             
		 if ($this->form_validation->run()=== TRUE){
			$this->inventory_card_header_model->update($id,$data);
		    $data['message']='update success';
			$this->syslog_model->add($id,"stock_adjust","edit");

		} else {
			$data['message']='Error Update';
		}
	  
 		$this->view($id);		
	}
	
	function view($id,$message=null){
		if(!allow_mod2('_80120'))return false;   
		$id=urldecode($id);
		 $data['shipment_id']=$id;
		 $model=$this->inventory_products_model->get_by_id($id)->row();	
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['warehouse_list']=$this->shipping_locations_model->select_list();
		$this->template->display_form_input('inventory/stock_adjust',$data);
	}
	function items($nomor,$type='')
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.quantity_received, 
		p.unit,p.cost,p.id as line_number
		from inventory_products p
		left join inventory i on i.item_number=p.item_number
		where shipment_id='$nomor'";
		 
		echo datasource($sql);
	}
	
         
	function load_items($id){
		$id=urldecode($id);
		$this->load->model('inventory_moving_model');
		$this->inventory_moving_model->recalc($id);
		$sql="select i.item_number,s.description,i.from_qty as qty,i.id
			from inventory_moving i
			left join inventory s on s.item_number=i.item_number
			where transfer_id='".$id."'";
		 
		$data=browse_select(array('sql'=>$sql,'show_action'=>true,
			'action_button'=>'<input value="Del" type="button" onclick="del_row(#id);return false;"/>',
			'fields_input'=>array('sumber','tujuan'),
			'field_key'=>'id'
			));
	   // <input  value="Upd" type="button" onclick="upd_row(#id);return false;"/>''
		return $data; 
    }
        
         
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('shipment_id','Receive Number', 'required|trim');
		 $this->form_validation->set_rules('supplier_number','Supplier Number',	 'required');
		 $this->form_validation->set_rules('date_received','Tanggal', 'required|trim');
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
        $data['caption']='DAFTAR TRANSAKSI STOCK ADJUSTMENT';
		$data['controller']='stock_adjust';		
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Item Number','Description','Qty','Unit','Gudang','Keterangan');
		$data['fields']=array('shipment_id', 'date_received','item_number','description','quantity_received','unit','warehouse_code','comments');
		$data['field_key']='shipment_id';
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
			$sql.=" and shipment_id='".$no."'";
		} else {
			$sql.=" and date_received between '$d1' and '$d2'";
		}
        //$sql.=" limit $offset,$limit";
        echo datasource($sql);
    }
	 
	function delete($id){
		if(!allow_mod2('_80123'))return false;   
		$id=urldecode($id);
	 	$this->inventory_products_model->delete($id);
		$this->syslog_model->add($id,"stock_adjust","delete");

	 	$this->browse();
	}	
	 
        function save_item(){
            $item_no=$this->input->post('item_number');
			$id=$this->input->post('shipment_id');
			if($id=="AUTO"){
			    $id=$this->nomor_bukti();
                $this->nomor_bukti(true);
			}
            $data['item_number']=$item_no;
            $data['quantity_received']=$this->input->post('quantity');
            $item=$this->inventory_model->get_by_id($data['item_number'])->row();
            if($item){
            	$cost=$item->cost;
            } else {
            	$cost=0;
            }
            $data['cost']=$cost;
            $data['unit']=$this->input->post('unit');
            $data['shipment_id']=$id;
            $data['warehouse_code']=$this->input->post('warehouse_code');
            $data['total_amount']=$data['quantity_received']*$data['cost'];
			$data['receipt_type']='ADJ';
			$data['date_received']=$this->input->post('date_received');;
			$data['comments']=$this->input->post('comments');;
			
			$ok=$this->inventory_products_model->save($data);
			if ($ok){
				echo json_encode(array('success'=>true,'shipment_id'=>$id));
			} else {
				echo json_encode(array('msg'=>'Some errors occured.'));
			}
	            
            
            
		}         
        function print_adjust($nomor){
			$nomor=urldecode($nomor);
            $adj=$this->inventory_products_model->get_by_id($nomor)->row();
			$data['shipment_id']=$adj->shipment_id;
			$data['date_received']=$adj->date_received;
			$data['warehouse_code']=$adj->warehouse_code;
			$data['comments']=$adj->comments;
			$data['content']=load_view('inventory/rpt/print_adjust',$data);
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

}
