
<?
	echo $_header;
?>
<div class='pos'>
	<div class='pos-content'>
		<div class='col-sm-4 thumbnail'>
			<div class='nota'>
				 <div class='nota-content'>
				 </div>
				 <div class='nota-total'>
					  <p><strong>Total:</strong></p>
				 </div>
			</div>
			<div class='thumbnail col-sm-9'>
					<button class="input-button number-char">1</button>
					<button class="input-button number-char">2</button>
					<button class="input-button number-char">3</button>
					<button class="mode-button selected-mode" data-mode="quantity">Qty</button>
					<br>
					<button class="input-button number-char">4</button>
					<button class="input-button number-char">5</button>
					<button class="input-button number-char">6</button>
					<button class="mode-button" data-mode="discount">Disc</button>
					<br>
					<button class="input-button number-char">7</button>
					<button class="input-button number-char">8</button>
					<button class="input-button number-char">9</button>
					<button class="mode-button" data-mode="price">Price</button>
					<br>
					<button class="input-button numpad-minus">+/-</button>
					<button class="input-button number-char">0</button>
					<button class="input-button number-char">.</button>
					<button class="input-button numpad-backspace"><-</button>
					<br>
			</div>
			<div class='col-md-10 thumbnail'>
				<?=link_button('New','tambah()','add','false')?>
				<?=link_button('Cash','pay_cash()','add','false')?>
				<?=link_button('Card','pay_ccard()','add','false')?>
				<?=link_button('Split','pay_split()','add','false')?>
				<?=link_button('Open','open_nota()','add','false')?>
				<?=link_button('Void','void_nota()','add','false')?>
			
			</div>
		</div>
		<div class='col-sm-8 thumbnail'>
			 <div class='search'>
				<ol class='breadcrumb'>
					 <li><a class="first-cat glyphicon glyphicon-home" href="#"> Home</a></li>
				</ol>

			 </div>
			 <div class='category'>
				<?
					$first_cat='';
					if($q=$this->db->query("select kode,category from inventory_categories 
					   limit 0,5")){
					   foreach($q->result() as $r) {
							echo "<div class='cat-cell' id='$r->kode' title='Product by this category'>";
							echo "<img src=''><p>".$r->category."</p>";
							echo "</div>";
						}
					}
				
				?>			 
			 </div>
			 <div class='product' id='product'>
	
			 </div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		var url='<?=base_url()?>index.php/inventory/pos_items';
		get_this(url,'','product');
		
		$('.first-cat').click(function(){
			get_this(url,'','product');
			}
		);
		
		$('.cat-cell').click(function(event) {
			 var cat = $(this).attr("id");
			var url='<?=base_url()?>index.php/inventory/pos_items/'+cat;
			get_this(url,'','product');
			
		});		
	});
	$(document).on('click', '.item-cell', function(){
			var kode=$(this).attr("id");
			$(".nota-content").append("<li class='line-order' id='"+kode+"'  >"+kode+"</li>");
	});
	
</script>
<style>
.line-order {
	height:20px;
	border-bottom: 1px solid #ddd;
}
.cat-cell {
	position: relative;
	vertical-align: top;
	display: inline-block;
	font-size: 11px;
	margin: 5px !important;
	width: 120px;
	height: 120px;
	background: #fff;
	border: 1px solid #d7d7d7;
	border-radius: 3px;
	border-bottom-width: 3px;
	cursor: pointer;
	padding:10px;
	horizontal-align:center;
}
.cat-cell img {
	width:90px;
	height:90px;
}
.cat-cell:hover {
	background: #ffd;	
}
.item-cell {
	position: relative;
	vertical-align: top;
	display: inline-block;
	font-size: 11px;
	margin: 5px !important;
	width: 120px;
	height: 180px;
	background: #fff;
	border: 1px solid #d7d7d7;
	border-radius: 3px;
	border-bottom-width: 3px;
	cursor: pointer;
	padding:10px;
	horizontal-align:center;
}
.item-cell img {
	width:90px;
	height:90px;
}
.item-cell:hover {
	background: #ffd;	
}

.left-pane {
	position: absolute;
	top: 60px;
	width: 300px;
	height: 100%;
	bottom: 0;	
	box-sizing: border-box;
	border-right: solid 1px #CECBCB;
}
.rigth-pane {
	position: absolute;
	top: 60px;
	left: 380px;
	bottom: 0;
	width: 65%;
	background-color: #E7E7E7;	
}
.pos .nota {
	border: solid 1px #CECBCB;
	margin: 5px;
	padding: 5px;
	background: rgba(17, 16, 17, 0.06);
}
.pos .nota-total {
	height: 100px;
}

.pos .nota-content {
	background: white;
	min-height: 200px;
	max-height: 400px;
	overflow: hidden;
	overflow-y: auto;
}

.search {
	height:40px;
	background: rgb(186, 193, 221);
}
.category {
	height:150px;
	background: rgb(229, 229, 229);
	border-bottom: 1px solid #cecece;
	padding:10px;
}
.input-button {
	width:50px;
}
.mode-button {
	width:50px;
}
.selected-mode, .pos .popup button:active {
	border: none;
	color: white;
	background: #7f82ac;
}
</style>