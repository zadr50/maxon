<?php 
    $disabled="";$disabled_edit="";
    if(!($mode=="add"))$disabled=" readonly='readonly'";
	$url=base_url()."index.php/courier/booking_dom";
    $dat['show_print']=true;
    $dat['mode']=$mode;
    $dat['show_posting']=false;
    $dat['extra_button']=link_button('Invoice','create_invoice()','ok');
    echo load_view("aed_button",$dat);
    $err=validation_errors(); 
    if($err!="") echo "<div class='alert alert-warning'>$err</div>"; 
    
?>
    
<form id='frmMain' method="post">
<input type='hidden' name='mode' id='mode'	value='<?=$mode?>'>
   <table class='table' width="100%">
		<tr>
			<td>Nomor Book</td>
			<td><?php
				echo my_input3(array("field"=>'book_no',"value"=>$book_no, 
				"extra"=>"class='easyui-validatebox' 
				    data-options='required:true,	
				    validType:length[3,30]' $disabled")); 
			?></td>
            <td>Tanggal</td><td><?=form_input_date('bk_date',$bk_date)?></td>
            <td>Kota Asal</td><td><?=my_input3(array("field"=>"origin",
                "value"=>$origin,"button"=>true,"func"=>"dlgkecamatan_show()"))?>
            </td>
		</tr>
		<tr>	
            <td>Pengirim </td><td><?=my_input3(array("field"=>"sender",
                "value"=>$sender,"button"=>true,"func"=>"dlgcustomers_show()"))?>
            </td>
            <td>Penerima </td><td><?=my_input3(array("field"=>"ce_name",
                "value"=>$ce_name,"button"=>true,"func"=>"dlgcustomers2_show()"))?>
            </td>
            <td>Kota Tujuan</td><td><?=my_input3(array("field"=>"destination",
                "value"=>$destination,"button"=>true,"func"=>"dlgkecamatan2_show()"))?>
            </td>
        </tr>
        <tr>    
            <td>Nama</td><td><?=form_input("company",$company,"id='company'")?></td>            
            <td>Nama</td><td><?=form_input("ce_company",$ce_company,"id='ce_company'")?></td>            
            <td>Service</td><td><?=my_input3(array("field"=>"service",
                "value"=>$service,"button"=>true,"func"=>"dlgservice_show()"))?>
            </td>
       </tr>	 
       <tr>
            <td>Alamat</td><td><?=form_input("address1",$address1,"id='address1'")?></td>            
            <td>Alamat</td><td><?=form_input("ce_address1",$ce_address1,"id='ce_address1'")?></td>            
            <td>Status </td><td><?=my_input3(array("field"=>"status",
                 "value"=>$status,"button"=>true,"func"=>"dlgstatus_show()"))?>
            </td>
       </tr>     
       <tr>
            <td>Blok</td><td><?=form_input("address2",$address2,"id='address2'")?></td>            
            <td>Blok</td><td><?=form_input("ce_address2",$ce_address2,"id='ce_address2'")?></td>            
            <td>Shipping</td><td><?=my_input3(array("field"=>"ship_type",
                "value"=>$ship_type,"button"=>true,"func"=>"dlgship_type_show()"))?>
            </td>
       </tr>     
       <tr>
            <td>Negara</td><td><?=form_input("country",$country,"id='country' style='width:80px'")?></td>            
            <td>Negara</td><td><?=form_input("ce_country",$ce_country,"id='ce_country' style='width:80px'")?></td>            
            <td>Sub Shipping</td><td><?=my_input3(array("field"=>"sub_ship",
                "value"=>$sub_ship,"button"=>true,"func"=>"dlgsub_ship_show()"))?>
            </td>
       </tr>     
       <tr>
            <td>Kota </td><td><?=form_input("city",$city,"id='city'")?></td>                
            <td>Kota </td><td><?=form_input("ce_city",$ce_city,"id='ce_city'")?></td>                
            <td>Tarif Berat </td><td><?=form_input("tarif_berat",$tarif_berat,"id='tarif_berat'")?></td>                
       </tr>
       <tr>
            <td>Keterangan</td><td colspan=3><?=form_input("dlv_remarks",$dlv_remarks,"id='div_remarks' style='width:300px'")?></td>            
            <td>Tarif Volume </td><td><?=form_input("tarif_volume",$tarif_volume,"id='tarif_volume'")?></td>                
       </tr>
   </table>
</form>
</div> 
 
<div class="easyui-tabs" >
	<div title="Items" style="padding:10px">
	<!-- DETAIL -->	
	<div id='divItem'>
		<table id="dgItem" class="easyui-datagrid"  width="100%"
		      data-options="iconCls: 'icon-edit',
				singleSelect: true,toolbar: '#tbItem',fitColumns: true, 
				url: '<?=$url.'/items/'.$book_no?>' ">
			<thead>
				<tr>
				    <?=grid_fields("booking_dom_detail","item,qty,weight,tarif_berat,p,l,t,v,tarif_volume,biaya,total_berat,total_volume,id")?>
				</tr>
			</thead>
		</table>
	<!-- END DETAIL -->
	</div>	
	</div>
</div>
<div id="tbItem" class="box-gradient">
	<?=link_button('Add','add_item()','add');	?>	
	<?=link_button('Refresh','load_item()','reload');	?>	
	<?=link_button('View','view_item()','edit');	?>	
    <?=link_button('Delete','delete_item()','remove');    ?>  
</div>

<div id='dlgItem' class="easyui-dialog"  background='black'
 closed="true"  buttons="#btnItem">
   <form id='frmItem' method="post">
   <table class='table' width="100%">
        <tr>
            <td>Item </td><td><?=form_input("item","","id='item'")?></td>                
            <td>Qty </td><td><?=form_input("qty","","id='qty' onBlur='calc_tarif()'")?></td>                
            <td>Berat </td><td><?=form_input("weight","","id='weight'  onBlur='calc_tarif()'")?></td>                
        </tr>
        <tr>
            <td>Panjang </td><td><?=form_input("p","","id='p'   onBlur='calc_tarif()'")?></td>                
            <td>Lebar </td><td><?=form_input("l","","id='l' onBlur='calc_tarif()'")?></td>                
            <td>Tinggi </td><td><?=form_input("t","","id='t' onBlur='calc_tarif()'")?></td>                
        </tr>
        <tr>
            <td>Volume </td><td><?=form_input("v","","id='v'")?></td>                
            <td>Tarif Berat </td><td><?=form_input("tarif_berat","","id='tarif_berat2'")?></td>                
            <td>Tarif Volume </td><td><?=form_input("tarif_volume","","id='tarif_volume2'")?></td>                
        </tr>
        <tr>
            <td>Jenis </td><td><?=form_input("jenis_biaya","BERAT","id='jenis_biaya'")?></td>                
            <td>Total  Berat </td><td><?=form_input("total_berat","","id='total_berat'")?></td>                
            <td>Total Volume </td><td><?=form_input("total_volume","","id='total_volume'")?></td>                
        </tr>
        <tr>
            <td>Book No </td><td><?=form_input("book_no",$book_no," readonly='readonly'")?></td>                
            <td>Id </td><td><?=form_input("id","","id='id_item'  readonly='readonly'")?></td>                
            <td>Biaya </td><td><?=form_input("biaya","","id='biaya'")?></td>                
        </tr>
   </table>
   </form> 
</div>
<div id="btnItem" class='box-gradient'>
    <?=link_button('Submit','save_item()','save');?>  
    <?=link_button('Calc','calc_tarif()','sum');?>  
</div>

<?php 
echo $lov_origin;
echo $lov_destination;
echo $lov_service;
echo $lov_ship_type;
echo $lov_sender;
echo $lov_ce_name;
echo $lov_status;
echo $lov_sub_ship;
?>

<script type="text/javascript">
	var _url="<?=$url?>";	
	function valid(){
	    var field=['book_no','origin','destination','service','sender','ce_name'];
	    var ret=true;
	    for(i=0;i<field.length;i++){
	        if($("#"+field[i]).val()==''){
	            ret=false;
	            break;
	        }
	    }
	    return ret;
	}
    function save_aed(){
        if(!valid()){alert("Isi nomor,tujuan,service,penerima !");return false;}
		url=_url+'/save';
		
		
		$('#frmMain').form('submit',{
			url: url,
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success){
                    var nomor=result.book_no;
                    window.open(_url+"/view/"+nomor,"_self");
				} else {
					log_err(result.msg);
				}
			}
		});
    }
	function print_aed(){
	    nomor=$("#book_no").val();
		window.open(_url+'/print_nomor/'+nomor,'_blank');
	}
	function add_aed(){
	    window.open(_url+'/add','_self');
	}	
	function delete_aed()
	{
	    var nomor=$('#book_no').val();
		$.ajax({
				type: "GET",
				url: _url+"/delete/"+nomor,
				data: "",
				success: function(result){
					var result = eval('('+result+')');
					if(result.success){
						$.messager.show({
							title:'Success',msg:result.msg
						});	
						remove_tab_parent();
					} else {
						$.messager.show({
							title:'Error',msg:result.msg
						});							
					};
				},
				error: function(msg){alert(msg);}
		}); 				
	}
	function edit_aed(){
	    
	}
	function refresh_aed(){
        var nomor=$('#book_no').val();
        window.open(_url+'/view/'+nomor,'_self');	    
	}
	function add_item(){
	    if($("#book_no").val()=="AUTO"){
	        alert("Simpan dulu..!");return false;
	    }
	    clear_item();
        $('#dlgItem').dialog('open').dialog('setTitle','Add Item');
	}
	function clear_item(){
	    $("#item").val("");
        $("#qty").val("1");
        $("#weight").val("0");
        $("#p").val("");
        $("#l").val("");
        $("#t").val("");
        $("#v").val("");
        $("#total_berat").val("0");
        $("#total_volume").val("0");
        $("#tarif_berat").val("0");
        $("#tarif_volume").val("0");
        $("#biaya").val("0");
        $("#id_item").val("");
	    
	}
    function valid_item(){
        var field=['item','qty','weight'];
        var ret=true;
        for(i=0;i<field.length;i++){
            if($("#"+field[i]).val()==''){
                ret=false;
                break;
            }
        }
        return ret;
    }
    function save_item(){

        if(!valid_item()){alert("Isi item qty,berat !");return false;}

        
        calc_tarif(
            function(success){
                if(success){
                    url=_url+'/items/save';
                    $('#frmItem').form('submit',{
                        url: url,
                        onSubmit: function(){
                            return $(this).form('validate');
                        },
                        success: function(result){
                            var result = eval('('+result+')');
                            if (result.success){
                                $("#dlgItem").dialog("close");
                                load_item();
                                log_msg('Data sudah tersimpan. Silahkan isi detail barang.');
                            } else {
                                log_err(result.msg);
                            }
                        }
                    });                
                }
            }
        );
    }
    function load_item(){
        var nomor=$("#book_no").val();
        $('#dgItem').datagrid({url:_url+'/items/'+nomor});
        $('#dgItem').datagrid('reload');
    }
    function delete_item(){
        var row = $('#dgItem').datagrid('getSelected');
        if (row){
            $.ajax({url: _url+"/items/delete/"+row.id,
                success: function(result){
                    var result = eval('('+result+')');
                    if(result.success){
                        load_item();
                    }
                }
            })
        };                 
    }
    function view_item(){
        var row = $('#dgItem').datagrid('getSelected');
        if (row){
            $.ajax({url: _url+"/items/view/"+row.id,
                success: function(result){
                    var result = eval('('+result+')');
                    if(result.success){
                        $('#dlgItem').dialog('open').dialog('setTitle','Add Item');
                        $("#item").val(result.item);
                        $("#qty").val(result.qty);
                        $("#weight").val(result.weight);
                        $("#p").val(result.p);
                        $("#l").val(result.l);
                        $("#t").val(result.t);
                        $("#v").val(result.v);
                        $("#total_berat").val(result.total_berat);
                        $("#total_volume").val(result.total_volume);
                        $("#tarif_berat").val(result.tarif_berat);
                        $("#tarif_volume").val(result.tarif_volume);
                        $("#biaya").val(result.biaya);                        
                        $("#id_item").val(result.id);                        
                    }
                }
            })
        };                 
    }
    function calc_tarif(after_calc){
        
       // if(!valid()){alert("Isi kota,service,nama !");return false;}
        
        var origin=$("#origin").val();                  var qty=$("#qty").val();
        var destination=$("#destination").val();        var weight=$("#weight").val();
        var service=$("#service").val();                var biaya=0;
        var sender=$("#sender").val();                  var p=$("#p").val();
        var receiver=$("#ce_name").val();               var l=$("#l").val();
        var jenis_biaya=$("#jenis_biaya").val();        var t=$("#t").val();
        var ship_type=$("#ship_type").val();            var plt="";
        var plt_ratio=0;
        
                
        if(p=="")p="0";        plt=plt+p+"x";
        if(l=="")l="0";        plt=plt+l+"x";
        if(t=="")t="0";        plt=plt+t;
        if(p>0 && l>0 && t>0){
            plt_ratio=(p * l * t) / 1000000;
        }        
        $("#v").val(plt_ratio);

        var param={origin:origin,destination:destination,service:service,
                sender:sender,receiver:receiver,ship_type:ship_type,
                qty:qty,weight:weight,plt_ratio:plt_ratio};

        
        $.ajax({url: CI_ROOT+"courier/tarif/get_tarif",type:"POST",data:param,
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    var data=result.data;
                    console.log(data);
                    cvalf("#tarif_berat",data.tarif);
                    cvalf("#tarif_volume",data.tarif_vol);
                    cvalf("#tarif_berat2",data.tarif);
                    cvalf("#tarif_volume2",data.tarif_vol);
                    $("#jenis_biaya").val(data.jenis_biaya);
                    total_berat=weight*qty;
                    total_volume=data.tarif_vol*plt_ratio;
                    tberat=data.tarif*qty;
                    tvol=total_volume*qty;
                    if(data.jenis_biaya=="VOLUME" && (tvol>tberat)){
                        biaya=total_volume*qty;
                    } else {
                        biaya=tberat;
                        data.jenis_biaya="BERAT";                        
                    }
                    cvalf("#total_berat",total_berat);
                    cvalf("#total_volume",total_volume);
                    cvalf("#biaya",biaya);
                    if (typeof after_calc === "function") {
                        after_calc(result.success);
                    }
                }
            }
        });
        
    }
    function create_invoice(){
        var book_no=$("#book_no").val();
        add_tab_parent("Invoice",CI_ROOT+"courier/invoice/add_from_book/"+book_no);
    }
</script>
    
