<legend><?=$caption?></legend>
<div class='alert alert-info'>
    <p>Silahkan pilih / contreng jurnal-jurnal yang sudah divalidasi dibawah ini, 
        kemudian klik tombol [Submit]</p>
</div>
<div class='col-md-12'>
    <?php
    $period_list=$this->periode_model->loadlist();
    $period=date("Y-m");
    $trans_type="";
    $valid="";
    if($this->input->post('submit')){
        $period=$this->input->post("period");
        $selected=$this->input->post("selected");
        for($i=0;$i<count($selected);$i++){
            $glid=$selected[$i];
            $this->jurnal_model->validate_process($glid,$valid);
        }
        redirect("jurnal/validate");
        
    } else if($this->input->post('refresh')){
        $period=$this->input->post("period");
        $trans_type=$this->input->post('trans_type');
        $valid=$this->input->post('valid');
    }
    $jurnal_list=$this->jurnal_model->loadlist_validate($period,$trans_type,$valid);
    $trans_type_list=array(""=>"All",1=>"Penjualan",2=>"Pembelian",3=>"Buku Kas",
        4=>"Persediaan",5=>"Memorial",6=>"Asset",7=>"Payroll");
    echo form_open();
    echo "<p>";
    echo form_checkbox("select_all","","" ," style='width:30px'")." Select All ";    
    echo form_dropdown('period',$period_list,$period,"style='width:90px'");
    echo " Transaksi: ".form_dropdown("trans_type",$trans_type_list,$trans_type);
    echo form_dropdown('valid',array(""=>"Belum Validasi","1"=>"Sudah Validasi",$valid));
    echo form_submit('refresh',' Refresh ',"class='btn btn-info'");
    echo form_submit('submit',' Submit ',"class='btn btn-warning'");
    echo "</p>";
    echo "<table class='table'>";
    echo "<tr><td>Pilih</td><td>Kode</td><td>Tanggal</td><td align='right'>Debit</td>
        <td align='right'>Credit</td><td align='right'>Saldo</td> </tr>";
    for($i=0;$i<count($jurnal_list);$i++){
        $j=$jurnal_list[$i];
        echo "<tr>";
        echo "<td>".form_checkbox("selected[]",$j->gl_id,"","style='width:30px'")."</td>";
        $db=number_format($j->debit_sum);
        $cr=number_format($j->credit_sum);
        $saldo=number_format($j->saldo);
        echo "<td>$j->gl_id</td><td>$j->date1</td><td align='right'>$db</td>
        <td align='right'>$cr</td><td align='right'>$saldo</td> ";
        echo "</tr>";        
    }
    echo "</table>";
    echo form_close();
    
    
    ?>
    
</div>
<script language='JavaScript'>
$("input[name='select_all']").change(function() {
    var checkboxes = $(this).closest('form').find(':checkbox');
    checkboxes.prop('checked', $(this).is(':checked'));
});
</script>
