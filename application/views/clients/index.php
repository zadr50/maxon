<style>
.add-me {
	border:1px solid lightgray;
	width:120px;
	height:150px;
	padding:3px;
	cursor: pointer;
	box-shadow: 2px 2px 1px #888888;
	float:left;
}
.add-me-logo img {
	width:100px;
	height:100px;
}
.add-me-note {
	font-size: 9px;
	background-color: lightgray;
	height:43px;
}
.add-me:hover {
	background-color: lightgray;
}
</style>
<div  style="col-md-10 height:auto;;padding:10px">
	<div class="welcome_line welcome_t"></div>

	<div class="panel panel-primary " >
		<div class="panel-heading">
				<h3 class="panel-title"  style="padding:10px;color:white">KISAH SUKSES</h3>
		</div>
		<div class="panel-body"   style="padding:10px;">
			<p>
				Dibawah ini adalah galery bagi pengguna yang telah berhasil dan memasang
				software MaxOn di perusahaan atau organisasi anda.
				Silahkan submit logo perusahaan atau website anda disini.
			</p>
<?	
  if ($handle = opendir('./images/clients/')) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
				if($pos=strpos($entry,".jpg.txt")){
					show_file($entry);
				}
            }
        }
        closedir($handle);
		show_file();
   }
   
   function show_file($filename="") {
		if($filename=="") {
			$id="id='add-me-box'";
			$file_jpg="addme.gif";
			$content="Silahkan upload gambar logo anda disini";
			$title="Add My Company";
		} else {
			// id='add-me-box'
			$id="";
			$pos=strpos($filename,".jpg.txt");
			$file_txt=$filename;
			$file_jpg=str_replace(".jpg.txt",".jpg",$file_txt);
			// read content
			$file_txt="images/clients/".$file_txt;
			$data = explode("\n", file_get_contents($file_txt));
			$title=$data[0];
			$content=substr($data[1],1,50);
		}
		echo "
		<div class='add-me' $id >
			<div class='add-me-logo'  align='center'>
				<img src='".base_url()."images/clients/$file_jpg' title='$title'>
			</div>
			<div class='add-me-note' align='center'>
				<p>$content</p>
			</div>
		</div>";
	}

?>				
		<div class="clearfix"></div>
		
			<div id="add_me" class="col-md-5 thumbnail" style="margin-top:10px;height:auto;display:none">
				<?php include "add_me.php"; ?>
			</div>
				
				
		</div>



       </div>
	</div>


 	  

 <script>
	 $( "#add-me-box" ).click(function() {
	  $( "#add_me" ).toggle( "slow", function() {
		// Animation complete.
	  });
	});
 </script>