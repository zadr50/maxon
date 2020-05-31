<link href="<?php echo base_url();?>/themes/standard/style_print.css" rel="stylesheet">
<?php
     $CI =& get_instance();
     $CI->load->model('company_model');
     $model=$CI->company_model->get_by_id($CI->access->cid)->row();
?>
<table cellspacing="0" cellpadding="1" border="0" width='800px'> 
     <tr>
        <td colspan='2'><h2><?=$model->company_name?></h2></td><td colspan='2'><h2>CHART OF ACCOUNTS</h2></td>      
     </tr>
     <tr><td colspan=4 style='border-bottom: black solid 1px'></td></tr>
     <tr>
        <td colspan="8">
                <table class='titem'>
                <thead>
                    <tr><td>Kode Akun</td><td>Nama Akun</td><td >DB/CR</td>
                    	<td>Saldo Awal</td><td>Id</td>
                    </tr>
                </thead>
                <tbody>
<?php
$s="select * from chart_of_accounts order by account_type,account";
if($q=$this->db->query($s)){
	foreach($q->result() as $r){
		echo "<tr><td>$r->account</td><td>$r->account_description</td>
		<td>$r->db_or_cr</td><td>$r->beginning_balance</td><td>$r->id</td></tr>";
	}
}
?>  
                </tbody>
            </table>
        
        </td>
     </tr>
</table>
