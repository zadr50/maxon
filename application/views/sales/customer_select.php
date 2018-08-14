<!-- PILIH PELANGGAN --> 
<div id="btn1" name="btn1" class='box-gradient'>
<input  id="search_cust" style='width:200px' name="search_cust" placeholder='Search'>
<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="select_customer();return false;">Cari</a>        
<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="selected_customer();return false;">Pilih</a>
</div>
<div id='dlgSelectCust' class="easyui-dialog" style="width:600px;height:400px;
padding:5px 5px;left:100px;top:20px"
     closed="true" toolbar="#btn1">
     <div id='divSelectCust'> 
		<table id="dgSelectCust" class="easyui-datagrid"  width='100%'
			data-options="
				toolbar: '',fitColumns: true, 
				singleSelect: true,
				url: ''
			">
			<thead>
				<tr>
					<th data-options="field:'company',width:'180'">Pelanggan</th>
					<th data-options="field:'customer_number',width:'80'">Kode</th>
					<th data-options="field:'salesman',width:'80'">Salesman</th>
					<th data-options="field:'cust_type',width:'80'">Type</th>
					<th data-options="field:'city',width:'80'">Kota</th>
					<th data-options="field:'region',width:'80'">Wilayah</th>
				</tr>
			</thead>
		</table>
    </div>   
</div>
<SCRIPT language="javascript">
	function select_customer(){
			search=$('#search_cust').val();
			$('#dlgSelectCust').dialog('open').dialog('setTitle','Cari Pelanggan');
			$('#dgSelectCust').datagrid({url:'<?=base_url()?>index.php/customer/select/'+search});
			$('#dgSelectCust').datagrid('reload');
            $('#dgSelectCust').datagrid({
                onDblClickRow:function(){
                    selected_customer();
                }
            });        
            
			
	};	
	function selected_customer(){
		var row = $('#dgSelectCust').datagrid('getSelected');
		if (row){
			console.log(row);
			$('#sold_to_customer').val(row.customer_number);
			$('#company').val(row.company);
			$('#client').val(row.company);
			$('#customer_info').html(row.company+'<br>'+row.street+'<br>'+row.city);
			$('#customer_number').val(row.customer_number);
			$('#salesman').val(row.salesman);
			$('#payment_terms').val(row.payment_terms);
			$("#cust_type").val(row.cust_type);
			$("#tmp_disc_total_percent").val(row.discount_percent);
			$('#dlgSelectCust').dialog('close');
		} else {
			alert("Pilih salah satu nomor customer !");
		}
	}	
</SCRIPT>
<!-- END PILIH PELANGGAN -->

