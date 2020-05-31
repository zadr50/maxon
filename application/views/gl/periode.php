<div class="thumbnail box-gradient">
	<?php
	echo link_button('Save', 'save_periode();return false;','save');		
    if($closed=="1"){
        echo link_button('ReOpen', '','edit','false',base_url().'index.php/periode/unclosing/'.$period);       
        
    } else {
        echo link_button('Closing', '','edit','false',base_url().'index.php/periode/closing/'.$period);     
        
    }
	echo link_button("Refresh","onReload();return false","reload");
	echo link_button("Delete","onDelete();return false;","remove");
	echo "<div style='float:right'>";
	echo link_button('Help', 'load_help(\'periode\')','help');		
	?>
	<a href="#" class="easyui-splitbutton" data-options="plain:false,menu:'#mmOptions',iconCls:'icon-tip'">Options</a>
	<div id="mmOptions" style="width:200px;">
		<div onclick="load_help('periode')">Help</div>
		<div onclick="show_syslog('periode','<?=$period?>')">Log Aktifitas</div>
		<div>Update</div>
		<div>MaxOn Forum</div>
		<div>About</div>
	</div>
	<?=link_button("Close", "remove_tab_parent();return false;","cancel")?>
	</div>
</div> 
<?php 
	echo validation_errors();
?>
<div  class="easyui-tabs" style="width:auto;height:auto;min-height: 500px">
    <div title="General" id="box_section" style="padding:10px">
    	<?php
		if($mode=='view'){
			$disabled=' readonly';
		} else {
			$disabled='';
		}
    	?>
    	<form name='myform' id='myform' method='POST'>
		<table class='table' >
			
		<?php 
			echo "<tr>";
			echo my_input_td("Periode Id",'period',$period,""," $disabled");
			echo my_input_td("Periode Month",'month_name',$month_name);
		    echo "</tr>";
		    echo "<tr>";
			echo my_input_td("Year",'year_id',$year_id);
			echo my_input_td("Sequence",'sequence',$sequence);
		    echo "</tr>";
		    echo "<tr>";
			echo my_input_date_td("Start Date",'startdate',$startdate);
			echo my_input_date_td("End Date",'enddate',$enddate).'</tr>';
			echo '</tr>';
			echo "<tr><td>Sudah Tutup Buku ?</td>
				<td colspan='4'>";
			echo form_radio('closed','No',$closed=='0'||$closed=='',"style='width:20px'")." &nbsp No ";
			echo form_radio('closed','Yes',!($closed=='0'||$closed==''),"style='width:20px'")." &nbsp Yes ";
			echo "</td></tr>";
		?>
		</form>	
		</table>
   </div>
   <div title="Balance" id="box_section" style="padding:10px">
		<p>Dibawah ini adalah saldo awal dan akhir untuk periode diatas</p>
		<?=load_view("gl/balance_coa",array("periode"=>$period))?>
    </div>

    <div title="Transaction (UnPosted)" id="box_section" style="padding:10px">
<?php
        $unpost_tr=new $this->crud();
        $unpost_tr->sql="select * from q_all_trans where tanggal between '$startdate' and '$enddate' and (posted=0 or posted is null) order by tanggal";
        $unpost_tr->title="Transaction (UnPosted)";
        $unpost_tr->table="q_all_trans";
        $unpost_tr->show_box=false;
        $unpost_tr->column_numeric=array("amount");
        $colwidth[]=array("field"=>"posted","width"=>40);
        $unpost_tr->column_width=$colwidth;
        $unpost_tr->show_button_close=false;
        
        $url=base_url("posting/posting_all?sid_date_from=$startdate&sid_date_to=$enddate&sid_nomor=&sid_posted=");
        
        $unpost_tr->other_buttons=link_button('Posting',"posting2();return false;",'save')."
	        <script language='JavaScript'>
	            function posting2(){
	                var vUrl='$url';
	                add_tab_parent('Posting $period',vUrl);
	            };
	        </script>
        ";
        
        echo $unpost_tr->render();



?>
    </div>
    <div title="Transaction (Posted)" id="box_section" style="padding:10px">
<?php 
        $unpost_tr=new $this->crud();
        $unpost_tr->sql="select * from q_all_trans where tanggal between '$startdate' and '$enddate' and (posted=1) order by tanggal";
        $unpost_tr->title="Transaction (Posted)";
        $unpost_tr->table="q_all_trans";
        $unpost_tr->show_box=false;
        $unpost_tr->column_numeric=array("amount");
        $colwidth[]=array("field"=>"posted","width"=>40);
        $unpost_tr->column_width=$colwidth;
        $unpost_tr->show_button_close=false;
        
        $url=base_url("posting/unposting_all?sid_date_from=$startdate&sid_date_to=$enddate&sid_nomor=&sid_posted=");
        
        $unpost_tr->other_buttons=link_button('UnPosting',"unposting2();return false;",'save')."
	        <script language='JavaScript'>
	            function unposting2(){
	                var vUrl='$url';
	                add_tab_parent('UnPosting $period',vUrl);
	            };
	        </script>
        ";
        
        
        echo $unpost_tr->render();


?>

    </div>
    
</div>
				
<script type="text/javascript">
    function save_periode(){
        if($('#period').val()===''){log_err('Isi dulu kode periode !');return false;};
        if($('#year_id').val()===''){log_err('Isi dulu tahun !');return false;};

//            echo form_open('periode/add','id=myform name=myform  class=form-horizontal  role=form'); 
//            echo form_open('periode/update','id=\'myform\' name=\'myform\' class=\'form-horizontal\' role=form');
        loading();
        url='<?=base_url()?>index.php/periode/save';
            $('#myform').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    loading_close();
                    if (result.success){
                        log_msg(result.msg);
                        remove_tab_parent();
                    } else {
                        log_err(result.msg);
                    }
                }
            });
            
                    
    }
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/periode");
	}
	function onReload(){
		var period=$("#period").val();
		var url=CI_BASE+"index.php/periode/view/"+period;
		window.open(url,"_self");
	}
	function onDelete(){
		var period=$("#period").val();
		$.messager.confirm('Confirm','Are you sure you want to remove this ?',function(r){
		if (r){
			var url=CI_BASE+"index.php/periode/delete/"+period;
			window.open(url,"_self");
		}}
		);
	}
</script>
	
