<?
	if($q=$CI->db->query("select las.*,cm.cust_name,cm.street,cm.phone,
		cm.kec,cm.kel,lam.inst_amount,lam.inst_month
		from ls_app_survey las
		left join ls_app_master lam on lam.app_id=las.app_id 
		left join ls_cust_master cm on cm.cust_id=lam.cust_id
		where las.status=0 and survey_by='".$CI->access->user_id()."'")){
		if($q->num_rows()){
			echo "<div class='alert alert-warning'><legend>Anda mendapatkan tugas survey sebagai berikut : </legend>
			<p>Silahkan lakukan survey kealamat berikut ini. Klik link untuk mulai input survey.</p>";
			echo "<table class='table2'>
			<thead><tr><th>Nomor SPK</th><th>Jadwal</th><th>Nama Customer</th>
			<th>Alamat</th><th>Kecamatan</th><th>Kelurahan</th><th>Telpon</th></tr>
			<tbody>";
			foreach($q->result() as $row){
				echo "<tr><td><a href='#' 
				onclick=\"survey_spk('".$row->app_id."');return false;\" >".$row->app_id."</a></td><td>".$row->survey_date
				."</td><td>".$row->cust_name."</td><td>".$row->street."</td>
				.<td>".$row->kec."</td><td>".$row->kel."</td><td>".$row->phone."</td></tr>";
				$desc="";			
				$r2=$this->db->select("description")->where("app_id",$row->app_id)
				->get("ls_app_object_items")->row();
				if($r2){
					$desc=$r2->description;
				}
				echo "<tr><td></td><td colspan=5><i>Produk: $desc , Tenor: $row->inst_month bulan, 
				Cicilan: ".number_format($row->inst_amount)."</i></td></tr>";

			}
			echo "</tbody>
			</table><div>&nbsp</div></div>";
		}
	}
?>

<script language="javascript">
	function survey_spk(nomor_spk){
		var  url="<?=base_url()?>index.php/leasing/survey/proses/"+nomor_spk;
		add_tab_parent('proses_survey',url);
	}
	
</script>