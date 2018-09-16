<?php 
    echo $this->list_of_values->render(array(
        "dlgBindId"=>"bank_accounts",
        "dlgColsData"=>array("bank_account_number","bank_name"),
        "dlgRetFunc"=>"
            $('#bank_account_number').val(row.bank_account_number);
            $('#bank_name').html(row.bank_name);
        "
    ));
?>
<script type="text/javascript">
	function lookup_bank() {
	    dlgbank_accounts_show();
	}
</script>
<!-- END DIALOG KODE REKENING -->
