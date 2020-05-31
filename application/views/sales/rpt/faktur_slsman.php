<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
    $CI->load->model('shipping_locations_model');
     
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
    $date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
    $date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $salesman=$CI->input->post("text1");
    $customer=$CI->input->post("text2");
    $outlet=$CI->input->post("text3");
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
        <td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>PENJUALAN PER SALESMAN</h2></td>         
     </tr>
     <tr>
        <td colspan='2'><?=$model->street?></td><td></td>       
     </tr>
     <tr>
        <td colspan='2'><?=$model->suite?></td>         
     </tr>
     <tr>
        <td>
            <?=$model->city_state_zip_code?> - Phone: <?=$model->phone_number?>
        </td>
     </tr>
     <tr>
        <td>
            Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?>
            Salesman: <?=$salesman?>, Customer: <?=$customer?>, 
            Outlet: <?=$outlet?>        </td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
        <td colspan="8">
                <table class='titem'>
                <thead>
                    <tr><td>Salesman</td><td>Tanggal</td><td>Nomor Faktur</td><td>Kode Pelanggan</td><td>Nama Pelanggan</td>
                        <td>Nomor SO</td><td>Termin</td><td>Jumlah</td>
                        <td>Payment</td><td>Retur</td><td>Cr Memo</td><td>Dr Memo</td>
                        <td>Saldo</td>
                    </tr>
                </thead>
                <tbody>
                <?
                $sql="select i.*,c.salesman as salesman_cust from qry_invoice i 
                join invoice i2 on i2.invoice_number=i.invoice_number
                join customers c on c.customer_number=i2.sold_to_customer
                where i.invoice_date between '$date1' and '$date2'  ";
                
                $logged_in=$this->session->userdata('logged_in');
                if($logged_in['flag1']!=''){
                    //$sql.=" and i.salesman='".$logged_in['username']."'";
                }
                
                if($salesman!="")$sql.=" and i.salesman='" . $salesman . "'";
                if($customer!="")$sql.=" and i.sold_to_customer='" . $customer . "'";
                if($outlet!="")$sql.=" and i2.warehouse_code='$outlet'";
                
                $sql.=" order by c.salesman,i.invoice_date,i.invoice_number";
                
                $rst_so=$CI->db->query($sql);
                $tbl="";
                $z_amount=0;        $z_payment=0;
                $z_retur=0;         $z_cr_amount=0;
                $z_db_amount=0;     $z_saldo=0;

                $z_amount_sls=0;$z_payment_sls=0;
                $z_retur_sls=0;$z_cr_amount_sls=0;
                $z_db_amount_sls=0;$z_saldo_sls=0;


                $old_sales="";
                $rows=$rst_so->result();
                 for($i=0;$i<count($rows);$i++){
                    $row=$rows[$i];
                    $old_sales=$row->salesman_cust;
                    $tbl.="<tr>";
                    $tbl.="<td>".$row->salesman_cust."</td>";
                    $tbl.="<td>".$row->invoice_date."</td>";
                    $tbl.="<td>".$row->invoice_number."</td>";
                    $tbl.="<td>".($row->sold_to_customer)."</td>";
                    $tbl.="<td>".$row->company."</td>";
                    $tbl.="<td>".$row->sales_order_number."</td>";
                    $tbl.="<td>".$row->payment_terms."</td>";
                    $tbl.="<td align='right'>".number_format($row->amount)."</td>";
                    $tbl.="<td align='right'>".number_format($row->payment)."</td>";
                    $tbl.="<td align='right'>".number_format($row->retur)."</td>";
                    $tbl.="<td align='right'>".number_format($row->cr_amount)."</td>";
                    $tbl.="<td align='right'>".number_format($row->db_amount)."</td>";
                    $saldo=$row->amount-$row->payment-$row->cr_amount+$row->db_amount;
                    $tbl.="<td align='right'>".number_format($saldo)."</td>";
                    $tbl.="</tr>";
                    $z_amount=$z_amount+$row->amount;
                    $z_payment=$z_payment+$row->payment;
                    $z_retur=$z_retur+$row->retur;
                    $z_cr_amount=$z_cr_amount+$row->cr_amount;
                    $z_db_amount=$z_db_amount+$row->db_amount;
                    $z_saldo=$z_saldo+$saldo;

                    $z_amount_sls=$z_amount_sls+$row->amount;
                    $z_payment_sls=$z_payment_sls+$row->payment;
                    $z_retur_sls=$z_retur_sls+$row->retur;
                    $z_cr_amount_sls=$z_cr_amount_sls+$row->cr_amount;
                    $z_db_amount_sls=$z_db_amount_sls+$row->db_amount;
                    $z_saldo_sls=$z_saldo_sls+$saldo;

                    if($i<count($rows)-1){
                        if($old_sales != $rows[$i+1]->salesman_cust){
                            $tbl.= "<tr><td><h4>Sub Total : ".$old_sales."</h4></td>
                            <td colspan='6'>
                            <td align='right'><h4>".number_format($z_amount_sls)."</h4></td>
                            <td align='right'><h4>".number_format($z_payment_sls)."</h4></td>
                            <td align='right'><h4>".number_format($z_retur_sls)."</h4></td>
                            <td align='right'><h4>".number_format($z_cr_amount_sls)."</h4></td>
                            <td align='right'><h4>".number_format($z_db_amount_sls)."</h4></td>
                            <td align='right'><h4>".number_format($z_saldo_sls)."</h4></td>
                            </tr>";
                            $z_amount_sls=0;$z_payment_sls=0;
                            $z_retur_sls=0;$z_cr_amount_sls=0;
                            $z_db_amount_sls=0;$z_saldo_sls=0;
                        }
                    }
               };
                $tbl.= "<tr><td><h4>Sub Total : ".$old_sales."</h4></td>
                <td></td><td></td><td></td><td></td><td></td><td></td>
                <td align='right'><h4>".number_format($z_amount_sls)."</h4></td>
                <td align='right'><h4>".number_format($z_payment_sls)."</h4></td>
                <td align='right'><h4>".number_format($z_retur_sls)."</h4></td>
                <td align='right'><h4>".number_format($z_cr_amount_sls)."</h4></td>
                <td align='right'><h4>".number_format($z_db_amount_sls)."</h4></td>
                <td align='right'><h4>".number_format($z_saldo_sls)."</h4></td>
                </tr>";
               
               $tbl.="<tr><td><h4>TOTAL</h4></td><td></td><td></td><td></td>
                        <td></td><td></td><td></td>
                        <td align='right'><h4>".number_format($z_amount)."</h4></td>
                        <td align='right'><h4>".number_format($z_payment)."</h4></td>
                        <td align='right'><h4>".number_format($z_retur)."</h4></td>
                        <td align='right'><h4>".number_format($z_cr_amount)."</h4></td>
                        <td align='right'><h4>".number_format($z_db_amount)."</h4></td>
                        <td align='right'><h4>".number_format($z_saldo)."</h4></td></tr>";
               echo $tbl;
                                                   
            ?>  
                </tbody>
            </table>
        
        </td>
     </tr>
</table>


