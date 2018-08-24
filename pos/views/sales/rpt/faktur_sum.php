<?
//var_dump($_POST);
?>
<?
     $CI =& get_instance();
     $CI->load->model('company_model');
     $CI->load->model("shipping_locations_model");
     $CI->load->model("invoice_model");
     
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $outlet=$CI->input->post("text1");
//    $outlet=current_gudang();
    $outlet_name="";
    $company_name="";
    if($outlet!=""){
        if($qgdg=$CI->shipping_locations_model->get_by_id($outlet)){
            if($gdg=$qgdg->row()){
                $outlet_name=$gdg->attention_name;
                $company_code=$gdg->company_name;
                if($company_code!=""){
                    if($qcom=$CI->db->query("select company_name from preferences 
                        where company_code='$company_code' ")){
                            if($rcom=$qcom->row()){
                                $company_name=$rcom->company_name;
                            }
                        }
                }
                
            }
        }
        if($outlet_name==""){
            $outlet_name=$CI->shipping_locations_model->outlet($outlet);            
        }
    }
    
       $this->load->model("company_model");
            $company=$CI->company_model->get_by_id($this->access->cid)->row();
            $data['company_name']=$company->company_name;
            $data['street']=$company->street;
            $data['suite']=$company->street;
            $data['city_state_zip_code']=$company->city_state_zip_code;
            $data['phone_number']=$company->phone_number;
            $data['default_warehouse']=$this->session->userdata("default_warehouse");       

    
    
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0" width='100%'> 
     <tr>
     	<td colspan='5'><h2>DAFTAR FAKTUR PENJUALAN</h2></td>     	
     </tr>
     <tr><td>Outlet: <?=$outlet.'-'.$outlet_name?></td></tr>
     <tr><td>Perusahaan: <?=$company_name?></td></tr>
     <tr>
     	<td>
     		Tanggal: <?=$date1?> s/d : <?=$date2?>, Outlet: <?=$outlet?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
	     		<table class='titem'>
	     		<thead>
	     			<tr><td>Nomor Faktur</td><td>Tanggal</td><td>Jumlah</td>
	     			<td>Paid</td>    	     			</tr>
	     		</thead>
	     		<tbody>
     			<?
     			$sql="select * from invoice where invoice_type='I' 
     			and invoice_date between '$date1' and '$date2'  ";
                
				$logged_in=$this->session->userdata('logged_in');
				if($logged_in['flag1']!=''){
					//$sql.=" and salesman='".$logged_in['username']."'";
				}
				//echo $sql;
                
     			$rst_so=$CI->db->query($sql);
     			$tbl="";
				$z_amount=0;		$z_payment=0;
				$z_retur=0;			$z_cr_amount=0;
				$z_db_amount=0;		$z_saldo=0;
                 foreach($rst_so->result() as $row){
                     
                    $warehouse_code=$CI->invoice_model->warehouse($row->invoice_number);
                    if($outlet==$warehouse_code || $outlet==''){
                        $tbl.="<tr>";
                        $tbl.="<td>".$row->invoice_number."</td>";
                        $tbl.="<td>".$row->invoice_date."</td>";
                        $tbl.="<td align='right'>".number_format($row->amount)."</td>";
                        $tbl.="<td>".$row->paid."</td>";
                        $tbl.="</tr>";
    					$z_amount=$z_amount+$row->amount;
					}
               };
			   
			   $tbl.="<tr><td><strong>TOTAL</strong></td>
	     		<td></td><td align='right'><strong>".number_format($z_amount)."</strong></td>
	     			
	     			</tr>";
			   echo $tbl;
				   				   				   
			?>	
				</tbody>
     		</table>
     	
     	</td>
     </tr>
</table>
