<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
	echo $library_src;
	echo $script_head;
	if(!isset($_left_menu_caption))$_left_menu_caption='Left Menu';
?> 
<script type="text/javascript">
   		CI_ROOT = "<?=base_url()?>index.php/";
		CI_BASE = "<?=base_url()?>";   
</script>

<body>
<div id="wrapz">	 
<div class="easyui-layout" style="width:100%;height:1000px;
    box-shadow: 5px 5px 5px rgba(0,0,0,0.15);
	 border-radius: 5px;">
		<div data-options="region:'north'" style="background-color:#CCCCCC;
			height:100px;padding-top:2px;background-image:url('<?=base_url()?>images/header2.jpg')">
            <?=$_header?>
        </div>
		<div data-options="region:'south',split:true" 
                     style="background-color:#ddd;height:100px;padding:5px;
                     background-image:url('<?=base_url()?>images/img01.jpg')">
                     <?=$_footer?></div>
		<div id="left_menu" data-options="region:'west',split:true" title="MENU // <?=$_left_menu_caption?>"
			
                     style="background-color: white-smoke;padding:5px;width:250px;
                      ">
                   <?=$_left_menu;?>
		</div>
		<div id="main_content" data-options="region:'center',title:'',iconCls:'icon-ok'" 
                     style="background-color:white-smoke;padding: 5px;width:80%;">
				<div  data-options="iconCls:'icon-help',closable:true" style="padding:10px">

                      <?php echo $_content;?>   


				</div>
		</div>
</div>		

<div style="position:absolute;top:0;left:0;background:black;width:100%;color:white;height:20">
	<span style="float:right"> 
	<?php
		echo $this->access->print_info();
		echo " - ".date("Y-m-d H:i a");
	?>
	</span>		
</div>


</body>

</html>
