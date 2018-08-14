<!--[if IE]><script type="text/javascript" src="excanvas.js"></script><![endif]-->

<script type="text/javascript" src="<?=base_url()?>js/clock/coolclock.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/clock/moreskins.js"></script>
<body onload="CoolClock.findAndCreateClocks()"></body>

	<div class="col-sm-5">
	 
		<div class="thumbnail">	
			<canvas class="CoolClock:chunkySwiss"></canvas>
		</div>	
		<div class="thumbnail">
		<strong>INPUT ABSEN </strong>
		</div>
		<div class="thumbnail">
			<form id="frmAbsen" method="POST">
		   <table class='table2' width='100%'>
		      <tr><td>NIP</td><td><input id="nip" onblur="cari_nip()" name="nip"></td></tr>
			  <tr><td>Tanggal</td><td><input id="tanggal" name="tanggal" value="<?=$tanggal?>" class="easyui-datetimebox" style="width:140px
				data-options='formatter:format_date,parser:parse_date'
				"></td></tr>
			  <tr><td>Jam Masuk</td><td><input id="time_in" name="time_in"></td></tr>
		      <tr><td>Jam Keluar</td><td><input id="time_out" name="time_out"></td></tr>
		      <tr><td> <?=link_button('Tambah','add_absen()','save','false')?></td></tr>
		   </table>
		   </form>
		</div>
		<div class="thumbnail">
			<h5>Data Pegawai</h5>
		   <table class='table2' width='100%'>
		      <tr><td>Nama</td><td><input id="nama" name="nama" disabled></td></tr>
			  <tr><td>Dept</td><td><input id="dept" name="dept" disabled></td></tr>
			  <tr><td>Divisi</td><td><input id="divisi" name="divisi" disabled></td></tr>
		      <tr><td>Nip Id</td><td><input id="nip_id" name="nip_id" disabled></td></tr>
		      <tr><td>Type</td><td><input id="emptype" disabled></td></tr>
		      <tr><td>
			 
			  </td></tr>
		   </table>
		</div>

	</div>	
	<div class="col-sm-1 col-md-5">
		<div id="divAbsen" class="">	
			<table id="dg" class="easyui-datagrid"  width='100%'
				style="width:400px;min-height:800px"
				data-options="
					iconCls: 'icon-edit',fitColumns: true,
					singleSelect: true,
					toolbar: '#tb',
					url: '<?=base_url()?>index.php/payroll/absensi/data'
					
					">
				<thead>
					<tr>
						<th data-options="field:'nip'">NIP</th>
						<th data-options="field:'nama'">Nama</th>
						<th data-options="field:'time_in',align:'right',editor:{type:'numberbox',options:{precision:2}}">Time In</th>
						<th data-options="field:'time_out',align:'right',editor:{type:'numberbox',options:{precision:2}}">Time Out</th>
						<th data-options="field:'id',align:'right'">Line</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>	 
<div id='tb'>
	<?=link_button('Absensi','load_absensi()','edit')?>
</div> 
<script type="text/javascript">
	function load_absensi(){
		var row = $('#dg').datagrid('getSelected');
		if(row){
			window.open('<?=base_url()?>index.php/payroll/absensi/detail/'+row.nip,'_self');
		} else {
			alert("Pilih satu baris untuk melihat data absensi.");
		}
	}
	function cari_nip(){
		var nip=$("#nip").val();
		var url="<?=base_url()?>index.php/payroll/employee/find/"+nip;
	    $.ajax({
	                type: "GET", url: url,
	                success: function(msg){
	                    var obj=jQuery.parseJSON(msg);
	                    $('#nama').val(obj.nama);
	                    $('#nip_id').val(obj.nip_id);
	                    $('#dept').val(obj.dept);
	                    $('#divisi').val(obj.divisi);
	                    $('#emptype').val(obj.emptype);
	                },
	                error: function(msg){alert(msg);}
	    });
		
	}
    function add_absen(){
        if($('#nip').val()===''){alert('Isi NIP !');return false;};
		url='<?=base_url()?>index.php/payroll/absensi/save';
		$('#frmAbsen').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$("#nip").val('');
					$('#dg').datagrid({url:'<?=base_url()?>index.php/payroll/absensi/data'});
					$('#dg').datagrid('reload');
					$.messager.show({
						title:'Success',msg:'Data sudah tersimpan.'
					});
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});
	    
    }
   
</script>  

 
 