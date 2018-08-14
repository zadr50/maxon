<?
require(APPPATH.'libraries/REST_Controller.php');
class Books extends REST_Controller
{
    public function index_get()
    {
        echo "BOOKID: ".$this->get('nama');
    }
	public function name_get(){
		echo "NAME:".$this->get('nama');
	}

    public function index_post()
    {
        // Create a new book
    }
}
?>
