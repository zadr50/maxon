<link rel="stylesheet" href="<?=base_url()?>assets/flexslider/flexslider.css" type="text/css" media="screen">
<script type="text/javascript" src="<?=base_url()?>assets/flexslider/jquery.flexslider-min.js"></script>
 <div class="thumbnail" >
	<div class="flexslider">
	  <ul class="slides">
	  
		<li>
		  <img src="<?php echo base_url().$this->sysvar->getvar('slider1','images/slider1.jpg') ?>" 
		  title='Sistim Cloud' height="300">
		</li>
		<li>
		  <img src="<?php echo base_url().$this->sysvar->getvar('slider2','images/slider2.jpg') ?>" title='Hindari Kerja Lembur' height="300">
		</li>
		<li>
		  <img src="<?php echo base_url().$this->sysvar->getvar('slider3','images/slider3.jpg') ?>" title='Online Training And Support' height="300">
		</li>
		<li>
		  <img src="<?php echo base_url().$this->sysvar->getvar('slider4','images/slider4.jpg') ?>" title='Kerja Dimana Saja' height="300">
		</li>
	  </ul>
	</div>	      
 </div>
