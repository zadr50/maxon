<?php
class Table_model extends CI_Model {

	private $primary_key='';
	private $table_name='';
	public $fields=null;

	function __construct(){
		parent::__construct();        
	}
	function check_tables(){
		$this->Anggota();
		$this->KelompokAnggota();
		$this->JenisPinjaman();
		$this->JenisSimpanan();
		$this->Petugas();	
		$this->Pinjaman();
		$this->Simpanan();
		$this->Tabungan();
		$this->Cicilan();
		$this->CicilanBayar();
	}
	function CicilanBayar() {
		$this->table_name="kop_cicilan_bayar";
		$this->primary_key="id";
		$fields[]=array('name'=>'no_anggota','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'no_pinjaman','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'bulan_ke','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		$fields[]=array('name'=>'tanggal_bayar','type'=>'datetime','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'tanggal_tagih','type'=>'datetime','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'tagihan','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'bayar','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'denda','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'admin','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'payment_no','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>250,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	
	function Cicilan() {
		$this->table_name="kop_cicilan";
		$this->primary_key="id";
		$fields[]=array('name'=>'no_pinjaman','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'no_urut','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		$fields[]=array('name'=>'tanggal_tagih','type'=>'datetime','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'tanggal_jth_tempo','type'=>'datetime','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'awal','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'pokok','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'bunga','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'angsuran','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'akhir','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'payment_no','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>250,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	
	function Tabungan() {
		$this->table_name="kop_tabungan";
		$this->primary_key="id";
		$fields[]=array('name'=>'no_rekening','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'no_anggota','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'nama','type'=>'nvarchar','size'=>150,'caption'=>"nomor",'control'=>'text');
		$fields[]=array('name'=>'tanggal','type'=>'datetime','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'sandi','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'jumlah','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'jumlah_admin','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'jumlah_setor','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'jenis_setor','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'ref1','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'voucher_kas','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'saldo','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'petugas','type'=>'nvarchar','size'=>150,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'catatan','type'=>'nvarchar','size'=>250,'caption'=>"nomor",'control'=>'text');
		
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function Simpanan() {
		$this->table_name="kop_simpanan";
		$this->primary_key="nomor";
		$fields[]=array('name'=>'nomor','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'kode_anggota','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'nama','type'=>'nvarchar','size'=>150,'caption'=>"nomor",'control'=>'text');
		$fields[]=array('name'=>'jenis_simpanan','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'tanggal_daftar','type'=>'datetime','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'setor_awal','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'setor_admin','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'setor_total','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'catatan','type'=>'nvarchar','size'=>250,'caption'=>"nomor",'control'=>'text');
		$fields[]=array('name'=>'voucher','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'deposito_jangka','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'deposito_percent','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function Pinjaman() {
		$this->table_name="kop_pinjaman";
		$this->primary_key="no_anggota";
		$fields[]=array('name'=>'no_pinjaman','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'no_anggota','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'nama','type'=>'nvarchar','size'=>150,'caption'=>"nomor",'control'=>'text');
		$fields[]=array('name'=>'jenis_pinjaman','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'tanggal','type'=>'datetime','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'tanggal_tempo','type'=>'datetime','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'no_simpanan','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'jumlah','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'bunga_prc','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'provisi_prc','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'resiko_prc','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'angsur_pokok','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'angsur_bunga','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'angsuran','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'jangka_waktu','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>250,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function Petugas() {
		$this->table_name="kop_petugas";
		$this->primary_key="nip";
		$fields[]=array('name'=>'nip','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'nama','type'=>'nvarchar','size'=>150,'caption'=>"nomor",'control'=>'text');
		
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	
	function JenisSimpanan() {
		$this->table_name="kop_jenis_simpanan";
		$this->primary_key="nama";
		$fields[]=array('name'=>'nama','type'=>'nvarchar','size'=>150,'caption'=>"nomor",'control'=>'text');
		$fields[]=array('name'=>'jenis','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'jangka_waktu','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'keterangan','type'=>'nvarchar','size'=>250,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'bunga_prc','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');

		$fields[]=array('name'=>'coa_ag_kas','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_ag_simpanan','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_ag_admin','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_ag_beban_bunga','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');

		$fields[]=array('name'=>'coa_nag_kas','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_nag_simpanan','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_nag_admin','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_nag_beban_bunga','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		

		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	
	function create_table($table_name,$fields,$primary_key) {
		$table_name=strtolower($table_name);
		$this->load->dbforge();
		if(!$this->db->table_exists($table_name)){	
			foreach($fields as $fld){
				$size="";$type=$fld['type'];
				if($fld['type']=="nvarchar"){
					$size="(".$fld['size'].")";
					if($size=="0")$size="50";
				}
				if($fld['name']=="id"){
					$type="";
				} else {
					$type =" ".$type.' '.$size;
				}
				$this->dbforge->add_field($fld['name'].$type);
			}
			if ($primary_key <>"id") $this->dbforge->add_key($primary_key,TRUE);
			$this->dbforge->create_table($table_name);
			//echo($table_name." created.<br>");
		} else {
			//show_error($table_name." exist.");			
		}
	}
	function JenisPinjaman() {
		$this->table_name="kop_jenis_pinjaman";
		$this->primary_key="nama";
		$fields[]=array('name'=>'nama','type'=>'nvarchar','size'=>150,'caption'=>"nomor",'control'=>'text');
		$fields[]=array('name'=>'periode','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'custom_hari','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'jenis_bunga','type'=>'nvarchar','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'bunga_prc','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'resiko_prc','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'provisi_prc','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'angsuran','type'=>'double','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'angsuran_kali','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'loan_count','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');

		$fields[]=array('name'=>'coa_ag_kas','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_ag_piutang','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_ag_jasa','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_ag_provisi','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_ag_denda','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_ag_resiko','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_ag_admin','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');

		$fields[]=array('name'=>'coa_nag_kas','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_nag_piutang','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_nag_jasa','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_nag_provisi','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_nag_denda','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_nag_resiko','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'coa_nag_admin','type'=>'int','size'=>50,'caption'=>"nama",'control'=>'text');

		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function KelompokAnggota() {
		$this->table_name="kop_kelompok";
		$this->primary_key="kode";
		$fields[]=array('name'=>'kode','type'=>'nvarchar','size'=>50,'caption'=>"nomor",'control'=>'text');
		$fields[]=array('name'=>'kelompok','type'=>'nvarchar','size'=>250,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
	function Anggota() {
		$this->table_name="kop_anggota";
		$this->primary_key="no_anggota";
		$fields[]=array('name'=>'no_anggota','type'=>'nvarchar','size'=>50,'caption'=>"nomor",'control'=>'text');
		$fields[]=array('name'=>'nama','type'=>'nvarchar','size'=>250,'caption'=>"nama",'control'=>'text');
		$fields[]=array('name'=>'group_type','type'=>'nvarchar','size'=>50,'caption'=>"group type",'control'=>'text');
		$fields[]=array('name'=>'street','type'=>'nvarchar','size'=>250,'caption'=>"street",'control'=>'text');
		$fields[]=array('name'=>'suite','type'=>'nvarchar','size'=>250,'caption'=>"suite",'control'=>'text');
		$fields[]=array('name'=>'state','type'=>'nvarchar','size'=>100,'caption'=>"state",'control'=>'text');
		$fields[]=array('name'=>'city','type'=>'nvarchar','size'=>100,'caption'=>"city",'control'=>'text');
		$fields[]=array('name'=>'zip_postal_code','type'=>'nvarchar','size'=>50,'caption'=>"zip_postal_code",'control'=>'text');
		$fields[]=array('name'=>'region','type'=>'nvarchar','size'=>100,'caption'=>"region",'control'=>'text');
		$fields[]=array('name'=>'country','type'=>'nvarchar','size'=>100,'caption'=>"country",'control'=>'text');
		$fields[]=array('name'=>'email','type'=>'nvarchar','size'=>250,'caption'=>"email",'control'=>'text');
		$fields[]=array('name'=>'phone','type'=>'nvarchar','size'=>50,'caption'=>"phone",'control'=>'text');
		$fields[]=array('name'=>'other_phone','type'=>'nvarchar','size'=>250,'caption'=>"other_phone",'control'=>'text');
		$fields[]=array('name'=>'id_type','type'=>'nvarchar','size'=>50,'caption'=>"id type",'control'=>'text');
		$fields[]=array('name'=>'id_card','type'=>'nvarchar','size'=>150,'caption'=>"id card",'control'=>'text');
		$fields[]=array('name'=>'id_expire','type'=>'nvarchar','size'=>100,'caption'=>"id expire",'control'=>'text');
		$fields[]=array('name'=>'religion','type'=>'nvarchar','size'=>100,'caption'=>"religion",'control'=>'text');
		$fields[]=array('name'=>'join_date','type'=>'datetime','size'=>50,'caption'=>"join date",'control'=>'date');
		$fields[]=array('name'=>'birth_place','type'=>'nvarchar','size'=>250,'caption'=>"birth place",'control'=>'text');
		$fields[]=array('name'=>'birth_date','type'=>'date','caption'=>"country",'control'=>'text');
		$fields[]=array('name'=>'nama_pasangan','type'=>'nvarchar','size'=>250,'caption'=>"country",'control'=>'text');
		$fields[]=array('name'=>'job','type'=>'nvarchar','size'=>250,'caption'=>"country",'control'=>'text');
		$fields[]=array('name'=>'penghasilan','type'=>'double','size'=>250,'caption'=>"country",'control'=>'text');
		$fields[]=array('name'=>'perusahaan','type'=>'nvarchar','size'=>250,'caption'=>"perusahaan",'control'=>'text');
		$fields[]=array('name'=>'alamat_kantor','type'=>'nvarchar','size'=>250,'caption'=>"alamat kantor",'control'=>'text');
		$fields[]=array('name'=>'comments','type'=>'nvarchar','size'=>250,'caption'=>"comments",'control'=>'text');
		$fields[]=array('name'=>'petugas','type'=>'nvarchar','size'=>50,'caption'=>"petugas",'control'=>'text');
		$fields[]=array('name'=>'active','type'=>'int','size'=>50,'caption'=>"active",'control'=>'text');
		$fields[]=array('name'=>'status_member','type'=>'nvarchar','size'=>50,'caption'=>"status member",'control'=>'text');
		$fields[]=array('name'=>'jenis_kelamin','type'=>'nvarchar','size'=>50,'caption'=>"jenis kelamin",'control'=>'text');
		$fields[]=array('name'=>'photo','type'=>'nvarchar','size'=>250,'caption'=>"photo",'control'=>'text');
		$fields[]=array('name'=>'id','type'=>'int','size'=>0,'caption'=>"id",'control'=>'text');
		
		$this->create_table($this->table_name,$fields,$this->primary_key);
		return $fields;
	}
		
}


