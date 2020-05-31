<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Query extends CI_Controller {
    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library(array('sysvar','template','form_validation'));
		
    }
    function index()    {
    	$data['caption']="Query Express";
    	$this->template->display("admin/query",$data);
	}	
	function execute(){
		$sql=$this->input->post('sql');
		$tbl="";
			$sql_ar=explode(";",$sql);
			for($i=0;$i<count($sql_ar);$i++){
				$sql=$sql_ar[$i];
				
				if(substr(strtolower($sql), 0,strlen("select "))=="select "){
					if($query=$this->db->query($sql)){
				        $flds=$query->list_fields();
				        $thead='<tr>';
				        for($i=0;$i<count($flds);$i++){
				            $fld=$flds[$i];
				            $fld=str_replace('_',' ',$fld);
				            $thead.="<th>$fld</th>";
				        }
				        $thead.='</tr>';
						$tbody="";
						foreach($query->result_array() as $row){
							$tbody.="<tr>";
							for($i=0;$i<count($flds);$i++){
					            $fld=$flds[$i];
								$val=$row[$fld];
								$tbody.="<td>$val</td>";
							}
							$tbody.="</tr>";
						}
				        $tbl="
				        <table class='table'>
				              <thead>$thead</thead>
				              <tbody>$tbody</tbody>
			            </table>";
				        
				        
				        echo $tbl;
						
				               
						
					}
				
				} else {
					echo "<br>$sql<br>";					
					$this->db->query($sql);
					echo "Success.";
					echo "<br>";
				}
				
				
			}
				
		
		if($tbl!=""){
			echo "Success.";
			exit;
		}
		//echo $this->db->display_error();
		
	}
}

