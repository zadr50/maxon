<?php if(!defined('BASEPATH'))	exit('No direct script access allowd');
 
class Stock_opname extends CI_Controller {
    private $limit=10;
    private $table_name='inventory_moving';
    private $sql="select distinct ip.transfer_id,
        concat(year(date_trans),'-',month(date_trans),'-',day(date_trans)) as date_trans,
        ip.from_location,ip.status,ip.trans_by,ip.status,ip.verify_by,ip.verify_date, ip.comments
        from inventory_moving ip
        where trans_type='opname' 
                ";
    private $file_view='inventory/stock_opname';
    private $primary_key='transfer_id';
    private $controller='stock_opname';
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
        $this->browse();
	}
	function nomor_bukti($add=false)
	{
		$key="Opname Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!OP~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!OP~$00001');
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
                $data['status']=0;
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
			$data['lookup_inventory']=$this->list_of_values->lookup_inventory();
            
            return $data;
	}	
	function get_posts(){
	    $data=$this->input->post();
		return $data;
	}
	function add()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();		 
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['trans_type']='OPNAME';
            $data['from_location']=current_gudang();
			$data['transfer_id']=$this->nomor_bukti();
			$id=$this->inventory_moving_model->save($data);
			$this->nomor_bukti(true);
            $data['message']='update success';
            $data['mode']='view';
			$this->syslog_model->add($id,"stock_opname","add");

            $this->browse();
		} else {
			$data['mode']='add';
			$data['message']='';			 
			$this->template->display_form_input($this->file_view,$data);			
		}
	}
	function update()
	{
		$data=$this->get_posts();
		$id=$data['transfer_id'];
	   $ok=$this->inventory_moving_model->update_bukti($id,$data);
	   if($ok){		 	
		  $msg='Update Success';
		  $this->syslog_model->add($id,"stock_opname","edit");
	  } else {
		  $msg='Error Update';
	  }	  
	   echo json_encode(array("success"=>$ok,"msg"=>$msg));
  }
	
	function view($id,$message=null){
		$id=urldecode($id);
		 $data['transfer_id']=$id;
		 $model=$this->inventory_moving_model->get_by_id($id)->row();	
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
		$this->template->display_form_input($this->file_view,$data);
	}
	function items($nomor)
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.to_qty as quantity, 
		p.unit,p.cost,p.total_amount,p.id as line_number
		from inventory_moving p
		left join inventory i on i.item_number=p.item_number
		where transfer_id='$nomor'";
		 
		echo datasource($sql);
	}
	
	 // validation rules
	function _set_rules(){	
	}
	function browse($offset=0,$limit=10,$order_column='transfer_id',$order_type='asc')
	{
        $data['caption']='DAFTAR TRANSAKSI STOCK OPNAME';
		$data['controller']=$this->controller;		
		$data['fields_caption']=array('Nomor Bukti','Tanggal','Gudang','Status','By','Verify','Comments');
		$data['fields']=array('transfer_id', 'date_trans','from_location','status','trans_by','verify_by','comments');
					
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
			$sql.=" and transfer_id='$no'";
		} else {
			$sql.=" and date_trans between '$d1' and '$d2'";
		}

        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
        }
        if($search!=""){
            $sql.=" and transfer_id like '%$search%'";
        }
        $sort_by=$this->my_setting->sort_by();
        if($sort_by=='1'){
            $sql.=" order by date_trans desc";
        } else {
            $sql.=" order by transfer_id";
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
	 	$ok = $this->inventory_moving_model->delete($id);
		$this->syslog_model->add($id,"stock_opname","delete");
	 	echo json_encode(array("success"=>true,"message"=>"Success"));
	}	
	 
    function save_item(){            
			$item_no=$this->input->post('item_number');
			$id=$this->input->post('transfer_id');
            $gudang=$this->input->post('from_location');
            $unit=$this->input->post('unit');
			$doc_type=$this->input->post("doc_type");
			if($doc_type=="")$doc_type=0;
			$status=$this->input->post("status");
			if($status=="")$status="OPEN";
			$date_trans=$this->input->post('date_trans');
			$comments=$this->input->post('comments');
			$trans_by=$this->input->post('trans_by');
			

            if($item_no==""){
                echo json_encode(array("success"=>false,"msg"=>"Pilih kode barang !"));
                return false;
            }
			$id=$this->input->post('transfer_id');
			if($id=="AUTO"){
			    $id=$this->nomor_bukti();
                $this->nomor_bukti(true);
			}
            $gudang=$this->input->post('from_location');
            
            $qty_stock=0;
            if($qitem=$this->db->query("select quantity from inventory_warehouse 
                where item_number='$item_no' and warehouse_code='$gudang'")){
                if($ritem=$qitem->row()){
                    $qty_stock=$ritem->quantity;
                }
            }
            $qty_adj=$this->input->post("quantity");
            
            $data['item_number']=$item_no;
            $data['from_qty']=$qty_stock;
			$data['to_qty']=$qty_adj;
            $qty_stock=0;
            $qty_adj=0;
			$qty=$this->input->post("quantity");
			
            $item=$this->inventory_model->get_by_id($data['item_number'])->row();
            if($item){
            	$cost=$item->cost;
            } else {
            	$cost=0;
            }
            $data['cost']=$cost;
            $data['unit']=$this->input->post('unit');
            $data['transfer_id']=$id;
            $data['from_location']=$this->input->post('from_location');
            $data['total_amount']=$qty_adj*$data['cost'];
			$data['trans_type']='OPNAME';
			$data['date_trans']=$this->input->post('date_trans');;
			$data['comments']=$this->input->post('comments');;
			$data['trans_by']=user_id();

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
						
			$this->db->where("transfer_id",$id)->update($this->table_name,array(
				"doc_type"=>$doc_type,"status"=>$status,"date_trans"=>$date_trans,
				"comments"=>$comments,"trans_by"=>$trans_by,'from_location'=>$gudang
			));
			
			if ($ok){
				echo json_encode(array('success'=>true,'transfer_id'=>$id));
			} else {
				echo json_encode(array('msg'=>'Some errors occured.'));
			}
	            
            
            
            
		}         
        function print_bukti($nomor){
			$nomor=urldecode($nomor);
            $mov=$this->inventory_moving_model->get_by_id($nomor)->row();
			$data['transfer_id']=$mov->transfer_id;
			$data['date_trans']=$mov->date_trans;
			$data['from_location']=$mov->from_location;
			$data['comments']=$mov->comments;
			$data['content']=load_view('inventory/rpt/print_opname',$data);
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
