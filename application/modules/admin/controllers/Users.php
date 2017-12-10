<?php

class Users extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $group = 'admin';

        if (!$this->ion_auth->in_group($group))
        {
            $this->session->set_flashdata('message', 'You must be an administrator to view the users page.');
            redirect('admin/dashboard');
        }
    }

    public function index() {
        $users = $this->ion_auth->users()->result();

        $data['users'] = $users;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "users_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('email')) {
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $group_id = array( $this->input->post('group_id'));

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
            );

            $user = $this->ion_auth->register($email, $password, $email, $additional_data,$group_id);

            if(!$user)
            {

                $data["errors"] = $this->ion_auth->errors();

              //  echo $errors;


            }
            else
            {
                redirect('/admin/users', 'refresh');
            }


        }

        $data['groups'] = $this->ion_auth->groups()->result();
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "users_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('first_name')) {
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['email'] = $this->input->post('email');
            $group_id = $this->input->post('group_id');

            $this->ion_auth->remove_from_group('', $id);
            $this->ion_auth->add_to_group($group_id, $id);

            $this->ion_auth->update($id, $data);

            redirect('/admin/users', 'refresh');
        }

        $this->load->helper('ui');

        $data['groups'] = $this->ion_auth->groups()->result();
        $data['user'] = $this->ion_auth->user($id)->row();
        $data['user_group'] = $this->ion_auth->get_users_groups($id)->row();
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "users_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        $this->ion_auth->delete_user($id);

        redirect('/admin/users', 'refresh');
    }

}
