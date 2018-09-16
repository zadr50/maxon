<!-- JURNAL -->
	<DIV title="Jurnal" style="padding:10px" >
		<div id='divJurnal' class='thumbnail'>
		<table id="dgCrdb" class="easyui-datagrid"  width='750'
			data-options="
				iconCls: 'icon-edit', fitColumns: true, 
				singleSelect: true,toolbar:'#tbCrdb',
				url: '<?=base_url()?>index.php/jurnal/items/<?=$gl_id?>'
			">
			<thead>
				<tr>
					<th data-options="field:'account',width:80">Akun</th>
					<th data-options="field:'account_description',width:150">Nama Akun</th>
					<th data-options="field:'debit',width:80,align:'right'">Debit</th>
					<th data-options="field:'credit',width:80,align:'right'">Credit</th>
					<th data-options="field:'custsuppbank',width:50">Ref</th>
					<th data-options="field:'operation',width:50">Operasi</th>
					<th data-options="field:'source',width:50">Keterangan</th>
					<th data-options="field:'transaction_id',width:50">Id</th>
				</tr>
			</thead>
		</table>
		</div>
			
	</DIV>
