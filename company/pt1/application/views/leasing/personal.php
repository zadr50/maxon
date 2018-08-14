<div class='col-sm-6' style='padding:10px'>
<table width='100%' style="border:none">
	<tr><td>Nama Lengkap (Tanpa Singkatan)</td><td><?=form_input('first_name',$first_name, $disabled);?></td></tr>
	<tr><td>Nama Panggilan</td><td><?=form_input('call_name',$call_name, $disabled);?></td></tr>
	<tr><td>L/P</td><td><?=form_dropdown("gender",array("L"=>"Laki-laki","P"=>"Wanita"),$gender, $disabled)?></td></tr>
	<tr><td>Tempat Lahir</td><td><?=form_input('birth_place',$birth_place, $disabled);?></td></tr>
	<tr><td>Tanggal Lahir</td><td><?=form_input('birth_date',$birth_date,"class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' ".$disabled);?></td></tr>
	<tr><td>Status Pernikahan</td>
		<td><?=form_dropdown('marital_status',array("Single","Menikah","Janda/Duda"),$marital_status," id='marital_status'".$disabled);?></td></tr>
	<tr><td>Jumlah Tanggungan</td><td><?=form_input('no_of_dependents',$no_of_dependents,"style='width:50px'".$disabled);?> Orang</td></tr>
	<tr><td>Nomor. KTP</td><td><?=form_input('id_card_no',$id_card_no, $disabled);?></td></tr>
	<tr><td>Masa Berlaku KTP</td><td><?=form_input('id_card_exp',$id_card_exp, "class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' ".$disabled);?></td></tr>
	<tr><td>Status Tempat Tinggal</td><td><?=form_dropdown("house_status", 
		array('Sendiri','Dinas','Orang Tua','Saudara/Kerabat','Kontrak/Kos'),$house_status, $disabled);?></td></tr>			
	<tr><td>Lama Menetap Tahun/Bulan</td><td><?=form_input('lama_thn',$lama_thn,"style='width:50px'". $disabled);?></td></tr>
</table>
</div>
<div class='col-sm-6' style='padding:10px'>
<table width='100%' style="border:none">	
	<tr><td>Nama Ibu Kandung</td><td><?=form_input('mother_name',$mother_name, $disabled);?></td></tr>					
	<tr><td colspan='2'><h4>Data Pasangan</h4></td></tr>
	<tr><td>Nama Pasangan</td><td><?=form_input('spouse_name',$spouse_name, $disabled);?></td></tr>
	<tr><td>Tempat Lahir </td><td><?=form_input('spouse_birth_place',$spouse_birth_place, $disabled);?></td></tr>
	<tr><td>Tgl Lahir </td><td><?=form_input('spouse_birth_date',$spouse_birth_date, "class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' ".$disabled);?></td></tr>
	<tr><td>No. Telp</td><td><?=form_input('spouse_phone',$spouse_phone, $disabled);?></td></tr>
	<tr><td>No. HP</td><td><?=form_input('spouse_hp',$spouse_hp, $disabled);?></td></tr>
</table>
</div>
