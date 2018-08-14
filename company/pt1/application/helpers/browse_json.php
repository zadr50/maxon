<?php
$CI =& get_instance();
            
       $multi_company=$CI->config->item('multi_company');
       if($multi_company){
            $company_code=$CI->session->userdata("company_code","");
            if($company_code!=""){
               $CI->db = $CI->load->database($company_code, TRUE);
           }
       }         
$sql="select customer_number,company,street from customers";
$query=$CI->db->query($sql.' limit 1');
$i=0;
foreach($query->result_array() as $row){
    $rows[$i++]=$row;
};
echo json_encode($rows);
?>