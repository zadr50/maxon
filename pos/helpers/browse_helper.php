<?php if(!defined('BASEPATH'))exit('No direct script access allowed');
 
if(!function_exists('browse')){ 
    function browse($sql,$caption='',$controller='',$offset=0,$limit=10
            ,$field_key='',$width='auto',$height='auto'){
       echo '  <script type="text/javascript">    
            CI_CONTROL=\''.$controller.'\';
            FIELD_KEY=\''.$field_key.'\';
            CI_CAPTION=\''.$caption.'\';
            CI_WIDTH='.$width.';
            CI_HEIGHT='.$height.';
        </script>';
        $CI =& get_instance();  
    
        $query=$CI->db->query($sql.' limit 1');
        $flds=$query->list_fields();
         
        $thead='<tr>';
        for($i=0;$i<count($flds);$i++){
            $fld=$flds[$i];
            $fld=str_replace('_',' ',$fld);
            $fld=ucfirst($fld);
            $thead.='<th data-options="field:\''.$flds[$i].'\' ">'.$fld.'</th>';
        }
        $thead.='</tr>';
        $search=$CI->input->get('search');
        $tbl='
        <table id="dg" class="easyui-datagrid", title="'.$caption.'"
              style="height:'.$height.' px;width:$width px", 
              data-options="rownumbers:true,pagination:true,pageSize:10,loadFilter:pagerFilter,
              singleSelect:true,collapsible:true,url:\''
                .site_url().'/'.$controller.'/browse_data/'.$offset.'/'.$limit.'/'.$search.'\'
                    ,toolbar:\'#tb\'">
              <thead>'.$thead.'</thead>
              </table>
         ';
 
         
        return $tbl;

    }
if(!function_exists('browse_data')){
    function browse_data($data,$flds,$caption='',$width=600,$id='dg',$toolbar=''){
        $CI =& get_instance();
          
        $thead='<tr>';
        for($i=0;$i<count($flds);$i++){
            $fld=$flds[$i];
            $fld=str_replace('_',' ',$fld);
            $fld=ucfirst($fld);
            $thead.='<th data-options="field:\''.$flds[$i].'\'">'.$fld.'</th>';
        }
        $thead.='</tr>';
        $tbl='<table id="'.$id.'" class="easyui-datagrid", title="'.$caption.'"
              style="width:'.$width.' px", 
              data-options="rownumbers:false, 
              singleSelect:true,collapsible:true,';
        if($toolbar!='')$tbl.="toolbar:'#".$toolbar."',";
        $tbl.='">';
        $tbl.='<thead>'.$thead.'</thead>';
        $tbl.="<tbody>";
                for($r=0;$r<count($data);$r++){
                  	$row=$data[$r];
                    $rows[$r+1]=$r;
                    $tbl.="<tr>";
                    for($i=0;$i<count($flds);$i++){
                        $fld=$flds[$i];
                        $tbl.="<td>".$row[$fld]."</td>";
                    };
                    $tbl.="</tr>";
               };
       $tbl.='</tbody>';
        
       $tbl.='</table>';
	   $s="
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
                <script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
            ";
        return $tbl;
    }
}
if(!function_exists('browse_simple')){
    function browse_simple($sql,$caption='',$width=600,$height=100,$id='dg',$toolbar=''){
        $CI =& get_instance();
      
        $query=$CI->db->query($sql);
        $flds=$query->list_fields();
//		$fd=$query->field_data();
		
//		var_dump($flds);
//		foreach ($fd as $field)
//		{
//			var_dump($field);
//		   echo $field->name;
//		   echo $field->type;
//		   echo $field->max_length;
//		   echo $field->primary_key;
//		}		
        $thead='<tr>';
//		for($i=0;$i<len($flds)-1;$i++) {
        for($i=0;$i<count($flds);$i++){
            $fld=$flds[$i];
            $fld=str_replace('_',' ',$fld);
            $fld=ucfirst($fld);
            $thead.='<th data-options="field:\''.$flds[$i].'\'">'.$fld.'</th>';
        }
        $thead.='</tr>';
        $tbl='<table id="'.$id.'" class="table2", width="100%" title="'.$caption.'"
              data-options="rownumbers:true, 
              singleSelect:true,collapsible:true,';
        if($toolbar!='')$tbl.="toolbar:'#".$toolbar."',";
        $tbl.='">';
        $tbl.='<thead>'.$thead.'</thead>';
        $tbl.="<tbody>";
                foreach($query->result_array() as $row){
                    $rows[$i++]=$row;
                    $tbl.="<tr>";
                    for($i=0;$i<count($flds);$i++){
                        $fld=$flds[$i];
                        $tbl.="<td>".$row[$fld]."</td>";
                    };
                    $tbl.="</tr>";
               };
       $tbl.='</tbody>';
        
       $tbl.='</table>';
	   $s="
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
                <script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
            ";
        return $tbl;
    }
}

if ( ! function_exists('browse2'))
{
    function browse2($sql,$caption="",$class="",$offset=0,$limit=50
            ,$order_column='',$order_type='asc',$header='',$style='')
    {
        echo '<script language="javascript">
            M_BROWSE=\''.base_url().'index.php/'.$class.'/browse/\';    
            M_VIEW=\''.base_url().'index.php/'.$class.'/view/\';    
            M_DELETE=\''.base_url().'index.php/'.$class.'/delete/\';   
                
        </script>';    
        $CI =& get_instance();
        
        $query=$CI->db->query($sql.' limit 1');
        $flds=$query->list_fields();
		if($caption=="")$caption="Recordset";
		if($class=="")$class="unknown_controller";
        $url=site_url().'/'.$class.'/browse_json/'.$offset.'/'.$limit;
        $thead='<tr>';
		if($style=='')$style='width:100%';
        for($i=0;$i<count($flds);$i++){
            $fld=$flds[$i];
            $fld=str_replace('_',' ',$fld);
			if($fld!=""){
           		 $thead.='<th  data-options="field:\''.$flds[$i].'\'">
            			<strong>'.ucfirst($fld).'</strong></th>';
			}
        }
        $thead.='</tr>';
        $tbl='<table id="dg" class="easyui-datagrid" , title=\''.$caption.'\' 
              style="'.$style.'"
              data-options="singleSelect:true,collapsible:true,fitColumns:true,
              	url:\''.$url.'\' ,toolbar:\'#tb\' " >
              <thead>'.$thead.'</thead>
              </table>';
        $retval=$tbl;
               

        return  $retval;

        }
}
if(!function_exists('browse_table')){
    function browse_table($table_name,$field_key='',$field_val=''){
        $width=600;
        $height=400;
        $caption=$table_name;
        $controller='run';
       echo '  <script type="text/javascript">    
            CI_CONTROL=\''.$controller.'\';
            FIELD_KEY=\''.$field_key.'\';
            CI_CAPTION=\''.$caption.'\';
            CI_WIDTH='.$width.';
            CI_HEIGHT='.$height.';
        </script>';
       $sql="select * from ".$table_name;
        $CI =& get_instance();
  
        $query=$CI->db->query($sql.' limit 1');
        $flds=$query->list_fields();
         
        $thead='<tr>';
        for($i=0;$i<count($flds);$i++){
            $fld=$flds[$i];
            $fld=str_replace('_',' ',$fld);
            $thead.='<th data-options="field:\''.$flds[$i].'\'">'.$fld.'</th>';
        }
        $thead.='</tr>';
        $search=$CI->input->get('search');
        $xurl=site_url().'/run/browse/'.$table_name.'/'.$field_key.'/'.$field_val;
        echo "<script>console.log('".$xurl."');</script>";
        $tbl='<table id="dg" class="easyui-datagrid", title="'.$caption.'"
              style="height:400px;width:900px", 
              data-options="rownumbers:true,pagination:true,pageSize:10,
              singleSelect:true,collapsible:true,url:\''
                .$xurl.'\'
                    ,toolbar:\'#tb\'">
              <thead>'.$thead.'</thead>
              </table>';
	return $tbl;

    }
}

if(!function_exists('browse_simple_edit')){
    function browse_simple_edit($sql,$caption='',$width=600,$height=100,$id='dg',$toolbar=''){
        $CI =& get_instance();
            
   
        $query=$CI->db->query($sql);
        $flds=$query->list_fields();
        $thead='<tr>';
        for($i=0;$i<count($flds);$i++){
            $fld=$flds[$i];
            $fld=str_replace('_',' ',$fld);
            $fld=ucfirst($fld);
            $thead.='<th data-options="field:\''.$flds[$i].'\',editor:\'text\'">'.$fld.'</th>';
        }
        $thead.='</tr>';
        $tbl='<table id="'.$id.'" class="easyui-datagrid", title="'.$caption.'"
              style="height:auto;width:auto", 
              data-options="rownumbers:true, 
              singleSelect:true,collapsible:true,
              
              onClickRow: onClickRow"';
        if($toolbar!='')$tbl.="toolbar:'#".$toolbar."',";
        $tbl.='">';
        $tbl.='<thead>'.$thead.'</thead>';
        $tbl.="<tbody>";
                foreach($query->result_array() as $row){
                    $rows[$i++]=$row;
                    $tbl.="<tr>";
                    for($i=0;$i<count($flds);$i++){
                        $fld=$flds[$i];
                        $tbl.="<td>".$row[$fld]."</td>";
                    };
                    $tbl.="</tr>";
               };
       $tbl.='</tbody>';
        
       $tbl.='</table>';
	   $s="
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/default/easyui.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/icon.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."js/jquery-ui/themes/demo.css\">
                <script src=\"".base_url()."js/jquery-ui/jquery.easyui.min.js\"></script>                
                
		<script type=\"text/javascript\">
		var editIndex = undefined;
		function endEditing(){
			if (editIndex == undefined){return true}
			if ($('#dgItem').datagrid('validateRow', editIndex)){
				//var ed = $('#dgItem').datagrid('getEditor', {index:editIndex,field:'item_number'});
				//var productname = $(ed.target).combobox('getText');
				//$('#dgItem').datagrid('getRows')[editIndex]['productname'] = productname;
				//$('#dgItem').datagrid('endEdit', editIndex);
				editIndex = undefined;
				return true;
			} else {
				return false;
			}
		}
		
		</script>		                                
                
            ";
        return $s.$tbl;
    }
}


}