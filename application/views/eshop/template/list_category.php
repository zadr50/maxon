<?php 
echo "<span><b>CATEGORIES</b>&nbsp&nbsp<a href='#' class='btn btn-sm btn-danger'>Show All</a></span> </br> ";
$categories=$this->db->get("inventory_categories");
if(isset($categories)){ 
    $i=0;
    foreach($categories->result() as $cat) {
        $i++;
        if($i<10){
            $cnt=$this->db->where("category",$cat->kode)->get("inventory")->num_rows();
            if($cat->icon_picture != ''){
                $ico=base_url()."/tmp/".$cat->icon_picture;
                $ico="<img src='".$ico."' width=25 height=25 />";
            } else {
                $ico='';
            }
            echo "<li onclick='filter_category(\"$cat->kode\");return false;' style='margin-top:2px'>";
            $title=$ico." ".$cat->category." <span class='badge' style='float:right'>".$cnt."</span>";;
            echo $title;
            echo "</li>";
    
        }
    }
} 

?>
<script lang="JavaScript">
    function filter_category(kode){
        var url="<?=base_url('index.php/eshop/categories/view')?>/"+kode;        
        window.open(url,"_self");
    }
</script>
