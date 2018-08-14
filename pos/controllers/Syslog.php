<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class SysLog extends CI_Controller {
	function __construct()
	{
		parent::__construct();        
        
 		$this->load->helper(array('url','form'));
		$this->load->library('template');;
	}
	function index()
	{	
		$data['message']='';
	}
	function view_all(){
		$sql="select * from syslog order by tgljam desc limit 1000";
		//echo($sql);
		echo "<table class='table'><tr><td>TglJam</td><td>UserId</td>
		<td>Jenis</td><td>Command</td>
		<td>Nomor Bukti</td></tr>";
		if($query=$this->db->query($sql)){
			echo "<tr>";
			foreach($query->result() as $row){
				echo "<td>$row->tgljam</td><td>$row->userid</td>
				<td>$row->jenis</td><td>$row->jenis_cmd</td>
				<td>$row->no_bukti</td></tr>";
			}
			echo "</tr>";
		}
		
		//echo json_encode($query->row_array());
	}

	function view($module,$nomor=''){
		$sql="select * from syslog where jenis='$module' 
		and userid='".user_id()."' and no_bukti='$nomor'";
		//echo($sql);
		echo "<table class='table'><tr><td>TglJam</td><td>UserId</td>
		<td>Jenis</td></tr>";
		if($query=$this->db->query($sql)){
			echo "<tr>";
			foreach($query->result() as $row){
				echo "<td>$row->tgljam</td><td>$row->userid</td>
				<td>$row->jenis</td><td>$row->jenis_cmd</td></tr>";
			}
			echo "</tr>";
		}
		
		//echo json_encode($query->row_array());
	}
 
}