<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH.'libraries/ssp.class.php');

class Spares extends CI_Controller {

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
        $this->load->model(array('spares_model','dashboard_model'));
        $this->datetime = $this->dashboard_model->datetime();
    }

    public function index()
	{
	    $mes = $this->session->userdata("spares");

        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Spares',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes),
                'supplier' => $this->GetSupplierActive(),
                'category' => $this->GetCategoryActive()
            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'Spares',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => '',
                'supplier' => $this->GetSupplierActive(),
                'category' => $this->GetCategoryActive()
            );
        }

        $this->load->view('spare_register',$data);
        $this->session->unset_userdata("spares");
	}

	public function SpareSave()
    {
        $data = array(
            'spare_part_no' => $this->input->post('spare_part_no'),
            'spare_hsn' => $this->input->post('spare_hsn'),
            'spare_name' => $this->input->post('spare_name'),
            'spare_size' => $this->input->post('spare_size'),
            'spare_desc' => $this->input->post('spare_desc'),
            'supplier_id' => implode(",",$this->input->post('supplier')),
            'category_id' => $this->input->post('category'),
            'spare_price' => $this->input->post('spare_price'),
            'spare_tax' => $this->input->post('spare_tax'),
            'spare_uom' => $this->input->post('spare_uom'),
            'spare_reorder_level' => $this->input->post('spare_reorder_level'),
            'spare_quantity' => $this->input->post('spare_qty'),
            'created_at' => $this->datetime,
            'status' => 'active',
        );

            $result = $this->spares_model->save($data);

                if($result == 1)
                {
                    $this->session->set_userdata("spares","saved");
                    redirect('spares/');
                }
                else
                {
                    $this->session->set_userdata("spares","unsaved");
                    redirect('spares/');
                }
    }

    public function SparesEdit()
    {
        $spare_id = $this->input->post('id');

        $result = $this->spares_model->getelementbyid($spare_id);
        $res = $result[0];
        echo json_encode($res);
    }

    public function SparesUpdate()
    {
        $edit_id = $this->input->post('spares_edit_id');

        $data = array(
            'spare_part_no' => $this->input->post('spare_part_edit_no'),
            'spare_hsn' => $this->input->post('spare_hsn_edit'),
            'spare_name' => $this->input->post('spare_name_edit'),
            'spare_size' => $this->input->post('spare_size_edit'),
            'spare_desc' => $this->input->post('spare_desc_edit'),
            'spare_price' => $this->input->post('spare_price_edit'),
            'spare_tax' => $this->input->post('spare_tax_edit'),
            'category_id' => $this->input->post('spare_edit_category'),
            'spare_uom' => $this->input->post('spare_edit_uom'),
            'spare_reorder_level' => $this->input->post('spare_reorder_level_edit'),
            'spare_quantity' => $this->input->post('spare_qty_edit'),
            'supplier_id' => implode(",",$this->input->post('supplier_id_edit')),
            'updated_at' => $this->datetime,
            'status' => 'active'
        );

        $result = $this->spares_model->Update($data,$edit_id);

        if($result == 1)
        {
            $this->session->set_userdata("spares","updated");
            redirect('spares/spareslist');
        }
        else
        {
            $this->session->set_userdata("spares","unupdated");
            redirect('spares/spareslist');
        }
    }

    public function StatusUpdate()
    {
        $id = $this->input->post('id');
        $res = $this->supplier_model->UpdateStatus($id);
        echo  $res;
    }

    public function SparesDelete()
    {
        $spare_id = $this->input->post('id');

        $result = $this->spares_model->delete($spare_id);

        echo $result;
    }

    public function SparesList()
    {
        $mes = $this->session->userdata("spares");

        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Spares',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes),
                'supplier' => $this->GetSupplierActive(),
                'category' => $this->GetCategoryActive()

            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'Spares',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => '',
                'supplier' => $this->GetSupplierActive(),
                'category' => $this->GetCategoryActive()
            );
        }

        $this->load->view('spare_list', $data);
        $this->session->unset_userdata("spares");
    }

    public function SparesServerSide()
    {
        // DB table to use
        $table = 'spares';

        // Table's primary key
        $primaryKey = 'spare_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'spare_id', 'dt' => 0 ),
            array( 'db' => 'spare_part_no',  'dt' => 1 ),
            array( 'db' => 'spare_hsn',  'dt' => 2 ),
            array( 'db' => 'spare_name',  'dt' => 3 ),
            array( 'db' => 'spare_size',   'dt' => 4 ),
            array( 'db' => 'spare_price',     'dt' => 5 ),
            array( 'db' => 'spare_quantity',     'dt' => 6 ),
			array(
				'db'        => 'spare_reorder_level',
				'dt'        => 7,
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
                'dt'        => 8,
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
                'dt'        => 9,
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

    public function GetSupplierActive()
    {
        $this->load->model('supplier_model');
        $result = $this->supplier_model->getsupplieractive();
        return $result;
    }

    public function GetCategoryActive()
    {
        $this->load->model('category_model');
        $result = $this->category_model->getcategoryactive();
        return $result;
    }

    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Customer Record Inserted Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Customer Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Customer Record Updated Successfully...</div>';
        }
        elseif ($message == 'unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Customer Record Does not Updated Try again...</div>';
        }

        return $mess;
    }
}
