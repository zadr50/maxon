<legend>Daftar Tagihan jatuh tempo</legend>
<div class='alert alert-info'>
	<p>Dibawah ini adalah daftar billing tagihan yang jatuh tempo 
	hari ini tanggal  [<strong><?=date("Y-m-d")?></strong>]
	</p>
</div>
<?php
$d1=date("Y-m-d");
$d2=date("Y-m-d")." 23:59:59";
$dealer_name="";
/*h.amount,h.amount_paid,h.cust_deal_id,
, c.spouse_hp AS HPPasangan, c.phone TlpRumah
					lam.create_by,u.username,
					h.pokok,h.bunga,h.denda_tagih,
					h.pokok_paid,h.bunga_paid,h.denda as denda_paid,
					h.pokok-h.pokok_paid as pokok_saldo,
					h.bunga-h.bunga_paid as bunga_saldo,
					h.paid,h.payment_method, h.date_paid,
					lc.area,lc.counter_id, l.dealer_id,h.loan_id,
					h.invoice_number,
*/					
$sql="select h.invoice_date,h.idx_month, 
	h.amount-h.amount_paid as amount_saldo,c.cust_name ,l.dealer_name,
	h.hari_telat,lc.area_name,
	lc.counter_name, c.hp					 
	from ls_invoice_header h 
	left join ls_loan_master l on l.loan_id=h.loan_id
	left join ls_cust_master c on c.cust_id=l.cust_id
	left join ls_app_master lam on lam.app_id=l.app_id
	left join ls_counter lc on lc.counter_id=lam.counter_id
	left join `user` u on u.user_id=lam.create_by
	where 1=1 and h.paid=false";
$sql.=" and h.invoice_date between '".$d1."' and '".$d2."'";
if($dealer_name!="")$sql.=" and l.dealer_name='".$dealer_name."'";
$sql.=" order by h.loan_id,h.invoice_date";

echo browse_select(	array('sql'=>$sql,"class"=>"table",
	'show_action'=>false,"fields_sum"=>array("amount","amount_paid",
	"ar_bal_amount_sum","denda_paid","amount_paid","pokok","bunga",
	"pokok_paid","bunga_paid","pokok_saldo","bunga_saldo")
));	
				
?>