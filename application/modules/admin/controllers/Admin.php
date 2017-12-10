<?php

class Admin extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('admin/establishment'));
    }

    public function index() {

      $data['val1'] = array('text' => 'Ratings', 'value' => $this->establishment->getRaitingCount());
      $data['val2'] = array('text' => 'Registered Establishments', 'value' => $this->establishment->getShopsCount());

      if($this->is_partner){
        $data['val3'] = array('text' => 'Visits', 'value' => $this->establishment->getVisitsCount());
      }else{
        $data['val3'] = array('text' => 'Waiting for moderation', 'value' => $this->establishment->getUnshowedShopsCount());
      }


        $data['page'] = $this->config->item('spweb_template_dir_admin') . "dashboard";
        $this->load->view($this->_container, $data);
    }

}
