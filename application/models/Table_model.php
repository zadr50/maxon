<?php
class Table_model extends CI_Model {
    private $result_id=0;
    private $fields=null;
    private $table_name='';
    private $field_key='';
    private $sql='';
    function __construct(){
        parent::__construct();        
      
        
        $this->load->helper('mylib_helper');
        $this->load->library('table');
        $this->load->library('pagination');
        
    }
    function load($table_name,$field_key=''){
        $this->browse($param);
    }
	
    function table_def($table_name=''){
		if($table_name!='')$this->table_name=$table_name;
       /*  $q = mysql_query('DESCRIBE '.$this->table_name);
        while($row = mysql_fetch_array($q)) {
    //        echo "{$row['Field']} - {$row['Type']}\n";
            preg_match('/([a-zA-Z]+)(\(\d+\))?/', $row['Type'], $matches);

            $type = (array_key_exists(1, $matches)) ? $matches[1] : NULL;
            $length = (array_key_exists(2, $matches)) ? preg_replace('/[^\d]/', '', $matches[2]) : NULL;

            $F				= new stdClass();
            $F->name		= $row['Field'];
            $F->type		= $type;
            $F->default		= $row['Default'];
            $F->max_length	= $length;
            $F->primary_key = ( $row['Key'] == 'PRI' ? 1 : 0 );
            $F->visible=True;
            $F->caption=str_replace('_',' ',$F->name);
            $retval[] = $F;
        } */
		$retval=array();	$name=array();	$len=array(); $flag=array();
		if($fields=$this->db->field_data($table_name)){
			foreach($fields as $fld){
				$F				= new stdClass();
				$F->name		= $fld->name;
				$F->type		= $fld->type;
				//$F->default		= $row['Default'];
				$F->max_length	= $fld->max_length;
				$F->primary_key = $fld->primary_key;
				$F->visible=True;
				$F->caption=str_replace('_',' ',$F->name);
				$retval[] = $F;
			}
		}
		
        return $retval;
    }
         function data($table_name='',$offset=0,$limit=10,$field_key='',$field_val=''){
           
            
            $sql="select * from ".$table_name;
            
            if($field_key<>"")$sql.=" where ".$field_key." like '".$field_val."%'";
            $query=$this->db->query($sql);
            $i=0; 
            foreach($query->result_array() as $row){
                $rows[$i++]=$row;
            };
            $data['total']=$i;
            $data['rows']=$rows;
           
            echo json_encode($data);
           
        }
        function browsex($param=null)
    {
        //add header
        foreach($this->fields as $fld){
            $header[]=$fld->caption;
        }
        $this->table->set_heading($header);
        $this->table->set_empty('&nbsp;');
        //add row
        $offset=$param['offset'];
        $limit=$param['limit'];
        $offset=$offset*$limit;
        if($offset==0)$offset=1;
        $this->db->from($this->table_name);
        $query=$this->db->limit($limit,$offset);
        $query=$this->db->get();
        $i=0;
        foreach($query->result_array() as $row){
            $i=0;
            foreach($this->fields as $fld){
             $newrow[$i++]=$row[$fld->name];
            };
            $this->table->add_row($newrow);
        };
        $tmpl=$this->table_template();
        $this->table->set_template($tmpl);
        $retval=$this->table->generate();        
        $config['base_url']=site_url();
        $config['total_rows']=$i;
        $config['per_page']=10;
        $config['uri_segment']=3;
        $this->pagination->initialize($config);
        $link=$this->pagination->create_links();
       //show table
        $data['_content']=$retval;
        $data['caption']=$this->table_name;
        //$data['_top_menu']=$this->load->view('menu',$data, true);
        //$data['_header']=$this->load->view('template/standard/header',$data);
        $this->load->view('table',$data);
    }
    function table_template(){
        return array (
            'table_open'          => '<table id="dg"
              cellpadding="0" cellspacing="0" border="0" class="display"     title="Basic DataGrid"
                >',

            'heading_row_start'   => '<tr>',
            'heading_row_end'     => '</tr>',
            'heading_cell_start'  => '<th>',
            'heading_cell_end'    => '</th>',

            'row_start'           => '<tr>',
            'row_end'             => '</tr>',
            'cell_start'          => '<td>',
            'cell_end'            => '</td>',

            'row_alt_start'       => '<tr>',
            'row_alt_end'         => '</tr>',
            'cell_alt_start'      => '<td>',
            'cell_alt_end'        => '</td>',

            'table_close'         => '</table>'
      );

    }
}
