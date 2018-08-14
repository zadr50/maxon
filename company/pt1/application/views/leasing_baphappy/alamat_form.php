<div id='dlgAddAlamat'class="easyui-dialog" style="width:500px;height:380px;padding:10px 20px" closed="true" 
	buttons="#tbAddAlamat">
	<? echo form_open('',array("action"=>"","name"=>"frmAddAlamat","id"=>"frmAddAlamat"));
		echo "<table class='table2' width='100%'>";
		echo "<tr><td>Jenis Alamat</td><td>".form_dropdown("ship_to_type", 
				array("Family"=>"Family","Saat Ini"=>"Saat Ini","Penagihan"=>"Penagihan",
				"Perusahaan"=>"Perusahaan"),'Family',
				"id='ship_to_type' style='width:100%'")."</td><td></td><td></td></tr>";
		echo "<tr><td>Nama Sesuai KTP</td><td>".form_input("first_name")."</td>";
		echo "<td>Hubungan</td><td>".form_input("relation")."</td></tr>";
		echo "<tr><td>Alamat</td><td colspan='4'>".form_input("street",'','style="width:100%"')."</td></tr>";
		echo "<tr><td>Propinsi</td><td>".form_input("province")."</td><td></td><td></td></tr>";
		echo "<tr><td>Kota</td><td>".form_input("city")."</td>";
		echo "<td>Kelurahan</td><td>".form_input("kel")."</td></tr>";
		echo "<tr><td>Kecamatan</td><td>".form_input("kec")."</td>";
		echo "<td>RT</td><td>".form_input("rt")."</td></tr>";
		echo "<tr><td>RW</td><td>".form_input("rw")."</td>";
		echo "<td>Kode Pos</td><td>".form_input("zip_pos")."</td></tr>";
		echo "<tr><td>Handphone</td><td>".form_input("hp")."</td>";
		echo "<td>Telpon</td><td>".form_input("phone")."</td></tr>";
		echo "<tr><td>Fax</td><td>".form_input("fax")."</td>";
		echo "<td>Email</td><td>".form_input("email")."</td></tr>";
		echo "<tr><td><input type='hidden' name='frmAddAlamat_id' id='frmAddAlamat_id'></td></tr>";
		echo form_hidden("frmAddAlamat_cust_id",$cust_id);
		echo "</table>";
		echo form_close();
		
	?>
</div>	   


<div id='tbAddAlamat'>
	<?=link_button('Save', 'dlgAddAlamat_Save()','ok');?>
	<?=link_button('Close', 'dlgAddAlamat_Close()','no');?>
</div>

<script language="JavaScript">
	function dlgAddAlamat_Valid(){
		var fld=["cust_id","street","city","kel","kec","suite","province"];
		for(i=0;i<fld.length;i++){
			if($("#frmAddAlamat input[name="+fld[i]+"]").val()==""){
			alert('Isi field '+fld[i]+' !!'); return false;}}
		return true;
		fld=['zip_pos','phone','hp'];
		var n=0;
		for(i=0;i<fld.length;i++){
			n=$("#frmAddAlamat input[name="+fld[i]+"]").val();
			if(!isNumber(n)){alert("Isi field "+fld[i]+" dengan angka !!"); 
			return false;}
		}
		return true;
	}

	function dlgAddAlamat_Close(){
		$('#dlgAddAlamat').dialog('close');
	}
	function dlgAddAlamat_Save(){
		if(!dlgAddAlamat_Valid())return false;
		var cust_id=$("#cust_id").val();
		if(cust_id==""){alert("Isi kode pelanggan ");return false};
		url='<?=base_url()?>index.php/leasing/cust_master/alamat/save';
		$('#frmAddAlamat').form('submit',{
			url: url, param: "cust_id="+cust_id, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					dgAlamat_Refresh();
					log_msg('Data sudah tersimpan.');
					$('#dlgAddAlamat').dialog('close');
					$("#frmAddAlamat").resetForm();
					fill_form_blank();
				} else {
					log_err(result.msg);
				}
			}
		});
	}
	function fill_form(result){
		$("#frmAddAlamat select[name=ship_to_type]").val(result.ship_to_type);
		$("#frmAddAlamat input[name=first_name]").val(result.first_name);
		$("#frmAddAlamat input[name=last_name]").val(result.last_name);
		$("#frmAddAlamat input[name=relation]").val(result.relation);
		$("#frmAddAlamat input[name=street]").val(result.street);
		//$("#frmAddAlamat input[name=suite]").val(result.suite);
		$("#frmAddAlamat input[name=city]").val(result.city);
		$("#frmAddAlamat input[name=kel]").val(result.kel);
		$("#frmAddAlamat input[name=kec]").val(result.kec);
		$("#frmAddAlamat input[name=rt]").val(result.rt);
		$("#frmAddAlamat input[name=rw]").val(result.rw);
		$("#frmAddAlamat input[name=zip_pos]").val(result.zip_pos);
		$("#frmAddAlamat input[name=hp]").val(result.hp);
		$("#frmAddAlamat input[name=phone]").val(result.phone);
		$("#frmAddAlamat input[name=fax]").val(result.fax);
		$("#frmAddAlamat input[name=email]").val(result.email);
		$("#frmAddAlamat input[name=province]").val(result.province);
		$("#frmAddAlamat_id").val(result.id);

		
		//$("#frmAddAlamat input[name=country]").val(result.country);
		//$("#frmAddAlamat input[name=region]").val(result.region);
	}	
	function fill_form_blank(){
		$("#frmAddAlamat select[name=ship_to_type]").val("Family");
		$("#frmAddAlamat input[name=first_name]").val("");
		$("#frmAddAlamat input[name=last_name]").val("");
		$("#frmAddAlamat input[name=relation]").val("");
		$("#frmAddAlamat input[name=street]").val("");
		//$("#frmAddAlamat input[name=suite]").val("");
		$("#frmAddAlamat input[name=city]").val("");
		$("#frmAddAlamat input[name=kel]").val("");
		$("#frmAddAlamat input[name=kec]").val("");
		$("#frmAddAlamat input[name=rt]").val("");
		$("#frmAddAlamat input[name=rw]").val("");
		$("#frmAddAlamat input[name=zip_pos]").val("");
		$("#frmAddAlamat input[name=hp]").val("");
		$("#frmAddAlamat input[name=phone]").val("");
		$("#frmAddAlamat input[name=fax]").val("");
		$("#frmAddAlamat input[name=email]").val("");
		$("#frmAddAlamat input[name=province]").val("");
		//$("#frmAddAlamat input[name=country]").val("");
		//$("#frmAddAlamat input[name=region]").val("");
		$("#frmAddAlamat_id").val('');
	}	
	
</script>
	