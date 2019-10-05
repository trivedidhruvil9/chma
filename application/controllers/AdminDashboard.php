<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDashboard extends CI_Controller {

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
	 function __construct() {
        parent::__construct();

        $this->load->model('Admin_Model');
    }

	public function index()
	{
		$this->load->view('admin/header.php');
		$this->load->view('admin/dashboard.php');
	
		
	}
	public function getDiseaseDetails()
	{
		  
		$data = $this->Admin_Model->getDiseaseDetails();
		echo json_encode($data);
	}
	public function generateData()
	{
		$data = $this->Admin_Model->generateData();
	}
}
