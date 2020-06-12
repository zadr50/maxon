<?php
class Media extends CI_Controller {
	function __construct()
	{
		parent::__construct();        
        
 		$this->load->helper(array('url','form','mylib_helper'));
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->model('syslog_model');
	} 
	function index()
	{	
        $data=null;
        $dir    = __DIR__ ."/../../tmp/";
        $dh  = opendir($dir);
        while (false !== ($fileName = readdir($dh))) {
            $ext = substr($fileName, strrpos($fileName, '.') + 1);
            if(in_array($ext, array("jpg","jpeg","png","gif","JPG")))
                $data['fileList'][] = array("name"=>$fileName,"url"=>base_url().'/tmp/'.$fileName);
        }
        closedir($dh);
        echo json_encode($data);
    }
    function upload(){
        $data['success']=true;
        $data['message']='Success';
        echo json_encode($data);
    }
    function delete($file){
        $dir    = __DIR__ ."/../../tmp/".$file;
        unlink($dir);
        $data['success']=true;
        $data['message']='Success';
        echo json_encode($data);
    }
    function sliderPromo(){
        if($data=$this->input->post()){
            putvar('slider1',$data['slider1']);
            putvar('slider2',$data['slider2']);
            putvar('slider3',$data['slider3']);
            putvar('slider4',$data['slider4']);

            putvar('promo1',$data['promo1']);
            putvar('promo2',$data['promo2']);
            putvar('promo3',$data['promo3']);
            putvar('promo4',$data['promo4']);

        } else {
            $data['slider1']=getVar("slider1","slider1.jpg");
            $file=__DIR__ ."/../../tmp/".$data["slider1"];
            if(!file_exists($file))$data['slider1']='';

            $data['slider2']=getVar("slider2","slider2.jpg");
            $file=__DIR__ ."/../../tmp/".$data["slider2"];
            if(!file_exists($file))$data['slider2']='';

            $data['slider3']=getVar("slider3","slider3.jpg");
            $file=__DIR__ ."/../../tmp/".$data["slider3"];
            if(!file_exists($file))$data['slider3']='';

            $data['slider4']=getVar("slider4","slider4.jpg");
            $file=__DIR__ ."/../../tmp/".$data["slider4"];
            if(!file_exists($file))$data['slider4']='';

            $data['promo1']=getVar("promo1","promo1.jpg");
            $data['promo2']=getVar("promo2","promo2.jpg");
            $data['promo3']=getVar("promo3","promo3.jpg");
            $data['promo4']=getVar("promo4","promo4.jpg");
        }
        echo json_encode($data);
    }

}