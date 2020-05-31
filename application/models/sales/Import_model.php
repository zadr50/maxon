<?php
class Import_model extends CI_Model {

	function __construct(){
		parent::__construct();        
       
        
	}
	function process_row($row){
	    $row2=str_replace("\"","",$row[0]);
		$data=explode(",",$row2);
		$code=$data[0];
		switch($code)
		{
		case("PR"):
			//kode perusahaan
			$this->import_row_perusahaan($data);
			break;
		case ("CT"):
			//kode pelanggan
			$this->import_row_pelanggan($data);
			break;
		case ("ST"):
			//kode barang
			$this->import_row_barang($data);
			break;
		case ("IN"):
			//nomor faktur
			$this->import_row_faktur($data);
			break;
		case ("IL"):
			//item faktur
			$this->import_row_faktur_item($data);
			break;
		case ("PA"):
			//payment faktur
			$this->import_row_payment($data);
			break;

		}
	}
	function import_row_perusahaan($row){
		//"PR","MYPOS","Sample Company","MyPOS Retail System","Baghdad Square - Royal Park","Ph. 021-200022","Ph: 0264-20123234"
		
	}
	function import_row_pelanggan($row){
		//"CT","CUSTOMER_NUMBER","COMPANY","STREET","SUITE","CITY","SALESMAN"
		$this->db->where("customer_number",$row[1]);
		$q=$this->db->get("customers");
		if($q->num_rows()>0){
			return false;
		}
		$data=array("customer_number"=>$row[1],"company"=>$row[2],
				"street"=>$row[3],"suite"=>$row[4],"city"=>$row[5],
				"salesman"=>$row[6]
			);
		return $this->db->insert("customers",$data);
	}
	function import_row_barang($row){
		///"ST","ITEM_NUMBER","DESCRIPTION","CATEGORY","RETAIL","COST","SUPPLIER_NUMBER","UNIT_OF_MEASURE"
		$this->db->where("item_number",$row[1]);
		$q=$this->db->get("inventory");
		if($q->num_rows()>0){
			return false;
		}
		$data=array("item_number"=>$row[1],"description"=>$row[2],
				"category"=>$row[3],"retail"=>$row[4],"cost"=>$row[5],
				"supplier_number"=>$row[6],"unit_of_measure"=>$row[7]
			);
		return $this->db->insert("inventory",$data);

	}
	function import_row_faktur($row){
		//"IN","INVOICE_NUMBER","INVOICE_DATE","SOLD_TO_CUSTOMER","PAYMENT_TERMS",
		//"INVOICE_TYPE","SALESMAN","INV_AMOUNT"
		$this->db->where("invoice_number",$row[1]);
		$q=$this->db->get("invoice");
		$cnt=$q->num_rows();
		$data=array("invoice_number"=>$row[1],"invoice_date"=>$row[2],
				"sold_to_customer"=>$row[3],"payment_terms"=>$row[4],
				"invoice_type"=>$row[5],"salesman"=>$row[6],
				"amount"=>$row[7],"inv_amount"=>$row[7]
			);
        if($cnt>0){
//          return false;
            unset($data["invoice_number"]);
            return $this->db->where("invoice_number",$row[1])->update("invoice",$data);
        } else {
            return $this->db->insert("invoice",$data);
        }
        

	}
	function import_row_faktur_item($row){
		//"IL","INVOICE_NUMBER","ITEM_NUMBER","DESCRIPTION","QUANTITY","UNIT",
		//"PRICE","COST","MULTI_UNIT","MU_QTY","MU_HARGA","AMOUNT","LINE_NUMBER"
		$this->db->where("line_number",$row[12]);
		$q=$this->db->get("invoice_lineitems");
		$data=array("invoice_number"=>$row[1],"item_number"=>$row[2],
				"description"=>$row[3],"quantity"=>$row[4],"unit"=>$row[5],
				"price"=>$row[6],"cost"=>$row[7],"multi_unit"=>$row[8],
				"mu_qty"=>$row[9],"mu_harga"=>$row[10],"amount"=>$row[11],
				"line_number"=>$row[12]
			);
        if($q->num_rows()>0){
            unset($data['line_number']);
            return $this->db->where("line_number",$row[1])->update("invoice_lineitems",$data);
        } else {
			return $this->db->insert("invoice_lineitems",$data);
        }
	}
	function import_row_payment($row){
		//"PA","INVOICE_NUMBER","DATE_PAID","HOW_PAID","AMOUNT_PAID","CREDIT_CARD_TYPE",
		//"AUTHORIZATION","LINE_NUMBER"
		$this->db->where("line_number",$row[9]);
		$q=$this->db->get("payments");
		$data=array("invoice_number"=>$row[1],"date_paid"=>$row[2],
				"how_paid"=>$row[3],"amount_paid"=>$row[4],"credit_card_type"=>$row[5],
				"credit_card_number"=>$row[6],"authorization"=>$row[7],
				"no_bukti"=>$row[8],"line_number"=>$row[9]
			);
        if($q->num_rows()>0){
            unset($data['line_number']);
            return $this->db->where("line_number",$row[9])->update("payments",$data);
        } else {
            return $this->db->insert("payments",$data);
            
            
        }
	}
	
		
}
