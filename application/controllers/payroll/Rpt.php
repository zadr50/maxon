<?php
class Rpt extends CI_Controller {
	function __construct()
	{
		parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
        $this->load->helper(array('url',"browse_select"));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
	}
    function index(){
        
    }
	function view($id){
		$data['date_from']=date('Y-m-d 00:00:00');
		$data['date_to']=date('Y-m-d 23:59:59');
		$data['select_date']=true;
         switch ($id) {
             case 'emp_list':
                 $data['select_date']=false;
                 $data['criteria1']=true;
                 $data['label1']='Department';
                 $data['text1']='';
                 $data['output1']="text1";
                 $data['key1']="dept_code";
                 $data['ctr1']='lookup/query/departments';
                 $data['fields1'][]=array("dept_name","180","Nama");
                 $data['fields1'][]=array("dept_code","80","Kode");
                 
                 $data['criteria2']=true;
                 $data['label2']='Division';
                 $data['text2']='';
                 $data['output2']="text2";
                 $data['key2']="div_code";
                 $data['ctr2']='lookup/query/divisions';                 
                 $data['fields2'][]=array("div_name","180","Nama");
                 $data['fields2'][]=array("div_code","180","Kode");
                 
                 break;
             case 'overtime':
             case 'absensi':
                 $data['criteria1']=true;
                 $data['label1']='Nomor Induk Pegawai';
                 $data['text1']='';
                 $data['output1']="text1";
                 $data['key1']="nip";
                 $data['ctr1']='lookup/query/employee';
                 $data['fields1'][]=array("nama","180","Nama");
                 $data['fields1'][]=array("nip","80","Kode");
                 
                 break;
             case 'print_slip_all':
             case 'slip_bank':
             case 'slip_list':
                 $data['select_date']=false;
                 
                 $data['criteria1']=true;
                 $data['label1']='Department';
                 $data['text1']='';
                 $data['output1']="text1";
                 $data['key1']="dept_code";
                 $data['ctr1']='lookup/query/departments';
                 $data['fields1'][]=array("dept_name","180","Nama");
                 $data['fields1'][]=array("dept_code","80","Kode");
                 
                 $data['criteria2']=true;
                 $data['label2']='Division';
                 $data['text2']='';
                 $data['output2']="text2";
                 $data['key2']="div_code";
                 $data['ctr2']='lookup/query/divisions';                 
                 $data['fields2'][]=array("div_name","180","Nama");
                 $data['fields2'][]=array("div_code","180","Kode");
                 
                 $data['criteria3']=true;
                 $data['label3']='Periode (YYYY-MM)';
                 $data['text3']=date("Y-m");
                 $data['output3']="text3";
                 $data['key3']="period";
                 $data['ctr3']='lookup/query/hr_period';                 
                 $data['fields3'][]=array("period","180","Periode");

                 $data['criteria4']=true;
                 $data['label4']='Kelompok';
                 $data['text4']='';
                 $data['output4']="text4";
                 $data['key4']="kode";
                 $data['ctr4']='lookup/query/emptype';                 
                 $data['fields4'][]=array("keterangan","180","Nama");
                 $data['fields4'][]=array("kode","180","Kode");
                 
                 
                 break;
             default:
                 break;
         }

         $data['rpt_controller']="payroll/rpt/view/$id";
         
        if(!$this->input->post('cmdPrint')){
            $this->template->display_form_input('criteria',$data,'');
        } else {
            $this->load->view("payroll/rpt/$id");
        }        
	
	}
	function action(){
		if(!$this->input->post('cmdPrint')){
			$this->load->view($this->rpt);
		}
	}
}
?>
