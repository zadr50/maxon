<div class="col-md-8 thumbnail box-gradient">
    <?=link_button("Generate","generate();return false","save")?>
    <?=link_button('Import 1','import_excel()','csv','false');?>
    <?=link_button('Import 2','import_text_tab()','csv','false');?>
    <?=link_button('Import 3','import_dat()','csv','false');?>
    <div style='float:right'>
        <?=link_button('Close','remove_tab_parent()',"cancel");?>
    </div>
</div>
<div class="col-md-8 thumbnail">
		Periode: <?=form_dropdown('periode',$periode_list,$periode,"id='periode'")?>
		NIP <?php 
    		$disabled="";
            if($flag1==1)$disabled="disabled";
    		echo form_input('nip',$nip,"id='nip' $disabled");
            if($flag1!=1)echo link_button('Pilih NIP','dlgemployee_show();return false;','search');
	        echo link_button('Refresh','load_absen();return false',"reload");
			
		?>		
	    <div class='thumbnail'>
	      Nama <?=form_input('nama',$nama,'id=nama disabled')?>
          Department <?=form_input('dept',$dept,'id=dept disabled')?>
          Divisi <?=form_input('divisi',$divisi,'id=divisi disabled')?>	        
          Nip ID Mesin <?=form_input('nip_id',$nip_id,'id=nip_id disabled')?>	        
	    </div>
</div>

<div class="col-md-12" >
		<table id="dg" class="easyui-datagrid"  
			data-options="iconCls: 'icon-edit',singleSelect: false, toolbar: '#tb',  
			pagination:false,fitColumns: true,url: '' ">
			<thead>
				<tr>
					<th field="ck" checkbox="true"></th>
					<th data-options="field:'absen_type'">Type</th>
					<th data-options="field:'tanggal'">Tanggal</th>
					<th data-options="field:'hari'">Hari</th>
					<th data-options="field:'time_in'">TimeIn</th>
					<th data-options="field:'time_out'">TimeOut</th>
					<th data-options="field:'ot_in'">OT In</th>
					<th data-options="field:'ot_out'">OT Out</th>
					<th data-options="field:'shift_code'">Shift</th>
					<th data-options="field:'work_status'">Work Status</th>
					<th data-options="field:'nip'">NIP</th>
					<th data-options="field:'nama'">Nama</th>
					<th data-options="field:'dept'">Dept</th>
					<th data-options="field:'divisi'">Divisi</th>
					<th data-options="field:'salary_no'">Salary No</th>
					<th data-options="field:'id',align:'right'">Line</th>
				</tr>
			</thead>
		</table>
</div>
<div id="tb">
    <?php if($flag1<>1) { ?>
	<div class="thumbnail">
        <?=link_button('Add','add_item()','add')?>
		<?=link_button('Edit','edit_item()','edit')?>
		<?=link_button('Remove','del_item()','remove')?>
		<?=link_button('ReSave','save_rows()','save')?>
        <?=link_button('Refresh','load_absen();return false',"reload");?>
	</div>
	<?php }  ?>
</div>



<div class="alert alert-info">
	*Catatan: 
</br>Import 1 : adalah import dari file XLS yang sudah disave as TXT tab delimited.
</br>Import 2 : adalah import dari file TXT tab delimited yang diambil datanya dari program absensi file MDB.
</br>Import 3 : adalah import dari file DAT (unencrypted) dari mesin absensi (merek: Solution)
</div>
<?php include_once("absensi_input.php"); ?>

<?php
    echo $lookup_employee;
?>
<script language="JavaScript">
	
	var data_selected=[];

    $().ready(function (){
        $('#dg').datagrid({
            onDblClickRow:function(){
            	
	    //Firefox tidak punya window.event jadi di offkan dulu
	    //fnc_after_select=subEvent;
       // var mainEvent = subEvent ? subEvent : window.event;
		        var w=600;
		        var x=100;	//screen.width*0.5-w*0.5;
		        var y=window.event.screenY;
		        //$('#dlgItem').window({left:100,top:y});  
            	edit_item();
            }
        });        
        
        $('#dg').datagrid({
            rowStyler: function(index,row){
            	if(row.hari=="Sunday"){
		            return 'color:red;font-weight:bold;';
            	}
            	if(row.hari=="Saturday"){
		            return 'color:#f06156;font-weight:bold;';
            	}
            	
            }
        });        

        
    });
    




	function cari_nip(){
		var nip=$("#nip").val();
 		var periode=$("#periode").val();
		var url="<?=base_url()?>index.php/payroll/employee/find/"+nip+"/"+periode;
	    $.ajax({
	                type: "GET", url: url,
	                success: function(msg){
	                    var obj=jQuery.parseJSON(msg);
	                    $('#nama').val(obj.nama);
	                    $('#nip_id').val(obj.nip_id);
	                    $('#dept').val(obj.dept);
	                    $('#divisi').val(obj.divisi);
	                    $('#emptype').val(obj.emptype);
	                    $("#gapok").val(formatNumber(obj.gp));
	                    $("#tjabatan").val(formatNumber(obj.tjabatan));
	                    $("#tarif_upah_lembur").val(formatNumber(obj.tarif));
	                    $("#lembur_jam1").val(formatNumber(obj.lembur_jam1));
	                    $("#lembur_jam2").val(formatNumber(obj.lembur_jam2));
	                    $("#lembur_jumlah").val(formatNumber(obj.lembur_jumlah));
	                },
	                error: function(msg){log_err(msg);}
	    });
		
	}
	
    function generate(){
        var periode=$("#periode").val();
        if ( periode=="" ){
            log_err("Pilih periode !");return false;
        }
        var _url=CI_ROOT+"payroll/absensi/generate/"+periode;
        add_tab_parent("Generate["+periode+"]",_url);
    }
	function add_item(){
        if($("#nip").val()==""){
            log_err("Pilih NIP Karyawan !");return false;
        }	    
	    $("#id").val("");
	    $("#dlgItem").dialog("open");
 	}
 	function save_rows(){
		xurl=CI_BASE+'index.php/payroll/absensi/save_rows';                        
		var ids = [];
		var rows = $('#dg').datagrid('getSelections');
 		if(rows){
 			//console.log(rows);
			for(var i=0; i<rows.length; i++){
			    ids.push(rows[i].id);
			}
 			var _data={'rows':ids};
			$.ajax({
				type: "POST",	url: xurl, data: _data,
				success: function(result){
				try {
						var result = eval('('+result+')');
						if(result.success){
						   load_absen(); 
						} else {
						    log_err(result.msg);
						};
					} catch (exception) {		
                            log_err(result.msg);
					}
				},
				error: function(msg){log_err("Tidak bisa simpan baris-baris ini !");}
			});         
 			
 		}
 		
 	}
 	function del_item(){
		xurl=CI_BASE+'index.php/payroll/absensi/delete_rows';                        
		var ids = [];
		var rows = $('#dg').datagrid('getSelections');
 		if(rows){
 			//console.log(rows);
			for(var i=0; i<rows.length; i++){
			    ids.push(rows[i].id);
			}
		
		
 			var _data={'rows':ids};
			$.ajax({
				type: "POST",	url: xurl, data: _data,
				success: function(result){
				try {
						var result = eval('('+result+')');
						if(result.success){
						   load_absen(); 
						} else {
						    log_err(result.msg);
						};
					} catch (exception) {		
                            log_err(result.msg);
					}
				},
				error: function(msg){log_err("Tidak bisa dihapus baris-baris ini !");}
			});         
 			
 		}
// 		$("#dg").datagrid("clearSelections");
//		var row = $('#dg').datagrid('getSelected');
//		if (row){
//			xurl=CI_BASE+'index.php/payroll/absensi/delete/'+row.id;                        
//			delete_row("dg",xurl);
//		}
	}
	function delete_row(grid_id,xurl){
		$.messager.confirm('Confirm','Are you sure you want to remove this line?',
		function(r)	{
			if(!r)return false;
			$.ajax({
				type: "GET",	url: xurl,
				success: function(result){
				try {
						var result = eval('('+result+')');
						if(result.success){
						   load_absen(); 
						} else {
						    log_err(result.msg);
						};
					} catch (exception) {		
                            log_err(result.msg);
					}
				},
				error: function(msg){log_err("Tidak bisa dihapus baris ini !");}
			});         
		});
	}
 	function edit_item(){
//		$("#dg").datagrid("clearChecked"); 		
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$("#tanggal").datetimebox("setValue",row.tanggal);
			$("#time_in").val(row.time_in);
			$("#time_out").val(row.time_out);
			$("#ot_in").val(row.ot_in);
			$("#ot_out").val(row.ot_out);
			$("#id").val(row.id);
			$("#absen_type").val(row.absen_type);
			$("#work_status").val(row.work_status);
			$("#dlgItem").dialog("open");
		}	
		
	}
 	function load_absen(){
 		var nip=$("#nip").val();
        if(nip==""){log_err("Pilih NIP karyawan !");return false;};
 		var periode=$("#periode").val();
 		cari_nip();
 		
		$('#dg').datagrid({url:'<?=base_url()?>index.php/payroll/absensi/data_nip/'+periode+'/'+nip});
 	}
    function import_excel(){
        add_tab_parent("Import",CI_ROOT+"payroll/absensi/import");
    }
    function import_text_tab(){
        add_tab_parent("Import",CI_ROOT+"payroll/absensi/import_text_tab");
    }
    function import_dat(){
        add_tab_parent("Import",CI_ROOT+"payroll/absensi/import_dat");
    }
	$.extend($.fn.datagrid.methods, {
		clearSelections: function(jq){
			return jq.each(function(){
				var state = $.data(this, 'datagrid');
				var selectedRows = state.selectedRows;
				var checkedRows = state.checkedRows;
				selectedRows.splice(0, selectedRows.length);
				$(this).datagrid('unselectAll');
				if (state.options.checkOnSelect){
					checkedRows.splice(0, checkedRows.length);
				}
			});
		},
		clearChecked: function(jq){
			return jq.each(function(){
				var state = $.data(this, 'datagrid');
				var selectedRows = state.selectedRows;
				var checkedRows = state.checkedRows;
				checkedRows.splice(0, checkedRows.length);
				$(this).datagrid('uncheckAll');
				if (state.options.selectOnCheck){
					selectedRows.splice(0, selectedRows.length);
				}
			});
		},
		deleteSelections: function(jq){
			return jq.each(function(){
				var state=$.data(this,'datagrid');
				var selectedRows = state.selectedRows;
				var checkedRows = state.checkedRows;
				if(selectedRows){
					console.log(selectedRows);
					
				}
			});
		}
		
	})
	

	
</script>