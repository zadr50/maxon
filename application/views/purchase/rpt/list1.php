<?
    $CI =& get_instance();
    $CI->load->model('company_model');
    $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	$city= $CI->input->post('text1');
?>
<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<table cellspacing="0" cellpadding="1" border="0"> 
     <tr>
     	<td colspan='2'><h2>DAFTAR SUPPLIER</h2></td>     	
     </tr>
     <tr>
     	<td>
     		Criteria: Kota : <?=$city?>
     	</td>
     </tr>
     <tr>
     	<td colspan="8">
 		<table class='titem'>
 		<thead>
 			<tr><td>Nama Supplier</td><td>Kode</td>
			<td>Kontak Person</td><td>Kota</td><td>Negara</td>
 			</tr>
 		</thead>
 		<tbody>
     			<?
	 		       $sql="select supplier_name,supplier_number,city,
				   first_name,country 
				   from suppliers";
					if($city!="")$sql.=" where city='$city'"; 
	                $sql.=" order by supplier_name";
			        $query=$CI->db->query($sql);
	     			$tbl="";
	                 foreach($query->result() as $row){
	                    $tbl.="<tr>";
	                    $tbl.="<td>".$row->supplier_name."</td>";
	                    $tbl.="<td>".$row->supplier_number."</td>";
	                    $tbl.="<td>".$row->first_name."</td>";
	                    $tbl.="<td>".$row->city."</td>";
	                    $tbl.="<td>".$row->country."</td>";
	                    $tbl.="</tr>";
	               };
				   echo $tbl;
    			?>
     	

   		</tbody>
   		</table>
     	
     	</td>
     </tr>
</table>
