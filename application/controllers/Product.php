<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH.'libraries/ssp.class.php');

class Product extends CI_Controller {

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
        $this->load->model(array('product_model','dashboard_model'));
        $this->datetime = $this->dashboard_model->datetime();
    }

	public function index()
	{
        $mes = $this->session->userdata("product");

        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Product',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes)
            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'Product',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => ''
            );
        }

        $this->load->view('product_new',$data);
        $this->session->unset_userdata("product");
	}

	public function ProductList()
	{
		$mes = $this->session->userdata("product");

		if(isset($mes))
		{
			$data = array(
				'pagetitle' => 'Product List',
				'profile_name' => $this->session->userdata('Loginsession')->user_name,
				'message' => $this->Message($mes)
			);
		}
		else
		{
			$data = array(
				'pagetitle' => 'Product List',
				'profile_name' => $this->session->userdata('Loginsession')->user_name,
				'message' => ''
			);
		}

		$this->load->view('product_list',$data);
		$this->session->unset_userdata("product");
	}

	public function ProductStatus()
	{
		$id = $this->input->post('id');
		$res = $this->product_model->productstatusupdate($id);
		echo $res;
	}

	public function ProductEdit()
	{
		$prod_id = $this->input->post('id');

		$result = $this->product_model->editproduct($prod_id);
		echo json_encode($result);
	}

	public function ProductDelete()
	{
		$prod_id = $this->input->post('id');

		$result = $this->product_model->delete($prod_id);

		echo $result;
	}

	public function ProductServerSide()
	{
		// DB table to use
		$table = 'products';

		// Table's primary key
		$primaryKey = 'product_id';

		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes
		$columns = array(
			array( 'db' => 'product_id', 'dt' => 0 ),
			array( 'db' => 'product_name',  'dt' => 1 ),
			array( 'db' => 'product_desc',  'dt' => 2 ),
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
                            <button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            &nbsp; <button type="button" id="btndelete" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
				}
			)
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

	public function ProductQuantitySave()
    {


        $data_product = array(
            'product_name' => $this->input->post('product_name'),
            'product_desc' => $this->input->post('product_desc'),
            'status' => 'active'
        );

        $pro_result = $this->product_model->saveproduct($data_product);

            if(!$pro_result == 0)
            {
                $data_details = array(
                    'product_id' => $pro_result,
                    'spare_id' => $this->input->post('spares'),
                    'qty' => $this->input->post('quantity')
                );

                $result = $this->product_model->saveproductquantity($data_details);

                    if($result == 1)
                    {
                        $this->session->set_userdata("product","saved");
                        redirect('product/');
                    }
                    else
                    {
                        $this->session->set_userdata("product","unsaved");
                        redirect('product/');
                    }
            }
            else
            {
                $this->session->set_userdata("product","unsaved");
                redirect('product/');
            }
    }

	public function ProductQuantityUpdate()
	{
        error_reporting(E_ALL ^ E_NOTICE);
		$data_product = array(
			'product_id' => $this->input->post('prod_id'),
			'product_name' => $this->input->post('product_name_edit'),
			'product_desc' => $this->input->post('product_desc_edit'),
			'status' => 'active'
		);

		$data_details = array(
			'detail_id' => $this->input->post('detail_id'),
			'prod_id' => $this->input->post('prod_id'),
			'cat_id' => $this->input->post('category'),
			'spare_id' => $this->input->post('spares'),
			'qty' => $this->input->post('quantity')
		);

		$result = $this->product_model->updateproduct($data_product,$data_details);

		if($result == 1)
		{
			$this->session->set_userdata("product","updated");
			redirect('product/productlist');
		}
		else
		{
			$this->session->set_userdata("product","unupdated");
			redirect('product/productlist');
		}
	}

    public function GetSupplierActiveJson()
    {
        $this->load->model('supplier_model');
        $result = $this->supplier_model->getsupplieractive();
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

    public function ProductDetailDelete()
    {
        $id = $this->input->post('id');
        $res = $this->product_model->DeleteProductDetailById($id);
        echo $res;
    }

    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Product Record Inserted Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Product Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Product Record Updated Successfully...</div>';
        }
        elseif ($message == 'unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Product Record Does not Updated Try again...</div>';
        }

        return $mess;
    }
}
