<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
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
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
        <td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>LAPORAN NERACA</h2></td>      
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
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
        <td colspan="8">
                <table class='titem'>
                <thead>
                    <tr><td>Kode Akun</td><td>Nama Akun</td><td >Saldo</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                $coa_old="";                $amt_pasiva=0;        $amt_aktiva=0;
                $coa_name="";
                $amt_mtd_tot=0;
                $amt_ytd_tot=0;
                $amt_mtd_grd=0;
                $amt_ytd_grd=0;
                
                if($qcoa=$CI->chart_of_accounts_model->data_tree_neraca()){
                    for($i=0;$i<count($qcoa);$i++){
                        $coa_id=$qcoa[$i]["account_id"];
                        $coa=$qcoa[$i]["account"];
                        $coa_name=$qcoa[$i]["account_description"];
                        $type=$qcoa[$i]["row_type"];
                        $coa_type=$qcoa[$i]['account_type'];
                        $amt_mtd=0;
                        $amt_ytd=0;
                        if($type=="T"){
                            $coa_old=$coa;
                            $coa_name_old=$coa_name;
                        }
                        if($type=="D"){
                            $s="select * from gl_beginning_balance_archive where `year`='$enddate' 
                                and account_id='$coa_id' ";
                            if($q1=$this->db->query($s)){
                                if($r1=$q1->row()){
                                    $amt_mtd=$r1->ending_balance;
                                }
                            } 
                        }
                        $amt_mtd_tot+=$amt_mtd;
                        $amt_ytd_tot+=$amt_ytd;
                        $amt_mtd_grd+=$amt_mtd;
                        $amt_ytd_grd+=$amt_ytd;
                        
                        if($coa_type>1){
                            $amt_pasiva+=$amt_mtd;
                        } else {
                            $amt_aktiva+=$amt_mtd;
                        }
                        $amt_mtd_text=$coa_type>2?-1*$amt_mtd:$amt_mtd;
                        //if($amt_mtd!=0 || $amt_ytd!=0 || $type=="T"){
                            echo "<tr><td>$coa</td><td>$coa_name</td>
                                <td align='right'>".number_format(($amt_mtd_text),2)."</td></tr>";
                            
                        //}
                        
                        //if next row
                        if($i+1<count($qcoa)){
                            if($qcoa[$i+1]["row_type"]=="T"){
        
                                $amt_mtd_tot_text=$coa_type>2?-1*$amt_mtd_tot:$amt_mtd_tot;
                                
                                echo "<tr><td>$coa_old</td><td>TOTAL: $coa_name_old</td>
                                    <td align='right'>".number_format(($amt_mtd_tot_text),2)."</td></tr>";
                                    
                                echo "<tr><td colspan=5>&nbsp</td></tr>";
                                    
                                $amt_mtd_tot=0;
                                $amt_ytd_tot=0;
                            }
                        }   
                            
                    }
                }
                $amt_mtd_tot_text=$coa_type>2?-1*$amt_mtd_tot:$amt_mtd_tot;
                echo "<tr><td>$coa_old</td><td>TOTAL: $coa_name_old</td>
                        <td align='right'>".number_format(($amt_mtd_tot_text),2)."</td></tr>";
                
                echo "<tr><td>SALDO</td><td></td>
                        <td align='right'>".number_format($amt_aktiva+$amt_pasiva,2)."</td></tr>";
                
                
            ?>  
                </tbody>
            </table>
        
        </td>
     </tr>
</table>
