<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $CI->load->model("shipping_locations_model");
     $CI->load->model("invoice_model");
       
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
    $date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
    $date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $outlet=$CI->input->post('text1');
    $salesman=$CI->input->post('text2');
    //$outlet=current_gudang();
    $outlet_name=$CI->shipping_locations_model->outlet($outlet);
    
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
        <td><h2>PENJUALAN PER KASIR</h2></td>        
     </tr>
     <tr>
        <td colspan='2'>Outlet: <?=$outlet.'-'.$outlet_name?></td><td></td>         
     </tr>
     <tr>
        <td>
        Tanggal: <?=$date1?> s/d : <?=$date2?>, Kasir: <?=$salesman?>
        </td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
        <td colspan="8">
                <table class='titem'>
                <thead>
                    <tr><td>Nomor Faktur</td><td>Tanggal</td>
                        <td>Jumlah</td><td>Customer</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                $logged_in=$this->session->userdata('logged_in');
                if($logged_in['flag1']=='1'){
                    //$sql.=" and salesman='".$logged_in['username']."'";
                }
                            
                $sql="select salesman from invoice 
                    where invoice_date between '$date1' and '$date2' 
                    and invoice_type='I'";
                if($outlet!="")$sql.="  and warehouse_code='$outlet'";
                if($salesman!="")$sql.=" and salesman='$salesman'";
                $sql.=" group by salesman";

                    echo $sql;
                
                $qinv=$CI->db->query($sql);
                $tbl="";
                foreach($qinv->result() as $rinv){
                         
                   $tbl.="<tr><td colspan=3><strong>Kasir/Sales: $rinv->salesman</strng></td></tr>";
                    
                    $sql="select i.invoice_number,i.invoice_date,i.amount,c.company 
                    from invoice i 
                    left join customers c on c.customer_number=i.sold_to_customer                     
                    where invoice_date between '$date1' and '$date2' 
                    and invoice_type='i'";
                    if($outlet!="")$sql.=" and i.warehouse_code='$outlet'";
                    $sql.=" and i.salesman='$rinv->salesman'";
//                    if($text2!="")$sql.=" and i.sold_to_customer='" . $text2 . "'";
                    $sql.=" order by i.invoice_number";
                    
					
                    $rst_so=$CI->db->query($sql);
                    
                    $z_amount=0;      
                    foreach($rst_so->result() as $row ){
                         
                        $warehouse_code=$CI->invoice_model->warehouse($row->invoice_number);
    
                        if($outlet==$warehouse_code || $outlet==''){                     
                            $tbl.="<tr>";
                            $tbl.="<td>".$row->invoice_number."</td>";
                            $tbl.="<td>".$row->invoice_date."</td>";
                            $tbl.="<td align='right'>".number_format($row->amount)."</td>";
                            $tbl.="<td>".$row->company."</td>";
                            $tbl.="</tr>";
                            $z_amount=$z_amount+$row->amount;
                        }
                    };
                    $tbl.= "<tr><td><h4>Sub Total : $rinv->salesman</h4></td>
                    <td></td>
                    <td align='right'><strong>".number_format($z_amount)."</strong></td>
                    </tr>";
                   
                   $tbl.="<tr><td><strong>TOTAL</strong></td><td></td>
                            <td align='right'><strong>".number_format($z_amount)."</strong></td>
                            </tr>";
                   echo $tbl;
                                       
                }   //qinv
            ?>  
                </tbody>
            </table>
        
        </td>
     </tr>
</table>
