<div class='btn-toolbar' role='toolbar' aria-label="Toolbar">
<div class="btn-group" role="group" aria-label="Navigation Button" style='float:left'>
	<button onclick="list_item(1);return false;" title='Move to first record'
	type="button" class="btn btn-default glyphicon glyphicon-step-backward"></button>
	<button onclick="list_item(<?php 
		if($page<=0)$page=1; $page=$page-1; 
		echo $page; 
		?>);return false;" title='Previous page'
	type="button" class="btn btn-default glyphicon glyphicon-backward"></button>
	<button onclick="list_item(<?php 
		if($page>$item_page_max-2)$page=$item_page_max-2; 
		echo $page+2
		?>);return false;" title='Next page'
	type="button" class="btn btn-default glyphicon glyphicon-forward"></button>
	<button onclick="list_item(<?=$item_page_max?>);return false;" title='Move to last record'
	type="button" class="btn btn-default glyphicon glyphicon-step-forward"></button>
	<button onclick="add_item();return false;" title='Addnew Record'
	type="button" class="btn btn-default glyphicon glyphicon-plus"></button>
	<button onclick="list_item(0);return false;" title='View as table'
	type="button" class="btn btn-default glyphicon glyphicon-list glyphicon "></button>
	<button onclick="list_detail();return false;" title='View as detail'
	type="button" class="btn btn-default glyphicon glyphicon-th-large"></button>
	<button onclik='search_item();return false;' class="btn btn-default 
	glyphicon glyphicon-filter" 
	type="button" title='Search record by text'></button>	
</div>
<div class='btn-group col-md-6' role='group' aria-label='Record'>
  <div class="col-md-4">
    <div class="input-group">
      <input name='page' id='page' value='<?
	  if($page<=0)$page=0;
	  echo $page+1
	  ?>' type="text" class="form-control" placeholder="Page">
      <span class="input-group-btn">
        <button onclick='page();return false' class="btn btn-default" type="button">Page</button>
      </span>
    </div>
  </div> 

  <div class="col-md-6">
    <div class="input-group">
      <input name='rows' id='rows' value='<?=$limit?>' type="text" class="form-control" placeholder="Row Count">
      <span class="input-group-btn">
        <button onclick='rows();return false' class="btn btn-default" type="button">Rows</button>
      </span>
    </div>
  </div> 
</div> 

</div>