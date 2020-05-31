<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
     $cwq=$CI->db->where("voucher",$voucher)->get("check_writer");
     $trans_id=0;
     if($cw=$cwq->row()){
         $trans_id=$cw->trans_id;
     }

?>
<table cellspacing="0" cellpadding="1" border="0" width='100%'>     
     <tr>
            <td colspan=3><h2><?=$model->company_name?></h2>
     </tr>
     <tr>
            <td colspan=3><h2>KAS KELUAR</h2></td>      
     </tr>
     <tr>
        <td colspan=3><?=$model->street?></td><td></td>       
     </tr>
     <tr>
        <td colspan=3><?=$model->suite?></td>         
     </tr>
     <tr>
        <td colspan=3>
            <?=$model->city_state_zip_code?> - Phone: <?=$model->phone_number?>
        </td>
     </tr>
     <tr>
         <td>Voucher</td><td><?=$cw->voucher?></td>
     </tr>
     <tr>
         <td>Tanggal</td><td><?=$cw->check_date?></td>
     </tr>
     <tr>
         <td>Jumlah</td><td><?=number_format($cw->payment_amount,2)?></td>
     </tr>
     <tr>
         <td>Jenis</td><td><?=$cw->trans_type?></td>
     </tr>
     <tr>
         <td>Peneriman</td><td><?=$cw->payee." - ".$cw->supplier_number?></td>
     </tr>
     <tr>
         <td>Nomor Giro</td><td><?=$cw->check_number?></td>         
     </tr>
     <tr>
         <td>Memo</td><td><?=$cw->memo?></td>
     </tr>
     <tr>
         <td colspan=6>
            <table border=1>
                 <td><strong>Account</strong></td><td><strong>Description</strong></td>
                 <td align='right'><strong>Amount</strong></td>
                <?php
                    $sql="select cwi.*,coa.account,coa.account_description from check_writer_items cwi
                        left join chart_of_accounts coa on coa.id=cwi.account_id 
                        where cwi.trans_id='$trans_id'
                        ";
                     $total=0;
                     $cwi=$CI->db->query($sql);
                     foreach($cwi->result() as $cwi_item){
                        echo "<tr>";
                        echo "<td>$cwi_item->account</td><td>$cwi_item->account_description</td>
                                <td align='right'>".number_format($cwi_item->amount,2)."</td>";
                        echo "</tr>";
                        $total+=$cwi_item->amount;
                     }
                    
                
                ?>
                 <td><strong>Jumlah</strong></td><td><strong>&nbsp</strong></td>
                 <td align='right'><strong><?=number_format($total,2)?></strong></td>                
            </table>   
         </td>

     </tr>
     <tr>
         <td><strong>Penerima</strong></td><td></td>
         <td><strong>Mengetahui</strong></td>
     </tr>
</table>