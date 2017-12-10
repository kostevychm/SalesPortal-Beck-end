<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Notification extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function hasPermission($notId)
    {
      if($this->is_admin)
        return true;


      $this->db->select('user_id');
      $this->db->from('notifications');

      $this->db->where(array('user_id' => $this->session->userdata('user_id'), 'id' => $notId));
      $Q = $this->db->get();

      if ($Q->num_rows() > 0) {
          return true;
      }else{
        return false;
      }
    }
}
