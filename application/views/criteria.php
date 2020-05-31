<?php
//echo $library_src;
//echo $script_head;

if(!isset($target_window)){
	$target_window=" target='_blank_$rpt_controller'";
} else {
	$target_window="_self";
}
if(!isset($output1))$output1="text1";
if(!isset($output2))$output2="text2";
if(!isset($output3))$output3="text3";
if(!isset($output4))$output4="text4";
if(!isset($output5))$output5="text5";
if(!isset($output6))$output6="text6";
if(!isset($output7))$output7="text7";

if(!isset($module))$module="";

?>
<div class='col-sm-12 thumbnail'>       
    <p><strong><?if(isset($caption))echo $caption?></strong></p>
    <div class='alert alert-info'>Silahkan isi kriteria pencetakan untuk laporan 
        <strong>[<?=$rpt_controller?>]</strong>
        di halaman ini dengan benar, kemudian tekan tombol print/posting/preview.
    </div>
</div> 
 
<div class="col-sm-12 thumbnail">
		
	<form id='frmPrint' method='post' 
		action="<?=base_url()?>index.php/<?=$rpt_controller?>" <?=$target_window?>  >
	
	
		<?php
			if(!isset($select_date))$select_date=false;
			if(!isset($criteria1))$criteria1=false;
			if(!isset($criteria2))$criteria2=false;
			if(!isset($criteria3))$criteria3=false;
			if(!isset($criteria4))$criteria4=false;
			if(!isset($criteria5))$criteria5=false;
			if(!isset($criteria6))$criteria6=false;
			if(!isset($criteria7))$criteria7=false;
			
			
			if(!isset($module))$module="";
			
			if($select_date){
				echo "<strong>Dari Tanggal :</strong>";
				echo "<p>".form_input('txtDateFrom',$date_from,'id="txtDateFrom" 
						 class="easyui-datetimebox" required style="width:180px"
						data-options="formatter:format_date,parser:parse_date" 
						')."</p>";
				echo "  <strong>Sampai Tanggal :</strong>";
				echo "  <p>";
				echo form_input('txtDateTo',$date_to,'id="txtDateTo" 
						 class="easyui-datetimebox" required style="width:180px"
						data-options="formatter:format_date,parser:parse_date"');
				echo "</p>";
			}
			if($criteria1){
				echo "<strong>$label1</strong>";
				echo "<p>";
				echo form_input('text1',$text1,"id='text1' ");
				if(isset($ctr1))echo link_button("","lov1()","search"); 
				echo "</p>";
			}
			if($criteria2){
				if(isset($ctr2)){
					echo "<strong>".$label2."</strong>";
					if(is_array($ctr2)){
						echo "<p>".form_dropdown('text2',$ctr2,$text2,"id='text2' ");
						echo "</p>";
					} else {
						echo "<p>".form_input('text2',$text2,"id='text2'   ");
						echo link_button("","lov2()","search"); 
						echo "</p>";
					}
				} else {
					echo "<strong>".$label2."</strong>";
					echo "<p>".form_input('text2',$text2,"id='text2'")."</p>";
				}
				
			}
			if($criteria3){
				if(isset($ctr3)){
					echo "<strong>".$label3."</strong>";
					echo "<p>";
					if(is_array($ctr3)){
						echo form_dropdown('text3',$ctr3,$text3,"id='text3'");
					} else {
						echo form_input('text3',$text3,"id='text3'");					
						echo link_button("","lov3()","search"); 
					}
					echo "</p>";
				}  else {
					echo "<strong>".$label3."</strong>";
					echo "<p>".form_input('text3',$text3,"id='text3'")."</p>";					
				}
			}
			if($criteria4){
				if(isset($ctr4)){
					echo "<strong>".$label4."</strong>";
					if(is_array($ctr4)){
						echo "<p>".form_dropdown('text4',$ctr4,$text4,"id='text4'");
					} else {
						echo "<p>".form_input('text4',$text4,"id='text4'");					
						echo link_button("","lov4()","search"); 
					}
					echo "</p>";
				}  else {
					echo "<strong>".$label4."</strong>";
					echo "<p>".form_input('text4',$text4,"id='text4'");					
					echo "</p>";
				}
			}
			if($criteria5){
				if(isset($ctr5)){
					echo "<strong>".$label5."</strong>";
					if(is_array($ctr5)){
						echo "<p>".form_dropdown('text5',$ctr5,$text5,"id='text5'");
					} else {
						echo "<p>".form_input('text5',$text5,"id='text5'");					
						echo link_button("","lov5()","search"); 
					}
					echo "</p>";
					
				}  else {
					echo "<strong>".$label5."</strong>";
					echo "<p>".form_input('text5',$text5,"id='text5'");					
					echo "</p>";
				}
			}
			if($criteria6){
				if(isset($ctr6)){
					echo "<strong>".$label6."</strong>";
					if(is_array($ctr6)){
						echo "<p>".form_dropdown('text6',$ctr6,$text6,"id='text6'");
					} else {
						echo "<p>".form_input('text6',$text6,"id='text6'");					
						echo link_button("","lov6()","search"); 
					}
					echo "</p>";
					
				}  else {
					echo "<strong>".$label5."</strong>";
					echo "<p>".form_input('text5',$text5,"id='text5'");					
					echo "</p>";
				}
			}
			
		?>
</div>
<div class="col-sm-12 box-gradient thumbnail" >
		<?php	
			if($module==""){
				echo "<input type='submit' name='cmdPrint' value='Print' class='btn btn-primary' >";
			} 
			if($module=="posting"){
				echo "<input type='submit' name='cmdPosting' value='Posting' class='btn btn-primary'>";
				echo "&nbsp&nbsp<input type='submit' name='cmdUnPosting' value='UnPosting' class='btn btn-default'>";	
			}
		?>
</div>

	
	</form>

<p></p>	

<SCRIPT language="javascript">
	function cmdPrint_Click(){
    	<?php
    		$req1="";
    		if(isset($ctr1)){
    			if(isset($required1)){
    				$req1=$required1;
    			}
    		}
			if($req1=="")$req1="false";
			echo "req1=".$req1.";\n";
    		$req2="";
    		if(isset($ctr2)){
    			if(isset($required2)){
    				$req2=$required2;
    			}
    		}
			if($req2=="")$req2="false";
			echo "req2=".$req2.";\n";
    		
    		$req3="";
    		if(isset($ctr3)){
    			if(isset($required3)){
    				$req1=$required3;
    			}
    		}
			if($req3=="")$req3="false";
			echo "req3=".$req3.";\n";
    		$req4="";
    		if(isset($ctr4)){
    			if(isset($required4)){
    				$req1=$required4;
    			}
    		}    		
			if($req4=="")$req4="false";
			echo "req4=".$req4.";\n";
    		$req5="";
    		if(isset($ctr5)){
    			if(isset($required5)){
    				$req5=$required5;
    			}
    		}
			if($req5=="")$req5="false";
			echo "req5=".$req5.";\n";

			if($req5=="")$req5="false";
			echo "req5=".$req5.";\n";
    		$req6="";
    		if(isset($ctr6)){
    			if(isset($required6)){
    				$req5=$required6;
    			}
    		}
			if($req6=="")$req6="false";
			echo "req6=".$req6.";\n";
						    	
    	?>
    	if(req1){
    		log_err("Isi criteria pilihan 1");return false;
    	}
    	if(req2){
    		log_err("Isi criteria pilihan 2");return false;
    	}
    	if(req3){
    		log_err("Isi criteria pilihan 3");return false;
    	}
    	if(req4){
    		log_err("Isi criteria pilihan 4");return false;
    	}
    	if(req5){
    		log_err("Isi criteria pilihan 5");return false;
    	}
    	if(req6){
    		log_err("Isi criteria pilihan 6");return false;
    	}
		
			$('#frmPrint').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#divItem').show('slow');
						$('#purchase_order_number').val(result.purchase_order_number);
						var nomor=$('#purchase_order_number').val();
						$('#mode').val('view');
						$('#dg').datagrid({url:'<?=base_url()?>index.php/purchase_order/items/'+nomor+'/json'});
						//$('#dg').datagrid('reload');
						log_msg('Data sudah tersimpan. Silahkan pilih nama barang.');
					} else {
						log_err(result.msg);
					}
				}
			});
		
	}
    function cmdOK_Click(){
        $("#dialog_print").dialog("close");
        url='<?=base_url()?>index.php/<?=$rpt_controller?>';
        $('#frmPrint').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                window.open(url,<?=$target_window?>);
            }
        });
    }
    function dialog_print_print(){
        cmdOK_Click();
    }

</SCRIPT>
<!-- PILIHAN LOV 1 --> 

<?php if(isset($ctr1)){ ?>

<div id='dlg1'class="easyui-dialog" style="width:600px;height:500px;padding:5px 5px;left:100px;top:20px"
     closed="true" toolbar="#btn1">
		<table id="dg1" class="easyui-datagrid" data-options="singleSelect: true , 
		      fitColumns: true,
            pagination:true">
			<thead>	<tr> <? for($i=0;$i<count($fields1);$i++){ $field=$fields1[$i];
				echo "<th data-options=\"field:'".$field[0]."',width:'".$field[1]."'\">".$field[2]."</th>";
			}?>	</tr></thead>
		</table>
</div>
<div id="btn1" name="btn1" style="height:auto">
	<input  id="search1" style='width:100' name="search1" placeholder='Search' 
	     onchange='lov_search();return false;'
	>
	<?=link_button("Cari","lov1()","search")?>
	<?=link_button("Pilih","lov1_ok()","ok")?>
	<?=link_button("Close","lov1_close()","cancel")?>
</div>
<SCRIPT language="javascript">
    $('#dg1').datagrid({
        onDblClickRow:function(){
            var row = $('#dg1').datagrid('getSelected');
            if (row){
            	lov1_ok();
            }       
        }
    });        


	function lov1(){
	    $('#dlg1').dialog('open').dialog('setTitle','Pilihan');
	    lov_search();
        $('#dg1').datagrid({
            onDblClickRow:function(){
                lov1_ok();
            }
        });        
        
	    
	};	
	function lov_search(){
        var search=$('#search1').val(); 
        $('#dg1').datagrid({url:'<?=base_url()?>index.php/<?=$ctr1?>/'+search});
        $('#dg1').datagrid('reload');	    
        
	}
	function lov1_ok(){
		var row = $('#dg1').datagrid('getSelected');
		if (row){
			$('#<?=$output1?>').val(row.<?=$key1?>); 
			$('#dlg1').dialog('close');
		} else { 
		    alert("Pilih salah satu !"); 
		}
	}	
	function lov1_close(){
	    $('#dlg1').dialog('close');
	}
</SCRIPT>

<? } ?>

<!-- END LOV1 -->

<!-- PILIHAN LOV 2 --> 
<?php if(isset($ctr2)){ ?>

<div id='dlg2'class="easyui-dialog" style="width:600px;height:500px;padding:5px 5px;left:100px;top:20px"
     closed="true" toolbar="#btn2">
		<table id="dg2" class="easyui-datagrid" 
		  data-options="singleSelect: true, fitColumns: true,
            pagination:true ">
			<thead>	<tr> <? for($i=0;$i<count($fields2);$i++){ $field=$fields2[$i];
				echo "<th data-options=\"field:'".$field[0]."',width:'".$field[1]."'\">".$field[2]."</th>";
			}?>	</tr></thead>
		</table>
</div>
<div id="btn2" name="btn2" style="height:auto">
	<input  id="search2" style='width:100' name="search2" placeholder='Search' 
         onchange='lov2_search();return false;'>
	<?=link_button("Cari","lov2()","search")?>
	<?=link_button("Pilih","lov2_ok()","ok")?>
	<?=link_button("Close", "lov2_close()","cancel")?>
</div>
<SCRIPT language="javascript">

    $('#dg2').datagrid({
        onDblClickRow:function(){
            var row = $('#dg2').datagrid('getSelected');
            if (row){
            	lov2_ok();
            }       
        }
    });        

	function lov2(){
		search=$('#search2').val(); $('#dlg2').dialog('open').dialog('setTitle','Pilihan');
		$('#dg2').datagrid({url:'<?=base_url()?>index.php/<?=$ctr2?>/'+search});
		$('#dg2').datagrid('reload');
	};	
	function lov2_ok(){
		var row = $('#dg2').datagrid('getSelected');
		if (row){
			$('#<?=$output2?>').val(row.<?=$key2?>); 
			$('#dlg2').dialog('close');
		} else { alert("Pilih salah satu !"); }
	}	
    function lov2_search(){
        var search=$('#search2').val(); 
        $('#dg2').datagrid({url:'<?=base_url()?>index.php/<?=$ctr2?>/'+search});
       ///$('#dlg2').dialog('close');       
        
    }
    function lov2_close(){
        $('#dlg2').dialog('close');          
    }
	
</SCRIPT>

<? } ?>
<!-- END LOV2 -->

<!-- PILIHAN LOV 3 --> 
<?php if(isset($ctr3)){ ?>

<div id='dlg3'class="easyui-dialog" style="width:600px;height:450px;padding:5px 5px;left:100px;top:20px"
     closed="true" toolbar="#btn3">
		<table id="dg3" class="easyui-datagrid" data-options="singleSelect: true, fitColumns: true,
            pagination:true">
			<thead>	<tr> <? for($i=0;$i<count($fields3);$i++){ $field=$fields3[$i];
				echo "<th data-options=\"field:'".$field[0]."',width:'".$field[1]."'\">".$field[2]."</th>";
			}?>	</tr></thead>
		</table>
</div>
<div id="btn3" name="btn3" style="height:auto">
	<input  id="search3" style='width:100' name="search3" placeholder='Search'   onchange='lov3_search();return false;'>
	<?=link_button("Cari","lov3()","search")?>
	<?=link_button("Pilih","lov3_ok()","ok")?>
	<?=link_button("Close", "lov3_close()","cancel")?>
</div>
<SCRIPT language="javascript">
    $('#dg3').datagrid({
        onDblClickRow:function(){
            var row = $('#dg3').datagrid('getSelected');
            if (row){
            	lov3_ok();
            }       
        }
    });        

	function lov3(){
		search=$('#search3').val(); $('#dlg3').dialog('open').dialog('setTitle','Pilihan');
		$('#dg3').datagrid({url:'<?=base_url()?>index.php/<?=$ctr3?>/'+search});
	};	
	function lov3_ok(){
		var row = $('#dg3').datagrid('getSelected');
		if (row){
			$('#<?=$output3?>').val(row.<?=$key3?>); $('#dlg3').dialog('close');
		} else { alert("Pilih salah satu !"); }
	}	
   function lov3_search(){
        var search=$('#search3').val(); 
        $('#dg3').datagrid({url:'<?=base_url()?>index.php/<?=$ctr3?>/'+search});
        $('#dg3').datagrid('reload');       
        
    }
    function lov3_close(){
        $('#dlg3').dialog('close');        
    }

</SCRIPT>

<? } ?>
<!-- END LOV2 -->



<!-- PILIHAN LOV 4 --> 
<?php if(isset($ctr4)){ ?>

<div id='dlg4'class="easyui-dialog" style="width:600px;height:500px;padding:5px 5px;left:100px;top:20px"
     closed="true" buttons="#btn4">
		<table id="dg4" class="easyui-datagrid" data-options="singleSelect: true, fitColumns: true,
            pagination:true">
			<thead>	<tr> <? for($i=0;$i<count($fields4);$i++){ $field=$fields4[$i];
				echo "<th data-options=\"field:'".$field[0]."',width:'".$field[1]."'\">".$field[2]."</th>";
			}?>	</tr></thead>
		</table>
</div>
<div id="btn4" name="btn4" style="height:auto">
	<input  id="search4" style='width:100' name="search4"   onchange='lov4_search();return false;' placeholder='Search'>
	<?=link_button("Cari","lov4()","search")?>
	<?=link_button("Pilih","lov4_ok()","ok")?>
	<?=link_button("Close", "lov4_close()","cancel")?>
</div>
<SCRIPT language="javascript">
    $('#dg4').datagrid({
        onDblClickRow:function(){
            var row = $('#dg4').datagrid('getSelected');
            if (row){
            	lov4_ok();
            }       
        }
    });        

	function lov4(){
		search=$('#search4').val(); $('#dlg4').dialog('open').dialog('setTitle','Pilihan');
		$('#dg4').datagrid({url:'<?=base_url()?>index.php/<?=$ctr4?>/'+search});
		$('#dg4').datagrid('reload');
	};	
	function lov4_ok(){
		var row = $('#dg4').datagrid('getSelected');
		if (row){
			$('#<?=$output4?>').val(row.<?=$key4?>); $('#dlg4').dialog('close');
		} else { alert("Pilih salah satu !"); }
	}	
	
   function lov4_search(){
        var search=$('#search4').val(); 
        $('#dg4').datagrid({url:'<?=base_url()?>index.php/<?=$ctr4?>/'+search});
        $('#dg4').datagrid('reload');       
        
    }
    function lov4_close(){
        $('#dlg4').dialog('close');
    }
	
</SCRIPT>

<? } ?>
<!-- END LOV4 -->


<!-- PILIHAN LOV 5 --> 
<?php if(isset($ctr5)){ ?>

<div id='dlg5'class="easyui-dialog" style="width:600px;height:380px;padding:5px 5px;left:100px;top:20px"
     closed="true" buttons="#btn5">
		<table id="dg5" class="easyui-datagrid" data-options="singleSelect: true, fitColumns: true,
            pagination:true">
			<thead>	<tr> <? for($i=0;$i<count($fields5);$i++){ $field=$fields5[$i];
				echo "<th data-options=\"field:'".$field[0]."',width:'".$field[1]."'\">".$field[2]."</th>";
			}?>	</tr></thead>
		</table>
</div>
<div id="btn5" name="btn5" style="height:auto">
	<input  id="search5" style='width:100' name="search5"   onchange='lov5_search();return false;' placeholder='Search'>
	<?=link_button("Cari","lov5()","search")?>
	<?=link_button("Pilih","lov5_ok()","ok")?>
	<?=link_button("Close", "lov5_close()","cancel")?>
</div>
<SCRIPT language="javascript">

    $('#dg5').datagrid({
        onDblClickRow:function(){
            var row = $('#dg5').datagrid('getSelected');
            if (row){
            	lov5_ok();
            }       
        }
    });  

	function lov5(){
		search=$('#search5').val(); $('#dlg5').dialog('open').dialog('setTitle','Pilihan');
		$('#dg5').datagrid({url:'<?=base_url()?>index.php/<?=$ctr5?>/'+search});
		$('#dg5').datagrid('reload');
	};	
	function lov5_ok(){
		var row = $('#dg5').datagrid('getSelected');
		if (row){
			$('#<?=$output5?>').val(row.<?=$key5?>); $('#dlg5').dialog('close');
		} else { alert("Pilih salah satu !"); }
	}	
   function lov5_search(){
        var search=$('#search5').val(); 
        $('#dg5').datagrid({url:'<?=base_url()?>index.php/<?=$ctr5?>/'+search});
        $('#dg5').datagrid('reload');       
        
    }
    function lov5_close(){
        $('#dlg5').dialog('close');
    }
	
</SCRIPT>

<? } ?>
<!-- END LOV5 -->



<!-- PILIHAN LOV 6 --> 
<?php if(isset($ctr6)){ ?>

<div id='dlg6'class="easyui-dialog" style="width:600px;height:380px;padding:5px 5px;left:100px;top:20px"
     closed="true" buttons="#btn6">
		<table id="dg6" class="easyui-datagrid" data-options="singleSelect: true">
			<thead>	<tr> <? for($i=0;$i<count($fields6);$i++){ $field=$fields6[$i];
				echo "<th data-options=\"field:'".$field[0]."',width:'".$field[1]."'\">".$field[2]."</th>";
			}?>	</tr></thead>
		</table>
</div>
<div id="btn6" name="btn6" style="height:auto">
	<input  id="search6" style='width:100' name="search6"   onchange='lov6_search();return false;' placeholder='Search'>
	<?=link_button("Cari","lov6()","search")?>
	<?=link_button("Pilih","lov6_ok()","ok")?>
	<?=link_button("Close", "lov6_close()","cancel")?>
</div>
<SCRIPT language="javascript">

    $('#dg6').datagrid({
        onDblClickRow:function(){
            var row = $('#dg6').datagrid('getSelected');
            if (row){
            	lov6_ok();
            }       
        }
    });  

	function lov6(){
		search=$('#search6').val(); $('#dlg6').dialog('open').dialog('setTitle','Pilihan');
		$('#dg6').datagrid({url:'<?=base_url()?>index.php/<?=$ctr6?>/'+search});
		$('#dg6').datagrid('reload');
	};	
	function lov6_ok(){
		var row = $('#dg6').datagrid('getSelected');
		if (row){
			$('#<?=$output6?>').val(row.<?=$key6?>); $('#dlg6').dialog('close');
		} else { alert("Pilih salah satu !"); }
	}	
   function lov6_search(){
        var search=$('#search6').val(); 
        $('#dg6').datagrid({url:'<?=base_url()?>index.php/<?=$ctr6?>/'+search});
        $('#dg6').datagrid('reload');       
        
    }
    function lov6_close(){
        $('#dlg6').dialog('close');
    }
	
</SCRIPT>

<? } ?>


