<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Periode extends CI_Controller {
    private $limit=10;
    private $table_name='financial_periods';
    private $sql="select year_id,sequence,period,startdate,enddate,closed,month_name 
        from financial_periods";
    private $file_view='gl/periode';
	private $_error="";

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
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('periode_model');
		$this->load->model('syslog_model');
	}
	function set_defaults($record=NULL){
        $data=data_table($this->table_name,$record); 
        $data['mode']='';
        $data['message']='';
        return $data;
	}
	function index()
	{	
		if (!allow_mod2('_30030'))  exit;
        $this->browse();
	}
	function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
	}
	function add()
	{
		if (!allow_mod2('_30031'))  exit;
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['closed']=$data['closed']=='No'?'0':'1';
			$id=$this->periode_model->save($data);
            $data['message']='update success';
            $data['mode']='view';
			$this->syslog_model->add($id,"periode","edit");

            $this->browse();
		} else {
			$data['mode']='add';
            $this->template->display_form_input($this->file_view,$data,'');
		}
	}
	function update()
	{
	 	 $data=$this->set_defaults();
 		 $this->_set_rules();
 		 $id=$this->input->post('period');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['closed']=$data['closed']=='No'?'0':'1';
            unset($data['id']);
			$this->periode_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"periode","edit");

            $this->browse();
		} else {
			$message='Error Update';
     		$this->view($id,$message);		
		}	  	
	}
	
	function view($id,$message=null){           
		if (!allow_mod2('_30030'))  exit;
		$id=urldecode($id);
		 $data['period']=$id;
		 $model=$this->periode_model->get_by_id($id)->row();
		 $data=$this->set_defaults($model);
		 $data['mode']='view';
         $data['message']=$message;
         $this->template->display_form_input($this->file_view,$data,'');
	}
	 // validation rules
	function _set_rules(){	
		 $this->form_validation->set_rules('year_id','Tahun', 'required|trim');
		 $this->form_validation->set_rules('period','Periode Id', 'required|trim');
	}
	
	 // date_validation callback
	function valid_date($str)
	{
	 if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
	 {
		 $this->form_validation->set_message('valid_date',
		 'date format is not valid. yyyy-mm-dd');
		 return false;
	 } else {
	 	return true;
	 }
	}
    function browse($offset=0,$limit=50,$order_column='sales_order_number',$order_type='asc'){
		$data['controller']='periode';
		$data['fields_caption']=array('Tahun','Urut','Periode','Month','Start','End','Closed');
		$data['fields']=array('year_id','sequence','period','month_name','startdate','enddate','closed');
		$data['field_key']='period';
		$data['caption']='DAFTAR PERIODE AKUNTANSI';
		$data['criteria']=array();
		$button2[]=array('title'=>'Closing','controller'=>'periode_closing','icon'=>'save',
			'function'=>
			'<script>
				function periode_closing(){
					var row = $("#dg_periode").datagrid("getSelected");
					if (row){
						xurl=CI_ROOT+CI_CONTROL+"/closing/"+row[FIELD_KEY];
						window.open(xurl,"_self");		
					}
				}
			</script>
			');
		$button2[]=array('title'=>'Unclosing','controller'=>'periode_unclosing','icon'=>'save',
			'function'=>
			'<script>
				function periode_unclosing(){
					var row = $("#dg_periode").datagrid("getSelected");
					if (row){
						xurl=CI_ROOT+CI_CONTROL+"/unclosing/"+row[FIELD_KEY];
						window.open(xurl,"_self");		
					}
				}
			</script>
			');
		$data['other_button']=$button2;
        $this->template->display_browse($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		$sql=$this->sql." order by year_id,sequence";
        echo datasource($sql);
    }	      
	function delete($id){
		if (!allow_mod2('_30030'))  exit;
		$id=urldecode($id);
	 	$this->periode_model->delete($id);
		$this->syslog_model->add($id,"periode","delete");

	 	$this->browse();
	}
	function select($periode="") {
		$periode=urldecode($periode);
		$sql="select * from financial_periods";
		if($periode!="")$sql.=" where period like '$periode%'";
		
		echo datasource($sql);
	}
	function unclosing($period){
		echo "Unclosing Periode : $period";	
        $dperiod['closed']=0;
        $this->periode_model->update($period,$dperiod);
		$this->index();
	}
	function closing($period){
		if (!allow_mod2('_30050'))  exit;
		$periode=urldecode($period);
		if(!$p=$this->periode_model->get_by_id($period)){
			$this->_error.="<br>Periode not found ! [".$periode."]";
			return false;
		} 
		if(!$prd=$p->row()){
			$this->_error.="<br>Periode not found ! [".$periode."]";
			return false;
		}
		$s="select * from chart_of_accounts order by account"; 
		$content="";
		
		if($q=$this->db->query($s)){
			foreach($q->result() as $rowAcc){
				$s="select sum(credit) as z_cr,sum(debit) as z_db
				from gl_transactions g 
				where date>='".$prd->startdate."' 
					and date<='".$prd->enddate."' 
					and g.account_id=".$rowAcc->id." 
				";
				
				$awal=0;	$db=0; 	$cr=0;	$akhir=0;
				if($qTran=$this->db->query($s)->row()){
					$cr=$qTran->z_cr;
					$db=$qTran->z_db;
				}
				$s="select count(1) as cnt from gl_beginning_balance_archive 
				where account_id=".$rowAcc->id." 
				and year='".$prd->enddate."'";
				if($qArc0=$this->db->query($s)){
					if($qArc=$qArc0->row()){
						$akhir=$awal+$db-$cr;
						$data["account_id"]=$rowAcc->id;
						$data["company_code"]=$rowAcc->company_code;
						$data["year"]=$prd->enddate;
						$data["beginning_balance"]=$awal;
						$data["debit_base"]=$db;
						$data["credit_base"]=$cr;
						$data["ending_balance"]=$akhir;
						if($qArc->cnt==0){
							if(!$this->db->insert("gl_beginning_balance_archive",$data)){
								$this->_error.="<br>ERR: unable insert data ".$rowAcc->account;
							}
						} else {
							//if($rowAcc->account=="40005")var_dump($data);
							if(!$this->db->update("gl_beginning_balance_archive",$data,
								"account_id='".$rowAcc->id."' and year='".($prd->enddate)."'")){
								$this->_error.="<br>ERR: unable update data ".$rowAcc->account;
							}
						}
					}
				}  
				$content.="<br>Account: ".$rowAcc->account." - ".$rowAcc->account_description.", 
				awal=".$awal.", debit=".$db.", credit=".$cr.", akhir=".$akhir;
				
			}
		}
		$message=$this->_error;
        $dperiod['closed']=1;
        $this->periode_model->update($period,$dperiod);
//		$this->load->view("blank",array("message"=>$message,"content"=>$content));
		$this->index();
	}

	function saldo_awal($periode){
		$periode=urldecode($periode);
		
		if(!$p=$this->periode_model->get_by_id($periode)){
			$this->_error.="<br>Periode not found ! [".$periode."]";
			return false;
		} 
		if(!$prd=$p->row()){
			$this->_error.="<br>Periode not found ! [".$periode."]";
			return false;
		}
		$sql="select account,account_description,g.beginning_balance,
	    g.debit_base,g.credit_base,g.ending_balance,g.company_code 
        from gl_beginning_balance_archive g 
		left join chart_of_accounts c on c.id=g.account_id
		where year='".($prd->enddate)."' 
		and (ending_balance<>0)
        group by account,account_description"; 
        echo datasource($sql);		
	}	
}
