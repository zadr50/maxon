<?php

 if(!defined('BASEPATH')) exit('No direct script access allowd');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Posting extends CI_Controller {
                
    private $postcode="";
    private $posting_all=false;
	
	function __construct()
	{
		parent::__construct();        
        
		if(!$this->access->is_login())redirect(base_url());
        $this->load->helper(array('url','form','browse_select'));
        $this->load->library('sysvar');
        $this->load->library('javascript');
        $this->load->library('template');
		$this->load->library('form_validation');
        $this->load->model('crdb_model');
        $this->load->model('purchase_retur_model');
        $this->load->model('check_writer_model');
        $this->load->model('purchase_invoice_model');
        $this->load->model('invoice_model');
	}

    function index(){
        $this->browse();        
    }
    

    function sales_invoice($nomor="",$unposting=false){
        if($nomor!=""){
            if($unposting){
            $this->invoice_model->unposting($nomor);
                
            }  else {
            $this->invoice_model->posting($nomor);
                
            }
            
        } else {
            
        
             $data['date_from']=date('Y-m-d 00:00:00');
             $data['date_to']=date('Y-m-d 23:59:59');
             $data['rpt_controller']='posting/sales_invoice';
             $data['select_date']=true;
             $data['target_window']=false;
             $data['module']='posting';
             
             $postcode=$this->input->post('cmdPosting');
             
             if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
             if($postcode==""){
                $this->template->display_form_input('criteria',$data,'');
                 exit;
            } else {
                $date1=$this->input->post('txtDateFrom');
                $date2=$this->input->post('txtDateTo');
                if($this->posting_all)$this->invoice_model->show_finish_message=false;
                
                if($postcode=="Posting"){
                    $message=$this->invoice_model->posting_range_date($date1,$date2);
                } else {
                    $message=$this->invoice_model->un_posting_range_date($date1,$date2);                
                }
                $data['message']=$message;
                $this->template->display('',$data);
                
            }
        }
    }
    function sales_retur($nomor="",$unposting=false){
        if($nomor!=""){
            if($unposting){
            $this->invoice_model->unposting($nomor);     
                
            } else {
            $this->invoice_model->posting($nomor);     
                
            }
        } else {
             $data['date_from']=date('Y-m-d 00:00:00');
             $data['date_to']=date('Y-m-d 23:59:59');
             $data['rpt_controller']='posting/sales_retur';
             $data['select_date']=true;
             $data['target_window']=false;
             $data['module']='posting';
             $postcode=$this->input->post('cmdPosting');
             if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
            $date1=$this->input->post('txtDateFrom');
            $date2=$this->input->post('txtDateTo');
             
             if($postcode==""){
                $this->template->display_form_input('criteria',$data,'');
            } else {

                if($this->posting_all)$this->invoice_model->show_finish_message=false;
                
                if($postcode=="Posting"){
                    $message=$this->invoice_model->posting_retur_range_date($date1,$date2);
                } else {
                    $message=$this->invoice_model->un_posting_retur_range_date($date1,$date2);              
                }
                $data['message']=$message;
                $this->template->display('',$data);
            }
       }     
    }
    function sales_memo($nomor="",$unposting=false) {
        if($nomor!=""){
            if($unposting){
            $this->crdb_model->unposting($nomor);
                
            } else {
            $this->crdb_model->posting($nomor);
                
            }
        } else {
            $data['date_from']=date('Y-m-d 00:00:00');
            $data['date_to']=date('Y-m-d 23:59:59');
            $data['rpt_controller']='posting/sales_memo';
            $data['select_date']=true;
            $data['target_window']=false;
            $data['module']='posting';
            $postcode=$this->input->post('cmdPosting');
            if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
            if($postcode==""){
                $this->template->display_form_input('criteria',$data,'');
            } else {

                $date1=$this->input->post('txtDateFrom');
                $date2=$this->input->post('txtDateTo');
                
                if($this->posting_all)$this->crdb_model->show_finish_message=false;
                
                if($postcode=="Posting"){
                    $message=$this->crdb_model->posting_range_date($date1,$date2);
                } else {
                    $message=$this->crdb_model->unposting_range_date($date1,$date2);                
                }
                $data['message']=$message;
                $this->template->display('',$data);
            }
        }
    }
    function purchase_invoice($invoice_number="",$unposting=false) {
        if($invoice_number!=""){
            if($unposting){
                $this->purchase_invoice_model->unposting($invoice_number);
            } else {
                $this->purchase_invoice_model->posting($invoice_number);
            }
        } else {            
            $data['date_from']=date('Y-m-d 00:00:00');
            $data['date_to']=date('Y-m-d 23:59:59');
            $data['rpt_controller']='posting/purchase_invoice';
            $data['select_date']=true;
            $data['target_window']=false;
            $data['module']='posting';
            $postcode=$this->input->post('cmdPosting');
            if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
            if($postcode==""){
                $this->template->display_form_input('criteria',$data,'');
            } else {
                $date1=$this->input->post('txtDateFrom');
                $date2=$this->input->post('txtDateTo');
            
                if($this->posting_all)$this->purchase_invoice_model->show_finish_message=false;
                
                if($postcode=="Posting"){
                    $message=$this->purchase_invoice_model->posting_range_date($date1,$date2);
                } else {
                    $message=$this->purchase_invoice_model->unposting_range_date($date1,$date2);                
                }
                $data['message']=$message;
                $this->template->display('',$data);
            }       

        }

    }
    function purchase_retur($nomor="",$unposting=false) {
        if($nomor!=""){
            if($unposting){
            $this->purchase_retur_model->unposting($nomor);
                
            }  else {
            $this->purchase_retur_model->posting($nomor);
                
            }
        } else {
            
            $data['date_from']=date('Y-m-d 00:00:00');
            $data['date_to']=date('Y-m-d 23:59:59');
            $data['rpt_controller']='posting/purchase_retur';
            $data['select_date']=true;
            $data['target_window']=false;
            $data['module']='posting';
            $postcode=$this->input->post('cmdPosting');
            if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
            if($postcode==""){
                $this->template->display_form_input('criteria',$data,'');
            } else {
                $date1=$this->input->post('txtDateFrom');
                $date2=$this->input->post('txtDateTo');
                
                if($this->posting_all)$this->purchase_retur_model->show_finish_message=false;
                
                
                if($postcode=="Posting"){
                    $message=$this->purchase_retur_model->posting_range_date($date1,$date2);
                } else {
                    $message=$this->purchase_retur_model->unposting_range_date($date1,$date2);              
                }
                $data['message']=$message;
                $this->template->display('',$data);
            }

        }

    }
    function purchase_memo($nomor="",$unposting=false) {
        if($nomor!=""){
            if($unposting){
                $this->crdb_model->unposting($nomor);     
                
            } else {
                $this->crdb_model->posting($nomor);     
                
            }
        } else {
            
            $data['date_from']=date('Y-m-d 00:00:00');
            $data['date_to']=date('Y-m-d 23:59:59');
            $data['rpt_controller']='posting/purchase_memo';
            $data['select_date']=true;
            $data['target_window']=false;
            $data['module']='posting';
            $postcode=$this->input->post('cmdPosting');
            if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
            if($postcode==""){
                $this->template->display_form_input('criteria',$data,'');
            } else {
                $date1=$this->input->post('txtDateFrom');
                $date2=$this->input->post('txtDateTo');
    
                if($this->posting_all)$this->crdb_model->show_finish_message=false;
    
                if($postcode=="Posting"){
                    $message=$this->crdb_model->posting_range_date($date1,$date2,1);
                } else {
                    $message=$this->crdb_model->unposting_range_date($date1,$date2,1);              
                }
                $data['message']=$message;
                $this->template->display('',$data);
            }
       }
    }
    function cash($voucher="",$unposting=false) {
        if($voucher!=""){
            if($unposting){
                $this->check_writer_model->unposting($voucher);
                
            } else {
                $this->check_writer_model->posting($voucher);
                
            }
        } else {
            $data['date_from']=date('Y-m-d 00:00:00');
            $data['date_to']=date('Y-m-d 23:59:59');
            $data['rpt_controller']='posting/cash';
            $data['select_date']=true;
            $data['target_window']=false;
            $data['module']='posting';
            $postcode=$this->input->post('cmdPosting');
            if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
            if($postcode==""){
                $this->template->display_form_input('criteria',$data,'');
            } else {
                $date1=$this->input->post('txtDateFrom');
                $date2=$this->input->post('txtDateTo');
            
                
                if($this->posting_all)$this->check_writer_model->show_finish_message=false;
                
                if($postcode=="Posting"){
                    $message=$this->check_writer_model->posting_range_date($date1,$date2);
                } else {
                    $message=$this->check_writer_model->unposting_range_date($date1,$date2);                
                }
                $data['message']=$message;
                $this->template->display('',$data);
            }
        }
    }
    function browse($offset=0,$limit=10,$order_column='shipment_id',$order_type='asc'){
        $data['caption']='DAFTAR TRANSAKSI ';
        $data['controller']='posting';     
        
        $data['fields_caption']=array('Nomor Bukti','Tanggal','Jenis','Posted','Amount','Comments');
        $data['fields']=array('nomor_bukti', 'tanggal','jenis','posted','amount','comments');
					
		if(!$data=set_show_columns($data['controller'],$data)) return false;
			
        
        $data['field_key']='nomor_bukti';
        $this->load->library('search_criteria');
        
        $faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
        $faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
        $faa[]=criteria("Nomor","sid_nomor");
        $faa[]=criteria("Posted","sid_posted");
        $data['criteria']=$faa;
        $data['posting_visible']=true;
        $data['unposting_visible']=true;
        $this->template->display_browse2($data); 
        
    }
    function posting_all(){
        $date1=$this->input->get("sid_date_from");
        $date2=$this->input->get("sid_date_to");
        $sql="select * from q_all_trans ";
        $d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
        $d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $sql.=" where tanggal between '$d1' and '$d2'";
        $sql.=" and (posted='0' or posted is null) ";
        $sql.=" order by tanggal";
        
        //echo "<br>SQL: $sql";
        
        if($q=$this->db->query($sql)){
            foreach($q->result() as $glid){
                $jenis=$glid->jenis;
                $nomor=$glid->nomor_bukti;
                echo "<br>Posting [$nomor] - $jenis...please wait";
                if($jenis=="kas masuk" || $jenis=="kas keluar"){
                    $this->cash($nomor);
                } else if ($jenis=="faktur penjualan kontan" || $jenis=="faktur penjualan kredit"){
                    $this->sales_invoice($nomor);
                } else if ($jenis=="faktur pembelian kredit"){
                    $this->purchase_invoice($nomor);
                } else if ($jenis=="retur pembelian"){
                    $this->purchase_retur($nomor);            
                } else if ($jenis=="faktur beli konsinyasi"){
                    $this->purchase_invoice($nomor);          
                } else if ($jenis=="debit credit memo pembelian"){
                    $this->purchase_memo($nomor);            
                } else if ($jenis=="faktur pembelian non po"){
                    $this->purchase_invoice($nomor);            
                } else if ($jenis=="retur penjualan"){
                    $this->sales_retur($nomor);            
                } else if ($jenis=="faktur jual konsinyasi"){
                    $this->sales_invoice($nomor);           
                } else if ($jenis=="debit credit memo pembelian"){
                    $this->sales_memo($nomor);            
                } else if ($jenis=="debit credit memo penjualan"){
                    $this->sales_memo($nomor);            
                } else if ($jenis=="assembly disassembly"){
                                
                } else if ($jenis=="stock adjustment"){
                              
                } else if ($jenis=="bank transfer"){
                                
                } else if ($jenis=="barang keluar lainnya"){
                                
                                
                } else {
                    msgbox("Jenis transaksi belum bisa di Posting
                     <strong>[$jenis]</strong> untuk nomor bukti 
                     <strong>[$nomor]</strong>","Informasi");
                }
                
            }
        }
        echo "<p>Finish</p>";  
        
    }
    function all(){
        $data['date_from']=date('Y-m-d 00:00:00');
        $data['date_to']=date('Y-m-d 23:59:59');
        $data['rpt_controller']='posting/all';
        $data['select_date']=true;
        $data['target_window']=false;
        $data['module']='posting';
        
        $postcode=$this->input->post('cmdPosting');
        if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
        if($postcode==""){
            $this->template->display_form_input('criteria',$data,'');
        } else {
            
            $date1=$this->input->post('txtDateFrom');
            $date2=$this->input->post('txtDateTo');
        
            $postcode=$this->input->post("cmdPosting");
            if($postcode=="")$postcode=$this->input->post('cmdUnPosting');
            
            if($postcode=="Posting"){
                $this->load_trans($date1,$date2);
            } else {
                
                $this->posting_all=true;    
                $this->postcode=$postcode=="Posting"?true:false;
                $this->purchase_invoice();
                $this->sales_invoice();
                $this->purchase_memo();
                $this->purchase_retur();
                $this->sales_memo();
                $this->posting_all=false;    
                $this->sales_retur();
                $message="Finish";
                $data['message']=$message;
                $this->template->display('',$data);
            
            }
            
        } 
    }
    function browse_data($offset=0,$limit=10,$nama=''){
        $sql="select * from q_all_trans ";
        
        $no=$this->input->get('sid_nomor');
        $posted=$this->input->get("sid_posted");
        $d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
        $d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $sql.=" where tanggal between '$d1' and '$d2'";
        if($posted=="")$posted=0;
        $sql.=" and posted='$posted'";
        
        $sql.=" order by tanggal";
                
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
        echo datasource($sql);
    }
    function view($id){
        $id=urldecode($id);
        $jenis="";
        if($q=$this->db->query("select * from q_all_trans where nomor_bukti='$id'")){
            if($r=$q->row()){
                $jenis=$r->jenis;
            }
        }
        if($jenis=="kas masuk"){
            $jenis2=$this->db->query("select trans_type from check_writer where voucher='$id'")->row()->trans_type;
            redirect(base_url("cash_in/view/$id"));
        } else if ($jenis=="kas keluar"){
            $jenis2=$this->db->query("select trans_type from check_writer where voucher='$id'")->row()->trans_type;
            redirect(base_url("cash_out/view/$id"));
        } else if ($jenis=="faktur penjualan kontan" || $jenis=="faktur penjualan kredit"){
                redirect(base_url("invoice/view/$id"));
        } else if ($jenis=="faktur pembelian kredit"){
            redirect(base_url("purchase_invoice/view/$id"));
        } else if ($jenis=="retur pembelian"){
            redirect(base_url("purchase_retur/view/$id"));            
        } else if ($jenis=="faktur beli konsinyasi"){
            redirect(base_url("purchase_invoice/view/$id"));            
        } else if ($jenis=="debit credit memo pembelian"){
            redirect(base_url("purchase_dbmemo/view/$id"));            
        } else if ($jenis=="faktur pembelian non po"){
            redirect(base_url("payable/view/$id"));            
        } else if ($jenis=="retur penjualan"){
            redirect(base_url("sales_retur/view/$id"));            
        } else if ($jenis=="faktur jual konsinyasi"){
            redirect(base_url("invoice/view/$id"));            
        } else if ($jenis=="debit credit memo penjualan"){
            redirect(base_url("sales_crmemo/view/$id"));            
        } else if ($jenis=="assembly disassembly"){
            redirect(base_url("sales_assembly/view/$id"));            
        } else if ($jenis=="stock adjustment"){
            redirect(base_url("stock_adjust/view/$id"));            
        } else if ($jenis=="bank transfer"){
            redirect(base_url("cash_mutasi/view/$id"));            
        } else if ($jenis=="barang keluar lainnya"){
            redirect(base_url("delivery/view/$id"));            
                        
        } else {
            msgbox("Jenis transaksi belum bisa di lihat <strong>[$jenis]</strong> untuk nomor bukti <strong>[$id]</strong>","Informasi");
        }
    }    
    function unposting_all(){
        $date1=$this->input->get("sid_date_from");
        $date2=$this->input->get("sid_date_to");
        $sql="select * from q_all_trans ";
        $d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
        $d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $sql.=" where tanggal between '$d1' and '$d2'";
        $sql.=" and (posted='1') ";
        $sql.=" order by tanggal";
        
        //echo "<br>SQL: $sql";
        
        if($q=$this->db->query($sql)){
            foreach($q->result() as $glid){
                $jenis=$glid->jenis;
                $nomor=$glid->nomor_bukti;
                echo "<br>UnPosting [$nomor] - $jenis...please wait";
                if($jenis=="kas masuk" || $jenis=="kas keluar"){
                    $this->cash($nomor,true);
                } else if ($jenis=="faktur penjualan kontan" || $jenis=="faktur penjualan kredit"){
                    $this->sales_invoice($nomor,true);
                } else if ($jenis=="faktur pembelian kredit"){
                    $this->purchase_invoice($nomor,true);
                } else if ($jenis=="retur pembelian"){
                    $this->purchase_retur($nomor,true);            
                } else if ($jenis=="faktur beli konsinyasi"){
                    $this->purchase_invoice($nomor,true);          
                } else if ($jenis=="debit credit memo pembelian"){
                    $this->purchase_memo($nomor,true);            
                } else if ($jenis=="faktur pembelian non po"){
                    $this->purchase_invoice($nomor,true);            
                } else if ($jenis=="retur penjualan"){
                    $this->sales_retur($nomor,true);            
                } else if ($jenis=="faktur jual konsinyasi"){
                    $this->sales_invoice($nomor,true);           
                } else if ($jenis=="debit credit memo pembelian"){
                    $this->sales_memo($nomor,true);            
                } else if ($jenis=="debit credit memo penjualan"){
                    $this->sales_memo($nomor,true);            
                } else if ($jenis=="assembly disassembly"){
                                
                } else if ($jenis=="stock adjustment"){
                              
                } else if ($jenis=="bank transfer"){
                                
                } else if ($jenis=="barang keluar lainnya"){
                                
                                
                } else {
                    msgbox("Jenis transaksi belum bisa di UnPosting
                     <strong>[$jenis]</strong> untuk nomor bukti 
                     <strong>[$nomor]</strong>","Informasi");
                }
                
            }
        }
        echo "<p>Finish</p>";  
        
    }

}

?>