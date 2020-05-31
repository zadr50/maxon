<?php

	$varname="copy_inventory";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_inventory_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_inventory=getvar("copy_inventory",false);for($i=1;$i<11;$i++)$inventory[$i-1]=getvar("db_inventory_$i");	
	
	$varname="copy_customer";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_customer_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_customer=getvar("copy_customer",false);for($i=1;$i<11;$i++)$customer[$i-1]=getvar("db_customer_$i");	

	$varname="copy_supplier";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_supplier_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_supplier=getvar("copy_supplier",false);for($i=1;$i<11;$i++)$supplier[$i-1]=getvar("db_supplier_$i");	

	$varname="copy_bank";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_bank_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_bank=getvar("copy_bank",false);for($i=1;$i<11;$i++)$bank[$i-1]=getvar("db_bank_$i");

	$varname="copy_coa";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){		$ii=$i+1;
			
		
		$varname="db_coa_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_coa=getvar("copy_coa",false);for($i=1;$i<11;$i++)$coa[$i-1]=getvar("db_coa_$i");
		
	$varname="copy_so";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_so_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_so=getvar("copy_so",false);for($i=1;$i<11;$i++)$so[$i-1]=getvar("db_so_$i");

	$varname="copy_jual";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_jual_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_jual=getvar("copy_jual",false);for($i=1;$i<11;$i++)$jual[$i-1]=getvar("db_jual_$i");

	$varname="copy_do";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_do_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_do=getvar("copy_do",false);for($i=1;$i<11;$i++)$do[$i-1]=getvar("db_do_$i");

	$varname="copy_retur_jual";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_retur_jual_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_retur_jual=getvar("copy_retur_jual",false);for($i=1;$i<11;$i++)$retur_jual[$i-1]=getvar("db_retur_jual_$i");

	$varname="copy_pay_jual";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_pay_jual_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_pay_jual=getvar("copy_pay_jual",false);for($i=1;$i<11;$i++)$pay_jual[$i-1]=getvar("db_pay_jual_$i");

	$varname="copy_crdb_jual";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_crdb_jual_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_crdb_jual=getvar("copy_crdb_jual",false);for($i=1;$i<11;$i++)$crdb_jual[$i-1]=getvar("db_crdb_jual_$i");
	

	$varname="copy_po";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_po_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_po=getvar("copy_po",false);for($i=1;$i<11;$i++)$po[$i-1]=getvar("db_po_$i");

	$varname="copy_beli";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){		$ii=$i+1;
		
		$varname="db_beli_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_beli=getvar("copy_beli",false);for($i=1;$i<11;$i++)$beli[$i-1]=getvar("db_beli_$i");

	$varname="copy_pay_beli";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_pay_beli_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_pay_beli=getvar("copy_pay_beli",false);for($i=1;$i<11;$i++)$pay_beli[$i-1]=getvar("db_pay_beli_$i");

	$varname="copy_retur_beli";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_retur_beli_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_retur_beli=getvar("copy_retur_beli",false);for($i=1;$i<11;$i++)$retur_beli[$i-1]=getvar("db_retur_beli_$i");

	$varname="copy_crdb_beli";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_crdb_beli_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_crdb_beli=getvar("copy_crdb_beli",false);for($i=1;$i<11;$i++)$crdb_beli[$i-1]=getvar("db_crdb_beli_$i");


	$varname="copy_recv_po";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_recv_po_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_recv_po=getvar("copy_recv_po",false);for($i=1;$i<11;$i++)$recv_po[$i-1]=getvar("db_recv_po_$i");

	$varname="copy_recv_etc";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_recv_etc_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_recv_etc=getvar("copy_recv_etc",false);for($i=1;$i<11;$i++)$recv_etc[$i-1]=getvar("db_recv_etc_$i");

	$varname="copy_do_etc";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_do_etc_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_do_etc=getvar("copy_do_etc",false);for($i=1;$i<11;$i++)$do_etc[$i-1]=getvar("db_do_etc_$i");

	$varname="copy_stock_adjust";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_stock_adjust_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_stock_adjust=getvar("copy_stock_adjust",false);for($i=1;$i<11;$i++)$stock_adjust[$i-1]=getvar("db_stock_adjust_$i");

	$varname="copy_stock_mutasi";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_stock_mutasi_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_stock_mutasi=getvar("copy_stock_mutasi",false);for($i=1;$i<11;$i++)$stock_mutasi[$i-1]=getvar("db_stock_mutasi_$i");


	$varname="copy_cash";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_cash_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_cash=getvar("copy_cash",false);for($i=1;$i<11;$i++)$cash[$i-1]=getvar("db_cash_$i");

	$varname="copy_jurnal";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_jurnal_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_jurnal=getvar("copy_jurnal",false);for($i=1;$i<11;$i++)$jurnal[$i-1]=getvar("db_jurnal_$i");

	$varname="copy_retur_toko";if(!exist_var($varname))insert_var($varname,false);
	for($i=0;$i<10;$i++){
		$ii=$i+1;
		$varname="db_retur_toko_$ii";
		if(!exist_var($varname))insert_var($varname,false);	
	}
	$ck_retur_toko=getvar("copy_retur_toko",false);for($i=1;$i<11;$i++)$retur_toko[$i-1]=getvar("db_retur_toko_$i");

	if(isset($message)){
		if($message!=""){
			echo "<div class='alert alert-warning'>$message</div>";
		}
	}	


?>
<form method='POST' action="<?=base_url("index.php/replicate/setting")?>">
<label><?=$caption?></label>
<div class='alert alert-info'>
	<p>Silahkan isi pengaturan untuk proses data transfer dan replikasi data ke database 
	lain dibawah ini kemudian klik tombol submit  
	<input type='submit' name='submit' value='Submit'>
	</p>
	
</div>

<div class='thumbnailxxx'>
	<table class='table'>
		<thead><th>Pilih</th><th>Proses</th>
			<th>DB1</th><th>DB2</th><th>DB3</th><th>DB4</th><th>DB5</th>
			<th>DB6</th><th>DB7</th><th>DB8</th><th>DB9</th><th>DB10</th>			
		</thead>
		<tbody>
			<tr><td colspan=10><b>TRANSAKSI PENJUALAN</b></td></tr>
			<tr>
				<td><?=form_checkbox("ck_so",1,$ck_so,"style='width:30px'");?></td>
				<td>SALES ORDER</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("so[]",$so[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_jual",1,$ck_jual,"style='width:30px'");?></td>
				<td>FAKTUR PENJUALAN</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("jual[]",$jual[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_do",1,$ck_do,"style='width:30px'");?></td>
				<td>DELIVERY ORDER</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("do[]",$do[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_retur_jual",1,$ck_retur_jual,"style='width:30px'");?></td>
				<td>RETUR PENJUALAN</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("retur_jual[]",$retur_jual[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_crdb_jual",1,$ck_crdb_jual,"style='width:30px'");?></td>
				<td>CRDB MEMO PENJUALAN</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("crdb_jual[]",$crdb_jual[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_pay_jual",1,$ck_pay_jual,"style='width:30px'");?></td>
				<td>PAYMENT PENJUALAN</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("pay_jual[]",$pay_jual[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	

			<tr><td colspan=10><b>TRANSAKSI PEMBELIAN</b></td></tr>

			<tr>
				<td><?=form_checkbox("ck_po",1,$ck_po,"style='width:30px'");?></td>
				<td>PURCHASE ORDER</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("po[]",$po[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_beli",1,$ck_beli,"style='width:30px'");?></td>
				<td>FAKTUR PEMBELIAN</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("beli[]",$beli[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_retur_beli",1,$ck_retur_beli,"style='width:30px'");?></td>
				<td>RETUR PEMBELIAN</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("retur_beli[]",$retur_beli[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_pay_beli",1,$ck_pay_beli,"style='width:30px'");?></td>
				<td>PAYMENT PEMBELIAN</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("pay_beli[]",$pay_beli[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_crdb_beli",1,$ck_crdb_beli,"style='width:30px'");?></td>
				<td>CRDB MEMO PEMBELIAN</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("crdb_beli[]",$crdb_beli[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			
			<tr><td colspan=10><b>TRANSAKSI INVENTORY</b></td></tr>
			<tr>
				<td><?=form_checkbox("ck_recv_po",1,$ck_recv_po,"style='width:30px'");?></td>
				<td>PENERIMAAN ATAS PO</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("recv_po[]",$recv_po[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_recv_etc",1,$ck_recv_etc,"style='width:30px'");?></td>
				<td>PENERIMAAN LAINNYA</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("recv_etc[]",$recv_etc[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	

			<tr>
				<td><?=form_checkbox("ck_do_etc",1,$ck_do_etc,"style='width:30px'");?></td>
				<td>PENGELUARAN LAINNYA</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("do_etc[]",$do_etc[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_stock_mutasi",1,$ck_stock_mutasi,"style='width:30px'");?></td>
				<td>STOCK MUTASI</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("stock_mutasi[]",$stock_mutasi[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_stock_adjust",1,$ck_stock_adjust,"style='width:30px'");?></td>
				<td>STOCK ADJUSTMENT</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("stock_adjust[]",$stock_adjust[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>
			<tr>
				<td><?=form_checkbox("ck_retur_toko",1,$ck_retur_toko,"style='width:30px'");?></td>
				<td>RETUR TOKO</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("retur_toko[]",$retur_toko[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>
			
				
			<tr><td colspan=10><b>TRANSAKSI BANK DAN AKUNTING</b></td></tr>
			<tr>
				<td><?=form_checkbox("ck_cash",1,$ck_cash,"style='width:30px'");?></td>
				<td>TRANSAKSI CASH/BANK</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("cash[]",$cash[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_jurnal",1,$ck_jurnal,"style='width:30px'");?></td>
				<td>JURNAL UMUM</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("jurnal[]",$jurnal[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	

			
			<tr><td colspan=10><b>MASTER DATA</b></td></tr>
			<tr>
				<td><?=form_checkbox("ck_inventory",1,$ck_inventory,"style='width:30px'");?></td>
				<td>INVENTORY</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("inventory[]",$inventory[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>
			<tr>
				<td><?=form_checkbox("ck_customer",1,$ck_customer,"style='width:30px'");?></td>
				<td>CUSTOMER</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("customer[]",$customer[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>
			<tr>
				<td><?=form_checkbox("ck_supplier",1,$ck_supplier,"style='width:30px'");?></td>
				<td>SUPPLIER</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("supplier[]",$supplier[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>
			<tr>
				<td><?=form_checkbox("ck_bank",1,$ck_bank,"style='width:30px'");?></td>
				<td>REKENING KAS / BANK</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("bank[]",$bank[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			<tr>
				<td><?=form_checkbox("ck_coa",1,$ck_coa,"style='width:30px'");?></td>
				<td>CHART OF ACCOUNTS</td>
				<?php 
				for($i=0;$i<10;$i++){
					echo "<td>".form_input("coa[]",$coa[$i],"style='width:80px'")."</td>";
				}
				?>
			</tr>	
			
		</tbody>
	</table>

</div>
</form>
