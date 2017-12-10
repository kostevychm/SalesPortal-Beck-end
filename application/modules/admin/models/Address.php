<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Address extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert($data) {
        $data['date_created'] = $data['date_updated'] = date('Y-m-d H:i:s');
        $data['created_from_ip'] = $data['updated_from_ip'] = $this->input->ip_address();
        $id = $this->db->query('SELECT UUID() as id');
        $data['id'] = $id->result_array()[0]["id"];

        $success = $this->db->insert($this->table_name, $data);
        if ($success) {
            return $data['id'];
        } else {
            return FALSE;
        }
    }

    public function hasPermission($addressId, $estId = NULL)
    {
      if($this->is_admin)
        return true;



    if($estId == NULL){
      $this->db->select('parent_id');
      $this->db->from('addresses');
      $this->db->where(array('id' => $addressId));
      $partner_id = $this->db->get()->result_array()[0]['parent_id'];
    }else{
      $partner_id = $estId;
    }

      $this->db->select('partner_id');
      $this->db->from('user_to_partner');

      $this->db->where(array('user_id' => $this->session->userdata('user_id')));
      $Q = $this->db->get();

      if ($Q->num_rows() > 0) {
          foreach ($Q->result_array() as $row) {
              $names[] = $row['partner_id'];
          }
      }
      $flag = false;
      if(in_array($partner_id, $names))
        $flag = true;

        return $flag;
    }

    public function get_forPartner()
    {
        $data = NULL;
        $names = NULL;
        $this->db->select('partner_id');
        $this->db->from('user_to_partner');

        $this->db->where(array('user_id' => $this->session->userdata('user_id')));
        $Q = $this->db->get();

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $names[] = $row['partner_id'];
            }
        }

      //  var_dump($names);

        $this->db->select('*');
        $this->db->from('addresses');
        $this->db->where_in('parent_id', $names);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
      //  return $Q->num_rows();
    }

    public function getCities($cityId = NULL)
    {
        $this->db->order_by('city');


        if($cityId != NULL)
        {
          $this->db->where('id',$cityId);
        }
        $Q = $this->db->group_by('city')->get('cities');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();

      return $data;
    }
}
