		
		  <div class="box box-info">
		    <div class="box-header with-border">
		      <h3 class="box-title">Info Nota</h3>
		      <div class="box-tools pull-right">
		        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		      </div>
		    </div><!-- /.box-header -->
		    <div class="box-body">
		    	<div class="table-responsive">
		    		<div class='col-xs-4'>
			    		<p>Nomor Nota#</p><span id='nota' class="form-control">AUTO</span>
			    		<span id='nota_tmp'></span>
		    			
		    		</div>
	    		<div class='col-xs-4'>
			    		<p>Pelanggan</p><?=form_input("cust","CASH","id='cust' class='form-control'")?>
		    			
		    		</div>
		    		<div class='col-xs-4'>
			    		<p>Salesman#</p><?=form_input("nota","","class='form-control'")?>
		    			
		    		</div>
		
				</div>
		    </div><!-- /.box-body -->
			
		  </div><!-- /.box -->
