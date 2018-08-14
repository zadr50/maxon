<div class='thumbnail box-gradient'>
<?php
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print()','print');		
	echo link_button('Add','','add','false',base_url().'index.php/payroll/employee/add');		
	echo link_button('Refresh','frmEmployeeReload()','reload','false');		
    echo link_button('Import','import_excel()','csv','false');     
	echo link_button('Search','','search','false',base_url().'index.php/payroll/employee');		
?>	
    <div style='float:right'>
	<?=link_button('Help', 'load_help(\'employee\')','help');?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
    <?=link_button('Close','remove_tab_parent()','cancel');?>         
	
	</div>
</div>

<?php 
$readonly=$mode=="view"?"readonly":"";
$err=validation_errors(); 
if($err!=""){
    echo "<div class='alert alert-warning'><p>$err</p></div>";
}
?>

<div class="easyui-tabs" style="width:auto;height:auto;min-height:300px">
	<div title="General" style="padding:10px">
		<form id="frmEmployee"  method="post">
			<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
		   <table class='table2' width='100%'>
			<tr>
				<td>Kode Pegawai - NIP  </td>
				<td><?=form_input('nip',$nip,"id=nip $readonly");?></td>
				<td>Group</td><td><?=form_dropdown('emptype',$group_list,$emptype,"id=emptype");?>
				<?php echo link_button('Add','add_groups();return false;','add');		?>
				</td>
                <td>Location</td><td><? echo form_input('location',$location,"id='location'");
                    echo link_button('','dlgshipping_locations_show()',"search"); 
                ?></td>				
			</tr>	 
			<tr><td>Nama Pegawai</td><td colspan="3"><?=form_input('nama',$nama,"id=nama style='width:400px'");?></td>
                <td>Shift Group</td><td><?=form_input('shift_group',$shift_group,"id='shift_group'");?></td>       
			    
			    
			</tr>
			   <tr>
					<td>Departemen</td><td><?=form_dropdown('dept',$dept_list,$dept,"id=dept");?>
					<?php echo link_button('Add','add_dept();return false;','add');		?>
					
					</td>
					<td>Level</td><td><?=form_dropdown('emplevel',$level_list,$emplevel,"id=emplevel");?>
					</td>
                    <td>Sisa Cuti</td><td><?=form_input('sisa_cuti',$sisa_cuti,"id='sisa_cuti'");?></td>       
			   </tr>
			   <tr>
					<td>Divisi</td><td><?=form_dropdown('divisi',$div_list,$divisi,"id=divisi");?>
					<?php echo link_button('Add','add_divisi();return false;','add');		?>
					
					</td>
					<td>Posisi</td><td><?=form_input('position',$position,"id=position");?>
					</td>       
                    <td>Resigned </td><td><?=form_input('is_resigned',$is_resigned);?>
                        <br><i>* 0-No, 1-Yes</i>
                    </td>
			   </tr>
			   <tr></tr>
			   <tr>
					<td>Status</td><td><?=form_dropdown('status',$status_list,$status,"id=status");?>
					<?php echo link_button('Add','add_ptkp();return false;','add');		?>
					
					</td>
					<td>ID Mesin</td><td><?=form_input('nip_id',$nip_id);?></td>
                    <td>Resigned Date</td><td><?=form_input('resigned_date',$resigned_date);?></td>
			   </tr>
			   <tr></tr>
			   <tr></tr>

			   <tr></tr>
			   <tr>
					<td>NPWP</td><td><?=form_input('npwp',$npwp);?></td>
					<td>Nama Atasan</td><td><?=form_input('supervisor',$supervisor);?></td>
					<td>Foto</td><td><?=form_input('pathimage',$pathimage);?></td>
			   </tr>
			   <tr>
					<td>Rekening</td><td><?=form_input('account',$account);?></td>
					<td>Bank</td><td><?=form_input('bank_name',$bank_name,"id=bank_name");?>
					</td>
					
				</tr>
			   <tr><td>Alamat</td><td colspan="4"><?=form_input('alamat',$alamat,"style='width:400px'");?></td></tr>
			   <tr>
					<td>Kode Pos</td><td><?=form_input('kodepos',$kodepos);?></td>
					<td>Telpon</td><td><?=form_input('telpon',$telpon);?></td>
			   </tr>
			   <tr>
					<td>Pendidikan</td><td><?=form_input('pendidikan',$pendidikan,"id=pendidikan");?>
					</td>
					<td>Handphone</td><td><?=form_input('hp',$hp);?></td>
			   </tr>
			   <tr>
					<td>Agama</td><td><?=form_input('agama',$agama,"id=agama");?>
					</td>
					<td>Tanggal Masuk</td><td><?=form_input('hireddate',$hireddate,
                                                "class='easyui-datetimebox' 
						data-options='formatter:format_date,parser:parse_date'
						style='width:150px'");?></td>
				</tr>
			   <tr>
					<td>Tempat Lahir</td><td><?=form_input('tempat_lahir',$tempat_lahir);?></td>
					<td>Tanggal Lahir</td><td><?=form_input('tgllahir',$tgllahir,
                                                "class='easyui-datetimebox' 
					data-options='formatter:format_date,parser:parse_date'
					style='width:150px'");?></td>
			   </tr>

			   <tr>
					<td>Gol Darah</td><td><?=form_dropdown('gol_darah',
						array(""=>"","A"=>"A","B"=>"B","AB"=>"AB","O"=>"O"),$gol_darah);?>
					</td>
					<td>Pria/Wanita</td><td><?=form_dropdown('kelamin',array("L"=>"Pria","P"=>"Wanita"),$kelamin);?></td>       	
			   </tr>
			   <tr><td>Nomor KTP/SIM</td><td><?=form_input('idktpno',$idktpno);?></td>
					<td>Gaji Pokok</td><td><?=form_input('gp',$gp);?></td>
			   </tr>

			   <tr><td></td><td></td>
					<td>Tun Jabatan</td><td><?=form_input('tjabatan',$tjabatan);?></td>
			   </tr>
			   <tr></tr>
			   <tr></tr>
		   </table>
		   </form>
	</div>
	<div title='Pengalaman'><? include_once "employee_experience.php" ?></div>
	<div title="Pendidikan"><? include_once "employee_education.php" ?></div>
	<div title='Keluarga'><? include_once "employee_family.php" ?></div>
	<div title='Medical'><? include_once "employee_medical.php" ?></div>
	<div title='Reward And Funish'><? include_once "employee_reward.php" ?></div>
	<div title='Kartu Identitas'><? include_once "employee_license.php" ?></div>
	<div title='Training'><? include_once "employee_training.php" ?></div>
</div>

<div id="dlgGambar" class="easyui-dialog" 
 style="width:300px;height:200px;padding:5px 5px;left:100px;top:20px" closed="true" >
    <div class="thumbnail">
    <?php 
        echo form_open_multipart(base_url()."index.php/payroll/employee/do_upload_picture","id='frmUpload'");
    ?>
        <input type="file" name="userfile" id="userfile" size="20" title="Pilih Gambar" stye="float:left" />
        <input type="button" value="Submit" onclick="do_upload()">  
        </form>
    </div>
    <div id='error_upload'></div>
</div>
<div id="dlgExcel" class="easyui-dialog" title="Import Data" 
 style="width:400px;height:300px;padding:5px 5px" closed="true" >
    <div class="thumbnail">
        <p class='alert alert-info'>Silahkan pilih nama file format text tab delimited (*.TXT) data karyawan dibawah ini,
           kemudian klik tombol submit.</p>
    <?php 
        echo form_open_multipart(base_url()."index.php/payroll/employee/import_excel","id='dlgExcelForm'");
    ?>
        <input type="file" name="file_excel" id="file_excel" stye="width:300px" />
        <p></p>
        <p></p>
        <p class='thumbnail'>
        <input type="button" value="Submit" onclick="dlgExcelSubmit()" class='btn btn-primary'>  
        </p>
        </form>
    </div>
    <div id='dlgExcelInfo'></div>
</div>
<?php 
echo $lookup_outlet;
?>
<script type="text/javascript">
    function save_this(){
        if($('#nip').val()===''){alert('Isi dulu NIP Karyawan !');return false;};
        if($('#nama').val()===''){alert('Isi dulu nama karyawan !');return false;};

		url='<?=base_url()?>index.php/payroll/employee/save';
			$('#frmEmployee').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#nip').val(result.nip);
						$('#mode').val('view');
						log_msg('Data sudah tersimpan.');
					} else {
						log_err(result.msg);
					}
				}
			});
    }
	function frmEmployeeReload(){
		var nip=$("#nip").val();
		if(nip==""){alert("Isi NIP dulu !");return false}
		var url='<?=base_url()?>index.php/payroll/employee/view/'+nip;
		window.open(url,"_self");
	}
	function add_groups(){
		add_tab_parent("Level Groups",CI_ROOT+"payroll/group");
	}
	function add_dept(){
		add_tab_parent("Department",CI_ROOT+"company/department");
	}
	function add_divisi(){
		add_tab_parent("Division",CI_ROOT+"company/division");
	}
	function add_ptkp(){
		add_tab_parent("PTKP",CI_ROOT+"payroll/ptkp");
	}
	
    function do_upload()
    {
        var xurl='<?=base_url()?>index.php/payroll/employee/do_upload_picture';
            $('#frmUpload').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    console.log(result);
                    var result = eval('('+result+')');
                    if (result.success){
                        
                        //$.messager.show({
                        //  title:'Success',msg:'Data sudah tersimpan. Silahkan simpan formulir ini.'
                        //});
                        
                        var upload_data=result.upload_data;
                        $('#pathimage').val(upload_data['file_name']);
                        $('#dlgGambar').dialog('close');
                        save();
                        
                    } else {
                        $('#error_upload').html(result.error);
                    }
                }
            });
         

    }
    function upload_gambar()
    {
        $('#dlgGambar').dialog('open').dialog('setTitle','Upload Gambar');
    }
    function import_excel(){
        add_tab_parent("Import",CI_ROOT+"payroll/employee/import");
    }
    function dlgExcelSubmit(){
        var xurl='<?=base_url()?>index.php/payroll/employee/import_excel';
        $('#dlgExcelForm').form('submit',{
            url: xurl, onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                console.log(result);
                var result = eval('('+result+')');
                if (result.success){
                    $('#dlgExcel').dialog('close')
                    log_msg("Data sudah diimport, periksa data table search.");
                } else {
                    log_err(result.msg);
                }
            }
        });
    }
	
		
</script>  
