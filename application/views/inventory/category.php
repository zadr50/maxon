<div class="thumbnail box-gradient">
    <?=link_button('Save','on_save();return false;','save','false')?>     
    <?=link_button('Delete','on_delete();return false;','remove','false')?>     
    <div style='float:right'>
        <a href="#" class="easyui-splitbutton" data-options="plain:false, menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
        <div id="mmOptions" style="width:200px;">
            <div onclick="load_help('category')">Help</div>
            <div onclick="show_syslog('category','<?=$kode?>')">Log Aktifitas</div>
            <div>Update</div>
            <div>MaxOn Forum</div>
            <div>About</div>
        </div>
        <?=link_button('Close','remove_tab_parent()','cancel')?>
    </div> 
</div>
<?php 
    $readonly="";
    if($mode=='view')$readonly="readonly";
?>
<div class='easyui-tabs' >
   <div title='General' style='padding:5px'>
        <form name='frmMain' id='frmMain' method='POST'>
            <table class='table'>
                <tr>
                    <td>Kode Category</td><td><?=form_input("kode",$kode,"id='kode' $readonly")?></td>
                </tr>
                <tr>
                    <td>Nama Category </td><td><?=form_input("category",$category,"id='category' style='width:300px' ")?></td>
                </tr>
                <tr>
                    <td>Sales Disc % </td><td><?=form_input("sales_disc_prc",$sales_disc_prc,"id='sales_disc_prc' ")?></td>
                </tr>
                <tr>
                    <td>Inventory Account </td><td>
                        <?php echo form_input("inventory_account",
                        $inventory_account,"id='inventory_account' style='width:300px' ");
                        echo link_button('','dlginventory_account_show();return false','search','false');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Cogs Account </td><td>
                        <?php echo form_input("cogs_account",
                        $cogs_account,"id='cogs_account' style='width:300px' ");
                        echo link_button('','dlgcost_account_show();return false','search','false');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Sales Account </td><td>
                        <?php echo form_input("sales_account",
                        $sales_account,"id='sales_account' style='width:300px' ");
                        echo link_button('','dlgsales_account_show();return false','search','false');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tax Account </td><td>
                        <?php echo form_input("tax_account",
                        $tax_account,"id='tax_account' style='width:300px' ");
                        echo link_button('','dlgtax_account_show();return false','search','false');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Sales Target </td><td>
                        <?php echo form_input("sales_target",
                        $sales_target,"id='sales_target'  ");
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Icon File </td><td>
                        <?php echo form_input("icon_picture",
                        $icon_picture,"id='icon_picture'  ");
                        ?>
                    </td>
                </tr>
                
            </table>
        </form>
	</div>
    <div title='Sub Category' style='padding:5px'>
        <?php 
            echo browse2("select kode,category from inventory_categories_sub 
                where parent_id='$kode'","Sub Category",'category');
        ?>
        
    </div>
        
</div>
	

<div id='tb'>
    <?php 
    echo link_button('Add','add_item()','add');
    echo link_button('Edit','edit_item()','edit');
    echo link_button('Delete','delete_item()','remove');    
    ?>
    
</div>

 <div id='dgItem' class="easyui-dialog" style="width:500px;height:380px;
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
<div id='btnItem'>
    <?=link_button('Close','close_item();return false;','cancel')?>
    <?=link_button('Save','save_item();return false;','save')?>    
</div>

<?php 
echo $lookup_cost_account;
echo $lookup_inventory_account;
echo $lookup_sales_account;
echo $lookup_tax_account;

?>
<script language="JavaScript">
	
	var mode='<?=$mode?>';
	
	function on_save(){
	    var kode=$("#kode").val();
	    if(kode==""){log_err("Isi kode kategori  !!");return false;}
	    
        url='<?=base_url()?>index.php/category/save';
        loading();
        
        $('#frmMain').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    log_msg('Data sudah tersimpan');
                    remove_tab_parent();                    
                } else {
                    log_err(result.msg);
                }
            }
        });	    
	}
	function clear_input(){
		$('#kode1').val('');
		$('#category1').val('');
		$("#parent_id").val($("#kode").val());
	}
	function close_item(){
	    $("#dgItem").dialog("close");
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
    function on_delete(){
        var kode=$("#kode").val();
        if(kode==""){
            log_err("Pilih kode category !");
            return false;
        }
    
        $.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
            if (r){
                loading();
                url='<?=base_url()?>index.php/category/delete_json/'+kode;
                $.ajax({
                    type: "GET",url: url,param: '',
                    success: function(result){
                        var result = eval('('+result+')');
                        if (result.success){
                            remove_tab_parent();
                        }   
                    },
                    error: function(msg){$.messager.alert('Info',msg);}
            });
                
            }
        })
    }
	
</script>
 