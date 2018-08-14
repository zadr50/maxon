<?
	$d1=$this->input->post('txtDateFrom');
	$d1=date("Y-m-d",strtotime($d1));
	$d2=$this->input->post('txtDateTo');
	$d2=date("Y-m-d H:n:s",strtotime($d2));
	$cst=$this->input->post('text1');
	$sql="select sum(amount_recv) as z_amt from qry_ls_cash_receive ";
	$sql.=" where tanggal<'".$d1."'";
	 
	
	$saldo=0;
	$mutasi=0;
	
	if($cst!="")$sql.=" and cust_name like '%".$cst."%'";
	if($q=$this->db->query($sql)){
		if($row=$q->row()){
			$saldo=$row->z_amt;
		}
	}
	$sql="select sum(amount_recv) as z_amt from qry_ls_cash_receive ";
	$sql.=" where tanggal between '".$d1."' and '".$d2."'";
	if($cst!="")$sql.=" and cust_name like '%".$cst."%'";
	
	 
	if($q=$this->db->query($sql)){
		if($row=$q->row()){
			$mutasi=$row->z_amt;
		}
	}
	echo "<p>Saldo Awal: ".number_format($saldo)."</p>";
	echo "<p>Mutasi    : ".number_format($mutasi)."</p>";
	echo "<p>Saldo Akhir: ".number_format($saldo+$mutasi)."</p>";

?>