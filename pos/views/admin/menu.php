<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span>Administration Modules</span>
			<ul>
				<li>
					<span>Operation</span>
					<ul>
			<li><?=anchor('company','Nama Perusahaan', 'class="info_link"')?></li>
			<li><?=anchor('user','User Login',' class="info_link"');?></li>
			<li><?=anchor('periode','Periode Akuntansi', 'class="info_link"')?></li>
			<li><?=anchor('jobs','User Job Group',' class="info_link"');?></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/company/sales " class="info_link">Penjualan</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/company/purchase" class="info_link">Pembelian</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/company/inventory" class="info_link">Inventory</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/company/gl_link" class="info_link">Link Perkiraan</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/nomor" class="info_link">Penomoran</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/company/others" class="info_link">Lain-lain</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/modules"  class="info_link">Modules</a></li>
			<li><?=anchor('company/department','Department','class="info_link"');?></li>
			<li><?=anchor('company/division','Division','class="info_link"');?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
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
