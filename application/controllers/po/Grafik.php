<?php
class Grafik extends CI_Controller {
    function __construct()
    {
        parent::__construct();        
         
        $this->load->helper(array('url','form','mylib_helper'));
        $this->load->library('template');
        $this->load->model('supplier_model');

    }
    function grafik_saldo_hutang(){
        header('Content-type: application/json');
        $data['label']="Saldo Hutang";
        $data['data']=$this->supplier_model->saldo_hutang_summary();
        echo json_encode($data);            
    } 
    function trend_pembelian()
    {
            $sql="select DATE_FORMAT(`po_date`,'%Y-%m') as prd,
            sum(p.amount) as sum_amount 
            from purchase_order p
            where potype='I' and year(p.po_date)=".date('Y')."
            group by DATE_FORMAT(`po_date`,'%Y-%m')
             
            limit 0,10";
            $query=$this->db->query($sql);
            $data=null;
            foreach($query->result() as $row){
                    $prd=$row->prd;
                    if($prd=="")$prd="00-00";
                    $amount=$row->sum_amount;
                    if($amount==null)$amount=0;
                    if($amount>0)$amount=round($amount/1000);
                    $data[]=array($prd,$amount);
            }
            return $data;
    }    
    function grafik_pembelian(){
        header('Content-type: application/json');
        $data['label']="Trend Pembelian";
        $data['data']=$this->trend_pembelian();
        echo json_encode($data);            
    }        
}
?>
