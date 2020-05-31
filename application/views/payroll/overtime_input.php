<div id='dlgItem' class="easyui-dialog"  buttons="#tbItem" title="Input Data Overtime" style="top:50px;width:600px;height:350px" data-options="iconCls:'icon-add'" closed="true">
	<div class='alert alert-info col-md-12'>
		<p>Silahkan isi formulir overtime dibawah ini dengan benar.</p>
	</div>
	<div class="col-md-12 ">
	    <div class="thumbnail">
	        <form id="frmOvertime" method="POST">
	        <table class='table2' width='100%'>	          
	          <tr><td>Tanggal</td><td>
	          	<input id="tanggal" name="tanggal" value="<?=$tanggal?>" 
	          		class="easyui-datetimebox" 
                    data-options="formatter:format_date,parser:parse_date"
                    style="width:140px">
	            </td></tr>
	          <tr><td>Jam Awal (HH:MM)</td><td><input id="time_in" name="time_in"></td></tr>
	          <tr><td>Jam Akhir (HH:MM)</td><td><input id="time_out" name="time_out"></td></tr>
	          <tr><td>Nama Supervisor</td><td><input id="supervisor" name="supervisor"></td></tr>
	          <tr><td>OT Hari Libur</td><td><input id="hari_libur" name="hari_libur" type="checkbox" style="width:20px"></td></tr>
			  <tr>
	                <td>OT Type</td><td><?=form_dropdown('work_status',
	                    array(""=>"","OTB"=>"Overtime Hari Biasa",
	                    "OTL"=>"Overtime Hari Libur",
	                    "OTN"=>"Overtime Hari Libur Nasional"),
	                    "","id='work_status' style='width:120px'")?>
	                </td>
	
			  </tr>          
	          
	          <tr><td>PaySlip#</td><td><input id="salary_no" name="salary_no" ></td></tr>
	          <tr><td><input id="id" name="id" type="hidden"></td></tr>	          
	        </table>
	        </form>
	        
	    </div>
	</div>
 
</div>
<div id='tbItem'>
   <?=link_button('Submit','submit_form();return false;',"save")?>
   <?=link_button('Cancel','close_form();return false;',"cancel")?>    
</div>
	

<script language="JavaScript">
    function close_form(){
        $("#dlgItem").dialog("close");
    }
	function submit_form(){
		var xurl="<?=base_url()?>index.php/payroll/overtime/save";
		var nip=$("#nip").val();
		if(nip==""){log_err("Pilih NIP karyawan !");return false;};
		
		var param={"nip":nip,"tanggal": $("#tanggal").datetimebox('getValue'), 
			"time_in":$("#time_in").val(),
			"time_out":$("#time_out").val(), 
			"ot_in":$("#ot_in").val(),
			"ot_out":$("#ot_out").val(),
			"id":$("#id").val(),"work_status":$("#work_status").val(),
			"absen_type":$("#absen_type").val(),"salary_no":$("#salary_no").val()
			};
		var ok=false;
		loading();
		$.ajax({type: "GET",url: xurl,data: param,
			success: function(result){
				console.log(result);
				loading_close();
				var result = eval('('+result+')');
				if(result.success){
				    close_form();
					log_msg("Success");
					$("#id").val("");
					$("#absen_type").val("0");
					load_data();
				}
			},
			error: function(result){
				loading_close();
				log_err("Error");
				return false;
			}			
		}); 		
		
	}	
	function add_row(){
        if($("#nip").val()==""){
            log_err("Pilih NIP Karyawan !");return false;
        }	    
	    clear_input();
	    $("#dlgItem").dialog("open");
		
	}
	function clear_input(){
		$("#nip").val('');
		$("#nama").val('');
		$("#time_in").val('');
		$("#time_out").val('');
		$("#supervisor").val('');
		$("#hari_libur").val('');
		$("#salary_no").val('');
		$("#work_status").val('');
		$("#id").val(0);

	}
    function add_ot(){
        if($('#nip').val()===''){alert('Isi NIP !');return false;};
		url='<?=base_url()?>index.php/payroll/overtime/save';
		$('#frmOvertime').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					clear_input();
					log_msg("Data sudah tersimpan.");
					if ($('#chkClear')[0].checked) load_data();
					
				} else {
					log_err(result.msg);
				}
			}
		});
    }
	function delete_row() {
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#id').val(row.id);
				var url="<?=base_url()?>index.php/payroll/overtime/delete/"+row.id;
				$.ajax({
							type: "GET", url: url,
							success: function(msg){
                                load_data();
							},
							error: function(msg){log_err(msg);}
				});
			}	
	}
	
 
	function edit_row()	{
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#id').val(row.id);
				var url="<?=base_url()?>index.php/payroll/overtime/get_id/"+row.id;
				$.ajax({
							type: "GET", url: url,
							success: function(msg){
								var obj=jQuery.parseJSON(msg);
									//$("#tanggal").val(obj.tanggal);
									$('#tanggal').datetimebox('setValue', obj.tanggal);
									$('#time_in').val(obj.time_in);
									$('#time_out').val(obj.time_out);
									$('#tanggal').val(obj.tanggal);
									$('#supervisor').val(obj.supervisor);
									$('#hari_libur').val(obj.hari_libur);
									
									$('#nip').val(obj.nip);
									$('#nama').val(obj.nama);
									$('#nip_id').val(obj.nip_id);
									$('#dept').val(obj.dept);
									$('#divisi').val(obj.divisi);
									$('#emptype').val(obj.emptype);
									$("#salary_no").val(obj.salary_no)
									$("#work_status").val(obj.work_status);
									
								    $("#dlgItem").dialog("open");
									
								
							},
							error: function(msg){log_err(msg);}
				});
			}	
	}
	
</script>