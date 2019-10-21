<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH.'libraries/ssp.class.php');
require_once (APPPATH.'libraries/join.ssp.class.php');

class Porder extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    var $datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('po_model','dashboard_model'));
        $this->datetime = $this->dashboard_model->datetime();
    }

	public function index()
	{
        $mes = $this->session->userdata("po");

        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Purchase Order',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes)
            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'Purchase Order',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => ''
            );
        }

        $this->load->view('po_new',$data);
        $this->session->unset_userdata("po");
	}

	public function PoList()
	{
		$mes = $this->session->userdata("po");

		if(isset($mes))
		{
			$data = array(
				'pagetitle' => 'Purchase Order List',
				'profile_name' => $this->session->userdata('Loginsession')->user_name,
				'message' => $this->Message($mes)
			);
		}
		else
		{
			$data = array(
				'pagetitle' => 'Purchase Order List',
				'profile_name' => $this->session->userdata('Loginsession')->user_name,
				'message' => ''
			);
		}

		$this->load->view('po_list',$data);
		$this->session->unset_userdata("po");
	}

	public function PoView()
	{
		$prod_id = $this->input->post('id');

		$result = $this->po_model->viewPO($prod_id);
		echo json_encode($result);
	}

	public function PoDelete()
	{
		$po_id = $this->input->post('id');

		$result = $this->po_model->delete($po_id);

		echo $result;
	}

	public function PrintPo($id)
	{
		$data = array(
			'po_master' => $this->po_model->getpomaster($id),
			'po_detail' => $this->po_model->getpodetail($id)
		);

		$this->load->view('make_po_print', $data);
	}



	public function RecivePO(){


    	$po_id=$this->input->post("po_id");
		$spare_id=$this->input->post("spare_id");
    	$price=$this->input->post("price");
    	$qty=$this->input->post("qty");
    	$data=array('po_id'=>$po_id,
					'cdate'=>$this->datetime,
					'spare_id'=>$spare_id,
					'price'=>$price,
					'qty'=>$qty);
    	$ret=$this->po_model->Transaction($data);

    	redirect('porder/polist');

}

	public function PoServerSide()
	{
		// DB table to use
		$table = 'purchase_order';

		// Table's primary key
		$primaryKey = 'po_id';

		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes
		$columns = array(
			array( 'db' => 'po_id', 'dt' => 0 ),
			array( 'db' => 'sup_name',  'dt' => 1 ),
			array( 'db' => 'c_date',  'dt' => 2 ),
			array(
				'db'        => 'status',
				'dt'        => 3,
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
				'db'        => 'status',
				'dt'        => 4,
				'formatter' => function( $d, $row ) {
					return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button> &nbsp; 
                            <button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Print"><i class="fa fa-print " aria-hidden="true"></i></button>
                            <button type="button" id="btnreceive" class="btn btn-primary btn-xs" title="Receive Purchase Order"><i class="fa fa-download " aria-hidden="true"></i></button>
                            <button type="button" id="btnemail" class="btn btn-warning btn-xs" title="Email Purchase Order"><i class="fa fa-mail-forward " aria-hidden="true"></i></button>
                            &nbsp; <button type="button" id="btndelete" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
				}
			),
			array( 'db' => 'status',  'dt' => 5 )
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

	public function PoSave()
    {
	/*	echo "<pre>";

    	print_r($this->input->post());exit;
		echo "</pre>";*/
		$sup_name=$this->po_model->GetSupplierNameById($this->input->post('supplier'));

		$data_po = array(
			'po_no_manu' => $this->input->post('po_no'),
			'sup_id' => $this->input->post('supplier'),
			'sup_name' => $sup_name,
			'c_date' => $this->datetime,
			'note' => $this->input->post('note'),
            'tax_type' => $this->input->post('tax_type'),
			'terms_of_delivery' => $this->input->post('terms_of_d'),
			'destination' => $this->input->post('destination'),
			'despatch' => $this->input->post('despatch'),
			'other_reference' => $this->input->post('other_reference'),
			'terms_of_payment' => $this->input->post('terms_of_payment'),
			'supplier_ref_no' => $this->input->post('sup_ref_no'),
			'status'=>'active'

		);



        $po_result = $this->po_model->savepo($data_po);

            if(!$po_result == 0)
            {
				$data_details = array(
              'po_id' =>$po_result,
              'spare_id' => $this->input->post('spares'),
              'qty' => $this->input->post('quantity'),
              'price' => $this->input->post('price'),
              'tax' => $this->input->post('tax'),
              'tax_amount' => $this->input->post('tax_amount'),
              'total' => $this->input->post('rowtotal'),
          );

                $result = $this->po_model->savepodetail($data_details);

                    if($result == 1)
                    {
                        $this->session->set_userdata("po","saved");
                        redirect('porder/');
                    }
                    else
                    {
                        $this->session->set_userdata("po","unsaved");
                        redirect('porder/');
                    }
            }
            else
            {
                $this->session->set_userdata("po","unsaved");
                redirect('porder/');
            }
    }

    public function GetSupplierActiveJson()
    {
        $this->load->model('supplier_model');
        $result = $this->supplier_model->getsupplieractive();
        echo json_encode($result);
    }

	public function GetSpareBySupplierJson()
	{
		$id=$this->input->post("id");
		$this->load->model('spares_model');
		$result = $this->spares_model->GetSparesBySupplier($id);
		echo json_encode($result);
	}

	public function GetSparePriceById()
	{
		$id=$this->input->post("id");
		$this->load->model('spares_model');
		$result = $this->spares_model->GetSparesPriceById($id);
		echo json_encode($result);
	}

    public function GetCategoryActiveJson()
    {
        $this->load->model('category_model');
        $result = $this->category_model->getcategoryactive();
        echo json_encode($result);
    }

    public function GetSparesWithCategoryIdJson()
    {
        $cat_id = $this->input->post('id');
        $result = $this->product_model->getsparewithcategoryid($cat_id);
        echo json_encode($result);
    }

	public function StatusUpdate()
	{
		$id = $this->input->post('id');

		$res = $this->po_model->UpdateStatus($id);
		echo  $res;
	}

	// Aravinth Code

	public function MakePo()
	{
		$mes = $this->session->userdata("po");

		if(isset($mes))
		{
			$data = array(
				'pagetitle' => 'Make Po List',
				'profile_name' => $this->session->userdata('Loginsession')->user_name,
				'message' => $this->Message($mes)
			);
		}
		else
		{
			$data = array(
				'pagetitle' => 'Make Po List',
				'profile_name' => $this->session->userdata('Loginsession')->user_name,
				'message' => ''
			);
		}

		$this->load->view('make_po_list',$data);
		$this->session->unset_userdata("po");
	}

	public function MakePoServerSide()
	{
		// DB table to use
		$table = "po_requirment_detail";

		// Table's primary key
		$primaryKey = 'id';

		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes

		$columns = array(
			array( 'db' => 'pord.id', 'dt' => 0, 'field' => 'id'),
			array( 'db' => ' pord.po_req_mast_id', 'dt' => 1, 'field' => 'po_req_mast_id'),
			array( 'db' => ' porm.name', 'dt' => 2, 'field' => 'name'),
			array( 'db' => ' porm.note', 'dt' => 3, 'field' => 'note'),
			array( 'db' => ' cat.category_desc', 'dt' => 4, 'field' => 'category_desc'),
			array( 'db' => ' pord.spare_id', 'dt' => 5, 'field' => 'spare_id'),
			array( 'db' => 's.spare_name', 'dt' => 6, 'field' => 'spare_name'),
			array( 'db' => 'pord.qty', 'dt' => 7, 'field' => 'qty'),
			array( 'db' => 'pord.status', 'dt' => 8, 'field' => 'status'),
			array(
				'db'        => 'pord.status',
				'dt'        => 9,
				'field' => 'status',
				'formatter' => function( $d, $row ) {
					return '<button type="button" id="btnpo" class="btn btn-success btn-xs" title="Purchase Order"><i class="fa fa-print" aria-hidden="true"></i></button>';
				}
			)
		);

		$joinQuery = "FROM   po_requirment_detail pord
						 JOIN spares s
						   ON( s.spare_id = pord.spare_id )
						JOIN category cat
							ON (s.category_id = cat.category_id)
						 JOIN po_requirment_master porm
						   ON ( pord.po_req_mast_id = porm.po_req_mast_id )";
		$extraCondition = "pord.status = 'active'";

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
			JSSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition)
		);
	}

	public function GetSupplierWithPo()
	{
		$spare_id = $this->input->post('id');
		$result = $this->po_model->makepogetsupplierwithspareid($spare_id);
		echo json_encode($result);
	}

	public function GetSaparesWithSupplierJson()
	{
		$sup_id = $this->input->post('mkposupplier');
		$result = $this->po_model->makepogetsparequantity($sup_id);
	/*	echo "<pre>";
		print_r($result);
		echo "</pre>";
		exit;*/


		$mes = $this->session->userdata("po");

		if(isset($mes))
		{
			$data = array(
				'pagetitle' => 'Purchase Order',
				'profile_name' => $this->session->userdata('Loginsession')->user_name,
				'spares_details' => $result,
				'message' => $this->Message($mes)
			);
		}
		else
		{
			$data = array(
				'pagetitle' => 'Purchase Order',
				'profile_name' => $this->session->userdata('Loginsession')->user_name,
				'spares_details' => $result,
				'message' => ''
			);
		}

		$this->load->view('make_po_new',$data);
		$this->session->unset_userdata("po");

		//echo json_encode($result);
	}

	public function ReqPoSave()
	{
		/*	echo "<pre>";
            print_r($_POST);exit;
            echo "</pre>";
			exit;*/

            $req_po_id = implode(",",$this->input->post('po_req_id'));

		$sup_name=$this->po_model->GetSupplierNameById($this->input->post('supplier'));

		$data_po = array(
			'sup_id' => $this->input->post('supplier'),
			'sup_name' => $sup_name,
			'c_date' => $this->datetime,
			'note' => $this->input->post('note'),
			'tax_type' => $this->input->post('tax_type'),
			'terms_of_delivery' => $this->input->post('terms_of_d'),
			'destination' => $this->input->post('destination'),
			'despatch' => $this->input->post('despatch'),
			'other_reference' => $this->input->post('other_reference'),
			'terms_of_payment' => $this->input->post('terms_of_payment'),
			'supplier_ref_no' => $this->input->post('sup_ref_no'),
			'status'=>'active'

		);

		$po_result = $this->po_model->savepo($data_po);

		if(!$po_result == 0)
		{
			$data_details = array(
				'po_id' =>$po_result,
				'spare_id' => $this->input->post('spares'),
				'qty' => $this->input->post('quantity'),
				'price' => $this->input->post('price'),
				'tax' => $this->input->post('tax'),
				'tax_amount' => $this->input->post('tax_amount'),
				'total' => $this->input->post('rowtotal')
			);


			$result = $this->po_model->savepodetail($data_details);

			if($result == 1)
			{
				$result1 = $this->po_model->requredpodetailstatus($req_po_id);
				if($result1 == 1)
				{
					$this->session->set_userdata("po","saved");
					redirect('porder/makepo');
				}
			}
			else
			{
				$this->session->set_userdata("po","unsaved");
				redirect('porder/makepo');
			}
		}
		else
		{
			$this->session->set_userdata("po","unsaved");
			redirect('porder/makepo');
		}
	}

	public function Test()
	{

	}

	// Error Message
    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Purchase Order Created Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Purchase Order Not Created Try again...</div>';
        }
        elseif ($message == 'updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;Purchase Order Updated Successfully...</div>';
        }
        elseif ($message == 'unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Purchase Order Does not Updated Try again...</div>';
        }

        return $mess;
    }

    public function PoEmail()
	{
		$id = $this->input->post('id');

		//$po_master = $this->po_model->getpomaster($id);
		//$po_detail = $this->po_model->getpodetail($id);

		$data = array(
			'po_master' => $this->po_model->getpomaster($id),
			'po_detail' => $this->po_model->getpodetail($id)
		);



		$msg = $this->load->view('make_po_print', $data, true);

		/*echo "<pre>";
		print_r($msg);
		echo "</pre>";
		exit;*/
		//print_r($msg);

		$res = $this->po_model->sendpomail($id,$msg);

		echo $res;

		//$this->po_model->SendPoMail($id,$mes);
	}

    public function test1()
	{
		$path= site_url("porder/test");
		//$path="https://www.google.co.in";
		//$text=file_get_contents($path);
		$text=readfile($path);

		echo '<textarea rows="4" cols="50">'.$text."</textaera>";
		//print_r($text);
		exit;
	}

	public function sendEmail($PoId,$message)
	{
		$ret=$this->po_model->SendPoMail($PoId,$message);
	}
}
