<?php 
echo $this->list_of_values->render(array(
    "dlgBindId"=>"chart_of_accounts",
    "dlgColsData"=>array("account","account_description","group_id","id"),
    "dlgRetFunc"=>"
        $('#'+idd).val(row.account+' - '+row.account_description);        
        $('#account').val(row.account);
        $('#description').val(row.account_description);
        $('#account_id').val(row.id);                
    "
));
?>
<script type="text/javascript">
    var idd='';
    function lookup_coa(id) {
        idd=id;
        dlgchart_of_accounts_show();
    }
</script>