<div class="row-fluid " >
	<?php
	if($cmd=="list") {
		
		$this->load->library("browser");
		
		$browse=new browser();
		$config['tablename']='sales_order';
		$config['sql']='';
		$config['primary_key']="sales_order_number";
		$config['order_by']="sales_date desc";
		$config['where']="";
		$config['use_bootstrap']=true;
		$config['id']="tbl";
		$config['limit']=$limit;
		$config['caption']='Manage Order';
		$config['fields']=array(
			'sales_order_number'=>array("caption"=>"Kode",'size'=>20),
			'sales_date'=>array('caption'=>'Tanggal','size'=>50),
			'sold_to_customer'=>array('caption'=>'Customer','size'=>50),
			'payment_terms'=>array('caption'=>'Termin','size'=>50),
			'status'=>array('caption'=>'Status','size'=>50),
			'paid'=>array('caption'=>'Lunas','size'=>50),
			'amount'=>array('caption'=>'Jumlah','size'=>29,'type'=>'numeric')
		);
		$config['controller']=base_url()."index.php/eshop_admin/orders";

		if(!isset($page))$page=0;
		$config['page']=$page;

		$browse->init($config);
		$browse->render();		
		
	} else {
		$so=$this->db->where("sales_order_number",$sales_order_number)->get("sales_order")->row();
		$cust=$this->db->where("customer_number",$so->sold_to_customer)->get("customers")->row();
		$so_detail=$this->db->where("sales_order_number",$sales_order_number)->get("sales_order_lineitems");
		$so_pay=$this->db->where("invoice_number",$sales_order_number)->get("payments")->row();
		$status_order=array("0 - Order belum dikonfirmasi",
			"1 - Order sudah dikonfirmasi",
			"2 - Barang sedang dikirim atau packing",
			"3 - Barang sudah sampai diterima",
			"4 - Order sudah selesai",
			"5 - Order dibatalkan");
		$status_payment=array("0 - Belum dibayar",
				"1 - Sudah dibayar dan sudah diperiksa");
	?>
		<div class="col-md-10">

				<div role="tabpanel">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#tab1" aria-controls="home" role="tab" 
								data-toggle="tab">
								Invoice
							</a>
						</li>
						<li role="presentation">
							<a href="#tabItem" aria-controls="profile" role="tab" 
								data-toggle="tab">
								Items
							</a>
						</li>
						<li role="presentation">
							<a href="#tabPayment" aria-controls="profile" role="tab" 
								data-toggle="tab">
								Payments
							</a>
						</li>
						<li role="presentation">
							<a href="#tab2" aria-controls="profile" role="tab" 
								data-toggle="tab">
								Status
							</a>
						</li>
						<li role="presentation">
							<a href="#tab3" aria-controls="messages" role="tab" 
								data-toggle="tab">
								Delivery
							</a>
						</li>
					</ul>
  
					<div class="tab-content">
					  <div role="tabpanel" class="tab-pane fade in active" id="tab1">
							<div id='divSales'>
								<div class="">
									<?php include_once "sales_form.php"; ?>
								</div>
							</div>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tabItem">
							<div id='divPurchase'>
									<?php include_once "sales_items.php"; ?> 
							</div>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tabPayment">
							<div id='divPurchase'>
									<?php include_once "sales_pays.php"; ?> 
							</div>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab2">
							<div id='divPurchase'>
									<?php include_once "sales_status.php"; ?> 
							</div>
					  </div>
					  <div role="tabpanel" class="tab-pane fade" id="tab3">
							<div id='divSalesValue'>
									<?php include_once "sales_delivery.php"; ?> 
							</div>
					  
					  </div>
					</div>
				</div>
			</div>

			
		</div>
		<script language='javascript'>
		function save_item(){
			var kode=$("#sales_order_number").val();
			if(kode==""){alert("Isi kode  !");return false}
			var url="<?=base_url()?>index.php/eshop_admin/orders/save";
			var next_url='<?=base_url()?>index.php/eshop_admin/orders/browse';
			$('#frmMain').ajax_post(url,'undefined',next_url); 
		};

		</script>
	
	<?php } ?>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/eshop/eshop.css">

