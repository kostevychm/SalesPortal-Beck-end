<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Establishment extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->table_name = 'partners';
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

    public function insertRating($data) {
        $data['date_created'] = $data['date_updated'] = date('Y-m-d H:i:s');
        $data['created_from_ip'] = $data['updated_from_ip'] = $data['ip'];
        unset($data['ip']);
        $flag = $success = false;

        $query ="select created_from_ip from ratings  WHERE partner_id = '".$data["partner_id"]."' order by date_created DESC limit 1";
         $res = $this->db->query($query);

         if($res->num_rows() > 0) {

    			 $r = $res->result("array");
            if($r[0]['created_from_ip'] != $data['created_from_ip'])
              $flag = true;
        }else{
          $flag = true;
        }

        if($flag)
        {
          $success = $this->db->insert('ratings', $data);
          $query = "SELECT AVG(value) as val FROM ratings WHERE partner_id = '".$data["partner_id"]."' GROUP BY partner_id";
      		$res = $this->db->query($query);
      		if($res->num_rows() > 0) {
      			$r = $res->result("array");

            $q = "UPDATE `partners` SET `rating` = '".$r[0]['val']."' WHERE `partners`.`id` = '".$data["partner_id"]."'";
            $this->db->query($q);
      	 }
        }

        if ($success && $flag) {
            return true;
        } else {
            return FALSE;
        }
    }

    public function addRelatedUser($data) {

      if ($this->ion_auth->in_group('admin'))
      {
        $data['date_created'] = $data['date_updated'] = date('Y-m-d H:i:s');
        $data['created_from_ip'] = $data['updated_from_ip'] = $this->input->ip_address();
  //      $data['user_id'] = $userId;
  //      $data['partner_id'] = $estId;

        $success = $this->db->insert('user_to_partner', $data);
        return $success;
      }else{
          return FALSE;
      }
    }

    public function deleteRelatedUser($id) {

      $this->db->select('partner_id');
      $this->db->from('user_to_partner');

      $this->db->where(array('id' => $id));
      $Q =$this->db->get();

      if ($Q->num_rows() > 0) {
          foreach ($Q->result_array() as $row) {
              $names = $row;
          }
      }
      $this->db->where($this->primary_key, $id);
      $this->db->delete('user_to_partner');

      return $names['partner_id'];
    }

    public function ratingDelete($id) {
      $this->db->select('partner_id');
      $this->db->from('ratings');
      $this->db->where(array('id' => $id));
      $Q =$this->db->get();

      if ($Q->num_rows() > 0) {
          foreach ($Q->result_array() as $row) {
              $names = $row;
          }
      }
      $this->db->where($this->primary_key, $id);
      $this->db->delete('ratings');

      return $names['partner_id'];
    }

    public function getRaitingCount()
    {
      if($this->is_admin)
      {
        return $this->db->count_all_results('ratings');
      }else{

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


        $this->db->select('*');
        $this->db->from('ratings');
        $this->db->where_in('id', $names);
        $Q = $this->db->get();

        return $Q->num_rows();
      }
    }

    public function hasPermission($estId)
    {
      if($this->is_admin)
        return true;

      $partner_id = $estId;
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

    public function getShopsCount()
    {
      if($this->is_admin)
      {
        return $this->db->count_all_results('partners');
      }else{


        $this->db->select('partner_id');
        $this->db->from('user_to_partner');

        $this->db->where(array('user_id' => $this->session->userdata('user_id')));
        $Q = $this->db->get();

        return $Q->num_rows();
      }
    }

    public function getUnshowedShopsCount()
    {
      $this->db->select('*');
      $this->db->from('partners');
      $this->db->where(array('showed'=>0));


      $Q = $this->db->get();

      return $Q->num_rows();
    }

    public function getPartners()
    {
      $this->db->select('partner_id');
      $this->db->from('user_to_partner');

      $this->db->where(array('user_id' => $this->session->userdata('user_id')));
      $Q = $this->db->get();

      if ($Q->num_rows() > 0) {
          foreach ($Q->result_array() as $row) {
              $names[] = $row['partner_id'];
          }
      }

    //  return $names;

      $this->db->select('*');
      $this->db->from('partners');
      $this->db->where_in('id', $names);
      $Q = $this->db->get();
      if ($Q->num_rows() > 0) {
          foreach ($Q->result_array() as $row) {
              $data[] = $row;
          }
      }
      $Q->free_result();
      return $data;
    }

    public function getVisitsCount()
    {
      if($this->is_admin)
      {
        return $this->db->count_all_results('ratings');
      }else{

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


        $this->db->select('*');
        $this->db->from('visits');
        $this->db->where_in('partner_id', $names);
        $Q = $this->db->get();

        return $Q->num_rows();
      }
    }

    public function getFreeUsers($estId)
    {
      $data = NULL;
      $names = NULL;
      $this->db->select('user_id');
      $this->db->from('user_to_partner');

      $this->db->where(array('partner_id' => $estId));
      $Q =$this->db->get();

      if ($Q->num_rows() > 0) {
          foreach ($Q->result_array() as $row) {
              $names[] = $row['user_id'];
          }
      }

    //  var_dump($names);

      $this->db->select('*');
      $this->db->from('users');
      $this->db->where_not_in('id', $names);
      $Q =$this->db->get();
      if ($Q->num_rows() > 0) {
          foreach ($Q->result_array() as $row) {
              $data[] = $row;
          }
      }
      $Q->free_result();


      return $data;
    }

    public function getRelatedUsers($estId)
    {
      $data = NULL;
      $this->db->select('user_to_partner.id, users.first_name, users.last_name, users.email, users.id as user_id, user_to_partner.created_from_ip');
      $this->db->from('user_to_partner');
      $this->db->join('users', 'user_to_partner.user_id = users.id');
      $this->db->where(array('user_to_partner.partner_id' => $estId));
      $Q =$this->db->get();

      if ($Q->num_rows() > 0) {
          foreach ($Q->result_array() as $row) {
              $data[] = $row;
          }
      }
      $Q->free_result();

        return $data;
    }

    public function getRatings($estId)
    {
      $data = NULL;
      $this->db->select('*');
      $this->db->from('ratings');

      $this->db->where(array('partner_id' => $estId));
      $Q =$this->db->get();

      if ($Q->num_rows() > 0) {
          foreach ($Q->result_array() as $row) {
              $data[] = $row;
          }
      }
      $Q->free_result();

        return $data;
    }

    public function get_allForDisplay()
    {
      $data = NULL;
      $this->db->select('partners.id, partners.name, partners.short_desc, partners.rating, categories.title, partners.date_created, partners.showed');
      $this->db->from('partners');
      $this->db->join('categories', 'categories.id = partners.cat_id');

      if($this->is_admin != 1)
      {
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

        $this->db->select('partners.id, partners.name, partners.short_desc, partners.rating, categories.title, partners.date_created, partners.showed');
        $this->db->from('partners');
        $this->db->join('categories', 'categories.id = partners.cat_id');
        $this->db->where_in('partners.id', $names);
      }


      $Q =$this->db->get();

      if ($Q->num_rows() > 0) {
          foreach ($Q->result_array() as $row) {
              $data[] = $row;
          }
      }
      $Q->free_result();

        return $data;
    }
}
