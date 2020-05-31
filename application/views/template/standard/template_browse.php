<script type="text/javascript">
    CI_ROOT = "<?=base_url()?>index.php/";
    CI_BASE = "<?=base_url()?>";        
    
</script>

<?php 
date_default_timezone_set("Asia/Jakarta");

if(!isset($dont_load_js))$dont_load_js=false;

if($dont_load_js){
    
}  else  {
    echo $library_src;
    echo $script_head;    
}


$width=isset($width)?$width." px":"auto";
$height=isset($height)?$height." px":"auto";
$caption=isset($caption)?$caption:$controller;
$offset=0;
$limit=100;
$def_col_width=80; 
if(!isset($msg_left))$msg_left="<i>***Data record yang ditampilkan hanya <b>100 baris.</b></i></br>
<i>***Apabila data tidak tampil, persempit pencarian tekan tombol [<strong>Filter</strong>].</i>";
if(!isset($msg_content))$msg_content="<p>***Silahkan pilih satu baris ditabel ini 
	kemudian klik toolbar edit diatas.</p><p>***Apabila masih tidak tampil juga tekan [<strong>CTRL+R</strong>]</p>";

?>
<?php
$table_head="<thead><tr>";
if(isset($show_checkbox)){
    if($show_checkbox)    $table_head.="<th data-options=\"field:'ck',width:40\">Cek</th>";
}
$_fields=null;
$has_field_caption=false;
if(isset($fields_caption))$has_field_caption=true;

for($i=0;$i<count($fields);$i++){
    $aFld=$fields[$i];
	
    if(is_string($aFld)){
        $fld_name=$fields[$i];
		if(!$has_field_caption)$fields_caption[]=ucfirst($fld_name);
        $fld_caption=$fields_caption[$i];
    } else {
        $fld_name=$fields[$i]['name'];
        $fld_caption=$fields[$i]['caption'];
		if(!$has_field_caption)$fields_caption[]=ucfirst($fld_caption);
    }
	$_fields[]=$fld_name;
    $table_head.="<th data-options=\"field:'$fld_name' ";
    if(isset($col_width[$fld_name])){
        $width=$col_width[$fld_name];
    } else {
        $width=$def_col_width;
    }
	if($i==0)$width="130";
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
if($_fields)$fields=$_fields;

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
    if(!isset($with_tab)){
        $with_tab="true";
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
	<?=link_button("", "addnew_$controller_name();return false;","add","false");?>
	<?=link_button("", "edit_$controller_name();return false;","edit","false");?>
	<?=link_button("", "del_row_$controller_name();return false;","remove","false");?>
	<?php
	if(isset($posting_visible)){
		echo link_button('Posting','posting_'.$controller_name."();return false;",'save');
	};
	echo link_button('','dlgFilter_'.$controller_name.'_Show();return false;','filter');
	if(isset($print_visible)){
		if($print_visible){
			echo link_button('','print_'.$controller_name."();return false;",'print');
		}
	}	
	//echo link_button('','cari_'.$controller_name."();return false;",'reload');
		
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
	
	if(isset($list_info_visible)){
		echo link_button('Info','cari_info_'.$controller_name."();return false;",'search');
	};
	if(isset($import_visible)){
		echo link_button('Import','import_'.$controller_name."();return false;",'more');			
	}
	if(isset($export_visible)){
		echo link_button('Export','export_'.$controller_name."();return false;",'xls');
	}	
	echo " Find: <input type='text' id='tb_search' onchange='find_$controller_name();return false;'>";
	echo link_button('','find_'.$controller_name."();return false;",'search');
	echo link_button("Set", "set_".$controller_name."();return false;",'lock');
	
	echo link_button('','refresh_tab_parent()','reload');
		
	echo link_button("", "help_".$controller_name."();return false;",'help');
	echo link_button('','remove_tab_parent()','cancel');      
	
	if(isset($query_list)){
	 
	?>
		</br>
			<select id='query_list' style='height:25px'>
			<?php
			for($i=0;$i<count($query_list);$i++) {
				$q=$query_list[$i];
				echo "<option value='".$q['value']."'>".$q['caption']."</option>";
			}
			?>
			</select>
			<?=link_button("Run", "run_query();return false;","search")?>
	
	<?php } ?>
	
	
</div> 


<div id='__section_left_content' style='padding:0px;margin-left:0px;margin-right:0px'>
	<div id="_section_table">
		<?php 
		$url=base_url()."index.php/$controller/browse_data".$sub_strip;
		$offset1=1;
		$limit1=10;
		$nama='x';
		$url.="/$offset1/$limit1/$nama";
		if(isset($row_count)){
			$url.="/$row_count";
		}
		$row_double_click=$this->session->userdata("row_double_click",false);
		
		$fit="true";
		if (count($fields)>5){
			$fit="false";
		} 
		//
		?>
		<table  id="dg_<?=$controller_name?>" class="easyui-datagrid", 
			style='height:auto;width:auto;min-height:90%'  
			data-options="rownumbers:true,pagination:true,fitColumns:<?=$fit?>,
			singleSelect:true,collapsible:false,method:'get',
			url:'', toolbar:'#tb_<?=$controller_name?>' ">
		  
			<?=$table_head?>
		  
		</table>

		<?=$msg_content.$msg_left?>

		   
		<?php
			if(isset($other_menu)){
				$this->load->view($other_menu);
			}
		?>
	</div>
</div>

 
<div id="dlgSet" name='dlgSet' class="easyui-dialog" 
	data-options="title:'Setting'" 
	buttons='#button_setting' closed="true"  
	style="top:10px;width:400px;height:450px;padding:2px">
	<form id='frmSet_<?=$controller_name?>' class='form' method='get'>
		<?php
		$checked="";
		if($this->session->userdata("row_double_click")){
			$checked="checked";
		}
				echo "Silahkan contreng pengaturan berikut ini:
		</br><input value='on' type='checkbox' name='ck_reset'  style='width:30px'>Reset pengaturan kolom
		</br><input value='on' $checked type='checkbox' id='ck_double_click' name='ck_double_click'  style='width:30px'>Double klik baris untuk melihat detail";
				
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

<div id="dlgFilter_<?=$controller_name?>"  class="easyui-dialog" 
	data-options="title:'Filter Criteria'" 
	closed="true" buttons="#button_filter" 
	style="top:10px;width:600px;height:400px;padding:5px 5px">
	
	<div id="lb_<?=$controller_name?>" style="padding:5px;min-height:80%;" 
		class=''>
		<form id='frmSearch_<?=$controller_name?>' class='form'>
			<?php
			$i=0;
			//$s="<div class='col-sm-6'>";
			$s="";
			foreach($criteria as $fa){
				$i++;
				if($i==4){
					///$s.="</div><div class='col-sm-5'>";
				}
				$type="text";
				$val="";
				if($fa->field_class=="easyui-datetimebox"){
                    $val=date("Y-m-d 23:59:59");
                    $parse_date="parse_date";
					if($fa->field_id=="date_from" || $fa->field_id=="sid_date_from" ){
                        $val=date('Y-m-d',strtotime("$val -1 Months"));
                        $parse_date="parse_date_no_time";
                    }
					$s.="<div class='form-group'>";
					$s.="&nbsp<label for='$fa->field_id'>$fa->caption</label></br>";
					$s.="<input type='$type' value='$val' id='$fa->field_id'  
					name='$fa->field_id' 
					class='$fa->field_class form-control' style='width:100%' 
					data-options='formatter:format_date,parser: $parse_date'   ";

                                        
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
			//$s."</div>";
			echo $s;
			?>
		</form>
	</div>
</div> 

<div id='button_filter' class='box-gradient'>
	<div>Silahkan isi kriteria pencarian dibawah ini:
	<?=link_button('Filter','dlgFilter_close_'.$controller_name."();return false;",'search');?>			
	<?=link_button('Close','dlgFilter_cancel_'.$controller_name."();return false;",'cancel');?>			
	</div>  
</div>
 

<?php
if(isset($view_file)){
    echo load_view($view_file);
}
?>	
<script type="text/javascript">
    
    var xurl='<?=$url?>';
    var with_tab=<?=$with_tab?>;
	var filter='<?php if(isset($filter)) echo "$filter"; ?>';
	var _request_count=0;

    $().ready(function (){
        $('#dg_<?=$controller_name?>').datagrid({
        	
        	<?php if($row_double_click) { ?> 
        		
	            onDblClickRow:function(){
	                var row = $('#dg_<?=$controller_name?>').datagrid('getSelected');
	                if (row){
	                    edit_<?=$controller_name?>();
	                }       
	            }
	            
        		
        	<?php } else { ?>
        		
	            onClickRow:function(){
	                var row = $('#dg_<?=$controller_name?>').datagrid('getSelected');
	                if (row){
	                    edit_<?=$controller_name?>();
	                }       
	            }
	            
        		
        	<?php } ?>
    
            
        });        
		cari_<?=$controller_name?>();
        //$.parser.parse();
	}); 	 
			
    function addnew_<?=$controller_name?>(){
        loading();
        xurl_add=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/add';
        if (filter != '')xurl_add=xurl_add+'?filter='+filter;
		add_tab_parent("addnew_<?=$controller_name?>",xurl_add);
    };
    function edit_<?=$controller_name?>(){
        loading();
        if(with_tab){
            edit_tab_<?=$controller_name?>();
        } else {
            edit_box_<?=$controller_name?>();
        }
        
    }
    function edit_box_<?=$controller_name?>(){
       edit_<?=$controller_name?>();
    }
    function edit_tab_<?=$controller_name?>(){
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
	                loading();
	                $.ajax({
	                        type: "GET",
	                        url: xurl_delete,
	                        param: xparam,
	                        success: function(result){
							try {
									var result = eval('('+result+')');
									if(result.success){
										loading_close();
										$.messager.show({
											title:'Success',msg:result.msg
										});
										log_msg(result.msg);
										$('#dg_<?=$controller_name?>').datagrid('reload');	 
									} else {
										loading_close();
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
	                        error: function(msg){log_err("Error");
	                        	$.messager.alert('Info',"Tidak bisa dihapus baris ini !");}
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
        loading();
    	xsearch=$('#frmSearch_<?=$controller_name?>').serialize();
	    xurl2=xurl+'?'+xsearch;
	    <?php
            if(isset($filter)){
                echo "xurl2=xurl2+'&filter=$filter';";
            }
        ?>
	    
        $('#dg_<?=$controller_name?>').datagrid({url:xurl2});		
    }
    function dlgFilter_close_<?=$controller_name?>(){
    	$(".pagination-num").val(1);
    	cari_<?=$controller_name?>();
		$('#dlgFilter_<?=$controller_name?>').dialog('close');		
    }
    function dlgFilter_cancel_<?=$controller_name?>(){
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
	    loading();
    	xsearch=$('#frmSearch_<?=$controller_name?>').serialize();
	    xurl_export=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/export_xls?'+xsearch;
        add_tab_parent('export_<?=$controller_name?>',xurl_export);		
	}
	function import_<?=$controller_name?>(){
	    loading();
	    xurl_import=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/import_<?=$controller_name?>';
        add_tab_parent('import_<?=$controller_name?>',xurl_import);		
	}
	function print_<?=$controller_name?>(){
	    loading();
		var row = $('#dg_<?=$controller_name?>').datagrid('getSelected');
		if (row){
			xurl_print=CI_ROOT+CI_CONTROL+'<?=$sub_slash?>/print_<?=$controller_name?>/'+row[FIELD_KEY];;
			window.open(xurl_print,"_blank");		
		} else {
	        xurl_add=CI_ROOT+CI_CONTROL+'/rpt/list1';
	        if (filter != '')xurl_add=xurl_add+'?filter='+filter;
			add_tab_parent("print_"+CI_CONTROL,xurl_add);

		}
	}
	function dlgFilter_<?=$controller_name?>_Show(){
		$('#dlgFilter_<?=$controller_name?>').dialog('open').dialog('setTitle','Enter Filter Criteria');
	}

	
</script>