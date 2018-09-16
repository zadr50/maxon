<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span>Sekolah Modules</span>
			<ul>
				<li>
					<span>Operation</span>
					<ul>
						<?php echo info_link("sekolah/jadwal_belajar","Jadwal Belajar");
						
						?>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
						<?php echo info_link("sekolah/reports","Daftar Laporan");
						
						?>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
						<?php echo info_link("siswa","Siswa");
						
						?>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
