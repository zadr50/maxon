<?php
//var_dump($_POST);
?>
<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
     $startdate="";
     $enddate="";
     $closed=0;
     $with_header=false;        
     $period=$this->input->post("text1");
     $CI->load->model("periode_model");
     
     if($qprd=$CI->periode_model->get_by_id($period)){
         if($rprd=$qprd->row()){
             $closed=$rprd->closed;
             $startdate=$rprd->startdate;
             $enddate=$rprd->enddate;
         }
     }
    $CI->load->model('chart_of_accounts_model');
    
        $coa_rl_berjalan=0;
        $coa_rl_ditahan=0;
        $rl_data=null;
        $coa_rl_berjalan=$model->earning_account;
        $coa_rl_ditahan=$model->year_earning_account;
    
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
<?php if($with_header) { ?>	
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>NERACA SALDO</h2></td>     	
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
     		Periode : <?=$period?>
     	</td>
     </tr>
<?php } ?>     
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Kode Akun</td><td>Nama Akun</td>
	     				<td colspan='2'>Saldo Awal</td>
	     				<td colspan='2'>Mutasi</td>
	     				<td colspan='2'>Saldo Akhir</td>
	     				<td>DbCr</td>
	     				<td>Type</td>
	     			</tr>
	     			<tr><td></td><td></td>
	     				<td>Debit</td><td>Kredit</td>
	     				<td>Debit</td><td>Kredit</td>
	     				<td>Debit</td><td>Kredit</td>
	     				<td></td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$sql="select * from chart_of_accounts
	            order by account_type,account ";
     			$rst_coa=$CI->db->query($sql);
				$total_awal_cr=0;$total_awal_db=0;
				$total_cr=0;$total_db=0;
				$total_akhir_cr=0;$total_akhir_db=0;
				foreach ($rst_coa->result() as $row_coa) {
				    
                   $awal=0;                 $sld_db=0;          $sld_cr=0;
                   $akhir=0;                $akhir_db=0;        $akhir_cr=0;
                   $mut_db=0;
                   $mut_cr=0;
                       
	 		       $sql="select * from gl_beginning_balance_archive g
	                where g.account_id='$row_coa->id' and g.year='$enddate'"; 
			        $query=$CI->db->query($sql)->row();
					if($query){
					    $awal=$query->beginning_balance;
						$mut_db=$query->debit_base;
						$mut_cr=$query->credit_base;
                        $akhir=$query->ending_balance;
					}
                    if($row_coa->db_or_cr==0){
                        $sld_db=abs($awal);
                        $sld_cr=0;
                        $akhir_db=abs($akhir);
                        $akhir_cr=0;
                    }  else {
                        $sld_db=0;
                        $sld_cr=abs($awal);
                        $akhir_db=0;
                        $akhir_cr=abs($akhir);
                        if($row_coa->account_type>3){
                            if($akhir>0){
                                $akhir_db=abs($akhir);
                                $akhir_cr=0;
                            }
                        }
                    }
                    if($coa_rl_berjalan==$row_coa->id){
                        $rl_data['sld_db']=$sld_db;
                        $rl_data['sld_cr']=$sld_cr;
                        $rl_data['mut_db']=$mut_db;
                        $rl_data['mut_cr']=$mut_cr;
                        $rl_data['akhir_db']=$akhir_db;
                        $rl_data['akhir_cr']=$akhir_cr;
                        
                    } else {
                                            
                        $total_awal_db+=$sld_db;        $total_awal_cr+=$sld_cr;
                        $total_db+=$mut_db;             $total_cr+=$mut_cr;
                        $total_akhir_db+=$akhir_db;     $total_akhir_cr+=$akhir_cr;
                        
    		     		$tbl="";
    					if($akhir != 0 || $mut_db!=0 || $mut_cr!=0){
    	                    $tbl.="<tr>";
    	                    $tbl.="<td>".$row_coa->account."</td>";
    	                    $tbl.="<td>".$row_coa->account_description."</td>";
    	                    $tbl.="<td align='right'>".number_format($sld_db)."</td>";
    	                    $tbl.="<td align='right'>".number_format($sld_cr)."</td>";
    	                    $tbl.="<td align='right'>".number_format($mut_db)."</td>";
    	                    $tbl.="<td align='right'>".number_format($mut_cr)."</td>";
    	                    $tbl.="<td align='right'>".number_format($akhir_db)."</td>";
    	                    $tbl.="<td align='right'>".number_format($akhir_cr)."</td>";
                            $tbl.="<td>$row_coa->db_or_cr</td><td>$row_coa->account_type</td>";	
    	                    $tbl.="</tr>";
    	                    $tbl.="<tr>";
                       }				 
                        echo $tbl;
 
                    }

					
				};
				$tbl="<tr>";
				$tbl.="<td>TOTAL</td>";
				$tbl.="<td></td>";
				$tbl.="<td align='right'>".number_format($total_awal_db)."</td>";
				$tbl.="<td align='right'>".number_format($total_awal_cr)."</td>";

				$tbl.="<td align='right'>".number_format($total_db)."</td>";
				$tbl.="<td align='right'>".number_format($total_cr)."</td>";

				$tbl.="<td align='right'>".number_format($total_akhir_db)."</td>";
				$tbl.="<td align='right'>".number_format($total_akhir_cr)."</td>";

				$tbl.="<td></td><td></td></tr>";
				
				echo $tbl;
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
