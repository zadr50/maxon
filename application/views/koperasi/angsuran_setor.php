<div class="thumbnail box-gradient">
	<?php
   $min_date=$this->session->userdata("min_date","");
	
	echo link_button('Save', 'save_this()','save');		
	echo link_button('Print', 'print_bukti()','print');		
	
	?>
	<div style="float:right">
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help()">Help</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?php echo link_button('Help', 'load_help()','help');		
	echo link_button("Close", "remove_tab_parent()","cancel");
	?>
	</div>
</div>

<?php echo validation_errors(); ?>

<div class="easyui-tabs" style="width:auto;height:auto;min-height:300px">
	<div title="General" style="padding:10px">
 
	<form id="frmLoan"  method="post">
		<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
	   <table class='table'>
			<tr><td>Nomor Bukti</td>
				<td>
					<?php
					if($mode=='view'){
						echo "<span class='thumbnail'><strong>$payment_no</strong></span>";
						echo "<input type='hidden' id='payment_no' value='$payment_no'>";
					} else { 
						echo form_input('$payment_no',$payment_no,"id=$payment_no");
					}		
					?>
				</td>
				<td rowspan='3' colspan='4'>
					<div id='nama' class="thumbnail" style="width:400px;height:100px">
						<?=$nama_anggota?>
					</div>
				</td>
			</tr>	 
		   <tr>
				<td>Nomor Anggota</td><td><?=form_input('no_anggota',$no_anggota,"id=no_anggota");
					echo link_button("","select_anggota()","search")
					?></td>
		   </tr>
		   <tr>
				<td>Nomor Pinjaman</td><td><?=form_input('no_pinjaman',$no_pinjaman,"id=no_pinjaman");
					echo link_button("","select_pinjaman()","search")
					?></td>
		   </tr>
		   <tr>
				<td>Angsuran Ke</td><td><?=form_input('bulan_ke',$bulan_ke);?></td>
				<td>Jumlah Tagihan</td><td><?=form_input('tagihan',$tagihan);?></td>
		   </tr>
			<tr>
				<td>Tanggal Bayar</td><td><? echo form_input('tanggal_bayar',$tanggal_bayar,"id=tanggal_bayar class='easyui-datetimebox' 
				data-options='formatter:format_date,parser:parse_date' style='width:180px'");?></td>
				<td>Tanggal Tagihan</td><td><?=form_input('tanggal_tagih',$tanggal_tagih,"id=tanggal_tagih 
				class='easyui-datetimebox' data-options='formatter:format_date,parser:parse_date' style='width:180px'");?></td>
		   </tr>
		   <tr>
				<td>Jumlah Bayar</td><td><?=form_input('bayar',$bayar,"id='bayar'");?></td>
				<td>Denda</td><td><?=form_input('denda',$denda,"id=denda");?></td>
				<td>Admin</td><td><?=form_input('admin',$admin,"id='admin'");?></td>
		   </tr>
		   <tr><td>Catatan</td><td colspan="4"><?=form_input('comments',$comments,"style='width:400px'");?></td></tr>
		   <tr>
		   </tr>
	   </table>
	   </form>
	</div>
	 
	 
</div>	

<script type="text/javascript">
    function save_this(){
        var valid_date=true;
        var min_date='<?=$min_date?>';
        var tanggal=$('#tanggal_bayar').datetimebox('getValue'); 
        if(tanggal<min_date){
            valid_date=false;
        }
        if(!valid_date){alert("Tanggal tidak benar ! Mungkin sudah closing !");return false;}
        
        if($('#nip').val()===''){alert('Isi dulu NIP Karyawan !');return false;};

		url='<?=base_url()?>index.php/pinjaman/save';
			$('#frmLoan').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#loan_number').val(result.loan_number);
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
			window.parent.$("#help").load("<?=base_url()?>index.php/help/load/pinjaman");
	}
	function select_anggota(){
		lookup1({id:"kop_anggota", 
			url:CI_ROOT+"lookup/query/kop_anggota",
			fields: [[
		        {field:'no_anggota',title:'Kode Anggota',width:80},
		        {field:'nama',title:'Nama',width:300},
		        {field:'phone',title:'Phone',width:80},
		        {field:'group_type',title:'Kelompok',width:80}
    		]],
    		result: function result(){
    			$("#no_anggota").val(r.data.no_anggota);
    			$("#nama").html(r.data.nama+"\r"+r.data.street);
    		}
		});		
	}
	function select_pinjaman(){
		lookup1({id:"kop_pinjaman", 
			url:CI_ROOT+"lookup/query/kop_pinjaman",
			fields: [[
		        {field:'no_pinjaman',title:'Nomor Pinjaman',width:80},
		        {field:'nama',title:'Nama',width:300},
		        {field:'no_anggota',title:'Nomor Anggota',width:80}
    		]],
    		result: function result(){
    			$("#no_pinjaman").val(r.data.no_pinjaman);
    		}
		});		
	}
		
</script>  
