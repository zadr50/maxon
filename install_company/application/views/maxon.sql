CREATE TABLE `hr_leaves` (
  `nip` varchar(50) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `leave_type` varchar(50) DEFAULT NULL,
  `leave_day` varchar(50) DEFAULT NULL,
  `reason` varchar(250) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `doc_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping structure for table simak.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `date_post` datetime DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `show_on_top` int(11) DEFAULT NULL,
  `icon_file` varchar(250) DEFAULT NULL,
  `doc_name` varchar(50) DEFAULT NULL,
  `section_name` varchar(50) DEFAULT NULL,
  `class_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.articles: 60 rows
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
REPLACE INTO `articles` (`id`, `title`, `date_post`, `view_count`, `author`, `category`, `content`, `show_on_top`, `icon_file`, `doc_name`, `section_name`, `class_name`) VALUES
	(8, 'EPIP -(Export Import Data)', '2014-12-27 17:58:55', 0, 'Andri', 'clients', '<p>aaaaaaaaaaa</p>\r\n', 0, '', '', NULL, NULL),
	(66, '143434', '2014-12-27 17:58:44', 0, '2', '2', '<p>2fdgsdgdsgsdgfsgfds</p>\r\n', 0, '', '', NULL, NULL),
	(67, '3', '1970-01-01 00:00:00', 0, '3', '23', '<p>333</p>\r\n', 0, '', '', NULL, NULL),
	(68, '3', '1970-01-01 00:00:00', 0, '2', '2', '<p>22</p>\r\n', 0, '', '', NULL, NULL),
	(69, 'Master Supplier', '2015-11-02 00:00:00', 0, 'andri', '0', '<p><strong>Master supplier</strong></p>\r\n\r\n<p>Data master supplier harus anda definisikan terlebih dahulu sebelum membuat transaksi pembelian atau purchase order.</p>\r\n\r\n<p><strong>Supplier Number</strong>, diiisi dengan kode suppleir usahakan singkat tetapi mudah diingat&nbsp;dan hindari tanda baca.</p>\r\n\r\n<p><strong>Supplier Name</strong>, diisi dengan nama supplier atau nama perusahaan supplier atau pemasok barang pembelian.</p>\r\n\r\n<p><strong>Akun Hutang</strong>, dipilih dengan kode akun perkiraan hutang untuk menjurnal transaksi pembelian khusus untuk supplier yang bersangkutan,&nbsp;apabila anda tidak memilih maka akan dipakai akun hutang yang ada diseting global akuntansi.</p>\r\n\r\n<p><strong>Akun Biaya</strong>, dipilih dengan akun biaya untuk mencatat biaya-biaya yang ada didalam pembuatan faktur piutang misalnya ongkos angkut, biaya promosi atau lainnya.</p>\r\n\r\n<p><strong>Kelompok</strong>, dipilih dengan kode kelompok supplier untuk kegunaan laporan atau peringkat supplier</p>\r\n\r\n<p><strong>Termin</strong>, dipilih dengan termin pembelian khusus supplier ini namun apabila anda tidak memilih anda harus memilih termin ketika pembuatan faktur pembelian.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 0, '', 'supplier', '', ''),
	(70, '', '2015-03-03 00:00:00', 0, '', '', '', 0, '', '', NULL, NULL),
	(71, 'Mengapa Belanja di Toko kami', '2015-03-07 00:00:00', 0, NULL, 'eshop', '<h1>Mengapa Belanja di Toko kami?</h1>\r\n\r\n<p>Jutaan produk tersedia dari berbagai online shop. Temukan Produk dari Ribuan Toko / Online Shop terpercaya se Indonesia, dan baca review nya.</p>\r\n\r\n<p><a href="http://tokodemo.maxonerp.com/index.php/eshop/member/add">Daftar Sekarang</a></p>\r\n\r\n<p><a href="http://tokodemo.maxonerp.com/index.php/eshop/help">Pelajari Lebih Lanjut</a></p>\r\n', 0, '', '', 'section-content', 'col-md-6'),
	(72, 'Tranparan dan Aman', '2015-03-07 00:00:00', 0, NULL, 'eshop', '<h1>Transparan</h1>\r\n\r\n<p>Bandingkan review untuk berbagai online shop terpercaya se-Indonesia Belanja Online Aman, Bebas Penipuan.</p>\r\n\r\n<h1>Aman</h1>\r\n\r\n<p>Pembayaran Anda baru diteruskan ke penjual setelah barang Anda terima.</p>\r\n', 0, '', '', 'section-content', 'col-md-6'),
	(73, 'Copyright', '2015-03-07 00:00:00', 0, NULL, 'eshop', '<p><img src="http://tokodemo.maxonerp.com/images/logo_maxon.png" style="float:left; margin:5px" /></p>\r\n\r\n<p>Copyright &copy;2000-2015 Talagasoft Indonesia - Developed &amp; Design by www.talagasoft.com</p>\r\n\r\n<ul>\r\n	<li><a href="http://www.facebook.com/maxon51" target="_new">Facebook MaxOn ERP</a></li>\r\n	<li><a href="http://www.twitter.com/talagasoft" target="_new">Twitter MaxOn ERP</a></li>\r\n	<li><a href="http://forum.maxonerp.com/" target="_new">Forum MaxOn ERP</a></li>\r\n	<li><a href="http://www.talagasoft.com/">Talagasoft Indonesia</a></li>\r\n</ul>\r\n', 0, '', '', 'section-footer', 'col-md-7'),
	(74, '', '2015-03-03 00:00:00', 0, NULL, 'eshop', '', 0, '', '', NULL, NULL),
	(75, '', '2015-03-03 00:00:00', 0, NULL, 'eshop', '', 0, '', '', NULL, NULL),
	(76, '', '2015-03-03 00:00:00', 0, NULL, 'eshop', '', 0, '', '', NULL, NULL),
	(77, '', '2015-03-03 00:00:00', 0, NULL, 'eshop', '', 0, '', '', NULL, NULL),
	(78, '', '2015-03-03 00:00:00', 0, NULL, 'eshop', '', 0, '', '', NULL, NULL),
	(79, '', '2015-03-06 00:00:00', 0, NULL, 'eshop', '', 0, '', '', NULL, NULL),
	(20, 'MdbExecute', '2015-02-17 22:09:22', 0, 'Andri', 'tutorial', '<h1>MDBEXECUTE</h1>\r\n\r\n<p>Download: <a href="http://f.intanhotel.com/mdb.rar">Klik disini</a></p>\r\n\r\n<p>MdbExecute adalah tool command dos untuk membuat exsekusi perintah-perintah sql yang disertakan dalam file sql yang anda buat, bisa juga anda gunakan untuk compact dan backup file Ms Access yang anda miliki.</p>\r\n\r\n<p><strong>Parameter: </strong><br />\r\n- /mdb : untuk menentukan file mdb yang akan di proses<br />\r\n- /sql : untuk menentukan file sql command yang akan di eksekusi<br />\r\n- /user: untuk user bagi file mdb yang di protect<br />\r\n- /pwd : untuk password bagi file mdb yang di protect<br />\r\n- /nomove: agar tool ini memindahkan dan menghapus file mdb diatas<br />\r\n- /compact: agar melakukan proses compact database<br />\r\n<br />\r\n<strong>Contoh penggunaan:</strong><br />\r\nmdb.exe /mdb:data.mdb /sql:kosong.sql /user:admin /pwd:nita /nomove:true<br />\r\nmdb.exe /mdb:data.mdb /compact /user:admin /pwd:nita</p>\r\n', 0, '', '', NULL, NULL),
	(21, 'Depo Gemilang Supermarket', '2012-06-23 00:00:00', NULL, 'Andri', 'clients', '<div align="center">\r\n<p><img src="clients/images/depo2.gif" alt="" width="213" height="144" /></p>\r\n<p>Jl. Mayjen. Sutoyo S No.94/202, Banjarmasin. Kalimantan. Indonesia</p>\r\n<p><strong>Moto</strong></p>\r\n<p>"Lebih Lengkap. Lebih Luas. Lebih Hemat."</p>\r\n<p><strong>Visi</strong></p>\r\n<p>Menjadi Supermarket bahan bangunan terkemuka yang dikenal masyarakat luas serta mampu bersaing secara global</p>\r\n<p><strong>Webiste</strong></p>\r\n<p><a href="http://putragemilangprima.com/">http://putragemilangprima.com/</a></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</div>', 0, 'clients/images/konex2.gif', NULL, NULL, NULL),
	(52, 'Membuat Saldo Awal Hutang', '2013-04-26 00:00:00', NULL, 'Andri', 'triks', '<p>Untuk perusahaan yang sudah berjalan tentu sudah mempunyai saldo awal hutang supplier, anda tidak usah memasukkan semua transaksi faktur-faktur pembelian untuk menciptakan saldo awal hutangnya.</p>\r\n<p>Cara termudah adalah dengan memangkas input faktur-faktur yang lama adalah dengan mencatat saldo akhir hutang masing-masing supplier, dari daftar hutang supplier tersebut silahkan diinput lewat program SIMAK, ikutilah cara-cara dibawah ini:</p>\r\n<ul>\r\n<li>Buatlah master barang dengan kode SALDO kemudian isi deskripsinya SALDO kemudian simpan (Menu-&gt;Inventory-&gt;Barang dan Jasa-&gt;Tambah</li>\r\n<li>Langkah selanjutnya bukan (Menu-&gt;Pembelian-&gt;Faktur Pembelian Kredit-&gt;Tambah)</li>\r\n<li>Isi tanggal saldo awal (misal: 1-Jan-2012) karena kita memulai sistim pada tanggal tersebut</li>\r\n<li>Pilih supplier dari pilihan master supplier yang telah kita buat sebelumnya</li>\r\n<li>Pilih termin (misal:30 Hari)</li>\r\n<li>Selanjutnya pada bagian item detailnya pilih nama barang SALDO</li>\r\n<li>Isi Qty=1 dan Harga diisi sejumlah saldo awal hutang supplier yang bersangkutan</li>\r\n<li>Isi keterangan saldo awal</li>\r\n<li>Terakhir tekan tombol Simpan</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>* Untuk melihat saldo hutang buka menu-&gt;laporan-&gt;pembelian-&gt;supplier-&gt;daftar sisa faktur</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 0, '', NULL, NULL, NULL),
	(22, 'aaaa', '2012-06-06 00:00:00', NULL, 'aaa', 'clients', 'lkdjfalsfdjkfas', 0, 'clients/images/23.jpg', NULL, NULL, NULL),
	(23, 'Multi Home Supermarket Bangunan', '2012-08-29 00:00:00', NULL, 'andri', 'clients', '<h1>HOME MULTI - SUPERMARKET BANGUNAN</h1>\r\n<p>===========================</p>\r\n<p>Jl. Siliwangi - Depok</p>\r\n\r\n<p>Home Multi mempercayakan MyPOS software untuk transaksi kasir yang dapat di pakai secara cepat dan otomatis, juga pencatatan surat jalan, sales order.</p>\r\n\r\n<p>Menggunakan SIMAK Accounting sebagai sarana untuk mencatat purchase order kepada supplier dan partial receive untuk stock management.</p>\r\n\r\nimg src="clients/images/multihome.jpg"/>', 0, '', NULL, NULL, NULL),
	(24, 'Matahari Jaya Supermarket', '2012-11-02 00:00:00', NULL, 'andri', 'news', '<img src="clients/images/matjaya.jpg"/>\r\nGrandopening Matahari Jaya Supermarket Bangunan - Jogjakarta', 0, 'matjaya_icon.jpg', NULL, NULL, NULL),
	(25, 'Multi Home Supermarket Bangunan', '2012-08-29 00:00:00', NULL, 'andri', 'clients', 'Grandopening Matahari Jaya Supermarket Bangunan - Jogjakarta', 0, '', NULL, NULL, NULL),
	(26, 'test', '2012-11-02 00:00:00', NULL, 'test', 'says', 'test1', 0, '', NULL, NULL, NULL),
	(27, 'test2', '2012-11-02 00:00:00', NULL, 'test', 'says', 'test 2', 0, '', NULL, NULL, NULL),
	(28, 'Patch SIMAK Accounting 1', '2013-04-23 00:00:00', NULL, 'Andri', 'soft_patch', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(29, 'Patch SIMAK Accounting 2', '2013-04-23 00:00:00', NULL, 'Andri', 'soft_patch', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(30, 'Patch SIMAK Accounting 3', '2013-04-23 00:00:00', NULL, 'Andri', 'soft_patch', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(31, 'Patch SIMAK Accounting 4', '2013-04-23 00:00:00', NULL, 'Andri', 'soft_patch', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(32, 'Patch SIMAK Accounting 4 bjld kd fkalsdj dflkajdsf sdlkafjslad fkjsdlakfj dskafjdsklafjdslak fjdslafkj', '2013-04-23 00:00:00', NULL, 'Andri', 'soft_patch', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(33, 'Patch SIMAK Accounting 5 bjld kd fkalsdj dflkajdsf sdlkafjslad fkjsdlakfj dskafjdsklafjdslak fjdslafkj', '2013-04-23 00:00:00', NULL, 'Andri', 'soft_patch', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(34, 'Patch SIMAK Accounting 6', '2013-04-23 00:00:00', NULL, 'Andri', 'soft_patch', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(35, 'Patch SIMAK Accounting 7', '2013-04-23 00:00:00', NULL, 'Andri', 'soft_patch', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(36, 'Patch SIMAK Accounting 8', '2013-04-23 00:00:00', NULL, 'Andri', 'soft_patch', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(37, 'Promo 1', '2013-04-23 00:00:00', NULL, 'Andri', 'promo', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(38, 'Triks 1', '2013-04-23 00:00:00', NULL, 'Andri', 'triks', 'Patch kali ini d adlkjfads fkldsjaflsdakf jdsklajfdsaf\r\ndlfkjasdlfkj lkdfjadskf\r\nkldfajsdl fksjjkdfalskfjsadf\r\nldkfajsdflsadfkj \r\nkdlfajdsfl sajflksjflkasfdj as\r\nldkfjasdklfj aslfdk\r\ndklfajsdlfkj \r\nkldjfasdf\r\nkldjfas d\r\ndfassd\r\n', 0, 'ddddd', NULL, NULL, NULL),
	(39, 'guestbook', NULL, NULL, 'guest', 'says', 'dasdfasd', NULL, 'x', NULL, NULL, NULL),
	(40, 'guestbook', NULL, NULL, 'guest', 'says', 'tesatestetastest', NULL, 'x', NULL, NULL, NULL),
	(41, 'guestbook', NULL, NULL, 'guest', 'says', 'testestsatest', NULL, 'x', NULL, NULL, NULL),
	(42, 'guestbook', '2013-04-25 12:31:29', NULL, 'guest', 'says', 'etst', NULL, 'x', NULL, NULL, NULL),
	(43, 'guestbook', '2013-04-25 12:33:18', NULL, 'guest', 'says', ' testtestet test', NULL, 'x', NULL, NULL, NULL),
	(44, 'guestbook', '2013-04-25 12:33:36', NULL, 'guest', 'says', ' halooohaloo2', NULL, 'x', NULL, NULL, NULL),
	(45, 'guestbook', '2013-04-25 12:39:14', NULL, 'andri', 'says', 'halo 2', NULL, 'x', NULL, NULL, NULL),
	(46, 'guestbook', '2013-04-25 12:39:50', NULL, 'ucok', 'says', 'kamana aja???', NULL, 'x', NULL, NULL, NULL),
	(47, 'guestbook', '2013-04-25 12:42:17', NULL, 'aaaa', 'says', 'bbbb', NULL, 'x', NULL, NULL, NULL),
	(48, 'guestbook', '2013-04-25 12:42:26', NULL, 'aaa', 'says', 'aa,bb', NULL, 'x', NULL, NULL, NULL),
	(49, 'guestbook', '2013-04-25 12:42:32', NULL, 'aaa', 'says', 'bb\'bb', NULL, 'x', NULL, NULL, NULL),
	(50, 'guestbook', '2013-04-25 12:42:49', NULL, 'aaaa', 'says', 'aaa\' where', NULL, 'x', NULL, NULL, NULL),
	(51, 'test tinimce', '2013-04-23 00:00:00', NULL, 'Andri', 'triks', '<h1><strong>Halo apa kabar</strong></h1>\r\n<p>&nbsp;</p>\r\n<p>penjelasanan dkfsalfjd slafjkds fjkadsf</p>\r\n<p><em>dfkasjdfl jsaflksja</em></p>\r\n<p><em>dfkjlasjdf sajkfadfs</em></p>\r\n<p>&nbsp;</p>\r\n<p>terimakasih andri</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 0, '', NULL, NULL, NULL),
	(56, 'Software Kasir', NULL, NULL, NULL, 'email_promo', 'MyPOS adalah software kasir  digunakan untuk mencatat nota-nota penjualan secara cepat baik penjualan tunai ataupun kartu kredit. Software ini bisa anda gunakan di toko retail, toko buku, toko komputer, toko kelontong, sembako,salon, restaurant dan lain-lain. Software MyPos telah disesuaikan dengan operasional di kasir yang menuntut kecepatan input transaksi, otomatis dan interface yang menarik dan mudah digunakan. Kunjungi http://www.talagasoft.com', NULL, NULL, NULL, NULL, NULL),
	(55, 'MyPOS Versi Retail', NULL, NULL, NULL, 'email_promo', 'MyPOS adalah software kasir  digunakan untuk mencatat nota-nota penjualan secara cepat baik penjualan tunai ataupun kartu kredit.  Software ini bisa anda gunakan di toko retail, toko buku, toko komputer, toko kelontong, sembako,salon, restaurant dan lain-lain. Software MyPos telah disesuaikan dengan operasional di kasir yang menuntut kecepatan input transaksi, otomatis dan interface yang menarik dan mudah digunakan. Kunjungi http://www.talagasoft.com', NULL, NULL, NULL, NULL, NULL),
	(57, 'Software Untuk Usaha Car Wash', '2013-04-23 01:00:00', NULL, 'Andri', 'Produk', '<p><img src="img/mypos/menu_utama_salon_mobil.gif" alt="MyPOS CarWash" longdesc="MyPOS CarWash" /></p>\r\n<h1>MyPOS - Car Wash</h1>\r\n<p><span style="direction: ltr;">Software MyPOS Car Wash biasanya dipakai untuk jenis &nbsp;usaha pencucian mobil atau motor dan usaha lain yang sejenis. &nbsp;Dengan bantuan software ini dimudahkan untuk mencatat data-data transaksi penjualan melalui nota penjualan, pencatatan dan history kendaraan yang pernah transaksi sehingga memudahkan bagian marketing untuk menggunakan informasi ini, selain itu dengan bantuan software ini perhitungan komisi untuk yang mengerjakan pencucian atau perawat dapat dihasilkan secara lengkap melalui laporan komisinya.</span></p>\r\n<p><span style="direction: ltr;">Fitur lainnya adalah anda bisa secara langsung mengatur pemakaian bahan-bahan atau material pendukung berupa shampo, obat dan lain-laninya lewat seting paket, sehingga program secara otomatis mengurangi stok pemakaian bahannya.</span></p>\r\n<p><span style="direction: ltr;"> &nbsp;</span></p>\r\n<h2><span style="direction: ltr;">Fitur-fitur Umum</span></h2>\r\n<p>&nbsp;</p>\r\n<p>- Cocok untuk jasa salon mobil, pencucian, bengkel dan lain sebagainya</p>\r\n<p>- Skin tampilan menarik dan dapat diubah-ubah sesuai selera.</p>\r\n<p>- Cara pembayaran disediakan 10 macam (Cash, Credit Card, Voucher, OnAccount, Discount,Pembulatan, Debit Card dll)</p>\r\n<p>- Pembayaran dapat dilakukan penggabungan (split payments antara cash atau kartu kredit dan lainnya).</p>\r\n<p>- Support printer kasir (Epson TM,Customer Display, Barcode Scanner, Cash Drawer)</p>\r\n<p>- Hapus item yang telah di order menggunakan password supervisor.</p>\r\n<p>- Ada setting agar Kasir tidak dapat mengubah harga atau discount ketika jualan.</p>\r\n<p>- Laporan-laporan tertentu ada password supervisor atau tidak ditampilkan di menu kasir.</p>\r\n<p>- Seting perangkat flexible, cash drawer, slip printer, customer display, barcode scannder, dll.</p>\r\n<p>- Penomoran untuk nomor bukti fleksible, nomor urut bisa di depan, tengah, di ujung ataupun menggunakan bulan romawi sesuai keinginan user</p>\r\n<p>- Pengelolaan harga jual dan price manager yang dapat mengubah harga secara masalah.</p>\r\n<p>- Program promosi yang flexible dan disediakan 4 macam program promosi. yaitu discount percent, nominal, buy 2 get one, one price, quantity price, dll.</p>\r\n<p>- Ada seting user level yang mengijinkan kasir atau user mengakses menu tertentu.</p>\r\n<p>- Rangkuman penjualan harian kasir atau seluruh kasir.</p>\r\n<p>- Laporan penjualan berdasarkan item barang, service perawatan, kelompok, history service pelanggan atau per kasir.</p>\r\n<p>- Laporan berdasarkan jenis pembayaran tunai, kartu kredit, voucher</p>\r\n<p>- Ada warning apabila input harga jual dibawah harga beli.</p>\r\n<p>- Prose pengeluaran dan pemasukan barang secara langsung ke toko</p>\r\n<p>- Proses backup data secara otomatis harian atau ditentukan oleh user</p>\r\n<p>- Mencetak ulang nota terakhir, misal karena kertas struk di printer habis.</p>\r\n<p>- Kartu stock yang detail diperlukan untuk audit transaksi yang mempengaruhi quantity barang.</p>\r\n<p>- Skin dan tampilan tidak monoton dan dapat diubah oleh user.</p>\r\n<p>- Penyusunan dan formula untuk jasa service yang dapat secara otomatis memotong quantity bahan atau barang tersebut</p>\r\n<p>- Penerimaan dan pengeluan bahan atau barang</p>\r\n<p>- Catatan history data kendaraan dan nomor polisi kendaraan</p>\r\n<p><img src="img/download.png" alt="" /><strong><a href="download.php?f=mypos_carwash_down.php">Download</a></strong></p>\r\n<p>&nbsp;</p>\r\n<h2><strong>Harga Promo Rp. 1,000,000,- (sampai 30-Mei-2014)</strong></h2>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 0, '', NULL, NULL, NULL),
	(58, 'Video Tutorial SIMAK Accounting Software', '2013-05-12 00:00:00', NULL, 'Andri', 'soft_patch', '<h1>Video Tutorial SIMAK Accounting Software</h1>\r\n<p>Berikut ini adalah daftar tutorial pada penggunaan software SIMAK Accounting, yang terdiri dari modul-module penjualan, pembelian, hutang, piutang, stock, buku kas dan akuntansi.</p>\r\n<div class="info3">\r\n<h2>Alur Kerja Untuk Penjualan</h2>\r\n<img src="img/pic_1_2.jpg" alt="" />Tutorial ini akan menunjukkan anda untuk berlatih alur kerja penjualan yang dimulai dari pembuatan so, kemudian pembuatan surat jalan sampai pada akhirnya adalah membuatkan jurnal secara otomatis kedalam modul General Ledger. <br />Alur kerja penjualan ini terbagi menjadi : <br />- Pembuatan Sales Order<a style="direction: ltr;" href="http://youtu.be/jTo7YCjHZpI" target="_blank"> Lihat Video</a>&nbsp; <br />- Modifkasi Format Sales Order dan Export ke XLS<a style="direction: ltr;" href="http://youtu.be/wJs5FJSDWyE" target="_blank"> Lihat Video</a> <br />- Pembayaran DP So dan pembuatan Surat Jalan dan Kartu Stock<a style="direction: ltr;" href="http://youtu.be/DCyfSsGtfCU" target="_blank"> Lihat Video</a>&nbsp;<br />- Pembuatan Faktur atas SO dan Saldo Piutang Faktur<a style="direction: ltr;" href="http://youtu.be/0I1Mkla_cBM" target="_blank"> Lihat Video</a> <br />- Penerimaan Pelunasan atas Piutang Faktur Pelanggan<a style="direction: ltr;" href="http://youtu.be/ByGMfba_1RE" target="_blank"> Lihat Video</a>&nbsp;</div>\r\n<div class="info3">\r\n<h2>Alur Kerja Untuk Pembelian</h2>\r\n<img src="img/pic_1_2.jpg" alt="" />Tutorial ini akan menunjukkan anda untuk berlatih alur kerja pembelian yang dimulai dari pembuatan purchase order, penerimaan barang, pembuatan faktur, pelunasan hutang sampai membuatkan jurnal secara otomatis kedalam modul General Ledger.&nbsp;<br />Alur kerja pembelian ini terbagi menjadi :&nbsp;<br />- Penjelasan Singkat<a style="direction: ltr;" href="http://youtu.be/VCxHlXy9Rxk" target="_blank"> Lihat Video</a>&nbsp;&nbsp;<br />- Pembuatan Master Supplier, Barang, Kategory<a style="direction: ltr;" href="http://youtu.be/0SLP8HgFVTY" target="_blank"> Lihat Video</a>&nbsp;<br />- Termin Pembayaran<a style="direction: ltr;" href="http://youtu.be/U0IHTc5VCfY" target="_blank"> Lihat Video</a><br />- Pembuatan Rekening Bank atau Kas<a style="direction: ltr;" href="http://youtu.be/T48Z4rUp5XU" target="_blank"> Lihat Video</a><br />- Pembuatan Purchase Order dan Design<a style="direction: ltr;" href="http://youtu.be/Olzt-sMqwt0" target="_blank"> Lihat Video</a><br />- Penerimaan Barang dan Kartu Stock<a style="direction: ltr;" href="http://youtu.be/SgeG-InFimk" target="_blank"> Lihat Video</a><br />- Pembuatan Faktur Hutang<a style="direction: ltr;" href="http://youtu.be/OdltZV4gWdg" target="_blank"> Lihat Video</a><br />- Pelunasan Hutang dan Bukti Kas Keluar<a style="direction: ltr;" href="http://youtu.be/SoJOar6wzqo" target="_blank"> Lihat Video</a><br />- Retur Barang dan Debit Memo<a style="direction: ltr;" href="http://youtu.be/MqjVaxEexfE" target="_blank"> Lihat Video</a></div>\r\n<div class="info3">\r\n<h2>Membuat data perusahaan baru</h2>\r\n<img src="img/pic_1_2.jpg" alt="" />Tutorial untuk membuat data perusahaan baru sehingga anda bisa memisah-memisah data untuk masing-masing&nbsp;perusahaan (multi company)\r\n<p align="justify"><a style="direction: ltr;" href="http://youtu.be/ojaSP50RADQ" target="_blank">Lihat Video</a></p>\r\n</div>\r\n<div class="info3">\r\n<h2>Seting Nama Perusahaan</h2>\r\n<img src="img/pic_1_2.jpg" alt="" />Setting untuk nama perusahaan anda sehingga tampil di semua cetakan sebagai header laporan, seting ini meliputi nama, alamat, nomor telp dan lainnya.\r\n<p align="justify"><a style="direction: ltr;" href="http://youtu.be/W0WDMRgoi-g" target="_blank">Lihat Video</a></p>\r\n</div>\r\n<div class="info3">\r\n<h2>Membat Kode Perkiraan / Kode Akun</h2>\r\n<img src="img/pic_1_2.jpg" alt="" />Kode perkiraan adalah seting yang harus pertama kali mendapatkan perhatian sebagai pengguna software SIMAK karena seting ini terintegrasi dengan modul-modul yang lainnya.\r\n<p align="justify"><a style="direction: ltr;" href="http://youtu.be/XlgIhA8EZ9g" target="_blank">Lihat Video</a></p>\r\n</div>\r\n<div class="info3">\r\n<h2>Seting GL Link</h2>\r\n<img src="img/pic_1_2.jpg" alt="" />Seting GL Link adalah akun-akunt penting bagi sistim integerasi SIMAK yang bersangkutan kepada modul-modul pembelian, penjualan, inventory, buku kas.&nbsp;&nbsp; &nbsp;Sehingga semua transaksi tersebut bisa &nbsp;dilakukan posting secara otomatis guna menghasilkan jurnal-jurnal untuk keperluan laporan neraca dan rugi laba.\r\n<p align="justify"><a style="direction: ltr;" href="http://youtu.be/C77IwWXgev0" target="_blank">Lihat Video</a></p>\r\n</div>', 0, '', NULL, NULL, NULL),
	(59, 'guestbook', '2013-08-16 12:26:39', NULL, '', 'says', '', NULL, 'x', NULL, NULL, NULL),
	(60, 'guestbook', '2013-08-16 12:39:19', NULL, 'aa', 'says', 'bbb', NULL, 'x', NULL, NULL, NULL),
	(61, 'guestbook', '2013-08-16 12:40:16', NULL, 'test', 'says', 'test', NULL, 'x', NULL, NULL, NULL),
	(62, 'guestbook', '2013-08-16 12:40:22', NULL, 'etestest', 'says', 'testest', NULL, 'x', NULL, NULL, NULL),
	(63, 'Company 2', '2012-11-02 00:00:00', NULL, 'andri', 'news', '<img src="clients/images/matjaya.jpg"/>', 0, 'matjaya_icon.jpg', NULL, NULL, NULL),
	(64, 'Data Master Debitur', '1970-01-01 00:00:00', 0, 'Andri', 'Leasing', '<p><strong>Data master d</strong>ebitur atau pelanggan adalah blablabla dfadsf</p>\r\n\r\n<p>dfasdfsd asdf a</p>\r\n\r\n<p>dfasdf dsa</p>\r\n\r\n<p>&nbsp;</p>\r\n', 0, '', '', NULL, NULL),
	(65, 'Pengajuan Kredit', '2014-12-10 00:00:00', 0, 'Bagus', '7', '<p>Untuk membuat pengajuan kontrak kredit ikuti langkah sebagai berikut:</p>\r\n\r\n<ul>\r\n	<li>Klik Module Pengajuan</li>\r\n	<li>Klik Tombol Add (+) dan nomor Pengajuan akan terisi otomatis oleh sistem</li>\r\n	<li>Pilih/Cari Debitur yang akan dibuat kontraknya</li>\r\n	<li>Klik&nbsp;Select dengan mengklik nama debitur</li>\r\n	<li>Pilih Counter</li>\r\n	<li>Pilih Tanggal dibuat.</li>\r\n	<li>Kemudian klik tombol save terlebih dahulu</li>\r\n	<li>Setelah data tersimpan cari no pengajuan kredit dengan mengklik tombol search untuk menambahkan barang yg akan di ambil</li>\r\n	<li>Klik&nbsp;edit, kemudian&nbsp;Add dikolom tengah pemilihan barang maka akan muncul data barang dengan mengklik cari dan pilih&nbsp;Barang yang di inginkan kemudian klik Select maka data barang akan terisi otomatis sesuai dengan master</li>\r\n	<li>Klik tombol save untuk menyimpan data, kemudian klik tombol Save yang berada di tab atas untuk menyimpan data keseluruhan.</li>\r\n	<li>&nbsp;</li>\r\n</ul>\r\n', 0, '', 'app_master', NULL, NULL),
	(80, 'Master Barang', '2015-11-02 00:00:00', 0, 'Andri', '0', '<p><strong>Master Barang</strong></p>\r\n\r\n<p>Sebelum melakukan transaksi pembelian ataupun penjualan anda diharuskan membuat master kode barang-barang dagangan atau jasa yang dijual kepada pelanggan atau customer.</p>\r\n\r\n<p><strong>Item Number</strong>, diisi dengan kode atau barcode dari barang tersebut usahakan singkat dan hindari tanda baca pada kode barang.</p>\r\n\r\n<p><strong>Description</strong>, diisi dengan nama barang atau nama jasa maximal 50 karakter.</p>\r\n\r\n<p><strong>Class</strong>, dipilih dengan kelas barang tersebut diantaranya :</p>\r\n\r\n<p>- <em>Stock item</em> yaitu barang-barang stock yang dilakukan transaksi penjualan dan pembelian atau transaksi stock lainnya.</p>\r\n\r\n<p>- <em>Service</em>, yaitu kode ini tidak dipakai dalam stock persediaan karena kode ini termasuk jasa atau layanan.</p>\r\n\r\n<p>- Material, yaitu kode barang ini dipakai sebagai material dalam proses produksi</p>\r\n\r\n<p><strong>Supplier</strong>, dipilih dengan kode supplier yang telah dibuat sebelumnya atau tekan tombol tambah disebelahnya untuk membuat supplier baru.</p>\r\n\r\n<p>&nbsp;<strong>Category</strong>, dipillih dengan kode kelompok barang untuk pengelompokan barang anda bisa membuat kode kategori baru dengan tombol tambah kategori.</p>\r\n\r\n<p><strong>Harga Jual</strong>, diisi dengan harga jual untuk pelanggan isi dengan harga price list.</p>\r\n\r\n<p><strong>Harga Beli</strong>, diisi dengan harga beli yang diberikan oleh supplier atau harga price list supplier.</p>\r\n\r\n<p><strong>Harga Pokok</strong>, anda tidak perlu isi harga pokok ini karena akan dihitung secara otomatis dirata-rata sesuai dengan naik turunkannya harga pembelian barang dari supplier.</p>\r\n\r\n<p>Setelah semua data diinput anda bisa klik tombol <strong>simpan</strong>,</p>\r\n\r\n<p>&nbsp;</p>\r\n', 0, '', 'inventory', '', '');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;


-- Dumping structure for table simak.bank_accounts
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `bank_account_number` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `type_bank` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bank_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `aba_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `routing_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state_province` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip_postal_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `starting_check_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_bank_statement_date` datetime DEFAULT NULL,
  `last_bank_statement_balance` double DEFAULT NULL,
  `account_id` int(50) DEFAULT NULL,
  `micr_line` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `no_bukti_in` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_bukti_out` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`bank_account_number`),
  KEY `x1` (`bank_account_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.bank_accounts: 3 rows
/*!40000 ALTER TABLE `bank_accounts` DISABLE KEYS */;
REPLACE INTO `bank_accounts` (`bank_account_number`, `type_bank`, `bank_name`, `aba_number`, `routing_code`, `street`, `suite`, `city`, `state_province`, `zip_postal_code`, `country`, `contact_name`, `phone_number`, `fax_number`, `starting_check_number`, `last_bank_statement_date`, `last_bank_statement_balance`, `account_id`, `micr_line`, `no_bukti_in`, `no_bukti_out`, `org_id`, `update_status`) VALUES
	('BCA', '0', 'BCA', '', '', '', '', '', '', '', '', '', '', '', '', '2015-11-15 00:00:00', 0, 1485, '', '', '', '', ''),
	('CASH', '1', 'CASH', '', '', '', '', '', '', '', '', '', '', '', '', '2015-11-15 00:00:00', 0, 1370, '', '', '', '', ''),
	('aaa', '0', 'bbbb', '', '', '0', '', '0', '', '', '', '', '0', '', '', '2015-11-15 00:00:00', 0, 1495, '', '', '', '', '');
/*!40000 ALTER TABLE `bank_accounts` ENABLE KEYS */;


-- Dumping structure for table simak.bill_detail
CREATE TABLE IF NOT EXISTS `bill_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `tgl_jatuh_tempo` datetime DEFAULT NULL,
  `curr_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.bill_detail: 0 rows
/*!40000 ALTER TABLE `bill_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `bill_detail` ENABLE KEYS */;


-- Dumping structure for table simak.bill_header
CREATE TABLE IF NOT EXISTS `bill_header` (
  `bill_id` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `customer_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.bill_header: 0 rows
/*!40000 ALTER TABLE `bill_header` DISABLE KEYS */;
/*!40000 ALTER TABLE `bill_header` ENABLE KEYS */;


-- Dumping structure for table simak.branch
CREATE TABLE IF NOT EXISTS `branch` (
  `branch_code` varchar(15) CHARACTER SET utf8 NOT NULL,
  `branch_name` varchar(50) DEFAULT NULL,
  `address_type` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `attention_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `other_phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`branch_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table simak.branch: 3 rows
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
REPLACE INTO `branch` (`branch_code`, `branch_name`, `address_type`, `attention_name`, `company_name`, `street`, `suite`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `other_phone`, `comments`, `update_status`) VALUES
	('KRW', 'KARAWANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CWG', 'CAWANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PST', 'PUSAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;


-- Dumping structure for table simak.budget
CREATE TABLE IF NOT EXISTS `budget` (
  `account_id` int(11) DEFAULT NULL,
  `budget_year` int(11) DEFAULT NULL,
  `january` double DEFAULT NULL,
  `february` double DEFAULT NULL,
  `march` double DEFAULT NULL,
  `april` double DEFAULT NULL,
  `may` double DEFAULT NULL,
  `june` double DEFAULT NULL,
  `july` double DEFAULT NULL,
  `august` double DEFAULT NULL,
  `september` double DEFAULT NULL,
  `october` double DEFAULT NULL,
  `november` double DEFAULT NULL,
  `december` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  KEY `x1` (`account_id`,`budget_year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.budget: 0 rows
/*!40000 ALTER TABLE `budget` DISABLE KEYS */;
/*!40000 ALTER TABLE `budget` ENABLE KEYS */;


-- Dumping structure for table simak.chart_account_link
CREATE TABLE IF NOT EXISTS `chart_account_link` (
  `company_code` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `hutang` int(11) DEFAULT NULL,
  `penerimaan` int(11) DEFAULT NULL,
  `piutang` int(11) DEFAULT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `laba_periode` int(11) DEFAULT NULL,
  `laba_ditahan` int(11) DEFAULT NULL,
  `historical_balancing` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`company_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.chart_account_link: 0 rows
/*!40000 ALTER TABLE `chart_account_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `chart_account_link` ENABLE KEYS */;


-- Dumping structure for table simak.chart_of_accounts
CREATE TABLE IF NOT EXISTS `chart_of_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `account_type` double DEFAULT NULL,
  `group_type` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `group_sequence` double DEFAULT NULL,
  `account` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `account_description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sub_account` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `sub_account_description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `beginning_balance` double DEFAULT NULL,
  `notes` double DEFAULT NULL,
  `db_or_cr` int(11) DEFAULT NULL,
  `flag_archive` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `x1` (`account`),
  KEY `x2` (`account_description`)
) ENGINE=MyISAM AUTO_INCREMENT=1509 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.chart_of_accounts: 72 rows
/*!40000 ALTER TABLE `chart_of_accounts` DISABLE KEYS */;
REPLACE INTO `chart_of_accounts` (`id`, `company_code`, `account_type`, `group_type`, `group_sequence`, `account`, `account_description`, `sub_account`, `sub_account_description`, `beginning_balance`, `notes`, `db_or_cr`, `flag_archive`, `update_status`, `sourceautonumber`, `sourcefile`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	(1370, 'MYPOS', 1, '10000', 0, '11001', 'Cash', '', '', 0, 0, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1373, 'MYPOS', 1, '10000', 0, '13200', 'Piutang Dagang', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1374, 'MYPOS', 1, '11', 0, '13700', 'Persediaan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1375, 'MYPOS', 1, '11', 5, '13800', 'Biaya dibayar dimuka', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1376, 'MYPOS', 1, '12', 0, '15100', 'Tanah', '', '', 0, 0, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1377, 'MYPOS', 1, '12', 0, '15150', 'Gedung', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1378, 'MYPOS', 1, '12', 0, '15151', 'Akumulasi Depr. Gedung', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1379, 'MYPOS', 1, '12', 0, '15200', 'Peralatan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1380, 'MYPOS', 1, '12', 0, '15201', 'Akumulasi Depr. Peralatan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1381, 'MYPOS', 1, '12', 0, '15230', 'Komputer', '', '', 0, 0, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1382, 'MYPOS', 1, '12', 0, '15231', 'Akumulasi Depr. Komputer', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1383, 'MYPOS', 1, '12', 8, '15480', 'Furnitur dan Mebel', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1384, 'MYPOS', 1, '12', 0, '15481', 'Akumulasi Depr.Meubel', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1385, 'MYPOS', 1, '12', 0, '16610', 'Kendaraan dan Truk', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1386, 'MYPOS', 1, '12', 0, '16611', 'Akumulasi Depr. Kendaraan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1393, 'MYPOS', 2, '20000', 0, '21000', 'Hutang Dagang', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1394, 'MYPOS', 2, '21', 2, '21200', 'Hutang (Cicilan)', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1396, 'MYPOS', 2, '21', 4, '21700', 'PPN', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1408, 'MYPOS', 3, '33', 0, '30200', 'Laba (Rugi) ditahan', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1410, 'MYPOS', 3, '33', 0, '30400', 'Modal', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1411, 'MYPOS', 3, '33', 0, '30500', 'Prive', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1415, 'MYPOS', 4, '41', 0, '40005', 'Penjualan', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1416, 'MYPOS', 4, '41', 0, '44000', 'Potongan Penjualan', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1417, 'MYPOS', 4, '41', 0, '45000', 'Ongkos Angkut', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1419, 'MYPOS', 5, '51', 0, '50001', 'Harga Pokok Penjualan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1420, 'MYPOS', 5, '51', 3, '50002', 'Ongkos Angkut Pembelian', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1421, 'MYPOS', 5, '51', 4, '50003', 'Potongan Pembelian', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1423, 'MYPOS', 6, '61', 1, '60100', 'Biaya Administrasi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1424, 'MYPOS', 6, '61', 0, '60110', 'Biaya Iklan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1427, 'MYPOS', 6, '61', 0, '60350', 'Biaya Bank', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1429, 'MYPOS', 6, '61', 7, '60500', 'Biaya Komisi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1430, 'MYPOS', 6, '61', 0, '60600', 'Biaya Konsultasi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1433, 'MYPOS', 6, '61', 11, '60700', 'Biaya Kirim', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1434, 'MYPOS', 6, '61', 0, '60720', 'Biaya Penyusutan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1437, 'MYPOS', 6, '61', 15, '62160', 'Biaya Marketing', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1438, 'MYPOS', 6, '61', 16, '62190', 'Biaya Sewa Perlengkapan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1447, 'MYPOS', 6, '61', 25, '64900', 'Biaya Maintenance dan Perbaikan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1448, 'MYPOS', 6, '61', 0, '64950', 'Biaya Peralatan Kantor', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1449, 'MYPOS', 6, '61', 0, '65250', 'Biaya Gaji', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1450, 'MYPOS', 6, '61', 0, '65400', 'Biaya Promosi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1452, 'MYPOS', 6, '61', 0, '65600', 'Biaya Sewa', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1453, 'MYPOS', 6, '61', 31, '66000', 'Biaya Gaji Bag. Administrasi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1454, 'MYPOS', 6, '61', 32, '66100', 'Biaya Gaji Bag. Sales', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1455, 'MYPOS', 6, '61', 0, '66200', 'Biaya Keamanan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1456, 'MYPOS', 6, '61', 34, '66300', 'Biaya Software', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1457, 'MYPOS', 6, '61', 35, '66350', 'Biaya Perlengkapan Kantor', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1458, 'MYPOS', 7, '71', 0, '66351', 'Biaya Pajak', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1464, 'MYPOS', 6, '61', 0, '66352', 'Biaya Telphone', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1465, 'MYPOS', 6, '61', 43, '66353', 'Biaya Perjalanan Dinas', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1473, 'MYPOS', 1, '10000', 0, '11006', 'BCA Cab. Jakarta', '', '', 0, 0, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1477, 'MYPOS', 1, '11', 0, '14000', 'Uang muka penjualan', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1481, 'MYPOS', 5, '51', 0, '51002', 'Harga Pokok Penjualan Konsinyasi', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1482, 'MYPOS', 4, '41', 0, '46000', 'Lain-lain', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1483, 'MYPOS', 3, '33', 0, '30100', 'Laba (Rugi) berjalan', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1484, 'MYPOS', 8, '81', 0, '81001', 'PPH', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1485, 'MYPOS', 1, '10000', 0, '11002', 'BCA Cab. Bandung', '', '', 0, 0, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1489, 'MYPOS', 6, '61', 0, '66354', 'Biaya Kirim Barang', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1490, 'MYPOS', 1, '10000', 0, '11003', 'Bank Mandiri', '', '', 0, NULL, 1, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1491, 'MYPOS', 1, '11', 0, '19001', 'Ayat Silang', '', '', 0, NULL, 0, b'10000000', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(1492, NULL, 1, '10000', NULL, '11004', 'Bank LIPO', NULL, NULL, 1000000, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1495, NULL, 1, '10000', NULL, '11005', 'Bank BRI', NULL, NULL, 100000, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1498, NULL, 1, '10000', NULL, '13201', 'Piutang Bunga', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1499, NULL, 4, '40000', NULL, '40015', 'Pendapatan Leasing', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1500, NULL, 4, '40000', NULL, '40016', 'Pendapatan Bunga', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1501, NULL, 4, '40000', NULL, '40017', 'Pendapatan Administrasi', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1502, NULL, 4, '40000', NULL, '40018', 'Pendapatan DP Leasing', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1503, NULL, 4, '40000', NULL, '40019', 'Pendapatan Denda Leasing', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1504, NULL, 1, '10000', NULL, '13701', 'Persediaan Barang Leasing', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1505, NULL, 1, '10000', NULL, '13702', 'Persediaan Barang Jadi', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1506, NULL, 1, '10000', NULL, '13703', 'Persediaan Bahan Baku', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1507, NULL, 1, '10000', NULL, '13704', 'Persediaan Waste', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(1508, NULL, 1, '10000', NULL, '13705', 'Persediaan Barang Dlm Produksi', NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `chart_of_accounts` ENABLE KEYS */;


-- Dumping structure for table simak.chart_of_account_types
CREATE TABLE IF NOT EXISTS `chart_of_account_types` (
  `account_type_num` double NOT NULL DEFAULT '0',
  `account_type` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `income_statement_num` int(11) DEFAULT NULL,
  `sub_acc_income` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`account_type_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.chart_of_account_types: 8 rows
/*!40000 ALTER TABLE `chart_of_account_types` DISABLE KEYS */;
REPLACE INTO `chart_of_account_types` (`account_type_num`, `account_type`, `income_statement_num`, `sub_acc_income`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'Aktiva', NULL, NULL, NULL, NULL, NULL),
	(2, 'Hutang', NULL, NULL, NULL, NULL, NULL),
	(3, 'Modal', NULL, NULL, NULL, NULL, NULL),
	(4, 'Pendapatan', NULL, NULL, NULL, NULL, NULL),
	(5, 'Harga Pokok', NULL, NULL, NULL, NULL, NULL),
	(6, 'Biaya', NULL, NULL, NULL, NULL, NULL),
	(7, 'Pendapatan Lain', NULL, NULL, NULL, NULL, NULL),
	(8, 'Baya Lain', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `chart_of_account_types` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer
CREATE TABLE IF NOT EXISTS `check_writer` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `check_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `check_date` datetime DEFAULT NULL,
  `payee` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_amount` double DEFAULT NULL,
  `deposit_amount` double DEFAULT NULL,
  `memo` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `cleared` int(1) DEFAULT NULL,
  `cleared_date` datetime DEFAULT NULL,
  `void` int(1) DEFAULT NULL,
  `print` int(1) DEFAULT NULL,
  `voucher` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `adjustment_dr_account_id` int(11) DEFAULT NULL,
  `adjustment_cr_account_id` int(11) DEFAULT NULL,
  `bill_payment` int(1) DEFAULT NULL,
  `posting_gl_id` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `posted` int(1) DEFAULT NULL,
  `printed` datetime DEFAULT NULL,
  `batch_post` int(1) DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `paymentlineid` int(11) DEFAULT NULL,
  `from_bank` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bank_tran_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `curr_rate_exc` double DEFAULT NULL,
  `curr_code_org` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate_org` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `jenisuangmuka` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sisauangmuka` double DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`trans_id`),
  KEY `x1` (`payee`),
  KEY `x2` (`voucher`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer: 1 rows
/*!40000 ALTER TABLE `check_writer` DISABLE KEYS */;
REPLACE INTO `check_writer` (`trans_id`, `trans_type`, `account_number`, `check_number`, `check_date`, `payee`, `supplier_number`, `payment_amount`, `deposit_amount`, `memo`, `cleared`, `cleared_date`, `void`, `print`, `voucher`, `adjustment_dr_account_id`, `adjustment_cr_account_id`, `bill_payment`, `posting_gl_id`, `posted`, `printed`, `batch_post`, `invoice_number`, `paymentlineid`, `from_bank`, `bank_tran_id`, `curr_code`, `curr_rate`, `curr_rate_exc`, `curr_code_org`, `curr_rate_org`, `org_id`, `update_status`, `jenisuangmuka`, `sisauangmuka`, `sourceautonumber`, `sourcefile`, `update_date`) VALUES
	(1, 'cash in', 'CASH', '', '2016-03-12 00:00:00', 'Adrian', '101', 0, 1000000, '', 0, '2016-03-12 00:00:00', 0, 0, 'KM00005', 0, 0, 0, '', 0, '2016-03-12 00:00:00', 0, '', 0, '', '', '', 0, 0, '', 0, '', 0, '', 0, '', '', '2016-03-12 00:00:00');
/*!40000 ALTER TABLE `check_writer` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_deposit_detail
CREATE TABLE IF NOT EXISTS `check_writer_deposit_detail` (
  `trans_id` int(11) DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `routing_code` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `check_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_deposit_detail: 0 rows
/*!40000 ALTER TABLE `check_writer_deposit_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_writer_deposit_detail` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_items
CREATE TABLE IF NOT EXISTS `check_writer_items` (
  `trans_id` int(11) DEFAULT NULL,
  `trans_type` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `comments` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `account` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `ref1` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_items: 1 rows
/*!40000 ALTER TABLE `check_writer_items` DISABLE KEYS */;
REPLACE INTO `check_writer_items` (`trans_id`, `trans_type`, `line_number`, `account_id`, `amount`, `comments`, `account`, `description`, `update_status`, `sourceautonumber`, `sourcefile`, `update_date`, `invoice_number`, `ref1`) VALUES
	(1, NULL, 1, 1373, 1000000, '', '13200', 'Piutang Dagang', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `check_writer_items` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_print_settings
CREATE TABLE IF NOT EXISTS `check_writer_print_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `check_position` double DEFAULT NULL,
  `check_type` double DEFAULT NULL,
  `paper_type` double DEFAULT NULL,
  `print_all_info` int DEFAULT NULL,
  `print_check_num` int DEFAULT NULL,
  `print_check_stub` int DEFAULT NULL,
  `print_company_info` int DEFAULT NULL,
  `print_bank_info` int DEFAULT NULL,
  `print_payee_address` int DEFAULT NULL,
  `print_micr` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_print_settings: 0 rows
/*!40000 ALTER TABLE `check_writer_print_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_writer_print_settings` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_recurring_payments
CREATE TABLE IF NOT EXISTS `check_writer_recurring_payments` (
  `payment_number` int(11) DEFAULT NULL,
  `bank_account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payee` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_amount` double DEFAULT NULL,
  `memo` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `voucher` double DEFAULT NULL,
  `frequency` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `selected` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_recurring_payments: 0 rows
/*!40000 ALTER TABLE `check_writer_recurring_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_writer_recurring_payments` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_recurring_payment_items
CREATE TABLE IF NOT EXISTS `check_writer_recurring_payment_items` (
  `payment_number` int(11) DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_recurring_payment_items: 0 rows
/*!40000 ALTER TABLE `check_writer_recurring_payment_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_writer_recurring_payment_items` ENABLE KEYS */;


-- Dumping structure for table simak.check_writer_undeposited_checks
CREATE TABLE IF NOT EXISTS `check_writer_undeposited_checks` (
  `payment_date` datetime DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `check_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `selected` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.check_writer_undeposited_checks: 0 rows
/*!40000 ALTER TABLE `check_writer_undeposited_checks` DISABLE KEYS */;
/*!40000 ALTER TABLE `check_writer_undeposited_checks` ENABLE KEYS */;


-- Dumping structure for table simak.city
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `city_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.city: 3 rows
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
REPLACE INTO `city` (`city_id`, `city_name`) VALUES
	('01', 'Purwakarta'),
	('02', 'Jakarta'),
	('03', 'Surabaya');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;


-- Dumping structure for table simak.com_list
CREATE TABLE IF NOT EXISTS `com_list` (
  `com_code` varchar(50) DEFAULT NULL,
  `com_db_name` varchar(50) DEFAULT NULL,
  `com_url` varchar(150) DEFAULT NULL,
  `com_short_desc` varchar(250) DEFAULT NULL,
  `com_long_desc` varchar(550) DEFAULT NULL,
  `com_logo` varchar(150) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.com_list: 7 rows
/*!40000 ALTER TABLE `com_list` DISABLE KEYS */;
REPLACE INTO `com_list` (`com_code`, `com_db_name`, `com_url`, `com_short_desc`, `com_long_desc`, `com_logo`, `id`) VALUES
	('test1', 'test1', 'http://localhost/talagasoft/simak/v6.maxon//company/test1/index.php', 'This company is short description bla bla bla, change on setting nama perusahaan', 'This company is long description bla bla bla, change on setting perusahaan', 'http://localhost/talagasoft/simak/v6.maxon//company/test1/images/logo.jpg', 1),
	('test2', 'test2', 'http://localhost/talagasoft/simak/v6.maxon//company/test2/index.php', 'This company is short description bla bla bla, change on setting nama perusahaan', 'This company is long description bla bla bla, change on setting perusahaan', 'http://localhost/talagasoft/simak/v6.maxon//company/test2/images/logo.jpg', 2),
	('test3', 'test3', 'http://localhost/talagasoft/simak/v6.maxon//company/test3/index.php', 'This company is short description bla bla bla, change on setting nama perusahaan', 'This company is long description bla bla bla, change on setting perusahaan', 'http://localhost/talagasoft/simak/v6.maxon//company/test3/images/logo.jpg', 3),
	('test4', 'test4', 'http://localhost/talagasoft/simak/v6.maxon//company/test4/index.php', 'This company is short description bla bla bla, change on setting nama perusahaan', 'This company is long description bla bla bla, change on setting perusahaan', 'http://localhost/talagasoft/simak/v6.maxon//company/test4/images/logo.jpg', 4),
	('test6', 'test6', 'http://localhost/talagasoft/simak/v6.maxon//company/test6/index.php', 'This company is short description bla bla bla, change on setting nama perusahaan', 'This company is long description bla bla bla, change on setting perusahaan', 'http://localhost/talagasoft/simak/v6.maxon//company/test6/images/logo.jpg', 5),
	('test7', 'test7', 'http://localhost/talagasoft/simak/v6.maxon//company/test7/index.php', 'This company is short description bla bla bla, change on setting nama perusahaan', 'This company is long description bla bla bla, change on setting perusahaan', 'http://localhost/talagasoft/simak/v6.maxon//company/test7/images/gnome-db.png', 6),
	('test8', 'test8', 'http://localhost/talagasoft/simak/v6.maxon//company/test8/index.php', 'This company is short description bla bla bla, change on setting nama perusahaan', 'This company is long description bla bla bla, change on setting perusahaan', 'http://localhost/talagasoft/simak/v6.maxon//company/test8/images/gnome-db.png', 7);
/*!40000 ALTER TABLE `com_list` ENABLE KEYS */;


-- Dumping structure for table simak.country
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` varchar(50) DEFAULT NULL,
  `country_name` varchar(50) DEFAULT NULL,
  `curr_code` varchar(50) DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.country: 2 rows
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
REPLACE INTO `country` (`country_id`, `country_name`, `curr_code`, `curr_rate`, `id`) VALUES
	('INA', 'Indonesia', 'Rp.', 1, 1),
	('US', 'United States', '$', 0, 2);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;


-- Dumping structure for table simak.crdb_memo
CREATE TABLE IF NOT EXISTS `crdb_memo` (
  `linenumber` int(11) NOT NULL AUTO_INCREMENT,
  `transtype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `docnumber` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `amount` double DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `kodecrdb` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `posted` int(1) DEFAULT NULL,
  `accountid` int(11) DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`linenumber`,`docnumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.crdb_memo: 0 rows
/*!40000 ALTER TABLE `crdb_memo` DISABLE KEYS */;
/*!40000 ALTER TABLE `crdb_memo` ENABLE KEYS */;


-- Dumping structure for table simak.crdb_memo_dtl
CREATE TABLE IF NOT EXISTS `crdb_memo_dtl` (
  `lineid` int(11) NOT NULL AUTO_INCREMENT,
  `kodecrdb` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `accountid` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`lineid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.crdb_memo_dtl: 0 rows
/*!40000 ALTER TABLE `crdb_memo_dtl` DISABLE KEYS */;
/*!40000 ALTER TABLE `crdb_memo_dtl` ENABLE KEYS */;


-- Dumping structure for table simak.credit_card_type
CREATE TABLE IF NOT EXISTS `credit_card_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_type` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `card_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `from_date` datetime DEFAULT NULL,
  `disc_percent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`card_type`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.credit_card_type: 4 rows
/*!40000 ALTER TABLE `credit_card_type` DISABLE KEYS */;
REPLACE INTO `credit_card_type` (`id`, `card_type`, `update_status`, `sourceautonumber`, `sourcefile`, `card_name`, `to_date`, `from_date`, `disc_percent`) VALUES
	(1, 'Citibank', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'Mandiri Visa', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'Mandiri Master', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 'Amex', NULL, NULL, NULL, 'Amex Card', '2010-02-11 00:00:00', '2009-07-24 00:00:00', 10);
/*!40000 ALTER TABLE `credit_card_type` ENABLE KEYS */;


-- Dumping structure for table simak.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `currency_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`currency_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.currencies: 2 rows
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
REPLACE INTO `currencies` (`currency_code`, `description`, `update_status`) VALUES
	('IDR', 'Rupiah', NULL),
	('USD', 'Dollar', NULL);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;


-- Dumping structure for table simak.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `active` int(1) DEFAULT NULL,
  `customer_record_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `region` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salutation` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `middle_initial` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip_postal_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `other_phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tax_exempt` int(1) DEFAULT NULL,
  `sales_tax_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax2_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `credit_limit` double DEFAULT NULL,
  `discount_percent` double(11,0) DEFAULT NULL,
  `markup_percent` double(11,0) DEFAULT NULL,
  `credit_balance` double DEFAULT NULL,
  `pricing_type` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `payment_terms` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `credithold` int(1) DEFAULT NULL,
  `salesman` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipped_via` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `route_delivery_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `route_delivery_sequence` int(11) DEFAULT NULL,
  `route_delivery_day` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `finance_charges` int DEFAULT NULL,
  `last_finance_charge_date` datetime DEFAULT NULL,
  `finance_charge_acct` int(11) DEFAULT NULL,
  `finance_charge_pct` double DEFAULT NULL,
  `bill_to_customer_number` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `current_balance` double DEFAULT NULL,
  `npwp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `nppkp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `limi_date` datetime DEFAULT NULL,
  `disc_min_qty` double DEFAULT NULL,
  `markup_amount` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `disc_prc_2` double DEFAULT NULL,
  `disc_prc_3` double DEFAULT NULL,
  PRIMARY KEY (`customer_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.customers: 18 rows
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
REPLACE INTO `customers` (`customer_number`, `active`, `customer_record_type`, `type_of_customer`, `region`, `salutation`, `first_name`, `middle_initial`, `last_name`, `company`, `street`, `suite`, `city`, `state`, `zip_postal_code`, `country`, `phone`, `fax`, `other_phone`, `email`, `tax_exempt`, `sales_tax_code`, `sales_tax2_code`, `credit_limit`, `discount_percent`, `markup_percent`, `credit_balance`, `pricing_type`, `code`, `comments`, `payment_terms`, `credithold`, `salesman`, `shipped_via`, `route_delivery_code`, `route_delivery_sequence`, `route_delivery_day`, `finance_charges`, `last_finance_charge_date`, `finance_charge_acct`, `finance_charge_pct`, `bill_to_customer_number`, `current_balance`, `npwp`, `org_id`, `update_status`, `nppkp`, `create_date`, `create_by`, `update_date`, `update_by`, `password`, `limi_date`, `disc_min_qty`, `markup_amount`, `discount_amount`, `disc_prc_2`, `disc_prc_3`) VALUES
	('101', NULL, '', NULL, '', '', '', '', '', 'Adrian', 'Jl. Raya Sadang', '', 'Jakarta', NULL, '', '', '', '', NULL, '', NULL, NULL, NULL, 10000000, 30, 0, 8799469.959, NULL, NULL, 0, 'Po Net 45', NULL, 'AGUS', '', NULL, 0, NULL, NULL, '2015-01-28 21:08:39', 0, 0, NULL, 1200530.041, '0', NULL, 1, NULL, '2013-10-22 13:29:50', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 20, 10),
	('103', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ovie', NULL, NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -16920000, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 16920000, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ganda', NULL, NULL, 'Surabaya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 0, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Andrea', NULL, NULL, 'Surabaya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 0, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('15899', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ALAMIN', NULL, NULL, 'JAKARTA', 'DKI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -8611450, NULL, NULL, 0, 'PO Net 30', NULL, 'DIAN', NULL, NULL, 0, NULL, NULL, '2011-11-22 10:06:49', 0, 0, NULL, 8647500, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('71383', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAKMUR', NULL, NULL, 'CIBINONG', 'JAWA BARAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -22250000, NULL, NULL, 0, 'PO Net 30', NULL, 'DIAN', NULL, NULL, 0, NULL, NULL, '2011-11-22 10:06:24', 0, 0, NULL, 23000000, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('71808', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SAKURA', NULL, NULL, 'CIPANAS', 'JAWA BARAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, 'PO Net 30', NULL, 'DIAN', NULL, NULL, 0, NULL, NULL, '2014-10-02 14:36:11', 0, 0, NULL, 6000, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('90120', NULL, 'GROSIR', 'BESAR', NULL, NULL, NULL, NULL, NULL, 'Andri Andriana', 'Jl. Raya Purwakarta No. 87', NULL, 'Purwakarta', NULL, NULL, NULL, '082192992', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -1693000, NULL, NULL, 0, 'PO Net 15', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2016-01-15 11:22:07', 0, 0, NULL, 1712800, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('9975370922', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Annisa Azhari', 'Ds. Blang Panyang', NULL, 'Lhokseumawe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -3303200, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2014-01-22 00:00:00', 0, 0, NULL, 7158800, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Ateng', NULL, NULL, 'Guest', NULL, 'Mr', NULL, NULL, NULL, 'Ateng', 'Jl. Raya Sadang, No. 27A', NULL, 'Purwakarta', NULL, NULL, 'INA       ', '026499933', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 759000, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CASH', NULL, NULL, 'ECERAN', NULL, NULL, NULL, NULL, NULL, 'CASH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, 'PO Net 30', NULL, 'DIAN', NULL, NULL, 0, NULL, NULL, '2013-10-31 12:19:39', 0, 0, NULL, 8855700, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CP002', NULL, NULL, 'Corporate', NULL, NULL, NULL, NULL, NULL, 'PLN Cab Purwakarta', 'Jl. Raya Purwakarta No. 30', NULL, 'Purwakarta', NULL, NULL, NULL, '02163003', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 627000, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CST00006', NULL, NULL, NULL, NULL, 'Mr', NULL, NULL, NULL, 'AQUA SPRING, PT', NULL, NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, 'PO Net 30', NULL, 'DIAN', NULL, NULL, 0, NULL, NULL, '2012-01-18 13:39:54', 0, 0, NULL, 3866600, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CST00015', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fdfs', 'fdsg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 0, '0', NULL, 1, NULL, '2014-09-04 21:05:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CST0001d6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ddsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 0, '0', NULL, 1, NULL, '2014-09-04 21:05:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('RKN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rano Karno', 'Jl. Raya Purwakarta No. 8', NULL, 'Jakarta', 'Jakarta', NULL, 'Indonesia', '0821255se', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, 'PO Net 30', NULL, 'udin', NULL, NULL, 0, NULL, NULL, '2010-09-23 13:24:01', 0, 0, NULL, 0, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SKS', NULL, NULL, 'ECERAN', NULL, 'Mr', 'Akim', NULL, NULL, 'Surya Kencana Sejahtera', 'Jl. Raya Rancaekek Bandung', NULL, 'Bandung', 'Jawa Barat', NULL, 'Indonesia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, 0, 'PO Net 30', NULL, 'DIAN', NULL, NULL, 0, NULL, NULL, '2014-10-14 17:32:15', 1373, 0, NULL, 0, '0', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SONY', NULL, 'Pelanggan', NULL, NULL, NULL, NULL, NULL, NULL, 'Sony Music Entertain', NULL, NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 100, NULL, NULL, 0, 'PO Net 30', NULL, 'DIAN', NULL, NULL, 0, NULL, NULL, '2013-03-05 09:18:21', 0, 0, NULL, 0, '.', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;


-- Dumping structure for table simak.customers_other_info
CREATE TABLE IF NOT EXISTS `customers_other_info` (
  `cust_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `disc_percent` int(11) DEFAULT NULL,
  `disc_from_date` datetime DEFAULT NULL,
  `disc_to_date` datetime DEFAULT NULL,
  `join_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `disc_amount` double DEFAULT NULL,
  `min_sales` double DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  PRIMARY KEY (`cust_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.customers_other_info: 0 rows
/*!40000 ALTER TABLE `customers_other_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_other_info` ENABLE KEYS */;


-- Dumping structure for table simak.customer_beginning_balance
CREATE TABLE IF NOT EXISTS `customer_beginning_balance` (
  `tanggal` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `customer_number` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `piutang_awal` double DEFAULT NULL,
  `piutang` double DEFAULT NULL,
  `piutang_akhir` double DEFAULT NULL,
  `amountin` double DEFAULT NULL,
  `amountout` double DEFAULT NULL,
  `flagawal` int DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`tanggal`,`customer_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.customer_beginning_balance: 0 rows
/*!40000 ALTER TABLE `customer_beginning_balance` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_beginning_balance` ENABLE KEYS */;


-- Dumping structure for table simak.customer_shipto
CREATE TABLE IF NOT EXISTS `customer_shipto` (
  `customer_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `location_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `kota` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kode_pos` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.customer_shipto: 0 rows
/*!40000 ALTER TABLE `customer_shipto` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_shipto` ENABLE KEYS */;


-- Dumping structure for table simak.customer_statement_defaults
CREATE TABLE IF NOT EXISTS `customer_statement_defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aging_date` datetime DEFAULT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `print_type` int(11) DEFAULT NULL,
  `number_of_copies` int(11) DEFAULT NULL,
  `statement_type` int(11) DEFAULT NULL,
  `customer_range` int(11) DEFAULT NULL,
  `print_dunning_messages` int DEFAULT NULL,
  `minimum_past_due_amount` double DEFAULT NULL,
  `minimum_invoice_age` double DEFAULT NULL,
  `minimum_customer_balance` double DEFAULT NULL,
  `print_zero_balances` int DEFAULT NULL,
  `print_credit_balances` int DEFAULT NULL,
  `current_message` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `over_30_message` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `over_60_message` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `over_90_message` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `over_120_message` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `paymentdisplay` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.customer_statement_defaults: 0 rows
/*!40000 ALTER TABLE `customer_statement_defaults` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_statement_defaults` ENABLE KEYS */;


-- Dumping structure for table simak.customer_type
CREATE TABLE IF NOT EXISTS `customer_type` (
  `type_id` varchar(50) DEFAULT NULL,
  `type_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`type_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.customer_type: 2 rows
/*!40000 ALTER TABLE `customer_type` DISABLE KEYS */;
REPLACE INTO `customer_type` (`type_id`, `type_name`) VALUES
	('02', 'ECERAN'),
	('01', 'GROSIR');
/*!40000 ALTER TABLE `customer_type` ENABLE KEYS */;


-- Dumping structure for table simak.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dept_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`dept_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.departments: 0 rows
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;


-- Dumping structure for table simak.divisions
CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `div_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `div_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`div_code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.divisions: 4 rows
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
REPLACE INTO `divisions` (`id`, `div_code`, `div_name`, `company_code`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'JKT', 'JAKARTA', NULL, NULL, NULL, NULL),
	(2, 'BDG', 'BANDUNG', NULL, NULL, NULL, NULL),
	(3, 'Kantor', 'Kantor', NULL, NULL, NULL, NULL),
	(4, 'Lapangan', 'Lapangan', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;


-- Dumping structure for table simak.employee
CREATE TABLE IF NOT EXISTS `employee` (
  `nip` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tgllahir` datetime DEFAULT NULL,
  `agama` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `kelamin` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `idktpno` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `hireddate` datetime DEFAULT NULL,
  `dept` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `divisi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `level` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `position` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supervisor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payperiod` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `alamat` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `kodepos` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telpon` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `hp` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `gp` double DEFAULT NULL,
  `tjabatan` double DEFAULT NULL,
  `ttransport` double DEFAULT NULL,
  `tmakan` double DEFAULT NULL,
  `incentive` double DEFAULT NULL,
  `sc` double(11,0) DEFAULT NULL,
  `rateot` double DEFAULT NULL,
  `tkesehatan` double DEFAULT NULL,
  `tlain` double DEFAULT NULL,
  `bjabatang` double DEFAULT NULL,
  `iurantht` double DEFAULT NULL,
  `blain` double DEFAULT NULL,
  `emptype` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `emplevel` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `pathimage` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `nip_id` int(11) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `gol_darah` varchar(50) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee: 3 rows
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
REPLACE INTO `employee` (`nip`, `nama`, `tgllahir`, `agama`, `kelamin`, `status`, `idktpno`, `hireddate`, `dept`, `divisi`, `level`, `position`, `supervisor`, `payperiod`, `alamat`, `kodepos`, `telpon`, `hp`, `gp`, `tjabatan`, `ttransport`, `tmakan`, `incentive`, `sc`, `rateot`, `tkesehatan`, `tlain`, `bjabatang`, `iurantht`, `blain`, `emptype`, `emplevel`, `pathimage`, `update_status`, `nip_id`, `npwp`, `account`, `pendidikan`, `tempat_lahir`, `gol_darah`, `bank_name`) VALUES
	('ANDRI', 'Andri Andriana', '2015-01-13 07:00:00', '', 'L', 'K1', '', '2015-01-13 07:00:00', 'HRD', 'JKT', NULL, '', '', NULL, '', '', '', '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GAJI1', 'L01', '', NULL, 0, '', '', '', '', 'A', ''),
	('121', 'Puput Melati', '2015-01-13 18:27:38', 'Islam', 'P', 'K1', '123.3239.2929', '2015-01-13 18:27:38', 'HRD', 'JKT', NULL, '', '', NULL, 'Jl. Raya Purwakarta 20', '41172', '', '082112829192', 2000000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GAJI1', 'L01', '', NULL, 0, '123467', '13800', 'SMA', 'Purwakarta', 'A', ''),
	('122', 'Inul Daratista', '2015-01-13 18:50:30', '', 'P', 'K2', '', '2015-01-13 18:50:30', 'HRD', 'JKT', NULL, '', '', NULL, '', '', '', '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GAJI1', 'L01', '', NULL, 0, '', '', '', '', 'A', '');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;


-- Dumping structure for table simak.employeeeducations
CREATE TABLE IF NOT EXISTS `employeeeducations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `educationlevel` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `school` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `place` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `major` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `enteryear` int(11) DEFAULT NULL,
  `graduationyear` int(11) DEFAULT NULL,
  `yearofattend` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `graduate` int DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeeeducations: 2 rows
/*!40000 ALTER TABLE `employeeeducations` DISABLE KEYS */;
REPLACE INTO `employeeeducations` (`id`, `employeeid`, `educationlevel`, `school`, `place`, `major`, `enteryear`, `graduationyear`, `yearofattend`, `graduate`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'ANDRI', 'daf', 'dfaf', 'dfads', NULL, 0, 0, 'dfadsdf', b'10000000', NULL, NULL),
	(2, 'ANDRI', 'dfads', '', '', NULL, 0, 0, '', b'10000000', NULL, NULL);
/*!40000 ALTER TABLE `employeeeducations` ENABLE KEYS */;


-- Dumping structure for table simak.employeeexperience
CREATE TABLE IF NOT EXISTS `employeeexperience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `startdate` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `finishdate` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `firstposition` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `endposition` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `place` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lastsalary` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `supervisor` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `referencename` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `referencephone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `reasontoleave` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeeexperience: 2 rows
/*!40000 ALTER TABLE `employeeexperience` DISABLE KEYS */;
REPLACE INTO `employeeexperience` (`id`, `employeeid`, `company`, `startdate`, `finishdate`, `firstposition`, `endposition`, `place`, `lastsalary`, `supervisor`, `referencename`, `referencephone`, `reasontoleave`, `sourceautonumber`, `sourcefile`) VALUES
	(1, '122', 'Ida Royani', '2015-01-13 19:02:31', '2015-01-13 19:02:31', 'a', 'A', 'ss', 'W', 'W', 'W', 'W', 'W', NULL, NULL),
	(3, 'ANDRI', 'dafddfasfd', '2015-06-09 07:32:15', '2015-06-09 07:32:15', 'dfasf', 'dfasf', '', '', '', '', '', '', NULL, NULL);
/*!40000 ALTER TABLE `employeeexperience` ENABLE KEYS */;


-- Dumping structure for table simak.employeefamily
CREATE TABLE IF NOT EXISTS `employeefamily` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `familyname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `relationship` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `age` datetime DEFAULT NULL,
  `education` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `job` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mariagestatus` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeefamily: 1 rows
/*!40000 ALTER TABLE `employeefamily` DISABLE KEYS */;
REPLACE INTO `employeefamily` (`id`, `employeeid`, `familyname`, `relationship`, `age`, `education`, `job`, `mariagestatus`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'ANDRI', 'dfasf', 'dfasd', '1970-01-01 00:00:00', '', '', '', NULL, NULL);
/*!40000 ALTER TABLE `employeefamily` ENABLE KEYS */;


-- Dumping structure for table simak.employeelicense
CREATE TABLE IF NOT EXISTS `employeelicense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `licensenumber` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lincensetype` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `finishdate` datetime DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeelicense: 0 rows
/*!40000 ALTER TABLE `employeelicense` DISABLE KEYS */;
/*!40000 ALTER TABLE `employeelicense` ENABLE KEYS */;


-- Dumping structure for table simak.employeemedical
CREATE TABLE IF NOT EXISTS `employeemedical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `medicaldate` datetime DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeemedical: 1 rows
/*!40000 ALTER TABLE `employeemedical` DISABLE KEYS */;
REPLACE INTO `employeemedical` (`id`, `employeeid`, `medicaldate`, `description`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'ANDRI', '1970-01-01 00:00:00', 'dfasdfsf', NULL, NULL);
/*!40000 ALTER TABLE `employeemedical` ENABLE KEYS */;


-- Dumping structure for table simak.employeerewardpunish
CREATE TABLE IF NOT EXISTS `employeerewardpunish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `daterp` datetime DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `rankinglevel` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `typerp` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeerewardpunish: 1 rows
/*!40000 ALTER TABLE `employeerewardpunish` DISABLE KEYS */;
REPLACE INTO `employeerewardpunish` (`id`, `employeeid`, `daterp`, `description`, `rankinglevel`, `typerp`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'ANDRI', '1970-01-01 00:00:00', 'dfas', 'dfas', '', NULL, NULL);
/*!40000 ALTER TABLE `employeerewardpunish` ENABLE KEYS */;


-- Dumping structure for table simak.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `employeeNumber` int(11) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `officeCode` varchar(10) NOT NULL,
  `reportsTo` int(11) DEFAULT NULL,
  `jobTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`employeeNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employees: 23 rows
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
REPLACE INTO `employees` (`employeeNumber`, `lastName`, `firstName`, `extension`, `email`, `officeCode`, `reportsTo`, `jobTitle`) VALUES
	(1002, 'Murphy', 'Diane', 'x5800', 'dmurphy@classicmodelcars.com', '1', NULL, 'President'),
	(1056, 'Patterson', 'Mary', 'x4611', 'mpatterso@classicmodelcars.com', '1', 1002, 'VP Sales'),
	(1076, 'Firrelli', 'Jeff', 'x9273', 'jfirrelli@classicmodelcars.com', '1', 1002, 'VP Marketing'),
	(1088, 'Patterson', 'William', 'x4871', 'wpatterson@classicmodelcars.com', '6', 1056, 'Sales Manager (APAC)'),
	(1102, 'Bondur', 'Gerard', 'x5408', 'gbondur@classicmodelcars.com', '4', 1056, 'Sale Manager (EMEA)'),
	(1143, 'Bow', 'Anthony', 'x5428', 'abow@classicmodelcars.com', '1', 1056, 'Sales Manager (NA)'),
	(1165, 'Jennings', 'Leslie', 'x3291', 'ljennings@classicmodelcars.com', '1', 1143, 'Sales Rep'),
	(1166, 'Thompson', 'Leslie', 'x4065', 'lthompson@classicmodelcars.com', '1', 1143, 'Sales Rep'),
	(1188, 'Firrelli', 'Julie', 'x2173', 'jfirrelli@classicmodelcars.com', '2', 1143, 'Sales Rep'),
	(1216, 'Patterson', 'Steve', 'x4334', 'spatterson@classicmodelcars.com', '2', 1143, 'Sales Rep'),
	(1286, 'Tseng', 'Foon Yue', 'x2248', 'ftseng@classicmodelcars.com', '3', 1143, 'Sales Rep'),
	(1323, 'Vanauf', 'George', 'x4102', 'gvanauf@classicmodelcars.com', '3', 1143, 'Sales Rep'),
	(1337, 'Bondur', 'Loui', 'x6493', 'lbondur@classicmodelcars.com', '4', 1102, 'Sales Rep'),
	(1370, 'Hernandez', 'Gerard', 'x2028', 'ghernande@classicmodelcars.com', '4', 1102, 'Sales Rep'),
	(1401, 'Castillo', 'Pamela', 'x2759', 'pcastillo@classicmodelcars.com', '4', 1102, 'Sales Rep'),
	(1501, 'Bott', 'Larry', 'x2311', 'lbott@classicmodelcars.com', '7', 1102, 'Sales Rep'),
	(1504, 'Jones', 'Barry', 'x102', 'bjones@classicmodelcars.com', '7', 1102, 'Sales Rep'),
	(1611, 'Fixter', 'Andy', 'x101', 'afixter@classicmodelcars.com', '6', 1088, 'Sales Rep'),
	(1612, 'Marsh', 'Peter', 'x102', 'pmarsh@classicmodelcars.com', '6', 1088, 'Sales Rep'),
	(1619, 'King', 'Tom', 'x103', 'tking@classicmodelcars.com', '6', 1088, 'Sales Rep'),
	(1621, 'Nishi', 'Mami', 'x101', 'mnishi@classicmodelcars.com', '5', 1056, 'Sales Rep'),
	(1625, 'Kato', 'Yoshimi', 'x102', 'ykato@classicmodelcars.com', '5', 1621, 'Sales Rep'),
	(1702, 'Gerard', 'Martin', 'x2312', 'mgerard@classicmodelcars.com', '4', 1102, 'Sales Rep');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;


-- Dumping structure for table simak.employeeskill
CREATE TABLE IF NOT EXISTS `employeeskill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `skillname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `skilllevel` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeeskill: 0 rows
/*!40000 ALTER TABLE `employeeskill` DISABLE KEYS */;
/*!40000 ALTER TABLE `employeeskill` ENABLE KEYS */;


-- Dumping structure for table simak.employeetraining
CREATE TABLE IF NOT EXISTS `employeetraining` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `trainingname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `traningdate` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `place` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `topic` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `certificate` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employeetraining: 0 rows
/*!40000 ALTER TABLE `employeetraining` DISABLE KEYS */;
/*!40000 ALTER TABLE `employeetraining` ENABLE KEYS */;


-- Dumping structure for table simak.employee_group
CREATE TABLE IF NOT EXISTS `employee_group` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee_group: 2 rows
/*!40000 ALTER TABLE `employee_group` DISABLE KEYS */;
REPLACE INTO `employee_group` (`kode`, `keterangan`) VALUES
	('GAJI2', 'GAJI2'),
	('GAJI1', 'GAJI1');
/*!40000 ALTER TABLE `employee_group` ENABLE KEYS */;


-- Dumping structure for table simak.employee_level
CREATE TABLE IF NOT EXISTS `employee_level` (
  `levelkode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `levelname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `creationdate` datetime DEFAULT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`levelkode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee_level: 1 rows
/*!40000 ALTER TABLE `employee_level` DISABLE KEYS */;
REPLACE INTO `employee_level` (`levelkode`, `levelname`, `creationdate`, `keterangan`, `update_status`) VALUES
	('L01', 'Level 1', NULL, 'Level 1', NULL);
/*!40000 ALTER TABLE `employee_level` ENABLE KEYS */;


-- Dumping structure for table simak.employee_pph
CREATE TABLE IF NOT EXISTS `employee_pph` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nomor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee_pph: 0 rows
/*!40000 ALTER TABLE `employee_pph` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_pph` ENABLE KEYS */;


-- Dumping structure for table simak.employee_shift
CREATE TABLE IF NOT EXISTS `employee_shift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kode_shift` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `keterangan` int(11) DEFAULT NULL,
  `tcid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee_shift: 0 rows
/*!40000 ALTER TABLE `employee_shift` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_shift` ENABLE KEYS */;


-- Dumping structure for table simak.employee_type
CREATE TABLE IF NOT EXISTS `employee_type` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.employee_type: 0 rows
/*!40000 ALTER TABLE `employee_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_type` ENABLE KEYS */;


-- Dumping structure for table simak.em_articles
CREATE TABLE IF NOT EXISTS `em_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `date_post` datetime DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `show_on_top` int(11) DEFAULT NULL,
  `icon_file` varchar(250) DEFAULT NULL,
  `doc_name` varchar(50) DEFAULT NULL,
  `section_name` varchar(50) DEFAULT NULL,
  `class_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.em_articles: 2 rows
/*!40000 ALTER TABLE `em_articles` DISABLE KEYS */;
REPLACE INTO `em_articles` (`id`, `title`, `date_post`, `view_count`, `author`, `category`, `content`, `show_on_top`, `icon_file`, `doc_name`, `section_name`, `class_name`) VALUES
	(56, 'Software Kasir', NULL, NULL, NULL, 'email_promo', 'MyPOS adalah software kasir  digunakan untuk mencatat nota-nota penjualan secara cepat baik penjualan tunai ataupun kartu kredit. Software ini bisa anda gunakan di toko retail, toko buku, toko komputer, toko kelontong, sembako,salon, restaurant dan lain-lain. Software MyPos telah disesuaikan dengan operasional di kasir yang menuntut kecepatan input transaksi, otomatis dan interface yang menarik dan mudah digunakan. Kunjungi http://www.talagasoft.com', NULL, NULL, NULL, NULL, NULL),
	(55, 'MyPOS Versi Retail', NULL, NULL, NULL, 'email_promo', 'MyPOS adalah software kasir  digunakan untuk mencatat nota-nota penjualan secara cepat baik penjualan tunai ataupun kartu kredit.  Software ini bisa anda gunakan di toko retail, toko buku, toko komputer, toko kelontong, sembako,salon, restaurant dan lain-lain. Software MyPos telah disesuaikan dengan operasional di kasir yang menuntut kecepatan input transaksi, otomatis dan interface yang menarik dan mudah digunakan. Kunjungi http://www.talagasoft.com', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `em_articles` ENABLE KEYS */;


-- Dumping structure for table simak.em_email
CREATE TABLE IF NOT EXISTS `em_email` (
  `email` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.em_email: 4 rows
/*!40000 ALTER TABLE `em_email` DISABLE KEYS */;
REPLACE INTO `em_email` (`email`, `id`) VALUES
	('andri@talagasoft.com', 80),
	('andri@talagasoft.com', 83),
	('undefined', 84),
	('undefined', 85);
/*!40000 ALTER TABLE `em_email` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_catatan
CREATE TABLE IF NOT EXISTS `eshop_catatan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_toko` int(10) NOT NULL,
  `kelompok` varchar(50) NOT NULL,
  `isi_catatan` varchar(500) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` varchar(50) NOT NULL,
  `update_date` datetime NOT NULL,
  `tampil` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.eshop_catatan: 0 rows
/*!40000 ALTER TABLE `eshop_catatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `eshop_catatan` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_comments
CREATE TABLE IF NOT EXISTS `eshop_comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(50) NOT NULL,
  `cm_userid` varchar(50) NOT NULL,
  `cm_username` varchar(50) NOT NULL,
  `cm_date` datetime NOT NULL,
  `comments` varchar(250) NOT NULL,
  `rate_quality` int(11) NOT NULL,
  `rate_accurate` int(11) NOT NULL,
  `rate_speed` int(11) NOT NULL,
  `rate_service` int(11) NOT NULL,
  `reply` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Index 2` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.eshop_comments: 16 rows
/*!40000 ALTER TABLE `eshop_comments` DISABLE KEYS */;
REPLACE INTO `eshop_comments` (`id`, `item_id`, `cm_userid`, `cm_username`, `cm_date`, `comments`, `rate_quality`, `rate_accurate`, `rate_speed`, `rate_service`, `reply`) VALUES
	(1, 'ABC', '12020', 'udin', '2015-02-14 15:43:12', 'Barang bagus pelayanan mantap', 4, 4, 4, 4, 0),
	(2, 'ABC', '12021', 'ucok', '2015-02-14 15:43:42', 'Good job, pelayanan prima', 5, 3, 2, 4, 0),
	(3, 'ABC', '', 'admin', '2015-02-21 23:44:17', 'aaaaaaa', 1, 2, 3, 4, 0),
	(4, 'ABC', '', 'admin', '2015-02-21 23:46:09', 'bbbbbbb', 1, 1, 1, 1, 0),
	(5, 'ABC', '', 'admin', '2015-02-21 23:46:25', 'cccc', 2, 2, 2, 2, 0),
	(6, 'ABC', '', 'admin', '2015-02-21 23:46:53', 'dddd', 4, 4, 4, 4, 0),
	(7, 'ABC', '', 'admin', '2015-02-21 23:47:06', 'eeeee', 5, 5, 5, 5, 0),
	(8, 'ABC', '', 'anang', '2015-02-21 23:50:07', 'aaaaa', 1, 1, 1, 5, 0),
	(9, 'DJISAMSU', '', 'anang', '2015-02-21 23:51:28', 'aaaa', 1, 2, 3, 4, 0),
	(10, 'KOREK', '', 'anang', '2015-02-21 23:53:46', 'aaaa', 1, 1, 1, 1, 0),
	(11, 'ABC', '', 'anang', '2015-02-22 13:51:18', 'bla bla bla bla', 1, 1, 1, 1, 0),
	(12, 'ABC', '', 'anang', '2015-02-22 13:53:44', 'awawawawawa', 1, 1, 5, 1, 0),
	(13, 'AQ001', '', '0', '2015-02-22 14:56:45', 'barang mantaff !!!', 3, 4, 5, 1, 0),
	(14, 'hps1', '', '0', '2015-03-26 22:01:17', 'aaa', 1, 1, 1, 1, 0),
	(15, 'aaaaa', '', '0', '2015-07-26 15:43:45', 'test', 2, 1, 1, 1, 0),
	(16, 'aaaaa', '', 'bagus', '2015-07-26 16:02:53', 'coba coba bang siapa tau ok', 1, 2, 3, 1, 0);
/*!40000 ALTER TABLE `eshop_comments` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_discuss
CREATE TABLE IF NOT EXISTS `eshop_discuss` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(50) NOT NULL,
  `cm_userid` varchar(50) NOT NULL,
  `cm_username` varchar(50) NOT NULL,
  `cm_date` datetime NOT NULL,
  `comments` varchar(250) NOT NULL,
  `reply` tinyint(4) NOT NULL DEFAULT '0',
  `reply_from` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index 2` (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table simak.eshop_discuss: 11 rows
/*!40000 ALTER TABLE `eshop_discuss` DISABLE KEYS */;
REPLACE INTO `eshop_discuss` (`id`, `item_id`, `cm_userid`, `cm_username`, `cm_date`, `comments`, `reply`, `reply_from`) VALUES
	(1, 'abc', 'jono', 'jono', '2015-02-14 16:30:48', 'tanya boleh gan', 0, NULL),
	(2, 'abc', 'joshua', 'joshua', '2015-02-14 16:31:22', 'boleh tanya?', 1, NULL),
	(3, 'abc', 'admin', 'admin', '2015-02-14 16:32:22', 'ada pertanyaa apa gan?', 0, 2),
	(4, 'ABC', '', 'anang', '2015-02-22 13:43:48', '', 0, NULL),
	(5, 'ABC', '', 'anang', '2015-02-22 13:44:06', 'dafsdfsafasdfsaff', 0, NULL),
	(6, 'ABC', '', 'anang', '2015-02-22 13:44:29', '', 0, NULL),
	(7, 'ABC', '', 'anang', '2015-02-22 13:45:04', '', 0, NULL),
	(8, 'ABC', '', 'anang', '2015-02-22 13:47:28', '', 0, NULL),
	(9, 'ABC', '', 'anang', '2015-02-22 13:51:30', 'xaxaxaxaxaa', 0, NULL),
	(10, 'ABC', '', 'anang', '2015-02-22 13:53:57', 'sasasasaasasa', 0, NULL),
	(11, 'aaaaa', '', 'bagus', '2015-07-26 16:23:55', 'testa et te etee te', 0, NULL);
/*!40000 ALTER TABLE `eshop_discuss` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_etalase
CREATE TABLE IF NOT EXISTS `eshop_etalase` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_toko` int(10) NOT NULL,
  `nama_etalase` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `kelompok` varchar(250) NOT NULL,
  `banner_etalase` varchar(250) NOT NULL,
  `user_admin` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.eshop_etalase: 0 rows
/*!40000 ALTER TABLE `eshop_etalase` DISABLE KEYS */;
/*!40000 ALTER TABLE `eshop_etalase` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_lokasi
CREATE TABLE IF NOT EXISTS `eshop_lokasi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `telpon` varchar(50) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `provinsi` varchar(150) NOT NULL,
  `kabupaten` varchar(150) NOT NULL,
  `kota` varchar(150) NOT NULL,
  `kode_pos` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.eshop_lokasi: 0 rows
/*!40000 ALTER TABLE `eshop_lokasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `eshop_lokasi` ENABLE KEYS */;


-- Dumping structure for table simak.eshop_toko
CREATE TABLE IF NOT EXISTS `eshop_toko` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `slogan` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status_toko` varchar(50) NOT NULL,
  `foto_sampul` varchar(150) NOT NULL,
  `provinsi` varchar(150) NOT NULL,
  `kabupaten` varchar(150) NOT NULL,
  `kota` varchar(150) NOT NULL,
  `kode_pos` varchar(150) NOT NULL,
  `jasa_kirim` varchar(150) NOT NULL,
  `jenis_bayar` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.eshop_toko: 1 rows
/*!40000 ALTER TABLE `eshop_toko` DISABLE KEYS */;
REPLACE INTO `eshop_toko` (`id`, `nama_toko`, `user_id`, `slogan`, `description`, `status_toko`, `foto_sampul`, `provinsi`, `kabupaten`, `kota`, `kode_pos`, `jasa_kirim`, `jenis_bayar`) VALUES
	(8, 'Talagasoft', 'anang', 'Mudah, murah dan otomatis', 'Pusat penjualan software berkwalitas', 'Open', 'sampul.jpg', 'Jawa Barat', 'Purwakarta', 'Pasawahan', '0', 'RPX,CAHAYA,', 'BCA,MANDIRI,');
/*!40000 ALTER TABLE `eshop_toko` ENABLE KEYS */;


-- Dumping structure for table simak.exchange_rate
CREATE TABLE IF NOT EXISTS `exchange_rate` (
  `er_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcecurrency` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `targetcurrency` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.exchange_rate: 0 rows
/*!40000 ALTER TABLE `exchange_rate` DISABLE KEYS */;
/*!40000 ALTER TABLE `exchange_rate` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset
CREATE TABLE IF NOT EXISTS `fa_asset` (
  `id` varchar(10) CHARACTER SET utf8 NOT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `group_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `location_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cost_centre_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custodian_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vendor_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sn` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `acquisition_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `acquisition_cost` double DEFAULT NULL,
  `warranty_date` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `depn_method` int(11) DEFAULT NULL,
  `useful_lives` int(11) DEFAULT NULL,
  `salvage_value` int(11) DEFAULT NULL,
  `private_use` int(11) DEFAULT NULL,
  `journal_id` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset: 2 rows
/*!40000 ALTER TABLE `fa_asset` DISABLE KEYS */;
REPLACE INTO `fa_asset` (`id`, `description`, `group_id`, `location_id`, `cost_centre_id`, `custodian_id`, `vendor_id`, `sn`, `acquisition_date`, `acquisition_cost`, `warranty_date`, `depn_method`, `useful_lives`, `salvage_value`, `private_use`, `journal_id`, `update_status`) VALUES
	('0101', 'Komputer Server XEON', '01', '1', '2', '3', '4', '5', '2015-01-01 19:27:27', 10000000, '2015-11-', 0, 12, 1000000, 0, 0, 0),
	('0102', 'Gedung Pabrik Plant 1', '02', '', '', '', '', '', '2015-01-01 00:00:00', 10000000, '1970-01-', 0, 100, 0, 0, 0, 0);
/*!40000 ALTER TABLE `fa_asset` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset_depreciation
CREATE TABLE IF NOT EXISTS `fa_asset_depreciation` (
  `asset_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `depn_year` int(11) DEFAULT NULL,
  `depn_month` int(11) DEFAULT NULL,
  `depn_id` int(11) DEFAULT NULL,
  `acquisition_cost` double DEFAULT NULL,
  `depn_exp` double DEFAULT NULL,
  `accum_depn` double DEFAULT NULL,
  `book_value` double DEFAULT NULL,
  `journal_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset_depreciation: 0 rows
/*!40000 ALTER TABLE `fa_asset_depreciation` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_asset_depreciation` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset_depreciation_schedule
CREATE TABLE IF NOT EXISTS `fa_asset_depreciation_schedule` (
  `asset_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `depn_year` int(11) DEFAULT NULL,
  `depn_id` int(11) DEFAULT NULL,
  `acquisition_cost` double DEFAULT NULL,
  `depn_exp` double DEFAULT NULL,
  `accum_depn` double DEFAULT NULL,
  `book_value` double DEFAULT NULL,
  `posted` int DEFAULT NULL,
  `glid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset_depreciation_schedule: 6 rows
/*!40000 ALTER TABLE `fa_asset_depreciation_schedule` DISABLE KEYS */;
REPLACE INTO `fa_asset_depreciation_schedule` (`asset_id`, `depn_year`, `depn_id`, `acquisition_cost`, `depn_exp`, `accum_depn`, `book_value`, `posted`, `glid`, `update_status`) VALUES
	('0101', 201612, NULL, 10000000, 750000, NULL, NULL, NULL, NULL, NULL),
	('0102', 201603, NULL, 10000000, 100000, 1500000, 8500000, NULL, NULL, NULL),
	('0101', 201603, NULL, 10000000, 750000, NULL, NULL, NULL, NULL, NULL),
	('0102', 201511, NULL, 10000000, 100000, 1100000, 8900000, NULL, NULL, NULL),
	('0101', 201511, NULL, 10000000, 750000, 8250000, 1750000, NULL, NULL, NULL),
	('0102', 201612, NULL, 10000000, 100000, 2400000, 7600000, NULL, NULL, NULL);
/*!40000 ALTER TABLE `fa_asset_depreciation_schedule` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset_group
CREATE TABLE IF NOT EXISTS `fa_asset_group` (
  `id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `at_cost` int(11) DEFAULT NULL,
  `accum_depn` int(11) DEFAULT NULL,
  `profit_on_sale` int(11) DEFAULT NULL,
  `loss_on_sale` int(11) DEFAULT NULL,
  `cash_bank` int(11) DEFAULT NULL,
  `depn_method` int(11) DEFAULT NULL,
  `useful_lives` int(11) DEFAULT NULL,
  `salvage_value` int(11) DEFAULT NULL,
  `expenses_depn` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `warranty_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset_group: 2 rows
/*!40000 ALTER TABLE `fa_asset_group` DISABLE KEYS */;
REPLACE INTO `fa_asset_group` (`id`, `name`, `at_cost`, `accum_depn`, `profit_on_sale`, `loss_on_sale`, `cash_bank`, `depn_method`, `useful_lives`, `salvage_value`, `expenses_depn`, `update_status`, `warranty_date`) VALUES
	('01', 'KOMPUTER', 1419, 1382, 1370, 1370, 0, 0, 12, 1000000, 1448, 0, '2016-03-12 00:00:00'),
	('02', 'GEDUNG', 1419, 1378, 1370, 1370, 0, 0, 120, 10000000, 1434, 0, '2015-11-28 00:00:00');
/*!40000 ALTER TABLE `fa_asset_group` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset_service_log
CREATE TABLE IF NOT EXISTS `fa_asset_service_log` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `asset_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `service_date` datetime DEFAULT NULL,
  `service_provider_id` double DEFAULT NULL,
  `service_contract` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `service_cost` double DEFAULT NULL,
  `notes` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `next_service_due` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `journal_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `posted` int DEFAULT NULL,
  `debit_account_id` double DEFAULT NULL,
  `credit_account_id` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset_service_log: 0 rows
/*!40000 ALTER TABLE `fa_asset_service_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_asset_service_log` ENABLE KEYS */;


-- Dumping structure for table simak.fa_asset_transaction
CREATE TABLE IF NOT EXISTS `fa_asset_transaction` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `asset_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `trans_type` int(11) DEFAULT NULL,
  `trans_date` varchar(8) CHARACTER SET utf8 DEFAULT NULL,
  `notes` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `trade_in_allowance` double DEFAULT NULL,
  `trans_value` double DEFAULT NULL,
  `vendor_id` double DEFAULT NULL,
  `cash_bank_ap` int(11) DEFAULT NULL,
  `journal_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `posted` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_asset_transaction: 0 rows
/*!40000 ALTER TABLE `fa_asset_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_asset_transaction` ENABLE KEYS */;


-- Dumping structure for table simak.fa_cards
CREATE TABLE IF NOT EXISTS `fa_cards` (
  `id` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `type` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street_add` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `postcode` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `mobile` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `notes` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `account_no1` int(11) DEFAULT NULL,
  `account_no2` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_cards: 0 rows
/*!40000 ALTER TABLE `fa_cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_cards` ENABLE KEYS */;


-- Dumping structure for table simak.fa_setting
CREATE TABLE IF NOT EXISTS `fa_setting` (
  `type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `enable` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.fa_setting: 0 rows
/*!40000 ALTER TABLE `fa_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `fa_setting` ENABLE KEYS */;


-- Dumping structure for table simak.fb_room
CREATE TABLE IF NOT EXISTS `fb_room` (
  `room_code` varchar(50) NOT NULL DEFAULT '',
  `room_name` varchar(50) DEFAULT NULL,
  `regular_hour` double DEFAULT NULL,
  `happy_hour` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `nota` varchar(50) DEFAULT NULL,
  `dept` varchar(50) DEFAULT NULL,
  `RType` varchar(50) DEFAULT NULL,
  `capacity` varchar(50) DEFAULT NULL,
  `desciption` varchar(100) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`room_code`),
  KEY `room_code` (`room_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.fb_room: 3 rows
/*!40000 ALTER TABLE `fb_room` DISABLE KEYS */;
REPLACE INTO `fb_room` (`room_code`, `room_name`, `regular_hour`, `happy_hour`, `status`, `nota`, `dept`, `RType`, `capacity`, `desciption`, `update_status`) VALUES
	('Meja 1', 'Meja 1', 0, 0, 1, '', '', '', '', '', NULL),
	('Meja 2', 'Meja 2', 0, 0, 1, '', '', '', '', '', NULL),
	('Meja 3', 'Meja 3', 0, 0, 1, '', '', '', '', '', NULL);
/*!40000 ALTER TABLE `fb_room` ENABLE KEYS */;


-- Dumping structure for table simak.finance_charge_defaults
CREATE TABLE IF NOT EXISTS `finance_charge_defaults` (
  `minimum_days_past_due` int(11) DEFAULT NULL,
  `minimum_customer_balance` double DEFAULT NULL,
  `minimum_finance_charge` double DEFAULT NULL,
  `number_days_between_charges` int(11) DEFAULT NULL,
  `use_one_month_or_actual_days` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `annual_finance_charge_pct` double DEFAULT NULL,
  `daily_finance_charge_pct` double DEFAULT NULL,
  `include_fin_chg_in_past_due_amt` int DEFAULT NULL,
  `finance_charge_acct` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.finance_charge_defaults: 0 rows
/*!40000 ALTER TABLE `finance_charge_defaults` DISABLE KEYS */;
/*!40000 ALTER TABLE `finance_charge_defaults` ENABLE KEYS */;


-- Dumping structure for table simak.financial_periods
CREATE TABLE IF NOT EXISTS `financial_periods` (
  `year_id` int(11) DEFAULT NULL,
  `sequence` double DEFAULT NULL,
  `period` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `closed` tinyint(1) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.financial_periods: 24 rows
/*!40000 ALTER TABLE `financial_periods` DISABLE KEYS */;
REPLACE INTO `financial_periods` (`year_id`, `sequence`, `period`, `startdate`, `enddate`, `closed`, `update_status`, `id`, `month_name`) VALUES
	(2015, 1, '2015-01', '2015-01-01 00:00:00', '2015-01-31 23:59:59', 0, NULL, 1, 'Jan'),
	(2015, 2, '2015-02', '2015-02-01 00:00:00', '2015-02-28 23:59:59', 0, NULL, 2, 'Feb'),
	(2015, 3, '2015-03', '2015-03-01 00:00:00', '2015-03-31 23:59:59', 0, NULL, 3, 'Mar'),
	(2015, 4, '2015-04', '2015-04-01 00:00:00', '2015-04-30 23:59:59', 0, NULL, 4, 'Apr'),
	(2015, 5, '2015-05', '2015-05-01 00:00:00', '2015-05-31 23:59:59', 0, NULL, 5, 'May'),
	(2015, 6, '2015-06', '2015-06-01 00:00:00', '2015-06-30 23:59:59', 0, NULL, 6, 'Jun'),
	(2015, 7, '2015-07', '2015-07-01 00:00:00', '2015-07-31 23:59:59', 0, NULL, 7, 'Jul'),
	(2015, 8, '2015-08', '2015-08-01 00:00:00', '2015-08-31 23:59:59', 0, NULL, 8, 'Aug'),
	(2015, 9, '2015-09', '2015-09-01 00:00:00', '2015-09-30 23:59:59', 0, NULL, 9, 'Sep'),
	(2015, 10, '2015-10', '2015-10-01 00:00:00', '2015-10-31 23:59:59', 0, NULL, 10, 'Oct'),
	(2015, 11, '2015-11', '2015-11-01 00:00:00', '2015-11-30 23:59:59', 0, NULL, 11, 'Nov'),
	(2015, 12, '2015-12', '2015-12-01 00:00:00', '2015-12-31 23:59:59', 0, NULL, 12, 'Dec'),
	(2016, 1, '2016-01', '2016-01-01 00:00:00', '2016-01-31 23:59:59', 0, NULL, 13, 'Jan'),
	(2016, 2, '2016-02', '2016-02-01 00:00:00', '2016-02-29 23:59:59', 0, NULL, 14, 'Feb'),
	(2016, 3, '2016-03', '2016-03-01 00:00:00', '2016-03-31 23:59:59', 0, 0, 15, 'Mar'),
	(2016, 4, '2016-04', '2016-04-01 00:00:00', '2016-04-30 23:59:59', 0, NULL, 16, 'Apr'),
	(2016, 5, '2016-05', '2016-05-01 00:00:00', '2016-05-31 23:59:59', 0, NULL, 17, 'May'),
	(2016, 6, '2016-06', '2016-06-01 00:00:00', '2016-06-30 23:59:59', 0, NULL, 18, 'Jun'),
	(2016, 7, '2016-07', '2016-07-01 00:00:00', '2016-07-31 23:59:59', 0, NULL, 19, 'Jul'),
	(2016, 8, '2016-08', '2016-08-01 00:00:00', '2016-08-31 23:59:59', 0, NULL, 20, 'Aug'),
	(2016, 9, '2016-09', '2016-09-01 00:00:00', '2016-09-30 23:59:59', 0, NULL, 21, 'Sep'),
	(2016, 10, '2016-10', '2016-10-01 00:00:00', '2016-10-31 23:59:59', 0, NULL, 22, 'Oct'),
	(2016, 11, '2016-11', '2016-11-01 00:00:00', '2016-11-30 23:59:59', 0, NULL, 23, 'Nov'),
	(2016, 12, '2016-12', '2016-12-01 00:00:00', '2016-12-31 23:59:59', 0, NULL, 24, 'Dec');
/*!40000 ALTER TABLE `financial_periods` ENABLE KEYS */;


-- Dumping structure for table simak.gl_begbalarc_year
CREATE TABLE IF NOT EXISTS `gl_begbalarc_year` (
  `account_id` int(11) DEFAULT NULL,
  `company_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `year` datetime DEFAULT NULL,
  `beginning_balance` double DEFAULT NULL,
  `debit_base` double DEFAULT NULL,
  `credit_base` double DEFAULT NULL,
  `ending_balance` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_begbalarc_year: 0 rows
/*!40000 ALTER TABLE `gl_begbalarc_year` DISABLE KEYS */;
/*!40000 ALTER TABLE `gl_begbalarc_year` ENABLE KEYS */;


-- Dumping structure for table simak.gl_beginning_balance_archive
CREATE TABLE IF NOT EXISTS `gl_beginning_balance_archive` (
  `account_id` int(11) DEFAULT NULL,
  `company_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `year` datetime DEFAULT NULL,
  `beginning_balance` double DEFAULT NULL,
  `debit_base` double DEFAULT NULL,
  `credit_base` double DEFAULT NULL,
  `ending_balance` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_beginning_balance_archive: 0 rows
/*!40000 ALTER TABLE `gl_beginning_balance_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `gl_beginning_balance_archive` ENABLE KEYS */;


-- Dumping structure for table simak.gl_projects
CREATE TABLE IF NOT EXISTS `gl_projects` (
  `kode` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `client` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `budget_amount` double DEFAULT NULL,
  `project_amount` double DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `person_in_charge` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status_project` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category_project` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sales` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `expense` double DEFAULT NULL,
  `labarugi` double DEFAULT NULL,
  `finish_prc` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_number` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_projects: 2 rows
/*!40000 ALTER TABLE `gl_projects` DISABLE KEYS */;
REPLACE INTO `gl_projects` (`kode`, `keterangan`, `client`, `tgl_mulai`, `tgl_selesai`, `budget_amount`, `project_amount`, `lokasi`, `person_in_charge`, `id`, `date_created`, `last_update`, `updated_by`, `status_project`, `category_project`, `sales`, `cost`, `expense`, `labarugi`, `finish_prc`, `update_status`, `sourceautonumber`, `sourcefile`, `invoice_number`) VALUES
	('dfasf', 'dfasf', 'dfafd', '2015-06-12 23:09:18', '2015-06-12 23:09:18', 0, 0, '', 'dfasfasdfsaf', 3, NULL, NULL, NULL, 'OPEN', 'GEDUNG', 0, 0, 0, 0, 0, NULL, NULL, NULL, 0),
	('dfafasf', 'daf', 'dfafs', '2015-06-12 23:12:21', '2015-06-12 23:12:21', 0, 0, 'dfasf', 'dfasfd', 4, NULL, NULL, NULL, '', '', 0, 0, 0, 0, 0, NULL, NULL, NULL, 0);
/*!40000 ALTER TABLE `gl_projects` ENABLE KEYS */;


-- Dumping structure for table simak.gl_projects_budget
CREATE TABLE IF NOT EXISTS `gl_projects_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `bulan_1` double DEFAULT NULL,
  `bulan_2` double DEFAULT NULL,
  `bulan_3` double DEFAULT NULL,
  `bulan_4` double DEFAULT NULL,
  `bulan_5` double DEFAULT NULL,
  `bulan_6` double DEFAULT NULL,
  `bulan_7` double DEFAULT NULL,
  `bulan_8` double DEFAULT NULL,
  `bulan_9` double DEFAULT NULL,
  `bulan_10` double DEFAULT NULL,
  `bulan_11` double DEFAULT NULL,
  `bulan_12` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_projects_budget: 0 rows
/*!40000 ALTER TABLE `gl_projects_budget` DISABLE KEYS */;
/*!40000 ALTER TABLE `gl_projects_budget` ENABLE KEYS */;


-- Dumping structure for table simak.gl_projects_saldo
CREATE TABLE IF NOT EXISTS `gl_projects_saldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=290 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_projects_saldo: 289 rows
/*!40000 ALTER TABLE `gl_projects_saldo` DISABLE KEYS */;
REPLACE INTO `gl_projects_saldo` (`id`, `project_code`, `start_date`, `account_id`, `amount`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(1, 'RSU', '2007-12-31 00:00:00', 1415, 0, NULL, NULL, NULL),
	(289, 'PJL00292.2129', '2013-12-31 00:00:00', 1484, 0, NULL, NULL, NULL);
/*!40000 ALTER TABLE `gl_projects_saldo` ENABLE KEYS */;


-- Dumping structure for table simak.gl_report_groups
CREATE TABLE IF NOT EXISTS `gl_report_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `account_type` double DEFAULT NULL,
  `group_type` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `group_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `parent_group_type` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`group_type`)
) ENGINE=MyISAM AUTO_INCREMENT=269 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_report_groups: 10 rows
/*!40000 ALTER TABLE `gl_report_groups` DISABLE KEYS */;
REPLACE INTO `gl_report_groups` (`id`, `company_code`, `account_type`, `group_type`, `group_name`, `parent_group_type`, `update_status`, `sourceautonumber`, `sourcefile`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	(216, 'MYPOS', 1, '10000', 'Aktiva Lancar', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(219, 'MYPOS', 2, '20000', 'Hutang Lancar', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(223, 'MYPOS', 3, '33000', 'Modal', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(224, 'MYPOS', 4, '40000', 'Pendapatan', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(225, 'MYPOS', 5, '50000', 'Harga Pokok Penjualan', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(226, 'MYPOS', 6, '60000', 'Biaya', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(227, 'MYPOS', 7, '70000', 'Pendapatan Lain-lain', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(228, 'MYPOS', 8, '80000', 'Biaya Lain-lain', '0', 3, NULL, NULL, NULL, NULL, NULL, NULL),
	(268, NULL, 1, '12000', 'Aktiva Tetap', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(267, NULL, 1, '11010', 'Kas Kecil', '10000', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `gl_report_groups` ENABLE KEYS */;


-- Dumping structure for table simak.gl_transactions
CREATE TABLE IF NOT EXISTS `gl_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `gl_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `date_time_stamp` datetime DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `source` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `operation` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `custsuppbank` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `jurnaltype` int(11) DEFAULT NULL,
  `project_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `x1` (`gl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_transactions: 2 rows
/*!40000 ALTER TABLE `gl_transactions` DISABLE KEYS */;
REPLACE INTO `gl_transactions` (`transaction_id`, `company_code`, `gl_id`, `date_time_stamp`, `account_id`, `date`, `debit`, `credit`, `source`, `operation`, `custsuppbank`, `jurnaltype`, `project_code`, `org_id`, `update_status`, `sourceautonumber`, `sourcefile`, `id_name`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	(4, NULL, 'GL00006', NULL, 1450, '2016-03-12 00:00:00', 1000, 0, 'Beli Perangko', 'operasional', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, NULL, 'GL00006', NULL, 1370, '2016-03-12 00:00:00', 0, 1000, 'Beli Perangko', 'operasional', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `gl_transactions` ENABLE KEYS */;


-- Dumping structure for table simak.gl_transactions_archive
CREATE TABLE IF NOT EXISTS `gl_transactions_archive` (
  `transaction_id` int(11) DEFAULT NULL,
  `company_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `gl_id` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `date_time_stamp` datetime DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `source` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `operation` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.gl_transactions_archive: 0 rows
/*!40000 ALTER TABLE `gl_transactions_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `gl_transactions_archive` ENABLE KEYS */;


-- Dumping structure for table simak.hr_emp_default_com
CREATE TABLE IF NOT EXISTS `hr_emp_default_com` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) CHARACTER SET utf8 NOT NULL,
  `def_com_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `def_com_value` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_emp_default_com: 0 rows
/*!40000 ALTER TABLE `hr_emp_default_com` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_emp_default_com` ENABLE KEYS */;


-- Dumping structure for table simak.hr_emp_level_com
CREATE TABLE IF NOT EXISTS `hr_emp_level_com` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `no_urut` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `formula_string` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `take_home_pay` int(11) DEFAULT NULL,
  `salary_com_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `salary_com_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_emp_level_com: 6 rows
/*!40000 ALTER TABLE `hr_emp_level_com` DISABLE KEYS */;
REPLACE INTO `hr_emp_level_com` (`id`, `level_code`, `no_urut`, `formula_string`, `take_home_pay`, `salary_com_code`, `salary_com_name`) VALUES
	(3, 'GAJI1', '1', 'dfadfdasfasdfd', NULL, 'GAPOK', NULL),
	(4, 'GAJI1', '1', 'SDSDAd', NULL, 'MAKAN', NULL),
	(10, 'GAJI1', '1', 'SDSDAd', NULL, 'TOKO', NULL),
	(11, 'GAJI2', '1', '', NULL, 'GAPOK', NULL),
	(12, 'GAJI2', '2', '', NULL, 'MAKAN', NULL),
	(13, 'GAJI2', '3', '', NULL, 'TOKO', NULL);
/*!40000 ALTER TABLE `hr_emp_level_com` ENABLE KEYS */;


-- Dumping structure for table simak.hr_emp_loan
CREATE TABLE IF NOT EXISTS `hr_emp_loan` (
  `loan_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `loan_type` int(11) NOT NULL,
  `date_loan` datetime DEFAULT NULL,
  `loan_amount` double DEFAULT NULL,
  `loan_balance` double DEFAULT NULL,
  `angsuran` double DEFAULT NULL,
  `loan_count` int(11) DEFAULT NULL,
  `loan_last_to` int(11) DEFAULT NULL,
  `loan_last_date` datetime DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `pay_method` int(11) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pokok` double NOT NULL DEFAULT '0',
  `bunga` double NOT NULL DEFAULT '0',
  `rate_method` int(11) NOT NULL DEFAULT '0',
  `rate_percent` float NOT NULL DEFAULT '0',
  `comments` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_emp_loan: 4 rows
/*!40000 ALTER TABLE `hr_emp_loan` DISABLE KEYS */;
REPLACE INTO `hr_emp_loan` (`loan_number`, `loan_type`, `date_loan`, `loan_amount`, `loan_balance`, `angsuran`, `loan_count`, `loan_last_to`, `loan_last_date`, `approved_by`, `pay_method`, `nip`, `id`, `pokok`, `bunga`, `rate_method`, `rate_percent`, `comments`) VALUES
	('LN00001', 0, '2014-06-04 17:22:00', 1000000, 0, 0, 12, 0, '2014-06-04 07:00:00', '', 0, '121', 1, 100000, 10000, 0, 10, ''),
	('LN00003', 0, '2014-06-04 17:22:00', 1000000, 0, 0, 12, 0, '2014-06-04 07:00:00', '', 0, '121', 3, 100000, 10000, 0, 10, ''),
	('LN00002', 0, '2015-01-13 20:07:29', 1000000, 0, 0, 12, 0, '2015-01-13 20:07:30', '', 0, 'ANDRI', 4, 83333.333333333, 0, 0, 0, ''),
	('LN00004', 0, '2015-01-13 20:07:29', 1000000, 0, 0, 12, 0, '2015-01-13 20:07:30', '', 0, 'ANDRI', 5, 83333.333333333, 0, 0, 10, '');
/*!40000 ALTER TABLE `hr_emp_loan` ENABLE KEYS */;


-- Dumping structure for table simak.hr_pph
CREATE TABLE IF NOT EXISTS `hr_pph` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `percent_value` double DEFAULT NULL,
  `low_value` double DEFAULT NULL,
  `high_value` double DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_pph: 0 rows
/*!40000 ALTER TABLE `hr_pph` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_pph` ENABLE KEYS */;


-- Dumping structure for table simak.hr_pph_form
CREATE TABLE IF NOT EXISTS `hr_pph_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelompok` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nomor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `header` int DEFAULT NULL,
  `rumus` varchar(250) DEFAULT NULL,
  `template` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_pph_form: 0 rows
/*!40000 ALTER TABLE `hr_pph_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_pph_form` ENABLE KEYS */;


-- Dumping structure for table simak.hr_ptkp
CREATE TABLE IF NOT EXISTS `hr_ptkp` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_ptkp: 5 rows
/*!40000 ALTER TABLE `hr_ptkp` DISABLE KEYS */;
REPLACE INTO `hr_ptkp` (`kode`, `keterangan`, `jumlah`) VALUES
	('K0', 'KAWIN ANAK 0', 26326000),
	('K1', 'KAWIN ANAK 1', 28350000),
	('K2', 'KAWIN ANAK 2', 30375000),
	('K3', 'KAWIN ANAK 3', 32400000),
	('TK', 'BELUM KAWIN', 24300000);
/*!40000 ALTER TABLE `hr_ptkp` ENABLE KEYS */;


-- Dumping structure for table simak.hr_shift
CREATE TABLE IF NOT EXISTS `hr_shift` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `different_day` int DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.hr_shift: 0 rows
/*!40000 ALTER TABLE `hr_shift` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_shift` ENABLE KEYS */;


-- Dumping structure for table simak.inventory
CREATE TABLE IF NOT EXISTS `inventory` (
  `item_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `active` int DEFAULT NULL,
  `class` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sub_category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `picking_order` int(11) DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `manufacturer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `model` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_inventory_date` datetime DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `cost_from_mfg` double DEFAULT NULL,
  `retail` double DEFAULT NULL,
  `special_features` varchar(1000) DEFAULT NULL,
  `item_picture` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `last_order_date` datetime DEFAULT NULL,
  `expected_delivery` datetime DEFAULT NULL,
  `lead_time` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `case_pack` double DEFAULT NULL,
  `unit_of_measure` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `location` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bin` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `weight_unit` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `manufacturer_item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `upc_code` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `serialized` int DEFAULT NULL,
  `assembly` int DEFAULT NULL,
  `multiple_pricing` int DEFAULT NULL,
  `multiple_warehouse` int DEFAULT NULL,
  `style` int DEFAULT NULL,
  `inventory_account` int(11) DEFAULT NULL,
  `sales_account` int(11) DEFAULT NULL,
  `cogs_account` int(11) DEFAULT NULL,
  `amount_ordered` int(11) DEFAULT NULL,
  `quantity_in_stock` int(11) DEFAULT NULL,
  `quantity_on_back_order` int(11) DEFAULT NULL,
  `quantity_on_order` int(11) DEFAULT NULL,
  `reorder_point` int(11) DEFAULT NULL,
  `reorder_quantity` int(11) DEFAULT NULL,
  `taxable` int DEFAULT NULL,
  `recordstate` int(11) DEFAULT NULL,
  `gudang_1` double(11,0) DEFAULT NULL,
  `gudang_2` double(11,0) DEFAULT NULL,
  `gudang_3` double(11,0) DEFAULT NULL,
  `gudang_4` double(11,0) DEFAULT NULL,
  `gudang_5` double(11,0) DEFAULT NULL,
  `gudang_6` double(11,0) DEFAULT NULL,
  `gudang_7` double(11,0) DEFAULT NULL,
  `gudang_8` double(11,0) DEFAULT NULL,
  `gudang_9` double(11,0) DEFAULT NULL,
  `gudang_10` double(11,0) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `upd_qty_asm_method` int(11) DEFAULT NULL,
  `iskitchenitem` int DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `custom_field_1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_3` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_3` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_4` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_4` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_5` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_5` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_6` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_6` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_7` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_7` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_8` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_8` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_9` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_9` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_field_10` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_10` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `qstep1` double(11,0) DEFAULT NULL,
  `qstep2` double(11,0) DEFAULT NULL,
  `qstep3` double(11,0) DEFAULT NULL,
  `qty_awal` double DEFAULT NULL,
  `discount_percent` double DEFAULT NULL,
  `allowchangeprice` int DEFAULT NULL,
  `allowchangedisc` int DEFAULT NULL,
  `setuptime` int(11) DEFAULT NULL,
  `processtime` int(11) DEFAULT NULL,
  `finishtime` int(11) DEFAULT NULL,
  `linkto_product1` double DEFAULT NULL,
  `linkto_product2` double DEFAULT NULL,
  `linkto_product3` double DEFAULT NULL,
  `komisi` double DEFAULT NULL,
  `isservice` int DEFAULT NULL,
  `isneedprocesstime` int DEFAULT NULL,
  `pricestep1` double DEFAULT NULL,
  `pricestep2` double DEFAULT NULL,
  `pricestep3` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tax_account` int(11) DEFAULT NULL,
  `item_picture2` varchar(50) DEFAULT NULL,
  `item_picture3` varchar(50) DEFAULT NULL,
  `item_picture4` varchar(50) DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `sales_count` int(11) DEFAULT NULL,
  `condition` varchar(50) DEFAULT NULL,
  `insr_name` varchar(50) DEFAULT NULL,
  `sales_min` int(11) DEFAULT NULL,
  `delivery_by` varchar(150) DEFAULT NULL,
  `division` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory: 632 rows
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
REPLACE INTO `inventory` (`item_number`, `active`, `class`, `category`, `sub_category`, `picking_order`, `supplier_number`, `description`, `manufacturer`, `model`, `last_inventory_date`, `cost`, `cost_from_mfg`, `retail`, `special_features`, `item_picture`, `last_order_date`, `expected_delivery`, `lead_time`, `case_pack`, `unit_of_measure`, `location`, `bin`, `weight`, `weight_unit`, `manufacturer_item_number`, `upc_code`, `serialized`, `assembly`, `multiple_pricing`, `multiple_warehouse`, `style`, `inventory_account`, `sales_account`, `cogs_account`, `amount_ordered`, `quantity_in_stock`, `quantity_on_back_order`, `quantity_on_order`, `reorder_point`, `reorder_quantity`, `taxable`, `recordstate`, `gudang_1`, `gudang_2`, `gudang_3`, `gudang_4`, `gudang_5`, `gudang_6`, `gudang_7`, `gudang_8`, `gudang_9`, `gudang_10`, `total_amount`, `upd_qty_asm_method`, `iskitchenitem`, `org_id`, `update_status`, `custom_field_1`, `custom_label_1`, `custom_field_2`, `custom_label_2`, `custom_field_3`, `custom_label_3`, `custom_field_4`, `custom_label_4`, `custom_field_5`, `custom_label_5`, `custom_field_6`, `custom_label_6`, `custom_field_7`, `custom_label_7`, `custom_field_8`, `custom_label_8`, `custom_field_9`, `custom_label_9`, `custom_field_10`, `custom_label_10`, `qstep1`, `qstep2`, `qstep3`, `qty_awal`, `discount_percent`, `allowchangeprice`, `allowchangedisc`, `setuptime`, `processtime`, `finishtime`, `linkto_product1`, `linkto_product2`, `linkto_product3`, `komisi`, `isservice`, `isneedprocesstime`, `pricestep1`, `pricestep2`, `pricestep3`, `create_date`, `create_by`, `update_date`, `update_by`, `tax_account`, `item_picture2`, `item_picture3`, `item_picture4`, `view_count`, `sales_count`, `condition`, `insr_name`, `sales_min`, `delivery_by`, `division`) VALUES
	('0', NULL, 'Non Stock', NULL, NULL, 0, NULL, 'Opening Balance', NULL, NULL, '2015-11-01 17:59:47', 5000000, 5000000, 0, '0', NULL, '2015-11-23 00:00:00', '2015-11-23 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '0', 'Ñ01Ó', NULL, NULL, NULL, NULL, NULL, 2409, 2409, 2409, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5000000, 0, NULL, NULL, 1, NULL, 'Custom Field 0', NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 2409, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00002', NULL, 'Stock Item', 'Komputer', 'KOM', -17, 'MM', 'Komputer Desktop Presario GLX 1001 White Green', '.', '2500000', '2016-02-19 16:26:50', 2500000, 2500000, 27500000, '0', 'D:gambar2602.jpg', '2016-02-19 16:26:05', '2012-10-22 00:00:00', '32', 0, 'pcs', 'R1.3.S2', NULL, 0, NULL, '00002', 'Ò  Í2aÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 1419, 25000000, 892, 0, 1, 0, 2, NULL, 1, 0, 765, 10, 9, 0, 108, 0, 0, 0, 0, 2252750000, 0, NULL, NULL, 1, 'DIMEN1', 'Custom 0', '2mm', 'Custom 1', 'Silver', 'Custom 2', 'Custom 0', 'Custom 3', 'Pavilon', 'Custom 4', 'Section 1', 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 43, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00004', NULL, 'Stock Item', 'Komputer', NULL, -4, 'JKT.KI', 'Keyboard Logitech', NULL, '6872.6599999999999', '2016-02-17 14:01:27', 5600, 10000, 5600, '0', '0', '2016-02-17 13:43:54', '2013-10-07 00:00:00', '32', 0, '.', 'A21', NULL, 0, NULL, '00004', 'Ò  Í4iÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 100000, 210, 100, 5, 0, 4, NULL, 1, 0, 205, -1, -1, 0, 7, 0, 0, 0, 0, 2240000, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', 'Custom 0', 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 477, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00005', NULL, 'Stock Item', 'Komputer', NULL, -5, 'ALFAMART', 'Printer Epson LX300', NULL, '1100000', '2016-02-19 16:26:50', 500000, 500000, 1100000, '0', '0', '2016-02-19 16:26:05', '2014-02-15 00:00:00', '1', 0, 'PCS', 'MM', NULL, 0, NULL, '00005', 'Ò  Í5mÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 30000000, 124, 0, 0, 0, 0, NULL, 1, 0, 12, 107, 0, 0, 6, 0, -1, 0, 0, 64980620.46, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', 'Custom 0', 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00007', NULL, 'Stock Item', 'MINUMAN', NULL, 18, '5', 'Mizone', '.', '1500', '2016-02-17 14:02:11', 0, 3500, 1700, '0', NULL, '2016-02-17 14:01:56', '2010-08-04 00:00:00', '47', 0, 'Btl', 'A100', NULL, 0, NULL, '00007', 'Ò  Í7uÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 80500, 312, 0, -170, 0, 31, NULL, 1, 0, 247, 80, 0, 0, -15, 0, 0, 0, 0, 1281000, 0, NULL, NULL, 1, '0.15540000000000001', 'Custom 1', '5.4300000000000001E-2', 'Custom 2', '0', 'Custom 3', 'Custom 0', 'AQUA', '0', 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 3000, 2000, 3000, 713, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 10, 20, 2000, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00012', NULL, 'Stock Item', 'Rumah', NULL, 0, '0', 'Garasi Tambahan', NULL, '0', '2015-11-13 17:47:40', 0, 0, 0, '0', NULL, '2013-11-22 21:59:28', '2010-09-23 00:00:00', ' ', 0, 'Unit', NULL, NULL, 0, NULL, '00012', 'Ò !Í2cÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 2, -1, 0, 0, 2, 1, NULL, 1, 0, -1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00021', NULL, 'Stock Item', 'Minuman', NULL, 0, '1', 'Teh Tarik', '.', '900', '2016-01-15 12:31:30', 3000, 3000, 1000, '0', 'D:prgmvb	alagaaccpropro3IMAGES\receive.bmp', '2016-01-15 12:28:37', '2011-05-09 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '00021', 'Ò "Í1aÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 1418000000, 985, 0, 0, 0, 6, NULL, 1, 0, 985, 0, 0, 0, 0, 0, 0, 0, 0, 5973000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', '.', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 1000, 900, 800, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 10, 20, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00022', NULL, 'Stock Item', 'KAYU', NULL, 0, '0', 'Korek Api Gas', NULL, '1000', '2014-10-22 14:11:36', -1, 2000, 1200, '0', NULL, '2015-11-18 07:24:53', '2011-06-12 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '00022', 'Ò "Í2eÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 20000, -11, 0, 0, 26, 15, NULL, 1, 0, -6, 0, 0, 0, -5, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00023', NULL, 'Stock Item', 'MAKANAN', NULL, -1, '0', 'Indomilk', NULL, '1000', '2014-07-11 14:27:45', 10000, 10000, 1200, '0', NULL, '2015-11-18 07:14:42', '2011-09-07 00:00:00', ' ', 0, 'pcs', NULL, NULL, 0, NULL, '00023', 'Ò "Í3iÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 200000, 11, 0, 0, 0, 8, NULL, 0, 0, 14, 0, 0, -3, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', 'xxx', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00024', NULL, 'Stock Item', 'MAKANAN', NULL, 0, 'ALFAMART', 'Susu indomilk kaleng', NULL, '1000', '2016-02-17 13:29:04', 1200, 5000, 1200, '0', NULL, '2016-01-16 11:05:04', '2011-09-22 00:00:00', '32', 0, 'klg', 'A12', NULL, 0, NULL, '00024', 'Ò "Í4mÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 14650000, 267, 0, 0, 0, 2, NULL, 1, 0, 328, 0, 0, 0, -61, 0, 0, 0, 0, 617801.12, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', 'Custom 0', 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00027', NULL, 'Stock Item', 'MAKANAN', NULL, 0, '0', 'Minyak Kelapa', NULL, '0', '2016-02-17 13:29:04', 25000, 25000, 110000, '0', NULL, '2016-01-17 07:17:06', '2011-10-23 00:00:00', ' ', 0, 'Ltr', NULL, NULL, 0, NULL, '00027', 'Ò "Í7yÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 300000, 19997, 0, 12, 0, 67, NULL, 1, 0, 49969, 0, 0, -29972, 0, 0, 0, 0, 0, 502425000, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', 'Custom 0', 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00028', NULL, 'Stock Item', 'MAKANAN', NULL, -2, '0', 'Donat', NULL, '0', '2015-11-17 21:44:46', 5000, 5000, 6000, '0', NULL, '2016-01-17 07:17:06', '2011-10-23 00:00:00', '125', 0, 'Pcs', NULL, NULL, 0, NULL, '00028', 'Ò "Í8}Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 325000, 8998, 0, 5, 0, 1005, NULL, 1, 0, 10000, 0, 0, -1002, 0, 0, 0, 0, 0, 100035000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00029', NULL, 'Stock Item', 'BOLA', NULL, 0, '5', 'USB Flashdisk', NULL, '1000', '2015-11-28 08:36:36', 0, 0, 20000, '0', NULL, '2015-11-13 17:46:27', '2011-11-16 00:00:00', ' ', 0, 'pcs', NULL, NULL, 0, NULL, '00029', 'Ò "Í9ÊÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 990, 27, 0, 0, 0, 3, NULL, 1, 0, -3, 0, 30, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', 'Custom 0', 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 20000, 18000, 15000, -8, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 10, 20, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00035', NULL, 'Stock Item', 'CAT', NULL, 0, '0', 'CAT FALCON 5KG', NULL, '9000', '2016-01-15 13:08:08', -1, 50000, 15000, '0', NULL, '2015-11-29 07:41:02', '2012-03-21 00:00:00', '47', 0, 'GLN', NULL, NULL, 0, NULL, '00035', 'Ò #Í5sÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 650000, 9, 0, 0, 0, 0, NULL, 1, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 30000, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', 'Custom 0', 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, -10, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00036', NULL, 'Stock Item', 'CAT', NULL, 0, '0', 'SAMSUNG GALAXY MINI', NULL, '800', '2016-02-17 13:29:04', 3500000, 3500000, 900, '0', NULL, '2015-11-19 22:08:33', '2012-09-13 00:00:00', ' ', 0, 'PCS', NULL, NULL, 0, NULL, '00036', 'Ò #Í6wÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 42304000, 6, 0, 0, 0, 0, NULL, 0, 0, 11, 0, 0, -5, 0, 0, 0, 0, 0, 42000000, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 79, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00040', NULL, 'Stock Item', 'Komputer', NULL, 0, '0', 'Komputer Server', NULL, '0', '2016-02-17 13:29:04', 4000000, 4000000, 1000000, '0', NULL, '2015-11-19 22:08:33', '2012-10-22 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '00040', 'Ò $Í0aÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 21304000, -9, 0, 0, 24, 15, NULL, 0, 0, -4, 0, 0, 0, -5, 0, 0, 0, 0, 21999999.98, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00050', NULL, 'Stock Item', 'Ticket', NULL, 0, '0', 'Ticket Pesawat Stock', NULL, '0', '2012-10-13 00:00:00', 0, 0, 800000, '0', '0', '2013-05-15 00:00:00', '2013-05-15 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '00006', 'Ò %Í0cÓ', NULL, NULL, NULL, NULL, NULL, 2395, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00051', NULL, 'Stock Item', 'Ticket', NULL, 0, '0', 'Ticket Pesawat Electronik', NULL, '0', '2012-10-13 00:00:00', 0, 0, 0, '0', '0', '2013-05-15 00:00:00', '2013-05-15 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '00006', 'Ò %Í1gÓ', NULL, NULL, NULL, NULL, NULL, 2395, 2394, 1419, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00052', NULL, 'Stock Item', 'Ticket', NULL, 0, '0', 'Ticket Pesawat Agen Lain', NULL, '0', '2012-10-13 00:00:00', 0, 0, 0, '0', '0', '2013-05-15 00:00:00', '2013-05-15 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, '00006', 'Ò %Í2kÓ', NULL, NULL, NULL, NULL, NULL, 2395, 2394, 1419, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00054', NULL, 'Stock Item', 'MAKANAN', NULL, 0, '0', 'Kopi ABC Sachet', NULL, '1000', '2013-06-05 16:01:03', -2, 0, 1200, '0', NULL, '2013-06-05 10:26:41', '2011-03-11 00:00:00', ' ', 0, 'pcs', NULL, NULL, 0, NULL, '00019', 'Ò %Í4sÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', 'ABC', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00057', NULL, 'Stock Item', 'Makanan', NULL, -1, '0', 'Rokok Star Mild', NULL, '1000', '2015-11-13 17:47:40', 0, 0, 1200, '0', NULL, '2015-11-13 17:46:27', '2013-06-24 00:00:00', ' ', 0, 'Bks', NULL, NULL, 0, NULL, '00057', 'Ò %Í7ÈÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 990, 1, 0, 0, 0, 0, NULL, 1, 3, 0, 0, -2, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00064', NULL, 'Stock Item', 'Komputer', NULL, 0, '0', 'CD Lagu Iwan Fals 2013', NULL, '5000', '2014-05-10 14:59:41', 0, 0, 6000, '0', NULL, '2015-02-04 17:47:45', '2014-04-29 00:00:00', '11', 0, 'PCS', 'ALFAMART', NULL, 0, NULL, '00064', 'Ò &Í4uÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 7000, -2, 0, 0, 4, 2, NULL, 1, 0, 0, 0, 0, 0, -2, 0, 0, 0, 0, 100000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('00065', NULL, 'Stock Item', '10', NULL, 0, '0', 'Pahemat', NULL, '12900', '2014-05-03 00:00:00', 2, 0, 0, '0', NULL, '2015-02-04 17:47:45', '2014-05-03 00:00:00', ' ', 0, 'set', NULL, NULL, 0, NULL, '00065', 'Ò &Í5yÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 19900, 0, 0, 4, 0, 0, NULL, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('001', NULL, 'Stock Item', 'ROOT-ROOT', NULL, 0, '0', 'Jam Tangan Seiko', '.', '500000', '2015-01-07 18:12:15', 3, 0, 550000, '0', NULL, '2015-02-04 17:47:45', '2010-07-23 00:00:00', '33', 0, 'pcs', NULL, NULL, 0, NULL, '001', 'Ñ001ÍÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 519900, 0, 0, 5, 0, 0, NULL, 1, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, -500000, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', 'AQUI', NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 47, 0, NULL, NULL, 30, 30, 30, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('002', NULL, 'Stock Item', 'CITIZEN', NULL, 0, '0', 'Jam Tangan Quartz', '.', '570000', '2014-01-22 18:15:21', 0, 0, 627000, '0', 'D:Prgmvb	alagapos\retailPro.v3ackx.jpg', '2015-02-04 17:47:45', '2010-07-23 00:00:00', '167', 0, 'Pcs', NULL, NULL, 0, NULL, '002', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1089900, 0, 0, 6, 0, 4, NULL, 1, 2, 2, 0, -4, 0, 0, 0, 0, 0, 0, -570000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', '.', NULL, 'Custom 4', 'S1010', 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 97, 0, NULL, NULL, 30, 30, 30, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('010624', NULL, 'Stock Item', 'BUAH', NULL, 0, '0', 'Pisang', '.', '0', '2015-02-04 00:00:00', 1, 0, 0, '0', NULL, '2015-02-04 17:47:45', '2015-02-04 00:00:00', '0', 0, 'Kg', NULL, NULL, 0, NULL, NULL, 'Ò!&8wÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1089900, 0, 0, 7, 0, 0, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('021', NULL, 'Stock Item', 'Local', 'phone', 0, '0', 'Jakarta', NULL, '0', '2015-02-04 00:00:00', 0, 0, 0, '0', NULL, '2015-02-04 17:47:45', '2015-02-04 00:00:00', '0', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Ò*  ,Í9|Ó', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1089900, 0, 0, 8, 0, 0, NULL, 1, 1, 0, 0, -1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('1', NULL, 'Stock Item', 'TARIF', NULL, 0, '0', 'IURAN ASRAMA', NULL, '0', '2012-05-27 00:00:00', 1, 0, 0, '0', '0', '2015-02-04 17:47:45', '2012-05-27 00:00:00', ' ', 0, NULL, NULL, NULL, 0, NULL, '1', 'Ñ12Ó', NULL, NULL, NULL, NULL, NULL, 0, 1415, 0, 1089900, -1, 0, 0, 3, 2, NULL, 1, 0, -1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100', NULL, NULL, 'Baju Anak', NULL, 0, NULL, 'Baju Anak Koko', NULL, NULL, '2016-01-15 12:31:30', 50000, 50000, 10000, '0', NULL, '2016-01-15 12:28:37', '2016-01-15 00:00:00', '0', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1415000000, 187, 0, 0, 0, 1, NULL, 1, 0, 187, 0, 0, 0, 0, 0, 0, 0, 0, 19400000, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000010', NULL, 'Stock Item', '10', NULL, 0, 'N-001', 'JUNIOR (0.94LTR) 674 CLEAR DAY', 'JUNIOR', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 9, 0, 0, 0, 0, NULL, 1, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000011', NULL, 'Stock Item', '10', NULL, 0, 'N-001', 'JUNIOR (0.94LTR), 675 GARDENA', 'JUNIOR', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 10, 0, 0, 0, 0, NULL, 1, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000032', NULL, 'Stock Item', '10', NULL, 0, 'N-001', 'VINILEX BASE 25 KG DEEP', 'VINILEX', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 9, 0, 0, 0, 0, NULL, 1, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000036', NULL, 'Stock Item', '10', NULL, 0, 'N-001', 'VINILEX BASE 25 KG ACCENT', 'VINILEX', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 8, 0, 0, 0, 0, NULL, 1, 0, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000037', NULL, 'Stock Item', NULL, NULL, 0, 'N-001', 'JUNIOR (0.94LTR) 624 ARMY GREEN', 'JUNIOR', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 10, 0, 0, 0, 0, NULL, 1, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000041', NULL, 'Stock Item', '10', NULL, 0, 'T-015', 'AVIAN HAMERTONE 1KG COOPER (100)', 'HAMERTONE', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 9, 0, 0, 0, 0, NULL, 1, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000042', NULL, 'Stock Item', '10', NULL, 0, 'N-001', 'JUNIOR (0.94LTR) 629 ANTIQUE', 'JUNIOR', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 9, 0, 0, 0, 0, NULL, 1, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000043', NULL, 'Stock Item', '10', NULL, 0, 'N-001', 'VINILEX BASE 1,4 KG PASTEL', 'VINILEX', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 10, 0, 0, 0, 0, NULL, 1, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000044', NULL, 'Stock Item', '10', NULL, 0, 'N-001', 'JUNIOR (0.94LTR) 630 LEATHER', 'JUNIOR', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 8, 0, 0, 0, 0, NULL, 1, 0, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000117', NULL, 'Stock Item', '20', NULL, 0, 'A-013', 'ASTER PANEL KALIGRAFI II RED 9X20X25 (9PCS)', 'ASTER', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 10, 0, 0, 0, 0, NULL, 1, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000124', NULL, 'Stock Item', '10', NULL, 0, 'N-001', 'AUTOLUX MET (300CC) NO. 1 VIOLET', 'AUTOLUX', 'G', NULL, 90000, 90000, 100000, '0', NULL, NULL, NULL, NULL, 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 10, 0, 0, 0, 0, NULL, 1, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100000125', NULL, 'Stock Item', '10', NULL, 0, 'N-001', 'AUTOLUX MET (300CC) NO. 2 GOLD I', 'AUTOLUX', 'G', '2016-01-15 13:08:15', 90000, 90000, 100000, '0', NULL, '2016-01-13 16:19:22', NULL, '2', 0, 'Pcs', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 90000, 10, 0, 0, 0, 0, NULL, 1, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100001', NULL, 'Stock', 'Keramik', NULL, 3, 'CATUR', 'Keramik Roman 30x30', NULL, NULL, '2016-02-18 00:00:00', 50000, 50000, 100000, '0', NULL, '2016-02-19 14:16:57', '2016-02-18 00:00:00', ' ', 0, 'BOX', NULL, NULL, 0, NULL, '100001', 'Ò* !/Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 5500000, 35, 0, 75, 0, 0, NULL, 0, 0, 10, 0, 0, 15, 10, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100011', NULL, 'Stock Item', NULL, NULL, 0, NULL, 'HN A VDROID S4C', NULL, '0', NULL, 0, 0, 910000, '0', NULL, NULL, NULL, NULL, 0, 'PCS', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('100382', NULL, 'Stock Item', NULL, NULL, 0, NULL, 'HN SMSUNG G7102', NULL, '0', NULL, 0, 0, 3250000, '0', NULL, NULL, NULL, NULL, 0, 'PCS', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('101100049', NULL, 'Stock Item', '10', '11', 0, '0', 'Keramik Milan 303dsadfsdf', NULL, '10000', '2014-12-17 18:11:54', 2, 0, 90000, '0', NULL, '2015-02-04 17:47:45', '2013-04-06 00:00:00', '33', 0, NULL, NULL, NULL, 0, NULL, '101100048', 'Ò*+ $Í9rÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 1099900, 2, 0, -1, 0, 1, NULL, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 20000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('10201', NULL, 'Stock Item', 'Baju', NULL, 0, '3', 'Celana Jeans Pria', '.', '120000', '2016-01-16 16:01:03', 120000, 120000, 132000, '0', NULL, '2015-02-04 17:47:45', '2013-06-22 00:00:00', '65', 0, 'Pcs', NULL, NULL, 0, NULL, NULL, 'Ò*4Í1(Ó', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1339900, 0, 0, 0, 0, 0, NULL, 0, 0, -4, 0, 0, -1, 0, 0, 0, 0, 0, 1878319.61, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40000, 20000, 0, 0, 0, NULL, NULL, 30, 30, 30, 0, 0, 0, 0, NULL, NULL, 5, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('12', NULL, 'Stock Item', 'CAT', NULL, 0, '0', 'cat base', '.', '0', '2014-05-29 00:00:00', 1, 0, 0, '0', NULL, '2015-02-04 17:47:45', '2014-05-29 00:00:00', '0', 0, NULL, NULL, NULL, 0, NULL, NULL, 'Ñ12VÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1339900, 0, 0, 0, 1, 1, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -9, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('123456', NULL, 'Stock Item', 'CITIZEN', NULL, 0, '0', 'Joy Stick PS 2 Sony', 'Model', '90000', '2015-01-12 14:19:42', 10, 0, 99000, '0', NULL, '2015-01-12 14:19:01', '2011-05-21 00:00:00', '33', 0, 'Pcs', NULL, NULL, 0, NULL, '123456', 'Ò,BXLÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 900000, 0, 100, 10, 0, 1, NULL, 1, 9, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1890000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', 'Manuf', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('129082', NULL, NULL, 'MOBIL ', NULL, 0, NULL, 'toyota kijang', NULL, NULL, NULL, 0, 0, 10000, '0', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, -1, 0, 0, 1, 0, NULL, 1, 0, -1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('2', NULL, 'Stock Item', 'TARIF', NULL, 0, '0', 'IURAN DAPUR', NULL, '0', NULL, 0, 0, 0, '0', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 'Ò*  ,Í9|Ó', NULL, NULL, NULL, NULL, NULL, 0, 1415, 0, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('20000', NULL, NULL, '1200', NULL, 0, NULL, 'warna putih xl', NULL, NULL, NULL, 0, 0, 20000, '0', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('20001', NULL, 'Stock Item', 'OBAT', NULL, 0, '0', 'SALONPAS CAIR 100 GR', NULL, '10000', '2013-05-12 16:20:54', 0, 0, 11000, '0', '0', '2013-05-12 16:09:40', '2013-05-12 00:00:00', ' ', 0, 'Pcs', 'S0010', NULL, 0, NULL, '20001', 'Ò4 Í1qÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 315500, 0, 0, 20, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('2012', NULL, NULL, 'Warna', NULL, 0, NULL, 'Ukuran XL', NULL, NULL, NULL, 0, 0, 20020, '0', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('29929', NULL, NULL, '100', NULL, 0, NULL, 'XL', NULL, NULL, NULL, 0, 0, 200000, '0', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, -2, 0, 0, 2, 0, NULL, 1, 0, -2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('3', NULL, 'Stock Item', 'TARIF', NULL, 0, '0', 'IURAN SPP', NULL, '0', NULL, 0, 0, 0, '0', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 'Ò*  ,Í9|Ó', NULL, NULL, NULL, NULL, NULL, 0, 1415, 0, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('34521', NULL, 'Stock Item', 'BOLA', NULL, 0, '0', 'STICK PS ONE SONY', 'MODEL', '0', '2011-05-22 00:00:00', 0, 0, 0, '0', NULL, '2011-05-22 21:13:15', '2011-05-22 00:00:00', NULL, 0, 'PCS', 'KWAN', NULL, 0, NULL, NULL, 'ÒBTÍ1ÉÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MANUF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, -8, 0, NULL, NULL, 30, 30, 30, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('aaaa', NULL, NULL, 'Baju', NULL, 0, NULL, 'Kemeja Pria', NULL, NULL, '2016-01-15 12:31:30', 200000, 200000, 100000, '0', NULL, '2016-01-15 12:28:37', '2016-01-15 00:00:00', '0', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1438000000, 93, 0, 0, 0, 0, NULL, 1, 0, 93, 0, 0, 0, 0, 0, 0, 0, 0, 38600000, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('aaaadd', NULL, NULL, 'Baju', NULL, 0, NULL, 'Celana Kolor', NULL, NULL, NULL, 0, 0, 10000, '0', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, -3, 0, 0, 3, 0, NULL, 1, 0, -3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CCdddd', NULL, 'Stock Item', 'Service', NULL, 0, '0', 'Cuci Mobil Honda Jazz', 'Honda Jazz', '0', '2011-12-26 00:00:00', 0, 0, 0, '0', NULL, '2011-12-26 00:00:00', '2011-12-26 00:00:00', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CMMC', NULL, 'Stock Item', 'Service', 'MEDIUM CAR', 0, '0', 'Cuci Mobil Medium Car', 'Honda Jazz', '0', '2013-05-28 00:00:00', 0, 0, 0, '0', NULL, '2014-10-10 14:24:27', '2013-05-28 00:00:00', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 'ÑCMMC|Ó', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 12000, 0, 0, 1, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 10000, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CMSC', NULL, 'Stock Item', 'Service', 'SMALL CAR', 0, '0', 'Cuci Mobil Small Car', 'Honda Jazz', '0', '2013-05-28 00:00:00', 0, 0, 0, '0', NULL, '2013-05-28 00:00:00', '2013-05-28 00:00:00', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 'ÑCMSC\'Ó', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 9000, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CUCI RAMBUT', NULL, 'Stock Item', NULL, NULL, 0, '0', 'Cuci Rambut', NULL, '0', '2012-11-15 00:00:00', 0, 0, 0, '0', NULL, '2014-06-09 15:46:55', '2012-11-15 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, 'CUCI RAMBUT', 'ÑCUCI RAMBUT@Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('DJISAMSU', NULL, 'Stock Item', 'Makanan', NULL, 0, '0', 'Rokok Dji Sam Su Kretek', NULL, '1000', '2012-12-15 18:55:00', 0, 0, 1200, '0', NULL, '2012-12-15 19:08:37', '2012-12-15 00:00:00', ' ', 0, 'Bks', NULL, NULL, 0, NULL, 'DJISAMSU', 'ÑDJISAMSU0Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, -200, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 11422.62, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('DP27', NULL, 'Stock Item', 'MAKANAN', NULL, 0, '0', 'Donat Paket 27 Ribu', NULL, '0', '2011-11-22 00:00:00', 0, 0, 0, '0', NULL, '2011-11-22 00:00:00', '2011-11-22 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, 'DP27', 'ÑDP27iÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('DP40', NULL, 'Stock Item', 'MAKANAN', NULL, 0, '0', 'Donat Paket 40 ribu', NULL, '0', '2011-11-22 00:00:00', 0, 0, 0, '0', NULL, '2011-11-22 00:00:00', '2011-11-22 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, 'DP40', 'ÑDP40SÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('DP41', NULL, 'Stock Item', 'MAKANAN', NULL, 0, '0', 'Donat Paket 41 Ribu', NULL, '0', '2011-11-22 00:00:00', 0, 0, 0, '0', NULL, '2011-11-22 00:00:00', '2011-11-22 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, 'DP41', 'ÑDP41WÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('FAOZ', NULL, 'Stock Item', NULL, NULL, 0, '0', 'Facial Ozone', NULL, '0', '2012-11-23 00:00:00', 0, 0, 0, '0', NULL, '2012-11-23 00:00:00', '2012-11-23 00:00:00', '0', 0, NULL, NULL, NULL, 0, NULL, NULL, 'ÑFAOZbÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0.15, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('GANTUNGAN', NULL, 'Stock Item', NULL, NULL, 0, '0', 'GANTUNGAN', NULL, '0', '2012-10-30 00:00:00', 0, 0, 0, '0', NULL, '2012-10-30 00:00:00', '2012-10-30 00:00:00', ' ', 0, 'PCS', NULL, NULL, 0, NULL, 'GANTUNGAN', 'ÑGANTUNGANzÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('GG', NULL, 'Stock Item', 'Drink', NULL, 0, '0', 'Gudang Garam Filter', NULL, '10000', '2014-10-14 17:45:54', 0, 0, 15000, '0', NULL, '2014-10-14 17:40:31', '2014-10-14 00:00:00', ' ', 0, 'PCS', 'MM', NULL, 0, NULL, 'GG', 'ÑGG/Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 2510000, 0, 0, 2, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Gula', NULL, 'Stock Item', NULL, NULL, 0, '0', 'Gula Pasir', NULL, '16000', '2012-07-13 00:00:00', 0, 0, 17700, '0', NULL, '2012-07-13 00:00:00', '2012-07-13 00:00:00', ' ', 0, 'Kg', NULL, NULL, 0, NULL, 'Gula', 'ÑGulapÓ', NULL, NULL, NULL, NULL, NULL, 2390, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('HD', NULL, 'Stock Item', 'KOMPUTER', NULL, 0, '0', 'Hardisk Seagete 200Gb', '.', '200000', '2014-10-10 14:45:49', 0, 0, 220000, '0', NULL, '2013-03-05 07:22:25', '2011-07-15 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, 'HD', 'ÑHD*Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 2400000, -60, 0, 0, 28, 0, NULL, 1, 0, -32, 0, 0, 0, -28, 0, 0, 0, 0, -1560000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', '.', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('HVS', NULL, 'Stock Item', NULL, NULL, 0, '0', 'Kertas HVS', NULL, '0', '2013-03-05 09:46:49', 0, 0, 0, '0', 'D:prgmimagesPict1AvacadoRolls.bmp', '2013-03-05 00:00:00', '2013-03-05 00:00:00', ' ', 0, 'rim', NULL, NULL, 0, NULL, 'HVS', 'ÑHVSÉÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('JUS', NULL, 'Stock Item', 'MINUMAN', NULL, 0, '0', 'JUS MILO BESAR', NULL, '0', '2012-07-13 15:58:15', 0, 0, 0, '0', NULL, '2012-07-13 00:00:00', '2012-07-13 00:00:00', ' ', 0, 'Gelas', NULL, NULL, 0, NULL, 'JUS', 'ÑJUSÉÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, -2, 0, 0, 2, 0, NULL, 1, 0, -2, 0, 0, 0, 0, 0, 0, 0, 0, 667994.4, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K100', NULL, 'Stock Item', 'KAMERA', NULL, 0, '0', 'KAMERA', '.', '0', '2010-11-30 00:00:00', 0, 0, 0, '0', NULL, '2010-11-30 00:00:00', '2010-11-30 00:00:00', NULL, 0, 'PCS', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 30, 30, 30, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('KAYU46', NULL, 'Stock Item', NULL, NULL, 0, '0', 'KAYU 4X6', NULL, '12900', '2014-05-03 00:00:00', 0, 0, 0, '0', NULL, '2014-05-03 00:00:00', '2014-05-03 00:00:00', ' ', 0, 'BTG', NULL, NULL, 0, NULL, 'KAYU46', 'ÑKAYU46$Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('KAYU57', NULL, 'Stock Item', NULL, NULL, 0, '0', 'KAYU 5X7', NULL, '0', '2014-05-03 15:51:31', 0, 0, 0, '0', NULL, '2014-05-03 15:51:05', '2014-05-03 00:00:00', ' ', 0, 'BTG', NULL, NULL, 0, NULL, 'KAYU57', 'ÑKAYU57/Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 100, 0, 0, 100, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('KAYU57I', NULL, 'Stock Item', NULL, NULL, 0, '0', 'KAYU 5X7 IKET 5 BTG', NULL, '0', '2014-05-03 15:52:55', 0, 0, 0, '0', NULL, '2014-05-03 00:00:00', '2014-05-03 00:00:00', ' ', 0, 'IKET', NULL, NULL, 0, NULL, 'KAYU57I', 'ÑKAYU57IÉÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('KB', NULL, 'Stock Item', 'KOMPUTER', NULL, 10, '0', 'Keyboard Logitect', NULL, '8000', '2016-02-17 13:29:04', 0, 20000, 8900, '0', NULL, '2015-11-19 22:08:33', '2011-07-15 00:00:00', ' ', 0, 'Pcs', 'MM', NULL, 0, NULL, 'KB', 'ÑKB)Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 1304000, 21, 0, 0, 7, 18, NULL, 1, 0, 65, 0, 0, 0, -44, 0, 0, 0, 0, 1720000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('LLR', NULL, 'Stock Item', NULL, NULL, 0, '0', 'Lulur', NULL, '0', '2012-11-22 00:00:00', 0, 0, 0, '0', NULL, '2012-11-22 00:00:00', '2012-11-22 00:00:00', '0', 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0.2, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('MILO', NULL, 'Stock Item', NULL, NULL, 0, '0', 'Milo bubuk', NULL, '67500', '2012-07-13 15:58:15', 0, 0, 74300, '0', NULL, '2012-07-13 00:00:00', '2012-07-13 00:00:00', ' ', 0, 'Kg', NULL, NULL, 0, NULL, 'MILO', 'ÑMILODÓ', NULL, NULL, NULL, NULL, NULL, 2390, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('MON', NULL, 'Stock Item', 'KOMPUTER', NULL, 10, '0', 'Monitor Samsung', NULL, '800000', '2016-01-15 12:31:30', 0, 1500000, 880000, '0', NULL, '2016-01-15 12:28:37', '2011-07-15 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, 'MON', 'ÑMONhÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 1405000000, 69, 0, 0, 0, 16, NULL, 0, 0, 83, 0, 0, 0, -14, 0, 0, 0, 0, 277500000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('MOUSE', NULL, 'Stock Item', 'KOMPUTER', NULL, 10, '0', 'Mouse Logitect', NULL, '20000', '2016-01-15 12:31:30', 0, 10000, 22000, '0', NULL, '2016-01-15 12:28:37', '2011-07-15 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, 'MOUSE', 'ÑMOUSEfÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 1255000000, 469, 0, 0, 0, 16, NULL, 0, 0, 483, 0, 0, 0, -14, 0, 0, 0, 0, 9850000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('ONGKOS', NULL, 'Stock Item', NULL, NULL, 0, '0', 'ONGKOS', NULL, '0', '2012-11-16 00:00:00', 0, 0, 0, '0', NULL, '2012-11-16 00:00:00', '2012-11-16 00:00:00', ' ', 0, '.', NULL, NULL, 0, NULL, 'ONGKOS', 'ÑONGKOSKÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PakuDus', NULL, 'Stock Item', NULL, NULL, 0, '0', 'Paku yang dus', NULL, '0', '2012-10-01 00:00:00', 0, 0, 0, '0', NULL, '2012-10-01 00:00:00', '2012-10-01 00:00:00', ' ', 0, 'Dus', NULL, NULL, 0, NULL, 'PakuDus', 'ÑPakuDusZÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 0', NULL, 'Custom Field 1', NULL, 'Custom Field 2', 'Custom Field 0', 'Custom Field 3', NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PKTA', NULL, 'Stock Item', 'KOMPUTER', NULL, 6, '0', 'Paket Hemat Komputer', '.', '12900', '2016-02-17 13:29:04', 14200, 1400000, 14200, '0', NULL, '2015-11-19 22:08:33', '2011-07-15 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, 'PKTA', 'ÑPKTA+Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 46504000, -4, 100, 0, 18, 8, NULL, 1, 0, 3, 0, 0, 0, -7, 0, 0, 0, 0, 10347999.97, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', 'Custom 0', 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PKTB', NULL, 'Stock Item', NULL, NULL, 0, '0', 'Paket Hemat Food', NULL, '0', '2012-10-05 11:27:50', 0, 0, 12000, '0', NULL, '2012-10-23 00:00:00', '2012-10-23 00:00:00', ' ', 0, NULL, NULL, NULL, 0, NULL, 'PKTB', 'ÑPKTB/Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PNIKAHA', NULL, 'Stock Item', NULL, NULL, 0, '0', 'Paket Pernikahan A', NULL, '0', '2012-11-23 00:00:00', 0, 0, 0, '0', NULL, '2012-11-23 00:00:00', '2012-11-23 00:00:00', '0', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, 'CRBATH', NULL, 'FAOZ', NULL, 'TOWA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PROC', NULL, 'Stock Item', 'KOMPUTER', NULL, 0, '0', 'Processor Intel Dual Core', NULL, '5000000', '2014-10-10 14:45:49', 0, 0, 5500000, '0', NULL, '2013-03-05 07:22:25', '2011-07-15 00:00:00', ' ', 0, 'Pcs', NULL, NULL, 0, NULL, 'PROC', 'ÑPROC2Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 21435000, -29, 0, 0, 14, 0, NULL, 0, 0, -15, 0, 0, 0, -14, 0, 0, 0, 0, 5000000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('R001', NULL, 'Stock Item', 'Minuman', 'resto', 0, '10', 'Bir Bintang', '.', '1', '2015-11-19 22:03:02', 50000, 50000, 1000, '0', NULL, '2015-11-18 08:51:39', '2014-01-11 00:00:00', '1', 0, NULL, NULL, NULL, 0, NULL, 'R001', 'ÑR001ÉÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 6300000, 14, 0, 0, 0, 1, NULL, 1, 0, 4, 6, 0, 1, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', '.', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 500, 300, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 20, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('R002', NULL, 'Stock Item', 'Drink', 'resto', 20, '10', 'Kopi Hitam', '.', '700', '2013-04-12 17:39:12', 0, 0, 800, '0', '0', '2013-05-11 11:09:03', '2012-12-08 00:00:00', '0', 0, 'PCS', 'A100', NULL, 0, NULL, 'R002', 'ÑR002ÍÓ', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3226720, 0, 0, 1002, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 931817.96, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', '.', NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 5000, 3000, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 20, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('R003', NULL, 'Stock Item', 'Food', 'resto', 0, '0', 'Nasi Goreng Special', NULL, '0', NULL, 0, 0, 0, '0', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 'Ò*  ,Í9|Ó', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('S100001', NULL, 'Stock', 'S', NULL, -1, 'ALFAMART', 'Spartpart pintu', NULL, NULL, '2015-11-16 14:02:51', 0, 0, 0, '0', NULL, '2015-11-16 00:00:00', '2015-11-16 00:00:00', ' ', 0, 'PCS', 'R1.3.S2', 'S2', 0, NULL, 'S100001', 'ÑSÌ* !oÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 100, 99, 0, 0, 0, 0, NULL, 0, 96, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 0', NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SABUN', NULL, 'Stock Item', NULL, NULL, 0, '0', 'SABUN', NULL, '800', '2012-11-15 11:18:38', 0, 0, 900, '0', NULL, '2012-11-15 11:36:29', '2012-11-15 00:00:00', ' ', 0, 'BTL', NULL, NULL, 0, NULL, 'SABUN', 'ÑSABUNLÓ', NULL, NULL, NULL, NULL, NULL, 2390, 1415, 1419, 1000, 0, 0, 1, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 80036.5987, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SALDO', NULL, 'Stock Item', NULL, NULL, 0, '0', 'SALDO', NULL, '1000000', '2011-07-12 23:01:23', 0, 0, 1100000, '0', NULL, '2012-09-19 00:00:00', '2012-09-19 00:00:00', ' ', 0, '.', NULL, NULL, 0, NULL, 'SALDO', 'ÑSALDO+Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 1, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 145970000.01, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SHAMPO', NULL, 'Stock Item', NULL, NULL, 0, '0', 'SHAMPO', NULL, '400', '2012-11-15 00:00:00', 0, 0, 500, '0', NULL, '2012-11-15 11:17:50', '2012-11-15 00:00:00', ' ', 0, 'Btl', NULL, NULL, 0, NULL, 'SHAMPO', 'ÑSHAMPO&Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 120000, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 39539.9969, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SM001', NULL, 'Stock Item', 'Komputer', NULL, 0, '0', 'Smartfren HP Si', NULL, '1000000', '2014-02-27 19:59:41', 0, 0, 1200000, '0', NULL, '2013-09-01 09:54:04', '2013-09-07 00:00:00', ' ', 0, 'pcs', NULL, NULL, 0, NULL, 'SM001', 'ÑSM001>Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SMILD', NULL, 'Stock Item', 'BEKEL', NULL, 0, '0', 'SAMPURNA MILD', NULL, '10000', '2014-10-14 17:45:54', 0, 0, 20000, '0', NULL, '2014-10-14 17:40:31', '2014-10-14 00:00:00', ' ', 0, 'PCS', 'ALFAMART', NULL, 0, NULL, 'SMILD', 'ÑSMILD#Ó', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 2520000, 0, 0, 3, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20000, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('TOWA', NULL, 'Stock Item', 'Makanan', NULL, 0, '0', 'Totok Wajah', NULL, '30000', '2012-11-23 00:00:00', 0, 0, 33000, '0', '0', '2012-11-23 00:00:00', '2012-11-23 00:00:00', '0', 0, 'pcs', NULL, NULL, 0, NULL, 'TOWA', 'ÑTOWA@Ó', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom 1', NULL, 'Custom 2', NULL, 'Custom 3', 'Custom 0', NULL, NULL, 'Custom 4', NULL, 'Custom 5', NULL, 'Custom 6', NULL, 'Custom 7', NULL, 'Custom 8', NULL, 'Custom 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0.05, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('TYPE-36', NULL, 'Stock Item', 'Rumah', NULL, 0, '0', 'Rumah Type 36', NULL, '0', '2010-09-23 00:00:00', 0, 0, 0, '0', NULL, '2011-06-02 19:17:08', '2010-09-23 00:00:00', ' ', 0, 'Unit', NULL, NULL, 0, NULL, 'TYPE-36', 'ÑTYPE-36gÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, 0, 0, 0, 0, 0, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 2, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('XL', NULL, 'Stock Item', 'PLASTIK', NULL, 0, '0', 'KANTONG PELASTIK XL', NULL, '1000000', '2014-05-20 00:00:00', 0, 0, 0, '0', NULL, '2014-05-20 00:00:00', '2014-05-20 00:00:00', ' ', 0, 'PCS', NULL, NULL, 0, NULL, 'XL', 'ÑXLJÓ', NULL, NULL, NULL, NULL, NULL, 1374, 1415, 1419, 0, -2, 0, 0, 2, 0, NULL, 0, 0, -2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1, NULL, 'Custom Field 1', NULL, 'Custom Field 2', NULL, 'Custom Field 3', 'Custom Field 0', NULL, NULL, 'Custom Field 4', NULL, 'Custom Field 5', NULL, 'Custom Field 6', NULL, 'Custom Field 7', NULL, 'Custom Field 8', NULL, 'Custom Field 9', 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('CASGBRHB4', b'10000000', 'Stock Item', 'Stock Item', 'ASG', NULL, 'Megatex', 'CASUAL BR HB4', NULL, NULL, NULL, 0, 0, 80500, NULL, NULL, NULL, NULL, NULL, NULL, 'Lusin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;


-- Dumping structure for table simak.inventorysource
CREATE TABLE IF NOT EXISTS `inventorysource` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `unit_of_measure` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `quantity_in_stock` int(11) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventorysource: 0 rows
/*!40000 ALTER TABLE `inventorysource` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventorysource` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_assembly
CREATE TABLE IF NOT EXISTS `inventory_assembly` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `assembly_item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comment` varchar(150) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `default_cost` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  UNIQUE KEY `x1` (`item_number`,`assembly_item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_assembly: 0 rows
/*!40000 ALTER TABLE `inventory_assembly` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_assembly` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_beginning_balance
CREATE TABLE IF NOT EXISTS `inventory_beginning_balance` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `amount_awal` double DEFAULT NULL,
  `amount_trans` double DEFAULT NULL,
  `amount_akhir` double DEFAULT NULL,
  `qty_awal_gd1` int(11) DEFAULT NULL,
  `qty_trans_gd1` int(11) DEFAULT NULL,
  `qty_akhir_gd1` int(11) DEFAULT NULL,
  `qty_awal_gd2` int(11) DEFAULT NULL,
  `qty_trans_gd2` int(11) DEFAULT NULL,
  `qty_akhir_gd2` int(11) DEFAULT NULL,
  `qty_awal_gd3` int(11) DEFAULT NULL,
  `qty_trans_gd3` int(11) DEFAULT NULL,
  `qty_akhir_gd3` int(11) DEFAULT NULL,
  `qty_awal_gd4` int(11) DEFAULT NULL,
  `qty_trans_gd4` int(11) DEFAULT NULL,
  `qty_akhir_gd4` int(11) DEFAULT NULL,
  `qty_awal_gd5` int(11) DEFAULT NULL,
  `qty_trans_gd5` int(11) DEFAULT NULL,
  `qty_akhir_gd5` int(11) DEFAULT NULL,
  `qty_awal_gd6` int(11) DEFAULT NULL,
  `qty_trans_gd6` int(11) DEFAULT NULL,
  `qty_akhir_gd6` int(11) DEFAULT NULL,
  `qty_awal_gd7` int(11) DEFAULT NULL,
  `qty_trans_gd7` int(11) DEFAULT NULL,
  `qty_akhir_gd7` int(11) DEFAULT NULL,
  `qty_awal_gd8` int(11) DEFAULT NULL,
  `qty_trans_gd8` int(11) DEFAULT NULL,
  `qty_akhir_gd8` int(11) DEFAULT NULL,
  `qty_awal_gd9` int(11) DEFAULT NULL,
  `qty_trans_gd9` int(11) DEFAULT NULL,
  `qty_akhir_gd9` int(11) DEFAULT NULL,
  `qty_awal_gd10` int(11) DEFAULT NULL,
  `qty_trans_gd10` int(11) DEFAULT NULL,
  `qty_akhir_gd10` int(11) DEFAULT NULL,
  `ttlqty_awal` int(11) DEFAULT NULL,
  `ttlqty_trans` int(11) DEFAULT NULL,
  `ttlqty_akhir` int(11) DEFAULT NULL,
  `qtyin` int(11) DEFAULT NULL,
  `qtyout` int(11) DEFAULT NULL,
  `amountin` double DEFAULT NULL,
  `amountout` double DEFAULT NULL,
  `flagawal` int DEFAULT NULL,
  `hpp_awal` double DEFAULT NULL,
  `hpp_akhir` double DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  UNIQUE KEY `x1` (`item_number`,`tanggal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_beginning_balance: 0 rows
/*!40000 ALTER TABLE `inventory_beginning_balance` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_beginning_balance` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_categories
CREATE TABLE IF NOT EXISTS `inventory_categories` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `custom_label_1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_3` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_4` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_5` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_6` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_7` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_8` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_9` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custom_label_10` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `parent_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `item_picture` varchar(150) DEFAULT NULL,
  `description` varchar(350) DEFAULT NULL,
  `icon_picture` varchar(150) DEFAULT NULL,
  `sales_disc_prc` double DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_categories: 3 rows
/*!40000 ALTER TABLE `inventory_categories` DISABLE KEYS */;
REPLACE INTO `inventory_categories` (`kode`, `category`, `update_status`, `custom_label_1`, `custom_label_2`, `custom_label_3`, `custom_label_4`, `custom_label_5`, `custom_label_6`, `custom_label_7`, `custom_label_8`, `custom_label_9`, `custom_label_10`, `sourceautonumber`, `sourcefile`, `parent_id`, `create_date`, `create_by`, `update_date`, `update_by`, `item_picture`, `description`, `icon_picture`, `sales_disc_prc`) VALUES
	('MAKANAN', 'MAKANAN', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '2016-03-12 00:00:00', '', '2016-03-12 00:00:00', '', '', '', '', 0),
	('MINUMAN', 'MINUMAN', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '2016-03-12 00:00:00', '', '2016-03-12 00:00:00', '', '', '', '', 0),
	('KERAMIK', 'KERAMIK', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '2016-03-12 00:00:00', '', '2016-03-12 00:00:00', '', '', '', '', 0);
/*!40000 ALTER TABLE `inventory_categories` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_class
CREATE TABLE IF NOT EXISTS `inventory_class` (
  `kode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `class` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_class: 5 rows
/*!40000 ALTER TABLE `inventory_class` DISABLE KEYS */;
REPLACE INTO `inventory_class` (`kode`, `class`, `id`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	('Stock Item', 'Stock Item', 6, NULL, NULL, NULL),
	('Service', 'Service', 7, NULL, NULL, NULL),
	('Employee', 'Employee', 8, NULL, NULL, NULL),
	('Labour', 'Labour', 9, NULL, NULL, NULL),
	('Material', 'Material', 14, NULL, NULL, NULL);
/*!40000 ALTER TABLE `inventory_class` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_moving
CREATE TABLE IF NOT EXISTS `inventory_moving` (
  `transfer_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_trans` datetime DEFAULT NULL,
  `from_location` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `from_qty` int(11) DEFAULT NULL,
  `to_location` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `to_qty` int(11) DEFAULT NULL,
  `trans_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comments` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `trans_type` varchar(10) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `verify_by` varchar(50) DEFAULT NULL,
  `verify_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`transfer_id`,`item_number`,`date_trans`,`from_location`,`to_location`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_moving: 2 rows
/*!40000 ALTER TABLE `inventory_moving` DISABLE KEYS */;
REPLACE INTO `inventory_moving` (`transfer_id`, `item_number`, `date_trans`, `from_location`, `from_qty`, `to_location`, `to_qty`, `trans_by`, `cost`, `update_status`, `id`, `comments`, `trans_type`, `total_amount`, `unit`, `status`, `verify_by`, `verify_date`) VALUES
	('TRX00012', 'R001', '2016-03-17 17:59:00', 'Cawang', 1, 'Gudang', 1, NULL, 50000, NULL, 1, '', NULL, 50000, '', '0', NULL, NULL),
	('TRX00012', '00035', '2016-03-17 17:59:00', 'Cawang', 1, 'Gudang', 1, NULL, -1, NULL, 2, '', NULL, -1, '', '0', NULL, NULL);
/*!40000 ALTER TABLE `inventory_moving` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_prices
CREATE TABLE IF NOT EXISTS `inventory_prices` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer_pricing_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `retail` double DEFAULT NULL,
  `quantity_high` int(11) DEFAULT NULL,
  `quantity_low` int(11) DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  UNIQUE KEY `x1` (`item_number`,`customer_pricing_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_prices: 0 rows
/*!40000 ALTER TABLE `inventory_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_prices` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_price_customers
CREATE TABLE IF NOT EXISTS `inventory_price_customers` (
  `item_no` varchar(50) DEFAULT NULL,
  `cust_type` varchar(50) DEFAULT NULL,
  `sales_price` double DEFAULT NULL,
  `disc_prc_from` double DEFAULT NULL,
  `min_qty` double DEFAULT NULL,
  `disc_prc_to` double DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `cust_no` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `disc_amount` double DEFAULT NULL,
  `disc_prc_2` double DEFAULT NULL,
  `disc_prc_3` double DEFAULT NULL,
  `min_qty_sold` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.inventory_price_customers: 13 rows
/*!40000 ALTER TABLE `inventory_price_customers` DISABLE KEYS */;
REPLACE INTO `inventory_price_customers` (`item_no`, `cust_type`, `sales_price`, `disc_prc_from`, `min_qty`, `disc_prc_to`, `description`, `id`, `cust_no`, `category`, `disc_amount`, `disc_prc_2`, `disc_prc_3`, `min_qty_sold`) VALUES
	(NULL, NULL, 1, NULL, NULL, 1, 'Minuman', 1, NULL, 'MI', 1, NULL, NULL, NULL),
	(NULL, NULL, 1, NULL, NULL, 1, 'Minuman', 2, NULL, 'MI', 1, NULL, NULL, NULL),
	(NULL, NULL, 1, NULL, NULL, 1, 'Minuman', 3, NULL, 'MI', 1, NULL, NULL, NULL),
	(NULL, NULL, 1, NULL, NULL, 1, 'Minuman', 4, NULL, 'MI', 1, NULL, NULL, NULL),
	(NULL, NULL, 1, NULL, NULL, 1, 'Minuman', 5, NULL, 'MI', 1, NULL, NULL, NULL),
	(NULL, NULL, 0, NULL, NULL, 20, 'Makanan', 6, '12292', 'MA', 0, 14, 10, NULL),
	(NULL, NULL, 0, NULL, NULL, 10, 'Minuman', 7, '12292', 'MI', 0, 20, 15, NULL),
	(NULL, NULL, 21, NULL, NULL, 2, 'Bahan Bangunan', 8, '12292', 'BA', 34, NULL, NULL, NULL),
	(NULL, NULL, 0, NULL, NULL, 0, 'Barang Jadi', 9, '12292', 'BJ', 0, NULL, NULL, NULL),
	(NULL, NULL, 0, NULL, NULL, 10, 'Minuman', 10, '39393', 'MI', 0, NULL, NULL, NULL),
	(NULL, NULL, 0, NULL, NULL, 12, 'Fashion', 11, '39393', 'FA', 0, NULL, NULL, NULL),
	(NULL, NULL, 0, NULL, 30, 30, 'MINUMAN', 15, '101', 'MINUMAN', 0, 5, 20, NULL),
	(NULL, NULL, 0, NULL, 12, 1, 'KERAMIK', 16, '101', 'KERAMIK', 0, 2, 3, NULL);
/*!40000 ALTER TABLE `inventory_price_customers` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_price_history
CREATE TABLE IF NOT EXISTS `inventory_price_history` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_changed` datetime DEFAULT NULL,
  `po_or_so` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sales_price` double DEFAULT NULL,
  `order_price` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_price_history: 0 rows
/*!40000 ALTER TABLE `inventory_price_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_price_history` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_products
CREATE TABLE IF NOT EXISTS `inventory_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipment_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `warehouse_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `purchase_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quantity_in_stock` int(11) DEFAULT NULL,
  `quantity_received` int(11) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `selected` tinyint(1) DEFAULT NULL,
  `other_doc_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `receipt_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `receipt_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `production_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `multi_unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mu_qty` int(11) DEFAULT NULL,
  `mu_price` double DEFAULT NULL,
  `new_cost` double DEFAULT NULL,
  `from_line_number` int(11) DEFAULT NULL,
  `tanggal_jual` datetime DEFAULT NULL,
  `no_faktur_beli` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_faktur_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_do_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal_beli` datetime DEFAULT NULL,
  `no_retur_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `serial_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `retail` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `x1` (`item_number`,`shipment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_products: 3 rows
/*!40000 ALTER TABLE `inventory_products` DISABLE KEYS */;
REPLACE INTO `inventory_products` (`id`, `item_number`, `shipment_id`, `date_received`, `cost`, `supplier_number`, `warehouse_code`, `color`, `size`, `purchase_order_number`, `quantity_in_stock`, `quantity_received`, `total_amount`, `selected`, `other_doc_number`, `receipt_type`, `receipt_by`, `comments`, `production_code`, `unit`, `multi_unit`, `mu_qty`, `mu_price`, `new_cost`, `from_line_number`, `tanggal_jual`, `no_faktur_beli`, `no_faktur_jual`, `no_do_jual`, `tanggal_beli`, `no_retur_jual`, `update_status`, `sourceautonumber`, `sourcefile`, `serial_number`, `create_date`, `create_by`, `update_date`, `update_by`, `retail`) VALUES
	(1, '100', 'ADJ00010', '2016-03-12 15:47:00', 50000, NULL, 'Gudang', NULL, NULL, NULL, NULL, 1, 50000, NULL, NULL, 'ADJ', NULL, '', NULL, '', '', 1, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, '10201', 'ADJ00010', '2016-03-12 15:47:00', 120000, NULL, 'Gudang', NULL, NULL, NULL, NULL, 1, 120000, NULL, NULL, 'ADJ', NULL, '', NULL, 'Pcs', 'Pcs', 1, 120000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, '100', 'RPRD00006', '2016-03-12 17:08:00', 50000, NULL, 'Cawang', NULL, NULL, 'WO-00017', NULL, 1, 50000, NULL, NULL, 'RCV_PROD', NULL, '', NULL, '', '', 1, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `inventory_products` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_promotion
CREATE TABLE IF NOT EXISTS `inventory_promotion` (
  `kode` varchar(20) CHARACTER SET utf8 NOT NULL,
  `datefrom` datetime DEFAULT NULL,
  `dateto` datetime DEFAULT NULL,
  `discpercent` int(11) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `keterangan` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `promotype` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sundayprc` double(11,0) DEFAULT NULL,
  `mondayprc` double(11,0) DEFAULT NULL,
  `tuesdayprc` double(11,0) DEFAULT NULL,
  `wednesdayprc` double(11,0) DEFAULT NULL,
  `thursdayprc` double(11,0) DEFAULT NULL,
  `fridayprc` double(11,0) DEFAULT NULL,
  `saturdayprc` double(11,0) DEFAULT NULL,
  `active` int DEFAULT NULL,
  `update_status` double(11,0) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_promotion: 0 rows
/*!40000 ALTER TABLE `inventory_promotion` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_promotion` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_sales_disc
CREATE TABLE IF NOT EXISTS `inventory_sales_disc` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `datefrom` datetime DEFAULT NULL,
  `timefrom` datetime DEFAULT NULL,
  `sunday` double(11,0) DEFAULT NULL,
  `monday` double(11,0) DEFAULT NULL,
  `tuesday` double(11,0) DEFAULT NULL,
  `wednesday` double(11,0) DEFAULT NULL,
  `thursday` double(11,0) DEFAULT NULL,
  `friday` double(11,0) DEFAULT NULL,
  `saturday` double(11,0) DEFAULT NULL,
  `update_status` double(11,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_sales_disc: 0 rows
/*!40000 ALTER TABLE `inventory_sales_disc` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_sales_disc` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_serialized_items
CREATE TABLE IF NOT EXISTS `inventory_serialized_items` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipment_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `comment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_activated` datetime DEFAULT NULL,
  `date_expired` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `month_guaranted` int(11) DEFAULT NULL,
  `tanggal_jual` datetime DEFAULT NULL,
  `no_faktur_beli` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_faktur_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_do_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal_beli` datetime DEFAULT NULL,
  `no_retur_beli` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_retur_jual` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`item_number`,`serial_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_serialized_items: 0 rows
/*!40000 ALTER TABLE `inventory_serialized_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_serialized_items` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_suppliers
CREATE TABLE IF NOT EXISTS `inventory_suppliers` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lead_time` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  UNIQUE KEY `x1` (`item_number`,`supplier_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_suppliers: 0 rows
/*!40000 ALTER TABLE `inventory_suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_suppliers` ENABLE KEYS */;


-- Dumping structure for table simak.inventory_warehouse
CREATE TABLE IF NOT EXISTS `inventory_warehouse` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `warehouse_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `reorderlevel` int(11) DEFAULT NULL,
  `lastorderdate` datetime DEFAULT NULL,
  `lastorderqty` int(11) DEFAULT NULL,
  `whtype` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `max_qty` int(11) DEFAULT NULL,
  `opening_qty` int(11) DEFAULT NULL,
  `trx_qty` int(11) DEFAULT NULL,
  `ending_qty` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `topten` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_able` int DEFAULT NULL,
  `tax_abcle` int DEFAULT NULL,
  `ignore_qty_check` int DEFAULT NULL,
  `sales_commision_percent` int DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `manufacturer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `model` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `qstep1` int(11) DEFAULT NULL,
  `pricestep1` double DEFAULT NULL,
  `qstep2` int(11) DEFAULT NULL,
  `pricestep2` double DEFAULT NULL,
  `qstep3` int(11) DEFAULT NULL,
  `pricestep3` double DEFAULT NULL,
  `minprice` double DEFAULT NULL,
  `matrix` int(11) DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`item_number`,`warehouse_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.inventory_warehouse: 0 rows
/*!40000 ALTER TABLE `inventory_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_warehouse` ENABLE KEYS */;


-- Dumping structure for table simak.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_number` varchar(20) CHARACTER SET utf8 NOT NULL,
  `invoice_type` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `sales_order_number` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_invoice` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `sold_to_customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ship_to_customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `your_order__` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `source_of_order` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_terms` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salesman` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `fob` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `shipped_via` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `tax_2` double DEFAULT NULL,
  `freight` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `other` double DEFAULT NULL,
  `paid` int(1) DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `sales_tax_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent` double DEFAULT NULL,
  `sales_tax2_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent_2` double DEFAULT NULL,
  `posted` int(1) DEFAULT NULL,
  `posting_gl_id` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `batch_post` int(1) DEFAULT NULL,
  `finance_charge` int(1) DEFAULT NULL,
  `department` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `truck` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `capacity` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `printed` int(1) DEFAULT NULL,
  `payment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `insurance` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `packing` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `discount_2` double DEFAULT NULL,
  `discount_3` double DEFAULT NULL,
  `print_counter` int(11) DEFAULT NULL,
  `uang_muka` double DEFAULT NULL,
  `saldo_invoice` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `audit_status` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `ppn_amount` double DEFAULT NULL,
  `do_invoiced` int(1) DEFAULT NULL,
  `your_order_date` datetime DEFAULT NULL,
  `disc_amount` double DEFAULT NULL,
  `sales_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `promosi_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `no_so_text` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `no_po_text` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `currency_code` varchar(50) DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `warehouse_code` varchar(50) DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  PRIMARY KEY (`invoice_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice: 40 rows
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
REPLACE INTO `invoice` (`invoice_number`, `invoice_type`, `sales_order_number`, `type_of_invoice`, `account_id`, `sold_to_customer`, `ship_to_customer`, `invoice_date`, `your_order__`, `source_of_order`, `payment_terms`, `salesman`, `fob`, `shipped_via`, `tax`, `tax_2`, `freight`, `discount`, `other`, `paid`, `comments`, `sales_tax_code`, `sales_tax_percent`, `sales_tax2_code`, `sales_tax_percent_2`, `posted`, `posting_gl_id`, `batch_post`, `finance_charge`, `department`, `truck`, `capacity`, `printed`, `payment`, `insurance`, `packing`, `discount_2`, `discount_3`, `print_counter`, `uang_muka`, `saldo_invoice`, `amount`, `disc_amount_1`, `disc_amount_2`, `disc_amount_3`, `total_amount`, `audit_status`, `org_id`, `update_status`, `ppn_amount`, `do_invoiced`, `your_order_date`, `disc_amount`, `sales_name`, `promosi_code`, `create_date`, `create_by`, `update_date`, `update_by`, `no_so_text`, `no_po_text`, `currency_code`, `currency_rate`, `warehouse_code`, `subtotal`, `due_date`) VALUES
	('K01-00279', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-25 08:55:22', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 800, 1, '0', 'PPN', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00278', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-24 22:12:07', NULL, 'POS', 'CASH', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00277', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 15:27:03', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 100, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00277', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00276', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 15:21:24', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00276', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00272', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 15:21:07', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00272', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('JRE00033', 'R', NULL, 'Simple', 1373, '101', '101', '2016-02-19 15:16:28', 'J00053', NULL, 'PO Net 30', NULL, NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, 'JRE00033', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 24749999.96, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '2016-02-19 15:16:28', 0, NULL, NULL, '2016-02-19 15:16:50', 'Administrator', '2016-02-19 15:16:50', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00275', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 15:11:14', 'J00053', 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00275', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00274', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 15:04:25', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00274', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00273', 'I', NULL, 'Simple', 1485, '101', '101', '2016-02-19 14:53:09', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 400, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00273', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00271', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:49:48', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00271', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00270', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:47:50', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00270', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'DIAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00269', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:46:33', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00269', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'AGUS,JOKO,UNUN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00268', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:45:48', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 300, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00268', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'KASIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00267', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:44:59', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00267', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'KASIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00266', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:43:44', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00266', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'KASIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00265', 'I', NULL, 'Simple', 1485, '101', '101', '2016-02-19 14:35:07', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00265', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'KASIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00264', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:31:49', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 800, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00264', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'KASIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00263', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:30:13', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 200, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00263', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'KASIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00262', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:23:31', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 400, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00262', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'KASIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00261', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:21:44', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 800, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00261', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'KASIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00260', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-19 14:15:46', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00260', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, 'KASIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('J00056', 'I', 'SO00190', 'Simple', 1373, '103', '103', '2016-02-18 20:38:45', ',', NULL, 'PO Net 15', 'IDAD', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, 'J00056', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 15750000, 9000000, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '2016-02-18 20:38:45', 0, NULL, NULL, '2016-02-18 20:38:46', 'Administrator', '2016-02-18 20:38:45', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-04 20:38:45'),
	('J00055', 'I', 'SO00189', 'Simple', 1373, '71383', '71383', '2016-02-18 19:55:52', ',', NULL, 'PO Net 15', 'DIAN', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, 'J00055', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1000000, 23000000, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '2002-10-10 00:00:00', 0, NULL, NULL, '2016-02-18 20:06:16', 'Administrator', '2016-02-18 20:06:36', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-04 19:55:52'),
	('J00054', 'I', 'SO00188', 'Simple', 1373, '90120', '90120', '2016-02-18 18:06:54', ',', NULL, 'PO Net 15', 'AGUS', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, 'J00054', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 109800, -19800, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '2002-10-10 00:00:00', 0, NULL, NULL, '2016-02-18 18:07:27', 'Administrator', '2016-02-18 18:13:41', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-04 18:06:54'),
	('JDO0058', 'D', 'SO00186', 'Simple', 1373, '101', '101', '2016-02-18 17:02:07', 'SO00186', NULL, NULL, 'AGUS', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 24750000, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, 1, '2016-02-18 16:59:39', 0, NULL, NULL, '2016-02-18 17:02:15', 'Administrator', '2016-02-18 17:02:15', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('J00053', 'I', 'JDO0057', 'Simple', 1373, '101', '101', '2016-02-18 17:00:39', NULL, NULL, 'PO Net 15', 'AGUS', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, 'J00053', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 62370.041, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '2016-02-18 17:00:39', 0, NULL, NULL, '2016-02-18 17:02:06', 'Administrator', '2016-02-18 17:02:05', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-04 17:00:39'),
	('JDO0057', 'D', 'SO00174,SO00186', 'Simple', 1373, '101', '101', '2016-02-18 17:00:39', 'SO00174,SO00186', NULL, NULL, 'AGUS', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 24849000, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, 1, '2016-02-18 16:59:39', 0, NULL, NULL, '2016-02-18 17:00:48', 'Administrator', '2016-02-18 17:01:54', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('JDO0056', 'D', 'SO00186', 'Simple', 1373, '101', '101', '2016-02-18 16:59:39', 'SO00186', NULL, NULL, 'AGUS', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 24750000, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, 1, '2016-02-18 16:59:39', 0, NULL, NULL, '2016-02-18 16:59:39', 'Administrator', '2016-02-18 16:59:39', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00259', 'I', NULL, 'Simple', 1370, 'CASH', 'CASH', '2016-02-18 12:18:06', NULL, 'POS', 'CASH', 'KASIR', NULL, NULL, 0, 0, 0, 0, 300, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00259', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00258', 'I', NULL, 'Simple', 1370, 'CASH', 'CASH', '2016-02-18 12:05:58', NULL, 'POS', 'CASH', 'KASIR', NULL, NULL, 0, 0, 0, 0, 400, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00258', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('K01-00257', 'I', NULL, 'Simple', 1485, 'CASH', 'CASH', '2016-02-18 11:51:37', NULL, 'POS', 'Cash', 'KASIR', NULL, NULL, 0, 0, 0, 0, 300, 1, '0', 'PPN', 0, NULL, 0, NULL, 'K01-00257', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, 0, 0, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('T00007', 'I', NULL, 'Simple', 1370, '90120', '90120', '2016-02-25 16:36:15', NULL, NULL, 'TUNAI', NULL, NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, -7805653.1, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '2016-02-25 16:36:15', 0, NULL, NULL, '2016-02-25 16:36:32', 'Administrator', '2016-02-25 16:36:32', 'Administrator', NULL, NULL, NULL, NULL, 'Toko', 3345279.9, NULL),
	('JDO0059', 'D', 'SO00191', 'Simple', 1373, '90120', '90120', '2016-02-25 16:50:09', 'SO00191', NULL, NULL, 'DIAN', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 11115, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '2016-02-25 16:50:09', 0, NULL, NULL, '2016-02-25 16:50:13', 'Administrator', '2016-02-25 16:50:13', 'Administrator', NULL, NULL, NULL, NULL, 'Toko', NULL, NULL),
	('J00057', 'I', 'SO00191', 'Simple', 1373, '90120', '90120', '2016-02-25 16:51:31', ',', NULL, 'PO Net 15', 'JONO', NULL, NULL, 0, 0, 0, 0, 0, 1, '0', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 22230, 1116600, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '2016-02-25 16:51:31', 0, NULL, NULL, '2016-02-25 16:51:36', 'Administrator', '2016-02-25 16:51:36', 'Administrator', NULL, NULL, NULL, NULL, 'Toko', 22230, '2016-03-11 16:51:31'),
	('PJL00167', 'I', NULL, 'Simple', NULL, 'CASH', NULL, '2016-03-12 15:41:01', NULL, NULL, 'CASH', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1116600, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-12 15:41:01'),
	('PJL00168', 'I', NULL, 'Simple', NULL, 'CASH', NULL, '2016-03-12 16:02:45', NULL, NULL, 'CASH', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1116600, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-12 16:02:45'),
	('PJL00169', 'I', NULL, 'Simple', NULL, 'CASH', NULL, '2016-03-12 16:56:07', NULL, NULL, 'CASH', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1116600, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-12 16:56:07'),
	('PJL00170', 'I', NULL, 'Simple', NULL, 'CASH', NULL, '2016-03-12 17:00:10', NULL, NULL, 'CASH', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1116600, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-12 17:00:10'),
	('PJL00171', 'I', 'MULTI DO', 'Simple', NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, NULL, 0, NULL, 0, 0, 0, 0, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 71544, 71544, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Cawang', 71544, '2016-05-16 12:00:00'),
	('SJ00054', 'D', 'SO00119', NULL, NULL, '101', NULL, '2016-03-17 18:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Cawang', NULL, '2016-03-17 00:00:00');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_delivery_order_info
CREATE TABLE IF NOT EXISTS `invoice_delivery_order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `do_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `reason_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `reason_date` datetime DEFAULT NULL,
  `comments` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_delivery_order_info: 0 rows
/*!40000 ALTER TABLE `invoice_delivery_order_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_delivery_order_info` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_lineitems
CREATE TABLE IF NOT EXISTS `invoice_lineitems` (
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` double(11,2) DEFAULT NULL,
  `unit` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `discount` double(11,2) DEFAULT NULL,
  `taxable` int DEFAULT NULL,
  `shipped` int DEFAULT NULL,
  `ship_date` datetime DEFAULT NULL,
  `ship_qty` double(11,0) DEFAULT NULL,
  `bo_qty` double(11,0) DEFAULT NULL,
  `serial_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `job_reference` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `warehouse_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `revenue_acct_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `currency_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `quality` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `packing_material` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `multi_unit` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `mu_qty` double(11,2) DEFAULT NULL,
  `mu_harga` double DEFAULT NULL,
  `forex_price` double DEFAULT NULL,
  `base_curr_amount` double DEFAULT NULL,
  `disc_2` double(11,2) DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double(11,2) DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `ppn_amount` double DEFAULT NULL,
  `nett_amount` double DEFAULT NULL,
  `from_line_number` double DEFAULT NULL,
  `from_line_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `from_line_doc` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `discount_addition` int(11) DEFAULT NULL,
  `printcount` int(11) DEFAULT NULL,
  `tax_amount` double DEFAULT NULL,
  `sales_comm_percent` int(11) DEFAULT NULL,
  `sales_comm_amount` double DEFAULT NULL,
  `employee_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_order_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `duration_minute` int(11) DEFAULT NULL,
  `promo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `coa1` int(11) DEFAULT NULL,
  `coa2` int(11) DEFAULT NULL,
  `coa3` int(11) DEFAULT NULL,
  `coa4` int(11) DEFAULT NULL,
  `coa5` int(11) DEFAULT NULL,
  `coa1amt` double DEFAULT NULL,
  `coa2amt` double DEFAULT NULL,
  `coa3amt` double DEFAULT NULL,
  `coa4amt` double DEFAULT NULL,
  `coa5amt` double DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sc_amount` double DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_lineitems: 86 rows
/*!40000 ALTER TABLE `invoice_lineitems` DISABLE KEYS */;
REPLACE INTO `invoice_lineitems` (`invoice_number`, `line_number`, `item_number`, `quantity`, `unit`, `description`, `price`, `discount`, `taxable`, `shipped`, `ship_date`, `ship_qty`, `bo_qty`, `serial_number`, `job_reference`, `comments`, `cost`, `color`, `size`, `warehouse_code`, `revenue_acct_id`, `amount`, `currency_code`, `currency_rate`, `discount_amount`, `quality`, `packing_material`, `multi_unit`, `mu_qty`, `mu_harga`, `forex_price`, `base_curr_amount`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `update_status`, `ppn_amount`, `nett_amount`, `from_line_number`, `from_line_type`, `from_line_doc`, `sourceautonumber`, `sourcefile`, `discount_addition`, `printcount`, `tax_amount`, `sales_comm_percent`, `sales_comm_amount`, `employee_id`, `line_order_type`, `start_time`, `duration_minute`, `promo`, `coa1`, `coa2`, `coa3`, `coa4`, `coa5`, `coa1amt`, `coa2amt`, `coa3amt`, `coa4amt`, `coa5amt`, `create_date`, `create_by`, `update_date`, `update_by`, `sc_amount`) VALUES
	('T00007', 1, '00007', 1.00, 'Btl', 'Mizone', 1700.00, 0.00, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 3500, NULL, NULL, 'Toko', 1415, 1698.3, 'IDR', 1, 1.7, NULL, NULL, 'Btl', 1.00, 1700, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 2, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 10000.00, 0.05, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Toko', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 3, '00004', 1.00, '.', 'Keyboard Logitech', 5000.00, 0.00, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 10000, NULL, NULL, 'Toko', 1415, 4995, 'IDR', 1, 5, NULL, NULL, '.', 1.00, 5000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 4, '00005', 1.00, 'PCS', 'Printer Epson LX300', 1100000.00, 0.00, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 500000, NULL, NULL, 'Toko', 1415, 1098900, 'IDR', 1, 1100, NULL, NULL, 'PCS', 1.00, 1100000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 5, '00064', 1.00, 'PCS', 'CD Lagu Iwan Fals 2013', 6000.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 'Gudang', 1415, 5700, 'IDR', 1, 300, NULL, NULL, 'PCS', 1.00, 6000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 6, '12', 1.00, 'Pcs', 'cat base', 0.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 1, NULL, NULL, 'Gudang', 1415, 0, 'IDR', 1, 0, NULL, NULL, 'Pcs', 1.00, 0, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 7, '1', 1.00, 'Pcs', 'IURAN ASRAMA', 0.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 1, NULL, NULL, 'Gudang', 1415, 0, 'IDR', 1, 0, NULL, NULL, 'Pcs', 1.00, 0, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 8, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 27500000.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Gudang', 1415, 26125000, 'IDR', 1, 1375000, NULL, NULL, 'pcs', 1.00, 27500000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 9, '100', 1.00, 'Pcs', 'Baju Anak Koko', 10000.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 50000, NULL, NULL, 'Gudang', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'Pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('JDO0059', 10, '00007', 1.00, 'Btl', 'Mizone', 1700.00, 0.05, NULL, NULL, '2016-02-25 16:50:09', 1, 0, NULL, NULL, 0, 3500, NULL, NULL, 'Toko', 1415, 1615, 'IDR', 1, 85, NULL, NULL, 'Btl', 1.00, 1700, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 77, 'SO', 'SO00191', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('JDO0059', 11, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 10000.00, 0.05, NULL, NULL, '2016-02-25 16:50:09', 1, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Toko', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 76, 'SO', 'SO00191', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('J00057', 12, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 10000.00, 0.05, NULL, NULL, '2016-02-25 16:51:31', 1, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Toko', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 76, 'SO', 'SO00191', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('J00057', 13, '00007', 1.00, 'Btl', 'Mizone', 1700.00, 0.05, NULL, NULL, '2016-02-25 16:51:31', 1, 0, NULL, NULL, 0, 3500, NULL, NULL, 'Toko', 1415, 1615, 'IDR', 1, 85, NULL, NULL, 'Btl', 1.00, 1700, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 77, 'SO', 'SO00191', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('JDO0059', 14, '00007', 1.00, 'Btl', 'Mizone', 1700.00, 0.05, NULL, NULL, '2016-02-25 16:50:09', 1, 0, NULL, NULL, 0, 3500, NULL, NULL, 'Toko', 1415, 1615, 'IDR', 1, 85, NULL, NULL, 'Btl', 1.00, 1700, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 77, 'SO', 'SO00191', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('JDO0059', 15, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 10000.00, 0.05, NULL, NULL, '2016-02-25 16:50:09', 1, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Toko', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 76, 'SO', 'SO00191', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 16, '00007', 1.00, 'Btl', 'Mizone', 1700.00, 0.00, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 3500, NULL, NULL, 'Toko', 1415, 1698.3, 'IDR', 1, 1.7, NULL, NULL, 'Btl', 1.00, 1700, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 17, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 10000.00, 0.05, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Toko', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 18, '00004', 1.00, '.', 'Keyboard Logitech', 5000.00, 0.00, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 10000, NULL, NULL, 'Toko', 1415, 4995, 'IDR', 1, 5, NULL, NULL, '.', 1.00, 5000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 19, '00005', 1.00, 'PCS', 'Printer Epson LX300', 1100000.00, 0.00, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 500000, NULL, NULL, 'Toko', 1415, 1098900, 'IDR', 1, 1100, NULL, NULL, 'PCS', 1.00, 1100000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 20, '00064', 1.00, 'PCS', 'CD Lagu Iwan Fals 2013', 6000.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 'Gudang', 1415, 5700, 'IDR', 1, 300, NULL, NULL, 'PCS', 1.00, 6000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 21, '12', 1.00, 'Pcs', 'cat base', 0.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 1, NULL, NULL, 'Gudang', 1415, 0, 'IDR', 1, 0, NULL, NULL, 'Pcs', 1.00, 0, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 22, '1', 1.00, 'Pcs', 'IURAN ASRAMA', 0.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 1, NULL, NULL, 'Gudang', 1415, 0, 'IDR', 1, 0, NULL, NULL, 'Pcs', 1.00, 0, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 23, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 27500000.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Gudang', 1415, 26125000, 'IDR', 1, 1375000, NULL, NULL, 'pcs', 1.00, 27500000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 24, '100', 1.00, 'Pcs', 'Baju Anak Koko', 10000.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 50000, NULL, NULL, 'Gudang', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'Pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('J00057', 25, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 10000.00, 0.05, NULL, NULL, '2016-02-25 16:51:31', 1, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Toko', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 76, 'SO', 'SO00191', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('J00057', 26, '00007', 1.00, 'Btl', 'Mizone', 1700.00, 0.05, NULL, NULL, '2016-02-25 16:51:31', 1, 0, NULL, NULL, 0, 3500, NULL, NULL, 'Toko', 1415, 1615, 'IDR', 1, 85, NULL, NULL, 'Btl', 1.00, 1700, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 77, 'SO', 'SO00191', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('JDO0059', 27, '00007', 1.00, 'Btl', 'Mizone', 1700.00, 0.05, NULL, NULL, '2016-02-25 16:50:09', 1, 0, NULL, NULL, 0, 3500, NULL, NULL, 'Toko', 1415, 1615, 'IDR', 1, 85, NULL, NULL, 'Btl', 1.00, 1700, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 77, 'SO', 'SO00191', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('JDO0059', 28, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 10000.00, 0.05, NULL, NULL, '2016-02-25 16:50:09', 1, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Toko', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 76, 'SO', 'SO00191', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 29, '00007', 1.00, 'Btl', 'Mizone', 1700.00, 0.00, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 3500, NULL, NULL, 'Toko', 1415, 1698.3, 'IDR', 1, 1.7, NULL, NULL, 'Btl', 1.00, 1700, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 30, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 10000.00, 0.05, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Toko', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 31, '00004', 1.00, '.', 'Keyboard Logitech', 5000.00, 0.00, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 10000, NULL, NULL, 'Toko', 1415, 4995, 'IDR', 1, 5, NULL, NULL, '.', 1.00, 5000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('T00007', 32, '00005', 1.00, 'PCS', 'Printer Epson LX300', 1100000.00, 0.00, NULL, NULL, '2016-02-25 16:36:15', 1, 0, NULL, NULL, 0, 500000, NULL, NULL, 'Toko', 1415, 1098900, 'IDR', 1, 1100, NULL, NULL, 'PCS', 1.00, 1100000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 33, '00064', 1.00, 'PCS', 'CD Lagu Iwan Fals 2013', 6000.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0, NULL, NULL, 'Gudang', 1415, 5700, 'IDR', 1, 300, NULL, NULL, 'PCS', 1.00, 6000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 34, '12', 1.00, 'Pcs', 'cat base', 0.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 1, NULL, NULL, 'Gudang', 1415, 0, 'IDR', 1, 0, NULL, NULL, 'Pcs', 1.00, 0, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 35, '1', 1.00, 'Pcs', 'IURAN ASRAMA', 0.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 1, NULL, NULL, 'Gudang', 1415, 0, 'IDR', 1, 0, NULL, NULL, 'Pcs', 1.00, 0, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 36, '00002', 1.00, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 27500000.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 2500000, NULL, NULL, 'Gudang', 1415, 26125000, 'IDR', 1, 1375000, NULL, NULL, 'pcs', 1.00, 27500000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('K01-00279', 37, '100', 1.00, 'Pcs', 'Baju Anak Koko', 10000.00, 0.05, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 50000, NULL, NULL, 'Gudang', 1415, 9500, 'IDR', 1, 500, NULL, NULL, 'Pcs', 1.00, 10000, 0, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 'KASIR', NULL, NULL, 0, 'PR00001', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0),
	('PJL00167', 38, '1', 1.00, 'Komputer Deskto', '00002', 27500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27500000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00167', 39, '2', 2.00, 'Keyboard Logite', '00004', 5600.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00167', 40, '3', 5.00, 'Printer Epson L', '00005', 1100000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5500000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00167', 41, '4', 1.00, 'Teh Tarik', '00021', 1000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 42, '1', 1.00, 'Komputer Deskto', '00002', 27500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27500000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 43, '2', 1.00, 'Printer Epson L', '00005', 1100000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 44, '3', 1.00, 'Keyboard Logite', '00004', 5600.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5600, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 45, '4', 1.00, 'Teh Tarik', '00021', 1000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 46, '5', 1.00, 'Korek Api Gas', '00022', 1200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 47, '6', 1.00, 'Garasi Tambahan', '00012', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 48, '7', 1.00, 'Mizone', '00007', 1700.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1700, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 49, '8', 1.00, 'USB Flashdisk', '00029', 20000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 50, '9', 1.00, 'CAT FALCON 5KG', '00035', 15000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 51, '10', 1.00, 'SAMSUNG GALAXY ', '00036', 900.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 900, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 52, '11', 1.00, 'Komputer Server', '00040', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 53, '12', 1.00, 'Donat', '00028', 6000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 54, '13', 1.00, 'Minyak Kelapa', '00027', 110000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 110000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 55, '14', 1.00, 'Susu indomilk k', '00024', 1200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 56, '15', 1.00, 'Indomilk', '00023', 1200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 57, '16', 1.00, 'Ticket Pesawat ', '00050', 800000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 800000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 58, '17', 1.00, 'Ticket Pesawat ', '00051', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 59, '18', 1.00, 'Ticket Pesawat ', '00052', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 60, '19', 1.00, 'Ticket Pesawat ', '00052', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 61, '20', 1.00, 'Ticket Pesawat ', '00051', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 62, '21', 1.00, 'Ticket Pesawat ', '00050', 800000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 800000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 63, '22', 1.00, 'SAMSUNG GALAXY ', '00036', 900.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 900, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 64, '23', 1.00, 'SAMSUNG GALAXY ', '00036', 900.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 900, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00168', 65, '24', 1.00, 'Keyboard Logite', '00004', 5600.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5600, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00169', 66, '1', 1.00, 'Komputer Deskto', '00002', 27500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27500000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00169', 67, '2', 1.00, 'Keyboard Logite', '00004', 5600.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5600, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00169', 68, '3', 1.00, 'Printer Epson L', '00005', 1100000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00169', 69, '4', 1.00, 'Korek Api Gas', '00022', 1200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00169', 70, '5', 1.00, 'Teh Tarik', '00021', 1000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00169', 71, '6', 1.00, 'Garasi Tambahan', '00012', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00169', 72, '7', 1.00, 'Mizone', '00007', 1700.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1700, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00169', 73, '8', 1.00, 'Garasi Tambahan', '00012', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00169', 74, '9', 1.00, 'Garasi Tambahan', '00012', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00169', 75, '10', 1.00, 'Printer Epson L', '00005', 1100000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00170', 76, '1', 1.00, 'Keyboard Logite', '00004', 5600.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5600, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00170', 77, '2', 1.00, 'Printer Epson L', '00005', 1100000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00170', 78, '3', 10.00, 'Teh Tarik', '00021', 1000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00170', 79, '4', 1.00, 'Teh Tarik', '00021', 1000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00170', 80, '5', 1.00, 'Garasi Tambahan', '00012', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SJ00054', 81, '100', 1.00, NULL, 'Baju Anak Koko', 10000.00, 0.30, NULL, NULL, '2016-03-17 18:45:00', NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, 'Cawang', NULL, 5040, NULL, NULL, 3000, NULL, NULL, NULL, 1.00, 10000, NULL, NULL, 0.20, 1400, 0.10, 560, NULL, NULL, NULL, 3, 'SO', 'SO00119', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SJ00054', 82, 'R001', 1.00, NULL, 'Bir Bintang', 1000.00, 0.30, NULL, NULL, '2016-03-17 18:45:00', NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, 'Cawang', NULL, 504, NULL, NULL, 300, NULL, NULL, NULL, 1.00, 1000, NULL, NULL, 0.20, 140, 0.10, 56, NULL, NULL, NULL, 4, 'SO', 'SO00119', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SJ00054', 83, '10201', 1.00, 'Pcs', 'Celana Jeans Pria', 132000.00, 0.50, NULL, NULL, '2016-03-17 18:45:00', NULL, NULL, NULL, NULL, NULL, 120000, NULL, NULL, 'Cawang', NULL, 66000, NULL, NULL, 66000, NULL, NULL, 'Pcs', 1.00, 132000, NULL, NULL, 0.00, 0, 0.00, 0, NULL, NULL, NULL, 5, 'SO', 'SO00119', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00171', 84, '100', 1.00, NULL, 'Baju Anak Koko', 10000.00, 0.30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, 'Cawang', 1415, 5040, NULL, NULL, 3000, NULL, NULL, NULL, 1.00, 10000, NULL, NULL, 0.20, 1400, 0.10, 560, NULL, NULL, NULL, 81, 'DO', 'SJ00054', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00171', 85, 'R001', 1.00, NULL, 'Bir Bintang', 1000.00, 0.30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, 'Cawang', 1415, 504, NULL, NULL, 300, NULL, NULL, NULL, 1.00, 1000, NULL, NULL, 0.20, 140, 0.10, 56, NULL, NULL, NULL, 82, 'DO', 'SJ00054', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PJL00171', 86, '10201', 1.00, 'Pcs', 'Celana Jeans Pria', 132000.00, 0.50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 120000, NULL, NULL, 'Cawang', 1415, 66000, NULL, NULL, 66000, NULL, NULL, 'Pcs', 1.00, 132000, NULL, NULL, 0.00, 0, 0.00, 0, NULL, NULL, NULL, 83, 'DO', 'SJ00054', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `invoice_lineitems` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_serialized_items
CREATE TABLE IF NOT EXISTS `invoice_serialized_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `month_guaranted` int(11) DEFAULT NULL,
  `date_activated` datetime DEFAULT NULL,
  `date_expired` datetime DEFAULT NULL,
  `comments` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_serialized_items: 0 rows
/*!40000 ALTER TABLE `invoice_serialized_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_serialized_items` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_shipment
CREATE TABLE IF NOT EXISTS `invoice_shipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `expeditur` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `jenis_kendaraan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nomor_polisi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nama_sopir` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tujuan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `jumlah_do_induk` int(11) DEFAULT NULL,
  `qty_do_before` double(11,0) DEFAULT NULL,
  `qty_do_current` double(11,0) DEFAULT NULL,
  `qty_do_after` double(11,0) DEFAULT NULL,
  `tanggal_do_induk` datetime DEFAULT NULL,
  `nomor_do_induk` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_nama` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_address1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_address2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_address3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_address4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custkirim_address5` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_nama` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_address1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_address2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_address3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_address4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `custterima_address5` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `kota_asal` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kota_tujuan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer_pengirim` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customer_penerima` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kode_rute` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tagihan_untuk` int(11) DEFAULT NULL,
  `biaya_dokumen` double DEFAULT NULL,
  `biaya_pengepakan` double DEFAULT NULL,
  `biaya_lain` double DEFAULT NULL,
  `nomor_surat_jalan` double DEFAULT NULL,
  `nomor_voucher_kas` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_shipment: 0 rows
/*!40000 ALTER TABLE `invoice_shipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_shipment` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_shipment_export
CREATE TABLE IF NOT EXISTS `invoice_shipment_export` (
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lc_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `issuing_bank` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `feeder_vessel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mother_vessel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `port_of_loading` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `destination` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `flight` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `carrier_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipping_marks` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `notes` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_shipment_export: 0 rows
/*!40000 ALTER TABLE `invoice_shipment_export` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_shipment_export` ENABLE KEYS */;


-- Dumping structure for table simak.invoice_tax_serial
CREATE TABLE IF NOT EXISTS `invoice_tax_serial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nofaktur` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `noseripajak` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggalpajak` datetime DEFAULT NULL,
  `customernumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customernpwp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `customernppkp` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ship_to` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.invoice_tax_serial: 0 rows
/*!40000 ALTER TABLE `invoice_tax_serial` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_tax_serial` ENABLE KEYS */;


-- Dumping structure for table simak.jenis_potongan
CREATE TABLE IF NOT EXISTS `jenis_potongan` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sifat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `is_variable` smallint(1) DEFAULT '0',
  `ref_column` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.jenis_potongan: 1 rows
/*!40000 ALTER TABLE `jenis_potongan` DISABLE KEYS */;
REPLACE INTO `jenis_potongan` (`kode`, `keterangan`, `sifat`, `is_variable`, `ref_column`, `update_status`) VALUES
	('TOKO', 'POTONGAN TOKO', '', 0, '', NULL);
/*!40000 ALTER TABLE `jenis_potongan` ENABLE KEYS */;


-- Dumping structure for table simak.jenis_tunjangan
CREATE TABLE IF NOT EXISTS `jenis_tunjangan` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sifat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `is_variable` smallint(1) DEFAULT '0',
  `ref_column` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.jenis_tunjangan: 2 rows
/*!40000 ALTER TABLE `jenis_tunjangan` DISABLE KEYS */;
REPLACE INTO `jenis_tunjangan` (`kode`, `keterangan`, `sifat`, `is_variable`, `ref_column`, `update_status`) VALUES
	('GAPOK', 'GAJI POKOK', '0', 0, '12', NULL),
	('MAKAN', 'MAKAN', '0', 0, '10', NULL);
/*!40000 ALTER TABLE `jenis_tunjangan` ENABLE KEYS */;


-- Dumping structure for table simak.kas_kasir
CREATE TABLE IF NOT EXISTS `kas_kasir` (
  `comno` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `supervisor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `jmlakhir` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `kasir` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shift` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `catatan` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.kas_kasir: 318 rows
/*!40000 ALTER TABLE `kas_kasir` DISABLE KEYS */;
REPLACE INTO `kas_kasir` (`comno`, `tanggal`, `jumlah`, `supervisor`, `jmlakhir`, `update_status`, `kasir`, `shift`, `catatan`) VALUES
	('K01', '2015-11-12 10:32:20', 1000000, 'andri', 0, 0, 'kasir', '1032', 'modal kasir'),
	('K01', '2016-02-19 15:06:26', 1000000, 'adiana', 0, 0, 'kasir', '1506', NULL);
/*!40000 ALTER TABLE `kas_kasir` ENABLE KEYS */;


-- Dumping structure for table simak.kendaraan
CREATE TABLE IF NOT EXISTS `kendaraan` (
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nomor_plat` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nama_supir` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kapasitas` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `merk` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bpkb_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bpkb_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `model` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `colour` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bpkb_address` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `stnk_date` datetime DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.kendaraan: 0 rows
/*!40000 ALTER TABLE `kendaraan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kendaraan` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_approved
CREATE TABLE IF NOT EXISTS `ls_app_approved` (
  `app_id` varchar(50) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `approved_rate` varchar(50) DEFAULT NULL,
  `first_score` varchar(50) DEFAULT NULL,
  `last_score` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_approved: 0 rows
/*!40000 ALTER TABLE `ls_app_approved` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_approved` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_bill_cust_address
CREATE TABLE IF NOT EXISTS `ls_app_bill_cust_address` (
  `app_id` varchar(50) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `loan_id` varchar(50) DEFAULT NULL,
  `default_ship_to_id` varchar(50) DEFAULT NULL,
  `coll_id` varchar(50) DEFAULT NULL,
  `coll_cost` varchar(50) DEFAULT NULL,
  `send_letter_via` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_bill_cust_address: 0 rows
/*!40000 ALTER TABLE `ls_app_bill_cust_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_bill_cust_address` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_confirm
CREATE TABLE IF NOT EXISTS `ls_app_confirm` (
  `app_id` varchar(50) DEFAULT NULL,
  `confirm_date` date DEFAULT NULL,
  `confirm_by` varchar(50) DEFAULT NULL,
  `confirm_count` int(11) DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_confirm: 0 rows
/*!40000 ALTER TABLE `ls_app_confirm` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_confirm` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_cost
CREATE TABLE IF NOT EXISTS `ls_app_cost` (
  `app_id` varchar(50) DEFAULT NULL,
  `cost_type` varchar(50) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_cost: 0 rows
/*!40000 ALTER TABLE `ls_app_cost` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_cost` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_installment
CREATE TABLE IF NOT EXISTS `ls_app_installment` (
  `app_id` varchar(50) DEFAULT NULL,
  `bank_id` varchar(50) DEFAULT NULL,
  `inst_date` varchar(50) DEFAULT NULL,
  `loan_amount` varchar(50) DEFAULT NULL,
  `inst_amount` varchar(50) DEFAULT NULL,
  `disc_amount` varchar(50) DEFAULT NULL,
  `subsidi_dealer_amount` varchar(50) DEFAULT NULL,
  `dp_received_by` varchar(50) DEFAULT NULL,
  `inst_id` varchar(50) DEFAULT NULL,
  `inst_type` varchar(50) DEFAULT NULL,
  `inst_top` varchar(50) DEFAULT NULL,
  `inst_first_date` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_installment: 0 rows
/*!40000 ALTER TABLE `ls_app_installment` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_installment` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_insurance
CREATE TABLE IF NOT EXISTS `ls_app_insurance` (
  `app_id` varchar(50) DEFAULT NULL,
  `insr_id` varchar(50) DEFAULT NULL,
  `insr_type` varchar(50) DEFAULT NULL,
  `insr_top` varchar(50) DEFAULT NULL,
  `insr_season` varchar(50) DEFAULT NULL,
  `flat_rate_prc` varchar(50) DEFAULT NULL,
  `eff_rate_prc` varchar(50) DEFAULT NULL,
  `comments` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_insurance: 0 rows
/*!40000 ALTER TABLE `ls_app_insurance` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_app_insurance` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_master
CREATE TABLE IF NOT EXISTS `ls_app_master` (
  `app_id` varchar(50) NOT NULL DEFAULT '',
  `app_date` varchar(50) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `counter_id` varchar(50) DEFAULT NULL,
  `dealer_id` varchar(50) DEFAULT NULL,
  `terms_id` varchar(50) DEFAULT NULL,
  `notes` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `contract_id` varchar(50) DEFAULT NULL,
  `dp_amount` float DEFAULT NULL,
  `dp_prc` float DEFAULT NULL,
  `insr_amount` float DEFAULT NULL,
  `admin_amount` float DEFAULT NULL,
  `insr_prc` float DEFAULT NULL,
  `inst_amount` float DEFAULT NULL,
  `inst_month` float DEFAULT NULL,
  `loan_amount` float DEFAULT NULL,
  `rate_prc` float DEFAULT NULL,
  `rate_amount` float DEFAULT NULL,
  `verified` int(11) DEFAULT '0',
  `scored` int(11) DEFAULT '0',
  `score_value` int(11) DEFAULT '0',
  `confirmed` int(11) DEFAULT '0',
  `surveyed` int(11) DEFAULT '0',
  `approved` int(11) DEFAULT '0',
  `create_by` varchar(50) DEFAULT NULL,
  `risk_approved` int(11) DEFAULT '0',
  `update_by` varchar(50) DEFAULT NULL,
  `sub_total` float DEFAULT NULL,
  `posted` int(11) DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `promo_code` varchar(50) DEFAULT NULL,
  `item_del_by` varchar(50) DEFAULT NULL,
  `item_del_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_master: 40 rows
/*!40000 ALTER TABLE `ls_app_master` DISABLE KEYS */;
REPLACE INTO `ls_app_master` (`app_id`, `app_date`, `cust_id`, `counter_id`, `dealer_id`, `terms_id`, `notes`, `status`, `contract_id`, `dp_amount`, `dp_prc`, `insr_amount`, `admin_amount`, `insr_prc`, `inst_amount`, `inst_month`, `loan_amount`, `rate_prc`, `rate_amount`, `verified`, `scored`, `score_value`, `confirmed`, `surveyed`, `approved`, `create_by`, `risk_approved`, `update_by`, `sub_total`, `posted`, `create_date`, `update_date`, `promo_code`, `item_del_by`, `item_del_date`) VALUES
	('SPK00008', '2015-01-26 11:30:00', '00004LS1411', 'C1', NULL, NULL, NULL, 'Finish', '4252423', 277500, 0.15, 0, 100000, NULL, 575273, 3, 1572500, 0.0325, 51106.2, 1, 1, 55, 0, 1, 1, '', 1, 'andri', 1850000, 0, '1970-01-01 00:00:00', NULL, '', '', ''),
	('SPK00048', '2015-05-03 00:00:00', '00023LS1503', 'pluit', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'andri', 0, NULL, 0, 0, '2015-05-03 00:00:00', NULL, '', '', '');
/*!40000 ALTER TABLE `ls_app_master` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_object_items
CREATE TABLE IF NOT EXISTS `ls_app_object_items` (
  `app_id` varchar(50) DEFAULT NULL,
  `obj_id` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `disc_prc` float DEFAULT NULL,
  `disc_amount` float DEFAULT NULL,
  `tax_prc` float DEFAULT NULL,
  `tax_amount` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `comments` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `dp` float NOT NULL DEFAULT '0',
  `dp_amount` float NOT NULL DEFAULT '0',
  `aft_dp_amount` float NOT NULL DEFAULT '0',
  `bunga` float NOT NULL DEFAULT '0',
  `bunga_amount` float NOT NULL DEFAULT '0',
  `loan_amount` float NOT NULL DEFAULT '0',
  `tenor` int(11) NOT NULL DEFAULT '0',
  `aft_tenor` float NOT NULL DEFAULT '0',
  `angsuran` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_object_items: 42 rows
/*!40000 ALTER TABLE `ls_app_object_items` DISABLE KEYS */;
REPLACE INTO `ls_app_object_items` (`app_id`, `obj_id`, `description`, `qty`, `price`, `disc_prc`, `disc_amount`, `tax_prc`, `tax_amount`, `amount`, `comments`, `id`, `dp`, `dp_amount`, `aft_dp_amount`, `bunga`, `bunga_amount`, `loan_amount`, `tenor`, `aft_tenor`, `angsuran`) VALUES
	('SPK00008', 'hps1', 'samsung duos', 1, 1850000, NULL, NULL, NULL, NULL, 1850000, NULL, 13, 0, 0, 0, 0, 0, 0, 0, 0, 0),
	('SPK00047', '100405', 'HN SMSUNG T2110', 1, 3199000, NULL, NULL, NULL, NULL, 3199000, NULL, 57, 0, 0, 0, 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `ls_app_object_items` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_scoring
CREATE TABLE IF NOT EXISTS `ls_app_scoring` (
  `app_id` varchar(50) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `office_phone` varchar(50) DEFAULT NULL,
  `v2_cust_name` varchar(50) DEFAULT NULL,
  `v2_cust_name_x` varchar(50) DEFAULT NULL,
  `v2_place_birth` varchar(50) DEFAULT NULL,
  `v2_date_birth` varchar(50) DEFAULT NULL,
  `v2_mother_name` varchar(50) DEFAULT NULL,
  `v2_mother_name_x` varchar(50) DEFAULT NULL,
  `v1_fam_name` varchar(50) DEFAULT NULL,
  `v1_fam_relation` varchar(50) DEFAULT NULL,
  `v1_fam_street` varchar(250) DEFAULT NULL,
  `v1_fam_kel` varchar(100) DEFAULT NULL,
  `v1_fam_kec` varchar(100) DEFAULT NULL,
  `v1_fam_kota` varchar(100) DEFAULT NULL,
  `v1_fam_pos` varchar(50) DEFAULT NULL,
  `v1_fam_phone` varchar(50) DEFAULT NULL,
  `v1_cust_name` varchar(50) DEFAULT NULL,
  `v1_mother_name` varchar(50) DEFAULT NULL,
  `v1_street` varchar(250) DEFAULT NULL,
  `v1_rtrw` varchar(50) DEFAULT NULL,
  `v1_kel` varchar(50) DEFAULT NULL,
  `v1_kec` varchar(50) DEFAULT NULL,
  `v1_kota` varchar(50) DEFAULT NULL,
  `v1_pos` varchar(50) DEFAULT NULL,
  `v1_phone` varchar(50) DEFAULT NULL,
  `v1_hp` varchar(50) DEFAULT NULL,
  `v1_house_status` varchar(50) DEFAULT NULL,
  `v1_house_status_x` varchar(50) DEFAULT NULL,
  `v3_com_name` varchar(50) DEFAULT NULL,
  `v3_street` varchar(250) DEFAULT NULL,
  `v3_bidang` varchar(50) DEFAULT NULL,
  `v3_emp_status` varchar(50) DEFAULT NULL,
  `v3_jabatan` varchar(50) DEFAULT NULL,
  `v3_com_status` varchar(50) DEFAULT NULL,
  `v3_year` varchar(50) DEFAULT NULL,
  `v3_salary` varchar(50) DEFAULT NULL,
  `v3_supervisor` varchar(50) DEFAULT NULL,
  `v3_hrd` varchar(50) DEFAULT NULL,
  `type_data` varchar(50) DEFAULT NULL COMMENT '0 - verify, 1 - appmaster',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `v1_lama_tahun` varchar(50) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `catatan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table simak.ls_app_scoring: 44 rows
/*!40000 ALTER TABLE `ls_app_scoring` DISABLE KEYS */;
REPLACE INTO `ls_app_scoring` (`app_id`, `cust_id`, `cust_name`, `phone`, `office_phone`, `v2_cust_name`, `v2_cust_name_x`, `v2_place_birth`, `v2_date_birth`, `v2_mother_name`, `v2_mother_name_x`, `v1_fam_name`, `v1_fam_relation`, `v1_fam_street`, `v1_fam_kel`, `v1_fam_kec`, `v1_fam_kota`, `v1_fam_pos`, `v1_fam_phone`, `v1_cust_name`, `v1_mother_name`, `v1_street`, `v1_rtrw`, `v1_kel`, `v1_kec`, `v1_kota`, `v1_pos`, `v1_phone`, `v1_hp`, `v1_house_status`, `v1_house_status_x`, `v3_com_name`, `v3_street`, `v3_bidang`, `v3_emp_status`, `v3_jabatan`, `v3_com_status`, `v3_year`, `v3_salary`, `v3_supervisor`, `v3_hrd`, `type_data`, `id`, `v1_lama_tahun`, `create_date`, `update_date`, `create_by`, `update_by`, `catatan`) VALUES
	('SPK00002', '00003LS1411', 'Ucok Baba', '082112829192', NULL, 'on', NULL, 'on', '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '0', NULL, NULL, NULL, NULL, NULL),
	('SPK00047', '00023LS1503', 'dede yusuf', '082112829192', NULL, '1', NULL, '1', '1', '1', NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '1', NULL, NULL, '1', NULL, NULL, '1', '1', '1', '1', NULL, 46, '1', NULL, NULL, NULL, NULL, '');
/*!40000 ALTER TABLE `ls_app_scoring` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_survey
CREATE TABLE IF NOT EXISTS `ls_app_survey` (
  `app_id` varchar(50) DEFAULT NULL,
  `survey_times` varchar(50) DEFAULT NULL,
  `survey_date` varchar(50) DEFAULT NULL,
  `survey_by` varchar(50) DEFAULT NULL,
  `comments` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `hasil` varchar(250) DEFAULT NULL,
  `foto_depan` varchar(250) DEFAULT NULL,
  `foto_kiri` varchar(50) DEFAULT NULL,
  `foto_kanan` varchar(50) DEFAULT NULL,
  `recomended` int(11) DEFAULT '0',
  `foto_1` varchar(250) DEFAULT NULL,
  `foto_ket_1` varchar(250) DEFAULT NULL,
  `foto_2` varchar(250) DEFAULT NULL,
  `foto_ket_2` varchar(250) DEFAULT NULL,
  `foto_3` varchar(250) DEFAULT NULL,
  `foto_ket_3` varchar(250) DEFAULT NULL,
  `foto_4` varchar(250) DEFAULT NULL,
  `foto_ket_4` varchar(250) DEFAULT NULL,
  `foto_5` varchar(250) DEFAULT NULL,
  `foto_ket_5` varchar(250) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_app_survey: 35 rows
/*!40000 ALTER TABLE `ls_app_survey` DISABLE KEYS */;
REPLACE INTO `ls_app_survey` (`app_id`, `survey_times`, `survey_date`, `survey_by`, `comments`, `id`, `status`, `area`, `hasil`, `foto_depan`, `foto_kiri`, `foto_kanan`, `recomended`, `foto_1`, `foto_ket_1`, `foto_2`, `foto_ket_2`, `foto_3`, `foto_ket_3`, `foto_4`, `foto_ket_4`, `foto_5`, `foto_ket_5`, `create_date`, `update_date`, `create_by`, `update_by`) VALUES
	('SPK00002', NULL, '2014-11-27 06:29:06', 'admin', NULL, 1, '1', 'default', 'dafdfsafdsaf', 'talaga1.jpg', 'intanhotel2.jpg', 'qolby19.jpg', 1, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL),
	('SPK00047', NULL, '2015-05-01 09:30:45', 'andri', NULL, 45, '1', 'default', 'rekomend deh, alamat jelas, orangnya baik', '', '', '', 1, '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ls_app_survey` ENABLE KEYS */;


-- Dumping structure for table simak.ls_app_verify
CREATE TABLE IF NOT EXISTS `ls_app_verify` (
  `app_id` varchar(50) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `office_phone` varchar(50) DEFAULT NULL,
  `v2_cust_name` varchar(50) DEFAULT NULL,
  `v2_cust_name_x` varchar(50) DEFAULT NULL,
  `v2_place_birth` varchar(50) DEFAULT NULL,
  `v2_date_birth` date DEFAULT NULL,
  `v2_mother_name` varchar(50) DEFAULT NULL,
  `v2_mother_name_x` varchar(50) DEFAULT NULL,
  `v1_fam_name` varchar(50) DEFAULT NULL,
  `v1_fam_relation` varchar(50) DEFAULT NULL,
  `v1_fam_street` varchar(250) DEFAULT NULL,
  `v1_fam_kel` varchar(100) DEFAULT NULL,
  `v1_fam_kec` varchar(100) DEFAULT NULL,
  `v1_fam_kota` varchar(100) DEFAULT NULL,
  `v1_fam_pos` varchar(50) DEFAULT NULL,
  `v1_fam_phone` varchar(50) DEFAULT NULL,
  `v1_cust_name` varchar(50) DEFAULT NULL,
  `v1_mother_name` varchar(50) DEFAULT NULL,
  `v1_street` varchar(250) DEFAULT NULL,
  `v1_rtrw` varchar(50) DEFAULT NULL,
  `v1_kel` varchar(50) DEFAULT NULL,
  `v1_kec` varchar(50) DEFAULT NULL,
  `v1_kota` varchar(50) DEFAULT NULL,
  `v1_pos` varchar(50) DEFAULT NULL,
  `v1_phone` varchar(50) DEFAULT NULL,
  `v1_hp` varchar(50) DEFAULT NULL,
  `v1_house_status` varchar(50) DEFAULT NULL,
  `v1_house_status_x` varchar(50) DEFAULT NULL,
  `v3_com_name` varchar(50) DEFAULT NULL,
  `v3_street` varchar(250) DEFAULT NULL,
  `v3_bidang` varchar(50) DEFAULT NULL,
  `v3_emp_status` varchar(50) DEFAULT NULL,
  `v3_jabatan` varchar(50) DEFAULT NULL,
  `v3_com_status` varchar(50) DEFAULT NULL,
  `v3_year` varchar(50) DEFAULT NULL,
  `v3_salary` float DEFAULT NULL,
  `v3_supervisor` varchar(50) DEFAULT NULL,
  `v3_hrd` varchar(50) DEFAULT NULL,
  `v1_lama_tahun` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.ls_app_verify: 43 rows
/*!40000 ALTER TABLE `ls_app_verify` DISABLE KEYS */;
REPLACE INTO `ls_app_verify` (`app_id`, `cust_id`, `cust_name`, `phone`, `office_phone`, `v2_cust_name`, `v2_cust_name_x`, `v2_place_birth`, `v2_date_birth`, `v2_mother_name`, `v2_mother_name_x`, `v1_fam_name`, `v1_fam_relation`, `v1_fam_street`, `v1_fam_kel`, `v1_fam_kec`, `v1_fam_kota`, `v1_fam_pos`, `v1_fam_phone`, `v1_cust_name`, `v1_mother_name`, `v1_street`, `v1_rtrw`, `v1_kel`, `v1_kec`, `v1_kota`, `v1_pos`, `v1_phone`, `v1_hp`, `v1_house_status`, `v1_house_status_x`, `v3_com_name`, `v3_street`, `v3_bidang`, `v3_emp_status`, `v3_jabatan`, `v3_com_status`, `v3_year`, `v3_salary`, `v3_supervisor`, `v3_hrd`, `v1_lama_tahun`, `id`, `create_date`, `update_date`, `create_by`, `update_by`) VALUES
	('SPK00032', '00009LS1412', 'Olga Saputra', '324324', NULL, '2', '1', '1', '2015-02-06', '2', '1', '1', '1', '3', NULL, NULL, NULL, NULL, '1', NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', '2', NULL, NULL, '3', NULL, NULL, '3', 3, '3', '3', '1', 0, NULL, NULL, NULL, NULL),
	('SPK00047', '00023LS1503', 'dede yusuf', '082112829192', NULL, 'B', 'DEDE YUSUF', 'JAKARTA', '1970-01-01', 'B', 'YANI', 'YUNI', 'ADIK', 'JL. RAYA JOGLO 8', NULL, NULL, NULL, NULL, '082112829192', NULL, NULL, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B', 'MILIK SENDIRI', 'B', NULL, NULL, 'C', NULL, NULL, 'C', 0, 'C', 'C', '10', 47, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `ls_app_verify` ENABLE KEYS */;


-- Dumping structure for table simak.ls_bunga_range
CREATE TABLE IF NOT EXISTS `ls_bunga_range` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount_from` float NOT NULL DEFAULT '0',
  `amount_to` float NOT NULL DEFAULT '0',
  `bunga_prc` float NOT NULL DEFAULT '0',
  `comments` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table simak.ls_bunga_range: 4 rows
/*!40000 ALTER TABLE `ls_bunga_range` DISABLE KEYS */;
REPLACE INTO `ls_bunga_range` (`id`, `amount_from`, `amount_to`, `bunga_prc`, `comments`) VALUES
	(9, 500000, 1500000, 3, ''),
	(10, 0, 500000, 0, ''),
	(11, 1500000, 3000000, 4, ''),
	(12, 3000000, 900000000, 3.5, '');
/*!40000 ALTER TABLE `ls_bunga_range` ENABLE KEYS */;


-- Dumping structure for table simak.ls_counter
CREATE TABLE IF NOT EXISTS `ls_counter` (
  `counter_id` varchar(50) NOT NULL DEFAULT '',
  `counter_name` varchar(150) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `area_name` varchar(150) DEFAULT NULL,
  `sales_agent` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `join_date` datetime DEFAULT NULL,
  `target` float DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`counter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_counter: 2 rows
/*!40000 ALTER TABLE `ls_counter` DISABLE KEYS */;
REPLACE INTO `ls_counter` (`counter_id`, `counter_name`, `area`, `area_name`, `sales_agent`, `address`, `phone`, `join_date`, `target`, `active`) VALUES
	('C1', 'Jakarta Barat', 'Grogol', NULL, 'SA', 'Jl. Daan Mogot Raya No.12', '2292002202', '2014-11-23 00:00:00', 200000000, 1),
	('C2', 'Jakarta Utara ', 'Pluit', 'Pluit Jakarta Barat', '', '', '', '2014-12-17 00:00:00', 0, 0);
/*!40000 ALTER TABLE `ls_counter` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_company
CREATE TABLE IF NOT EXISTS `ls_cust_company` (
  `cust_id` varchar(50) DEFAULT NULL,
  `comp_type` varchar(50) DEFAULT NULL,
  `bussiness_type` varchar(50) DEFAULT NULL,
  `industry_type` varchar(50) DEFAULT NULL,
  `office_status` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `notaris_no` varchar(50) DEFAULT NULL,
  `notaris_date` varchar(50) DEFAULT NULL,
  `notaris_name` varchar(50) DEFAULT NULL,
  `tdp_number` varchar(50) DEFAULT NULL,
  `tdp_date` varchar(50) DEFAULT NULL,
  `zip_pos` varchar(50) DEFAULT NULL,
  `siup_number` varchar(50) DEFAULT NULL,
  `siup_date` varchar(50) DEFAULT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `total_employee` varchar(50) DEFAULT NULL,
  `comp_name` varchar(50) DEFAULT NULL,
  `since_year` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `rtrw` varchar(50) DEFAULT NULL,
  `kel` varchar(50) DEFAULT NULL,
  `kec` varchar(50) DEFAULT NULL,
  `phone_ext` varchar(50) DEFAULT NULL,
  `spv_name` varchar(50) DEFAULT NULL,
  `job_status` varchar(50) DEFAULT NULL,
  `job_level` varchar(50) DEFAULT NULL,
  `job_type` varchar(50) DEFAULT NULL,
  `job_status_etc` varchar(50) DEFAULT NULL,
  `job_type_etc` varchar(50) DEFAULT NULL,
  `emp_status` varchar(50) DEFAULT NULL,
  `emp_status_etc` varchar(50) DEFAULT NULL,
  `comp_desc` varchar(50) DEFAULT NULL,
  `office_status_etc` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `hrd_name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_company: 20 rows
/*!40000 ALTER TABLE `ls_cust_company` DISABLE KEYS */;
REPLACE INTO `ls_cust_company` (`cust_id`, `comp_type`, `bussiness_type`, `industry_type`, `office_status`, `npwp`, `notaris_no`, `notaris_date`, `notaris_name`, `tdp_number`, `tdp_date`, `zip_pos`, `siup_number`, `siup_date`, `contact_name`, `contact_phone`, `total_employee`, `comp_name`, `since_year`, `street`, `city`, `rtrw`, `kel`, `kec`, `phone_ext`, `spv_name`, `job_status`, `job_level`, `job_type`, `job_status_etc`, `job_type_etc`, `emp_status`, `emp_status_etc`, `comp_desc`, `office_status_etc`, `id`, `hrd_name`) VALUES
	('00003LS1411', NULL, '1', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'f', NULL, NULL, NULL, 'g', '2', '1', '1', 'a', 'e', 'b', 'c', 'd', '1', '11', '1', '1', '0', '1', '1', '0', '1', '1', '1', 6, '0'),
	('00023LS1503', NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '', '0', '', '', '', '', '', '', '', '', '', '1', '', '0', '', '', '0', '', '', '', 30, '');
/*!40000 ALTER TABLE `ls_cust_company` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_company_owner
CREATE TABLE IF NOT EXISTS `ls_cust_company_owner` (
  `cust_id` varchar(50) DEFAULT NULL,
  `owner_name` varchar(50) DEFAULT NULL,
  `id_ktp` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `pangsa` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `suite` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip_pos` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_company_owner: 0 rows
/*!40000 ALTER TABLE `ls_cust_company_owner` DISABLE KEYS */;
/*!40000 ALTER TABLE `ls_cust_company_owner` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_crcard
CREATE TABLE IF NOT EXISTS `ls_cust_crcard` (
  `cust_id` varchar(50) DEFAULT NULL,
  `card_no` varchar(50) DEFAULT NULL,
  `card_bank` varchar(50) DEFAULT NULL,
  `card_expire` varchar(50) DEFAULT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `card_type_etc` varchar(50) DEFAULT NULL,
  `card_limit` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_crcard: 4 rows
/*!40000 ALTER TABLE `ls_cust_crcard` DISABLE KEYS */;
REPLACE INTO `ls_cust_crcard` (`cust_id`, `card_no`, `card_bank`, `card_expire`, `card_type`, `card_type_etc`, `card_limit`, `id`) VALUES
	('00003LS1411', '213213', '23231', 'dfasdf', 'dfsd', NULL, 'dfs', 5),
	('00003LS1411', '213123', '23213', '2322', '', NULL, '', 6),
	('00006LS1412', '23213213', 'bca', '2014-10-10', 'xxx', NULL, 'xx', 7),
	('00010LS1412', '23213213', 'Citibank', '2015-10-10', 'VISA', NULL, '5000000', 8);
/*!40000 ALTER TABLE `ls_cust_crcard` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_master
CREATE TABLE IF NOT EXISTS `ls_cust_master` (
  `cust_id` varchar(50) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `suite` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip_pos` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `bank_acc_number` varchar(50) DEFAULT NULL,
  `credit_card_number` varchar(50) DEFAULT NULL,
  `is_send_email` varchar(50) DEFAULT NULL,
  `is_active` varchar(50) DEFAULT NULL,
  `balance_amount` varchar(50) DEFAULT NULL,
  `credit_amount` varchar(50) DEFAULT NULL,
  `credit_balance` varchar(50) DEFAULT NULL,
  `credit_limit` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `ref_doc_id` varchar(50) DEFAULT NULL,
  `cust_type` varchar(50) DEFAULT NULL,
  `parent_cust_id` varchar(50) DEFAULT NULL,
  `call_name` varchar(50) DEFAULT NULL,
  `id_card_no` varchar(50) DEFAULT NULL,
  `id_card_exp` varchar(50) DEFAULT NULL,
  `rtrw` varchar(50) DEFAULT NULL,
  `kel` varchar(50) DEFAULT NULL,
  `kec` varchar(50) DEFAULT NULL,
  `lama_thn` int(11) DEFAULT NULL,
  `lama_bln` int(11) DEFAULT NULL,
  `mother_name` varchar(50) DEFAULT NULL,
  `spouse_name` varchar(50) DEFAULT NULL,
  `spouse_birth_place` varchar(50) DEFAULT NULL,
  `spouse_birth_date` datetime DEFAULT NULL,
  `spouse_phone` varchar(50) DEFAULT NULL,
  `salary_source` varchar(50) DEFAULT NULL,
  `spouse_salary_source` float DEFAULT NULL,
  `other_income_source` float DEFAULT NULL,
  `deduct` float DEFAULT NULL,
  `deduct_source` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `spouse_hp` varchar(50) NOT NULL DEFAULT '0',
  `other_loan` float NOT NULL DEFAULT '0',
  `cust_foto` varchar(250) DEFAULT NULL,
  `rt` int(11) DEFAULT NULL,
  `rw` int(11) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `cust_foto_2` varchar(250) DEFAULT NULL,
  `cust_foto_3` varchar(250) DEFAULT NULL,
  `cust_foto_4` varchar(250) DEFAULT NULL,
  `cust_foto_5` varchar(250) DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x_cust_id` (`cust_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_master: 20 rows
/*!40000 ALTER TABLE `ls_cust_master` DISABLE KEYS */;
REPLACE INTO `ls_cust_master` (`cust_id`, `cust_name`, `first_name`, `last_name`, `street`, `suite`, `city`, `zip_pos`, `region`, `province`, `country`, `phone`, `fax`, `email`, `bank_name`, `bank_acc_number`, `credit_card_number`, `is_send_email`, `is_active`, `balance_amount`, `credit_amount`, `credit_balance`, `credit_limit`, `status`, `ref_doc_id`, `cust_type`, `parent_cust_id`, `call_name`, `id_card_no`, `id_card_exp`, `rtrw`, `kel`, `kec`, `lama_thn`, `lama_bln`, `mother_name`, `spouse_name`, `spouse_birth_place`, `spouse_birth_date`, `spouse_phone`, `salary_source`, `spouse_salary_source`, `other_income_source`, `deduct`, `deduct_source`, `id`, `spouse_hp`, `other_loan`, `cust_foto`, `rt`, `rw`, `hp`, `cust_foto_2`, `cust_foto_3`, `cust_foto_4`, `cust_foto_5`, `create_by`, `update_by`, `create_date`, `update_date`) VALUES
	('00003LS1411', 'Ucok Baba', 'Ucok Baba Sembiring', 'a', 'Jl. Raya Serang Km. 200', 'b', 'Purwakarta', '41172', '1', '1', '1', '082112829192', '1', '1', '1', '1', '1', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, 'Karyawan', '11', 'Ucok', '1243516651', '1970-01-01 07:00:00', '12/12', 'Pasawahan', 'Pasawahan', 5, NULL, 'Yeni', 'Yati Rachman', 'Medan', '1970-01-01 07:00:00', '0221544', NULL, NULL, NULL, NULL, NULL, 9, '02132555', 0, '35aochk-jpg6.png', 12, 12, '02645125661', '51_m1.jpg', '20.jpg', 'Adek4.JPG', 'ah_kieu_weh.jpg', '', 'andri', '1970-01-01 07:00:00', '2015-02-27 19:23:34'),
	('00023LS1503', 'dede yusuf', 'dede', '', 'x', '', 'KABUPATEN BADUNG', '32222', '', 'Bali', '', '082112829192', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'dede', 'dddd', '1970-01-01 07:00:00', '0/0', 'ABIAN BASE', 'ABIAN BASE', 0, NULL, 'dddd', '', '', '2015-03-17 00:00:00', '', NULL, NULL, NULL, NULL, NULL, 40, '', 0, '', 0, 0, '02645125661', '', '', '', '', 'andri', 'andri', '2015-03-17 00:00:00', '2015-03-17 21:58:20');
/*!40000 ALTER TABLE `ls_cust_master` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_personal
CREATE TABLE IF NOT EXISTS `ls_cust_personal` (
  `cust_id` varchar(50) DEFAULT NULL,
  `subcust_id` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `birth_place` varchar(50) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `education` varchar(50) DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `house_status` varchar(50) DEFAULT NULL,
  `salary` decimal(10,0) DEFAULT NULL,
  `spouse_salary` decimal(10,0) DEFAULT NULL,
  `other_income` decimal(10,0) DEFAULT NULL,
  `no_of_dependents` int(11) DEFAULT NULL,
  `year_of_service` int(11) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `deduct` decimal(10,0) DEFAULT NULL,
  `salary_source` varchar(50) DEFAULT NULL,
  `spouse_salary_source` varchar(50) DEFAULT NULL,
  `deduct_source` varchar(50) DEFAULT NULL,
  `other_income_source` varchar(50) DEFAULT NULL,
  `other_loan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_personal: 21 rows
/*!40000 ALTER TABLE `ls_cust_personal` DISABLE KEYS */;
REPLACE INTO `ls_cust_personal` (`cust_id`, `subcust_id`, `gender`, `birth_place`, `birth_date`, `religion`, `occupation`, `education`, `marital_status`, `house_status`, `salary`, `spouse_salary`, `other_income`, `no_of_dependents`, `year_of_service`, `id`, `deduct`, `salary_source`, `spouse_salary_source`, `deduct_source`, `other_income_source`, `other_loan`) VALUES
	('00003LS1411', NULL, 'L', 'Medan', '2015-02-01 19:35:00', NULL, NULL, NULL, '0', '0', 3000000, 2000000, 6000000, 1, NULL, 7, 6000000, 'a', 'b', 'd', 'c', ''),
	('00023LS1503', NULL, 'L', 'ddf', '1970-01-01 07:00:00', NULL, NULL, NULL, '0', '0', 0, 0, 0, 0, NULL, 32, 0, 'ddd', '', NULL, '', '0');
/*!40000 ALTER TABLE `ls_cust_personal` ENABLE KEYS */;


-- Dumping structure for table simak.ls_cust_ship_to
CREATE TABLE IF NOT EXISTS `ls_cust_ship_to` (
  `cust_id` varchar(50) DEFAULT NULL,
  `ship_to_type` varchar(50) DEFAULT NULL,
  `ship_to_id` varchar(50) DEFAULT NULL,
  `relation` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `suite` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip_pos` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `kel` varchar(50) DEFAULT NULL,
  `kec` varchar(50) DEFAULT NULL,
  `rtrw` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `rt` int(9) NOT NULL DEFAULT '0',
  `rw` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_cust_ship_to: 17 rows
/*!40000 ALTER TABLE `ls_cust_ship_to` DISABLE KEYS */;
REPLACE INTO `ls_cust_ship_to` (`cust_id`, `ship_to_type`, `ship_to_id`, `relation`, `first_name`, `last_name`, `street`, `suite`, `city`, `zip_pos`, `region`, `province`, `country`, `phone`, `fax`, `email`, `kel`, `kec`, `rtrw`, `hp`, `id`, `rt`, `rw`) VALUES
	('00004LS1411', 'Saat Ini', NULL, 'Family', 'Andri', NULL, 'Jl. Raya Serang Km. 200', 'Gedung Artha Guna', 'Purwakarta', '', 'Jawa Barat', 'dfads', NULL, '0264-9399393', '', '', 'Pasawahan', 'Pasawahan', '', '', 14, 0, 0),
	('00010LS1412', 'Family', NULL, 'adik', 'ibu ratmi', NULL, 'Jl. Raya Serang Km. 200', NULL, 'Jakarta', '41172', NULL, 'DKI Jakarta', NULL, '082112829192', '0299200111', 'zadr50@yahoo.com', 'pamulang timur', 'Pasawahan', NULL, '2', 39, 1, 12);
/*!40000 ALTER TABLE `ls_cust_ship_to` ENABLE KEYS */;


-- Dumping structure for table simak.ls_dp_range
CREATE TABLE IF NOT EXISTS `ls_dp_range` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `dp_from` float NOT NULL DEFAULT '0',
  `dp_to` float NOT NULL DEFAULT '0',
  `dp_prc` float NOT NULL DEFAULT '0',
  `comments` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.ls_dp_range: 4 rows
/*!40000 ALTER TABLE `ls_dp_range` DISABLE KEYS */;
REPLACE INTO `ls_dp_range` (`id`, `dp_from`, `dp_to`, `dp_prc`, `comments`) VALUES
	(1, 0, 500000, 0, ''),
	(2, 500000, 1500000, 10, ''),
	(3, 1500000, 3000000, 15, ''),
	(4, 3000000, 100000000, 20, '');
/*!40000 ALTER TABLE `ls_dp_range` ENABLE KEYS */;


-- Dumping structure for table simak.ls_invoice_header
CREATE TABLE IF NOT EXISTS `ls_invoice_header` (
  `loan_id` varchar(50) DEFAULT NULL,
  `app_id` varchar(50) DEFAULT NULL,
  `idx_month` int(11) DEFAULT NULL,
  `invoice_number` varchar(50) NOT NULL DEFAULT '',
  `invoice_date` varchar(50) DEFAULT NULL,
  `invoice_type` varchar(50) DEFAULT NULL,
  `amount` float DEFAULT '0',
  `paid` int(11) DEFAULT '0',
  `date_paid` datetime DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `amount_paid` float DEFAULT NULL,
  `voucher` varchar(50) DEFAULT NULL,
  `cust_deal_id` varchar(50) DEFAULT NULL,
  `cust_deal_ship_id` varchar(50) DEFAULT NULL,
  `gross_amount` float DEFAULT '0',
  `disc_amount` float DEFAULT '0',
  `insr_amount` float DEFAULT '0',
  `admin_amount` float DEFAULT '0',
  `pokok` float DEFAULT '0',
  `bunga` float DEFAULT '0',
  `hari_telat` int(11) DEFAULT '0',
  `pokok_paid` float DEFAULT '0',
  `bunga_paid` float DEFAULT '0',
  `denda` float DEFAULT '0',
  `bunga_finalty` float DEFAULT '0',
  `posted` int(11) DEFAULT '0',
  `visit_count` int(11) DEFAULT '0',
  `create_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `denda_tagih` float DEFAULT NULL,
  `saldo` float DEFAULT NULL,
  `saldo_titip` double DEFAULT NULL,
  `saldo_titip_paid` double DEFAULT NULL,
  PRIMARY KEY (`invoice_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_invoice_header: 197 rows
/*!40000 ALTER TABLE `ls_invoice_header` DISABLE KEYS */;
REPLACE INTO `ls_invoice_header` (`loan_id`, `app_id`, `idx_month`, `invoice_number`, `invoice_date`, `invoice_type`, `amount`, `paid`, `date_paid`, `payment_method`, `amount_paid`, `voucher`, `cust_deal_id`, `cust_deal_ship_id`, `gross_amount`, `disc_amount`, `insr_amount`, `admin_amount`, `pokok`, `bunga`, `hari_telat`, `pokok_paid`, `bunga_paid`, `denda`, `bunga_finalty`, `posted`, `visit_count`, `create_by`, `update_by`, `create_date`, `update_date`, `denda_tagih`, `saldo`, `saldo_titip`, `saldo_titip_paid`) VALUES
	('0163000024', 'SPK00024', 1, '0163000024-01', '2015-02-21 23:59:59', 'I', 597429, 0, NULL, NULL, 0, NULL, '00009LS1412', 'C2', 469800, 0, 0, 0, 348000, 121800, 163, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 127629, 0, 0, NULL),
	('4252423', 'SPK00008', 3, '4252423-3', '2015-02-14 23:59:59', 'I', 575273, 0, '2015-02-14 03:50:26', 'Cash', 0, NULL, '00004LS1411', 'C1', 1269790, 0, 0, 0, 524167, 51106.2, 0, 0, 0, 0, 561457, 1, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL);
/*!40000 ALTER TABLE `ls_invoice_header` ENABLE KEYS */;


-- Dumping structure for table simak.ls_invoice_payments
CREATE TABLE IF NOT EXISTS `ls_invoice_payments` (
  `invoice_number` varchar(50) DEFAULT NULL,
  `date_paid` datetime DEFAULT NULL,
  `how_paid` varchar(50) DEFAULT NULL,
  `amount_paid` float DEFAULT '0',
  `voucher_no` varchar(50) DEFAULT NULL,
  `denda` float DEFAULT '0',
  `pokok` float DEFAULT '0',
  `bunga` float DEFAULT '0',
  `asuransi` float DEFAULT '0',
  `admin` float DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `dont_calculate` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.ls_invoice_payments: 66 rows
/*!40000 ALTER TABLE `ls_invoice_payments` DISABLE KEYS */;
REPLACE INTO `ls_invoice_payments` (`invoice_number`, `date_paid`, `how_paid`, `amount_paid`, `voucher_no`, `denda`, `pokok`, `bunga`, `asuransi`, `admin`, `id`, `create_by`, `update_by`, `create_date`, `update_date`, `dont_calculate`) VALUES
	('14120011-1', '2014-12-30 00:00:00', 'Cash', 10, '14120011-1-30', 1, 5, 4, 0, 0, 1, NULL, NULL, NULL, NULL, 0),
	('2013031700022-1', '2015-08-07 00:00:00', 'Cash', 47261, 'P2013031700022-1-143', 0, 47261, 0, 0, 0, 143, 'andri', NULL, '2015-08-07 14:16:50', NULL, 0);
/*!40000 ALTER TABLE `ls_invoice_payments` ENABLE KEYS */;


-- Dumping structure for table simak.ls_loan_col_sched
CREATE TABLE IF NOT EXISTS `ls_loan_col_sched` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `loan_id` varchar(50) NOT NULL,
  `sch_date` datetime NOT NULL,
  `user_col` varchar(50) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `visited` int(11) NOT NULL DEFAULT '0',
  `visit_date` datetime NOT NULL,
  `visit_notes` varchar(50) NOT NULL,
  `amount_col` float NOT NULL,
  `collected` int(11) NOT NULL DEFAULT '0',
  `promise_date` datetime NOT NULL,
  `visit_ke` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.ls_loan_col_sched: 22 rows
/*!40000 ALTER TABLE `ls_loan_col_sched` DISABLE KEYS */;
REPLACE INTO `ls_loan_col_sched` (`id`, `loan_id`, `sch_date`, `user_col`, `invoice_no`, `visited`, `visit_date`, `visit_notes`, `amount_col`, `collected`, `promise_date`, `visit_ke`) VALUES
	(1, '', '1970-01-01 00:00:00', 'andri', '25-1', 1, '2014-12-29 00:00:00', 'kunjungan ke 2', 0, 0, '2014-12-29 14:24:45', 12),
	(22, '', '2015-02-27 00:00:00', 'andri', '14120017-3', 1, '2015-02-28 00:00:00', 'dddd', 0, 0, '2015-02-27 00:00:00', 0);
/*!40000 ALTER TABLE `ls_loan_col_sched` ENABLE KEYS */;


-- Dumping structure for table simak.ls_loan_master
CREATE TABLE IF NOT EXISTS `ls_loan_master` (
  `loan_id` varchar(50) DEFAULT NULL,
  `loan_date` datetime DEFAULT NULL,
  `app_id` varchar(50) DEFAULT NULL,
  `cust_id` varchar(50) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `loan_amount` float DEFAULT NULL,
  `interest_amount` float DEFAULT NULL,
  `dp_amount` float DEFAULT NULL,
  `adm_amount` float DEFAULT NULL,
  `insr_amount` float DEFAULT NULL,
  `ar_amount` float DEFAULT NULL,
  `ar_bal_amount` float DEFAULT NULL,
  `first_dp_amount` float DEFAULT NULL,
  `inst_amount` float DEFAULT NULL,
  `first_paid_amount` float DEFAULT NULL,
  `first_paid_date` datetime DEFAULT NULL,
  `first_adm_amount` float DEFAULT NULL,
  `first_adm_date` datetime DEFAULT NULL,
  `first_insr_amount` float DEFAULT NULL,
  `first_insr_date` datetime DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `first_dealer_id` varchar(50) DEFAULT NULL,
  `max_month` int(11) DEFAULT NULL,
  `interest_percent` float DEFAULT NULL,
  `insr_percent` float DEFAULT NULL,
  `dp_percent` float DEFAULT NULL,
  `dealer_id` varchar(50) DEFAULT NULL,
  `dealer_name` varchar(50) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `last_idx_month` int(11) DEFAULT NULL,
  `last_date_paid` datetime DEFAULT NULL,
  `last_amount_paid` float DEFAULT NULL,
  `total_amount_paid` float DEFAULT NULL,
  `posted` int(11) DEFAULT '0',
  `create_by` varchar(50) DEFAULT NULL,
  `update_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `loan_date_aggr` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_loan_master: 21 rows
/*!40000 ALTER TABLE `ls_loan_master` DISABLE KEYS */;
REPLACE INTO `ls_loan_master` (`loan_id`, `loan_date`, `app_id`, `cust_id`, `cust_name`, `loan_amount`, `interest_amount`, `dp_amount`, `adm_amount`, `insr_amount`, `ar_amount`, `ar_bal_amount`, `first_dp_amount`, `inst_amount`, `first_paid_amount`, `first_paid_date`, `first_adm_amount`, `first_adm_date`, `first_insr_amount`, `first_insr_date`, `paid`, `status`, `first_dealer_id`, `max_month`, `interest_percent`, `insr_percent`, `dp_percent`, `dealer_id`, `dealer_name`, `id`, `last_idx_month`, `last_date_paid`, `last_amount_paid`, `total_amount_paid`, `posted`, `create_by`, `update_by`, `create_date`, `update_date`, `loan_date_aggr`) VALUES
	('4252423', '2014-12-14 15:50:00', 'SPK00008', '00004LS1411', 'Rafi Achmad', 1572500, 51106.2, 277500, 100000, 0, NULL, 1572500, NULL, 575273, NULL, NULL, NULL, NULL, NULL, NULL, 0, '1', 'C1', 3, 0.0325, NULL, 0.15, 'C1', 'Jakarta Barat', 17, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL),
	('01630K00047', '2015-05-03 00:00:00', 'SPK00047', '00023LS1503', 'dede yusuf', 2559200, NULL, 639800, NULL, NULL, NULL, NULL, NULL, 936241, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'C2', 3, 0.0325, NULL, 0.2, 'C2', 'Jakarta Utara ', 49, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '2015-05-10 00:00:00');
/*!40000 ALTER TABLE `ls_loan_master` ENABLE KEYS */;


-- Dumping structure for table simak.ls_loan_obj_items
CREATE TABLE IF NOT EXISTS `ls_loan_obj_items` (
  `obj_item_id` varchar(50) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `disc_amount` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `loan_id` varchar(50) DEFAULT NULL,
  `line_type` varchar(50) DEFAULT NULL,
  `price_list_id` varchar(50) DEFAULT NULL,
  `item_type` varchar(50) DEFAULT NULL,
  `item_brand` varchar(50) DEFAULT NULL,
  `item_model` varchar(50) DEFAULT NULL,
  `bunga` float NOT NULL DEFAULT '0',
  `bunga_amount` float NOT NULL DEFAULT '0',
  `loan_amount` float NOT NULL DEFAULT '0',
  `tenor` int(11) NOT NULL DEFAULT '0',
  `aft_tenor` float NOT NULL DEFAULT '0',
  `angsuran` float NOT NULL DEFAULT '0',
  `made_in` varchar(50) DEFAULT NULL,
  `mfg_year` varchar(50) DEFAULT NULL,
  `colour` varchar(50) DEFAULT NULL,
  `name_on_bpkp` varchar(50) DEFAULT NULL,
  `frame_no` varchar(50) DEFAULT NULL,
  `engine_no` varchar(50) DEFAULT NULL,
  `engine_capacity` varchar(50) DEFAULT NULL,
  `police_no` varchar(50) DEFAULT NULL,
  `insr_company` varchar(50) DEFAULT NULL,
  `insr_policy_no` varchar(50) DEFAULT NULL,
  `insr_name` varchar(50) DEFAULT NULL,
  `insr_order_no` varchar(50) DEFAULT NULL,
  `insr_date_from` datetime DEFAULT NULL,
  `insr_date_to` datetime DEFAULT NULL,
  `insr_amount` float DEFAULT NULL,
  `flat_rate_prc` float DEFAULT NULL,
  `obj_desc` varchar(50) DEFAULT NULL,
  `comments` varchar(150) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `dp` float NOT NULL DEFAULT '0',
  `aft_dp_amount` float NOT NULL DEFAULT '0',
  `dp_amount` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.ls_loan_obj_items: 26 rows
/*!40000 ALTER TABLE `ls_loan_obj_items` DISABLE KEYS */;
REPLACE INTO `ls_loan_obj_items` (`obj_item_id`, `qty`, `unit`, `price`, `discount`, `disc_amount`, `amount`, `loan_id`, `line_type`, `price_list_id`, `item_type`, `item_brand`, `item_model`, `bunga`, `bunga_amount`, `loan_amount`, `tenor`, `aft_tenor`, `angsuran`, `made_in`, `mfg_year`, `colour`, `name_on_bpkp`, `frame_no`, `engine_no`, `engine_capacity`, `police_no`, `insr_company`, `insr_policy_no`, `insr_name`, `insr_order_no`, `insr_date_from`, `insr_date_to`, `insr_amount`, `flat_rate_prc`, `obj_desc`, `comments`, `id`, `dp`, `aft_dp_amount`, `dp_amount`) VALUES
	('hps1', 1, 'Pcs', 1850000, NULL, NULL, 1850000, '4252423', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'samsung duos', NULL, 17, 0, 0, NULL),
	('Palu', 100, 'Pcs', 25000, NULL, NULL, 2500000, '14120017', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Palu', NULL, 18, 0, 0, NULL),
	('100405', 1, 'Pcs', 3199000, NULL, NULL, 3199000, '01630K00047', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HN SMSUNG T2110', NULL, 55, 0, 0, 0);
/*!40000 ALTER TABLE `ls_loan_obj_items` ENABLE KEYS */;


-- Dumping structure for table simak.mat_release_detail
CREATE TABLE IF NOT EXISTS `mat_release_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mat_rel_no` varchar(50) DEFAULT NULL,
  `item_number` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `warehouse` varchar(50) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `line_exec_no` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.mat_release_detail: 0 rows
/*!40000 ALTER TABLE `mat_release_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mat_release_detail` ENABLE KEYS */;


-- Dumping structure for table simak.mat_release_header
CREATE TABLE IF NOT EXISTS `mat_release_header` (
  `mat_rel_no` varchar(50) NOT NULL DEFAULT '',
  `date_rel` datetime DEFAULT NULL,
  `wo_number` varchar(50) DEFAULT NULL,
  `exec_number` varchar(50) DEFAULT NULL,
  `warehouse` varchar(50) DEFAULT NULL,
  `person` varchar(50) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`mat_rel_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.mat_release_header: 1 rows
/*!40000 ALTER TABLE `mat_release_header` DISABLE KEYS */;
REPLACE INTO `mat_release_header` (`mat_rel_no`, `date_rel`, `wo_number`, `exec_number`, `warehouse`, `person`, `comments`) VALUES
	('MR00014', '2016-03-12 00:00:00', 'WO-00017', 'WOE00009', 'Cawang', '', '');
/*!40000 ALTER TABLE `mat_release_header` ENABLE KEYS */;


-- Dumping structure for table simak.maxon_apps
CREATE TABLE IF NOT EXISTS `maxon_apps` (
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.maxon_apps: 19 rows
/*!40000 ALTER TABLE `maxon_apps` DISABLE KEYS */;
REPLACE INTO `maxon_apps` (`app_name`, `app_desc`, `app_type`, `app_ico`, `app_path`, `is_core`, `is_active`, `app_create_by`, `app_url`, `id`, `app_id`, `app_controller`) VALUES
	('Pembelian', 'Pembuatan purchase order (PO) supplier, beserta pengelolaan hutang dan pelunasan hutang.', 'Modul', 'ico_purchase.png', '\\', 1, 1, 'andri', 'purchase', 1, '_40000', 'purchase'),
	('Penjualan', 'Pembuatan sales order (SO) pelanggan, pengiriman, kartu piutang sampai pelunasan piutang.', 'Modul', 'ico_sales.png', '\\', 1, 1, 'andri', 'sales', 2, '_30000', 'sales'),
	('Inventory', 'Pengelolaan data stock meliputi penerimaan, pengeluaran, transfer, adjustment dan lainnya.', 'Modul', 'ico_inventory.png', '\\', 1, 1, 'andri', 'inventory', 3, '_80000', 'inventory'),
	('Buku Kas', 'Pencatatan kas masuk dan kas keluar diluar pelunasan hutang piutang.', 'Modul', 'ico_bank.png', '\\', 1, 1, 'andri', 'bank', 4, '_60000', 'bank'),
	('Aktiva Tetap', 'Pengelolaan biaya penyusutan terhadap aktiva tetap seperti gedung, kendaraan dan lainnya', 'Modul', 'ico_asset.png', '\\', 0, 1, 'andri', '', 5, '_14000', 'aktiva'),
	('Manufacture', 'Proses pembuatan dari mulai bahan baku sampai penerimaan barang jadi di sebuah pabrik.', 'Modul', 'ico_manuf.png', '\\', 0, 1, 'andri', '', 6, '_11000', 'manuf'),
	('Payroll', 'Pengelollan data pegawai berupa absensi, shift, tunjangan, slip gaji dan lainnya', 'Modul', 'ico_payroll.png', '\\', 0, 0, 'andri', '', 7, '_12000', 'payroll'),
	('Koperasi', 'Pencatatan anggota koperasi beserta pinjaman, tabungan dan pelunasannya.', 'Modul', 'ico_koperasi.png', '\\', 0, 0, 'andri', '', 8, '_13000', 'koperasi'),
	('Point Of Sales', 'Modul penjualan tunai / kasir, untuk melayani pelanggan secara cepat', 'Modul', 'ico_pos.png', '\\', 0, 1, 'andri', '', 9, '_30000.0', 'pos'),
	('Akuntansi', 'Modul buku besar dan jurnal-jurnal yang dihasilkan semua transaksi yang menghasilkan laporan neraca dan rugi laba', 'Modul', 'ico_akun.png', '\\', 1, 1, 'andri', '', 10, '_10000', 'gl'),
	('Travel Agent', 'Modul untuk usaha travel agent, meliputi jadwal pesawat pembuatan invoice dan pelunasan.', 'Modul', 'office.png', '\\', 0, 0, 'andri', '', 11, '_21000', 'travel'),
	('Hotel', 'Modul pengelolaan data transaksi untuk usaha hotel dan penginapan.', 'Modul', 'eog.png', '\\', 0, 0, 'andri', '', 12, '_15000', 'hotel'),
	('Restaurant', 'Modul untuk dipakai di restoran dan rumah makan', 'Modul', 'gazpacho.png', '\\', 0, 0, 'andri', '', 13, '_16000', 'resto'),
	('Laundry', 'Modul untuk laundry dan pencucian pakaian.', 'Modul', 'glob2-icon-48.png', '\\', 0, 0, 'andri', '', 14, '_17000', 'laundry'),
	('Leasing', 'Modul untuk usaha leasing dan kredit kendaraan beserta angsurannya', 'Modul', 'gnome-fs-network.png', '\\', 0, 0, 'andri', '', 15, '_18000', 'leasing'),
	('Sekolah', 'Modul untuk sekolah dan dunia pendidikan.";', 'Modul', 'gnome-db.png', '\\', 0, 0, 'andri', '', 16, '_19000', 'sekolah'),
	('Setting', 'Seting user login, kelompok user atau job dan modul yang boleh di akses.', 'Modul', 'ico_setting.png', '\\', 1, 1, 'andri', '', 17, '_00000', 'admin'),
	('Website', 'Halaman utama untuk website perusahaan', 'Modul', 'office.png', '\\', 0, 0, 'andri', '', 18, '_20000', 'website'),
	('Online Shop', 'Halaman Penjualan Online', 'Modul', 'eog.png', '\\eshop', 0, 0, 'andri', 'eshop', 19, 'eshop', 'eshop');
/*!40000 ALTER TABLE `maxon_apps` ENABLE KEYS */;


-- Dumping structure for table simak.maxon_chat
CREATE TABLE IF NOT EXISTS `maxon_chat` (
  `userid` varchar(50) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.maxon_chat: 26 rows
/*!40000 ALTER TABLE `maxon_chat` DISABLE KEYS */;
REPLACE INTO `maxon_chat` (`userid`, `message`, `id`) VALUES
	('Guest', 'test', 1),
	('andri', 'saldo awal barang diinput lewat menu inventory disebelah kanan ada menu terima barang non po', 26);
/*!40000 ALTER TABLE `maxon_chat` ENABLE KEYS */;


-- Dumping structure for table simak.maxon_inbox
CREATE TABLE IF NOT EXISTS `maxon_inbox` (
  `rcp_from` varchar(250) DEFAULT NULL,
  `rcp_to` varchar(250) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT NULL,
  `msg_date` datetime DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `reply_id` int(9) NOT NULL DEFAULT '0',
  `is_archieve` tinyint(4) NOT NULL DEFAULT '0',
  `is_trash` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.maxon_inbox: 112 rows
/*!40000 ALTER TABLE `maxon_inbox` DISABLE KEYS */;
REPLACE INTO `maxon_inbox` (`rcp_from`, `rcp_to`, `subject`, `message`, `is_read`, `msg_date`, `id`, `reply_id`, `is_archieve`, `is_trash`) VALUES
	('andri', 'admin', 'subject', 'message', NULL, '2014-11-19 16:42:19', 1, 0, 0, 0),
	('anang', 'bagus', 'ggg', 'gg', 0, '2015-07-27 23:20:14', 112, 108, 0, 0);
/*!40000 ALTER TABLE `maxon_inbox` ENABLE KEYS */;


-- Dumping structure for table simak.maxon_log_ip
CREATE TABLE IF NOT EXISTS `maxon_log_ip` (
  `period` varchar(50) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.maxon_log_ip: 47 rows
/*!40000 ALTER TABLE `maxon_log_ip` DISABLE KEYS */;
REPLACE INTO `maxon_log_ip` (`period`, `ip_address`) VALUES
	('20150222', '192.168.1.15'),
	('20160202', '::1');
/*!40000 ALTER TABLE `maxon_log_ip` ENABLE KEYS */;


-- Dumping structure for table simak.maxon_market
CREATE TABLE IF NOT EXISTS `maxon_market` (
  `app_title` varchar(200) DEFAULT NULL,
  `app_desc` varchar(200) DEFAULT NULL,
  `app_type` varchar(50) DEFAULT NULL,
  `lic_type` varchar(50) DEFAULT NULL,
  `app_ico` varchar(50) DEFAULT NULL,
  `app_path` varchar(50) DEFAULT NULL,
  `is_core` int(11) DEFAULT '0',
  `is_active` int(11) DEFAULT '0',
  `app_create_by` varchar(50) DEFAULT NULL,
  `app_url` varchar(200) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(50) NOT NULL,
  `app_controller` varchar(150) NOT NULL,
  `app_file` varchar(150) NOT NULL,
  `app_scr_1` varchar(150) NOT NULL,
  `app_scr_2` varchar(150) NOT NULL,
  `app_scr_3` varchar(150) NOT NULL,
  `app_scr_4` varchar(150) NOT NULL,
  `app_scr_5` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table simak.maxon_market: 8 rows
/*!40000 ALTER TABLE `maxon_market` DISABLE KEYS */;
REPLACE INTO `maxon_market` (`app_title`, `app_desc`, `app_type`, `lic_type`, `app_ico`, `app_path`, `is_core`, `is_active`, `app_create_by`, `app_url`, `id`, `app_id`, `app_controller`, `app_file`, `app_scr_1`, `app_scr_2`, `app_scr_3`, `app_scr_4`, `app_scr_5`) VALUES
	('1', '1', 'themes', 'free', NULL, NULL, 0, 0, '1', NULL, 19, '', '', '', '', '', '', '', ''),
	('4', '4', 'apps', 'paid', '0', NULL, 0, 0, '44', NULL, 20, '', '', '0', '', '', '', '', ''),
	('66', '6', 'themes', 'paid', 'hamil.jpg', NULL, 0, 0, '6', NULL, 21, '', '', 'coet.zip', '', '', '', '', ''),
	('Payroll', 'Pengelolaan data karyawan dan penggajian beserta absensi secara realtime, modul: pegawai, absensi, overtime, slip gaji, pph21', 'apps', 'paid', 'coet.jpg', NULL, 0, 0, 'Andri', NULL, 22, '', '', 'coet.zip', '', '', '', '', ''),
	('Buku Panduan MaxOn ERP Software', 'Buku panduan dasar-dasar penggunakan aplikasi software MaxOn ERP berisi tutorial dan tatacara penggunaan, disusun secara mudah untuk dipelajari.', 'books', 'free', 'maling bh.jpg', NULL, 0, 0, 'Andri', NULL, 23, '', '', 'coet.zip', '', '', '', '', ''),
	('Buku Panduan Untuk Developer', 'Berisi panduan untuk developer atau programmer yang ingin menambah fungsi atau modul-modul atau tema yang bisa anda tambahkan ke dalam software MaxOn ERP.', 'books', 'paid', '10968446_1050713611611315_3536989720526861468_n.jp', NULL, 0, 0, 'Andri', NULL, 24, '', '', 'coet.zip', 'djuarsa.jpg', 'maling bh.jpg', 'gambar-orang-lucu-narsis.jpg', 'kutil.jpg', 'IMG_2665.JPG'),
	('6', '6', 'themes', 'free', '', NULL, 0, 0, '6', NULL, 27, '', '', '', '', '', '', '', ''),
	('Funny Books', 'dkjfalkds klsdfjsa klfjsdalkfj salkjsad lksjflskajf sdlkjfsa lfkjslfkjs alfkajslkfajs flsda;jfd', 'books', 'paid', 'bayi-lucu-112.jpg', NULL, 0, 0, 'Andri', NULL, 28, '', '', 'bayi-lucu-12.jpg', 'bayi-lucu-113.jpg', 'bayi-lucu-114.jpg', 'bayi-lucu-115.jpg', 'bayi-lucu-116.jpg', 'bayi-lucu-117.jpg');
/*!40000 ALTER TABLE `maxon_market` ENABLE KEYS */;


-- Dumping structure for table simak.media_list
CREATE TABLE IF NOT EXISTS `media_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Index 1` (`filename`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.media_list: 2 rows
/*!40000 ALTER TABLE `media_list` DISABLE KEYS */;
REPLACE INTO `media_list` (`id`, `filename`, `description`, `title`) VALUES
	(1, 'martabak1.jpg', 'martabak 1', 'martabak'),
	(2, 'eshop.jpg', 'ehsop', 'ehsop');
/*!40000 ALTER TABLE `media_list` ENABLE KEYS */;


-- Dumping structure for table simak.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `module_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `module_name` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `form_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(225) CHARACTER SET utf8 DEFAULT NULL,
  `parentid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sequence` int(5) DEFAULT NULL,
  `visible` int DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.modules: 606 rows
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
REPLACE INTO `modules` (`module_id`, `module_name`, `type`, `form_name`, `description`, `parentid`, `update_status`, `sequence`, `visible`, `controller`) VALUES
	('frmCustomers.cmdSaveShipTo', 'frmCustomers.cmdSaveShipTo', 'Form', 'frmCustomers.cmdSaveShipTo', 'frmCustomers.cmdSaveShipTo', '_30010', 0, NULL, NULL, NULL),
	('frmMain.Addnew', 'frmMain.Addnew', 'Form', 'frmMain.Addnew', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('frmRptCriteria', 'frmRptCriteria', 'Form', 'frmRptCriteria', 'Please entry this', '_90000', 0, NULL, NULL, NULL),
	('ID_ExportImport', 'ID_ExportImport', 'Form', 'ID_ExportImport', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('ID_ItemPrices', 'Item Prices', 'Form', 'ID_ItemPrices', '', 'ID_ItemPrices', 0, 0, b'10000000', ''),
	('ID_JasaKiriman', 'ID_JasaKiriman', 'Form', 'ID_JasaKiriman', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('\\CEK\\BANKCEK2.RPT', '004. Cek keluar - Status Belum Cair / Gantung', 'Form', '\\CEK\\BANKCEK2.RPT', '004. Cek Keluar - Status Belum Cair', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\BANKCEKGL.RPT', '011. Laporan Cek Keluar (Dengan Kode Perkiraan)', 'Form', '\\CEK\\BANKCEKGL.RPT', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\BANKCEKM2.RPT', '005. Cek Masuk - Status Belum Cair / Gantung', 'Form', '\\CEK\\BANKCEKM2.RPT', 'A005. Cek Masuk - Status Belum Cair', '_90010', 0, NULL, NULL, NULL),
	('\\cek\\BANKCODE.rpt', '001. Daftar Bank', 'Form', '\\cek\\BANKCODE.rpt', 'A004. Cek Keluar - Status Cair', '_90010', 0, NULL, NULL, NULL),
	('\\Cek\\BankMutasiBank.rpt', '012. Laporan Mutasi Transaksi Bank', 'Form', '\\Cek\\BankMutasiBank.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\ChInSum.Rpt', '006. Daftar Penerimaan Cek/Giro', 'Form', '\\CEK\\ChInSum.Rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\ChOutSum.Rpt', '007. Daftar Pengeluran Cek/Giro', 'Form', '\\CEK\\ChOutSum.Rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\KasInSum.Rpt', '002. Daftar Penerimaan Kas', 'Form', '\\CEK\\KasInSum.Rpt', 'Daftar Penerimaan Kas', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\KasOutSum.Rpt', '003. Daftar Pengeluran Kas', 'Form', '\\CEK\\KasOutSum.Rpt', 'Daftar Pengeluaran Kas', '_90010', 0, NULL, NULL, NULL),
	('\\Cek\\MutasiKas_Saldo.rpt', '008. Laporan Mutasi Kas/Bank', 'Form', '\\Cek\\MutasiKas_Saldo.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\transfer_in.rpt', '009. Daftar Penerimaan transfer', 'Form', '\\CEK\\transfer_in.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\CEK\\transfer_out.rpt', '010. Daftar Pengeluaran transfer', 'Form', '\\CEK\\transfer_out.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\gl\\balancesheet2.rpt', '009. Laporan Neraca', 'Form', '\\gl\\balancesheet2.rpt', '009. Laporan Neraca', '_90010', 0, NULL, NULL, NULL),
	('\\gl\\neracaT.rpt', 'Laporan Neraca T-Form', 'Form', '\\gl\\neracaT.rpt', 'Laporan Neraca T-Form', '_90010', 0, NULL, NULL, NULL),
	('\\gl\\RLCompare.rpt', 'Laporan Rugi Laba Comparison', 'Form', '\\gl\\RLCompare.rpt', 'Laporan Rugi Laba Comparison', '_90010', 0, NULL, NULL, NULL),
	('\\Inv\\AsmItem.Rpt', 'Laporan Assembly item', 'Form', '\\Inv\\AsmItem.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\AsmItem17.Rpt', '022. Laporan Assembly item - Summary', 'Form', '\\Inv\\AsmItem17.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\DaftarBarang.Rpt', 'Laporan Daftar  Barang', 'Form', '\\Inv\\DaftarBarang.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\FisikInventory.rpt', 'Laporan Fisik Inventory', 'Form', '\\Inv\\FisikInventory.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\HargaBeli.Rpt', 'Laporan Daftar Harga Beli', 'Form', '\\Inv\\HargaBeli.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\HargaJual.Rpt', 'Laporan Daftar Harga Jual', 'Form', '\\Inv\\HargaJual.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\InventoryMoving.rpt', 'Laporan Keluar Masuk Barang', 'Form', '\\Inv\\InventoryMoving.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\InvPriceHistory.rpt', 'Laporan History Harga', 'Form', '\\Inv\\InvPriceHistory.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\InvTranCategory.Rpt', '023. Inventory Transaction by Category', 'Form', '\\Inv\\InvTranCategory.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\InvTranItem.Rpt', '024. Inventory Transaction by Item Number', 'Form', '\\Inv\\InvTranItem.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\inv\\invvalue.rpt', 'Laporan Nilai Persediaan Inventory', 'Form', '\\inv\\invvalue.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\inv\\KeluarReturPembelian.rpt', 'Pengeluaran Barang Retur Pembelian', 'Form', '\\inv\\KeluarReturPembelian.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\MutasiGudang.rpt', 'Mutasi Per Barang Per Gudang', 'Form', '\\Inv\\MutasiGudang.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\StokMgmtLow.rpt', 'Stock Mgmt - Inventory Low Stock', 'Form', '\\Inv\\StokMgmtLow.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\StokMgMtOnBOrder.rpt', 'Stock MgMt - Inventory on Back Order', 'Form', '\\Inv\\StokMgMtOnBOrder.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\StokMgMtOut.rpt', 'Stock MgMt - Inventory Out Of Stock', 'Form', '\\Inv\\StokMgMtOut.rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Inv\\StokMgMtRecon.Rpt', 'Stock MgMt - Inventory Reconsiliation', 'Form', '\\Inv\\StokMgMtRecon.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\Po\\DaftarHutang.rpt', 'A0041. Hutang Supplier dan Pembayaran', 'Form', '\\Po\\DaftarHutang.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\DaftarSupplier.rpt', 'A002. Daftar Supplier Urut Nama', 'Form', '\\po\\DaftarSupplier.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\DaftarSupplierUtama.rpt', 'Daftar Hutang per Supplier', 'Form', '\\po\\DaftarSupplierUtama.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\Po\\HistoryHargaItemSupplier.rpt', '020. History Harga Item Per Supplier', 'Form', '\\Po\\HistoryHargaItemSupplier.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\PO\\Keluar.rpt', 'Laporan Pengeluaran Barang', 'Form', '\\PO\\Keluar.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\KeluarPerPO.rpt', 'Laporan Pengeluaran Barang/Retur - Per PO', 'Form', '\\PO\\KeluarPerPO.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\OpenPO.rpt', 'Open Purchase Order by PO Number', 'Form', '\\PO\\OpenPO.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\Po\\OrderPembelian.rpt', 'Order Pembelian / PO', 'Form', '\\Po\\OrderPembelian.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\Po\\OrderPembelianItemSupplierDetail.rpt', 'A008. Pembelian  per Item, Supplier - Detail ', 'Form', '\\Po\\OrderPembelianItemSupplierDetail.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\PayAnaSupplier.Rpt', 'A016. Total Pembayaran per Supplier - Detail', 'Form', '\\PO\\PayAnaSupplier.Rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\PO\\PayDetailDaily.Rpt', 'A014. Total Pembayaran Harian', 'Form', '\\PO\\PayDetailDaily.Rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\PO\\PayDetailMonthly.Rpt', 'A015. Total Pembayaran Bulanan', 'Form', '\\PO\\PayDetailMonthly.Rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\PO\\PODaily.rpt', 'A009. Total Faktur Pembelian dibuat - Harian - Summary', 'Form', '\\PO\\PODaily.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\PODetailDaily.rpt', 'A010. Total Faktur Pembelian dibuat - Harian - Detail', 'Form', '\\PO\\PODetailDaily.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\POItemNoRecvItem.rpt', 'Purchase Order Items Not Received- by Item', 'Form', '\\PO\\POItemNoRecvItem.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\POItemNoRecvSupplier.rpt', 'Purchase Order Items Not Received- by Supplier', 'Form', '\\PO\\POItemNoRecvSupplier.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\POItemOverItem.rpt', 'Purchase Order Items Overdue - by Item', 'Form', '\\PO\\POItemOverItem.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\POItemOverSupplier.rpt', 'Purchase Order Items Overdue - by Supplier', 'Form', '\\PO\\POItemOverSupplier.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\PO\\POMonthly.rpt', 'A011. Total Faktur Pembelian dibuat - Bulanan - Summary', 'Form', '\\PO\\POMonthly.rpt', 'Please entry this', '_90070', 0, NULL, NULL, NULL),
	('\\Po\\SaldoHutang.rpt', 'A005. Daftar Saldo Hutang Supplier', 'Form', '\\Po\\SaldoHutang.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\SelisihKursHutang1.Rpt', '015. Selisih Kurs Pembelian', 'Form', '\\po\\SelisihKursHutang1.Rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\sisa_hutang.rpt', '011. Daftar Sisa Hutang - Per Invoice', 'Form', '\\po\\sisa_hutang.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\sisa_hutang_bulan.rpt', '012. Daftar Sisa Hutang - Per Bulan', 'Form', '\\po\\sisa_hutang_bulan.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\po\\supplierEnvelop.rpt', 'Supplier Envelope', 'Form', '\\po\\supplierEnvelop.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\Po\\SupplierLstFinancial.rpt', 'Supplier Financial Listing', 'Form', '\\Po\\SupplierLstFinancial.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\Po\\SupplierLstNumber.Rpt', 'Supplier List by Supplier Number', 'Form', '\\Po\\SupplierLstNumber.Rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\Po\\SupplierPayables.rpt', 'Supplier Total Period Payables', 'Form', '\\Po\\SupplierPayables.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\PO\\Terima.Rpt', '021. Penerimaan Barang - Detail', 'Form', '\\PO\\Terima.Rpt', 'Please entry this', '_90040', 0, NULL, NULL, NULL),
	('\\PO\\TotalPayableSupplier.rpt', 'Total Period Payable Paid by Supplier', 'Form', '\\PO\\TotalPayableSupplier.rpt', 'Please entry this', '_90120', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerCustomerPerbulan.rpt', 'A003. Penjualan per Customer - Summary', 'Form', '\\So\\AnalisaPenjualanPerCustomerPerbulan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerJenisPembayaranDetail.rpt', 'A012. Penjualan per Jenis Pembayaran - Detail', 'Form', '\\So\\AnalisaPenjualanPerJenisPembayaranDetail.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerJenisPembayaranPerbulan.rpt', 'A011. Penjualan per Jenis Pembayaran - Summary', 'Form', '\\So\\AnalisaPenjualanPerJenisPembayaranPerbulan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerKategoryCustomer.rpt', 'Laporan analisa penjualan per kategory customer', 'Form', '\\So\\AnalisaPenjualanPerKategoryCustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerSalesmanPerbulan.rpt', 'Laporan analisa penjualan per salesman - perbulan', 'Form', '\\So\\AnalisaPenjualanPerSalesmanPerbulan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerSourcePerbulan.rpt', 'Laporan analisa penjualan per source of order - perbulan', 'Form', '\\So\\AnalisaPenjualanPerSourcePerbulan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\AnalisaPenjualanPerWilayah.rpt', 'Laporan analisa penjualan per wilayah', 'Form', '\\So\\AnalisaPenjualanPerWilayah.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\CustCredit.rpt', 'Customer on Credit Hold', 'Form', '\\so\\CustCredit.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\so\\CustCreditAll.rpt', 'Customer on Credit Hold - Columns Style', 'Form', '\\so\\CustCreditAll.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\So\\CustHighest.Rpt', 'Customer Sales by Highest Total', 'Form', '\\So\\CustHighest.Rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\so\\CustListCompany.rpt', 'Customer Listing by Company', 'Form', '\\so\\CustListCompany.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\so\\CustListCustomer.rpt', 'Customer Listing by Customer Number', 'Form', '\\so\\CustListCustomer.rpt', 'Please entry this', '_90010', 0, NULL, NULL, NULL),
	('\\so\\customerEnvelop.rpt', 'Customer Envelope/Label', 'Form', '\\so\\customerEnvelop.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\CustPayHistory2.rpt', 'A0061. Piutang Customer dan Pembayaran', 'Form', '\\so\\CustPayHistory2.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\CustPayHistoryByCust.rpt', 'A003. Daftar pembayaran piutang - group by customer', 'Form', '\\So\\CustPayHistoryByCust.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\CustSalesHistory.rpt', 'Customer Sales History', 'Form', '\\So\\CustSalesHistory.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\CustSalesHistoryLast.rpt', 'Customer Sales History - Last Order', 'Form', '\\So\\CustSalesHistoryLast.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\daftarcustomer.rpt', 'A001. Daftar Customer urut Nama', 'Form', '\\so\\daftarcustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\DaftarPiutang.rpt', 'A006. Piutang Customer dan Pembayaran', 'Form', '\\so\\DaftarPiutang.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\DaftarTagihan.rpt', 'Daftar Tagihan dan Pembayaran', 'Form', '\\So\\DaftarTagihan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\DODetail100.Rpt', 'Laporan Pengiriman Barang / DO', 'Form', '\\So\\DODetail100.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPelunasanPiutang.Rpt', 'A009. Pelunasan Piutang - per Invoice (All)', 'Form', '\\So\\FakturPelunasanPiutang.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanDetailTanggal.Rpt', 'A2.Faktur Penjualan - Summary', 'Form', '\\So\\FakturPenjualanDetailTanggal.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanDetailtem.Rpt', 'A006. Penjualan per Item - Detail', 'Form', '\\So\\FakturPenjualanDetailtem.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummary.Rpt', 'Faktur Penjualan - Summary - Jenis Pembayaran', 'Form', '\\So\\FakturPenjualanSummary.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummaryBayar.Rpt', 'Faktur Penjualan - Summary - Per Status Pembayaran', 'Form', '\\So\\FakturPenjualanSummaryBayar.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummaryItemCust.Rpt', 'A012. Penjualan per Customer per Item - Detail', 'Form', '\\So\\FakturPenjualanSummaryItemCust.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummarySupplier.Rpt', 'Faktur Penjualan - Summary - Per Supplier', 'Form', '\\So\\FakturPenjualanSummarySupplier.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummaryTanggal.Rpt', 'Faktur Penjualan - Summary -  per tanggal', 'Form', '\\So\\FakturPenjualanSummaryTanggal.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FakturPenjualanSummaryWilayah.Rpt', 'Faktur Penjualan - Summary - Per Wilayah', 'Form', '\\So\\FakturPenjualanSummaryWilayah.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FB_RoomResv.rpt', 'F&B Room Reservation - Daily', 'Form', '\\So\\FB_RoomResv.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FB_RoomResv2.rpt', 'F&B Room Reservation - Daily - By Waiter', 'Form', '\\So\\FB_RoomResv2.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FB_RoomResv3.rpt', 'F&B Room Reservation - Daily - By Room', 'Form', '\\So\\FB_RoomResv3.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FB_RoomResvSumDay.rpt', 'F&B Room Reservation Summary - Daily', 'Form', '\\So\\FB_RoomResvSumDay.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\FB_TableResv.rpt', 'F&B Table Reservation - Daily', 'Form', '\\So\\FB_TableResv.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\HargaHistoryMonthly.rpt', 'Laporan History Harga Monthly', 'Form', '\\SO\\HargaHistoryMonthly.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\HistoryHargaItemCustomer.rpt', '019. History Harga Item Per Customer', 'Form', '\\So\\HistoryHargaItemCustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\InvoiceAllTypePerCustomer.rpt', 'Invoice - All Type - per Customers', 'Form', '\\So\\InvoiceAllTypePerCustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\InvoicePerTypePerCustomer.rpt', 'Invoice - InvoiceType - per Customers', 'Form', '\\So\\InvoicePerTypePerCustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\Jual100.Rpt', 'Laporan Penjualan Detail', 'Form', '\\So\\Jual100.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\JualCustSum.Rpt', 'Penjualan per Customer', 'Form', '\\so\\JualCustSum.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualKasirDateTime.Rpt', 'Laporan penjualan kasir with Date, Time', 'Form', '\\SO\\JualKasirDateTime.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualKonsinyasiTglMonthly.Rpt', 'Laporan Penjualan Konsinyasi Bulanan', 'Form', '\\SO\\JualKonsinyasiTglMonthly.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualReturTglMonthly.Rpt', 'Laporan Retur Penjualan Bulanan', 'Form', '\\SO\\JualReturTglMonthly.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualTglMonthly.Rpt', 'Laporan Penjualan Bulanan', 'Form', '\\SO\\JualTglMonthly.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualTglMonthlyDept.Rpt', 'Laporan Penjualan per Department', 'Form', '\\SO\\JualTglMonthlyDept.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\JualTglMonthlySales.Rpt', 'Laporan Penjualan Bulanan per Salesman', 'Form', '\\SO\\JualTglMonthlySales.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\KomisiSalesmanMonthly.rpt', 'Laporan Komisi Salesman - per Bulan', 'Form', '\\So\\KomisiSalesmanMonthly.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\KomisiSalesmanSummary.rpt', 'Laporan Komisi Salesman - Total Periode', 'Form', '\\So\\KomisiSalesmanSummary.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\KreditMemoSummary.rpt', 'Kredit Memo Summary', 'Form', '\\So\\KreditMemoSummary.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\MutasiStock.Rpt', 'Laporan Mutasi Stock Bulanan', 'Form', '\\SO\\MutasiStock.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\MutasiStockPrice.Rpt', 'Laporan Mutasi Stock, Price Bulanan ', 'Form', '\\SO\\MutasiStockPrice.Rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\PenjualanCustomer.rpt', 'Penjualan per Customer - Detail', 'Form', '\\So\\PenjualanCustomer.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\PenjualanCustomerDetail.rpt', 'A002. Penjualan per Customer - Detail', 'Form', '\\So\\PenjualanCustomerDetail.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\PenjualanPerbulanDetail.rpt', 'A002. Penjualan perbulan - Detail', 'Form', '\\So\\PenjualanPerbulanDetail.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\So\\SaldoPiutang.rpt', 'A007. Daftar Saldo Piutang Customer', 'Form', '\\So\\SaldoPiutang.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\SalesKomisi.exe', 'Query Komisi Salesman', 'Form', '\\SO\\SalesKomisi.exe', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\SalesOrder.rpt', 'Sales Order Summary', 'Form', '\\SO\\SalesOrder.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\SalesOrderDetail.rpt', 'Sales Order Detail', 'Form', '\\so\\SalesOrderDetail.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\salesorder_do.rpt', 'Sales Order - Delivery Order - Summary', 'Form', '\\so\\salesorder_do.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\salesorder_do_item.rpt', 'Sales Order - Delivery Order - Item - Detail', 'Form', '\\so\\salesorder_do_item.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\sisa_piutang.rpt', '011. Daftar Sisa Piutang - Per Invoice', 'Form', '\\so\\sisa_piutang.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\so\\sisa_piutang_bulan.rpt', '012. Daftar Sisa Piutang - Per Bulan', 'Form', '\\so\\sisa_piutang_bulan.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\SOOpenItem.rpt', 'Open Sales Order - by Item', 'Form', '\\SO\\SOOpenItem.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('\\SO\\SOOpenTanggal.rpt', 'Open Sales Order - by Tanggal', 'Form', '\\SO\\SOOpenTanggal.rpt', 'Please entry this', '_90090', 0, NULL, NULL, NULL),
	('_00000', 'Setting', 'Form', '_00000', 'Setup data perusahaan atau aturan-aturan umum lainnya.', '0', 0, 7, b'10000000', ''),
	('_00010', 'Job Responsibility', 'Form', 'jobs', 'Job Responsibility', '_00000', 1, 3, b'10000000', NULL),
	('_00011', 'Create', 'Form', '_00011', '.', '_00010', 1, NULL, NULL, NULL),
	('_00012', 'Edit', 'Form', '_00012', '.', '_00010', 1, NULL, NULL, NULL),
	('_00013', 'Delete', 'Form', '_00013', '.', '_00010', 1, NULL, NULL, NULL),
	('_00020', 'User Access', 'Form', 'user', 'User Access', '_00000', 1, 2, b'10000000', NULL),
	('_00021', 'Create', 'Form', '_00021', '.', '_00020', 1, NULL, NULL, NULL),
	('_00022', 'Edit', 'Form', '_00022', '.', '_00020', 1, NULL, NULL, NULL),
	('_00023', 'Delete', 'Form', '_00023', '.', '_00020', 1, NULL, NULL, NULL),
	('_00030', 'Global Setting', 'Form', 'seting', 'Global Setting', '_00000', 1, 1, b'10000000', NULL),
	('_00031', 'Save', 'Form', '_00031', '.', '_00030', 1, NULL, NULL, NULL),
	('_00032', 'Remove All Database', 'Form', '_00032', 'Remove All Database', '_00030', 1, NULL, NULL, NULL),
	('_00040', 'Report List System', 'Form', 'report_list', 'Report List System', '_00000', 1, 4, b'10000000', NULL),
	('_00041', 'Add', 'Form', 'frmReportList.cmdAdd', '.', '_00040', 1, NULL, NULL, NULL),
	('_00042', 'Edit', 'Form', 'frmReportList.cmdEdit', '.', '_00040', 1, NULL, NULL, NULL),
	('_00043', 'Delete', 'Form', 'frmReportList.cmdDelete', '.', '_00040', 1, NULL, NULL, NULL),
	('_00050', 'List Modules System', 'Form', 'modules', 'List Modules System', '_00000', 1, 5, b'10000000', NULL),
	('_10000', 'General Ledger', 'Form', '_10000', 'Modul General Ledger atau Akuntansi.', '0', 0, 0, b'10000000', ''),
	('_10010', 'Perkiraan (COA)', 'Form', '_10010', '.', '_10000', 1, NULL, b'10000000', NULL),
	('_10011', 'Create', 'Form', '_10011', '.', '_10010', 1, NULL, NULL, NULL),
	('_10012', 'Edit', 'Form', '_10012', '.', '_10010', 1, NULL, NULL, NULL),
	('_10013', 'Delete', 'Form', '_10013', '.', '_10010', 1, NULL, NULL, NULL),
	('_10015', 'Create New COA Group', 'Form', '_10015', 'Create New COA Group', '_10010', 1, NULL, NULL, NULL),
	('_10016', 'Remove COA Group', 'Form', '_10016', 'Remove COA Group', '_10010', 1, NULL, NULL, NULL),
	('_10020', 'Budgeting ', 'Form', 'budget', 'Budgeting Cost', '_10000', 1, 5, b'10000000', NULL),
	('_10021', 'Save', 'Form', '_10021', '.', '_10020', 1, NULL, NULL, NULL),
	('_10030', 'Periode Akuntansi', 'Form', 'periode', 'Periode Akuntansi', '_10000', 1, 4, b'10000000', NULL),
	('_10031', 'Save', 'Form', '_10031', '.', '_10030', 1, NULL, NULL, NULL),
	('_10032', 'Copy To New Periode', 'Form', '_10032', '.', '_10030', 1, NULL, NULL, NULL),
	('_10035', 'Closing Periode', 'Form', '_10035', '.', '_10030', 1, NULL, NULL, NULL),
	('_10036', 'Re-Opening Periode', 'Form', '_10036', '.', '_10030', 1, NULL, NULL, NULL),
	('_10060', 'Jurnal Entry', 'Form', 'jurnal', 'Jurnal Umum', '_10000', 1, 3, b'10000000', NULL),
	('_10060A', '_10060A', 'Form', '_10060A', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_10061', 'Create', 'Form', '_10061', '.', '_10060', 1, NULL, NULL, NULL),
	('_10062', 'Edit', 'Form', '_10062', '.', '_10060', 1, NULL, NULL, NULL),
	('_10063', 'Delete', 'Form', '_10063', '.', '_10060', 1, NULL, NULL, NULL),
	('_10064', 'Jenis Perkiraan / COA', 'Form', 'coa', 'Jenis Perkiraan / COA', '_10000', 1, 1, b'10000000', NULL),
	('_10065', 'Kelompok Perkiraan', 'Form', 'coa_group', 'Kelompok Perkiraan', '_10000', 1, 2, b'10000000', NULL),
	('_10066', 'View Arsip Saldo Perkiraan', 'Form', 'gl_arsip', 'View Arsip Saldo Perkiraan', '_10000', 1, 6, b'10000000', NULL),
	('_10067', 'Setting Autonumber Jurnal Entry', 'Form', '_10067', 'Setting Autonumber Jurnal Entry', '_10000', 1, NULL, NULL, NULL),
	('_10068', 'Setting Hotkey Jurnal Entry', 'Form', '_10068', 'Setting Hotkey Jurnal Entry', '_10000', 1, NULL, NULL, NULL),
	('_10069', 'Neraca Design Report', 'Form', '_10069', 'Neraca Design Report', '_10000', 1, NULL, NULL, NULL),
	('_10070', 'Rugi Laba Design Report', 'Form', '_10070', 'Rugi Laba Design Report', '_10000', 1, NULL, NULL, NULL),
	('_11000', '_11000', 'Form', '_11000', 'Manufacture dan pabrikasi module', '_00000', 0, 0, b'10000000', ''),
	('_12000', 'Payroll and HRD', 'Form', '_12000', 'Payroll and Human Resource Development', '0', 0, 0, b'10000000', ''),
	('_13000', '_13000', 'Form', '_13000', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_30000', 'Penjualan', 'Form', '_30000', 'Modul Penjualan, A/R, Pelanggan dan Pembayaran.', '0', 1, 1, b'10000000', NULL),
	('_30000.0', 'Point Of Sales - MyPOS', 'Form', '_30000', 'Point Of Sales - MyPOS', '_30000', 0, NULL, b'10000000', NULL),
	('_30000.001', 'Buat nota baru', 'Form', '_30000.001', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.002', 'Void atau pembatalan nota', 'Form', '_30000.002', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.003', 'Input discount nota', 'Form', '_30000.003', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.004', 'Input PPN nota', 'Form', '_30000.004', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.005', 'Input service charge', 'Form', '_30000.005', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.006', 'Laporan penjualan harian kasir', 'Form', '_30000.006', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.007', 'Input penerimaan barang ', 'Form', '_30000.007', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.008', 'Lihat daftar penerimaan barang', 'Form', '_30000.008', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.009', 'Input pengeluran barang ', 'Form', '_30000.009', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.010', 'Lihat daftar penerimaan barang', 'Form', '_30000.010', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.011', 'Cetak label / barcode barang  ', 'Form', '_30000.011', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.012', 'Buka cash drawer  ', 'Form', '_30000.012', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.013', 'Input master barang dan kelompok  ', 'Form', '_30000.013', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.014', 'Input master pelanggan', 'Form', '_30000.014', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.015', 'Input master waiter ', 'Form', '_30000.015', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.016', 'Input master table / meja / room  ', 'Form', '_30000.016', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.017', 'Input master salesman ', 'Form', '_30000.017', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.018', 'Input price manager ', 'Form', '_30000.018', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.019', 'Input barang promosi  ', 'Form', '_30000.019', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.020', 'Backup database', 'Form', '_30000.020', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.021', 'Seting nota dan perangkat keras', 'Form', '_30000.021', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.022', 'Seting pemakai dan user level ', 'Form', '_30000.022', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.023', 'Hapus semua data transaksi penjualan  ', 'Form', '_30000.023', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.024', 'Hapus semua data master barang', 'Form', '_30000.024', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.025', 'Export / Import data barang ', 'Form', '_30000.025', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.026', 'Reset nomor nota  ', 'Form', '_30000.026', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.027', 'Seting nomor nota ', 'Form', '_30000.027', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.028', 'Input kas awal, pengambilan kas ', 'Form', '_30000.028', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.029', 'Laporan: penjualan per nota ', 'Form', '_30000.029', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.030', 'Laporan: penjualan per kasir  ', 'Form', '_30000.030', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.031', 'Laporan: penjualan per item ', 'Form', '_30000.031', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.032', 'Laporan: penjualan per kategory ', 'Form', '_30000.032', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.033', 'Laporan: penjualan per waiter ', 'Form', '_30000.033', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.034', 'Laporan: penjualan per customer ', 'Form', '_30000.034', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.035', 'Laporan: Daftar nota  ', 'Form', '_30000.035', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.036', 'Laporan: Daftar pembayaran', 'Form', '_30000.036', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.037', 'Laporan: Kartu stock  ', 'Form', '_30000.037', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.038', 'Laporan: Item Paling laku ', 'Form', '_30000.038', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.039', 'Laporan: Item paling tidak laku ', 'Form', '_30000.039', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.040', 'Laporan: Rugi / laba penjualan', 'Form', '_30000.040', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.041', 'Laporan: Daftar barang', 'Form', '_30000.041', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.050', 'Penyesuaian Stock (Adjustment)', 'Form', '_30000.050', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.051', 'Proses Produksi Jadi (Assembly)', 'Form', '_30000.051', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.052', 'Laporan Proses Produksi Jadi (Assembly)', 'Form', '_30000.052', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.053', 'Laporan Penyesuaian Stock (Adjustment)', 'Form', '_30000.053', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.054', 'Daftar piutang customer', 'Form', '_30000.054', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.055', 'Formulir Stock Opname', 'Form', '_30000.055', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.056', 'Proses retur barang', 'Form', '_30000.056', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.057', 'Proses import master barang file MDB', 'Form', '_30000.057', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.058', 'Laporan penjualan item minus', 'Form', '_30000.058', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.059', 'Laporan kartu stock', 'Form', '_30000.059', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.060', 'Input discount bertingkat', 'Form', '_30000.060', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.061', 'Input ppn percent', 'Form', '_30000.061', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.062', 'Input discount percent nota', 'Form', '_30000.062', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.063', 'Daftar user level/job', 'Form', '_30000.063', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.064', 'Export master barang to excel', 'Form', '_30000.064', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.065', 'Import master barang dari excel', 'Form', '_30000.065', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.066', 'Daftar Kategori Barang', 'Form', '_30000.066', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.067', 'Laporan Penjualan per Customer, Item', 'Form', '_30000.067', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.068', 'Laporan Penjualan per Nota, Pembayaran', 'Form', '_30000.068', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30000.100', 'Proses Pelunasan ONACCOUNT', 'Form', '_30000.100', '.', '_30000.0', 0, NULL, NULL, NULL),
	('_30010', 'Master Data Customer', 'Form', 'customer/browse', '.', '_30000', 1, 1, b'10000000', 'customer'),
	('_30011', 'Create', 'Form', '_30011', '.', '_30010', 1, NULL, NULL, NULL),
	('_30012', 'Edit', 'Form', '_30012', '.', '_30010', 1, NULL, NULL, NULL),
	('_30013', 'Delete', 'Form', '_30013', '.', '_30010', 1, NULL, NULL, NULL),
	('_30020', 'Master Salesman', 'Form', 'salesman', '.', '_30000', 1, 2, b'10000000', 'salesman'),
	('_30030', 'Setting Saldo Awal Piutang Customer', 'Form', 'customer/saldo_awal', '.', '_30000', 1, 3, b'10000000', NULL),
	('_30031', 'Proses', 'Form', '_30031', '.', '_30030', 1, NULL, NULL, NULL),
	('_30033', 'Delete', 'Form', '_30033', '.', '_30030', 1, NULL, NULL, NULL),
	('_30040', 'Arsip Bulanan Piutang Customer', 'Form', 'customer/proses_bulanan', '.', '_30000', 1, 4, b'10000000', NULL),
	('_30041', 'Proses', 'Form', '_30041', '.', '_30040', 1, NULL, NULL, NULL),
	('_30042', 'Delete', 'Form', '_30042', '.', '_30040', 1, NULL, NULL, NULL),
	('_30050', 'Pembuatan SO', 'Form', 'sales_order', '.', '_30000', 1, 5, b'10000000', NULL),
	('_30051', 'Create', 'Form', '_30051', '.', '_30050', 1, NULL, NULL, NULL),
	('_30052', 'Edit', 'Form', '_30052', '.', '_30050', 1, NULL, NULL, NULL),
	('_30053', 'Delete', 'Form', '_30053', '.', '_30050', 1, NULL, NULL, NULL),
	('_30054', 'Buat Invoice', 'Form', '_30054', '.', '_30050', 1, NULL, NULL, NULL),
	('_30055', 'Buat Do', 'Form', '_30055', 'Buat Do', '_30000', 1, NULL, b'10000000', NULL),
	('_30060', 'Pembuatan DO', 'Form', 'delivery_order', '.', '_30000', 1, 6, b'10000000', NULL),
	('_30061', 'Create', 'Form', '_30061', '.', '_30060', 1, NULL, NULL, NULL),
	('_30062', 'Edit', 'Form', '_30062', '.', '_30060', 1, NULL, NULL, NULL),
	('_30063', 'Delete', 'Form', '_30063', '.', '_30060', 1, NULL, NULL, NULL),
	('_30064', 'Print', 'Form', '_30064', '.', '_30060', 1, NULL, NULL, NULL),
	('_30070', 'Pembuatan Invoice Kontan', 'Form', 'invoice/kontan', '.', '_30000', 1, 8, b'10000000', NULL),
	('_30071', 'Create', 'Form', '_30071', '.', '_30070', 1, NULL, NULL, NULL),
	('_30072', 'Edit', 'Form', '_30072', '.', '_30070', 1, NULL, NULL, NULL),
	('_30073', 'Delete', 'Form', '_30073', '.', '_30070', 1, NULL, NULL, NULL),
	('_30074', 'Print', 'Form', '_30074', '.', '_30070', 1, NULL, NULL, NULL),
	('_30075', 'Posting', 'Form', '_30075', 'Posting', '_30070', 1, NULL, NULL, NULL),
	('_30080', 'Pembuatan Invoice dari DO', 'Form', 'invoice/do', '.', '_30000', 1, 7, b'10000000', NULL),
	('_30081', 'Save', 'Form', '_30081', '.', '_30080', 1, NULL, NULL, NULL),
	('_30090', 'Pembuatan Retur Penjualan', 'Form', 'invoice/retur', '.', '_30000', 1, 11, b'10000000', NULL),
	('_300900', '_300900', 'Form', '_300900', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_300901', '_300901', 'Form', '_300901', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_30091', 'Create', 'Form', '_30091', '.', '_30090', 1, NULL, NULL, NULL),
	('_30092', 'Edit', 'Form', '_30092', '.', '_30090', 1, NULL, NULL, NULL),
	('_30093', 'Delete', 'Form', '_30093', '.', '_30090', 1, NULL, NULL, NULL),
	('_30094', 'Print', 'Form', '_30094', '.', '_30090', 1, NULL, NULL, NULL),
	('_30095', 'Posting', 'Form', '_30095', '.', '_30090', 1, NULL, NULL, NULL),
	('_30100', 'Batch Posting', 'Form', 'so_batch_posting', '.', '_30000', 1, 14, b'10000000', NULL),
	('_30110', 'Pelunasan Piutang', 'Form', 'payments', '.', '_30000', 1, 10, b'10000000', NULL),
	('_30112', 'Proses', 'Form', '_30112', '.', '_30110', 1, NULL, NULL, NULL),
	('_30120', 'Kredit Nota', 'Form', 'so_credit_memo', '.', '_30000', 1, 12, b'10000000', NULL),
	('_30121', 'Create', 'Form', '_30121', '.', '_30100', 1, NULL, NULL, NULL),
	('_30122', 'Edit', 'Form', '_30122', '.', '_30120', 1, NULL, NULL, NULL),
	('_30123', 'Delete', 'Form', '_30123', '.', '_30120', 1, NULL, NULL, NULL),
	('_30124', 'Print', 'Form', '_30124', '.', '_30120', 1, NULL, NULL, NULL),
	('_30125', 'Posting', 'Form', '_30125', '.', '_30120', 1, NULL, NULL, NULL),
	('_30130', 'Debit Nota', 'Form', 'so_debit_memo', '.', '_30000', 1, 13, b'10000000', NULL),
	('_30131', 'Create', 'Form', '_30131', '.', '_30100', 1, NULL, NULL, NULL),
	('_30132', 'Edit', 'Form', '_30132', '.', '_30130', 1, NULL, NULL, NULL),
	('_30133', 'Delete', 'Form', '_30133', '.', '_30130', 1, NULL, NULL, NULL),
	('_30134', 'Print', 'Form', '_30134', '.', '_30130', 1, NULL, NULL, NULL),
	('_30135', 'Posting', 'Form', '_30135', '.', '_30130', 1, NULL, NULL, NULL),
	('_30140', 'Daftar Pelunasan Giro', 'Form', 'payments/giro', '.', '_30000', 1, 15, b'10000000', NULL),
	('_30141', 'Cairkan', 'Form', '_30141', '.', '_30100', 1, NULL, NULL, NULL),
	('_30142', 'Tolak', 'Form', '_30142', '.', '_30140', 1, NULL, NULL, NULL),
	('_30143', 'Hapus', 'Form', '_30143', '.', '_30140', 1, NULL, NULL, NULL),
	('_30150', 'Daftar Pelunasan Cash', 'Form', 'payments/cash', '.', '_30000', 1, 16, b'10000000', NULL),
	('_30151', 'Delete', 'Form', '_30151', '.', '_30150', 1, NULL, NULL, NULL),
	('_30160', 'Pembuatan Invoice Kredit', 'Form', 'invoice', '.', '_30000', 1, 8, b'10000000', NULL),
	('_30161', 'Create', 'Form', '_30161', '.', '_30160', 1, NULL, NULL, NULL),
	('_30162', 'Edit', 'Form', '_30162', '.', '_30160', 1, NULL, NULL, NULL),
	('_30163', 'Delete', 'Form', '_30163', '.', '_30160', 1, NULL, NULL, NULL),
	('_30164', 'Print', 'Form', '_30164', '.', '_30160', 1, NULL, NULL, NULL),
	('_30165', 'Posting', 'Form', '_30165', 'Posting', '_30160', 1, NULL, NULL, NULL),
	('_30170', '_30170', 'Form', '_30170', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_40000', 'Pembelian', 'Form', '_40000', 'Modul Hutang, A/P, Hutang, Pembayaran, Supplier dan Pembayaran.', '0', 1, 2, b'10000000', NULL),
	('_40010', 'Master Data Supplier', 'Form', 'supplier/browse', '.', '_40000', 1, 1, b'10000000', NULL),
	('_40011', 'Create', 'Form', '_40011', '.', '_40010', 1, NULL, NULL, NULL),
	('_40012', 'Edit', 'Form', '_40012', '.', '_40010', 1, NULL, NULL, NULL),
	('_40013', 'Delete', 'Form', '_40013', '.', '_40010', 1, NULL, NULL, NULL),
	('_40020', 'Setting Saldo Awal Hutang Supplier', 'Form', 'supplier/saldo_awal', '.', '_40000', 1, 2, b'10000000', NULL),
	('_40021', 'Proses', 'Form', '_40021', '.', '_40020', 1, NULL, NULL, NULL),
	('_40023', 'Delete', 'Form', '_40023', '.', '_40020', 1, NULL, NULL, NULL),
	('_40030', 'Arsip Bulanan Hutang Supplier', 'Form', 'supplier/proses_bulanan', '.', '_40000', 1, 13, b'10000000', NULL),
	('_40031', 'Proses', 'Form', '_40031', '.', '_40030', 1, NULL, NULL, NULL),
	('_40033', 'Delete', 'Form', '_40033', '.', '_40030', 1, NULL, NULL, NULL),
	('_40040', 'Pembuatan PO', 'Form', 'purchase_order', '.', '_40000', 1, 3, b'10000000', NULL),
	('_40041', 'Create', 'Form', '_40041', '.', '_40040', 1, NULL, NULL, NULL),
	('_40042', 'Edit', 'Form', '_40042', '.', '_40040', 1, NULL, NULL, NULL),
	('_40043', 'Delete', 'Form', '_40043', '.', '_40040', 1, NULL, NULL, NULL),
	('_40044', 'Print', 'Form', '_40044', '.', '_40040', 1, NULL, NULL, NULL),
	('_40045', 'Close PO Manual', 'Form', '_40045', 'Close PO Manual', '_40040', 1, NULL, NULL, NULL),
	('_40046', 'Buat Faktur', 'Form', '_40046', 'Buat Faktur', '_40040', 1, NULL, NULL, NULL),
	('_40047', 'Create Duplikat PO', 'Form', '_40047', 'Create Duplikat PO', '_40040', 1, NULL, NULL, NULL),
	('_40048', 'Daftar Penerimaan PO', 'Form', '_40048', 'Daftar Penerimaan PO', '_40040', 1, NULL, NULL, NULL),
	('_40049', 'Buat Faktur dari daftar penerimaan', 'Form', '_40049', 'Buat Faktur Dari daftar penerimaan', '_40040', 1, NULL, NULL, NULL),
	('_40050', 'Faktur Pembelian Kontan', 'Form', 'beli/kontan', '.', '_40000', 1, 5, b'10000000', NULL),
	('_40051', 'Create', 'Form', '_40051', '.', '_40050', 1, NULL, NULL, NULL),
	('_40052', 'Edit', 'Form', '_40052', '.', '_40050', 1, NULL, NULL, NULL),
	('_40053', 'Delete', 'Form', '_40053', '.', '_40050', 1, NULL, NULL, NULL),
	('_40054', 'Print', 'Form', '_40054', '.', '_40050', 1, NULL, NULL, NULL),
	('_40055', 'Posting', 'Form', '_40055', '.', '_40050', 1, NULL, NULL, NULL),
	('_40060', 'Pembuatan Retur Pembelian', 'Form', 'po_retur', '.', '_40000', 1, 7, b'10000000', NULL),
	('_40061', 'Create', 'Form', '_40061', '.', '_40060', 1, NULL, NULL, NULL),
	('_40062', 'Edit', 'Form', '_40062', '.', '_40060', 1, NULL, NULL, NULL),
	('_40063', 'Delete', 'Form', '_40063', '.', '_40060', 1, NULL, NULL, NULL),
	('_40064', 'Print', 'Form', '_40064', '.', '_40060', 1, NULL, NULL, NULL),
	('_40065', 'Posting', 'Form', '_40065', '.', '_40060', 1, NULL, NULL, NULL),
	('_40070', 'Pembayaran Hutang', 'Form', 'payables_payments', '.', '_40000', 1, 6, b'10000000', NULL),
	('_40071', 'Proses', 'Form', '_40071', '.', '_40070', 1, NULL, NULL, NULL),
	('_40080', 'Hutang Manager', 'Form', 'payables', '.', '_40000', 1, 8, b'10000000', NULL),
	('_40081', 'Create', 'Form', '_40081', '.', '_40080', 1, NULL, NULL, NULL),
	('_40082', 'Edit', 'Form', '_40082', '.', '_40080', 1, NULL, NULL, NULL),
	('_40083', 'Delete', 'Form', '_40083', '.', '_40080', 1, NULL, NULL, NULL),
	('_40084', 'Bayar Hutang', 'Form', '_40084', '.', '_40080', 1, NULL, NULL, NULL),
	('_40085', 'Posting', 'Form', '_40085', '.', '_40080', 1, NULL, NULL, NULL),
	('_40090', 'Kredit Memo', 'Form', 'po_credit_memo', '.', '_40000', 1, 9, b'10000000', NULL),
	('_40091', 'Create', 'Form', '_40091', '.', '_40090', 1, NULL, NULL, NULL),
	('_40092', 'Edit', 'Form', '_40092', '.', '_40090', 1, NULL, NULL, NULL),
	('_40093', 'Delete', 'Form', '_40093', '.', '_40090', 1, NULL, NULL, NULL),
	('_40094', 'Print', 'Form', '_40094', '.', '_40090', 1, NULL, NULL, NULL),
	('_40095', 'Posting', 'Form', '_40095', 'Posting', '_40090', 1, NULL, NULL, NULL),
	('_40100', 'Debit Memo', 'Form', 'po_debit_memo', '.', '_40000', 1, 10, b'10000000', NULL),
	('_40101', 'Create', 'Form', '_40101', '.', '_40100', 1, NULL, NULL, NULL),
	('_40102', 'Edit', 'Form', '_40102', '.', '_40100', 1, NULL, NULL, NULL),
	('_40103', 'Delete', 'Form', '_40103', '.', '_40100', 1, NULL, NULL, NULL),
	('_40104', 'Print', 'Form', '_40104', '.', '_40100', 1, NULL, NULL, NULL),
	('_40105', 'Posting', 'Form', '_40105', 'Posting', '_40100', 1, NULL, NULL, NULL),
	('_40110', 'Daftar Pembayaran Giro', 'Form', 'payables_payments/giro', '.', '_40000', 1, 11, b'10000000', NULL),
	('_40113', 'Cair', 'Form', '_40113', '.', '_40110', 1, NULL, NULL, NULL),
	('_40114', 'Tolak', 'Form', '_40114', '.', '_40110', 1, NULL, NULL, NULL),
	('_40115', 'Delete', 'Form', '_40115', '.', '_40110', 1, NULL, NULL, NULL),
	('_40120', 'Daftar Pembayaran Cash', 'Form', 'payables_payments/cash', '.', '_40000', 1, 12, b'10000000', NULL),
	('_40123', 'Delete', 'Form', '_40123', '.', '_40120', 1, NULL, NULL, NULL),
	('_40130', 'Faktur Pembelian Kredit', 'Form', 'beli', '.', '_40000', 1, 4, b'10000000', NULL),
	('_40131', 'Create', 'Form', '_40131', '.', '_40050', 1, NULL, NULL, NULL),
	('_40132', 'Edit', 'Form', '_40132', '.', '_40050', 1, NULL, NULL, NULL),
	('_40134', 'Delete', 'Form', '_40134', '.', '_40050', 1, NULL, NULL, NULL),
	('_40135', 'Print', 'Form', '_40135', '.', '_40050', 1, NULL, NULL, NULL),
	('_40136', 'Posting', 'Form', '_40136', '.', '_40050', 1, NULL, NULL, NULL),
	('_60000', 'Cash & Bank', 'Form', '_60000', 'Modul untuk pencatatan semua aktifitas kas atau bank.', '0', 1, 3, b'10000000', NULL),
	('_60010', 'Pembuatan Account Bank', 'Form', 'bank', '.', '_60000', 1, 1, b'10000000', NULL),
	('_60011', 'Create', 'Form', '_60011', '.', '_60010', 1, NULL, NULL, NULL),
	('_60012', 'Edit', 'Form', '_60012', '.', '_60010', 1, NULL, NULL, NULL),
	('_60013', 'Delete', 'Form', '_60013', '.', '_60010', 1, NULL, NULL, NULL),
	('_60020', 'Cash Masuk', 'Form', 'bank_cash/in', '.', '_60000', 1, 2, b'10000000', NULL),
	('_60021', 'Create', 'Form', '_60021', '.', '_60020', 1, NULL, NULL, NULL),
	('_60022', 'Edit', 'Form', '_60022', '.', '_60020', 1, NULL, NULL, NULL),
	('_60023', 'Delete', 'Form', '_60023', '.', '_60020', 1, NULL, NULL, NULL),
	('_60024', 'Print', 'Form', '_60024', '.', '_60020', 1, NULL, NULL, NULL),
	('_60025', 'Posting', 'Form', '_60025', '.', '_60020', 1, NULL, NULL, NULL),
	('_60030', 'Cash Keluar', 'Form', 'bank_cash/out', '.', '_60000', 1, 3, b'10000000', NULL),
	('_60031', 'Create', 'Form', '_60031', '.', '_60030', 1, NULL, NULL, NULL),
	('_60032', 'Edit', 'Form', '_60032', '.', '_60030', 1, NULL, NULL, NULL),
	('_60033', 'Delete', 'Form', '_60033', '.', '_60030', 1, NULL, NULL, NULL),
	('_60034', 'Print', 'Form', '_60034', '.', '_60030', 1, NULL, NULL, NULL),
	('_60035', 'Posting', 'Form', '_60035', '.', '_60030', 1, NULL, NULL, NULL),
	('_60040', 'Giro Masuk', 'Form', 'bank_giro/in', '.', '_60000', 1, 4, b'10000000', NULL),
	('_60041', 'Create', 'Form', '_60041', '.', '_60040', 1, NULL, NULL, NULL),
	('_60042', 'Edit', 'Form', '_60042', '.', '_60040', 1, NULL, NULL, NULL),
	('_60043', 'Delete', 'Form', '_60043', '.', '_60040', 1, NULL, NULL, NULL),
	('_60044', 'Print', 'Form', '_60044', '.', '_60040', 1, NULL, NULL, NULL),
	('_60045', 'Posting', 'Form', '_60045', '.', '_60040', 1, NULL, NULL, NULL),
	('_60050', 'Giro Keluar', 'Form', 'bank_giro/out', '.', '_60000', 1, 5, b'10000000', NULL),
	('_60051', 'Create', 'Form', '_60051', '.', '_60050', 1, NULL, NULL, NULL),
	('_60052', 'Edit', 'Form', '_60052', '.', '_60050', 1, NULL, NULL, NULL),
	('_60053', 'Delete', 'Form', '_60053', '.', '_60050', 1, NULL, NULL, NULL),
	('_60054', 'Print', 'Form', '_60054', '.', '_60050', 1, NULL, NULL, NULL),
	('_60055', 'Posting', 'Form', '_60055', '.', '_60050', 1, NULL, NULL, NULL),
	('_60060', 'Transfer Masuk', 'Form', 'bank_transfer/in', '.', '_60000', 1, 6, b'10000000', NULL),
	('_60061', 'Create', 'Form', '_60061', '.', '_60060', 1, NULL, NULL, NULL),
	('_60062', 'Edit', 'Form', '_60062', '.', '_60060', 1, NULL, NULL, NULL),
	('_60063', 'Delete', 'Form', '_60063', '.', '_60060', 1, NULL, NULL, NULL),
	('_60064', 'Print', 'Form', '_60064', '.', '_60060', 1, NULL, NULL, NULL),
	('_60065', 'Posting', 'Form', '_60065', '.', '_60060', 1, NULL, NULL, NULL),
	('_60070', 'Transfer Keluar', 'Form', 'bank_transfer/out', '.', '_60000', 1, 7, b'10000000', NULL),
	('_60071', 'Create', 'Form', '_60071', '.', '_60070', 1, NULL, NULL, NULL),
	('_60072', 'Edit', 'Form', '_60072', '.', '_60070', 1, NULL, NULL, NULL),
	('_60073', 'Delete', 'Form', '_60073', '.', '_60070', 1, NULL, NULL, NULL),
	('_60074', 'Print', 'Form', '_60074', '.', '_60070', 1, NULL, NULL, NULL),
	('_60075', 'Posting', 'Form', '_60075', '.', '_60070', 1, NULL, NULL, NULL),
	('_60080', 'Adjusment', 'Form', 'bank_adjust', '.', '_60000', 1, 8, b'10000000', NULL),
	('_60081', 'Create', 'Form', '_60081', '.', '_60080', 1, NULL, NULL, NULL),
	('_60082', 'Edit', 'Form', '_60082', '.', '_60080', 1, NULL, NULL, NULL),
	('_60083', 'Delete', 'Form', '_60083', '.', '_60080', 1, NULL, NULL, NULL),
	('_60085', 'Posting', 'Form', '_60085', '.', '_60080', 1, NULL, NULL, NULL),
	('_80000', 'Inventory', 'Form', '_80000', 'Modul Pengelolaan dan transaksi barang dagangan.', '0', 1, 4, b'10000000', NULL),
	('_80010', 'Master Data Stock', 'Form', 'inventory', '.', '_80000', 1, 1, b'10000000', NULL),
	('_80010.01', '_80010.01', 'Form', '_80010.01', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.02', '_80010.02', 'Form', '_80010.02', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.03', '_80010.03', 'Form', '_80010.03', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.04', '_80010.04', 'Form', '_80010.04', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.05', '_80010.05', 'Form', '_80010.05', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.06', '_80010.06', 'Form', '_80010.06', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80010.07', '_80010.07', 'Form', '_80010.07', 'Please entry this', '_00000', 0, NULL, NULL, NULL),
	('_80011', 'Create', 'Form', '_80011', '.', '_80010', 1, NULL, NULL, NULL),
	('_80012', 'Edit', 'Form', '_80012', '.', '_80010', 1, NULL, NULL, NULL),
	('_80013', 'Delete', 'Form', '_80013', '.', '_80010', 1, NULL, NULL, NULL),
	('_80014', 'Serial Number', 'Form', '_80014', '.', '_80010', 1, NULL, NULL, NULL),
	('_80015', 'Ubah Kode', 'Form', '_80015', 'Ubah kode barang atau jasa', '_80010', 0, NULL, NULL, NULL),
	('_80020', 'Master Kategory', 'Form', 'category', '.', '_80000', 1, 2, b'10000000', NULL),
	('_80021', 'Create', 'Form', '_80021', '.', '_80020', 0, NULL, NULL, NULL),
	('_80022', 'Edit', 'Form', '_80022', '.', '_80020', 0, NULL, NULL, NULL),
	('_80023', 'Delete', 'Form', '_80023', '.', '_80020', 0, NULL, NULL, NULL),
	('_80024', 'Print', 'Form', '_80024', '.', '_80020', 0, NULL, NULL, NULL),
	('_80030', 'Master Gudang', 'Form', 'gudang', '.', '_80000', 1, 3, b'10000000', NULL),
	('_80031', 'Create', 'Form', '_80031', '.', '_80030', 0, NULL, NULL, NULL),
	('_80032', 'Edit', 'Form', '_80032', '.', '_80030', 0, NULL, NULL, NULL),
	('_80033', 'Delete', 'Form', '_80033', '.', '_80030', 0, NULL, NULL, NULL),
	('_80034', 'Print', 'Form', '_80034', '.', '_80030', 0, NULL, NULL, NULL),
	('_80040', 'Transfer Stock', 'Form', 'transfer', '.', '_80000', 1, 4, b'10000000', NULL),
	('_80041', 'Create', 'Form', '_80041', '.', '_80040', 0, NULL, NULL, NULL),
	('_80042', 'Edit', 'Form', '_80042', '.', '_80040', 0, NULL, NULL, NULL),
	('_80043', 'Delete', 'Form', '_80043', '.', '_80040', 0, NULL, NULL, NULL),
	('_80044', 'Print', 'Form', '_80044', '.', '_80040', 0, NULL, NULL, NULL),
	('_80050', 'Penerimaan dari PO', 'Form', 'receive', '.', '_80000', 1, 6, b'10000000', NULL),
	('_80051', 'Create', NULL, '_80051', NULL, '_80050', 0, NULL, NULL, NULL),
	('_80052', 'Edit', NULL, '_80052', NULL, '_80050', 0, NULL, NULL, NULL),
	('_80053', 'Delete', NULL, '_80053', NULL, '_80050', 0, NULL, NULL, NULL),
	('_80054', 'Print', NULL, '_80054', NULL, '_80050', 0, NULL, NULL, NULL),
	('_80060', 'Penerimaan Lain-lain', NULL, 'stock_recv_etc', NULL, '_80000', 1, 7, b'10000000', NULL),
	('_80061', 'Create', NULL, '_80061', NULL, '_80060', 0, NULL, NULL, NULL),
	('_80062', 'Edit', NULL, '_80062', NULL, '_80060', 0, NULL, NULL, NULL),
	('_80063', 'Delete', NULL, '_80063', NULL, '_80060', 0, NULL, NULL, NULL),
	('_80064', 'Print', 'Form', '_80064', '.', '_80060', 1, NULL, NULL, NULL),
	('_80070', 'Pengeluaran Lain-Lain', NULL, 'stock_send_etc', NULL, '_80000', 1, 8, b'10000000', NULL),
	('_80071', 'Create', NULL, '_80071', NULL, '_80070', 0, NULL, NULL, NULL),
	('_80072', 'Edit', NULL, '_80072', NULL, '_80070', 0, NULL, NULL, NULL),
	('_80073', 'Delete', NULL, '_80073', NULL, '_80070', 0, NULL, NULL, NULL),
	('_80074', 'Print', NULL, '_80074', NULL, '_80070', 0, NULL, NULL, NULL),
	('_80080', 'Pengeluaran ke WIP', NULL, '_80080', NULL, '_80000', 1, NULL, b'10000000', NULL),
	('_80081', 'Create', NULL, '_80081', NULL, '_80080', 1, NULL, NULL, NULL),
	('_80082', 'Edit', NULL, '_80082', NULL, '_80080', 1, NULL, NULL, NULL),
	('_80083', 'Delete', NULL, '_80083', NULL, '_80080', 1, NULL, NULL, NULL),
	('_80084', 'Print', NULL, '_80084', NULL, '_80080', 1, NULL, NULL, NULL),
	('_80090', 'Penerimaan dari WIP', NULL, '_80090', NULL, '_80000', 1, NULL, b'10000000', NULL),
	('_80091', 'Create', NULL, '_80091', NULL, '_80090', 1, NULL, NULL, NULL),
	('_80092', 'Edit', NULL, '_80092', NULL, '_80090', 1, NULL, NULL, NULL),
	('_80093', 'Delete', NULL, '_80093', NULL, '_80090', 1, NULL, NULL, NULL),
	('_80094', 'Print', NULL, '_80094', NULL, '_80090', 1, NULL, NULL, NULL),
	('_80100', 'Proses Assembly', NULL, 'assembly', NULL, '_80000', 1, 9, b'10000000', NULL),
	('_80101', 'Proses', NULL, '_80101', NULL, '_80100', 1, NULL, NULL, NULL),
	('_80110', 'Proses DisAssembly', NULL, 'disassembly', NULL, '_80000', 1, 10, b'10000000', NULL),
	('_80111', 'Proses', NULL, '_80111', NULL, '_80110', 1, NULL, NULL, NULL),
	('_80120', 'Adjusment Stock', NULL, 'stock_adjust', NULL, '_80000', 1, 5, b'10000000', NULL),
	('_80121', 'Proses', NULL, '_80121', NULL, '_80120', 1, NULL, NULL, NULL),
	('_80130', 'Arsip Bulanan Stock', NULL, 'stock_proses_bulanan', NULL, '_80000', 1, 11, b'10000000', NULL),
	('_80131', 'Proses', NULL, '_80131', NULL, '_80130', 1, NULL, NULL, NULL),
	('_80132', 'Delete', NULL, '_80132', NULL, '_80130', 1, NULL, NULL, NULL),
	('_80140', 'Setting Saldo Awal', NULL, 'stock_saldo_awal', NULL, '_80000', 1, 12, b'10000000', NULL),
	('_80141', 'Proses', NULL, '_80141', NULL, '_80140', 1, NULL, NULL, NULL),
	('_80200', 'Penerimaan barang non PO', NULL, '_80200', NULL, '_80000', 1, NULL, b'10000000', NULL),
	('_80201', 'Save', NULL, '_80201', NULL, '_80200', 1, NULL, NULL, NULL),
	('_80202', 'Print', NULL, '_80202', NULL, '_80200', 1, NULL, NULL, NULL),
	('_90000', 'Laporan', NULL, '_90000', 'Modul Daftar Laporan', '0', 1, 8, b'10000000', NULL),
	('_90010', 'General Ledger', 'Group', 'laporan/gl', 'Laporan General Ledger', '_90000', 1, 3, b'10000000', NULL),
	('_90011', '001. Daftar Perkiraan / Chart Of Accounts', 'Report', '\\Gl\\chartofaccount1.rpt', 'Daftar Perkiraan', '_90010', 1, NULL, NULL, NULL),
	('_90012', '002. Jurnal Transaksi - Sort by Kode Jurnal', NULL, '\\gl\\gltransactions1.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90013', '003. Jurnal Transaksi - Sort by Tanggal', NULL, '\\gl\\gltransactions2.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90014', '004. Kartu General Ledger', NULL, '\\Gl\\glCards.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90015', '005. Kartu General Ledger - All Date', NULL, '\\Gl\\glCards2.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90016', '006. Kartu General Ledger - All Date, Account', NULL, '\\Gl\\glCards3.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90017', '007. Neraca Percobaan', NULL, '\\gl\\trialbalances.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90018', '008. Laporan Rugi Laba', NULL, '\\gl\\incomestatement1.rpt', NULL, '_90010', 1, NULL, NULL, NULL),
	('_90040', 'Inventory', NULL, 'laporan/stock', 'Laporan Inventory', '_90000', 1, 4, b'10000000', NULL),
	('_90041', '001. Daftar Stock Item Number', NULL, '\\Inv\\InvListing.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90042', '002. Daftar Stock per Gudang', NULL, '\\Inv\\PosisiStockGudang.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90043', '003. Daftar Stock - With Financial', NULL, '\\Inv\\DaftarBarang12.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90044', '004. Daftar Stock - With to Order', NULL, '\\Inv\\DaftarBarang11.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90045', '005. Formulir Stock Opname', NULL, '\\Inv\\FStockOpname.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90046', '006. Price List', NULL, '\\Inv\\PriceList.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90047', '007. Kartu Stock', NULL, '\\Inv\\KartuStock.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90048', '008. Kartu Stock Summary', NULL, '\\Inv\\KartuStockSum.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90049', '009. Penerimaan Barang - Detail by No PO', NULL, '\\PO\\TerimaByPO.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90050', '010. Penerimaan Barang - Detail by No Bukti', NULL, '\\PO\\TerimaByRecvId.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90051', '011. Penerimaan Barang - Detail by Item', NULL, '\\PO\\TerimaByItem.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90052', '012. Penerimaan Barang dari WIP', NULL, '\\PO\\TerimaFG.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90053', '013. Pengeluaran Barang ke WIP', NULL, '\\Po\\KeluarWO.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90054', '014. Retur Barang Penjualan', NULL, '\\inv\\TerimaReturPenjualan.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90055', '015. Retur Barang Pembelian ', NULL, '\\Po\\ReturBarangPembelian.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90056', '016. Transfer Stok Antar Gudang ', NULL, '\\inv\\Transfer001.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90057', '017. Laporan Assembly & Disassembly', NULL, '\\Inv\\AsmItem18.Rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90058', '018. Daftar Transaksi Stock - per Gudang', NULL, '\\Inv\\TransaksiInventory.rpt', NULL, '_90040', 1, NULL, NULL, NULL),
	('_90070', 'Pembelian', NULL, 'laporan/pembelian', 'Laporan Pembelian', '_90000', 1, 2, b'10000000', NULL),
	('_90071', '001. Pembelian - Summary', NULL, '\\Po\\OrderPembelianSummary.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90072', '002. Pembelian  Per Supplier - Summary ', NULL, '\\Po\\OrderPembelianDetail.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90073', '003. Pembelian  Per Supplier  - Detail ', NULL, '\\Po\\BeliSuppSum.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90074', '004. Pembelian  Per Item Summary', NULL, '\\Po\\OrderPembelianSupplierDetail.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90075', '005. Pembelian  Per Item - Detail ', NULL, '\\Po\\PembelianItemSummary.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90076', '006. Pembelian  Per Katagori - Summary', NULL, '\\Po\\OrderPembelianItemDetail.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90077', '007. Pembelian  Per Kategori - Detail ', NULL, '\\Po\\OrderPembelianItemKategoriSum.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90078', '009. Pembelian per Mata Uang', NULL, '\\Po\\OrderPembelianItemKategoriDetail.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90079', '010. Laporan Pajak Masukan', NULL, '\\po\\BeliCurrency.Rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90080', '011. Daftar PO', NULL, '\\Po\\PajakMasukan.Rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90081', '012. Daftar PO - Detail', NULL, '\\PO\\DaftarPO.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90082', '013. Faktur Pembelian - Detail', NULL, '\\PO\\PODetailMonthly.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90083', '014. History Harga Per Supplier', NULL, '\\po\\PembelianDetail.Rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90084', '015. Selisih Kurs Pembelian', NULL, '\\Po\\HistoryHargaPerSupplier.rpt', NULL, '_90070', 1, NULL, NULL, NULL),
	('_90090', 'Penjualan', NULL, 'laporan/penjualan', 'Laporan Penjualan', '_90000', 1, 1, b'10000000', NULL),
	('_90091', '001. Penjualan - Summary ', NULL, '\\So\\AnalisaPenjualanPerJenisFakturPerbulan.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90092', '002. Penjualan By Customer - Summary ', NULL, '\\So\\PenjualanCustomerSum.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90093', '003. Penjualan by Customer - Detail ', NULL, '\\So\\SumJualByCust.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90094', '004. Penjualan per Item - Summary', NULL, '\\So\\FakturPenjualanSummaryTrading.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90095', '005. Penjualan per Item - Detail', NULL, '\\So\\PenjualanPeritemDetailTrading.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90096', '006. Penjualan per kategori Item - Summary', NULL, '\\So\\AnalisaPenjualanPerkategoriSummary.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90097', '007. Penjualan Per Kategori - Detail', NULL, '\\So\\AnalisaPenjualanPerkategori.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90098', '008. Penjualan per Salesman - Summary', NULL, '\\So\\FakturPenjualanMonthSales.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90099', '009. Penjualan per Salesman - Detail', NULL, '\\So\\FakturPenjualanSummarySales.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90100', '010. Penjualan per wilayah - Summary', NULL, '\\So\\AnalisaPenjualanPerWilayahPerbulan.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90101', '011. Penjualan per Mata Uang', NULL, '\\so\\JualCurrency.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90102', '012. Faktur Penjualan - Detail', NULL, '\\So\\FakturPenjualan.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90103', '013. Retur Penjualan', NULL, '\\So\\ReturPenjualan.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90104', '014. Komisi Salesman', NULL, '\\So\\KomisiSalesman.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90105', '015. Laporan Pajak Keluaran', NULL, '\\So\\PajakKeluaran.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90106', '017. Daftar DO Customer', NULL, '\\SO\\DODetail300.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90107', '018. Daftar DO - Detail', NULL, '\\SO\\DODetail200.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90108', '019. History Harga Per Customer', NULL, '\\So\\HistoryHargaPerCustomer.rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90109', '020. Selisih Kurs Penjualan', NULL, '\\so\\SelisihKursPiutang1.Rpt', NULL, '_90090', 1, NULL, NULL, NULL),
	('_90120', 'Supplier / Hutang', NULL, 'laporan/supplier', 'Laporan Supplier atau Hutang', '_90000', 1, 5, b'10000000', NULL),
	('_90121', '001. Daftar Supplier Urut Kode', NULL, '\\po\\DaftarSupplier2.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90122', '002. History Pembayaran Hutang Supplier', NULL, '\\po\\SuppPayHistory01.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90123', '003. Daftar Pembayaran Hutang', NULL, '\\po\\SuppPayHistory.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90124', '004. Kartu Hutang Supplier Summary', NULL, '\\po\\KartuHutangSum.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90125', '005. Kartu Hutang Supplier Detail', NULL, '\\Po\\KartuHutang.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90126', '006. Laporan Umur Hutang - Summary', NULL, '\\Po\\UmurHutang.Rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90127', '007. Laporan Umur Hutang Supplier - Summary', NULL, '\\Po\\UmurHutang_Supplier.Rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90128', '008. Laporan Umur Hutang Supplier - Detail', NULL, '\\Po\\UmurHutang_SupplierDetail.Rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90129', '009. Daftar Pembayaran Hutang - Currency', NULL, '\\PO\\BayarHutang0011.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90130', '010. Daftar Pembayaran Hutang per Supplier - Currency', NULL, '\\PO\\BayarHutang0012.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90131', '011. Daftar Hutang - Currency', NULL, '\\po\\DaftarHutang009.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90132', '012. Daftar Hutang per Supplier - Currency', NULL, '\\po\\DaftarHutang010.rpt', NULL, '_90120', 1, NULL, NULL, NULL),
	('_90150', 'Customer / Piutang', NULL, 'laporan/customer', 'Laporan Customer atau Piutang', '_90000', 1, 6, b'10000000', NULL),
	('_90151', '001. Daftar Customer urut Kode', NULL, '\\so\\daftarcustomerkode.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90152', '002. History Pembayaran Piutang Customer', NULL, '\\So\\CustPayHistory01.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90153', '003. Daftar Pembayaran Piutang', NULL, '\\So\\CustPayHistory.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90154', '004. Kartu Piutang Customer - Summary', NULL, '\\so\\KartuPiutangSum.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90155', '005. Kartu Piutang Customer - Detail', NULL, '\\so\\KartuPiutang.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90156', '006. Laporan Umur Piutang - Summary', NULL, '\\So\\UmurPiutang.Rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90157', '007. Laporan Umur Piutang Pelanggan - Summary', NULL, '\\So\\UmurPiutang_Customer.Rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90158', '008. Laporan Umur Piutang Pelanggan - Detail', NULL, '\\So\\UmurPiutang_CustomerDetail.Rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90159', '009. Daftar Pembayaran Piutang - Currency', NULL, '\\SO\\BayarPiutang0010.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90160', '010. Daftar Pembayaran Piutang per Customer - Currency', NULL, '\\SO\\BayarPiutang0011.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90161', '011. Daftar Piutang - Currency', NULL, '\\so\\DaftarPiutang0011.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_90162', '012. Daftar Piutang per Customer - Currency', NULL, '\\so\\DaftarPiutang0012.rpt', NULL, '_90150', 1, NULL, NULL, NULL),
	('_60084', 'Mutasi Antar Rekening', 'Form', 'bank_mutasi', NULL, '_60000', NULL, 9, b'10000000', NULL),
	('_18000', 'Leasing', 'Form', '_18000', 'Leasing elektronik, kendaraan atau lainnya', '0', 0, 0, b'10000000', ''),
	('_18000.001', 'Data Pelanggan', 'Form', '_18000.001', 'Data Pelanggan', '_18000', 0, 0, b'10000000', ''),
	('_18000.002', 'Object Kredit', 'Form', '_18000.002', 'Data Master Object Kredit', '_18000', 0, 2, b'10000000', ''),
	('_18000.003', 'Aplikasi Kredit', 'Form', '_18000.003', 'Formulir Aplikasi Kredit', '_18000', 0, 3, b'10000000', ''),
	('_18000.004', 'Phone Verification', 'Form', '_18000.004', 'Proses Verifikasi Applikasi Kredit', '_18000', 0, 4, b'10000000', ''),
	('_18000.005', 'Scoring', 'Form', '_18000.005', 'Proses Scoring Aplikasi Kredit', '_18000', 0, 6, b'10000000', ''),
	('_18000.006', 'Survey', 'Form', '_18000.006', 'Proses Survey Aplikasi Kredit', '_18000', 0, 7, b'10000000', ''),
	('_18000.007', 'Proses Risk', 'Form', '_18000.007', 'Proses Risk', '_18000', 0, 8, b'10000000', ''),
	('_18000.008', 'Formulir Kredit', 'Form', '_18000.008', 'Formulir Kredit', '_18000', 0, 9, b'10000000', ''),
	('_18000.009', 'Billing', 'Form', '_18000.008\\9', 'Billing', '_18000', 0, 9, b'10000000', ''),
	('_18000.010', 'Bayar Cicilan', 'Form', '_18000.010', 'Bayar Cicilan', '_18000', 0, 10, b'10000000', ''),
	('_18000.011', 'Kolektor', 'Form', '_18000.011', 'Kolektor', '_18000', 0, 11, b'10000000', ''),
	('_18000.012', 'Penutupan', 'Form', '_18000.012', 'Penutupan', '_18000', 0, 12, b'10000000', ''),
	('_18000.013', 'Counter', 'Form', '_18000.013', 'Data Master Counter dan Cabang', '_18000', 0, 13, b'10000000', ''),
	('_18000.100', 'Setting', 'Form', '_18000.100', 'Pengaturan Modul Leasing', '_18000', 0, 100, b'10000000', ''),
	('_18000.014', 'Approval', 'Form', '_18000.014', 'Approval Pengajuan Kredit', '_18000', 0, 14, b'10000000', ''),
	('_18000.015', 'Recomend To Survey', 'Form', '_18000.015', 'Recomend To Survey', '_18000', 0, 15, b'10000000', ''),
	('_18000.020', 'Export Absensi', 'Form', '_18000.020', 'Export Data Absensi', '_18000', 0, 20, b'10000000', ''),
	('_20000', 'Website', 'Form', '_20000', 'Website utama untuk perusahaan', '_00000', 0, 21, b'10000000', ''),
	('_21000', 'Travel Agent', 'Form', '_21000', 'Modul Travel Agent', '0', 0, 1, b'10000000', ''),
	('_21010', 'Maskapai', 'Form', '_21010', 'Data master maskapai penerbangan', '_21000', 0, 1, b'10000000', ''),
	('_18000.900', 'Clear Data Transaksi', 'Form', '_18000.900', 'Clear Data Transaksi', '_18000', 0, 12, b'10000000', ''),
	('_18000.901', 'Clear Data Master', 'Form', '_18000.901', 'Clear Data Master', '_18000', 0, 12, b'10000000', ''),
	('_11001', 'Work Order', 'Form', '_11001', 'Work order', '_11000', 0, 0, b'10000000', ''),
	('_12001', 'Employee Master', 'Form', '_12001', 'Employee Master', '_12000', 0, 0, b'10000000', ''),
	('_18000.021', 'Jadwal Kontrak Untuk SA', 'Form', '_18000.021', 'Jadwal Kontrak Untuk SA', '_18000', 0, 3, b'10000000', ''),
	('_18000.022', 'Jadwal Kontrak Untuk Admin', 'Form', '_18000.022', 'Jadwal Kontrak Untuk Admin', '_18000', 0, 3, b'10000000', ''),
	('_14001', 'Daftar Aktiva', 'Form', '_14001', 'Daftar Aktiva Tetap', '_14000', 0, 1, b'00000000', ''),
	('_14000', 'Aktiva Tetap', 'Form', '_14000', 'Aktiva Tetap', '0', 0, 1, b'00000000', '');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;


-- Dumping structure for table simak.modules_groups
CREATE TABLE IF NOT EXISTS `modules_groups` (
  `user_group_id` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `user_group_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `path_image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`user_group_id`),
  UNIQUE KEY `x1` (`user_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.modules_groups: 15 rows
/*!40000 ALTER TABLE `modules_groups` DISABLE KEYS */;
REPLACE INTO `modules_groups` (`user_group_id`, `user_group_name`, `creation_date`, `description`, `path_image`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	('Administrator', 'Administrator', '2015-11-06 00:00:00', 'Administrator', '', 0, '', ''),
	('ANDRI', 'Khusus job untuk andri', '2014-11-10 00:00:00', 'Khusus Job untuk andri', '', 0, '', ''),
	('BYR', 'Buyer', '2013-08-31 00:00:00', 'Buyer', '', 0, '', ''),
	('FIN', 'Financial', '2015-11-28 00:00:00', 'Kelompok finansial bertugas untuk mencatat data keuangan', '', 0, '', ''),
	('Gudang', 'Gudang', '2015-11-14 00:00:00', 'Bagian gudang', '', 0, '', ''),
	('INV', 'Inventory', '2015-01-09 00:00:00', '', '', 0, '', ''),
	('KSR', 'Kasir', '2003-11-14 20:41:59', NULL, NULL, 1, NULL, NULL),
	('PUR', 'Purchasing', '2014-12-31 00:00:00', '', '', 0, '', ''),
	('SLS', 'Sales', '2015-11-04 00:00:00', '', '', 0, '', ''),
	('SPV', 'Supervisor', '2015-11-04 00:00:00', '', '', 0, '', ''),
	('SYSMENU', 'SYSMENU', '2006-09-23 20:59:05', 'aaaa', 'a1.ico', 1, NULL, NULL),
	('ADM', 'Admin', '2015-11-14 00:00:00', 'Admin', '', 0, '', ''),
	('GL', 'Akuntansi', '2014-12-27 00:00:00', 'Perkiraan, closing, jurnal, neraca dan rugilaba', '', 0, '', ''),
	('admin', 'admin', '2015-11-04 00:00:00', 'admin', '', 0, '', ''),
	('SLSADM', 'Sales Admin', '2015-11-14 00:00:00', 'Sales Admin', '', 0, '', '');
/*!40000 ALTER TABLE `modules_groups` ENABLE KEYS */;


-- Dumping structure for table simak.org_struct
CREATE TABLE IF NOT EXISTS `org_struct` (
  `org_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `org_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact_person` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `org_parent` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `source_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `is_head_office` int DEFAULT NULL,
  PRIMARY KEY (`org_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.org_struct: 0 rows
/*!40000 ALTER TABLE `org_struct` DISABLE KEYS */;
/*!40000 ALTER TABLE `org_struct` ENABLE KEYS */;


-- Dumping structure for table simak.other_vendors
CREATE TABLE IF NOT EXISTS `other_vendors` (
  `vendor_id` int(11) DEFAULT NULL,
  `vendor_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_vendor` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salutation` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `middle_initial` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `zip_postal_code` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `payment_terms` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `credit_limit` double DEFAULT NULL,
  `fed_tax_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `credit_balance` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.other_vendors: 0 rows
/*!40000 ALTER TABLE `other_vendors` DISABLE KEYS */;
/*!40000 ALTER TABLE `other_vendors` ENABLE KEYS */;


-- Dumping structure for table simak.overtime_detail
CREATE TABLE IF NOT EXISTS `overtime_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `time_in` varchar(50) DEFAULT NULL,
  `time_out` varchar(50) DEFAULT NULL,
  `time_total` varchar(50) DEFAULT NULL,
  `supervisor` varchar(50) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `istirahat` double DEFAULT NULL,
  `ttc_1x` double DEFAULT NULL,
  `ttc_2x` double DEFAULT NULL,
  `ttc_3x` double DEFAULT NULL,
  `ttc_4x` double DEFAULT NULL,
  `time_total_calc` double DEFAULT NULL,
  `meal` tinyint(1) DEFAULT '0',
  `others` tinyint(1) DEFAULT '0',
  `amount` double DEFAULT NULL,
  `tcid` varchar(50) DEFAULT NULL,
  `salary_no` varchar(50) DEFAULT NULL,
  `hari_libur` tinyint(1) DEFAULT '0',
  `work_status` varchar(50) DEFAULT NULL,
  `add_to_slip` tinyint(1) DEFAULT '1',
  `time_total_run` double DEFAULT NULL,
  `periode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.overtime_detail: 9 rows
/*!40000 ALTER TABLE `overtime_detail` DISABLE KEYS */;
REPLACE INTO `overtime_detail` (`id`, `tanggal`, `nip`, `time_in`, `time_out`, `time_total`, `supervisor`, `keterangan`, `org_id`, `jenis`, `istirahat`, `ttc_1x`, `ttc_2x`, `ttc_3x`, `ttc_4x`, `time_total_calc`, `meal`, `others`, `amount`, `tcid`, `salary_no`, `hari_libur`, `work_status`, `add_to_slip`, `time_total_run`, `periode`) VALUES
	(13, '2014-05-29 17:31:09', '122', '08:00', '17:25', '09:25:00', 'andri', NULL, NULL, NULL, NULL, 1.5, 18, 0, 0, 19.5, 0, 0, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL),
	(11, '2014-05-29 17:31:09', '33', '08:00', '12:00', '04:00:00', 'andri doang', NULL, NULL, NULL, NULL, 1.5, 8, 0, 0, 9.5, 0, 0, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL),
	(5, '2014-05-29 17:14:52', '342', '08:00', '15:00', '07:00:00', 'andri doang', NULL, NULL, NULL, NULL, 0, 12, 3, 0, 15, 0, 0, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL),
	(6, '2014-05-29 16:48:03', '122', '08:00', '15:00', '07:00:00', 'andri', NULL, NULL, NULL, NULL, 0, 12, 3, 0, 15, 0, 0, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL),
	(10, '2014-05-29 17:31:09', '512', '08:00', '15:00', '07:00:00', '', NULL, NULL, NULL, NULL, 1.5, 14, 0, 0, 15.5, 0, 0, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL),
	(8, '2014-05-29 17:24:35', '342', '08:00', '12:00', '04:00:00', 'andri', NULL, NULL, NULL, NULL, 1.5, 8, 0, 0, 9.5, 0, 0, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL),
	(9, '2014-05-29 16:59:13', '121', '08:00', '13:00', '05:00:00', 'udin', NULL, NULL, NULL, NULL, 0, 10, 0, 0, 10, 0, 0, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL),
	(14, '2014-05-29 22:44:28', '121', '08:00', '17:00', '09:00:00', '', NULL, NULL, NULL, NULL, 0, 12, 9, 0, 21, 0, 0, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL),
	(15, '2014-06-04 17:30:30', '342', '17:00', '20:20', '03:20:00', '', NULL, NULL, NULL, NULL, 1.5, 6, 0, 0, 7.5, 0, 0, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL);
/*!40000 ALTER TABLE `overtime_detail` ENABLE KEYS */;


-- Dumping structure for table simak.payables
CREATE TABLE IF NOT EXISTS `payables` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_type` int(11) DEFAULT NULL,
  `supplier_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `other_number` int(11) DEFAULT NULL,
  `purchase_order` tinyint(1) DEFAULT NULL,
  `purchase_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `expense_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `invoice_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `terms` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `discount_taken` double DEFAULT NULL,
  `purpose_of_expense` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tax_deductible` tinyint(1) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `posted` tinyint(1) DEFAULT NULL,
  `posting_gl_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `batch_post` tinyint(1) DEFAULT NULL,
  `X1099` tinyint(1) DEFAULT NULL,
  `invoice_received` tinyint(1) DEFAULT NULL,
  `items_received` tinyint(1) DEFAULT NULL,
  `many_po` tinyint(1) DEFAULT NULL,
  `curr_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `curr_code_org` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate_org` double DEFAULT NULL,
  `curr_selisih` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `saldo_invoice` double DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payables: 3 rows
/*!40000 ALTER TABLE `payables` DISABLE KEYS */;
REPLACE INTO `payables` (`bill_id`, `vendor_type`, `supplier_number`, `other_number`, `purchase_order`, `purchase_order_number`, `expense_type`, `account_id`, `invoice_number`, `invoice_date`, `amount`, `due_date`, `terms`, `discount_taken`, `purpose_of_expense`, `tax_deductible`, `comments`, `paid`, `posted`, `posting_gl_id`, `batch_post`, `X1099`, `invoice_received`, `items_received`, `many_po`, `curr_code`, `curr_rate`, `curr_code_org`, `curr_rate_org`, `curr_selisih`, `org_id`, `update_status`, `sourceautonumber`, `sourcefile`, `update_date`, `saldo_invoice`) VALUES
	(1, NULL, 'ALFAMART', NULL, 1, 'PI00019', 'Purchase Order', NULL, 'PI00019', '2016-02-01 00:00:00', 2300000, '2016-02-27 00:00:00', '60 Hari', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, NULL, 'AM', NULL, 1, 'PI00020', 'Purchase Order', NULL, 'PI00020', '2016-02-02 00:00:00', 500000, '2016-02-27 00:00:00', 'Kredit 30 Hari', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, NULL, 'JKT.KI', NULL, 1, 'PI00021', 'Purchase Order', NULL, 'PI00021', '2016-01-01 00:00:00', 1500000, '2016-02-27 00:00:00', 'KREDIT', NULL, 'Purchase Order', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `payables` ENABLE KEYS */;


-- Dumping structure for table simak.payables_items
CREATE TABLE IF NOT EXISTS `payables_items` (
  `bill_id` int(11) DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payables_items: 0 rows
/*!40000 ALTER TABLE `payables_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `payables_items` ENABLE KEYS */;


-- Dumping structure for table simak.payables_many_po
CREATE TABLE IF NOT EXISTS `payables_many_po` (
  `bill_id` int(11) DEFAULT NULL,
  `purchase_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_amount` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payables_many_po: 0 rows
/*!40000 ALTER TABLE `payables_many_po` DISABLE KEYS */;
/*!40000 ALTER TABLE `payables_many_po` ENABLE KEYS */;


-- Dumping structure for table simak.payables_payments
CREATE TABLE IF NOT EXISTS `payables_payments` (
  `bill_id` int(11) DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `date_paid` datetime DEFAULT NULL,
  `how_paid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `how_paid_account_id` int(11) DEFAULT NULL,
  `check_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `amount_paid` double DEFAULT NULL,
  `amount_alloc` double DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `curr_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `curr_code_org` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate_org` double DEFAULT NULL,
  `curr_selisih` double DEFAULT NULL,
  `purchase_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `no_bukti` varchar(50) DEFAULT NULL,
  `paid_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payables_payments: 0 rows
/*!40000 ALTER TABLE `payables_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payables_payments` ENABLE KEYS */;


-- Dumping structure for table simak.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `date_paid` datetime DEFAULT NULL,
  `how_paid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `how_paid_acct_id` int(11) DEFAULT NULL,
  `credit_card_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `expiration_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `authorization` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `amount_paid` double DEFAULT NULL,
  `amount_alloc` double DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `check_type` int(11) DEFAULT NULL,
  `curr_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate` double DEFAULT NULL,
  `curr_rate_exc` double DEFAULT NULL,
  `curr_code_org` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `curr_rate_org` double DEFAULT NULL,
  `curr_selisih` double DEFAULT NULL,
  `no_bukti` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `receipt_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `credit_card_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `jenisuangmuka` int(11) DEFAULT NULL,
  `angsur_no_dari` int(11) DEFAULT NULL,
  `angsur_no_sampai` int(11) DEFAULT NULL,
  `angsur_sisa` double DEFAULT NULL,
  `angsur_lunas` double DEFAULT NULL,
  `angsur_lunas_bunga` int(11) DEFAULT NULL,
  `from_bank` varchar(50) DEFAULT NULL,
  `from_account` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payments: 154 rows
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
REPLACE INTO `payments` (`invoice_number`, `line_number`, `date_paid`, `how_paid`, `how_paid_acct_id`, `credit_card_number`, `expiration_date`, `authorization`, `amount_paid`, `amount_alloc`, `comments`, `check_type`, `curr_code`, `curr_rate`, `curr_rate_exc`, `curr_code_org`, `curr_rate_org`, `curr_selisih`, `no_bukti`, `trans_id`, `org_id`, `update_status`, `receipt_by`, `credit_card_type`, `sourceautonumber`, `sourcefile`, `jenisuangmuka`, `angsur_no_dari`, `angsur_no_sampai`, `angsur_sisa`, `angsur_lunas`, `angsur_lunas_bunga`, `from_bank`, `from_account`, `account_number`) VALUES
	('K01-00279', 1, '2016-02-25 08:55:22', 'CASH', 1485, NULL, NULL, NULL, 26142000, 30000000, 0, NULL, NULL, 0, 0, NULL, 0, 0, 'K01-002790225', NULL, NULL, 0, 'kasir', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL),
	('PJL00170', 154, '2016-03-12 17:00:10', 'CASH', NULL, NULL, NULL, NULL, 1116600, 883400, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;


-- Dumping structure for table simak.payroll_link
CREATE TABLE IF NOT EXISTS `payroll_link` (
  `last_check_file` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `last_gl_file` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `last_bank_account` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_source` int(11) DEFAULT NULL,
  `last_selchecks` int DEFAULT NULL,
  `last_selgl` int DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.payroll_link: 0 rows
/*!40000 ALTER TABLE `payroll_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `payroll_link` ENABLE KEYS */;


-- Dumping structure for table simak.pending_stock_opname
CREATE TABLE IF NOT EXISTS `pending_stock_opname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `trans` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipment` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `artikel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `size1` int(11) DEFAULT NULL,
  `size2` int(11) DEFAULT NULL,
  `size3` int(11) DEFAULT NULL,
  `size4` int(11) DEFAULT NULL,
  `size5` int(11) DEFAULT NULL,
  `size6` int(11) DEFAULT NULL,
  `size7` int(11) DEFAULT NULL,
  `size8` int(11) DEFAULT NULL,
  `size9` int(11) DEFAULT NULL,
  `size10` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `current_price` int(11) DEFAULT NULL,
  `current_total` int(11) DEFAULT NULL,
  `process_count` int(11) DEFAULT NULL,
  `qty_stock` int(11) DEFAULT NULL,
  `qty_adjust` int(11) DEFAULT NULL,
  `color` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.pending_stock_opname: 0 rows
/*!40000 ALTER TABLE `pending_stock_opname` DISABLE KEYS */;
/*!40000 ALTER TABLE `pending_stock_opname` ENABLE KEYS */;


-- Dumping structure for table simak.pending_stock_opname_tmp
CREATE TABLE IF NOT EXISTS `pending_stock_opname_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `trans` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.pending_stock_opname_tmp: 0 rows
/*!40000 ALTER TABLE `pending_stock_opname_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `pending_stock_opname_tmp` ENABLE KEYS */;


-- Dumping structure for table simak.preferences
CREATE TABLE IF NOT EXISTS `preferences` (
  `company_code` varchar(15) CHARACTER SET utf8 NOT NULL,
  `company_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `slogan` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `purchase_order_contact` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `city_state_zip_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fed_tax_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `perpetual_inventory` tinyint(1) DEFAULT NULL,
  `out_of_stock_checking` tinyint(1) DEFAULT NULL,
  `purchase_order_restocking` tinyint(1) DEFAULT NULL,
  `item_categories` tinyint(1) DEFAULT NULL,
  `supplier_numbering` double DEFAULT NULL,
  `default_invoice_type` double DEFAULT NULL,
  `default_bank_account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `default_credit_card_account` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_numbering` double DEFAULT NULL,
  `use_sales_order_number` tinyint(1) DEFAULT NULL,
  `customer_credit_account_number` int(11) DEFAULT NULL,
  `supplier_credit_account_number` int(11) DEFAULT NULL,
  `po_numbering` double DEFAULT NULL,
  `invoice_message_copy__1` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__2` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__3` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__4` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_message_copy__5` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__1` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__2` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__3` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__4` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `po_message_copy__5` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__1` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__2` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__3` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `bol_message_copy__4` varchar(75) CHARACTER SET utf8 DEFAULT NULL,
  `inventory_tracking` double DEFAULT NULL,
  `inventory_costing` double DEFAULT NULL,
  `customer_order` double DEFAULT NULL,
  `customer_numbering` double DEFAULT NULL,
  `general_ledger` tinyint(1) DEFAULT NULL,
  `freight_taxable` tinyint(1) DEFAULT NULL,
  `other_taxable` tinyint(1) DEFAULT NULL,
  `accounts_receivable` int(11) DEFAULT NULL,
  `so_freight` int(11) DEFAULT NULL,
  `so_other` int(11) DEFAULT NULL,
  `so_tax` int(11) DEFAULT NULL,
  `so_tax_2` int(11) DEFAULT NULL,
  `so_discounts_given` int(11) DEFAULT NULL,
  `accounts_payable` int(11) DEFAULT NULL,
  `po_freight` int(11) DEFAULT NULL,
  `po_other` int(11) DEFAULT NULL,
  `po_tax` int(11) DEFAULT NULL,
  `po_tax_2` int(11) DEFAULT NULL,
  `po_discounts_taken` int(11) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `inventory_sales` int(11) DEFAULT NULL,
  `inventory_cogs` int(11) DEFAULT NULL,
  `maximize_on_640` tinyint(1) DEFAULT NULL,
  `invoice_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `po_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quote_number` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `sales_order_number` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `gl_post_date` int(11) DEFAULT NULL,
  `security` tinyint(1) DEFAULT NULL,
  `sales_selection` int(11) DEFAULT NULL,
  `printed_check_password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `unpost_password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `undeposited_checks` tinyint(1) DEFAULT NULL,
  `autostub` tinyint(1) DEFAULT NULL,
  `startup_company_schedule` tinyint(1) DEFAULT NULL,
  `po_show_items` double DEFAULT NULL,
  `acctproglocation` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `payrollproglocation` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `payrolldatalocation` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `custbalupdated` datetime DEFAULT NULL,
  `display_shiptos` double DEFAULT NULL,
  `version` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `inventorysearch` int(11) DEFAULT NULL,
  `barcodeinventorystandard` tinyint(1) DEFAULT NULL,
  `barcodeinventorywarehouse` tinyint(1) DEFAULT NULL,
  `barcodepo` tinyint(1) DEFAULT NULL,
  `barcodesales` tinyint(1) DEFAULT NULL,
  `invpridec` int(11) DEFAULT NULL,
  `invqtydec` int(11) DEFAULT NULL,
  `payrollsystem` double DEFAULT NULL,
  `poitemdisplay` int(11) DEFAULT NULL,
  `salesitemdisplay` int(11) DEFAULT NULL,
  `salpridec` int(11) DEFAULT NULL,
  `salqtydec` int(11) DEFAULT NULL,
  `state_tax_id` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `gl_post_date_2` int(11) DEFAULT NULL,
  `earning_account` int(11) DEFAULT NULL,
  `year_earning_account` int(11) DEFAULT NULL,
  `historical_balance_account` int(11) DEFAULT NULL,
  `default_cash_payment_account` int(11) DEFAULT NULL,
  `invamtdec` int(11) DEFAULT NULL,
  `salamtdec` int(11) DEFAULT NULL,
  `purpridec` int(11) DEFAULT NULL,
  `purqtydec` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `file_logo` varchar(200) DEFAULT NULL,
  `handphone` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`company_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.preferences: 1 rows
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
REPLACE INTO `preferences` (`company_code`, `company_name`, `slogan`, `invoice_contact`, `purchase_order_contact`, `street`, `suite`, `city_state_zip_code`, `phone_number`, `fax_number`, `email`, `fed_tax_id`, `perpetual_inventory`, `out_of_stock_checking`, `purchase_order_restocking`, `item_categories`, `supplier_numbering`, `default_invoice_type`, `default_bank_account_number`, `default_credit_card_account`, `invoice_numbering`, `use_sales_order_number`, `customer_credit_account_number`, `supplier_credit_account_number`, `po_numbering`, `invoice_message_copy__1`, `invoice_message_copy__2`, `invoice_message_copy__3`, `invoice_message_copy__4`, `invoice_message_copy__5`, `po_message_copy__1`, `po_message_copy__2`, `po_message_copy__3`, `po_message_copy__4`, `po_message_copy__5`, `bol_message_copy__1`, `bol_message_copy__2`, `bol_message_copy__3`, `bol_message_copy__4`, `inventory_tracking`, `inventory_costing`, `customer_order`, `customer_numbering`, `general_ledger`, `freight_taxable`, `other_taxable`, `accounts_receivable`, `so_freight`, `so_other`, `so_tax`, `so_tax_2`, `so_discounts_given`, `accounts_payable`, `po_freight`, `po_other`, `po_tax`, `po_tax_2`, `po_discounts_taken`, `inventory`, `inventory_sales`, `inventory_cogs`, `maximize_on_640`, `invoice_number`, `po_number`, `quote_number`, `sales_order_number`, `gl_post_date`, `security`, `sales_selection`, `printed_check_password`, `unpost_password`, `undeposited_checks`, `autostub`, `startup_company_schedule`, `po_show_items`, `acctproglocation`, `payrollproglocation`, `payrolldatalocation`, `custbalupdated`, `display_shiptos`, `version`, `inventorysearch`, `barcodeinventorystandard`, `barcodeinventorywarehouse`, `barcodepo`, `barcodesales`, `invpridec`, `invqtydec`, `payrollsystem`, `poitemdisplay`, `salesitemdisplay`, `salpridec`, `salqtydec`, `state_tax_id`, `gl_post_date_2`, `earning_account`, `year_earning_account`, `historical_balance_account`, `default_cash_payment_account`, `invamtdec`, `salamtdec`, `purpridec`, `purqtydec`, `update_status`, `file_logo`, `handphone`, `country`) VALUES
	('C01', 'PT. Megatax Indotama', NULL, NULL, NULL, 'Apartement Pesona Bahari R1', NULL, 'Jakarta', '0216124706', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1485', '1490', NULL, NULL, 1416, 1421, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1373, 1417, 1482, 1458, NULL, 1416, 1393, 1417, 1482, 1458, NULL, 1421, 1374, 1415, 1419, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1483, 1408, 1411, 1370, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_disc
CREATE TABLE IF NOT EXISTS `promosi_disc` (
  `promosi_code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `tipe` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  `issameitem` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `outlet` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `disc_base` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `total_sales` double DEFAULT NULL,
  `method` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `flag1` int DEFAULT NULL,
  `flag2` int DEFAULT NULL,
  `flag3` int DEFAULT NULL,
  `flag4` int DEFAULT NULL,
  `flag5` int DEFAULT NULL,
  PRIMARY KEY (`promosi_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_disc: 14 rows
/*!40000 ALTER TABLE `promosi_disc` DISABLE KEYS */;
REPLACE INTO `promosi_disc` (`promosi_code`, `description`, `date_from`, `category`, `date_to`, `tipe`, `qty`, `nilai`, `issameitem`, `update_status`, `outlet`, `disc_base`, `total_sales`, `method`, `create_date`, `create_by`, `update_date`, `update_by`, `flag1`, `flag2`, `flag3`, `flag4`, `flag5`) VALUES
	('Extra Qty', 'Extra Qty Sample', '2013-07-04 00:00:00', 2, '2015-11-13 23:59:59', 0, 2, 1, 0, 1, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Extra Qty Pilih', 'Extra Qty Pilih', '2013-07-04 00:00:00', 2, '2016-02-20 23:59:59', 0, 2, 1, 1, 1, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('One Price', 'One Price', '2013-07-04 00:00:00', 4, '2013-07-05 23:59:59', 0, 0, 1000, 0, 1, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PR00001', 'Sample Discount Promo', '2013-10-19 00:00:00', 1, '2016-02-26 05:00:00', 2, 0, 5, 0, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PR00002', 'Sample Discount Promo', '2013-10-19 00:00:00', 0, '2013-10-20 05:00:00', 2, 0, 0.13, 0, 1, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PR00003', 'Promo Extra Test 21', '2013-10-20 00:00:00', 2, '2013-10-30 05:00:00', 0, 5, 1, -1, 1, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PR00004', 'Extra Qty Campuran', '2013-10-25 00:00:00', 2, '2013-11-30 05:00:00', 0, 60, 1, 0, 1, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PR9', 'Promo Target Penjualan', '2014-03-05 00:00:00', 9, '2014-03-06 05:00:00', 2, 0, 0, 0, 1, NULL, NULL, 10000000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PrDiscAmt', 'Promosi Discount Amount', '2014-06-06 00:00:00', 1, '2014-06-06 23:59:59', 1, 0, 1000, 0, 1, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PRDS2', 'PROMO POINT', '2013-10-19 00:00:00', 6, '2016-02-20 23:00:00', 1, 1, 0, 0, 1, NULL, NULL, 100000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('PRPOINT', 'Promo Point', '2013-10-27 00:00:00', 6, '2015-11-14 23:00:00', 1, 1, 0, 0, 1, NULL, NULL, 1000000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('R1', 'contoh reg', '2015-11-12 00:00:00', 1, '2015-11-13 23:59:59', 2, 0, 0.8, 0, 1, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Range Qty', 'Range Qty', '2013-07-04 00:00:00', 3, '2014-09-04 23:59:59', 2, 2, 10, 0, 1, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Reguler', 'Contoh Disc Reguler', '2013-07-04 00:00:00', 1, '2016-02-23 23:59:59', 2, 0, 0.1, 0, 0, '"', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `promosi_disc` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_extra_item
CREATE TABLE IF NOT EXISTS `promosi_extra_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promosi_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `table_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field3` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field4` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field5` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `x1` (`promosi_code`,`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_extra_item: 0 rows
/*!40000 ALTER TABLE `promosi_extra_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_extra_item` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_item
CREATE TABLE IF NOT EXISTS `promosi_item` (
  `promosi_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `table_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`promosi_code`,`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_item: 0 rows
/*!40000 ALTER TABLE `promosi_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_item` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_item_category
CREATE TABLE IF NOT EXISTS `promosi_item_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promosi_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kode_category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_item_category: 0 rows
/*!40000 ALTER TABLE `promosi_item_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_item_category` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_item_customer
CREATE TABLE IF NOT EXISTS `promosi_item_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promosi_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cust_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_item_customer: 0 rows
/*!40000 ALTER TABLE `promosi_item_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_item_customer` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_outlet
CREATE TABLE IF NOT EXISTS `promosi_outlet` (
  `outlet` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_outlet: 0 rows
/*!40000 ALTER TABLE `promosi_outlet` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_outlet` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_point_transactions
CREATE TABLE IF NOT EXISTS `promosi_point_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jenis_transaksi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `ref1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref3` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref4` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref5` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_point_transactions: 0 rows
/*!40000 ALTER TABLE `promosi_point_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_point_transactions` ENABLE KEYS */;


-- Dumping structure for table simak.promosi_time
CREATE TABLE IF NOT EXISTS `promosi_time` (
  `time_value` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.promosi_time: 0 rows
/*!40000 ALTER TABLE `promosi_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `promosi_time` ENABLE KEYS */;


-- Dumping structure for table simak.purchase_order
CREATE TABLE IF NOT EXISTS `purchase_order` (
  `purchase_order_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `po_date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `inv_date` datetime DEFAULT NULL,
  `ship_to_contact` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `bill_to_contact` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `ordered_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `terms` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fob` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `shipped_via` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ship_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `approved_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `freight` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `tax_2` double DEFAULT NULL,
  `other` double DEFAULT NULL,
  `received` tinyint(1) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `ship_customer_display` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bill_customer_display` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `posted` tinyint(1) DEFAULT NULL,
  `posting_gl_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `potype` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `po_ref` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `uang_muka` double DEFAULT NULL,
  `saldo_invoice` double DEFAULT NULL,
  `comments` varchar(250) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `disc_2` double DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `type_of_invoice` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `tax_amount` double DEFAULT NULL,
  `warehouse_code` varchar(50) DEFAULT NULL,
  `currency_code` varchar(50) DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `branch_code` varchar(50) DEFAULT NULL,
  `division_code` varchar(50) DEFAULT NULL,
  `dept_code` varchar(50) DEFAULT NULL,
  `doc_status` varchar(50) DEFAULT NULL,
  `project_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`purchase_order_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.purchase_order: 6 rows
/*!40000 ALTER TABLE `purchase_order` DISABLE KEYS */;
REPLACE INTO `purchase_order` (`purchase_order_number`, `supplier_number`, `po_date`, `due_date`, `inv_date`, `ship_to_contact`, `bill_to_contact`, `ordered_by`, `terms`, `fob`, `shipped_via`, `ship_date`, `approved_by`, `approved_date`, `freight`, `tax`, `tax_2`, `other`, `received`, `paid`, `ship_customer_display`, `bill_customer_display`, `posted`, `posting_gl_id`, `discount`, `potype`, `po_ref`, `uang_muka`, `saldo_invoice`, `comments`, `account_id`, `disc_amount_1`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `org_id`, `update_status`, `amount`, `type_of_invoice`, `update_date`, `tax_amount`, `warehouse_code`, `currency_code`, `currency_rate`, `subtotal`, `branch_code`, `division_code`, `dept_code`, `doc_status`, `project_code`) VALUES
	('PI00019', 'ALFAMART', '2016-02-01 00:00:00', '2016-02-27 00:00:00', NULL, NULL, NULL, NULL, '60 Hari', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'I', NULL, NULL, 2300000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2300000, NULL, NULL, 0, NULL, NULL, NULL, 2300000, NULL, NULL, NULL, NULL, NULL),
	('PI00020', 'AM', '2016-02-02 00:00:00', '2016-02-27 00:00:00', NULL, NULL, NULL, NULL, 'Kredit 30 Hari', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'I', NULL, NULL, 500000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 500000, NULL, NULL, 0, NULL, NULL, NULL, 500000, NULL, NULL, NULL, NULL, NULL),
	('PI00021', 'JKT.KI', '2016-01-01 00:00:00', '2016-02-27 00:00:00', NULL, NULL, NULL, NULL, 'KREDIT', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'I', NULL, NULL, 1500000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1500000, NULL, NULL, 0, NULL, NULL, NULL, 1500000, NULL, NULL, NULL, NULL, NULL),
	('POR-00003', NULL, '2016-03-12 17:15:49', '2016-03-12 00:00:00', NULL, NULL, NULL, 'ANDRI', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'Q', NULL, NULL, 250000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 250000, NULL, NULL, 0, NULL, NULL, NULL, 250000, 'KRW', NULL, '', 'OPEN', 'dfafasf'),
	('PO00278', 'ALFAMART', '2016-04-11 00:00:00', '2016-04-11 00:00:00', NULL, NULL, NULL, NULL, '60 Hari', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'O', NULL, NULL, 180000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 180000, NULL, NULL, 0, NULL, NULL, NULL, 180000, NULL, NULL, NULL, NULL, NULL),
	('PO00279', 'ALFAMART', '2016-04-11 00:00:00', '2016-04-11 00:00:00', NULL, NULL, NULL, NULL, 'KREDIT', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 'O', NULL, NULL, 90000, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90000, NULL, NULL, 0, NULL, NULL, NULL, 90000, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `purchase_order` ENABLE KEYS */;


-- Dumping structure for table simak.purchase_order_lineitems
CREATE TABLE IF NOT EXISTS `purchase_order_lineitems` (
  `purchase_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `stock_item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_expec` datetime DEFAULT NULL,
  `date_recvd` datetime DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` double DEFAULT NULL,
  `received` tinyint(1) DEFAULT NULL,
  `comment` double DEFAULT NULL,
  `serial_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `qty_recvd` double(11,2) DEFAULT NULL,
  `quantity` double(11,2) DEFAULT NULL,
  `discount` double(11,2) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `multi_unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mu_qty` double(11,0) DEFAULT NULL,
  `mu_harga` double DEFAULT NULL,
  `forex_price` double DEFAULT NULL,
  `base_curr_amount` double DEFAULT NULL,
  `inventory_account` int(11) DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `disc_2` double(11,2) DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double(11,2) DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `from_line_number` int(11) DEFAULT NULL,
  `from_line_type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `from_line_doc` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `retail` double DEFAULT NULL,
  `dept` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dept_sub` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `price_margin` int(11) DEFAULT NULL,
  `warehouse_code` varchar(50) DEFAULT NULL,
  `selected` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.purchase_order_lineitems: 8 rows
/*!40000 ALTER TABLE `purchase_order_lineitems` DISABLE KEYS */;
REPLACE INTO `purchase_order_lineitems` (`purchase_order_number`, `line_number`, `item_number`, `stock_item_number`, `date_expec`, `date_recvd`, `description`, `price`, `received`, `comment`, `serial_number`, `color`, `size`, `qty_recvd`, `quantity`, `discount`, `total_price`, `unit`, `currency_code`, `currency_rate`, `multi_unit`, `mu_qty`, `mu_harga`, `forex_price`, `base_curr_amount`, `inventory_account`, `disc_amount_1`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `update_status`, `from_line_number`, `from_line_type`, `from_line_doc`, `sourceautonumber`, `sourcefile`, `create_date`, `create_by`, `update_date`, `update_by`, `retail`, `dept`, `dept_sub`, `price_margin`, `warehouse_code`, `selected`) VALUES
	('PI00019', 1, 'R001', NULL, NULL, NULL, 'Bir Bintang', 50000, NULL, NULL, NULL, NULL, NULL, NULL, 10.00, 0.00, 500000, NULL, 'IDR', 1, '', 10, 50000, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
	('PI00019', 2, '10201', NULL, NULL, NULL, 'Celana Jeans Pria', 120000, NULL, NULL, NULL, NULL, NULL, NULL, 15.00, 0.00, 1800000, 'Pcs', 'IDR', 1, 'Pcs', 15, 120000, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
	('PI00020', 3, 'HD', NULL, NULL, NULL, 'Hardisk Seagete 200Gb', 500000, NULL, NULL, NULL, NULL, NULL, NULL, 1.00, 0.00, 500000, 'Pcs', 'IDR', 1, 'Pcs', 1, 500000, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
	('PI00021', 4, '100011', NULL, NULL, NULL, 'HN A VDROID S4C', 1500000, NULL, NULL, NULL, NULL, NULL, NULL, 1.00, 0.00, 1500000, 'PCS', 'IDR', 1, 'PCS', 1, 1500000, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
	('POR-00003', 5, '100', NULL, NULL, NULL, 'Baju Anak Koko', 50000, NULL, NULL, NULL, NULL, NULL, NULL, 5.00, 0.00, 250000, NULL, 'IDR', 1, '', 5, 50000, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
	('PO00278', 6, '100000043', NULL, NULL, NULL, 'VINILEX BASE 1,4 KG PASTEL', 90000, NULL, NULL, NULL, NULL, NULL, NULL, 2.00, 0.00, 180000, 'Pcs', 'IDR', 1, 'Pcs', 2, 90000, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
	('PO00279', 7, 'CALUBCO15', NULL, NULL, NULL, 'ALU BEAMY COMBO 15-16', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1.00, 0.00, 0, 'Lusin', 'IDR', 1, 'pcs', 12, 0, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
	('PO00279', 8, '100000117', NULL, NULL, NULL, 'ASTER PANEL KALIGRAFI II RED 9X20X25 (9PCS)', 90000, NULL, NULL, NULL, NULL, NULL, NULL, 1.00, 0.00, 90000, 'Pcs', 'IDR', 1, 'Pcs', 1, 90000, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL);
/*!40000 ALTER TABLE `purchase_order_lineitems` ENABLE KEYS */;


-- Dumping structure for table simak.qry_kartu_hutang
CREATE TABLE IF NOT EXISTS `qry_kartu_hutang` (
  `tanggal` datetime DEFAULT NULL,
  `no_bukti` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ref2` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `jenis` varchar(10) CHARACTER SET utf8 NOT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.qry_kartu_hutang: 0 rows
/*!40000 ALTER TABLE `qry_kartu_hutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `qry_kartu_hutang` ENABLE KEYS */;


-- Dumping structure for table simak.qry_kartu_piutang
CREATE TABLE IF NOT EXISTS `qry_kartu_piutang` (
  `jenis` varchar(1) DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `no_bukti` varchar(50) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `customer_number` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.qry_kartu_piutang: 0 rows
/*!40000 ALTER TABLE `qry_kartu_piutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `qry_kartu_piutang` ENABLE KEYS */;


-- Dumping structure for table simak.qry_loan_by_counter
CREATE TABLE IF NOT EXISTS `qry_loan_by_counter` (
  `area` varchar(50) DEFAULT NULL,
  `area_name` varchar(150) DEFAULT NULL,
  `counter_id` varchar(50) DEFAULT NULL,
  `counter_name` varchar(150) DEFAULT NULL,
  `tahun` int(4) DEFAULT NULL,
  `bulan` int(2) DEFAULT NULL,
  `z_loan` double DEFAULT NULL,
  `z_balance` double DEFAULT NULL,
  `z_payment` double DEFAULT NULL,
  `z_pokok` double DEFAULT NULL,
  `z_saldo_pokok_sum` double DEFAULT NULL,
  `z_noa` bigint(21) DEFAULT NULL,
  `z_lancar` decimal(45,0) DEFAULT NULL,
  `z_kurang` decimal(45,0) DEFAULT NULL,
  `z_macet` decimal(45,0) DEFAULT NULL,
  `z_lancar_amt` double DEFAULT NULL,
  `z_kurang_amt` double DEFAULT NULL,
  `z_macet_amt` double DEFAULT NULL,
  `z_price` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.qry_loan_by_counter: 0 rows
/*!40000 ALTER TABLE `qry_loan_by_counter` DISABLE KEYS */;
/*!40000 ALTER TABLE `qry_loan_by_counter` ENABLE KEYS */;


-- Dumping structure for table simak.qry_ls_cash_receive
CREATE TABLE IF NOT EXISTS `qry_ls_cash_receive` (
  `jenis` varchar(3) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `no_bukti` varchar(50) DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `amount_recv` double DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `cust_deal_id` varchar(50) DEFAULT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `posted` int(11) DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `area_name` varchar(150) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `counter_id` varchar(50) DEFAULT NULL,
  `counter_name` varchar(150) DEFAULT NULL,
  `pokok` float DEFAULT NULL,
  `pokok_paid` float DEFAULT NULL,
  `bunga_paid` float DEFAULT NULL,
  `bunga` float DEFAULT NULL,
  `dp_prc` float DEFAULT NULL,
  `z_dp_amount` double DEFAULT NULL,
  `z_admin_amount` double DEFAULT NULL,
  `denda_paid` float DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `saldo` float DEFAULT NULL,
  `saldo_titip` double DEFAULT NULL,
  `denda_tagih` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.qry_ls_cash_receive: 0 rows
/*!40000 ALTER TABLE `qry_ls_cash_receive` DISABLE KEYS */;
/*!40000 ALTER TABLE `qry_ls_cash_receive` ENABLE KEYS */;


-- Dumping structure for table simak.qry_payroll_component
CREATE TABLE IF NOT EXISTS `qry_payroll_component` (
  `jenis` varchar(6) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `sifat` varchar(50) DEFAULT NULL,
  `is_variable` smallint(6) DEFAULT NULL,
  `ref_column` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.qry_payroll_component: 0 rows
/*!40000 ALTER TABLE `qry_payroll_component` DISABLE KEYS */;
/*!40000 ALTER TABLE `qry_payroll_component` ENABLE KEYS */;


-- Dumping structure for table simak.quotation
CREATE TABLE IF NOT EXISTS `quotation` (
  `sales_order_number` varchar(22) CHARACTER SET utf8 NOT NULL,
  `invoice_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_invoice` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sold_to_customer` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `ship_to_customer` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `sales_date` datetime DEFAULT NULL,
  `your_order__` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `source_of_order` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_terms` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salesman` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `shipped_via` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `tax_2` double DEFAULT NULL,
  `other` double DEFAULT NULL,
  `freight` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `sales_tax_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent` double(11,0) DEFAULT NULL,
  `sales_tax2_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent_2` double(11,0) DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `disc_2` double(11,0) DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double(11,0) DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `create_invoice` int DEFAULT NULL,
  `delivered` int DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`sales_order_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.quotation: 0 rows
/*!40000 ALTER TABLE `quotation` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotation` ENABLE KEYS */;


-- Dumping structure for table simak.quotation_lineitems
CREATE TABLE IF NOT EXISTS `quotation_lineitems` (
  `sales_order_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` double(11,0) DEFAULT NULL,
  `unit` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `taxable` int DEFAULT NULL,
  `ship_date` datetime DEFAULT NULL,
  `ship_qty` double(11,0) DEFAULT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `job_reference` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `warehouse_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `forex_price` double DEFAULT NULL,
  `base_curr_amount` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `revenue_acct_id` int(11) DEFAULT NULL,
  `currency_code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `currency_rate` int(11) DEFAULT NULL,
  `multi_unit` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mu_qty` double(255,0) DEFAULT NULL,
  `mu_harga` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `disc_2` double(11,0) DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double(11,0) DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.quotation_lineitems: 0 rows
/*!40000 ALTER TABLE `quotation_lineitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotation_lineitems` ENABLE KEYS */;


-- Dumping structure for table simak.region
CREATE TABLE IF NOT EXISTS `region` (
  `region_id` varchar(50) NOT NULL DEFAULT '',
  `region_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table simak.region: 3 rows
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
REPLACE INTO `region` (`region_id`, `region_name`) VALUES
	('JAKBAR', 'Jakarta Barat'),
	('JAKTIM', 'Jakarta Timur'),
	('JAKUT', 'Jakarta Utara');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;


-- Dumping structure for table simak.report_list
CREATE TABLE IF NOT EXISTS `report_list` (
  `report_code` varchar(75) CHARACTER SET utf8 NOT NULL,
  `report_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `report_category` double DEFAULT NULL,
  `query_name` double DEFAULT NULL,
  `description` double DEFAULT NULL,
  `date_selectors` int DEFAULT NULL,
  `category_selectors` int DEFAULT NULL,
  `category_query` varchar(255) DEFAULT NULL,
  `category_text` varchar(255) DEFAULT NULL,
  `category_2_selectors` int DEFAULT NULL,
  `category_2_query` varchar(255) DEFAULT NULL,
  `category_2_text` varchar(255) DEFAULT NULL,
  `image` double DEFAULT NULL,
  `criteriatype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `criteria2type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `report_filename` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `field_selection` varchar(255) DEFAULT NULL,
  `date_field_selection` varchar(255) DEFAULT NULL,
  `field_2_selection` varchar(255) DEFAULT NULL,
  `visible` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `criteria3type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category_3_selectors` int DEFAULT NULL,
  `category_3_query` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `category_3_text` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `field_3_selection` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `criteria4type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category_4_selectors` int DEFAULT NULL,
  `category_4_query` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `field_4_selection` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `category_4_text` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `criteria5type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category_5_selectors` int DEFAULT NULL,
  `category_5_query` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `field_5_selection` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `category_5_text` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`report_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.report_list: 0 rows
/*!40000 ALTER TABLE `report_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `report_list` ENABLE KEYS */;


-- Dumping structure for table simak.rpt_open_to_buy
CREATE TABLE IF NOT EXISTS `rpt_open_to_buy` (
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `period_mm` int(11) DEFAULT NULL,
  `opening_stock` double DEFAULT NULL,
  `forecast_sales` double DEFAULT NULL,
  `period_forward_cover` double DEFAULT NULL,
  `closing_stock_required` double DEFAULT NULL,
  `intake_required` double DEFAULT NULL,
  `on_order` double DEFAULT NULL,
  `otb_remaining` double DEFAULT NULL,
  `closing_stock` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=397 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.rpt_open_to_buy: 12 rows
/*!40000 ALTER TABLE `rpt_open_to_buy` DISABLE KEYS */;
REPLACE INTO `rpt_open_to_buy` (`item_number`, `period_mm`, `opening_stock`, `forecast_sales`, `period_forward_cover`, `closing_stock_required`, `intake_required`, `on_order`, `otb_remaining`, `closing_stock`, `id`) VALUES
	('00007', 1, 200, 100, 0, 0, 0, 200, 200, 100, 385),
	('00007', 2, 100, 150, 0, 0, 0, 100, 200, 50, 386),
	('00007', 3, 50, 200, 0, 0, 0, 0, 0, -150, 387),
	('00007', 4, -150, 0, 0, 0, 0, 0, 0, -150, 388),
	('00007', 5, -150, 0, 0, 0, 0, 0, 0, -150, 389),
	('00007', 6, -150, 0, 0, 0, 0, 0, 0, -150, 390),
	('00007', 7, -150, 0, 0, 0, 0, 0, 0, -150, 391),
	('00007', 8, -150, 0, 0, 0, 0, 7763.86, 15627.72, 7713.86, 392),
	('00007', 9, 7713.86, 0, 0, 0, 0, 0, 0, 7713.86, 393),
	('00007', 10, 7713.86, 0, 0, 0, 0, 0, 0, 7713.86, 394),
	('00007', 11, 7713.86, 0, 0, 0, 0, 0, 0, 7713.86, 395),
	('00007', 12, 7713.86, 0, 0, 0, 0, 0, 0, 7713.86, 396);
/*!40000 ALTER TABLE `rpt_open_to_buy` ENABLE KEYS */;


-- Dumping structure for table simak.salesman
CREATE TABLE IF NOT EXISTS `salesman` (
  `salesman` varchar(50) CHARACTER SET utf8 NOT NULL,
  `commission_rate_1` int(11) DEFAULT NULL,
  `commission_rate_2` int(11) DEFAULT NULL,
  `salestype` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `lock_report` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`salesman`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.salesman: 1 rows
/*!40000 ALTER TABLE `salesman` DISABLE KEYS */;
REPLACE INTO `salesman` (`salesman`, `commission_rate_1`, `commission_rate_2`, `salestype`, `update_status`, `create_date`, `create_by`, `update_date`, `update_by`, `user_id`, `lock_report`) VALUES
	('Andri', 0, 0, 'GROSIR', NULL, NULL, NULL, NULL, NULL, 'admin', 0);
/*!40000 ALTER TABLE `salesman` ENABLE KEYS */;


-- Dumping structure for table simak.salesman_group
CREATE TABLE IF NOT EXISTS `salesman_group` (
  `groupid` varchar(20) CHARACTER SET utf8 NOT NULL,
  `salesman` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `komisiprc` double(11,0) DEFAULT NULL,
  `remarks` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.salesman_group: 2 rows
/*!40000 ALTER TABLE `salesman_group` DISABLE KEYS */;
REPLACE INTO `salesman_group` (`groupid`, `salesman`, `komisiprc`, `remarks`, `update_status`) VALUES
	('RETAIL', NULL, 10, 'Kelompok Sales Retail', NULL),
	('GROSIR', NULL, 0, 'Kelompok Grosir', NULL);
/*!40000 ALTER TABLE `salesman_group` ENABLE KEYS */;


-- Dumping structure for table simak.salesman_group_komisi
CREATE TABLE IF NOT EXISTS `salesman_group_komisi` (
  `created_date` datetime DEFAULT NULL,
  `groupid` varchar(50) CHARACTER SET utf8 NOT NULL,
  `salesman` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_amount` double DEFAULT NULL,
  `komisi_prc` double(11,0) DEFAULT NULL,
  `komisi_amount` double DEFAULT NULL,
  `keterangan` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.salesman_group_komisi: 0 rows
/*!40000 ALTER TABLE `salesman_group_komisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `salesman_group_komisi` ENABLE KEYS */;


-- Dumping structure for table simak.salesman_komisi
CREATE TABLE IF NOT EXISTS `salesman_komisi` (
  `low_amount` double DEFAULT NULL,
  `high_amount` double DEFAULT NULL,
  `persen_komisi` double(11,0) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.salesman_komisi: 0 rows
/*!40000 ALTER TABLE `salesman_komisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `salesman_komisi` ENABLE KEYS */;


-- Dumping structure for table simak.sales_order
CREATE TABLE IF NOT EXISTS `sales_order` (
  `sales_order_number` varchar(22) CHARACTER SET utf8 NOT NULL,
  `invoice_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_invoice` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sold_to_customer` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `ship_to_customer` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `sales_date` datetime DEFAULT NULL,
  `your_order__` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `source_of_order` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_terms` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `salesman` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `shipped_via` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `tax_2` double DEFAULT NULL,
  `freight` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `other` double DEFAULT NULL,
  `back_order` int DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `sales_tax_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent` double DEFAULT NULL,
  `sales_tax2_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `sales_tax_percent_2` double DEFAULT NULL,
  `create_invoice` int DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `disc_2` double DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `delivered` int(1) DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `uang_muka` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `close_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `close_date` datetime DEFAULT NULL,
  `close_memo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `approved` int DEFAULT NULL,
  `appr_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `appr_date` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `appr_memo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `cancel_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cancel_date` datetime DEFAULT NULL,
  `cancel_memo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `pending_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pending_date` datetime DEFAULT NULL,
  `pending_memo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `currency_code` varchar(50) DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `ship_date` datetime DEFAULT NULL,
  `warehouse_code` varchar(50) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `paid` int(1) DEFAULT NULL,
  `ship_day` varchar(50) DEFAULT NULL,
  `ship_weight` varchar(50) DEFAULT NULL,
  `ship_no` varchar(50) DEFAULT NULL,
  `supplier_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sales_order_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sales_order: 7 rows
/*!40000 ALTER TABLE `sales_order` DISABLE KEYS */;
REPLACE INTO `sales_order` (`sales_order_number`, `invoice_number`, `type_of_invoice`, `sold_to_customer`, `ship_to_customer`, `sales_date`, `your_order__`, `source_of_order`, `payment_terms`, `salesman`, `shipped_via`, `tax`, `tax_2`, `freight`, `discount`, `other`, `back_order`, `comments`, `sales_tax_code`, `sales_tax_percent`, `sales_tax2_code`, `sales_tax_percent_2`, `create_invoice`, `disc_amount_1`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `delivered`, `org_id`, `update_status`, `uang_muka`, `amount`, `saldo`, `close_by`, `close_date`, `close_memo`, `approved`, `appr_by`, `appr_date`, `appr_memo`, `status`, `cancel_by`, `cancel_date`, `cancel_memo`, `pending_by`, `pending_date`, `pending_memo`, `create_date`, `create_by`, `update_date`, `update_by`, `due_date`, `currency_code`, `currency_rate`, `subtotal`, `ship_date`, `warehouse_code`, `account_id`, `paid`, `ship_day`, `ship_weight`, `ship_no`, `supplier_number`) VALUES
	('SO00191', NULL, 'Simple', '90120', '90120', '2016-02-25 16:49:13', NULL, NULL, 'PO Net 15', NULL, NULL, 0, 0, 0, 0, 0, NULL, '0', 'PPN', 0, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 11115, 11115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-25 16:50:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00119', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, 'KREDIT', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 71544, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 71544, '2016-03-17 18:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00120', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 14560, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 14560, '1970-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00121', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 12096, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 12096, '1970-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00122', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00123', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00124', NULL, NULL, '101', NULL, '2016-03-17 00:00:00', NULL, NULL, '60 Hari', 'Andri', NULL, 0, NULL, 0, 0, 0, NULL, '', NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', NULL, NULL, 0, '1970-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `sales_order` ENABLE KEYS */;


-- Dumping structure for table simak.sales_order_lineitems
CREATE TABLE IF NOT EXISTS `sales_order_lineitems` (
  `sales_order_number` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` double(11,0) DEFAULT NULL,
  `unit` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount` double(11,2) DEFAULT NULL,
  `taxable` int(1) DEFAULT NULL,
  `shipped` int(1) DEFAULT NULL,
  `ship_date` datetime DEFAULT NULL,
  `ship_qty` double(11,0) DEFAULT NULL,
  `bo_qty` double(11,0) DEFAULT NULL,
  `prev_ship_qty` double(11,0) DEFAULT NULL,
  `serial_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `job_reference` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `color` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `warehouse_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `revenue_acct_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `currency_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `currency_rate` double DEFAULT NULL,
  `multi_unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mu_qty` double(11,2) DEFAULT NULL,
  `mu_harga` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `forex_price` double DEFAULT NULL,
  `base_curr_amount` double DEFAULT NULL,
  `disc_2` double(11,2) DEFAULT NULL,
  `disc_amount_2` double DEFAULT NULL,
  `disc_3` double(11,2) DEFAULT NULL,
  `disc_amount_3` double DEFAULT NULL,
  `disc_amount_1` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sales_order_lineitems: 9 rows
/*!40000 ALTER TABLE `sales_order_lineitems` DISABLE KEYS */;
REPLACE INTO `sales_order_lineitems` (`sales_order_number`, `line_number`, `item_number`, `quantity`, `unit`, `description`, `price`, `discount`, `taxable`, `shipped`, `ship_date`, `ship_qty`, `bo_qty`, `prev_ship_qty`, `serial_number`, `job_reference`, `comments`, `cost`, `color`, `size`, `warehouse_code`, `revenue_acct_id`, `amount`, `currency_code`, `currency_rate`, `multi_unit`, `mu_qty`, `mu_harga`, `discount_amount`, `forex_price`, `base_curr_amount`, `disc_2`, `disc_amount_2`, `disc_3`, `disc_amount_3`, `disc_amount_1`, `update_status`, `sourceautonumber`, `sourcefile`, `create_date`, `create_by`, `update_date`, `update_by`) VALUES
	('SO00191', 1, '00002', 1, 'pcs', 'Komputer Desktop Presario GLX 1001 White Green', 10000, 0.05, NULL, NULL, '2016-02-25 16:49:13', NULL, 0, 0, NULL, NULL, '0', 2500000, NULL, NULL, 'Toko', 1415, 9500, 'IDR', 1, 'pcs', 1.00, 10000, 500, 0, 0, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00191', 2, '00007', 1, 'Btl', 'Mizone', 1700, 0.05, NULL, NULL, '2016-02-25 16:49:13', NULL, 0, 0, NULL, NULL, '0', 3500, NULL, NULL, 'Toko', 1415, 1615, 'IDR', 1, 'Btl', 1.00, 1700, 85, 0, 0, 0.00, 0, 0.00, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00119', 3, '100', 1, NULL, 'Baju Anak Koko', 10000, 0.30, NULL, 0, '2016-03-17 18:45:00', 1, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 5040, NULL, NULL, NULL, 1.00, 10000, 3000, NULL, NULL, 0.20, 1400, 0.10, 560, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00119', 4, 'R001', 1, NULL, 'Bir Bintang', 1000, 0.30, NULL, 0, '2016-03-17 18:45:00', 1, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 504, NULL, NULL, NULL, 1.00, 1000, 300, NULL, NULL, 0.20, 140, 0.10, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00119', 5, '10201', 1, 'Pcs', 'Celana Jeans Pria', 132000, 0.50, NULL, 0, '2016-03-17 18:45:00', 1, NULL, NULL, NULL, NULL, NULL, 120000, NULL, NULL, NULL, NULL, 66000, NULL, NULL, 'Pcs', 1.00, 132000, 66000, NULL, NULL, 0.00, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00120', 6, 'R001', 20, NULL, 'Bir Bintang', 1000, 0.15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 9520, NULL, NULL, NULL, 20.00, 1000, 3000, NULL, NULL, 0.20, 3400, 0.30, 4080, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00120', 7, '100', 1, NULL, 'Baju Anak Koko', 10000, 0.30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 5040, NULL, NULL, NULL, 1.00, 10000, 3000, NULL, NULL, 0.20, 1400, 0.10, 560, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00121', 8, '100', 2, NULL, 'Baju Anak Koko', 10000, 0.30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 10080, NULL, NULL, NULL, 2.00, 10000, 6000, NULL, NULL, 0.20, 2800, 0.10, 1120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('SO00121', 9, 'R001', 4, NULL, 'Bir Bintang', 1000, 0.30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL, NULL, NULL, NULL, 2016, NULL, NULL, NULL, 4.00, 1000, 1200, NULL, NULL, 0.20, 560, 0.10, 224, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `sales_order_lineitems` ENABLE KEYS */;


-- Dumping structure for table simak.sales_tax_rates
CREATE TABLE IF NOT EXISTS `sales_tax_rates` (
  `code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `tax_rate` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sales_tax_rates: 0 rows
/*!40000 ALTER TABLE `sales_tax_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_tax_rates` ENABLE KEYS */;


-- Dumping structure for table simak.service_jobs
CREATE TABLE IF NOT EXISTS `service_jobs` (
  `job_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `service_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `teknisi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `garansi` int DEFAULT NULL,
  `job_finish` int DEFAULT NULL,
  `ongkos_kerja` double DEFAULT NULL,
  `masalah` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pekerjaan` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `biaya_lain` double DEFAULT NULL,
  `total_amt_part` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`job_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.service_jobs: 0 rows
/*!40000 ALTER TABLE `service_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_jobs` ENABLE KEYS */;


-- Dumping structure for table simak.service_job_sparepart
CREATE TABLE IF NOT EXISTS `service_job_sparepart` (
  `job_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `item_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.service_job_sparepart: 0 rows
/*!40000 ALTER TABLE `service_job_sparepart` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_job_sparepart` ENABLE KEYS */;


-- Dumping structure for table simak.service_order
CREATE TABLE IF NOT EXISTS `service_order` (
  `no_bukti` varchar(50) CHARACTER SET utf8 NOT NULL,
  `customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `alt_phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cust_po` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `serv_rep` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `manufacture` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `model` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `serial` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `alt_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `service_amt` double DEFAULT NULL,
  `ongkos_amt` double DEFAULT NULL,
  `kirim_amt` double DEFAULT NULL,
  `lain_amt` double DEFAULT NULL,
  `ppn_prc` double(11,0) DEFAULT NULL,
  `ppn_amt` double DEFAULT NULL,
  `disc_prc` double(11,0) DEFAULT NULL,
  `disc_amt` double DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `tanggal_beli` datetime DEFAULT NULL,
  `selesai` int DEFAULT NULL,
  `part_amt` double DEFAULT NULL,
  `tanggal_akhir_garansi` datetime DEFAULT NULL,
  `source_invoice_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_bukti`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.service_order: 0 rows
/*!40000 ALTER TABLE `service_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_order` ENABLE KEYS */;


-- Dumping structure for table simak.shipped_via
CREATE TABLE IF NOT EXISTS `shipped_via` (
  `shipped_via` varchar(50) CHARACTER SET utf8 NOT NULL,
  `address_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `customer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contact_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telp_1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telp_2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`shipped_via`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.shipped_via: 0 rows
/*!40000 ALTER TABLE `shipped_via` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipped_via` ENABLE KEYS */;


-- Dumping structure for table simak.shipping_locations
CREATE TABLE IF NOT EXISTS `shipping_locations` (
  `location_number` varchar(15) CHARACTER SET utf8 NOT NULL,
  `address_type` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `attention_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `company_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `other_phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `comments` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`location_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.shipping_locations: 4 rows
/*!40000 ALTER TABLE `shipping_locations` DISABLE KEYS */;
REPLACE INTO `shipping_locations` (`location_number`, `address_type`, `attention_name`, `company_name`, `street`, `suite`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `other_phone`, `comments`, `update_status`) VALUES
	('Jakarta', 'Penjualan', 'Udin', NULL, 'Jl. Raya Sadang', NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Cawang', 'Penyimpanan', 'Ibu Dewi', NULL, 'Jl. Raya Halim', NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Kerawang', 'Pabrik', 'Usman', NULL, 'Jl. Raya Dawuan', NULL, 'Kerawang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('Gudang', 'Penyimpanan', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `shipping_locations` ENABLE KEYS */;


-- Dumping structure for table simak.source_of_order
CREATE TABLE IF NOT EXISTS `source_of_order` (
  `source_of_order` varchar(50) CHARACTER SET utf8 NOT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`source_of_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.source_of_order: 3 rows
/*!40000 ALTER TABLE `source_of_order` DISABLE KEYS */;
REPLACE INTO `source_of_order` (`source_of_order`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	('', 0, '', ''),
	('By Invite', NULL, NULL, NULL),
	('By Phone', NULL, NULL, NULL);
/*!40000 ALTER TABLE `source_of_order` ENABLE KEYS */;


-- Dumping structure for table simak.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `active` int(1) DEFAULT NULL,
  `supplier_other_vendor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_account_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `type_of_vendor` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `salutation` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `middle_initial` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `suite` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `zip_postal_code` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `payment_terms` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `credit_limit` double DEFAULT NULL,
  `fed_tax_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `credit_balance` double DEFAULT NULL,
  `default_account` int(11) DEFAULT NULL,
  `x1099` int DEFAULT NULL,
  `x1099fedwithheld` double DEFAULT NULL,
  `x1099line` int(11) DEFAULT NULL,
  `x1099statewithheld` double DEFAULT NULL,
  `print1099` int DEFAULT NULL,
  `state_tax_id` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `plafon_hutang` double DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `acc_biaya` int(11) DEFAULT NULL,
  PRIMARY KEY (`supplier_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.suppliers: 30 rows
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
REPLACE INTO `suppliers` (`supplier_number`, `active`, `supplier_other_vendor`, `supplier_account_number`, `type_of_vendor`, `supplier_name`, `salutation`, `first_name`, `middle_initial`, `last_name`, `street`, `suite`, `city`, `state`, `zip_postal_code`, `country`, `phone`, `fax`, `email`, `payment_terms`, `credit_limit`, `fed_tax_id`, `comments`, `credit_balance`, `default_account`, `x1099`, `x1099fedwithheld`, `x1099line`, `x1099statewithheld`, `print1099`, `state_tax_id`, `plafon_hutang`, `org_id`, `update_status`, `create_date`, `create_by`, `update_date`, `update_by`, `acc_biaya`) VALUES
	('3', NULL, NULL, '0', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('A100', NULL, NULL, '0', NULL, 'Asia Jaya, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -27910000, NULL, '0', 31140000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('ALFAMART', NULL, NULL, '1393', 'Konsinyasi', 'ALFAMART', 'Mr.', 'YENI', NULL, NULL, 'JL. RE.MARTADINATA', NULL, 'PURWAKARTA', NULL, NULL, NULL, '0264-393000', '0264-399939', 'YENI@YAHOO.COM', 'PO Net 30', -1562883500, 'PPN', '0', 1628683500, 1393, NULL, NULL, NULL, NULL, NULL, '123.123.122', 20000000, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('AM', NULL, NULL, '0', NULL, 'ARTHA MADIRI', NULL, NULL, NULL, NULL, 'JL. RAYA PELABUHAN', NULL, 'SERANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12500000, NULL, '0', 2550990, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('CATUR', NULL, NULL, '0', NULL, 'CATUR PRATAMA, PT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('FIF', NULL, NULL, '0', NULL, 'FIF Financial', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10000000, NULL, '0', 50000000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('JKT.KI', NULL, NULL, '0', NULL, 'KARYA INDAH', NULL, NULL, NULL, NULL, NULL, NULL, 'JKT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 148942400, NULL, '0', 111278000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('MM', NULL, NULL, '0', NULL, 'MAJU MUNDUR, PT', NULL, NULL, NULL, NULL, 'JL. RAYA BEKASI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, -26244500, 'PPN', '0', 49234500, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S0010', NULL, NULL, '0', NULL, 'MAJU JAYA, PT', 'Mr.', 'Andri', NULL, NULL, 'Jl. Raya Pangandaran', NULL, 'Purwakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45000000, NULL, '0', 5005000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S01', NULL, NULL, NULL, NULL, 'Supplier 1', NULL, NULL, NULL, NULL, 'Jl. Raya Sadang', NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, 'Jl. Raya Sadang', NULL, 0, NULL, '0', 10000000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S02', NULL, NULL, NULL, NULL, 'Supplier 2', NULL, NULL, NULL, NULL, NULL, NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S03', NULL, NULL, NULL, NULL, 'Supplier 3', NULL, NULL, NULL, NULL, NULL, NULL, 'Surabaya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S04', NULL, NULL, NULL, NULL, 'Supplier 4', NULL, NULL, NULL, NULL, NULL, NULL, 'Surabaya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S05', NULL, NULL, NULL, NULL, 'Supplier 5', NULL, NULL, NULL, NULL, NULL, NULL, 'JAKARTA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S06', NULL, NULL, NULL, NULL, 'Supplier 6', NULL, NULL, NULL, NULL, NULL, NULL, 'CIBINONG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S07', NULL, NULL, NULL, NULL, 'Supplier 7', NULL, NULL, NULL, NULL, NULL, NULL, 'CIPANAS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S08', NULL, NULL, NULL, NULL, 'Supplier 8', NULL, NULL, NULL, NULL, 'Jl. Raya Purwakarta No. 87', NULL, 'Purwakarta', NULL, NULL, NULL, '82192992', NULL, 'Jl. Raya Purwakarta No. 87', NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S09', NULL, NULL, NULL, NULL, 'Supplier 9', NULL, NULL, NULL, NULL, 'Ds. Blang Panyang', NULL, 'Lhokseumawe', NULL, NULL, NULL, NULL, NULL, 'Ds. Blang Panyang', NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S10', NULL, NULL, NULL, NULL, 'Supplier 10', NULL, NULL, NULL, NULL, 'Jl. Raya Sadang, No. 27A', NULL, 'Purwakarta', NULL, NULL, NULL, '26499933', NULL, 'Jl. Raya Sadang, No. 27A', NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S11', NULL, NULL, NULL, NULL, 'Supplier 11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S12', NULL, NULL, NULL, NULL, 'Supplier 12', NULL, NULL, NULL, NULL, 'Jl. Raya Purwakarta No. 30', NULL, 'Purwakarta', NULL, NULL, NULL, '2163003', NULL, 'Jl. Raya Purwakarta No. 30', NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S13', NULL, NULL, NULL, NULL, 'Supplier 13', NULL, NULL, NULL, NULL, NULL, NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S14', NULL, NULL, NULL, NULL, 'Supplier 14', NULL, NULL, NULL, NULL, 'fdsg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fdsg', NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S15', NULL, NULL, NULL, NULL, 'Supplier 15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S16', NULL, NULL, NULL, NULL, 'Supplier 16', NULL, NULL, NULL, NULL, 'Jl. Raya Purwakarta No. 8', NULL, 'Jakarta', NULL, NULL, NULL, '0821255se', NULL, 'Jl. Raya Purwakarta No. 8', NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S17', NULL, NULL, NULL, NULL, 'Supplier 17', NULL, 'Akim', NULL, NULL, 'Jl. Raya Rancaekek Bandung', NULL, 'Bandung', NULL, NULL, NULL, NULL, NULL, 'Jl. Raya Rancaekek Bandung', NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('S18', NULL, NULL, NULL, NULL, 'Supplier 18', NULL, NULL, NULL, NULL, NULL, NULL, 'Jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('SC', NULL, NULL, '0', NULL, 'SUPPLIER CARAKA UTAMA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PO Net 30', 1600000, NULL, '0', 1600000, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, NULL, NULL, NULL, NULL, NULL),
	('TIKI', NULL, NULL, '2404', 'Expedisi', 'TIKI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PO Net 30', 1700000, 'PPN', '0', 1700000, 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL),
	('UNKNOWN', NULL, NULL, '0', NULL, 'UNKNOWN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;


-- Dumping structure for table simak.supplier_beginning_balance
CREATE TABLE IF NOT EXISTS `supplier_beginning_balance` (
  `tanggal` datetime DEFAULT NULL,
  `supplier_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `hutang_awal` double DEFAULT NULL,
  `hutang` double DEFAULT NULL,
  `hutang_akhir` double DEFAULT NULL,
  `amountin` double DEFAULT NULL,
  `amountout` double DEFAULT NULL,
  `flagawal` int DEFAULT NULL,
  `org_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  UNIQUE KEY `x1` (`tanggal`,`supplier_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.supplier_beginning_balance: 0 rows
/*!40000 ALTER TABLE `supplier_beginning_balance` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier_beginning_balance` ENABLE KEYS */;


-- Dumping structure for table simak.syslog
CREATE TABLE IF NOT EXISTS `syslog` (
  `tgljam` datetime DEFAULT NULL,
  `computer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `userid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `logtext` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `tcp_ip` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.syslog: 801 rows
/*!40000 ALTER TABLE `syslog` DISABLE KEYS */;
REPLACE INTO `syslog` (`tgljam`, `computer`, `userid`, `logtext`, `update_status`, `tcp_ip`, `jenis`) VALUES
	('2014-12-07 00:00:00', NULL, 'xxx', 'x', NULL, NULL, ''),
	('2016-04-11 18:45:19', NULL, 'admin', '', NULL, NULL, 'LOGIN');
/*!40000 ALTER TABLE `syslog` ENABLE KEYS */;


-- Dumping structure for table simak.sysreportdesign
CREATE TABLE IF NOT EXISTS `sysreportdesign` (
  `report_group` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `formulas` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `debitorcredit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `plusorminus` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fonttype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `colvalue1` double DEFAULT NULL,
  `colvalue2` double DEFAULT NULL,
  `colvalue3` double DEFAULT NULL,
  `colvalue4` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sysreportdesign: 0 rows
/*!40000 ALTER TABLE `sysreportdesign` DISABLE KEYS */;
/*!40000 ALTER TABLE `sysreportdesign` ENABLE KEYS */;


-- Dumping structure for table simak.sysreportdesignfiles
CREATE TABLE IF NOT EXISTS `sysreportdesignfiles` (
  `filename` varchar(50) CHARACTER SET utf8 NOT NULL,
  `report_group` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `formulas` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `debitorcredit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `plusorminus` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fonttype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `colvalue1` double DEFAULT NULL,
  `colvalue2` double DEFAULT NULL,
  `colvalue3` double DEFAULT NULL,
  `colvalue4` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`filename`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sysreportdesignfiles: 0 rows
/*!40000 ALTER TABLE `sysreportdesignfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `sysreportdesignfiles` ENABLE KEYS */;


-- Dumping structure for table simak.system_variables
CREATE TABLE IF NOT EXISTS `system_variables` (
  `varname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `varlen` int(11) DEFAULT NULL,
  `varvalue` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_status` int(11) DEFAULT NULL,
  `section` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vartype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `varlist` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55426 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.system_variables: 55,051 rows
/*!40000 ALTER TABLE `system_variables` DISABLE KEYS */;
REPLACE INTO `system_variables` (`varname`, `varlen`, `varvalue`, `keterangan`, `id`, `update_status`, `section`, `category`, `vartype`, `varlist`) VALUES
	('A/R Payment Numbering', 14, '!ARP~@-~$00001', '', 1, 1, 'Purchase', 'Auto Numbering', 'String', ''),
	('A/R Payment Numbering - AutoNumber', 7, '1', '', 2, 1, 'Purchase', '', '', ''),
	('Admin Password', 3, 'bos', '', 5, 1, 'Inventory', 'Auto Numbering', '', ''),
	('Allow Qty Stock Minus', 4, 'True', '', 6, 1, 'System', 'Auto Numbering', '', ''),
	('AP Numbering', 14, '!ARP~@-~#MM~#DD~#YY~$00009', '', 7, 1, 'Purchase', 'Auto Numbering', '', ''),
	('AP Numbering - AutoNumber', 7, '1', '', 8, 1, 'Purchase', 'Auto Numbering', '', ''),
	('AP Payment Numbering', 14, '!APP~$00066', '', 9, 1, 'Sales', 'Auto Numbering', '', ''),
	('AR Payment Numbering', 14, '!ARP~$00094', '', 10, 1, 'Sales', 'Auto Numbering', '', ''),
	('AskAdminPassForExit', 5, 'False', 'NIL', 11, 1, 'Inventory', 'Auto Numbering', '', ''),
	('Assembly Numbering', 14, '!ASM~@-~$00010', '', 12, 1, 'System', NULL, NULL, NULL),
	('Assembly Numbering - AutoNumber', 7, '1', '', 13, 1, 'System', '', '', ''),
	('AutoComplete', 5, 'True', NULL, 14, 1, 'System', NULL, NULL, NULL),
	('AutoLogon', 1, '1', NULL, 15, 1, 'System', NULL, NULL, NULL),
	('AutoLookUp', 4, 'True', NULL, 16, 1, 'System', NULL, NULL, NULL),
	('Bersihkan Input', 1, 'True', '', 17, 1, 'Accounting', 'Auto Numbering', '', ''),
	('Cetak_CreditCard', 1, '1', NULL, 18, 1, 'System', NULL, NULL, NULL),
	('Cetak_LainLain', 1, '1', NULL, 19, 1, 'System', NULL, NULL, NULL),
	('Cetak_PPN', 1, '1', NULL, 20, 1, 'System', NULL, NULL, NULL),
	('COA Uang Muka', 4, '1209', '', 21, 1, 'Inventory', 'Auto Numbering', '', ''),
	('COA Uang Muka Pembelian', 4, '1370', '', 22, 1, 'System', NULL, NULL, NULL),
	('COA Uang Muka Penjualan', 4, '1370', '', 23, 1, 'System', NULL, NULL, NULL),
	('CRDB SO Numbering', 15, '!CRDB~@-~$00107', '', 24, 1, 'System', NULL, NULL, NULL),
	('current_org_id', 3, '000', 'struktur organisasi aktif', 25, 1, 'System', NULL, NULL, NULL),
	('DisAssembly Numbering', 15, '!DASM~$00001', NULL, 26, 1, 'System', NULL, NULL, NULL),
	('DisAssembly Numbering - AutoNumber', 7, '0', NULL, 27, 1, 'System', NULL, NULL, NULL),
	('Display Supplier/Customer', 4, 'True', NULL, 28, 1, 'System', NULL, NULL, NULL),
	('DisplayError', 1, 'True', '', 29, 1, 'System', NULL, NULL, NULL),
	('Flag [Bank Accounts] add no_bukti_in, no_bukti_out', 1, '1', 'NIL', 31, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Customers] add NPPKP.', 1, '1', 'NIL', 32, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [GL Transaction] +project_code', 1, '1', 'NIL', 33, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [gl_projects] add sales, cost, expense', 1, '1', 'NIL', 34, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [gl_projects] add sales, cost, expense, labar', 1, '1', 'NIL', 35, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Inventory Beginning Balance] hpp_awal,akhir', 1, '1', 'NIL', 36, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Inventory Moving] add cost', 1, '1', 'NIL', 37, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Inventory] add custom fields', 1, '1', 'NIL', 38, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Invoice Lineitems] koreksi qty dan mu qty', 1, '1', 'NIL', 39, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Invoice Tax Serial] create.', 1, '1', 'NIL', 40, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Invoice] add audit_status', 1, '1', 'NIL', 41, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [org_struct] add table', 1, '1', 'NIL', 42, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [sys_tooltip] add table', 1, '1', 'NIL', 43, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Check Writer 100', 1, '1', NULL, 44, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Check Writer 101', 1, '1', NULL, 45, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Check Writer 102', 1, '1', 'add curr_code, curr_rate', 46, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag DB Integrated GL', 1, '1', NULL, 47, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Inventory 100', 1, '1', 'NIL', 48, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Inventory Balance 100', 1, '1', 'NIL', 49, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Inventory Beginning Balance 100', 1, '1', 'NIL', 50, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Inventory Ordering Info', 1, '1', 'NIL', 51, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Inventory Products 100', 1, '1', 'NIL', 52, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Inventory Products 101', 1, '1', 'NIL', 53, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Inventory Products 102', 1, '1', 'NIL', 54, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Inventory Products 103', 1, '1', 'NIL', 55, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Inventory Serialized Items 100', 1, '1', 'NIL', 56, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Invoice 200', 1, '1', 'NIL', 57, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Invoice 201', 1, '1', 'NIL', 58, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Invoice Correction', 1, '1', NULL, 59, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag KIS Group Modules 100', 1, '1', 'NIL', 60, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag KIS Modules 100', 1, '1', 'NIL', 61, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Multi Unit', 1, '1', NULL, 62, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Payables 100', 1, '1', NULL, 63, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Payment 100', 1, '1', NULL, 64, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Payments 102', 1, '1', 'add no_bukti', 65, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Payments 103', 1, '1', 'NIL', 66, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag PO Info Correction', 1, '1', NULL, 67, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Purchase Order 100', 1, '1', 'NIL', 68, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Purchase Order 102', 1, '1', 'NIL', 69, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Purchase Order Lineitems 100', 1, '1', 'NIL', 70, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag Quotation add Disc, MultiUnit', 1, '1', 'NIL', 71, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag System Variabel 100', 1, '1', 'add keterangan di system variabel', 72, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag TMP_KARTU_STOCK add harga, hpp_awal,hpp_akhir', 1, '1', 'NIL', 73, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag tmp_seri 100', 1, '1', 'NIL', 74, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag User 101', 1, '1', 'NIL', 75, 1, 'Upgrade', NULL, NULL, NULL),
	('Footer1', 11, 'Terimakasih', NULL, 76, 1, 'System', NULL, NULL, NULL),
	('Footer2', 7, 'Footer2', NULL, 77, 1, 'System', NULL, NULL, NULL),
	('Footer3', 7, 'Footer3', NULL, 78, 1, 'System', NULL, NULL, NULL),
	('FormatNumeric', 14, '###,###,##0.00', NULL, 79, 1, 'System', NULL, NULL, NULL),
	('GL Journal Numbering', 25, '!JU~$00004', '', 80, 1, 'Accounting', 'Auto Numbering', '', ''),
	('GL Journal Numbering - AutoNumber', 1, '1', '', 81, 1, 'System', NULL, NULL, NULL),
	('gstrTahunAktif', 0, '2001', NULL, 82, 1, 'System', NULL, NULL, NULL),
	('Header1', 7, 'Header1', NULL, 83, 1, 'System', NULL, NULL, NULL),
	('Header2', 7, 'Header2', NULL, 84, 1, 'System', NULL, NULL, NULL),
	('Header3', 7, 'Header3', NULL, 85, 1, 'System', NULL, NULL, NULL),
	('height', 0, '11190', NULL, 86, 1, 'System', NULL, NULL, NULL),
	('HKGL112', 16, 'GetAccount(1098)', NULL, 87, 1, 'Accounting', NULL, NULL, NULL),
	('HKGL113', 16, 'GetAccount(1099)', NULL, 88, 1, 'Accounting', NULL, NULL, NULL),
	('HKGL114', 16, 'GetAccount(1204)', NULL, 89, 1, 'Accounting', NULL, NULL, NULL),
	('HKGL115', 16, 'GetAccount(1210)', NULL, 90, 1, 'Accounting', NULL, NULL, NULL),
	('HKGL116', 16, 'GetAccount(1104)', NULL, 91, 1, 'Accounting', NULL, NULL, NULL),
	('HKGL117', 16, 'GetAccount(1111)', NULL, 92, 1, 'Accounting', NULL, NULL, NULL),
	('HKGL118', 16, 'GetAccount(1206)', NULL, 93, 1, 'Accounting', NULL, NULL, NULL),
	('HKGL119', 16, 'GetAccount(1102)', NULL, 94, 1, 'Accounting', NULL, NULL, NULL),
	('HKGL120', 16, 'GetAccount(1110)', NULL, 95, 1, 'Accounting', NULL, NULL, NULL),
	('Invoice DO Numbering', 14, '!JDO~$0045', '', 96, 1, 'Sales', NULL, NULL, NULL),
	('Invoice DO Numbering - AutoNumber', 7, '1', '', 97, 1, 'Sales', NULL, NULL, NULL),
	('Invoice Konsinyasi Numbering', 14, '!JKO~$00001', '', 98, 1, 'Sales', NULL, NULL, NULL),
	('Invoice Konsinyasi Numbering - AutoNumber', 7, '1', '', 99, 1, 'Sales', NULL, NULL, NULL),
	('Invoice Numbering', 14, '!PJL~$00172', '', 100, 1, 'Sales', NULL, NULL, NULL),
	('Invoice Numbering - AutoNumber', 7, '1', '', 101, 1, 'Sales', NULL, NULL, NULL),
	('Invoice Retur Numbering', 14, '!JRE~$00027', '', 102, 1, 'Sales', NULL, NULL, NULL),
	('Invoice Retur Numbering - AutoNumber', 7, '1', '', 103, 1, 'Sales', NULL, NULL, NULL),
	('Jenis_Usaha', 1, '1', 'NIL', 104, 1, 'System', NULL, NULL, NULL),
	('JenisFaktur', 0, 'Invoice', NULL, 105, 1, 'Sales', NULL, NULL, NULL),
	('Jumlah Discount', 1, '1', '', 106, 1, 'System', NULL, NULL, NULL),
	('Konfirmasi Simpan Stock', 1, '0', NULL, 107, 1, 'System', NULL, NULL, NULL),
	('Konsinyasi Numbering', 14, '!BKO~$00001', '', 108, 1, 'Sales', NULL, NULL, NULL),
	('Konsinyasi Numbering - AutoNumber', 7, '1', '', 109, 1, 'Sales', NULL, NULL, NULL),
	('Lady Resv Numbering', 0, '!RLD~@-~$00001', NULL, 110, 1, 'System', NULL, NULL, NULL),
	('left', 0, '1650', NULL, 111, 1, 'System', NULL, NULL, NULL),
	('Multi DO', 7, '0', '', 113, 1, 'Purchase', 'Auto Numbering', '', ''),
	('no', 0, 'False', NULL, 114, 1, 'System', NULL, NULL, NULL),
	('Pakai Discount Rupiah', 5, 'False', '', 115, 1, 'System', NULL, NULL, NULL),
	('Pembelian Numbering', 14, '!PBL~$00116', '', 116, 1, 'System', NULL, NULL, NULL),
	('Pembelian Numbering - AutoNumber', 7, '1', '', 117, 1, 'System', NULL, NULL, NULL),
	('POS Numbering', 14, '!T8~$00019', NULL, 118, 1, 'System', NULL, NULL, NULL),
	('POS Room Numbering', 14, '!POS~@-~$00016', NULL, 119, 1, 'System', NULL, NULL, NULL),
	('Purchase Order Numbering', 13, '!PO~$00280', '', 120, 1, 'System', NULL, NULL, NULL),
	('Purchase Order Numbering - AutoNumber', 7, '1', '', 121, 1, 'System', NULL, NULL, NULL),
	('PurchaseUpdQtyWhen', 21, '1', '', 122, 1, 'System', NULL, NULL, NULL),
	('Quotation Numbering', 14, '!QUT~$00001', '', 123, 1, 'Sales', NULL, NULL, NULL),
	('Quotation Numbering - AutoNumber', 7, '1', '', 124, 1, 'Sales', NULL, NULL, NULL),
	('Receivement Numbering', 14, '!TRM~$00242', '', 125, 1, 'System', NULL, NULL, NULL),
	('Receivement Numbering - AutoNumber', 7, '1', '', 126, 1, 'System', NULL, NULL, NULL),
	('Recv Finish Good Numbering', 14, '!RFG~@-~$00026', '', 127, 1, 'System', NULL, NULL, NULL),
	('Reservation Numbering', 14, '!RPO~@-~$00034', NULL, 128, 1, 'System', NULL, NULL, NULL),
	('Retur Beli Numbering', 14, '!BRE~$00020', '', 129, 1, 'System', NULL, NULL, NULL),
	('Retur Numbering', 14, '!BRE~@-~$00018', NULL, 130, 1, 'Sales', NULL, NULL, NULL),
	('Retur Numbering - AutoNumber', 7, '1', NULL, 131, 1, 'Sales', NULL, NULL, NULL),
	('Room Resv Numbering', 14, '!RRN~@-~$00022', NULL, 132, 1, 'System', NULL, NULL, NULL),
	('rpt_criteria_split_char_1', 1, '/', 'rpt_criteria_split_char_1', 133, 1, 'System', NULL, NULL, NULL),
	('rpt_criteria_split_char_2', 1, '\\', 'rpt_criteria_split_char_2', 134, 1, 'System', NULL, NULL, NULL),
	('Sales Order Numbering', 13, '!SO~$00125', '', 135, 1, 'Sales', NULL, NULL, NULL),
	('Sales Order Numbering - AutoNumber', 7, '1', '', 136, 1, 'Sales', NULL, NULL, NULL),
	('SaleUpdQtyWhen', 21, '1 - Pengiriman Barang', '', 137, 1, 'Sales', NULL, NULL, NULL),
	('Serial', 16, '0387F9FF00000686', 'NIL', 138, 1, 'System', NULL, NULL, NULL),
	('SetCekStatusRoom', 5, 'False', 'NIL', 139, 1, 'System', NULL, NULL, NULL),
	('SetCreditCard', 1, '0', 'NIL', 140, 1, 'System', NULL, NULL, NULL),
	('SetDiscPrc', 3, '0.1', 'NIL', 141, 1, 'System', NULL, NULL, NULL),
	('SetPB', 1, '0', 'NIL', 142, 1, 'System', NULL, NULL, NULL),
	('SetRoundMinute', 1, '0', 'NIL', 143, 1, 'System', NULL, NULL, NULL),
	('SetServiceCharge', 1, '0', 'NIL', 144, 1, 'System', NULL, NULL, NULL),
	('SetShowKonsinyasi', 4, 'True', NULL, 145, 1, 'System', NULL, NULL, NULL),
	('status_project', 4, 'Open', 'Status Project', 146, 1, 'System', NULL, NULL, NULL),
	('status_project_1', 6, 'Closed', 'Status Project', 147, 1, 'System', NULL, NULL, NULL),
	('Stock Receive Numbering', 14, '!RCV~@-~$00024', NULL, 148, 1, 'System', NULL, NULL, NULL),
	('strCompany', 0, 'ATL', NULL, 149, 1, 'System', NULL, NULL, NULL),
	('strCurrentModule', 0, 'frmMain', NULL, 150, 1, 'System', NULL, NULL, NULL),
	('Tampil Harga Beli', 1, '0', '', 151, 1, 'System', NULL, NULL, NULL),
	('Tampil History Harga', 1, '', '', 152, 1, 'System', NULL, NULL, NULL),
	('Tampil Multi Pricing', 1, '', '', 153, 1, 'System', NULL, NULL, NULL),
	('top', 0, '165', NULL, 154, 1, 'System', NULL, NULL, NULL),
	('TRX OE Numbering', 0, '!TRX~$00004', NULL, 155, 1, 'System', NULL, NULL, NULL),
	('txtPassword', 0, 'ADMIN', NULL, 156, 1, 'System', NULL, NULL, NULL),
	('txtUsername', 0, 'administrator', NULL, 157, 1, 'System', NULL, NULL, NULL),
	('Ubah Qty Assembly DisAssembly', 4, 'True', '', 158, 1, 'System', NULL, NULL, NULL),
	('Update AR/AP Balance in Bank Module', 5, 'False', NULL, 159, 1, 'System', NULL, NULL, NULL),
	('Use Stock Receipt', 1, '0', 'NIL', 160, 1, 'System', NULL, NULL, NULL),
	('width', 0, '15480', NULL, 161, 1, 'System', NULL, NULL, NULL),
	('WindowState', 1, '2', NULL, 162, 1, 'System', NULL, NULL, NULL),
	('Work Order Numbering', 13, '!WO~@-~$00018', NULL, 163, 1, 'System', NULL, NULL, NULL),
	('yes', 0, 'True', NULL, 164, 1, 'System', NULL, NULL, NULL),
	('Flag [Kas Kasir] add kasir', 1, '1', 'nil', 165, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Payments] add pos fields', 1, '1', 'NIL', 166, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Inventory] add qstep1', 1, '1', 'nil', 167, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Inventory] add qty_awal', 1, '1', 'nil', 168, 1, 'Upgrade', NULL, NULL, NULL),
	('Sales Tax Numbering', 22, '!010.000.07.~$00000005', 'Nomor urut faktur pajak', 169, 1, 'Sales', NULL, NULL, NULL),
	('Flag [Trans_Type] new table', 1, '1', 'NIL', 173, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [qry_KartuStock_Union] Add query', 1, '1', 'NIL', 174, 1, 'Upgrade', NULL, NULL, NULL),
	('DefaultCurrency', 3, 'IDR', '', 175, 1, 'System', NULL, NULL, NULL),
	('BeginDate', 10, '2012-01-01 00:00', '', 176, 1, 'System', NULL, NULL, NULL),
	('FiscalYear', 10, '2012', '', 177, 1, 'System', NULL, NULL, NULL),
	('AllowInputDateFrom', 10, '2012-01-01 00:00', '', 178, 1, 'System', 'Auto Numbering', '', ''),
	('AllowInputDateTo', 10, '2012-12-31 00:00', '', 179, 1, 'Purchase', 'Auto Numbering', '', ''),
	('ShowReminder', 4, 'True', '', 180, 1, 'System', NULL, NULL, NULL),
	('ShowTips', 4, 'FALSE', 'Show Tips', 181, 1, 'System', NULL, NULL, NULL),
	('Flag [Inventory] add AllowChangePrice', 1, '1', 'nil', 182, 1, 'Upgrade', NULL, NULL, NULL),
	('Flag [Sales Order] add uang_muka', 1, '1', 'NIL', 183, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Preferences] add PurPriDec, PurQtyDec', 1, '1', 'NIL', 188, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Invoice Lineitems] add from_line_type', 1, '1', 'NIL', 190, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Sales Order] add uang_muka 2', 1, '1', 'NIL', 191, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Purchase Order Lineitems] add from_line_numb', 1, '1', 'NIL', 201, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Purchase Order Lineitems] add from_line_numb', 1, '1', 'NIL', 205, NULL, 'Upgrade', NULL, NULL, NULL),
	('PO Jumlah Discount', 1, '1', '', 206, NULL, 'System', NULL, NULL, NULL),
	('Flag [Invoice] do_invoiced', 1, '1', 'NIL', 207, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [so_do_inv_pay] add', 1, '1', 'NIL', 208, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Purchase Order] add amount', 1, '1', 'NIL', 209, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag add [Invoice Shipment]', 1, '1', 'NIL', 210, NULL, 'Upgrade', NULL, NULL, NULL),
	('TypeOfInvoice', 0, 'Simple', 'Jenis faktur', 211, NULL, 'Sales', NULL, NULL, NULL),
	('TypeOfInvoice', 0, 'Profesional', 'Jenis faktur', 212, NULL, 'Sales', NULL, NULL, NULL),
	('TypeOfInvoice', 0, 'Product Detail', 'Jenis faktur', 213, NULL, 'Sales', NULL, NULL, NULL),
	('TypeOfInvoice', 0, 'Service', 'Jenis faktur', 214, NULL, 'Sales', NULL, NULL, NULL),
	('TypeOfInvoice', 0, 'Konsinyasi', 'Jenis faktur', 215, NULL, 'Sales', NULL, NULL, NULL),
	('TypeOfInvoice', 0, 'Faktur Eceran', 'Jenis faktur', 216, NULL, 'Sales', NULL, NULL, NULL),
	('TypeOfInvoice', 0, 'Faktur Grosir', 'Jenis faktur', 217, NULL, 'Sales', NULL, NULL, NULL),
	('Flag add key type of invoice', 1, '1', 'NIL', 218, NULL, 'Upgrade', NULL, NULL, NULL),
	('AppSecureLevel', 1, '0', 'NIL', 219, NULL, 'Sales', 'Auto Numbering', '', ''),
	('HargaBeliPoItem', 1, '0', '', 220, NULL, 'System', NULL, NULL, NULL),
	('Flag add [Check Writer] JenisUangMuka, SisaUangMuk', 1, '1', 'NIL', 221, NULL, 'Upgrade', NULL, NULL, NULL),
	('TypeOfInvoice', 0, 'Faktur Pangan', 'Jenis faktur', 222, NULL, 'Sales', NULL, NULL, NULL),
	('TypeOfInvoice', 0, 'Faktur Kebun', 'Jenis faktur', 223, NULL, 'Sales', NULL, NULL, NULL),
	('Flag add [sqlListDo]', 1, '1', 'NIL', 224, NULL, 'Upgrade', NULL, NULL, NULL),
	('PO Request Numbering', 14, '!POR~@-~$00004', 'NIL', 225, NULL, 'System', NULL, NULL, NULL),
	('Flag [Import] Build Source Autonumber', 0, '1', NULL, 226, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Preferences] change Fed Tax ID', 1, '1', 'NIL', 227, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [CW Items] add org_id', 1, '1', 'NIL', 228, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag change [tmp_kartu_hutang] amount', 1, '1', 'NIL', 229, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag change [tmp_kartu_piutang] amount', 1, '1', 'NIL', 230, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [gl_projects] add invoice_number', 1, '1', 'NIL', 231, NULL, 'Upgrade', NULL, NULL, NULL),
	('AR Payment Numbering - AutoNumber', 1, '1', '', 232, NULL, 'System', NULL, NULL, NULL),
	('Acc In KAS Numbering', 15, '!KM.KAS.~$00072', '', 233, NULL, 'Banking', 'Auto Numbering', '', ''),
	('Acc Out KAS Numbering', 15, '!KK.KAS.~$00056', '', 234, NULL, 'Sales', 'Auto Numbering', '', ''),
	('Flag [Fa_Asset] change acquisition_date', 1, '1', 'NIL', 235, NULL, 'Upgrade', NULL, NULL, NULL),
	('Retur Beli Numbering - AutoNumber', 1, '1', '', 236, NULL, 'System', NULL, NULL, NULL),
	('AP Payment Numbering - AutoNumber', 1, '1', '', 237, NULL, 'Purchase', 'Auto Numbering', '', ''),
	('Inventory Numbering - AutoNumber', 1, '1', '', 238, NULL, 'Inventory', NULL, NULL, NULL),
	('Inventory Numbering', 6, '$00013', '', 239, NULL, 'Inventory', NULL, NULL, NULL),
	('Flag Ubah symbol kode barang', 1, '1', 'NIL', 244, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [tmp_stock_card_1] add table', 1, '1', 'NIL', 245, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag add qry_daftar_piutang', 1, '1', 'NIL', 255, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Invoice] your_order_date', 1, '1', 'NIL', 256, NULL, 'Upgrade', NULL, NULL, NULL),
	('TerbilangInvoice', 1, '0', '', 257, NULL, 'System', NULL, NULL, NULL),
	('Flag [SysVar] set terbilang bahasa', 1, '1', 'NIL', 258, NULL, 'Upgrade', NULL, NULL, NULL),
	('SelectRecWhenPrintInvoice', 1, '0', '', 259, NULL, 'Sales', NULL, NULL, NULL),
	('Flag [SysVar] set pilih rekening', 1, '1', 'NIL', 260, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [SysVar] add Section,Category,VarType', 1, '1', 'NIL', 261, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Inventory] add SetupTime~ ProcessTime', 1, '1', 'None', 262, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Inventory] add Komisi~ IsService', 1, '1', 'None', 263, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [SysVar] add [Discount Addition]', 1, '1', 'nil', 264, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [Inventory Serial] add function', 1, '1', 'NIL', 265, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [user_modules] add', 1, '1', 'nil', 266, NULL, 'Upgrade', NULL, NULL, NULL),
	('Flag [user_modules] add', 1, '1', 'nil', 267, NULL, 'Upgrade', NULL, NULL, NULL),
	('FingerprintKey', 1, 'UAA2ARPPEAEJEEE66', 'FingerprintKey', 268, NULL, 'System', NULL, NULL, NULL),
	('LicenceKey', 37, 'HI42T2GP7EIMN3A2AAA13AE7IEE68IIA2EIAA', 'NIL', 269, NULL, 'System', NULL, NULL, NULL),
	('LicenceCount', 1, '2', 'NIL', 270, NULL, 'System', NULL, NULL, NULL),
	('LicenseKey', 1, 'HAA2A2BPE4EJ6EE66', 'LicenseKey', 271, NULL, 'System', NULL, NULL, NULL),
	('LicenseCount', 1, '2', 'LicenseCount', 272, NULL, 'System', NULL, NULL, NULL),
	('AppLicenseStatus', 1, '1', 'NIL', 273, NULL, 'Sales', 'Auto Numbering', '', ''),
	('Flag add patch v.630', 1, '1', 'NIL', 274, NULL, 'Upgrade', NULL, NULL, NULL),
	('Acc In BCA Numbering', 15, '!BCA.KM.~$00035', '', 275, NULL, 'Banking', 'Auto Numbering', '', ''),
	('Acc Out BCA Numbering', 15, '!BCA.KK.~$00015', '', 276, NULL, 'Banking', 'Auto Numbering', '', ''),
	('MultiCurrency', 1, '1', 'NIL', 277, NULL, 'System', '', '', ''),
	('MultiWarehouse', 1, '1', 'NIL', 278, NULL, 'System', '', '', ''),
	('MultiBranch', 1, '1', 'NIL', 279, NULL, 'System', NULL, NULL, NULL),
	('MyPosFile', 18, 'C:\\MyPos\\MyPos.exe', 'NIL', 280, NULL, 'System', NULL, NULL, NULL),
	('MultiCustomerBranch', 1, '1', 'NIL', 281, NULL, NULL, NULL, NULL, NULL),
	('DefaultGudang', 6, 'Gudang', 'NIL', 282, NULL, NULL, NULL, NULL, NULL),
	('DefaultCurrencyRate', 1, '1', 'Default Currency Rate', 283, NULL, NULL, NULL, NULL, NULL),
	('Invoice Angkutan Numbering', 7, '$000016', 'NIL', 284, NULL, NULL, NULL, NULL, NULL),
	('Biaya Angkutan Numbering', 11, '@BA~$000032', 'NIL', 285, NULL, NULL, NULL, NULL, NULL),
	('ReCalcHppBeforeJournal', 1, '0', 'NIL', 286, NULL, NULL, NULL, NULL, NULL),
	('Flag [credit_card_type] add card_type', 1, '1', 'nil', 287, NULL, NULL, NULL, NULL, NULL),
	('Flag [Kas kasir] add catatan', 1, '1', 'nil', 288, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice Lineitems] add [Tax_Amount]', 1, '1', 'nil', 289, NULL, NULL, NULL, NULL, NULL),
	('Flag [PR_Card] addnew table', 1, '1', 'nil', 290, NULL, NULL, NULL, NULL, NULL),
	('Flag [090613].[qry_KartuPiutang]', 1, '1', 'NIL', 291, NULL, NULL, NULL, NULL, NULL),
	('Flag [090615].[Report List] visible', 1, '1', 'NIL', 293, NULL, NULL, NULL, NULL, NULL),
	('Flag [GL_BegBalArc_Year] add table', 1, '1', 'NIL', 294, NULL, NULL, NULL, NULL, NULL),
	('AutoCreateSupplierWhenOrder', 1, 'True', '', 295, NULL, NULL, NULL, NULL, NULL),
	('AllowMoveToNextControlWhenEmpty', 1, '', '', 296, NULL, NULL, NULL, NULL, NULL),
	('Multi Currency', 1, 'True', '', 297, NULL, NULL, NULL, NULL, NULL),
	('AutoCreateCustomerWhenOrder', 1, '1', '', 298, NULL, NULL, NULL, NULL, NULL),
	('GridAutoCompletion', 1, '1', '', 299, NULL, NULL, NULL, NULL, NULL),
	('GridAutoDropdown', 1, '1', '', 300, NULL, NULL, NULL, NULL, NULL),
	('GridMoveColWithTab', 1, '0', '', 301, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice Lineitems] add sales_comm_amount', 1, '1', 'NIL', 302, NULL, NULL, NULL, NULL, NULL),
	('Flag [090701].[qry_KartuPiutang]', 1, '1', 'NIL', 303, NULL, NULL, NULL, NULL, NULL),
	('Flag [KIS Modules] add onaccount payment', 1, '1', 'nil', 305, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice Lineitems] change employee_id', 1, '1', 'nil', 306, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice Lineitems] add forex price', 1, '1', 'nil', 307, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice Lineitems] add PrintCount', 1, '1', 'None', 308, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice Lineitems] add employee_id~ line_ord', 1, '1', 'None', 309, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory] add [qstep1]', 1, '1', 'nil', 310, NULL, NULL, NULL, NULL, NULL),
	('Flag [Report List] Add more field', 1, '1', 'NIL', 311, NULL, NULL, NULL, NULL, NULL),
	('Flag Set QtyStockUpdateWhen', 1, '999', 'NIL', 312, NULL, NULL, NULL, NULL, NULL),
	('Service Order Numbering', 14, '!SRV~@-~$00003', 'service job numbering', 313, NULL, NULL, NULL, NULL, NULL),
	('Service job numbering', 15, '!SJOB~@-~$00005', 'service job numbering', 314, NULL, NULL, NULL, NULL, NULL),
	('NilaiPembulatan', 3, '0', 'nil', 315, NULL, NULL, NULL, NULL, NULL),
	('Flag [credit_card_type] add [card_name]', 1, '1', 'nil', 316, NULL, NULL, NULL, NULL, NULL),
	('Flag [user_modules] add menu adj', 1, '1', 'nil', 317, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory Categories] add field parent_id', 1, '1', 'nil', 318, NULL, NULL, NULL, NULL, NULL),
	('Flag [customers_other_info] add table', 1, '1', 'nil', 319, NULL, NULL, NULL, NULL, NULL),
	('Flag [tmp_kartu_stock] add [comments]', 1, '1', 'nil', 320, NULL, NULL, NULL, NULL, NULL),
	('Flag [user_modules] add menu assembly', 1, '1', 'nil', 321, NULL, NULL, NULL, NULL, NULL),
	('adjust_raw_material', 5, 'True', 'nil', 322, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice Shipment] add addr1, addr2 etc', 1, '1', 'NIL', 323, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice Shipment] add kota asal', 1, '1', 'NIL', 324, NULL, NULL, NULL, NULL, NULL),
	('recalc_discount_when_report', 5, 'False', 'nil', 325, NULL, NULL, NULL, NULL, NULL),
	('Flag [qry_pos_nota] add new query', 1, '1', 'nil', 326, NULL, NULL, NULL, NULL, NULL),
	('Customer ShipTo Numbering', 6, '$00008', 'nil', 327, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory Warehouse] add price', 1, '1', 'NIL', 328, NULL, NULL, NULL, NULL, NULL),
	('Invoice Numbering - Locked', 1, '1', '', 329, NULL, NULL, NULL, NULL, NULL),
	('GabungKodeJurnal', 1, '1', '', 330, NULL, NULL, NULL, NULL, NULL),
	('LoadSelectItem', 1, '', '', 331, NULL, NULL, NULL, NULL, NULL),
	('ar_payment_date_locked', 1, '', '', 332, NULL, NULL, NULL, NULL, NULL),
	('allow_reprint_do', 1, '', '', 333, NULL, NULL, NULL, NULL, NULL),
	('allow_reprint_invoice', 1, '0', '', 334, NULL, NULL, NULL, NULL, NULL),
	('allow_reprint_so', 1, '1', 'NIL', 335, NULL, NULL, NULL, NULL, NULL),
	('allow_reprint_retur_jual', 1, '1', 'NIL', 336, NULL, NULL, NULL, NULL, NULL),
	('allow_reprint_po', 1, '1', 'NIL', 337, NULL, NULL, NULL, NULL, NULL),
	('allow_reprint_po_invoice', 1, '1', 'NIL', 338, NULL, NULL, NULL, NULL, NULL),
	('allow_reprint_retur_beli', 1, '1', 'NIL', 339, NULL, NULL, NULL, NULL, NULL),
	('Flag Allow Reprint Document', 1, '1', 'NIL', 340, NULL, NULL, NULL, NULL, NULL),
	('Flag [user_modules] add menu form stock opname', 1, '1', 'nil', 341, NULL, NULL, NULL, NULL, NULL),
	('Flag [user_modules] add menu retur opname', 1, '1', 'nil', 342, NULL, NULL, NULL, NULL, NULL),
	('lock_change_item', 5, 'True', 'nil', 343, NULL, NULL, NULL, NULL, NULL),
	('Flag [user_modules] add menu lap minus', 1, '1', 'nil', 344, NULL, NULL, NULL, NULL, NULL),
	('Adjustment Numbering', 11, '!ADJ~$00020', '', 345, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory Warehouse] add qstep', 1, '1', 'NIL', 346, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory Moving] add id', 1, '1', 'NIL', 347, NULL, NULL, NULL, NULL, NULL),
	('Transfer Stock Numbering', 14, '!TRX~$00012', '', 348, NULL, NULL, NULL, NULL, NULL),
	('Adjustment Numbering - AutoNumber', 1, '1', '', 349, NULL, NULL, NULL, NULL, NULL),
	('Transfer Stock Numbering - AutoNumber', 1, '0', 'NIL', 350, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory Moving] add catatan', 1, '1', 'NIL', 351, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory Warehouse] add desc', 1, '1', 'NIL', 352, NULL, NULL, NULL, NULL, NULL),
	('col_width_kode', 4, '3110', 'nil', 353, NULL, NULL, NULL, NULL, NULL),
	('col_width_qty', 3, '555', 'nil', 354, NULL, NULL, NULL, NULL, NULL),
	('col_width_unit', 3, '450', 'nil', 355, NULL, NULL, NULL, NULL, NULL),
	('col_width_harga', 4, '1005', 'nil', 356, NULL, NULL, NULL, NULL, NULL),
	('col_width_disc_prc', 3, '615', 'nil', 357, NULL, NULL, NULL, NULL, NULL),
	('col_width_disc_amt', 3, '700', 'nil', 358, NULL, NULL, NULL, NULL, NULL),
	('col_width_jumlah', 4, '1500', 'nil', 359, NULL, NULL, NULL, NULL, NULL),
	('Flag [user_modules] add menu print kartu', 1, '1', 'nil', 360, NULL, NULL, NULL, NULL, NULL),
	('Flag [user_modules] add menu cust detil', 1, '1', 'nil', 361, NULL, NULL, NULL, NULL, NULL),
	('Flag [invoice_angkutan] add sektor', 1, '1', 'NIL', 362, NULL, NULL, NULL, NULL, NULL),
	('Flag [add field update_status]', 1, '1', 'NIL', 363, NULL, NULL, NULL, NULL, NULL),
	('Flag [credit_card_type] add vales', 1, '1', 'nil', 364, NULL, NULL, NULL, NULL, NULL),
	('Acc In LIPO 234 Numbering', 11, '!KML~$00001', 'NIL', 365, NULL, NULL, NULL, NULL, NULL),
	('Acc OutLIPO 234 Numbering', 11, '!KKL~$00002', 'NIL', 366, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory Warehouse] add description', 1, '1', 'NIL', 367, NULL, NULL, NULL, NULL, NULL),
	('Flag [org_struct] add table 2', 1, '1', 'NIL', 368, NULL, NULL, NULL, NULL, NULL),
	('Flag [Kendaraan] add merk,bpkb', 1, '1', 'NIL', 369, NULL, NULL, NULL, NULL, NULL),
	('Flag [Wilayah] add kode', 1, '1', 'NIL', 370, NULL, NULL, NULL, NULL, NULL),
	('NextShipToId', 12, '!SHT1~$00008', 'Penomoran untuk kode pengiriman customer', 371, NULL, NULL, NULL, NULL, NULL),
	('AllowChangePrice', 0, 'true', NULL, 372, NULL, NULL, NULL, NULL, NULL),
	('AllowChangeDiscItem', 0, 'true', NULL, 373, NULL, NULL, NULL, NULL, NULL),
	('Flag [payments] change cc charge', 1, '1', 'nil', 374, NULL, NULL, NULL, NULL, NULL),
	('Flag [Recalc Inv Amount]', 1, '1', 'nil', 375, NULL, NULL, NULL, NULL, NULL),
	('allow_cashier_report', 4, 'True', 'nil', 376, NULL, NULL, NULL, NULL, NULL),
	('LockSO_Freight', 0, 'true', NULL, 377, NULL, NULL, NULL, NULL, NULL),
	('LockSO_Tax', 0, 'true', NULL, 378, NULL, NULL, NULL, NULL, NULL),
	('DisplayConfirmWhenPayment', 0, 'false', NULL, 379, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice] add sales_name', 1, '1', 'nil', 380, NULL, NULL, NULL, NULL, NULL),
	('Flag [Promosi_Disc] add outlet', 1, '1', 'nil', 381, NULL, NULL, NULL, NULL, NULL),
	('Flag change [sys_Grid] colstr1', 1, '1', 'NIL', 382, NULL, NULL, NULL, NULL, NULL),
	('Flag change [GL Transactions] ID_Name', 1, '1', 'NIL', 383, NULL, NULL, NULL, NULL, NULL),
	('Flag [Payments] add JenisUangMuka', 1, '1', 'NIL', 384, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory Assembly] add default_cost', 1, '1', 'NIL', 385, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice] add Coa1 s.d Coa5', 1, '1', 'NIL', 386, NULL, NULL, NULL, NULL, NULL),
	('ItemReturBased', 1, '2', 'NIL', 387, NULL, NULL, NULL, NULL, NULL),
	('Flag [Promosi_Disc] add disc_base', 1, '1', 'nil', 388, NULL, NULL, NULL, NULL, NULL),
	('Flag [User] add discount', 1, '1', 'nil', 389, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice] add promosi_code', 1, '1', 'nil', 390, NULL, NULL, NULL, NULL, NULL),
	('Flag [add field update_by]', 1, '1', 'NIL', 391, NULL, NULL, NULL, NULL, NULL),
	('AskGLIDPosting', 5, 'False', 'NIL', 394, NULL, NULL, NULL, NULL, NULL),
	('Acc In Mandiri Numbering', 12, '!BMM.~$00002', 'NIL', 395, NULL, NULL, NULL, NULL, NULL),
	('Acc OutMandiri Numbering', 12, '!BKM.~$00002', 'NIL', 396, NULL, NULL, NULL, NULL, NULL),
	('Invoice DO Other Numbering - AutoNumber', 1, '1', '', 397, NULL, NULL, NULL, NULL, NULL),
	('Invoice DO Other Numbering', 11, '!JDL~$00017', '', 398, NULL, NULL, NULL, NULL, NULL),
	('Invoice DO Other Numbering - Locked', 1, '1', '', 399, NULL, NULL, NULL, NULL, NULL),
	('tmp_no_po', 7, 'JDO0037', '', 400, NULL, NULL, NULL, NULL, NULL),
	('tmp_no_so', 7, 'JDO0037', 'SO00033', 401, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice] add ref do so po', 1, '1', 'NIL', 402, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice Lineitems] add line_order_type', 1, '1', 'nil', 403, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory Categories] add parent_id', 1, '1', 'NIL', 404, NULL, NULL, NULL, NULL, NULL),
	('Flag [Purchase Order Lineitems] add harga jual', 1, '1', 'NIL', 405, NULL, NULL, NULL, NULL, NULL),
	('Flag [Inventory Products] add harga jual', 1, '1', 'NIL', 406, NULL, NULL, NULL, NULL, NULL),
	('Flag [Purchase Order Lineitems] add dept', 1, '1', 'NIL', 407, NULL, NULL, NULL, NULL, NULL),
	('Flag [Purchase Order] add type invoice', 1, '1', 'NIL', 411, NULL, NULL, NULL, NULL, NULL),
	('Flag [Purchase Order Lineitems] add price_margin', 1, '1', 'NIL', 412, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice Lineitems] add disc add', 1, '1', 'nil', 413, NULL, NULL, NULL, NULL, NULL),
	('Flag [customers_other_info] add disc amount', 1, '1', 'nil', 414, NULL, NULL, NULL, NULL, NULL),
	('HideAccountEarningAccount', 5, 'True', '', 415, NULL, NULL, NULL, NULL, NULL),
	('AllowVoucherNonMember', 5, 'True', 'nil', 416, NULL, NULL, NULL, NULL, NULL),
	('Flag [voucher_master] addnew', 1, '1', 'nil', 417, NULL, NULL, NULL, NULL, NULL),
	('MoveToNextCol', 5, 'False', 'NIL', 418, NULL, NULL, NULL, NULL, NULL),
	('InvalidAcc_Jurnal', 0, '1483', 'InvalidAcc_Jurnal', 419, NULL, NULL, NULL, NULL, NULL),
	('InvalidAcc_Jurnal', 0, '1408', 'InvalidAcc_Jurnal', 420, NULL, NULL, NULL, NULL, NULL),
	('IncPoAutoNumWhenEdit', 0, 'true', NULL, 421, NULL, NULL, NULL, NULL, NULL),
	('UnlockChangePriceInvoice', 5, '', '', 422, NULL, NULL, NULL, NULL, NULL),
	('ProtectChangePrice', 5, '', '', 423, NULL, NULL, NULL, NULL, NULL),
	('ProtectChangeDisc', 5, '', '', 424, NULL, NULL, NULL, NULL, NULL),
	('Flag [Payments] add angsur_no_dari', 1, '1', 'NIL', 425, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 426, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 427, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 428, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 429, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 430, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 431, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 432, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 433, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 434, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 435, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 436, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 437, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 438, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 439, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 440, NULL, NULL, NULL, NULL, NULL),
	('Flag CloseDB 2009', 1, '1', NULL, 441, NULL, NULL, NULL, NULL, NULL),
	('Purchase Order Number', 21, '', 'No Comment', 445, NULL, NULL, NULL, NULL, NULL),
	('Retur Jual Numbering', 20, '', 'No Comment', 446, NULL, NULL, NULL, NULL, NULL),
	('Adjustmnet Numbering', 20, '', 'No Comment', 447, NULL, NULL, NULL, NULL, NULL),
	('Other Delivery Numbering', 24, '!DOX~$00016', 'No Comment', 448, NULL, NULL, NULL, NULL, NULL),
	('Retur Pembelian Numbering', 25, '!PR~$00033', 'No Comment', 449, NULL, NULL, NULL, NULL, NULL),
	('Delivery Order Numbering', 24, '!SJ~$00055', 'No Comment', 450, NULL, NULL, NULL, NULL, NULL),
	('Retur Invoice Numbering', 23, '', 'No Comment', 452, NULL, NULL, NULL, NULL, NULL),
	('CRDB PO Numbering', 17, '!CRDB.PO.~@-~$00001', 'No Comment', 453, NULL, NULL, NULL, NULL, NULL),
	('Voucher in Numbering', 20, '', 'No Comment', 454, NULL, NULL, NULL, NULL, NULL),
	('Acc In  Numbering', 17, '', 'No Comment', 455, NULL, NULL, NULL, NULL, NULL),
	('Acc In BCW Numbering', 20, '', 'No Comment', 456, NULL, NULL, NULL, NULL, NULL),
	('Voucher  Numbering', 18, '', 'No Comment', 457, NULL, NULL, NULL, NULL, NULL),
	('Voucher out Numbering', 21, '', 'No Comment', 458, NULL, NULL, NULL, NULL, NULL),
	('Acc Out  Numbering', 18, '', 'No Comment', 460, NULL, NULL, NULL, NULL, NULL),
	('Invoice Kontan Numbering', 24, '!FK~$00003', 'Faktur Jual Kontan', 475, NULL, NULL, NULL, NULL, NULL),
	('', 0, '!TRP~$00001', 'Penerimaan PO', 489, NULL, NULL, NULL, NULL, NULL),
	('PO Receive Numbering', 20, '!TRP~$00038', 'Penerimaan PO', 490, NULL, NULL, NULL, NULL, NULL),
	('SalQtyDec', 9, '2', 'No Comment', 491, NULL, NULL, NULL, NULL, NULL),
	('SalPriDec', 9, '0', 'No Comment', 492, NULL, NULL, NULL, NULL, NULL),
	('InvQtyDec', 9, '2', 'No Comment', 493, NULL, NULL, NULL, NULL, NULL),
	('InvPriDec', 9, '0', 'No Comment', 494, NULL, NULL, NULL, NULL, NULL),
	('PurQtyDec', 9, '2', 'No Comment', 495, NULL, NULL, NULL, NULL, NULL),
	('PurPriDec', 9, '0', 'No Comment', 496, NULL, NULL, NULL, NULL, NULL),
	('DiscRupiah', 10, 'True', 'No Comment', 497, NULL, NULL, NULL, NULL, NULL),
	('UseGiroGantung', 14, '1', 'No Comment', 498, NULL, NULL, NULL, NULL, NULL),
	('AllowPayMinus', 13, '1', 'No Comment', 499, NULL, NULL, NULL, NULL, NULL),
	('CR Debit Numbering', NULL, '!DBSO~@-~$00001', NULL, 500, NULL, NULL, NULL, NULL, NULL),
	('ContactOnSales', NULL, 'Purchasing', NULL, 501, NULL, NULL, NULL, NULL, NULL),
	('Default Invoice Type', NULL, 'Simple', NULL, 502, NULL, NULL, NULL, NULL, NULL),
	('Freight Taxable', NULL, 'True', NULL, 503, NULL, NULL, NULL, NULL, NULL),
	('Other Taxable', NULL, 'True', NULL, 504, NULL, NULL, NULL, NULL, NULL),
	('Undeposited Checks', NULL, 'True', NULL, 505, NULL, NULL, NULL, NULL, NULL),
	('show_kas', NULL, 'True', NULL, 506, NULL, NULL, NULL, NULL, NULL),
	('so_number', 9, '!SO~$00052', 'No Comment', 507, NULL, NULL, NULL, NULL, NULL),
	('faktur_number', 13, '!PJL~$00074', 'No Comment', 508, NULL, NULL, NULL, NULL, NULL),
	('do_number', 9, '!JDO~$0044', 'No Comment', 509, NULL, NULL, NULL, NULL, NULL),
	('konsinyasi_number', 17, '!JKO~$00001', 'No Comment', 510, NULL, NULL, NULL, NULL, NULL),
	('retur_number', 12, '!JRE~$00015', 'No Comment', 511, NULL, NULL, NULL, NULL, NULL),
	('payment_number', 14, '!ARP~$00030', 'No Comment', 512, NULL, NULL, NULL, NULL, NULL),
	('quot_number', 11, '!QUT~$00001', 'No Comment', 513, NULL, NULL, NULL, NULL, NULL),
	('stock_send_number', 17, '!DOX~$00007', 'No Comment', 514, NULL, NULL, NULL, NULL, NULL),
	('credit_memo_number', 18, '!CRDB~@-~$00107', 'No Comment', 515, NULL, NULL, NULL, NULL, NULL),
	('debit_memo_number', 17, '!DBSO~@-~$00001', 'No Comment', 516, NULL, NULL, NULL, NULL, NULL),
	('fakur_pajak_number', 18, '', 'No Comment', 517, NULL, NULL, NULL, NULL, NULL),
	('discount_bertingkat', 19, '1', 'No Comment', 518, NULL, NULL, NULL, NULL, NULL),
	('nama_di_faktur', 14, 'Andri', 'No Comment', 519, NULL, NULL, NULL, NULL, NULL),
	('CR PO Numbering', 15, 'CRPO~$00001', 'No Comment', 520, NULL, NULL, NULL, NULL, NULL),
	('DB PO Numbering', 15, '!DBPO~$00001', 'No Comment', 521, NULL, NULL, NULL, NULL, NULL),
	('Purchase Order Contact', 22, 'Purchasing', 'No Comment', 522, NULL, NULL, NULL, NULL, NULL),
	('POItemDisplay', 13, '0', 'No Comment', 523, NULL, NULL, NULL, NULL, NULL),
	('PO Show Items', 13, '0', 'No Comment', 524, NULL, NULL, NULL, NULL, NULL),
	('Inventory Costing', 17, '0', 'No Comment', 525, NULL, NULL, NULL, NULL, NULL),
	('Perpetual Inventory', 19, '0', 'No Comment', 526, NULL, NULL, NULL, NULL, NULL),
	('Display ShipTos', 15, '0', 'No Comment', 527, NULL, NULL, NULL, NULL, NULL),
	('customer order', 14, '0', 'No Comment', 528, NULL, NULL, NULL, NULL, NULL),
	('InventorySearch', 15, '0', 'No Comment', 529, NULL, NULL, NULL, NULL, NULL),
	('customer numbering', 18, '0', 'No Comment', 530, NULL, NULL, NULL, NULL, NULL),
	('Supplier Numbering', 18, '0', 'No Comment', 531, NULL, NULL, NULL, NULL, NULL),
	('button_position', 15, '0', 'No Comment', 532, NULL, NULL, NULL, NULL, NULL),
	('C01 Invoice Numbering', NULL, '!P-C01~$00006', 'Numbering', 533, NULL, NULL, NULL, NULL, NULL),
	(' Invoice Numbering', NULL, '!P-~$00001', 'Numbering', 534, NULL, NULL, NULL, NULL, NULL),
	('T01 Invoice Numbering', NULL, '!P-T01~$00006', 'Numbering', 535, NULL, NULL, NULL, NULL, NULL),
	('T01 Receive Numbering', NULL, '!R-T01~$00010', 'Numbering', 536, NULL, NULL, NULL, NULL, NULL),
	('C01 Receive Numbering', NULL, '!R-C01~$00010', 'Numbering', 537, NULL, NULL, NULL, NULL, NULL),
	('C01 Delivery Numbering', NULL, '!D-C01~$00009', 'Numbering', 538, NULL, NULL, NULL, NULL, NULL),
	('C01 AR Payment Numbering', NULL, '!ARP-C01~$00006', 'Numbering', 539, NULL, NULL, NULL, NULL, NULL),
	('C01 Adjust Numbering', NULL, '!ADJ-C01~$00004', 'Numbering', 540, NULL, NULL, NULL, NULL, NULL),
	('C01 Pembelian Numbering', NULL, '!FBC01~$00011', 'Numbering', 541, NULL, NULL, NULL, NULL, NULL),
	('C01 AP Payment Numbering', NULL, '!APP-C01~$00006', 'Numbering', 542, NULL, NULL, NULL, NULL, NULL),
	('Flag [Customers] add sc exempt', 1, '1', 'nil', 543, NULL, NULL, NULL, NULL, NULL),
	('Flag [Invoice lineitems] change field type', 1, '1', 'nil', 544, NULL, NULL, NULL, NULL, NULL),
	('Purchase Invoice Numbering', NULL, '!PI~$00022', 'Numbering', 545, NULL, NULL, NULL, NULL, NULL),
	('Retur Pembelian Numbering', NULL, '!PR~$00033', 'Numbering', 546, NULL, NULL, NULL, NULL, NULL),
	('Delivery Order Numbering', NULL, '!SJ~$00055', 'Numbering', 547, NULL, NULL, NULL, NULL, NULL),
	('CrDB Numbering', NULL, '!CRDB~$00010', 'Numbering', 548, NULL, NULL, NULL, NULL, NULL),
	('Other Recievement Numbering', NULL, '!EIN~$00003', 'Numbering', 549, NULL, NULL, NULL, NULL, NULL),
	('Other Receivement Numbering', NULL, '!EIN~$00015', 'Numbering', 550, NULL, NULL, NULL, NULL, NULL),
	('Cash In Numbering', NULL, '!KM~$00006', 'auto', 551, NULL, NULL, NULL, NULL, NULL),
	('Cash In Numbering', NULL, '!KM~$00006', 'Numbering', 552, NULL, NULL, NULL, NULL, NULL),
	('Sales Online Numbering', NULL, '!1~$00046', 'auto', 886, NULL, NULL, NULL, NULL, NULL),
	('Customer Number', NULL, '$00023~!LS~#YY~#MM', 'auto', 555, NULL, NULL, NULL, NULL, NULL),
	('AppMaster Numbering', NULL, '!SPK~$00049', 'auto', 557, NULL, NULL, NULL, NULL, NULL),
	('AppMaster Numbering', NULL, '!SPK~$00049', 'Numbering', 558, NULL, NULL, NULL, NULL, NULL),
	('COA Retur Penjualan', NULL, '1416', 'auto', 559, NULL, NULL, NULL, NULL, NULL),
	('COA Item Out Others', NULL, '1489', 'auto', 560, NULL, NULL, NULL, NULL, NULL),
	('COA Item In Others', NULL, '1489', 'auto', 561, NULL, NULL, NULL, NULL, NULL),
	('COA Item Adjustment', NULL, '1489', 'auto', 562, NULL, NULL, NULL, NULL, NULL),
	('CoaChargeCreditCard', NULL, '1491', 'auto', 563, NULL, NULL, NULL, NULL, NULL),
	('CoaPromo', NULL, '1424', 'auto', 564, NULL, NULL, NULL, NULL, NULL),
	('CoaGift', NULL, '1424', 'auto', 565, NULL, NULL, NULL, NULL, NULL),
	('admin', NULL, '100000', 'auto', 566, NULL, NULL, NULL, NULL, NULL),
	('lookup.status_po_request', NULL, 'OPEN', 'OPEN', 906, NULL, NULL, NULL, NULL, NULL),
	('lookup.status_po_request', NULL, 'APPROVED', 'APPROVED', 907, NULL, NULL, NULL, NULL, NULL),
	('lookup.status_po_request', NULL, 'CANCEL', 'CANCEL', 908, NULL, NULL, NULL, NULL, NULL),
	('lookup.status_po_request', NULL, 'PENDING', 'PENDING', 909, NULL, NULL, NULL, NULL, NULL),
	('lookup.status_project', NULL, 'OPEN', 'OPEN', 910, NULL, NULL, NULL, NULL, NULL),
	('lookup.status_project', NULL, 'FINISH', 'FINISH', 911, NULL, NULL, NULL, NULL, NULL),
	('folder_images', NULL, 'tmp', 'auto', 893, NULL, NULL, NULL, NULL, NULL),
	('slidder1', NULL, 'images/slidder1.jpg', 'auto', 888, NULL, NULL, NULL, NULL, NULL),
	('Receive Product Numbering', NULL, '!RPRD~$00006', 'Numbering', 881, NULL, NULL, NULL, NULL, NULL),
	('Receive Product Numbering', NULL, '!RPRD~$00006', 'auto', 880, NULL, NULL, NULL, NULL, NULL),
	('Work Exec Numbering', NULL, '!WOE~$00010', 'Numbering', 877, NULL, NULL, NULL, NULL, NULL),
	('col_macet', NULL, '14', 'auto', 871, NULL, NULL, NULL, NULL, NULL),
	('col_lancar', NULL, '0', 'auto', 869, NULL, NULL, NULL, NULL, NULL),
	('col_no_lancar', NULL, '14', 'auto', 870, NULL, NULL, NULL, NULL, NULL),
	('Cash Trx Numbering', NULL, '', 'auto', 867, NULL, NULL, NULL, NULL, NULL),
	('Sales CrDB Numbering', NULL, '!CRDBS~$00007', 'auto', 863, NULL, NULL, NULL, NULL, NULL),
	('GL Numbering', NULL, '!GL~$00007', 'Numbering', 860, NULL, NULL, NULL, NULL, NULL),
	('Adjust Numbering', NULL, '!ADJ~$00010', 'Numbering', 858, NULL, NULL, NULL, NULL, NULL),
	('Adjust Numbering', NULL, '!ADJ~$00010', 'auto', 857, NULL, NULL, NULL, NULL, NULL),
	('COA Pendapatan DP', NULL, '1502', 'auto', 855, NULL, NULL, NULL, NULL, NULL),
	('COA Pendapatan Denda', NULL, '1503', 'auto', 854, NULL, NULL, NULL, NULL, NULL),
	('COA Pendapatan Admin', NULL, '1501', 'auto', 853, NULL, NULL, NULL, NULL, NULL),
	('lookup.group_project', NULL, 'JEMBATAN', 'JEMBATAN', 914, NULL, NULL, NULL, NULL, NULL),
	('slider3', NULL, 'slider31.jpg', 'auto', 891, NULL, NULL, NULL, NULL, NULL),
	('google_ads_visible', NULL, '0', 'auto', 885, NULL, NULL, NULL, NULL, NULL),
	('denda_hari', NULL, '8', 'auto', 875, NULL, NULL, NULL, NULL, NULL),
	('Cash Trx Numbering', NULL, '!KT~$00001', 'Numbering', 868, NULL, NULL, NULL, NULL, NULL),
	('lookup.group_project', NULL, 'JALAN', 'JALAN', 913, NULL, NULL, NULL, NULL, NULL),
	('slider2', NULL, 'slider21.jpg', 'auto', 890, NULL, NULL, NULL, NULL, NULL),
	('Loan Numbering', NULL, '!LN~$00004', 'Numbering', 884, NULL, NULL, NULL, NULL, NULL),
	('denda_prc', NULL, '5', 'auto', 874, NULL, NULL, NULL, NULL, NULL),
	('slider1', NULL, 'slider11.jpg', 'auto', 889, NULL, NULL, NULL, NULL, NULL),
	('Loan Numbering', NULL, '!LN~$00004', 'auto', 883, NULL, NULL, NULL, NULL, NULL),
	('Material Release Numbering', NULL, '!MR~$00015', 'Numbering', 879, NULL, NULL, NULL, NULL, NULL),
	('penalty', NULL, '2', 'auto', 873, NULL, NULL, NULL, NULL, NULL),
	('Cash Out Numbering', NULL, '!KK~$00003', 'Numbering', 866, NULL, NULL, NULL, NULL, NULL),
	('Purchase CrDB Numbering', NULL, '!CRDBP~$00004', 'Numbering', 862, NULL, NULL, NULL, NULL, NULL),
	('COA Persediaan Leasing', NULL, '1504', 'auto', 856, NULL, NULL, NULL, NULL, NULL),
	('themes', NULL, 'standard', 'auto', 882, NULL, NULL, NULL, NULL, NULL),
	('Material Release Numbering', NULL, '!MR~$00015', 'auto', 878, NULL, NULL, NULL, NULL, NULL),
	('hari_telat', NULL, '14', 'auto', 872, NULL, NULL, NULL, NULL, NULL),
	('Cash Out Numbering', NULL, '!KK~$00003', 'auto', 865, NULL, NULL, NULL, NULL, NULL),
	('Purchase CrDB Numbering', NULL, '!CRDBP~$00004', 'auto', 861, NULL, NULL, NULL, NULL, NULL),
	('lookup.group_project', NULL, 'GEDUNG', 'GEDUNG', 912, NULL, NULL, NULL, NULL, NULL),
	('slider4', NULL, 'slider41.jpg', 'auto', 892, NULL, NULL, NULL, NULL, NULL),
	('Sales Online Numbering', NULL, '!1~$00046', 'Numbering', 887, NULL, NULL, NULL, NULL, NULL),
	('Work Exec Numbering', NULL, '!WOE~$00010', 'auto', 876, NULL, NULL, NULL, NULL, NULL),
	('Sales CrDB Numbering', NULL, '!CRDBS~$00007', 'Numbering', 864, NULL, NULL, NULL, NULL, NULL),
	('GL Numbering', NULL, '!GL~$00007', 'auto', 859, NULL, NULL, NULL, NULL, NULL),
	('COA Pendapatan Bunga', NULL, '1500', 'auto', 852, NULL, NULL, NULL, NULL, NULL),
	('COA Pendapatan Leasing', NULL, '1499', 'auto', 851, NULL, NULL, NULL, NULL, NULL),
	('COA Piutang Bunga', NULL, '1498', 'auto', 850, NULL, NULL, NULL, NULL, NULL),
	('Flag [user] add field [branch_code]', NULL, '', 'auto', 915, NULL, NULL, NULL, NULL, NULL),
	('Flag [user] add field [branch_code]', NULL, '1', '', 916, NULL, NULL, NULL, NULL, NULL),
	('Flag [salesman] add field [lock_report]', NULL, '', 'auto', 917, NULL, NULL, NULL, NULL, NULL),
	('Flag [salesman] add field [lock_report]', NULL, '1', '', 918, NULL, NULL, NULL, NULL, NULL),
	('Flag [unit_of_measure] add table', NULL, '', 'auto', 919, NULL, NULL, NULL, NULL, NULL),
	('Flag [unit_of_measure] add table', NULL, '1', '', 920, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory_price_customers] add table', NULL, '', 'auto', 921, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory_price_customers] add table', NULL, '1', '', 922, NULL, NULL, NULL, NULL, NULL),
	('Flag [user_roles] add table', NULL, '', 'auto', 923, NULL, NULL, NULL, NULL, NULL),
	('Flag [user_roles] add table', NULL, '1', '', 924, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory] add field [division]', NULL, '', 'auto', 925, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory] add field [division]', NULL, '1', '', 926, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory_moving] add field [status]', NULL, '', 'auto', 927, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory_moving] add field [status]', NULL, '1', '', 928, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory_moving] add field [verify_by]', NULL, '', 'auto', 929, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory_moving] add field [verify_by]', NULL, '1', '', 930, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory_moving] add field [verify_date]', NULL, '', 'auto', 931, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory_moving] add field [verify_date]', NULL, '1', '', 932, NULL, NULL, NULL, NULL, NULL),
	('Flag [com_list] add table', NULL, '', 'auto', 933, NULL, NULL, NULL, NULL, NULL),
	('Flag [com_list] add table', NULL, '1', '', 934, NULL, NULL, NULL, NULL, NULL),
	('chatbox_visible', NULL, '', 'auto', 935, NULL, NULL, NULL, NULL, NULL),
	('chatbox_visible', NULL, '', 'auto', 936, NULL, NULL, NULL, NULL, NULL),
	('chatbox_visible', NULL, '', 'auto', 937, NULL, NULL, NULL, NULL, NULL),
	('chatbox_visible', NULL, '', 'auto', 938, NULL, NULL, NULL, NULL, NULL),
	('chatbox_visible', NULL, '', 'auto', 939, NULL, NULL, NULL, NULL, NULL),
	('chatbox_visible', NULL, '', 'auto', 940, NULL, NULL, NULL, NULL, NULL),
	('default_cash_account', NULL, NULL, 'auto', 941, NULL, NULL, NULL, NULL, NULL),
	('format_print', NULL, NULL, 'html', 942, NULL, NULL, NULL, NULL, NULL),
	('Flag [inventory_price_customers] add field [disc_p', NULL, '1', '', 55425, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `system_variables` ENABLE KEYS */;


-- Dumping structure for table simak.sys_grid
CREATE TABLE IF NOT EXISTS `sys_grid` (
  `selectionindex` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_time` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `colstr1` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `colstr2` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `colstr3` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `colstr4` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `colstr5` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `colnum1` double DEFAULT NULL,
  `colnum2` double DEFAULT NULL,
  `colnum3` double DEFAULT NULL,
  `colnum4` double DEFAULT NULL,
  `colnum5` double DEFAULT NULL,
  `colnum6` double DEFAULT NULL,
  `colnum7` double DEFAULT NULL,
  `colnum8` double DEFAULT NULL,
  `colnum9` double DEFAULT NULL,
  `colnum10` double DEFAULT NULL,
  `colnum11` double DEFAULT NULL,
  `colnum12` double DEFAULT NULL,
  `colnum13` double DEFAULT NULL,
  `colnum14` double DEFAULT NULL,
  `colnum15` double DEFAULT NULL,
  `colnum16` double DEFAULT NULL,
  `colnum17` double DEFAULT NULL,
  `colnum18` double DEFAULT NULL,
  `colnum19` double DEFAULT NULL,
  `colnum20` double DEFAULT NULL,
  `coldate1` datetime DEFAULT NULL,
  `coldate2` datetime DEFAULT NULL,
  `coldate3` datetime DEFAULT NULL,
  `coldate4` datetime DEFAULT NULL,
  `coldate5` datetime DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`selectionindex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sys_grid: 0 rows
/*!40000 ALTER TABLE `sys_grid` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_grid` ENABLE KEYS */;


-- Dumping structure for table simak.sys_log_run
CREATE TABLE IF NOT EXISTS `sys_log_run` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `param1` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1093 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sys_log_run: 1,092 rows
/*!40000 ALTER TABLE `sys_log_run` DISABLE KEYS */;
REPLACE INTO `sys_log_run` (`id`, `user_id`, `url`, `controller`, `method`, `param1`) VALUES
	(1, 'admin', 'http://localhost/talagasoft/simak/v7.maxon//index.php/welcome_message', NULL, NULL, NULL),
	(2, 'admin', 'http://localhost/talagasoft/simak/v7.maxon//index.php/sales/menu', 'menu', 'load', 'sales'),
	(1092, 'admin', 'http://localhost/talagasoft/simak/v7.maxon//index.php/purchase/purchase_order', 'purchase_order', 'add', NULL);
/*!40000 ALTER TABLE `sys_log_run` ENABLE KEYS */;


-- Dumping structure for table simak.sys_objects
CREATE TABLE IF NOT EXISTS `sys_objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_form` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `user_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `obj_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `obj_index` int(11) DEFAULT NULL,
  `prop_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `prop_value` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `obj_child` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sys_objects: 0 rows
/*!40000 ALTER TABLE `sys_objects` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_objects` ENABLE KEYS */;


-- Dumping structure for table simak.sys_tooltip
CREATE TABLE IF NOT EXISTS `sys_tooltip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `update_by` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `help_key` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `help_desc` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.sys_tooltip: 1 rows
/*!40000 ALTER TABLE `sys_tooltip` DISABLE KEYS */;
REPLACE INTO `sys_tooltip` (`id`, `date_created`, `created_by`, `date_updated`, `update_by`, `help_key`, `help_desc`, `sourceautonumber`, `sourcefile`) VALUES
	(1, NULL, 'administrator', NULL, NULL, 'frmReport.TreeView1', 'Daftar Laporan SIMAK Accounting', NULL, NULL);
/*!40000 ALTER TABLE `sys_tooltip` ENABLE KEYS */;


-- Dumping structure for table simak.tbtreeviewdata
CREATE TABLE IF NOT EXISTS `tbtreeviewdata` (
  `id` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `parentid` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `text` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `image` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `expand` tinyint(1) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table simak.tbtreeviewdata: 10 rows
/*!40000 ALTER TABLE `tbtreeviewdata` DISABLE KEYS */;
REPLACE INTO `tbtreeviewdata` (`id`, `parentid`, `text`, `image`, `expand`, `rank`) VALUES
	('hardware', 'root', 'Hardware', 'Folder.gif', 1, 1),
	('software', 'root', 'Software', 'Folder.gif', 1, 2),
	('ebook', 'root', 'E-books', 'Folder.gif', 1, 4),
	('intel', 'hardware', 'Intel.doc', 'doc.gif', 0, 2),
	('recycle', 'root', 'Recycle', 'xpRecycle.gif', 1, 5),
	('amd', 'software', 'AMD.doc', 'doc.gif', 0, 2),
	('asus', 'hardware', 'Asus.doc', 'doc.gif', 0, 1),
	('windowxp', 'hardware', 'WindowXP.doc', 'doc.gif', 0, 3),
	('linux', 'software', 'Linux.doc', 'doc.gif', 0, 1),
	('macos', '', 'MacOs.doc', 'doc.gif', 0, 1);
/*!40000 ALTER TABLE `tbtreeviewdata` ENABLE KEYS */;


-- Dumping structure for table simak.tb_imageview
CREATE TABLE IF NOT EXISTS `tb_imageview` (
  `ID` int(11) NOT NULL,
  `Small_Image` varchar(30) NOT NULL,
  `Big_Image` varchar(30) NOT NULL,
  `Description` varchar(200) DEFAULT NULL,
  KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.tb_imageview: 6 rows
/*!40000 ALTER TABLE `tb_imageview` DISABLE KEYS */;
REPLACE INTO `tb_imageview` (`ID`, `Small_Image`, `Big_Image`, `Description`) VALUES
	(1, 'small_image1.jpg', 'big_image1.jpg', 'Color of Autumn'),
	(2, 'small_image2.jpg', 'big_image2.jpg', 'Back to Nature'),
	(3, 'small_image3.jpg', 'big_image3.jpg', 'Beauty of Hawaii '),
	(4, 'small_image4.jpg', 'big_image4.jpg', 'Pure'),
	(5, 'small_image5.jpg', 'big_image5.jpg', 'Dream Home'),
	(6, 'small_image6.jpg', 'big_image6.jpg', 'Imazing Nature');
/*!40000 ALTER TABLE `tb_imageview` ENABLE KEYS */;


-- Dumping structure for table simak.tb_slidemenu
CREATE TABLE IF NOT EXISTS `tb_slidemenu` (
  `ID` varchar(15) NOT NULL,
  `ParentID` varchar(15) NOT NULL,
  `IsChild` tinyint(1) NOT NULL,
  `Text` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.tb_slidemenu: 27 rows
/*!40000 ALTER TABLE `tb_slidemenu` DISABLE KEYS */;
REPLACE INTO `tb_slidemenu` (`ID`, `ParentID`, `IsChild`, `Text`) VALUES
	('companyhome', 'root', 0, 'Company Home'),
	('systemtasks', 'root', 0, 'System Tasks'),
	('otherplaces', 'root', 0, 'Other Places'),
	('exploresite', 'root', 0, 'Explore Site'),
	('resources', 'root', 0, 'Resources'),
	('entertainment', 'companyhome', 1, 'Entertainment'),
	('games', 'companyhome', 1, 'Games'),
	('greetingcards', 'companyhome', 1, 'Greeting Cards'),
	('downloads', 'companyhome', 1, 'Downloads'),
	('newcars', 'companyhome', 1, 'New cars'),
	('smartstuff', 'companyhome', 1, 'Smart Stuff'),
	('viewsysteminfo', 'systemtasks', 1, 'View System info'),
	('addprograms', 'systemtasks', 1, 'Add programs'),
	('changesettings', 'systemtasks', 1, 'Change settings'),
	('addusers', 'systemtasks', 1, 'Add Users'),
	('MyNetworkPlaces', 'otherplaces', 1, 'My Network Places'),
	('MyDocuments', 'otherplaces', 1, 'My Documents'),
	('SharedDocuments', 'otherplaces', 1, 'Shared Documents'),
	('ControlPanel', 'otherplaces', 1, 'Control Panel'),
	('careers', 'exploresite', 1, 'Careers'),
	('buytickets', 'exploresite', 1, 'Buy Tickets'),
	('Business', 'exploresite', 1, 'Business'),
	('Enewsletters ', 'resources', 1, 'E-Newsletters '),
	('DiscussionCent', 'resources', 1, 'Discussion Center '),
	('WhitePapers ', 'resources', 1, 'White Papers '),
	('OnlineCourses ', 'resources', 1, 'Online Courses '),
	('OnlineBookLib', 'resources', 1, 'Online Book Library');
/*!40000 ALTER TABLE `tb_slidemenu` ENABLE KEYS */;


-- Dumping structure for table simak.time_card_detail
CREATE TABLE IF NOT EXISTS `time_card_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_no` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `absen_type` int(11) DEFAULT NULL,
  `shift_code` varchar(10) DEFAULT NULL,
  `work_status` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `time_in` varchar(5) DEFAULT NULL,
  `time_out` varchar(5) DEFAULT NULL,
  `time_hour` varchar(5) DEFAULT NULL,
  `ot_in` varchar(5) DEFAULT NULL,
  `ot_out` varchar(5) DEFAULT NULL,
  `ot_hour` varchar(5) DEFAULT NULL,
  `ot_type` varchar(10) DEFAULT NULL,
  `ot_exclude` int(11) DEFAULT NULL,
  `ot_amount` double DEFAULT NULL,
  `tc_1` double DEFAULT NULL,
  `tc_2` double DEFAULT NULL,
  `tc_3` double DEFAULT NULL,
  `tc_4` double DEFAULT NULL,
  `tc_sum` double DEFAULT NULL,
  `tc_run` double DEFAULT NULL,
  `tc_exp` double DEFAULT NULL,
  `free_in` varchar(5) DEFAULT NULL,
  `free_out` varchar(5) DEFAULT NULL,
  `free_hour` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=908 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.time_card_detail: 349 rows
/*!40000 ALTER TABLE `time_card_detail` DISABLE KEYS */;
REPLACE INTO `time_card_detail` (`id`, `salary_no`, `nip`, `absen_type`, `shift_code`, `work_status`, `tanggal`, `time_in`, `time_out`, `time_hour`, `ot_in`, `ot_out`, `ot_hour`, `ot_type`, `ot_exclude`, `ot_amount`, `tc_1`, `tc_2`, `tc_3`, `tc_4`, `tc_sum`, `tc_run`, `tc_exp`, `free_in`, `free_out`, `free_hour`) VALUES
	(1, 0, '121', NULL, NULL, NULL, '2014-04-11 07:00:00', '1', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 0, '122', NULL, NULL, NULL, '2014-04-11 07:00:00', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 0, '122', NULL, NULL, NULL, '2014-04-11 07:00:00', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 0, '512', NULL, NULL, NULL, '2014-04-11 07:00:00', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 0, '121', NULL, NULL, NULL, '2014-04-11 07:00:00', '08:50', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 0, '512', NULL, NULL, NULL, '2014-04-12 07:00:00', '08:50', '15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 0, '121', NULL, NULL, NULL, '2014-04-12 06:17:40', '08:56', '17:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 0, '122', NULL, NULL, NULL, '2014-04-12 06:20:46', '08:51', '17:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 0, '122', NULL, NULL, NULL, '2014-04-12 06:24:21', '', '15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 0, '122', NULL, NULL, NULL, '2014-04-13 06:55:12', '08:00', '18:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 0, '122', NULL, NULL, NULL, '2014-04-13 06:55:12', '08:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 0, '121', NULL, NULL, NULL, '2014-04-13 07:00:33', '09:00', '20:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 0, '512', NULL, NULL, NULL, '2014-04-13 07:00:33', '09:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 0, '342', NULL, NULL, NULL, '2014-05-28 06:03:37', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 0, '122', NULL, NULL, NULL, '2014-05-28 06:06:30', '08:50', '15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, 0, '121', NULL, NULL, NULL, '2014-05-29 17:53:46', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 0, '342', NULL, NULL, NULL, '2014-05-29 17:53:46', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 0, '122', NULL, NULL, NULL, '2014-05-29 17:53:46', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 0, '512', NULL, NULL, NULL, '2014-05-29 17:53:46', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 0, '122', NULL, NULL, NULL, '2014-06-04 17:22:51', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 0, '342', NULL, NULL, NULL, '2014-06-04 17:32:35', '08:00', '17:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 0, 'andri', NULL, NULL, NULL, '2014-12-08 00:00:00', '13:44', '13:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(25, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(26, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:00', '17:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(27, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:26', '17:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(28, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:27', '17:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(29, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(30, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(31, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(32, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:00', '17:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(33, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:26', '17:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(34, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:27', '17:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(35, 0, 'andri', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(36, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(37, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(38, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(39, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:00', '17:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(40, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:26', '17:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(41, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:27', '17:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(42, 0, 'andri', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:27', '17:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(43, 0, 'andri', NULL, NULL, NULL, '2014-12-07 00:00:00', '18:12', '18:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(44, 0, 'andri', NULL, NULL, NULL, '2014-12-08 00:00:00', '13:44', '13:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(45, 0, 'andri', NULL, NULL, NULL, '2014-12-09 00:00:00', '22:58', '22:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(46, 0, 'andri', NULL, NULL, NULL, '2014-12-10 00:00:00', '08:20', '08:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(47, 0, 'SA', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:37', '15:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(48, 0, 'PV', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:38', '14:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(49, 0, 'andri', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:50', '15:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(50, 0, 'mrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:50', '15:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(51, 0, 'BS', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:50', '14:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(52, 0, 'gmbs', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:01', '15:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(53, 0, 'Risk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:10', '15:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(54, 0, 'SV', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:13', '15:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(55, 0, 'GmRisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:30', '15:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(56, 0, 'admls', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:36', '17:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(57, 0, 'col', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:02', '17:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(58, 0, 'andri', NULL, NULL, NULL, '2014-12-16 00:00:00', '22:32', '22:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(59, 0, 'andri', NULL, NULL, NULL, '2014-12-14 00:00:00', '06:51', '06:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(60, 0, 'andri', NULL, NULL, NULL, '2014-12-14 00:00:00', '14:05', '14:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(61, 0, 'andri', NULL, NULL, NULL, '2014-12-14 00:00:00', '16:43', '16:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(62, 0, 'admls', NULL, NULL, NULL, '2014-12-14 00:00:00', '16:43', '16:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(63, 0, 'andri', NULL, NULL, NULL, '2014-12-15 00:00:00', '13:13', '13:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(64, 0, 'admin', NULL, NULL, NULL, '2014-12-15 00:00:00', '21:34', '21:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(65, 0, 'andri', NULL, NULL, NULL, '2014-12-16 00:00:00', '22:32', '22:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(182, 0, 'andri', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(183, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(184, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(185, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:12', '17:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(186, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:00', '17:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(187, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:26', '17:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(188, 0, 'admin', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:27', '17:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(189, 0, 'andri', NULL, NULL, NULL, '2014-12-07 00:00:00', '17:27', '17:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(190, 0, 'andri', NULL, NULL, NULL, '2014-12-07 00:00:00', '18:12', '18:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(191, 0, 'andri', NULL, NULL, NULL, '2014-12-08 00:00:00', '13:44', '13:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(192, 0, 'andri', NULL, NULL, NULL, '2014-12-09 00:00:00', '22:58', '22:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(193, 0, 'andri', NULL, NULL, NULL, '2014-12-10 00:00:00', '08:20', '08:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(194, 0, 'andri', NULL, NULL, NULL, '2014-12-10 00:00:00', '19:58', '19:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(195, 0, 'andri', NULL, NULL, NULL, '2014-12-10 00:00:00', '22:12', '22:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(196, 0, 'sa', NULL, NULL, NULL, '2014-12-10 00:00:00', '22:12', '22:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(197, 0, 'andri', NULL, NULL, NULL, '2014-12-11 00:00:00', '06:42', '06:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(198, 0, 'andri', NULL, NULL, NULL, '2014-12-11 00:00:00', '17:33', '17:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(199, 0, 'sa', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:37', '13:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(200, 0, 'SA', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:37', '13:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(201, 0, 'pv', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:38', '13:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(202, 0, 'PV', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:50', '13:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(203, 0, 'andri', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:50', '13:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(204, 0, 'andri', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:50', '13:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(205, 0, 'mrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:50', '13:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(206, 0, 'mrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:50', '13:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(207, 0, 'bs', NULL, NULL, NULL, '2014-12-12 00:00:00', '13:50', '13:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(208, 0, 'BS', NULL, NULL, NULL, '2014-12-12 00:00:00', '14:04', '14:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(209, 0, 'sa', NULL, NULL, NULL, '2014-12-12 00:00:00', '14:04', '14:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(210, 0, 'SA', NULL, NULL, NULL, '2014-12-12 00:00:00', '14:28', '14:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(211, 0, 'pv', NULL, NULL, NULL, '2014-12-12 00:00:00', '14:29', '14:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(212, 0, 'PV', NULL, NULL, NULL, '2014-12-12 00:00:00', '14:33', '14:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(213, 0, 'sa', NULL, NULL, NULL, '2014-12-12 00:00:00', '14:33', '14:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(214, 0, 'SA', NULL, NULL, NULL, '2014-12-12 00:00:00', '14:34', '14:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(215, 0, 'bs', NULL, NULL, NULL, '2014-12-12 00:00:00', '14:34', '14:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(216, 0, 'BS', NULL, NULL, NULL, '2014-12-12 00:00:00', '14:58', '14:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(217, 0, 'sa', NULL, NULL, NULL, '2014-12-12 00:00:00', '14:58', '14:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(218, 0, 'SA', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:01', '15:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(219, 0, 'gmbs', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:01', '15:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(220, 0, 'gmbs', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:04', '15:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(221, 0, 'sa', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:04', '15:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(222, 0, 'SA', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:07', '15:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(223, 0, 'mrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:07', '15:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(224, 0, 'mrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:08', '15:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(225, 0, 'andri', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:08', '15:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(226, 0, 'andri', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:10', '15:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(227, 0, 'mrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:10', '15:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(228, 0, 'mrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:10', '15:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(229, 0, 'risk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:10', '15:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(230, 0, 'Risk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:13', '15:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(231, 0, 'sv', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:13', '15:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(232, 0, 'SV', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:20', '15:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(233, 0, 'mrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:21', '15:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(234, 0, 'mrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:30', '15:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(235, 0, 'gmrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:30', '15:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(236, 0, 'GmRisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:33', '15:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(237, 0, 'sa', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:33', '15:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(238, 0, 'SA', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:33', '15:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(239, 0, 'gmrisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:33', '15:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(240, 0, 'GmRisk', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:35', '15:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(241, 0, 'admls', NULL, NULL, NULL, '2014-12-12 00:00:00', '15:36', '15:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(242, 0, 'AdmLs', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:02', '17:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(243, 0, 'col', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:02', '17:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(244, 0, 'col', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:06', '17:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(245, 0, 'col', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:06', '17:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(246, 0, 'col', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:07', '17:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(247, 0, 'admls', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:07', '17:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(248, 0, 'AdmLs', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:08', '17:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(249, 0, 'col', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:08', '17:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(250, 0, 'col', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:09', '17:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(251, 0, 'admls', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:09', '17:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(252, 0, 'AdmLs', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:09', '17:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(253, 0, 'col', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:09', '17:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(254, 0, 'col', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:10', '17:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(255, 0, 'admls', NULL, NULL, NULL, '2014-12-12 00:00:00', '17:10', '17:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(256, 0, 'andri', NULL, NULL, NULL, '2014-12-12 00:00:00', '23:17', '23:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(257, 0, 'andri', NULL, NULL, NULL, '2014-12-13 00:00:00', '16:50', '16:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(258, 0, 'andri', NULL, NULL, NULL, '2014-12-13 00:00:00', '22:41', '22:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(259, 0, 'gmbs', NULL, NULL, NULL, '2014-12-13 00:00:00', '22:41', '22:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(260, 0, 'gmbs', NULL, NULL, NULL, '2014-12-13 00:00:00', '22:41', '22:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(261, 0, 'gmbs', NULL, NULL, NULL, '2014-12-13 00:00:00', '22:44', '22:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(262, 0, 'gmbs', NULL, NULL, NULL, '2014-12-13 00:00:00', '22:44', '22:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(263, 0, 'andri', NULL, NULL, NULL, '2014-12-13 00:00:00', '22:44', '22:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(264, 0, 'andri', NULL, NULL, NULL, '2014-12-14 00:00:00', '06:51', '06:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(265, 0, 'andri', NULL, NULL, NULL, '2014-12-14 00:00:00', '14:05', '14:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(266, 0, 'andri', NULL, NULL, NULL, '2014-12-14 00:00:00', '16:43', '16:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(267, 0, 'admls', NULL, NULL, NULL, '2014-12-14 00:00:00', '16:43', '16:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(268, 0, 'andri', NULL, NULL, NULL, '2014-12-15 00:00:00', '13:13', '13:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(269, 0, 'admin', NULL, NULL, NULL, '2014-12-15 00:00:00', '21:34', '21:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(270, 0, 'andri', NULL, NULL, NULL, '2014-12-16 00:00:00', '22:32', '22:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(277, 0, 'andri', NULL, NULL, NULL, '2014-12-17 00:00:00', '09:13', '09:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(278, 0, 'andri', NULL, NULL, NULL, '2014-12-17 00:00:00', '12:08', '12:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(279, 0, 'admin', NULL, NULL, NULL, '2014-12-17 00:00:00', '12:08', '12:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(280, 0, 'admin', NULL, NULL, NULL, '2014-12-17 00:00:00', '12:09', '12:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(281, 0, 'andri', NULL, NULL, NULL, '2014-12-17 00:00:00', '12:09', '12:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(282, 0, 'andri', NULL, NULL, NULL, '2014-12-17 00:00:00', '17:26', '17:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(283, 0, 'admin', NULL, NULL, NULL, '2014-12-17 00:00:00', '17:27', '17:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(284, 0, 'admin', NULL, NULL, NULL, '2014-12-17 00:00:00', '17:27', '17:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(285, 0, 'andri', NULL, NULL, NULL, '2014-12-17 00:00:00', '17:27', '17:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(286, 0, 'andri', NULL, NULL, NULL, '2014-12-17 00:00:00', '23:06', '23:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(287, 0, 'andri', NULL, NULL, NULL, '2014-12-18 00:00:00', '10:57', '10:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(288, 0, 'andri', NULL, NULL, NULL, '2014-12-19 00:00:00', '14:11', '14:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(289, 0, 'andri', NULL, NULL, NULL, '2014-12-22 00:00:00', '08:33', '08:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(290, 0, 'andri', NULL, NULL, NULL, '2014-12-22 00:00:00', '08:34', '08:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(291, 0, 'andri', NULL, NULL, NULL, '2014-12-22 00:00:00', '08:40', '08:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(292, 0, 'andri', NULL, NULL, NULL, '2014-12-22 00:00:00', '08:40', '08:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(293, 0, 'andri', NULL, NULL, NULL, '2014-12-22 00:00:00', '08:47', '08:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(294, 0, 'andri', NULL, NULL, NULL, '2014-12-22 00:00:00', '15:46', '15:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(295, 0, 'andri', NULL, NULL, NULL, '2014-12-24 00:00:00', '17:33', '17:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(296, 0, 'andri', NULL, NULL, NULL, '2014-12-24 00:00:00', '22:29', '22:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(297, 0, 'andri', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:26', '08:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(298, 0, 'andri', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:29', '08:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(299, 0, 'sa', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:29', '08:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(300, 0, 'SA', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:30', '08:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(301, 0, 'risk', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:30', '08:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(302, 0, 'Risk', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:30', '08:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(303, 0, 'gmrisk', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:30', '08:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(304, 0, 'GmRisk', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:31', '08:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(305, 0, 'admls', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:31', '08:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(306, 0, 'AdmLs', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:33', '08:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(307, 0, 'andri', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:33', '08:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(308, 0, 'andri', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:37', '08:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(309, 0, 'sa', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:37', '08:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(310, 0, 'SA', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:52', '08:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(311, 0, 'col', NULL, NULL, NULL, '2014-12-25 00:00:00', '08:52', '08:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(312, 0, 'col', NULL, NULL, NULL, '2014-12-25 00:00:00', '09:08', '09:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(313, 0, 'andri', NULL, NULL, NULL, '2014-12-25 00:00:00', '09:09', '09:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(314, 0, 'andri', NULL, NULL, NULL, '2014-12-25 00:00:00', '16:47', '16:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(315, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '06:39', '06:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(316, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '16:02', '16:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(317, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '16:02', '16:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(318, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '18:18', '18:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(319, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:17', '19:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(320, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:17', '19:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(321, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:26', '19:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(322, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:37', '19:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(323, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:41', '19:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(324, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:43', '19:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(325, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:43', '19:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(326, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:44', '19:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(327, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:44', '19:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(328, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:44', '19:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(329, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:45', '19:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(330, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:45', '19:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(331, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:52', '19:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(332, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:54', '19:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(333, 0, 'andri', NULL, NULL, NULL, '2014-12-26 00:00:00', '19:57', '19:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(334, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:18', '06:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(335, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:18', '06:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(336, 0, 'admin', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:18', '06:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(337, 0, 'admin', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:22', '06:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(338, 0, 'admin', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:22', '06:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(339, 0, 'admin', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:24', '06:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(340, 0, 'gl', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:25', '06:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(341, 0, 'gl', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:25', '06:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(342, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:25', '06:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(343, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:45', '06:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(344, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:50', '06:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(345, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '06:58', '06:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(346, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '07:13', '07:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(347, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '07:21', '07:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(348, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '13:00', '13:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(349, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '13:01', '13:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(350, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '13:28', '13:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(351, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '13:29', '13:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(352, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '17:59', '17:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(353, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '19:38', '19:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(354, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '19:40', '19:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(355, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '19:41', '19:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(356, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '19:42', '19:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(357, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '19:43', '19:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(358, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '19:44', '19:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(359, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '22:55', '22:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(360, 0, 'andri', NULL, NULL, NULL, '2014-12-27 00:00:00', '23:12', '23:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(361, 0, 'andri', NULL, NULL, NULL, '2014-12-28 00:00:00', '22:23', '22:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(362, 0, 'admls', NULL, NULL, NULL, '2014-12-29 00:00:00', '13:15', '13:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(363, 0, 'AdmLs', NULL, NULL, NULL, '2014-12-29 00:00:00', '13:16', '13:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(364, 0, 'col', NULL, NULL, NULL, '2014-12-29 00:00:00', '13:16', '13:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(365, 0, 'col', NULL, NULL, NULL, '2014-12-29 00:00:00', '13:22', '13:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(366, 0, 'andri', NULL, NULL, NULL, '2014-12-29 00:00:00', '13:24', '13:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(367, 0, 'andri', NULL, NULL, NULL, '2014-12-29 00:00:00', '13:34', '13:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(368, 0, 'col', NULL, NULL, NULL, '2014-12-29 00:00:00', '13:34', '13:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(369, 0, 'col', NULL, NULL, NULL, '2014-12-29 00:00:00', '15:13', '15:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(370, 0, 'admls', NULL, NULL, NULL, '2014-12-29 00:00:00', '15:13', '15:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(371, 0, 'AdmLs', NULL, NULL, NULL, '2014-12-29 00:00:00', '16:28', '16:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(372, 0, 'col', NULL, NULL, NULL, '2014-12-29 00:00:00', '16:29', '16:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(373, 0, 'andri', NULL, NULL, NULL, '2014-12-30 00:00:00', '14:37', '14:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(374, 0, 'andri', NULL, NULL, NULL, '2014-12-30 00:00:00', '17:46', '17:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(375, 0, 'andri', NULL, NULL, NULL, '2014-12-30 00:00:00', '21:51', '21:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(376, 0, 'andri', NULL, NULL, NULL, '2014-12-31 00:00:00', '07:56', '07:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(377, 0, 'admin', NULL, NULL, NULL, '2015-01-01 00:00:00', '08:08', '08:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(378, 0, 'admin', NULL, NULL, NULL, '2015-01-01 00:00:00', '08:08', '08:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(379, 0, 'andri', NULL, NULL, NULL, '2015-01-01 00:00:00', '08:08', '08:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(380, 0, 'admin', NULL, NULL, NULL, '2015-01-01 00:00:00', '17:24', '17:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(381, 0, 'admin', NULL, NULL, NULL, '2015-01-01 00:00:00', '17:28', '17:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(382, 0, 'admin', NULL, NULL, NULL, '2015-01-01 00:00:00', '17:28', '17:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(383, 0, 'andri', NULL, NULL, NULL, '2015-01-01 00:00:00', '17:28', '17:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(384, 0, 'andri', NULL, NULL, NULL, '2015-01-02 00:00:00', '07:05', '07:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(385, 0, 'andri', NULL, NULL, NULL, '2015-01-02 00:00:00', '12:30', '12:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(386, 0, 'andri', NULL, NULL, NULL, '2015-01-04 00:00:00', '18:19', '18:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(387, 0, 'andri', NULL, NULL, NULL, '2015-01-05 00:00:00', '07:41', '07:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(388, 0, 'andri', NULL, NULL, NULL, '2015-01-05 00:00:00', '07:41', '07:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(389, 0, 'andri', NULL, NULL, NULL, '2015-01-05 00:00:00', '07:49', '07:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(390, 0, 'andri', NULL, NULL, NULL, '2015-01-05 00:00:00', '17:07', '17:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(391, 0, 'andri', NULL, NULL, NULL, '2015-01-05 00:00:00', '17:36', '17:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(392, 0, 'andri', NULL, NULL, NULL, '2015-01-05 00:00:00', '17:36', '17:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(903, 0, 'SV', NULL, NULL, NULL, '2015-03-05 00:00:00', '10:07', '10:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(902, 0, 'SV', NULL, NULL, NULL, '2015-02-20 00:00:00', '21:09', '21:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(901, 0, 'SV', NULL, NULL, NULL, '2015-01-26 00:00:00', '20:49', '21:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(907, 0, 'SA', NULL, NULL, NULL, '2015-03-06 00:00:00', '11:35', '11:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(899, 0, 'SA', NULL, NULL, NULL, '2015-03-05 00:00:00', '09:44', '16:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(898, 0, 'SA', NULL, NULL, NULL, '2015-02-18 00:00:00', '19:19', '19:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(897, 0, 'SA', NULL, NULL, NULL, '2015-02-06 00:00:00', '14:24', '14:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(896, 0, 'sa', NULL, NULL, NULL, '2015-01-26 00:00:00', '21:10', '21:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(895, 0, 'SA', NULL, NULL, NULL, '2015-01-22 00:00:00', '22:20', '22:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(894, 0, 'Risk', NULL, NULL, NULL, '2015-03-05 00:00:00', '10:33', '10:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(893, 0, 'PV', NULL, NULL, NULL, '2015-03-05 00:00:00', '09:57', '10:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(892, 0, 'PV', NULL, NULL, NULL, '2015-02-06 00:00:00', '14:29', '14:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(891, 0, 'mrisk', NULL, NULL, NULL, '2015-03-05 00:00:00', '10:22', '10:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(890, 0, 'mrisk', NULL, NULL, NULL, '2015-01-26 00:00:00', '20:50', '20:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(889, 0, 'GmRisk', NULL, NULL, NULL, '2015-03-05 00:00:00', '10:31', '10:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(888, 0, 'gmbs', NULL, NULL, NULL, '2015-03-05 00:00:00', '10:13', '10:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(887, 0, 'col', NULL, NULL, NULL, '2015-01-12 00:00:00', '13:31', '13:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(886, 0, 'BS', NULL, NULL, NULL, '2015-03-05 00:00:00', '10:16', '10:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(885, 0, 'BS', NULL, NULL, NULL, '2015-02-10 00:00:00', '15:22', '15:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(884, 0, 'BS', NULL, NULL, NULL, '2015-01-26 00:00:00', '20:36', '20:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(906, 0, 'andri', NULL, NULL, NULL, '2015-03-06 00:00:00', '11:35', '17:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(882, 0, 'andri', NULL, NULL, NULL, '2015-03-05 00:00:00', '07:53', '16:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(881, 0, 'Andri', NULL, NULL, NULL, '2015-03-04 00:00:00', '15:01', '16:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(880, 0, 'andri', NULL, NULL, NULL, '2015-03-02 00:00:00', '08:40', '08:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(879, 0, 'andri', NULL, NULL, NULL, '2015-02-27 00:00:00', '18:26', '18:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(878, 0, 'andri', NULL, NULL, NULL, '2015-02-26 00:00:00', '15:18', '23:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(877, 0, 'andri', NULL, NULL, NULL, '2015-02-24 00:00:00', '09:36', '09:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(876, 0, 'andri', NULL, NULL, NULL, '2015-02-20 00:00:00', '20:54', '21:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(875, 0, 'andri', NULL, NULL, NULL, '2015-02-19 00:00:00', '15:57', '17:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(874, 0, 'andri', NULL, NULL, NULL, '2015-02-18 00:00:00', '19:07', '19:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(873, 0, 'andri', NULL, NULL, NULL, '2015-02-16 00:00:00', '14:22', '14:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(872, 0, 'andri', NULL, NULL, NULL, '2015-02-13 00:00:00', '09:50', '09:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(871, 0, 'andri', NULL, NULL, NULL, '2015-02-12 00:00:00', '15:48', '18:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(870, 0, 'andri', NULL, NULL, NULL, '2015-02-11 00:00:00', '07:08', '15:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(869, 0, 'andri', NULL, NULL, NULL, '2015-02-10 00:00:00', '07:08', '15:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(868, 0, 'andri', NULL, NULL, NULL, '2015-02-09 00:00:00', '12:46', '19:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(867, 0, 'andri', NULL, NULL, NULL, '2015-02-08 00:00:00', '08:21', '08:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(866, 0, 'andri', NULL, NULL, NULL, '2015-02-07 00:00:00', '10:04', '16:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(865, 0, 'andri', NULL, NULL, NULL, '2015-02-06 00:00:00', '07:32', '14:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(864, 0, 'andri', NULL, NULL, NULL, '2015-02-04 00:00:00', '08:03', '19:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(863, 0, 'andri', NULL, NULL, NULL, '2015-02-03 00:00:00', '23:39', '23:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(862, 0, 'andri', NULL, NULL, NULL, '2015-02-01 00:00:00', '10:31', '10:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(861, 0, 'andri', NULL, NULL, NULL, '2015-01-30 00:00:00', '11:51', '11:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(860, 0, 'andri', NULL, NULL, NULL, '2015-01-26 00:00:00', '18:49', '20:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(859, 0, 'andri', NULL, NULL, NULL, '2015-01-24 00:00:00', '23:27', '23:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(858, 0, 'andri', NULL, NULL, NULL, '2015-01-23 00:00:00', '16:27', '23:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(857, 0, 'andri', NULL, NULL, NULL, '2015-01-22 00:00:00', '21:27', '22:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(856, 0, 'andri', NULL, NULL, NULL, '2015-01-21 00:00:00', '06:56', '06:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(855, 0, 'andri', NULL, NULL, NULL, '2015-01-16 00:00:00', '22:53', '22:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(854, 0, 'andri', NULL, NULL, NULL, '2015-01-14 00:00:00', '07:46', '07:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(853, 0, 'andri', NULL, NULL, NULL, '2015-01-13 00:00:00', '00:24', '18:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(852, 0, 'andri', NULL, NULL, NULL, '2015-01-12 00:00:00', '14:23', '16:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(851, 0, 'andri', NULL, NULL, NULL, '2015-01-11 00:00:00', '12:47', '22:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(850, 0, 'andri', NULL, NULL, NULL, '2015-01-10 00:00:00', '06:26', '21:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(849, 0, 'andri', NULL, NULL, NULL, '2015-01-09 00:00:00', '07:54', '22:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(848, 0, 'AdmLs', NULL, NULL, NULL, '2015-03-05 00:00:00', '10:21', '15:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(847, 0, 'AdmLs', NULL, NULL, NULL, '2015-02-11 00:00:00', '14:39', '15:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(846, 0, 'AdmLs', NULL, NULL, NULL, '2015-02-06 00:00:00', '14:35', '14:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(845, 0, 'AdmLs', NULL, NULL, NULL, '2015-01-26 00:00:00', '20:49', '20:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(844, 0, 'AdmLs', NULL, NULL, NULL, '2015-01-12 00:00:00', '13:29', '16:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(843, 0, 'admin', NULL, NULL, NULL, '2015-03-04 00:00:00', '15:01', '15:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(842, 0, 'admin', NULL, NULL, NULL, '2015-02-27 00:00:00', '10:05', '18:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(841, 0, 'admin', NULL, NULL, NULL, '2015-02-26 00:00:00', '15:17', '15:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(840, 0, 'admin', NULL, NULL, NULL, '2015-02-25 00:00:00', '00:21', '00:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(838, 0, 'admin', NULL, NULL, NULL, '2015-02-18 00:00:00', '19:07', '19:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(839, 0, 'admin', NULL, NULL, NULL, '2015-02-20 00:00:00', '18:51', '18:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(837, 0, 'admin', NULL, NULL, NULL, '2015-02-17 00:00:00', '00:43', '22:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(836, 0, 'admin', NULL, NULL, NULL, '2015-02-16 00:00:00', '14:22', '14:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(835, 0, 'admin', NULL, NULL, NULL, '2015-02-15 00:00:00', '07:11', '07:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(827, 0, 'admin', NULL, NULL, NULL, '2015-01-11 00:00:00', '12:44', '22:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(828, 0, 'admin', NULL, NULL, NULL, '2015-01-13 00:00:00', '06:54', '18:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(829, 0, 'admin', NULL, NULL, NULL, '2015-01-14 00:00:00', '15:43', '15:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(830, 0, 'admin', NULL, NULL, NULL, '2015-01-18 00:00:00', '21:11', '21:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(831, 0, 'admin', NULL, NULL, NULL, '2015-02-01 00:00:00', '07:00', '10:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(832, 0, 'admin', NULL, NULL, NULL, '2015-02-04 00:00:00', '08:07', '08:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(833, 0, 'admin', NULL, NULL, NULL, '2015-02-09 00:00:00', '12:46', '12:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(834, 0, 'admin', NULL, NULL, NULL, '2015-02-11 00:00:00', '15:25', '15:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(826, 0, 'admin', NULL, NULL, NULL, '2015-01-10 00:00:00', '16:11', '21:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(825, 0, 'admin', NULL, NULL, NULL, '2015-01-09 00:00:00', '20:26', '22:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `time_card_detail` ENABLE KEYS */;


-- Dumping structure for table simak.trans_type
CREATE TABLE IF NOT EXISTS `trans_type` (
  `type_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `type_inout` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.trans_type: 0 rows
/*!40000 ALTER TABLE `trans_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_type` ENABLE KEYS */;


-- Dumping structure for table simak.trans_typex
CREATE TABLE IF NOT EXISTS `trans_typex` (
  `type_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `type_inout` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.trans_typex: 0 rows
/*!40000 ALTER TABLE `trans_typex` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_typex` ENABLE KEYS */;


-- Dumping structure for table simak.type_of_account
CREATE TABLE IF NOT EXISTS `type_of_account` (
  `type_of_account` varchar(20) CHARACTER SET utf8 NOT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`type_of_account`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.type_of_account: 0 rows
/*!40000 ALTER TABLE `type_of_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_of_account` ENABLE KEYS */;


-- Dumping structure for table simak.type_of_payment
CREATE TABLE IF NOT EXISTS `type_of_payment` (
  `type_of_payment` varchar(50) CHARACTER SET utf8 NOT NULL,
  `discount_percent` double DEFAULT NULL,
  `discount_days` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`type_of_payment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.type_of_payment: 4 rows
/*!40000 ALTER TABLE `type_of_payment` DISABLE KEYS */;
REPLACE INTO `type_of_payment` (`type_of_payment`, `discount_percent`, `discount_days`, `days`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	('Kredit 30 Hari', 0.12, 30, 30, 0, '', ''),
	('Kredit15 hari', 0.15, 0, 15, 0, '', ''),
	('60 Hari', 0, 30, 60, 0, '', ''),
	('KREDIT', 0, 0, 30, 0, '', '');
/*!40000 ALTER TABLE `type_of_payment` ENABLE KEYS */;


-- Dumping structure for table simak.unit_of_measure
CREATE TABLE IF NOT EXISTS `unit_of_measure` (
  `from_unit` varchar(50) DEFAULT NULL,
  `to_unit` varchar(50) DEFAULT NULL,
  `unit_value` double DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.unit_of_measure: 1 rows
/*!40000 ALTER TABLE `unit_of_measure` DISABLE KEYS */;
REPLACE INTO `unit_of_measure` (`from_unit`, `to_unit`, `unit_value`, `id`) VALUES
	('pcs', 'lusin', 12, 1);
/*!40000 ALTER TABLE `unit_of_measure` ENABLE KEYS */;


-- Dumping structure for table simak.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `path_image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `disc_prc_max` double(11,0) DEFAULT NULL,
  `disc_amt_max` double DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `userlevel` varchar(50) DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  `cid` varchar(10) DEFAULT NULL,
  `supervisor` varchar(50) DEFAULT NULL,
  `branch_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.user: 12 rows
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`user_id`, `username`, `password`, `path_image`, `update_status`, `disc_prc_max`, `disc_amt_max`, `email`, `nip`, `userlevel`, `active`, `cid`, `supervisor`, `branch_code`) VALUES
	('admin', 'admin', 'admin', NULL, 0, 0, 0, '', '', '', 0, 'ALL', '', ''),
	('Administrator', 'Administrator', 'admin', 'bayi-lucu-1.jpg', 0, 0, 0, '', '', '', 0, 'C01', '', NULL),
	('andri', 'andri', '1', 'wonfeihung.jpg', 0, 0, 0, '', '', '', 0, 'C01', 'admin', NULL),
	('buyer', 'buyer', '1', '', 0, 0, 0, '', '', '', 0, 'C01', '', NULL),
	('Kasir', 'kasir', '1', 'kasir.gif', 0, 0, 0, '', '', '', 0, 'C01', '', NULL),
	('sales', 'sales', '1', NULL, 0, 0, 0, '', '', '', 0, 'C01', '', ''),
	('Spv', 'Supervisor', '1', '', 0, 0, 0, '', '', '', 0, 'C01', '', NULL),
	('gl', 'Accounting', '11', NULL, 0, 0, 0, '', '', '', 0, 'C01', NULL, NULL),
	('ongkim', 'ongkim', '1', NULL, 0, 0, 0, '', '', '', 0, 'C01', '', 'PST'),
	('gudang', 'gudang', '1', NULL, 0, 0, 0, '', '', '', 0, 'C01', '', ''),
	('finance', 'finance', '1', NULL, 0, 0, 0, '', '', '', 0, 'C01', '', ''),
	('kerawang', 'kerawang', '1', NULL, 0, 0, 0, '', '', '', 0, 'C01', '', 'KRW');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table simak.user_group_modules
CREATE TABLE IF NOT EXISTS `user_group_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `module_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `permission` int(11) DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`group_id`,`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3194 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.user_group_modules: 1,015 rows
/*!40000 ALTER TABLE `user_group_modules` DISABLE KEYS */;
REPLACE INTO `user_group_modules` (`id`, `group_id`, `module_id`, `permission`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(97, 'BYR', '_40110', 0, 1, NULL, NULL),
	(98, 'BYR', '_40120', 0, 1, NULL, NULL),
	(99, 'BYR', '_80010', 0, 1, NULL, NULL),
	(100, 'BYR', '_80020', 0, 1, NULL, NULL),
	(101, 'BYR', '_80030', 0, 1, NULL, NULL),
	(102, 'BYR', '_90070', 0, 1, NULL, NULL),
	(103, 'BYR', '_90071', 0, 1, NULL, NULL),
	(104, 'BYR', '_90072', 0, 1, NULL, NULL),
	(105, 'BYR', '_90073', 0, 1, NULL, NULL),
	(106, 'BYR', '_90075', 0, 1, NULL, NULL),
	(107, 'BYR', '_90076', 0, 1, NULL, NULL),
	(2228, 'Administrator', '_00011', NULL, NULL, NULL, NULL),
	(192, 'SYSMENU', '_10000', 0, NULL, NULL, NULL),
	(193, 'SYSMENU', '_11000', 0, NULL, NULL, NULL),
	(194, 'SYSMENU', '_10060', 0, NULL, NULL, NULL),
	(195, 'SYSMENU', '_30010', 0, 1, NULL, NULL),
	(196, 'SYSMENU', '_30011', 0, 1, NULL, NULL),
	(197, 'SYSMENU', '_30012', 0, 1, NULL, NULL),
	(2227, 'Administrator', '_00010', NULL, NULL, NULL, NULL),
	(307, 'BYR', '_40010', 0, 1, NULL, NULL),
	(308, 'BYR', '_40040', 0, 1, NULL, NULL),
	(309, 'BYR', '_40041', 0, 1, NULL, NULL),
	(310, 'BYR', '_40042', 0, 1, NULL, NULL),
	(311, 'BYR', '_40043', 0, 1, NULL, NULL),
	(312, 'BYR', '_40044', 0, 1, NULL, NULL),
	(313, 'BYR', '_40050', 0, 1, NULL, NULL),
	(314, 'BYR', '_40051', 0, 1, NULL, NULL),
	(315, 'BYR', '_40052', 0, 1, NULL, NULL),
	(316, 'BYR', '_40053', 0, 1, NULL, NULL),
	(372, 'BYR', '_90074', 0, 1, NULL, NULL),
	(373, 'BYR', '_90077', 0, 1, NULL, NULL),
	(374, 'BYR', '_90078', 0, 1, NULL, NULL),
	(375, 'BYR', '_90079', 0, 1, NULL, NULL),
	(376, 'BYR', '_90080', 0, 1, NULL, NULL),
	(377, 'BYR', '_90081', 0, 1, NULL, NULL),
	(378, 'BYR', '_90082', 0, 1, NULL, NULL),
	(379, 'BYR', '_90083', 0, 1, NULL, NULL),
	(380, 'BYR', '_90084', 0, 1, NULL, NULL),
	(381, 'BYR', '_90120', 0, 1, NULL, NULL),
	(382, 'BYR', '_90121', 0, 1, NULL, NULL),
	(383, 'BYR', '_90122', 0, 1, NULL, NULL),
	(384, 'BYR', '_90123', 0, 1, NULL, NULL),
	(385, 'BYR', '_90124', 0, 1, NULL, NULL),
	(386, 'BYR', '_90125', 0, 1, NULL, NULL),
	(387, 'BYR', '_90126', 0, 1, NULL, NULL),
	(388, 'BYR', '_90127', 0, 1, NULL, NULL),
	(389, 'BYR', '_90128', 0, 1, NULL, NULL),
	(390, 'BYR', '_90129', 0, 1, NULL, NULL),
	(391, 'BYR', '_90131', 0, 1, NULL, NULL),
	(392, 'BYR', '_90130', 0, 1, NULL, NULL),
	(393, 'BYR', '_90132', 0, 1, NULL, NULL),
	(3179, 'FIN', '_40090', NULL, NULL, NULL, NULL),
	(3180, 'FIN', '_40091', NULL, NULL, NULL, NULL),
	(2211, 'SPV', '_30000.066', NULL, NULL, NULL, NULL),
	(2210, 'SPV', '_30000.063', NULL, NULL, NULL, NULL),
	(2209, 'SPV', '_30000.059', NULL, NULL, NULL, NULL),
	(2208, 'SPV', '_30000.057', NULL, NULL, NULL, NULL),
	(2207, 'SPV', '_30000.056', NULL, NULL, NULL, NULL),
	(2206, 'SPV', '_30000.054', NULL, NULL, NULL, NULL),
	(2205, 'SPV', '_30000.041', NULL, NULL, NULL, NULL),
	(2204, 'SPV', '_30000.040', NULL, NULL, NULL, NULL),
	(2203, 'SPV', '_30000.039', NULL, NULL, NULL, NULL),
	(2202, 'SPV', '_30000.038', NULL, NULL, NULL, NULL),
	(2201, 'SPV', '_30000.037', NULL, NULL, NULL, NULL),
	(2200, 'SPV', '_30000.036', NULL, NULL, NULL, NULL),
	(2199, 'SPV', '_30000.035', NULL, NULL, NULL, NULL),
	(2198, 'SPV', '_30000.034', NULL, NULL, NULL, NULL),
	(2197, 'SPV', '_30000.032', NULL, NULL, NULL, NULL),
	(2196, 'SPV', '_30000.031', NULL, NULL, NULL, NULL),
	(2195, 'SPV', '_30000.030', NULL, NULL, NULL, NULL),
	(2194, 'SPV', '_30000.029', NULL, NULL, NULL, NULL),
	(2193, 'SPV', '_30000.028', NULL, NULL, NULL, NULL),
	(2192, 'SPV', '_30000.027', NULL, NULL, NULL, NULL),
	(2191, 'SPV', '_30000.026', NULL, NULL, NULL, NULL),
	(2190, 'SPV', '_30000.025', NULL, NULL, NULL, NULL),
	(2189, 'SPV', '_30000.024', NULL, NULL, NULL, NULL),
	(2188, 'SPV', '_30000.023', NULL, NULL, NULL, NULL),
	(2187, 'SPV', '_30000.022', NULL, NULL, NULL, NULL),
	(2186, 'SPV', '_30000.021', NULL, NULL, NULL, NULL),
	(2185, 'SPV', '_30000.020', NULL, NULL, NULL, NULL),
	(2184, 'SPV', '_30000.019', NULL, NULL, NULL, NULL),
	(2183, 'SPV', '_30000.018', NULL, NULL, NULL, NULL),
	(2182, 'SPV', '_30000.014', NULL, NULL, NULL, NULL),
	(2828, 'ADM', '_00011', NULL, NULL, NULL, NULL),
	(2829, 'ADM', '_00012', NULL, NULL, NULL, NULL),
	(2830, 'ADM', '_00013', NULL, NULL, NULL, NULL),
	(2831, 'ADM', '_00020', NULL, NULL, NULL, NULL),
	(2832, 'ADM', '_00021', NULL, NULL, NULL, NULL),
	(2833, 'ADM', '_00022', NULL, NULL, NULL, NULL),
	(2834, 'ADM', '_00023', NULL, NULL, NULL, NULL),
	(2835, 'ADM', '_00050', NULL, NULL, NULL, NULL),
	(2836, 'ADM', '_20000', NULL, NULL, NULL, NULL),
	(2837, 'ADM', '_18000', NULL, NULL, NULL, NULL),
	(2838, 'ADM', '_18000.002', NULL, NULL, NULL, NULL),
	(2839, 'ADM', '_18000.013', NULL, NULL, NULL, NULL),
	(2840, 'ADM', '_18000.100', NULL, NULL, NULL, NULL),
	(2841, 'ADM', '_18000.900', NULL, NULL, NULL, NULL),
	(2842, 'ADM', '_18000.901', NULL, NULL, NULL, NULL),
	(2843, 'ADM', '_30000.0', NULL, NULL, NULL, NULL),
	(2844, 'ADM', '_30000.001', NULL, NULL, NULL, NULL),
	(2845, 'ADM', '_30000.002', NULL, NULL, NULL, NULL),
	(2846, 'ADM', '_30000.003', NULL, NULL, NULL, NULL),
	(2847, 'ADM', '_30000.004', NULL, NULL, NULL, NULL),
	(2848, 'ADM', '_30000.005', NULL, NULL, NULL, NULL),
	(2849, 'ADM', '_30000.006', NULL, NULL, NULL, NULL),
	(2850, 'ADM', '_30000.007', NULL, NULL, NULL, NULL),
	(2851, 'ADM', '_30000.009', NULL, NULL, NULL, NULL),
	(2852, 'ADM', '_30000.012', NULL, NULL, NULL, NULL),
	(2853, 'ADM', '_30000.013', NULL, NULL, NULL, NULL),
	(2854, 'ADM', '_30000.014', NULL, NULL, NULL, NULL),
	(2855, 'ADM', '_30000.015', NULL, NULL, NULL, NULL),
	(2856, 'ADM', '_30000.016', NULL, NULL, NULL, NULL),
	(2857, 'ADM', '_30000.017', NULL, NULL, NULL, NULL),
	(2858, 'ADM', '_30000.018', NULL, NULL, NULL, NULL),
	(2859, 'ADM', '_30000.019', NULL, NULL, NULL, NULL),
	(2860, 'ADM', '_30000.020', NULL, NULL, NULL, NULL),
	(2861, 'ADM', '_30000.021', NULL, NULL, NULL, NULL),
	(2862, 'ADM', '_30000.022', NULL, NULL, NULL, NULL),
	(2863, 'ADM', '_30000.023', NULL, NULL, NULL, NULL),
	(1982, 'PUR', '_80010', NULL, NULL, NULL, NULL),
	(1981, 'PUR', '_80000', NULL, NULL, NULL, NULL),
	(1980, 'PUR', '_40044', NULL, NULL, NULL, NULL),
	(1979, 'PUR', '_40042', NULL, NULL, NULL, NULL),
	(1978, 'PUR', '_40041', NULL, NULL, NULL, NULL),
	(1977, 'PUR', '_40040', NULL, NULL, NULL, NULL),
	(1976, 'PUR', '_40030', NULL, NULL, NULL, NULL),
	(1975, 'PUR', '_40020', NULL, NULL, NULL, NULL),
	(1974, 'PUR', '_40012', NULL, NULL, NULL, NULL),
	(1973, 'PUR', '_40011', NULL, NULL, NULL, NULL),
	(1972, 'PUR', '_40010', NULL, NULL, NULL, NULL),
	(1971, 'PUR', '_40000', NULL, NULL, NULL, NULL),
	(819, 'BYR', 'socustomerEnvelop.rpt', NULL, NULL, NULL, NULL),
	(820, 'BYR', '_10010', NULL, NULL, NULL, NULL),
	(821, 'BYR', '_10020', NULL, NULL, NULL, NULL),
	(822, 'BYR', '_10030', NULL, NULL, NULL, NULL),
	(823, 'BYR', '_10060', NULL, NULL, NULL, NULL),
	(824, 'BYR', '_10064', NULL, NULL, NULL, NULL),
	(825, 'BYR', '_30000.0', NULL, NULL, NULL, NULL),
	(826, 'BYR', '_30010', NULL, NULL, NULL, NULL),
	(827, 'BYR', '_30020', NULL, NULL, NULL, NULL),
	(828, 'BYR', '_30030', NULL, NULL, NULL, NULL),
	(2148, 'INV', '_80100', NULL, NULL, NULL, NULL),
	(2149, 'INV', '_80120', NULL, NULL, NULL, NULL),
	(3115, 'FIN', '_80010.02', NULL, NULL, NULL, NULL),
	(3114, 'FIN', '_80010.01', NULL, NULL, NULL, NULL),
	(3181, 'FIN', '_40092', NULL, NULL, NULL, NULL),
	(3177, 'FIN', '_40081', NULL, NULL, NULL, NULL),
	(3178, 'FIN', '_40082', NULL, NULL, NULL, NULL),
	(1677, 'ANDRI', '_80010.07', NULL, NULL, NULL, NULL),
	(1676, 'ANDRI', '_80010.06', NULL, NULL, NULL, NULL),
	(1675, 'ANDRI', '_80010.05', NULL, NULL, NULL, NULL),
	(1674, 'ANDRI', '_80010.04', NULL, NULL, NULL, NULL),
	(1673, 'ANDRI', '_80010.03', NULL, NULL, NULL, NULL),
	(1672, 'ANDRI', '_80010.02', NULL, NULL, NULL, NULL),
	(1671, 'ANDRI', '_80010.01', NULL, NULL, NULL, NULL),
	(1670, 'ANDRI', '_30170', NULL, NULL, NULL, NULL),
	(1669, 'ANDRI', '_300901', NULL, NULL, NULL, NULL),
	(1668, 'ANDRI', '_300900', NULL, NULL, NULL, NULL),
	(1667, 'ANDRI', '_13000', NULL, NULL, NULL, NULL),
	(1666, 'ANDRI', '_11000', NULL, NULL, NULL, NULL),
	(1665, 'ANDRI', '_10060A', NULL, NULL, NULL, NULL),
	(1664, 'ANDRI', '_00050', NULL, NULL, NULL, NULL),
	(1663, 'ANDRI', '_00040', NULL, NULL, NULL, NULL),
	(1662, 'ANDRI', '_00030', NULL, NULL, NULL, NULL),
	(1661, 'ANDRI', '_00020', NULL, NULL, NULL, NULL),
	(1660, 'ANDRI', '_00010', NULL, NULL, NULL, NULL),
	(1659, 'ANDRI', 'ID_JasaKiriman', NULL, NULL, NULL, NULL),
	(1658, 'ANDRI', 'ID_ExportImport', NULL, NULL, NULL, NULL),
	(1657, 'ANDRI', 'frmMain.Addnew', NULL, NULL, NULL, NULL),
	(1114, 'BYR', '_40000', NULL, NULL, NULL, NULL),
	(1115, 'BYR', '_80000', NULL, NULL, NULL, NULL),
	(1116, 'BYR', '_30000', NULL, NULL, NULL, NULL),
	(1117, 'BYR', '_60000', NULL, NULL, NULL, NULL),
	(2226, 'Administrator', 'ID_JasaKiriman', NULL, NULL, NULL, NULL),
	(2225, 'Administrator', 'ID_ExportImport', NULL, NULL, NULL, NULL),
	(2156, 'SA', '_18000.003', NULL, NULL, NULL, NULL),
	(1680, 'ANDRI', '_10030', NULL, NULL, NULL, NULL),
	(1678, 'ANDRI', '_10010', NULL, NULL, NULL, NULL),
	(1679, 'ANDRI', '_10020', NULL, NULL, NULL, NULL),
	(1848, 'GM', '_18000.015', NULL, NULL, NULL, NULL),
	(2155, 'SA', '_18000.001', NULL, NULL, NULL, NULL),
	(1686, 'VF', '_18000', NULL, NULL, NULL, NULL),
	(1687, 'VF', '_18000.004', NULL, NULL, NULL, NULL),
	(1847, 'GM', '_18000.005', NULL, NULL, NULL, NULL),
	(1846, 'GM', '_18000', NULL, NULL, NULL, NULL),
	(2870, 'ADM', '_30000.030', NULL, NULL, NULL, NULL),
	(2871, 'ADM', '_30000.031', NULL, NULL, NULL, NULL),
	(2864, 'ADM', '_30000.024', NULL, NULL, NULL, NULL),
	(2865, 'ADM', '_30000.025', NULL, NULL, NULL, NULL),
	(2866, 'ADM', '_30000.026', NULL, NULL, NULL, NULL),
	(2867, 'ADM', '_30000.027', NULL, NULL, NULL, NULL),
	(2868, 'ADM', '_30000.028', NULL, NULL, NULL, NULL),
	(2869, 'ADM', '_30000.029', NULL, NULL, NULL, NULL),
	(1822, 'BS', '_18000.005', NULL, NULL, NULL, NULL),
	(1821, 'BS', '_18000', NULL, NULL, NULL, NULL),
	(1857, 'SV', '_18000', NULL, NULL, NULL, NULL),
	(1825, 'MRISK', '_18000', NULL, NULL, NULL, NULL),
	(1826, 'MRISK', '_18000.007', NULL, NULL, NULL, NULL),
	(1827, 'GMRISK', '_18000', NULL, NULL, NULL, NULL),
	(1828, 'GMRISK', '_18000.014', NULL, NULL, NULL, NULL),
	(2164, 'LSADM', '_18000.020', NULL, NULL, NULL, NULL),
	(2229, 'Administrator', '_00012', NULL, NULL, NULL, NULL),
	(2230, 'Administrator', '_00013', NULL, NULL, NULL, NULL),
	(2163, 'LSADM', '_18000.012', NULL, NULL, NULL, NULL),
	(2162, 'LSADM', '_18000.011', NULL, NULL, NULL, NULL),
	(2161, 'LSADM', '_18000.010', NULL, NULL, NULL, NULL),
	(1849, 'GM', '_30000', NULL, NULL, NULL, NULL),
	(1850, 'GM', '_40000', NULL, NULL, NULL, NULL),
	(1851, 'COL', '_18000', NULL, NULL, NULL, NULL),
	(1852, 'COL', '_18000.011', NULL, NULL, NULL, NULL),
	(1853, 'GMBS', '_18000', NULL, NULL, NULL, NULL),
	(1854, 'GMBS', '_18000.015', NULL, NULL, NULL, NULL),
	(1855, 'RS', '_18000', NULL, NULL, NULL, NULL),
	(1856, 'RS', '_18000.006', NULL, NULL, NULL, NULL),
	(2160, 'LSADM', '_18000.008', NULL, NULL, NULL, NULL),
	(2159, 'LSADM', '_18000', NULL, NULL, NULL, NULL),
	(2154, 'SA', '_18000', NULL, NULL, NULL, NULL),
	(2872, 'ADM', '_30000.032', NULL, NULL, NULL, NULL),
	(1957, 'GL', '_10070', NULL, NULL, NULL, NULL),
	(1956, 'GL', '_10069', NULL, NULL, NULL, NULL),
	(1955, 'GL', '_10066', NULL, NULL, NULL, NULL),
	(1954, 'GL', '_10065', NULL, NULL, NULL, NULL),
	(1953, 'GL', '_10064', NULL, NULL, NULL, NULL),
	(1952, 'GL', '_10060', NULL, NULL, NULL, NULL),
	(1951, 'GL', '_10030', NULL, NULL, NULL, NULL),
	(1950, 'GL', '_10020', NULL, NULL, NULL, NULL),
	(1949, 'GL', '_10010', NULL, NULL, NULL, NULL),
	(1948, 'GL', '_10000', NULL, NULL, NULL, NULL),
	(1958, 'GL', '_12000', NULL, NULL, NULL, NULL),
	(2147, 'INV', '_80090', NULL, NULL, NULL, NULL),
	(2146, 'INV', '_80070', NULL, NULL, NULL, NULL),
	(2145, 'INV', '_80060', NULL, NULL, NULL, NULL),
	(2144, 'INV', '_80050', NULL, NULL, NULL, NULL),
	(2143, 'INV', '_80040', NULL, NULL, NULL, NULL),
	(2142, 'INV', '_80030', NULL, NULL, NULL, NULL),
	(2141, 'INV', '_80020', NULL, NULL, NULL, NULL),
	(2140, 'INV', '_80010', NULL, NULL, NULL, NULL),
	(2139, 'INV', '_11000', NULL, NULL, NULL, NULL),
	(1983, 'PUR', '_80011', NULL, NULL, NULL, NULL),
	(1984, 'PUR', '_80012', NULL, NULL, NULL, NULL),
	(3116, 'FIN', '_80010.03', NULL, NULL, NULL, NULL),
	(3117, 'FIN', '_80010.04', NULL, NULL, NULL, NULL),
	(3118, 'FIN', '_80010.05', NULL, NULL, NULL, NULL),
	(3119, 'FIN', '_80010.06', NULL, NULL, NULL, NULL),
	(3120, 'FIN', '_80010.07', NULL, NULL, NULL, NULL),
	(3121, 'FIN', '_14000', NULL, NULL, NULL, NULL),
	(2070, 'TRV', '_21000', NULL, NULL, NULL, NULL),
	(2071, 'TRV', '_21010', NULL, NULL, NULL, NULL),
	(2827, 'ADM', '_00010', NULL, NULL, NULL, NULL),
	(2826, 'ADM', '_00000', NULL, NULL, NULL, NULL),
	(2150, 'INV', '_80130', NULL, NULL, NULL, NULL),
	(2151, 'INV', '_80200', NULL, NULL, NULL, NULL),
	(2152, 'PYR', '_12000', NULL, NULL, NULL, NULL),
	(2153, 'PYR', '_12001', NULL, NULL, NULL, NULL),
	(2157, 'SA', '_18000.011', NULL, NULL, NULL, NULL),
	(2158, 'SA', '_18000.021', NULL, NULL, NULL, NULL),
	(2165, 'LSADM', '_18000.022', NULL, NULL, NULL, NULL),
	(2166, 'admin', '_00010', NULL, NULL, NULL, NULL),
	(2167, 'admin', '_00011', NULL, NULL, NULL, NULL),
	(2168, 'admin', '_00012', NULL, NULL, NULL, NULL),
	(2169, 'admin', '_00013', NULL, NULL, NULL, NULL),
	(2170, 'admin', '_00020', NULL, NULL, NULL, NULL),
	(2171, 'admin', '_00021', NULL, NULL, NULL, NULL),
	(2172, 'admin', '_00022', NULL, NULL, NULL, NULL),
	(2173, 'admin', '_00023', NULL, NULL, NULL, NULL),
	(2174, 'SLS', '_30000', NULL, NULL, NULL, NULL),
	(2175, 'SLS', '_30000.029', NULL, NULL, NULL, NULL),
	(2176, 'SLS', '_30000.030', NULL, NULL, NULL, NULL),
	(2177, 'SLS', '_30000.031', NULL, NULL, NULL, NULL),
	(2178, 'SLS', '_30000.032', NULL, NULL, NULL, NULL),
	(2179, 'SLS', '_30000.033', NULL, NULL, NULL, NULL),
	(2180, 'SLS', '_30000.034', NULL, NULL, NULL, NULL),
	(2181, 'SLS', '_30000.035', NULL, NULL, NULL, NULL),
	(2212, 'SPV', '_30000.100', NULL, NULL, NULL, NULL),
	(2224, 'Administrator', 'frmMain.Addnew', NULL, NULL, NULL, NULL),
	(2223, 'Administrator', '_00000', NULL, NULL, NULL, NULL),
	(2231, 'Administrator', '_00020', NULL, NULL, NULL, NULL),
	(2232, 'Administrator', '_00021', NULL, NULL, NULL, NULL),
	(2233, 'Administrator', '_00022', NULL, NULL, NULL, NULL),
	(2234, 'Administrator', '_00023', NULL, NULL, NULL, NULL),
	(2235, 'Administrator', '_00030', NULL, NULL, NULL, NULL),
	(2236, 'Administrator', '_00031', NULL, NULL, NULL, NULL),
	(2237, 'Administrator', '_00032', NULL, NULL, NULL, NULL),
	(2238, 'Administrator', '_00040', NULL, NULL, NULL, NULL),
	(2239, 'Administrator', '_00041', NULL, NULL, NULL, NULL),
	(2240, 'Administrator', '_00042', NULL, NULL, NULL, NULL),
	(2241, 'Administrator', '_00043', NULL, NULL, NULL, NULL),
	(2242, 'Administrator', '_00050', NULL, NULL, NULL, NULL),
	(2243, 'Administrator', '_10060A', NULL, NULL, NULL, NULL),
	(2244, 'Administrator', '_11000', NULL, NULL, NULL, NULL),
	(2245, 'Administrator', '_11001', NULL, NULL, NULL, NULL),
	(2246, 'Administrator', '_13000', NULL, NULL, NULL, NULL),
	(2247, 'Administrator', '_20000', NULL, NULL, NULL, NULL),
	(2248, 'Administrator', '_300900', NULL, NULL, NULL, NULL),
	(2249, 'Administrator', '_300901', NULL, NULL, NULL, NULL),
	(2250, 'Administrator', '_30170', NULL, NULL, NULL, NULL),
	(2251, 'Administrator', '_80010.01', NULL, NULL, NULL, NULL),
	(2252, 'Administrator', '_80010.02', NULL, NULL, NULL, NULL),
	(2253, 'Administrator', '_80010.03', NULL, NULL, NULL, NULL),
	(2254, 'Administrator', '_80010.04', NULL, NULL, NULL, NULL),
	(2255, 'Administrator', '_80010.05', NULL, NULL, NULL, NULL),
	(2256, 'Administrator', '_80010.06', NULL, NULL, NULL, NULL),
	(2257, 'Administrator', '_80010.07', NULL, NULL, NULL, NULL),
	(2258, 'Administrator', '_10000', NULL, NULL, NULL, NULL),
	(2259, 'Administrator', '_10010', NULL, NULL, NULL, NULL),
	(2260, 'Administrator', '_10011', NULL, NULL, NULL, NULL),
	(2261, 'Administrator', '_10012', NULL, NULL, NULL, NULL),
	(2262, 'Administrator', '_10013', NULL, NULL, NULL, NULL),
	(2263, 'Administrator', '_10015', NULL, NULL, NULL, NULL),
	(2264, 'Administrator', '_10016', NULL, NULL, NULL, NULL),
	(2265, 'Administrator', '_10020', NULL, NULL, NULL, NULL),
	(2266, 'Administrator', '_10021', NULL, NULL, NULL, NULL),
	(2267, 'Administrator', '_10030', NULL, NULL, NULL, NULL),
	(2268, 'Administrator', '_10031', NULL, NULL, NULL, NULL),
	(2269, 'Administrator', '_10032', NULL, NULL, NULL, NULL),
	(2270, 'Administrator', '_10035', NULL, NULL, NULL, NULL),
	(2271, 'Administrator', '_10036', NULL, NULL, NULL, NULL),
	(2272, 'Administrator', '_10060', NULL, NULL, NULL, NULL),
	(2273, 'Administrator', '_10061', NULL, NULL, NULL, NULL),
	(2274, 'Administrator', '_10062', NULL, NULL, NULL, NULL),
	(2275, 'Administrator', '_10063', NULL, NULL, NULL, NULL),
	(2276, 'Administrator', '_10064', NULL, NULL, NULL, NULL),
	(2277, 'Administrator', '_10065', NULL, NULL, NULL, NULL),
	(2278, 'Administrator', '_10066', NULL, NULL, NULL, NULL),
	(2279, 'Administrator', '_10067', NULL, NULL, NULL, NULL),
	(2280, 'Administrator', '_10068', NULL, NULL, NULL, NULL),
	(2281, 'Administrator', '_10069', NULL, NULL, NULL, NULL),
	(2282, 'Administrator', '_10070', NULL, NULL, NULL, NULL),
	(2283, 'Administrator', '_12000', NULL, NULL, NULL, NULL),
	(2284, 'Administrator', '_12001', NULL, NULL, NULL, NULL),
	(2285, 'Administrator', '_18000', NULL, NULL, NULL, NULL),
	(2286, 'Administrator', '_18000.001', NULL, NULL, NULL, NULL),
	(2287, 'Administrator', '_18000.002', NULL, NULL, NULL, NULL),
	(2288, 'Administrator', '_18000.003', NULL, NULL, NULL, NULL),
	(2289, 'Administrator', '_18000.004', NULL, NULL, NULL, NULL),
	(2290, 'Administrator', '_18000.005', NULL, NULL, NULL, NULL),
	(2291, 'Administrator', '_18000.006', NULL, NULL, NULL, NULL),
	(2292, 'Administrator', '_18000.007', NULL, NULL, NULL, NULL),
	(2293, 'Administrator', '_18000.008', NULL, NULL, NULL, NULL),
	(2294, 'Administrator', '_18000.009', NULL, NULL, NULL, NULL),
	(2295, 'Administrator', '_18000.010', NULL, NULL, NULL, NULL),
	(2296, 'Administrator', '_18000.011', NULL, NULL, NULL, NULL),
	(2297, 'Administrator', '_18000.012', NULL, NULL, NULL, NULL),
	(2298, 'Administrator', '_18000.013', NULL, NULL, NULL, NULL),
	(2299, 'Administrator', '_18000.014', NULL, NULL, NULL, NULL),
	(2300, 'Administrator', '_18000.015', NULL, NULL, NULL, NULL),
	(2301, 'Administrator', '_18000.020', NULL, NULL, NULL, NULL),
	(2302, 'Administrator', '_18000.021', NULL, NULL, NULL, NULL),
	(2303, 'Administrator', '_18000.022', NULL, NULL, NULL, NULL),
	(2304, 'Administrator', '_18000.100', NULL, NULL, NULL, NULL),
	(2305, 'Administrator', '_18000.900', NULL, NULL, NULL, NULL),
	(2306, 'Administrator', '_18000.901', NULL, NULL, NULL, NULL),
	(2307, 'Administrator', '_21000', NULL, NULL, NULL, NULL),
	(2308, 'Administrator', '_21010', NULL, NULL, NULL, NULL),
	(2309, 'Administrator', '_30000', NULL, NULL, NULL, NULL),
	(2310, 'Administrator', '_30000.0', NULL, NULL, NULL, NULL),
	(2311, 'Administrator', '_30000.001', NULL, NULL, NULL, NULL),
	(2312, 'Administrator', '_30000.002', NULL, NULL, NULL, NULL),
	(2313, 'Administrator', '_30000.003', NULL, NULL, NULL, NULL),
	(2314, 'Administrator', '_30000.004', NULL, NULL, NULL, NULL),
	(2315, 'Administrator', '_30000.005', NULL, NULL, NULL, NULL),
	(2316, 'Administrator', '_30000.006', NULL, NULL, NULL, NULL),
	(2317, 'Administrator', '_30000.007', NULL, NULL, NULL, NULL),
	(2318, 'Administrator', '_30000.008', NULL, NULL, NULL, NULL),
	(2319, 'Administrator', '_30000.009', NULL, NULL, NULL, NULL),
	(2320, 'Administrator', '_30000.010', NULL, NULL, NULL, NULL),
	(2321, 'Administrator', '_30000.011', NULL, NULL, NULL, NULL),
	(2322, 'Administrator', '_30000.012', NULL, NULL, NULL, NULL),
	(2323, 'Administrator', '_30000.013', NULL, NULL, NULL, NULL),
	(2324, 'Administrator', '_30000.014', NULL, NULL, NULL, NULL),
	(2325, 'Administrator', '_30000.015', NULL, NULL, NULL, NULL),
	(2326, 'Administrator', '_30000.016', NULL, NULL, NULL, NULL),
	(2327, 'Administrator', '_30000.017', NULL, NULL, NULL, NULL),
	(2328, 'Administrator', '_30000.018', NULL, NULL, NULL, NULL),
	(2329, 'Administrator', '_30000.019', NULL, NULL, NULL, NULL),
	(2330, 'Administrator', '_30000.020', NULL, NULL, NULL, NULL),
	(2331, 'Administrator', '_30000.021', NULL, NULL, NULL, NULL),
	(2332, 'Administrator', '_30000.022', NULL, NULL, NULL, NULL),
	(2333, 'Administrator', '_30000.023', NULL, NULL, NULL, NULL),
	(2334, 'Administrator', '_30000.024', NULL, NULL, NULL, NULL),
	(2335, 'Administrator', '_30000.025', NULL, NULL, NULL, NULL),
	(2336, 'Administrator', '_30000.026', NULL, NULL, NULL, NULL),
	(2337, 'Administrator', '_30000.027', NULL, NULL, NULL, NULL),
	(2338, 'Administrator', '_30000.028', NULL, NULL, NULL, NULL),
	(2339, 'Administrator', '_30000.029', NULL, NULL, NULL, NULL),
	(2340, 'Administrator', '_30000.030', NULL, NULL, NULL, NULL),
	(2341, 'Administrator', '_30000.031', NULL, NULL, NULL, NULL),
	(2342, 'Administrator', '_30000.032', NULL, NULL, NULL, NULL),
	(2343, 'Administrator', '_30000.033', NULL, NULL, NULL, NULL),
	(2344, 'Administrator', '_30000.034', NULL, NULL, NULL, NULL),
	(2345, 'Administrator', '_30000.035', NULL, NULL, NULL, NULL),
	(2346, 'Administrator', '_30000.036', NULL, NULL, NULL, NULL),
	(2347, 'Administrator', '_30000.037', NULL, NULL, NULL, NULL),
	(2348, 'Administrator', '_30000.038', NULL, NULL, NULL, NULL),
	(2349, 'Administrator', '_30000.039', NULL, NULL, NULL, NULL),
	(2350, 'Administrator', '_30000.040', NULL, NULL, NULL, NULL),
	(2351, 'Administrator', '_30000.041', NULL, NULL, NULL, NULL),
	(2352, 'Administrator', '_30000.050', NULL, NULL, NULL, NULL),
	(2353, 'Administrator', '_30000.051', NULL, NULL, NULL, NULL),
	(2354, 'Administrator', '_30000.052', NULL, NULL, NULL, NULL),
	(2355, 'Administrator', '_30000.053', NULL, NULL, NULL, NULL),
	(2356, 'Administrator', '_30000.054', NULL, NULL, NULL, NULL),
	(2357, 'Administrator', '_30000.055', NULL, NULL, NULL, NULL),
	(2358, 'Administrator', '_30000.056', NULL, NULL, NULL, NULL),
	(2359, 'Administrator', '_30000.057', NULL, NULL, NULL, NULL),
	(2360, 'Administrator', '_30000.058', NULL, NULL, NULL, NULL),
	(2361, 'Administrator', '_30000.059', NULL, NULL, NULL, NULL),
	(2362, 'Administrator', '_30000.060', NULL, NULL, NULL, NULL),
	(2363, 'Administrator', '_30000.061', NULL, NULL, NULL, NULL),
	(2364, 'Administrator', '_30000.062', NULL, NULL, NULL, NULL),
	(2365, 'Administrator', '_30000.063', NULL, NULL, NULL, NULL),
	(2366, 'Administrator', '_30000.064', NULL, NULL, NULL, NULL),
	(2367, 'Administrator', '_30000.065', NULL, NULL, NULL, NULL),
	(2368, 'Administrator', '_30000.066', NULL, NULL, NULL, NULL),
	(2369, 'Administrator', '_30000.067', NULL, NULL, NULL, NULL),
	(2370, 'Administrator', '_30000.068', NULL, NULL, NULL, NULL),
	(2371, 'Administrator', '_30000.100', NULL, NULL, NULL, NULL),
	(2372, 'Administrator', '_30010', NULL, NULL, NULL, NULL),
	(2373, 'Administrator', 'frmCustomers.cmdSaveShipTo', NULL, NULL, NULL, NULL),
	(2374, 'Administrator', '_30011', NULL, NULL, NULL, NULL),
	(2375, 'Administrator', '_30012', NULL, NULL, NULL, NULL),
	(2376, 'Administrator', '_30013', NULL, NULL, NULL, NULL),
	(2377, 'Administrator', '_30020', NULL, NULL, NULL, NULL),
	(2378, 'Administrator', '_30030', NULL, NULL, NULL, NULL),
	(2379, 'Administrator', '_30031', NULL, NULL, NULL, NULL),
	(2380, 'Administrator', '_30033', NULL, NULL, NULL, NULL),
	(2381, 'Administrator', '_30040', NULL, NULL, NULL, NULL),
	(2382, 'Administrator', '_30041', NULL, NULL, NULL, NULL),
	(2383, 'Administrator', '_30042', NULL, NULL, NULL, NULL),
	(2384, 'Administrator', '_30050', NULL, NULL, NULL, NULL),
	(2385, 'Administrator', '_30051', NULL, NULL, NULL, NULL),
	(2386, 'Administrator', '_30052', NULL, NULL, NULL, NULL),
	(2387, 'Administrator', '_30053', NULL, NULL, NULL, NULL),
	(2388, 'Administrator', '_30054', NULL, NULL, NULL, NULL),
	(2389, 'Administrator', '_30055', NULL, NULL, NULL, NULL),
	(2390, 'Administrator', '_30060', NULL, NULL, NULL, NULL),
	(2391, 'Administrator', '_30061', NULL, NULL, NULL, NULL),
	(2392, 'Administrator', '_30062', NULL, NULL, NULL, NULL),
	(2393, 'Administrator', '_30063', NULL, NULL, NULL, NULL),
	(2394, 'Administrator', '_30064', NULL, NULL, NULL, NULL),
	(2395, 'Administrator', '_30070', NULL, NULL, NULL, NULL),
	(2396, 'Administrator', '_30071', NULL, NULL, NULL, NULL),
	(2397, 'Administrator', '_30072', NULL, NULL, NULL, NULL),
	(2398, 'Administrator', '_30073', NULL, NULL, NULL, NULL),
	(2399, 'Administrator', '_30074', NULL, NULL, NULL, NULL),
	(2400, 'Administrator', '_30075', NULL, NULL, NULL, NULL),
	(2401, 'Administrator', '_30080', NULL, NULL, NULL, NULL),
	(2402, 'Administrator', '_30081', NULL, NULL, NULL, NULL),
	(2403, 'Administrator', '_30090', NULL, NULL, NULL, NULL),
	(2404, 'Administrator', '_30091', NULL, NULL, NULL, NULL),
	(2405, 'Administrator', '_30092', NULL, NULL, NULL, NULL),
	(2406, 'Administrator', '_30093', NULL, NULL, NULL, NULL),
	(2407, 'Administrator', '_30094', NULL, NULL, NULL, NULL),
	(2408, 'Administrator', '_30095', NULL, NULL, NULL, NULL),
	(2409, 'Administrator', '_30100', NULL, NULL, NULL, NULL),
	(2410, 'Administrator', '_30121', NULL, NULL, NULL, NULL),
	(2411, 'Administrator', '_30131', NULL, NULL, NULL, NULL),
	(2412, 'Administrator', '_30141', NULL, NULL, NULL, NULL),
	(2413, 'Administrator', '_30110', NULL, NULL, NULL, NULL),
	(2414, 'Administrator', '_30112', NULL, NULL, NULL, NULL),
	(2415, 'Administrator', '_30120', NULL, NULL, NULL, NULL),
	(2416, 'Administrator', '_30122', NULL, NULL, NULL, NULL),
	(2417, 'Administrator', '_30123', NULL, NULL, NULL, NULL),
	(2418, 'Administrator', '_30124', NULL, NULL, NULL, NULL),
	(2419, 'Administrator', '_30125', NULL, NULL, NULL, NULL),
	(2420, 'Administrator', '_30130', NULL, NULL, NULL, NULL),
	(2421, 'Administrator', '_30132', NULL, NULL, NULL, NULL),
	(2422, 'Administrator', '_30133', NULL, NULL, NULL, NULL),
	(2423, 'Administrator', '_30134', NULL, NULL, NULL, NULL),
	(2424, 'Administrator', '_30135', NULL, NULL, NULL, NULL),
	(2425, 'Administrator', '_30140', NULL, NULL, NULL, NULL),
	(2426, 'Administrator', '_30142', NULL, NULL, NULL, NULL),
	(2427, 'Administrator', '_30143', NULL, NULL, NULL, NULL),
	(2428, 'Administrator', '_30150', NULL, NULL, NULL, NULL),
	(2429, 'Administrator', '_30151', NULL, NULL, NULL, NULL),
	(2430, 'Administrator', '_30160', NULL, NULL, NULL, NULL),
	(2431, 'Administrator', '_30161', NULL, NULL, NULL, NULL),
	(2432, 'Administrator', '_30162', NULL, NULL, NULL, NULL),
	(2433, 'Administrator', '_30163', NULL, NULL, NULL, NULL),
	(2434, 'Administrator', '_30164', NULL, NULL, NULL, NULL),
	(2435, 'Administrator', '_30165', NULL, NULL, NULL, NULL),
	(2436, 'Administrator', '_40000', NULL, NULL, NULL, NULL),
	(2437, 'Administrator', '_40010', NULL, NULL, NULL, NULL),
	(2438, 'Administrator', '_40011', NULL, NULL, NULL, NULL),
	(2439, 'Administrator', '_40012', NULL, NULL, NULL, NULL),
	(2440, 'Administrator', '_40013', NULL, NULL, NULL, NULL),
	(2441, 'Administrator', '_40020', NULL, NULL, NULL, NULL),
	(2442, 'Administrator', '_40021', NULL, NULL, NULL, NULL),
	(2443, 'Administrator', '_40023', NULL, NULL, NULL, NULL),
	(2444, 'Administrator', '_40030', NULL, NULL, NULL, NULL),
	(2445, 'Administrator', '_40031', NULL, NULL, NULL, NULL),
	(2446, 'Administrator', '_40033', NULL, NULL, NULL, NULL),
	(2447, 'Administrator', '_40040', NULL, NULL, NULL, NULL),
	(2448, 'Administrator', '_40041', NULL, NULL, NULL, NULL),
	(2449, 'Administrator', '_40042', NULL, NULL, NULL, NULL),
	(2450, 'Administrator', '_40043', NULL, NULL, NULL, NULL),
	(2451, 'Administrator', '_40044', NULL, NULL, NULL, NULL),
	(2452, 'Administrator', '_40045', NULL, NULL, NULL, NULL),
	(2453, 'Administrator', '_40046', NULL, NULL, NULL, NULL),
	(2454, 'Administrator', '_40047', NULL, NULL, NULL, NULL),
	(2455, 'Administrator', '_40048', NULL, NULL, NULL, NULL),
	(2456, 'Administrator', '_40049', NULL, NULL, NULL, NULL),
	(2457, 'Administrator', '_40050', NULL, NULL, NULL, NULL),
	(2458, 'Administrator', '_40051', NULL, NULL, NULL, NULL),
	(2459, 'Administrator', '_40052', NULL, NULL, NULL, NULL),
	(2460, 'Administrator', '_40053', NULL, NULL, NULL, NULL),
	(2461, 'Administrator', '_40054', NULL, NULL, NULL, NULL),
	(2462, 'Administrator', '_40055', NULL, NULL, NULL, NULL),
	(2463, 'Administrator', '_40131', NULL, NULL, NULL, NULL),
	(2464, 'Administrator', '_40132', NULL, NULL, NULL, NULL),
	(2465, 'Administrator', '_40134', NULL, NULL, NULL, NULL),
	(2466, 'Administrator', '_40135', NULL, NULL, NULL, NULL),
	(2467, 'Administrator', '_40136', NULL, NULL, NULL, NULL),
	(2468, 'Administrator', '_40060', NULL, NULL, NULL, NULL),
	(2469, 'Administrator', '_40061', NULL, NULL, NULL, NULL),
	(2470, 'Administrator', '_40062', NULL, NULL, NULL, NULL),
	(2471, 'Administrator', '_40063', NULL, NULL, NULL, NULL),
	(2472, 'Administrator', '_40064', NULL, NULL, NULL, NULL),
	(2473, 'Administrator', '_40065', NULL, NULL, NULL, NULL),
	(2474, 'Administrator', '_40070', NULL, NULL, NULL, NULL),
	(2475, 'Administrator', '_40071', NULL, NULL, NULL, NULL),
	(2476, 'Administrator', '_40080', NULL, NULL, NULL, NULL),
	(2477, 'Administrator', '_40081', NULL, NULL, NULL, NULL),
	(2478, 'Administrator', '_40082', NULL, NULL, NULL, NULL),
	(2479, 'Administrator', '_40083', NULL, NULL, NULL, NULL),
	(2480, 'Administrator', '_40084', NULL, NULL, NULL, NULL),
	(2481, 'Administrator', '_40085', NULL, NULL, NULL, NULL),
	(2482, 'Administrator', '_40090', NULL, NULL, NULL, NULL),
	(2483, 'Administrator', '_40091', NULL, NULL, NULL, NULL),
	(2484, 'Administrator', '_40092', NULL, NULL, NULL, NULL),
	(2485, 'Administrator', '_40093', NULL, NULL, NULL, NULL),
	(2486, 'Administrator', '_40094', NULL, NULL, NULL, NULL),
	(2487, 'Administrator', '_40095', NULL, NULL, NULL, NULL),
	(2488, 'Administrator', '_40100', NULL, NULL, NULL, NULL),
	(2489, 'Administrator', '_40101', NULL, NULL, NULL, NULL),
	(2490, 'Administrator', '_40102', NULL, NULL, NULL, NULL),
	(2491, 'Administrator', '_40103', NULL, NULL, NULL, NULL),
	(2492, 'Administrator', '_40104', NULL, NULL, NULL, NULL),
	(2493, 'Administrator', '_40105', NULL, NULL, NULL, NULL),
	(2494, 'Administrator', '_40110', NULL, NULL, NULL, NULL),
	(2495, 'Administrator', '_40113', NULL, NULL, NULL, NULL),
	(2496, 'Administrator', '_40114', NULL, NULL, NULL, NULL),
	(2497, 'Administrator', '_40115', NULL, NULL, NULL, NULL),
	(2498, 'Administrator', '_40120', NULL, NULL, NULL, NULL),
	(2499, 'Administrator', '_40123', NULL, NULL, NULL, NULL),
	(2500, 'Administrator', '_40130', NULL, NULL, NULL, NULL),
	(2501, 'Administrator', '_60000', NULL, NULL, NULL, NULL),
	(2502, 'Administrator', '_60010', NULL, NULL, NULL, NULL),
	(2503, 'Administrator', '_60011', NULL, NULL, NULL, NULL),
	(2504, 'Administrator', '_60012', NULL, NULL, NULL, NULL),
	(2505, 'Administrator', '_60013', NULL, NULL, NULL, NULL),
	(2506, 'Administrator', '_60020', NULL, NULL, NULL, NULL),
	(2507, 'Administrator', '_60021', NULL, NULL, NULL, NULL),
	(2508, 'Administrator', '_60022', NULL, NULL, NULL, NULL),
	(2509, 'Administrator', '_60023', NULL, NULL, NULL, NULL),
	(2510, 'Administrator', '_60024', NULL, NULL, NULL, NULL),
	(2511, 'Administrator', '_60025', NULL, NULL, NULL, NULL),
	(2512, 'Administrator', '_60030', NULL, NULL, NULL, NULL),
	(2513, 'Administrator', '_60031', NULL, NULL, NULL, NULL),
	(2514, 'Administrator', '_60032', NULL, NULL, NULL, NULL),
	(2515, 'Administrator', '_60033', NULL, NULL, NULL, NULL),
	(2516, 'Administrator', '_60034', NULL, NULL, NULL, NULL),
	(2517, 'Administrator', '_60035', NULL, NULL, NULL, NULL),
	(2518, 'Administrator', '_60040', NULL, NULL, NULL, NULL),
	(2519, 'Administrator', '_60041', NULL, NULL, NULL, NULL),
	(2520, 'Administrator', '_60042', NULL, NULL, NULL, NULL),
	(2521, 'Administrator', '_60043', NULL, NULL, NULL, NULL),
	(2522, 'Administrator', '_60044', NULL, NULL, NULL, NULL),
	(2523, 'Administrator', '_60045', NULL, NULL, NULL, NULL),
	(2524, 'Administrator', '_60050', NULL, NULL, NULL, NULL),
	(2525, 'Administrator', '_60051', NULL, NULL, NULL, NULL),
	(2526, 'Administrator', '_60052', NULL, NULL, NULL, NULL),
	(2527, 'Administrator', '_60053', NULL, NULL, NULL, NULL),
	(2528, 'Administrator', '_60054', NULL, NULL, NULL, NULL),
	(2529, 'Administrator', '_60055', NULL, NULL, NULL, NULL),
	(2530, 'Administrator', '_60060', NULL, NULL, NULL, NULL),
	(2531, 'Administrator', '_60061', NULL, NULL, NULL, NULL),
	(2532, 'Administrator', '_60062', NULL, NULL, NULL, NULL),
	(2533, 'Administrator', '_60063', NULL, NULL, NULL, NULL),
	(2534, 'Administrator', '_60064', NULL, NULL, NULL, NULL),
	(2535, 'Administrator', '_60065', NULL, NULL, NULL, NULL),
	(2536, 'Administrator', '_60070', NULL, NULL, NULL, NULL),
	(2537, 'Administrator', '_60071', NULL, NULL, NULL, NULL),
	(2538, 'Administrator', '_60072', NULL, NULL, NULL, NULL),
	(2539, 'Administrator', '_60073', NULL, NULL, NULL, NULL),
	(2540, 'Administrator', '_60074', NULL, NULL, NULL, NULL),
	(2541, 'Administrator', '_60075', NULL, NULL, NULL, NULL),
	(2542, 'Administrator', '_60080', NULL, NULL, NULL, NULL),
	(2543, 'Administrator', '_60081', NULL, NULL, NULL, NULL),
	(2544, 'Administrator', '_60082', NULL, NULL, NULL, NULL),
	(2545, 'Administrator', '_60083', NULL, NULL, NULL, NULL),
	(2546, 'Administrator', '_60085', NULL, NULL, NULL, NULL),
	(2547, 'Administrator', '_60084', NULL, NULL, NULL, NULL),
	(2548, 'Administrator', '_80000', NULL, NULL, NULL, NULL),
	(2549, 'Administrator', '_80010', NULL, NULL, NULL, NULL),
	(2550, 'Administrator', '_80011', NULL, NULL, NULL, NULL),
	(2551, 'Administrator', '_80012', NULL, NULL, NULL, NULL),
	(2552, 'Administrator', '_80013', NULL, NULL, NULL, NULL),
	(2553, 'Administrator', '_80014', NULL, NULL, NULL, NULL),
	(2554, 'Administrator', '_80015', NULL, NULL, NULL, NULL),
	(2555, 'Administrator', '_80020', NULL, NULL, NULL, NULL),
	(2556, 'Administrator', '_80021', NULL, NULL, NULL, NULL),
	(2557, 'Administrator', '_80022', NULL, NULL, NULL, NULL),
	(2558, 'Administrator', '_80023', NULL, NULL, NULL, NULL),
	(2559, 'Administrator', '_80024', NULL, NULL, NULL, NULL),
	(2560, 'Administrator', '_80030', NULL, NULL, NULL, NULL),
	(2561, 'Administrator', '_80031', NULL, NULL, NULL, NULL),
	(2562, 'Administrator', '_80032', NULL, NULL, NULL, NULL),
	(2563, 'Administrator', '_80033', NULL, NULL, NULL, NULL),
	(2564, 'Administrator', '_80034', NULL, NULL, NULL, NULL),
	(2565, 'Administrator', '_80040', NULL, NULL, NULL, NULL),
	(2566, 'Administrator', '_80041', NULL, NULL, NULL, NULL),
	(2567, 'Administrator', '_80042', NULL, NULL, NULL, NULL),
	(2568, 'Administrator', '_80043', NULL, NULL, NULL, NULL),
	(2569, 'Administrator', '_80044', NULL, NULL, NULL, NULL),
	(2570, 'Administrator', '_80050', NULL, NULL, NULL, NULL),
	(2571, 'Administrator', '_80051', NULL, NULL, NULL, NULL),
	(2572, 'Administrator', '_80052', NULL, NULL, NULL, NULL),
	(2573, 'Administrator', '_80053', NULL, NULL, NULL, NULL),
	(2574, 'Administrator', '_80054', NULL, NULL, NULL, NULL),
	(2575, 'Administrator', '_80060', NULL, NULL, NULL, NULL),
	(2576, 'Administrator', '_80061', NULL, NULL, NULL, NULL),
	(2577, 'Administrator', '_80062', NULL, NULL, NULL, NULL),
	(2578, 'Administrator', '_80063', NULL, NULL, NULL, NULL),
	(2579, 'Administrator', '_80064', NULL, NULL, NULL, NULL),
	(2580, 'Administrator', '_80070', NULL, NULL, NULL, NULL),
	(2581, 'Administrator', '_80071', NULL, NULL, NULL, NULL),
	(2582, 'Administrator', '_80072', NULL, NULL, NULL, NULL),
	(2583, 'Administrator', '_80073', NULL, NULL, NULL, NULL),
	(2584, 'Administrator', '_80074', NULL, NULL, NULL, NULL),
	(2585, 'Administrator', '_80080', NULL, NULL, NULL, NULL),
	(2586, 'Administrator', '_80081', NULL, NULL, NULL, NULL),
	(2587, 'Administrator', '_80082', NULL, NULL, NULL, NULL),
	(2588, 'Administrator', '_80083', NULL, NULL, NULL, NULL),
	(2589, 'Administrator', '_80084', NULL, NULL, NULL, NULL),
	(2590, 'Administrator', '_80090', NULL, NULL, NULL, NULL),
	(2591, 'Administrator', '_80091', NULL, NULL, NULL, NULL),
	(2592, 'Administrator', '_80092', NULL, NULL, NULL, NULL),
	(2593, 'Administrator', '_80093', NULL, NULL, NULL, NULL),
	(2594, 'Administrator', '_80094', NULL, NULL, NULL, NULL),
	(2595, 'Administrator', '_80100', NULL, NULL, NULL, NULL),
	(2596, 'Administrator', '_80101', NULL, NULL, NULL, NULL),
	(2597, 'Administrator', '_80110', NULL, NULL, NULL, NULL),
	(2598, 'Administrator', '_80111', NULL, NULL, NULL, NULL),
	(2599, 'Administrator', '_80120', NULL, NULL, NULL, NULL),
	(2600, 'Administrator', '_80121', NULL, NULL, NULL, NULL),
	(2601, 'Administrator', '_80130', NULL, NULL, NULL, NULL),
	(2602, 'Administrator', '_80131', NULL, NULL, NULL, NULL),
	(2603, 'Administrator', '_80132', NULL, NULL, NULL, NULL),
	(2604, 'Administrator', '_80140', NULL, NULL, NULL, NULL),
	(2605, 'Administrator', '_80141', NULL, NULL, NULL, NULL),
	(2606, 'Administrator', '_80200', NULL, NULL, NULL, NULL),
	(2607, 'Administrator', '_80201', NULL, NULL, NULL, NULL),
	(2608, 'Administrator', '_80202', NULL, NULL, NULL, NULL),
	(2609, 'Administrator', '_90000', NULL, NULL, NULL, NULL),
	(2610, 'Administrator', 'frmRptCriteria', NULL, NULL, NULL, NULL),
	(2611, 'Administrator', '_90010', NULL, NULL, NULL, NULL),
	(2612, 'Administrator', '\\CEK\\BANKCEK2.RPT', NULL, NULL, NULL, NULL),
	(2613, 'Administrator', '\\CEK\\BANKCEKGL.RPT', NULL, NULL, NULL, NULL),
	(2614, 'Administrator', '\\CEK\\BANKCEKM2.RPT', NULL, NULL, NULL, NULL),
	(2615, 'Administrator', '\\cek\\BANKCODE.rpt', NULL, NULL, NULL, NULL),
	(2616, 'Administrator', '\\Cek\\BankMutasiBank.rpt', NULL, NULL, NULL, NULL),
	(2617, 'Administrator', '\\CEK\\ChInSum.Rpt', NULL, NULL, NULL, NULL),
	(2618, 'Administrator', '\\CEK\\ChOutSum.Rpt', NULL, NULL, NULL, NULL),
	(2619, 'Administrator', '\\CEK\\KasInSum.Rpt', NULL, NULL, NULL, NULL),
	(2620, 'Administrator', '\\CEK\\KasOutSum.Rpt', NULL, NULL, NULL, NULL),
	(2621, 'Administrator', '\\Cek\\MutasiKas_Saldo.rpt', NULL, NULL, NULL, NULL),
	(2622, 'Administrator', '\\CEK\\transfer_in.rpt', NULL, NULL, NULL, NULL),
	(2623, 'Administrator', '\\CEK\\transfer_out.rpt', NULL, NULL, NULL, NULL),
	(2624, 'Administrator', '\\gl\\balancesheet2.rpt', NULL, NULL, NULL, NULL),
	(2625, 'Administrator', '\\gl\\neracaT.rpt', NULL, NULL, NULL, NULL),
	(2626, 'Administrator', '\\gl\\RLCompare.rpt', NULL, NULL, NULL, NULL),
	(2627, 'Administrator', '\\so\\CustCredit.rpt', NULL, NULL, NULL, NULL),
	(2628, 'Administrator', '\\so\\CustCreditAll.rpt', NULL, NULL, NULL, NULL),
	(2629, 'Administrator', '\\So\\CustHighest.Rpt', NULL, NULL, NULL, NULL),
	(2630, 'Administrator', '\\so\\CustListCompany.rpt', NULL, NULL, NULL, NULL),
	(2631, 'Administrator', '\\so\\CustListCustomer.rpt', NULL, NULL, NULL, NULL),
	(2632, 'Administrator', '_90011', NULL, NULL, NULL, NULL),
	(2633, 'Administrator', '_90012', NULL, NULL, NULL, NULL),
	(2634, 'Administrator', '_90013', NULL, NULL, NULL, NULL),
	(2635, 'Administrator', '_90014', NULL, NULL, NULL, NULL),
	(2636, 'Administrator', '_90015', NULL, NULL, NULL, NULL),
	(2637, 'Administrator', '_90016', NULL, NULL, NULL, NULL),
	(2638, 'Administrator', '_90017', NULL, NULL, NULL, NULL),
	(2639, 'Administrator', '_90018', NULL, NULL, NULL, NULL),
	(2640, 'Administrator', '_90040', NULL, NULL, NULL, NULL),
	(2641, 'Administrator', '\\Inv\\AsmItem.Rpt', NULL, NULL, NULL, NULL),
	(2642, 'Administrator', '\\Inv\\AsmItem17.Rpt', NULL, NULL, NULL, NULL),
	(2643, 'Administrator', '\\Inv\\DaftarBarang.Rpt', NULL, NULL, NULL, NULL),
	(2644, 'Administrator', '\\Inv\\FisikInventory.rpt', NULL, NULL, NULL, NULL),
	(2645, 'Administrator', '\\Inv\\HargaBeli.Rpt', NULL, NULL, NULL, NULL),
	(2646, 'Administrator', '\\Inv\\HargaJual.Rpt', NULL, NULL, NULL, NULL),
	(2647, 'Administrator', '\\Inv\\InventoryMoving.rpt', NULL, NULL, NULL, NULL),
	(2648, 'Administrator', '\\Inv\\InvPriceHistory.rpt', NULL, NULL, NULL, NULL),
	(2649, 'Administrator', '\\Inv\\InvTranCategory.Rpt', NULL, NULL, NULL, NULL),
	(2650, 'Administrator', '\\Inv\\InvTranItem.Rpt', NULL, NULL, NULL, NULL),
	(2651, 'Administrator', '\\inv\\invvalue.rpt', NULL, NULL, NULL, NULL),
	(2652, 'Administrator', '\\inv\\KeluarReturPembelian.rpt', NULL, NULL, NULL, NULL),
	(2653, 'Administrator', '\\Inv\\MutasiGudang.rpt', NULL, NULL, NULL, NULL),
	(2654, 'Administrator', '\\Inv\\StokMgmtLow.rpt', NULL, NULL, NULL, NULL),
	(2655, 'Administrator', '\\Inv\\StokMgMtOnBOrder.rpt', NULL, NULL, NULL, NULL),
	(2656, 'Administrator', '\\Inv\\StokMgMtOut.rpt', NULL, NULL, NULL, NULL),
	(2657, 'Administrator', '\\Inv\\StokMgMtRecon.Rpt', NULL, NULL, NULL, NULL),
	(2658, 'Administrator', '\\PO\\Terima.Rpt', NULL, NULL, NULL, NULL),
	(2659, 'Administrator', '_90041', NULL, NULL, NULL, NULL),
	(2660, 'Administrator', '_90042', NULL, NULL, NULL, NULL),
	(2661, 'Administrator', '_90043', NULL, NULL, NULL, NULL),
	(2662, 'Administrator', '_90044', NULL, NULL, NULL, NULL),
	(2663, 'Administrator', '_90045', NULL, NULL, NULL, NULL),
	(2664, 'Administrator', '_90046', NULL, NULL, NULL, NULL),
	(2665, 'Administrator', '_90047', NULL, NULL, NULL, NULL),
	(2666, 'Administrator', '_90048', NULL, NULL, NULL, NULL),
	(2667, 'Administrator', '_90049', NULL, NULL, NULL, NULL),
	(2668, 'Administrator', '_90050', NULL, NULL, NULL, NULL),
	(2669, 'Administrator', '_90051', NULL, NULL, NULL, NULL),
	(2670, 'Administrator', '_90052', NULL, NULL, NULL, NULL),
	(2671, 'Administrator', '_90053', NULL, NULL, NULL, NULL),
	(2672, 'Administrator', '_90054', NULL, NULL, NULL, NULL),
	(2673, 'Administrator', '_90055', NULL, NULL, NULL, NULL),
	(2674, 'Administrator', '_90056', NULL, NULL, NULL, NULL),
	(2675, 'Administrator', '_90057', NULL, NULL, NULL, NULL),
	(2676, 'Administrator', '_90058', NULL, NULL, NULL, NULL),
	(2677, 'Administrator', '_90070', NULL, NULL, NULL, NULL),
	(2678, 'Administrator', '\\PO\\Keluar.rpt', NULL, NULL, NULL, NULL),
	(2679, 'Administrator', '\\PO\\KeluarPerPO.rpt', NULL, NULL, NULL, NULL),
	(2680, 'Administrator', '\\PO\\OpenPO.rpt', NULL, NULL, NULL, NULL),
	(2681, 'Administrator', '\\Po\\OrderPembelian.rpt', NULL, NULL, NULL, NULL),
	(2682, 'Administrator', '\\Po\\OrderPembelianItemSupplierDetail.rpt', NULL, NULL, NULL, NULL),
	(2683, 'Administrator', '\\PO\\PODaily.rpt', NULL, NULL, NULL, NULL),
	(2684, 'Administrator', '\\PO\\PODetailDaily.rpt', NULL, NULL, NULL, NULL),
	(2685, 'Administrator', '\\PO\\POItemNoRecvItem.rpt', NULL, NULL, NULL, NULL),
	(2686, 'Administrator', '\\PO\\POItemNoRecvSupplier.rpt', NULL, NULL, NULL, NULL),
	(2687, 'Administrator', '\\PO\\POItemOverItem.rpt', NULL, NULL, NULL, NULL),
	(2688, 'Administrator', '\\PO\\POItemOverSupplier.rpt', NULL, NULL, NULL, NULL),
	(2689, 'Administrator', '\\PO\\POMonthly.rpt', NULL, NULL, NULL, NULL),
	(2690, 'Administrator', '_90071', NULL, NULL, NULL, NULL),
	(2691, 'Administrator', '_90072', NULL, NULL, NULL, NULL),
	(2692, 'Administrator', '_90073', NULL, NULL, NULL, NULL),
	(2693, 'Administrator', '_90074', NULL, NULL, NULL, NULL),
	(2694, 'Administrator', '_90075', NULL, NULL, NULL, NULL),
	(2695, 'Administrator', '_90076', NULL, NULL, NULL, NULL),
	(2696, 'Administrator', '_90077', NULL, NULL, NULL, NULL),
	(2697, 'Administrator', '_90078', NULL, NULL, NULL, NULL),
	(2698, 'Administrator', '_90079', NULL, NULL, NULL, NULL),
	(2699, 'Administrator', '_90080', NULL, NULL, NULL, NULL),
	(2700, 'Administrator', '_90081', NULL, NULL, NULL, NULL),
	(2701, 'Administrator', '_90082', NULL, NULL, NULL, NULL),
	(2702, 'Administrator', '_90083', NULL, NULL, NULL, NULL),
	(2703, 'Administrator', '_90084', NULL, NULL, NULL, NULL),
	(2704, 'Administrator', '_90090', NULL, NULL, NULL, NULL),
	(2705, 'Administrator', '\\So\\AnalisaPenjualanPerCustomerPerbulan.rpt', NULL, NULL, NULL, NULL),
	(2706, 'Administrator', '\\So\\AnalisaPenjualanPerJenisPembayaranDetail.rpt', NULL, NULL, NULL, NULL),
	(2707, 'Administrator', '\\So\\AnalisaPenjualanPerJenisPembayaranPerbulan.rpt', NULL, NULL, NULL, NULL),
	(2708, 'Administrator', '\\So\\AnalisaPenjualanPerKategoryCustomer.rpt', NULL, NULL, NULL, NULL),
	(2709, 'Administrator', '\\So\\AnalisaPenjualanPerSalesmanPerbulan.rpt', NULL, NULL, NULL, NULL),
	(2710, 'Administrator', '\\So\\AnalisaPenjualanPerSourcePerbulan.rpt', NULL, NULL, NULL, NULL),
	(2711, 'Administrator', '\\So\\AnalisaPenjualanPerWilayah.rpt', NULL, NULL, NULL, NULL),
	(2712, 'Administrator', '\\so\\customerEnvelop.rpt', NULL, NULL, NULL, NULL),
	(2713, 'Administrator', '\\so\\CustPayHistory2.rpt', NULL, NULL, NULL, NULL),
	(2714, 'Administrator', '\\So\\CustPayHistoryByCust.rpt', NULL, NULL, NULL, NULL),
	(2715, 'Administrator', '\\So\\CustSalesHistory.rpt', NULL, NULL, NULL, NULL),
	(2716, 'Administrator', '\\So\\CustSalesHistoryLast.rpt', NULL, NULL, NULL, NULL),
	(2717, 'Administrator', '\\so\\daftarcustomer.rpt', NULL, NULL, NULL, NULL),
	(2718, 'Administrator', '\\so\\DaftarPiutang.rpt', NULL, NULL, NULL, NULL),
	(2719, 'Administrator', '\\So\\DaftarTagihan.rpt', NULL, NULL, NULL, NULL),
	(2720, 'Administrator', '\\So\\DODetail100.Rpt', NULL, NULL, NULL, NULL),
	(2721, 'Administrator', '\\So\\FakturPelunasanPiutang.Rpt', NULL, NULL, NULL, NULL),
	(2722, 'Administrator', '\\So\\FakturPenjualanDetailTanggal.Rpt', NULL, NULL, NULL, NULL),
	(2723, 'Administrator', '\\So\\FakturPenjualanDetailtem.Rpt', NULL, NULL, NULL, NULL),
	(2724, 'Administrator', '\\So\\FakturPenjualanSummary.Rpt', NULL, NULL, NULL, NULL),
	(2725, 'Administrator', '\\So\\FakturPenjualanSummaryBayar.Rpt', NULL, NULL, NULL, NULL),
	(2726, 'Administrator', '\\So\\FakturPenjualanSummaryItemCust.Rpt', NULL, NULL, NULL, NULL),
	(2727, 'Administrator', '\\So\\FakturPenjualanSummarySupplier.Rpt', NULL, NULL, NULL, NULL),
	(2728, 'Administrator', '\\So\\FakturPenjualanSummaryTanggal.Rpt', NULL, NULL, NULL, NULL),
	(2729, 'Administrator', '\\So\\FakturPenjualanSummaryWilayah.Rpt', NULL, NULL, NULL, NULL),
	(2730, 'Administrator', '\\So\\FB_RoomResv.rpt', NULL, NULL, NULL, NULL),
	(2731, 'Administrator', '\\So\\FB_RoomResv2.rpt', NULL, NULL, NULL, NULL),
	(2732, 'Administrator', '\\So\\FB_RoomResv3.rpt', NULL, NULL, NULL, NULL),
	(2733, 'Administrator', '\\So\\FB_RoomResvSumDay.rpt', NULL, NULL, NULL, NULL),
	(2734, 'Administrator', '\\So\\FB_TableResv.rpt', NULL, NULL, NULL, NULL),
	(2735, 'Administrator', '\\SO\\HargaHistoryMonthly.rpt', NULL, NULL, NULL, NULL),
	(2736, 'Administrator', '\\So\\HistoryHargaItemCustomer.rpt', NULL, NULL, NULL, NULL),
	(2737, 'Administrator', '\\So\\InvoiceAllTypePerCustomer.rpt', NULL, NULL, NULL, NULL),
	(2738, 'Administrator', '\\So\\InvoicePerTypePerCustomer.rpt', NULL, NULL, NULL, NULL),
	(2739, 'Administrator', '\\So\\Jual100.Rpt', NULL, NULL, NULL, NULL),
	(2740, 'Administrator', '\\so\\JualCustSum.Rpt', NULL, NULL, NULL, NULL),
	(2741, 'Administrator', '\\SO\\JualKasirDateTime.Rpt', NULL, NULL, NULL, NULL),
	(2742, 'Administrator', '\\SO\\JualKonsinyasiTglMonthly.Rpt', NULL, NULL, NULL, NULL),
	(2743, 'Administrator', '\\SO\\JualReturTglMonthly.Rpt', NULL, NULL, NULL, NULL),
	(2744, 'Administrator', '\\SO\\JualTglMonthly.Rpt', NULL, NULL, NULL, NULL),
	(2745, 'Administrator', '\\SO\\JualTglMonthlyDept.Rpt', NULL, NULL, NULL, NULL),
	(2746, 'Administrator', '\\SO\\JualTglMonthlySales.Rpt', NULL, NULL, NULL, NULL),
	(2747, 'Administrator', '\\So\\KomisiSalesmanMonthly.rpt', NULL, NULL, NULL, NULL),
	(2748, 'Administrator', '\\So\\KomisiSalesmanSummary.rpt', NULL, NULL, NULL, NULL),
	(2749, 'Administrator', '\\So\\KreditMemoSummary.rpt', NULL, NULL, NULL, NULL),
	(2750, 'Administrator', '\\SO\\MutasiStock.Rpt', NULL, NULL, NULL, NULL),
	(2751, 'Administrator', '\\SO\\MutasiStockPrice.Rpt', NULL, NULL, NULL, NULL),
	(2752, 'Administrator', '\\So\\PenjualanCustomer.rpt', NULL, NULL, NULL, NULL),
	(2753, 'Administrator', '\\So\\PenjualanCustomerDetail.rpt', NULL, NULL, NULL, NULL),
	(2754, 'Administrator', '\\So\\PenjualanPerbulanDetail.rpt', NULL, NULL, NULL, NULL),
	(2755, 'Administrator', '\\So\\SaldoPiutang.rpt', NULL, NULL, NULL, NULL),
	(2756, 'Administrator', '\\SO\\SalesKomisi.exe', NULL, NULL, NULL, NULL),
	(2757, 'Administrator', '\\SO\\SalesOrder.rpt', NULL, NULL, NULL, NULL),
	(2758, 'Administrator', '\\so\\SalesOrderDetail.rpt', NULL, NULL, NULL, NULL),
	(2759, 'Administrator', '\\so\\salesorder_do.rpt', NULL, NULL, NULL, NULL),
	(2760, 'Administrator', '\\so\\salesorder_do_item.rpt', NULL, NULL, NULL, NULL),
	(2761, 'Administrator', '\\so\\sisa_piutang.rpt', NULL, NULL, NULL, NULL),
	(2762, 'Administrator', '\\so\\sisa_piutang_bulan.rpt', NULL, NULL, NULL, NULL),
	(2763, 'Administrator', '\\SO\\SOOpenItem.rpt', NULL, NULL, NULL, NULL),
	(2764, 'Administrator', '\\SO\\SOOpenTanggal.rpt', NULL, NULL, NULL, NULL),
	(2765, 'Administrator', '_90091', NULL, NULL, NULL, NULL),
	(2766, 'Administrator', '_90092', NULL, NULL, NULL, NULL),
	(2767, 'Administrator', '_90093', NULL, NULL, NULL, NULL),
	(2768, 'Administrator', '_90094', NULL, NULL, NULL, NULL),
	(2769, 'Administrator', '_90095', NULL, NULL, NULL, NULL),
	(2770, 'Administrator', '_90096', NULL, NULL, NULL, NULL),
	(2771, 'Administrator', '_90097', NULL, NULL, NULL, NULL),
	(2772, 'Administrator', '_90098', NULL, NULL, NULL, NULL),
	(2773, 'Administrator', '_90099', NULL, NULL, NULL, NULL),
	(2774, 'Administrator', '_90100', NULL, NULL, NULL, NULL),
	(2775, 'Administrator', '_90101', NULL, NULL, NULL, NULL),
	(2776, 'Administrator', '_90102', NULL, NULL, NULL, NULL),
	(2777, 'Administrator', '_90103', NULL, NULL, NULL, NULL),
	(2778, 'Administrator', '_90104', NULL, NULL, NULL, NULL),
	(2779, 'Administrator', '_90105', NULL, NULL, NULL, NULL),
	(2780, 'Administrator', '_90106', NULL, NULL, NULL, NULL),
	(2781, 'Administrator', '_90107', NULL, NULL, NULL, NULL),
	(2782, 'Administrator', '_90108', NULL, NULL, NULL, NULL),
	(2783, 'Administrator', '_90109', NULL, NULL, NULL, NULL),
	(2784, 'Administrator', '_90120', NULL, NULL, NULL, NULL),
	(2785, 'Administrator', '\\Po\\DaftarHutang.rpt', NULL, NULL, NULL, NULL),
	(2786, 'Administrator', '\\po\\DaftarSupplier.rpt', NULL, NULL, NULL, NULL),
	(2787, 'Administrator', '\\po\\DaftarSupplierUtama.rpt', NULL, NULL, NULL, NULL),
	(2788, 'Administrator', '\\Po\\HistoryHargaItemSupplier.rpt', NULL, NULL, NULL, NULL),
	(2789, 'Administrator', '\\PO\\PayAnaSupplier.Rpt', NULL, NULL, NULL, NULL),
	(2790, 'Administrator', '\\PO\\PayDetailDaily.Rpt', NULL, NULL, NULL, NULL),
	(2791, 'Administrator', '\\PO\\PayDetailMonthly.Rpt', NULL, NULL, NULL, NULL),
	(2792, 'Administrator', '\\Po\\SaldoHutang.rpt', NULL, NULL, NULL, NULL),
	(2793, 'Administrator', '\\po\\SelisihKursHutang1.Rpt', NULL, NULL, NULL, NULL),
	(2794, 'Administrator', '\\po\\sisa_hutang.rpt', NULL, NULL, NULL, NULL),
	(2795, 'Administrator', '\\po\\sisa_hutang_bulan.rpt', NULL, NULL, NULL, NULL),
	(2796, 'Administrator', '\\po\\supplierEnvelop.rpt', NULL, NULL, NULL, NULL),
	(2797, 'Administrator', '\\Po\\SupplierLstFinancial.rpt', NULL, NULL, NULL, NULL),
	(2798, 'Administrator', '\\Po\\SupplierLstNumber.Rpt', NULL, NULL, NULL, NULL),
	(2799, 'Administrator', '\\Po\\SupplierPayables.rpt', NULL, NULL, NULL, NULL),
	(2800, 'Administrator', '\\PO\\TotalPayableSupplier.rpt', NULL, NULL, NULL, NULL),
	(2801, 'Administrator', '_90121', NULL, NULL, NULL, NULL),
	(2802, 'Administrator', '_90122', NULL, NULL, NULL, NULL),
	(2803, 'Administrator', '_90123', NULL, NULL, NULL, NULL),
	(2804, 'Administrator', '_90124', NULL, NULL, NULL, NULL),
	(2805, 'Administrator', '_90125', NULL, NULL, NULL, NULL),
	(2806, 'Administrator', '_90126', NULL, NULL, NULL, NULL),
	(2807, 'Administrator', '_90127', NULL, NULL, NULL, NULL),
	(2808, 'Administrator', '_90128', NULL, NULL, NULL, NULL),
	(2809, 'Administrator', '_90129', NULL, NULL, NULL, NULL),
	(2810, 'Administrator', '_90130', NULL, NULL, NULL, NULL),
	(2811, 'Administrator', '_90131', NULL, NULL, NULL, NULL),
	(2812, 'Administrator', '_90132', NULL, NULL, NULL, NULL),
	(2813, 'Administrator', '_90150', NULL, NULL, NULL, NULL),
	(2814, 'Administrator', '_90151', NULL, NULL, NULL, NULL),
	(2815, 'Administrator', '_90152', NULL, NULL, NULL, NULL),
	(2816, 'Administrator', '_90153', NULL, NULL, NULL, NULL),
	(2817, 'Administrator', '_90154', NULL, NULL, NULL, NULL),
	(2818, 'Administrator', '_90155', NULL, NULL, NULL, NULL),
	(2819, 'Administrator', '_90156', NULL, NULL, NULL, NULL),
	(2820, 'Administrator', '_90157', NULL, NULL, NULL, NULL),
	(2821, 'Administrator', '_90158', NULL, NULL, NULL, NULL),
	(2822, 'Administrator', '_90159', NULL, NULL, NULL, NULL),
	(2823, 'Administrator', '_90160', NULL, NULL, NULL, NULL),
	(2824, 'Administrator', '_90161', NULL, NULL, NULL, NULL),
	(2825, 'Administrator', '_90162', NULL, NULL, NULL, NULL),
	(2873, 'ADM', '_30000.034', NULL, NULL, NULL, NULL),
	(2874, 'ADM', '_30000.035', NULL, NULL, NULL, NULL),
	(2875, 'ADM', '_30000.036', NULL, NULL, NULL, NULL),
	(2876, 'ADM', '_30000.037', NULL, NULL, NULL, NULL),
	(2877, 'ADM', '_30000.038', NULL, NULL, NULL, NULL),
	(2878, 'ADM', '_30000.039', NULL, NULL, NULL, NULL),
	(2879, 'ADM', '_30000.040', NULL, NULL, NULL, NULL),
	(2880, 'ADM', '_30000.041', NULL, NULL, NULL, NULL),
	(2881, 'ADM', '_30000.054', NULL, NULL, NULL, NULL),
	(2882, 'ADM', '_30000.056', NULL, NULL, NULL, NULL),
	(2883, 'ADM', '_30000.057', NULL, NULL, NULL, NULL),
	(2884, 'ADM', '_30000.059', NULL, NULL, NULL, NULL),
	(2885, 'ADM', '_30000.060', NULL, NULL, NULL, NULL),
	(2886, 'ADM', '_30000.061', NULL, NULL, NULL, NULL),
	(2887, 'ADM', '_30000.062', NULL, NULL, NULL, NULL),
	(2888, 'ADM', '_30000.063', NULL, NULL, NULL, NULL),
	(2889, 'ADM', '_30000.064', NULL, NULL, NULL, NULL),
	(2890, 'ADM', '_30000.065', NULL, NULL, NULL, NULL),
	(2891, 'ADM', '_30000.066', NULL, NULL, NULL, NULL),
	(2892, 'ADM', '_30000.100', NULL, NULL, NULL, NULL),
	(2893, 'aaa', 'frmMain.Addnew', NULL, NULL, NULL, NULL),
	(2894, 'aaa', 'ID_ExportImport', NULL, NULL, NULL, NULL),
	(2895, 'aaa', 'ID_JasaKiriman', NULL, NULL, NULL, NULL),
	(2896, 'aaa', '_00010', NULL, NULL, NULL, NULL),
	(2897, 'SLSADM', '_30000', NULL, NULL, NULL, NULL),
	(2898, 'SLSADM', '_30010', NULL, NULL, NULL, NULL),
	(2899, 'SLSADM', 'frmCustomers.cmdSaveShipTo', NULL, NULL, NULL, NULL),
	(2900, 'SLSADM', '_30011', NULL, NULL, NULL, NULL),
	(2901, 'SLSADM', '_30012', NULL, NULL, NULL, NULL),
	(2902, 'SLSADM', '_30020', NULL, NULL, NULL, NULL),
	(2903, 'SLSADM', '_30050', NULL, NULL, NULL, NULL),
	(2904, 'SLSADM', '_30051', NULL, NULL, NULL, NULL),
	(2905, 'SLSADM', '_30052', NULL, NULL, NULL, NULL),
	(2992, 'Gudang', '_30000', NULL, NULL, NULL, NULL),
	(2993, 'Gudang', '_30060', NULL, NULL, NULL, NULL),
	(2994, 'Gudang', '_30061', NULL, NULL, NULL, NULL),
	(2995, 'Gudang', '_30062', NULL, NULL, NULL, NULL),
	(2996, 'Gudang', '_30064', NULL, NULL, NULL, NULL),
	(2997, 'Gudang', '_80000', NULL, NULL, NULL, NULL),
	(2998, 'Gudang', '_80010', NULL, NULL, NULL, NULL),
	(2999, 'Gudang', '_80011', NULL, NULL, NULL, NULL),
	(3000, 'Gudang', '_80012', NULL, NULL, NULL, NULL),
	(3001, 'Gudang', '_80020', NULL, NULL, NULL, NULL),
	(3002, 'Gudang', '_80021', NULL, NULL, NULL, NULL),
	(3003, 'Gudang', '_80022', NULL, NULL, NULL, NULL),
	(3004, 'Gudang', '_80040', NULL, NULL, NULL, NULL),
	(3005, 'Gudang', '_80041', NULL, NULL, NULL, NULL),
	(3006, 'Gudang', '_80042', NULL, NULL, NULL, NULL),
	(3007, 'Gudang', '_80050', NULL, NULL, NULL, NULL),
	(3008, 'Gudang', '_80051', NULL, NULL, NULL, NULL),
	(3009, 'Gudang', '_80052', NULL, NULL, NULL, NULL),
	(3010, 'Gudang', '_80060', NULL, NULL, NULL, NULL),
	(3011, 'Gudang', '_80061', NULL, NULL, NULL, NULL),
	(3012, 'Gudang', '_80062', NULL, NULL, NULL, NULL),
	(3013, 'Gudang', '_80070', NULL, NULL, NULL, NULL),
	(3014, 'Gudang', '_80071', NULL, NULL, NULL, NULL),
	(3015, 'Gudang', '_80072', NULL, NULL, NULL, NULL),
	(3016, 'Gudang', '_80080', NULL, NULL, NULL, NULL),
	(3017, 'Gudang', '_80081', NULL, NULL, NULL, NULL),
	(3018, 'Gudang', '_80082', NULL, NULL, NULL, NULL),
	(3019, 'Gudang', '_80090', NULL, NULL, NULL, NULL),
	(3020, 'Gudang', '_80091', NULL, NULL, NULL, NULL),
	(3021, 'Gudang', '_80092', NULL, NULL, NULL, NULL),
	(3022, 'Gudang', '_80100', NULL, NULL, NULL, NULL),
	(3023, 'Gudang', '_80101', NULL, NULL, NULL, NULL),
	(3024, 'Gudang', '_80110', NULL, NULL, NULL, NULL),
	(3025, 'Gudang', '_80111', NULL, NULL, NULL, NULL),
	(3026, 'Gudang', '_80120', NULL, NULL, NULL, NULL),
	(3027, 'Gudang', '_80121', NULL, NULL, NULL, NULL),
	(3028, 'Gudang', '_80130', NULL, NULL, NULL, NULL),
	(3029, 'Gudang', '_80131', NULL, NULL, NULL, NULL),
	(3030, 'Gudang', '_80132', NULL, NULL, NULL, NULL),
	(3031, 'Gudang', '_80140', NULL, NULL, NULL, NULL),
	(3032, 'Gudang', '_80141', NULL, NULL, NULL, NULL),
	(3033, 'Gudang', '_80200', NULL, NULL, NULL, NULL),
	(3034, 'Gudang', '_80201', NULL, NULL, NULL, NULL),
	(3035, 'Gudang', '_80202', NULL, NULL, NULL, NULL),
	(3176, 'FIN', '_40080', NULL, NULL, NULL, NULL),
	(3175, 'FIN', '_40071', NULL, NULL, NULL, NULL),
	(3174, 'FIN', '_40070', NULL, NULL, NULL, NULL),
	(3173, 'FIN', '_40063', NULL, NULL, NULL, NULL),
	(3172, 'FIN', '_40062', NULL, NULL, NULL, NULL),
	(3171, 'FIN', '_40061', NULL, NULL, NULL, NULL),
	(3170, 'FIN', '_40060', NULL, NULL, NULL, NULL),
	(3169, 'FIN', '_40136', NULL, NULL, NULL, NULL),
	(3168, 'FIN', '_40135', NULL, NULL, NULL, NULL),
	(3167, 'FIN', '_40132', NULL, NULL, NULL, NULL),
	(3166, 'FIN', '_40131', NULL, NULL, NULL, NULL),
	(3165, 'FIN', '_40055', NULL, NULL, NULL, NULL),
	(3164, 'FIN', '_40054', NULL, NULL, NULL, NULL),
	(3163, 'FIN', '_40052', NULL, NULL, NULL, NULL),
	(3162, 'FIN', '_40051', NULL, NULL, NULL, NULL),
	(3161, 'FIN', '_40050', NULL, NULL, NULL, NULL),
	(3160, 'FIN', '_40031', NULL, NULL, NULL, NULL),
	(3159, 'FIN', '_40030', NULL, NULL, NULL, NULL),
	(3158, 'FIN', '_40021', NULL, NULL, NULL, NULL),
	(3157, 'FIN', '_40020', NULL, NULL, NULL, NULL),
	(3156, 'FIN', '_40000', NULL, NULL, NULL, NULL),
	(3155, 'FIN', '_30165', NULL, NULL, NULL, NULL),
	(3154, 'FIN', '_30164', NULL, NULL, NULL, NULL),
	(3153, 'FIN', '_30162', NULL, NULL, NULL, NULL),
	(3152, 'FIN', '_30161', NULL, NULL, NULL, NULL),
	(3151, 'FIN', '_30160', NULL, NULL, NULL, NULL),
	(3150, 'FIN', '_30151', NULL, NULL, NULL, NULL),
	(3149, 'FIN', '_30150', NULL, NULL, NULL, NULL),
	(3125, 'FIN', '_30071', NULL, NULL, NULL, NULL),
	(3124, 'FIN', '_30070', NULL, NULL, NULL, NULL),
	(3123, 'FIN', '_30000', NULL, NULL, NULL, NULL),
	(3122, 'FIN', '_14001', NULL, NULL, NULL, NULL),
	(3148, 'FIN', '_30143', NULL, NULL, NULL, NULL),
	(3147, 'FIN', '_30142', NULL, NULL, NULL, NULL),
	(3146, 'FIN', '_30140', NULL, NULL, NULL, NULL),
	(3145, 'FIN', '_30135', NULL, NULL, NULL, NULL),
	(3144, 'FIN', '_30134', NULL, NULL, NULL, NULL),
	(3143, 'FIN', '_30132', NULL, NULL, NULL, NULL),
	(3142, 'FIN', '_30130', NULL, NULL, NULL, NULL),
	(3141, 'FIN', '_30125', NULL, NULL, NULL, NULL),
	(3140, 'FIN', '_30124', NULL, NULL, NULL, NULL),
	(3139, 'FIN', '_30122', NULL, NULL, NULL, NULL),
	(3138, 'FIN', '_30120', NULL, NULL, NULL, NULL),
	(3137, 'FIN', '_30112', NULL, NULL, NULL, NULL),
	(3136, 'FIN', '_30110', NULL, NULL, NULL, NULL),
	(3135, 'FIN', '_30095', NULL, NULL, NULL, NULL),
	(3134, 'FIN', '_30094', NULL, NULL, NULL, NULL),
	(3133, 'FIN', '_30092', NULL, NULL, NULL, NULL),
	(3132, 'FIN', '_30091', NULL, NULL, NULL, NULL),
	(3131, 'FIN', '_30090', NULL, NULL, NULL, NULL),
	(3130, 'FIN', '_30081', NULL, NULL, NULL, NULL),
	(3129, 'FIN', '_30080', NULL, NULL, NULL, NULL),
	(3128, 'FIN', '_30075', NULL, NULL, NULL, NULL),
	(3127, 'FIN', '_30074', NULL, NULL, NULL, NULL),
	(3126, 'FIN', '_30072', NULL, NULL, NULL, NULL),
	(3182, 'FIN', '_40100', NULL, NULL, NULL, NULL),
	(3183, 'FIN', '_40101', NULL, NULL, NULL, NULL),
	(3184, 'FIN', '_40102', NULL, NULL, NULL, NULL),
	(3185, 'FIN', '_40104', NULL, NULL, NULL, NULL),
	(3186, 'FIN', '_40105', NULL, NULL, NULL, NULL),
	(3187, 'FIN', '_40110', NULL, NULL, NULL, NULL),
	(3188, 'FIN', '_40113', NULL, NULL, NULL, NULL),
	(3189, 'FIN', '_40114', NULL, NULL, NULL, NULL),
	(3190, 'FIN', '_40115', NULL, NULL, NULL, NULL),
	(3191, 'FIN', '_40120', NULL, NULL, NULL, NULL),
	(3192, 'FIN', '_40123', NULL, NULL, NULL, NULL),
	(3193, 'FIN', '_40130', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `user_group_modules` ENABLE KEYS */;


-- Dumping structure for table simak.user_job
CREATE TABLE IF NOT EXISTS `user_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `group_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x1` (`user_id`,`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.user_job: 49 rows
/*!40000 ALTER TABLE `user_job` DISABLE KEYS */;
REPLACE INTO `user_job` (`id`, `user_id`, `group_id`, `update_status`, `sourceautonumber`, `sourcefile`) VALUES
	(252, 'admin', 'ADM', NULL, NULL, NULL),
	(16, 'Kasir', 'INV', NULL, NULL, NULL),
	(17, 'Kasir', 'PUR', NULL, NULL, NULL),
	(18, 'Kasir', 'BYR', NULL, NULL, NULL),
	(45, 'Administrator', 'ADM', NULL, NULL, NULL),
	(115, 'andri', 'SYSMENU', NULL, NULL, NULL),
	(245, 'admin', 'INV', NULL, NULL, NULL),
	(255, 'sales', 'SLSADM', NULL, NULL, NULL),
	(250, 'Spv', 'SPV', NULL, NULL, NULL),
	(254, 'sales', 'SLS', NULL, NULL, NULL),
	(60, 'Kasir', 'FIN', NULL, NULL, NULL),
	(61, 'Administrator', 'ANDRI', NULL, NULL, NULL),
	(200, 'bbb', 'DRV', NULL, NULL, NULL),
	(199, 'bbb', 'COL', NULL, NULL, NULL),
	(244, 'ongkim', 'SLS', NULL, NULL, NULL),
	(68, 'buyer', 'BYR', NULL, NULL, NULL),
	(111, 'andri', 'Gudang', NULL, NULL, NULL),
	(112, 'andri', 'INV', NULL, NULL, NULL),
	(113, 'andri', 'KSR', NULL, NULL, NULL),
	(114, 'andri', 'SPV', NULL, NULL, NULL),
	(116, 'andri', 'test', NULL, NULL, NULL),
	(246, 'admin', 'PUR', NULL, NULL, NULL),
	(213, 'andri', 'SV', NULL, NULL, NULL),
	(214, 'andri', 'BS', NULL, NULL, NULL),
	(215, 'andri', 'SA', NULL, NULL, NULL),
	(216, 'andri', 'VF', NULL, NULL, NULL),
	(217, 'andri', 'GM', NULL, NULL, NULL),
	(218, 'andri', 'MRISK', NULL, NULL, NULL),
	(219, 'andri', 'GMRISK', NULL, NULL, NULL),
	(220, 'andri', 'LSADM', NULL, NULL, NULL),
	(221, 'andri', 'Administrator', NULL, NULL, NULL),
	(223, 'andri', 'COL', NULL, NULL, NULL),
	(227, 'andri', 'GMBS', NULL, NULL, NULL),
	(228, 'andri', 'RS', NULL, NULL, NULL),
	(229, 'andri', 'ADM', NULL, NULL, NULL),
	(230, 'andri', 'FIN', NULL, NULL, NULL),
	(231, 'andri', 'BYR', NULL, NULL, NULL),
	(232, 'andri', 'GL', NULL, NULL, NULL),
	(233, 'gl', 'GL', NULL, NULL, NULL),
	(234, 'andri', 'PUR', NULL, NULL, NULL),
	(235, 'andri', 'TRV', NULL, NULL, NULL),
	(251, 'admin', 'GL', NULL, NULL, NULL),
	(243, 'admin', 'SLS', NULL, NULL, NULL),
	(247, 'admin', 'Gudang', NULL, NULL, NULL),
	(248, 'admin', 'Administrator', NULL, NULL, NULL),
	(249, 'admin', 'SPV', NULL, NULL, NULL),
	(253, 'admin', 'FIN', NULL, NULL, NULL),
	(256, 'gudang', 'Gudang', NULL, NULL, NULL),
	(257, 'finance', 'FIN', NULL, NULL, NULL);
/*!40000 ALTER TABLE `user_job` ENABLE KEYS */;


-- Dumping structure for table simak.user_roles
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_id` varchar(50) DEFAULT NULL,
  `roles_type` varchar(50) DEFAULT NULL,
  `roles_item` varchar(50) DEFAULT NULL,
  `roles_value1` double DEFAULT NULL,
  `roles_value2` double DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `id` int(9) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table simak.user_roles: 4 rows
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
REPLACE INTO `user_roles` (`user_id`, `roles_type`, `roles_item`, `roles_value1`, `roles_value2`, `description`, `id`) VALUES
	('kerawang', '2', 'Kerawang', NULL, NULL, 'Kerawang', 1),
	('admin', '1', 'Kantor', NULL, NULL, 'Kantor', 4),
	('admin', '1', 'Kantor', NULL, NULL, 'Kantor', 5),
	('admin', '1', 'JKT', NULL, NULL, 'JAKARTA', 6);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;


-- Dumping structure for table simak.voucher_master
CREATE TABLE IF NOT EXISTS `voucher_master` (
  `voucher_no` varchar(50) CHARACTER SET utf8 NOT NULL,
  `tanggal_dibuat` datetime DEFAULT NULL,
  `tanggal_aktif` datetime DEFAULT NULL,
  `tanggal_expire` datetime DEFAULT NULL,
  `customer_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `voucher_amt` double DEFAULT NULL,
  `voucher_amt_terpakai` double DEFAULT NULL,
  `voucher_amt_sisa` double DEFAULT NULL,
  `voucher_point` int(11) DEFAULT NULL,
  `voucher_point_terpakai` int(11) DEFAULT NULL,
  `voucher_point_sisa` int(11) DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`voucher_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.voucher_master: 0 rows
/*!40000 ALTER TABLE `voucher_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `voucher_master` ENABLE KEYS */;


-- Dumping structure for table simak.wilayah
CREATE TABLE IF NOT EXISTS `wilayah` (
  `wilayah` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `kode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ongkos_kirim` double DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.wilayah: 2 rows
/*!40000 ALTER TABLE `wilayah` DISABLE KEYS */;
REPLACE INTO `wilayah` (`wilayah`, `update_status`, `kode`, `ongkos_kirim`) VALUES
	('JAKARTA BARAT', NULL, 'JAKBAR', NULL),
	('JAKARTA TIMUR', NULL, 'JAKTIM', NULL);
/*!40000 ALTER TABLE `wilayah` ENABLE KEYS */;


-- Dumping structure for table simak.work_exec
CREATE TABLE IF NOT EXISTS `work_exec` (
  `work_exec_no` varchar(50) NOT NULL DEFAULT '',
  `wo_number` varchar(50) NOT NULL DEFAULT '',
  `start_date` datetime DEFAULT NULL,
  `expected_date` datetime DEFAULT NULL,
  `dept_code` varchar(50) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `person_in_charge` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `wo_customer` varchar(50) NOT NULL,
  PRIMARY KEY (`work_exec_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.work_exec: 2 rows
/*!40000 ALTER TABLE `work_exec` DISABLE KEYS */;
REPLACE INTO `work_exec` (`work_exec_no`, `wo_number`, `start_date`, `expected_date`, `dept_code`, `comments`, `person_in_charge`, `status`, `wo_customer`) VALUES
	('WOE00008', 'WO-00015', '2015-11-14 07:52:29', '2015-11-14 07:52:29', '', '', 'ANDRI', 0, ''),
	('WOE00009', 'WO-00017', '2016-03-12 00:00:00', '2016-03-12 00:00:00', '', '', '121', 0, '');
/*!40000 ALTER TABLE `work_exec` ENABLE KEYS */;


-- Dumping structure for table simak.work_exec_detail
CREATE TABLE IF NOT EXISTS `work_exec_detail` (
  `work_exec_no` varchar(50) DEFAULT NULL,
  `item_number` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.work_exec_detail: 2 rows
/*!40000 ALTER TABLE `work_exec_detail` DISABLE KEYS */;
REPLACE INTO `work_exec_detail` (`work_exec_no`, `item_number`, `description`, `quantity`, `unit`, `price`, `total`, `id`) VALUES
	('WOE00008', 'MEJA', 'MEJA KANTOR', 1, 'Pcs', 0, 0, 1),
	('WOE00009', '100', 'Baju Anak Koko', 8, NULL, 0, 0, 2);
/*!40000 ALTER TABLE `work_exec_detail` ENABLE KEYS */;


-- Dumping structure for table simak.work_order
CREATE TABLE IF NOT EXISTS `work_order` (
  `work_order_no` varchar(50) NOT NULL DEFAULT '',
  `start_date` datetime DEFAULT NULL,
  `expected_date` datetime DEFAULT NULL,
  `customer_number` varchar(50) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `wo_status` varchar(50) DEFAULT NULL,
  `special_order` tinyint(1) DEFAULT NULL,
  `sales_order_number` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`work_order_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.work_order: 3 rows
/*!40000 ALTER TABLE `work_order` DISABLE KEYS */;
REPLACE INTO `work_order` (`work_order_no`, `start_date`, `expected_date`, `customer_number`, `comments`, `wo_status`, `special_order`, `sales_order_number`) VALUES
	('WO-00015', '2015-11-14 07:50:44', '2015-11-14 07:50:44', '39393', NULL, '', 0, 'SO00099'),
	('WO-00016', '2015-11-15 12:58:39', '2015-11-15 12:58:39', 'MJ', NULL, '0', 0, 'SO00100'),
	('WO-00017', '2016-03-12 00:00:00', '2016-03-12 00:00:00', '101', NULL, '', 0, '4444');
/*!40000 ALTER TABLE `work_order` ENABLE KEYS */;


-- Dumping structure for table simak.work_order_detail
CREATE TABLE IF NOT EXISTS `work_order_detail` (
  `work_order_no` varchar(50) DEFAULT NULL,
  `item_number` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty_exec` double DEFAULT NULL,
  `qty_bal` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table simak.work_order_detail: 3 rows
/*!40000 ALTER TABLE `work_order_detail` DISABLE KEYS */;
REPLACE INTO `work_order_detail` (`work_order_no`, `item_number`, `description`, `quantity`, `unit`, `price`, `total`, `id`, `qty_exec`, `qty_bal`) VALUES
	('WO-00015', 'MEJA', 'MEJA KANTOR', 1, 'Pcs', 0, 0, 1, 1, 0),
	('WO-00016', 'MEJA', 'MEJA KANTOR', 1, 'Pcs', 0, 0, 2, NULL, NULL),
	('WO-00017', '100', 'Baju Anak Koko', 8, NULL, 50000, 400000, 3, 8, 0);
/*!40000 ALTER TABLE `work_order_detail` ENABLE KEYS */;


-- Dumping structure for table simak.yescalendaricons
CREATE TABLE IF NOT EXISTS `yescalendaricons` (
  `noteiconname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `noteiconcategory` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `noteicon` double DEFAULT NULL,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.yescalendaricons: 0 rows
/*!40000 ALTER TABLE `yescalendaricons` DISABLE KEYS */;
/*!40000 ALTER TABLE `yescalendaricons` ENABLE KEYS */;


-- Dumping structure for table simak.yes_smartsearchdefinition
CREATE TABLE IF NOT EXISTS `yes_smartsearchdefinition` (
  `searchid` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `optionlabel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `listlabel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `rowsource` double DEFAULT NULL,
  `columncount` int(11) DEFAULT NULL,
  `columnwidths` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `boundcolumn` int(11) DEFAULT NULL,
  `textsearchlabel` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `textsearchfield` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `lastselectedoption` int(11) DEFAULT NULL,
  `source_table` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `line_number` int(11) NOT NULL AUTO_INCREMENT,
  `update_status` int(11) DEFAULT NULL,
  `sourceautonumber` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sourcefile` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`line_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table simak.yes_smartsearchdefinition: 0 rows
/*!40000 ALTER TABLE `yes_smartsearchdefinition` DISABLE KEYS */;
/*!40000 ALTER TABLE `yes_smartsearchdefinition` ENABLE KEYS */;


-- Dumping structure for view simak.qry_coa
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_coa` (
	`account` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`account_description` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(1) NOT NULL COLLATE 'utf8_general_ci',
	`db_or_cr` VARCHAR(11) NULL COLLATE 'utf8_general_ci',
	`saldo_awal` DOUBLE NULL,
	`parent` VARCHAR(10) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice` (
	`invoice_date` DATETIME NULL,
	`invoice_number` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`sold_to_customer` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`company` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`due_date` DATETIME NULL,
	`payment_terms` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`salesman` VARCHAR(30) NULL COLLATE 'utf8_general_ci',
	`amount` DOUBLE NULL,
	`sales_order_number` VARCHAR(22) NULL COLLATE 'utf8_general_ci',
	`payment` DOUBLE NULL,
	`retur` DOUBLE NULL,
	`cr_amount` DOUBLE NULL,
	`db_amount` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_credit
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_credit` (
	`docnumber` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`cr_amount` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_debit
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_debit` (
	`docnumber` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`db_amount` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_header_sum
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_header_sum` (
	`loan_id` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`z_pokok` DOUBLE NULL,
	`z_pokok_paid` DOUBLE NULL,
	`z_saldo_pokok` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_lancar_macet
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_lancar_macet` (
	`loan_id` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`tahun` INT(4) NULL,
	`bulan` INT(2) NULL,
	`lancar` DECIMAL(23,0) NULL,
	`kurang` DECIMAL(23,0) NULL,
	`macet` DECIMAL(23,0) NULL,
	`lancar_amt` DOUBLE NULL,
	`kurang_amt` DOUBLE NULL,
	`macet_amt` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_payment
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_payment` (
	`invoice_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`payment` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_invoice_retur
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_invoice_retur` (
	`your_order__` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`retur` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_adj
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_adj` (
	`tanggal` DATETIME NULL,
	`jenis` VARCHAR(10) NOT NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` BIGINT(11) NULL,
	`qty_keluar` BIGINT(11) NULL,
	`price` INT(1) NOT NULL,
	`cost` DOUBLE NULL,
	`amount_masuk` DOUBLE NULL,
	`amount_keluar` INT(1) NOT NULL,
	`gudang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_delivery
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_delivery` (
	`tanggal` DATETIME NULL,
	`tipe` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(11) NOT NULL COLLATE 'utf8_general_ci',
	`termin` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` INT(1) NOT NULL,
	`qty_keluar` DOUBLE(19,2) NULL,
	`unit` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`price` DOUBLE(11,2) NULL,
	`cost` DOUBLE NULL,
	`discount` DOUBLE(11,2) NULL,
	`discount_amount` DOUBLE NULL,
	`amount` DOUBLE NULL,
	`gudang` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`mata_uang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`rate` DOUBLE NULL,
	`customer` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`mu_qty` DOUBLE(11,2) NULL,
	`multi_unit` VARCHAR(25) NULL COLLATE 'utf8_general_ci',
	`mu_harga` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_etc_out
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_etc_out` (
	`tanggal` DATETIME NULL,
	`tipe` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`termin` VARCHAR(7) NOT NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` INT(1) NOT NULL,
	`qty_keluar` BIGINT(11) NULL,
	`unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`price` DOUBLE NULL,
	`cost` DOUBLE NULL,
	`discount` INT(1) NOT NULL,
	`discount_amount` INT(1) NOT NULL,
	`amount` DOUBLE NULL,
	`gudang` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`mata_uang` VARCHAR(3) NOT NULL COLLATE 'utf8_general_ci',
	`rate` INT(1) NOT NULL,
	`supplier` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`mu_qty` INT(11) NULL,
	`multi_unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`mu_price` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_invoice
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_invoice` (
	`tanggal` DATETIME NULL,
	`tipe` VARCHAR(1) NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(18) NOT NULL COLLATE 'utf8_general_ci',
	`termin` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(20) NOT NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` DOUBLE(19,2) NULL,
	`qty_keluar` DOUBLE NULL,
	`unit` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`price` DOUBLE(11,2) NULL,
	`cost` DOUBLE NULL,
	`discount` DOUBLE(11,2) NULL,
	`discount_amount` DOUBLE NULL,
	`amount` DOUBLE NULL,
	`gudang` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`mata_uang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`rate` DOUBLE NULL,
	`customer` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`mu_qty` DOUBLE(11,2) NULL,
	`multi_unit` VARCHAR(25) NULL COLLATE 'utf8_general_ci',
	`mu_harga` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_purchase
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_purchase` (
	`tanggal` DATETIME NULL,
	`tipe` VARCHAR(11) NOT NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(18) NOT NULL COLLATE 'utf8_general_ci',
	`terms` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` DOUBLE(11,2) NULL,
	`qty_keluar` DOUBLE NULL,
	`unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`price` DOUBLE NULL,
	`cost` DOUBLE NULL,
	`discount` DOUBLE(11,2) NULL,
	`disc_amount_1` DOUBLE NULL,
	`amount_masuk` DOUBLE NULL,
	`amount_keluar` BIGINT(20) NOT NULL,
	`gudang` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`mata_uang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`rate` DOUBLE NULL,
	`supplier_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`mu_qty` DOUBLE(11,0) NULL,
	`multi_unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`mu_harga` DOUBLE NULL,
	`comments` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_receipt
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_receipt` (
	`tanggal` DATETIME NULL,
	`tipe` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`jenis` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`termin` VARCHAR(7) NOT NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` BIGINT(11) NULL,
	`qty_keluar` BIGINT(11) NULL,
	`unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`price` DOUBLE NULL,
	`cost` DOUBLE NULL,
	`discount` INT(1) NOT NULL,
	`discount_amount` INT(1) NOT NULL,
	`amount` DOUBLE NULL,
	`gudang` VARCHAR(15) NULL COLLATE 'utf8_general_ci',
	`mata_uang` VARCHAR(3) NOT NULL COLLATE 'utf8_general_ci',
	`rate` INT(1) NOT NULL,
	`supplier` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`mu_qty` INT(11) NULL,
	`multi_unit` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`mu_price` DOUBLE NULL
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_transfer
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_transfer` (
	`tanggal` DATETIME NULL,
	`jenis` VARCHAR(8) NOT NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` BIGINT(20) NULL,
	`qty_keluar` BIGINT(20) NULL,
	`price` BIGINT(20) NOT NULL,
	`cost` BIGINT(20) NOT NULL,
	`amount_masuk` DOUBLE NULL,
	`amount_keluar` DOUBLE NULL,
	`gudang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_kartustock_union
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `qry_kartustock_union` (
	`tanggal` DATETIME NULL,
	`jenis` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`no_sumber` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`item_number` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`description` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
	`qty_masuk` DOUBLE NULL,
	`qty_keluar` DOUBLE NULL,
	`price` DOUBLE NULL,
	`cost` DOUBLE NULL,
	`amount_masuk` DOUBLE NULL,
	`amount_keluar` DOUBLE NULL,
	`gudang` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`comments` VARCHAR(250) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;


-- Dumping structure for view simak.qry_coa
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_coa`;
CREATE VIEW `qry_coa` AS select `coa`.`account` AS `account`,`coa`.`account_description` AS `account_description`,_utf8'D' AS `jenis`,`coa`.`db_or_cr` AS `db_or_cr`,`coa`.`beginning_balance` AS `saldo_awal`,`coa`.`group_type` AS `parent` from `chart_of_accounts` `coa` union all select `grg`.`group_type` AS `group_type`,`grg`.`group_name` AS `group_name`,_utf8'H' AS `jenis`,_utf8'' AS `Unknown`,NULL AS `0`,`grg`.`parent_group_type` AS `parent_group_type` from `gl_report_groups` `grg` ;


-- Dumping structure for view simak.qry_invoice
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice`;
CREATE VIEW `qry_invoice` AS select `i`.`invoice_date` AS `invoice_date`,`i`.`invoice_number` AS `invoice_number`,`i`.`sold_to_customer` AS `sold_to_customer`,`c`.`company` AS `company`,`i`.`due_date` AS `due_date`,`i`.`payment_terms` AS `payment_terms`,`i`.`salesman` AS `salesman`,`i`.`amount` AS `amount`,`i`.`sales_order_number` AS `sales_order_number`,`p`.`payment` AS `payment`,`r`.`retur` AS `retur`,`cr`.`cr_amount` AS `cr_amount`,`d`.`db_amount` AS `db_amount` from (((((`invoice` `i` left join `customers` `c` on((`c`.`customer_number` = `i`.`sold_to_customer`))) left join `qry_invoice_payment` `p` on((convert(`p`.`invoice_number` using utf8) = `i`.`invoice_number`))) left join `qry_invoice_retur` `r` on((convert(`r`.`your_order__` using utf8) = `i`.`invoice_number`))) left join `qry_invoice_credit` `cr` on((convert(`cr`.`docnumber` using utf8) = `i`.`invoice_number`))) left join `qry_invoice_debit` `d` on((convert(`d`.`docnumber` using utf8) = `i`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'I') ;


-- Dumping structure for view simak.qry_invoice_credit
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_credit`;
CREATE VIEW `qry_invoice_credit` AS select `crdb_memo`.`docnumber` AS `docnumber`,sum(`crdb_memo`.`amount`) AS `cr_amount` from `crdb_memo` where (`crdb_memo`.`transtype` = _utf8'SO-CREDIT MEMO') group by `crdb_memo`.`docnumber` ;


-- Dumping structure for view simak.qry_invoice_debit
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_debit`;
CREATE VIEW `qry_invoice_debit` AS select `crdb_memo`.`docnumber` AS `docnumber`,sum(`crdb_memo`.`amount`) AS `db_amount` from `crdb_memo` where (`crdb_memo`.`transtype` = _utf8'SO-DEBIT MEMO') group by `crdb_memo`.`docnumber` ;


-- Dumping structure for view simak.qry_invoice_header_sum
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_header_sum`;
CREATE VIEW `qry_invoice_header_sum` AS select `ls_invoice_header`.`loan_id` AS `loan_id`,sum(`ls_invoice_header`.`pokok`) AS `z_pokok`,sum(`ls_invoice_header`.`pokok_paid`) AS `z_pokok_paid`,(sum(`ls_invoice_header`.`pokok`) - sum(`ls_invoice_header`.`pokok_paid`)) AS `z_saldo_pokok` from `ls_invoice_header` group by `ls_invoice_header`.`loan_id` ;


-- Dumping structure for view simak.qry_invoice_lancar_macet
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_lancar_macet`;
CREATE VIEW `qry_invoice_lancar_macet` AS select `ls_invoice_header`.`loan_id` AS `loan_id`,year(`ls_invoice_header`.`invoice_date`) AS `tahun`,month(`ls_invoice_header`.`invoice_date`) AS `bulan`,sum(if(((`ls_invoice_header`.`hari_telat` >= 0) and (`ls_invoice_header`.`hari_telat` < 7)),1,0)) AS `lancar`,sum(if(((`ls_invoice_header`.`hari_telat` >= 7) and (`ls_invoice_header`.`hari_telat` < 14)),1,0)) AS `kurang`,sum(if((`ls_invoice_header`.`hari_telat` >= 14),1,0)) AS `macet`,sum(if(((`ls_invoice_header`.`hari_telat` >= 0) and (`ls_invoice_header`.`hari_telat` < 7)),`ls_invoice_header`.`amount`,0)) AS `lancar_amt`,sum(if(((`ls_invoice_header`.`hari_telat` >= 7) and (`ls_invoice_header`.`hari_telat` < 14)),`ls_invoice_header`.`amount`,0)) AS `kurang_amt`,sum(if((`ls_invoice_header`.`hari_telat` >= 14),`ls_invoice_header`.`amount`,0)) AS `macet_amt` from `ls_invoice_header` group by `ls_invoice_header`.`loan_id`,year(`ls_invoice_header`.`invoice_date`),month(`ls_invoice_header`.`invoice_date`) ;


-- Dumping structure for view simak.qry_invoice_payment
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_payment`;
CREATE VIEW `qry_invoice_payment` AS select `payments`.`invoice_number` AS `invoice_number`,sum(`payments`.`amount_paid`) AS `payment` from `payments` group by `payments`.`invoice_number` ;


-- Dumping structure for view simak.qry_invoice_retur
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_invoice_retur`;
CREATE VIEW `qry_invoice_retur` AS select `invoice`.`your_order__` AS `your_order__`,sum(`invoice`.`amount`) AS `retur` from `invoice` where (`invoice`.`invoice_type` = _utf8'R') group by `invoice`.`invoice_number` ;


-- Dumping structure for view simak.qry_kartustock_adj
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_adj`;
CREATE VIEW `qry_kartustock_adj` AS select `i`.`date_trans` AS `tanggal`,_utf8'Adjustment' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,`s`.`description` AS `description`,abs(if((`i`.`to_qty` > 0),`i`.`to_qty`,0)) AS `qty_masuk`,abs(if((`i`.`to_qty` < 0),`i`.`to_qty`,0)) AS `qty_keluar`,0 AS `price`,`i`.`cost` AS `cost`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_masuk`,0 AS `amount_keluar`,`i`.`to_location` AS `gudang`,`i`.`comments` AS `comments` from (`inventory_moving` `i` left join `inventory` `s` on((`i`.`item_number` = `s`.`item_number`))) ;


-- Dumping structure for view simak.qry_kartustock_delivery
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_delivery`;
CREATE VIEW `qry_kartustock_delivery` AS select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Surat Jalan' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,0 AS `qty_masuk`,abs(`il`.`quantity`) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'D') ;


-- Dumping structure for view simak.qry_kartustock_etc_out
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_etc_out`;
CREATE VIEW `qry_kartustock_etc_out` AS select `pp`.`date_received` AS `tanggal`,`pp`.`receipt_type` AS `tipe`,`pp`.`receipt_type` AS `jenis`,_utf8'Unknown' AS `termin`,`pp`.`shipment_id` AS `no_sumber`,`pp`.`item_number` AS `item_number`,`s`.`description` AS `description`,0 AS `qty_masuk`,abs(`pp`.`quantity_received`) AS `qty_keluar`,`pp`.`unit` AS `unit`,`pp`.`cost` AS `price`,`pp`.`cost` AS `cost`,0 AS `discount`,0 AS `discount_amount`,`pp`.`total_amount` AS `amount`,`pp`.`warehouse_code` AS `gudang`,_utf8'IDR' AS `mata_uang`,1 AS `rate`,`pp`.`supplier_number` AS `supplier`,`pp`.`comments` AS `comments`,`pp`.`mu_qty` AS `mu_qty`,`pp`.`multi_unit` AS `multi_unit`,`pp`.`mu_price` AS `mu_price` from (`inventory_products` `pp` left join `inventory` `s` on((`pp`.`item_number` = `s`.`item_number`))) where (`pp`.`receipt_type` = _utf8'ETC_OUT') ;


-- Dumping structure for view simak.qry_kartustock_invoice
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_invoice`;
CREATE VIEW `qry_kartustock_invoice` AS select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Faktur Jual Kontan' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where ((`i`.`invoice_type` = _utf8'I') and (`i`.`payment_terms` in (_utf8'Cash',_utf8'',_utf8'Tunai',_utf8'Kontan'))) union all select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Surat Jalan' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where ((`i`.`invoice_type` = _utf8'D') and (`il`.`from_line_type` = _utf8'SO')) union all select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Retur Jual' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,abs(`il`.`quantity`) AS `qty_masuk`,0 AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'R') union all select `i`.`invoice_date` AS `tanggal`,`i`.`invoice_type` AS `tipe`,_utf8'Konsinyasi' AS `jenis`,`i`.`payment_terms` AS `termin`,`i`.`invoice_number` AS `no_sumber`,`il`.`item_number` AS `item_number`,`il`.`description` AS `description`,if((`il`.`quantity` < 0),abs(`il`.`quantity`),0) AS `qty_masuk`,if((`il`.`quantity` > 0),abs(`il`.`quantity`),0) AS `qty_keluar`,`il`.`unit` AS `unit`,`il`.`price` AS `price`,`il`.`cost` AS `cost`,`il`.`discount` AS `discount`,`il`.`discount_amount` AS `discount_amount`,`il`.`amount` AS `amount`,`il`.`warehouse_code` AS `gudang`,`il`.`currency_code` AS `mata_uang`,`il`.`currency_rate` AS `rate`,`i`.`sold_to_customer` AS `customer`,`i`.`comments` AS `comments`,`il`.`mu_qty` AS `mu_qty`,`il`.`multi_unit` AS `multi_unit`,`il`.`mu_harga` AS `mu_harga` from (`invoice` `i` left join `invoice_lineitems` `il` on((`i`.`invoice_number` = `il`.`invoice_number`))) where (`i`.`invoice_type` = _utf8'K') ;


-- Dumping structure for view simak.qry_kartustock_purchase
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_purchase`;
CREATE VIEW `qry_kartustock_purchase` AS select `p`.`po_date` AS `tanggal`,_utf8'BELI_KONTAN' AS `tipe`,_utf8'Faktur Beli Kredit' AS `jenis`,`p`.`terms` AS `terms`,`pi`.`purchase_order_number` AS `no_sumber`,`pi`.`item_number` AS `item_number`,`pi`.`description` AS `description`,`pi`.`quantity` AS `qty_masuk`,0 AS `qty_keluar`,`pi`.`unit` AS `unit`,`pi`.`price` AS `price`,`pi`.`price` AS `cost`,`pi`.`discount` AS `discount`,`pi`.`disc_amount_1` AS `disc_amount_1`,`pi`.`total_price` AS `amount_masuk`,0 AS `amount_keluar`,`pi`.`warehouse_code` AS `gudang`,`pi`.`currency_code` AS `mata_uang`,`pi`.`currency_rate` AS `rate`,`p`.`supplier_number` AS `supplier_number`,`pi`.`mu_qty` AS `mu_qty`,`pi`.`multi_unit` AS `multi_unit`,`pi`.`mu_harga` AS `mu_harga`,`p`.`comments` AS `comments` from (`purchase_order_lineitems` `pi` left join `purchase_order` `p` on((`p`.`purchase_order_number` = `pi`.`purchase_order_number`))) where ((`p`.`potype` = _utf8'I') and (`p`.`terms` in (_utf8'',_utf8'CASH',_utf8'TUNAI',_utf8'KONTAN'))) union all select `p`.`po_date` AS `tanggal`,_utf8'RET_BELI' AS `tipe`,_utf8'Retur Beli Kredit' AS `jenis`,`p`.`terms` AS `terms`,`pi`.`purchase_order_number` AS `no_sumber`,`pi`.`item_number` AS `item_number`,`pi`.`description` AS `description`,0 AS `qty_masuk`,abs(`pi`.`quantity`) AS `qty_keluar`,`pi`.`unit` AS `unit`,`pi`.`price` AS `price`,`pi`.`price` AS `cost`,`pi`.`discount` AS `discount`,`pi`.`disc_amount_1` AS `disc_amount_1`,`pi`.`total_price` AS `amount_masuk`,0 AS `amount_keluar`,`pi`.`warehouse_code` AS `gudang`,`pi`.`currency_code` AS `mata_uang`,`pi`.`currency_rate` AS `rate`,`p`.`supplier_number` AS `supplier_number`,`pi`.`mu_qty` AS `mu_qty`,`pi`.`multi_unit` AS `multi_unit`,`pi`.`mu_harga` AS `mu_harga`,`p`.`comments` AS `comments` from (`purchase_order_lineitems` `pi` left join `purchase_order` `p` on((`p`.`purchase_order_number` = `pi`.`purchase_order_number`))) where (`p`.`potype` = _utf8'R') ;


-- Dumping structure for view simak.qry_kartustock_receipt
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_receipt`;
CREATE VIEW `qry_kartustock_receipt` AS select `pp`.`date_received` AS `tanggal`,`pp`.`receipt_type` AS `tipe`,`pp`.`receipt_type` AS `jenis`,_utf8'Unknown' AS `termin`,`pp`.`shipment_id` AS `no_sumber`,`pp`.`item_number` AS `item_number`,`s`.`description` AS `description`,abs(if((`pp`.`quantity_received` > 0),`pp`.`quantity_received`,0)) AS `qty_masuk`,abs(if((`pp`.`quantity_received` < 0),`pp`.`quantity_received`,0)) AS `qty_keluar`,`pp`.`unit` AS `unit`,`pp`.`cost` AS `price`,`pp`.`cost` AS `cost`,0 AS `discount`,0 AS `discount_amount`,`pp`.`total_amount` AS `amount`,`pp`.`warehouse_code` AS `gudang`,_utf8'IDR' AS `mata_uang`,1 AS `rate`,`pp`.`supplier_number` AS `supplier`,`pp`.`comments` AS `comments`,`pp`.`mu_qty` AS `mu_qty`,`pp`.`multi_unit` AS `multi_unit`,`pp`.`mu_price` AS `mu_price` from (`inventory_products` `pp` left join `inventory` `s` on((`pp`.`item_number` = `s`.`item_number`))) where (`pp`.`receipt_type` not in (_utf8'INVOICE',_utf8'RET_BELI',_utf8'ETC_OUT')) ;


-- Dumping structure for view simak.qry_kartustock_transfer
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_transfer`;
CREATE VIEW `qry_kartustock_transfer` AS select `i`.`date_trans` AS `tanggal`,_utf8'Transfer' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,`s`.`description` AS `description`,0 AS `qty_masuk`,abs(`i`.`to_qty`) AS `qty_keluar`,0 AS `price`,0 AS `cost`,0 AS `amount_masuk`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_keluar`,`i`.`from_location` AS `gudang`,`i`.`comments` AS `comments` from (`inventory_moving` `i` left join `inventory` `s` on((`i`.`item_number` = `s`.`item_number`))) where (`i`.`from_location` <> `i`.`to_location`) union all select `i`.`date_trans` AS `tanggal`,_utf8'Transfer' AS `jenis`,`i`.`transfer_id` AS `no_sumber`,`i`.`item_number` AS `item_number`,`s`.`description` AS `description`,abs(`i`.`to_qty`) AS `qty_masuk`,0 AS `qty_keluar`,0 AS `price`,0 AS `cost`,(`i`.`cost` * abs(`i`.`to_qty`)) AS `amount_masuk`,0 AS `amount_keluar`,`i`.`to_location` AS `gudang`,`i`.`comments` AS `comments` from (`inventory_moving` `i` left join `inventory` `s` on((`i`.`item_number` = `s`.`item_number`))) where (`i`.`from_location` <> `i`.`to_location`) ;


-- Dumping structure for view simak.qry_kartustock_union
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `qry_kartustock_union`;
CREATE VIEW `qry_kartustock_union` AS select `i`.`tanggal` AS `tanggal`,`i`.`jenis` AS `jenis`,`i`.`no_sumber` AS `no_sumber`,`i`.`item_number` AS `item_number`,`i`.`description` AS `description`,`i`.`qty_masuk` AS `qty_masuk`,`i`.`qty_keluar` AS `qty_keluar`,`i`.`price` AS `price`,`i`.`cost` AS `cost`,if((`i`.`qty_masuk` > 0),(`i`.`cost` * `i`.`qty_masuk`),0) AS `amount_masuk`,if((`i`.`qty_masuk` > 0),0,(`i`.`cost` * `i`.`qty_keluar`)) AS `amount_keluar`,`i`.`gudang` AS `gudang`,`i`.`comments` AS `comments` from `qry_kartustock_invoice` `i` where (`i`.`item_number` is not null) union all select `r`.`tanggal` AS `tanggal`,`r`.`jenis` AS `jenis`,`r`.`no_sumber` AS `no_sumber`,`r`.`item_number` AS `item_number`,`r`.`description` AS `description`,`r`.`qty_masuk` AS `qty_masuk`,`r`.`qty_keluar` AS `qty_keluar`,`r`.`price` AS `price`,`r`.`cost` AS `cost`,if((`r`.`qty_masuk` > 0),(`r`.`cost` * `r`.`qty_masuk`),0) AS `amount_masuk`,if((`r`.`qty_masuk` > 0),0,(`r`.`cost` * `r`.`qty_keluar`)) AS `amount_keluar`,`r`.`gudang` AS `gudang`,`r`.`comments` AS `comments` from `qry_kartustock_receipt` `r` union all select `r`.`tanggal` AS `tanggal`,`r`.`jenis` AS `jenis`,`r`.`no_sumber` AS `no_sumber`,`r`.`item_number` AS `item_number`,`r`.`description` AS `description`,`r`.`qty_masuk` AS `qty_masuk`,`r`.`qty_keluar` AS `qty_keluar`,`r`.`price` AS `price`,`r`.`cost` AS `cost`,if((`r`.`qty_masuk` > 0),(`r`.`cost` * `r`.`qty_masuk`),0) AS `amount_masuk`,if((`r`.`qty_masuk` > 0),0,(`r`.`cost` * `r`.`qty_keluar`)) AS `amount_keluar`,`r`.`gudang` AS `gudang`,`r`.`comments` AS `comments` from `qry_kartustock_etc_out` `r` union all select `p`.`tanggal` AS `tanggal`,`p`.`jenis` AS `jenis`,`p`.`no_sumber` AS `no_sumber`,`p`.`item_number` AS `item_number`,`p`.`description` AS `description`,`p`.`qty_masuk` AS `qty_masuk`,`p`.`qty_keluar` AS `qty_keluar`,`p`.`price` AS `price`,`p`.`cost` AS `cost`,`p`.`amount_masuk` AS `amount_masuk`,`p`.`amount_keluar` AS `amount_keluar`,`p`.`gudang` AS `gudang`,`p`.`comments` AS `comments` from `qry_kartustock_purchase` `p` union all select `adj`.`tanggal` AS `tanggal`,`adj`.`jenis` AS `jenis`,`adj`.`no_sumber` AS `no_sumber`,`adj`.`item_number` AS `item_number`,`adj`.`description` AS `description`,`adj`.`qty_masuk` AS `qty_masuk`,`adj`.`qty_keluar` AS `qty_keluar`,`adj`.`price` AS `price`,`adj`.`cost` AS `cost`,`adj`.`amount_masuk` AS `amount_masuk`,`adj`.`amount_keluar` AS `amount_keluar`,`adj`.`gudang` AS `gudang`,`adj`.`comments` AS `comments` from `qry_kartustock_adj` `adj` union all select `trn`.`tanggal` AS `tanggal`,`trn`.`jenis` AS `jenis`,`trn`.`no_sumber` AS `no_sumber`,`trn`.`item_number` AS `item_number`,`trn`.`description` AS `description`,`trn`.`qty_masuk` AS `qty_masuk`,`trn`.`qty_keluar` AS `qty_keluar`,`trn`.`price` AS `price`,`trn`.`cost` AS `cost`,`trn`.`amount_masuk` AS `amount_masuk`,`trn`.`amount_keluar` AS `amount_keluar`,`trn`.`gudang` AS `gudang`,`trn`.`comments` AS `comments` from `qry_kartustock_transfer` `trn` ;

-- ----------------------------
-- View structure for qry_kartu_hutang
-- ----------------------------
DROP TABLE IF EXISTS `qry_kartu_hutang`;
CREATE VIEW `qry_kartu_hutang` AS select `payables`.`invoice_date` AS `Tanggal`,if(`payables`.`purchase_order`,`payables`.`purchase_order_number`,`payables`.`bill_id`) AS `NoBukti`,`payables`.`bill_id` AS `Ref1`,`payables`.`invoice_number` AS `ref2`,'Faktur' AS `Jenis`,`payables`.`supplier_number` AS `Supplier_Number`,`payables`.`amount` AS `amount` from `payables` union all select `pp`.`date_paid` AS `date_paid`,`cw`.`voucher` AS `voucher`,`pp`.`bill_id` AS `bill_id`,`pp`.`trans_id` AS `trans_id`,'Bayar' AS `jenis`,`p`.`supplier_number` AS `supplier_number`,(-(1) * `pp`.`amount_paid`) AS `jumlah` from ((`payables_payments` `pp` left join `payables` `p` on((`p`.`bill_id` = `pp`.`bill_id`))) left join `check_writer` `cw` on((`cw`.`trans_id` = `pp`.`trans_id`))) union all select `purchase_order`.`po_date` AS `po_date`,`purchase_order`.`purchase_order_number` AS `purchase_order_number`,`purchase_order`.`po_ref` AS `po_ref`,'' AS `ref2`,'Retur' AS `jenis`,`purchase_order`.`supplier_number` AS `supplier_number`,(-(1) * abs(`purchase_order`.`saldo_invoice`)) AS `jumlah` from `purchase_order` where (`purchase_order`.`potype` = 'R') union all select `c`.`tanggal` AS `tanggal`,`c`.`kodecrdb` AS `kodecrdb`,`c`.`docnumber` AS `docnumber`,'' AS `ref2`,'Debit Memo' AS `jenis`,`p`.`supplier_number` AS `supplier_number`,(-(1) * abs(`c`.`amount`)) AS `jumlah` from (`crdb_memo` `c` left join `purchase_order` `p` on((`p`.`purchase_order_number` = `c`.`docnumber`))) where (`c`.`transtype` = 'PO-DEBIT MEMO') union all select `c`.`tanggal` AS `tanggal`,`c`.`kodecrdb` AS `kodecrdb`,`c`.`docnumber` AS `docnumber`,'' AS `ref2`,'Credit Memo' AS `jenis`,`p`.`supplier_number` AS `supplier_number`,`c`.`amount` AS `amount` from (`crdb_memo` `c` left join `purchase_order` `p` on((`p`.`purchase_order_number` = `c`.`docnumber`))) where (`c`.`transtype` = 'PO-CREDIT MEMO');

-- ----------------------------
-- View structure for qry_kartu_piutang
-- ----------------------------
DROP TABLE IF EXISTS `qry_kartu_piutang`;
CREATE VIEW `qry_kartu_piutang` AS select `invoice`.`invoice_type` AS `Jenis`,`invoice`.`invoice_number` AS `Ref`,`invoice`.`invoice_number` AS `NoBukti`,`invoice`.`invoice_date` AS `Tanggal`,`invoice`.`amount` AS `Amount`,`invoice`.`sold_to_customer` AS `customer_number` from `invoice` where (`invoice`.`invoice_type` = 'I') union all select `invoice`.`invoice_type` AS `Jenis`,`invoice`.`your_order__` AS `Ref`,`invoice`.`invoice_number` AS `NoBukti`,`invoice`.`invoice_date` AS `Tanggal`,(`invoice`.`amount` * -(1)) AS `Jumlah`,`invoice`.`sold_to_customer` AS `customer_number` from `invoice` where (`invoice`.`invoice_type` = 'R') union all select 'P' AS `Jenis`,`p`.`invoice_number` AS `Ref`,`p`.`no_bukti` AS `no_bukti`,`p`.`date_paid` AS `date_paid`,(`p`.`amount_paid` * -(1)) AS `jumlah`,`i`.`sold_to_customer` AS `customer_number` from (`payments` `p` left join `invoice` `i` on((`p`.`invoice_number` = `i`.`invoice_number`))) union all select 'C' AS `Jenis`,`crdb_memo`.`docnumber` AS `DocNumber`,`crdb_memo`.`kodecrdb` AS `KodeCrDb`,`crdb_memo`.`tanggal` AS `Tanggal`,(-(1) * `crdb_memo`.`amount`) AS `jumlah`,'unknown' AS `unknown` from `crdb_memo` where (`crdb_memo`.`transtype` = 'SO-CREDIT MEMO') union all select 'C' AS `Jenis`,`crdb_memo`.`docnumber` AS `DocNumber`,`crdb_memo`.`kodecrdb` AS `KodeCrDb`,`crdb_memo`.`tanggal` AS `Tanggal`,`crdb_memo`.`amount` AS `Amount`,'unknown' AS `unknown` from `crdb_memo` where (`crdb_memo`.`transtype` = 'SO-DEBIT MEMO');

-- ----------------------------
-- View structure for qry_loan_by_counter
-- ----------------------------
DROP TABLE IF EXISTS `qry_loan_by_counter`;
CREATE VIEW `qry_loan_by_counter` AS select `lc`.`area_name` AS `area_name`,`lc`.`area` AS `area`,`lam`.`counter_id` AS `counter_id`,`lc`.`counter_name` AS `counter_name`,year(`l`.`loan_date`) AS `tahun`,month(`l`.`loan_date`) AS `bulan`,sum(`l`.`loan_amount`) AS `z_loan`,sum(`l`.`ar_bal_amount`) AS `z_balance`,sum(`l`.`total_amount_paid`) AS `z_payment`,sum(`z_ih`.`z_pokok`) AS `z_pokok`,sum(`z_ih`.`z_saldo_pokok`) AS `z_saldo_pokok_sum`,count(1) AS `z_noa`,sum(`h`.`lancar`) AS `z_lancar`,sum(`h`.`kurang`) AS `z_kurang`,sum(`h`.`macet`) AS `z_macet`,sum(`h`.`lancar_amt`) AS `z_lancar_amt`,sum(`h`.`kurang_amt`) AS `z_kurang_amt`,sum(`h`.`macet_amt`) AS `z_macet_amt`,sum(`loi`.`price`) AS `z_price` from (((((`ls_loan_master` `l` left join `qry_invoice_header_sum` `z_ih` on((`z_ih`.`loan_id` = `l`.`loan_id`))) left join `ls_loan_obj_items` `loi` on((`loi`.`loan_id` = `l`.`loan_id`))) left join `ls_app_master` `lam` on((`lam`.`app_id` = `l`.`app_id`))) left join `ls_counter` `lc` on((`lc`.`counter_id` = `lam`.`counter_id`))) left join `qry_invoice_lancar_macet` `h` on(((`h`.`loan_id` = `l`.`loan_id`) and (`h`.`tahun` = year(`l`.`loan_date`)) and (`h`.`bulan` = month(`l`.`loan_date`))))) where (`l`.`status` = 1) group by `lc`.`area_name`,`lc`.`counter_name`,year(`l`.`loan_date`),month(`l`.`loan_date`);

-- ----------------------------
-- View structure for qry_ls_cash_receive
-- ----------------------------
DROP TABLE IF EXISTS `qry_ls_cash_receive`;
CREATE  VIEW `qry_ls_cash_receive` AS select 'INV' AS `jenis`,`p`.`date_paid` AS `tanggal`,`ih`.`invoice_number` AS `no_bukti`,`p`.`voucher_no` AS `ref`,`p`.`amount_paid` AS `amount_recv`,`ih`.`paid` AS `status`,`c`.`cust_name` AS `cust_name`,`ih`.`posted` AS `posted`,ifnull(`p`.`create_by`,`lam`.`create_by`) AS `create_by`,`u`.`username` AS `username`,`lc`.`area_name` AS `area_name`,`lc`.`counter_name` AS `counter_name`,`ih`.`pokok` AS `pokok`,`p`.`pokok` AS `pokok_paid`,`p`.`bunga` AS `bunga_paid`,`ih`.`bunga` AS `bunga`,`lam`.`dp_prc` AS `dp_prc`,0 AS `z_dp_amount`,0 AS `z_admin_amount`,`p`.`denda` AS `denda_paid`,`ih`.`saldo` AS `saldo`,`ih`.`saldo_titip` AS `saldo_titip`,`ih`.`denda_tagih` AS `denda_tagih`,`p`.`how_paid` AS `payment_method` from ((((((`ls_invoice_payments` `p` left join `ls_invoice_header` `ih` on((`ih`.`invoice_number` = convert(`p`.`invoice_number` using utf8)))) left join `ls_cust_master` `c` on((`c`.`cust_id` = `ih`.`cust_deal_id`))) left join `ls_loan_master` `l` on((`l`.`loan_id` = `ih`.`loan_id`))) left join `ls_app_master` `lam` on((`lam`.`app_id` = `l`.`app_id`))) left join `ls_counter` `lc` on((`lc`.`counter_id` = `lam`.`counter_id`))) left join `user` `u` on((`u`.`user_id` = `p`.`create_by`))) union all select 'DP' AS `jenis`,`l`.`loan_date` AS `loan_date`,`m`.`app_id` AS `app_id`,`l`.`loan_id` AS `loan_id`,(`m`.`dp_amount` + `m`.`admin_amount`) AS `m.dp_amount+m.admin_amount`,`m`.`status` AS `status`,`c`.`cust_name` AS `cust_name`,`l`.`posted` AS `posted`,`m`.`create_by` AS `create_by`,`u`.`username` AS `username`,`lc`.`area_name` AS `area_name`,`lc`.`counter_name` AS `counter_name`,0 AS `0`,0 AS `My_exp_0`,0 AS `My_exp_1_0`,0 AS `My_exp_2_0`,`m`.`dp_prc` AS `dp_prc`,`m`.`dp_amount` AS `m_dp_amount`,`m`.`admin_amount` AS `admin_amount`,0 AS `denda_paid`,0 AS `saldo`,0 AS `saldo_titip`,0 AS `denda_tagih`,'Cash' AS `payment_method` from ((((`ls_app_master` `m` left join `ls_cust_master` `c` on((`c`.`cust_id` = `m`.`cust_id`))) left join `ls_loan_master` `l` on((`l`.`app_id` = `m`.`app_id`))) left join `ls_counter` `lc` on((`lc`.`counter_id` = `m`.`counter_id`))) left join `user` `u` on((`u`.`user_id` = `m`.`create_by`))) where (`m`.`status` = 'Finish');
-- ----------------------------
-- View structure for c02_qry_payroll_component
-- ----------------------------
DROP TABLE IF EXISTS `qry_payroll_component`;
CREATE  VIEW `qry_payroll_component` AS select 'income' AS `jenis`,`jenis_tunjangan`.`kode` AS `kode`,`jenis_tunjangan`.`keterangan` AS `keterangan`,`jenis_tunjangan`.`sifat` AS `sifat`,`jenis_tunjangan`.`is_variable` AS `is_variable`,`jenis_tunjangan`.`ref_column` AS `ref_column` from `jenis_tunjangan` union all select 'deduct' AS `jenis`,`jenis_potongan`.`kode` AS `kode`,`jenis_potongan`.`keterangan` AS `keterangan`,`jenis_potongan`.`sifat` AS `sifat`,`jenis_potongan`.`is_variable` AS `is_variable`,`jenis_potongan`.`ref_column` AS `ref_column` from `jenis_potongan`;

