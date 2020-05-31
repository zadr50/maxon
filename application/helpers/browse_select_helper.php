<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! function_exists('browse_select'))
{
    function browse_select($sql_array,$caption='',$class='',
            $field_key='',$offset=0,$limit=200
            ,$order_column='',$order_type='asc',$show_action=false)
    {
        $fields_input='';
        $sql=$sql_array;
        $action_button='<input type="button" value="Del" 
                 onclick="del_row(\'#'.$field_key.'\');return false;"/>';
        $hidden=''; 
		$fields_sum='';
        $group_section_fields=null;
        
        if(is_array($sql_array)){
           $sql=$sql_array['sql'];
           if(isset($sql_array['caption']))$caption=$sql_array['caption'];
           if(isset($sql_array['class']))$class=$sql_array['class'];
           if(isset($sql_array['field_key']))$field_key=$sql_array['field_key'];
           if(isset($sql_array['offset']))$offset=$sql_array['offset'];
           if(isset($sql_array['limit']))$limit=$sql_array['limit'];
           if(isset($sql_array['order_column']))$order_column=$sql_array['order_column'];
           if(isset($sql_array['order_type']))$order_type=$sql_array['order_type'];
           if(isset($sql_array['show_action']))$show_action=$sql_array['show_action'];
           if(isset($sql_array['action_button']))$action_button=$sql_array['action_button'];
           if(isset($sql_array['fields_input']))$fields_input=$sql_array['fields_input'];
           if(isset($sql_array['hidden']))$hidden=$sql_array['hidden']; 
           if(isset($sql_array['fields_sum']))$fields_sum=$sql_array['fields_sum']; 
           if(isset($sql_array['group_by']))$group_by=$sql_array['group_by']; 
           if(isset($sql_array['group_section_fields']))$group_section_fields=$sql_array['group_section_fields']; 
        };
        $CI =& get_instance();
        $CI->load->library('template');
        $CI->load->library('table');
        $i=0+$offset;
		$count=0;
		$type=array();	$name=array();	$len=array(); $flag=array();
		$fld=array();	$flds=array();
		if( substr(CI_VERSION,0,1)== '2' ) {
			$query=$CI->db->query($sql.' limit 1');
			$result = mysql_query($sql.' limit 1');
			$count = mysql_num_fields($result);
			$type[0]='';$flds[0]='';            
			for ($i=0; $i < $count; $i++) {
				$type[$i]  = mysql_field_type($result, $i);
				$flds[$i]  = mysql_field_name($result, $i);
				$len   = mysql_field_len($result, $i);
				$flags = mysql_field_flags($result, $i);
//				echo $type . " " . $name . " " . $len . " " . $flags . "\n";
			}
		} else {
			$query=$CI->db->query($sql.' limit 1');
			if($fields=$query->field_data()){
				foreach($fields as $fld){
					$type[]=$fld->type;
					$name[]=$fld->name;
					$flds[]=$fld->name;
					$len[]=$fld->max_length;
					$count++;
					//echo $fld->type . " " . $fld->name . " " . $fld->max_length . "\n";
					
				}
			}		
		}
        $where='';
        for($i=0;$i<$count;$i++){
            $fld=$flds[$i];
			$lhide=false;
			if(is_array($hidden)){
				for($j=0;$j<count($hidden);$j++){
					if(strcasecmp($hidden[$j], $fld)==0 ){
						$lhide=true;
						break;
					}
				}
			}
            
            $fld=ucfirst(str_replace('_',' ',$fld));
            
            if(!$lhide)  $flds2[$i]=$fld;
			 
			

            if(isset($_GET[$flds[$i]])){
                $val=$_GET[$flds[$i]];
            } else {
                $val='';
            }
            
            $flds_input[$i]='<input id="'.$flds[$i].'"/>';
             
            if(isset($_GET[$flds[$i]])){
                $where=$where.' '.$flds[$i].' like \''.$_GET[$flds[$i]].'%\' and ';
            }
        }
        //var_dump($where);
        if($caption=='')$where='';
        if($where!=''){
            $where=substr($where,0,strlen($where)-4);
            if(preg_match('/ where /',$sql)){
                $sql=$sql.' AND '.$where;
            } else {
                $sql=$sql.' WHERE '.$where;                
            }
            if($order_column!='') $sql=$sql.' ORDER BY '.$order_column.' '.$order_type;
            //$sql=$sql.' limit '.$offset*$limit.', '.$limit;
            $query=$CI->db->query($sql);
        } else {
            if($order_column!='') $sql=$sql.' ORDER BY '.$order_column.' '.$order_type;
            //$sql=$sql.' limit '.$offset*$limit.', '.$limit;
            $query=$CI->db->query($sql);
            
        }
        if($show_action){ 
            if($caption!='')$flds2[$i++]='Action';else $flds2[$i++]='Act';
        }
        $CI->table->set_heading($flds2);
        $j=0;
		if(is_array($fields_sum)){
			for($j=0;$j<count($fields_sum);$j++){
				$fields_sum_value[$fields_sum[$j]]=0;
			}
		}
		$eof=false;
		$rows=$query->result_array();

		//echo $sql;exit;
		$count_colspan=$count;
		if(isset($hidden)){
			if(is_array($hidden)){
				$count_colspan-=count($hidden);
			}
		}

		$k=0;
		$old_val="";$new_val="";
		//echo "<h1>".count($rows)."</h1>";
		if(count($rows)){
		$row=$rows[$k];
        while( ! $eof and $k<count($rows) ){
			if( $row ){
				$newrow=null; 
				$group_by1=null;
				if(isset($group_by))$group_by1=$group_by[0];
				for($ik=0;$ik<$count;$ik++){
					$fld=$flds[$ik];
					if(isset($fields_sum_value[$fld])){
						$sub_ttl[$fld]=0;
					} 
				}
				
				$new_val="";
				$old_val="";
				if($group_by1){
					$new_val=strtoupper($row[$group_by1]);
					$old_val=$new_val;
                    $new_val2=$new_val;
                    if($group_section_fields){
                        foreach ($group_section_fields as $igsf => $value) {
                            $gsf_fields=$value;
                            for($igsf2=0;$igsf2<count($gsf_fields);$igsf2++){
                                $gsf_field_name=$gsf_fields[$igsf2];
                                $new_val2.=" - ".$row[$gsf_field_name];
                            
                                
                            }
                        }
                        
                        
                    }
                    $sgrp="<tr><td colspan=$count_colspan><h2>$new_val2 </h2></td>";
                    $sgrp.="</tr>";
					$CI->table->add_row($sgrp);
				}
				while ( ! $eof and $k<count($rows) and $new_val==$old_val ) {
					$newrow=null; 
					for($i=0;$i<$count;$i++){
						$fld=$flds[$i];
						$lhide=false;
						if(is_array($hidden)){
							for($j=0;$j<count($hidden);$j++){
								if(strcasecmp($hidden[$j], $fld)==0 ){
									$lhide=true;
									break;
								}
							}
						}
						if(!$lhide){
							if($fld=="ttc_1x"){
								//echo 1;
							}
							if($type[$i]==5 || $type[$i]=='real' || $type[$i]=='5' || $type[$i]=="double" 
							|| $type[$i]=="int" ){
								//|| $type[$i]==3
								$val=$row[$fld];
//								if($val>0 and $val<1){
									$val=number_format($val,2);
//								} else {
//									$val=number_format($val);
//								}
								$newrow[$i]= '<div align="right">'.$val.'</div>';
							} else {
								$newrow[$i]=$row[$fld];
							}
							if(is_array($fields_input)){
							   for($j=0;$j<count($fields_input);$j++){                            
								   if($fld==$fields_input[$j]){
									  $newrow[$i]='<input id="'.$fld.$i.'" value="'.$row[$fld].'" style="width:50px"/>';
								   }
							   }
							}
						}
						if(is_array($fields_sum)){
							for($j=0;$j<count($fields_sum);$j++){
								if(strcasecmp($fields_sum[$j],$fld)==0){
									$fields_sum_value[$fld]=$fields_sum_value[$fld]+$row[$fld];
									if(isset($sub_ttl[$fld])){
										$sub_ttl[$fld]=$sub_ttl[$fld]+$row[$fld];
									}
									break;
								}
							}
						}
					}
					if($field_key=='') $key=$row[$flds[0]];else $key=$row[$field_key];

					if($caption!=''){
						$newrow[$i++]='
						<input id="txtQty'.$j.'" style="width:30px" value="1"/>    
						<input type="button" value="Add" 
						onclick="add_row(\''.$j.'\',\''.$key.'\');return false;"/>';
				   } else {
					   if($show_action){
							$button=str_replace('#'.$field_key,$key, $action_button);
							$button=str_replace('#',$key, $action_button);
						   
							$newrow[$i++]=$button;
					   }
				   }
					
					$CI->table->add_row($newrow);
					$j++;    
					$i++;
					$k++;
					if($k<count($rows)){
						$row=$rows[$k];
						$eof = ! $row;
					}
					if($row){
						if($group_by1){
							$new_val=strtoupper($row[$group_by1]);
						}
					}
					
				}
				
				if($group_by1){
					if(isset($fields_sum[0])){
//						$CI->table->add_row("<strong>Sub total  $group_by1 : $old_val Rp. ".$sub_ttl[$fields_sum[0]]."</strong>");
						$s2=null;
						for($ik=0;$ik<$count;$ik++){
							$fld=$flds[$ik];
							$s2[$ik]="";							
							if(isset($fields_sum_value[$fld])){
								if(is_array($s2))$s2[count($s2)-2]='<div align="right"><strong>'.number_format($sub_ttl[$fld],2).'</strong></div>';
							} else {
								
								$lhide=false;
								if(is_array($hidden)){
									for($j=0;$j<count($hidden);$j++){
										if(strcasecmp($hidden[$j], $fld)==0 ){
											$lhide=true;
											break;
										}
									}
								}
								if(!$lhide){
									if($ik==1){
										if(is_array($s2))$s2[count($s2)-1]="<b>SUB TOTAL</b>";										
									} 									
								}
							}
						}
						$CI->table->add_row($s2);						
					}
				}
			
			
			}
        };
		}
		$s3=null;
		for($i=0;$i<$count;$i++){
			$fld=$flds[$i];
			$lhide=false;
			if(is_array($hidden)){
				for($j=0;$j<count($hidden);$j++){
					if(strcasecmp($hidden[$j], $fld)==0 ){
						$lhide=true;
						break;
					}
				}
			}
			if(isset($fields_sum_value[$fld])){				
				if(is_array($s3))$s3[count($s3)]='<div align="right"><strong>'.number_format($fields_sum_value[$fld],2).'</strong></div>';
			} else {
				if(!$lhide){
					$s3[]="";				
				}
			}
			//if(is_array($s3))$s3[count($s3)]="<strong>GRAND TOTAL</strong>";
		}
        $CI->table->add_row($s3);
		if($class=="")$class="titem";
		
        $tmpl=$CI->template->template_table($class);
        $CI->table->set_template($tmpl);
        $retval=$CI->table->generate();
        
        $CI->load->library('pagination');
        $config['base_url']=site_url('browse');
        $config['total_rows']=$i;
        $config['per_page']=10;
        $config['uri_segment']=3;
        $CI->pagination->initialize($config);
        $link=$CI->pagination->create_links();
        if($caption==''){
            $s='';
        } else {
        $s='
            <div id="divBrowse" >
            Rows <input id="txtLimit" value="'.$limit.'" style="width:50px"/>
            <strong>Search</strong>&nbsp
            <input id="txtSearch" name="txtSearch"/>
            <input type="button" onclick="b_search();return false;" value="Search"/>
            </div>
            ';
        }
        return $s.$retval;
    }
}