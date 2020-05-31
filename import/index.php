<?
include "koneksi.php";
//var_dump($_POST);
//exit;

$cmd="";
if(isset($_POST['cmd']))$cmd=$_POST['cmd'];
$data['cmd']=$cmd;
if($cmd==""){
    echo "Error: Unknown cmd: $cmd";
    exit;
}
$table="";
if(isset($_POST['table_name']))$table=strtolower($_POST['table_name']);
$data['table_name']=$table;
if($table=="purchase_order_lineitems"){
    $s="";
}

$field="";
if(isset($_POST['field_name']))$field=$_POST['field_name'];

 
if($cmd=="table_exist"){
    $data['success']=mx_sql_table_exist($table);
    $data["error"]=mysql_error();
    echo json_encode($data);
    exit;
    
}
if($cmd=="field_exist"){
    $data['result']=mx_sql_field_exist($table,$field);
    $data["error"]=mysql_error();
    echo json_encode($data);
    exit;
    
}
 

if($cmd=='sql_exec'){
    $sql=$_POST["sql"];
    $sql=str_ireplace(array("\r","\n",'\r','\n'),'', $sql);    
    $data=mx_sql_exec($sql);
//    $data["error"]=mysql_error();
    echo json_encode($data);
    exit;
}
$gid="";
if(isset($_POST['gid'])){
	$gid=$_POST['gid'];
}
$data=mx_table_desc($table);

if($gid==""){
	$key_field=$data['key_field'];
	$key_value=$data['key_value'];
} else {
	$key_field="gid";
	$key_value=$gid;
}
$record=$data['record'];
if(isset($record['gid'])){
    if($record['gid']==''){
        $record['gid']=$gid;
    }
}
$return=""; $cnt=0; $ret="";
if($key_field!=""){
    $cnt = mx_sql_rows($table, $key_field, $key_value);
}
if( $cnt>0 ) {
    $ret = mx_sql_update($table,$record,$key_field,$key_value);
} else {
    $ret = mx_sql_insert($table, $record);
}
if($table=="invoice"){
   $s="update invoice  set amount=inv_amount where invoice_number='$key_value' ";
   mysql_query($s); 
   $ret=mysql_error();
 } 

if($ret==""){
	$return = "OK";
    if($key_field!="") $return = "OK : ".$table." - ".$key_value;
} else {
    $return = "ERR : ".$ret;
}

echo $return;

function mx_sql_update($table,$record,$key_field_name,$value){
    $values = array_values($record);
    $keys = array_keys($record);
    
    $s="UPDATE `".$table."` SET ";
    for($i=0;$i<count($keys);$i++){
        if($keys[$i]!=$key_field_name){
            $s=$s.'`'.$keys[$i]."`='".$values[$i]."',";
        }
    } 
    if(strrpos($s, ',',-1) ) {
        $s =  substr ($s,0, strlen ($s)-1);
    }
    $s = $s." WHERE `".$key_field_name."`='".$value."'";
    $ret=mysql_query($s);
    
    return mysql_error();
}
function mx_sql_insert($table, $inserts) {
    $values = array_map('mysql_real_escape_string', array_values( $inserts));
    $keys = array_keys($inserts);
    $sql='INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`)
    VALUES (\''.implode('\',\'', $values).'\')';
    
    $ret=mysql_query($sql);
    return mysql_error();
}
function mx_sql_rows($table,$key_field_name,$value){
    $cnt=0;
    $sql="select $key_field_name from $table where $key_field_name = '$value' limit 1";
    if ( $result=mysql_query($sql) ) $cnt = mysql_num_rows($result);
    return $cnt;
}
function mx_sql_table_exist($table){
    $retval=false;
    $sql="select count(1) from $table limit 1";    
    mysql_query($sql);
    $err=mysql_error();
    if($err=="") $retval = true;
    return $retval;
}
function mx_sql_exec($sql){
    $retval=false;
    $q=mysql_query($sql);
    $err=mysql_error();
    if($err=="") $retval = true;
    $row=null;
    if(mysql_num_rows($q)>0)$row=mysql_fetch_assoc($q);
    return $row;
}

function mx_sql_field_exist($table,$field){
    $retval=false;
    $sql="select $field from $table limit 1";    
    mysql_query($sql);
    $err=mysql_error();
    if($err=="") $retval = true;
    return $retval;
}

function mx_table_desc($table){
    if ($table=='')exit;
    $result = mysql_query("SHOW COLUMNS FROM ".$table);
    if (!$result) {
       echo 'ERR : Table ['.$table.'] Not Found Or Syntax Error';
       exit;
    }
    $key_field=""; $key_value="";
    $record=null;
    
    if (mysql_num_rows($result) > 0) {
       while ($row = mysql_fetch_assoc($result)) {           
           $field=$row['Field'];
           $type=strtolower($row['Type']);
           if(isset($_POST[$field])){
               $value=$_POST[$field];
               if(strrpos($type, "bit")){
                   if(strtolower($value)=="0"){
                           $value=0;
                   } else {
                           $value=1;
                   }
               }
               if($value!="") {
                   $record[$field]=$value;
               }
               if($row['Key']=="PRI"){
                   $key_value=$value;
                   $key_field=$field;
               }
           }
       }
    }
   $data['key_field']=$key_field; 
   $data['key_value']=$key_value; 
   $data['record']=$record;
   return $data;
}
?>

