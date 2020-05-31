<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Alert
{
	private $message="";
 function __construct()
 {
     $this->CI =& get_instance();             
	 
  }
  function message_text(){
  	return $this->message;
  }
 function process(){
     $this->po_expired();
     $this->faktur_beli_jatuh_tempo();
 }
 function faktur_beli_jatuh_tempo(){
 	 $this->message.="\r start: faktur_beli_jatuh_tempo()";
	 
     $today=date("Y-m-d");
     $s="select purchase_order_number,po_date,due_date,supplier_number 
     from purchase_order 
     where potype='I' and due_date<'$today' order by due_date desc limit 100";
     $q=$this->CI->db->query($s);
     foreach($q->result() as $row){
         $nDay=my_date_diff($row->due_date,date("Y-m-d"));
         $nTerminDay=0;
         $supplier_name="";
         if($qsupp=$this->CI->db->select("supplier_name,termin_day")->where("supplier_number",$row->supplier_number)
            ->get("suppliers")){
                if($rsupp=$qsupp->row()){
                    $nTerminDay=$rsupp->termin_day;
                    $supplier_name=$rsupp->supplier_name;
                }
            }
         $hari=$nDay-$nTerminDay;
         if($hari<0){
             $judul="Faktur Jatuh Tempo dalam [$hari] hari lagi.: $row->purchase_order_number";
             inbox_send("system", "admin", $judul, 
             "Faktur: $row->purchase_order_number
             <br>Supplier : $supplier_name
             <br>Tanggal Faktur: $row->po_date, 
             <br>Tanggal Jatuh Tempo : $row->due_date 
             <br>Seting Alert: $nTerminDay sebelum expire 
             <br>Harus dibayar [$hari] hari lagi.
             <br>",
             $row->purchase_order_number,'faktur_beli');
             
         }
         
     }
     $this->message.="--stop";
 }
 function po_expired(){
    $potype=getvar("PoType","O");

 	$this->message.="start: po_expired()";
     $today=date("Y-m-d");
     $s="select purchase_order_number,po_date,po_expire_date,doc_status 
     from purchase_order 
     where potype='$potype' and po_expire_date<'$today' order by po_expire_date limit 100";
     $q=$this->CI->db->query($s);
     foreach($q->result() as $row){
         $nDay=my_date_diff($row->po_expire_date,date("Y-m-d"));
         $status=$row->doc_status; 
         $judul="PO Expired: $row->purchase_order_number";
         if($status=="CANCELED")$judul.=", Status: $status";
         inbox_send("system", "admin", $judul, 
         "PO Number: $row->purchase_order_number
         <br>Po Date: $row->po_date, <br>Expire: $row->po_expire_date 
         <br>Day: $nDay
         <br>",
         $row->purchase_order_number,'PO');
         
     }
     $this->message.="--stop";
 }
 
}
     