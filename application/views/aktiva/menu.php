<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Fixed Assets Modules</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul>
<li><?=anchor('aktiva/aktiva_proses','Proses Penyusutan Bulanan','class="info_link link2"');?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
						<?=include_once("menu_reports.php")?>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
<li><?=anchor('aktiva/aktiva','Aktiva Tetap','class="info_link link2"');?></li>
<li><?=anchor('aktiva/aktiva_group','Kelompok Aktiva Tetap','class="info_link link2"');?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
