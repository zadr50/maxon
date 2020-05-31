<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head>
	<title>MaxOn ERP Online</title>
</head>
<script type="text/javascript">
	CI_ROOT = "<?=base_url()?>index.php/";
	CI_BASE = "<?=base_url()?>"; 		
</script>

<BODY> 
<?php
	$item_number=$this->input->post("item_number");
	$description=$this->input->post("description");
?>
<div class="container " >
	<div class="row ">		 
		<div class='col-md-12 well'>
			<form name='frmCari' method='POST'>
				<div class='col-md-4'>
				<label for="item_number">Kode Barang:</label>
				<div class="form-group ">
					<input  class="form-control" type="text" id="item_number" 
					name="item_number" value="<?=$item_number?>" placeholder="Kode barang">
				</div>
				</div>
				<div class='col-md-4'>
				<label for="description">Nama Barang:</label>
				<div class="form-group ">
					<input  class="form-control" type="text" id="description" 
						name="description" value="<?=$description?>" placeholder="Nama barang">
				</div>
				</div>
				<div class='col-md-3'>
				<label for="action">Action</label>
				<div class="form-group">
					<input class="btn btn-primary " type="submit" value="Cari" name='cari' style="height:30px">
					<input class="btn btn-danger " type="submit" value='Logout' name='logout' style='height:30px'>
				</div>
				</div>
			</form>
		</div>
    </div>
	<div class='row'>
		<div class='col-md-12'>
			<table class='table'>
				<thead>
					<th>Kode Barang</th><th>Nama Barang</th>
					<th><span style='float:right'>Harga Jual </span></th>
					
					<?php if (strtolower(user_id())=="admin") {  ?>
						<th><span style='float:right'>Harga Beli </span></th>
						<th><span style='float:right'>Margin% </span></th>						
					<?php } ?>
					<th><span style='float:right'>Quantity</span></th>					
					<th>Promosi</th>
					<th>Category</th>
					<th>Merk</th>
				</thead>
				<tbody>
					<?php 
						if($this->input->post("logout")){
							redirect(base_url("index.php/inventory/checkharga_logout"));
						} else if($this->input->post("cari")){
							$s="select item_number,description,retail,quantity_in_stock,category,
								manufacturer,supplier_number,cost,cost_from_mfg 
								from inventory where 1=1 ";
							if($item_number=$this->input->post("item_number")){
								$s.=" and item_number like '%$item_number%' ";
							}
							if($description=$this->input->post("description")){
								$s.=" and description like '%$description%' ";
							}
							$s.=" limit 500";
							if($q=$this->db->query($s)){
								foreach($q->result() as $r){
									$cost=$r->cost_from_mfg;
									if($cost==0)$cost=$r->cost;
									$promo="";
									$s="select p.nilai from promosi_disc p left join promosi_item pi 
									on pi.promosi_code=p.promosi_code where pi.item_number='$r->item_number' 
									and '".date('Y-m-d H:i:s'). "' between p.date_from and p.date_to";

									if($qpro=$this->db->query($s)){
										foreach($qpro->result() as $rpro){
											$promo.=",".$rpro->nilai;
										}
									}
									$margin=0;
									if($r->retail>0)$margin=(($r->retail-$cost)/$r->retail)*100;
									echo "<tr><td>$r->item_number</td><td>$r->description</td>
									<td align='right'>".number_format($r->retail)."</td>";
									if ((strtolower(user_id())=="admin")) { 									
										echo "<td align='right'>".number_format($cost)."</td>
										<td align='right'>".number_format($margin,2)."</td>";
									}
									echo "<td align='right'>".number_format($r->quantity_in_stock)."</td>
									<td>$promo</td>
									<td>$r->category</td><td>$r->manufacturer</td>
									</tr>";
								}
							}
						} else {
							echo "<tr><td colspan=5>Silahkan isi nama dan klik tombol cari</td></tr>";
						}
					
					?>
				</tbody>
			</table>

		</div> 
	</div>
</div>   
   
		
<!-- </body> --></BODY>
 

<script type="text/javascript" charset="utf-8" src="<?=base_url()?>/assets/jquery/jquery-1.11.3.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>/assets/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/bootstrap-3.3.5/css/bootstrap.min.css">

<script languange="javascript">
 
</script>
 

