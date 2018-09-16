<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Detail_grid
{
 function __construct()
 {
     $this->CI =& get_instance();             
 }
 function render($param){
 	
	
//			echo $this->detail_grid->render(
//				array(
//					"id"=>"dgRcv",
//					"field_key"=>"id",
//					"controller"=>"receive_po",
//					"parent_value"=>$purchase_order_number,
//					"fields"=>array("shipment_id","date_received","warehouse_code",
//						"item_number","description","quantity_received","receipt_by",
//						"selected")
					//"url_list"=>base_url("receive_po/list_by_po"),
					//"url_add"=>base_url("receive_po/add"),
					//"url_del"=>base_url("receive_po/delete"),
					//"url_edit"=>base_url("receive_po/view"),
					//"columns"=>array(
					//	array("field"=>"shipment_id","width"=>100,"caption"=>"Nomor"),
					//	array("field"=>"date_received","width"=>100,"caption"=>"Tanggal"),
					//	array("field"=>"warehouse_code","width"=>100,"caption"=>"Gudang"),
					//	array("field"=>"item_number","width"=>100,"caption"=>"Item Number"),
					//	array("field"=>"description","width"=>100,"caption"=>"Description"),
					//	array("field"=>"quantity_received","width"=>100,"caption"=>"Quantiy"),
					//	array("field"=>"receipt_by","width"=>100,"caption"=>"Petugas"),
					//	array("field"=>"selected","width"=>100,"caption"=>"Invoiced")
					//)					
					//"fields_numeric"=>array("quantity","mu_qty"),
					//"buttons"=>array("add","edit",'delete')	
//				)
//			)
	
	
	$id=$param["id"];
	$controller=$param["controller"];
	$parent_value=$param["parent_value"];
	$field_key=$param["field_key"];
	$cols="";
	$fields_numeric=null;
	if(isset($param["fields_numeric"]))$fields_numeric=$param["fields_numeric"];
	$columns=null;
	
	if(isset($param["columns"])){
		$columns=$param["columns"];	
		for($i=0;$i<count($columns);$i++){
			$field=$columns[$i];
			$fn=$field["field"];
			$wd=$field["width"];
			$cap=$field["caption"];
			$fmt_num="";
			if($fields_numeric){
				for($ii=0;$ii<count($fields_numeric);$ii++){
					if($fields_numeric[$ii]==$fn){
						$fmt_num=",align:'right',editor:{type:'numberbox',options:{precision:2}}";
						break;
					}
				}
			}
			$cols.="<th data-options=\"field:'$fn',width:$wd $fmt_num \">$cap</th> \r";
		}
		
	}
	$fields="";
	if(isset($param["fields"])){
		$fields=$param["fields"];
		for($i=0;$i<count($fields);$i++){
			$fn=$fields[$i];
			$wd=100;
			$cap=str_replace("_"," ",ucfirst($fn));		
			$cols.="<th data-options=\"field:'$fn',width:$wd\">$cap</th> \r";
		}
	}
	$url_list=base_url("$controller/items/$parent_value");
	if(isset($param["url_list"]))$url_list=$param["url_list"];
	$url_add=base_url("$controller/add/$parent_value");
	if(isset($param["url_add"]))$url_list=$param["url_add"];
	$url_edit=base_url("$controller/view");
	if(isset($param["url_edit"]))$url_edit=$param["url_view"];
	$url_del=base_url("$controller/delete");
	if(isset($param["url_del"]))$url_del=$param["url_delete"];
	
	$button_add = "";		$button_edit = "";		$button_delete = "";
	if(isset($param["buttons"])){
		$buttons=$param["buttons"];
		for($i=0;$i<count($buttons);$i++){
			if($buttons[$i]=="add")	$button_add    = link_button('Add',$id.'_add();return false','add');
			if($buttons[$i]=="edit") $button_edit   = link_button('View',$id.'_view();return false;','edit');			
			if($buttons[$i]=="delete")	$button_delete = link_button('Delete',$id.'_delete();return false;','remove');		
		}
	} 
    $button_reload = link_button('Refresh',$id.'_reload();return false;','reload');  
	
	$retval="
		<table id='$id' class='easyui-datagrid'  	\r 
			style='min-height:300px'
			data-options=\"
				iconCls: 'icon-edit',
				singleSelect: true, toolbar: '#".$id."_toolbar',
				url: ''
			\">					\r
			<thead>				\r
				<tr>			\r
					$cols		\r
				</tr>			\r
			</thead>			\r
		</table>
        <div id='".$id."_toolbar' class='box-gradient' >	\r 
        	$button_add 		\r
        	$button_edit		\r
        	$button_delete		\r
        	$button_reload		\r         	
        </div>					\r 
        
        <script>
			$().ready(function (){
			    ".$id."_reload();
			    $('#$id').datagrid({
			        onDblClickRow:function(){
			        	".$id."_view();
			        }
			    });            
			});
			                
        </script>
	";
	return $retval;
 }
 
 
 
}