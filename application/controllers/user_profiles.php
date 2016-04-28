<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    Class User_profiles extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();

// Load form helper library
            $this->load->helper(['url', 'html', 'form']);


// Load form validation library
            $this->load->library(['form_validation', 'session']);

// Load models
            $this->load->model(array('User', 'Gallery_model'));


// Load database
            $this->load->database();
        }


    // Show home page
    public function index() {
        $this->load->view('header');
        $this->load->view('homepage');
        $this->load->view('footer');
    }

    // Show registration page
    public function user_registration_show() {
        $this->load->view('header');
        $this->load->view('registration_form');
        $this->load->view('footer');
    }

    // Show login page
    public function user_login_show() {
        $this->load->view('header');
        $this->load->view('login_form');
        $this->load->view('footer');
    }

// method for adding images
    public function add(){
        $rules =    [
            [
                'field' => 'caption',
                'label' => 'Caption',
                'rules' => 'required'
            ],
            [
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('gallery/add_image');
            $this->load->view('footer');
        }
        else
        {
            /* Start Uploading File */
            $config =   [
                'upload_path'   => './uploads/',
                'allowed_types' => 'gif|jpg|png',
                'max_size'      => 750,
                'max_width'     => 1024,
                'max_height'    => 1024
            ];
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('gallery/add_image', $error);
            }
            else
            {
                $file = $this->upload->data();
                //print_r($file);
                $data = [
                    'file'          => 'uploads/' . $file['file_name'],
                    'caption'      => set_value('caption'),
                    'description'   => set_value('description'),
                ];
                $this->Gallery_model->create($data);
                $this->session->set_flashdata('message','New image has been added..');
                redirect('user_profiles/#gallery'); // redirect after successful upload of image
            }
        }
    }

    // edit the image
    public function edit($id){
        $rules =    [
            [
                'field' => 'caption',
                'label' => 'Caption',
                'rules' => 'required'
            ],
            [
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($rules);
        $image = $this->Gallery_model->find($id)->row();

        if ($this->form_validation->run() == FALSE)
        {

            $this->load->view('gallery/edit_image',['image'=>$image]);
            $this->load->view('footer');
        }
        else
        {
            if(isset($_FILES["userfile"]["name"]))
            {
                /* Start Uploading File */
                $config =   [
                    'upload_path'   => './uploads/',
                    'allowed_types' => 'gif|jpg|png',
                    'max_size'      => 100,
                    'max_width'     => 1024,
                    'max_height'    => 768
                ];

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload())
                {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('gallery/edit_image',['image'=>$image,'error'=>$error]);
                }
                else
                {
                    $file = $this->upload->data();
                    $data['file'] = 'uploads/' . $file['file_name'];
                    unlink($image->file);
                }
            }

            $data['caption']      = set_value('caption');
            $data['description']   = set_value('description');

            $this->Gallery_model->update($id,$data);
            $this->session->set_flashdata('message','New image has been updated..');
            redirect('user_profiles/#gallery');
        }
    }

    // Delete the image
    public function delete($id)
    {
        $this->Gallery_model->delete($id);
        $this->session->set_flashdata('message','Image has been deleted.');
        redirect('user_profiles');
    }


// Validate and store registration data in database
    public function new_user_registration() {
// Check validation for user input in SignUp form
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('email_value', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            //$this->load->view('header');
            //$this->load->view('registration_form');
            //$this->load->view('footer');

            // Ajax validaton instead of reloading page
            echo json_encode(array('st'=>0, 'msg' => validation_errors()));

        } else {
            $data = array(
                'user_name' => $this->input->post('username'),
                'user_email' => $this->input->post('email_value'),
                'user_password' => $this->input->post('password')
            );
            $result = $this->User->registration_insert($data);
            if ($result == TRUE) {
                $this->load->view('header');
                $data['message_display'] = 'Registration Successful !';
                $this->load->view('login_form', $data);
                $this->load->view('footer');
            } else {
                $data['message_display'] = 'Username already exist!';
                $this->load->view('header');
                $this->load->view('registration_form', $data);
                $this->load->view('footer');

            }
        }
    }



    // Check for user login process
    public function user_login_process() {

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            if(isset($this->session->userdata['logged_in'])){
                //$this->load->view('admin_page');

                $data = [
                    'images'   => $this->Gallery_model->all()
                ];
                $this->load->view('admin_page', $data);
                $this->load->view('footer');

            }else{
                $this->load->view('header');
                $this->load->view('login_form');
                $this->load->view('footer');
            }
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $result = $this->User->login($data);
            if ($result == TRUE) {

                $username = $this->input->post('username');
                $result = $this->User->read_user_information($username);
                if ($result != false) {
                    $session_data = array(
                        'username' => $result[0]->user_name,
                        'email' => $result[0]->user_email,
                    );
// Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    //$this->load->view('admin_page');

                    $data = [
                        'images'   => $this->Gallery_model->all()
                    ];
                    $this->load->view('admin_page', $data);
                    $this->load->view('footer');
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('header');
                $this->load->view('login_form', $data);
                $this->load->view('footer');
            }
        }
    }


    // Logout from admin page
    public function logout() {

    // Removing session data
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        //$data['message_display'] = 'Successfully Logout';
        $this->load->view('header');
        $this->load->view('login_form');
        $this->load->view('footer');
    }

}



?>