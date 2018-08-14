<h1>Themes</h1>
<p>Thema adalah tampilan untuk mempercantik aplikasi sehingga anda 
betah berlama-lama bekerja dengan aplikasi, silahkan pasang atau
download thema dibawah ini yang sesuai dengan keinginan.</p>
<h2>Free</h2>
<? 
if(!$free_themes->num_rows()){
	echo "<i>Not available themes</i>";
} else {
	foreach($free_themes->result() as $themes) 	panel_box($themes); 
}
?>
<h2>Paid</h2>
<? 
if(!$paid_themes->num_rows()){
	echo "<i>Not available themes</i>";
} else {
	foreach($paid_themes->result() as $themes) 	panel_box($themes,false); 
}
?>
