<?php

class Establishments extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model(array('admin/address'));
        $this->load->model(array('admin/category'));
        $this->load->model(array('admin/establishment'));
    }

    public function index() {
        $establishment = $this->establishment->get_allForDisplay();

      //  $establishment["category"] = "AA";//$this->category->get($establishment->cat_id);

        $data['establishment'] = $establishment;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "establishment_list";
        $this->load->view($this->_container, $data);
    }

    public function users($estId) {

      if($this->is_admin!=1 || !isset($id))
      {
        redirect('/admin/establishment', 'refresh');
      }

      $group = 'admin';

      if (!$this->ion_auth->in_group($group))
      {
          $this->session->set_flashdata('message', 'You must be an administrator to view the users page.');
          redirect('admin/dashboard');
      }

        $users = $this->establishment->getRelatedUsers($estId);
        $data['establishment'] = $users;

        $data['id'] = $estId;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "establishmentuser_list";
        $this->load->view($this->_container, $data);
    }

    public function rating($estId) {
      if(!$this->establishment->hasPermission($estId) || !isset($estId))
            redirect('/admin/establishment', 'refresh');

        $users = $this->establishment->getRatings($estId);
        $data['establishment'] = $users;

        $data['id'] = $estId;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "establishmentrating_list";
        $this->load->view($this->_container, $data);
    }

    public function addRating()
    {
        if ($this->input->post('estId')) {
            $data["ip"] = $this->input->post["ip"];
            $data["partner_id"] = $this->input->post["estId"];
            $data["value"] = $this->input->post["value"];

            $this->establisment->insertRating($data);
        }
    }

    public function create() {
        if ($this->input->post('name')) {
            $data['name'] = $this->input->post('name');
            $data['sales_percent'] = $this->input->post('sale');
            $data['rules'] = $this->input->post('rules');
            $data['description'] = $this->input->post('description');
            $data['short_desc'] = $this->input->post('short_desc');
            $data['cat_id'] = $this->input->post('category_id');

            if(!empty($_FILES['bgimage']))
            {
              $ext = pathinfo($_FILES['bgimage']['name'], PATHINFO_EXTENSION);
              $new_name = time();
              $config['upload_path']          = './uploads/';
              $config['allowed_types']        = 'gif|jpg|png';
              $config['max_size']             = 1024*1024*5;
              $config['max_width']            = 1024;
              $config['max_height']           = 768;
              $config['file_name'] = $new_name;
              $this->load->library('upload', $config);
              $data['image'] = $new_name.".".$ext;
              if ( ! $this->upload->do_upload('bgimage'))
              {
                      $data["errors"] = $this->upload->display_errors();
                      $this->session->set_flashdata('message', $this->upload->display_errors());
              }
            }
            if(!empty($_FILES['logoimage']))
            {
              $ext = pathinfo($_FILES['logoimage']['name'], PATHINFO_EXTENSION);
              $new_name = time();
              $config['upload_path']          = './uploads/';
              $config['allowed_types']        = 'gif|jpg|png';
              $config['max_size']             = 1024*1024*5;
              $config['max_width']            = 1024;
              $config['max_height']           = 768;
              $config['file_name'] = $new_name;
              $this->load->library('upload', $config);
              $data['logo'] = $new_name.".".$ext;
              if (!$this->upload->do_upload('logoimage'))
              {
                  $data["errors"] = $this->upload->display_errors();
                  $this->session->set_flashdata('message', $this->upload->display_errors());
              }
            }

            if(empty($data["errors"]))
            {
              $this->establishment->insert($data);
              redirect('/admin/establishment', 'refresh');
            }
          }

        $categories = $this->category->get_all();

        $data['categories'] = $categories;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "establishment_create";
        $this->load->view($this->_container, $data);
    }


    public function addRelatedUser($estId) {
      if($this->is_admin!=1 || !isset($estId))
      {
        redirect('/admin/establishment', 'refresh');
      }
        if ($this->input->post('user_id')) {
            $data['user_id'] = $this->input->post('user_id');
            $data['partner_id'] = $estId;


              $this->establishment->addRelatedUser($data);
              redirect('/admin/establishments/users/'.$estId, 'refresh');
          }

        $users = $this->establishment->getFreeUsers($estId);

        $data['users'] = $users;
        $data['id'] = $estId;

        $data['page'] = $this->config->item('spweb_template_dir_admin') . "establishmentuser_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {

      if(!$this->establishment->hasPermission($id) || !isset($id))
        redirect('/admin/establishment', 'refresh');

        if ($this->input->post('name')) {

          $data['name'] = $this->input->post('name');
          $data['sales_percent'] = $this->input->post('sale');
          $data['rules'] = $this->input->post('rules');
          $data['description'] = $this->input->post('description');
          $data['short_desc'] = $this->input->post('short_desc');
          $data['cat_id'] = $this->input->post('category_id');
          $data['showed'] = $this->input->post('showed');


          if(!empty($_FILES['bgimage']["name"]))
          {
            $ext = pathinfo($_FILES['bgimage']['name'], PATHINFO_EXTENSION);
            $new_name = time();
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024*1024*5;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $data['image'] = $new_name.".".$ext;
            if ( ! $this->upload->do_upload('bgimage'))
            {
                    $data["errors"] = $this->upload->display_errors();
                    $this->session->set_flashdata('message', $this->upload->display_errors());
            }
          }
          if(!empty($_FILES['logoimage']["name"]))
          {
            $ext = pathinfo($_FILES['logoimage']['name'], PATHINFO_EXTENSION);
            $new_name = time();
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024*1024*5;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['file_name'] = $new_name."1";
            $this->load->library('upload', $config);
            $data['logo'] = $new_name."1.".$ext;
            if (!$this->upload->do_upload('logoimage'))
            {
                $data["errors"] = $this->upload->display_errors();
                $this->session->set_flashdata('message', $this->upload->display_errors());
            }
          }

          if(empty($data["errors"]))
          {
            $this->establishment->update($data, $id);
            redirect('/admin/establishment', 'refresh');
          }

        }
        $establishment = $this->establishment->get($id);

        $categories = $this->category->get_all();

        $data['categories'] = $categories;
        $data['establishment'] = $establishment;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "establishment_edit";
        $this->load->view($this->_container, $data);
    }

    public function deleteRelatedUser($id) {
      if($this->is_admin!=1 || !isset($id))
        redirect('/admin/establishment', 'refresh');
        $backId = $this->establishment->deleteRelatedUser($id);

        //var_dump($backId);
        redirect('/admin/establishments/users/'.$backId, 'refresh');
    }

    public function delete($id) {
      if(!$this->establishment->hasPermission($id) || !isset($id))
        redirect('/admin/establishment', 'refresh');

        $this->establishment->delete($id);

        redirect('/admin/establishment', 'refresh');
    }

    public function ratingDelete($id) {
      if($this->is_admin!=1 || !isset($id))
        redirect('/admin/establishment', 'refresh');

        $backId = $this->establishment->ratingDelete($id);

        //var_dump($backId);
        redirect('/admin/establishments/rating/'.$backId, 'refresh');
    }


}
