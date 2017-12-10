<?php

class Notifications extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model(array('admin/notification'));

    }


    public function index() {
      if($this->is_admin){
        $notifications = $this->notification->get_all();
      }else{
        $notifications = $this->notification->get_all(NULL, array('user_id' => $this->session->userdata('user_id')));
      }

        $data['notifications'] = $notifications;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "notifications_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {

        if ($this->input->post('title')) {
            $data['title'] = $this->input->post('title');
            $data['slogan'] = $this->input->post('slogan');
            $data['user_id'] = $this->session->userdata('user_id');

              $this->notification->insert($data);
              redirect('/admin/notifications', 'refresh');
        }

        $data['page'] = $this->config->item('spweb_template_dir_admin') . "notifications_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
      if(!$this->notification->hasPermission($id) || !isset($id))
        redirect('/admin/notifications', 'refresh');

        if ($this->input->post('title')) {
          $data['title'] = $this->input->post('title');
          $data['slogan'] = $this->input->post('slogan');

          $this->notification->update($data, $id);
          redirect('/admin/notifications', 'refresh');
        }

        $notification = $this->notification->get($id);

        $data['notification'] = $notification;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "notifications_edit";
        $this->load->view($this->_container, $data);
    }

    public function sentToAll($id) {
      if($this->is_admin && isset($id)){
          $data['showed'] = 1;
          $this->notification->update($data, $id);

          $this->session->set_flashdata('Sent to all devices', $this->ion_auth->messages());
          redirect('/admin/notifications', 'refresh');
        }

        $this->session->set_flashdata('You should be an administrator!', $this->ion_auth->messages());
        redirect('/admin/notifications', 'refresh');
    }

    public function delete($id) {
      if(!$this->notification->hasPermission($id) || !isset($id))
        redirect('/admin/notifications', 'refresh');

        $this->notification->delete($id);


        redirect('/admin/categories', 'refresh');
    }

}
