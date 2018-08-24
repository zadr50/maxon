<script type="text/javascript">
    CI_ROOT = "<?=base_url()?>index.php/";
    CI_BASE = "<?=base_url()?>";        
</script>

<?php 
date_default_timezone_set("Asia/Jakarta");

echo $library_src;
echo $script_head;


$width=isset($width)?$width." px":"auto";
$height=isset($height)?$height." px":"auto";
$caption=isset($caption)?$caption:$controller;
$offset=0;
$limit=100;
$def_col_width=80; 
if(!isset($msg_left))$msg_left="<i>***Data yang ditampilkan hanya <b>100 baris.</b></i></br>
<i>***Apabila data tidak tampil, persempit pencarian (isi kriteria/kode) dan tekan tombol search.</i>";
if(!isset($msg_content))$msg_content="<p><i>Silahkan pilih satu baris ditabel ini kemudian klik toolbar edit diatas</i></p>";

?>
<div id='__section_left_content'   style='padding:0px;margin-left:0px;margin-right:0px'>
<?
$table_head="<thead><tr>";
if(isset($show_checkbox)){
    if($show_checkbox)    $table_head.="<th data-options=\"field:'ck',width:40\">Cek</th>";
}
for($i=0;$i<count($fields);$i++){
    $aFld=$fields[$i];
    if(is_string($aFld)){
        $fld_name=$fields[$i];
        $fld_caption=$fields_caption[$i];
    } else {
        $fld_name=$fields[$i]['name'];
        $fld_caption=$fields[$i]['caption'];
    }
    $table_head.="<th data-options=\"field:'$fld_name' ";
    if(isset($col_width[$fld_name])){
        $width=$col_width[$fld_name];
    } else {
        $width=$def_col_width;
    }
    $table_head.=", width:$width ";
    
    if(isset($fields_format_numeric)){
        if(is_num_format($fld_name,$fields_format_numeric)){
            $table_head.=",align:'right',editor:'numberbox', 
            formatter: function(value,row,index){
                if(isNumber(value)){
                    return number_format(value,2,'.',',');
                    return value;
                } else {
                    return value;
                }
            }";
        }
    } 
    $table_head.="\"";
    $table_head.=">".$fld_caption."</th>";
}
$table_head.="</tr></thead>";


if(isset($_form)){
	echo load_view($_form,array('mode'=>'add'));
}

$controller_name=str_replace("/","_",$controller);

if(isset($sub_controller)){
	$sub_strip="_".$sub_controller;
	$sub_slash="/".$sub_controller;
}else{
	$sub_controller='';
	$sub_strip="";
	$sub_slash="";
}
?>
<script type="text/javascript">    
    CI_CONTROL='<?=$controller?>';
    FIELD_KEY='<?=$field_key?>';
    CI_CAPTION='<?=$caption?>';
    CI_WIDTH='<?=$width?>';
    CI_HEIGHT='<?=$height?>';	
</script>
<div class='box-gradient' id='tb_<?=$controller_name?>' >
	<div class='legend-top'><?=$caption?></div>
	<?=link_button("Add", "addnew_$controller_name();return false;","add","false");?>
	<?=link_button("Edit", "edit_$controller_name();return false;","edit","false");?>
	<?=link_button("Del", "del_row_$controller_name();return false;","remove","false");?>
	<?
	if(isset($posting_visible)){
		echo link_button('Posting','posting_'.$controller_name."();return false;",'save');
	};
	if(isset($list_info_visible)){
		echo link_button('Info','cari_info_'.$controller_name."();return false;",'search');
	};
	if(isset($import_visible)){
		echo link_button('Import','import_'.$controller_name."();return false;",'more');			
	}
	if(isset($export_visible)){
		echo link_button('Export','export_'.$controller_name."();return false;",'xls');
	}	
	echo link_button('Filter','dlgFilter_'.$controller_name.'_Show();return false;','filter');
	if(isset($print_visible)){
		if($print_visible){
			echo link_button('Print','print_'.$controller_name."();return false;",'print');
		}
	}	
	echo link_button('Refesh','cari_'.$controller_name."();return false;",'reload');
	echo link_button('Frame','refresh_tab_parent()','reload');
		
	if(isset($other_button)){
		if(is_array($other_button)){
			for($i=0;$i<count($other_button);$i++){
				$title=$other_button[$i]['title'];
				$ctr=$other_button[$i]['controller'];
				$icon=$other_button[$i]['icon'];
				$fn=$other_button[$i]['function'];
				if($title!=""){
					echo link_button($title,$ctr.'()',$icon);
					echo $fn;
				}
			}
		}
	}
	echo " Find: <input type='text' id='tb_search' onchange='find_$controller_name();return false;'>";
	echo link_button('','find_'.$controller_name."();return false;",'search');
    
	echo link_button("Seting", "set_".$controller_name."();return false;",'lock');
	echo link_button("Help", "help_".$controller_name."();return false;",'help');
    echo link_button('Close','remove_tab_parent()','cancel');      
	
	if(isset($query_list)){
	 
	?>
		<div style='float:right;'><select id='query_list' style='height:25px'>
		<? for($i=0;$i<count($query_list);$i++) {
			$q=$query_list[$i];
			echo "<option value='".$q['value']."'>".$q['caption']."</option>";
		}
		?>
		</select>
		<a href='#' class='easyui-linkbutton' data-options="iconCls:'icon-search', 
			plain: true" onclick='run_query();return false;' 
			group="" id="" > Run 
		</a>	
		</div>
	
	<? } ?>
</div> 

<div id="_section_table">
	
	<?php 
	//,pageSize:10,pagination:true
	$url=base_url()."index.php/$controller/browse_data".$sub_strip;
    $offset1=10;
    $limit1=10;
    $nama='x';
    $url.="/$offset1/$limit1/$nama";
    if(isset($row_count)){
        $url.="/$row_count";
    }
	?>
	<table  id="dg_<?=$controller_name?>" class="easyui-datagrid", style='height:500px'
      data-options="rownumbers:true,fitColumns:true,pagination:true,
      singleSelect:true,collapsible:false,method:'get',
      url:'',
      toolbar:'#tb_<?=$controller_name?>' ">
      
      <?=$table_head?>
      
	</table>

	<?=$msg_content?>

       
	<?
		if(isset($other_menu)){
			$this->load->view($other_menu);
		}
	?>
</div>

</div>
<div id="dlgSet" name='dlgSet' class="easyui-dialog" data-options="title:'Setting'" 
	buttons='#button_setting' closed="true"  style="top:10px;width:400px;height:450px;padding:10px 10px">
	<form id='frmSet_<?=$controller_name?>' class='form'>
		<?php
		echo "Silahkan di contreng berikut ini apabila ingin mereset kolom yang tampil kesemula.
		</br><input type='checkbox' name='ck_reset'  style='width:30px'>Reset pengaturan kolom";
				
		echo "</br></br>Pilihlah kolom yang ingin ditampikan, kolom nomor bukti atau primary key jangan dicontreng untuk hidden.";
		if(isset($fields)){
			for($i=0;$i<count($fields);$i++){
				echo "</br><input type='checkbox' name='ck_cols[]' checked style='width:30px'
				value='$fields[$i]'> $fields_caption[$i]";
			}
		}		
		
		?>
	</form>
</div>
<div id='button_setting' class='thumbnail box-gradient'>
	<div class='align-right' >
	<?=link_button('Cancel','set_cancel_'.$controller_name."();return false;",'cancel');?>			
	<?=link_button('Submit','set_change_'.$controller_name."();return false;",'save');?>			
	</div>
</div>

<div id="dlgFilter_<?=$controller_name?>"  class="easyui-dialog" data-options="title:'Filter Criteria'" 
	closed="true" toolbar="#button_filter" style="top:10px;width:300px;height:480px;padding:10px 10px">
	<div id="lb_<?=$controller_name?>" style="padding:5px;min-height:80%;" 
		class='thumbnail box-gradient'>
		<form id='frmSearch_<?=$controller_name?>' class='form'>
			<?
			$i=0;
			$s="";
			foreach($criteria as $fa){
				$type="text";
				$val="";
				if($fa->field_class=="easyui-datetimebox"){
					$val=date("Y-m-d");
                    $val=date('Y-m-d',strtotime("$val -1 Months"));
					if(strpos($fa->field_id,"date_to")){
					    $val=date("Y-m-t 23:59:59");
                    }
					$s.="<div class='form-group'>";
					$s.="&nbsp<label for='$fa->field_id'>$fa->caption</label></br>";
					$s.="<input type='$type' value='$val' id='$fa->field_id'  
					name='$fa->field_id' 
					class='$fa->field_class form-control' style='width:100%' 
					data-options='formatter:format_date,parser:parse_date'
					>";
					$s.= "</div>";
				} else if($fa->field_class=="checkbox"){
					$s.="<div class='form-group'>";
					$s.="&nbsp<label for='$fa->field_id'>$fa->caption</label></br>";
					$s .=  "<input type='checkbox' value=$val id='$fa->field_id'  
					name='$fa->field_id'>";
					$s.= "</div>";
				} else {
					$style=" ";
					$class="form-control";
					$fa->field_class=$class;
					if($fa->field_style!="")$style=$fa->field_style;
					$s.="<div class='form-group'>";
					$s.="&nbsp<label for='$fa->field_id'>$fa->caption</label></br>";
					$s .=  "<input type='$type' value='$val' id='$fa->field_id'  style='width:100%'
					name='$fa->field_id'  placeholder='$fa->caption' >";
					$s.= "</div>";
				}
			}
			echo $s;
			echo $msg_left;
			?>
		</form>
	</div>
</div> 
<div id='button_filter' class='thumbnail box-gradient'>
	<span>Isi kriteria dibawah dan klik Filter: 
	<?=link_button('Filter','cari_'.$controller_name."();return false;",'search');?>			
	</span>  
</div>
	
<script type="text/javascript">
    var xurl='<?=$url?>';
		(function($){
			
			
	        $('#dg_<?=$controller_name?>').datagrid({
	            onDblClickRow:function(){
	                var row = $('#dg_<?=$controller_name?>').datagrid('getSelected');
	                if (row){
	                    edit_<?=$controller_name?>();
	                }       
	            }
	        });        
			
			cari_<?=$controller_name?>();
			
			
			
			function pagerFilter(data){
				if ($.isArray(data)){	// is array
					data = {
						total: data.length,
						rows: data
					}
				}
				var dg = $(this);
				var state = dg.data('datagrid');
				var opts = dg.datagrid('options');
				if (!state.allRows){
					state.allRows = (data.rows);
				}
				var start = (opts.pageNumber-1)*parseInt(opts.pageSize);
				var end = start + parseInt(opts.pageSize);
				data.rows = $.extend(true,[],state.allRows.slice(start, end));
				return data;
			}

			var loadDataMethod = $.fn.datagrid.methods.loadData;
			$.extend($.fn.datagrid.methods, {
				clientPaging: function(jq){
					return jq.each(function(){
						var dg = $(this);
                        var state = dg.data('datagrid');
                        var opts = state.options;
                        opts.loadFilter = pagerFilter;
                        var onBeforeLoad = opts.onBeforeLoad;
                        opts.onBeforeLoad = function(param){
                            state.allRows = null;
                            return onBeforeLoad.call(this, param);
                        }
						dg.datagrid('getPager').pagination({
							onSelectPage:function(pageNum, pageSize){
								opts.pageNumber = pageNum;
								opts.pageSize = pageSize;
								$(this).pagination('refresh',{
									pageNumber:pageNum,
									pageSize:pageSize
								});
								dg.datagrid('loadData',state.allRows);
							}
						});
                        $(this).datagrid('loadData', state.data);
                        if (opts.url){
                        	$(this).datagrid('reload');
                        }
					});
				},
                loadData: function(jq, data){
                    jq.each(function(){
                        $(this).data('datagrid').allRows = null;
                    });
                    return loadDataMethod.call($.fn.datagrid.methods, jq, data);
                },
                getAllRows: function(jq){
                	return jq.data('datagrid').allRows;
                }
			})
		})(jQuery); 	 
		
	$(function(){
		$('#dg_<?=$controller_name?>').datagrid('clientPaging');
	});
    function addnew_<?=$controller_name?>(){
        xurl_add=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/add';
		add_tab_parent("addnew_<?=$controller_name?>",xurl_add);
    };
    function edit_<?=$controller_name?>(){
        var row = $('#dg_<?=$controller_name?>').datagrid('getSelected');
        if (row){
            xurl_edit=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/view/'+row[FIELD_KEY];
			add_tab_parent("edit_<?=$controller_name?>_"+row[FIELD_KEY],xurl_edit);
        }
    }
    function del_row_<?=$controller_name?>(){
			var row = $('#dg_<?=$controller_name?>').datagrid('getSelected');
            //var row = $('#dg_<?=$controller_name?>').datagrid('getSelections');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this line?',function(r){
					if(!r)return false;
	                xurl_delete=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/delete/'+row[FIELD_KEY];                             
	                xparam='';
	                $.ajax({
	                        type: "GET",
	                        url: xurl_delete,
	                        param: xparam,
	                        success: function(result){
							try {
									var result = eval('('+result+')');
									if(result.success){
										$.messager.show({
											title:'Success',msg:result.msg
										});
										$('#dg_<?=$controller_name?>').datagrid('reload');	 
									} else {
										$.messager.show({
											title:'Error',msg:result.msg
										});
										log_err(result.msg);
									};
								} catch (exception) {		
									 
									// reload kalau output bukan json
									$('#dg_<?=$controller_name?>').datagrid('reload');	 
								}
	                        },
	                        error: function(msg){$.messager.alert('Info',"Tidak bisa dihapus baris ini !");}
	                });         
				});
		}
	}
	function run_query(){
		var proc=$("#query_list").val();
		var url=CI_ROOT+proc;
		window.open(url,"_self");
	}
    function cari_<?=$controller_name?>(){
    	xsearch=$('#frmSearch_<?=$controller_name?>').serialize();
	    //xurl=CI_ROOT+CI_CONTROL+'/browse_data<?=$sub_strip?>?'+xsearch;
	    xurl2=xurl+'?'+xsearch;
	    
        $('#dg_<?=$controller_name?>').datagrid({url:xurl2});		
		$('#dlgFilter_<?=$controller_name?>').dialog('close');		
    }
    function posting_<?=$controller_name?>(){
    	xsearch=$('#frmSearch_<?=$controller_name?>').serialize();
	    xurl_posting=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/posting_all?'+xsearch;
		$.messager.confirm('Confirm','Are you sure you want to posting all date ?',function(r){
	        window.open(xurl_posting,"_self");
		});
    }
    function cari_info_<?=$controller_name?>(){
    	xsearch=$('#frmSearch_<?=$controller_name?>').serialize();
	    xurl_cari=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/list_info?'+xsearch;
		window.open(xurl_cari,"_self");
	}
    function find_<?=$controller_name?>(){
	    xurl_find=CI_ROOT+CI_CONTROL+'/browse_data<?=$sub_strip?>?tb_search='+$("#tb_search").val();
        $('#dg_<?=$controller_name?>').datagrid({url:xurl_find});
    }
    function set_<?=$controller_name?>(){
		//$('#dlgSet').window({left:100,top:window.event.clientY+20});
		$('#dlgSet').dialog('open').dialog('setTitle','Setting');
    }
    function set_change_<?=$controller_name?>(){
	    xurl_set=CI_ROOT+CI_CONTROL+'/browse<?=$sub_strip?>';
		$('#frmSet_<?=$controller_name?>').form('submit',{
			url: xurl_set,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
					refresh_tab_parent();
				} else {
					log_err(result.msg);
				}
			}
		});
    }
    function set_cancel_<?=$controller_name?>(){
        $('#dlgSet').dialog('close');
    }
    
    function help_<?=$controller_name?>(){
    	load_help('<?=$controller_name?>');
    }
    
	function export_<?=$controller_name?>(){
    	xsearch=$('#frmSearch_<?=$controller_name?>').serialize();
	    xurl_export=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/export_xls?'+xsearch;
        add_tab_parent('export_<?=$controller_name?>',xurl_export);		
	}
	function import_<?=$controller_name?>(){
	    xurl_import=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/import_<?=$controller_name?>';
        add_tab_parent('import_<?=$controller_name?>',xurl_import);		
	}
	function print_<?=$controller_name?>(){
		var row = $('#dg_<?=$controller_name?>').datagrid('getSelected');
		if (row){
			xurl_print=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/print_<?=$controller_name?>/'+row[FIELD_KEY];;
			window.open(xurl_print,"_blank");		
		}
	}
	function dlgFilter_<?=$controller_name?>_Show(){
		//$('#dlgFilter').window({left:100,top:window.event.clientY+20});
		$('#dlgFilter_<?=$controller_name?>').dialog('open').dialog('setTitle','Enter Filter Criteria');
	}
	
</script>