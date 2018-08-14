 <?
  $CI =& get_instance();
 ?>
<div class="easyui-tabs" id="tt">	 
	<div title="HOME"><? include_once __DIR__."/../home.php";?></div>
	<script>$().ready(function(){$("#tt").tabs("select","DASHBOARD");});</script>

	<div title="DASHBOARD" style="padding:10px">
		<div class="col-md-12 thumbnail">

 
<div class="box1">
<div id="p" class="easyui-panel box2" title="Online Documentation"  style='width:900px'
	data-options="iconCls:'icon-help'" >
	<div id='divCustomer'><img src="<?=base_url()?>images/loading.gif"></div>
</div>
</div>


		</div>
	</div>
</div>




<script  language="javascript">
$().ready(function(){
	//void get_this(CI_ROOT+'purchase_invoice/daftar_kartu_gl','','divGL');
});
	
	
</script>

