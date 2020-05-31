<div class='col-md-8'>
	<div id="p" class="easyui-panel" title="Themes" style="padding:20px"
			data-options="iconCls:'icon-save',closable:true,
			collapsible:true,minimizable:true,maximizable:true">
			<form id="" method="post">
				<div class="row">
					<label class="control-label col-sm-5" for="sidebar">Sidebar Position</label>
					<div class="col-sm-5">
						<?=form_radio("sidebar_position","left",$sidebar_position=='left'?'left':'',"style='width:30px'");?> Left
						<?=form_radio("sidebar_position","right",$sidebar_position=='right'?'right':'',"style='width:30px'");?> Right
					</div>
				</div>
				<div class="row">
					<label class="control-label col-sm-5" for="sidebar">Show Header</label>
					<div class="col-sm-5"><?=form_checkbox("header_visible",true,$header_visible)?></div>
				</div>
				<div class="row">
					<label class="control-label col-sm-5" for="sidebar">Show Last Runing Box</label>
					<div class="col-sm-5"><?=form_checkbox("last_running_visible",true,$last_running_visible)?></div>
				</div>
				<div class="row">
					<label class="control-label col-sm-5" for="sidebar">Show Donate Box</label>
					<div class="col-sm-5"><?=form_checkbox("donate_visible",true,$donate_visible)?></div>
				</div>
				<div class="row">
					<label class="control-label col-sm-5" for="sidebar">Display Google Ads</label>
					<div class="col-sm-5"><?=form_checkbox("google_ads_visible",true,$google_ads_visible)?></div>
				</div>
				<div class="row">
					<label class="control-label col-sm-5" for="chatbox">Display Chat Box</label>
					<div class="col-sm-5"><?=form_checkbox("chatbox_visible",true,$chatbox_visible)?></div>
				</div>
                <div class="row">
                    <label class="control-label col-sm-5" for="dont_validate">Don't validate journal posting</label>
                    <div class="col-sm-5"><?=form_checkbox("dont_validate_journal",false,$dont_validate_journal)?></div>
                </div>
                <div class="row">
                    <label class="control-label col-sm-5" for="background">Stop background process</label>
                    <div class="col-sm-5"><?=form_checkbox("stop_background_process",false,$stop_background_process)?></div>
                </div>



				<div class="row">
				    <div class="thumbnail box-gradient">
                        <?=form_submit("submit","Submit","class='btn btn-primary right'");?>				        
				    </div>
				</div>
			</form>
	</div>
</div>
