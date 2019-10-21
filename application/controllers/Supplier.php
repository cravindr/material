<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 26-07-2018
 * Time: 11:23 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH.'libraries/ssp.class.php');
class Supplier extends  CI_Controller
{
    var $datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('supplier_model','dashboard_model'));
        $this->datetime = $this->dashboard_model->datetime();
    }

    public function index()
    {
        $mes = $this->session->userdata("supplier");

        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'supplier',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes),
                'supplier' => $this->GetSupplierActive(),
                'category' => $this->GetCategoryActive()
            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'supplier',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => '',
                'supplier' => $this->GetSupplierActive(),
                'category' => $this->GetCategoryActive()
            );
        }

        $this->load->view('supplier_register',$data);
        $this->session->unset_userdata("supplier");
    }

    public function suppliersave()
    {
        $data = array(
            'sup_name' => $this->input->post('supplier_name'),
            'sup_email' => $this->input->post('emailid'),
            'sup_mobile' => $this->input->post('mobile'),
            'sup_phone' => $this->input->post('phone'),
            'sup_contact_person' => $this->input->post('contact_persion'),
            'sup_address' => $this->input->post('address'),
            'sup_place' => $this->input->post('place'),
            'sup_city' => $this->input->post('city'),
            'sup_state' => $this->input->post('state'),
            'sup_pin' => $this->input->post('pin'),
            'gst_no' => $this->input->post('gstno'),
            'state_code' => $this->input->post('statecode'),
            'create_at' => $this->datetime,
            'status' => 'active',
        );

        $result = $this->supplier_model->save($data);

        if($result == 1)
        {
            $this->session->set_userdata("supplier","saved");
            redirect('supplier/');
        }
        else
        {
            $this->session->set_userdata("supplier","unsaved");
            redirect('supplier/supplierlist');
        }
    }

    public function supplierEdit()
    {
        $supplier_id = $this->input->post('id');

        $result = $this->supplier_model->getelementbyid($supplier_id);
        $res = $result[0];
        echo json_encode($res);
    }

    public function supplierUpdate()
    {
        $edit_id = $this->input->post('supplier_edit_id');

        $data = array(
            'sup_name' => $this->input->post('supplier_name_edit'),
            'sup_email' => $this->input->post('emailid_edit'),
            'sup_mobile' => $this->input->post('mobile_edit'),
            'sup_phone' => $this->input->post('phone_edit'),
            'sup_contact_person' => $this->input->post('contact_persion_edit'),
            'sup_address' => $this->input->post('address_edit'),
            'sup_place' => $this->input->post('place_edit'),
            'sup_city' => $this->input->post('city_edit'),
            'sup_state' => $this->input->post('state_edit'),
            'sup_pin' => $this->input->post('pin_edit'),
            'gst_no' => $this->input->post('gstno_edit'),
            'state_code' => $this->input->post('statecode_edit'),
            'updated_at' => $this->datetime,
            'status' => 'active',
        );



        $result = $this->supplier_model->Update($data,$edit_id);

        if($result == 1)
        {
            $this->session->set_userdata("supplier","updated");
            redirect('supplier/supplierlist');
        }
        else
        {
            $this->session->set_userdata("supplier","unupdated");
            redirect('supplier/supplierlist');
        }
    }

    public function supplierDelete()
    {
        $spare_id = $this->input->post('id');

        $result = $this->supplier_model->delete($spare_id);

        echo $result;
    }

    public function StatusUpdate()
    {
        $id = $this->input->post('id');
        $res = $this->supplier_model->UpdateStatus($id);
        echo  $res;
    }

    public function supplierList()
    {
        $mes = $this->session->userdata("supplier");

        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Supplier',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes),
                'supplier' => $this->GetSupplierActive(),
                'category' => $this->GetCategoryActive()

            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'supplier',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => '',
                'supplier' => $this->GetSupplierActive(),
                'category' => $this->GetCategoryActive()
            );
        }

        $this->load->view('supplier_list', $data);
        $this->session->unset_userdata("supplier");
    }

    public function supplierServerSide()
    {
        // DB table to use
        $table = 'supplier';

        // Table's primary key
        $primaryKey = 'sup_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'sup_id', 'dt' => 0 ),
            array( 'db' => 'sup_name',  'dt' => 1 ),
            array( 'db' => 'sup_mobile',  'dt' => 2 ),
            array( 'db' => 'sup_place',   'dt' => 3 ),
            array( 'db' => 'sup_city',     'dt' => 4 ),
            array( 'db' => 'sup_state',     'dt' => 5 ),
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
