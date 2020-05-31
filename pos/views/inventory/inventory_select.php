<div id="tb_search" style="height:auto" class="box-gradient">
	<div style="float:left">
	Enter Text: <input  id="search_item" style='width:100px' name="search_item">
	<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" 
	onclick="searchItem();return false;">Search</a>        
	</div>
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok"  onclick="selectSearchItem();return false;">Select</a>
</div>

<div id='dlgSearchItem' class="easyui-dialog" style="width:500px;height:380px;;left:100px;top:20px"
        closed="true" toolbar="#tb_search">
     <div id='divItemSearchResult'> 
		<table id="dgItemSearch" class="easyui-datagrid"  width="100%"
			data-options="
				toolbar: '',fitColumns:true,
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'description',width:150">Nama Barang</th>
					<th data-options="field:'item_number',width:80">Kode Barang</th>
					<th data-options="field:'category',width:80">Kelompok</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>


<script type="text/javascript">
	$().ready(function (){
	    $('#dgItemSearch').datagrid({
	        onDblClickRow:function(){
	            var row = $('#dgItemSearch').datagrid('getSelected');
	            if (row){
	            	selectSearchItem();
	            }       
	        }
	    });        
	});
	function dlgSearchItem_close(){
		$("#dlgSearchItem").dialog("close");
	}


		function find(){
			var cust_type=$('#cust_type').val();
			 
			var item=$("#item_number").val();
			if( item=="" || item=="undefined")return false;
			var cust_no=$("#sold_to_customer").val();
		    xurl=CI_ROOT+'inventory/find/'+$('#item_number').val()+'/'+cust_type ;
			var param={item_no:item,cust_type:cust_type,cust_no:cust_no};
		    $.ajax({
				type: "GET",
				url: xurl,
				data: param,
				success: function(msg){
					var obj=jQuery.parseJSON(msg);
					$('#item_number').val(obj.item_number);
					$('#price').val(obj.retail);
					$('#cost').val(obj.cost);
					$('#unit').val(obj.unit_of_measure);
					$('#description').val(obj.description);
					$("#discount").val(obj.discount);
					if(obj.discount==0) $("#discount").val(obj.disc_prc_1);
					$("#disc_2").val(obj.disc_prc_2);
					$("#disc_3").val(obj.disc_prc_3);
					if(obj.multiple_pricing){
						$("#cmdLovUnit").show();
					} else {
						$("#cmdLovUnit").hide();
					}
					hitung();
				},
				error: function(msg){alert(msg);}
		    });
		};
		function selectSearchItem()
		{
			var row = $('#dgItemSearch').datagrid('getSelected');
			if (row){
				$('#item_number').val(row.item_number);
				$('#description').val(row.description);
				find();
				$('#dlgSearchItem').dialog('close');
			}
			
		}
		function searchItem()
		{
			$('#dlgSearchItem').window({left:100,top:window.event.clientY+20});
			$('#dlgSearchItem').dialog('open')
				.dialog('setTitle','Cari data barang');
			nama=$('#search_item').val();
			$('#dgItemSearch').datagrid({url:'<?=base_url()?>index.php/inventory/filter/'+nama});
			$('#dgItemSearch').datagrid('reload');

		}
		
</script>