<?php
    $CI =& get_instance();
    $data['caption']='DAFTAR PEMBAYARAN FAKTUR';

        $date_from=$CI->input->post("txtDateFrom");
        $date_to=$CI->input->post("txtDateTo");
        
        $sql="select 
        i.supplier_number,s.supplier_name,p.no_bukti,
        p.date_paid,i.purchase_order_number as faktur,
        i.po_date,i.potype,i.terms,i.warehouse_code,
        sum(p.amount_paid) as amount_paid, sum(i.amount) as amount_invoice,
        sum(i.amount)-sum(p.amount_paid) as balance     
        from payables_payments p 
        left join purchase_order i on i.purchase_order_number=p.purchase_order_number
        left join suppliers s on s.supplier_number=i.supplier_number
        left join chart_of_accounts c on c.id=p.how_paid_account_id
        where p.date_paid between '$date_from' and '$date_to' ";
        
        if($supplier=$CI->input->post("text1"))$sql.=" and p.supplier_number='$supplier'";
        $sql.=" group by i.supplier_number,s.supplier_name,p.no_bukti,
        p.date_paid,i.purchase_order_number,        
        i.po_date,i.potype,i.terms,i.warehouse_code";
        
        
        $data['content']=browse_select( 
            array('sql'=>$sql,'show_action'=>false,
                "fields_sum"=>array("amount_paid","amount_invoice","balance"),
                "group_by"=>array("supplier_number")
            )
        );
         $data['header']=company_header();
         $data['criteria']="Date From: $date_from - $date_to, Supplier: $supplier";
        $this->load->view('simple_print.php',$data);            
?>