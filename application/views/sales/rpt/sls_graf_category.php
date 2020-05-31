<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
	//$date1= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateFrom')));
	//$date2= date('Y-m-d H:i:s', strtotime($CI->input->post('txtDateTo')));
    $salesman=$CI->input->post("text1");
    $customer=$CI->input->post("text2");
    $outlet=$CI->input->post("text3");
    $category=$CI->input->post("text4");
    $region=$CI->input->post("text5");
   $data=$CI->input->post();
   
?>
<div class='thumbnail box-gradient'>
<strong>Dari Tanggal :</strong>
<?=form_input('txtDateFrom',$date1,'id="txtDateFrom" 
	 class="easyui-datetimebox" required style="width:130px"
	data-options="formatter:format_date,parser:parse_date" 	')?>
<strong>s/d :</strong>
<?=form_input('txtDateTo',$date2,'id="txtDateTo" 
	 class="easyui-datetimebox" required style="width:130px"
	data-options="formatter:format_date,parser:parse_date" ')?>
<strong>Category</strong><?=form_dropdown("wilayah",$lookup_category,"","id='wilayah'")?>
<?=link_button("", "dlgwilayah_show();return false;","search")?>
<?=link_button("Refresh", "on_refresh();return false","reload")?>	
	
</div>
<div id="divSales" class="" title="Grafik Penjualan"  
	data-options="iconCls:'icon-help'" width="100%" height="300px"
	style="padding:10px;border:1px solid lightgray;width:100%;height:300px" > 
	
		
</div>

<script type="text/javascript" src="<?=base_url()?>assets/flot/excanvas.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.categories.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/flot/jquery.flot.pie.js"></script>


<script type="text/javascript">

	
	var options2 = {
			bars: {
				show: true,
				barWidth: 0.6,
				align: "center"
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			}
	};	
	
	var data2 = [];
	var alreadyFetched2 = {};
	var dataurl2=CI_ROOT+'so/sales_graph/category_graph';

	function on_refresh(){
		var d1=$('#txtDateFrom').datetimebox('getValue'); 
		var d2=$('#txtDateTo').datetimebox('getValue'); 
		
		alreadyFetched2=null;
		data2=null;
		alreadyFetched2={};
		data2=[];
		loading();
		var param={"date1":d1,"date2":d2,"region":$("#wilayah").val()};
		
		$.ajax({
			url: dataurl2,data: param,
			type: "GET",
			dataType: "json",
			success: function(result) {
				loading_close();
				onDataReceived2(result);
			}
		});
	}

 
	function onDataReceived2(series) {
		if (!alreadyFetched2[series.label]) {
			alreadyFetched2[series.label] = true;
			data2.push(series);
		}
		$.plot("#divSales", data2, options2);
	}
			
			
			
	</script>