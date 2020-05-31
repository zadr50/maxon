<div id='dlgItem' class="easyui-dialog"  buttons="#tbItem" title="Input Data Absen" 
	style="top:50px;width:600px;height:350px" data-options="iconCls:'icon-add'" closed="true">
    <div class='alert alert-info'>
        <p>Isi informasi data absensi tanggal dan jam masuk/keluar 
        dan overtime dibawah ini kemudian klik tombol submit</p>
    </div>
    <form id='frmItem' metod='post'>
        <table class='table'>
            <tr><td>Work Type</td>
                <td><?=form_dropdown('absen_type',
                    array("0"=>"Hadir","1"=>"Tidak","2"=>"Sakit","3"=>"Ijin","9"=>"Off"),
                    0,"id=absen_type style='width:100px'")?>
                </td>
            <td>Tanggal</td><td><?=form_input('tanggal',date('Y-m-d'),"id=tanggal style='width:150px' 
            class='easyui-datetimebox' data-options='formatter:format_date,parser:parse_date' ")?>
            </td></tr>
            <tr><td>Time In</td><td><?=form_input('time_in','0000',"id=time_in style='width:50px'")?></td>
            <td>Time Out</td><td><?=form_input('time_out','0000',"id=time_out style='width:50px'" )?></td></tr>
            <tr><td>OT In</td><td><?=form_input('ot_in','0000',"id=ot_in style='width:50px'")?></td>
            	<td>OT Out</td><td><?=form_input('ot_out','0000',"id=ot_out style='width:50px'" )?></td></tr>
            <tr>
                <td>OT Type</td><td><?=form_dropdown('work_status',
                    array(""=>"","OTB"=>"Overtime Hari Biasa",
                    "OTL"=>"Overtime Hari Libur",
                    "OTN"=>"Overtime Hari Libur Nasional"),
                    "","id='work_status' style='width:120px'")?>
                </td>
            	<td>Id</td><td><?=form_input('id','',"id=id style='width:80px' readonly" )?></td>
            </tr>
        </table>
    </form>
</div>
<div id='tbItem'>
   <?=link_button('Submit','submit_absen();return false;',"save")?>
   <?=link_button('Cancel','close_absen();return false;',"cancel")?>    
</div>

<script language="JavaScript">
    function close_absen(){
        $("#dlgItem").dialog("close");
    }
	function submit_absen(){
		var xurl="<?=base_url()?>index.php/payroll/absensi/save";
		var nip=$("#nip").val();
		if(nip==undefined){
			nip=$("#employee_id").val();
		}
		
		if(nip==""){log_err("Pilih NIP karyawan !");return false;};
		
		var param={"nip":nip,"tanggal": $("#tanggal").datetimebox('getValue'), 
			"time_in":$("#time_in").val(),
			"time_out":$("#time_out").val(), 
			"ot_in":$("#ot_in").val(),
			"ot_out":$("#ot_out").val(),
			"id":$("#id").val(),
			"absen_type":$("#absen_type").val(),"work_status":$("#work_status").val()
			};
		console.log(param);
		
		
		var ok=false;
		loading();
		$.ajax({type: "GET",url: xurl,data: param,
			success: function(result){
				console.log(result);
				loading_close();
				var result = eval('('+result+')');
				if(result.success){
				    close_absen();
					log_msg("Success");
					$("#id").val("");
					$("#absen_type").val("0");
					load_absen();
				}
			},
			error: function(result){
				loading_close();
				log_err("Error");
				return false;
			}			
		}); 		
		
	}

	
</script>
