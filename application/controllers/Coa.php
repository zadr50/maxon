<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Coa extends CI_Controller {
    private $sql="select account,account_description,db_or_cr,
    beginning_balance,account_type,group_type,id 
    from chart_of_accounts
    ";
    private $file_view='gl/coa';
	function __construct()
	{
		parent::__construct();        
         
		if(!$this->access->is_login())redirect(base_url());
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
        $this->load->model('chart_of_accounts_model');
		$this->load->model('syslog_model');
        $this->load->model('gl_report_groups_model');

	} 
	function index()
	{	
		if(!allow_mod2('_10010'))return false;   
        $coa_type=1;
        $this->browse_tree($coa_type);
	}
	function  coa_type($type){
        if(!allow_mod2('_10010'))return false;   
        $this->browse_tree($type);
	}
    function print_coa(){
        echo "Not available yet";
    }
    function browse_tree($coa_type){
        $data["coa_type"]=$coa_type;
        $this->template->display('gl/coa_tree',$data);
    }
    function browse($offset=0,$limit=50,$order_column='account',$order_type='asc'){
		$data['controller']='coa';
		$data['fields_caption']=array('Kode Akun','Nama Akun Perkiraan',
			'Db/Cr','Saldo Awal','Type Akun','Kelompok',"Id");
		$data['fields']=array('account','account_description','db_or_cr'
			,'beginning_balance','account_type','group_type',"id");
		$data['field_key']='id';
		$data['caption']='DAFTAR KODE AKUN / COA / PERKIRAAN';
		$data['list_info_visible']=true;

		$this->load->library('search_criteria');
		$faa[]=criteria("Kode Akun","sid_no");
		$faa[]=criteria("Nama Akun","sid_nama");
		$faa[]=criteria("Kelompok","sid_kel");
		$data['criteria']=$faa;
        $this->template->display_browse($data);            
    }
    function unknown(){
        $sql="select * from chart_of_accounts where group_type not in (select group_type from gl_report_groups) order by account";
        echo datasource($sql);          
    }
    function browse_data($offset=0,$limit=20,$nama=''){
		$no=$this->input->get('sid_no');
        $company=cid();
        $sql=$this->sql." where 1=1 ";
        
		if($no!='')$sql.=" and account like '".$no."%'";
		if($this->input->get('sid_nama')!='')$sql.=" and account_description like '".$this->input->get('sid_nama')."%'";
		if($this->input->get('sid_kel')!='')$sql.=" and group_type like '".$this->input->get('sid_kel')."%'";
		$sql.=" order by account";
        if($this->input->get("page"))$offset=$this->input->get("page");
        if($this->input->get("rows"))$limit=$this->input->get("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";
        
         
        
        echo datasource($sql);
    }	      
	function list_info($offset=0){
		if(isset($_GET['offset'])){
			$offset=$_GET['offset'];
		}
		$data['offset']=$offset;
		$this->load->library('search_criteria');

		$faa[]=criteria("Kode Akun","sid_no");
		$faa[]=criteria("Nama Akun","sid_nama");
		$faa[]=criteria("Kelompok","sid_kel");
	
		$data['criteria']=$faa;
		$data['criteria_text']=criteria_text($faa);
		$data['sid_nama']=$this->session->userdata('sid_nama');
		$data['sid_kel']=$this->session->userdata('sid_kel');
		$data['sid_no']=$this->session->userdata('sid_no');
		
		$this->template->display_form_input('gl/info_list_coa',$data);	
	}	    
	function add()
	{
	     
		if(!allow_mod2('_10011'))return false;   
		 $data=$this->set_defaults();
		 $this->_set_rules();
		 $success=false;
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
			$id=$this->chart_of_accounts_model->save($data);
            $data['message']='update success';
            $data['mode']='view';
            $data['success']=true;
			$this->syslog_model->add($id,"coa","add");

            echo json_encode($data);
		} else {
			$data['mode']='add';
	        $this->template->display_form_input($this->file_view,$data,'');
		}
	}
    function save(){
        $data=$this->input->post();
        unset($data['mode']);
        $success=$this->chart_of_accounts_model->save($data);
        $data["success"]=$success;
        $data["message"]=$success?"Data sudah disimpan":mysql_error();
        echo json_encode($data);
		
    }    
    function save_group(){
        $data=$this->input->post();
        unset($data['mode_group']);
        $success=$this->gl_report_groups_model->save($data);
        $data["success"]=$success;
        $data["message"]=$success?"Data sudah disimpan":mysql_error();
        echo json_encode($data);
    }
	function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
    	$data['account_type_list']=$this->chart_of_accounts_model->account_type_list();
		$data['group_type_list']=$this->chart_of_accounts_model->group_type_list();
        $data['account_type']='';
        $data['group_type']='';
        $data['h_or_d']='0';
		if($record==NULL){
			$data['account']='';
			$data['account_description']='';
			$data['db_or_cr']='';
			$data['h_or_d']='';
			$data['beginning_balance']='0';
		} else {
			$data['account']=$record->account;
			$data['account_description']=$record->account_description;
			$data['db_or_cr']=$record->db_or_cr;
			$data['beginning_balance']=$record->beginning_balance;
            $data['account_type']=$record->account_type;
            $data['group_type']=$record->group_type;
		}
		return $data;
	}
	function get_posts(){
		$data['mode']=$this->input->post('mode');
		$data['account_type']=$this->input->post('account_type');
		$data['group_type']=$this->input->post('group_type');
		$data['account']=$this->input->post('account');
		$data['account_description']=$this->input->post('account_description');
		$data['db_or_cr']=$this->input->post('db_or_cr');
		$data['h_or_d']=$this->input->post('h_or_d');
		$data['beginning_balance']=$this->input->post('beginning_balance');
        return $data;
	}        
    function _set_rules(){	
		 $this->form_validation->set_rules('account_type','Account Type', 'required|trim');
		 $this->form_validation->set_rules('group_type','Group Type', 'required');
		 $this->form_validation->set_rules('account','Account', 'required|trim');
	}
    function delete($id){
		if(!allow_mod2('_10013'))return false;   
		$id=urldecode($id);
	 	$ret=$this->chart_of_accounts_model->delete($id);
		$this->syslog_model->add($id,"coa","delete");
	 	echo json_encode(array("message"=>$ret?"Berhasil dihapus, silahkan refresh":"Gagal"));
	}
    function delete_group($id){
        if(!allow_mod2('_10013'))return false;   
        $id=urldecode($id);
        $ret=$this->gl_report_groups_model->delete($id);
        $this->syslog_model->add($id,"coa_group","delete");
        //$this->browse();
        echo json_encode(array("message"=>$ret?"Berhasil dihapus, silahkan refresh":"Gagal"));
    }
    
	function view($id,$message=null){
		if(!allow_mod2('_10010'))return false;   
		$id=urldecode($id);
		$message=urldecode($message);
		 $data['id']=$id;
		 $rst=$this->chart_of_accounts_model->get_by_account_id($id)->row();
		 if(count($rst)){
            $data=$this->set_defaults($rst);
            $data['db_or_cr']=$rst->db_or_cr;
            $data['h_or_d']='1';
         }
		 $data['mode']='view';
         $data['message']=$message;
         $data['account_type_list']=$this->chart_of_accounts_model->account_type_list();
		 $data['group_type_list']=$this->chart_of_accounts_model->group_type_list();
		          
         $this->template->display_form_input($this->file_view,$data,'');
	}        
	function update()
	{
		 $data=$this->set_defaults();
		 $this->_set_rules();
 		 $id=$this->input->post('account');
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts(); 
			unset($data['h_or_d']);                     
			$this->chart_of_accounts_model->update($id,$data);
            $message='Update Success';
			$this->syslog_model->add($id,"coa","edit");

            $this->browse();
		} else {
			$message='Error Update';
     		$this->view($id,$message);		
		}	  	
	}        
	function select($search=''){

        $search=urldecode($search);
        $sql=$this->sql;

        if($search!=""){
            $sql.=" where (account like '$search%' 
                or account_description like '$search%')";
        }
        $sql.=" order by account";

        $offset=0; $limit=10;
        if($this->input->post("page"))$offset=$this->input->post("page");
        if($this->input->post("rows"))$limit=$this->input->post("rows");
        if($offset>0)$offset--;
        $offset=$limit*$offset;
        $sql.=" limit $offset,$limit";        
        
        echo datasource($sql);
            
	}
	function card($account_id) {
	{
		$account_id=urldecode($account_id);
		$account_id=$this->chart_of_accounts_model->get_by_id($account_id)->row()->id;
		$date_from= $this->input->get('d1');
		$date_from=  date('Y-m-d H:i:s', strtotime($date_from));
		$date_to= $this->input->get('d2');
		$date_to = date('Y-m-d H:i:s', strtotime($date_to));
		
		$sql="select sum(debit)-sum(credit) as saldo  
			from gl_transactions 
			where account_id='$account_id' 
			and date<'$date_from'";

        $query=$this->db->query($sql);
		$awal=$query->row()->saldo;
		$rows[0]=array("gl_id"=>"SALDO","date"=>"SALDO","source"=>"SALDO","debit"=>0,"credit"=>0,
			"operation"=>'SALDO',"saldo"=>number_format($awal));

		$sql="select gl_id,date,source,debit,credit,operation 
			from gl_transactions 
			where account_id='$account_id' 
			and date between '$date_from' and '$date_to' order by date";
		
	 
		
        $query=$this->db->query($sql);
		 
        $i=1;
		if($query)foreach($query->result_array() as $row) {
			$awal=$awal+$row['debit']-$row['credit'];
			$row['debit']=number_format($row['debit']);
			$row['credit']=number_format($row['credit']);
			$row["saldo"]=number_format($awal);
			$rows[]=$row;
		};	
        $data['total']=count($rows);
        $data['rows']=$rows;
                    
        echo json_encode($data);

	}

	
	
	}
	
    function loadlist($coa_type) {
        $acc_exist=array();             
        $group_exist=array();
        $rows=array();        
        $qactp=$this->db->where("account_type_num",$coa_type)
            ->order_by("account_type_num")->get("chart_of_account_types");
        foreach($qactp->result() as $ractp){
                
            
            $qgrp1=$this->db->where("account_type",$ractp->account_type_num)
            ->where("parent_group_type","0")
            ->order_by("group_type")
            ->get("gl_report_groups");

            $rgrp1_dat=array();
            foreach($qgrp1->result() as $rgrp1){
                $group_exist[]=$rgrp1->group_type;
                
                $qgrp2=$this->db->where("account_type",$ractp->account_type_num)
                ->where("parent_group_type",$rgrp1->group_type)
                ->order_by("group_type")
                ->get("gl_report_groups");
                
                $rgrp2_dat=array();
                foreach($qgrp2->result() as $rgrp2){
                    $group_exist[]=$rgrp2->group_type;
                    
                    $qgrp3=$this->db->where("account_type",$ractp->account_type_num)
                    ->where("parent_group_type",$rgrp2->group_type)
                    ->order_by("group_type")
                    ->get("gl_report_groups");
                    
                    $rgrp3_dat=array();
                    foreach($qgrp3->result() as $rgrp3){
                        $group_exist[]=$rgrp3->group_type;
                        
                        $rgrp3_dat[]=array('id'=>"G_".$rgrp3->group_type,
                        'text'=>"$rgrp3->group_type - $rgrp3->group_name - (G3)");
                        
                    }
                    
                    $qcoa1=$this->db->where("group_type",$rgrp2->group_type)
                        ->order_by("account")->get("chart_of_accounts");
                    foreach($qcoa1->result() as $rcoa1){
                        $rgrp3_dat[]=array('id'=>"A_".$rcoa1->account,
                            'text'=>"$rcoa1->account - $rcoa1->account_description - (A),  ".number_format($rcoa1->beginning_balance));
                        $acc_exist[]=$rcoa1->account;
                    }
                    
                    $rgrp2_dat[]=array('id'=>"G_".$rgrp2->group_type,
                        'text'=>"$rgrp2->group_type - $rgrp2->group_name - (G2)",
                        "children"=>$rgrp3_dat);
                    
                }
                
                $qcoa1=$this->db->where("group_type",$rgrp1->group_type)
                    ->order_by("account")->get("chart_of_accounts");
                
                foreach($qcoa1->result() as $rcoa1){
                    $rgrp2_dat[]=array('id'=>"A_".$rcoa1->account,
                        'text'=>"$rcoa1->account - $rcoa1->account_description - (A), ".number_format($rcoa1->beginning_balance));
                        $acc_exist[]=$rcoa1->account;
                }
                
                $rgrp1_dat[]=array('id'=>"G_".$rgrp1->group_type,
                    'text'=>"$rgrp1->group_type - $rgrp1->group_name - (G1)",
                    "children"=>$rgrp2_dat);
                
            };
       
            if($rgrp1_dat) { 
                $rows[]=array("id"=>$ractp->account_type_num,
                    "text"=>"$ractp->account_type_num - $ractp->account_type - (T)",
                    "state"=>"open","children"=>$rgrp1_dat);
            }
            
        };
         
        $data[]=array('id'=>'1','text'=>'Root','children'=>$rows);
        
        $s2="";
        for($i=0;$i<count($acc_exist);$i++){
            if($i==0){
                $s2="'$acc_exist[$i]'";
            } else {
                $s2.=",'$acc_exist[$i]'";
            }
        }
        if($s2!=""){
            $s="select account,account_description,id from chart_of_accounts  
                where account not in ($s2) and account_type<>'$coa_type'
                order by account";
            $coa_invalid=array();
            $qcoa=$this->db->query($s);
            foreach($qcoa->result() as $rcoa){
               $coa_invalid[]=array("id"=>"A_".$rcoa->account,
                    "text"=>"$rcoa->account - $rcoa->account_description - (A)");
            }
            
            
        }
        
        $s2="";
        for($i=0;$i<count($group_exist);$i++){
            if($i==0){
                $s2="'$group_exist[$i]'";
            } else {
                $s2.=",'$group_exist[$i]'";
            }
        }
        if($s2!=""){
            $s="select group_type,group_name from gl_report_groups  
                where group_type not in ($s2) and account_type<>'$coa_type' 
                order by group_type";
            $group_invalid=array();
            $qgroup=$this->db->query($s);
            foreach($qgroup->result() as $rgroup){
               $group_invalid[]=array("id"=>"G_".$rgroup->group_type,
                    "text"=>"$rgroup->group_type - $rgroup->group_name - (G)");
            }
        }
        
        //$data[]=array('id'=>'2','text'=>'Invalid Coa','children'=>$coa_invalid);
        //$data[]=array('id'=>'3','text'=>'Invalid Group','children'=>$group_invalid);
        echo json_encode($data);
    }	
	function find($account){
	    $data=(array)$this->db->where("account",$account)->get("chart_of_accounts")->row();
        echo json_encode($data);
	}
    function find_group($group_type){
        $data=(array)$this->db->where("group_type",$group_type)->get("gl_report_groups")->row();
        echo json_encode($data);
    }
function import_excel(){
    $p=$this->input->post();
   
    
        $c_kode=$this->input_col('account');
        $c_nama=$this->input_col('account_description');
        $c_jenis=$this->input_col('jenis');
        $c_group=$this->input_col('group_type');
        $c_account_type=$this->input_col('account_type');
        $c_dbcr=$this->input_col('dbcr');
        $c_saldo=$this->input_col('saldo');
        $auto_create_type=$this->input->post('auto_create_type');
        $auto_create_group=$this->input->post('auto_create_group');
        $hapus_dulu=$this->input->post('hapus_dulu');
        
        if($hapus_dulu=="1"){$hapus_dulu=true;} else {$hapus_dulu=false;}    
        if($auto_create_group=="1"){$auto_create_group=true;} else {$auto_create_group=false;}
        if($auto_create_type=="1"){$auto_create_type=true;} else {$auto_create_type=false;}
        
        if($c_jenis==0){echo "Isi kolom jenis !! Silahkan kembali back...";exit;}
        if($c_group==0){echo "Isi kolom group !! Silahkan kembali back...";exit;}
        if($c_account_type==0){echo "Isi kolom type !! Silahkan kembali back...";exit;}

        $filename=$_FILES["file_excel"]["tmp_name"];
        
        if($_FILES["file_excel"]["size"] > 0)
        {
            $file = fopen($filename, "r");
            $i=0;
            $ok=false;
            $this->db->trans_begin();
            
            if($hapus_dulu) $this->clear_coa();
            
            while (($emapData = fgetcsv($file, 10000, chr(9))) !== FALSE)
            {
               //echo "<br>".var_dump($emapData);
                //exit();
                $kode=$emapData[$c_kode];
                $jenis="D";
                if($c_jenis>0)$jenis=$emapData[$c_jenis];
                
                if(! ($kode == null or $kode == "" or $kode == "kode" ) ) {
                        
                    $i++;
                    
                    if ($jenis=="H"){
                        $data_g["group_type"]=$kode;
                        $data_g["group_name"]=$emapData[$c_nama];
                        $data_g["account_type"]=$emapData[$c_account_type];
                        $data_g["parent_group_type"]=$emapData[$c_group];
                        $data_g["company_code"]=cid();
                        if($data_g['parent_group_type']=='')$data_g['parent_group_type']=0;
                        $ok=$this->gl_report_groups_model->save($data_g)==1;
                                                
                    } else if ($jenis=="T"){
                        $data_t["account_type_numx"]=$kode;
                        $data_t["account_type"]=$emapData[$c_nama];
                        //$ok=$this->chart_of_accounts_model->save_account_type($data_t)==1;
                        
                    } else if($jenis=="D"){
                        $data["account"]=$kode;
                        $data["account_description"]=$emapData[$c_nama];
                        $data["account_type"]=$emapData[$c_account_type];
                        $data["group_type"]=$emapData[$c_group];
                        $data["db_or_cr"]=$emapData[$c_dbcr];
                        $data["beginning_balance"]=$emapData[$c_saldo];                        
                        $data["company_code"]=cid();
                        $ok=$this->chart_of_accounts_model->save($data)==1;
                    } else {
                        echo "<br>Unknown jenis: $jenis";
                    }
                }
            }
            if ($this->db->trans_status() === FALSE)
            {
                echo "Error: Row $i : ".$item_no." : ".$this->db->display_error()."</br>";
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_commit();
            }           
            fclose($file);
            if ($ok){echo json_encode(array("success"=>true));} else {echo json_encode(array('msg'=>'Some errors occured.'));}      
        }
        echo "<div class='alert alert-success'><h1>FINISH</h1>
        Selanjutnya silahkan diperiksa dan diseting ulang link accountnya di menu setting.</div>";
    }
    function import(){
        $data['caption']="IMPORT DATA MASTER COA";
        $this->template->display("gl/import_master",$data);
    }    
    function clear_coa(){
        $this->db->query("delete from chart_of_accounts");
        $this->db->query("delete from gl_report_groups");
    }
    function input_col($colname){
        $c=0;
        if($this->input->post($colname)!=""){
            $c=65-ord(strtoupper($this->input->post($colname)));
        }
        return abs($c);
    }
    
}
