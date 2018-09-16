<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
function __construct()
{
	 parent::__construct();        
      
	 $this->load->helper(array('url','form','mylib_helper'));

	 $this->load->library('template');
	}

	function index()
	{
		$this->session->set_userdata('use_iframe',true);
		$this->template->display('welcome_message');
		$this->session->unset_userdata('use_iframe');
	}
	function add_my_company() {
		$userfile=$this->input->post('userfile');

		$config['upload_path'] = './images/clients/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' =>'Error upload !! Maximum size gambar 100kb');
		    echo json_encode($error);
		}
		else
		{
			$data = array('success'=>'Sukses','upload_data' => $this->upload->data());
			$content = $this->input->post('add_me_title')."\n".$this->input->post('add_me_note');

			// write to file info
			$userfile=$data['upload_data']['file_name'];
			$fp = fopen("images/clients/$userfile.txt","wb");
			fwrite($fp,$content);
			fclose($fp);

			echo json_encode($data);
		}		
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */