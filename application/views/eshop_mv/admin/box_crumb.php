 
			<ol class="breadcrumb  bg-head-foot">
			  <?php
				$brc="";
				$url=base_url()."index.php/";
				for($i=1;$i<5;$i++) {
					$url .= $this->uri->segment($i).'/';
					$title=$this->uri->segment($i);
					if($title!="") {
						$brc .= '<li><a href="'.$url.'">'.ucfirst($title).'</a></li>';
					}
				}
				echo $brc;
			  ?>
			</ol>
 
