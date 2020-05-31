<?php 
	 $CI =& get_instance();
	 $d1 = date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	 $d2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
	 
		$data['caption']="DAFTAR SERVICE ORDER";
		$sql="select i.no_bukti,i.tanggal,i.customer,c.company,
		i.jenis_masalah,i.masalah,i.serial as item_mesin,i.serv_rep,i.comments,i.service_amt
			FROM service_order i 
			left join customers c on c.customer_number=i.customer 
			where tanggal between '$d1' and '$d2' ";
		$customer=$CI->input->post("text1");
		if($customer!="")$sql.=" and i.customer='$customer'";
		$sql.=" order by i.no_bukti";
		$data['content']=browse_select(	array('sql'=>$sql,'show_action'=>false,
			"fields_sum"=>array("service_amt")
		));
		 $data['header']=company_header();
		 $data['criteria']="Tanggal: $d1 s/d $d2, Customer: $customer";
		$this->load->view('simple_print.php',$data);    		
?>