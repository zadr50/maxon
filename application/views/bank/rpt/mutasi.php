<?php
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
	     				<td>Keluar</td><td>Saldo</td><td>Person</td><td>Memo</td>
	     				<td>DocType</td><td>Ref1</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php 
                $sub_ttl_db=0;
                $sub_ttl_cr=0;
                $grand_ttl_db=0;
                $grand_ttl_cr=0;
                
                
     			$sql="select bank_account_number,bank_name from bank_accounts ";
				
				if($rek!="")$sql.=" where bank_account_number='".$rek."'";
                
				$rst_bank=$CI->db->query($sql);
                
				foreach($rst_bank->result() as $r_bank){

                    $saldo=0;
                    
                    $sql="select sum(deposit_amount)-sum(payment_amount) as z_amt 
                    from check_writer where account_number='$r_bank->bank_account_number' 
                    and check_date<'$date1'";
					
                    if($rsld=$this->db->query($sql)->row()){
                        $saldo=$rsld->z_amt;
                    }
					echo "<tr><td colspan='10'></td></tr>";
					echo "<tr><td colspan='5'><h1>Rekening: ".$r_bank->bank_account_number
					." - ".$r_bank->bank_name."</h1></td><td align='right'>
					   <b>".number_format($saldo,2)."</b></td><td></td><td></td></tr>";


					
	     			$sql="select i.check_date,i.voucher,i.trans_type,i.doc_type,s.doc_type_name,
	     			i.deposit_amount,i.payment_amount,i.supplier_number,i.payee,i.memo,i.trans_id
	     			 from check_writer i 
	     			 left join (select varvalue,keterangan as doc_type_name 
	     			 	from system_variables 
	     			 	where varname='lookup.doc_type_cash_out') s on s.varvalue=i.doc_type
		            where account_number='".$r_bank->bank_account_number."' 
		            and i.check_date between '$date1' and '$date2'  ";
	     			$rst_so=$CI->db->query($sql);
	     			$tbl="";
                    
                    $sub_ttl_db=0;
                    $sub_ttl_cr=0;
                    
                    
	                 foreach($rst_so->result() as $row){
	                 	$deposit_amount=$row->deposit_amount;
						$payment_amount=$row->payment_amount;
	                 	$saldo+=($deposit_amount-$payment_amount);
						 
                        $sub_ttl_db+=$deposit_amount;
                        $sub_ttl_cr+=$payment_amount;
                        $grand_ttl_db+=$deposit_amount;
                        $grand_ttl_cr+=$payment_amount;
                        
	                 	$jenis=$row->memo;
	                 	
	                 	$faktur="";
	                 	if($jenis=="Payment Pos "){
	                 		$s="select invoice_number from Check_writer_items where trans_id='$row->trans_id'";
	                 		if($q=$this->db->query($s)){
	                 			if($r=$q->row()){
	                 				$faktur=$r->invoice_number;
	                 			}
	                 		}
							if($deposit_amount==0){
								$s="select amount_paid,line_number from payments where no_bukti='$row->voucher'";
								if($q=$this->db->query($s)){
									if($r=$q->row()){
										$deposit_amount2=$r->amount_paid;
										if($deposit_amount2>0){
											$deposit_amount=$deposit_amount2;	
											$s="update check_writer set deposit_amount=$deposit_amount where voucher='$row->voucher'";
											$this->db->query($s);											
										}
									}
								}
							}
	                 	}
						
	                    $tbl.="<tr>";
	                    $tbl.="<td>".$row->check_date."</td>";
	                    $tbl.="<td>".$row->voucher."</td>";
	                    $tbl.="<td>".($row->trans_type)."</td>";
	                    $tbl.="<td align='right'>".number_format($deposit_amount,2)."</td>";
	                    $tbl.="<td align='right'>".number_format($payment_amount,2)."</td>";
	                    $tbl.="<td align='right'>".number_format($saldo,2)."</td>";
	                    $tbl.="<td>".$row->supplier_number." - ".$row->payee."</td>";
	                    $tbl.="<td>".$row->memo."</td>";
	                    $tbl.="<td>".$row->doc_type_name."</td>";
	                    $tbl.="<td>$faktur</td>";
	                    $tbl.="</tr>";
	               };
                     $tbl.="<tr>";
                        $tbl.="<td><b>SUB TOTAL</b></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td align='right'><b>".number_format($sub_ttl_db,2)."</b></td>";
                        $tbl.="<td align='right'><b>".number_format($sub_ttl_cr,2)."</b></td>";
                        $tbl.="<td align='right'><b>".number_format(0,2)."<b></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="</tr>";
                        
				   echo $tbl;
				};  
                
                   $tbl="<tr>";
                        $tbl.="<td><b>GRAND TOTAL</b></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td align='right'><b>".number_format($grand_ttl_db,2)."</b></td>";
                        $tbl.="<td align='right'><b>".number_format($grand_ttl_cr,2)."</b></td>";
                        $tbl.="<td align='right'><b>".number_format(0,2)."</b></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="<td></td>";
                        $tbl.="</tr>";
                   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
