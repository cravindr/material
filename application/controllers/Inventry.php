<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH.'libraries/ssp.class.php');

class Inventry extends CI_Controller {

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
        $mes = $this->session->userdata("inventry");

        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Inventry',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes)
            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'Inventry',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => ''
            );
        }

        $this->load->view('inventry_list',$data);
        $this->session->unset_userdata("inventry");
	}

	public function InventryServerSide()
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
			array( 'db' => 'spare_name',  'dt' => 2 ),
			array( 'db' => 'spare_size',   'dt' => 3 ),
			array( 'db' => 'spare_price',     'dt' => 4 ),
			array( 'db' => 'spare_quantity',     'dt' => 5 ),
			array(
				'db'        => 'status',
				'dt'        => 6,
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
				'dt'        => 7,
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
