<div class='div-item' style="">
	<div class='row'>
		<div class='container-fluid'>
		    <?php
            if($q=$this->db->get('inventory_categories')){
                foreach($q->result() as $cat) {
                    echo "<div class='row' >
                        <div class='box-cat2 col-md-12'>
                        <img class='' src='".load_picture($cat->item_picture)."' 
                            height='50px' width='50px' >
                        <span class='title'>$cat->category</span>
                        </br>$cat->description
                    ";
                    echo "<span style='float:right;margin-right:20px'>".anchor("eshop/categories/view/$cat->kode","Selengkapnya",
                        "class='btn btn-primary ' ")."</span>";
                    echo "</div></div>";
                    
            $i=0;
            $new_row=false;
                $items=$this->db->limit(40)->where("category",$cat->kode)
                ->order_by("sales_count desc")->limit(40)->get('inventory');
            
                foreach($items->result() as $item){
                    
                    if($item->active){
                        if($item->item_number=='00023'){
                            //echo 'ok';
                        }
                        $i++;
                        $s="";
                        if(($i%5)==0){
                            $s="<div class='row'>";
                            $new_row=true;
                        }
                        $s.="<div style='color:black' onclick='view_item(\"$item->item_number\");return false;' 
                        class='box_item col-lg-2 col-sm-12'>
                        <div class='foto'>
                            <img  src='".load_picture($item->item_picture)."'>
                        </div>
                        <div class='content text-center'>$item->description</div>
                        <div class='item-footer'>
                            <div class='item-footer-no'>
                                <div class='price'>Rp. ".number_format($item->retail)."</div>
                                <div class='item_no'>Id: $item->item_number</div>
                            </div>
                            <div class='item-stat'>
                                <span class='item-stat-q'>Q: $item->quantity_in_stock</span>                            
                                <span class='item-stat-q'>S: $item->sales_count</span>
                                <span class='item-stat-q'>V: $item->view_count</span>
                                <span class='item-stat-q'>D%: $item->discount_percent</span>
                            </div>
                                                                                                                  
                           
                        </div>
                        </div>";
                        
                        if($new_row){
                            $i=0;                       
                            $new_row=false;
                            $s.="</div>";
                            
                        }
                        echo $s;
                        
                    }
                }
                    echo "</div>";   
                }
            } 
			
			?>
			
		</div>
	</div>
</div>
<script language="javascript">
function view_item(id){
	var url="<?=base_url()?>index.php/eshop/item/view/"+id;
	window.open(url,"_self");
}
</script>	
