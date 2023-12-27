<?php
     
class Product extends CI_Controller {
    
    public function __construct() {
       parent::__construct();
       
    }
    
    public function index() {
        $this->load->view('product/index');
    }

    public function ubah($id) {
        $this->load->view('product/ubah',['id' => $id]);
    }

    public function tambah() {
        $this->load->view('product/tambah');
    }


    	
}