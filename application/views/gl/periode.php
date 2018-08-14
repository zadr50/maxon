<div class="thumbnail box-gradient">
	<?
	echo link_button('Add','','add','false',base_url().'index.php/periode/add');		
	echo link_button('Search','','search','false',base_url().'index.php/periode');		
	echo link_button('Save', 'save_periode();return false;','save');		
    if($closed=="1"){
        echo link_button('ReOpen', '','edit','false',base_url().'index.php/periode/unclosing/'.$period);       
        
    } else {
        echo link_button('Closing', '','edit','false',base_url().'index.php/periode/closing/'.$period);     
        
    }
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
	</div>
</div> 
<?php 
	echo validation_errors();
	if($mode=='view'){
		echo form_open('periode/update','id=\'myform\' name=\'myform\' class=\'form-horizontal\' role=form');
		$disabled='disable';
	} else {
		$disabled='';
		echo form_open('periode/add','id=myform name=myform  class=form-horizontal  role=form'); 
	}
?>
<table class='table' >
<? 
	echo "<tr>";
	echo my_input_td("Periode Id",'period',$period);
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
		<td colspan='2'>".form_radio('closed','No',$closed=='0'||$closed=='')
		." &nbsp No ".form_radio('closed','Yes',!($closed=='0'||$closed==''))
		." &nbsp Yes </td></tr>";
	echo "</table>";
	echo form_close();
?>
<div  class="easyui-tabs" style="width:auto;height:auto;min-height: 500px">
    
    <div title="Balance" id="box_section" style="padding:10px">
	<p>Dibawah ini adalah saldo awal dan akhir untuk periode diatas</p>
	<table id='dgSaldo' name='dgSaldo' class="easyui-datagrid"  width='100%'
		data-options="
			iconCls: 'icon-edit', fitColumns: true,
			singleSelect: true,  
			url: '<?=base_url()?>index.php/periode/saldo_awal/<?=$period?>',
			toolbar:'#tbSaldo'," width="100%">
		<thead>
			<tr>
				<th data-options="field:'account',width:80">Account</th>
				<th data-options="field:'account_description',width:180">Account Description</th>
				<th data-options="<?=col_number("beginning_balance",2)?>">Awal</th>
                <th data-options="<?=col_number("debit_base",2)?>">Debit</th>
                <th data-options="<?=col_number("credit_base",2)?>">Credit</th>
                <th data-options="<?=col_number("ending_balance",2)?>">Akhir</th>                
				<th data-options="field:'company_code',width:180,align:'left'">Keterangan</th>
			</tr>
		</thead>
	</table>
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
        if($('#period').val()===''){alert('Isi dulu kode periode !');return false;};
        if($('#year_id').val()===''){alert('Isi dulu tahun !');return false;};
        $('#myform').submit();
    }
	function load_help() {
		window.parent.$("#help").load("<?=base_url()?>index.php/help/load/periode");
	}
</script>
	
