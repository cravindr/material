<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 27-07-2018
 * Time: 11:37 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require_once (APPPATH.'libraries/ssp.class.php');
class Available extends CI_Controller
{

    var $datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('available_model','dashboard_model'));
        $this->datetime = $this->dashboard_model->datetime();
    }

    public function index()
    {
        $mes = $this->session->userdata("available");

		$name = $this->input->post('name');
		$note = $this->input->post('note');

		$stockinfo[]=array(
			'name'=>$name,
			'note'=>$note,
			'date'=>$this->datetime
		);

		        	$prod_id_ar = $this->input->post('product');
			$qty_ar = $this->input->post('quantity');
			$prodarr = array_combine($prod_id_ar,$qty_ar);

/*		print_r($prod_id_ar);
		echo "<br>";
		print_r($qty_ar);
		echo "<br>";
		print_r($prodarr);
		echo "<br>";
		echo "</pre>";
		exit;*/

			//this code store available product checked product and quantity stored in this session
			$this->session->set_userdata("availability_check",$prodarr);


      /*  echo "<pre>";
        print_r($this->input->post());
		print_r();
        echo "</pre>";*/

        $product_list=$prodarr;   // product id and product count supplied by associative array
        $dumarr=array();
        foreach ($product_list as $k=>$v)
        {
            $spares=$this->available_model->GetProductSpares($k);  // get the speres as associative array
            $totspares=$this->available_model->fnArrayMultiplay($spares,$v); // array multiplication by its count
            /*print_r("<pre>");
            print_r($totspares);
            print_r("<br>........................................");
            print_r("</pre>");*/
            $dumarr=$this->available_model->fnAddArray($dumarr,$totspares);  //sum the total count
        }


/*
        $spares1=$this->available_model->GetProductSpares(1);
        $spares2=$this->available_model->GetProductSpares(2);

        /*$ar1=$this->available_model->fnObjectArrayToAssociativeArray($spares1);
        $ar2=$this->available_model->fnObjectArrayToAssociativeArray($spares2);

        $ar3=$this->available_model->fnArrayMultiplay($spares1,2);
        //$ar=$this->available_model->fnAddArray($ar3,$spares2);
        $ar=$this->available_model->fnAddArray($dumarr,$spares1);  */

        $resv="";
        $obj=new stdClass();
        $result=array();
      //  $i=0;



        foreach ($dumarr as $k=>$v)
        {

            $res=   $this->available_model->GetElementById($k);


     //  $resv = $res[0]->spare_name." Need ".$v."Available:". $res[0]->spare_quantity."<br>";
            $obj->spare_id=$k;
            $obj->spare_name=$res[0]->spare_name;
            $obj->qty_need=$v;
            $obj->qty_available=$res[0]->spare_quantity;

            $result[] = array(
                'spare_id' => $k,
                'part_no' => $res[0]->spare_part_no,
                'spare_name' => $res[0]->spare_name,
                'qty_need' => $v,
                'qty_available' => $res[0]->spare_quantity,
				'qty_required'=>$res[0]->spare_quantity-$v
            );


        }

		$this->session->set_userdata('finalresult',$result);
        $this->session->set_userdata('stockinfo',$stockinfo);


        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Available Spares',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes),
                'product_list'=>$product_list,
                'final'=>$dumarr,
                'results'=>$result
            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'Available Spares',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => '',
                'product_list'=>$product_list,

                'final'=>$dumarr,
                'results'=>$result

            );
        }

        $this->load->view('aval_spares',$data);
        $this->session->unset_userdata("available");
    }

    public function Check()
    {
        $mes = $this->session->userdata("Available");

        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Available',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes)
            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'Available',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => ''
            );
        }

        $this->load->view('available_check',$data);
        $this->session->unset_userdata("Available");
    }

    public function GetProductJson()
	{
		$result = $this->available_model->getproduct();
		echo json_encode($result);
	}


    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Spare Selection record Inserted Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Spare Selection record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;Spare Selection record Updated Successfully...</div>';
        }
        elseif ($message == 'unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Spare Selection record Does not Updated Try again...</div>';
        }

        return $mess;
    }

    public function GetSpareFromStock()
	{
		$res=$this->session->userdata('finalresult');
		$stockinfo=$this->session->userdata('stockinfo');
		$this->session->unset_userdata('finalresult');
		$this->session->unset_userdata('stockinfo');

		$data=array('result'=>$res,
					 'stockinfo'=>$stockinfo);

		$result=$this->available_model->transaction($data);

		if($result>0)
		{
			//Message("saved");
			$res=$this->session->set_userdata('Available','saved');
		}
		else
		{
			$res=$this->session->set_userdata('Available','unsaved');
		}


		redirect("available/check");

	}


	public function SetPoTable()
	{
		$res=$this->session->userdata('finalresult');
		$stockinfo=$this->session->userdata('stockinfo');
		$this->session->unset_userdata('finalresult');
		$this->session->unset_userdata('stockinfo');

		$data=array('result'=>$res,
			'stockinfo'=>$stockinfo);

		$result=$this->available_model->Po_requirment($data);

		if($result>0)
		{
			//Message("saved");
			$res=$this->session->set_userdata('Available','saved');
		}
		else
		{
			$res=$this->session->set_userdata('Available','unsaved');
		}


		redirect("available/check");

	}





	public function TransactionList()
	{
		$mes = $this->session->userdata("transaction_list");

		if(isset($mes))
		{
			$data = array(
				'pagetitle' => 'Transaction List',
				'profile_name' => $this->session->userdata('Loginsession')->user_name,
				'message' => $this->Message($mes),



			);
		}
		else
		{
			$data = array(
				'pagetitle' => 'Transaction List',
				'profile_name' => $this->session->userdata('Loginsession')->user_name,
				'message' => '',


			);
		}

		$this->load->view('transaction_list', $data);
		$this->session->unset_userdata("transaction_list");
	}




	public function TransactionServerSide()
	{
		// DB table to use
		$table = 'transaction';

		// Table's primary key
		$primaryKey = 'trans_id';

		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes
		$columns = array(
			array( 'db' => 'trans_id', 'dt' => 0 ),
			array( 'db' => 'name',  'dt' => 1 ),
			array( 'db' => 'note',  'dt' => 2 ),
			array( 'db' => 'cdate',   'dt' => 3 ),
			array(
				'db'        => 'status',
				'dt'        => 4,
				'formatter' => function( $d, $row ) {
					if($d == 'active')
					{
						$btn = "btn btn-success btn-xs";
					}
					else
					{
						$btn = "btn btn-danger btn-xs";
					}
					return '<button type="button" id="btnstatus" class="'.$btn.'">'.$d.'</button>';
				}
			),



			array(
				'db'        => 'trans_id',
				'dt'        => 5,
				'formatter' => function( $d, $row ) {
					return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> &nbsp; 
                           <button type="button" id="btnprint" class="btn btn-primary btn-xs" title="Print"><i class="fa fa-download " aria-hidden="true"></i></button> 
                            &nbsp; <button type="button" id="btndelete" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
				}
			),
			array( 'db' => 'status',   'dt' => 6 )
		);

		// SQL server connection information
		$sql_details = array(
			'user' => $this->db->username,
			'pass' => $this->db->password,
			'db'   => $this->db->database,
			'host' => $this->db->hostname
		);


		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

		echo json_encode(
			SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
		);
	}


	public function TransView()
	{


		$prod_id = $this->input->post('id');

		$result = $this->available_model->viewTransaction($prod_id);
		echo json_encode($result);
	}




public function cancelTransaction()
{

	$trans_id=$this->input->post('trans_id');
	$sparse=$this->input->post('spare_id');
	$qty=$this->input->post('qty');

	$data=array(
		'trans_id'=>$trans_id,
		'date'=>$this->datetime ,
		'spare_id'=>$sparse,
		'qty'=>$qty);
	$ret=$this->available_model->TransactionCancel($data);

	//redirect("available/");

}






}
