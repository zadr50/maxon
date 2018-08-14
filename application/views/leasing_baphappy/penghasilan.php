<table width='100%' style="border:none">
	<tr><td>Gaji/Penghasilan</td><td><?=form_input('salary',$salary, $disabled);?> / bln </td></tr>
	<tr><td>Sumber</td><td><?=form_input('salary_source',$salary_source, $disabled);?></td></tr>
	<tr><td>Penghasilan Pasangan</td><td><?=form_input('spouse_salary',$spouse_salary, $disabled);?> / bln</td></tr>
	<tr><td>Sumber</td><td><?=form_input('spouse_salary_source',$spouse_salary_source, $disabled);?></td></tr>
	<tr><td>Penghasilan Lainnya</td><td><?=form_input('other_income',$other_income, $disabled);?> / bln</td></tr>
	<tr><td>Sumber</td><td><?=form_input('other_income_source',$other_income_source, $disabled);?></td></tr>
	<tr><td>Pengeluaran</td><td><?=form_input('deduct',$deduct, $disabled);?> / bln</td></tr>
	<tr><td>Pinjaman di Tempat Lain</td><td><?=form_input('other_loan',$other_loan, $disabled);?> / bln</td></tr>
</table>