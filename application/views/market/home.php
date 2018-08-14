<?php
if(isset($message)){
	if($message!=""){
		echo '<div class="alert alert-success" role="alert">'.$message.'</div>';
	}
}
$active_home="";
$active_modules="";
$active_upload="";
$active_books="";
switch($page){
case "modules.php": $active_modules="active";break;
case "upload.php": $active_upload="active";break;
case "books.php": $active_books="active";break;
default:$active_home="active";
}
?>

<ul class="nav nav-tabs">
  <li role="presentation" class="<?=$active_home?>">
		<a href='<?=base_url()?>index.php/market/apps'>Themes</a></li>
  <li role="presentation"class="<?=$active_modules?>">
		<a href='<?=base_url()?>index.php/market/apps/modules'>Modules</a></li>
  <li role="presentation"class="<?=$active_books?>">
		<a href='<?=base_url()?>index.php/market/apps/books'>Books</a></li>
  <li role="presentation"class="<?=$active_upload?>">
		<a href='<?=base_url()?>index.php/market/apps/upload'>Upload</a></li>
</ul>

<? 
include $page; 

function panel_box($apps,$free=true){
	$ico=base_url().'market/images/'.$apps->app_ico;
    echo "
    <div class='panel panel-info info2 '>
	<div class='panel-heading '>
		<div class='glyphicon glyphicon-list'>
			<strong> $apps->app_title</strong>
		</div>
		<div class='top-legend'>Created By: $apps->app_create_by</div>
	</div>
	<div class='panel-body'>
		<div class='photo'><img src='$ico'></div>
		<div class='detail' style='min-height:110px'>$apps->app_desc</div>
		<a href='#' onclick='readmore($apps->id);return false;'
			class='btn btn-default'>Read More</a>
		<a href='#' onclick='install($apps->id);return false;'
			class='btn btn-default'>Install</a>
		<a href='#' onclick='download($apps->id);return false;'
			class='btn btn-default'>Download</a>";
        if(!$free){
        	echo "<a href='#' onclick='buy($apps->id);return false;'
        			class='btn btn-default'>Buy</a>";
        }
    echo '</div>';
}
?>
 <script language='javascript'>
function readmore(id){
	var url=CI_ROOT+"market/apps/view/"+id;
	window.open(url,"_self");
}
function install(id){
	alert(id);
}
function download(){
	alert(id);
}
function buy(){
	alert(id);
}
 
 </script>