<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Purchase_order extends CI_Controller {
        private $limit=10;
        private $sql="select purchase_order_number,po_date,
				c.supplier_name,i.received,i.terms,i.amount,i.doc_status,i.due_date,
				i.bill_to_contact,i.warehouse_code,i.type_of_invoice,i.supplier_number
                from purchase_order i
                left join suppliers c on c.supplier_number=i.supplier_number
                where i.potype='O'";
        private $controller='purchase_order';
        private $primary_key='purchase_order_number';
        private $file_view='purchase/purchase_order';
        private $table_name='purchase_order';
	function __construct()
	{
		parent::__construct();
		
		if(!$this->access->is_login())redirect(base_url());
        
         
		
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('purchase_order_model');
		$this->load->model('supplier_model');
		$this->load->model('inventory_model');
		$this->load->model('type_of_payment_model');
		$this->load->model('syslog_model');
		$this->load->model("warehouse_model");
		$this->load->library("list_of_values");
        $this->load->model('purchase_order_lineitems_model');
        $this->load->model('chart_of_accounts_model');
						 
	}
	function set_defaults($record=NULL){
            $data=data_table($this->table_name,$record);
			 
            $data['mode']='';
            $data['message']='';
            if($record==NULL){
				$data['purchase_order_number']=$this->nomor_bukti();
                $data['has_receive']=false;
	            $data['doc_status']="OPEN";
    		}
			$data['gdg']=$this->warehouse_model->loadlist();
			
			$setting['dlgBindId']="type_of_invoice";
			$setting['dlgRetFunc']="$('#type_of_invoice').val(row.varvalue);";
			$setting['dlgCols']=array( 
						array("fieldname"=>"varvalue","caption"=>"Kode","width"=>"80px"),
						array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
					);			
			$data['lookup_po_type']=$this->list_of_values->render($setting);

            if($data['type_of_invoice']=='')$data['type_of_invoice']="1";
            if($data['terms']=='')$data['terms']="KREDIT";
            $data['lookup_terms']=$this->type_of_payment_model->lookup();

			$setting['dlgBindId']="doc_status";
			$setting['sysvar_lookup']='po_status';
			$data['lookup_po_status']=$this->list_of_values->render($setting);
            
	
			
            
            $setting['dlgBindId']="req_no";
            $setting['dlgCols']=array( 
                array("fieldname"=>"req_no","caption"=>"Kode","width"=>"250px"),
                array("fieldname"=>"po_date","caption"=>"Tanggal","width"=>"200px"),
                array("fieldname"=>"due_date","caption"=>"Tanggal Req","width"=>"200px"),
                array("fieldname"=>"dept_code","caption"=>"Dept","width"=>"80px"),
                array("fieldname"=>"ordered_by","caption"=>"By","width"=>"200px")
            );
            unset($setting['sysvar_lookup']);
            $setting['dlgRetFunc']="$('#req_no').val(row.req_no);";
            $setting['show_date_range']=true;
            $data['lookup_req_no']=$this->list_of_values->render($setting);
            
            $setcom['dlgBindId']="preferences";
            $setcom['dlgRetFunc']="$('#bill_to_contact').val(row.company_code);";
            $setcom['dlgCols']=array( 
                        array("fieldname"=>"company_code","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"company_name","caption"=>"Perusahaan","width"=>"200px")
                    );          
            $setcom['show_date_range']=false;
            $data['lookup_company']=$this->list_of_values->render($setcom);
            if($data['bill_to_contact']=='')$data['bill_to_contact']=$this->session->userdata('session_company_code','');

            $setwh['dlgBindId']="warehouse";
            $setwh['dlgRetFunc']="$('#warehouse_code').val(row.location_number);
            $('#bill_to_contact').val(row.company_name);";
            $setwh['dlgCols']=array( 
                        array("fieldname"=>"location_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"attention_name","caption"=>"Nama Toko","width"=>"180px"),
                        array("fieldname"=>"company_name","caption"=>"Kode Pers","width"=>"50px"),
                        array("fieldname"=>"company","caption"=>"Perusahaan","width"=>"200px")
                    );          
            $setwh['show_date_range']=false;
            $data['lookup_gudang']=$this->list_of_values->render($setwh);
            if($data['warehouse_code']=='') $data['warehouse_code']=$this->session->userdata('session_outlet','');          
                        
            $data['lookup_suppliers']=$this->supplier_model->lookup();
            
            $data['allow_addnew_item']=$this->sysvar->getvar("allow_addnew_item","false");
            
            $data['lookup_coa_inventory']=$this->list_of_values->render(
                array("dlgBindId"=>"inventory_account",
                "dlgRetFunc"=>"$('#inventory_account').val(row.account); 
                $('#coa_inventory').val(row.account_description);",
                'dlgCols'=>array(
                    array("fieldname"=>"account","caption"=>"Account","width"=>"80px"),
                    array("fieldname"=>"account_description","caption"=>"Account Description","width"=>"300px")                    
                ))
            );
            return $data;
	}
	function index()
	{	
		if(!allow_mod2('_40040'))return false;
        $this->browse();
           
	}
	function get_posts(){
            $data=data_table_post($this->table_name);
            return $data;
	}
	function add()
	{
		if(!allow_mod2('_40041'))return false;
	 	$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
		$data['message']='';
        $data['supplier_number']='';
        $data['po_date']= date("Y-m-d");
		$data['supplier_info']='';
        $data['term_list']=$this->type_of_payment_model->select_list();
		$data['gdg']=$this->warehouse_model->loadlist();
        $data["expire_day"]=30;
        $data["po_expire_date"]=add_date($data["po_date"],$data["expire_day"]);
		$this->template->display_form_input($this->file_view,$data,'');			
	}
	function nomor_bukti($add=false)
	{
		return $this->purchase_order_model->nomor_bukti($add);
	}
	function save(){
	    
        $data=$this->get_posts();
		$mode=$this->input->post('mode');
        $id=$this->input->post('purchase_order_number');            
		if($mode=="add"){
            $id=$data['purchase_order_number'];            
            if($id=="AUTO")$id=$this->nomor_bukti();
		} else {
            if($id==""){
                $id=$this->session->userdata('purchase_order_number');
                $data['purchase_order_number']=$id;
            }            
            //$drow=$this->purchase_order_model->get_by_id($id);
           // $data=(array)$drow->row();    //ambil  dari POST lagi        
		}
        $data['purchase_order_number']=$id;
		unset($data['has_receive']);
		if($data['supplier_number']=="") $data['supplier_number']=$this->session->userdata('supplier_number');
			
		if($mode=="add"){
            $data['potype']='O';
			$ok=$this->purchase_order_model->save($data);
			if($data['req_no']!=""){
				$this->purchase_order_model->add_item_with_rfq($data['req_no'],$id);
			}
            if($ok)$this->nomor_bukti(true);
			$this->syslog_model->add($id,"purchase_order","add");
		} else {
		    unset($data['purchase_order_number']);
            $data['potype']='O';
			$ok=$this->purchase_order_model->update($id,$data);			
			$this->syslog_model->add($id,"purchase_order","edit");
		}

		if ($ok){
			echo json_encode(array('success'=>true,'purchase_order_number'=>$id));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'.mysql_error()));
		}
	}
	function items($nomor,$type='')
	{
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.quantity,p.qty_recvd 
		,p.unit,p.price,p.discount,p.total_price,
		p.line_number,p.from_line_doc,p.disc_2,p.disc_3,p.retail,p.margin,
		p.line_type,p.line_status,p.comment,p.multi_unit,p.mu_qty,p.mu_harga
		from purchase_order_lineitems p
		left join inventory i on i.item_number=p.item_number
		where purchase_order_number='$nomor'";
		 
		echo datasource($sql);
	}
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('purchase_order_number');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			unset($data['has_receive']);
			$this->purchase_order_model->update($id,$data);
			$message='Update Success';
			$this->syslog_model->add($id,"purchase_order","edit");
		} else {
			$message='Error Update';
		}
                
 		$this->view($id,$message);		
	}
	 
	function view($id,$mode="view"){
		if(!allow_mod2('_40040'))return false;
		$id=urldecode($id);
		 $data['id']=$id;
		 $model=$this->purchase_order_model->get_by_id($id)->row();
		 
		 $data=$this->set_defaults($model);	
		 	 
		 $data['purchase_order_number']=$id;
		 $data['id']=$id;
		 $data['mode']=$mode;
         $data['message']="";
         $data['supplier_list']=$this->supplier_model->select_list();  
         $data['supplier_info']=$this->supplier_model->info($data['supplier_number']);
         $data['term_list']=$this->type_of_payment_model->select_list();
		 $data['amount']=$model->amount;
		 $data['subtotal']=$model->subtotal;
		 $data['discount']=$model->discount;
		 $data['po_tax_percent']=$model->tax;
		 $data['has_receive']=$this->db->query("select count(1) as cnt from inventory_products 
				where purchase_order_number='$id'")->row()->cnt;
		 $this->purchase_order_model->recalc_qty_recvd($id);


         $this->session->set_userdata('purchase_order_number',$id);
         $this->session->set_userdata('supplier_number',$data['supplier_number']);
		 
		 $this->template->display_form_input($this->file_view,$data,'');			
		
	}
   
	function _set_rules(){	
		 $this->form_validation->set_rules('purchase_order_number','Nomor Faktur', 'required|trim');
		 $this->form_validation->set_rules('po_date','Tanggal','callback_valid_date');
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
    function browse($offset=0,$limit=50,$order_column='purchase_order_number',$order_type='asc'){
		$data['controller']=$this->controller;
		$data['fields_caption']=array('Nomor PO','Tanggal','Supplier','Nama Supplier','Rcvd',
        'termin','jumlah','status','Tgl Kirim','Company','Outlet','Sys');
		$data['fields']=array('purchase_order_number','po_date', 
                'supplier_number','supplier_name','received','terms','amount','doc_status','due_date',
                'bill_to_contact','warehouse_code','type_of_invoice');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
		$data['col_width']=array('purchase_order_number'=>50,'po_date'=>50,
		'supplier_name'=>200,'recv'=>20);
		$data['field_key']='purchase_order_number';
		$data['caption']='DAFTAR PURCHASE ORDER';
        $data['fields_format_numeric']=array("amount");
		$this->load->library('search_criteria');
		
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor PO","sid_po_number");
		$faa[]=criteria("Supplier","sid_supplier");
        $faa[]=criteria("System","sid_sistim");
        $faa[]=criteria("Outlet","sid_outlet");
		$data['criteria']=$faa;
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=10,$nama=''){
    	if($this->input->get('sid_po_number')){
    		$sql=$this->sql." and purchase_order_number like '%".$this->input->get('sid_po_number')."%'";
		} else {
			$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
			$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
			$sql=$this->sql." and po_date between '".$d1."' and '".$d2."'";
            $supplier=$this->input->get('sid_supplier');
			if($supplier!="")$sql.=" and (supplier_name like '$supplier%' or i.supplier_number='$supplier')";
            $sistim=$this->input->get("sid_sistim");
            if($sistim!="")$sql.=" and i.type_of_invoice='$sistim'";
            $outlet=$this->input->get("sid_outlet");
            if(!$outlet)$outlet=$this->session->userdata('session_outlet','');
            
            if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
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
        if($offset==1)$offset=0;
        $offset=10*$offset;
        $sql.=" limit $offset,$limit";
        
        echo datasource($sql);
    }	 
	function delete($id){	 	 
		$id=urldecode($id);
		if(!allow_mod('_40043')){
			echo json_encode(array("success"=>false,"msg"=>"Anda tidak diijinkan menjalankan proses module ini."));
			return false;
		};			
		if($this->purchase_order_model->validate_delete_po($id) and $this->purchase_order_model->delete($id) ){
			echo json_encode(array("success"=>true,"msg"=>"Berhasil nomor PO ini sudah dihapus."));
		} else {
			echo json_encode(array("success"=>false,"msg"=>"Nomor PO ini tidak bisa dihapus! <br>Sudah ada penerimaan."));
		}
		$this->syslog_model->add($id,"purchase_order","delete");

	}
	function detail(){
		$data['purchase_order_number']=isset($_GET['purchase_order_number'])?$_GET['purchase_order_number']:'';
		$data['po_date']=isset($_GET['po_date'])?$_GET['po_date']:'';
		$data['supplier_number']=isset($_GET['supplier_number'])?$_GET['supplier_number']:'';
		$data['comments']=isset($_GET['comments'])?$_GET['comments']:'';
		$data['potype']='O';
		$this->purchase_order_model->save($data);
		$this->sysvar->autonumber_inc("Purchase Order Numbering");

		$data['supplier_info']=$this->supplier_model->info($data['supplier_number']);
		
		$this->template->display('purchase/purchase_order_detail',$data);
	}
	function view_detail($nomor){
		$nomor=urldecode($nomor);
		$sql="select p.item_number,i.description,p.quantity 
		,p.unit,p.price,p.total_price,p.line_number
		from purchase_order_lineitems p
		left join inventory i on i.item_number=p.item_number
		where purchase_order_number='$nomor'";
		$s="
			<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
			<script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
		";
		echo $s." ".browse_simple($sql);
    }
        function add_item(){            
            if(isset($_GET)){
                $data['purchase_order_number']=$_GET['purchase_order_number'];
            } else {
                $data['purchase_order_number']='';
            }
           $this->load->model('inventory_model');
           $data['item_lookup']=$this->inventory_model->item_list();
            $this->load->view('purchase/purchase_order_add_item',$data);
        }   
        function delete_item($id){
			$id=urldecode($id);
            $this->load->model('purchase_order_lineitems_model');
            $ok=$this->purchase_order_lineitems_model->delete($id);			
			if ($ok){
				echo json_encode(array('success'=>true));
			} else {
				echo json_encode(array('msg'=>'Some errors occured.'));
			}
        }        
		function print_purchase_order($nomor){
		    $this->print_po($nomor);
		}
        function print_po($nomor){
			$nomor=urldecode($nomor);
			
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
            $data['create_by']=user_id();
            
            $file=$this->sysvar->getvar("file_print_po");
            ///echo "<br>file: $file";exit;
            if($file!=""){
               $data['content']=load_view("purchase/rpt/$file",$data);
            } else {
               $data['content']=load_view('purchase/rpt/print_po_pdf.php',$data);                
            }
            
            $this->load->view('pdf_print',$data);                
		}

        function sum_info(){
			$nomor=urldecode($nomor);
            $nomor=$_GET['nomor'];
            $saldo=$this->purchase_order_model->recalc($nomor);
            echo 'Jumlah Faktur: Rp. '.  number_format($this->purchase_order_model->amount);
            echo '<br/>Jumlah Bayar : Rp. '.  number_format($this->purchase_order_model->amount_paid);
            echo '<br/>Jumlah Sisa  : Rp. '.  number_format($saldo);            
        }
        function list_open_po($supplier)
        {
			$supplier=urldecode($supplier);
            $sql="select p.purchase_order_number,p.po_date,p.due_date,p.terms 
            from purchase_order  p
            where p.supplier_number='$supplier' and p.potype='O'";
            $s="
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
                <script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
            ";
            echo $s." ".browse_simple($sql,'',500,300,'dgPoList');

        }
		function select_open_po($supplier=''){
			$supplier=urldecode($supplier);
            $sql="select p.purchase_order_number,p.po_date,p.due_date,p.terms
            ,p.supplier_number,p.doc_status,p.bill_to_contact,s.supplier_name 
            from purchase_order  p
            left join suppliers s on s.supplier_number=p.supplier_number
            where p.potype='O'  and ifnull(received,false)=false";
            if($supplier!="")$sql.=" and p.supplier_number='$supplier' ";
            if($search=$this->input->get('s')){
                $sql.=" and (p.purchase_order_number like '%$search%' or p.supplier_number like '%$search%')";
            }
			$sql.=" limit 30 ";
			echo datasource($sql);
		}
        function list_item_receive($nomor){
			$nomor=urldecode($nomor);
            $this->load->model('purchase_order_lineitems_model');
            $data['po_item']=$this->purchase_order_lineitems_model->lineitems($nomor);
            $this->load->view('inventory/receive_po_item',$data);
            
        }
		function items_not_received($nomor){
			$nomor=urldecode($nomor);
			if($nomor){

				$sql="select item_number,description,quantity,unit,qty_recvd,line_number,
				mu_qty,multi_unit,mu_harga 
				from purchase_order_lineitems 
				where purchase_order_number='$nomor' and ifnull(received,false)=false ";				 
				 
				$query=$this->db->query($sql);
				$i=0;
				$rows[0]='';
				if($query){ 
					foreach($query->result_array() as $row){
						$qty_sisa=$row['quantity']-$row['qty_recvd'];
						if($row['quantity']>0){
							$ratio=$row['mu_qty']/$row['quantity'];
						} else {
							$ratio=1;
						}
						$mu_qty=$ratio*$qty_sisa;
						//qty_receive input
						$row['qty']=form_input("qty[]",$qty_sisa,"id='qty_$i' style='width:50px' onchange='calc_ratio($i);return false;'");
						$row['line']=$row['line_number'].
							form_input("line[]",$row['line_number'],"readonly style='width:10px'").
							form_input("ratio[]",$ratio,"readonly style='width:10px' id='ratio_$i'");
						$row['mu_qty']=form_input("mu_qty[]",$mu_qty,"readonly id='mu_qty_$i' style='width:50px'");
						
						$rows[$i++]=$row;
					};
				}
				$data['total']=$i;
				$data['rows']=$rows;
							
				echo json_encode($data);

			}
		}
        function view_receive($purchase_order_number){
			$purchase_order_number=urldecode($purchase_order_number);             
            $this->load->model('inventory_products_model');
            $sql="select distinct shipment_id,
                date_received,warehouse_code,receipt_by 
                from inventory_products
                where receipt_type='PO' 
                and purchase_order_number='$purchase_order_number'"; 
            //$data['list_receive']=$this->inventory_products_model->list_receive($purchase_order_number);
            $data['list_receive']=browse_simple($sql, 
                    "Daftar Penerimaan atas nomor po [".$purchase_order_number."]"
                    , 400, 0, "dgItem", "cmdButtons");
            $po=$this->purchase_order_model->get_by_id($purchase_order_number)->row();
            $data['supplier_number']=$po->supplier_number;
            $data['supplier_info']=$this->supplier_model->info($po->supplier_number);
            $data['purchase_order_number']=$purchase_order_number;
            $this->template->display('purchase/list_receive',$data);            
        }
	function create_invoice($nomor_po)
	{
		$nomor_po=urldecode($nomor_po);
		//-- tampilkan nomor penerimaan
            $this->load->model('inventory_products_model');
            $sql="select distinct shipment_id,
                date_received,warehouse_code,receipt_by,ipp.supplier_number,
       			s.supplier_name,ipp.purchase_order_number
                from inventory_products ipp left join suppliers s on s.supplier_number=ipp.supplier_number
                where receipt_type='PO' 
                and purchase_order_number='$nomor_po'"; 
			$rst=$this->db->query($sql);
			$table='
				<table class="table1">
				<tr><td colspan="7"><h3>Silahkan pilih nomor bukti penerimaan yang akan dibuatkan faktur
				dibawah ini: </h3></td></tr>
				<thead><tr><td>#</td><td>Nomor</td><td>Tanggal</td><td>Gudang</td>
				<td>Nomor PO</td><td>Supplier</td><td>Pilih</td></tr>
				</thead>
				<tbody>';
		    $i=1;
		    foreach($rst->result() as $row){
		        $table.= "<tr>
		            <td>".$i++."</td>
		            <td>".$row->shipment_id."</td>
		            <td>".$row->date_received."</td>
		            <td>".$row->warehouse_code."</td>
		            <td>".$row->purchase_order_number."</td>
		            <td>".$row->supplier_name."</td>		            		         
		            <td><input type='checkbox' name='pilih[]' value='".$row->shipment_id."'>
		            </td>
		        </tr>";
		    }
			$table.='
				</tbody>
				</table>        ';

			$data['list_receive']=$table;
            $po=$this->purchase_order_model->get_by_id($nomor_po)->row();
            $data['supplier_number']=$po->supplier_number;
            $data['supplier_info']=$this->supplier_model->info($po->supplier_number);
            $data['purchase_order_number']=$nomor_po;
            $this->template->display('purchase/list_receive_not_invoiced',$data);            
	}
	function sub_total($nomor){
		$nomor=urldecode($nomor);
        $msg="Error";
        $success=false;
		if($this->input->get()){
			$sql="update purchase_order set discount=".c_($_GET['discount']).",tax=".c_($_GET['tax'])
			.",freight=".c_($_GET['freight']).",other=".c_($_GET['others'])." where purchase_order_number='$nomor'";
			$rs=$this->db->query($sql);
		} 
        if($rs){
            $msg="Success";     $success=true;
        }
		$saldo=$this->purchase_order_model->recalc($nomor);
		$sub_total=$this->purchase_order_model->sub_total;
		$data=array('sub_total'=>$sub_total,'amount'=>$this->purchase_order_model->amount,"msg"=>$msg);
		$data["success"]=$success;
		
		echo json_encode($data);				
	}
    function save_item(){
        if($ck=$this->input->post("ck")){
            $this->save_item_all();
        } else {
            $this->save_item_one();
        }
        return true;
    }   
    function save_item_all(){
        $data=$this->input->post();
        $po=$this->input->get("po");
        $gudang=$this->input->get("gdg");
        $ck=$data["ck"];
        
        $data2['purchase_order_number']=$po;
        $data2['warehouse_code']=$gudang;
        $data_ret=null;
        
        for($i=0;$i<count($ck);$i++){
            $item_no=$ck[$i];               $jual=0;        $margin_prc=0;      $retail=0;
            $item_name="";                  $margin_amt=0;
            $qty=1;
            $unit="Pcs";
            $beli=0;
            if($qitem=$this->db->where("item_number",$item_no)->get("inventory")){
                    if($ritem=$qitem->row()){
                        $item_no=$ritem->item_number;
                        $item_name=$ritem->description;
                        $beli=c_($ritem->cost_from_mfg);
                        if($beli<1)$beli=$ritem->cost;
                        $unit=$ritem->unit_of_measure;
                        $jual=c_($ritem->retail);
                        $margin_prc=c_($ritem->margin);
                    }
                }
            if($unit=="")$unit="Pcs";
            $data2['item_number']=$item_no;
            $data2['description']=$item_name;
            $data2['quantity']=$qty;
            $data2['unit']=$unit;
            $data2['price']=$beli;
            $data2['margin']=$margin_prc;
            $data2['retail']=$jual;
            $ok=$this->purchase_order_lineitems_model->save($data2);
            $data_ret[]=$data2;
        }
        $this->purchase_order_model->recalc($po);
         
        if ($ok){
            $from_line=$ok;
            echo json_encode(array('success'=>true,"data"=>$data_ret));
        } else {
            echo json_encode(array('msg'=>'Some errors occured.'));
        }
        
    }     
	function exist_item_no($po_number,$item_no){
		$sql="select count(1) as znt from purchase_order_lineitems 
			where purchase_order_number='$po_number' and item_number='$item_no'";
		$cnt=$this->db->query($sql)->row()->znt;
		return $cnt>0;
	}
    function save_item_one(){
        $data=$this->input->post();
		$line_number=$data['line_number'];
		$item_no=$data['item_number'];
        $po=$data['po_number_item'];
        unset($data['po_number_item']);
		
		if($line_number==0 || $line_number==""){
			if($this->exist_item_no($po,$item_no)){
				echo json_encode(array("success"=>false,"item_exist"=>true,"msg"=>"Item [$item_no] sudah ada !"));
				return false;
			}
		}
		
        $gdg=null; $qty_alloc=null;
        if(isset($data['gdg'])){
            $gdg=$data['gdg']; unset($data['gdg']);
            $qty_alloc=$data['qty_alloc']; unset($data['qty_alloc']);
        }
        if(isset($data["inventory_account"])){
            if($data["inventory_account"]!=""){
                $data["inventory_account"]=account_id($data["inventory_account"]);               
            }
        }
        
//      if(isset($data['jual']))unset($data['jual']);
//      if(isset($data['profit']))unset($data['profit']);
		
        $data['purchase_order_number']=$po;
        $data['warehouse_code']=$data['gudang_item'];
        unset($data['gudang_item']);
        $ok=$this->purchase_order_lineitems_model->save($data);
        $this->purchase_order_model->recalc($po);
         
        if ($ok){
            $from_line=$ok;
            $data_qty['qty_alloc']=$qty_alloc;
            $data_qty['line_number_alloc']=$from_line;
            $data_qty['gdg']=$gdg;
            $this->purchase_order_lineitems_model->save_alloc($data_qty);
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('success'=>false,'msg'=>'Some errors occured.'));
        }
        
    }
	function recalc($nomor){
		$nomor=urldecode($nomor);
		$this->purchase_order_model->recalc($nomor);
	}
	function qty_alloc($po_line){
        $this->load->model('purchase_order_lineitems_model');
		$data=$this->input->post();
		 
       	$ok=$this->purchase_order_lineitems_model->save_alloc($data);		 
		if ($ok){
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}		
	}
    function load_line_number($line_number){
        $result['success']=false;
        $sql="select a.item_number,a.description,a.inventory_account,
            c.account,c.account_description 
            from purchase_order_lineitems a left join inventory i on i.item_number=a.item_number 
            left join chart_of_accounts c on c.id=a.inventory_account 
            where a.line_number='$line_number'";
        if($q=$this->db->query($sql)){
            if($r=$q->row()){
                $result=(array)$r;
                $result['success']=true;
            }
        }
        echo json_encode($result);
    }
	function load_qty_alloc($po_line){
        $this->load->model('purchase_order_lineitems_model');
       	$data=$this->purchase_order_lineitems_model->load_alloc($po_line);	
		$qty=null;
		$ok=false;
		$i=0;
		foreach($data->result() as $r){
			$qty[$i]['gudang']=$r->wh_code;
			$qty[$i]['qty']=$r->qty;
			$qty[$i]['id']=$r->id;
			$ok=true;
			$i++;
		}
        
		if ($ok){
			echo json_encode(array('success'=>true,"qty"=>$qty));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}		
	}
	function duplicate($from_po){
		$from_po=urldecode($from_po);
		if($q=$this->db->where("purchase_order_number",$from_po)->get("purchase_order")){
			if($src_po=$q->row_array()){
				$tgt_po=$src_po;
				$no_po=$this->nomor_bukti();
				$tgt_po['purchase_order_number']=$no_po;
				$tgt_po['po_date'] = date("Y-m-d");
				if($ok=$this->db->insert("purchase_order",$tgt_po)){
					if($qd=$this->db->where("purchase_order_number",$from_po)
						->get("purchase_order_lineitems"))	{
						foreach($qd->result_array() as $rqd){
							$tgt_line=$rqd;
							$tgt_line['purchase_order_number']=$no_po;
							$tgt_lile['received']=0;
							$tgt_line['qty_recvd']=0;
							unset($tgt_line['line_number']);
							if($ok=$this->db->insert("purchase_order_lineitems",$tgt_line)){
								$id=$this->db->insert_id();
								if($qalloc=$this->db->where("line_id_po",$rqd['line_number'])
									->get("po_qty_alloc")){
									foreach($qalloc->result_array() as $alloc_src){
										$alloc_tgt=$alloc_src;
										$alloc_tgt['line_id_po']=$id;
										unset($alloc_tgt['id']);
										if($ok=$this->db->insert("po_qty_alloc",$alloc_tgt)){
										
										}
									}
								}
							}
						}
					}
					$this->nomor_bukti(true);
				}
			}
		}
		echo "Selesai buat nomor po baru [$no_po]";
		redirect("purchase_order/view/".$no_po);
	}
	function po_expire(){
		$sql="select purchase_order_number,po_date,amount,c.supplier_name,due_date  
		from purchase_order i left join suppliers c on c.supplier_number=i.supplier_number
		where potype='O' and due_date>=".date('Y-m-d')."  
		order by po_date   		
		limit 5
		";
		echo datasource($sql);
		
	}
	function status($po,$status){
	    $po=urldecode($po);
	    $status=urldecode($status);
        $ordered_by=$this->db->select("ordered_by")->
            where("purchase_order_number",$po)->get("purchase_order")->row()->ordered_by;
        
	    $ok=$this->db->where("purchase_order_number",$po)->update("purchase_order",array("doc_status"=>$status));
        if($ok){
            $from=user_id();
            $to=$ordered_by;
            $subject="PO# $po, Status: $status";
            $message="Your PO has been changed status to; $status";
            inbox_send($from, $to, $subject, $message);
            echo json_encode(array("success"=>true,"msg"=>"Berhasil PO ini sudah diubah statusnya dan diinbox ke yang buat."));
        } else {
            echo json_encode(array("success"=>false,"msg"=>"Tidak berhasil !"));
        }
        
	}

    function expenses($nomor,$cmd="")
    {
        $nomor=urldecode($nomor);
        if($cmd=="save"){
            $data=$this->input->post();
            $id=$data["id"];unset($data["id"]);
            if($data["calc_method"]=="")$data["calc_method"]=0;
            if($data["qty"]=="")$data["qty"]=1;
            if($id==""){
                $data["purchase_order_number"]=$nomor;
                $ok=$this->db->insert("purchase_order_expenses",$data);
            } else {
                $data['purchase_order_number']=$nomor;
                $ok=$this->db->where("id",$id)->update("purchase_order_expenses",$data);                
            }
            $total=$this->db->query("select sum(amount) as z from purchase_order_expenses where purchase_order_number='$nomor'")->row()->z;
            $this->db->query("update purchase_order set other='$total' where purchase_order_number='$nomor'");
            echo json_encode(array("total"=>$total,"success"=>$ok,"msg"=>$ok?"Success":"Error"));
        } else if ($cmd=="delete"){
            $nomor_po=$this->db->query("select purchase_order_number as nomor_po from purchase_order_expenses where id='$nomor'")->row()->nomor_po;
            $ok=$this->db->query("delete from purchase_order_expenses where id='$nomor'");
            $total=$this->db->query("select sum(amount) as z from purchase_order_expenses where purchase_order_number='$nomor_po'")->row()->z;
            echo json_encode(array("total"=>$total,"success"=>$ok,"msg"=>$ok?"Success":"Error"));
        } else if ($cmd=="view"){
            $sql="select * from purchase_order_expenses where id='$nomor'";
            $data["success"]=false;
            $data['msg']="Error";
            if($q=$this->db->query($sql)){
                if($r=$q->row()){
                    $data["success"]=true;
                    $data['item_no']=$r->item_no;
                    $data['item_desc']=$r->item_desc;
                    $data['amount']=$r->amount;
                    $data['qty']=$r->qty;
                    $data['price']=$r->price;
                    $data['calc_method']=$r->calc_method;
                    $data['id']=$r->id;
                    
                }
            }
            echo json_encode($data);
        } else {
            $sql="select * from purchase_order_expenses
            where purchase_order_number='$nomor'";         
            echo datasource($sql);
            
        }
    }

}
