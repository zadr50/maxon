var next_row=0,tableData=null,selected_row=0,button_mode="btn_qty",xqty='';
var xprice='',baris="", focus_text="cash",total = 0,sisa=0;
var idx_cat_page=0,max_cat_page=4,arBarang = null;
var arItem=[],row=0;
var C_NO=0,C_CODE=1,C_NAME=2,C_QTY=3,C_UNIT=4,C_PRICE=5,C_DISC_PRC=6,C_DISC_AMT=7,C_AMOUNT=8;
var C_TENANT=9,C_REF=10,C_DISC_PRC_2=11, C_DISC_AMT_2=12,C_DISC_PRC_3=13;
var C_DISC_AMT_3=14,C_DISC_AMT_EX=15,C_ID=16,C_M_QTY=17,C_M_UNIT=18,C_M_PRICE=19;
var C_MAX=20;

$(document).ready(function(){
	$("#barcode").focusout(function(){
		find_barcode();
	})
	$("#barcode_top").focusout(function(){
		find_barcode_top();
	})
	
	$(".calc_input").focusout(function(){
		calc_input();
	})
	$(".calc_total").focusout(function(){
		total_nota();
	})
	//void cat_home('');
	//void refresh_cat();
});
	
	
	function print_close(){
		$("#dlgNotaPrint").dialog("close");
	} 
	function tambah(){void new_nota();}
	
	function new_nota(){
		next_row=0; tableData=null; selected_row=0; button_mode="btn_qty";
		xqty=''; xprice=''; baris=""; focus_text="cash";
		total = 0; sisa=0;					
		arItem=[];	row=0;
		
		clear_header_items();
		clear_input();
		clear_input_header();
		
		next_nota();
		list_nota_open();
		
	}
	function clear_input_header(){
		$("#dlgPay_sisa").val(0);			
		$("#dlgPay_tagih").val(0);
		$("#cash").val(0);
		$("#creditcard").val(0);
		$("#debitcard").val(0);
		$("#ttl_nota").html("");
		$("#ttl_sisa").html("");
		$("#nota").html("AUTO");
		$("#sub_total").val(0);
		$("#disc_nota_prc").val(0);
		$("#disc_nota_rp").val(0);		
		$("#ppn_prc").val(0);
		$("#ppn_rp").val(0);
		$("#pbulat").val(0);
		$("#kembali").val(0);		
		cvalf("#pay_cash",0);
		cvalf("#pay_card",0);
		cvalf("#pay_voucher",0);
		cvalf("#pay_total",0);
		cvalf("#pay_debit",0);
		$("#credit_card_number").val("");
		$("#voucher_no").val("");
		$("#msg-box-wrap").html("Ready.");
		
	}
	function next_nota(){
		loading();
		$.ajax({type: "GET",url: url_nota+'/next_number', 
			success: function(result){
				loading_close();
				var result = eval('('+result+')');
				if(result.success){
					$("#nota_tmp").html(" ("+result.nomor+")");
				}
			},
			error: function(result){
				loading_close();
				log_err(result);
				return false;
			}			
		}); 		
	}
	
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
		loading();
		$.ajax({type: "GET",url: url_cat+idx_cat_page,data:'',
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
		loading();
		$.ajax({
			type: "GET",
			url: url_item_filter+txtFilter,
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
		loading();
		$.ajax({
			type: "GET",
			url: url_list_barang+cat,
			data:'',
			success: function(msg){
				loading_close();
				var result = eval('('+msg+')');
				arBarang=result.rec;
				$("#product").html(result.html);				
				$(".breadcrumb").html("<li><a class='first-cat glyphicon glyphicon-home'"
				+"href='"+CI_BASE+"pos.php' > Home</a></li>"
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
			var disc_amount_ex=arBarang[i].disc_amount_ex;
			
			$(".nota-content").append("  "
			+"<tr class='line-order '  > "
			+"<td colspan='2' style='display:none'>"+next_row+"</td>"
			+"<td colspan='2'>"+kode+"</td>"
			+"<td colspan='3'>"+sDesc+"</td>"
			+"</tr><tr class='line-order-price'> "
			+"<td><span id='q_"+next_row+"'>"+qty+"</span></td><td> x </td>"
			+"<td><span id='p_"+next_row+"'>"+sPrice+"</span></td>"
			+"<td><span id='d_"+next_row+"'>"+sDisc+"</span></td>"
			+"<td><span id='dex_"+next_row+"'>"+formatNumber(disc_amount_ex)+"</span></td>"
			+"<td><span class='t_amount' id='t_"+next_row+"'>"+formatNumber(nAmount)+"</span></td>"
			+"</tr>");
			
			total_nota();
			
			$("#qty").val("1");
			
	});
	
	$(document).on('click','.line-order',function() {	
		tableData = $(this).children("td").map(function() {
				return $(this).text();
			}).get();
		$("#tbl_nota tr").eq(selected_row).removeClass("row-selected");
		selected_row= $(this).index();
		if(selected_row<1)selected_row=1;
		xqty='';xprice='';
		$(this).addClass("row-selected");
		console.log(tableData);
		
	});
	$(document).on('click','.del-button',function() {
		del_row();
	});
	$(document).on('click','.edit-button',function() {
		edit_row();
	});
	
	function del_row(){
		var caption=$(this).html();
		
		tableData = $("#tbl_nota tr").eq(selected_row).children("td").map(function() {
			return $(this).text();
		}).get();
		
		var id=tableData[C_ID];
		
		if(caption="Del"){
			if(selected_row==0){
				log_err("header row cannot delete !");return false;
			}
			$.messager.confirm('Confirm','Are you sure delete row_id ['+id+'] ?',function(r){
				if (r){
					
					if(id>0){
						loading();
						var url=base_url+'pos.php/invoice/delete_item/'+id;
						$.ajax({type: "POST",url: url,
							success: function(result){
								loading_close();
								var result = eval('('+result+')');
								if(result.success){
									
									table_row_remove();
									
									tableData = $("#tbl_nota tr").eq(selected_row).children("td").map(function() {
											return $(this).text();
										}).get();
									xqty=0;
									xprice=0;
									xdisc=0;
									
								}
							},
							error: function(result){
								loading_close();
								log_err(result);
								return false;
							}			
						}); 
										
					} else {
						table_row_remove();
					}
					
				}
			});
		}		
	}
	function table_row_remove(){
		$("#tbl_nota tr").eq(selected_row).remove();
		selected_row--;
		if(selected_row<1)selected_row=1;
		$("#tbl_nota tr").eq(selected_row).addClass("row-selected");
	}
	$(document).on('click','.nav-button',function() {
		var caption=$(this).html();
		if(caption=="Up"){
			$("#tbl_nota tr").eq(row).removeClass("row-selected");
			row--;
			if(row<1)row=1;
			$("#tbl_nota tr").eq(row).addClass("row-selected");
		}
		if(caption=="Down"){
			$("#tbl_nota tr").eq(row).removeClass("row-selected");
			row++;
			if(row>next_row)row=next_row;
			$("#tbl_nota tr").eq(row).addClass("row-selected");
		}
		selected_row=row;
		tableData = $("#tbl_nota tr").eq(selected_row).children("td").map(function() {
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
			selected_row=1;
			tableData = $("#tbl_nota tr").eq(selected_row).children("td").map(function() {
				return $(this).text();
			}).get();
		}
		baris=tableData[C_NO];
		price=parseInt($("#p_"+baris).html());
		qty=parseInt($("#q_"+baris).html());
		if(button_mode=="btn_qty"){
			xqty=xqty+$(this).html();
			qty=parseInt(xqty);
			tableData[C_QTY]=qty;
		}
		if(button_mode=="btn_price")		{
			xprice=xprice+$(this).html();
			price=parseInt(xprice);
			tableData[C_PRICE]=price;		
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
		console.log('Calculating...');
		arItem=[];
		var total=0,qty_total=0,qty_jenis=0;
		var i=0;
		$(".line-order").each(function(){
			td = $(this).children("td").map(function() {
				return $(this).text();
			}).get();
			i++;
			q=td[C_QTY];			
			t=td[C_AMOUNT];
			t=t.toString().replace(/,/g , "");
			total += (+t);
			qty_total+=(+q);
			qty_jenis++;
			arItem.push(td);	
			console.log(arItem);
		});
		sub_total=total;
		$("#sub_total").val(formatNumber(sub_total));
		disc_prc=$("#disc_nota_prc").val();
		disc_rp=$("#disc_nota_rp").val();		
		ppn_prc=$("#ppn_prc").val();
		ppn_rp=$("#ppn_rp").val();
		kembali=$("#kembali").val();

		disc_prc_dec=0;
		ppn_prc_dec=0;
		
	    if(disc_prc=='')item_disc_prc=0;
    	if(disc_prc>1)disc_prc_dec=disc_prc/100;
	    if(ppn_prc=='')ppn_disc_prc=0;
    	if(ppn_prc>1)ppn_prc_dec=ppn_prc/100;
		
		disc_rp=disc_prc_dec*sub_total;
		disc_rp=Math.round(disc_rp,2);
		total=sub_total-disc_rp;
		
		ppn_rp=ppn_prc_dec*total;
		ppn_rp=Math.round(ppn_rp,2);
		total=total+ppn_rp;
		
		total2=roundUp(total,pembulatan);
		$("#pbulat").val(total2-total);
		pbulat=$("#pbulat").val();
		total=total+(+pbulat);
		
		$("#total_nota").val(formatNumber(total));
		$("#disc_nota_rp").val(formatNumber(disc_rp));
		$("#ppn_rp").val(formatNumber(ppn_rp));
		
		
		cash=cval("#pay_cash");
		card=cval("#pay_card");
		debit=0; //cval("#pay_debit");
		voucher=cval("#pay_voucher");
		
		total_bayar=cash+card+debit+voucher;
		sisa=total_bayar-total;
		if(sisa>=0 && cash>0){
			total_bayar=total_bayar-sisa;
			sisa=cash-total_bayar;
			if(sisa<0)sisa=0;
		}
		if(sisa==0 && voucher>0){
			sisa=(cash+card+debit+voucher)-total;
		}
		$("#bayar").val(formatNumber(total_bayar));
		cvalf("#pay_total",total_bayar);
		
		$("#ttl_nota").html(formatNumber(total));
		$("#ttl_sisa").html(formatNumber(sisa));
		
		cvalf("#kembali",sisa);
		
		$("#dlgPay_tagih").val(formatNumber(total));
		$("#dlgPay_sisa").val(formatNumber(sisa));
		$("#qty_total").html(qty_total);
		$("#qty_jenis").html(qty_jenis);
	}
	/**
	 * @param num The number to round
	 * @param precision The number of decimal places to preserve
	 */
	function roundUp(num, precision) {
	  ///precision = Math.pow(10, precision)
	  if(precision==0){
	  	return num;
	  }
	  return Math.ceil(num / precision) * precision
	}
	
	function get_header_nota(){
		var total=$("#ttl_nota").html();
		total=total.toString().replace(",","");
		
		nota=$("#nota").html();
		cust_type=$("#cust_type").val();
		cust=$("#cust").html();
		total=$("#total_nota").val();
		total=total.toString().replace(",","");
		
		
		disc_prc=$("#disc_nota_prc").val();
		disc_prc=(+disc_prc)/100;
		disc_amt=$("#disc_nota_rp").val();
		disc_amt=disc_amt.toString().replace(",","");
		
		ppn_prc=$("#ppn_prc").val();
		ppn_prc=(+ppn_prc)/100;
		ppn_amt=$("#ppn_rp").val();
		ppn_amt=ppn_amt.toString().replace(",","");
		
		pbulat=$("#pbulat").val();pbulat.toString().replace(",","");
		
		var header={"invoice_number":nota,"cust_type":cust_type,"cust":cust,
		"discount":disc_prc,"sales_tax_percent":ppn_prc,"amount":total,
		"discount_amount":disc_amt,"tax":ppn_amt,"other":pbulat};
		
		return header;
	}
	function save_nota() {
		void total_nota();
		var header=get_header_nota();
		var param={"header":header,"items": arItem}
		var ok=false;
		loading();
		$.ajax({type: "POST",url: url_save_pos,data: param,
			success: function(result){
				loading_close();
				var result = eval('('+result+')');
				if(result.success){
					edit_nota(result.invoice_number);
					log_err("Nota berhasil disimpan.");
					list_nota_open();					
				}
			},
			error: function(result){
				loading_close();
				log_err(result);
				return false;
			}			
		}); 		
	}
    function card_info(){
        $("#dlgCard").dialog("open").dialog('setTitle','Info Kartu');
    }
    function debit_info(){
        card_info();
    }
    function dlgCard_Cancel(){
        $("#credit_card_type").val("");
        $("#credit_card_number").val("");
        $("#authorization").val("");
        $("#expiration_date").val("");
        $("#dlgCard").dialog("close");
    }
    function dlgCard_Ok(){
    	var rek=$("#credit_card_type").val();
    	if(rek==""){
    		log_err("Pilih rekening !");
    		return false;
    	}
        $("#dlgCard").dialog("close");        
        
        var flag=$("#dlgCard_flag1").val();
        if(flag=="1"){
        	$("#dlgCard_flag1").val("");
	        pay_nota_bawah();        
        }
        if(flag=="9"){
        	dlgPaySplit_Card_Submit();
        }
    }
	
	function submit_payment_ex() {
		void total_nota();
		var total=$("#ttl_nota").html();
		var sisa=$("#ttl_sisa").html();
		var cash=$("#pay_cash").val();
		var card=$("#pay_card").val();
		var debit=0;		///$("#debitcard").val();
		var kembali=cval("#kembali");
		var voucher=cval("#pay_voucher");	
		rek=$("#credit_card_type").val();
	
		if(kembali<0){
			log_err("Masih kurang bayar !");
			return false;
		}
		
		if (card>0 && rek==""){
			log_err("Rekening / EDC belum dipilih !");
			return false;
		}
		if(voucher>0 && $("#voucher_no").val()==""){
			log_err("Nommor voucher belum diisi !");
			return false;
		}
		
		var header=get_header_nota();
		
		var payment={"cash":cash,"card":card,"debit":debit,"voucher":voucher,"kembali":kembali,
			"credit_card_type":$("#credit_card_type").val(),
			"credit_card_number":$("#credit_card_number").val(),
			"authorization":$("#authorization").val(),
			"expiration_date":$("#expiration_date").val(),
			"from_bank":$("#from_bank").val(),"voucher_no":$("#voucher_no").val()};
			
		var param={"header":header,"items": arItem,"payment":payment}
		var ok=false;
		loading();
		$.ajax({type: "POST",url: url_save_pos,data: param,
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
				log_err(result);
				return false;
			}			
		}); 		
	}
	function reprint_nota(){
		var nomor=prompt("Input nomor nota :");
		
		loading();
		$("#divNotaPrint").html("");
		
		$.ajax({type: "GET",url: url_print_nota+nomor+'/reprint',
			success: function(result){
				$("#divNotaPrint").html(result);
	  			$('#dlgNotaPrint').dialog({modal: true}).dialog('open').dialog('setTitle','Print Dialog');
				
				loading_close();
			},
			error: function(result){
				loading_close();
				log_err(result);
				return false;
			}			
		}); 				

	}
	
	function reprint_nota_old(){
		var nomor=prompt("Input nomor nota :");
		var s="";
		loading();
		$.ajax({type: "GET",url: url_edit_nota+nomor,
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
				log_err(result);
				return false;
			}			
		}); 		
		
	}
	function reprint_nota_data(result){
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
		s += "<tr><td colspan='4'>TOTAL Rp. </td><td align='right'>"+formatNumber(total)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR CASH Rp. </td><td align='right'>"+formatNumber(cash)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR CARD Rp. </td><td align='right'>"+formatNumber(card)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR DEBT Rp. </td><td align='right'>"+formatNumber(debit)+"</td></tr>";
		s += "</table>";
		return s;
	}
	function preview_nota(nomor){
		loading();
		$("#divNotaPrint").html("");
		
		$.ajax({type: "GET",url: url_print_nota+nomor,
			success: function(result){
				$("#divNotaPrint").html(result);
	  			$('#dlgNotaPrint').dialog({modal: true}).dialog('open').dialog('setTitle','Print Dialog');
				
				loading_close();
			},
			error: function(result){
				loading_close();
				log_err(result);
				return false;
			}			
		}); 				
	}
	function preview_nota_old(nomor){
		var total=$("#total_nota").val();
		var cash=cval("#pay_cash");
		var card=cval("#pay_card");
		//var debit=cval("#pay_debit");
		var sisa=cval("#kembali");
		var rekening=$("#credit_card_type").val();
		//sisa=sisa.toString().replace(/,/g , "");		
		var s="<table width='200px'><tr><td colspan='5' align='center'>"+nama_toko+"</td></tr>";
		s += "<tr><td colspan='5' align='center'>"+alamat+"</td></tr>";
		s += "<tr><td colspan='5' align='center'>"+telp+"</td></tr>";
		s += "<tr><td colspan='5' align='center'>"+kota+"</td></tr>";
		s += "<tr><td colspan='5'>=================================</td></tr>";
		s += "<tr><td colspan='4'>Nota#</td><td>"+nomor+"</td></tr>";
		s += "<tr><td colspan='4'>Tanggal</td><td>"+tanggal+"</td></tr>";
		s += "<tr><td colspan='4'>Kasir</td><td>"+kasir+"</td></tr>";
		s += "<tr><td colspan='5'>=================================</td></tr>";
		for(i=0;i<arItem.length;i++){
			s += "<tr>";
			s += "<td colspan='5'>"+arItem[i][1]+"</td></tr>";
			s += "<td colspan='5'>"+arItem[i][2]+"</td></tr>";
			s += "<tr><td>"+arItem[i][3]+"</td><td>x</td><td align='right'>"+arItem[i][4]+"</td>"+
				"<td>=</td><td align='right'>"+arItem[i][7]+"</td>";
			s += "</tr>";
		}
		s += "<tr><td colspan='5'>=================================</td></tr>";
		s += "<tr><td colspan='4'>TOTAL Rp. </td><td align='right'>"+(total)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR CASH Rp. </td><td align='right'>"+formatNumber(cash)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR CARD Rp. </td><td align='right'>"+formatNumber(card)+"</td></tr>";
		s += "<tr><td colspan='4'>-- Rek: "+rekening+"</td><td></td></tr>";
		//s += "<tr><td colspan='4'>BAYAR DEBT Rp. </td><td align='right'>"+formatNumber(debit)+"</td></tr>";
		s += "<tr><td colspan='4'>BAYAR VOUCHER Rp. </td><td align='right'>"+formatNumber(voucher)+"</td></tr>";
		s += "<tr><td colspan='4'>KEMBALI Rp. </td><td align='right'>"+(formatNumber(sisa))+"</td></tr>";
		s += "<tr><td colspan='5'>=================================</td></tr>";
		s += "<tr><td colspan='5' align='center'>Barang yang sudah dibeli tidak</td></tr>";
		s += "<tr><td colspan='5' align='center'>bisa ditukar/dikembalikan</td></tr>";
		s += "<tr><td colspan='5' align='center'>***Terimakasih***</td></tr>";
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
	
function clear_input(){
	$("#barcode").val("");					$("#item_komisi_tour").val(0);
	$("#item_nama_barang").val("");			$("#item_tenant").val("");
	$("#qty").val(1);						$("#item_ref").val("");
	$("#item_price").val("0");				$("#credit_card_type").val("");
	$("#item_disc_prc").val("0");			$("#credit_card_number").val("");
	$("#item_disc_amt").val("0");			$("#authorization").val("");
	$("#item_disc_prc_2").val("0");			$("#expiration_date").val("");
	$("#item_disc_amt_2").val("0");			$("#qty_top").val(1);	
	$("#item_disc_prc_3").val("0");			$("#barcode_top").val("");
	$("#item_disc_amt_3").val("0");			$("#total_nota").val(0);
	$("#item_total").val("0");				$("#disc_amount_ex").val(0);
	$("#credit_card_type").val("");			$("#dlgCard_flag1").val("");
	$("#line").val("");						$("#unit").val("");
	$("#m_unit").val("");					$("#m_price").val(0);
	$("#m_qty").val(1);
}
function add_row_sales(){
    next_row++;
    item_number=$("#barcode").val();
    if(item_number==''){
    	log_err("Isi atau scan barcode !");
    	$('#barcode').focus();
    	return false;
    }
    description=$("#item_nama_barang").val();		item_disc_prc_2=$("#item_disc_prc_2").val();
    qty=$("#qty").val();							item_disc_amt_2=$("#item_disc_amt_2").val();
    retail=$("#item_price").val();					item_disc_prc_3=$("#item_disc_prc_3").val();
    item_disc_prc=$("#item_disc_prc").val();		item_disc_amt_3=$("#item_disc_amt_3").val();
    item_disc_amt=$("#item_disc_amt").val();		unit=$("#unit").val();
    item_total=$("#item_total").val();				m_unit=$("#m_unit").val();
    disc_amount_ex=$("#disc_amount_ex").val();		m_price=$("#m_price").val();
    m_qty=$("#m_qty").val();
    
    tenant=$("#tenant").val();
    ref=$("#ref").val();
    add_row(next_row,item_number,description,qty,unit,retail,item_disc_prc, 
    	item_disc_amt,item_total,tenant,ref,item_disc_prc_2,item_disc_amt_2,
    	item_disc_prc_3,item_disc_amt_3,0,disc_amount_ex,m_qty,m_unit,m_price);
    	
    total_nota();
    clear_input();
    
}
function add_row_data(ar){
	for(i=0;i<ar.length;i++){
		a=ar[i];
		add_row(a.no_urut,a.item_number,a.description,a.quantity,a.unit,
			a.price,a.discount,a.discount_amount,a.amount,a.employee_id,
			a.from_line_type,a.disc_2,a.disc_amount_2, 
			a.disc_3,a.disc_amount_3,a.line_number,a.disc_amount_ex,
			a.mu_qty,a.multi_unit,a.mu_harga);
	}
}
function clear_header_items(){
	$("#divNota").html("<table id='tbl_nota' width='1200px' " +
		" cellpadding='5' class='nota-content'> " +
	    "  <tr><th>No</th><th>Kode</th><th>Nama Barang</th><th>Qty</th><th>Unit</th> " +
	    "  <th>Price</th><th>Disc%</th><th>DiscRp</th><th>Jumlah</th> " +
	    "  <th>Tenant</th><th>Ref</th><th>Disc%2</th><th>DiscRp2</th> " +
	    "  <th>Disc%3</th><th>DiscRp3</th><th>DiscRpEx</th><th>Line</th> " +
	    "  <th>M Qty</th><th>M Unit</th><th>M Price</th> " +
	    " </tr> " +                        
	"</table>");
}


function calc_input(){
	
    qty=$("#qty").val(); if(qty=='')qty=1;
    
    item_price=$("#item_price").val(); if(item_price=='')item_price=0;
    item_price=item_price.replace(/,/g,"");

	calc_qty_unit();
	    
    //item disc 1
    item_disc_prc_dec=0;
    item_disc_prc=$("#item_disc_prc").val();
    if(item_disc_prc=='')item_disc_prc=0;
    if(item_disc_prc>1)	item_disc_prc=item_disc_prc/100;
    item_disc_amt=item_price*item_disc_prc;
    item_disc_amt=parseFloat(item_disc_amt).toFixed(2);
    
    item_price=item_price-item_disc_amt;
    
	//item disc 2
	item_disc_prc_dec_2=0;
    item_disc_prc_2=$("#item_disc_prc_2").val();
    if(item_disc_prc_2=='')item_disc_prc_2=0;
    if(item_disc_prc_2>1){
    	item_disc_prc_2=item_disc_prc_2/100;
    }
    item_disc_amt_2=item_price*item_disc_prc_2;
    item_disc_amt_2=Math.round(item_disc_amt_2,2);

    item_price=item_price-item_disc_amt_2;

	//item disc 3
	item_disc_prc_dec_3=0;
    item_disc_prc_3=$("#item_disc_prc_3").val();
    if(item_disc_prc_3=='')item_disc_prc_3=0;
    if(item_disc_prc_3>1){
    	item_disc_prc_3=item_disc_prc_3/100;
    }
    item_disc_amt_3=item_price*item_disc_prc_3;
    item_disc_amt_3=Math.round(item_disc_amt_3,2);

    item_price=item_price-item_disc_amt_3;

    item_komisi_tour=$("#item_komisi_tour").val();
    if(item_komisi_tour=='')item_komisi_tour=0;
    item_komisi_tour=item_komisi_tour.replace(/,/g,"");

    total=qty*item_price;
    
    item_disc_amt_ex=$("#disc_amount_ex").val();
    if(item_disc_amt_ex=='')item_disc_amt_ex=0;
    item_disc_amt_ex=item_disc_amt_ex.replace(/,/g,"");
    item_disc_amt_ex=parseFloat(item_disc_amt_ex).toFixed(2);
    
    total=total-item_disc_amt_ex;


    $("#qty").val(qty);    
    $("#item_disc_prc").val(item_disc_prc);    
    $("#item_disc_amt").val(formatNumber(item_disc_amt));
    $("#item_disc_prc_2").val(item_disc_prc_2);    
    $("#item_disc_amt_2").val(formatNumber(item_disc_amt_2));
    $("#item_disc_prc_3").val(item_disc_prc_3);    
    $("#item_disc_amt_3").val(formatNumber(item_disc_amt_3));
    
    $("#item_komisi_tour").val(formatNumber(item_komisi_tour));
    
    $("#disc_amount_ex").val(formatNumber(item_disc_amt_ex));
    $("#item_total").val(formatNumber(total));
}
	function find_barcode(){
		var qty=$("#qty").val();
		var barcode=$("#barcode").val();
		if(barcode==""){
			console.log("item_number is empty !");return false;
		}
		//$("#barcode").val("");
		$("#qty").val("1");
		loading();
		$.ajax({
			type: "GET",
			url: url_item_find+barcode,
			success: function(msg){
				loading_close();
				var result = eval('('+msg+')');
				if(result.success){
					result_set(result);
				    calc_input();				    
				    $("#qty").focus();
				} else {
					log_err("Barcode Not Found !");
				}
			},
			error: function(msg){
				loading_close();
				console.log(msg);
			}
		});					
	    return false;
    }
    function result_set(result){
        //console.log(result);
        $("#barcode").val(result.item_number);
        $("#item_nama_barang").val(result.description);
        $("#qty").val("1");
        $("#item_price").val(formatNumber(result.retail));
        $("#item_disc_prc").val(result.disc_prc_1);
        $("#item_disc_prc_2").val(result.disc_prc_2);
        $("#item_disc_prc_3").val(result.disc_prc_3);
        $("#unit").val(result.unit_of_measure);
        $("#m_unit").val(result.unit_of_measure);
        $("#m_price").val(result.retail);
        $("#m_qty").val(1);
        
        if(result.multiple_pricing=="1"){
            $("#cmdLovUnit").show();
            $("#divMultiUnit").show();
        } else {
            $("#cmdLovUnit").hide();
            $("#divMultiUnit").hide();          
        }
    }

	function find_barcode_top(){
		var qty=$("#qty_top").val();
		var barcode=$("#barcode_top").val();
		if(barcode==""){
			console.log("item_number is empty !");return false;
		}
		loading();
		$.ajax({
			type: "GET",
			url: url_item_find+barcode,
			success: function(msg){
				loading_close();
				var result = eval('('+msg+')');
				if(result.success){
					result_set(result);
				    calc_input();
				    add_row_sales();	
				} else {
					log_err("Barcode Not Found !");
				}
			},
			error: function(msg){
				loading_close();
				console.log(msg);
			}
		});					
	    return false;
    }    
    function list_nota_open(){
    	loading();
		$.ajax({type: "GET",url: url_nota+'list_nota_open',data:'',
			success: function(msg){	
				loading_close();
				var result = eval('('+msg+')');
				if(result.success){
					arNota=result.list_nota;	
					s="<table width='100%'>";
					if(arNota){
						for(i=0;i<arNota.length;i++){
							nota=arNota[i];
							amt=nota.amount;
							if(amt==null)amt=0;
							amt=Math.round(amt,2);
							s=s+"<tr><td><a href='#' onclick=\"edit_nota('"+nota.invoice_number+"');return false\">"+nota.invoice_number+"</a></td>"+
							"<td align=right>"+formatNumber(amt)+"</td></tr>";
						}	
					}
					s=s+"</table>";
					$("#divNotaOpen").html(s);
					$("#msg-box-wrap").html("Ready.");

				} else {
					log_err(result.msg);
				}
			},
			error: function(msg){
				log_err(msg);}
		});			
    }
	function edit_nota(nomor){
		var s="";
		loading();
		$.ajax({type: "GET",url: url_edit_nota+nomor,
			success: function(result){
				s=result;
				loading_close();
				var result = eval('('+result+')');
				if(result.success){
					edit_nota_data(result);
				} else {
					log_err(result.msg);
				}
			},
			error: function(result){
				loading_close();
				return false;
			}			
		}); 		
	}
	function edit_nota_data(result){
		var invoice=result.invoice;
		var items=result.items;
		var payments=result.payments;
		clear_header_items();
		$("#nota").html(invoice.invoice_number);
		$("#nota_tmp").html("");
		$("#tanggal").html(fmt_date(invoice.invoice_date));
		$("#userid").html(invoice.salesman);
		$("#cust").html(invoice.sold_to_customer);
		$("#cust_name").html(invoice.company);
		$("#cust_type").val(invoice.type_of_invoice);
		$("#disc_nota_prc").val(invoice.discount);
		$("#disc_nota_amt").val(invoice.disc_amount_1);
		$("#ppn_prc").val(invoice.sales_tax_percent);
		$("#ppn_amt").val(invoice.tax);
		$("#total_nota").val(invoice.amount);
		
		add_row_data(items);		
		
		if(payments){
			for(i=0;i<payments.length;i++){
				p=payments[i];
				if(p.how_paid=="CASH"){
					cvalf("#pay_cash",p.amount_paid);
				}
				if(p.how_paid=="CARD"){
					cvalf("#pay_card",p.amount_paid);
				}
				if(p.how_paid=="DEBIT"){
					//cvalf("#pay_debit",p.amount_paid);
				}
				if(p.how_paid=="VOUCHER"){
					cvalf("#pay_voucher",p.amount_paid);
				}
				
			}
		}
	    total_nota();
	}
	
	function pay_nota_bawah(){

		void total_nota();	//masuk ke arItem
		
		total=cval("#total_nota");
		var sisa=$("#ttl_sisa").html();
		cash=cval("#pay_cash");
		card=cval("#pay_card");
		debit=0; //cval("#pay_debit");
		voucher=cval("#pay_voucher");
		pay_total=cval("#pay_total");
		kembali=cval("#kembali")
		rek=$("#credit_card_type").val();
		voucher_no=$("#voucher_no").val();
		if(voucher>0 && voucher_no==""){
			log_err("Isi nomor voucher !");
			return false;
		}
		if(pay_total==0){
			log_err("Belum ada pembayaran !");
			return false;
		}
		if(kembali<0){
			log_err("Masih kurang bayar !");
			return false;
		}
		if (card>0 && rek==""){
			log_err("Rekening / EDC berlum dipilih !");
			return false;
		}
		
		var header=get_header_nota();
		
		var payment={"cash":cash,"card":card,"debit":debit,"voucher":voucher,"kembali":kembali,
			"credit_card_type":$("#credit_card_type").val(),"voucher_no":voucher_no,
			"credit_card_number":$("#credit_card_number").val(),
			"authorization":$("#authorization").val(),
			"expiration_date":$("#expiration_date").val(),
			"from_bank":$("#from_bank").val()};
					
		var param={"header":header,"items": arItem,"payment":payment}
		var ok=false;
		loading();
		$.ajax({type: "POST",url: url_save_pos,data: param,
			success: function(result){
				loading_close();
				var result = eval('('+result+')');
				if(result.success){
					void preview_nota(result.invoice_number);
					void new_nota();
				}
			},
			error: function(result){
				loading_close();
				log_err(result);
				return false;
			}			
		}); 		
}
	function reports(){
		window.open(base_url+'pos.php/reports','_blank');
	}
    function submit_session(){
        _url=CI_BASE+'pos.php/user/session';        
        _data={shipping_location:$("#shipping_location").val()};
        
        console.log(_data);
        
        $.ajax({
                type: "POST",
                url: _url,data: _data,
                success: function(msg){
                    console.log(msg);
                    window.open(CI_BASE+"pos.php","_self");
                }
        });
    }
    function pay_cash_nota(){
        total_nota();
        var ttl_nota=cval("#total_nota");
        if(ttl_nota==0){
            log_err("Jumlah nota 0 mungkin tidak ada itemnya. !");
            return false;
        }
        $("#dlgPayCash_Tagih").val(formatNumber(ttl_nota));
        $("#dlgPayCash_Kembali").val(0);
        $("#dlgPayCash_Bayar").val(0);
        $("#dlgPayCash_Bayar").focus();
        $("#dlgPayCash_Flag").val("");
        $("#pay_card").val(0);
        $("#card_amount").val(0);
        $("#dlgPayCash").dialog({modal: true}).dialog("open").dialog('setTitle','Dialog');         
    }
    function pay_card_nota(){
        total_nota();
        var ttl_nota=cval("#total_nota");
        if(ttl_nota==0){
            log_err("Jumlah nota 0 mungkin tidak ada itemnya. !");
            return false;
        }
        $("#pay_card").val(formatNumber(ttl_nota));
        $("#card_amount").val(formatNumber(ttl_nota));
        $("#dlgCard_flag1").val("1");
        $("#dlgCard").dialog({modal: true}).dialog("open").dialog('setTitle','Info Kartu');
    }
    function dlgPayCash_Cancel(){
        $("#dlgPayCash").dialog("close");
    }
    function dlgPayCash_Submit(){
        $("#dlgPayCash").dialog("close");
        var flag=$("#dlgPayCash_Flag").val();
        if(flag=="9"){
        	dlgPaySplit_Cash_Submit();
        } else {
	        pay_nota_bawah();        
        }
    }
    function dlgPayCash_Calc(){
        var ttl_nota=cval("#total_nota");
        var cash=cval("#dlgPayCash_Bayar");
        $("#pay_cash").val(formatNumber(cash));
        var sisa=cash-ttl_nota;
        $("#dlgPayCash_Kembali").val(formatNumber(sisa));
        total_nota();
    }
    function pay_split_nota(){
        total_nota();
        var ttl_nota=cval("#total_nota");
        if(ttl_nota==0){
            log_err("Jumlah nota 0 mungkin tidak ada itemnya. !");
            return false;
        }
        var ttl_nota=cval("#total_nota");
        $("#dlgPaySplit_Tagih").val(formatNumber(ttl_nota));
        $("#dlgPaySplit").dialog({modal: true}).dialog("open").dialog('setTitle','Split Payment');
    }
	function edit_row(){
		var caption=$(this).html();
		
		tableData = $("#tbl_nota tr").eq(selected_row).children("td").map(function() {
			return $(this).text();
		}).get();
		
		var id=tableData[C_ID];
		
		if(selected_row==0 ){
			log_err("Invalid row !");return false;
		}
		$("#barcode").val(tableData[C_CODE]);		
		$("#item_nama_barang").val(tableData[C_NAME]);		
		$("#item_price").val(tableData[C_PRICE]);		
		$("#item_disc_prc").val(tableData[C_DISC_PRC]);		
		$("#item_disc_amt").val(tableData[C_DISC_AMT]);		
		$("#item_disc_prc_2").val(tableData[C_DISC_PRC_2]);		
		$("#item_disc_amt_2").val(tableData[C_DISC_AMT_2]);		
		$("#item_disc_prc_3").val(tableData[C_DISC_PRC_3]);		
		$("#item_disc_amt_3").val(tableData[C_DISC_AMT_3]);		
		$("#dis_amount_ex").val(tableData[C_DISC_AMT_EX]);		
		$("#item_total").val(tableData[C_AMOUNT]);		
		//$("#item_komisi_tour").val(tableData[C_REF]);		
		$("#tenant").val(tableData[C_TENANT]);		
		$("#ref").val(tableData[C_REF]);		
		$("#qty").val(tableData[C_QTY]);		
		$("#line").val(tableData[C_ID]);
		$("#unit").val(tableData[C_UNIT]);		
		$("#m_qty").val(tableData[C_M_QTY]);		
		$("#m_unit").val(tableData[C_M_UNIT]);		
		$("#m_price").val(tableData[C_M_PRICE]);		
		
		log_msg("Silahkan ubah kemudian tekan [Add Item] lagi."); 
	}
function add_row(next_row,item_number,description,qty,unit,retail, 
	item_disc_prc,item_disc_amt,item_total,tenant,
	ref,item_disc_prc_2,item_disc_amt_2,
	item_disc_prc_3,item_disc_amt_3,line,disc_amount_ex, 
	m_qty,m_unit,m_price){
			
	var line_id=$("#line").val();
	if(line_id!=""){
		update_row(next_row,item_number,description,qty,unit,retail, 
			item_disc_prc,item_disc_amt,item_total,tenant,
			ref,item_disc_prc_2,item_disc_amt_2,
			item_disc_prc_3,item_disc_amt_3,line,disc_amount_ex,
			m_qty,m_unit,m_price);
	} else {
	    $(".nota-content").append("  "
	    +"<tr class='line-order'> "
	    +"<td>"+next_row+"</td>"
	    +"<td>"+item_number+"</td>"
	    +"<td>"+description+"</td>"
	    +"<td align='right'><span id='q_"+next_row+"'>"+qty+"</span></td>"
	    +"<td align='right'><span id='q_"+next_row+"'>"+unit+"</span></td>"
	    +"<td align='right'><span id='p_"+next_row+"'>"+formatNumber(retail)+"</span></td>"
	    +"<td align='right'><span id='d_"+next_row+"'>"+item_disc_prc+"</span></td>"
	    +"<td align='right'><span id='da_"+next_row+"'>"+item_disc_amt+"</span></td>"
	    +"<td align='right'><span id='t_"+next_row+"' class='t_amount' >"+formatNumber(item_total)+"</span></td>"
	    +"<td>"+tenant+"</td>"
	    +"<td>"+ref+"</td><td>"+item_disc_prc_2+"</td><td>"+formatNumber(item_disc_amt_2)+"</td>"
	    +"<td>"+item_disc_prc_3+"</td><td>"+formatNumber(item_disc_amt_3)+"</td>"
	    +"<td>"+disc_amount_ex+"</td><td>"+line+"</td>"
		+"<td>"+m_qty+"</td>"	    
		+"<td>"+m_unit+"</td>"
	    +"<td>"+m_price+"</td>"
	    +"</tr>");		
	}			
}    
function update_row(next_row,item_number,description,qty,retail, 
	item_disc_prc,item_disc_amt,item_total,tenant,
	ref,item_disc_prc_2,item_disc_amt_2,
	item_disc_prc_3,item_disc_amt_3,line,disc_amount_ex,
	unit,m_unit,m_price,m_qty){
	var i=0;
	//cari kalau ada item yg sama diupdate qty dan hitung lagi baris	
	$(".line-order").each(function(){
		td = $(this).children("td").map(function() {
			return $(this).text();
		}).get();
		
		i++;
		if (selected_row==i) { //edit line
			$(this).children("td:nth-child("+(C_CODE+1)+")").html(item_number);
			$(this).children("td:nth-child("+(C_NAME+1)+")").html(description);
			$(this).children("td:nth-child("+(C_QTY+1)+")").html(qty);
			$(this).children("td:nth-child("+(C_UNIT+1)+")").html(unit);
			$(this).children("td:nth-child("+(C_DISC_PRC+1)+")").html(item_disc_prc);
			$(this).children("td:nth-child("+(C_DISC_PRC_2+1)+")").html(item_disc_prc_2);
			$(this).children("td:nth-child("+(C_DISC_PRC_3+1)+")").html(item_disc_prc_3);
			$(this).children("td:nth-child("+(C_DISC_AMT+1)+")").html(formatNumber(item_disc_amt));
			$(this).children("td:nth-child("+(C_DISC_AMT_2+1)+")").html(formatNumber(item_disc_amt_2));
			$(this).children("td:nth-child("+(C_DISC_AMT_3+1)+")").html(formatNumber(item_disc_amt_3));
			$(this).children("td:nth-child("+(C_DISC_AMT_EX+1)+")").html(formatNumber(disc_amount_ex));
			$(this).children("td:nth-child("+(C_PRICE+1)+")").html(formatNumber(retail));
			$(this).children("td:nth-child("+(C_AMOUNT+1)+")").html(formatNumber(item_total));
			$(this).children("td:nth-child("+(C_TENANT+1)+")").html(tenant);
			$(this).children("td:nth-child("+(C_REF+1)+")").html(ref);
			$(this).children("td:nth-child("+(C_NO+1)+")").html(selected_row);
			$(this).children("td:nth-child("+(C_M_UNIT+1)+")").html(m_unit);
			$(this).children("td:nth-child("+(C_M_PRICE+1)+")").html(m_price);
			$(this).children("td:nth-child("+(C_M_QTY+1)+")").html(m_qty);
			
			return true;
		}
	})
}
    