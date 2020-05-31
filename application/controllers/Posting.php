<?php

 if(!defined('BASEPATH')) exit('No direct script access allowd');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Posting extends CI_Controller {
                
    private $postcode="";
    private $posting_all=false;
	private $message="";
	function message_text(){
		return $this->message;
	}
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
		$this->load->model('inventory_products_model');
		
	}

    function index(){
//        $this->browse();        
		$data['caption']='Posting all transactions';
		$this->template->display("gl/posting",$data);
    }
    function load_data(){
		$from_date=$this->input->get("d1");
		$to_date=$this->input->get("d2");
		$jenis=$this->input->get("q");
		$unposted=$this->input->get("unposted");
		$s="select * from q_all_trans where tanggal between '$from_date' and '$to_date' ";
		if($unposted){
			$s.=" and (posted=false or posted is null)";
		} else {
			$s.=" and posted=true";
		}
		if($jenis!=""){
			$s.=" and jenis='$jenis' ";
		}
		$s.=" order by tanggal ";
		//echo $s;
		
		echo datasource($s);
    }
	function sales_invoice_filter(){
		$data["caption"]="Posting Penjualan";
		$data["proses"]="invoice";
		$this->template->display("gl/posting",$data);
	}
    function sales_invoice($nomor="",$unposting=false){
        if($nomor!=""){
            if($unposting){
            $this->invoice_model->unposting($nomor);
                
            }  else {
            $this->invoice_model->posting($nomor,false);
                
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
	function posting_all2(){
		$success=false;
		$data=$this->input->post();
		if(isset($data['row'])){
			$row=$data['row'];
			$nomor=$row['nomor_bukti'];
			$jenis=$row['jenis'];
			$posted=$row['posted'];
			$this->posting_process($nomor, $jenis);
			$success=true;
			echo json_encode(array("success"=>$success,"message"=>$this->message));
		} else {
			$rows=$data['rows'];
			for($i=0;$i<count($rows);$i++){
				$row=$rows[$i];
				$nomor=$row['nomor_bukti'];
				$jenis=$row['jenis'];
				$posted=$row['posted'];
				$this->posting_process($nomor, $jenis);
			}
			$success=true;
			echo json_encode(array("success"=>$success,"message"=>$this->message));			
		}
		
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
				$this->posting_process($nomor,$jenis);
            }
        }
        echo "<br>$this->message <p>Finish</p>";  
        
    }
	function posting_process($nomor,$jenis){
            $this->message.= "<br>Posting [$nomor] - $jenis...please wait";
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
                $this->inventory_products_model->posting($nomor);				            
            } else if ($jenis=="barang masuk lainnya"){
                $this->inventory_products_model->posting($nomor);				            
            	
            	                
            } else {
                $this->message.="<br>Jenis transaksi belum bisa di Posting
                 <strong>[$jenis]</strong> untuk nomor bukti 
                 <strong>[$nomor]</strong>";
            }
                		
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
	function unposting_all2(){
		$success=false;
		$data=$this->input->post();
		if(isset($data['row'])){
			$row=$data['row'];
			$nomor=$row['nomor_bukti'];
			$jenis=$row['jenis'];
			$posted=$row['posted'];
			$this->unposting_process($nomor, $jenis);
			$success=true;
			echo json_encode(array("success"=>$success,"message"=>$this->message));
		} else {
			$rows=$data['rows'];
			for($i=0;$i<count($rows);$i++){
				$row=$rows[$i];
				$nomor=$row['nomor_bukti'];
				$jenis=$row['jenis'];
				$posted=$row['posted'];
				$this->unposting_process($nomor, $jenis);
			}
			$success=true;
			echo json_encode(array("success"=>$success,"message"=>$this->message));			
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
				$this->unposting_process($nomor,$jenis);

            }
        }
        echo "<p>Finish</p>";  
        
    }
	function unposting_process($nomor,$jenis){
                $this->message .= "<br>UnPosting [$nomor] - $jenis...please wait";
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
                    $this->inventory_products_model->unposting($nomor);            
                } else if ($jenis=="barang masuk lainnya"){
                    $this->inventory_products_model->unposting($nomor);            
                                
                } else {
                    $this->message.="Jenis transaksi belum bisa di UnPosting
                     <strong>[$jenis]</strong> untuk nomor bukti 
                     <strong>[$nomor]</strong>";
                }
                		
	}
 	function autopost(){
        $sql="select * from q_all_trans where (posted='0' or posted is null)  
        	and nomor_bukti not in (select gl_id from zzz_jurnal_error) limit 1";
		if($q=$this->db->query($sql)){
			if($r=$q->row()){
				$hari=round((strtotime(date("Y-m-d"))-strtotime($r->tanggal))/3600/24);
				
				if($hari>1){
					$this->message="AutoPost: $r->nomor_bukti";
					$this->posting_process($r->nomor_bukti, $r->jenis);
					echo json_encode(array("success"=>true,"message"=>$this->message));
										
				}
			}
		}
		$this->posting_sales_ticket();
 		
 	}
	function posting_sales_ticket(){
		$this->load->model("ticketing/sales_model");
		$this->sales_model->posting();
	}


}

?>