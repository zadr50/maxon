<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Koperasi Modules</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul>
<li><?=anchor('koperasi/pinjaman','Pinjaman','class="info_link link2"');?></li>
<li><?=anchor('koperasi/simpanan_setor','Setoran','class="info_link link2"');?></li>
<li><?=anchor('koperasi/angsuran_setor','Cicilan','class="info_link link2"');?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
<li><?=anchor('koperasi/simpanan_rekap','Rekap Simpanan','class="info_link link2"');?></li>
<li><?=anchor('koperasi/jenis_simpanan_saldo','Rekap Saldo Jenis Simpanan','class="info_link link2"');?></li>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
<li><?=anchor('koperasi/anggota','Anggota','class="info_link link2"')?></li>
<li><?=anchor('koperasi/kelompok','Kelompok Anggota','class="info_link link2"')?></li>
<li><?=anchor('koperasi/petugas','Petugas','class="info_link link2"')?></li>
<li><?=anchor('koperasi/jenis_simpanan','Jenis Simpanan','class="info_link link2"');?></li>
<li><?=anchor('koperasi/jenis_pinjaman','Jenis Pinjaman','class="info_link link2"');?></li>
<li><?=anchor('koperasi/rekening','Rekening Simpanan','class="info_link link2"');?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
