<?php
class App_master_model extends CI_Model {

	private $primary_key='app_id';
	private $table_name='ls_app_master';
	private $_app_id="";
	
	function __construct(){
		parent::__construct();        
	}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')	{
		$nama='';
		if(isset($_GET['cust_name']))$nama=$_GET['cust_name'];
		if($nama!='')$this->db->where("cust_name like '%$nama%'");

		if (empty($order_column)||empty($order_type))
			$this->db->order_by($this->primary_key,'asc');
		else
			$this->db->order_by($order_column,$order_type);
			
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function count_all(){
		return $this->db->count_all($this->table_name);
	}
	function get_by_id($id){
		$this->_app_id=$id;
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function get_items(){
		$this->db->where($this->primary_key,$this->_app_id);
		return $this->db->get("ls_app_object_items");
	}
	function save($data){
		$data['app_date']=date('Y-m-d H:i:s', strtotime($data['app_date']));
		$data['create_by']=$this->access->user_id();
		$data['create_date']=date('Y-m-d H:i:s', strtotime($data['create_date']));
		return $this->db->insert($this->table_name,$data);            
	}
	function recalc_type_item($nomor="") {
		$tenor=3;
		$insr_amount=0;
		if($this->input->get()){
			$tenor=$this->input->get('inst_month');
			$insr_amount=$this->input->get("insr_amount");
		} else {
			//ambil dari tabel
			if($q=$this->db->select("inst_amount,insr_amount")->where("app_id",$nomor)->get($this->table_name)) 
			{
				if($row=$q->row()){
					$tenor=	$row->inst_month;
					$insr_amount=$row->insr_amount;		
				}				
			}
		}
		
				$sub_total=0;$total_loan_amount=0;
				$total_dp_amount=0;$total_bunga_amount=0;$total_cicilan=0;
				$sama_bunga=true;$old_bunga=0;
				$sama_dp=true;$old_dp=0;
				$dp=0; $bunga=0;
				$pertama=0;
				if($q=$this->db->where("app_id",$nomor)->get("ls_app_object_items")){
					foreach($q->result() as $item){
						$sub_total=$sub_total+$item->amount;
						$old_dp=$dp;
						$dp=$this->get_dp_percent($item->amount);
						if($pertama>0)$sama_dp=$old_dp==$dp;						
						$dp_amount=(double)round($item->amount*$dp);
						$aft_dp=$item->amount-$dp_amount;
						$old_bunga=$bunga;
						$bunga=$this->get_bunga_percent($aft_dp);
						if($pertama>0)$sama_bunga=$old_bunga==$bunga;
						$pertama++;
						 
						$bunga_amount=(double)round($bunga*$aft_dp);
						$loan_amount=$aft_dp/$tenor;
						$aft_tenor=$aft_dp*$bunga;
						$cicilan=$aft_tenor+$loan_amount;
						$loan_amount=$loan_amount*$tenor;
						
						$this->db->where("id",$item->id)->update("ls_app_object_items", 
							array("dp"=>$dp,"dp_amount"=>$dp_amount,"aft_dp_amount"=>$aft_dp,
							"bunga"=>$bunga,"bunga_amount"=>$bunga_amount,
							"loan_amount"=>$loan_amount,"tenor"=>$tenor,
							"aft_tenor"=>$aft_tenor,"angsuran"=>$cicilan));
							
						$total_loan_amount=$total_loan_amount+$loan_amount;	
						$total_dp_amount=$total_dp_amount+$dp_amount;
						$total_cicilan=$total_cicilan+$cicilan;
						$total_bunga_amount=$total_bunga_amount+$bunga_amount;
					}
					$admin=getvar("admin",100000);
					 
					$data=array('sub_total'=>$sub_total,'loan_amount'=>$total_loan_amount,
					'dp_amount'=>$total_dp_amount, 
					'admin_amount'=>$admin,'inst_month'=>$tenor,'inst_amount'=>$total_cicilan,
					'insr_amount'=>$insr_amount,'rate_prc'=>$sama_bunga==true?$bunga:0,
					'rate_amount'=>$total_bunga_amount,
					'dp_prc'=>$sama_dp==true?$dp:0);
					$this->db->where("app_id",$nomor)->update("ls_app_master",$data);
					
					return $data;
					
				}
		
	}
	function recalc_type_total($nomor="") {
		$insr_amount=0;
		$tenor=3;
		if($this->input->get()){
			$tenor=$this->input->get('inst_month');
			$insr_amount=$this->input->get("insr_amount");
			$promo_code=$this->input->get("promo_code");
			$dp=$this->input->get('dp_prc');
			$bunga=$this->input->get('rate_prc');
			$admin=$this->input->get('admin_amount');
		} else {
			//ambil dari tabel
			if($q=$this->db->select("inst_month,insr_amount,dp_prc,rate_prc,
				admin_amount,promo_code")->where("app_id",$nomor)->get($this->table_name)) 
			{
				if($row=$q->row()){
					if ($row->inst_month>0 ) $tenor=$row->inst_month;
					$insr_amount=$row->insr_amount;
					$dp=$row->dp_prc;
					$bunga=$row->rate_prc;
					$admin=$row->admin_amount;
					$promo_code=$row->promo_code;
				}				
			}
		}
		if($dp>1)$dp=round($dp/100,4);
		if($bunga>1)$bunga=round($bunga/100,4);
		$admin=str_replace(",","",$admin);
		
		if($tenor<=0) $tenor=3;
		
				//-- hitungan dari total
				$q=$this->db->query("select sum(amount) as z_amt 
				from ls_app_object_items where app_id='".$nomor."'");		
				$sub_total=0;
				$loan_amount=0;				
				if($q) $sub_total=(double)$q->row()->z_amt;	
				//--- range down payment
				//--- PR nih supaya kalau DP sudah diisi tidak lihat lagi table range
				if($promo_code=="") {	
					$dp=$this->get_dp_percent($sub_total);
					$admin=getvar("admin",100000);
				} 
				$dp_amount=(double)round($dp*$sub_total);
				
				$loan_amount=(double)round($sub_total-$dp_amount);
				
				//--- bunga
				if($promo_code=="") {
					$bunga=$this->get_bunga_percent($loan_amount);
				} 
				$bunga_amount=round($loan_amount*$bunga,4);
				$loan_amount2=round($loan_amount/$tenor,4);
				$loan_amount2=$loan_amount+$bunga_amount;
				
				
	//			$loan_amount2=$loan_amount2+$insr_amount;
				$inst_amount=$loan_amount/$tenor;
				$inst_amount=$inst_amount+$bunga_amount;
				
				$data=array('sub_total'=>$sub_total,'loan_amount'=>$loan_amount,'dp_amount'=>$dp_amount, 
				'admin_amount'=>$admin,'inst_month'=>$tenor,'inst_amount'=>$inst_amount,
				'insr_amount'=>$insr_amount,'rate_prc'=>$bunga,'rate_amount'=>$bunga_amount,
				'dp_prc'=>$dp);
				$this->db->where("app_id",$nomor)->update("ls_app_master",$data);
				//update juga ls_loan_master 
				
				
				if($q=$this->db->select("loan_id")->where("app_id",$nomor)->get("ls_loan_master")){
					if($row=$q->row()) {
						$loan_id=$row->loan_id;
						$dtloan['inst_amount']=$inst_amount;
						$dtloan['loan_amount']=$loan_amount;
						$dtloan['max_month']=$tenor;
						$dtloan['dp_percent']=$dp;
						$dtloan['dp_amount']=$dp_amount;
						$dtloan['insr_amount']=$insr_amount;
						$dtloan['adm_amount']=$admin;
						$dtloan['interest_percent']=$bunga;
						$dtloan['interest_amount']=$bunga_amount;
						$this->db->where("loan_id",$loan_id)->update("ls_loan_master",$dtloan);
						
					}
				}
				
				return $data;
		
	}
	function recalc($nomor="") {
		if($nomor!=''){
			//-- hitungan dari tiap barang
			//0- hitungan dari total, 1-hitungan dari baris barang
			$jenis_hitungan=1;	
			if($jenis_hitungan==0) {
				return $this->recalc_type_item($nomor);
			}
			if($jenis_hitungan==1) {
				return $this->recalc_type_total($nomor);
			}
		}		
	}
	function update($id,$data){
		$id=urldecode($id);
		$data['app_date']=date('Y-m-d H:i:s', strtotime($data['app_date']));
		$data['update_by']=$this->access->user_id();
		if(isset($data['dp_amount']))$data['dp_amount']=str_replace(",","",$data['dp_amount']);
		if(isset($data['inst_amount']))$data['inst_amount']=str_replace(",","",$data['inst_amount']);
		if(isset($data['rate_amount']))$data['rate_amount']=str_replace(",","",$data['rate_amount']);
		if(isset($data['admin_amount']))$data['admin_amount']=str_replace(",","",$data['admin_amount']);

		$this->db->where($this->primary_key,$id);
		$ok=$this->db->update($this->table_name,$data);
		// hitung ulang jumlah angsuran
		$this->recalc($id);
		
		// cek apakah sudah dibuatkan kontrak?
		$app=$this->db->select("contract_id,inst_amount,rate_amount")->where("app_id",$id)
			->get($this->table_name)->row();
		$loan_id=$app->contract_id;
		if($loan_id=="") {
			if($row=$this->db->select("loan_id")->where("app_id",$id)->get("ls_loan_master")->row()){
				$loan_id=$row->loan_id;
			}
		}
		if($loan_id!=""){
			// cek apa barangnya cuman 1
			$app_item=$this->db->select("id,description,obj_id,qty,price,amount")->where("app_id",$id)
				->get("ls_app_object_items")->row();
			if($q=$this->db->select('id')->where('loan_id',$loan_id)
				->get("ls_loan_obj_items")) {
				$loan_item=$q->row();
				$id=$loan_item->id;
			} else {
				$loan_item=null;
				$id=0;
			}
			// update object item di kontrak dengan perubahan spk barangnya
			$data=array("obj_item_id"=>$app_item->obj_id,"obj_desc"=>$app_item->description,
				"qty"=>$app_item->qty,"price"=>$app_item->price,"amount"=>$app_item->amount);
			$this->db->where("loan_id",$loan_id)->where("id",$id)
				->update("ls_loan_obj_items",$data);
			// cek kalau ada cicilan
			if($qcic=$this->db->where('loan_id',$loan_id)->get("ls_invoice_header"))
			{
				foreach($qcic->result() as $inv)
				{
					$this->db->where('invoice_number',$inv->invoice_number)->update('ls_invoice_header',
						array("amount"=>$app->inst_amount,"bunga"=>$app->rate_amount,
						"pokok"=>$app->inst_amount-$app->rate_amount));
				}
			}
			$this->load->model('leasing/loan_master_model');
			$this->loan_master_model->recalc($loan_id);	
		}
		return $ok;
	}
	function delete($id){
		$numrow=$this->db->count_all("ls_loan_master where app_id='$id'");
		if($numrow>0){
			return false;
		}
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
		$this->db->where("app_id",$id)->delete("ls_app_object_items");
		return true;
	}

	function save_cust_master($data){
		$cm['cust_id']='';	
		$cm['cust_name']='';
		$cm['street']='';
		$cm['first_name']='';
		$cm['rtrw']='';
		$cm['call_name']='';
		$cm['kel']='';
		$cm['kec']='';
		$cm['id_card_no']='';
		$cm['id_card_exp']='';
		$cm['city']='';
		$cm['zip_pos']='';
		$data['mother_name']='';
		$data['spouse_name']='';
		$data['spouse_birth_date']='';
		$data['spouse_phone']='';
		$data['spouse_birth_place']='';

		$this->db->insert('ls_cust_master',$card1);
		$cm['cust_id']='';
		$data['gender']='';
		$data['birth_place']='';
		$data['house_status']='';
		$data['marital_status']='';
		$data['no_of_dependents']='';
		$this->db->insert('ls_cust_personal',$card1);


		$cm['cust_id']='';
		$data['cs1_street']='';
		$data['cs1_rtrw']='';
		$data['cs1_kel']='';
		$data['cs1_kec']='';
		$data['cs1_city']='';
		$data['cs1_zip_pos']='';
		$data['cs1_lama_thn']='';
		$data['cs1_lama_bln']='';
		$this->db->insert('ls_cust_ship_to',$card1);

		$cm['cust_id']='';
		$data['cs2_street']='';
		$data['cs2_rtrw']='';
		$data['cs2_kel']='';
		$data['cs2_kec']='';
		$data['cs2_city']='';
		$data['cs2_zip_pos']='';
		$data['cs2_phone']='';
		$data['cs2_hp']='';
		$this->db->insert('ls_cust_ship_to',$card1);

		$data['comp_name']='';
		$data['job_status']='';
		$data['bussiness_type']='';
		$data['job_status_etc']='';
		$data['since_year']='';
		$data['job_level']='';
		$data['com_street']='';
		$data['job_type']='';
		$data['com_rtrw']='';
		$data['job_type_etc']='';
		$data['com_kel']='';
		$data['comp_desc']='';
		$data['com_kec']='';
		$data['emp_status']='';
		$data['com_city']='';
		$data['emp_status_etc']='';
		$data['total_employee']='';
		$data['com_contact_phone']='';
		$data['office_status']='';
		$data['phone_ext']='';
		$data['office_status_etc']='';
		$data['spv_name']='';

		$data['salary']='';
		$data['com_zip_pos']='';
		$this->db->insert('ls_cust_company',$card1);

		$data['fam_first_name']='';
		$data['salary_source']='';
		$data['fam_relation']='';
		$data['spouse_salary']='';
		$data['fam_street']='';
		$data['spouse_salary_source']='';
		$data['fam_city']='';
		$data['other_income']='';
		$data['fam_kel']='';
		$data['other_income_source']='';
		$data['fam_kec']='';
		$data['deduct']='';
		$data['fam_zip_pos']='';
		$data['deduct_source']='';
		$data['fam_contact_phone']='';
		$this->db->insert('ls_cust_family',$card1);

		$card1['cd1_card_no']='';
		$card1['cd1_card_bank']='';
		$card1['cd1_card_exp']='';
		$card1['cd1_card_type']='';
		$card1['cd1_card_type_etc']='';
		$card1['cd1_card_limit']='';
		$card1['cust_id']='';
		$this->db->insert('ls_cust_crcard',$card1);

		$card2['cd2_card_no']='';
		$card2['cd2_card_bank']='';
		$card2['cd2_card_exp']='';
		$card2['cd2_card_type']='';
		$card2['cd2_card_type_etc']='';
		$card2['cd2_card_limit']='';
		$card2['cust_id']='';
		$this->db->insert('ls_cust_crcard',$card2);

		$data['app_id']='';
		$data['dealer_name']='';
		$data['dealer_id']='';
		$data['dp_amount']='';
		$data['insr_amount']='';
		$data['admin_amount']='';
		$data['inst_amount']='';
		$data['inst_month']='';

		$data['loan_amount']='';
		$this->db->insert('ls_cust_crcard',$card2);

		$data['app_id']='';
		$data['oid']='';
		$data['obj_id']='';
		$data['obj_name']='';
		$data['obj_amount']='';
		$data['obj_merk']='';
		$this->db->insert('ls_app_object_items',$card2);
		
	}
	function not_verified(){
		//PV cid diisi dengan area
		
		$sql="select lam.app_id,lam.app_date,lam.cust_id,c.cust_name,lam.create_by,
			lam.counter_id,lc.counter_name,lc.area,lc.area_name
			from ls_app_master lam 
			left join ls_cust_master c on c.cust_id=lam.cust_id
			left join ls_counter lc on lc.counter_id=lam.counter_id
			where lam.verified='0'";
			if( !($this->access->cid=="" or $this->access->cid=="ALL"))$sql.=" and 
			(lc.area_name='".$this->access->cid."' or lc.area='".$this->access->cid."')";
		 
		$s="";	
		if($q=$this->db->query($sql)){
			$s="<table class='table2' style='width:100%'>
				<thead><tr>
				<th>Nomor</th><th>Tanggal</th><th>Kode</th><th>Debitur</th>
				<th>CreateBy</th><th>Counter</th><th>Area</th></tr></thead>
				<tbody>
			";
			foreach($q->result() as $row){
				$s.="<tr><td>
					<a href='#' onclick=\"step1('".$row->app_id."');
					return false\" >".$row->app_id."</a></td>
				
				<td>".$row->app_date."</td>
				<td>".$row->cust_id."</td><td>".$row->cust_name."</td> 
				<td>".$row->create_by."</td>
				<td>".$row->counter_id."-".$row->counter_name."</td>
				<td>".$row->area."-".$row->area_name."</td></tr>";
			}
			$s.="</tbody></table>
			";
			
		}
		return $s;
	}
	function not_scored(){
		//user BS field CID diiisi dengan nama area di counter 
		
		$sql="select lam.app_id,lam.app_date,lam.cust_id,c.cust_name,lam.create_by,
			lam.counter_id,lc.counter_name,lc.area,lc.area_name 
			from ls_app_master lam 
			left join ls_cust_master c on c.cust_id=lam.cust_id
			left join ls_counter lc on lc.counter_id=lam.counter_id
			where lam.scored='0' and lam.verified=1";
			if( !($this->access->cid=="" or $this->access->cid=="ALL"))$sql.=" and 
			(lc.area_name='".$this->access->cid."' or lc.area='".$this->access->cid."')";
		$s="";	
		if($q=$this->db->query($sql)){
			$s="<table class='table2' style='width:100%'>
				<thead><tr>
				<th>Nomor</th><th>Tanggal</th><th>Kode</th><th>Debitur</th>
				<th>CreateBy</th><th>Counter</th><th>Area</th>
				<th>View SPK</th><th>View CST</th>
				</tr></thead>
				<tbody>
			";
			foreach($q->result() as $row){
				$s.="<tr><td>
					<a href='#' onclick=\"step1('".$row->app_id."');
					return false\" >".$row->app_id."</a></td>
				
				<td>".$row->app_date."</td>
				<td>".$row->cust_id."</td><td>".$row->cust_name."</td>
				<td>".$row->create_by."</td>
				<td>".$row->counter_id.'-'.$row->counter_name."</td>
				<td>".$row->area.'-'.$row->area_name."</td>
				<td>
					<a href='#' onclick=\"view_spk('".$row->app_id."');
					return false\" >View App</a>
				</td>				
				<td>
					<a href='#' onclick=\"view_cust('".$row->cust_id."');
					return false\" >View Cust</a>
				</td>				
				
				</tr>";
			}
			$s.="</tbody></table>";
			
		}
		return $s;
	}
	function not_surveyed($from="",$to="",$wilayah="",$surveyor=""){
		//	and lam.score_value>75 dihilangkan mungkin saja gmbs setuju walau score<75
		// mandala hilangkan lam.verified and lam.confirmed=1 and lam.status
		// where lam.status<>''  
			
		$sql="select lam.app_id,lam.app_date,lam.cust_id,c.cust_name,
			cn.counter_id,cn.counter_name,cn.area,cn.area_name,
			lam.status,lam.confirmed,lam.inst_amount,lam.inst_month
			from ls_app_master lam 
			left join ls_cust_master c on c.cust_id=lam.cust_id
			left join ls_counter cn on cn.counter_id=lam.counter_id
			left join ls_app_survey las on las.app_id=lam.app_id
			where lam.status is null and lam.confirmed=0 and lam.surveyed=0";
		if($from<>""){
			$sql.=" and lam.app_date between '".date("Y-m-d",strtotime($from))."'
			and '".date("Y-m-d H:i:s",strtotime($to))."'";
		}
		if($wilayah!=""){
			$sql.=" and cn.area='$wilayah'";
		}
		if($surveyor!=""){
			$sql.=" and las.survey_by='$surveyor'";
		}
		$s="";	
		if($q=$this->db->query($sql)){
			$s="<div style='float:scroll'>
			
				<table class='table2' style='width:100%'>
				<thead><tr>
				<th>Pilih</th><th>Nomor SPK</th><th>Tanggal</th><th>Kode</th><th>Debitur</th>
				<th>Counter</th><th>Area</th><th>Tgl Survey</th><th>Surveyor</th>
				</thead>
				<tbody>
			";
			$surveyor_list=array(""=>"- Pilih -");
			if($qs=$this->db->query("select u.user_id, u.username 
				from user u 
				left join user_job j on j.user_id=u.user_id 
				where j.group_id='SV'
				order by u.username")){
				foreach($qs->result() as $surv){
					$surveyor_list[$surv->user_id]=$surv->username;
				}
			}
			$i=0;
			foreach($q->result() as $row){
				$s.="<tr><td>
					<input type='checkbox' value='".$row->app_id."' name='pilih[".$i++."]'></td>
				<td>".$row->app_id."</td>
				<td>".$row->app_date."</td>
				<td><a href='#' onclick=\"view_cust('".$row->cust_id."');return false;\" >".$row->cust_id."</a></td>
				<td>".$row->cust_name."</td>
				<td>".$row->counter_id.'-'.$row->counter_name."</td>
				
				<td>".$row->area."</td>
				<td><input type='text' value='".date('Y-m-d H:i:s')."' name='tanggal[]' class='easyui-datetimebox'></td>
				<td>".form_dropdown("surveyor[]",$surveyor_list)."</td>
				</tr>";
				$desc="";			
				$r2=$this->db->select("description")->where("app_id",$row->app_id)
				->get("ls_app_object_items")->row();
				if($r2){
					$desc=$r2->description;
				}
				$s.="<tr><td></td><td colspan=5><i>Produk: $desc , Tenor: $row->inst_month bulan, 
				Cicilan: ".number_format($row->inst_amount)."</i></td></tr>";
			}
			$s.="</tbody></table>
				</div>
			";
			
		}
		return $s;
	}
	function surveyed(){
		//user mrisk field cid diisi dengan area
		// lam.score_value>50 and   bisa jadi gmbs setujua walau kurang
		$sql="select distinct lam.app_id,lam.app_date,lam.cust_id,c.cust_name,cn.area,cn.area_name
			,las.survey_by
			from ls_app_master lam 
			left join ls_cust_master c on c.cust_id=lam.cust_id
			left join ls_counter cn on cn.counter_id=lam.counter_id
			left join ls_app_survey las on las.app_id=lam.app_id
			where lam.verified=1 
			and lam.surveyed=1 and las.recomended=0 and las.status=1";
			if( !($this->access->cid=="" or $this->access->cid=="ALL"))$sql.=" and 
			(cn.area_name='".$this->access->cid."' or cn.area='".$this->access->cid."')";
		$s="";	
		if($q=$this->db->query($sql)){
			$s="<table class='table2' style='width:100%'>
				<thead><tr>
				<th>Nomor SPK</th><th>Tanggal</th><th>Kode</th><th>Debitur</th>
				<th>Area</th><th>Surveyor<th>Pilih?</th>
				</tr></thead>
				<tbody>
			";
			foreach($q->result() as $row){
				$s.="<tr>
				<td><a href='#' onclick=\"view_spk('".$row->app_id."');return false;\" >".$row->app_id."</a></td>
				<td>".$row->app_date."</td>
				<td><a href='#' onclick=\"view_cust('".$row->cust_id."');return false;\" >".$row->cust_id."</a></td>
				<td>".$row->cust_name."</td>
				<td>".$row->area."-".$row->area_name."</td>
				<td>".$row->survey_by."</td>
				<td><input type='checkbox' value='".$row->app_id."' name='pilih[]' ></td>
				</tr>";
			}
			$s.="</tbody></table>";
			
		}
		return $s;
	}	
	function not_approved($show_checkbox=true){
		//lam.score_value>50 and 
		//and las.recomended=1 
		//and lam.status='Wait Approval'
		$sql="select distinct lam.app_id,lam.app_date,lam.cust_id,c.cust_name,cn.area,cn.area_name
				,las.survey_by, lam.status,lam.approved
			from ls_app_master lam 
			left join ls_cust_master c on c.cust_id=lam.cust_id
			left join ls_counter cn on cn.counter_id=lam.counter_id
			left join ls_app_survey las on las.app_id=lam.app_id
			where lam.verified=1 
			and lam.surveyed=1 and lam.approved=0 ";
		$s="";	
		if($q=$this->db->query($sql)){
			$s1="<table class='table2' style='width:100%'>
				<thead><tr>
				<th>Nomor SPK</th><th>Tanggal</th><th>Kode</th><th>Debitur</th>
				<th>Area</th><th>Surveyor</th>";
			if($show_checkbox) $s1.="<th>Approve ?</th>";
			$s1.="</tr></thead>
				<tbody>
			";
			$s2="";
			foreach($q->result() as $row){
				$s2.="<tr>
				<td><a href='#' onclick=\"view_spk('".$row->app_id."');return false;\" >".$row->app_id."</a></td>
				<td>".$row->app_date."</td>
				<td><a href='#' onclick=\"view_cust('".$row->cust_id."');return false;\" >".$row->cust_id."</a></td><td>".$row->cust_name."</td>
				<td>".$row->area."-".$row->area_name."</td>
				<td>".$row->survey_by."</td>";
//				<td>".$row->status."</td>";
//				<td>".$row->approved."</td>";
				
				if($show_checkbox){
					$s2.="<td><input type='checkbox' value='".$row->app_id."' name='pilih[]' ></td>";
				}
				$s2.="</tr>";
			}
			$s3 ="</tbody></table>
			
			";
			if($s2==""){
				$s="<strong><i>Belum ada nomor SPK yang akan 
				diproses selanjutnya.</i></strong>";
			} else {
				$s .= $s1 . $s2 . $s3;
			}
			
		}
		return $s;
	}		
	function copy_to_loan($app_id,$data){
		$loan_id=$data['loan_id'];
		$loan_date=date('Y-m-d H:i:s', strtotime($data['loan_date']));
		$app_id=$data['app_id'];
		$s="insert into ls_loan_master(
			loan_id,loan_date,app_id,dp_amount,
			cust_id,cust_name,loan_amount,max_month,inst_amount,
			first_dealer_id,interest_percent,dp_percent,dealer_id,
			dealer_name) 
		select '$loan_id' as loan_id,'$loan_date' as loan_date, lam.app_id,lam.dp_amount,
		lam.cust_id,cm.cust_name,lam.loan_amount,lam.inst_month,lam.inst_amount,
		lam.counter_id,lam.rate_prc,lam.dp_prc,lam.counter_id,
		lc.counter_name 
		from ls_app_master lam 
		left join ls_cust_master cm on cm.cust_id=lam.cust_id 
		left join ls_counter lc on lc.counter_id=lam.counter_id 
		where lam.app_id='$app_id'";

		$ok=$this->db->query($s);
		
		$s="insert into ls_loan_obj_items(
		loan_id,obj_item_id,qty,unit,price,amount,
		obj_desc,dp,dp_amount,aft_dp_amount,
		bunga,bunga_amount,loan_amount,tenor,aft_tenor,angsuran) 
		select '$loan_id' as loan_id,i.obj_id,i.qty,'Pcs' as unit,
		i.price,i.amount,i.description,i.dp,i.dp_amount,i.aft_dp_amount,
		i.bunga,i.bunga_amount,i.loan_amount,i.tenor,i.aft_tenor,i.angsuran
		from ls_app_object_items i 
		where i.app_id='$app_id'";
		$ok=$this->db->query($s);
		if(!$ok)var_dump(mysql_error());
		return $ok;
	}
	function list_scored_result() {
		//user GMBS field CID diisi dengan counter area
		$sql="select lam.app_id,lam.app_date,lam.cust_id,c.cust_name,
			cn.counter_name,lam.counter_id,cn.area,cn.area_name,
			lam.score_value,lam.status
			from ls_app_master lam 
			left join ls_cust_master c on c.cust_id=lam.cust_id
			left join ls_counter cn on cn.counter_id=lam.counter_id
			where lam.status<>'' and lam.verified=1 and lam.scored=1 
			and lam.confirmed=0 and lam.surveyed=0";
			if( !($this->access->cid=="" or $this->access->cid=="ALL"))$sql.=" and cn.area='".$this->access->cid."'";
		$s="";	
		if($q=$this->db->query($sql)){
			$s="<table class='table2' style='width:100%'>
				<thead><tr>
				<th>Pilih</th><th>Nomor SPK</th><th>Tanggal</th><th>Kode</th><th>Debitur</th>
				<th>Counter</th><th>Area</th><th>Score</th><th>Status</th>
				</tr></thead>
				<tbody>
			";
			foreach($q->result() as $row){
				$s.="<tr><td>
					<input type='checkbox' value='".$row->app_id."' name='pilih[]'></td>
				<td><a href='#' onclick='view_spk(\"".$row->app_id."\");return false;'>".$row->app_id."</a></td>
				<td>".$row->app_date."</td>
				<td>".$row->cust_id."</td><td>".$row->cust_name."</td>
				<td>".$row->counter_id."-".$row->counter_name."</td>
				<td>".$row->area."-".$row->area_name."</td>
				<td><a href='#' onclick='view_score(\"".$row->app_id."\");return false;'>".$row->score_value."</a></td>
				<td>".$row->status."</td>
				</tr>";
			}
			$s.="</tbody></table>
			
			<h5><strong>CATATAN</strong></h5>
			<textarea id='catatan' name='catatan' style='width:300px;height:100px'></textarea>
			<p><i>*Silahkan isi catatan</i></p>
			
			";
			
		}
		return $s;	
	
	}
	function get_dp_percent($amount){
		//--- range down payment
		if($query=$this->db->query("select * from ls_dp_range order by dp_from")){
			$dp=0;
			foreach($query->result() as $row){
				if($amount > $row->dp_from and $amount <= $row->dp_to){
					$dp=$row->dp_prc;
					break;
				}
			}
			if($dp>0)$dp=$dp/100;
		} 
		return $dp;
	}
	function get_bunga_percent($loan_amount){
		if($query=$this->db->query("select * from ls_bunga_range order by amount_from")){
			$bunga=0;
			foreach($query->result() as $row){
				if($loan_amount >= $row->amount_from and $loan_amount < $row->amount_to){
					$bunga=$row->bunga_prc;
					break;
				}
			}
			if($bunga>0)$bunga=$bunga/100;
		} 
		return $bunga;
	}
	
}
?>