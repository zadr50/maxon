<?php 
	//var_dump($category_list);
	//var_dump($google_ads);
	//var_dump($widget_brand);
	echo load_view($google_ads);
	echo load_view($category_list);
	if($widget_brand!='')echo load_view($widget_brand);
?>