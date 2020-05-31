<link rel="stylesheet" href="<?=base_url()?>assets/flexslider/flexslider.css" type="text/css" media="screen">
<script type="text/javascript" src="<?=base_url()?>assets/flexslider/jquery.flexslider-min.js"></script>

			<?php
		  		$image1=$this->sysvar->getvar('slider1','images/slider1.jpg');
		  		if(!strpos($image1,"images",0)){
		  			$image1="images/".$image1;
		  		}
		  		$image2=$this->sysvar->getvar('slider2','images/slider2.jpg');
		  		if(!strpos($image2,"images",0)){
		  			$image2="images/".$image2;
		  		}
		  		$image3=$this->sysvar->getvar('slider3','images/slider3.jpg');
		  		if(!strpos($image3,"images",0)){
		  			$image3="images/".$image3;
		  		}
		  		$image4=$this->sysvar->getvar('slider4','images/slider4.jpg');
		  		if(!strpos($image4,"images",0)){
		  			$image4="images/".$image4;
		  		}
			
			?>

 <div class="thumbnail" >
	<div class="flexslider">
	  <ul class="slides">
	  
		<li>
		  <img src="<?=base_url($image1)?>" title='Sistim Cloud' height="300">
		</li>
		<li>
		  <img src="<?=base_url($image2)?>" title='Hindari Kerja Lembur' height="300">
		</li>
		<li>
		  <img src="<?=base_url($image3)?>" title='Online Training And Support' height="300">
		</li>
		<li>
		  <img src="<?=base_url($image4)?>" title='Kerja Dimana Saja' height="300">
		</li>
	  </ul>
	</div>	      
 </div>
