<?php
 $CI =& get_instance();
 if(!$CI->input->post('cmdPrint')){

    $data['caption']='LAPORAN AKUMULASI STOCK GABUNGAN';
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
    $data['text3']=current_gudang();
    $data['key3']='location_number';
    $data['output3']="text3";
    $data['fields3'][]=array("location_number","80","Kode");
    $data['fields3'][]=array("attention_nme","180","Gudang");
    $data['ctr3']='lookup/query/warehouse';
    
    $data['rpt_controller']="inventory/rpt/$id";
    $CI->template->display_form_input('criteria',$data,'');
} else {    
    $CI->load->model('company_model');
    $model=$CI->company_model->get_by_id($CI->access->cid)->row();
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
        <td colspan='2'><h2>LAPORAN AKUMULASI STOCK GABUNGAN</h2></td>      
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
                <td>Kode Supplier</td><td>Nama Supplier</td><td>Qty</td>
                <td align=right>Total Beli</td><td align=right>Total Jual</td>
                <td align=right>Margin%</td>
            </tr>
        </thead>
        <tbody>
                <?php
                $sql="select i.supplier_number,s.supplier_name,
                sum(q.qty_masuk)-sum(q.qty_keluar) as z_qty,
                (sum(q.qty_masuk)-sum(q.qty_keluar))*i.cost_from_mfg as z_beli,
                (sum(q.qty_masuk)-sum(q.qty_keluar))*i.retail as z_jual
                from inventory i left join suppliers s on s.supplier_number=i.supplier_number 
                left join qry_kartustock_union  q on q.item_number=i.item_number
                where q.tanggal<='$date2' ";
                    
                if($sistim!="")$sql.=" and i.type_of_invoice='$sistim'";    
                if($supplier!="")$sql.=" and i.supplier_number='$supplier'";
                if($outlet!="")$sql.=" and q.gudang='$outlet' ";
                $sql.=" group by i.supplier_number,s.supplier_name ";
                                
                $rst_item=$CI->db->query($sql);
                $tbl="";

                $beli_amt_ttl=0;         $jual_amt_ttl=0;
                $qty_akhir_ttl=0;
                
                foreach($rst_item->result() as $row){
                    $item_number="";
                    $qty_akhir=$row->z_qty;
                    $beli_amt=$row->z_beli;
                    $jual_amt=$row->z_jual;
                    $margin=0;
                    if($jual_amt>0)$margin=($beli_amt/$jual_amt)*100;                    
                        
                    $qty_akhir_ttl+=$qty_akhir;
                    $beli_amt_ttl+=$beli_amt;
                    $jual_amt_ttl+=$jual_amt;
                        
                    $tbl.="<tr>";
                    $tbl.="<td>$row->supplier_number</td>";
                    $tbl.="<td>$row->supplier_name</td>";
                    $tbl.="<td align='right'>".number_format($qty_akhir)."</td>";
                    $tbl.="<td align='right'>".number_format($beli_amt)."</td>";
                    $tbl.="<td align='right'>".number_format($jual_amt)."</td>";
                    $tbl.="<td align='right'>".number_format($margin)."</td>";
                    $tbl.="</tr>";
                }
            $tbl.="
            <tr><td><strong>TOTAL</strong></td><td></td>
                <td align=right>".number_format($qty_akhir_ttl)."</td>
                <td align=right>".number_format($beli_amt_ttl)."</td>
                <td align=right>".number_format($jual_amt_ttl)."</td>
            </tr>";

                echo $tbl;
                 
                ?>
        

        </tbody>
        </table>
        
        </td>
     </tr>
</table>
    <?php } ?>