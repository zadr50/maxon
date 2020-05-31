<div class="thumbnail">
	<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print_slip()','print');		
	echo link_button('Refresh','','reload','false',base_url().'index.php/payroll/salary/view/'.$pay_no);		
    echo link_button("Recalc","recalc_group();return false","sum");	
    echo link_button('View Absensi','view_absen();return false',"search");
    echo link_button('View Overtime','view_overtime();return false',"search");
	?>
	<div style='float:right'>
    	<?=link_button('Help', 'load_help(\'salary\')','help');	?>	
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

<?php echo validation_errors(); ?>

<form id="frmSalary"  method="post">

<div class="easyui-tabs" style="width:auto;height:auto;min-height:300px">
	<div title="General" style="padding:10px">
 
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
		
	   <table class='table' width='100%'>
			<tr><td>Nomor Slip</td>
				<td>
					<?php
					if($mode=='view'){
					    $readonly=" readonly";
					} else {
					    $readonly=""; 
					}		
                    echo form_input('pay_no',$pay_no,"id=pay_no $readonly");
					?>
				</td>
				<td rowspan='4' colspan='2'>
					<div class="thumbnail" style="width:400px;height:100px">
						<span id='nama'><?=$nama_pegawai?></span>
						<span id='dept'></span>
						<span id='divisi'></span>
						
					</div>
				</td>
		
			</tr>	 
			<tr>
				<td>NIP</td>
				<td><? echo form_input('employee_id',$employee_id,"id=employee_id"); 
				echo link_button("","dlgemployee_show();return false","search")?></td>
			</tr>
		    <tr>
				<td>Periode </td><td><?=form_input('pay_period',$pay_period,"id='pay_period'");
				echo link_button("","dlghr_period_show();return false;","search")?></td>
		   </tr>
		    <tr>
				<td>From Date </td><td><?=form_input('from_date',$from_date,
                    "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px' id='from_date'");?></td>
		   </tr>
		    <tr>
				<td>To Date </td><td><?=form_input('to_date',$to_date,
                    "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px' id='to_date'");?></td>
		   </tr>
		   <tr>
				<td>Tanggal</td><td><?=form_input('pay_date',$pay_date,
                    "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px'");?></td>
				<td>Pendapatan</td><td align='right'><?=number_format($total_pendapatan)?></td>
		   </tr>
			<tr>
				<td>Pay Type</td><td><?=form_input('pay_type',$pay_type,"id=pay_type");?></td>
				<td>Potongan</td><td align='right'><?=number_format($total_potongan)?></td>
			</tr>
			<tr>
				<td>Kelompok</td><td><?php 
				echo form_input('emp_level',$emp_level,"id=emp_level");
				echo link_button("","dlghr_emp_level_show();return false;","search");
                ?>
				</td>
				<td><strong>Net Gaji</td></strong>
				<td align='right'><strong><?=number_format($salary)?></strong></td>
			</tr>
	   </table>
	</div>
	
	<?php if($mode=="view") { ?>
	
	<div title="Pendapatan" style="padding:10px">
		<table class='table'>
			<thead>
				<tr>
					<th>No Urut</th><th>Nama Komponen</th><th>Jumlah</th>
					<th>Kode</th><th>Rumus</th><th>Id</th><th>Manual</th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i<count($tunjangan_list);$i++) {
						$jenis=$tunjangan_list[$i];
						$manual=$jenis['manual'];
						$id=$jenis['id'];
						echo "<tr><td>".$jenis['no_urut']."</td><td>".$jenis['salary_com_name']."</td>
						<td><input type='text' name='com_code[".$jenis['salary_com_code']."]'  
						    value='".$jenis['amount']."'>
						</td><td>".$jenis['salary_com_code']."</td>
						<td>".$jenis['formula_string']."</td><td>".$id."</td>
						<td>".form_checkbox("manual[]",$id,$manual?true:false,"id='manual' class='checkbox'")."</td><td>
						</tr>";
				
				} ?>
			</tbody>
		</table>
	</div>
	<div title="Potongan" style="padding:10px">
		<table class='table'>
			<thead>
				<tr>
					<th>No Urut</th><th>Nama Komponen</th><th>Jumlah</th>
					<th>Kode</th><th>Rumus</th><th>Id</th><th>Manual</th>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i<count($potongan_list);$i++) {
						$jenis=$potongan_list[$i];
						$manual=$jenis['manual'];
						$id=$jenis['id'];
						echo "<tr><td>".$jenis['no_urut']."</td><td>".$jenis['salary_com_name']."</td>
						<td><input type='text' name='com_code[".$jenis['salary_com_code']."]'  
						    value='".$jenis['amount']."'>
						</td><td>".$jenis['salary_com_code']."</td>
						<td>".$jenis['formula_string']."</td><td>".$id."</td>
						<td>".form_checkbox("manual[]",$id,$manual?true:false,"id='manual' class='checkbox'")."</td><td>
						</tr>";				
				} ?>
			</tbody>
		</table>
		
	</div>
	<?php } ?>
</div>	

</form>
	
<?php 
 echo $lookup_employee;
 echo $lookup_periode;
 echo $lookup_emp_type;
 
?>

<script type="text/javascript">

	$(document).on('change', '.checkbox', function() {
		var url="";
	    if(this.checked) {
	      // checkbox is checked
		  url=CI_ROOT+'payroll/salary/manual_check/'+this.value;
	    } else {
		  url=CI_ROOT+'payroll/salary/manual_uncheck/'+this.value;
	    }
	    console.log(url);
		$.ajax({
			type: "GET",
			url: url,
			success: function(msg){
				console.log(msg);
			},
			error: function(msg){log_err(msg);}
		});

	    
	});    



    $().ready(function (){
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

    function save_this(){
        if($('#employee_id').val()===''){alert('Isi dulu NIP Karyawan !');return false;};

		url='<?=base_url()?>index.php/payroll/salary/save';
			$('#frmSalary').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#pay_no').val(result.pay_no);
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
						remove_tab_parent();
					} else {
						log_err(result.msg);
					}
				}
			});
    }
	function load_help() {
			window.parent.$("#help").load("<?=base_url()?>index.php/payroll/help/load/salary");
	}
	function print_slip(){
		var pay_no=$("#pay_no").val();
		url="<?=base_url()?>index.php/payroll/salary/print_slip/"+pay_no;
		window.open(url,'_blank');
	}
	function recalc_group(){
	    var pay_no=$("#pay_no").val();
	    var group=$("#emp_level").val();
	    if(pay_no=="" || group==""){
	        log_err("Pilih nomor paycheck atau group emp level !");
	        return false;
	    }
	    var url=CI_ROOT+"payroll/salary/recalc_group/"+pay_no;
	    window.open(url,"_self");
	}
 	function view_absen(){
 		var nip=$("#employee_id").val();
        if(nip==""){log_err("Pilih NIP karyawan !");return false;};
 		var periode=$("#pay_period").val();
 		var url=CI_ROOT+"payroll/absensi/view/"+periode+'/'+nip;
 		add_tab_parent("ViewAbsen_"+periode+'_'+nip,url);
 	}
 	function view_overtime(){
 		var nip=$("#employee_id").val();
        if(nip==""){log_err("Pilih NIP karyawan !");return false;};
 		var periode=$("#pay_period").val();
 		var url=CI_ROOT+"payroll/overtime/view/"+periode+'/'+nip;
 		add_tab_parent("ViewOt_"+periode+'_'+nip,url);
 	}
		
</script>  
