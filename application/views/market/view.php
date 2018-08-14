<a href="javascript:history.go(-1)">BACK</a> 
<div class='box_apps'>
	<div class='foto'>
		<img src="<?=base_url()."market/images/".$apps->app_ico?>">
	</div>
	<div class='title'><h1><?=$apps->app_title?></h1></div>
	<div class='info_app'>
		<div class='by'>Create By : <?=$apps->app_create_by?></div>
		<div class='type'>Type : <?=$apps->app_type?></div>
		<div class='lic'>License : <?=$apps->lic_type?></div>
	</div>
	<div class='desc'>
		<h2>Description</h2>
		<?=$apps->app_desc?>
	</div>
	<div class='file'>
		<h2>Filename</h2>
		<?=$apps->app_file?>
	</div>
	<div class='scr'>
		<h2>Screenshoot</h2>
		<div class='thumb'>
			<img src="<?=base_url()."market/images/".$apps->app_scr_1?>">
		</div>
		<div class='thumb'>
			<img src="<?=base_url()."market/images/".$apps->app_scr_2?>">
		</div>
		<div class='thumb'>
			<img src="<?=base_url()."market/images/".$apps->app_scr_3?>">
		</div>
		<div class='thumb'>
			<img src="<?=base_url()."market/images/".$apps->app_scr_4?>">
		</div>
		<div class='thumb'>
			<img src="<?=base_url()."market/images/".$apps->app_scr_5?>">
		</div>
	</div>
</div>
<style>
.box_apps {
	
}
.box_apps .foto {
float: left;
width: 130px;
height: 130px;
margin: 5px;
}
.box_apps .foto img {
width: 120px;
height: 120px;
padding: 5px;
border: 1px solid lightgray;	
}
.box_apps .title {
}
.box_apps .info_app {
font-size: 12px;
color: gray;	
}
.box_apps .info_app .by {
margin-right: 10px;	
}
.box_apps .info_app .lic {
	margin-right: 10px;	
}
.box_apps .desc {
	clear:both;
}
.box_apps .file {
	
}
.box_apps .scr {
	clear:both;
}
.box_apps .scr .thumb img {
	width:200px;
	height:200px;
	float: left;
	margin: 10px;
	padding:5px;
	border: 1px solid gray;
}
.box_apps .src .thumb {
	
}

</style>