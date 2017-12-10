<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller {

	function __construct() {
			parent::__construct();

			$this->load->model(array('admin/category'));
			$this->load->model(array('admin/establishment'));
			$this->load->model(array('admin/address'));

	}
	public function ratingadd_get()
	{


		$data["ip"] = $this->get("ip");
		$data["partner_id"] = $this->get("id");
		$data["value"] = $this->get("value");

		if($data["partner_id"] != NULL)
		{
		if($this->establishment->insertRating($data))
		{
			$this->response([
					'status' => TRUE,
					'message' => 'Success'
			], REST_Controller::HTTP_OK);
		}else{
			$this->response([
					'status' => FALSE,
					'message' => 'An error..'
			], REST_Controller::HTTP_OK);
		}}else{
			$this->response([
					'status' => FALSE,
					'message' => 'Where is ID?'
			], REST_Controller::HTTP_OK);
		}
	}
	public function establishments_get()
	{
		$id = $this->get('id');
		$cat_id = $this->get('cat_id');

		if(isset($cat_id))
		{
			$res = NULL;
			$establishments = $this->establishment->get_all('', array('cat_id' => $cat_id, 'showed' => 1));

			if(count($establishments) > 0)
			{
				foreach($establishments as $establ)
				{

					$addresses = $this->address->get_all(array('phone','web','email','street','street_no','zip','city_id','lat','lng','id'), array('parent_id' => $establ['id']));

					foreach ($addresses as $keyTop=>$value) {
	          foreach ($value as $key=>$val) {
	            if($key === "city_id")
	            {
	              $cityName = $this->address->getCities($val)[0]['city'];

	                $addresses[$keyTop]["city"] = $cityName;
	            }
	          }
	        }

					$establ['addresses'] = $addresses;
					//$value['addressess'] = ;

					$res[] = $establ;
				}

				$this->response($res, REST_Controller::HTTP_OK);
			}else
			{
				$this->response([
						'status' => FALSE,
						'message' => 'No establishments were found'
				], REST_Controller::HTTP_OK);
			}

		}elseif (isset($id)) {
			$establishments = $this->establishment->get($id);

			if(isset($establishments)){

				$addresses = $this->address->get_all(array('phone','web','email','street','street_no','zip','city_id','lat','lng'), array('parent_id' => $establishments->id));

				foreach ($addresses as $keyTop=>$value) {
					foreach ($value as $key=>$val) {
						if($key === "city_id")
						{
							$cityName = $this->address->getCities($val)[0]['city'];
							$addresses[$keyTop]["city"] = $cityName;
						}
					}
				}
				$establishments->addresses = $addresses;

			$this->response($establishments, REST_Controller::HTTP_OK);}
			else{
				$this->response([
						'status' => FALSE,
						'message' => 'No establishments were found'
				], REST_Controller::HTTP_OK);
			}
		}else{
			$this->response([
					'status' => FALSE,
					'message' => 'No establishments were found'
			], REST_Controller::HTTP_OK);
		}

	}



	public function categories_get()
	{
			$id = $this->get('id');
			// If the id parameter doesn't exist return all the users
			if ($id === NULL)
			{
				$categories = $this->category->get_all();
					// Check if the users data store contains users (in case the database result returns NULL)
					if ($categories)
					{
							// Set the response and exit
							$this->response($categories, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
					}
					else
					{
							// Set the response and exit
							$this->response([
									'status' => FALSE,
									'message' => 'No categories were found'
							], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
					}
			}
			// Find and return a single record for a particular user.
			else {
					$id = (int) $id;

					// Validate the id.
					if ($id <= 0)
					{
							// Invalid id, set the response and exit.
							$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
					}

					// Get the user from the array, using the id as key for retrieval.
					// Usually a model is to be used for this.

					$category = $this->category->get($id);

					if (!empty($category))
					{
							$this->set_response($category, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
					}
					else
					{
							$this->set_response([
									'status' => FALSE,
									'message' => 'Category could not be found'
							], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
					}
			}
	}

	public function index_get()
	{
		//echo "What do you want? :)";
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
}
