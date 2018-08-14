<?php
class Browser
{
	private $config=null;
	private $limit=10;
	private $page=0;
	private $CI=null;
	
	function __construct()
	{
		$this->CI =& get_instance();        
 
        
		$this->CI->load->library('table');
	}
	function init($conf)
	{
		$this->config=$conf;
	}
	function render($as_output=false)
	{
		$tablename=$this->vars('tablename');
		$primary_key=$this->vars('primary_key');
		$sql=$this->vars('sql');
		$order_by=$this->vars('order_by');
		$where=$this->vars('where');
		$use_bootstrap=$this->vars('use_bootstrap');
		$id=$this->vars('id','tbl'.$tablename);
		$page=$this->vars('page');
		$exclude_script=$this->vars('exclude_script');
		$limit=$this->vars('limit');
		if($limit==0)$limit=10;
		$this->limit=$limit;
		
		$show_edit_button=$this->vars('show_edit_button',true);
		
		$show_delete_button=$this->vars('show_delete_button',true);

		$show_view_button=$this->vars('show_view_button',false);

		$caption=$this->vars('caption');
		$fields=$this->vars('fields');
		$select="";
		foreach($fields as $field=>$properties)
		{
			$select.=$field.",";
			$heading[]=$properties['caption'];
		}
		if(strrpos($select,","))$select=substr($select,0,strlen($select)-1);
		$action="";
		if($show_edit_button)$action='Edit';
		if($show_delete_button)$action='Del';
		if($show_view_button)$action='View';
		$heading[]='Action';
		$controller=$this->vars('controller');
		
		$output='';
		$result='';
		
		if($tablename != '') $sql="select $select from $tablename";
		if($page=='')$page=1;
		$page1=(int)$page-1;
		$sql=$sql.' '.$where;
		if($order_by!='')$sql=$sql." order by ".$order_by;
		$offset=" limit ".$page1.",".$limit;
		$sql=$sql.$offset;
		$query=$this->CI->db->query($sql);
			$this->CI->table->set_heading($heading);
			$tmpl = array ( 'table_open'  => '<table  class="table" id="'.$id.'" name="'.$id.'" >' );
			$this->CI->table->set_template($tmpl);
 			if( $query )
			{
				foreach($query->result() as $row)
				{
					$data=null;
					$type='string';
					$key_value='';
					$i=0;
					foreach($row as $key=>$val)
					{
						$type='string';
						if(isset($fields[$key]['type']))$type=$fields[$key]['type'];
						if($type=='numeric'){
							$val=number_format($val);
							$cell=array('data'=>$val,'align'=>'right');
						} else {
							$cell=strip_tags($val);
						}
						if($key==$primary_key){
							$key_value=$val;
						} 
						$data[]=$cell;
					}
					$action="";
					if($show_edit_button)$action.="<a href='#'   value='$key_value' class='editLink btn btn-default glyphicon glyphicon-pencil' title='Edit Row'></a>"; 
					if($show_delete_button)$action.="&nbsp <a href='#'   value='$key_value' class='deleteLink btn btn-default glyphicon glyphicon-remove' title='Delete Row'></a>"; 
					if($show_view_button)$action.="&nbsp <a href='#'  value='$key_value' class='viewLink btn btn-default glyphicon glyphicon-folder-open' title='View Row'></a>"; 
					$data[]=$action;
					$this->CI->table->add_row($data);
					$i++;
				}
				
				
			}
			$result .=	$this->CI->table->generate();
 		
		$item_page_max=(int)($this->CI->db->count_all($tablename)/$limit);
		
		$output .= 	$this->toolbar($page,$item_page_max,$limit,$show_delete_button);
		$output	.=	$result;
		$output .= 	$this->toolbar($page,$item_page_max,$limit,$show_delete_button);
		$output_script	= '<script>
			var M_CONTROL="'.$controller.'"; 
			var M_ID_TABLE="'.$id.'";
			</script>';
		$output_script	.= '<script type="text/javascript" charset="utf-8" src="'.base_url().'js/browser.js"></script>';
		if( !$exclude_script ) $output .= $output_script;
		
		if ($as_output) {
			return $output;
		} else {
			echo $output;
		}
	}
	function vars($varname,$default='')
	{
		if( !isset($this->config[$varname]) ) $this->config[$varname]=$default;
		return (($this->config[$varname]))?$this->config[$varname]:'';
	}
	function toolbar($page=0,$item_page_max=10,$limit=50,$show_add_button=true) 
	{
		$output	= "
		<div class='btn-toolbar' role='toolbar' aria-label=\"Toolbar\">
		<div class=\"btn-groupx\" role=\"group\" aria-label=\"Navigation Button\" style='float:left'>
			<button onclick=\"list_item(1);return false;\" title='Move to first record'
			type=\"button\" class=\"btn btn-default glyphicon glyphicon-step-backward\"></button>
			<button onclick=\"list_item("; 
				if($page<=0)$page=1; $page=$page-1; 
				$output 	.= $page;
				$output	.= "
				);return false;\" title='Previous page'
			type=\"button\" class=\"btn btn-default glyphicon glyphicon-backward\"></button>
			<button onclick=\"list_item(";			
				if($page>$item_page_max-2)$page=$item_page_max-2; 
				$output	.= $page+2;
				$output	.= "
				);return false;\" title='Next page'
			type=\"button\" class=\"btn btn-default glyphicon glyphicon-forward\"></button>
			<button onclick=\"list_item($item_page_max);return false;\" title='Move to last record'
			type=\"button\" class=\"btn btn-default glyphicon glyphicon-step-forward\"></button>";
			if($show_add_button)$output.="
			<button onclick=\"add_item();return false;\" title='Addnew Record'
			type=\"button\" class=\"btn btn-default glyphicon glyphicon-plus\"></button>";
			$output.="
			<button onclick=\"list_item(0);return false;\" title='View as table'
			type=\"button\" class=\"btn btn-default glyphicon glyphicon-list glyphicon \"></button>
			<button onclick=\"list_detail();return false;\" title='View as detail'
			type=\"button\" class=\"btn btn-default glyphicon glyphicon-th-large\"></button>
			<button onclik='search_item();return false;' class=\"btn btn-default 
			glyphicon glyphicon-filter\" 
			type=\"button\" title='Search record by text'></button>	
		</div>
		<div class='btn-groupx col-md-6' role='group' aria-label='Record' style='float:right'>
			<span class=\"input-group\">
			  <input name='page' id='page' value='";
			  
			  if($page<=0)$page=0;
			  $output	.= 	$page+1;
			  
			  $output	.=	"' type=\"text\" class=\"form-control\" placeholder=\"Page\" 
			  style='width:50px'>
			  <span class=\"input-group-btnx\">
				<button onclick='page();return false' class=\"btn btn-default\" type=\"button\">Page</button>
			  </span>
			</span> 

			<span class=\"input-groupx\">
			  <input name='rows' id='rows' value='$limit' type=\"text\" class=\"form-control\" 
				placeholder=\"Row Count\" style='width:50px;float:left'>
			  <span class=\"input-group-btnx\">
				<button onclick='rows();return false' class=\"btn btn-default\" type=\"button\">Rows</button>
			  </span>
			</span>
		</div> 

		</div>
		";		
		return $output;
	}
}
?>