<script type="text/javascript">
	CI_ROOT = "<?=base_url()?>index.php/";
	CI_BASE = "<?=base_url()?>"; 		
    CI_CONTROL='<?=$controller?>';
    FIELD_KEY='<?=$field_key?>';
    CI_CAPTION='<?=$caption?>';
</script>

<legend>LAPORAN DATA APLIKASI KREDIT</legend>
<ul>
	<li><a href='#' onclick="print_001();return false">001. Daftar Aplikasi Kredit</a></li>
	<li><a href="#" onclick="print_002();return false">002. Daftar Aplikasi Kredit Summary</a></li>
</ul>

<script language="javascript">
	function print_001(){
		var url='<?=base_url()?>index.php/leasing/reports/app_master/001';
		add_tab_parent("Print_001",url);
	}
	function print_002(){
		var url='<?=base_url()?>index.php/leasing/reports/app_master/002';
		add_tab_parent("Print_002",url);
	}
	function print_003(){
		var url='<?=base_url()?>index.php/leasing/reports/app_master/003';
		add_tab_parent("Print_003",url);
	}
	
</script>