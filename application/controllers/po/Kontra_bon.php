<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Kontra_bon extends CI_Controller {
    private $limit=10;
    private $sql="select nomor,tanggal,i.termin,tgl_jth_tempo,i.supplier_number,s.supplier_name,
		    amount,paid
            from payables_bill_header i
            left join suppliers s on s.supplier_number=i.supplier_number";
    private $controller='po/kontra_bon';
    private $primary_key='purchase_order_number';
    private $file_view='purchase/kontra_bon';
    private $table_name='payables_bill_header';
	
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('supplier_model');
		$this->load->model('type_of_payment_model');
		$this->load->model('syslog_model');
        $this->load->model('receive_item_model');
        $this->load->model('purchase/payables_bill_header_model');
        $this->load->model('purchase/payables_bill_detail_model');
		 
	}
	function set_defaults($record=NULL){
		$data=data_table($this->table_name,$record);
        if(!$record){
    		$data['mode']='';
    		$data['message']='';
    		$data['nomor']="AUTO";    //$this->nomor_bukti();
    		$data['tanggal']= date("Y-m-d");
    		$data['tgl_jth_tempo']=date("Y-m-d");
    		$data['termin']="KREDIT";
        }
        $data['lookup_suppliers']=$this->supplier_model->lookup();
        $data['lookup_receive']=$this->receive_item_model->lookup(
            array("dlgRetFunc"=>"add_receive_no(row.shipment_id);"
        ));
        
		return $data;
	}
	function index()
	{	
		//if(!allow_mod2('kontra_bon_beli'))return false;
        $this->browse();
	}
	function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
	}
	function nomor_bukti($add=false)
	{
		$key="Kontra Bon Beli Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!KBB~$00001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!KBB~$00001');
				$rst=$this->payables_bill_header_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}

	function add()
	{
		//if(!allow_mod2('_40131'))return false;
		
	 	$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
		$data['message']='';
        $data['supplier_info']=$this->supplier_model->info($data['supplier_number']);
        $data['terms_list']=$this->type_of_payment_model->select_list();
		$this->template->display_form_input($this->file_view,$data,'');			                 
		
	}
	function save(){
		$data=$this->input->post();
		$id=$data['nomor'];
		$mode=$data['mode'];unset($data['mode']);
		if($mode=="add"){
	        $id=$this->nomor_bukti();
			$data['nomor']=$id;
			if($ok=$this->payables_bill_header_model->save($data)){
				$this->syslog_model->add($id,"payables_bill_header","add");
				$this->nomor_bukti(true);
			}
		} else {
			unset($data['nomor']);
			$ok=$this->payables_bill_header_model->update($id,$data);			
			$this->syslog_model->add($id,"payables_bill_header","edit");
		}
         $this->session->set_userdata('nomor',$id);		 
		
		if ($ok){
			echo json_encode(array('success'=>true,'nomor'=>$id,"msg"=>"Success"));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	function items($nomor)
	{
		$nomor=urldecode($nomor);
		$sql="select faktur,tanggal,jumlah,saldo,id
		from payables_bill_detail p 
		where nomor='$nomor'";		 
		echo datasource($sql);
	}
	function view($id,$message=null){
		//if(!allow_mod2('_40130'))return false;
		$id=urldecode($id);
		 $this->payables_bill_header_model->recalc($id);
		 $model=$this->payables_bill_header_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['nomor']=$id;
		 $data['mode']='view';
         $data['message']=$message;
         $data['supplier_info']=$this->supplier_model->info($data['supplier_number']);
         $data['terms_list']=$this->type_of_payment_model->select_list();
		
		 $this->load->model('periode_model');
		 $data['closed']=$this->periode_model->closed($data['tanggal']);
         //$left='purchase/menu_purchase_invoice';
		 //$this->session->set_userdata('_right_menu',$left);
         $this->session->set_userdata('nomor',$id);		 
         $this->template->display('purchase/kontra_bon',$data);                 
	}
   
	function _set_rules(){	
		 $this->form_validation->set_rules('nomor','Nomor', 'required|trim');
		 $this->form_validation->set_rules('tanggal','Tanggal','callback_valid_date');
	}
	 
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date',
		 'Format tanggal salah, seharusnya yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
    function browse($offset=0,$limit=50,$order_column='nomor',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor','Tanggal','Jth Tempo','Termin',
		'Jumlah','Supplier#','Supplier Name','Paid');
		$data['fields']=array('nomor','tanggal','tgl_jth_tempo','termin','amount', 
                'supplier_number','supplier_name','paid');
		$data['field_key']='nomor';
		$data['caption']='DAFTAR KONTRA BON PEMBELIAN';
		$data['posting_visible']=false;
        $data['fields_format_numeric']=array("amount");

		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor","sid_number");
		$faa[]=criteria("Supplier","sid_supplier");
		$faa[]=criteria("Paid","sid_paid");

		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
            
        $sql=$this->sql." where 1=1 ";
        
        $search="";
        if($this->input->get("tb_search")){
            $search=$this->input->get("tb_search");
            $sql.=" and nomor = '$search'";
        } else {
        
        	if($this->input->get('sid_number')!=''){
        		$sql.=" and nomor='".$this->input->get('sid_number')."'";
    		} else {
    			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
    			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
    			$sql.=" and tanggal between '".$d1."' and '".$d2."'";
    			if($this->input->get('sid_supplier')!='')$sql.=" and supplier_name like '".$this->input->get('sid_supplier')."%'";
    			if($this->input->get('sid_paid')!=''){
    				if($this->input->get('sid_paid')=='1'){
    					$sql.=" and paid=true";
    				} else {
    					$sql.=" and (paid=false or paid is null)";				
    				}
    			}
    		}
            
        }
         
        
        echo datasource($sql);
    }	 
	function delete($id){
		//if(!allow_mod2('_40133'))return false;
		$id=urldecode($id);
		$this->db->query("delete from payables_bill_detail where nomor='$id'");
		$this->db->query("delete from payables_bill_header where nomor='$id'");
		echo json_encode(array("success"=>true,"msg"=>"Berhasil hapus nomor ini."));		
		$this->syslog_model->add($id,"payables_bill_header","delete");
	}
	function detail(){
		$data['nomor']=isset($_GET['nomor'])?$_GET['nomor']:'';
		$data['po_date']=isset($_GET['po_date'])?$_GET['po_date']:'';
		$data['supplier_number']=isset($_GET['supplier_number'])?$_GET['supplier_number']:'';
		$data['comments']=isset($_GET['comments'])?$_GET['comments']:'';
		$data['potype']='I';
		$data['terms']=isset($_GET['terms'])?$_GET['terms']:'';
		$this->purchase_invoice_model->save($data);
		$this->sysvar->autonumber_inc("Purchase Invoice Numbering");
		$data['supplier_info']=$this->supplier_model->info($data['supplier_number']);            
		$this->template->display('purchase/purchase_invoice_detail',$data);
	}
	function view_detail($nomor){
		$nomor=urldecode($nomor);
		$this->load->model('purchase_order_lineitems_model');
		echo $this->purchase_order_lineitems_model->browse($nomor);
    }
        function add_item(){            
            if(isset($_GET)){
                $data['purchase_order_number']=$_GET['purchase_order_number'];
            } else {
                $data['purchase_order_number']='';
            }
           $this->load->model('inventory_model');
           $data['item_lookup']=$this->inventory_model->item_list();
            $this->load->view('purchase/purchase_invoice_add_item',$data);
        }   
        function save_item(){ 
            //$this->load->model('payables_bill_detail_model');
			$kontra_bon=$this->session->userdata('nomor');	
			$faktur=$this->input->post('faktur');
			$ok=false;
			$message="Tidak ada nomor faktur yang dipilih !";
			if($kontra_bon!=""){
				for($i=0;$i<count($faktur);$i++){
					$no=$faktur[$i];
					if($no!=""){
						if($q=$this->db->where("purchase_order_number",$no)->get("purchase_order")){
							if($r=$q->row()){
							    $amount=$r->amount;
                                if($r->potype=='R')$amount=$r->amount*-1;
								$d['nomor']=$kontra_bon;
								$d['faktur']=$no;
								$d['tanggal']=$r->po_date;
								$d['jumlah']=$amount;
								$d['saldo']=$r->saldo_invoice;
								$this->db->insert("payables_bill_detail",$d);
							}
						}
					}
					$ok=true;
					$message="Faktur sudah ditambahkan, silahkan refresh !";
				}
			}
            //$item_no=$this->input->post('item_number');
            //$ok=$this->payables_bill_detail_model->save($data);
            $amount=$this->db->query("select sum(jumlah) as z from payables_bill_detail 
                where nomor='$kontra_bon'")->row()->z;
            $this->db->query("update payables_bill_header set amount='$amount' where nomor='$kontra_bon'");
			$data['success']=$ok;
			$data['message']=$message;
			$data['amount']=$amount;
			echo json_encode($data);
			
        }        
        function delete_item($id){
			$id=urldecode($id);
            $kontra_bon="";
            if($q=$this->db->query("select nomor from payables_bill_detail where id='$id'")){
                if($r=$q->row()){
                    $kontra_bon=$r->nomor;
                }
            }
            $data['success']=$this->db->where("id",$id)->delete("payables_bill_detail");
            $amount=$this->db->query("select sum(jumlah) as z from payables_bill_detail 
                where nomor='$kontra_bon'")->row()->z;
            $this->db->query("update payables_bill_header set amount='$amount' where nomor='$kontra_bon'");
            $data['amount']=$amount;
            
            
            
			echo json_encode($data);
        }        
        function print_faktur($nomor){
			$nomor=urldecode($nomor);
            $data=$this->payables_bill_header_model->get_by_id($nomor)->row_array();
		 
			$data['content']=load_view('purchase/print_kontra_bon',$data);
			$this->load->view('pdf_print',$data);
        }
		function print_po_kontra_bon($nomor){
			$this->print_faktur($nomor);
		}
        function summary_info($nomor){
			$nomor=urldecode($nomor);
            return "";            
        }
         

	function daftar_saldo_faktur()
	{
		$sql="select p.purchase_order_number , p.po_date ,
		s.supplier_name,p.terms,p.amount,p.due_date
		from purchase_order p
		left join suppliers s on s.supplier_number=p.supplier_number
		where potype='I' and (p.due_date<=".date("Y-m-d")." or p.due_date is null) 
		order by p.po_date asc limit 5";
		echo datasource($sql);
	}
	function amount_paid($faktur){return $this->purchase_invoice_model->paid_amont($faktur);}
	function amount_retur($faktur){return $this->purchase_invoice_model->retur_amount($faktur);}
	function amount_crdb($faktur){return $this->purchase_invoice_model->crdb_amount($faktur);}
	 
	function find($nomor){
		$this->load->model('purchase_invoice_model');

		$sql="select purchase_order_number,po_date,due_date,amount,terms,paid,closed 
		from purchase_order 
		where purchase_order_number='$nomor'";
		
		$saldo=$this->purchase_invoice_model->recalc($nomor);
		$query=$this->purchase_invoice_model->get_by_id($nomor)->row();
		$data['po_date']=$query->po_date;
		$data['amount']=number_format($query->amount);
		$data['saldo']=number_format($saldo);
		
		echo json_encode($data);
		
	}
	function select_faktur($supplier_number){
		$supplier_number=urldecode($supplier_number);

		$this->load->model('purchase_invoice_model');

		$sql="select purchase_order_number,po_date,due_date,amount,terms,
		i.supplier_number,s.supplier_name,i.potype
		from purchase_order i left join suppliers s on s.supplier_number=i.supplier_number
		where potype in ('I','R')
		and i.supplier_number='$supplier_number'";
 // and (paid=false or isnull(paid))
		$query=$this->db->query($sql);
		$i=0;
		$rows[0]='';
		$ok=false;
		if($query){ 
			foreach($query->result_array() as $row){
				$nomor=$row['purchase_order_number'];
				$saldo=$this->purchase_invoice_model->recalc($nomor);
                $amount=$row['amount'];
                $row['recv_no']=$this->get_recv_no_invoice($nomor);
                if($row['potype']=='R')$amount=-1*$amount;
				if($saldo!=0){
					$row['amount']=number_format($amount);
					$row['saldo']=number_format($saldo);
					$rows[$i++]=$row;
				}
				$ok=true;
			};
		}
		$data['success']=$ok;
		$data['faktur']=$rows;
		echo json_encode($data);
	} 
    function get_recv_no_invoice($nomor_faktur){
        $ret="";
        $s="select from_line_doc from purchase_order_lineitems 
        where purchase_order_number='$nomor_faktur' and from_line_doc<>'' limit 1";
        if($q=$this->db->query($s)){
            if($r=$q->row()){
                $ret=$r->from_line_doc;
            }
        }
        return $ret;
    }
    function supplier_info($supplier_number){
        $ret="";             $beli=0;
        $jual=0;
        $persent=0;
        $tahun=date("Y");   $bulan=date("m");
        $beli=$this->db->query("select sum(amount) as zamt 
            from purchase_order where supplier_number='$supplier_number' 
            and potype='o' and year(po_date)='$tahun' 
            and month(po_date)='$bulan'")->row()->zamt;
        $jual=$this->db->query("select sum(il.amount) as zamt 
            from invoice_lineitems il left join invoice i on i.invoice_number=il.invoice_number 
            left join inventory s on s.item_number=il.item_number
            where s.supplier_number='$supplier_number' 
            and invoice_type='I' and year(invoice_date)='$tahun' 
            and month(invoice_date)='$bulan'")->row()->zamt;
        $persent=($jual/$beli)*100;
                    
        if($qsup=$this->db->where("supplier_number",$supplier_number)->get('suppliers')){
            if($rsup=$qsup->row()){
                $ret.="<strong>$rsup->supplier_name</strong>
                <br>$rsup->street - $rsup->city - $rsup->first_name
                <br>Total pembelian bulan ini: ".number_format($beli)." 
                <br>Total penjualan : ".number_format($jual)." 
                <br>Persentase: ".number_format($persent)."%";
                
            }
        }
        echo  $ret;
    }
    function add_receive_no($nomor_recv,$nomor_kontra){
        $success=false;
        $msg="Unknown Error";
        $s="select ip.shipment_id as faktur,date_format(ip.date_received,'%Y-%m-%d') as tanggal,
            sum(ip.total_amount) as jumlah
            from inventory_products ip
            where ip.shipment_id='$nomor_recv'
        ";
        if($qrcv=$this->db->query($s)){
            if($rcv=$qrcv->row()){
                $success=true;
                $msg="Sucess, data sudah tersimpan.";
                $item["nomor"]=$nomor_kontra;
                $item["faktur"]=$rcv->faktur;
                $item["tanggal"]=$rcv->tanggal;
                $item["jumlah"]=$rcv->jumlah;
                $item["saldo"]=$item["jumlah"];
                $this->payables_bill_detail_model->save($item);
            }
        }
        $data["success"]=$success;
        $data["msg"]=$msg;
        echo json_encode($data);
    }
	
}
