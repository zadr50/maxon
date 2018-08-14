<?
	$visited=" and lcs.visited=0";
	if($this->input->get("visited")) $visited=" and lcs.visited=1";
	$sql="select lcs.sch_date,lcs.invoice_no,ih.idx_month, 
		cm.cust_name,cm.street,cm.phone,cm.kec,cm.kel,lcs.visit_ke,lcs.visited,lcs.id  
		from ls_loan_col_sched lcs
		left join ls_invoice_header ih on ih.invoice_number=lcs.invoice_no
		left join ls_loan_master lm on lm.loan_id=ih.loan_id 
		left join ls_cust_master cm on cm.cust_id=lm.cust_id
		where ih.paid=0  and lcs.user_col='".$CI->access->user_id()."' $visited 
		order by lcs.invoice_no,lcs.visit_ke";
		
	if($q=$CI->db->query($sql)){
		if($q->num_rows()){
			echo "<legend>Anda mendapatkan tugas untuk menagih angsuran yang telat sebagai berikut : </legend>
			<p>Klik link untuk mulai input data kolek tagihan.</p>";
			echo "<p><a href='#' onclick='coll_visited();return false'>Lihat Data lama </a>";
			echo "<table class='table2'>
			<thead><tr><th>Nomor Faktur</th><th>Jadwal</th><th>Nama Customer</th>
			<th>Alamat</th><th>Kecamatan</th><th>Kelurahan</th><th>Telpon</th>
			<th>Angsuran Ke</th><th>Visit Ke</td><td>Visited</td><td>RowId</td>
			</tr>
			<tbody>";
			foreach($q->result() as $row){
				echo "<tr><td><a href='#' 
				onclick=\"view_invoice('".$row->invoice_no."','".$row->id."');return false;\" >".$row->invoice_no."</a></td>"
				."</td><td>".$row->sch_date."</td><td>".$row->cust_name."</td><td>".$row->street."</td>
				.<td>".$row->kec."</td><td>".$row->kel."</td><td>".$row->phone."</td>
				<td>".$row->idx_month."</td>
				<td>".$row->visit_ke."</td>
				<td>".$row->visited."</td>
				<td>".$row->id."</td></tr>";
			}
			echo "</tbody>
			</table>";
		}
	}
?>

<script language="javascript">
	function view_invoice(nomor_faktur,id){	
		var  url="<?=base_url()?>index.php/leasing/loan/tagih/"+nomor_faktur+"/"+id;
		add_tab_parent('proses_tagih',url);
	}
	function coll_visited(){
		var  url="<?=base_url()?>index.php/leasing/loan/tagih/"+nomor_faktur+"/"+id;
		add_tab_parent('proses_tagih',url);
	
	}
</script>