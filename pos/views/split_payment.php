<div id="dlgPaySplit" name="dlgPaySplit" class="easyui-dialog" style="width:700px;height:450px" buttons="#dlgPaySplit_Button" 
	closed="true" modal="true">
    <div class="thumbnail">
        <label>Isi daftar dibawah ini dengan jumlah pembayaran dan jenis pembayaran</label>
        <table class='table'>
            <tr>
                <td>Tagihan</td><td>Bayar</td><td>Sisa</td>
            </tr>
            <tr>
                <td><?=form_input('',0,"id='dlgPaySplit_Tagih' disabled align='right'")?></td>                
                <td><?=form_input('',0,"id='dlgPaySplit_Bayar' disabled align='right'")?></td>                
                <td><?=form_input('',0,"id='dlgPaySplit_Sisa' disabled align='right'")?></td>                
            </tr>
            <tr><td colspan=4>
                <?=link_button("Cash","dlgPaySplit_Cash()","sum");?>                
                <?=link_button("Card","dlgPaySplit_Card()","sum");?>                
                <?=link_button("Voucher","dlgPaySplit_Voucher()","sum");?>                
                <!--
                <?=link_button("Other","dlgPaySplit_Other()","sum");?>                
                -->
                
            </td></tr>
            <tr>
                <td colspan=4>
                    <table class='table' id='dlgPaySplit_Table' border="1" cellpadding="2">
                        <tr>
                            <td>Cara Bayar</td><td align='right'>Bayar</td><td>Rekening</td><td>Card No/Voucher</td>
                            <td>Card Author</td><td>Card Expire</td>
                        </tr>
                    </table>
                    
                </td>
            </tr>
        </table>
    </div>
</div>
<div id="dlgPaySplit_Button">
        <?=link_button("Cancel","dlgPaySplit_Cancel()","cancel","false");?>                
        <?=link_button("Submit","dlgPaySplit_Submit()","save","false");?>                
</div>
<script type='text/javascript' language="JavaScript">   

	function calc_ttl_bayar_split(){
		
		var ttl_tagih=cval("#dlgPaySplit_Tagih");
		var ttl_bayar_split=0;
		var bayar=0;
		var i=0;
		$("#dlgPaySplit_Table tr").each(function(){
			if(i>0){
				td = $(this).children("td").map(function() {
					return $(this).text();
				}).get();
				bayar=td[1].toString().replace(/,/g , "");				
				ttl_bayar_split+=(+bayar);			
				
			}
			
			i++;
		});
		
		
		cvalf("#dlgPaySplit_Bayar",ttl_bayar_split);
		var ttl_sisa_split=ttl_tagih-ttl_bayar_split;		
        $("#dlgPaySplit_Sisa").val(formatNumber(ttl_sisa_split));
	}
    function dlgPaySplit_Cash(){
    	calc_ttl_bayar_split();
    	var ttl_sisa_split=cval("#dlgPaySplit_Sisa");
    	if (ttl_sisa_split==0){
    		log_err("Sisa=0 tidak bisa dibayar lagi !");
    		return false;
    	}
        $("#dlgPayCash_Flag").val("9");
        $("#dlgPayCash_Tagih").val(formatNumber(ttl_sisa_split));
        $("#dlgPayCash_Kembali").val(0);
        $("#dlgPayCash_Bayar").val(0);        
        $("#dlgPayCash").dialog("open").dialog('setTitle','Dialog');         
        
    }
    function dlgPaySplit_Cash_Submit(){
    	var cash=cval("#dlgPayCash_Bayar");
        $("#dlgPaySplit_Table").append("  "
        +"<tr> "
        +"<td>CASH</td>"
        +"<td align='right'>"+formatNumber(cash)+"</td>"
        +"<td></td>"
        +"<td></td>"
        +"<td></td>"
        +"<td></td>"
        +"</tr>");
        $("dlgPayCash").dialog("close");
        
		calc_ttl_bayar_split();        
    }
    function dlgPaySplit_Other(){
        
    }
    function dlgPaySplit_Voucher(){
    	calc_ttl_bayar_split();
    	var ttl_sisa_split=cval("#dlgPaySplit_Sisa");
    	
    	if (ttl_sisa_split==0){
    		log_err("Sisa=0 tidak bisa dibayar lagi !");
    		return false;
    	}
    	$("#voucher_no").val("");
        $("#voucher_amount").val(formatNumber(ttl_sisa_split));
        $("#dlgVoucher_flag").val("9");
        $("#dlgVoucher").dialog("open").dialog('setTitle','Info Voucher');
        
    }
    function dlgPaySplit_Voucher_Submit(){
    	var voucher_amount=cval("#voucher_amount");
        var voucher_no=$("#voucher_no").val();
        if(voucher_amount==0){
        	log_err("Jumlah voucher belum diisi !"); return false;
        }
        if(voucher_no==""){
        	log_err("Nomor voucher belum diisi !"); return false;
        }
        
    	
        $("#dlgPaySplit_Table").append("  "
        +"<tr> "
        +"<td>VOUCHER</td>"
        +"<td align='right'>"+formatNumber(voucher_amount)+"</td>"
        +"<td></td>"
        +"<td>"+voucher_no+"</td>"
        +"<td></td>"
        +"<td></td>"
        +"</tr>");
        $("dlgVoucher").dialog("close");
        
		calc_ttl_bayar_split();        
    	
    }
    function dlgPaySplit_Card(){
    	calc_ttl_bayar_split();
    	var ttl_sisa_split=cval("#dlgPaySplit_Sisa");
    	
    	if (ttl_sisa_split==0){
    		log_err("Sisa=0 tidak bisa dibayar lagi !");
    		return false;
    	}
    	
        $("#pay_card").val(formatNumber(ttl_sisa_split));
        $("#card_amount").val(formatNumber(ttl_sisa_split));
        $("#dlgCard_flag1").val("9");
        $("#dlgCard").dialog("open").dialog('setTitle','Info Kartu');
    }
    function dlgPaySplit_Card_Submit(){
    	var card=cval("#card_amount");
        var ctype=$("#credit_card_type").val();
        var cnumber=$("#credit_card_number").val();
        var cauthor=$("#authorization").val();
        var cexpire=$("#expiration_date").val();
    	
        $("#dlgPaySplit_Table").append("  "
        +"<tr> "
        +"<td>CARD</td>"
        +"<td align='right'>"+formatNumber(card)+"</td>"
        +"<td>"+ctype+"</td>"
        +"<td>"+cnumber+"</td>"
        +"<td>"+cauthor+"</td>"
        +"<td>"+cexpire+"</td>"
        +"</tr>");
        $("dlgCard").dialog("close");
        
		calc_ttl_bayar_split();        
    	
    }
    function dlgPaySplit_Cancel(){
    	$("#dlgPaySplit_Table").html("");
        $("#dlgPaySplit").dialog("close");
    }
    function dlgPaySplit_Submit(){
    	
    	calc_ttl_bayar_split();
    	var ttl_sisa_split=cval("#dlgPaySplit_Sisa");
    	var ttl_bayar_split=0;
		var i=0;
		var arPay=[];
    	
    	if (ttl_sisa_split!=0){
    		log_err("Masih ada sisa tidak bisa diteruskan !");
    		return false;
    	}
		$("#dlgPaySplit_Table tr").each(function(){
			if(i>0){
				td = $(this).children("td").map(function() {
					return $(this).text();
				}).get();
				bayar=td[1].toString().replace(/,/g , "");				
				ttl_bayar_split+=(+bayar);			
				arPay.push(td);
			}
			
			i++;
		});
    	
		var header=get_header_nota();
		

					
		var param={"header":header,"items": arItem,"payment_split":arPay}
		var ok=false;
		loading();
		$.ajax({type: "POST",url: url_save_pos,data: param,
			success: function(result){
				loading_close();
				var result = eval('('+result+')');
				if(result.success){
					dlgPaySplit_Cancel();
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

</script>
