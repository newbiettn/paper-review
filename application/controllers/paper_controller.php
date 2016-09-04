<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paper_Controller extends CI_Controller {

    public function index()
    {
        $this->load->model('paper_service');
        $papers = $this->paper_service->get_list_paper();

        $view_data = array();
        $view_data["papers"] = $papers;
        $this->load->view('list_of_paper', $view_data);
    }

    public function create_review(){
        $this->load->view('review_paper');
    }

    public function submit_review(){
        $form = $this->input->post();
        $form["p_added_date"] = date("Y-m-d H:i:s");
        $this->load->model('paper_service');
        $p_id = $this->paper_service->insert_paper($form);
        redirect(base_url('index.php/paper_controller/view_paper/' . $p_id));
    }

    public function view_paper($p_id = NULL){
        $this->load->model('paper_service');
        $paper = $this->paper_service->get_paper_detail($p_id);

        $view_data = array();
        $view_data["paper"] = $paper;
        $this->load->view('view_paper', $view_data);
    }

    public function open_edit_review($p_id = NULL){
        $this->load->model('paper_service');
        $paper = $this->paper_service->get_paper_detail($p_id);

        $view_data = array();
        $view_data["paper"] = $paper;
        $this->load->view('edit_paper', $view_data);
    }
    public function submit_edit_review(){
        $this->load->model('paper_service');
        $form = $this->input->post();
        $form["p_edited_date"] = date("Y-m-d H:i:s");
        $this->paper_service->update_paper($form);
        redirect(base_url('index.php/paper_controller/view_paper/' . $form["p_id"]));
    }
}
