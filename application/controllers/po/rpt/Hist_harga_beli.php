<?php
class Hist_harga_beli extends CI_Controller {
    
	private	$rpt='po/rpt/hist_harga_beli/action';
    
	function __construct()
	{
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());        
         
        
        $this->load->helper(array('url'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->helper("browse_select");

	}
	function index(){
		 $data['date_from']=date('Y-m-d 00:00:00');
		 $data['date_to']=date('Y-m-d 23:59:59');
		 $data['select_date']=true;
         
         $data['criteria1']=true;
         $data['label1']='Kode Category';
         $data['text1']='';
         $data['output1']="text1";
         $data['key1']="kode";
         $data['fields1'][]=array("kode","180","Kode");
         $data['fields1'][]=array("category","180","Kategori");
         $data['ctr1']='category/select';
         
         $data['criteria2']=true;
         $data['label2']='Kode Barang';
         $data['text2']='';
         $data['output2']="text2";
         $data['key2']="item_number";
         $data['fields2'][]=array("item_number","180","Kode");
         $data['fields2'][]=array("description","180","Nama Barang");
         $data['ctr2']='inventory/select';
         
		$data['rpt_controller']=$this->rpt;
		$this->template->display_form_input('criteria',$data,'');	
	
	}
	function action(){
        $data['caption']='HISTORY HARGA BELI';
        
		if($this->input->post('cmdPrint')){
            $date1= date('Y-m-d H:i:s', strtotime($this->input->post('txtDateFrom')));
            $date2= date('Y-m-d H:i:s', strtotime($this->input->post('txtDateTo')));
		    $potype=getvar("PoType","O");
            $sql="select po.po_date,po.supplier_number,s.supplier_name,
                pod.item_number,pod.description,i.category,
                pod.quantity,pod.price,pod.total_price
                from purchase_order_lineitems pod 
                left join purchase_order po on po.purchase_order_number=pod.purchase_order_number 
                left join inventory i on i.item_number=pod.item_number 
                left join suppliers s on s.supplier_number=po.supplier_number
                where po.potype='$potype' ";
            $sql.=" and po.po_date between  '$date1' and '$date2'";
                
                
            if($this->input->post("text1")){
                $sql.=" and i.category='".$this->input->post('text1')."'";
            }
            if($this->input->post("text2")){
                $sql.=" and pod.item_number='".$this->input->post('text2')."'";
            }
                        
            
            $data['content']=browse_select(
            array('sql'=>$sql,'show_action'=>false,
                'group_by'=>array('item_number'),
                "group_section_fields"=>array("item_number"=>array("description")),
                "hidden"=>array("item_number","description"),
                "order_column"=>"po_date"
               )
            );
             $data['header']=company_header();
            $this->load->view('simple_print',$data);            
		}
        
	}
}
?>
