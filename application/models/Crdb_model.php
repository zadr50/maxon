<?php
class CrDb_model extends CI_Model {

private $primary_key='kodecrdb';
private $table_name='crdb_memo';
public $show_finish_message=true;

	function __construct(){
		parent::__construct();     
		$this->load->model('company_model');
		$this->load->model("periode_model");
		$this->load->model('chart_of_accounts_model');
		$this->load->model('customer_model');
		$this->load->model('supplier_model');
		$this->load->model('purchase_order_model');
		$this->load->model('invoice_model');
		$this->load->model('jurnal_model');
	}
    function amount_sum($faktur_ref,$transtype='PO-DEBIT MEMO'){
        $sql="select sum(amount) as z_amount 
            from crdb_memo i
            where docnumber='$faktur_ref' and transtype='$transtype'";
        $retval=0;
        if($q=$this->db->query($sql)){
            if($r=$q->row()){
                $retval=c_($r->z_amount);
            }
        }
        return $retval;
    }
    
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function save($data){
		if(isset($data['tanggal']))$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));
        $data['amount']=c_($data['amount']);
		$ok=$this->db->insert($this->table_name,$data);
//		$id=$this->db->insert_id();
		$faktur=$data['docnumber'];		
		$this->invoice_model->recalc($faktur);
		
        if(isset($data['cust_supp'])){
        	customer_need_update($data['cust_supp']);
			supplier_need_update($data['cust_supp']);
        }
		
		return $ok;
	}
	function update($id,$data){
		if(isset($data['tanggal']))$data['tanggal']= date('Y-m-d H:i:s', strtotime($data['tanggal']));
		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		
		if(isset($data['docnumber'])){
			$faktur=$data['docnumber'];						
			$this->invoice_model->recalc($faktur);
		}
		
        if(isset($data['cust_supp'])){
        	customer_need_update($data['cust_supp']);
			supplier_need_update($data['cust_supp']);
        }
		
		return $ok;
	}
	function delete($id){
		
		if ($q=$this->jurnal_model->get_by_gl_id($id)->result()){
				echo json_encode(array("success"=>false,"msg"=>"Gagal hapus nomor ini. <br>Karena sudah ada jurnal."));
				return false;
		}

		if(isset($data['docnumber'])){
			$faktur=$data['docnumber'];
			$this->invoice_model->recalc($faktur);
		}
	
		$this->db->where($this->primary_key,$id);
		if($this->db->delete($this->table_name)) {
				echo json_encode(array("success"=>true,"msg"=>"Sukses dihapus."));
				return true;
		} else {
				echo json_encode(array("success"=>false,"msg"=>"Gagal hapus nomor ini."));
				return false;
		}
	}
	function save_item($data){
		return $this->db->insert('crdb_memo_dtl',$data);
	}
	function delete_item($id){
		$this->db->where("lineid",$id);
		return $this->db->delete("crdb_memo_dtl");
	}
	function recalc($nomor) {
		$s="update  crdb_memo 
			left join (

			select kodecrdb,sum(amount) z_amount from crdb_memo_dtl
			where kodecrdb='$nomor' 
			group by kodecrdb

			) d
			on crdb_memo.kodecrdb=d.kodecrdb
			set amount=z_amount 

			where crdb_memo.kodecrdb='$nomor'";
		
		$this->db->query($s);
	}
	function unposting($nomor) {
		$this->recalc($nomor);
		$crdb=$this->get_by_id($nomor)->row();
		
		if($this->periode_model->closed($crdb->tanggal)){
			echo "ERR_PERIOD";
			return false;
		}
		if($this->jurnal_model->del_jurnal($nomor)) {
			$data['posted']=false;
		} else {
			$data['posted']=true;
		}
		$this->update($nomor,$data);
		
	}
	function posting($nomor)
	{
	
		$gl_id=$nomor;

		$this->recalc($nomor);
		$crdb=$this->get_by_id($nomor)->row();
		if (!$crdb ) {
			echo "Nomor tidak ada $nomor";
			return false;
		} 		
		if($this->periode_model->closed($crdb->tanggal)){
			echo "ERR_PERIOD";
			return false;
		}
		$type=$crdb->transtype;
		$docnumber=$crdb->docnumber;
		$accountid=$crdb->accountid;
		$amount=$crdb->amount;
		$date=$crdb->tanggal;
		$custsuppbank=$crdb->cust_supp;
		
		
		if($type=="SO-CREDIT MEMO" or $type=="SO-DEBIT MEMO") {
			
			if($fakturq=$this->invoice_model->get_by_id($docnumber)){
				if($faktur=$fakturq->row()){
					if(invalid_account($accountid))$accountid=$faktur->account_id;
					$custsuppbank=$faktur->sold_to_customer;
			
					if(invalid_account($accountid)) {
						$accountid=$this->company_model->setting("accounts_receivable");
						$this->db->query("update invoice set account_id='".$accountid."' 
							where invoice_number='".$docnumber."'");
					}
					
				}
			}
			
		} else {
			
			if($fakturq=$this->purchase_order_model->get_by_id($docnumber)){
				if($faktur=$fakturq->row()){
					if(invalid_account($accountid))$accountid=$faktur->account_id;					
					$custsuppbank=$faktur->supplier_number;
					if(invalid_account($accountid)){
						$accountid=$this->company_model->setting("accounts_payable");
						$this->db->query("update purchase_order set account_id='".$accountid."' 
							where purchase_order_number='".$docnumber."'");
						$this->db->query("update payables set account_id='".$accountid."' 
							where purchase_order_number='".$docnumber."'");
					}
					
				}
			}
		}
		
		$debit=0; $credit=0;$operation="";$source="";
		// posting header
		if($type=="SO-CREDIT MEMO" OR $type=="PO-DEBIT MEMO"){
			$debit=0; $credit=$amount;
		} else {
			$debit=$amount; $credit=0;
		}
		$operation=$type." Posting"; $source=$crdb->keterangan;
		
		$this->jurnal_model->add_jurnal($gl_id,$accountid,$date,$debit,$credit,$operation,$source,$custsuppbank);
		
		// posting detail
		$items=$this->db->query("select * from crdb_memo_dtl where kodecrdb='$nomor'");
		
		foreach($items->result() as $row) {
			$account_id=$row->accountid; 

			if($type=="SO-CREDIT MEMO" OR $type=="PO-DEBIT MEMO"){
				$debit=$row->amount; $credit=0;
			} else {
				$debit=0; $credit=$row->amount;
			}
			$operation=$type." Posting"; $source=$crdb->keterangan;
			$this->jurnal_model->add_jurnal($gl_id,$account_id,$date,$debit,$credit,$operation,$source,'',$custsuppbank);
		}
		
		if($this->jurnal_model->validate($nomor)) {$data['posted']=true;} else {$data['posted']=false;}
		$this->update($nomor,$data);
		
	}
	function posting_range_date($date_from,$date_to,$type=0){
			
		
		$date_from=date('Y-m-d H:i:s', strtotime($date_from));
		$date_to=date('Y-m-d H:i:s', strtotime($date_to));
		$where="where transtype in ('SO-CREDIT MEMO','SO-DEBIT MEMO')";
		if($type==1) $where="where transtype in ('PO-CREDIT MEMO','PO-DEBIT MEMO')";
		$s="select kodecrdb 
		from crdb_memo $where  
		and tanggal between '$date_from' and '$date_to' and ifnull(posted,false)=false 
		order by kodecrdb";
		$rst_inv_hdr=$this->db->query($s);
		if($rst_inv_hdr){
			foreach ($rst_inv_hdr->result() as $r_inv_hdr) {
				
				echo "<br>Posting...".$r_inv_hdr->kodecrdb;
				$this->posting($r_inv_hdr->kodecrdb);
						
			} // foreach rst_inv_hdr
		} // if rst_inv_hdr
		if($this->show_finish_message){
		echo "<legend>Finish.</legend><div class='alert alert-info'>
		Apabila ada kesalahan silahkan periksa mungkin seting akun-akun belum benar, 
		atau jurnal tidak balance. Silahkan cek ke nomor bukti yang bersangkutan 
		dan posting secara manual atau ulangi lagi 
		<a class='btn btn-primary' href='#' onclick='window.history.go(-1); return false;'> Go Back </a>.
		<p>&nbsp</p><p>Apabila tidak ada kesalahan silahkan close tab ini.
		<a class='btn btn-primary' href='#' onclick='remove_tab_parent(); return false;'> Close </a>.		
		</p>
		</div>"; 
		}	
	} // posting	
	function unposting_range_date($date_from,$date_to,$type=0){		
		$date_from=date('Y-m-d H:i:s', strtotime($date_from));
		$date_to=date('Y-m-d H:i:s', strtotime($date_to));
		$where="where transtype in ('SO-CREDIT MEMO','SO-DEBIT MEMO')";
		if($type==1) $where="where transtype in ('PO-CREDIT MEMO','PO-DEBIT MEMO')";
		$s="select kodecrdb 
		from crdb_memo $where 
		and tanggal between '$date_from' and '$date_to' and posted=true 
		order by kodecrdb";
		$rst_inv_hdr=$this->db->query($s);
		if($rst_inv_hdr){
			foreach ($rst_inv_hdr->result() as $r_inv_hdr) {
				$this->unposting($r_inv_hdr->kodecrdb);
				echo "<br>Delete Jurnal: ".$r_inv_hdr->kodecrdb;
			}
		}
		if($this->show_finish_message){
		echo "<legend>Finish.</legend><div class='alert alert-info'>
		<p>Apabila tidak ada kesalahan silahkan close tab ini.
		<a class='btn btn-primary' href='#' onclick='remove_tab_parent(); return false;'> Close </a>.		
		</p>
		</div>"; 
        }
	}
	
} ?>