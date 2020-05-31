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
		<!--status-->		
		<div id='msg-box-wrap' class="msg-border-1" style="width:40%">
			Ready.
		</div>
	</div>
	<div id="panel2" class="msg-border-1 msg-inbox" style="width:10%">
		<!--notify inbox-->
		<div id='panel2-msg' class='info_link' href='<?=base_url()?>index.php/maxon_inbox/list_msg'>
			ActiveInbox
		</div>
	</div>
	<div id="panel3" class="msg-border-1" style="width:10%">
		<!--curent user-->	
		ActiveUser
	</div>
	<div id="panel3a" class="msg-border-1" style="width:100px">
		<!--curent database-->	
		ActiveDb
	</div>
	
	<div id="panel4" class="msg-border-1" style="width:100px" textalign="right">
		<!--date-->
	
	</div>
	<div id="panel5" class="msg-border-1" style="width:60px" textalign="right">
		<!--time-->
	</div>
	<div id="panel6" class="msg-border-1" style="width:30px" textalign="right">
		<!--sidebar on/off-->
		<?php
			echo "<a href='".base_url()."index.php/sessionset/save/sidebar_show'>
			<img src='".base_url()."images/sort_desc.png' title='Hide/Show Sidebar'></a>";
		?>	
	</div>
	
</div>
