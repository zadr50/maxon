<div class='thumbnailx'>
    <div class='search' style='padding:2px'>
    <ol class='breadcrumbx col-md-4'></ol>
    <span style='float:right;padding-top:5px'>
        <?php 
        echo link_button('Setting','setting()','tip','false');
        echo "<input type='text' id='txtFilter'>";
        echo link_button('Search','filter_items()','search','false');
        
        ?>          
    
    </span>
 </div>
</div>
<div class='row'>
        <div class='col-sm-4 thumbnail'>
            <div class='barcode'>
                <strong>Qty:</strong> <input type='text' id='qty' value="1"
                    style="width:50px">
                <strong>Scan:</strong> <input type='text' id='barcode' title="Scan Barcode"
                    style="width:150px"
                    onkeypress="find_barcode(event)" >
            </div>
            <div class='nota-pay thumbnail box-gradient'>
                <table width='100%'>
                <tr><td><strong>Payment&nbsp</strong></td>
                    <td><strong>Total</strong></td><td><span id='ttl_nota'>0</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong>Sisa/Kembali</strong></td><td><span id='ttl_sisa'>0</span></td>
                </tr>
                </table>
            </div>
            <div class='thumbnail col-sm-12 box-gradient'> 
                <? include_once "numpad.php" ?>
            </div>
        </div>
        <div class='col-sm-8 thumbnail'>             
             <div class='category' style='max-height:250px'>
                <div class='cat-content' id="cat-content" >
                </div>
             </div>
             <div class='product' id='product'></div>
        </div>
    
    
</div>