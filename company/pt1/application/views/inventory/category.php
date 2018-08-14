 
<div class='row'>
   <div class='col-md-4 col-lg-4 col-sm-4'>
   <legend>Categories</legend>
   	<?php 
		$error=validation_errors();
	    if($error)echo "<p class='alert alert-warning'>$error</p>";    
   		if($mode=='view'){
			echo form_open('category/update','id=myform');
			$disabled='disable';
		} else {
			$disabled='';
   			echo form_open('category/add','id=myform'); 
   		}
		if($mode=='view'){
			echo "<strong>Kode : <input type='text' disabled value='$kode'> </strong>";
			echo form_hidden('kode',$kode);
		} else { 
			echo my_input_2("Kode","kode",$kode);
		}
		echo my_input_2("Category","category",$category);
		echo my_input_2("Sales Disc %","sales_disc_prc",$sales_disc_prc);
		echo my_button_submit();
		echo form_close();
	?>
	</div>

<?php if($mode=='view'){ ?>
	
	<div class='col-md-6 col-lg-6 col-sm-6'>
		<?php 
		echo browse2("select kode,category 
		from inventory_categories_sub where parent_id='$kode'",
		"Sub Category",'category');
		?>
		<div id='tb'>
			<?php 
			echo link_button('Add','add_item()','add');
			echo link_button('Edit','edit_item()','edit');
			echo link_button('Delete','delete_item()','remove');
			
			?>
			
		</div>
	</div>
	
<?php } ?>
	
</div>
 <div id='dgItem' class="easyui-dialog" style="width:300px;height:380px;
	left:100px;top:20px;padding:5px 5px"
    closed="true" buttons="#btnItem" >
	<?php 
	echo "<p></p>";
    echo $this->form_builder->open_form(array('id' => 'frmItem','action'=>''));
    echo $this->form_builder->build_form_horizontal(array(
        array('id' => 'kode1','label'=>'Kode Sub Category'),
        array('id' => 'category1','label'=>'Nama Sub Category'),
        array('id'=> 'parent_id','type'=>'hidden','value'=>$kode)
    ));
    echo $this->form_builder->close_form();
	?>
</div>
<div id='btnItem'><?=link_button('Save','save_item()','save')?></div>

<script language="JavaScript">
	var mode='<?=$mode?>';
	
	function clear_input(){
		$('#kode1').val('');
		$('#category1').val('');
	}
	function add_item(){
		if(mode=="add"){
			alert("Simpan dulu sebelum tambah !");
			return false;
		}
		clear_input();
		$("#dgItem").dialog("open").dialog('setTitle','Input kode sub category');
		
	}
	function edit_item(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$('#kode1').val(row.kode);
			$('#category1').val(row.category);
			$("#dgItem").dialog("open").dialog('setTitle','Input kode sub category');			
		}
	}
	function delete_item(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
				if (r){
					url='<?=base_url()?>index.php/category/delete_sub/'+row.kode;
					$.ajax({
						type: "GET",url: url,param: '',
						success: function(result){
							var result = eval('('+result+')');
							if (result.success){
								$('#dg').datagrid('reload');
							}	
						},
						error: function(msg){$.messager.alert('Info',msg);}
				});
					
				}
			})
		}
		
	}
	function save_item(){
		if(mode=="add"){alert("Simpan dulu nomor ini !");return false;}
		var url = '<?=base_url()?>index.php/category/save_sub';
		$('#frmItem').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					$('#dg').datagrid('reload');
					clear_input();
					$("#dgItem").dialog("close");						
					$.messager.show({
						title: 'Success',
						msg: 'Success'
					});
				} else {
					$.messager.show({
						title: 'Error',
						msg: result.msg
					});
				}
			}
		});		
	}
</script>
 