<?php
     
class Auth extends CI_Controller {
    
    public function __construct() {
       parent::__construct();
       
    }
    
    public function login() {
        $this->load->view('auth/login');
    }

    public function register() {
        $this->load->view('auth/register');
    }

    


    	
}