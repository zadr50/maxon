<? include_once "app_master_form.php"; ?>
<script language='javascript'>
	function valid(){
		var fld=["app_id","cust_id","counter_id","first_name","call_name",
		"gender","birth_place","birt_date","marital_status"];
		for(i=0;i<fld.length;i++){if($("#"+fld[i]).val()==""){alert('Isi field '+fld[i]+' !!'); return false;}		}
		return true;		
	}
  	function save(){
		if(!valid())return false;
		url='<?=base_url()?>index.php/leasing/app_master/save';
		$('#frmMain').form('submit',{
			url: url, onSubmit: function(){	return $(this).form('validate'); },
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#mode').val('view');
					log_msg('Data sudah tersimpan.');
					var app_id=$("#app_id").val();
					url='<?=base_url()?>index.php/leasing/app_master/view/'+app_id;
					window.open(url,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
  	}
	 
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/app_master");
	}
	function cmdLovCust(){
		
	}
	function cmdLovCounter(){
	
	}
	function calculate(){
		    url=CI_ROOT+'leasing/app_master/recalc/'+$('#app_id').val();
		    $.ajax({
                type: "GET", url: url,
				contentType: 'application/json; charset=utf-8',
                data:{dp_amount:$("#dp_amount").val(),insr_amount:$("#insr_amount").val(),
                admin_amount:$("#admin_amount").val(),inst_amount:$("#inst_amount").val(),
                inst_month:$("#inst_month").val(),dp_prc:$("#dp_prc").val(),rate_prc:$('#rate_prc').val(),
				promo_code:$("#promo_code").val()
				}, 
                success: function(msg){
                    var obj=jQuery.parseJSON(msg);
					console.log(obj);
					$('#sub_total').val(obj.sub_total);
                    $('#loan_amount').val(obj.loan_amount);
                    $('#dp_prc').val((obj.dp_prc));
                    $('#dp_amount').val((obj.dp_amount));
                    $('#insr_amount').val((obj.insr_amount));
                    $('#admin_amount').val((obj.admin_amount));
                    $('#inst_amount').val((obj.inst_amount));
                    $('#inst_month').val((obj.inst_month));
                    $('#rate_prc').val((obj.rate_prc));
                    $('#rate_amount').val((obj.rate_amount));
					window.open('<?=base_url()?>index.php/leasing/app_master/view/'+$("#app_id").val(),"_self");
					
                },
                error: function(msg){alert(msg);}
		    });
	}
	function CustomerShow(){
		var url="<?=base_url()?>index.php/leasing/cust_master/view/"+$("#cust_id").val()+'/view/false';
		add_tab_parent("cust_master",url);
	}
	function print_item(){
		window.open("<?=base_url()?>index.php/leasing/app_master/print_app/<?=$app_id?>","new");
		
	}
	
</script>