<div class="jumbotron text-center" style="margin-top:10px;margin-left:auto">
  <h1>Welcome</h1>
  <h2>MaxOn ERP Software</h2>
  <p>
      MaxOn ERP is the latest generation of software solutions for managing online or cloud transaction databases.
  <p>
  <p>Enter new database name for your company (only character allow and maximum 10 character)</p>
      Company code : <?=form_input("company","","id='company' 
            placeholder='ex: ABC' maxlength='10' 
            title='Fill in the short code and without punctuation'")?>
      <a href="#" onclick="create_company();return false;" class="btn btn-primary " 
            role="button"> Create</a>
      <a class="btn btn-default" href="http://help.maxonerp.com" target="_blank" role="button"> Learn more</a>
  </p>
</div>
<div class="center-text">
    <p>After finish and success try login with userid: <strong>admin</strong> and password: admin</p>
    <p>After login please upgrade with click menu <strong>Setting->Cek Db Structure</strong></p>
    <p>If you need clear database click menu <strong>Setting->Clear Database</strong></p>
</div>   
<div class="col-lg-12">
    <?php $this->load->view("company_list") ?>
</div>
<div class="col-lg-12">
    <div class="alert alert-warning text-center">
        <p>This website for demo only, database and company after one week will be deleted, 
        make sure you do not input your real transactions.
        </p>
        <p>Contact me WA: 082112829192 if you want build database company</p>
        <p>Thanks You !</p>
    </div>
</div>
   
<div id="dlgProcess" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
            <img id='divImg'  src="<?=base_url('../../images/loading.gif')?>" style="display:none;width:30px;height:30px"/>
            Please wait...
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>                
        </h5>
      </div>
      <div class="modal-body">
          <div id="divProcess" style="padding:5px;height:300px;overflow:scroll;background:black;color:green">
            <p>Creating database... please wait...</p>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script language="JavaScript">

    var _t=null;
    var _current=0;
    var _table_count=0;
    var _company="";
    var _url_new="";
    var _create_folder=false;
    
    function create_company(){
        
        if(_current<_table_count ){ 
            //still process
            $('#dlgProcess').modal('show');
            return false;
        }
        _company=$("#company").val();
        _company=_company.replace('/<[^>]+>@$#,()-/g', '');
        _company=_company.replace(' ','');
        _company=_company.toLowerCase();
        
        _url_new="<?=$this->config->item("url_new")?>/"+_company;
        
        $("#company").val(_company);
        add_log("Registering database ..."+_company+", please wait...");
        
        $('#dlgProcess').modal('show');

        if(company==""){
            add_log("Enter company code !");
            return false;
        }
        
        _current=0;
        _table_count=0;
        
        var _url="<?=base_url("index.php/welcome/set_db")?>";
        var _param={"company":_company};
        
        $("#divProcess").html("<p>Creating database... please wait...</p>");                
        $("#divImg").toggle();
        
        $.ajax({ type: "POST", url: _url, data: _param,
            success: function(result){
                if(IsJsonString(result)){
                    var result = eval('('+result+')');
                    if(result.success){
                        _create_folder=true;
                        _table_count=result.table_count;                    
                        add_log("Success database created, next create table...")
                        _t=setTimeout(function(){create_tables()}, 500);
                    } else {
                        add_log(result.msg);
                    }
                } else {
                    add_log("Unhandled error..!!");
                    add_log(result);                    
                }
            },
            error: function(result){
                    add_log("Unhandled error..!!");
                    add_log(result);                    
            }
        }); 
    }
    function open_company(){
        window.open(_url_new,"_self");
    }
    function create_tables(table_count){        
        _current++;
        if(_current>_table_count){
             clearTimeout(_t);
             add_log("Congratulation, your company database has been created ");
             add_log("Click this url: <strong><a href='"+_url_new+"'>"+_url_new+"</strong>");
             _t2=setTimeout(function(){open_company()}, 500);
             return false;
        }
        var _url="<?=base_url("index.php/welcome/create_table")?>/"+_current;
        var _param={company: _company};
        
        $.ajax({ type: "POST", url: _url, data: _param,
            success: function(result){
                if(IsJsonString(result)){
                    var result = eval('('+result+')');
                    if(result.success){
                        clearTimeout(_t);
                        add_log(result.msg);
                        _t=setTimeout(function(){create_tables()}, 500);
                    } else {
                        add_log(result.msg);
                         _current=_table_count;
                        clearTimeOut(_t);
                    }
                } else {
                     _current=_table_count;
                    clearTimeout(_t);
                    add_log("Unhandled error..!!");
                    add_log(result);                    
            }
            },
            error: function(result){
                 _current=_table_count;
                clearTimeout(_t);
                add_log("Unhandled error..!!");
                add_log(result);                    
        }
        }); 
        
        
    }
    function add_log(txt){
        $("#divProcess").append(txt+"</br>");        
    }
</script>
