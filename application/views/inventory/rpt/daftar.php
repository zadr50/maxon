<?php 
	 $CI =& get_instance();
	if(!$CI->input->post('cmdPrint')){
		$data['criteria1']=true;
		$data['label1']='Kelompok Barang';
		$data['text1']='';
         $data['key1']="kode";
         $data['fields1'][]=array("kode","80","Kode");
         $data['fields1'][]=array("category","180","Kelompok");
         $data['ctr1']='category/select';
		
		$data['criteria2']=true;
		$data['label2']='Supplier';
		$data['text2']='';
         $data['key2']="supplier_number";
         $data['fields2'][]=array("supplier_number","80","Kode");
         $data['fields2'][]=array("supplier_name","180","Supplier");
         $data['ctr2']='supplier/select';
		
		$data['caption']='DAFTAR BARANG';
		$data['rpt_controller']="inventory/rpt/$id";
		$CI->template->display_form_input('criteria',$data,'');
	} else {
		$data['caption']="DAFTAR MASTER BARANG";
		$sql="select i.item_number,i.description,i.quantity_in_stock as qty,
		i.unit_of_measure as unit,
		ip.qty_last as m_qty,ip.customer_pricing_code as m_unit,		
		i.retail as h_jual,i.cost,
		i.cost*i.quantity_in_stock as total_cost,
		c.category as cat_name,i.cost_from_mfg
			FROM inventory i 
			left join suppliers s on s.supplier_number=i.supplier_number 
			left join inventory_categories c on c.kode=i.category
            left join inventory_prices ip on ip.item_number=i.item_number
						where 1=1";
		//i.category,i.supplier_number,		s.supplier_name,i.model,i.manufacturer,
		$kel=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
		if($kel!="")$sql.=" and i.category='".$kel."'";
		
		$supp_name="";
		$supp=""; if($CI->input->post("text2"))$supp=$CI->input->post("text2");
		if($supp!=""){
			$sql.=" and i.supplier_number='$supp'";
			if($rsupp=$this->db->query("select supplier_name from suppliers 
				where supplier_number='$supp'")->row()){
				$supp_name=$rsupp->supplier_name;
			}	
		}	
		$sql.=" order by i.item_number";
		
		//echo $sql;
		
		$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false)
		);
		 $data['header']=company_header();
		 $data['criteria']="Kelompok: $kel, Supplier: $supp_name - $supp";
		$this->load->view('simple_print.php',$data);    		
		
	}

?>