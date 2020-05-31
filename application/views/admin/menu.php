<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Administration</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul>
			<li><?=anchor('periode','Periode Akuntansi', 'class="info_link"')?></li>
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
			<li><?=anchor('user','User Login',' class="info_link"');?></li>
			<li><?=anchor('jobs','User Job Group',' class="info_link"');?></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/company/sales " class="info_link link2">Penjualan</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/company/purchase" class="info_link link2">Pembelian</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/company/inventory" class="info_link link2">Inventory</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/company/gl_link" class="info_link link2">Link Perkiraan</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/nomor" class="info_link link2">Penomoran</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/company/others" class="info_link link2">Lain-lain</a></li>
			<li><a class="info_link" href="<?=base_url()?>index.php/modules"  class="info_link link2">Modules</a></li>
			<li><?=anchor('company/department','Department','class="info_link link2"');?></li>
			<li><?=anchor('company/division','Division','class="info_link link2"');?></li>
			<li><?=anchor('company','Nama Perusahaan', 'class="info_link link2"')?></li>
            <li><?=anchor('sysvar_data','System Variables', 'class="info_link link2"')?></li>
            <li><?=anchor('admin/themes','Themes', 'class="info_link link2"')?></li>
            <li><?=anchor('admin/query','Query Express', 'class="info_link link2"')?></li>
            <li><?=anchor('company/check_db_structure ','Check Database', 'class="info_link link2"')?></li>
            
           
					</ul>
				</li>
			</ul>
		</li>
	</ul>
