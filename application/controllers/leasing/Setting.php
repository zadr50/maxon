<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Setting extends CI_Controller {
    private $limit=100;
    private $file_view='leasing/setting';
    private $controller='leasing/setting';
	private $title="SETTING DAN PENGATURAN LEASING";
    private $sql="";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		if($this->help=="")$this->help="set_leasing";
    }
    function index(){
		$data['title']=$this->title;
		$data['controller']=$this->controller;
		$data['help']=$this->help;
		$data['admin']=getvar("admin",100000);
		$data['col_lancar']=getvar("col_lancar",0);
		$data['col_no_lancar']=getvar("col_no_lancar",14);
		$data['col_macet']=getvar("col_macet",14);
		$data['hari_telat']=getvar("hari_telat",14);	//kurang dari 14 masuk sa, lebih masuk adminls
		$data['penalty']=getvar("penalty",2);
		$data['denda_prc']=getvar("denda_prc",5);
		$data['denda_hari']=getvar("denda_hari",8);
		
		$data=array_merge($data,$this->gl_link());
		$this->template->display_form_input($this->file_view,$data);
    }
	function save(){
		$ok=putvar("admin",$this->input->post("admin"));
		$ok=putvar("col_lancar",$this->input->post("col_lancar"));
		$ok=putvar("col_no_lancar",$this->input->post("col_no_lancar"));
		$ok=putvar("col_macet",$this->input->post("col_macet"));
		$ok=putvar("hari_telat",$this->input->post("hari_telat"));
		$ok=putvar("penalty",$this->input->post("penalty"));
		$ok=putvar("denda_prc",$this->input->post("denda_prc"));
		$ok=putvar("denda_hari",$this->input->post("denda_hari"));
		if($ok){
			echo json_encode(array("success"=>true));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}		
	}	
	function dp($cmd="list",$id=""){
		$id=urldecode($id);
		if($cmd=="list"){
			echo datasource("select * from ls_dp_range order by dp_from");
		}
		if($cmd=="save"){
			$data=$this->input->post();
			$id=$data['dp_id'];
			unset($data['dp_id']);
			if($id=="" or $id==0){
				$ok=$this->db->insert("ls_dp_range",$data);
			} else {
				$ok=$this->db->where("id",$id)->update("ls_dp_range",$data);
			}
			if($ok){
				echo json_encode(array("success"=>true));
			} else {
				echo json_encode(array("msg"=>"Error ".mysql_error()));
			}
		}
		if($cmd=="delete"){
			return $this->db->where("id",$id)->delete("ls_dp_range");
		}
	}
	function bunga($cmd="list",$id=""){
		$id=urldecode($id);
		if($cmd=="list"){
			echo datasource("select * from ls_bunga_range order by amount_from");
		}
		if($cmd=="save"){
			$data=$this->input->post();
			$id=$data['bunga_id'];
			unset($data['bunga_id']);
			if($id=="" or $id==0){
				$ok=$this->db->insert("ls_bunga_range",$data);
			} else {
				$ok=$this->db->where("id",$id)->update("ls_bunga_range",$data);
			}
			if($ok){
				echo json_encode(array("success"=>true));
			} else {
				echo json_encode(array("msg"=>"Error ".mysql_error()));
			}
		}
		if($cmd=="delete"){
			return $this->db->where("id",$id)->delete("ls_bunga_range");
		}
	}
	function acc_id($account){
		$account=urldecode($account);
		$data=explode(" - ", $account);
		$this->load->model("chart_of_accounts_model");
		$coa=$this->chart_of_accounts_model->get_by_id($data[0])->row();
		if($coa){
			return $coa->id;
		} else {
			return 0;
		}
	}
	function gl_link(){
		$this->load->model("company_model");
		if($this->input->post('accounts_payable')){
			$ok=true;
			$data['accounts_payable']=$this->acc_id($this->input->post('accounts_payable'));
			$data['inventory_sales']=$this->acc_id($this->input->post('inventory_sales'));
			$data['inventory']=$this->acc_id($this->input->post('inventory'));
			$data['inventory_cogs']=$this->acc_id($this->input->post('inventory_cogs'));
			$data['accounts_receivable']=$this->acc_id($this->input->post('accounts_receivable'));
			$data['default_cash_payment_account']=$this->acc_id($this->input->post('default_cash_payment_account'));
			$data['default_bank_account_number']=$this->acc_id($this->input->post('default_bank_account_number'));
			
			$this->company_model->update($this->access->cid,$data);


			$this->sysvar->save('COA Uang Muka Pembelian',$this->acc_id($this->input->post('txtUangMukaBeli')));
			$this->sysvar->save('COA Uang Muka Penjualan',$this->acc_id($this->input->post('txtUangMukaJual')));

			$this->sysvar->save('COA Piutang Bunga',$this->acc_id($this->input->post('ar_bunga')));
			$this->sysvar->save('COA Pendapatan Leasing',$this->acc_id($this->input->post('sales_leasing')));
			$this->sysvar->save('COA Pendapatan Bunga',$this->acc_id($this->input->post('sales_bunga')));
			$this->sysvar->save('COA Pendapatan Admin',$this->acc_id($this->input->post('sales_admin')));
			$this->sysvar->save('COA Pendapatan Denda',$this->acc_id($this->input->post('sales_denda')));
			$this->sysvar->save('COA Pendapatan DP',$this->acc_id($this->input->post('sales_dp')));
			$this->sysvar->save('COA Persediaan Leasing',$this->acc_id($this->input->post('leasing_inventory')));
			if($ok){
				echo json_encode(array("success"=>true));
			} else {
				echo json_encode(array("msg"=>"Error ".mysql_error()));
			}		
			
		}	
		$set=null;
		if( $q=$this->company_model->get_by_id()) {
			$set=$q->row();
		}
	 
		$data['accounts_payable']=(!$set)?'':account($set->accounts_payable);
		$data['inventory_sales']=(!$set)?'':account($set->inventory_sales);
		$data['inventory']=(!$set)?'':account($set->inventory);
		$data['inventory_cogs']=(!$set)?'':account($set->inventory_cogs);
		$data['accounts_receivable']=(!$set)?'':account($set->accounts_receivable);
		$data['default_cash_payment_account']=(!$set)?'':account($set->default_cash_payment_account);
		$data['default_bank_account_number']=(!$set)?'':account($set->default_bank_account_number);

		$data['txtUangMukaBeli']=(!$set)?'':account($this->sysvar->getvar('COA Uang Muka Pembelian'));
		$data['txtUangMukaJual']=(!$set)?'':account($this->sysvar->getvar('COA Uang Muka Penjualan'));
		
		$data['ar_bunga']=(!$set)?'':account($this->sysvar->getvar('COA Piutang Bunga'));
		$data['sales_leasing']=(!$set)?'':account($this->sysvar->getvar('COA Pendapatan Leasing'));
		$data['sales_bunga']=(!$set)?'':account($this->sysvar->getvar('COA Pendapatan Bunga'));
		$data['sales_admin']=(!$set)?'':account($this->sysvar->getvar('COA Pendapatan Admin'));
		$data['sales_denda']=(!$set)?'':account($this->sysvar->getvar('COA Pendapatan Denda'));
		$data['sales_dp']=(!$set)?'':account($this->sysvar->getvar('COA Pendapatan DP'));
		$data['leasing_inventory']=(!$set)?'':account($this->sysvar->getvar('COA Persediaan Leasing'));
		return $data;
	}	
}
?>
