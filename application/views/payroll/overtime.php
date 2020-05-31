<div class='row'>
	<div class="box-gradient">
	    <?=link_button('Print','print_data();return false;','print')?>            
	    <?=link_button('Filter','load_data();return false;','reload')?>            
	    <div style="float:right">
	        <?=link_button('Help', 'load_help(\'salary\')','help'); ?>  
	        <a href="#" class="easyui-splitbutton" data-options="menu:'#mmOptions',iconCls:'icon-tip',plain:false">Options</a>
	        <div id="mmOptions" style="width:200px;">
	            <div onclick="load_help()">Help</div>
	            <div>Update</div>
	            <div>MaxOn Forum</div>
	            <div>About</div>
	        </div>
	        <?=link_button('Close', 'remove_tab_parent();return false;','cancel');?>     
	    </div>
	</div>	
</div>
<div class='row'>
	<div class="col-md-12">
			Periode: <?=form_dropdown('periode',$periode_list,$periode,"id='periode'")?>
			NIP <?php 
	    		$disabled="";
	//            if($flag1==1)$disabled="disabled";
	    		echo form_input('nip',$nip,"id='nip' $disabled");
	            //if($flag1!=1)
	            echo link_button('Pilih NIP','dlgemployee_show();return false;','search');
			?>		
			<?php
		    echo link_button('Refresh','load_data();return false;','reload');            
		    ?>
		    <div class='alert alert-info'>
		    	<table class='tablex'>
		      		<tr>
		      			<td>Nama </td><td><?=form_input('nama',$nama,'id=nama disabled')?></td>
			          	<td>Department </td><td><?=form_input('dept',$dept,'id=dept disabled')?></td>
	          			<td>Divisi </td><td><?=form_input('divisi',$divisi,'id=divisi disabled')?></td>
	          		</tr>		
	          		<tr>
	          			<td>Gaji Pokok </td><td><?=form_input("gapok",0,"id='gapok' disabled")?></td> 
	          			<td>Tunj Jabatan </td><td><?=form_input("tjabatan",0,"id='tjabatan' disabled")?></td> 
	          			<td>Lembur /Jam </td><td><?=form_input('tarif_upah_lembur',0,"id='tarif_upah_lembur' disabled")?></td>  	          			
	          		</tr>
	          		<tr>
			          <td>Lembur Jam ke 1</td><td><?=form_input('lembur_jam1',0,"id='lembur_jam1' disabled")?></td>  
			          <td>Lb Jam ke 2 dst</td><td><?=form_input('lembur_jam2',0,"id='lembur_jam2' disabled")?></td>  
			          <td>Jumlah</td><td><?=form_input('lembur_jumlah',0,"id='lembur_jumlah' disabled")?></td>  	          			
	          		</tr>
		    	</table>
		    </div>
	</div>
	
</div>


<div class='thumbnailxx'>
<table id="dg" class="easyui-datagrid" 	style="width:850px;height:400px"
				data-options="iconCls: 'icon-edit',singleSelect: false,toolbar: '#tb', fitColumns: false,
					url: ''">
				<thead>
					<tr>
						<th field="ck" checkbox="true"></th>
						<th data-options="field:'tanggal',width:100">Tanggal</th>
						<th data-options="field:'hari'">Hari</th>
						<th data-options="field:'time_in',align:'right',editor:{type:'numberbox',options:{precision:2}}">Time In</th>
						<th data-options="field:'time_out',align:'right',editor:{type:'numberbox',options:{precision:2}}">Time Out</th>
						<th data-options="field:'time_total',align:'right',editor:{type:'numberbox',options:{precision:2}}">OT Hour</th>
						<th data-options="<?=col_number('amount',2)?>">Amount</th>						
						<th data-options="field:'ttc_1x',align:'right',editor:{type:'numberbox',options:{precision:2}}">TTC1</th>
						<th data-options="field:'ttc_2x',align:'right',editor:{type:'numberbox',options:{precision:2}}">TTC2</th>
						<th data-options="field:'ttc_3x',align:'right',editor:{type:'numberbox',options:{precision:2}}">TTC3</th>
						<th data-options="field:'ttc_4x',align:'right',editor:{type:'numberbox',options:{precision:2}}">TTC4</th>
						<th data-options="field:'time_total_calc',align:'right',editor:{type:'numberbox',options:{precision:2}}">TTC</th>
						<th data-options="field:'hari_libur',align:'right',editor:{type:'numberbox',options:{precision:2}}">Holiday</th>
						<th data-options="field:'work_status'">Type</th>
						<th data-options="field:'nip',width:100">NIP</th>
						<th data-options="field:'nama',width:200">Nama</th>
						<th data-options="field:'id',align:'right'">Line</th>
						<th data-options="field:'salary_no',width:200">Salary No</th>
						<th data-options="field:'supervisor',align:'right',editor:{type:'numberbox',options:{precision:2}}">Supervsr</th>
						<th data-options="field:'tcid',width:200">TcId</th>
					</tr>
				</thead>
			</table>		
</div>

<div id='tb'>
	<?=link_button("Add Row","add_row()","add");?>
	<?=link_button("Edit Row" ,"edit_row()","edit");?>
	<?=link_button("Remove	","delete_rows()","remove");?>
	<?=link_button("Recalc	","recalc_rows()","sum");?>
	<?=link_button("Refresh	","load_data()","reload");?>
</div>
<?php
	echo $lookup_employee;
	include_once("overtime_input.php");
?>

<script type="text/javascript">

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
        
	function recalc_rows(){
		var nip=$("#nip").val();
 		var period=$("#periode").val();
 		if(nip=="" || period==""){
 			log_err("Pilih NIP dan perioe !");
 			return false;
 		}
		xurl=CI_BASE+'index.php/payroll/overtime/save_rows';                        
		var ids = [];
		var rows = $('#dg').datagrid('getSelections');
 		if(rows){
 			console.log(rows);
			for(var i=0; i<rows.length; i++){
			    ids.push(rows[i].id);
			}
		
		
 			var _data={'rows':ids,'nip':nip,'period':period};
			$.ajax({
				type: "POST",	url: xurl, data: _data,
				success: function(result){
				try {
						var result = eval('('+result+')');
						if(result.success){
						   load_data(); 
						} else {
						    log_err(result.msg);
						};
					} catch (exception) {		
                            log_err(result.msg);
					}
				},
				error: function(msg){log_err("Tidak bisa simpan !");}
			});         
 			
		}
		
	}
	function delete_rows(){
		xurl=CI_BASE+'index.php/payroll/overtime/delete_rows';                        
		var ids = [];
		var rows = $('#dg').datagrid('getSelections');
 		if(rows){
 			console.log(rows);
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
						   load_data(); 
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
	}
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
	                    $("#work_status").val(obj.work_status);
	                },
	                error: function(msg){log_err(msg);}
	    });
		
	}
	function load_data(){	   
 		var nip=$("#nip").val();
        if(nip==""){log_err("Pilih NIP karyawan !");return false;};
 		var periode=$("#periode").val();
		cari_nip();
		var vUrl='<?=base_url()?>index.php/payroll/overtime/data?nip='+nip+'&periode='+periode;
		
        $('#dg').datagrid({url:vUrl});
	}
	function print_data(){
 		var nip=$("#nip").val();
        if(nip==""){log_err("Pilih NIP karyawan !");return false;};
 		var periode=$("#periode").val();
 		var url=CI_ROOT+"payroll/overtime/print_data/?nip="+nip+"&period="+periode;
		window.open(url,"_blank");
	}

   
</script>  
			