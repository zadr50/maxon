<?php if(!defined('BASEPATH'))	exit('No direct script access allowd');
 
class Stock_adjust extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_moving';
    
    private $sql="select distinct ip.transfer_id,
        concat(year(date_trans),'-',month(date_trans),'-',day(date_trans)) as date_trans,
        ip.from_location,ip.status,ip.trans_by,ip.comments
        from inventory_moving ip
        where trans_type='ADJ'"; 
    
    private $file_view='inventory/stock_adjust';
    private $primary_key='shipment_id';
    private $controller='receive';
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
                $data['trans_by']=user_id();
                $data['status']="OPEN";
			}
            $setwh['dlgBindId']="warehouse";
            $setwh['dlgRetFunc']="$('#from_location').val(row.location_number);";
            $setwh['dlgCols']=array( 
                        array("fieldname"=>"location_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"attention_name","caption"=>"Nama Toko","width"=>"180px"),
                        array("fieldname"=>"company_name","caption"=>"Kode Pers","width"=>"50px"),
                        array("fieldname"=>"company","caption"=>"Perusahaan","width"=>"200px")
                    );          
            $setwh['show_date_range']=false;
            $data['lookup_gudang']=$this->list_of_values->render($setwh);
            if($data['from_location']=='') $data['from_location']=$this->session->userdata('session_outlet','');          
            
            $opname['dlgBindId']="stock_opname";
            $opname['dlgRetFunc']="$('#transfer_id').val(result.transfer_id);
                selected_doc();";
            $opname['extra_fields']="<input type='hidden' id='outlet' name='outlet' >";
            $opname['show_checkbox']=true;
            $opname['show_date_range']=true;
            $opname['dlgCols']=array( 
                        array("fieldname"=>"transfer_id","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"date_trans","caption"=>"Tanggal","width"=>"100px"),
                        array("fieldname"=>"from_location","caption"=>"Gudang","width"=>"50px"),
                        array("fieldname"=>"trans_by","caption"=>"Dibuat Oleh","width"=>"150px"),
                        array("fieldname"=>"status","caption"=>"Status","width"=>"50px")
                    );          
            $opname['url_submit']=base_url("stock_adjust/selected_sop");
            $data['lookup_stock_opname']=$this->list_of_values->render($opname);
            
            return $data;
	}	
    function selected_sop(){
        $nomor=$this->input->post("ck");
        $outlet=$this->input->post("outlet");
        $list="";
        for($i=0;$i<count($nomor);$i++){
            if($i<count($nomor)-1){
                $list.="'$nomor[$i]',";                
            } else {
                $list.="'$nomor[$i]'";
            }
        }
        $nomor="";
        $sql="select item_number,sum(from_qty) as zqty from inventory_moving
        where transfer_id in ($list) group by item_number";
        if($q=$this->db->query($sql)){
            
            $nomor=$this->nomor_bukti();
            $this->nomor_bukti(true);
            
            foreach($q->result() as $r){
                $item_number=$r->item_number;
                if($item_number!=""){
                    $unit="";               $qty_stock=0;
                    $qty=$r->zqty;          $qty_adjust=0;
                    $cost=0;
                    if($qitem=$this->db->query("select cost,unit_of_measure from inventory 
                        where item_number='$item_number'")){
                        if($ritem=$qitem->row()){
                            $cost=$ritem->cost;
                        }
                    }
                    if($qitem=$this->db->query("select quantity from inventory_warehouse 
                        where item_number='$item_number' and warehouse_code='$outlet'")){
                        if($ritem=$qitem->row()){
                            $qty_stock=$ritem->quantity;
                        }
                    }
                    $qty_adjust=$qty-$qty_stock;
                    $data['transfer_id']=$nomor;
                    $data['date_trans']=date("Y-m-d H:i:s");
                    $data["trans_by"]=user_id();
                    $data["item_number"]=$item_number;
                    $data["unit"]=$unit;
                    $data["from_qty"]=$qty;
                    $data["to_qty"]=$qty_adjust;
                    $data["from_location"]=$outlet;
                    $data["to_location"]=$data["from_location"];
                    $data["total_amount"]=$qty*$cost;
                    $data["trans_type"]="ADJ";
                    $ok=$this->inventory_moving_model->save($data);
                    
                }
            }
        }
       echo json_encode(array("success"=>true,"msg"=>"Success","transfer_id"=>$nomor));
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
       	 $data=$this->get_posts();
 		 $id=$data['transfer_id'];
		 $ok=$this->inventory_moving_model->update($id,$data);
		 if($ok){		 	
		    $msg='Update Success';
			$this->syslog_model->add($id,"stock_adjust","edit");
		} else {
			$msg='Error Update';
		}	  
 		echo json_encode(array("success"=>$ok,"msg"=>$msg));
	}
	
	function view($id,$message=null){
		if(!allow_mod2('_80120'))return false;   
		$id=urldecode($id);
		 $data['transfer_id']=$id;
		 $model=$this->inventory_moving_model->get_by_id($id)->row();	
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         //$data['warehouse_list']=$this->shipping_locations_model->select_list();
		$this->template->display_form_input('inventory/stock_adjust',$data);
	}
	function items($nomor,$type='')
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.from_qty,p.to_qty, 
		p.unit,p.cost,p.from_location,p.id as line_number,p.multi_unit,p.mu_qty
		from inventory_moving p
		left join inventory i on i.item_number=p.item_number
		where transfer_id='$nomor'";
		 
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
        
        $data['fields_caption']=array('Nomor Bukti','Tanggal','Gudang','Status','By','Comments');
        $data['fields']=array('transfer_id', 'date_trans','from_location','status','trans_by','comments');
					
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
		if(!allow_mod2('_80123'))return false;   
		$id=urldecode($id);
		
	 	$this->inventory_moving_model->delete($id);
		$this->syslog_model->add($id,"stock_adjust","delete");

	 	$this->browse();
	}	
	 
        function save_item(){
            $item_no=$this->input->post('item_number');
			$id=$this->input->post('transfer_id');
            $gudang=$this->input->post('from_location');
            $unit=$this->input->post('unit');
            $qty_stock=0;
            $qty_adj=0;
			$qty=$this->input->post("quantity");
			if($id=="AUTO"){
			    $id=$this->nomor_bukti();
                $this->nomor_bukti(true);
			}
            $item=$this->inventory_model->get_by_id($item_no)->row();
            if($item){
            	$cost=nz($item->cost);                
                if($unit=="") $unit=ns($item->unit_of_measure);
            } else {
            	$cost=0;
            }
            if($qitem=$this->db->query("select quantity from inventory_warehouse 
                where item_number='$item_no' and warehouse_code='$gudang'")){
                if($ritem=$qitem->row()){
                    $qty_stock=$ritem->quantity;
                }
            }
            $qty_adj=$qty-$qty_stock;
                
            $data['item_number']=$item_no;
            $data['from_qty']=$qty_stock;
            $data["to_qty"]=$qty;
            $data['cost']=$cost;
            $data['unit']=$unit;
            $data['transfer_id']=$id;
            $data['from_location']=$gudang;
            $data['to_location']=$gudang;
            $data['total_amount']=$qty_adj*$cost;
			$data['trans_type']='ADJ';
			$data['date_trans']=$this->input->post('date_trans');;
			$data['comments']=$this->input->post('comments');;
			$data['trans_by']=$this->input->post("trans_by");
			
			$mu_qty = $this->input->post("mu_qty");
			
			$data['multi_unit']=$this->input->post('multi_unit');
			if($data['multi_unit']==$data['unit'] || $data['multi_unit']==""){
				$mu_qty=$qty;
			} 
			$data['mu_qty']=$mu_qty; 
						
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
        function print_adjust($nomor){
			$nomor=urldecode($nomor);
            $adj=$this->inventory_moving_model->get_by_id($nomor)->row();
			$data['transfer_id']=$adj->transfer_id;
			$data['date_trans']=$adj->date_trans;
			$data['from_location']=$adj->from_location;
			$data['comments']=$adj->comments;
			$data['content']=load_view('inventory/rpt/print_adjust',$data);
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

}
