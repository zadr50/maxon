<?php
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past   
?>

<div  class="easyui-panel" title="Susunan kode perkiraan" style="width:850px;height:400px;padding:10px;">
        <div class="easyui-layout" data-options="fit:true">
                <div id="panel_west_'.$account_type.'" data-options="region:'west',split:true" 
                     style="width:400px;padding:10px">
    <!-- Left Content -->
 
        <div>
        <a href="#" onclick="add_group();"
            class="easyui-linkbutton" data-options="iconCls:'icon-add'">Add</a>
            <a href="#"  onclick="del_group();" class="easyui-linkbutton" 
               data-options="iconCls:'icon-remove'">Del</a>
            <a href="#"  class="easyui-linkbutton" data-options="iconCls:'icon-save'">Edit</a>
            <a href="#"  onclick="refresh_group('.$account_type.');" class="easyui-linkbutton" 
               data-options="iconCls:'icon-ok'">Refresh</a>
            <hr/>
        </div> 

    <ul id='tree_".<?=$account_type?>."' class='easyui-tree' data-options='animate:true'> 
         
        $q=$this->db->query("select group_type,group_name from gl_report_groups 
        where  account_type=".$account_type." order by group_type");

        foreach($q->result() as $row) {
            $ret.="
                 <ul><li><span>

                ".$row->group_type." - ".$row->group_name."
                
                </span></li> 
                <ul>
                 ";
                    $qs=$this->db->query("select group_type,group_name from gl_report_groups 
                        where parent_group_type='".$row->group_type."'");
                    foreach($qs->result() as $row_sub){
                        $ret.="<li><span>
                            ".$row_sub->group_type." - ".$row_sub->group_name."
                                
                            </span></li>";

                        }
                    $ret.="
                </ul>
                </li>
           </ul>";
        };        
    $ret.='</ul>';
    $ret.='             </div>
			<div data-options="region:\'center\'" style="padding:10px">';
    
    //Right Content
    
    $ret.='
        <a href="#" class="easyui-linkbutton" data-options="iconCls:\'icon-add\'">Add</a>
        <a href="#" class="easyui-linkbutton" data-options="iconCls:\'icon-remove\'">Del</a>
        <a href="#" class="easyui-linkbutton" data-options="iconCls:\'icon-save\'">Edit</a>
        <a href="#" class="easyui-linkbutton" data-options="iconCls:\'icon-ok\'">Refresh</a>
        <hr/>';
    
    $ret.='			</div>
		</div>
	</div>

    ';
    return $ret;
    
}