<?php
class Aktiva_model extends CI_Model {

private $primary_key='id';
private $table_name='fa_asset';
private $period="";
private $asset_id="";
private $item=null;	//recordset this aktiva
private $book_value=0;
private $akum_value=0;
private $expenses_value=0;
private $reload_period=false;

function __construct(){
	parent::__construct();        
      
}
	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')
	{
		$nama='';
		if(isset($_GET['nama'])){
			$nama=$_GET['nama'];
		}
		if($nama!='')$this->db->where("description like '%$nama%'");
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
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	
	function save($data){
		$data['warranty_date']= date('Y-m-d H:i:s', strtotime($data['warranty_date']));
		$data['acquisition_date']= date('Y-m-d H:i:s', strtotime($data['acquisition_date']));
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$data['warranty_date']= date('Y-m-d H:i:s', strtotime($data['warranty_date']));
		$data['acquisition_date']= date('Y-m-d H:i:s', strtotime($data['acquisition_date']));
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$data);
	}
	function delete($id){
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function load_all() {
		//load all aset active
//		$this->db->where("active",true);
		return $this->db->order_by("id")->get($this->table_name);
	}
	function loadlist() {
		//load all aset active
//		$this->db->where("active",true);
		$rows=null;
		if($q=$this->db->get($this->table_name)){
			foreach($q->result() as $r) {
				$rows[]=$r;
			}
		}
		return $rows;
	}
	function load_by_period($period,$reload=false){
		$period=str_replace("-","",$period);
		$this->period=$period;
		$aktiva=$this->load_all();
		$rows=array();
		$depn=null;
		$this->reload_period=$reload;
		if($this->reload_period){
			$sql="delete from fa_asset_depreciation_schedule 
				where depn_year='$this->period'";
			$this->db->query($sql);
		}
		foreach($aktiva->result() as $row_aktiva) {
			$this->asset_id=$row_aktiva->id;
			$this->item=$row_aktiva;
			if( $depn = $this->schedule() ) {
				$row_data['id']=$row_aktiva->id;
				$row_data['description']=$row_aktiva->description;
				$row_data['depr_amount']=$depn['amount'];
				$row_data['book_amount']=$depn['book'];
				
				$rows[]=$row_data;
			}
		}
		return $rows;	
	}
	function schedule(){
		$data['amount']=0;
		$data['book']=0;
		
		$this->db->where("depn_year",$this->period);
		if($this->asset_id!="")$this->db->where("asset_id",$this->asset_id);
					
		if($q=$this->db->get("fa_asset_depreciation_schedule"))
			{
				$data_ads['asset_id']=$this->asset_id;
				$data_ads['depn_year']=$this->period;
				$data_ads['acquisition_cost']=$this->item->acquisition_cost;
				if($oDepn=$q->row()){
					$data_ads['accum_depn'] = $oDepn->accum_depn;
					$data_ads['book_value'] = $oDepn->book_value;
					$data_ads['acquisition_cost'] = $oDepn->acquisition_cost;
					$data_ads['depn_exp'] = $oDepn->depn_exp;
					
					$this->db->where("asset_id",$this->asset_id)
						->where("depn_year",$this->period)
						->update("fa_asset_depreciation_schedule",$data_ads);
						
				} else {
					// calculate depn
					if ($this->item->depn_method=="2") {
						$data_proc=$this->sum_of_year_process();
					} else if ($this->item->depn_method=="3") {
						$data_proc=$this->declining_balance_process();
					} else {
						$data_proc=$this->straight_line_process();
					}
					$data_ads['accum_depn']=$data_proc['akum_value'];
					$data_ads['book_value']=$data_proc['book_value'];
					$data_ads['depn_exp']=$this->depn_exp;

					$this->db->insert("fa_asset_depreciation_schedule",$data_ads);
				}
				$data['amount']=$data_ads['accum_depn'];
				$data['book']=$data_ads['book_value'];
		}
	
		return $data;
	}
	 
	function straight_line_process() {
		//'--- hitung berapa persen dari masa pakai
		$nPrc=0;
		if($this->item->useful_lives==0)$this->item->useful_lives=12; //-- default 12 bulan
		$nPrc = 100 / $this->item->useful_lives;
		 
		$nDepn=0;
		$expenses_value = ($nPrc / 100) * ($this->item->acquisition_cost - $this->item->salvage_value);
		//'--- buat table
		$m_xItem=array();
		$book_value = $this->item->acquisition_cost;
		$data_retval=null;
		$akum_value=0;
		for($i = 0; $i<$this->item->useful_lives; $i++){
			$akum_value = $akum_value + $expenses_value;
			$book_value = $book_value - $expenses_value;
			if($book_value>$this->item->salvage_value){
				$prd=$this->add_date($this->item->acquisition_date,$i);
				$m_item=array('acquisition_date' => $prd,
					"expenses_value" => $expenses_value,
					"acquisition_cost" => $this->item->acquisition_cost,
					"akum_value" => $akum_value,
					"book_value" => $book_value);
				$m_xItem[]=$m_item;
				if(date("Ym",strtotime($prd))==$this->period) {	
					//found period
					$data_retval=$m_item;
					$i=$this->item->useful_lives;	//end for
				} 
			}
        }
		$this->book_value=$book_value;
		$this->akum_exp=$akum_value;
		$this->depn_exp=$expenses_value;
 
		return $data_retval;
	}
	function sum_of_year_process() {
		$m_xItem=array();
		$data_retval=null;
		For($i = 0;$i<$this->item->useful_lives;$i++) {
			$expenses_value = ($this->item->useful_lives - $i) / $this->iem->useful_live;
			$expenses_value = $expenses_value * ($this->item->acquisition_cost - $this->item->salvage_value);
			$akum_value = $akum_value + $expenses_value;
			$book_value = $book_value - $expenses_value;
			$prd=$this->add_date($this->item->acquisition_date,$i);
			$m_item=array('acquisition_date' => $prd,
				"expenses_value" => $expenses_value,
				"acquisition_cost" => $this->item->acquisition_cost,
				"akum_value" => $akum_value,
				"book_value" => $book_value);
			$m_xItem[]=$m_item;
			if(date("Ym",strtotime($prd))==$this->period) {	
				//found period
				$data_retval=$m_item;
				$i=$this->useful_lives;	//exit for
			} 
		}
		$this->book_value=$book_value;
		$this->akum_exp=$akum_value;
		$this->depn_exp=$expenses_value;
		return $data_retval;
	} 
	function declining_balance_process() {
		//'--- hitung berapa persen dari masa pakai
		$nPrc = 100 / $this->item->useful_lives;
		//'-- dalam metode ini biasanya 2 kali methode straight line
		$nPrc = $nPrc * 2;
		$book_value = $this->item->acquisition_cost;
		for($i = 0;$i<$this->item->useful_lives;$i++) {
			if($i == 0) { 
				//'---- periode pertama adalah sama dengan perolehan
				$expenses_value = ((($nPrc / 100) * ($this->item->acquisition_cost - 0)));
				$book_value = $book_value - $expenses_value;
				$akum_value = $expenses_value;
			} else {
				$xpenses_value = (($nPrc / 100) * ($book_value));
				$nTmp = $book_value - $expenses_value;
				if($nTmp < $this->item->salvage_value) {
					$expenses_value = $book_value - $this->item->salvage_value;
				}
				$akum_value = $akum_value + $expenses_value;
				$book_value = $book_value - $xpenses_value;
			}	
			//'--- periode terakhir lebih dari nilai salvage
			$prd=$this->add_date($this->item->acquisition_date,$i);
			$m_item=array('acquisition_date' => $prd,
				"expenses_value" => $expenses_value,
				"acquisition_cost" => $this->item->acquisition_cost,
				"akum_value" => $akum_value,
				"book_value" => $book_value);
			$m_xItem[]=$m_item;
				if(date("Ym",strtotime($prd))==$this->period) {	
				//found period
				$data_retval=$m_item;
				$i=$this->useful_lives;	//end loop
			} 
		}
		$this->book_value=$book_value;
		$this->akum_exp=$akum_value;
		$this->depn_exp=$expenses_value;
		return $data_retval;
	} 
	function add_date($orgDate,$mth){ 
	  $cd = strtotime($orgDate); 
	  $retDAY = date('Y-m-d', mktime(0,0,0,date('m',$cd)+$mth,date('d',$cd),date('Y',$cd))); 
	  return $retDAY; 
	} 	
	function get_asset_name($asset_id){
		$ret="";
		$this->db->select("description")->where("id",$asset_id);
		if($row=$this->db->get($this->table_name)->row()){
			$ret=$row->description;
		}
		return $ret;
	}
 
}
?>