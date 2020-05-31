<?php
class Modules_model extends CI_Model {

private $primary_key='module_id';
private $table_name='modules';
public $parent_id="";

function __construct(){
    parent::__construct();        
       
}
function count_all(){
    return $this->db->count_all($this->table_name);
}
function get_by_id($id){
    $this->db->where($this->primary_key,$id);
    return $this->db->get($this->table_name);
}
function check_parent_id($parent_id){
    if($parent_id==""){
        return "_00000";
    }
	if($parent_id!="0"){
		//cek punya parent???
	    if($this->db->query("select count(1) as cnt from modules 
	        where module_id='$parent_id'")->row()->cnt==0){
	        return "_00000";
	    }
		
	}
    return $parent_id;
}
function save($data){
    $data["parentid"]=$this->check_parent_id($data["parentid"]);
	if($data['sequence']=='')$data['sequence']=99;
    return $this->db->insert($this->table_name,$data);
    //return $this->db->insert_id();
}
function update($id,$data){
    $data["parentid"]=$this->check_parent_id($data["parentid"]);
	if($data['sequence']=='')$data['sequence']=99;
    $this->db->where($this->primary_key,$id);
    return $this->db->update($this->table_name,$data);
}
function delete($id){
    $this->db->where($this->primary_key,$id);
    $this->db->delete($this->table_name);
}
function build_menu(){
    $this->db->where('parentid','0');
    $this->db->where('visible',1);
    $this->db->order_by('sequence');
    $query=$this->db->get('modules');
    $menu="<nav><ul>";
    foreach($query->result() as $row){
        $menu.="<li><a href='#'>".$row->module_name."</a> ";

        $menu.="<ul>";
        $this->db->where('parentid',$row->module_id);
        $this->db->where('visible',1);
        $this->db->order_by('sequence');
        $q_child=$this->db->get('modules');
        foreach($q_child->result() as $r_child){
            $description=$r_child->description;
            if($description=='.' or $description=='Please entry this')
                $description=$r_child->module_name;
            $menu.="<li>".anchor($r_child->form_name,
                    $r_child->module_name,' title="'.$description.'"');
            $menu.="</li>";
        }
        $menu.="</ul>";

        $menu.="</li>";
    }
    $menu.="</ul></nav>";
    return $menu;
}
    function parent_id_list(){
        $retval=null;
        $sql="select * from modules where (parentid='0' or parentid is null) and description<>'.'";
        $sql.=" order by parentid";
        if($q=$this->db->query($sql)){
            foreach($q->result() as $row){
                $retval[$row->module_id]=$row->module_name;
            }
        }
        return $retval;
    }
	function module_list($group_id='') {
	    
	    if($this->parent_id=="")$this->parent_id="(parentid='0' or parentid is null)";
		$this->load->model('modules_groups_model');
		$s="select module_id as id,module_name as text
		from modules where 1=1";
		$s.=" and parentid='$this->parent_id'";
        $s.=" order by parentid, module_id";
        if($q=$this->db->query($s)){
			$rows=array();
			foreach($q->result() as $r){
				$s="select module_id as id,module_name as text
				from modules where parentid='".$r->id."' 
				order by module_id";
				$rows1=array();
                $has_child=false;
				if($q1=$this->db->query($s)){
					foreach($q1->result() as $r1){
						$checked=$this->modules_groups_model->exist($group_id,$r1->id);
						$rows1[]=array('id'=>$r1->id,'text'=>$r1->text.' ('.$r1->id.')',"checked"=>$checked);
                        $has_child=true;
					};
				};
				$checked=$this->modules_groups_model->exist($group_id,$r->id);
				if($rows1) { 
					$rows[]=array("id"=>$r->id,"text"=>$r->text.' ('.$r->id.')',"state"=>"open",
					"checked"=>$checked,"children"=>$rows1);
				} else {
				    if(!$has_child){
                        $checked=$this->modules_groups_model->exist($this->parent_id,$r->id);
                        $rows[]=array("id"=>$r->id,"text"=>$r->text.' ('.$r->id.')',"checked"=>$checked);
				        
				    }
				}
			};
		}
		$data[]=array('id'=>'1','text'=>'Root','children'=>$rows);
        echo json_encode($data);
	}
}
