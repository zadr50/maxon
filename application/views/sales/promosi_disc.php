<?php
echo load_view("aed_button");
?>
<form id="frmPromosi"  method="post">
    <table class='table2' width="100%">
        <tr>
            <td>Kode Promo</td><td><?=form_input('promosi_code',$promosi_code,"id=promosi_code")?></td>
            <td>Nama Promosi</td><td><?=form_input('description',$description,"id='description' style='width:300px'")?></td>
        </tr>
        <tr>
            <td>Tanggal Awal</td>
            <td><?=form_input('date_from',$date_from,'id=date_from 
                class="easyui-datetimebox" required style="width:150px"
                data-options="formatter:format_date,parser:parse_date"')?>
            </td>
            <td>Tanggal Akhir</td>
            <td><?=form_input('date_to',$date_to,'id=date_to 
                class="easyui-datetimebox" required style="width:150px"
                data-options="formatter:format_date,parser:parse_date"')?>
            </td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td><input type="radio" name="tipe" value="2" <?=$tipe==2?"checked":""?> style="width:20px"/> Persen<br>
                <input type="radio" name="tipe" value="1" <?=$tipe==1?"checked":""?> style="width:20px"/> Amount<br>
            </td>
            <td>Nilai</td><td><?=form_input("nilai",$nilai,"id='nilai' style='width:50px'")?>
                + <?=form_input("nilai2",$nilai2,"id='nilai2' style='width:50px'")?>
                + <?=form_input("nilai3",$nilai3,"id='nilai3' style='width:50px'")?>
            </td>
        </tr>
    </table>
    <input type='hidden' id='mode' name='mode' value='<?=$mode?>'>

</form>

<?php 
if($mode=="view"){
    include_once "promosi_item_dtl.php";
}
echo $lookup_inventory;
echo $lookup_category;
echo $lookup_supplier;
echo $lookup_merk;
?>
<script type="text/javascript">

    var allow_add=<?=$allow_add?>;
    var allow_edit=<?=$allow_edit?>;
    var allow_delete=<?=$allow_delete?>;
    var url;	
	$().ready(function(){
		load_items();		
	});


    function load_items(){
		var nomor=$("#promosi_code").val();								
		$('#dgItemPromo').datagrid({url:'<?=base_url()?>index.php/so/promosi_disc/items/'+nomor});
		$("#dgItemPromo").datagrid("reload");
	}
    function refresh_aed(){
        display();
    }
	function display(){
		var nomor=$("#promosi_code").val();
		window.open(CI_ROOT+"so/promosi_disc/view/"+nomor,"_self");
	}
    function valid(){
        if($('#promosi_code').val()==''){log_err('Isi kode promosi !');return false;}
        if($('#description').val()==''){log_err('Isi nama promosi !');return false;}
        if($('#nilai').val()==''||$("#nilai").val()=="0"){log_err('Isi Nilai atau pesentase !');return false;}        
		if( ! (allow_add || allow_edit) ) {
			log_msg(ERR_ACCESS_MODULE);
			return false;
		}
        return true;
    }
    function save_aed(){
        
        if(!valid)return false;

		$("#divToolbar").hide();
		
		loading();
		
		url='<?=base_url()?>index.php/so/promosi_disc/save';
        $('#frmPromosi').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.success){
                    loading_close();
                    $("#divToolbar").show();                    
                    $('#promosi_code').val(result.promosi_code);
                    log_msg('Data sudah tersimpan. Silahkan pilih nama barang2 promosi');
                    display();
                } else {
                    loading_close();
                    log_err(result.msg);
                }
            }
        });

    }

</script>
