<?php
class Replicate extends CI_Controller {
    function __construct()    {
		parent::__construct();        
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','form_validation','template'));
		$this->load->model(array('replicate_model','inventory_model','customer_model',
			'supplier_model','bank_accounts_model','retur_toko_model'));
		
    }
    function index(){}
	
	function process_jual($invoice_number){
		$this->replicate_model->nomor=$invoice_number;
		$this->replicate_model->jual();
		
	}
    function process(){
    	$item_number=$this->inventory_model->next_item_recalc();
        if($item_number!="")$this->replicate_model->inventory($item_number);
        
		$customer_number=$this->customer_model->next_customer_recalc();
		if($customer_number!="")$this->replicate_model->customer();
		
		$supplier_number=$this->supplier_model->next_supplier_recalc();
		if($supplier_number!="")$this->replicate_model->supplier();
		
		$bank_number=$this->bank_accounts_model->next_bank_recalc();
		if($bank_number!="")$this->replicate_model->bank();
		
		$this->inventory_model->convert_kode_lama();
		
		$this->replicate_model->purchase_order();
		$this->replicate_model->beli();
		$this->replicate_model->retur_beli();
		$this->replicate_model->payment_beli();
		$this->replicate_model->crdb_beli();
		$this->replicate_model->sales_order();
		$this->replicate_model->delivery_order();
		$this->replicate_model->jual();
		$this->replicate_model->retur_jual();
		$this->replicate_model->payment_jual();
		$this->replicate_model->crdb_jual();
		$this->replicate_model->recv_po();
		$this->replicate_model->recv_etc();
		$this->replicate_model->delivery_etc();
		$this->replicate_model->stock_mutasi();
		$this->replicate_model->stock_adjust();
		
		$this->replicate_model->jurnal();
		$this->replicate_model->bank();
		
		$this->retur_toko_model->replicate();
		
		
		$msg=$this->inventory_model->message_text();
        $msg.=$this->replicate_model->message_text();
		if($msg=="")$msg="Ready.";
        echo json_encode(array("success"=>true,"msg"=>$msg));
    }    		
	function setting(){
		if($data=$this->input->post()){
			$this->setting_save($data);
			$data['message']="Setting sudah diupdate. <script>xremove_tab_parent()</script>";
			
		}
		$data['caption']="Setting data transfer and replicate";
		$this->template->display("admin/replicate",$data);
	}
	function setting_save($data){
			
		$setck=array("inventory","customer","supplier","bank","coa","so","jual","do",
			"retur_jual","pay_jual","crdb_jual","po","beli","pay_beli","retur_beli",
			"crdb_beli","recv_po","recv_etc","do_etc","stock_adjust","stock_mutasi",
			"cash","jurnal","retur_toko");
			
		for($j=0;$j<count($setck);$j++){
				
			$proc=$setck[$j];
			
			if(!isset($data['ck_'.$proc]))$data['ck_'.$proc]=false;
			putvar("copy_".$proc, $data["ck_".$proc]);
			$proc_idx=$data[$proc];
			
			for($i=0;$i<10;$i++){
				$ii=$i+1;
				putvar("db_".$proc."_".$ii,$proc_idx[$i]);
			}
			
		}
		
	}
}
?>
