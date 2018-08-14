<?
 
$table="qry_kartu_hutang";
$sql="create view ".$cid."qry_kartu_hutang as 

select invoice_date as tanggal,case when purchase_order<>0 then purchase_order_number
else bill_id end as no_bukti,
bill_id as ref1,invoice_number as ref2,'Hutang' as jenis,supplier_number,amount
from ".$cid."payables

UNION ALL
select pp.date_paid,cw.voucher,
pp.bill_id,pp.trans_id,'Bayar',p.supplier_number,-1*amount_paid
from ".$cid."payables_payments pp
left join ".$cid."payables p on p.bill_id=pp.bill_id
left join ".$cid."check_writer cw on cw.trans_id=pp.trans_id

UNION ALL
select po_date,purchase_order_number,po_ref,'','Retur',supplier_number,
-1*abs(saldo_invoice)
from ".$cid."purchase_order 
where potype='R'

UNION ALL
select c.tanggal,c.kodecrdb,c.docnumber,'','Debit Memo', p.supplier_number,
-1*abs(c.amount)
from ".$cid."crdb_memo c
left join ".$cid."purchase_order p on p.purchase_order_number=c.docnumber 
where c.transtype='PO-DEBIT MEMO'

UNION ALL
select c.tanggal,c.kodecrdb,c.docnumber,'','Debit Memo', p.supplier_number,
-1*abs(c.amount)
from ".$cid."crdb_memo c
left join ".$cid."purchase_order p on p.purchase_order_number=c.docnumber 
where c.transtype='PO-CREDIT MEMO'

";
if($link->query($sql))echo mysqli_error($link);
?>