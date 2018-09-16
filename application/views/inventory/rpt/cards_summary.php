<?php 
     $CI =& get_instance();
    $data['caption']='SALDO STOCK';
    if(!$CI->input->post('cmdPrint')){
    	
        $data['criteria1']=true;
        $data['label1']='Kelompok Barang';
        $data['text1']='';
         $data['output1']="text1";
         $data['key1']="kode";
         $data['fields1'][]=array("kode","80","Kode");
         $data['fields1'][]=array("category","180","Kelompok");
         $data['ctr1']='category/select';
		
		
        $data['criteria2']=true;
        $data['label2']='Kode Barang';
        $data['text2']='';
         $data['output2']="text2";
         $data['key2']="item_number";
         $data['fields2'][]=array("item_number","80","Kode");
         $data['fields2'][]=array("description","180","Nama Barang");
         $data['ctr2']='inventory/select';
		
        $data['rpt_controller']="inventory/rpt/$id";
        $CI->template->display_form_input('criteria',$data,'');
    } else {
        $sql="select w.item_number,i.description,
		concat(ic.category,' (',i.category,')') as category,
        
        i.supplier_number,
            w.warehouse_code,w.quantity,i.cost,i.cost*w.quantity as amount
            from inventory_warehouse w 
            inner join inventory i  on w.item_number=i.item_number 
            left join inventory_categories ic on ic.kode=i.category
            where 1=1 ";
        
        $kel=$CI->input->post("text1");
        if($kel!="")$sql.=" and i.category='".$kel."'";
		
        $item=$CI->input->post('text2');
        if($item!="")$sql.=" and i.item_number='$item'";
		
        $data['content']=browse_select(array('sql'=>$sql,'show_action'=>false,
	        'order_by'=>array('item_number','warehouse_code'))
        );
	//	$sql.=" order by i.item_number,w.warehouse_code";
		
		
         $data['header']=company_header();
		 $data['criteria']="Kelompok: $kel, Kode Barang: $item";
        $this->load->view('simple_print.php',$data);            
        
    }

?>