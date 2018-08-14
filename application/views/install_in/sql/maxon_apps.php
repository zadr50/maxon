<?
$table='maxon_apps'; 
$sql=" 
CREATE TABLE IF NOT EXISTS `".$cid."maxon_apps` (
  `app_name` varchar(200) DEFAULT NULL,
  `app_desc` varchar(200) DEFAULT NULL,
  `app_type` varchar(50) DEFAULT NULL,
  `app_ico` varchar(50) DEFAULT NULL,
  `app_path` varchar(50) DEFAULT NULL,
  `is_core` int(11) DEFAULT '0',
  `is_active` int(11) DEFAULT '0',
  `app_create_by` varchar(50) DEFAULT NULL,
  `app_url` varchar(200) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(50) NOT NULL,
  `app_controller` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;";
if($link->query($sql))echo mysqli_error($link);

$sql="
REPLACE INTO `".$cid."maxon_apps` (`app_name`, `app_desc`, `app_type`, `app_ico`, `app_path`, `is_core`, `is_active`, `app_create_by`, `app_url`, `id`, `app_id`, `app_controller`) VALUES
	('Pembelian', 'Pembuatan purchase order (PO) supplier, beserta pengelolaan hutang dan pelunasan hutang.', 'Modul', 'ico_purchase.png', '', 1, 1, 'andri', 'purchase', 1, '_40000', 'purchase'),
	('Penjualan', 'Pembuatan sales order (SO) pelanggan, pengiriman, kartu piutang sampai pelunasan piutang.', 'Modul', 'ico_sales.png', '', 1, 1, 'andri', 'sales', 2, '_30000', 'sales'),
	('Inventory', 'Pengelolaan data stock meliputi penerimaan, pengeluaran, transfer, adjustment dan lainnya.', 'Modul', 'ico_inventory.png', '', 1, 1, 'andri', 'inventory', 3, '_80000', 'inventory'),
	('Buku Kas', 'Pencatatan kas masuk dan kas keluar diluar pelunasan hutang piutang.', 'Modul', 'ico_bank.png', '', 1, 1, 'andri', 'bank', 4, '_60000', 'bank'),
	('Aktiva Tetap', 'Pengelolaan biaya penyusutan terhadap aktiva tetap seperti gedung, kendaraan dan lainnya', 'Modul', 'ico_asset.png', '', 1, 1, 'andri', '', 5, '_14000', 'aktiva'),
	('Manufacture', 'Proses pembuatan dari mulai bahan baku sampai penerimaan barang jadi di sebuah pabrik.', 'Modul', 'ico_manuf.png', '', 1, 1, 'andri', '', 6, '_11000', 'manuf'),
	('Payroll', 'Pengelollan data pegawai berupa absensi, shift, tunjangan, slip gaji dan lainnya', 'Modul', 'ico_payroll.png', '', 1, 1, 'andri', '', 7, '_12000', 'payroll'),
	('Koperasi', 'Pencatatan anggota koperasi beserta pinjaman, tabungan dan pelunasannya.', 'Modul', 'ico_koperasi.png', '', 1, 1, 'andri', '', 8, '_13000', 'koperasi'),
	('Point Of Sales', 'Modul penjualan tunai / kasir, untuk melayani pelanggan secara cepat', 'Modul', 'ico_pos.png', '', 1, 1, 'andri', '', 9, '_30000.0', 'pos'),
	('Akuntansi', 'Modul buku besar dan jurnal-jurnal yang dihasilkan semua transaksi yang menghasilkan laporan neraca dan rugi laba', 'Modul', 'ico_akun.png', '', 1, 1, 'andri', '', 10, '_10000', 'gl'),
	('Travel Agent', 'Modul untuk usaha travel agent, meliputi jadwal pesawat pembuatan invoice dan pelunasan.', 'Modul', 'office.png', '', 1, 1, 'andri', '', 11, '_21000', 'travel'),
	('Hotel', 'Modul pengelolaan data transaksi untuk usaha hotel dan penginapan.', 'Modul', 'eog.png', '', 1, 1, 'andri', '', 12, '_15000', 'hotel'),
	('Restaurant', 'Modul untuk dipakai di restoran dan rumah makan', 'Modul', 'gazpacho.png', '', 1, 1, 'andri', '', 13, '_16000', 'resto'),
	('Laundry', 'Modul untuk laundry dan pencucian pakaian.', 'Modul', 'glob2-icon-48.png', '', 1, 1, 'andri', '', 14, '_17000', 'laundry'),
	('Leasing', 'Modul untuk usaha leasing dan kredit kendaraan beserta angsurannya', 'Modul', 'gnome-fs-network.png', '', 1, 1, 'andri', '', 15, '_18000', 'leasing'),
	('Sekolah', 'Modul untuk sekolah dan dunia pendidikan.', 'Modul', 'gnome-db.png', '', 1, 1, 'andri', '', 16, '_19000', 'sekolah'),
	('Setting', 'Seting user login, kelompok user atau job dan modul yang boleh di akses.', 'Modul', 'ico_setting.png', '', 1, 1, 'andri', '', 17, '_00000', 'admin'),
	('Website', 'Halaman utama untuk website perusahaan', 'Modul', 'office.png', '', 0, 1, 'andri', '', 18, '_20000', 'website');
";
if($link->query($sql))echo mysqli_error($link);
$sql="
CREATE TABLE IF NOT EXISTS `".$cid."maxon_chat` (
  `userid` varchar(50) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
";
if($link->query($sql))echo mysqli_error($link);
$sql="
REPLACE INTO `".$cid."maxon_chat` (`userid`, `message`) VALUES
	('Guest', 'test'),
	('Guest', 'dfdafsafafdfas');
";
if($link->query($sql))echo mysqli_error($link);
$sql="
CREATE TABLE IF NOT EXISTS `".$cid."maxon_inbox` (
  `rcp_from` varchar(250) DEFAULT NULL,
  `rcp_to` varchar(250) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `is_read` bit(1) DEFAULT NULL,
  `msg_date` datetime DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
";
if($link->query($sql))echo mysqli_error($link);
$sql="
REPLACE INTO `".$cid."maxon_inbox` (`rcp_from`, `rcp_to`, `subject`, `message`, `is_read`, `msg_date`, `id`) VALUES
	('andri', 'admin', 'subject', 'message', NULL, '2014-11-19 16:42:19', 1),
	('andri', 'admin', 'subject', 'message', NULL, '2014-11-19 16:42:22', 2),
	('andri', 'admin', 'subject', 'message', NULL, '2014-11-19 16:47:30', 3),
	('col', 'AdmLs', '14120011-1 - belum tertagih', 'Belum tertagih invoice 14120011-1 janji bayar tanggal 2014-12-29 14:46:57', NULL, '2014-12-29 14:47:02', 34);
";
if($link->query($sql))echo mysqli_error($link);
$sql="	
CREATE TABLE IF NOT EXISTS `".$cid."syslog` (
  `tgljam` datetime DEFAULT NULL,
  `computer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `userid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `logtext` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `tcp_ip` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
if($link->query($sql))echo mysqli_error($link);

?>