<?php
	$invoice_number=$this->session->userdata('invoice_number');
?>
 
    <h3>Operation</h3>
 		<div class="thumbnail"> 
			<li><?=anchor('payroll/salary','Slip Gaji');?></li>
			<li><?=anchor('payroll/absensi','Absensi');?></li>
			<li><?=anchor('payroll/absensi/detail','Absensi Data');?></li>
			<li><?=anchor('payroll/overtime','Overtime');?></li>
			<li><?=anchor('payroll/cuti','Cuti');?></li>
			<li><?=anchor('payroll/pinjaman','Pinjaman');?></li>
			<li><?=anchor('payroll/pengobatan','Pengobatan');?></li>
 		</div>
 		<div class="thumbnail"> <h3>Master</h3>
			<li><?=anchor('payroll/employee','Pegawai')?></li>
			<li><?=anchor('payroll/employee_level','Level Group')?></li>
			<li><?=anchor('payroll/ptkp','Status Kawin (PTKP)')?></li>
			<li><?=anchor('payroll/employee_jenis','Jenis')?></li>
			<li><?=anchor('payroll/jenis_income','Jenis Pendapatan')?></li>
			<li><?=anchor('payroll/jenis_deduct','Jenis Potongan')?></li>
			<li><?=anchor('payroll/posisi_jabatan','Jabatan (Posisi)')?></li>
			<li><?=anchor('payroll/holiday','Hari Libur')?></li>
 		</div>
