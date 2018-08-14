<?php 
    $CI =& get_instance();
    $data['caption']='DAFTAR REKENING BANK';

    if(!$CI->input->post('cmdPrint')){
        $data['criteria1']=false;
        $data['label1']='Kota';
        $data['text1']='';
        $data['rpt_controller']="banks/rpt/load/banks";
        $CI->template->display_form_input('criteria',$data,'');
    } else {
        $sql="select bank_account_number,bank_name,city,i.account_id,c.account,c.account_description,
            i.org_id,cw.debit, cw.credit,cw.debit-cw.credit as saldo 
            FROM bank_accounts i 
            left join chart_of_accounts c on c.id=i.account_id
            left join (select account_number,
                sum(deposit_amount) as debit, 
                sum(payment_amount) as credit
                from check_writer 
                group by account_number)
                cw on cw.account_number=i.bank_account_number
            where 1=1";
        $kota=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
        if($kota!="")$sql.=" and city='".$kota."'";
        $data['content']=browse_select( array('sql'=>$sql,'show_action'=>false)
        );
         $data['header']=company_header();
        $this->load->view('simple_print.php',$data);            
        
    }

?>