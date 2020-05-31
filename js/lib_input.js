$(function() { 	
	
	    $("#account_number").autocomplete({
	        url: CI_ROOT+"lookup/table/bank_accounts/bank_account_number/bank_name",
	        onItemSelect: function(value){
	            $("#account_number").val(value.data[0]);
	            $("#bank_name").html(value.data[1]);
	        }
	    });
	    $("#doc_status_x").autocomplete({
	        url:CI_ROOT+"lookup/query_sysvar_lookup2/doc_status",
	        onItemSelect: function(value){
	            $("#doc_status").val(valud.data[0]);
	        }
	    });
	    
	    if($("#supplier_number").val()!=""){
	        $("#supplier_number").autocomplete({
	            url: CI_ROOT+"lookup/table/suppliers/supplier_number/supplier_name",
	            onItemSelect: function(value){
	                $("#supplier_number").val(value.data[0]);
	                $("#supplier_name").val(value.data[1]);
	                $("#supplier_name").html(value.data[1]);
	                $("#payee").val(value.data[1]);
	                $("#supplier_info").html(value.data[1]);
	                
	            }
	        });
	    	
	    }
        $("#sold_to_customer").autocomplete({
            url: CI_ROOT+"lookup/table/customers/customer_number/company",
            onItemSelect: function(value){
                $("#sold_to_customer").val(value.data[0]);
                $("#company").html(value.data[1]);
                $("#customer_info").html(value.data[1]);
            }
        });
        $("#sold_to_customer").autocomplete({
            url: CI_ROOT+"lookup/table/customers/customer_number/company",
            onItemSelect: function(value){
                $("#sold_to_customer").val(value.data[0]);
                $("#company").html(value.data[1]);
                $("#customer_info").html(value.data[1]);
            }
        });
        $("#warehouse_code_x").autocomplete({
            url: CI_ROOT+"lookup/table/shipping_locations/location_number/attention_name",
            onItemSelect: function(value){
                $("#warehouse_code").val(value.data[0]);
                $("#attention_name").html(value.data[1]);
            }
        });
        $("#term").autocomplete({
            url: CI_ROOT+"lookup/table/type_of_payment/type_of_payment/type_of_payment",
            onItemSelect: function(value){
                $("#term").val(value.data[0]);
                $("#termin").html(value.data[1]);
            }
        });
        $("#payment_term").autocomplete({
            url: CI_ROOT+"lookup/table/type_of_payment/type_of_payment/type_of_payment",
            onItemSelect: function(value){
                $("#payment_term").val(value.data[0]);
                $("#termin").html(value.data[1]);
            }
        });
        $("#item_number_x").autocomplete({
            url: CI_ROOT+"lookup/table/inventory/item_number/description",
            onItemSelect: function(value){
                $("#item_number").val(value.data[0]);
                $("#description").html(value.data[1]);
                $("#nama_barang").html(value.data[1]);
            }
        });
        $("#barcodexx").autocomplete({
            url: CI_ROOT+"lookup/table/inventory/item_number/description/retail",
            onItemSelect: function(value){
                $("#item_number").val(value.data[0]);
                $("#description").html(value.data[1]);
                $("#nama_barang").html(value.data[1]);
                
                $("#barcode").val(value.data[0]);
                $("#item_nama_barang").val(value.data[1]);
                $("#itemp_price").val(value.data[2]);
            }
        });
        $("#barcode_top").autocomplete({
            url: CI_ROOT+"lookup/table/inventory/item_number/description/retail",
            onItemSelect: function(value){
                $("#item_number").val(value.data[0]);
                $("#description").html(value.data[1]);
                $("#nama_barang").html(value.data[1]);
                
                $("#barcode_top").val(value.data[0]);
                $("#barcode").val(value.data[0]);
                $("#item_nama_barang").val(value.data[1]);
                $("#item_price").val(value.data[2]);
                $("#qty").val($("#qty_top").val());
            }
        });
        
        $("#category_x").autocomplete({
            url: CI_ROOT+"lookup/table/inventory_categories/kode/category",
            onItemSelect: function(value){
                $("#category").val(value.data[0]);
            }
        });
        $("#account_x").autocomplete({
            url: CI_ROOT+"lookup/table/chart_of_accounts/account/account_description",
            onItemSelect: function(value){
                $("#account").val(value.data[0]);
                $("#description").val(value.data[1]);
            }
        });
        $("#account_id_x").autocomplete({
            url: CI_ROOT+"lookup/table/chart_of_accounts/account/account_description",
            onItemSelect: function(value){
                $("#account_id").val(value.data[0]+" - "+value.data[1]);
            }
        });
        
	         
});
