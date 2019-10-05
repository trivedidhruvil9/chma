<?php
class Doctor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }
    public function index()
    {
        $this->load->view('Doctor/header');
        $this->load->view('Doctor/pendingCases');
        $this->load->view('Doctor/footer');

    }
    public function pendingCases()
    {$this->load->view('Doctor/header');
        $this->load->view('Doctor/pendingCases');
        $this->load->view('Doctor/footer');

    }
    public function completedCases()
    {
        $this->load->view('Doctor/header');
        $this->load->view('Doctor/completedCases');
        $this->load->view('Doctor/footer');

    }
    public function requestedCases()
    {
        $this->load->view('Doctor/header');
        $this->load->view('Doctor/requestedCases');
        $this->load->view('Doctor/footer');

    }
}
