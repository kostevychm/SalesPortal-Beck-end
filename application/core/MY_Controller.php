<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    var $_container;
    var $_modules;

    function __construct() {
        parent::__construct();
        $this->load->helper('url');

        $this->load->config('spweb');

        // Set container variable
        $this->_container = $this->config->item('spweb_template_dir_public') . "layout.php";
        $this->_modules = $this->config->item('modules_locations');

        log_message('debug', 'SpWeb : MY_Controller class loaded');
    }
}
