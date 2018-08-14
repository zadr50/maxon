<?
echo "<p> </p>";
if($qbank=$this->db->get("bank_accounts")){
	echo "<table class='table'><thead><th>Rekening</th><th>Nama Bank</th>
	<th>Cabang</th><th>Atas Nama</th></thead>
	<tbody>";
	foreach($qbank->result() as $bank)
	{
		echo "<tr><td>$bank->bank_account_number</td><td>$bank->bank_name</td>
		<td>$bank->city</td><td>$bank->contact_name</td></tr>";
	}
	echo "</tbody></table>";
}
