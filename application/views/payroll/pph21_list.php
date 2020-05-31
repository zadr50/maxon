<div class='thumbnail box-gradient'>
    <table class='table'>
        <tr>
            <td>Pilih Tahun</td><td><?=form_input("tahun",$tahun,"id='tahun'")?></td>
            <td>Bulan</td><td><?=form_input("bulan",$bulan,"id='bulan'")?></td>
            <td>NIP</td><td><?=form_input("nip",$nip,"id='nip'")?>
                <?=link_button("", "dlgemployee_show();return false","search")?>
            </td>
            <td><?=link_button("Hitung","on_calc();return false","sum")?>
                <?=link_button("Simpan","on_save();return false","save")?>
                <?=link_button("Close","remove_tab_parent();return false","cancel")?>                
            </td>            
        </tr>
        <tr><td colspan=4>Nama: <span id='nama'></span> Status: <span id='status'></span>
            Jabatan: <span id='jabatan'></span> Dept: <span id='dept'></span>
            Divisi: <span id='divisi'></span>
        </td></tr>
    </table>
</div>
<div class='col-md-12'>
      <?php
            $sql="select * from hr_pph_form order by kelompok,nomor";       
                     
            echo browse2(array(
                "sql"=>$sql,
                "caption"=>"Data PPH21.",
                "controller"=>"payroll/pph21",
                "cols_width"=>array("keterangan"=>300),
                "fields_numeric"=>array("jumlah"=>true)
            )); 
      ?>
</div>
<?php
    echo $lookup_employee;
?>
<div id='tb'>
	<?=link_button("Add", "add_row();return false","add")?>
	<?=link_button("Edit", "edit_row();return false","edit")?>
	<?=link_button("Delete", "delete_row();return false","remove")?>
</div>
<div id='dlgItem' class="easyui-dialog"  buttons="#tbItem" title="Input Data" style="top:50px;width:600px;height:350px" data-options="iconCls:'icon-add'" closed="true">
    <form id='frmItem' metod='POST'>
        <table class='table'>
            <tr><td>Kelompok</td><td><?=form_input('kelompok','',"id='kelompok'")?></td></tr>
            <tr><td>Nomor</td><td><?=form_input('nomor','',"id='nomor'")?></td></tr>
            <tr><td>Keterangan</td><td><?=form_input('keterangan','',"id='keterangan' style='width:500px'")?></td></tr>
            <tr><td>Formulas</td><td><?=form_input('rumus','',"id='rumus' style='width:400px' ")?></td></tr>
            <tr><td>Id</td><td><?=form_input('id','',"id='id' style='width:50px' ")?>
            	<?=form_input('mode','add',"id='mode' style='width:50px' ")?>
            	<?=form_input("nip","","id='nip2'")?>
            	</td></tr>
        </table>
    </form>
</div>
<div id='tbItem'>
	<?=link_button("Submit", "save_item();return false","save")?>
	<?=link_button("Cancel", "cancel_item();return false","cancel")?>
</div>

<script language="JavaScript">
    function on_calc(){
        var nip=$("#nip").val();
        var tahun=$("#tahun").val();
        var bulan=$("#bulan").val();
        var _url=CI_ROOT+"payroll/pph21/calculate";
        var _param={tahun: tahun, bulan: bulan,nip: nip};
        if(nip==""){
            log_err("Pilih NIP karyawan !");
            return false;
        }
        $.ajax({
            url: _url,
            data: _param,
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    load_data();                
                }
            },
            error: function(result){log_err(result);}
        });
    }
    function load_data(){
        var _url=CI_ROOT+"payroll/pph21/browse_data";
        $("#dg").datagrid({url: _url});
    }
    function on_save(){
        
    }
    function add_row(){
    	clear_input_item();
        if($("#nip").val()==""){
            log_err("Pilih NIP Karyawan !");return false;
        }	    
    	$("#mode").val("add");
    	$("#dlgItem").dialog("open");
    	
    }
    function edit_row(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$("#id").val(row.id);
			$("#kelompok").val(row.kelompok);
			$("#keterangan").val(row.keterangan);
			$("#rumus").val(row.rumus);
			$("#nomor").val(row.nomor);
			$("#mode").val("edit");
			$("#dlgItem").dialog("open");
		}		
    	
    }
    function delete_row(){
    	var xurl=CI_ROOT+"payroll/pph21/delete/";
		$.messager.confirm('Confirm','Are you sure you want to remove this line?',
		function(r)	{
			if(!r)return false;
			var row = $('#dg').datagrid('getSelected');
			if (row){
			
				$.ajax({
					type: "GET",	url: xurl+row.id,
					success: function(result){
					try {
							var result = eval('('+result+')');
							if(result.success){
								cancel_item();
							   on_calc(); 
							} else {
							    log_err(result.msg);
							};
						} catch (exception) {		
	                            log_err(result.msg);
						}
					},
					error: function(msg){log_err("Tidak bisa dihapus baris ini !");}
				});       
			
			}  
		});
    	
    }
    function save_item(){
		var xurl="<?=base_url()?>index.php/payroll/pph21/save";
		var nip=$("#nip").val();
		if(nip==""){log_err("Pilih NIP karyawan !");return false;};
		$('#frmItem').form('submit',{
			url: xurl,method: "POST",
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					on_calc();
					loading_close();
					log_msg("Success");
					cancel_item();
				} else {
					loading_close();
					log_err(result.msg);
				}
			}
		});
		    	
    }
    function cancel_item(){
        $("#dlgItem").dialog("close");
    }
    function clear_input_item(){
    	var nip=$("#nip").val();
    	$("#kelompok").val("");
    	$("#keterangan").val("");
    	$("#rumus").val("");
    	$("#nomor").val("");
    	$("#rumus").val("");
    	$("#id").val("");    	
    	$("#nip2").val(nip);
    	$("mode").val("add");
    }
</script>
