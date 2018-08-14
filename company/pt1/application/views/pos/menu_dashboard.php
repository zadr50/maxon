<?
/*
if($this->session->userdata('pos')==''){
	echo "<p>Belum ada session yang aktif untuk user anda, silahkan bikin terlebih dahulu.</p>";
	echo "<p><a href='".base_url()."index.php/pos/new_session'>Buat Session Baru</a></p>";
} else {
*/

///	header('Location: http://'.base_url().'index.php/pos');
//}
 
?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/pos/style.css">
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>assets/printThis-master/printThis.js"></script>

<div class='pos'>
	<div class='pos-content'>
		<div class='col-sm-4 thumbnail'>
			<div class='barcode'>
				Qty: <input type='text' id='qty' value="1"
					style="width:50px">
				Scan: <input type='text' id='barcode' title="Scan Barcode"
					style="width:150px"
					onkeypress="find_barcode(event)" >
			</div>
			<div class='nota' id="divNota">
				<table id='tbl_nota' width='100%' cellpadding='5' class='nota-content'>
				</table>
			</div>
			<div class='nota-pay thumbnail box-gradient'>
				<table width='100%'>
				<tr><td><strong>Payment&nbsp</strong></td>
					<td><strong>Total</strong></td><td><span id='ttl_nota'>0</span></td>
				</tr>
				<tr>
					<td></td>
					<td><strong>Sisa/Kembali</strong></td><td><span id='ttl_sisa'>0</span></td>
				</tr>
				</table>
			</div>
			 
			<div class='thumbnail col-sm-12 box-gradient'> 
				<? include_once "numpad.php" ?>
			</div>
		</div>
		<div class='col-sm-8 thumbnail'>
			 <div class='search' style='padding:2px'>
				<ol class='breadcrumb  box-gradient col-md-9'></ol>
				<span style='float:right'>
				<?=link_button('Setting','setting()','tip','false')?>
				</span>
			 </div>
			<div class='col-md-12 thumbnail box-gradient' style='margin-bottom: 5px;'>
				<?=link_button('New','tambah()','ok','false')?>
				<?//link_button('Open','open_nota()','reload','false')?>
				<?//link_button('Void','void_nota()','undo','false')?>			
				<?=link_button('Payment','pay_nota()','sum','false')?>
				<div style="float:right">
					<?=link_button('Reprint','reprint_nota()','print','false')?>
					<input type='text' id='txtFilter'>
					<?=link_button('','filter_items()','search','false')?>			
				
				</div>
			</div>
			 <div class='category' style='max-height:250px'>
				<div class='cat-content' id="cat-content" >
				</div>
			 </div>
			 <div class='product' id='product'></div>
		</div>
	</div>
</div>

<div id='dlgNotaPrint'  class="easyui-dialog"  closed="true"  buttons="#btnPrint"
	 style="width:300px;height:500px;padding:5px 5px;left:100px;top:20px">
	<div id='divNotaPrint' style="padding:10px; font-family: 'Arial';"></div>
</div>
<div id="btnPrint">
	<?=link_button("Close","print_close()","cancel","false");?>
	<?=link_button("Cetak","print_nota()","print","false");?>
</div>
<div id='dlgSet' class="easyui-dialog" style="width:600px;height:450px;
padding:10px 20px;left:100px;top:20px" closed="true" 
	buttons="#btnDlgSet" modal='true'>
	<table width='100%' class='table'>
	<tr><td><strong>Default Kode Gudang : </strong></td>
	   <td><input  type='text' name='txtGudang' id='txtGudang' 
	   value="<?=$default_warehouse?>">
	   </br><i>*setting gudang user ada di menu->setting->user->warehose</i>
	   </td>
	</tr>
	</table>
</div>
<div id="btnDlgSet">
	<?=link_button("Simpan","save_setting()","save","false");?>
</div>
<div id='dlgPay' class="easyui-dialog" style="width:600px;height:450px;
padding:10px 20px;left:100px;top:20px" closed="true" 
	buttons="#tbPay" modal='true'>
	<table width='100%' class='table'>
	<tr><td><strong>Jumlah Tagihan </strong></td>
	   <td><input  type='text' name='dlgPay_tagih' id='dlgPay_tagih' disabled></td>
	</tr>
	<tr><td><strong>Bayar Pakai Cash</strong></td>
		<td><?=form_input('cash',"","id='cash' onblur='total_nota()'")?></td>
	</tr>
	<tr><td><strong>Bayar Credit Card</strong></td>
		<td><?=form_input('creditcard',"","id='creditcard'  onblur='total_nota()'")?></td>
	</tr>
	<tr><td><strong>Bayar Debit Card</strong></td>
		<td><?=form_input('debitcard',"","id='debitcard'  onblur='total_nota()'")?></td>
	</tr>
	<tr><td><strong>Jumlah Bayar</strong></td>
		<td><?=form_input('bayar',"","id='bayar'  onblur='total_nota()' disabled")?></td>
	</tr>
	<tr><td><strong>Jumlah Sisa/Kembalian </strong></td>
		<td><input  type='text' name='dlgPay_sisa' id='dlgPay_sisa' disabled></td>
	</tr>
	
	</table>
</div>	
<div id='tbPay'>
	<?=link_button('Submit','submit_payment()','save','false')?>
</div>
<script>	
	var next_row=0;
	var tableData=null;
	var selected_row=0;
	var button_mode="btn_qty";
	var xqty='';
	var xprice='';
	var baris="";
	var focus_text="cash";
	var total = 0;
	var sisa=0;
	var idx_cat_page=0;
	var max_cat_page=4;
	var arBarang = null;
	var arItem=[];
	var row=0;
	function print_close(){
		$("#dlgNotaPrint").dialog("close");
	} 
	function tambah(){void new_nota();}
	
	function new_nota(){
		next_row=0; tableData=null; selected_row=0; button_mode="btn_qty";
		xqty=''; xprice=''; baris=""; focus_text="cash";
		total = 0; sisa=0;
		arItem=[];	row=0;
		$("#dlgPay_sisa").val(0);
		$("#dlgPay_tagih").val(0);
		$("#cash").val(0);
		$("#creditcard").val(0);
		$("#debitcard").val(0);
		$("#divNota").html("<table id='tbl_nota' width='100%' " +
		" cellpadding='5' class='nota-content'> </table>");
		$("#ttl_nota").html("");
		$("#ttl_sisa").html("");
	}
	
	$(document).ready(function(){
		void cat_home('');
		void refresh_cat();
	});
	function cat_prev(){
		idx_cat_page--;
		if(idx_cat_page<0)idx_cat_page=0;
		refresh_cat();
	}
	function cat_next(){
		idx_cat_page++;
		if(idx_cat_page>max_cat_page)idx_cat_page=0;
		refresh_cat()
	}
	function refresh_cat(){
		var url='<?=base_url()?>index.php/inventory/pos_category/'+idx_cat_page;
		loading();
		$.ajax({type: "GET",url: url,data:'',
			success: function(msg){	
				loading_close();
				$("#cat-content").html(msg);
				if(msg==""){
					$("#cat-content").hide();
				}
				
			},
			error: function(msg){
				console.log(msg);}
		});			
	}	
	function filter_items(){
		var txtFilter=$("#txtFilter").val();
		var url='<?=base_url()?>index.php/inventory/pos_items_filter/'+txtFilter;
		loading();
		$.ajax({
			type: "GET",
			url: url,
			success: function(msg){
				loading_close();
				var result = eval('('+msg+')');
				arBarang=result.rec;
				$("#product").html(result.html);				
			},
			error: function(msg){
				loading_close();
				console.log(msg);
			}
		});					
	}
	function list_barang(cat) {
		var url='<?=base_url()?>index.php/inventory/pos_items/'+cat;
		loading();
		$.ajax({
			type: "GET",
			url: url,
			data:'',
			success: function(msg){
				loading_close();
				var result = eval('('+msg+')');
				arBarang=result.rec;
				$("#product").html(result.html);				
				$(".breadcrumb").html("<li><a class='first-cat glyphicon glyphicon-home'"
				+"href='"+CI_BASE+"index.php' > Home</a></li>"
				+"<li><a href='#' onclick='cat_home();return false'> Pos</a></li>"
				+"<li><a href='#'>"+cat+"</a></li>");
			},
			error: function(msg){
				loading_close();
				console.log(msg);}
		});			
	}
	function cat_home() { 
		$(".breadcrumb").html("<li> Home</li>");
		list_barang('');
	};
	$("#cash").click(function(){
		focus_text="cash";
	});
	$("#creditcard").click(function(){
		focus_text="creditcard";
	});
	
	$(document).on("click",".cat-cell",function() {
		var cat = $(this).attr("id");
		list_barang(cat);
	});
	$(document).on('click', '.item-cell', function(){
			next_row=next_row+1;
			var kode=this.id;
			var i = arBarang.inArray(kode, "item_number");
			var sDesc=arBarang[i].description;
			var sPrice=arBarang[i].retail;
			var nAmount=parseInt(sPrice);
			var qty=$("#qty").val();
			var sDisc=arBarang[i].disc_prc_1;
			$(".nota-content").append("  "
			+"<tr class='line-order '  > "
			+"<td colspan='2' style='display:none'>"+next_row+"</td>"
			+"<td colspan='2'>"+kode+"</td>"
			+"<td colspan='3'>"+sDesc+"</td>"
			+"</tr><tr class='line-order-price'> "
			+"<td><span id='q_"+next_row+"'>"+qty+"</span></td><td> x </td>"
			+"<td><span id='p_"+next_row+"'>"+sPrice+"</span></td>"
			+"<td><span id='d_"+next_row+"'>"+sDisc+"</span></td>"
			+"<td><span class='t_amount' id='t_"+next_row+"'>"+formatNumber(nAmount)+"</span></td>"
			+"</tr>");
			total_nota();
			$("#qty").val("1");
			
	});
	
	$(document).on('click','.line-order',function() {	
		tableData = $(this).children("td").map(function() {
				return $(this).text();
			}).get();
		$("tr").eq(selected_row).removeClass("row-selected");
		selected_row= $(this).index();
		xqty='';xprice='';
		$(this).addClass("row-selected");
	});
	$(document).on('click','.del-button',function() {
		var caption=$(this).html();
		if(caption="Del"){
			c_row=selected_row;
			$("tr").eq(c_row).remove();
			$("tr").eq(c_row).remove();
			row--;
			if(row<0)row=0;
			$("tr").eq(row*2).addClass("row-selected");
		}		
		selected_row=row*2;
		tableData = $("tr").eq(selected_row).children("td").map(function() {
				return $(this).text();
			}).get();
		xqty=0;
		xprice=0;
		xdisc=0;
	});
	$(document).on('click','.nav-button',function() {
		var caption=$(this).html();
		if(caption=="Up"){
			$("tr").eq(row*2).removeClass("row-selected");
			row--;
			if(row<0)row=0;
			$("tr").eq(row*2).addClass("row-selected");
		}
		if(caption=="Down"){
			$("tr").eq(row*2).removeClass("row-selected");
			row++;
			if(row+1>next_row)row=next_row-1;
			$("tr").eq(row*2).addClass("row-selected");
		}
		selected_row=row*2;
		tableData = $("tr").eq(selected_row).children("td").map(function() {
				return $(this).text();
			}).get();
		xqty=0;
		xprice=0;
		xdisc=0;
	});
	$(document).on('click','.number-char',function() {
		if(button_mode=="btn_pay") {
			$("#"+focus_text).val($("#"+focus_text).val()+$(this).html());
			total_nota();
			return false;
		}
		if(!tableData){
			selected_row=0;
			tableData = $("tr").eq(selected_row).children("td").map(function() {
				return $(this).text();
			}).get();
//			return false;
		}
		baris=tableData[0];
		price=parseInt($("#p_"+baris).html());
		qty=parseInt($("#q_"+baris).html());
		if(button_mode=="btn_qty"){
			xqty=xqty+$(this).html();
			qty=parseInt(xqty);
			tableData[3]=qty;
		}
		if(button_mode=="btn_price")		{
			xprice=xprice+$(this).html();
			price=parseInt(xprice);
			tableData[5]=price;		
			$("#p_"+baris).html(price);
		}
		var amount=qty*price;
		$("#q_"+baris).html(qty);
		$("#t_"+baris).html(formatNumber(amount));
		total_nota();
	});
	
	$(document).on('click','.numpad-backspace',function() {
		if(button_mode=="btn_pay"){
			var cash=$("#"+focus_text).val();
			$("#"+focus_text).val(cash.substr(0,cash.length-1));
			total_nota();
			return false;
		}
		if(button_mode=="btn_qty"){
			xqty=xqty.toString().substr(0,qty.toString().length-1);
			if(xqty=='')xqty="0";
			$("#q_"+baris).html(qty);
		}
		if(button_mode=="btn_price"){
			xprice=xprice.toString().substr(0,xprice.toString().length-1);
			if(xprice=='')xprice="0";
			$("#p_"+baris).html(xprice);
			price=xprice;
		}
		price=parseInt($("#p_"+baris).html());
		qty=parseInt($("#q_"+baris).html());
		var amount=qty*price;
		$("#t_"+baris).html(formatNumber(amount));
		total_nota();
	});
	$(document).on('click','.mode-button',function() {	
		xprice='';
		$("#"+button_mode).removeClass("selected-mode");
		$("#"+this.id).addClass("selected-mode");
		button_mode=this.id;
	});
	function total_nota(){
		arItem=[];
		var total=0;
		var i=0;
		$(".line-order").each(function(){
			td = $(this).children("td").map(function() {
				return $(this).text();
			}).get();
			i++;
			q=$("#q_"+i).html();
			p=$("#p_"+i).html();
			t=$("#t_"+i).html();
			d=$("#d_"+i).html();
			t=t.replace(/,/g,"");
			t=t.replace(/,/g,"");
			if(d>1)d=d/100;
			gross=(q*p);
			disc=(d*gross);
			t=gross-disc;
			$("#t_"+i).html(t);
			total += (+t);
			arItem.push([td[0],td[1],td[2],td[2],q,p,t,d]);	
		});
		var cash=$("#cash").val();
		var card=$("#creditcard").val();
		var debit=$("#debitcard").val();
		if(cash=="")cash=0;
		if(card=="")card=0;
		if(debit=="")debit=0;
		var bayar=parseInt(cash)+parseInt(card)+parseInt(debit);
		sisa=bayar-parseInt(total);
		$("#bayar").val(formatNumber(bayar));
		$("#ttl_nota").html(formatNumber(total));
		$("#ttl_sisa").html(formatNumber(sisa));
		
		$("#dlgPay_tagih").val(formatNumber(total));
		$("#dlgPay_sisa").val(formatNumber(sisa));
		
	}
	function submit_payment() {
		//console.log(arItem);//lihat controller/invoice/save_pos
		void total_nota();
		var total=$("#ttl_nota").html();
		var sisa=$("#ttl_sisa").html();
		var cash=$("#cash").val();
		var card=$("#creditcard").val();
		var debit=$("#debitcard").val();
		var header={"invoice_number":"new"};
		var payment={"cash":cash,"card":card,"debit":debit};
		var xurl="<?=base_url()?>index.php/invoice/save_pos";
		var param={"header":header,"items": arItem,"payment":payment}
		var ok=false;
		loading();
		$.ajax({type: "GET",url: xurl,data: param,
			success: function(result){
				loading_close();
				var result = eval('('+result+')');
				if(result.success){
					$('#dlgPay').dialog("close");
					void preview_nota(result.invoice_number);
					void new_nota();
				}
			},
			error: function(result){
				loading_close();
				alert(result);
				return false;
			}			
		}); 		
	}
	function reprint_nota(){
		var nomor=prompt("Input nomor nota :");
		var xurl="<?=base_url()?>index.php/invoice/edit_nota/"+nomor;
		var s="";
		loading();
		$.ajax({type: "GET",url: xurl,
			success: function(result){
				s=result;
				console.log(result);
				loading_close();
				var result = eval('('+result+')');
				if(result.success){
					s=reprint_nota_data(result);
					$("#divNotaPrint").html(s);
					$('#dlgNotaPrint').dialog({modal: true}).dialog('open').dialog('setTitle','Print Dialog');
				}
			},
			error: function(result){
				loading_close();
				alert(result);
				return false;
			}			
		}); 		
		
	}
	function reprint_nota_data(result){
		var nama_toko="<?=$company_name?>";
		var alamat="<?=$street?>";
		var telp="<?=$phone_number?>";
		var kota="<?=$city_state_zip_code?>";
		var invoice=result.invoice;
		var items=result.items;
		var payments=result.payments;
		var total=invoice.amount;
		var cash=0,card=0,debit=0;
		for(i=0;i<payments.length;i++){
			if(payments[i].how_paid=="CARD"){
				card=payments[i].amount_paid;
			} else if (payments[i].how_paid=="DEBIT"){
				debit=payments[i].amount_paid;
			} else {
				cash=payments[i].amount_paid;
			}
		}
		
		var s="<table width='200px'><tr><td colspan='5'>"+nama_toko+"</td></tr>";
		s += "<tr><td colspan='5'>"+alamat+"</td></tr>";
		s += "<tr><td colspan='5'>"+telp+"</td></tr>";
		s += "<tr><td colspan='5'>"+kota+"</td></tr>";
		s += "<tr><td colspan='5'>=================================</td></tr>";
		s += "<tr><td colspan='4'>Nota#</td><td>"+invoice.invoice_number+"</td></tr>";
		s += "<tr><td colspan='4'>Tanggal</td><td>"+invoice.invoice_date+"</td></tr>";
		s += "<tr><td colspan='4'>Kasir</td><td>"+invoice.salesman+"</td></tr>";
		s += "<tr><td colspan='5'>=================================</td></tr>";
		for(i=0;i<items.length;i++){
			s += "<tr>";
			s += "<td colspan='5'>"+items[i].description+"</td></tr>";
			s += "<tr><td>"+items[i].quantity+"</td><td>x</td><td align='right'>"+(items[i].price)+"</td><td>=</td><td align='right'>"+formatNumber(items[i].amount)+"</td>";
			s += "</tr>";
		}
		s += "<tr><td colspan='5'>=================================</td></tr>";
		s += "<tr><td colspan='4'>TOTAL Rp. </td><td align='right'>"+(total)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR CASH Rp. </td><td align='right'>"+(cash)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR CARD Rp. </td><td align='right'>"+(card)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR DEBT Rp. </td><td align='right'>"+(debit)+"</td></tr>";
		s += "</table>";
		return s;
	}
	function preview_nota(nomor){
		var nama_toko="<?=$company_name?>";
		var alamat="<?=$street?>";
		var telp="<?=$phone_number?>";
		var kota="<?=$city_state_zip_code?>";
		
		var total=$("#ttl_nota").html();
		var cash=$("#cash").val();
		var card=$("#creditcard").val();
		var debit=$("#debitcard").val();
		var sisa=$("#ttl_sisa").html();
		
		var s="<table width='200px'><tr><td colspan='5'>"+nama_toko+"</td></tr>";
		s += "<tr><td colspan='5'>"+alamat+"</td></tr>";
		s += "<tr><td colspan='5'>"+telp+"</td></tr>";
		s += "<tr><td colspan='5'>"+kota+"</td></tr>";
		s += "<tr><td colspan='5'>=================================</td></tr>";
		s += "<tr><td colspan='4'>Nota#</td><td>"+nomor+"</td></tr>";
		s += "<tr><td colspan='4'>Tanggal</td><td><?=str_pad(date("Y-m-d H:i:s"),10,"&nbsp")?></td></tr>";
		s += "<tr><td colspan='4'>Kasir</td><td><?=str_pad(user_id(),10,"&nbsp")?></td></tr>";
		s += "<tr><td colspan='5'>=================================</td></tr>";
		for(i=0;i<arItem.length;i++){
			s += "<tr>";
			s += "<td colspan='5'>"+arItem[i][2]+"</td></tr>";
			s += "<tr><td>"+arItem[i][4]+"</td><td>x</td><td align='right'>"+formatNumber(arItem[i][5])+"</td><td>=</td><td align='right'>"+formatNumber(arItem[i][6])+"</td>";
			s += "</tr>";
		}
		s += "<tr><td colspan='5'>=================================</td></tr>";
		s += "<tr><td colspan='4'>TOTAL Rp. </td><td align='right'>"+formatNumber(total)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR CASH Rp. </td><td align='right'>"+formatNumber(cash)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR CARD Rp. </td><td align='right'>"+formatNumber(card)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR DEBT Rp. </td><td align='right'>"+formatNumber(debit)+"</td></tr>";
		sisa=sisa.replace(",","");
		sisa=sisa.replace(",","");		
		s += "<tr><td colspan='4'>KEMBALI Rp. </td><td align='right'>"+formatNumber(Math.abs(sisa))+"</td></tr>";
		s += "</table>";

		$("#divNotaPrint").html(s);
		$('#dlgNotaPrint').dialog({modal: true}).dialog('open').dialog('setTitle','Print Dialog');
	}
	function print_nota(){
		$("#divNotaPrint").printThis();
		$("#dlgNotaPrint").dialog("close");
	}
	function pay_nota(){
		total_nota();
		$("#dlgPay").dialog("open").dialog('setTitle','Payment');
	}
	function setting(){
		$("#dlgSet").dialog("open").dialog('setTitle','Setting');		
	}
var STR_PAD_LEFT = 1;
var STR_PAD_RIGHT = 2;
var STR_PAD_BOTH = 3;

function pad(str, len, pad, dir) {
    if (typeof(len) == "undefined") { var len = 0; }
    if (typeof(pad) == "undefined") { var pad = ' '; }
    if (typeof(dir) == "undefined") { var dir = STR_PAD_RIGHT; }

    if (len + 1 >= str.length) {

        switch (dir){

            case STR_PAD_LEFT:
                str = Array(len + 1 - str.length).join(pad) + str;
            break;

            case STR_PAD_BOTH:
                var right = Math.ceil((padlen = len - str.length) / 2);
                var left = padlen - right;
                str = Array(left+1).join(pad) + str + Array(right+1).join(pad);
            break;

            default:
                str = str + Array(len + 1 - str.length).join(pad);
            break;

        } // switch

    }
	return str;
}
	function find_barcode(e){
        if(e.keyCode === 13){
			var qty=$("#qty").val();
			var barcode=$("#barcode").val();
			$("#barcode").val("");
			$("#qty").val("1");
			loading();
			var url='<?=base_url()?>index.php/inventory/find/'+barcode;
			$.ajax({
				type: "GET",
				url: url,
				success: function(msg){
					loading_close();
					var result = eval('('+msg+')');
					if(result.success){
						next_row=next_row+1;
						$(".nota-content").append("  "
						+"<tr class='line-order '  > "
						+"<td colspan='2' style='display:none'>"+next_row+"</td>"
						+"<td colspan='2'>"+result.item_number+"</td>"
						+"<td colspan='3'>"+result.description+"</td>"
						+"</tr><tr class='line-order-price'> "
						+"<td><span id='q_"+next_row+"'>"+qty+"</span></td><td> x </td>"
						+"<td><span id='p_"+next_row+"'>"+result.retail+"</span></td>"
						+"<td><span id='d_"+next_row+"'>"+result.disc_prc_1+"</span></td>"
						+"<td><span class='t_amount' id='t_"+next_row+"'>"+formatNumber(result.retail)+"</span></td>"
						+"</tr>");
						total_nota();
					} else {
						log_err("Barcode Not Found !");
					}
				},
				error: function(msg){
					loading_close();
					console.log(msg);
				}
			});			
		}
        return false;
    }
	
</script>
