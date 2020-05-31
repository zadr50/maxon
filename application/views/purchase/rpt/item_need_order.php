<?php
	 $CI =& get_instance();

		$data['caption']="DAFTAR BARANG YANG HARUS DIBELI";
		$sql="select i.item_number,i.description,
		(i.quantity_on_back_order-i.quantity_on_order-i.reorder_quantity-i.quantity_in_stock) qty_order,
		i.quantity_in_stock as qty_stock,
		i.reorder_quantity as qty_min,
		i.quantity_on_order as qty_on_order,
		i.quantity_on_back_order as qty_max,
		i.unit_of_measure as unit,
		c.category as category,
		s.supplier_name as supplier
			FROM inventory i 
			left join suppliers s on s.supplier_number=i.supplier_number 
			left join inventory_categories c on c.kode=i.category
			where (i.quantity_on_back_order-i.quantity_on_order-i.reorder_quantity-i.quantity_in_stock)>i.reorder_quantity ";
		
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
		
		$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false)
		);
		 $data['header']=company_header();
		 $data['criteria']="Kelompok: $kel, Supplier: $supp_name - $supp";
		$this->load->view('simple_print.php',$data);    		
?>		