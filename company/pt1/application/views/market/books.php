<h1>BOOKS</h1>
<p>Silahkan download tutorial penggunaan MaxOn ERP Software dihalaman ini:</p>
<h2>Free</h2>
<? 
if(!$free_books->num_rows()){
	echo "<i>Not available books</i>";
} else {
	foreach($free_books->result() as $apps) 	panel_box($apps); 
}
?>
<h2>Paid</h2>
<? 
if(!$paid_books->num_rows()){
	echo "<i>Not available books</i>";
} else {
	foreach($paid_books->result() as $apps) 	panel_box($apps,false); 
}
?>
