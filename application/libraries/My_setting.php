<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_setting  extends Sysvar
{
     
    function __construct()
    {
         $this->CI =& get_instance();        
         $this->CI->load->helper('mylib');
         $this->CI->load->library("list_of_values");
     }
    public function create_invoice_from_receive(){
        $retval=false;
        $s=$this->getvar("create_invoice_from_receive");
        if($s!=""){
            $retval=$s;
        }
        return $retval;
    }
    public function sort_by(){
        $retval=false;
        $s=$this->getvar("sort_by");
        if($s!=""){
            $retval=$s;
        }
        return $retval;
    }

 }
     
