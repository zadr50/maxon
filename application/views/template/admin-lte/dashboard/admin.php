<?php 

$kurs=0;
$year=date("Y");

?>


<!-- Main row -->

<div class="row">
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Budget Year</span>
              <span class="info-box-number"><?=$year?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Kurs</span>
              <span class="info-box-number">00000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Members</span>
              <span class="info-box-number">0000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>


	<div class="col-md-8">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Account Group Summary</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
        <table class="table no-margin">
          <thead>
            <tr>
              <th>Coa</th>
              <th>Description</th>
              <th align=right>Budget</th>
              <th align=right><?=anchor("coa/realisasi","Realisasi")?></th>
              <th align=right>Var%</th>
            </tr>
          </thead>
          <tbody>
			<?php 
				echo "<tr><td>";
		
				echo "</td><td>dfklsdjflsafkjdsf/td>
					<td align='right'>".number_format(0)."</td>
					<td align='right'>".number_format(0)."</td>
					<td align='right'>0</td></tr>";
			
			?>
          </tbody>
        </table>
      </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
<!--      <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
      <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
-->    </div><!-- /.box-footer -->
  </div><!-- /.box -->
</div><!-- /.col -->

<div class="col-md-4">
      <!-- PRODUCT LIST -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Summary Account Chart</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="pieChart" style="height: 180px; width: 646px;" width="646" height="180"></canvas>
                  </div>
         
        </div><!-- /.box-body -->
        <div class="box-footer text-center">
          <a href="#" class="uppercase">View Profit Loss</a>
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12">
      <p class="text-center">
        <strong>Sales Budget : Year - <?=date('Y')?></strong>
        <br><i>*Dalam ribuan dolar</i>
      </p>

      <div class="chart">
        <!-- Sales Chart Canvas -->
        <canvas id="salesChart" style="height: 180px; width: 646px;" width="646" height="180"></canvas>
      </div>
      <!-- /.chart-responsive -->
    </div>
    <!-- /.col -->
</div>
<div class='row'>
  <div class='col-md-12'>
  <div class="col-md-6">
      <!-- PRODUCT LIST -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Summary Products</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <?php
            $sql="select * from budget where budget_year='$year' and parent_id=0 
            and row_type in ('prod_mnk') 
            order by row_type,no_urut";
            
            echo "<table class='table'>";
            echo "<tr><td>keterangan</td><td align='right'>".number_format(0)."</td></tr>";
            echo "</table>";
            ?>
        </div><!-- /.box-body -->
        <div class="box-footer text-center">
          <a href="#" class="uppercase">View Products</a>
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /.col -->			  
    
<div class="col-md-6">
          <p class="text-center">
            <strong>Goal Completion</strong>
          </p>

          <div class="progress-group">
            <span class="progress-text">Add Products to Cart</span>
            <span class="progress-number"><b>160</b>/200</span>

            <div class="progress sm">
              <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
            </div>
          </div>
          <!-- /.progress-group -->
          <div class="progress-group">
            <span class="progress-text">Complete Purchase</span>
            <span class="progress-number"><b>310</b>/400</span>

            <div class="progress sm">
              <div class="progress-bar progress-bar-red" style="width: 80%"></div>
            </div>
          </div>
          <!-- /.progress-group -->
          <div class="progress-group">
            <span class="progress-text">Visit Premium Page</span>
            <span class="progress-number"><b>480</b>/800</span>

            <div class="progress sm">
              <div class="progress-bar progress-bar-green" style="width: 80%"></div>
            </div>
          </div>
          <!-- /.progress-group -->
          <div class="progress-group">
            <span class="progress-text">Send Inquiries</span>
            <span class="progress-number"><b>250</b>/500</span>

            <div class="progress sm">
              <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
            </div>
          </div>
          <!-- /.progress-group -->
        </div>    
    </div>
</div>			  
