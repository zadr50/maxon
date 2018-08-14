		<table  style='width:100%' class="table2">
			<tr><td>Kode Pelanggan</td><td><?=form_input(array("name"=>"cust_id","id"=>"cust_id"),$cust_id,$disabled)?></td>
				<td>Nama Lengkap (sesuai KTP)</td><td><?=form_input('cust_name',$cust_name,$disabled)?></td>
			</tr>
			<tr><td>Provinsi</td><td>
				<?  echo form_input('province',$province, $disabled.' id="province" ');
					echo link_button("","cmdProv_Click()","search");
				?>
				<input type='hidden' name='province_id'  id='province_id'>
			
				</td>
			<td  rowspan='2' colspan='2'>
			Alamat (sesuai KTP)
			<?=form_textarea('street',$street,"style='width:100%;height:50px'". $disabled)?></td>
			</tr>
			<tr><td>Kabupaten / Kota</td><td><?
				echo form_input('city',$city, $disabled.' id="city" ');
				echo link_button("","cmdCity_Click()","search");
			?>
				<input type='hidden' name='city_id'  id='city_id'>
			
			</td>
			</tr>
			<tr>
				<td>Kecamatan</td><td><?
					echo form_input('kec',$kec, $disabled.' id="kec"');
					echo link_button("","cmdKec_Click()","search");
				?>
				<input type='hidden' name='kec_id'  id='kec_id'>
				</td>
				<td>RT / RW<td colspan='2'>
					<?=form_input('rt',$rt, $disabled." style='width:50px'")?>
					<?=form_input('rw',$rw, $disabled." style='width:50px'")?>
				</td>
			</tr>
			<tr><td>Kelurahan</td><td><?
				echo form_input('kel',$kel, $disabled.' id="kel" ');
				echo link_button("","cmdKel_Click()","search");
				?>
				<input type='hidden' name='kel_id'  id='kel_id'>
				
				</td>
				<td>Handphone</td><td><?=form_input('hp',$hp, $disabled)?></td>
			</tr>
			<tr><td>Kode Pos</td><td><?=form_input('zip_pos',$zip_pos, $disabled)?></td>
				<td>Telpon</td><td><?=form_input('phone',$phone, $disabled)?></td>
			</tr>
			<tr><td>Create By</td><td><?
			echo form_hidden('create_by',$create_by);
			echo $username;
			?></td>
				<td>Create Date</td><td><?=form_input('create_date',$create_date, " readonly")?></td>
			</tr>
		</table>
