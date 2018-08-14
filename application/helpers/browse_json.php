<?php
$CI =& get_instance();
 $sql="select customer_number,company,street from customers";
$query=$CI->db->query($sql.' limit 1');
$i=0;
foreach($query->result_array() as $row){
    $rows[$i++]=$row;
};
echo json_encode($rows);
?>