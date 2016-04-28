<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 4/27/2016
 * Time: 8:38 PM
 */

class Contact extends CI_Controller {

    function index()
    {
        $data['include'] = 'contact';
        $this->load->view('includes/template', $data);
    }


    function contact_form()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE)
        {

            echo json_encode(array('st'=>0, 'msg' => validation_errors()));
        }
        else
        {
            $name = $this->input->post('name');
            echo json_encode(array('st'=>0, 'msg' => 'Successfully Submiited'));
        }

    }
}