<?php 
echo $this->list_of_values->render(array(
    "dlgBindId"=>"employee",
    "dlgColsData"=>array("nip","nama","dept","divisi","city","emptype","nip_id"),
    "dlgRetFunc"=>"
        $('#nip').val(row.nip);
        $('#nama').val(row.nama);
        $('#nip_id').val(row.nip_id);
        $('#employee_id').val(row.nip);
        $('#dept').val(row.dept);
        $('#divisi').val(row.divisi);
        $('#emptype').val(row.emptype);
        $('#emp_level').val(row.emptype);
        $('#nama').html(row.nama);
        $('#dept').html(row.dept);
        $('#divisi').html(row.divisi);
        $('#emptype').html(row.emptype);
        $('#emp_level').html(row.emptype);
                
        
    "
));
?>
<script language="JavaScript">
	function lookup_employee()	{
	    dlgemployee_show();
	}
</script>