<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Sales_graph extends CI_Controller {

    function __construct()    {
        parent::__construct();        
        $this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('sysvar');
        $this->load->library('template');
        $this->load->library('form_validation');
    }
    function index()    {	
		$data['caption']="";
	}
	function wilayah_category_graph(){
		$data=$this->input->get();
		$date1=$data['date1'];
		$date2=$data['date2'];
		$region=$data['region'];
		
			header('Content-type: application/json');
			$data['label']="Sales By Area";
			$category="";
			$salesman="";
			$outlet="";
			
			$sql="select cat.category as kode, sum(il.amount) as amount
				 from invoice i left join customers c on c.customer_number=i.sold_to_customer
				 left join invoice_lineitems il on il.invoice_number=i.invoice_number
				 left join inventory stk on stk.item_number=il.item_number
				 left join inventory_categories cat on cat.kode=stk.category
				 left join region r on r.region_id=c.region     			 
		        where ";
	        $sql.="i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  ";
				
	        if($category!="")$sql.=" and stk.category='$category'";
	        
			
			if($salesman!="")$sql.=" and i.salesman='$salesman'";
	        if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
	        if($region!="")$sql.=" and c.region='$region'";
			
			$sql.=" group by cat.category";
			
			$query=$this->db->query($sql);
			$data2[0]=0;
			foreach($query->result() as $row){
				$kode=$row->kode;
				if($kode=="")$kode="N/A";
				$amount=$row->amount;
				if($amount==null)$amount=0;
				if($amount>0)$amount=round($amount/1000000);
				$data2[]=array(substr($kode,0,10),$amount);
			}
			$data['data']=$data2;
			
			echo json_encode($data);					
		
	}
	
	function wilayah_graph(){

			header('Content-type: application/json');
			$data['label']="Sales By Area";
			$category="";
			$salesman="";
			$outlet="";
			$region="";
			
			$sql="select r.region_name as kode, sum(il.amount) as amount
				 from invoice i left join customers c on c.customer_number=i.sold_to_customer
				 left join invoice_lineitems il on il.invoice_number=i.invoice_number
				 left join inventory stk on stk.item_number=il.item_number
				 left join inventory_categories cat on cat.kode=stk.category
				 left join region r on r.region_id=c.region     			 
		        where 1=1 ";
				
	        if($category!="")$sql.=" and stk.category='$category'";
	        
	        //$sql.="i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  ";
			
			if($salesman!="")$sql.=" and i.salesman='$salesman'";
	        if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
	        if($region!="")$sql.=" and c.region='$region'";
			
			$sql.=" group by r.region_name";
			
			$query=$this->db->query($sql);
			$data2[0]=0;
			foreach($query->result() as $row){
				$kode=$row->kode;
				if($kode=="")$kode="N/A";
				$amount=$row->amount;
				if($amount==null)$amount=0;
				if($amount>0)$amount=round($amount/1000000);
				$data2[]=array(substr($kode,0,10),$amount);
			}
			$data['data']=$data2;
			
			echo json_encode($data);					
		
	}
	function wilayah(){
		$this->load->model("region_model");
			$data['caption']="Grafik Penjualan";
			$data['date1']=date("Y-m-1");
			$data['date2']=date("Y-m-d H:i:s");
             $data['lookup_region']=$this->region_model->list_region();
					
			$this->template->display("sales/rpt/sls_graf_wil_item",$data);
	}
	function category(){
		$this->load->model("category_model");
			$data['caption']="Grafik Penjualan Category";
			$data['date1']=date("Y-m-1");
			$data['date2']=date("Y-m-d H:i:s");
             $data['lookup_category']=$this->category_model->datalist();
					
			$this->template->display("sales/rpt/sls_graf_category",$data);
	}
	function category_graph(){
		$data=$this->input->get();
		$date1=$data['date1'];
		$date2=$data['date2'];
		$category=$data['region'];
		
			header('Content-type: application/json');
			$data['label']="Sales By Category";
			//$category="";
			$salesman="";
			$outlet="";
			
			$sql="select stk.sub_category as kode, year(i.invoice_date) as tahun,
				month(i.invoice_date) as bulan, 
				sum(il.amount) as amount
				 from invoice i left join customers c on c.customer_number=i.sold_to_customer
				 left join invoice_lineitems il on il.invoice_number=i.invoice_number
				 left join inventory stk on stk.item_number=il.item_number
				 left join inventory_categories cat on cat.kode=stk.category
		        where ";
		        
	        $sql.="i.invoice_type='I' and i.invoice_date between '$date1' and '$date2'  ";
				
	        if($category!="")$sql.=" and stk.category='$category'";
	        
			
			if($salesman!="")$sql.=" and i.salesman='$salesman'";
	        if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
			
			$sql.=" group by stk.sub_category,year(i.invoice_date),month(i.invoice_date)";
			
		//echo $sql;
			 
			
			$query=$this->db->query($sql);
			$data2[0]=0;
			foreach($query->result() as $row){
				$kode=$row->kode;
				if($kode=="")$kode="N/A";
				$periode=$row->tahun."-".$row->bulan;
				$amount=$row->amount;
				if($amount==null)$amount=0;
				//if($amount>0)$amount=round($amount/1000000);
				$data2[]=array($kode." [$periode]",$amount);
			}
			$data['data']=$data2;
			
			echo json_encode($data);					
		
	}
	
	
}