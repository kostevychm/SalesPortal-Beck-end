<?php

class Addresses extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model(array('admin/address'));
      //  $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->model(array('admin/establishment'));
    }

    public function index() {

      if($this->is_admin)
      {
        $addresses = $this->address->get_all();
      }else{
        $addresses = $this->address->get_forPartner();
      }


        foreach ($addresses as $keyTop=>$value) {
          foreach ($value as $key=>$val) {

            if($key === "parent_id")
            {
              $podnName = $this->establishment->get($val)->name;
                $addresses[$keyTop]["podnik"] = '<a href="../admin/establishment/edit/'.  $val.'">'.$podnName.'</a>';
            }

            if($key === "city_id")
            {
              $cityName = $this->address->getCities($val)[0]['city'];

                $addresses[$keyTop]["city"] = $cityName;
            }
          }
        }

        $data['addresses'] = $addresses;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "addresses_list";
        $data['id'] = '';
        $this->load->view($this->_container, $data);
    }

    public function related($estId) {

      if(!$this->address->hasPermission(NULL, $estId) || !isset($estId))
        redirect('/admin/establishment', 'refresh');

      $where = array('parent_id' => $estId);
        $addresses = $this->address->get_all(NULL, $where);

        foreach ($addresses as $keyTop=>$value) {
          foreach ($value as $key=>$val) {

            if($key === "parent_id")
            {
              $podnName = $this->establishment->get($val)->name;
                $addresses[$keyTop]["podnik"] = '<a href="../admin/establishment/edit/'.  $val.'">'.$podnName.'</a>';
            }

            if($key === "city_id")
            {
              $cityName = $this->address->getCities($val)[0]['city'];

                $addresses[$keyTop]["city"] = $cityName;
            }
          }
        }

        $data['addresses'] = $addresses;
        $data['page'] = $this->config->item('spweb_template_dir_admin') . "addresses_list";
        $data['id'] = $estId;
        $this->load->view($this->_container, $data);
    }

    public function create($id = NULL) {

      $dataView['cities'] = $this->address->getCities();

      $dataView['estId'] = $id;

      if($this->is_admin){
          $dataView['establishments'] = $this->establishment->get_all();
      }else{
        $dataView['establishments'] = $this->establishment->getPartners();
      }

        if ($this->input->post('street')) {

            $data['street'] = $this->input->post('street');
            $data['city_id'] = $this->input->post('city_id');
            $data['parent_id'] = $this->input->post('parent_id');
            $data['street_no'] = $this->input->post('street_no');
            $data['zip'] = $this->input->post('zip');
            $data['phone'] = $this->input->post('phone');
            $data['web'] = $this->input->post('web');
            $data['email'] = $this->input->post('email');
            $data['lat'] = $this->input->post('lat');
            $data['lng'] = $this->input->post('lng');

            $this->address->insert($data);

            redirect('/admin/addresses', 'refresh');
        }

        $dataView['page'] = $this->config->item('spweb_template_dir_admin') . "addresses_create";
        $this->load->view($this->_container, $dataView);
    }

    public function edit($id) {
        if(!$this->address->hasPermission($id))
          redirect('/admin/addresses', 'refresh');


        if ($this->input->post('street')) {
          $data['street'] = $this->input->post('street');
          $data['city_id'] = $this->input->post('city_id');
          $data['parent_id'] = $this->input->post('parent_id');
          $data['street_no'] = $this->input->post('street_no');
          $data['zip'] = $this->input->post('zip');
          $data['phone'] = $this->input->post('phone');
          $data['web'] = $this->input->post('web');
          $data['email'] = $this->input->post('email');
          $data['lat'] = $this->input->post('lat');
          $data['lng'] = $this->input->post('lng');
            $this->address->update($data, $id);

            redirect('/admin/addresses', 'refresh');
        }

        $data['cities'] = $this->address->getCities();

        if($this->is_admin){
            $data['establishments'] = $this->establishment->get_all();
        }else{
          $data['establishments'] = $this->establishment->getPartners();
        }

        $address = $this->address->get($id);

        $data['address'] = $address;

        $data['page'] = $this->config->item('spweb_template_dir_admin') . "addresses_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        $this->address->delete($id);

        redirect('/admin/addresses', 'refresh');
    }

}
