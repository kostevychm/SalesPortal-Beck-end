<?php

class Categories extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model(array('admin/category'));

    }


    public function index() {
        $categories = $this->category->get_all();

        $data['categories'] = $categories;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "categories_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {

        if ($this->input->post('title')) {
            $data['title'] = $this->input->post('title');
              $data['slogan'] = $this->input->post('slogan');
            if(!empty($_FILES['image']))
            {
              $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
              $new_name = time();
              $config['upload_path']          = './uploads/';
              $config['allowed_types']        = 'gif|jpg|png';
              $config['max_size']             = 1024*1024*5;
              $config['max_width']            = 1024;
              $config['max_height']           = 768;
              $config['file_name'] = $new_name;
              $this->load->library('upload', $config);
              $data['image'] = $new_name.".".$ext;
              if ( ! $this->upload->do_upload('image'))
              {
                      $data["errors"] = $this->upload->display_errors();
              }
              else
              {
                  $this->category->insert($data);
                    //  $data = array('upload_data' => $this->upload->data());
                      redirect('/admin/categories', 'refresh');
              }
            }else{
              $this->category->insert($data);
              redirect('/admin/categories', 'refresh');
            }


        }

        $data['page'] = $this->config->item('spweb_template_dir_admin') . "categories_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('title')) {
          $data['title'] = $this->input->post('title');
            $data['slogan'] = $this->input->post('slogan');

            if(!empty($_FILES['image']))
            {
              $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
              $new_name = time().$ext;
              $config['upload_path']          = './uploads/';
              $config['allowed_types']        = 'gif|jpg|png';
              $config['max_size']             = 1024*1024*5;
              $config['max_width']            = 1024;
              $config['max_height']           = 768;
              $config['file_name'] = $new_name;
              $this->load->library('upload', $config);
              $data['image'] = $new_name;

              if ( ! $this->upload->do_upload('image'))
              {
                      $data["errors"] = $this->upload->display_errors();
              }
              else
              {
                  $this->category->update($data, $id);
                    //  $data = array('upload_data' => $this->upload->data());
                      redirect('/admin/categories', 'refresh');
              }
            }else{
              $this->category->update($data, $id);
              redirect('/admin/categories', 'refresh');
            }
        }

        $category = $this->category->get($id);

        $data['category'] = $category;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "categories_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {

        $category = $this->category->get($id);
        $this->category->delete($id);
       @unlink("./uploads/".$category->image);

        redirect('/admin/categories', 'refresh');
    }

}
