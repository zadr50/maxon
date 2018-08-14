<div class='sb_panel box-gradient'>
	<div id="panel6" class="msg-border-1" style="width:30px">
		<?php
			echo "<a href='".base_url()."index.php/sessionset/save/sidebar_show'>
			<img src='".base_url()."images/sort_desc.png' title='Hide/Show Sidebar'></a>";
		?>	
	</div>
	<div id="panel7" class="msg-border-1" style="width:30px">
		<?php
			echo "<a href='#' onclick='start_offline();return false'>
			<img id='imgOffline' src='".base_url()."images/on.png' title='Offline Mode'></a>";
		?>	
	</div>
	<div id='panel1' >
		<div id='msg-box-wrap' class="msg-border-1" style="width:50%">
		</div>
	</div>
	<div id="panel2" class="msg-border-1 msg-inbox" style="width:10%">
		<div id='panel2-msg' class='info_link' href='<?=base_url()?>index.php/maxon_inbox/list_msg'></div>
	</div>
	<div id="panel3" class="msg-border-1" style="width:10%">
	
	</div>
	<div id="panel4" class="msg-border-1" style="width:100px" align="right">
	
	</div>
	<div id="panel5" class="msg-border-1" style="width:50px" align="right">
	
	</div>
	<div id="panel6" class="msg-border-1" style="width:30px" align="right">
		<?php
			echo "<a href='".base_url()."index.php/sessionset/save/sidebar_show'>
			<img src='".base_url()."images/sort_desc.png' title='Hide/Show Sidebar'></a>";
		?>	
	</div>
</div>
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>js/offline.js"></script>
