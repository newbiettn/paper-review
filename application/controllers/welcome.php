<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        if( $this->session->userdata ( 'username' )) {
            redirect('paper/manage');
        } else {
            redirect('paper/view');
        }
    }
}