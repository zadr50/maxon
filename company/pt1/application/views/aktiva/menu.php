<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span>Banks Modules</span>
			<ul>
				<li>
					<span>Operation</span>
					<ul>
			<li><?=anchor('aktiva','Aktiva Tetap','class="info_link"');?></li>
			<li><?=anchor('aktiva_group','Kelompok Aktiva Tetap','class="info_link"');?></li>
			<li><?=anchor('aktiva_proses','Proses Penyusutan Bulanan','class="info_link"');?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
			<li><?=anchor('aktiva/rpt/aktiva','Daftar Aktiva Tetap','class="info_link"')?></li>
			<li><?=anchor('aktiva/rpt/group','Daftar Kelompok Aktiva Tetap','class="info_link"')?></li>
			<li><?=anchor('aktiva/rpt/proses','Daftar Penyusutan Aktiva','class="info_link"')?></li>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
