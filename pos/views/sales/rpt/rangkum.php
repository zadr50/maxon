<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $CI->load->model("shipping_locations_model");
     $CI->load->model("invoice_model");
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
    $date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
    $date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $outlet=$CI->input->post("text1");
//    $outlet=current_gudang();
    $outlet_name="";
    if($outlet!="")$outlet_name=$CI->shipping_locations_model->outlet($outlet);
    
    $outlet_name="";
    $company_name="";
    if($outlet!=""){
        if($qgdg=$CI->shipping_locations_model->get_by_id($outlet)){
            if($gdg=$qgdg->row()){
                $outlet_name=$gdg->attention_name;
                $company_code=$gdg->company_name;
                if($company_code!=""){
                    if($qcom=$CI->db->query("select company_name from preferences 
                        where company_code='$company_code' ")){
                            if($rcom=$qcom->row()){
                                $company_name=$rcom->company_name;
                            }
                        }
                }
                
            }
        }
        if($outlet_name==""){
            $outlet_name=$CI->shipping_locations_model->outlet($outlet);            
        }
    }

    
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<div>
<?php     
$nota_cnt=0;    $amt_nota=0;    $gross=0;   $disc_item_amt=0;   $disc_item_amt_aft=0;
$disc_nota=0;   $tax_nota=0;    $other=0;   $net_sales=0;       
$cash_cnt=0;    $cash=0;        $voucher_cnt=0;     $voucher=0;
$on_acc_cnt=0;  $on_acc=0;      $giro_cnt=0;        $giro=0;
$comp_cnt=0;    $comp=0;        $disc_pay_cnt=0;    $disc_pay=0;
$pbulat_cnt=0;  $pbulat=0;      $unpaid_cnt=0;      $unpaid=0;
$pay_total=0;   $void_cnt=0;    $void=0;
$kas_in=0;      $kas_out=0;     $kas_akhir=0;
if($row=$this->db->query("select count(1) as z_cnt,sum(amount) as z_amt,
    sum(disc_amount_1) as z_disc_amt,sum(tax) as z_tax,sum(other) as z_other 
    from invoice where invoice_type='I' 
    and invoice_date between  '$date1' and '$date2' 
    and warehouse_code='$outlet' ")->row()){
        $nota_cnt=$row->z_cnt;
        $amt_nota=$row->z_amt;
        $disc_nota=$row->z_disc_amt;
        $tax_nota=$row->z_tax;
        $other=$row->z_other;
        $net_sales=$amt_nota;
}
if($row=$this->db->query("select count(1) as z_cnt,sum(amount) as z_amt 
    from invoice where invoice_type='I' 
    and invoice_date between  '$date1' and '$date2' and (paid is null or paid=0)
    and warehouse_code='$outlet' ")->row()){
        $unpaid_cnt=$row->z_cnt;
        $unpaid=$row->z_amt;
}
if($row=$this->db->query("select count(1) as z_cnt,sum(amount) as z_amt 
    from invoice where invoice_type='I' and payment_terms = 'CANCELED'
    and invoice_date between  '$date1' and '$date2' and warehouse_code='$outlet' ")->row()){
        $void_cnt=$row->z_cnt;
        $void=$row->z_amt;
}

if($row=$this->db->query("select sum(il.amount) as z_amt, sum(il.discount_amount) as z_disc1, 
    sum(il.disc_amount_2) as z_disc2,sum(il.disc_amount_3) as z_disc3,
    sum(il.disc_amount_ex) as z_disc_rp 
    from invoice_lineitems il 
    left join invoice i on i.invoice_number=il.invoice_number 
    where i.invoice_type='I' and i.invoice_date between '$date1' and '$date2' 
    and i.warehouse_code='$outlet' ")->row()){
        $disc_item_amt=$row->z_disc1+$row->z_disc2+$row->z_disc3+$row->z_disc_rp;
        $disc_item_amt_aft=$row->z_amt;
        $gross=$disc_item_amt_aft+$disc_item_amt;
    } 
$pays=$this->db->query("select p.how_paid, 
    credit_card_type,
    count(1) as z_cnt, 
    sum(amount_paid) as z_amount
    from payments p left join invoice i on i.invoice_number=p.invoice_number
    where invoice_type='I' and i.invoice_date between '$date1' and '$date2' 
    and i.warehouse_code='$outlet' 
    group by p.how_paid, p.credit_card_type");
$kas_in=$this->db->query("select sum(jumlah) as z_amt 
    from kas_kasir where tanggal between '$date1' and '$date2' 
    and jumlah>0 and kasir='".user_id()."' ")->row()->z_amt;
$kas_out=$this->db->query("select sum(jumlah) as z_amt 
    from kas_kasir where tanggal between '$date1' and '$date2' 
    and jumlah<0 and kasir='".user_id()."' ")->row()->z_amt;
    
?>    
<table width=400>
<tr><td><trong>RANGKUMAN PENJUALAN</strong></td></tr>
<tr><td>Criteria: <?=$date1?></td></tr>
<tr><td>s/d : <?=$date2?></td></tr>
<tr><td>Outlet: <?=$outlet?> - <?=$outlet_name?></td></tr>
<tr><td>Perusahaan: <?=$company_name?></td></tr>
<tr><td colspan=2>--------------------------------------</td></tr>                                 
<tr><td>Jumlah Nota [<?=$nota_cnt?>]</td><td align='right'><?=number_format($amt_nota)?></td></tr>                             
<tr><td>Gross Sales</td><td align='right'><?=number_format($gross)?></td></tr>                             
<tr><td>- Discount Item</td><td align='right'><?=number_format($disc_item_amt)?></td></tr>                             
<tr><td>Aft.Disc.Item</td><td align='right'><?=number_format($disc_item_amt_aft)?></td></tr>                            
<tr><td>- Discount Nota</td><td align='right'><?=number_format($disc_nota)?></td></tr>                             
<tr><td>+ Tax</td><td align='right'><?=number_format($tax_nota)?></td></tr>                             
<tr><td>+ Other</td><td align='right'><?=number_format($other)?></td></tr>                            
<tr><td colspan=2>--------------------------------------</td></tr>                                 
<tr><td>Net Sales</td><td align='right'><?=number_format($net_sales)?></td></tr>                             
<tr><td></td><td></td></tr>
<tr><td>Payment Info</td><td></td></tr>           
<tr><td colspan=2>--------------------------------------</td></tr>                                 
<?php 
    foreach($pays->result() as $rpay){
        $how=$rpay->how_paid;
        $how2="";
        if($how=="CREDITCARD" || $how=="CARD"){
            $how2=$rpay->credit_card_type;
            if($q=$this->db->where("bank_account_number",$how2)->get("bank_accounts")){
                if($r=$q->row()){
                    if($r->bank_name!=""){
                        $how2=substr($r->bank_name,0,10)." *".substr($how2,-5);
                    }
                }
            }
        }
        if($how2!="")$how=$how2;
        if($how=="CASH")$cash+=$rpay->z_amount;
        echo "<tr><td>$how [$rpay->z_cnt] </td><td align='right'>".number_format($rpay->z_amount)."</td></tr>";
        $pay_total+=$rpay->z_amount;
    }
    $kas_akhir=$kas_in+$kas_out+$cash;
    
?>
<tr><td colspan=2>--------------------------------------</td></tr>                                 
<tr><td>Total Payment</td><td align='right'><?=number_format($pay_total)?></td></tr>                             
<tr><td></td><td></td></tr>
<tr><td>Void Nota [<?=$void_cnt?>]</td><td align='right'><?=number_format($void)?></td></tr>                             
<tr><td>UnPaid Nota [<?=$unpaid_cnt?>]</td><td align='right'><?=number_format($unpaid)?></td></tr>                             
<tr><td></td><td></td></tr>
<tr><td>Kas Awal/Lainya</td><td align='right'><?=number_format($kas_in)?></td></tr>                             
<tr><td>Pengambilan</td><td align='right'><?=number_format($kas_out)?></td></tr>                             
<tr><td>Bayar Cash</td><td align='right'><?=number_format($cash)?></td></tr>                             
<tr><td colspan=2>--------------------------------------</td></tr>                                 
<tr><td>Kas Akhir</td><td align='right'><?=number_format($kas_akhir)?></td></tr>                             
<tr><td colspan=2>--------------------------------------</td></tr>                                 
    
</table>    


</div>

