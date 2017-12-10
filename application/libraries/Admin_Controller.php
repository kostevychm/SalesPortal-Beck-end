<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {
    public $is_admin;
    public $is_partner;
    public $logged_in_name;

    function __construct() {
        parent::__construct();

        // Set container variable
        $this->_container = $this->config->item('spweb_template_dir_admin') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');

        $this->load->library(array('ion_auth'));

        if (!$this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }

        $this->is_admin = $this->ion_auth->is_admin();
        $this->is_partner = $this->ion_auth->is_partner();


/*
        if(!($this->is_partner!=1 || !$this->is_admin!=1))
            redirect('/auth', 'refresh');
*/
        $user = $this->ion_auth->user()->row();
        $this->logged_in_name = $user->first_name;

        log_message('debug', 'CI My Admin : Admin_Controller class loaded');
    }
}

/* End of Admin_controller.php */
/* Location: ./application/libraries/Admin_controller.php */
