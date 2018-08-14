<h1>MODULES</h1>
<p>Modul adalah sebuah aplikasi tambahan yang dapat anda download 
dihalaman ini, silahkan download modul yang anda inginkan:</p>
<h2>Free</h2>
<? 
if(!$free_apps->num_rows()){
	echo "<i>Not available modules</i>";
} else {
	foreach($free_apps->result() as $apps) 	panel_box($apps); 
}
?>
<h2>Paid</h2>
<? 
if(!$paid_apps->num_rows()){
	echo "<i>Not available modules</i>";
} else {
	foreach($paid_apps->result() as $apps)panel_box($apps,false); 
	
}
?>
