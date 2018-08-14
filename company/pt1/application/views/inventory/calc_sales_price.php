<?php

    
?>


<div id='dlgJual' class="easyui-dialog" 
	style="width:500px;height:350px;padding:5px 5px"
    closed="true" buttons="#dlgJualTool" >
		<table class='table'>
		 <tr><td>Harga Beli</td><td><input id="dlgJual_price" name="dlgJual_price"  style='width:80px'></td></tr>
         <tr><td>Margin% </td><td><input id="dlgJual_margin" name="dlgJual_margin" style='width:40px'></td></tr>
         <tr><td>Harga Jual</td><td><input id="dlgJual_retail" name="dlgJual_retail" style='width:80px'></td></tr>
         <tr><td>Hr Jual Real</td><td> <input id="dlgJual_retail_real" name="dlgJual_retail_real" style='width:80px'></td></tr> 
         <tr><td>Margin Real</td><td><input id="dlgJual_margin_real" name="dlgJual_margin_real" style='width:40px'></td></tr>
         <tr><td colspan=2><?=link_button("Hitung HJ", "calc_price(1);return false;","sum","false","","Hitung harga jual")?>
                 <?=link_button("Hitung MG", "calc_price(2);return false;","sum","false","","","Hitung margin persen")?>
                 <?=link_button("Hitung HB", "calc_price(3);return false;","sum","false","","Hitung harga beli")?>
            </br><i>* Hitung 1 = Hitung harga jual, 2 = Hitung margin, 3 = Hitung harga beli</i>     
                 
                 
             
		    </td>
		 </tr>
		</table>
</div>
<div id="dlgJualTool">
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-cancel'"  
		onclick='dlgJualCancel();return false;' title='Close'>Cancel</a>
	<a href="#" class="easyui-linkbutton" data-options="plain:false,iconCls:'icon-save'"  
		onclick='dlgJualOk();return false;' title='Ok'>Ok</a>
</div>

<script language="JavaScript">
    function dlgJualOk(){
        $("#cost_from_mfg").val($("#dlgJual_price").val());
        $("#retail").val($("#dlgJual_retail").val());
        $("#margin").val($("#dlgJual_margin").val());
        
        $("#dlgJual").dialog("close");  
    }
	function dlgJualCancel(){
		$("#dlgJual").dialog("close");	
	}
	function dlgJualShow(){
        //$('#dlgJual').window({top:window.event.clientY-50});
        $("#dlgJual").dialog("open").dialog("setTitle","Hitung harga jual, beli, margin");  
	}
	function calc_price(method){
        var beli=0,jual=0,margin=0,jual_real2=0,jual_real=0;
 
        beli=parseFloat($("#dlgJual_price").val());
        if(isNaN(beli))beli=0;

        jual=parseFloat($("#dlgJual_retail").val());
        if(isNaN(jual))jual=0;
        
        jual_real=parseFloat($("#dlgJual_retail_real").val());
        if(isNaN(jual_real))jual_real=0;

        margin=parseFloat($("#dlgJual_margin").val());
        if(isNaN(margin))margin=0;
        if(margin>1)margin=margin/100;

        margin_real=parseFloat($("#dlgJual_margin_real").val());
        if(isNaN(margin_real))margin_real=0;
        if(margin_real>1)margin_real=margin_real/100;
        
        if(method==1){
            jual=roundNumber(beli+(beli*margin),2);
            jual_real2=roundNumber(jual+(jual*margin),2);
            if(jual_real2==0)jual_real2=1;
            if(jual_real!=jual_real2){
                margin_real=roundNumber(beli/jual_real2,2);
                jual_real=jual_real2;
            }
        }else if(method==2){
            margin_real=0;
            jual_real=0;
            margin=roundNumber(1-(beli/jual),2);
        }else{
            margin_real=0;
            jual_real=0;
            beli=jual-(margin*jual);
        }
        $("#dlgJual_price").val(beli);
        $("#dlgJual_retail").val(jual);
        $("#dlgJual_margin").val(margin);
        $("#dlgJual_retail_real").val(jual_real);
        $("#dlgJual_margin_real").val(margin_real);
	    
	}
	
	
function roundNumber(num, scale) {
  if(!("" + num).includes("e")) {
    return +(Math.round(num + "e+" + scale)  + "e-" + scale);
  } else {
    var arr = ("" + num).split("e");
    var sig = ""
    if(+arr[1] + scale > 0) {
      sig = "+";
    }
    return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
  }
}
	
</script>
