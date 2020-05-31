<div style="margin:10px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Payroll Modules</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul>
<li><?=anchor('payroll/salary','Slip Gaji','class="info_link link2"');?></li>
<li><?=anchor('payroll/salary/generate','Generate Slip Gaji','class="info_link link2"');?></li>
<li><?=anchor('payroll/pph21','Proses PPH 21','class="info_link link2"');?></li>
<li><?=anchor('payroll/absensi','Absensi','class="info_link link2"');?></li>
<li><?=anchor('payroll/absensi/generate','Generate Absensi','class="info_link link2"');?></li>
<li><?=anchor('payroll/overtime','Overtime','class="info_link link2"');?></li>
<li><?=anchor('payroll/cuti','Cuti Karyawan','class="info_link link2"');?></li>
<li><?=anchor('payroll/pinjaman','Pinjaman','class="info_link link2"');?></li>
<li><?=anchor('payroll/medical','Pengobatan','class="info_link link2"');?></li>
<li><?=anchor('payroll/shift_schedule','Jadwal Kerja Shift','class="info_link link2"');?></li>
					</ul>
				</li>
				<li   data-options="state:'closed'">
					<span>Report</span>
					<ul>
						<?php include_once("menu_reports.php")?>
					</ul>
				</li>
				<li  data-options="state:'closed'">
					<span>Master</span>
					<ul>
<li><?=anchor('payroll/employee','Pegawai','class="info_link link2"')?></li>
<li><?=anchor('payroll/group','Level Group','class="info_link link2"')?></li>
<li><?=anchor('payroll/ptkp','Status Kawin (PTKP)','class="info_link link2"')?></li>
<li><?=anchor('payroll/pelamar','Calon Pegawai','class="info_link link2"')?></li>
<li><?=anchor('payroll/income','Jenis Pendapatan','class="info_link link2"')?></li>
<li><?=anchor('payroll/deduct','Jenis Potongan','class="info_link link2"')?></li>
<!--
<li><?=anchor('payroll/level','Level Jabatan (Posisi)','class="info_link link2"')?></li>
<li><?=anchor('payroll/holiday','Hari Libur','class="info_link link2"')?></li>
-->
<li><?=anchor('payroll/periode','Periode Penggajian','class="info_link link2"')?></li>
<li><?=anchor('payroll/shift','Kode Shift','class="info_link link2"')?></li>
<li><?=anchor('payroll/jenis_absensi','Kode Absensi','class="info_link link2"')?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
