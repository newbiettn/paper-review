<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paper_Controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model("paper_service");
    }

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



    public function view_paper($id = NULL){
        $this->load->model('paper_service');
        $paper = $this->paper_service->get_paper_detail($id);

        $view_data = array();
        $view_data["paper"] = $paper;
        $this->load->view('view_paper', $view_data);
    }

    public function open_edit_review($id = NULL){
        $this->load->model('paper_service');
        $paper = $this->paper_service->get_paper_detail($id);

        $view_data = array();
        $view_data["paper"] = $paper;
        $this->load->view('edit_paper', $view_data);
    }
    public function submit_edit_review(){
        $this->load->model('paper_service');
        $form = $this->input->post();
        $form["edited_date"] = date("Y-m-d H:i:s");
        $this->paper_service->update_paper($form);
        redirect(base_url('index.php/paper_controller/view_paper/' . $form["id"]));
    }
    public function import_bibtex(){
        $this->load->library('phpBibLib/Bibtex');
        $this->load->model('paper_service');

        $bibtex = new Bibtex(COLLECTION_BIBTEXT);
        $bibtexArr = $bibtex->getBibtexAsArray();
        $bibtexArrKey = array_keys($bibtexArr);

        foreach ($bibtexArrKey as $bib_key) {
            //check if paper exists
            $is_paper_existed = $this->paper_service->check_unique_citation_key(trim($bib_key));
            if (empty($is_paper_existed)) {
                //get paper from bibArray by key
                $p = $bibtexArr[$bib_key];

                $data = [];
                //review (-1: non-reviewed)
                $data["review_fk"]= "-1";

                //paper type
                (array_key_exists("type", $p))? ($data["type"] = $p["type"]):$data["type"]="";

                //citation key
                $data["citation_key"] = trim($bib_key);

                //author
                (array_key_exists("author", $p))? ($data["author"] = $p["author"]):$data["author"]="";

                //abstract
                (array_key_exists("abstract", $p))? ($data["abstract"] = $p["abstract"]):$data["abstract"]="";

                //title
                (array_key_exists("title", $p))? ($data["title"] = $p["title"]):$data["title"]="";

                //publisher
                (array_key_exists("publisher", $p))? ($data["publisher"] = $p["publisher"]):$data["publisher"]= "";

                //year
                (array_key_exists("year", $p))? ($data["year"] = $p["year"]):$data["year"]="";

                //booktitle
                (array_key_exists("booktitle", $p))? ($data["booktitle"] = $p["booktitle"]):$data["booktitle"]="";

                //editor
                (array_key_exists("editor", $p))? ($data["editor"] = $p["editor"]):$data["editor"]="";

                //journal
                (array_key_exists("journal", $p))? ($data["journal"] = $p["journal"]):$data["journal"]="";

                //volume
                (array_key_exists("volume", $p))? ($data["volume"] = $p["volume"]):$data["volume"]="";

                //number
                (array_key_exists("number", $p))? ($data["number"] = $p["number"]):$data["number"]="";

                //note
                (array_key_exists("note", $p))? ($data["note"] = $p["note"]):$data["note"]="";

                //implementationurl
                (array_key_exists("implementationurl", $p))? ($data["implementationurl"] = $p["implementationurl"]):$data["implementationurl"]="";

                //paperurl
                (array_key_exists("paperurl", $p))? ($data["paperurl"] = $p["paperurl"]):$data["paperurl"]="";

                //tags
                (array_key_exists("tags", $p))? ($data["tags"] = $p["tags"]):$data["tags"]="";

                $this->paper_service->insert_paper($data);
            }
        }
    }
    public function create_bibtex_file_from_db(){
        $this->load->model('paper_service');
        $papers = $this->paper_service->get_paper_from_bib();
        $file = TEMP_BIBTEX;

        $str = "";
        foreach($papers as $p) {
            $str .= "@" . $p["type"] . "{" . $p["citation_key"] . ", \n";
            foreach(array_keys($p) as $key) {
                $key_name = (string)$key;
                $key_val = (string)$p[$key_name];
                if (!empty($key_val)){
                    $str .= ucfirst($key_name) . " = {" . $key_val . "}, \n";
                }
            }
            $str .= "} \n";
        }

        file_put_contents($file, $str);
    }

    public function view_bib($year = 2015){
        $this->load->library('phpBibLib/Bibtex');
        $this->load->model('paper_service');

        $this->create_bibtex_file_from_db();

        $bibtex = new Bibtex(TEMP_BIBTEX);

        $bibtex->ResetBibliography();
        $bibtex->SetBibliographyStyle('numeric');
        $bibtex->SetBibliographyOrder('usg');
        $bibtex->display_all_papers();

        $view_data = array();
        $view_data["papers"] = $bibtex;
        $this->load->view('view_bibliography', $view_data);
    }

    public function create_review_from_bib_list($id = NULL){
        $paper = $this->paper_service->get_paper_detail($id);

        $view_data = array();
        $view_data["p"] = $paper[0];
        $this->load->view('create_new_review', $view_data);
    }

    public function submit_review(){
        $form = $this->input->post();
        $form["added_date"] = date("Y-m-d H:i:s");

        $id = $this->paper_service->insert_paper($form);
        redirect(base_url('index.php/paper_controller/view_paper/' . $id));
    }

}
