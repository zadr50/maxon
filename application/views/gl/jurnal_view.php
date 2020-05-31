<!-- JURNAL -->
	<DIV title="Jurnal" style="padding:10px" >
		<div id='divJurnal' class='thumbnail'>
		<table id="dgCrdb" class="easyui-datagrid"  width='1000'
			data-options="
				iconCls: 'icon-edit', fitColumns: true, 
				singleSelect: true,toolbar:'#tbJurnal',
				url: '<?=base_url()?>index.php/jurnal/items/<?=$gl_id?>'
			">
			<thead>
				<tr>
					<th data-options="field:'account',width:80">Akun</th>
					<th data-options="field:'account_description',width:150">Nama Akun</th>
					<th data-options="field:'debit',width:80,align:'right'">Debit</th>
					<th data-options="field:'credit',width:80,align:'right'">Credit</th>
					<th data-options="field:'custsuppbank',width:50">Ref</th>
					<th data-options="field:'operation',width:90">Operasi</th>
					<th data-options="field:'source',width:90">Keterangan</th>
					<th data-options="field:'date',width:90">Date</th>
					<th data-options="field:'account_id',width:90">Acc Id</th>
					<th data-options="field:'transaction_id',width:50">Id</th>
				</tr>
			</thead>
			
		</table>
		<?php
		  $row=$this->db->query("select sum(debit) as db,sum(credit) as cr 
		      from gl_transactions where gl_id='$gl_id'")->row();
		  echo "<p>Total Debit: ".number_format($row->db).", Total Credit: ".number_format($row->cr).", 
		      Saldo: ".number_format($row->db-$row->cr)."</p>";
		?>
		
		</div>
			
	</DIV>
