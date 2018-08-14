<?php
class Supplier_model extends CI_Model {

private $primary_key='supplier_number';
private $table_name='suppliers';

	function __construct(){
		parent::__construct();        
     
		$this->table_name=cidt().$this->table_name;
	}
	function lov($bind_id,$other=""){
		$this->load->library("list_of_values");
		$setting['dlgBindId']=$bind_id;
		$setting['dlgRetFunc']="$('#".$bind_id."').val(row.supplier_number);";
		if($other!=""){
			$setting['dlgRetFunc']=$setting['dlgRetFunc']."$('#$other').val(row.supplier_number);";
		}
		$setting['dlgCols']=array( 
					array("fieldname"=>"supplier_number","caption"=>"Kode","width"=>"80px"),
					array("fieldname"=>"supplier_name","caption"=>"Nama Supplier","width"=>"200px")
				);			
		$setting['dlgUrlQuery']=base_url()."index.php/supplier/browse_data/";
		return $this->list_of_values->render($setting);
	}
	function select_list(){
    // dipakai untuk dropdown
        $query=$this->db->query("select supplier_number,supplier_name 
		from ".cidt()."suppliers");
        $ret=array();
        $ret['']='- Select Supplier -';
        foreach ($query->result() as $row)
        {
                $ret[$row->supplier_number]=$row->supplier_name;
        }		 
        return $ret;
}
    function lookup($param=null){        
            $setsupp['dlgBindId']="suppliers";
            $setsupp['dlgRetFunc']="$('#supplier_number').val(row.supplier_number);
            $('#supplier_name').html(row.supplier_name);
            ";
            if($param){
                if(isset($param['dlgRetFunc'])){
                    $setsupp['dlgRetFunc']=$param['dlgRetFunc'];
                }
            }
            $setsupp['dlgCols']=array( 
                        array("fieldname"=>"supplier_name","caption"=>"Nama Supplier","width"=>"180px"),
                        array("fieldname"=>"supplier_number","caption"=>"Kode","width"=>"80px"),
                        array("fieldname"=>"first_name","caption"=>"Kontak","width"=>"50px"),
                        array("fieldname"=>"city","caption"=>"Kota","width"=>"200px")
                    );          
        return $this->list_of_values->render($setsupp);
        
    }
    function lookup_ex($offset=0,$limit=20,$order_column='supplier_number',$order_type='asc'){
        $search='';
        if(isset($_GET['search']))$search=$_GET['search'];
        $sql="select supplier_number,supplier_name,city  
            from ".cidt()."suppliers";
        if($search!=""){
           $sql=$sql." where (supplier_number like '%".$search."%' 
                or supplier_name like '%".$search."%')";
        }
        if(isset($_GET['search'])){
           echo browse_select($sql,'Search','supplier/lookup'
                   ,'supplier_number',$offset,$limit,$order_column,$order_type);
        } else {
           return browse_select($sql,'Search','supplier/lookup'
                   ,'supplier_number',$offset,$limit,$order_column,$order_type);
        }
    }

	function get_paged_list($limit=10,$offset=0,
	$order_column='',$order_type='asc')
	{
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
	    if(isset($data['acc_biaya'])){
            if($data['acc_biaya']=='')$data['acc_biaya']=0;
	    }
		
        if(!isset($data['create_date']))$data['create_date']=date('Y-m-d H:i:s');
        if(isset($data['create_date']))$data['create_date']= date('Y-m-d H:i:s', strtotime($data['create_date']));
        if(!isset($data['update_date']))$data['update_date']=date('Y-m-d H:i:s');
        if(isset($data['update_date']))$data['update_date']= date('Y-m-d H:i:s', strtotime($data['update_date']));

				
		return $this->db->insert($this->table_name,$data);
	}
	function update($id,$data){
		$this->db->where($this->primary_key,$id);
        
//        if(!isset($data['create_date']))$data['create_date']=date('Y-m-d H:i:s');
//        $data['create_date']= date('Y-m-d H:i:s', strtotime($data['create_date']));
        if(!isset($data['update_date'])){
            $data['update_date']=date('Y-m-d H:i:s');
            $data['create_date']=$data['update_date'];
        }
//        $data['update_date']= date('Y-m-d H:i:s', strtotime($data['update_date']));
        
		return $this->db->update($this->table_name,$data);
	}
	function delete($id){
		$cnt=0;
		$sql="select supplier_number from ".cidt()."qry_kartu_hutang 
			where supplier_number='$id' limit 1";
		 
		if($row=$this->db->query($sql)->row()){
			 
			$cnt=$row->supplier_number!=""?1:0;
		} 
		if($cnt==0){
			$this->db->where($this->primary_key,$id);
			$this->db->delete($this->table_name);
		} 
		return $cnt;
	}
    function info($id){
        $data=$this->get_by_id($id)->row();
        if(count($data)){    
            $ret='<strong>'.$id.' - '.$data->supplier_name.'</strong> - '
                    .$data->street.' '.$data->city;
        } else $ret='';
        return $ret;
    }
	function saldo_hutang_summary_old()
	{
		$sql="select s.supplier_number,sum(p.amount) as sum_amount 
		from ".cidt()."purchase_order p
		left join ".cidt()."suppliers s on s.supplier_number=p.supplier_number
		where potype='I' and p.supplier_number<>'cash'
		group by p.supplier_number
		order by sum(p.amount) desc
		limit 0,10";
		$query=$this->db->query($sql);
		foreach($query->result() as $row){
			$supp=$row->supplier_number;
			if($supp=="")$supp="Unknown";
			$amount=$row->sum_amount;
			if($amount==null)$amount=0;
			if($amount>0)$amount=round($amount/1000);
			$data[$supp]=$amount;
		}
		//var_dump($data);
		return $data;
	}
	function saldo_hutang_summary()
	{
		$sql="select s.supplier_number,sum(p.amount) as sum_amount 
		from ".cidt()."purchase_order p
		left join ".cidt()."suppliers s on s.supplier_number=p.supplier_number
		where potype='I'  and p.supplier_number<>'cash'
		group by p.supplier_number
		order by sum(p.amount) desc
		limit 0,10";
		$query=$this->db->query($sql);
                $data=null;
		foreach($query->result() as $row){
			$supp=$row->supplier_number;
			if($supp=="")$supp="Unknown";
			$amount=$row->sum_amount;
			if($amount==null)$amount=0;
			if($amount>0)$amount=round($amount/1000);
			$data[]=array(substr($supp,0,10),$amount);
		}
		return $data;
	}
	function saldo($supplier_number){
		$sql="select sum(amount) as z_amt from ".cidt()."qry_kartu_hutang where supplier_number='$supplier_number'";
		return $this->db->query($sql)->row()->z_amt;
	}
	function valueof($ret_field,$search){
		$retval='';
		if($query=$this->db->select($ret_field)->where('supplier_number',$search)->get($this->table_name)){
			if($row=$query->row_array()){
				$retval=$row[$ret_field];
			}
		}
		return $retval;
	}
    function exist($id){
       return $this->db->count_all($this->table_name." where supplier_number='".$id."'")>0;
    }
	
}
