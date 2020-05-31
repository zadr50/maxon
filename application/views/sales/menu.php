<div style="margin:5px 0;"></div>
	<ul class="easyui-tree">
		<li>
			<span><b>Sales Modules</b></span>
			<ul>
				<li data-options="state:'closed'">
					<span>Operation</span>
					<ul><li data-options="state:'open'"><span>Sales Order</span>
						<ul>
<li><?=anchor(base_url().'index.php/sales_order/add#new_so','Buat Sales Order','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/sales_order','Daftar Sales Order','class="info_link link2"  ');?></li>
						</ul>
						</li>
					</ul>
					<ul>
						<li data-options="state:'closed'"><span>Delivery Order</span><ul>
<li><?=anchor(base_url().'index.php/delivery_order/add#new_do','Buat DO Baru','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/delivery_order','Daftar Delivery Order (DO)','class="info_link link2"  ');?></li>
						</ul></li>
					</ul>
					<ul><li data-options="state:'open'"><span>Sales Invoice (AR)</span>
						<ul>
<li><?=anchor(base_url().'index.php/invoice/add#new_invoice','Buat Sales Invoice Baru','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/invoice','Daftar Sales Invoice','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/so/kontra_bon','Daftar Kontra Bon','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/so/bill_collect','Tagihan Kolektor','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/sales_crmemo','Kredit Memo','class="info_link link2"');?></li>
<li><?=anchor(base_url().'index.php/sales_dbmemo','Debit Memo','class="info_link link2"');?></li>
						
						</ul>
						</li>
					</ul>
					<ul>
						<li data-options="state:'open'"><span>Payments</span><ul>
<li><?=anchor(base_url().'index.php/payment/add#new_invoice_payment','Buat Pembayaran Invoice Baru','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/payment','Daftar Pembayaran Invoice','class="info_link link2"  ');?></li>
					</ul></li>
					</ul>
					<ul><li data-options="state:'closed'"><span>Sales Return Invoice</span><ul>
<li><?=anchor(base_url().'index.php/sales_retur/add#new_invoice_retur','Buat Sales Retur Baru','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/sales_retur','Daftar Sales Return','class="info_link link2"  ');?></li>
<li><?=anchor('retur_toko','Retur barang dari toko','class="info_link link2"');?></li>
						</ul></li>
					</ul>
					<ul><li   data-options="state:'closed'"><span>Promosi</span><ul>
<li><?=anchor(base_url().'index.php/so/promosi_disc','Promosi Discount Penjualan','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/so/promosi_extra','Promosi Quantity Extra','class="info_link link2"  ');?></li>
<!--							<li><?=anchor(base_url().'index.php/so/promosi_one_price','Promosi One Price','class="info_link link2"  ');?></li>
-->
<li><?=anchor(base_url().'index.php/so/promosi_point','Promosi Point Reward','class="info_link link2"  ');?></li>
<li><?=anchor(base_url().'index.php/so/promosi_voucher','Promosi Voucher','class="info_link link2"  ');?></li>
						</ul></li>
					</ul>
					<ul>
						<li data-options="state:'closed'"><span>Service Order</span>
							<ul>
<li><?=anchor('so/service','Service Order','class="info_link link2"  ');?></li>
							
							</ul>
						</li>
					</ul>
				</li>
				
				<li data-options="state:'closed'">
					<span>Report</span>
					<ul>

						<li   data-options="state:'closed'"><span>Sales Order</span>
							<ul>
<li><?=anchor('sales/rpt/so_otstand','Open Sales Order (SO)',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/so_otstand_item','Open SO by Item Number',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/so_otstand_cust','Open SO by Customer Number',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/so_list','Daftar Sales Order (SO)',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/so_items','Sales Order by Item',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/so_salesman','Sales Order by Salesman',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/so_customer','Sales Order by Customer',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/do_list','Daftar Delivery Order (DO)',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/do_items','Delivery Order by Item',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/do_salesman','Delivery Order by Salesman',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/do_customer','Delivery Order by customer',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/komisi_hutang','Daftar Hutang Komisi',"class='info_link link2'")?></li>
							</ul>
						</li>
						
						<li   data-options="state:'closed'"><span>Invoice</span>
							<ul>
<li><?=anchor('sales/rpt/faktur_sum','Penjualan Summary',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/faktur_slsman','Penjualan Per Salesman',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/faktur_cust','Penjualan per Pelanggan',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_item','Penjualan per Item',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_cat','Penjualan per Item Kategori',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_item_supplier','Penjualan per Item Supplier',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_item_customer','Penjualan per Item Pelanggan',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_rl_item','Rugi Laba Penjualan per Item',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_daily','Daily Sales Report',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_termin','Penjualan per Termin',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_rl_invoice','Rugi Laba Penjualan per Invoice',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_rl_supplier','Rugi Laba Penjualan per Supplier',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_rl_customer','Rugi Laba Penjualan per Customer',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_top_qty','Top Ten Sales by Qty',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_top_amount','Top Ten Sales by Amount',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_cat_wil','Penjualan Salesman, Kategori,Wilayah ',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_wil_cat','Penjualan Wilayah, Kategori ',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_wil_cat2','Penjualan Category, Wilayah ',"class='info_link link2'")?></li>
<li><?=anchor('so/sales_graph/wilayah','Grafik Penjualan Wilayah ',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/sls_wil_cust','Penjualan Wilayah, Customer ',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/memo_list','Daftar Kredit/Debit Memo',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/pay_list','Daftar Pembayaran',"class='info_link link2'")?></li>
<li><?=anchor('banks/rpt/load/tran_giro','Daftar Pembayaran Giro',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/pay_type','Pembayaran Per Jenis Bayar',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/cust_list','Daftar Pelanggan',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/slsman_list','Daftar Salesman',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/ar_sum','Kartu Piutang Summary',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/ar_dtl','Kartu Piutang Detail',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/age_sum','Umur Piutang Summary - By Invoice Date',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/age_dtl','Umur Piutang Detail - By Invoice Date',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/age_dtl_item','Umur Piutang Detail - By Invoice Date, Item',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/age_sum_due','Umur Piutang Summary - By Due Date',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/age_dtl_due','Umur Piutang Detail - By Due Date',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/age_dtl_due_item','Umur Piutang Detail - By Due Date, Item',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/retur_list','Daftar Retur Penjualan',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/retur_item','Retur Per Item',"class='info_link link2'")?></li>
<li><?=anchor('sales/rpt/faktur_detail','Penjualan Per Nota Detail',"class='info_link link2'")?></li>
							</ul>
						</li>
						<li data-options="state:'closed'"><span>Service Order</span>
							<ul>
				<li><?=anchor('so/rpt/service','Service Order Summary','class="info_link link2"  ');?></li>
							
							</ul>
						</li>
					</ul>
					
					
				</li>
				<li data-options="state:'closed'">
					<span>Master</span>
					<ul>
						<li><?=anchor(base_url().'index.php/customer','Pelanggan','class="info_link link2"');?></li>
						<li><?=anchor(base_url().'index.php/salesman','Salesman','class="info_link link2"');?></li>
						<li><?=anchor(base_url().'index.php/type_of_payment','Termin','class="info_link link2"');?></li>
						<li><?=anchor("company/wilayah","Wilayah","class='info_link link2'");?></li>
						<li><?=anchor(base_url().'index.php/customer_type','Customer Type','class="info_link link2"');?></li>
					</ul>
				</li>
			</ul>
		</li>
				
		</li>				
			</ul>
		


	</ul>

