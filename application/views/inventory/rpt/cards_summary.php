<?php 
     $CI =& get_instance();
    $data['caption']='SALDO STOCK';
    if(!$CI->input->post('cmdPrint')){
        $data['criteria1']=true;
        $data['label1']='Kelompok Barang';
        $data['text1']='';
        $data['criteria2']=true;
        $data['label2']='Kode Barang';
        $data['text2']='';
        $data['rpt_controller']="inventory/rpt/$id";
        $CI->template->display_form_input('criteria',$data,'');
    } else {
        $sql="select w.item_number,i.description,i.category,i.supplier_number,
            w.warehouse_code,w.quantity
            from inventory_warehouse w 
            inner join inventory i 
            on w.item_number=i.item_number 
            order by i.item_number,w.warehouse_code
            ";
        $kel=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
        if($kel!="")$sql.=" and i.category='".$kel."'";
        $item=""; if($CI->input->post('text2'))$item=$CI->input->post('text2');
        if($item!="")$sql.=" and i.item_number='$item'";
        $data['content']=browse_select(array('sql'=>$sql,'show_action'=>false,
        'order_by'=>array('item_number','warehouse_code'))
        );
         $data['header']=company_header();
        $this->load->view('simple_print.php',$data);            
        
    }

?>