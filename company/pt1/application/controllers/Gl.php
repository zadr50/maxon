<?php
 if(!defined('BASEPATH')) exit('No direct script access allowd');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Gl extends CI_Controller {
                

	function __construct()
	{
		parent::__construct();        
        $multi_company=$this->config->item('multi_company');
       if($multi_company){
            $company_code=$this->session->userdata("company_code","");
            if($company_code!=""){
               $this->db = $this->load->database($company_code, TRUE);
           }
       }         
        
        
		if(!$this->access->is_login())redirect(base_url());
        $this->load->helper(array('url','form','browse_select'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('syslog_model');
	}
    function index(){	
	}
    function rpt($id){
    	 switch ($id) {
			 case 'cards':
				 $data['date_from']=date('Y-m-d 00:00:00');
				 $data['date_to']=date('Y-m-d 23:59:59');
				 $data['select_date']=true;
				 $data['criteria1']=true;
				 $data['label1']='Dari Kode Perkiraan';
				 $data['text1']='';
				 $data['criteria2']=true;
				 $data['label2']='Sampai Kode Perkiraan';
				 $data['text2']='';
				 break;
			 case 'jurnal' or 'neraca_saldo':
				 $data['date_from']=date('Y-m-d 00:00:00');
				 $data['date_to']=date('Y-m-d 23:59:59');
				 $data['select_date']=true;
				 break;
			 case "jurnal_not_balance":
				$data["select_date"]=false;
				$data['criteria1']=false;
				break;
			 default:
				 
				 break;
		 }
		 $rpt='gl/rpt/'.$id;
		 $data['rpt_controller']=$rpt;
		 
		if(!$this->input->post('cmdPrint')){
			$this->template->display_form_input('criteria',$data,'');
		} else {
			$this->load->view($rpt);
		}
   }
	function grafik_saldo_akun(){
		header('Content-type: application/json');
		//$data['label']="SALDO AKUN";
		$data['data']=$this->saldo_akun();
		echo json_encode($data);
	}
	function grafik_saldo_akun_old(){
		$phpgraph = $this->load->library('PhpGraph');		
		$cfg['width'] = '80%';
		$cfg['height'] = 200;
		$cfg['compare'] = false;
		$cfg['disable-values']=1;
		$chart_type='vertical-line-graph';
		$data=$this->saldo_akun();
		//var_dump($data);
		$file="tmp/".$chart_type.".png";
		$this->phpgraph->create_graph($cfg, $data,$chart_type,'Saldo Perkiraan',$file);
		echo '<img src="'.base_url().'/'.$file.'"/>';
		echo '';
	}
	function saldo_akun()
	{
       $sql="select account,account_description,sum(g.debit)-sum(g.credit) as saldo 
        from gl_transactions g left join chart_of_accounts c on c.id=g.account_id 
        group by account,account_description
		having sum(g.debit)-sum(g.credit)>0  limit 10"; 
		$query=$this->db->query($sql);
		foreach($query->result() as $row){
			$data[]=array(substr($row->account,0,10),$row->saldo);
		}
		return $data;
	}
	function neraca_saldo(){
		 $rpt='gl/rpt/neraca_saldo';
		 $data['rpt_controller']=$rpt;
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
 		 $this->load->view($rpt,$data);
	}
	function reports(){
		$this->template->display('gl/menu_reports');
	}
 	
}
?>
