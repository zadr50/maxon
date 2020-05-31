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