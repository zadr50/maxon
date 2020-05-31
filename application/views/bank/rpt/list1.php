<?php 
    $CI =& get_instance();
    $data['caption']='DAFTAR REKENING BANK';

    if(!$CI->input->post('cmdPrint')){
         $data['select_date']=true;        
         $data['date_from']=date("Y-m-1");
         $data['date_to']=date('Y-m-d 23:59:59');
    	
        $data['criteria1']=false;
        $data['label1']='Kota';
        $data['text1']='';
        $data['rpt_controller']="banks/rpt/load/banks";
        $CI->template->display_form_input('criteria',$data,'');
    } else {
	    $date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	    $date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    	
        $sql="select bank_account_number,bank_name,
            cwa.awal,cw.debit, cw.credit,cw.debit-cw.credit as akhir, 
        	c.account,c.account_description
            FROM bank_accounts i 
            left join chart_of_accounts c on c.id=i.account_id
            left join (select account_number,
                sum(deposit_amount) as debit, 
                sum(payment_amount) as credit
                from check_writer
                where check_date between '$date1' and '$date2' 
                group by account_number)
                cw on cw.account_number=i.bank_account_number
            left join (select account_number,
                sum(deposit_amount)-sum(payment_amount) as awal
                from check_writer
                where check_date<'$date1' 
                group by account_number
	            ) cwa on cwa.account_number=i.bank_account_number
            where 1=1";
		
		
        $kota=""; if($CI->input->post("text1"))$kel=$CI->input->post("text1");
        if($kota!="")$sql.=" and city='".$kota."'";
        $data['content']=browse_select( 
        	array('sql'=>$sql,'show_action'=>false,
			'fields_sum'=>array('debit',"credit",'awal','akhir'))
        );
         $data['header']=company_header();
		 $data['criteria']="Criteria: Dari Tanggal: $date1 s/d : $date2 ";
		 
        $this->load->view('simple_print.php',$data);            
        
    }

?>