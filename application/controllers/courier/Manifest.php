<?php
if(!defined('BASEPATH')) exit('No direct script access allowd');

class Manifest extends CI_Controller {
    private $limit=100;
    private $table_name='manifest';
    private $file_view='courier/manifest';
    private $controller='courier/manifest';
    private $primary_key='code';
    private $sql="";
	private $title="DAFTAR MANIFEST PENGIRIMAN";
	private $help="";

    function __construct()    {
		parent::__construct();
		if(!$this->access->is_login())redirect(base_url());
		$this->load->helper(array('url','form','mylib_helper'));
        $this->load->model(array('customer_model',
            'courier/tarif_model','courier/booking_dom_model',
            'courier/manifest_model'));
        
		$this->load->library(array('sysvar','template','form_validation'));

		$this->sql="select m.* from manifest m";
		if($this->help=="")$this->help=$this->table_name;
    }
	function nomor_bukti($add=false) {
		$key="Manifest Numbering";
		if($add){
		  	$this->sysvar->autonumber_inc($key);
		} else {			
			$no=$this->sysvar->autonumber($key,0,'!MF~$000001');
			for($i=0;$i<100;$i++){			
				$no=$this->sysvar->autonumber($key,0,'!MF~$000001');
				$rst=$this->manifest_model->get_by_id($no)->row();
				if($rst){
				  	$this->sysvar->autonumber_inc($key);
				} else {
					break;					
				}
			}
			return $no;
		}
	}

	
    function set_defaults($record=NULL){
		$data['mode']='';
		$data['message']='';
        
		$data=data_table($this->table_name,$record);
        if($data['ship_via']=="")$data["ship_via"]="Darat";
        $data['mode']='add';
        $data['title']=$this->title;
        $data['help']=$this->help;
        $data['message']='';
        $data['form_controller']=$this->controller;
        $data['field_key']=$this->primary_key;
		if($record) {
            $data['update_by']=user_id();
            $data['update_date']=date("Y-m-d H:i:s");            
		} else {
            $data['code']="AUTO";
            $data['date_mf']=date("Y-m-d H:i:s");
            $data['create_by']=user_id();
            $data['create_date']=$data['date_mf'];
            $data['date_go']=date("Y-m-d H:i:s");
            $data['date_to']=date("Y-m-d H:i:s");
            
		}
        $data['lov_kendaraan']=$this->list_of_values->render(
            array("dlgBindId"=>"kendaraan",
                "dlgRetFunc"=>"$('#plat_no').val(row.nomor_plat);",
                "dlgCols"=>array(
                    array("fieldname"=>"nomor_plat","caption"=>"Plat No","width"=>"100px"),
                    array("fieldname"=>"nama_supir","caption"=>"Supir","width"=>"100px")
                    
                    )
            )
        );        
        $data['lov_person']=$this->list_of_values->render(
            array("dlgBindId"=>"person","sysvar_lookup"=>"person")        
        );
        $data['lov_nama_kapal']=$this->list_of_values->render(
            array("dlgBindId"=>"nama_kapal","sysvar_lookup"=>"nama_kapal")        
        );
        $data['lov_kendaraan']=$this->list_of_values->render(
            array("dlgBindId"=>"kendaraan","sysvar_lookup"=>"kendaraan")        
        );
        
		return $data;
    }
    function index(){
		$this->browse();
    }
    function get_posts(){
		$data=data_table_post($this->table_name);
		return $data;
    }
    function add($ship_type=0)   {
		$data=$this->set_defaults();
        
		$this->_set_rules();
		 if ($this->form_validation->run()=== TRUE){
			$data=$this->get_posts();
            $data['data']=$data;
			$this->manifest_model->save($data);
			$data['message']='update success';
			$data['mode']='view';
			$this->browse();
		} else {
			$data['data']=$data;
			$this->template->display_form_input($this->file_view,$data);			
		}
    }
	function save(){
		$data=$this->input->post();
        $pilih=array();
        if(isset($data['pilih'])){
            $pilih=$data["pilih"];
            unset($data["pilih"]);            
        }
        
		$id=urldecode($data['code']);
		$mode=$data["mode"];	
		unset($data['mode']);
		if($mode=="add"){
		    $data['code']=$this->nomor_bukti(); 
			if($ok=$this->manifest_model->save($data)){
			    $this->nomor_bukti(true);	
                $this->add_item($data["code"],$pilih);   
            }
		} else {
			$ok=$this->manifest_model->update($id,$data);				
		}
		if($ok){
			echo json_encode(array("success"=>true,"code"=>$data["code"]));
		} else {
			echo json_encode(array("msg"=>"Error ".mysql_error()));
		}
		
	}	
    function view($id,$show_tool=true)	{
		$id=urldecode($id);
		$data[$this->primary_key]=$id;
		$model=$this->manifest_model->get_by_id($id)->row();
		$data=$this->set_defaults($model);				
		$data['mode']='edit';
		$data['show_tool']=$show_tool;
		$this->template->display_form_input($this->file_view,$data);
    }
    function _set_rules(){}
    function valid_date($str){
     if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str)){
             $this->form_validation->set_message('valid_date',
             'date format is not valid. yyyy-mm-dd');
             return false;
     } else {
            return true;
     }
    }
   function browse($offset=0,$limit=50,$order_column="",$order_type='asc'){
		if($order_column=="")$order_column=$this->primary_key;
		$data['controller']=$this->controller;
		$data['field_key']=$this->primary_key;
		$data['caption']=$this->title;

		$this->load->library('search_criteria');
		$faa[]=criteria("Pengirim","sid_nama");
		$faa[]=criteria("Dari","sid_date_from","easyui-datetimebox");
		$faa[]=criteria("S/d","sid_date_to","easyui-datetimebox");
		$faa[]=criteria("Nomor Plat","sid_number");
		$data['criteria']=$faa;
		$data['fields_caption']=array('Code','Tanggal','Person','Plat No','Tujuan','Pengirim','Nama Kapal');
		$data['fields']=array('code','date_mf','person','plat_no','tujuan','pengirim','nama_kapal');
		$data['msg_left']="<i>Isi range tanggal pengajuan atau isi nomor pengajuan, lalu klik tombol cari.</i>";
		
        $this->template->display_browse2($data);            
    }
    function browse_data($offset=0,$limit=100,$nama=''){
		$sql=$this->sql." where 1=1";
		$no=urldecode($this->input->get('sid_number'));        
		$d1= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_from')));
		$d2= date( 'Y-m-d H:i:s', strtotime($this->input->get('sid_date_to')));
        $nama=$this->input->post("sid_nama");
		if($no!=''){
			$sql.=" and code='$no";
		} else {
			$sql.=" and date_mf between '$d1' and '$d2' ";
		}
        if($nama!="")$sql.=" pengirim like '$nama%'";
        echo datasource($sql);
    }	   
	function delete($id){
		$id=urldecode($id);
		$ok=$this->manifest_model->delete($id);
        echo json_encode(array("success"=>$ok));
	}
	function find($nomor){
		$nomor=urldecode($nomor);
		$query=$this->db->query("select * from $this->table_name where code='$nomor'");
		echo json_encode($query->row_array());
 	}	
    function booking_unprocess($ship_type=0){
        $s2="and b.ship_type='$ship_type'";
        if($ship_type==3)$s2="";
        $sql="select b.book_no,b.bk_date,b.sender,b.ce_name,b.destination,b.ship_type
        ,b.total_amount as biaya,b.content,b.pcs,b.weight,b.volume,b.dimension
        ,b.book_no as id
        from booking_dom b 
        where (b.status is null or b.status=0)  ".$s2;
        $query=$this->db->query($sql);
        $rows=array();
        if($query){ 
            foreach($query->result_array() as $row){
                if($row){
                    $row["pilih"]="<input type='checkbox' name='pilih[]' 
                        value='".$row['book_no']."' style='width:30px'>";
                    $rows[]=$row;
                }
            };
            
        }
        $data['total']=count($rows);
        $data['rows']=$rows;
        echo  json_encode($data);        
    }

    function booking_unprocess_item($ship_type=0){
        $s2="and b.ship_type='$ship_type'";
        if($ship_type==3)$s2="";
        $sql="select b.book_no,b.bk_date,b.sender,b.ce_name,
        d.item,d.qty,d.weight,d.dimension,d.biaya,d.id,b.destination,b.ship_type 
        from booking_dom_detail d left join booking_dom b on b.book_no=d.book_no 
        where (d.delivered is null)  ".$s2;
        $query=$this->db->query($sql);
        $rows=array();
        if($query){ 
            foreach($query->result_array() as $row){
                if($row){
                    $row["pilih"]="<input type='checkbox' name='pilih[]' 
                        value='".$row['id']."' style='width:30px'>";
                    $rows[]=$row;
                }
            };
            
        }
        $data['total']=count($rows);
        $data['rows']=$rows;
        echo  json_encode($data);        
    }
	function items($cmd="",$id=''){
	    $book_no=$cmd;
		if ($cmd=="save") {
			$this->add_item();
		} else if($cmd=="delete") {
			$this->db->where("id",$id)->delete("manifest_detail");
            $data['success']=true;
            echo json_encode($data);
            
		} else if ($cmd=="view") {
			if($row=$this->db->where("id",$id)
				->get("manifest_detail")->row()){
				$data=(array)$row;
				$data['success']=true;
				echo json_encode($data);
			}				
			
		} else {		    
			$sql="select * from manifest_detail where code_mf = '$book_no'";
			echo datasource($sql);
		}
	}
    function add_item($code_mf,$data){
        $ok=false;
        $tujuan="";             $barang="";         $jumlah=0;    
        $pengirim="";           $biaya=0;           $banyaknya=0;
        for($i=0;$i<count($data);$i++){
            $id=$data[$i];
            $s="select b.content,b.pcs,b.weight,b.book_no,b.bk_date,
            b.sender,b.ce_name,b.origin,b.destination,b.dimension,
            b.total_amount,b.volume,dlv_remarks 
            from booking_dom b where b.book_no='$id'";
            
            if($q=$this->db->query($s)){
                if($row=(Array)$q->row()){
                    $row2["code_mf"]=$code_mf;
                    $row2['jenis_barang']=$row['content'];
                    $row2['volume']=$row['volume'];
                    $row2['book_no']=$row['book_no'];
                    $row2['pengirim']=$row['sender'];
                    $row2['penerima']=$row['ce_name'];
                    $row2['tujuan']=$row['destination'];
                    $row2['banyaknya']=$row['pcs'];
                    $row2['berat']=$row['weight'];
                    $row2['biaya']=$row['total_amount'];
                    $row2['dimension']=$row['dimension'];
                    $row2['notes']=$row['dlv_remarks'];
                    $row2['no_urut']=$i+1;
                    $tujuan.=$row2['tujuan'].",";
                    $pengirim.=$row2['pengirim'].",";
                    $barang.=$row2["jenis_barang"].",";
                    $banyaknya+=$row2["banyaknya"];
                    $biaya+=$row2["biaya"];
                    $jumlah+=$row2["berat"];
                                        
                    $ok=$this->db->insert("manifest_detail",$row2);
                    if($ok){
                        $this->db->where("book_no",$id)->update("booking_dom",array("status"=>1));
                    }
                }
            }
        }
        $this->db->where("code",$code_mf)->update("manifest",array("tujuan"=>$tujuan,
            "pengirim"=>$pengirim,"barang"=>$barang,"banyaknya"=>$banyaknya,
            "jumlah"=>$jumlah,"biaya_kirim"=>$biaya));
        return $ok;
    }
    
	function add_item_3($code_mf,$data){
	    $ok=false;
        $tujuan="";             $barang="";         $jumlah=0;    
        $pengirim="";           $biaya=0;           $banyaknya=0;
	    for($i=0;$i<count($data);$i++){
            $id=$data[$i];
            $s="select d.item,d.qty,d.weight,d.book_no,b.bk_date,
            b.sender,b.ce_name,b.origin,b.destination,d.dimension,
            d.biaya,d.v,d.content 
            from booking_dom_detail d left join booking_dom b on b.book_no=d.book_no 
            where d.id='$id'";
            
            if($q=$this->db->query($s)){
                if($row=(Array)$q->row()){
                    $row2["code_mf"]=$code_mf;
                    $row2['jenis_barang']=$row['item'];
                    $row2['volume']=$row['v'];
                    $row2['book_no']=$row['book_no'];
                    $row2['pengirim']=$row['sender'];
                    $row2['penerima']=$row['ce_name'];
                    $row2['tujuan']=$row['destination'];
                    $row2['banyaknya']=$row['qty'];
                    $row2['berat']=$row['weight'];
                    $row2['biaya']=$row['biaya'];
                    $row2['volume']=$row['v'];
                    $row2['dimension']=$row['dimension'];
                    $row2['notes']=$row['content'];
                    $row2['no_urut']=$i+1;
                    $tujuan.=$row2['tujuan'].",";
                    $pengirim.=$row2['pengirim'].",";
                    $barang.=$row2["jenis_barang"].",";
                    $banyaknya+=$row2["banyaknya"];
                    $biaya+=$row2["biaya"];
                    $jumlah+=$row2["berat"];
                                        
                    $ok=$this->db->insert("manifest_detail",$row2);
                    if($ok){
                        $this->db->where("id",$id)->update("booking_dom_detail",array("delivered"=>1));
                    }
                }
            }
	    }
        $this->db->where("code",$code_mf)->update("manifest",array("tujuan"=>$tujuan,
            "pengirim"=>$pengirim,"barang"=>$barang,"banyaknya"=>$banyaknya,
            "jumlah"=>$jumlah,"biaya_kirim"=>$biaya));
        return $ok;
	}
	function print_nomor($code){
	    $code=urldecode($code);
        $man=$this->manifest_model->get_by_id($code)->row();
        if(!$man){
            echo "<p>Booking [$code] not found !";
            return false;
        }
        $items=$this->manifest_model->items($code);
        $data["manifest"]=$man;
        $data["items"]=$items;
        echo load_view('courier/rpt/manifest',$data);                
	}
	
}
?>
