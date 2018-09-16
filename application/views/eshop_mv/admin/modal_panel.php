<?php
if(!isset($id_modal))$id_modal="myModal";
if(!isset($fnc_save))$fnc_save="save_item";
?>
<!-- Modal -->
<div class="modal fade" id="<?=$id_modal?>" tabindex="-1" role="dialog" 
	aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?=$caption?></h4>
      </div>
      <div class="modal-body" >
			<div id='textmodal' class='row'  style='padding:10px'>
			<?php 
			$readonly="readonly";
			if(isset($form_input)){
				include_once $form_input; 
			}
			if(isset($form_input_html)){
				echo $form_input_html;
			}
			?>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick='<?=$fnc_save?>();return false'>Save changes</button>
      </div>
    </div>
  </div>
</div>

