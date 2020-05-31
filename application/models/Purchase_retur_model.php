<?php
class Purchase_retur_model extends CI_Model {

private $primary_key='purchase_order_number';
private $table_name='purchase_order';
	function __construct(){
		parent::__construct();        
        
		$this->load->model('purchase_order_model');
	}
	
	function posting($nomor)	{
		$this->purchase_order_model->recalc($nomor);
		$po_date=date("Y-m-d H:i:s");
		$supplier_number="";
		$account_id=0;
		$amount=0;
		$comments="";
		$tax_amount=0;
		if($fakturq=$this->purchase_order_model->get_by_id($nomor)){
			if($faktur=$fakturq->row()){
				$po_date=$faktur->po_date;
				$supplier_number=$faktur->supplier_number;
				$account_id=$faktur->account_id;
				$amount=$faktur->amount;
				$comments=$faktur->comments;
				$tax_amount=$faktur->tax_amount;
			}	
		};

		$this->load->model("periode_model");
		if($this->periode_model->closed($po_date)){
			echo "ERR_PERIOD";
			return false;
		}
		$this->load->model('purchase_order_lineitems_model');
		$this->load->model('jurnal_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('company_model');
		$this->load->model('supplier_model');
		$this->load->model('inventory_model');
			
		$date=$po_date;
		$supplier_account_number="";
		if($supplierq=$this->supplier_model->get_by_id($supplier_number)){
			if($supplier=$supplierq->row()){
				$supplier_account_number=$supplier->supplier_account_number;
			}	
		};
		$akun_hutang=$account_id;
		$gl_id=$nomor;
		$debit=0; $credit=0;$operation="";$source="";
		// posting hutang / ap
		if(invalid_account($akun_hutang))$akun_hutang=$supplier_account_number;
		if(invalid_account($akun_hutang))$akun_hutang=$this->company_model->setting("accounts_payable");
		$account_id=$akun_hutang; $debit=$amount; $credit=0;
		$operation="AP Posting"; $source=$comments;
		$this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source);
		
		// posting tax amount
		$tax_amount=$tax_amount;
		if($tax_amount>0){
			$akun_ppn=$this->company_model->setting("po_tax");
			$account_id=$akun_ppn; $debit=0; $credit=$tax_amount;
			$operation="AP Tax Posting"; $source=$comments;
			$this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source);
		}
			
		// posting persediaan
		$items=$this->purchase_order_lineitems_model->get_by_nomor($nomor);
		foreach($items->result() as $row) {
			$item=$this->inventory_model->get_by_id($row->item_number)->row();
			
			$account_id=$item->inventory_account; 
			if(!$account_id)$account_id=$this->company_model->setting('inventory');
			
			$debit=0; $credit=$row->total_price;
			$operation="Inventory Posting"; $source=$row->description;
			$custsuppbank=$row->item_number;
			$this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source,'',$custsuppbank);
			
		}
		
		// validate jurnal
		if($this->jurnal_model->validate($nomor)) {
			$data['posted']=true;
		} else {
			$data['posted']=false;
		}
		$this->purchase_order_model->update($nomor,$data);
	}
	function unposting($nomor) {
		$this->purchase_order_model->recalc($nomor);
		$faktur=$this->purchase_order_model->get_by_id($nomor)->row();

		$this->load->model("periode_model");
		if($this->periode_model->closed($faktur->po_date)){
			echo "ERR_PERIOD";
			return false;
		}
		// validate jurnal
		$this->load->model('jurnal_model');
		if($this->jurnal_model->del_jurnal($nomor)) {
			$data['posted']=false;
		} else {
			$data['posted']=true;
		}
		$this->purchase_order_model->update($nomor,$data);
	}
	
	function posting_range_date($date_from,$date_to){
		$this->load->model('jurnal_model');
		$this->load->model('chart_of_accounts_model');
		$this->load->model('company_model');
		$date_from=date('Y-m-d H:i:s', strtotime($date_from));
		$date_to=date('Y-m-d H:i:s', strtotime($date_to));
		$s="select purchase_order_number from purchase_order where potype='R' 
		and po_date between '$date_from' and '$date_to' and ifnull(posted,false)=false 
		order by purchase_order_number";
		$rst_inv_hdr=$this->db->query($s);
		if($rst_inv_hdr){
			foreach ($rst_inv_hdr->result() as $r_inv_hdr) {
				
				echo "<br>Posting...".$r_inv_hdr->purchase_order_number;
				$this->posting($r_inv_hdr->purchase_order_number);
						
			} // foreach rst_inv_hdr
		} // if rst_inv_hdr
		echo "<legend>Finish.</legend><div class='alert alert-info'>
		Apabila ada kesalahan silahkan periksa mungkin seting akun-akun belum benar, 
		atau jurnal tidak balance. Silahkan cek ke nomor bukti yang bersangkutan 
		dan posting secara manual atau ulangi lagi 
		<a class='btn btn-primary' href='#' onclick='window.history.go(-1); return false;'> Go Back </a>.
		<p>&nbsp</p><p>Apabila tidak ada kesalahan silahkan close tab ini.
		<a class='btn btn-primary' href='#' onclick='remove_tab_parent(); return false;'> Close </a>.		
		</p>
		</div>"; 
			
	} // posting	
	function unposting_range_date($date_from,$date_to){
		$this->load->model('jurnal_model');
		$date_from=date('Y-m-d H:i:s', strtotime($date_from));
		$date_to=date('Y-m-d H:i:s', strtotime($date_to));
		$s="select purchase_order_number from purchase_order where potype='R' 
		and po_date between '$date_from' and '$date_to' and posted=true 
		order by purchase_order_number";
		$rst_inv_hdr=$this->db->query($s);
		if($rst_inv_hdr){
			foreach ($rst_inv_hdr->result() as $r_inv_hdr) {
				$this->unposting($r_inv_hdr->purchase_order_number);
				echo "<br>Delete Jurnal: ".$r_inv_hdr->purchase_order_number;
			}
		}
		echo "<legend>Finish.</legend><div class='alert alert-info'>
		<p>Apabila tidak ada kesalahan silahkan close tab ini.
		<a class='btn btn-primary' href='#' onclick='remove_tab_parent(); return false;'> Close </a>.		
		</p>
		</div>"; 
	}
}
