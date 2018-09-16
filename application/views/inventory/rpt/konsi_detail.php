<?php
$CI =& get_instance();
$CI->load->model('company_model');
$CI->load->model('purchase_invoice_model');
$model=$CI->company_model->get_by_id($CI->access->cid)->row();
$caption='RINCIAN LAPORAN HUTANG KONSINYASI';
 
 if(!$CI->input->post('cmdPrint')){

    $data['caption']=$caption;
    $data['date_from']=date('Y-m-d 00:00:00');
    $data['date_to']=date('Y-m-d 23:59:59');
    $data['select_date']=true;
     
    $data['criteria1']=true;
    $data['label1']='Sistim';
    $data['text1']='3';
    
    $data['criteria2']=true;
    $data['label2']='Supplier';
    $data['text2']='';
    $data['key2']='supplier_number';
    $data['output2']="text2";
    $data['fields2'][]=array("supplier_number","80","Kode");
    $data['fields2'][]=array("supplier_name","180","Supplier");
    $data['ctr2']='lookup/query/suppliers';
    
    $data['criteria3']=true;
    $data['label3']='Outlet';
    $data['text3']='';
    $data['key3']='location_number';
    $data['output3']="text3";
    $data['fields3'][]=array("location_number","80","Kode");
    $data['fields3'][]=array("attention_nme","180","Gudang");
    $data['ctr3']='lookup/query/warehouse';
    
    $data['rpt_controller']="inventory/rpt/$id";
    $CI->template->display_form_input('criteria',$data,'');
} else {    
    $date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
    $date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $sistim = $CI->input->post('text1');
    $supplier = $CI->input->post('text2');
    $outlet = $CI->input->post('text3');
    $category="";
    
     $outlet_name="";
     if($outlet!=""){         
         if($q=$CI->db->where("location_number",$outlet)->get("shipping_locations")){
             if($r=$q->row()){
                 $outlet_name=$r->attention_name;
             }
         }
     }
    
?>

<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">

<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
        <td colspan='2'><h2><?=$caption?></h2></td>      
     </tr>
     <tr>
        <td colspan='2'><h2><?=$model->company_name?></h2></td>
         
     </tr>
     <tr>
        <td>
            Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Kelompok <?=$category?>
            ,Supplier: <?=$supplier?>, Sistim: <?=$sistim?>, Outlet: <?=$outlet.'-'.$outlet_name?>
        </td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
        <td colspan="8">
        <table class='titem'>
        <thead>
            <tr>
                <td rowspan=2>NO</td><td rowspan=2>KODE SUPPLIER</td>
                <td rowspan=2>NAMA SUPPLIER</td>
                <td colspan=2>TERJUAL</td>
                <td colspan=2>PLUS</td>
                <td colspan=2>KEHILANGAN</td>
                <td colspan=2>TOTAL</td>
                <td rowspan=2>LABEL</td>
                <td rowspan=2>TOTAL TERHUTANG</td>
                <td rowspan=2>PPN</td>
                <td rowspan=2>ADM</td>
                <td rowspan=2>HANG TAG TOKO 1(125/PC)</td>
                <td rowspan=2>HANG TAG TOKO 2(60/PC)</td>
                <td rowspan=2>BIAYA TRANSFER</td>
                <td rowspan=2>BIAYA PAKET</td>
                <td rowspan=2>LAIN-LAIN</td>
                <td rowspan=2>GRAND TOTAL TERHUTANG</td>
                <td colspan=2>KETERANGAN</td>
            </tr>
            <tr>
                
                <td>Pcs</td><td>Total Hrg Beli</td>
                <td>Pcs</td><td>Total Hrg Beli</td>
                <td>Pcs</td><td>Total Hrg Beli</td>
                <td>Pcs</td><td>Total Hrg Beli</td>
                <td>DPP</td>
                <td>LAIN-LAIN</td>                
            </tr>
        </thead>
        <tbody>
                <?php
                $sql="select i.supplier_number,s.supplier_name 
                from inventory i left join suppliers s on s.supplier_number=i.supplier_number 
                left join qry_kartustock_union  q on q.item_number=i.item_number
                where q.tanggal between '$date1' and '$date2' ";
                    
                if($sistim!="")$sql.=" and i.type_of_invoice='$sistim'";    
                if($supplier!="")$sql.=" and i.supplier_number='$supplier'";
                if($outlet!="")$sql.=" and q.gudang='$outlet' ";
                $sql.=" group by i.supplier_number";
                                
                $rst_item=$CI->db->query($sql);
                $tbl="";

                $beli_amt_ttl=0;         $jual_amt_ttl=0;
                $qty_akhir_ttl=0;
                $nomor=0;
                $beli_amt=0;
                    $jual_amt=0;
                    $hilang_amt=0;
                    $jbh_tot_amt=0;
                    $label_amt=0;
                    $hut_tot_amt=0;
                    $ppn_amt=0;
                    $admin_amt=0;
                    $htag1_amt=0;
                    $htag2_amt=0;
                    $tran_amt=0;
                    $paket_amt=0;
                    $lain_amt=0;
                    $gth_amt=0;
                    $ket_dpp_amt=0;
                    $ket_lain_amt=0;
                
                
                foreach($rst_item->result() as $row){
                    $nomor++;
                    $item_number="";
                    $supplier=$row->supplier_number;
                    
                    $jual=$CI->inventory_model->qty_jual_gab($item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $beli=$CI->inventory_model->qty_beli_gab($item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $hilang=$CI->inventory_model->qty_hilang_gab($item_number,$date1,$date2,$supplier,$outlet,$category,$sistim);
                    $label=$CI->purchase_invoice_model->biaya_label_amount($date1,$date2,$supplier,$outlet,$category,$sistim);
                    $admin=$CI->purchase_invoice_model->biaya_admin_amount($date1,$date2,$supplier,$outlet,$category,$sistim);
                    $htag1=$CI->purchase_invoice_model->biaya_htag1_amount($date1,$date2,$supplier,$outlet,$category,$sistim);
                    $htag2=$CI->purchase_invoice_model->biaya_htag2_amount($date1,$date2,$supplier,$outlet,$category,$sistim);
                    $transfer=$CI->purchase_invoice_model->biaya_transfer_amount($date1,$date2,$supplier,$outlet,$category,$sistim);
                    $paket=$CI->purchase_invoice_model->biaya_paket_amount($date1,$date2,$supplier,$outlet,$category,$sistim);
                    $lain=$CI->purchase_invoice_model->biaya_lain_amount($date1,$date2,$supplier,$outlet,$category,$sistim);
                    $ppn=0;
                                        
                    $jbh_tot["qty"]=$beli['qty']-$jual['qty']+$hilang['qty'];
                    $jbh_tot["amount"]=$beli['amount']-$jual['amount']+$hilang['amount'];
                    $hut_tot=$jbh_tot['amount']-$label['amount'];
                                                            
                                                            
                    $tbl.="<tr>";
                    $tbl.="<td>$nomor</td>";
                    $tbl.="<td>$row->supplier_number</td>";
                    $tbl.="<td>$row->supplier_name</td>";
                    $tbl.="<td align='right'>".number_format($jual['qty'])."</td>";
                    $tbl.="<td align='right'>".number_format($jual['amount'])."</td>";
                    $tbl.="<td align='right'>".number_format($beli['qty'])."</td>";
                    $tbl.="<td align='right'>".number_format($beli['amount'])."</td>";
                    $tbl.="<td align='right'>".number_format($hilang['qty'])."</td>";
                    $tbl.="<td align='right'>".number_format($hilang['amount'])."</td>";
                    $tbl.="<td align='right'>".number_format($jbh_tot['qty'])."</td>";
                    $tbl.="<td align='right'>".number_format($jbh_tot['amount'])."</td>";
                    $tbl.="<td align='right'>".number_format($label['amount'])."</td>";
                    $tbl.="<td align='right'>".number_format($hut_tot)."</td>";
                    $tbl.="<td align='right'>".number_format($ppn)."</td>";
                    $tbl.="<td align='right'>".number_format($admin['amount'])."</td>";
                    $tbl.="<td align='right'>".number_format($htag1['amount'])."</td>";
                    $tbl.="<td align='right'>".number_format($htag2['amount'])."</td>";
                    $tbl.="<td align='right'>".number_format($transfer['amount'])."</td>";
                    $tbl.="<td align='right'>".number_format($paket['amount'])."</td>";
                    $tbl.="<td align='right'>".number_format($lain['amount'])."</td>";
                    
                    $gth=$hut_tot+$ppn-$admin['amount']-$htag1['amount']
                        -$htag2['amount']-$transfer['amount']-$paket['amount']
                        -$lain['amount'];
                    
                    $tbl.="<td align='right'>".number_format($gth)."</td>";
                    
                    $ket_dpp=0;
                    $ket_lain=0;
                    
                    $tbl.="<td align='right'>".number_format($ket_dpp)."</td>";
                    $tbl.="<td align='right'>".number_format($ket_lain)."</td>";

                    $beli_amt+=$beli['amount'];                    
                    $jual_amt+=$jual['amount'];
                    $hilang_amt+=$hilang['amount'];
                    $jbh_tot_amt+=$jbh_tot["amount"];
                    $label_amt+=$label["amount"];
                    $hut_tot_amt+=$hut_tot;
                    $ppn_amt+=$ppn;
                    $admin_amt+=$admin["amount"];
                    $htag1_amt+=$htag1["amount"];
                    $htag2_amt+=$htag2["amount"];
                    $tran_amt+=$transfer["amount"];
                    $paket_amt+=$paket["amount"];
                    $lain_amt+=$lain["amount"];
                    $gth_amt+=$gth;
                    $ket_dpp_amt+=$ket_dpp;
                    $ket_lain_amt+=$ket_lain;
                    
                    $tbl.="</tr>";
                }
            $tbl.="

            
            ";
            $tbl.="<tr>";
            $tbl.="<td></td>";
            $tbl.="<td></td>";
            $tbl.="<td></td>";
            $tbl.="<td align='right'>".number_format(0)."</td>";
            $tbl.="<td align='right'>".number_format($jual_amt)."</td>";
            $tbl.="<td align='right'>".number_format(0)."</td>";
            $tbl.="<td align='right'>".number_format($beli_amt)."</td>";
            $tbl.="<td align='right'>".number_format(0)."</td>";
            $tbl.="<td align='right'>".number_format($hilang_amt)."</td>";
            $tbl.="<td align='right'>".number_format(0)."</td>";
            $tbl.="<td align='right'>".number_format($jbh_tot_amt)."</td>";
            $tbl.="<td align='right'>".number_format($label_amt)."</td>";
            $tbl.="<td align='right'>".number_format($hut_tot_amt)."</td>";
            $tbl.="<td align='right'>".number_format($ppn_amt)."</td>";
            $tbl.="<td align='right'>".number_format($admin_amt)."</td>";
            $tbl.="<td align='right'>".number_format($htag1_amt)."</td>";
            $tbl.="<td align='right'>".number_format($htag2_amt)."</td>";
            $tbl.="<td align='right'>".number_format($tran_amt)."</td>";
            $tbl.="<td align='right'>".number_format($paket_amt)."</td>";
            $tbl.="<td align='right'>".number_format($lain_amt)."</td>";
            $tbl.="<td align='right'>".number_format($gth_amt)."</td>";
            $tbl.="<td align='right'>".number_format($ket_dpp_amt)."</td>";
            $tbl.="<td align='right'>".number_format($ket_lain_amt)."</td>";
                                
            
                echo $tbl;
                 
                ?>
        

        </tbody>
        </table>
        
        </td>
     </tr>
</table>
    <?php } ?>