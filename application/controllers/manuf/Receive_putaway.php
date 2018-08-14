<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Receive_putaway extends CI_Controller {

private $limit=10;

	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form'));
                 
		$this->load->library('template');
		$this->load->library('form_validation');
	 
	}
	function index()
	{	
		$data['message']='';
		$this->template->display_form_input('receive_putaway',$data,'receive_putaway_left_menu');
	}
	 
	function next_step_2(){
		$this->template->display_form_input('receive_putaway_location');
	}
	function next_step_3(){
		//$this->template->display_form_input('receive_putaway_location');
		$max=$this->input->post('loc_max');
		for($i=1;$i<=$max;$i++){
			$id=$this->input->post('id_'.$i);
			$loc=$this->input->post('loc_'.$i);
			$bin=$this->input->post('bin_'.$i);
			if($loc<>''){
				$s="update inventory_products set location='".$loc."',bin='".$bin."'
				where id=".$id;
				//echo "<br>".$s;
				$query=$this->db->query($s);
				
			} 
			
		}
		 $data['message']='<H2>Success</H2>
		 Barang yang diterima sudah ditempatkan dalam lokasi yang seharusnya berdasarkan 
		 lokasi dan nomor rak di gudang.
		 ';
		 
		 $this->template->display('finish',$data);
	}
	 
}
