<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 25-07-2018
 * Time: 12:55 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH.'libraries/ssp.class.php');
class Category extends CI_Controller
{
    var $datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('spares_model','dashboard_model','category_model'));
        $this->datetime = $this->dashboard_model->datetime();
    }


    public function index()
    {
        $mes = $this->session->userdata("category");

        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Category',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes),

            );
        }
        else
        {
            $data = array(
                'pagetitle' => 'Category',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => '',
                          );
        }

        $this->load->view('category_register',$data);
        $this->session->unset_userdata("spares");
    }

    public function CategoryList()
    {
        $mes = $this->session->userdata("category");

        if(isset($mes))
        {
            $data = array(
                'pagetitle' => 'Category',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => $this->Message($mes),
                 );
        }
        else
        {
            $data = array(
                'pagetitle' => 'Category',
                'profile_name' => $this->session->userdata('Loginsession')->user_name,
                'message' => '',

            );
        }

        $this->load->view('category_list', $data);
        $this->session->unset_userdata("category");
    }



    public function CategoryServerSide()
    {
        // DB table to use
        $table = 'category';

        // Table's primary key
        $primaryKey = 'category_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'category_id', 'dt' => 0 ),
            array( 'db' => 'category_desc',  'dt' => 1 ),
                        array(
                'db'        => 'status',
                'dt'        => 2,
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
                'dt'        => 3,
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



    public function CategorySave()
    {
        $data = array(
            'category_desc' => $this->input->post('category_desc'),
            'created_at' => $this->datetime,
            'status' => 'active',
        );

        $result = $this->category_model->save($data);

        if($result == 1)
        {
            $this->session->set_userdata("category","saved");
            redirect('category/categorylist');
        }
        else
        {
            $this->session->set_userdata("category","unsaved");
            redirect('category/categorylist');
        }
    }

    public function CategoryEdit()
    {
        $category_id = $this->input->post('id');

        $result = $this->category_model->getelementbyid($category_id);
        $res = $result[0];
        echo json_encode($res);
    }

    public function CategoryUpdate()
    {
        $edit_id = $this->input->post('category_edit_id');

        $data = array(
            'category_desc' => $this->input->post('category_desc_edit'),
            'status' => 'active'
        );

        $result = $this->category_model->Update($data,$edit_id);

        if($result == 1)
        {
            $this->session->set_userdata("category","updated");
            redirect('category/categorylist');
        }
        else
        {
            $this->session->set_userdata("category","unupdated");
            redirect('category/categorylist');
        }
    }

    public function CategoryDelete()
    {
        $category_id = $this->input->post('id');

        $result = $this->category_model->delete($category_id);

        echo $result;
    }

    public function StatusUpdate()
    {
        $id = $this->input->post('id');
        $res = $this->category_model->UpdateStatus($id);
        echo  $res;
    }

    private function Message($message)
    {
        if($message == 'saved')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Category Record Inserted Successfully...</div>';
        }
        elseif ($message == 'unsaved')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Category Record Does not Inserted Try again...</div>';
        }
        elseif ($message == 'updated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp; Category Record Updated Successfully...</div>';
        }
        elseif ($message == 'unupdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp; Category Record Does not Updated Try again...</div>';
        }

        return $mess;
    }

}