<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
     $startdate="";
     $enddate="";
     $closed=0;
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
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
     	<td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>LAPORAN LABA RUGI</h2></td>     	
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
     <tr><td colspan=4 style='border-bottom: black solid 2px'></td></tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Kode Akun</td><td>Nama Akun</td>
	     				<td align=right>This Period</td>
	     				<td  align=right>Year To Date</td>
	     			</tr>
	     		</thead>
	     		<tbody>
     			<?php
     			$coa_old="";
                $coa_name="";
                $amt_mtd_tot=0;
                $amt_ytd_tot=0;
                $amt_mtd_grd=0;
                $amt_ytd_grd=0;
                
     			if($qcoa=$CI->chart_of_accounts_model->data_tree_rugi_laba()){
     			    for($i=0;$i<count($qcoa);$i++){
     			        $coa_id=$qcoa[$i]["account_id"];
     			        $coa=$qcoa[$i]["account"];
                        $coa_name=$qcoa[$i]["account_description"];
                        $type=$qcoa[$i]["row_type"];
                        $amt_mtd=0;
                        $amt_ytd=0;
                        $s="select sum(debit_base)-sum(credit_base) as amt_ytd 
                            from gl_beginning_balance_archive 
                            where year(`year`)='".substr($enddate,0,4)."' and account_id='$coa_id' ";
                        if($q0=$this->db->query($s)){
                            if($r0=$q0->row()){
                                $amt_ytd=$r0->amt_ytd;
                            }
                        }
                        if($type=="T"){
                            $coa_old=$coa;
                            $coa_name_old=$coa_name;
                        }
                        if($type=="D"){
                            $s="select * from gl_beginning_balance_archive where `year`='$enddate' 
                                and account_id='$coa_id' ";
                            if($q1=$this->db->query($s)){
                                if($r1=$q1->row()){
                                    $amt_mtd=$r1->debit_base-$r1->credit_base;
                                }
                            } 
                        }
                        $amt_mtd_tot+=$amt_mtd;
                        $amt_ytd_tot+=$amt_ytd;
                        $amt_mtd_grd+=$amt_mtd;
                        $amt_ytd_grd+=$amt_ytd;
                        
                        $amt_mtd_text=$amt_mtd*-1;
                        $amt_ytd_text=$amt_ytd*-1;
                        $amt_mtd_tot_text=$amt_mtd_tot*-1;
                        $amt_ytd_tot_text=$amt_ytd_tot*-1;
                        if($amt_mtd!=0 || $amt_ytd!=0 || $type=="T"){
                            echo "<tr><td>$coa</td><td>$coa_name</td>
                                <td align='right'>".number_format(($amt_mtd_text),2)."</td>
                                <td align='right'>".number_format(($amt_ytd_text),2)."</td></tr>";
                            
                        }
                        
                        //if next row
                        if($i+1<count($qcoa)){
                            if($qcoa[$i+1]["row_type"]=="T"){
                                
                                echo "<tr><td>$coa_old</td><td><b>TOTAL: $coa_name_old</b></td>
                                    <td align='right'><b>".number_format(($amt_mtd_tot_text),2)."</b></td>
                                    <td align='right'><b>".number_format(($amt_ytd_tot_text),2)."</b></td></tr>";
                                    
                                echo "<tr><td colspan=5>&nbsp</td></tr>";
                                    
                                $amt_mtd_tot=0;
                                $amt_ytd_tot=0;
                            }
                        }   
                            
     			    }
     			}
                echo "<tr><td>$coa_old</td><td><b>TOTAL: $coa_name_old</b></td>
                        <td align='right'><b>".number_format($amt_mtd_tot_text,2)."</b></td>
                        <td align='right'><b>".number_format($amt_ytd_tot_text,2)."</b></td></tr>";
     			
                echo "<tr><td></td><td><b>GRAND TOTAL</b></td>
                        <td align='right'><b>".number_format($amt_mtd_grd,2)."</b></td>
                        <td align='right'><b>".number_format($amt_ytd_grd,2)."</b></td></tr>";
     			
     			
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
