<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

Class Inventory extends CI_Controller {

    private $limit=10,$table_name="";
    private $file_view='inventory/inventory';
 	function __construct()
	{
		parent::__construct();
        
       

		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','browse_select','mylib_helper'));
		
		$this->load->helper(array('language'));
		$this->lang->load('common');

		$this->load->library('template');
		$this->load->library('form_validation');
		
		$this->load->model('inventory_model');
        $this->load->model('chart_of_accounts_model');
        //$this->load->model('supplier_model');
		
		$this->load->helper(array('language'));
		$this->lang->load('common');
		$this->load->library("list_of_values");
		$this->load->model('syslog_model');

		$this->table_name=cidt().'inventory';
		$this->sql="select item_number,description,unit_of_measure,
                retail,cost_from_mfg,i.supplier_number,s.supplier_name,i.class,i.category 
                from ".cidt()."inventory i
                left join ".cidt()."suppliers s on s.supplier_number=i.supplier_number
                ";
		
		
	}
	function set_defaults($record=NULL){          
        $data=data_table('inventory',$record); 
		$data['mode']='';
		$data['message']='';
        $data['akun_list']=$this->chart_of_accounts_model->select_list();
//		$data['supplier_list']=$this->supplier_model->select_list();
		$data['category_list']=$this->inventory_model->category_list();
		$data['class_list']=$this->inventory_model->class_list();
		$data['sub_category_list']=$this->inventory_model->category_list();               
		$data['supplier_name']='';
		$data['unit_of_measure']='PCS';
		
		$setting['dlgBindId']="divisions";
		$setting['dlgCols']=array( 
			array("fieldname"=>"div_code","caption"=>"Kode","width"=>"80px"),
			array("fieldname"=>"div_name","caption"=>"Nama Kelompok","width"=>"200px")
		);
		$setting['dlgRetFunc']="$('#division').val(row.div_code);";
		$data['lookup_division']=$this->list_of_values->render($setting);

		$setting['dlgBindId']="inventory_categories";
		$setting['dlgCols']=array( 
			array("fieldname"=>"kode","caption"=>"Kode","width"=>"80px"),
			array("fieldname"=>"category","caption"=>"Category","width"=>"200px")
		);
		$setting['dlgRetFunc']="$('#category').val(row.kode);";
		$data['lookup_category']=$this->list_of_values->render($setting);

		$setting['dlgBindId']="inventory_sub_categories";
		$setting['dlgCols']=array( 
			array("fieldname"=>"kode","caption"=>"Kode","width"=>"80px"),
			array("fieldname"=>"category","caption"=>"Category","width"=>"200px")
		);
		$setting['dlgRetFunc']="$('#sub_category').val(row.kode);";
		$data['lookup_sub_category']=$this->list_of_values->render($setting);

        $setting['dlgBindId']="type_of_invoice";
        $setting['dlgRetFunc']="$('#type_of_invoice').val(row.varvalue);";
        $setting['dlgCols']=array( 
                    array("fieldname"=>"varvalue","caption"=>"Kode","width"=>"80px"),
                    array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
                );          
        $data['lookup_po_type']=$this->list_of_values->render($setting);
        
        $setting['dlgBindId']="colour";
        $setting['dlgRetFunc']="$('#colour').val(row.varvalue);";
        $setting['dlgCols']=array( 
                    array("fieldname"=>"varvalue","caption"=>"Kode","width"=>"80px"),
                    array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
                );          
        $data['lookup_colour']=$this->list_of_values->render($setting);

        $setting['dlgBindId']="size";
        $setting['dlgRetFunc']="$('#size').val(row.varvalue);";
        $setting['dlgCols']=array( 
                    array("fieldname"=>"varvalue","caption"=>"Kode","width"=>"80px"),
                    array("fieldname"=>"keterangan","caption"=>"Keterangan","width"=>"200px")
                );          
        $data['lookup_size']=$this->list_of_values->render($setting);
                
        		
		return $data;
	}
	function index()
	{	
		if(!allow_mod2('_80000'))return false;   
		if(!allow_mod2('_80010'))return false;   
        $this->browse();
	}
	function get_posts(){
        $data=data_table_post('inventory');
		return $data;
	}
	function add()
	{
		if(!allow_mod2('_80011'))return false;   
		$data=$this->set_defaults();
		$this->_set_rules();
		$data['mode']='add';
        $this->template->display_form_input($this->file_view,$data,'');
   }        
	function delete($id){
		if(!allow_mod2('_80013'))return false;   
	 	$ret=$this->inventory_model->delete($id);
		$this->syslog_model->add($id,"inventory","delete");

		if($ret==""){
			$this->browse();
		} else {
			$this->syslog_model->add($id,"inventory","delete");
			echo json_encode(array("success"=>false,"msg"=>$ret));			
		}
	}

    function nomor($add=false,$key)
    {
        $key.=" Numbering";
        $no='';
        if($add){
            $this->sysvar->autonumber_inc($key);
        } else {            
            $no=$this->sysvar->autonumber($key,0,'$001');
         
            for($i=0;$i<100;$i++){          
                $no=$this->sysvar->autonumber($key,0,'$001');
                $rst=$this->inventory_model->get_by_id($no)->row();
                if($rst){
                    $this->sysvar->autonumber_inc($key);
                } else {
                    break;                  
                }
            }
        }
        return $no;
    }   
	function save()
	{   
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('item_number');
		 $msg=""; $key="Inventory";
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            if($data['item_number']=="AUTO"){
                $cat=$data['category']; $sub=$data['sub_category'];
                $sup=$data['supplier_number'];  $sis=$data['type_of_invoice'];
                $colour=$data['colour'];    $size=$data['size'];
                $bln=kode_bulan();  $thn=kode_tahun();
                $key="$cat-$sub-$sup-$sis-$colour-$size-$bln-$thn";
                $no=$this->nomor(false,$key);
                $id="$key-$no";
                //echo "<br>key: $key, id: $id, no: $no, thn: $thn, bln: $bln";exit;
                
            }
			$mode=$this->input->post("mode");
			unset($data["mode"]);
			
			$data['sales_account']=$this->acc_id($data['sales_account']);
			$data['inventory_account']=$this->acc_id($data['inventory_account']);
			$data['cogs_account']=$this->acc_id($data['cogs_account']);
			$data['tax_account']=$this->acc_id($data['tax_account']);
			
			if($mode=="view"){
				$ok=$this->inventory_model->update($id,$data);	
				$this->syslog_model->add($id,"inventory","add");
				
			} else {
			    $data['item_number']=$id;
				$ok=$this->inventory_model->save($data);
                if($ok)$this->nomor(true,$key);
				$this->syslog_model->add($id,"inventory","edit");

			}
			$this->syslog_model->add($id,"inventory",$mode);

		} else {
				$msg=strip_tags(validation_errors());			
				$ok=false;
		}	
		if ($ok){
			echo json_encode(array('success'=>true,'item_number'=>$id));
		} else {
			echo json_encode(array('msg'=>$msg));
		}
		  
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
	
	function view($id,$message=null){
		if(!allow_mod2('_80012'))return false;   
		$id=urldecode($id);
		 $inventory=$this->inventory_model->get_by_id($id)->row();
		 $data=$this->set_defaults($inventory);
		 $data['id']=$id;
		 $data['mode']='view';
         $data['message']=$message;
		 $sql="select q.item_number,i.description,q.gudang,sum(q.qty_masuk)-sum(q.qty_keluar) as quantity 
   		from qry_kartustock_union q left join inventory i on i.item_number=q.item_number 
		where q.item_number='$id'   		
   		group by q.item_number,i.description,q.gudang ";
		 $data['qty_gudang']=browse_simple($sql);
		 $data['inventory_account']=account($data['inventory_account']);
		 $data['sales_account']=account($data['sales_account']);
		 $data['cogs_account']=account($data['cogs_account']);
		 $data['tax_account']=account($data['tax_account']);
		
		 $data['quantity_in_stock']=$this->inventory_model->quantity_in_stock($id);
		 $supp_name="";
		 if($query=$this->db->query("select supplier_name 
		 from suppliers where supplier_number='".$inventory->supplier_number."'")){
			if($row=$query->row()){
				$supp_name=$row->supplier_name;
			}
		}
		$data['supplier_name']=$supp_name;
		 $data['item_picture']=str_replace(":","",$data['item_picture']);
         $this->session->set_userdata('_right_menu', 'inventory/inventory_menu');
         $this->template->display_form_input($this->file_view,$data,'');
	}
	 // validation rules
	function _set_rules(){	
		if($this->input->post("mode")=="add"){
			$this->form_validation->set_rules('item_number','Item Number','required|trim|callback_exist');
		}
		 $this->form_validation->set_rules('description','Description',	 'required');
		 $this->form_validation->set_rules('class','Class', 'required');
		 $this->form_validation->set_rules('category','Category', 'required');
	}
	function valid_exist($id){return $this->exist($id);}
	function exist($id){
	   if($this->inventory_model->exist($id)>0) {
		   $this->form_validation->set_message('invoice_number', 'Nomor sudah ada !');
		   return false;
	   } else {
		   return true;
	   }
	}
	function browse($offset=0,$limit=10,$order_column='company',$order_type='asc')
	{
		$query_proc=false;
		if($this->input->get('query_proc'))$query_proc=true;
		if(!$query_proc || $this->input->get('query_proc')=='0'){
			$data['caption']='DAFTAR BARANG DAN JASA';
			$data['controller']='inventory';		
			$data['fields_caption']=array('Kode','Nama Barang','Unit','Harga Jual','Harga Beli',
				'Kode Supplier','Nama Supplier','Kelas','Category');
			$data['fields']=array('item_number','description','unit_of_measure',
					'retail','cost_from_mfg','supplier_number','supplier_name','class','category');
			$data['field_key']='item_number';
			$this->load->library('search_criteria');
			
			$faa[]=criteria("Kode","sid_kode");
			$faa[]=criteria("Nama","sid_nama");
			$faa[]=criteria("Supplier","sid_supp");
			$faa[]=criteria("Category","sid_cat");
			$data['list_info_visible']=true;
			$data['import_visible']=true;
			$data['criteria']=$faa;
			$data['query_list'][]=array("value"=>"inventory","caption"=>"Daftar Master Barang");
			$data['query_list'][]=array("value"=>"stock/query/exec/1","caption"=>"Quantity Stock Level");
			$data['query_list'][]=array("value"=>"inventory_query_2","caption"=>"Quantity Minus");
			$data['query_list'][]=array("value"=>"inventory_query_3","caption"=>"Stock Value");
			
			$this->template->display_browse2($data);
		} else {
			var_dump($this->input->get('query_proc'));
		}
    }
    function browse_data($offset=0,$limit=50,$nama=''){
		$sql=$this->sql." where 1=1";
		$div_list=$this->session->userdata('default_division_list');
		if ( $div_list ) 
		{
			//$sql.=" and division in ".sql_in($div_list);
		}
		
		if(!is_numeric($offset)){
			$sql.=" and description like '$offset%'";
		}  else {
			if($this->input->get('sid_kode')!='')$sql.=" and item_number like '".$this->input->get('sid_kode')."%'";
			if($this->input->get('sid_nama')!='')$sql.=" and description like '".$this->input->get('sid_nama')."%'";
			if($this->input->get('sid_supp')!='')$sql.=" and supplier='".$this->input->get('sid_supp')."'";
			if($this->input->get('sid_cat')!='')$sql.=" and category='".$this->input->get('sid_cat')."'";
		}
        $offset=$this->input->get("page");
        $limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
		echo datasource($sql);		
		
    }
	function manufacturer($cmd='lookup'){
		echo datasource("select distinct manufacturer from inventory");
	}
	function model($cmd='lookup'){
		echo datasource("select distinct model from inventory");
	}
    function lookup($offset=0,$limit=20,$order_column='item_number',$order_type='asc'){           
        return $this->inventory_model->lookup($offset,$limit,
                $order_column,$order_type);
    }
	function lookup_json(){
            
		$query=$this->db->query("select item_number,description from inventory");
		$data =array();
		foreach($query->result_array() as $row){
			$data[] =  array($row['item_number'], $row['description']);
		}
		echo json_encode($data);
 	}
	function lookup_json2(){
            
		$query=$this->db->query("select item_number,description from inventory");
		foreach($query->result_array() as $row){
			$data['items'][] =  array($row['item_number'], $row['description']);
		}
		$data['success']=true;
		echo json_encode($data);
 	}
	
	function filter($nama='',$type='json'){
		$nama=urldecode($nama);
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'description';
		$sql="select item_number,description,category,retail,cost,cost_from_mfg,supplier_number,unit_of_measure
		 from inventory  where 1=1 and description like '%".$nama."%' 
		 order by $sort limit 1000 ";
		echo datasource($sql);
	}
	
	function find($item_number='',$cust_type='',$min_qty=0){
		$item_number=urldecode($item_number);
		$cust_type=trim(urldecode($cust_type));
		$query=$this->db->query("select item_number,description,retail,
		unit_of_measure,cost,cost_from_mfg,multiple_pricing 
		from inventory where (item_number='$item_number' or kode_lama='$item_number')");
        $data['success']=false;
        $num_row=$query->num_rows();
        if($num_row>0){
            $data=$query->row_array();
 
            
            $data['success']=true;
    		$disc_prc=$this->promo_disc_item($item_number);
    		$data['disc_prc_1']=$disc_prc['disc_prc_1'];
    		$data['disc_prc_2']=$disc_prc['disc_prc_2'];
    		$data['disc_prc_3']=$disc_prc['disc_prc_3'];
    		if($cust_type!=""){
    			$this->load->model("customer_type_model");
    			$row_price=$this->customer_type_model->get_price($cust_type,$item_number);
    			if($row_price)
    			{
    				if($row_price->sales_price>0){
    					$data['retail']=$row_price->sales_price;
    				}
    			}
    		}
		}
		$cust_no="";if($this->input->get("cust_no"))$cust_no=$this->input->get("cust_no");
		$data['discount']=$this->inventory_model->sales_discount($item_number,$cust_no,$min_qty);
		echo json_encode($data);
 	}
	function sales_discount($item_number,$customer,$qty_sold){
		$item_number=urldecode($item_number);
		$category=$this->db->select("category")
			->where("item_number",$item_number)
			->get("inventory")->row()->category;
		$data['discount']=0;
		if($category!=""){
			$data['discount']=$this->inventory_model->sales_discount($item_number,$customer,$qty_sold);
		}
		echo json_encode($data);		
	}
	 
	function grafik_jual_old(){
/* create_graph($konfigurasi_grafik, $data, $tipe_grafik, $judul_pd_grafik, $nama_berkas) */		
		$phpgraph = $this->load->library('PhpGraph');		
		$cfg['width'] = 300;
		$cfg['height'] = 200;
		$cfg['compare'] = false;
		$cfg['disable-values']=1;
		$chart_type='vertical-simple-column-graph';
		$data=$this->inventory_model->paling_laku();
		$file="tmp/".$chart_type.".png";
		$this->phpgraph->create_graph($cfg, $data,$chart_type,'Grafik Penjualan',$file);
		echo '<img src="'.base_url().'/'.$file.'"/>';
		echo '*Display only top ten sales items';
	}
	function grafik_jual(){
		header('Content-type: application/json');
		$data['label']="Top Ten Sales";
		$data['data']=$this->inventory_model->paling_laku();
		echo json_encode($data);
	}

	function grafik_stock_min_old(){
/* create_graph($konfigurasi_grafik, $data, $tipe_grafik, $judul_pd_grafik, $nama_berkas) */		
		$phpgraph = $this->load->library('PhpGraph');		
		$cfg['width'] = 300;
		$cfg['height'] = 200;
		$cfg['compare'] = false;
		$cfg['disable-values']=1;
		$chart_type='vertical-simple-column-graph';
		$data=$this->inventory_model->minimum_stock();
		$file="tmp/".$chart_type.".png";
		$this->phpgraph->create_graph($cfg, $data,$chart_type,'Grafik Minimum Stock',$file);
		echo '<img src="'.base_url().'/'.$file.'"/>';
		echo '*Display only top ten stock minimum';
	}
	function grafik_stock_min(){
		header('Content-type: application/json');
		$data['label']="Minimum Items";
		$data['data']=$this->inventory_model->minimum_stock();
		echo json_encode($data);
	}
	function daftar_po_receive(){
		$sql="select pol.item_number,pol.description,pol.quantity,pol.qty_recvd,
		p.purchase_order_number as faktur, p.po_date as tanggal,
		s.supplier_name
		from purchase_order_lineitems pol
		left join purchase_order  p on p.purchase_order_number=pol.purchase_order_number
		left join suppliers s on s.supplier_number=p.supplier_number
		where potype='P' and year(p.po_date)=".date('Y')."
		order by p.po_date asc";
		
		$query=$this->db->query($sql);
		$flds=$query->list_fields();
		$data=$query->result_array();
		echo browse_data($data,$flds);
	}
	function daftar_stock_sisa(){
		$sql="select i.item_number,i.description,i.quantity_in_stock
		from inventory i";		
		$query=$this->db->query($sql);
		$flds=$query->list_fields();
		$data=$query->result_array();
		echo browse_data($data,$flds);
	}
	function list_data($type='')
	{
		$sql="select item_number as productid,description as productname from inventory";
			$q=$this->db->query($sql)->result_array();
			$s=json_encode($q);		
		 echo  $s;		
	}
    function rpt($id){
		$data['id']=$id;
		$this->load->view('inventory/rpt/'.$id,$data);
   }
   function unit_price($id){
		$id=urldecode($id);
		 $inventory=$this->inventory_model->get_by_id($id)->row();
		 $data['item_number']=$inventory->item_number;
		 $data['description']=$inventory->description;
         $this->template->display_form_input("inventory/unit_price",$data);
   }
   
   function unit_price_list($id){
		$sql="select customer_pricing_code,retail,quantity_low,
			quantity_high,retail,date_from,date_to,cost 
			from inventory_prices where item_number='$id'";
		echo datasource($sql);
   }
	function unit_price_load($item_number,$customer_pricing_code){
   		$id=urldecode($item_number);
   		$customer_pricing_code=urldecode($customer_pricing_code);
		$this->load->model('inventory_prices_model');
		$ok=false;
		if($query=$this->inventory_prices_model->get_by_id($item_number,$customer_pricing_code)){
			if($row=$query->row()){
				$data=array('success'=>true,
					"customer_pricing_code"=>$row->customer_pricing_code,
					"retail"=>$row->retail,"quantity_high"=>$row->quantity_high,
					"quantity_low"=>$row->quantity_low,"date_from"=>$row->date_from,
					"date_to"=>$row->date_to,"cost"=>$row->cost);
				$ok=true;
			}
		}
		if ($ok){echo json_encode($data);} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
	}
   function unit_price_add($id){
   		$id=urldecode($id);
		$this->load->model('inventory_prices_model');
		$data = $this->input->post(NULL, TRUE); //getallpost			
		if($data['date_from']==""){unset($data['date_from']);} else {$data['date_from']=date('Y-m-d H:i:s', strtotime($data['date_from']));}
		if($data['date_to']==""){unset($data['date_to']);} else {$data['date_to']=date('Y-m-d H:i:s', strtotime($data['date_to']));}
		$data['item_number']=$id;
		if($this->inventory_prices_model->get_by_id($id,$data['customer_pricing_code'])->row()){
			$ok=$this->inventory_prices_model->update($id,$data);
		} else {	
			$ok=$this->inventory_prices_model->save($data);
		}
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }
   function delete_price($item_number,$unit_price){
   		$item_number=htmlspecialchars_decode($item_number);
   		$unit_price=htmlspecialchars_decode($unit_price);
		$this->load->model('inventory_prices_model');
		$ok=$this->inventory_prices_model->delete($item_number,$unit_price);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }
   function assembly($id){
   		$id=htmlspecialchars_decode($id);
		 $barang=$this->inventory_model->get_by_id($id)->row();
		 $data['item_number']=$barang->item_number;
		 $data['description']=$barang->description;
         $this->template->display_form_input("inventory/assembly",$data);
   }   
   function assembly_list($id){
		$sql="select a.assembly_item_number,i.description,a.default_cost, 
			a.comment,a.quantity 
			from inventory_assembly  a 
			left join inventory i on i.item_number=a.assembly_item_number 
			where a.item_number='$id'";
		echo datasource($sql);
   }
   function assembly_add($id){
   		$id=htmlspecialchars_decode($id);
		$this->load->model('inventory_assembly_model');
		$data = $this->input->post(NULL, TRUE); //getallpost			
		$data['item_number']=$id;
		$item_asm=$data['assembly_item_number'];
		$query=$this->inventory_assembly_model->get_by_id($id,$item_asm);
		unset($data['description']);
		if($query->num_rows()){
			unset($data['item_number']);
			$ok=$this->inventory_assembly_model->update($id,$data);
		} else {
			$ok=$this->inventory_assembly_model->save($data);
		}
		
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }
   function assembly_delete($item_number,$kode){
   		$item_number=htmlspecialchars_decode($item_number);
   		$kode=htmlspecialchars_decode($kode);
		if($kode=="null")$kode='';
		$this->load->model('inventory_assembly_model');
		$ok=$this->inventory_assembly_model->delete($item_number,$kode);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }
   function supplier($id){
   		$id=htmlspecialchars_decode($id);
		 $barang=$this->inventory_model->get_by_id($id)->row();
		 $data['item_number']=$barang->item_number;
		 $data['description']=$barang->description;
         $this->template->display_form_input("inventory/supplier",$data);
   }   
   function supplier_add($id){
   		$id=htmlspecialchars_decode($id);
		$this->load->model('inventory_suppliers_model');
		$data = $this->input->post(NULL, TRUE); //getallpost			
		$data['item_number']=$id;
		if(isset($data['supplier_name']))unset($data['supplier_name']);
		$query=$this->inventory_suppliers_model->get_by_id($id,$data['supplier_number']);
		if($query->num_rows()){
			$ok=$this->inventory_suppliers_model->update($id,$data);
		} else {	
			$ok=$this->inventory_suppliers_model->save($data);
		}
		
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }
   function supplier_delete($item_number,$kode){
   		$item_number=htmlspecialchars_decode($item_number);
   		$kode=htmlspecialchars_decode($kode);
		$this->load->model('inventory_suppliers_model');
		$ok=$this->inventory_suppliers_model->delete($item_number,$kode);
		if ($ok){echo json_encode(array('success'=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
   }
   function qty_gudang($item_number){
   		$item_number=htmlspecialchars_decode($item_number);
   		$sql="select q.item_number,i.description,q.gudang,sum(q.qty_masuk)-sum(q.qty_keluar) as quantity 
   		from qry_kartustock_union q left join inventory i on i.item_number=q.item_number 
		where q.item_number='$item_number'   		
   		group by q.item_number,i.description,q.gudang ";
		$this->template->browse_sql($sql);
   }
	function do_upload_picture()
	{
		//var_dump($_POST);
		//var_dump($_GET);
		//var_dump($_FILES);
		
		$config['upload_path'] = './tmp/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$userfile=$this->input->get('userfile');

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' =>'Error upload !! Maximum size gambar 100kb');
		    echo json_encode($error);
		}
		else
		{
			$data = array('success'=>'Sukses','upload_data' => $this->upload->data());
			echo json_encode($data);
		}
	}
	function reports(){
		$this->template->display('inventory/menu_reports');
	}
	function kartu_stock_gudang($gudang){
		$gudang=urldecode($gudang);
		$date_to= $this->input->get('d2');
		$date_to = date('Y-m-d H:i:s', strtotime($date_to));
		
		$sql="select q.item_number,i.description,
			sum(qty_masuk)-sum(qty_keluar) as qty_saldo,i.unit_of_measure as unit,
			sum(amount_masuk)-sum(amount_keluar) as amount_saldo,
			i.category,i.supplier_number,s.supplier_name
			from qry_kartustock_union q left join inventory i on i.item_number=q.item_number
			left join suppliers s on s.supplier_number=i.supplier_number 
			where gudang='$gudang' and tanggal<='$date_to' 
			group by q.item_number";
                    
        echo datasource($sql);
		
	}
	function kartu_stock($item_number)
	{
		$item_number=urldecode($item_number);
		$date_from= $this->input->get('d1');
		$date_from =  date('Y-m-d H:i:s', strtotime($date_from));
		$date_to = $this->input->get('d2');
		$date_to = date('Y-m-d H:i:s', strtotime($date_to));
		$gudang = $this->input->get('gudang');
		
		$sql="select sum(qty_masuk)-sum(qty_keluar) as saldo from qry_kartustock_union 
			where item_number='$item_number' 
			and tanggal<'$date_from'";
		if($gudang!="")$sql.=" and gudang='$gudang'";

        $query=$this->db->query($sql);
		$awal=$query->row()->saldo;
		$rows[0]=array("no_sumber"=>"SALDO","tanggal"=>"SALDO","jenis"=>"SALDO","qty_masuk"=>0,"qty_keluar"=>0,
			"saldo"=>number_format($awal),"gudang"=>"");

		$sql="select no_sumber,tanggal,jenis,qty_masuk,qty_keluar,gudang
			from qry_kartustock_union
			where item_number='$item_number' 
			and tanggal between '$date_from' and '$date_to' ";
			
		if($gudang!="")$sql.=" and gudang='$gudang'";
		$sql.=" order by tanggal";

        $query=$this->db->query($sql);
		 
        $i=1;
		if($query)foreach($query->result_array() as $row) {
			$awal=$awal+$row['qty_masuk']-$row['qty_keluar'];
			$row['qty_masuk']=number_format($row['qty_masuk'],2);
			$row['qty_keluar']=number_format($row['qty_keluar'],2);
			$row["saldo"]=number_format($awal,2);
			$rows[$i++]=$row;
		};	
        $data['total']=$i;
        $data['rows']=$rows;
                    
        echo json_encode($data);

	}
	function list_info($offset=0){
		if(isset($_GET['offset'])){
			$offset=$_GET['offset'];
		}
		$data['offset']=$offset;
		$this->load->library('search_criteria');

		$faa[]=criteria("Kode","sid_kode");
		$faa[]=criteria("Nama","sid_nama");
		$faa[]=criteria("Supplier","sid_supp");
		$faa[]=criteria("Kelompok","sid_cat");
	
		$data['criteria']=$faa;
		$data['criteria_text']=criteria_text($faa);
		$data['sid_kode']=$this->session->userdata('sid_kode');
		$data['sid_nama']=$this->session->userdata('sid_nama');
		$data['sid_supp']=$this->session->userdata('sid_supp');
		$data['sid_cat']=$this->session->userdata('sid_cat');
		
		$this->template->display_form_input('inventory/info_list',$data);	
	}
	function pos_items_filter($search=""){
		$search=urldecode($search);
		$s="select item_number,description,retail,item_picture
			from inventory where 1=1";
		if($search!=""){
			$s .= " and (description like '%".$search."%' or item_number like '%".$search."%')";
		}
		$s.=" order by description";
		$ss = "";
		$ar=null;
		if($q=$this->db->query($s)){
		   foreach($q->result() as $r) {
			   $item_picture=$r->item_picture;
			   $item_picture=load_picture($item_picture);
			   $ss .= "<div class='item-cell box-gradient' id='".$r->item_number."' align='center'>";
				$ss .= "<span class='badge' style='float:left'>Rp. ".number_format($r->retail)."</span>";
				$ss .= "<img src='".$item_picture."'>
						<p>".$r->description."</p>";
				$ss .= "</div>";
				$disc_prc=$this->promo_disc_item($r->item_number);
				$r->disc_prc_1=$disc_prc['disc_prc_1'];
				$r->disc_prc_2=$disc_prc['disc_prc_2'];
				$r->disc_prc_3=$disc_prc['disc_prc_3'];
				$ar[]=$r;
			}
		}
		if($ss=="")$ss="<h3>No Items with this criteria $search</h3>";
		$data['html']=$ss;
		$data['rec']=$ar;
		echo json_encode($data);
	}
	
	function pos_items($category=""){
		$category=urldecode($category);
		$s="select item_number,description,retail,item_picture
			from inventory where 1=1";
		if($category=="all")$category="";
		if($category!=""){
			$s .= " and category='$category'";
		}
		$s.=" order by description";
//		$s .= " limit 10";
		$ss = "";
		$ar=null;
		if($q=$this->db->query($s)){
		   foreach($q->result() as $r) {
			   $item_picture=$r->item_picture;
			   $item_picture=load_picture($item_picture);
			   $ss .= "<div class='item-cell box-gradient' id='".$r->item_number."' align='center'>";
				$ss .= "<span class='badge' style='float:left'>Rp. ".number_format($r->retail)."</span>";
				$ss .= "<img src='".$item_picture."'>
						<p>".$r->description."</p>";
				$ss .= "</div>";
				$disc_prc=$this->promo_disc_item($r->item_number);
				$r->disc_prc_1=$disc_prc['disc_prc_1'];
				$r->disc_prc_2=$disc_prc['disc_prc_2'];
				$r->disc_prc_3=$disc_prc['disc_prc_3'];
				$ar[]=$r;
			}
		}
		if($ss=="")$ss="<h3>No Items with this category $category</h3>";
		$data['html']=$ss;
		$data['rec']=$ar;
		echo json_encode($data);
	}
	function promo_disc_item($item_number){
		$sql="select disc_prc_1,disc_prc_2,disc_prc_3 
			from promosi_item 
			where item_number='ALL_ITEM' and '".date('Y-m-d H:i:s')."' 
			between from_date and to_date";
		$retval['disc_prc_1']=0;
		$retval['disc_prc_2']=0;
		$retval['disc_prc_3']=0;
		if($q=$this->db->query($sql)){
			if($r=$q->row()){
				$retval['disc_prc_1']=$r->disc_prc_1;
				$retval['disc_prc_2']=$r->disc_prc_2;
				$retval['disc_prc_3']=$r->disc_prc_3;			
			} else {
				$sql="select disc_prc_1,disc_prc_2,disc_prc_3 
					from promosi_item 
					where item_number='$item_number' and '".date('Y-m-d H:i:s')."' 
					between from_date and to_date and (disc_type is null or disc_type=1)
					order by disc_prc_1 desc";
				if($q=$this->db->query($sql)){
					if($r=$q->row()){
						$retval['disc_prc_1']=$r->disc_prc_1;
						$retval['disc_prc_2']=$r->disc_prc_2;
						$retval['disc_prc_3']=$r->disc_prc_3;
					}	
				}
				
			}
		}
		return $retval;
	}
	function pos_category($page=0){	
		$s="";
		$page=$page*5;
		$s .="<div class='cat-cell' id='all' align='center' title='Product by this category'>";
		$s .="<img src='".load_picture("")."'><p>All Category</p>";
		$s .= "</div>";
		if($q=$this->db->query("select kode,category 
			from inventory_categories
			order by category")){
		   foreach($q->result() as $r) {
			   $item_picture='';	//$r->item_picture;
			   $item_picture=load_picture($item_picture);
			   
				$s .="<div class='cat-cell' id='$r->kode' align='center' title='Product by this category'>";
				$s .="<img src='$item_picture'><p>".$r->category."</p>";
				$s .= "</div>";
			}
		}
		echo $s;
	}
	function supplier_list($item_number){
		$sql="select a.supplier_number,s.supplier_name,a.supplier_item_number,a.lead_time,a.cost
		 from inventory_suppliers a 
		 left join suppliers s on s.supplier_number=a.supplier_number
		  where a.item_number='$item_number'";
		echo datasource($sql);
	}
	function supplier_load($item_number,$supplier_number){
   		$id=urldecode($item_number);
   		$supplier_number=urldecode($supplier_number);
		$this->load->model('inventory_suppliers_model');
		$ok=false;
		if($query=$this->inventory_suppliers_model->get_by_id($item_number,$supplier_number)){
			if($row=$query->result()){
				//var_dump($row[0]);
				$data=array('success'=>true,
					"supplier_number"=>$row[0]->supplier_number,
					"supplier_name"=>$row[0]->supplier_name,"cost"=>$row[0]->cost,
					"lead_time"=>$row[0]->lead_time,"supplier_item_number"=>$row[0]->supplier_item_number);
				$ok=true;
			}
		}
		if ($ok){echo json_encode($data);} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
	}
	function fields(){
		$flds[]=array("field"=>"item_number","title"=>"Kode Barang","width"=>"80");
		$flds[]=array("field"=>"description","title"=>"Nama Barang","width"=>"80");
		$flds[]=array("field"=>"retail","title"=>"Harga","width"=>"80");
		echo json_encode($flds);
	}
	function assembly_load($item_number,$assembly_item_number){
   		$id=urldecode($item_number);
   		$assembly_item_number=urldecode($assembly_item_number);
		$this->load->model('inventory_assembly_model');
		$ok=false;
		if($query=$this->inventory_assembly_model->get_by_id($item_number,$assembly_item_number)){
			if($row=$query->result()){
				//var_dump($row[0]);
				$data=array('success'=>true,
					"assembly_item_number"=>$row[0]->assembly_item_number,
					"description"=>$row[0]->description,"default_cost"=>$row[0]->default_cost,
					"quantity"=>$row[0]->quantity,"comment"=>$row[0]->comment);
				$ok=true;
			}
		}
		if ($ok){echo json_encode($data);} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
	}
	function input_col($colname){
		$c=0;
		if($this->input->post($colname)!=""){
			$c=65-ord(strtoupper($this->input->post($colname)));
		}
		return abs($c);
	}
	function import_excel(){
		$c_kode=$this->input_col('kode');
		$c_nama=$this->input_col('nama');
		$c_jual=$this->input_col('jual');
		$c_beli=$this->input_col('beli');
		$c_unit=$this->input_col('satuan');
		$c_class=$this->input_col('item_class');
		$c_categori1=$this->input_col('categori1');
		$c_categori2=$this->input_col('categori2');
		$c_categori3=$this->input_col('categori3');
		$c_cost=$this->input_col('cost');
		$c_jual1=$this->input_col('jual1');
		$c_jual2=$this->input_col('jual2');
		$c_jual3=$this->input_col('jual3');
		$c_supplier=$this->input_col('supplier');
		$c_division=$this->input_col('division');
		
		$filename=$_FILES["file_excel"]["tmp_name"];
		if($_FILES["file_excel"]["size"] > 0)
		{
			$file = fopen($filename, "r");
			$i=0;
			$ok=false;
			$this->db->trans_begin();
			while (($emapData = fgetcsv($file, 10000, chr(9))) !== FALSE)
			{
				//print_r($emapData[$c_kode]);
				//exit();
				$item_no=$emapData[$c_kode];
				if(! ($item_no == null or $item_no == "" or $item_no == "kode" ) ) {
					$i++;
					$data["item_number"]=$item_no;
					if($c_nama>0)$data["description"]=$emapData[$c_nama];
					if($c_unit>0)$data["unit_of_measure"]=$emapData[$c_unit];
					if($c_jual>0)$data["retail"]=$emapData[$c_jual];
					if($c_cost>0)$data["cost"]=$emapData[$c_cost];
					if($c_beli>0)$data["cost_from_mfg"]=$emapData[$c_beli];
					$data['class']="Stock Item";
					if($c_class>0)$data["class"]=$emapData[$c_class];
					if($data['class']=="")$data["class"]="Stock Item";
					$data["create_by"]=user_id();
					if($c_categori1>0)$data["category"]=$emapData[$c_categori1];
					if($c_categori2>0)$data["sub_category"]=$emapData[$c_categori2];
//					if($c_categori2>0)$data["sub_cat_1"]=$emapData[$c_categori3];
					$data['active']="1";
					if($c_supplier>0)$data["supplier_number"]=$emapData[$c_supplier];
					if($c_division>0)$data["division"]=$emapData[$c_division];
					if($this->inventory_model->exist($item_no)){
						unset($data['item_number']);
						$ok=$this->inventory_model->update($item_no,$data)==1;
						echo "Update: Row $i : ".$item_no."</br>";
					} else {
						$ok=$this->inventory_model->save($data)==1;
						echo "Insert: Row $i : ".$item_no."</br>";
					}
				}
			}
			if ($this->db->trans_status() === FALSE)
			{
				echo "Error: Row $i : ".$item_no." : ".$this->db->display_error()."</br>";
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}			
			fclose($file);
			if ($ok){echo json_encode(array("success"=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}   	
		}
		echo "<div class='alert alert-success'>FINISH.</div>";
	}
	function import_inventory(){
		$data['caption']="IMPORT DATA MASTER";
		$this->template->display("inventory/import_master",$data);
	}
	function saldo_stock()
	{
		if($data=$this->input->get())
		{
			$tgl=$data['tanggal'];
			$gdg=$data['gudang'];
			$success=false;	$data=array(); $message="";
			$s="select i.item_number,iw.description,iw.quantity_in_stock 
			,category
			from inventory i order by i.item_number";
			if($q=$this->db->select("item_number,description,category,quantity_in_stock")
				->order_by("item_number")->get("inventory") )
			{
				$data=array();
				foreach($q->result() as $row)
				{
					$q_gdg=$this->inventory_model->qty_gudang($row->item_number,$gdg);
					$data[]=array('item_number'=>$row->item_number,
							'description'=>$row->description,
							'category'=>$row->category,
							'qty_all'=>$row->quantity_in_stock,
							'qty_gudang'=>$q_gdg,
							'category'=>$row->category);
						
				}
				$success=true;
			}
			echo json_encode(array("success"=>$success,"data"=>$data,"message"=>$message));
			
		} else {
			$data['caption']="SALDO STOCK";
			$this->template->display("inventory/saldo_stock",$data);		
		}
	}
	function print_barcode($item_number,$qty,$size){
		$item_number=urldecode($item_number);
		if($size=="0"){
			$this->print_barcode_size_0($item_number,$qty);
		} else if($size=="1"){
			$this->print_barcode_size_1($item_number,$qty);
		}
	}
	function print_barcode_size_0($item_number,$qty){			
		$item_number=urldecode($item_number);
		$this->load->helper('pdf_helper');		
		tcpdf();
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		//$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('Print Barcode Kecil '.$pdf->getPageHeight());
		//$pdf->SetSubject('TCPDF Tutorial');
		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 027', PDF_HEADER_STRING);

		// set header and footer fonts
		//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(0, 0, PDF_MARGIN_RIGHT);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		//1.25
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set font
		$pdf->SetFont('helvetica', '', 11);

		// add a page
		$pdf->AddPage();

		// print a message
		//$txt = "You can also export 1D barcodes in other formats (PNG, SVG, HTML). Check the examples inside the barcodes directory.\n";
		//$pdf->MultiCell(70, 50, $txt, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);

		// -----------------------------------------------------------------------------

		$pdf->SetFont('dejavuserifcondensed', '', 6);

		// define barcode style
		$style = array(
			'position' => '',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => '',
			'border' => true,
			'hpadding' => 'auto',
			'vpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255),
			'text' => true,
			'font' => 'helvetica',
			'fontsize' => 6,
			'stretchtext' => 4
		);
		$row=$this->db->where('item_number',$item_number)->get('inventory')->row();
		// CODE 39 EXTENDED
		for($i=0;$i<$qty;$i++){
			$top=$i*20;
			$pdf->SetY($top);
			$pdf->SetX(0);
			$pdf->write1DBarcode($row->item_number, 'C39', '', '', '', 13, 0.3, $style, 'N');
			$pdf->MultiCell(100, 0, $row->description, 0, 'L', false, 1, 0, $top+13, true, 0, false, true, 0, 'T', false);
			$x2=50;
			$pdf->SetY($top);
			$pdf->SetX($x2);
			$pdf->write1DBarcode($row->item_number, 'C39', '', '', '', 13, 0.3, $style, 'N');
			$pdf->MultiCell(100, 0, $row->description, 0, 'L', false, 1, $x2, $top+13, true, 0, false, true, 0, 'T', false);
//			$pdf->AddPage();
		}
		$pdf->Output('pdf_output', 'I');

	}
	function print_barcode_size_1($item_number,$qty){			
		$this->load->helper('pdf_helper');		
		tcpdf();
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Print Barcode Besar');
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(0, 0, PDF_MARGIN_RIGHT);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetFont('helvetica', '', 11);
		$pdf->AddPage();
		$pdf->SetFont('dejavuserifcondensed', '', 8);
		$style = array(
			'position' => '',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => '',
			'border' => true,
			'hpadding' => 'auto',
			'vpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, 
			'text' => true,
			'font' => 'helvetica',
			'fontsize' => 8,
			'stretchtext' => 4
		);
		$row=$this->db->where('item_number',$item_number)->get('inventory')->row();
		// CODE 39 EXTENDED
		for($i=0;$i<$qty;$i++){
			$top=$i*30;
			$pdf->SetY($top);
			$pdf->SetX(0);
			$pdf->write1DBarcode($row->item_number, 'C39', '', '', '', 18, 0.4, $style, 'N');
			$pdf->MultiCell(100, 0, $row->description.' Rp.'.number_format($row->retail), 0, 'L', false, 1, 0, $top+20, true, 0, false, true, 0, 'T', false);
		}
		$pdf->Output('pdf_output', 'I');

	}
	function closing(){
		$this->load->model("shipping_locations_model");
		$data["message"]="";
		$data["periode"]=null;

		$this->closing_proses();

		if($query=$this->db->query("select year(tanggal) as tahun, month(tanggal) as bulan 
		from inventory_beginning_balance group by year(tanggal),month(tanggal)")){
			$data["periode"]=$query;
		}
		$data["caption"]="PROSES CLOSING STOCK";
		$this->template->display("inventory/closing",$data);
	}
	function closing_delete($tahun,$bulan){
		$data["message"]="";
		$sql="delete from inventory_beginning_balance where year(tanggal)=$tahun 
		and month(tanggal)=$bulan";
		$this->db->query($sql);
		
		if($query=$this->db->query("select year(tanggal) as tahun, month(tanggal) as bulan 
		from inventory_beginning_balance group by year(tanggal),month(tanggal)")){
			$data["periode"]=$query;
		}
		$data["caption"]="PROSES CLOSING STOCK";
		
		
		$this->template->display("inventory/closing",$data);
	}
	function closing_view($tahun,$bulan){
		$this->load->model("shipping_locations_model");
		$data["caption"]="VIEW CLOSING STOCK <strong>[$tahun - $bulan]</strong>";
		$sql="select b.item_number,i.description";
		$gdg2="";
		$gudang=$this->shipping_locations_model->get_all_array();
		for($iGdg=0;$iGdg<count($gudang);$iGdg++){
			$gdg=$gudang[$iGdg]['gudang'];
			$urut=$gudang[$iGdg]['no_urut'];
			$fld_gdg="qty_akhir_gd".$urut." as $gdg";
			$gdg2=$gdg2.",$fld_gdg";						
		}
		$sql.="$gdg2 from inventory_beginning_balance  b 
		left join inventory i on i.item_number=b.item_number
		where year(tanggal)=$tahun and month(tanggal)=$bulan 
		order by b.item_number";
		$table="<table class='table'><thead><tr><th>Item Number</th><th>Description</th>";
		for($iGdg=0;$iGdg<count($gudang);$iGdg++){
			$gdg=$gudang[$iGdg]['gudang'];
			$table.="<th>$gdg</th>";
		}
		$table.="<th>Total</th></tr></thead>";
		
		if($query=$this->db->query($sql)){
			
			foreach($query->result_array() as $row){
				$table.="<tr><td>".$row['item_number']."</td>
				<td>".$row['description']."</td>";
				$qty=0;
				for($iGdg=0;$iGdg<count($gudang);$iGdg++){
					$gdg=$gudang[$iGdg]['gudang'];
					$table.="<td>".$row[$gdg]."</td>";
					$qty=$qty+$row[$gdg];
				}
				
				$table.="<td>$qty</td></tr>";
			}
		}
		$table.="</table>";
		$data["table"]=$table;
		
		if($query=$this->db->query("select year(tanggal) as tahun, month(tanggal) as bulan 
		from inventory_beginning_balance group by year(tanggal),month(tanggal)")){
			$data["periode"]=$query;
		}
		$data['message']="";
		$this->template->display("inventory/closing",$data);
		
	}
	function closing_proses(){
		$exist=false;
		if($post=$this->input->post()){
			$tahun=$post["tahun"];
			$bulan=$post["bulan"];
			$tanggal=$tahun."-".$bulan."-1";
			$tanggal=date("Y-m-t", strtotime($tanggal));
			
			$sql="select count(1) as cnt from inventory_beginning_balance 
				where year(tanggal)=$tahun and month(tanggal)=$bulan";
				
			$exist=$this->db->query($sql)->row()->cnt>0;
			
			if($exist){
				$data["message"]="Periode $tahun - $bulan sudah diclosing tidak bisa diteruskan.";
			} else {
				//proses closing
				$gudang=$this->shipping_locations_model->get_all_array();
				$items=$this->inventory_model->item_list_all();
				$i=0;
				for($i=0;$i<count($items);$i++){
					$item_no=$items[$i]["item_number"];
					for($iGdg=0;$iGdg<count($gudang);$iGdg++){
						$gdg=$gudang[$iGdg]['gudang'];
						$urut=$gudang[$iGdg]['no_urut'];
						
						$sql="select sum(qty_masuk)-sum(qty_keluar) as z_qty 
							from qry_kartustock_union where item_number='$item_no' 
							and gudang='$gdg' and year(tanggal)<=$tahun 
							and month(tanggal)<=$bulan";
						 
						//echo $sql."</br>";
						$nQty=$this->db->query($sql)->row()->z_qty;
						if($nQty==null){
							$nQty=0;
						}
						$fld_gdg="qty_akhir_gd".$urut;
						
						$sql="select count(1) as cnt from inventory_beginning_balance
							where item_number='$item_no'  and year(tanggal)=$tahun 
							and month(tanggal)=$bulan";
						$cnt=$this->db->query($sql)->row()->cnt;
						if($cnt==0){
							$sql="insert into inventory_beginning_balance(tanggal,
							item_number,$fld_gdg) 
							values('$tanggal','$item_no',$nQty)";

						} else {
							$sql="update inventory_beginning_balance set $fld_gdg=$nQty 
							where item_number='$item_no' and year(tanggal)=$tahun 
							and month(tanggal)=$bulan";
							
						}
						
						//echo $sql."</br>";
						//flush();
						$this->db->query($sql);
					}
				}
			}
		}
		
	}
	function print_inventory(){
		$this->rpt("daftar");
	}
}
?>
