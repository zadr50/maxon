<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Picking extends CI_Controller {

private $limit=10;

	function __construct()
	{
		parent::__construct();        
         
		$data['message']='';
		$this->template->display_form_input('picking',$data,'picking_left_menu');
	}
	 
	function next_step_2(){
		$data['message']='';
		$max=$this->input->post('row_count');
		for($i=1;$i<=$max;$i++){
			$wo=$this->input->post('id_'.$i);
			if($wo<>''){
				$s="update workorder set picking=1	where wo_number='".$wo."'";
				$query=$this->db->query($s);
				$data['message']=$data['message'].'<br/>Process: '.$wo;
			} 
			
		}
		 $data['message']=$data['message'].'<H2>Success</h2>
		 Nomor-nomor workorder sudah di picking untuk dipersiapkan ke proses selanjutnya
		 <br/>yaitu pengecekan quantity dan persiapan untuk di packing dan dikirim
		 
		 ';
		 
		$this->template->display('finish',$data);
	}
	 
}
