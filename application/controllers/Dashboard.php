<?php if(!defined('BASEPATH')) exit('No direct script access allowd');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();        
         
 		$this->load->helper(array('url','form'));
		$this->load->library('template',"access");;
	}
	function index()
	{	
		if($this->access->is_login()){		    
			$data['message']='';
			$this->template->display('bos/home',$data,'');
		} else {
			header("location:login/simple");
		}
	}
	function getData(){
		$s="select sum(amount/1000) as zamt from purchase_order where potype in ('P','O')";
		if($q=$this->db->query($s)){
			$total_purchase=$q->row()->zamt;
		}
		$data['total_purchase']="Rp.".number_format($total_purchase);


		$s="select sum(amount/1000) as zamt from sales_order";
		if($q=$this->db->query($s)){
			$total_sales=$q->row()->zamt;
		}
		$data['total_sales']="Rp.".number_format($total_sales);

		$data = $this->chart_supplier($data);

		$data['barLegend']=['2011', '2012'];
		$data['barYAxis']=['Makanan', 'Minuman', 'Keramik', 'Cat', 'Tool', 'Sanitary'];
		$data['barSeries']= array(
				["name"=>'2011',"type"=>'bar',"data"=>[18203, 23489, 29034, 104970, 131744, 630230]],
				["name"=>'2012',"type"=>'bar',"data"=>[19325, 23438, 31000, 121594, 134141, 681807]]		
		);
		$data['lineLegend']= ['alfamart', 'indomart', 'matahari'];
		$data['lineXAxis']= ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
		$data['lineSeries']= [
			[
				"name"=> 'alfamart',
				"type"=> 'line',
				"stack"=> 's1',
				"data"=> [120, 132, 101, 134, 90, 230, 210]
			],
			[
				"name"=> 'indomart',
				"type"=> 'line',
				"stack"=> 's2',
				"data"=> [220, 182, 191, 234, 290, 330, 310]
			],
			[
				"name"=> 'matahari',
				"type"=> 'line',
				"stack"=> 's3',
				"data"=> [820, 932, 901, 934, 1290, 1330, 1320]
			]
		];
		$data['pieLegend']=['alfamart', 'toko b', 'toko c', 'toko d', 'toko e'];
		$data['pieSeries']= [
			[
				"name"=> 'alfamart',
				"type"=> 'pie',
				"radius"=> '55%',
				"center"=> ['50%', '60%'],
				"data"=> [
					[ "value"=> 335, "name"=> 'toko b' ],
					[ "value"=> 310, "name"=> 'toko c' ],
					[ "value"=> 234, "name"=> 'toko d' ],
					[ "value"=> 135, "name"=> 'toko e' ],
					[ "value"=> 1548, "name"=> 'alfamart' ]
				],
				"itemStyle"=> [
					"emphasis"=> [
						"shadowBlur"=> 10,
						"shadowOffsetX"=> 0,
						"shadowColor"=> 'rgba(0, 0, 0, 0.5)'
					]
				]
			]
		];



		echo json_encode($data);

	}
	function chart_supplier($data){
		$supplierDataChartX=[];
		$supplierDataChartSeries=[];
		$s="select o.supplier_number,sum(o.amount/1000) as zamt 
		  from purchase_order o group by o.supplier_number 
		  limit 6";
		if($q=$this->db->query($s)){
			foreach($q->result() as $r){
				$supplierDataChartX[]=$r->supplier_number;
				$supplierDataChartSeries[]=$r->zamt;

			}
		}

		$data['supplierDataChartX']=$supplierDataChartX;
        $data['supplierDataChartSeries']=$supplierDataChartSeries;

		return $data;
	}
}