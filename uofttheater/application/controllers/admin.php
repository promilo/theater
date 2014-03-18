<?php

class Admin extends CI_Controller {
    function __construct() {
        // Call the Controller constructor
        parent::__construct();
    }

    function index() {
        $data['main'] = 'main/adminview';
        $this->load->view('template', $data);
    }
}

?>
