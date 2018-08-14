<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
     
     

    if(!$CI->input->post('cmdPrint')){
        
         $data['select_date']=true;        
         $data['date_from']=date('Y-m-d 00:00:00');
         $data['date_to']=date('Y-m-d 23:59:59');

        $data['criteria1']=true;
        $data['label1']='Rekening';
        $data['text1']='';
         $data['ctr1']='lookup/query/bank_accounts';
         $data['fields1'][]=array("bank_account_number","100","Rekening");
         $data['fields1'][]=array("bank_name","180","Bank Name");
         $data['output1']="text1";
         $data['key1']="bank_account_number";

        $data['rpt_controller']=$controller;
        
        
        $CI->template->display_form_input('criteria',$data,'');
        exit;
        
    } 
        
             
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
    $date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
    $date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $rek=$CI->input->post('text1');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
        <td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>MUTASI TRANSAKSI REKENING</h2></td>      
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
            Criteria: Dari Tanggal: <?=$date1?> s/d : <?=$date2?> Rekening: <?=$rek?>
        </td>
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
        <td colspan="8">
                <table class='titem'>
                <thead>
                    <tr><td>Tanggal</td><td>Voucher</td><td>Jenis</td><td>Masuk</td>
                       <td>Person</td><td>Memo</td>
                    </tr>
                </thead>
                <tbody>
                <?
                $sql="select bank_account_number,bank_name from bank_accounts ";
                
                if($rek!="")$sql.=" where bank_account_number='".$rek."'";
                
                $rst_bank=$CI->db->query($sql);
                
                foreach($rst_bank->result() as $r_bank){

                    $saldo=0;
                    
                    echo "<tr><td colspan='10'></td></tr>";
                    echo "<tr><td colspan='5'><h1>Rekening: ".$r_bank->bank_account_number
                    ." - ".$r_bank->bank_name."</h1></td><td align='right'></td><td></td><td></td></tr>";


                    
                    $sql="select i.check_date,i.voucher,i.trans_type,
                    i.deposit_amount,i.payment_amount,i.supplier_number,i.payee,i.memo
                     from check_writer i 
                    where i.trans_type in ('cash in') and account_number='".$r_bank->bank_account_number."' 
                    and i.check_date between '$date1' and '$date2'  ";
                    $rst_so=$CI->db->query($sql);
                    $tbl="";
                     foreach($rst_so->result() as $row){
                        $tbl.="<tr>";
                        $tbl.="<td>".$row->check_date."</td>";
                        $tbl.="<td>".$row->voucher."</td>";
                        $tbl.="<td>".($row->trans_type)."</td>";
                        $tbl.="<td align='right'>".number_format($row->deposit_amount,2)."</td>";
                        $tbl.="<td>".$row->supplier_number." - ".$row->payee."</td>";
                        $tbl.="<td>".$row->memo."</td>";
                        $tbl.="</tr>";
                   };
                   echo $tbl;
                };  
                                                   
            ?>  
                </tbody>
            </table>
        
        </td>
     </tr>
</table>
