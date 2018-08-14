
 <head>
 <meta http-equiv="content-type" content="text/html; charset=utf-"/>
<style type="text/css" title="currentStyle">
			
			@import "<?=base_url();?>public/media/css/demo_table_jui.css";
			@import "<?=base_url();?>public/themes/smoothness/jquery-ui-1.8.4.custom.css";
			@import "<?=base_url();?>public/ui/themes/default/easyui.css";

                        
                        div.dataTables_info {
				padding-bottom: 10px;
			}
			.toolbar {
				float: left;
			}
</style> 
<link rel="stylesheet"type="text/css" 
      href="<?php echo base_url();?>public/themes/standard/style.css"/>
<link rel="stylesheet"type="text/css" 
      href="<?php echo base_url();?>public/themes/standard/nav_menu.css"/>


<script type="text/javascript" language="javascript" src="<?=base_url();?>public/ui/jquery-1.8.0.min.js"></script>
<script type="text/javascript" language="javascript" src="<?=base_url();?>public/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?=base_url();?>public/ui/jquery.easyui.min.js"></script>


<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
            $('#dg').dataTable( {
                "sScrollX": "50%",                    
                "sScrollY": 300,
                "bJQueryUI": true,
                "sPaginationType": "full_numbers"
             } );
    $('#frmForm').dialog({  
        width: 400,  
        height: 200,  
        closed: true,  
        cache: false,  
        href: 'get_content.php',  
        modal: true
        
    });            
    $('#frmList').dialog({  
        title:"Daftar Master Barang",
        width: 800,  
        height:500,
        resizable:true
    });            

    
    
    } );
</script>                
</head>

<body>
 <div id="header"><?php echo $_header;?></div>	   
   
    <div id="frmList" style="width:80%">
        <div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix">
            <a href="javascript:void(0)" class="easyui-linkbutton" >Addnew</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" 
               onclick="$('#frmForm').dialog('open')">Seting</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" >Filter</a>
        </div>
        
    <?php echo $_content;?>		 


    </div>

 
     <div id="frmForm" name="dlg" class="easyui-dialog" title="Basic Dialog"
         data-options="resizable:true,
				iconCls: 'icon-save',
				toolbar: [{
					text:'Add',
					iconCls:'icon-add',
					handler:function(){
						alert('add')
					}
				},'-',{
					text:'Save',
					iconCls:'icon-save',
					handler:function(){
						alert('save')
					}
				}],
				buttons: [{
					text:'Ok',
					iconCls:'icon-ok',
					handler:function(){
						alert('ok');
					}
				},{
					text:'Cancel',
					handler:function(){
						alert('cancel');;
					}
				}]
			"
        >
            The dialog content.
    </div>



</body>
