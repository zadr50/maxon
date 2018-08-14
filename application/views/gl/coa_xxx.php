<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
?>
<script src="<?=base_url();?>js/jquery-ui/jquery.easyui.min.js"></script>

<div id="tt" name="tt" class="easyui-tabs" style="width:880px;height:480px">
    <div title="1 - Aktiva" style="padding:10px">
         <?=$aktiva?>  
    </div>
    <div title="2 - Hutang" style="padding:10px">
            <?=$hutang?>
    </div>
    <div title="3 - Modal"   style="padding:10px">
       <?=$modal?> 
    </div>
    <div title="4 - Pendapatan"   style="padding:10px">
     <?=$pendapatan?>
    </div>
    <div title="5 - Harga Pokok"   style="padding:10px">
     <?=$harga_pokok?>
    </div>
    <div title="6 - Biaya"   style="padding:10px">
     <?=$biaya?> >
    </div>
    <div title="7 - Pendapatan Lainya"   style="padding:10px">
     <?=$pendapatan_lain?>
    </div>
    <div title="8 - Biaya Lainnya"   style="padding:10px">
             <?=$biaya_lain?>
    </div>
</div>

<div id="dlg" name='dlg'>content</div>
<script>
    function get_node(acc_type){
        var node = $('#tree_'+acc_type).tree('getSelected');
        var acc_par='';
        if (node){
                var s = node.text.trim();
                if (node.attributes){
                        //s = s+","+node.attributes.p1+","+node.attributes.p2;
                       s=node.attributes.p1.trim();
                }
                
                acc_par=s.substr(0,s.indexOf(' '));

        };
        console.log('get_node='+s+', acc_type='+acc_type);
        return acc_par;
        
    }
    function get_acc_type(){
        var pp = $('#tt').tabs('getSelected');  
        var tab = pp.panel('options').tab;    // the corresponding tab object                 
        return tab.text().substr(0,1);
    };
    
    function add_group(){
        var acc_type=get_acc_type();
        var acc_par=get_node(acc_type);
        xurl=CI_ROOT+'coa/group/'+acc_type+'/'+acc_par;
        console.log(xurl);
        $('#dlg').dialog({  
            width: 400,  
            height: 400,  
            closed: false,  
            cache: false,  
            href: xurl,  
            modal: true  
        });  
    }
    function del_group(){
        var acc_type=get_acc_type();
        var grp=get_node(acc_type);
        xurl=CI_ROOT+'coa/group_delete/'+grp;
        $.ajax({
		type: "GET",
		url: xurl,
		success: function(msg){
                    alert('Sukses Dihapus.')
		},
		error: function(msg){alert('Gagal Dihapus !');}
	}); 
    }
    function refresh_group(acc_type){
        console.log('refresh_group');
        xurl=CI_ROOT+'coa/group_refresh/'+acc_type;
        $.ajaxSetup({ cache: false });
        $.ajax({
		type: "GET",
		url: xurl,
		success: function(msg){
                    $('#panel_west_'+acc_type).html(msg);
		},
		error: function(msg){alert('error load group_list');}
	}); 
        
        
    }

</script>