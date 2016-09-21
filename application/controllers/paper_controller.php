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

    public function view_paper($id = NULL){
        $this->load->model('paper_service');
        $paper = $this->paper_service->get_paper_detail($id);

        $view_data = array();
        $view_data["paper"] = $paper;
        $this->load->view('view_paper', $view_data);
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

            //get paper from bibArray by key
            $p = $bibtexArr[$bib_key];

            $data = [];
            //review (-1: non-reviewed)
            $data["review_fk"]= "-1";

            //paper type
            (array_key_exists("type", $p))? ($data["type"] = $p["type"]):$data["type"]="";

            //citation key
            $data["citation_key"] = trim($bib_key);

            //abstract
            (array_key_exists("abstract", $p))? ($data["abstract"] = $p["abstract"]):$data["abstract"]="";

            //author
            (array_key_exists("author", $p))? ($data["author"] = $p["author"]):$data["author"]="";

            //title
            (array_key_exists("title", $p))? ($data["title"] = $p["title"]):$data["title"]="";

            //journal
            (array_key_exists("journal", $p))? ($data["journal"] = $p["journal"]):$data["journal"]="";

            //year
            (array_key_exists("year", $p))? ($data["year"] = $p["year"]):$data["year"]= "";

            //volume
            (array_key_exists("volume", $p))? ($data["volume"] = $p["volume"]):$data["volume"]="";

            //number
            (array_key_exists("number", $p))? ($data["number"] = $p["number"]):$data["number"]="";

            //pages
            (array_key_exists("pages", $p))? ($data["pages"] = $p["pages"]):$data["pages"]="";

            //month
            (array_key_exists("month", $p))? ($data["month"] = $p["month"]):$data["month"]="";

            //note
            (array_key_exists("note", $p))? ($data["note"] = $p["note"]):$data["note"]="";

            //editor
            (array_key_exists("editor", $p))? ($data["editor"] = $p["editor"]):$data["editor"]="";

            //publisher
            (array_key_exists("publisher", $p))? ($data["publisher"] = $p["publisher"]):$data["publisher"]= "";

            //publisher address
            (array_key_exists("publisher-address", $p))? ($data["publisher_address"] = $p["publisher"]):$data["publisher"]= "";

            //series
            (array_key_exists("series", $p))? ($data["series"] = $p["series"]):$data["series"]= "";

            //booktitle or the name of the conference
            (array_key_exists("booktitle", $p))? ($data["booktitle"] = $p["booktitle"]):$data["booktitle"]="";

            //location of the conference
            (array_key_exists("venue", $p))? ($data["conference_location"] = $p["venue"]):$data["conference_location"]="";

            //edition
            (array_key_exists("edition", $p))? ($data["edition"] = $p["edition"]):$data["edition"]="";

            //tags
            (array_key_exists("tags", $p))? ($data["tags"] = $p["tags"]):$data["tags"]="";

            //file
            (array_key_exists("file", $p))? ($data["file"] = $p["file"]):$data["file"]="";

            //check if paper exists
            $is_paper_existed = $this->paper_service->check_unique_citation_key(trim($bib_key));
            if (empty($is_paper_existed)) {
                $this->paper_service->insert_paper($data);
            } else {
                $paper_id = $is_paper_existed[0]["id"];
                $data["id"] = $paper_id;
                $paper = $this->paper_service->update_paper($data);
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

    public function view_bib(){
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

    public function create_review_from_bib_list($paper_id = NULL){
        $is_paper_review_inserted = $this->paper_service->is_paper_review_inserted($paper_id);
        $paper = $this->paper_service->get_paper_detail($paper_id);

        if (empty($is_paper_review_inserted)){
            //create new review in db
            $review_data["pr_paper_fk"] = $paper_id;
            $new_review_id = $this->paper_service->insert_review($review_data, $paper_id);
        }

        //retrieve details of selected paper
        $paper = $this->paper_service->get_paper_detail($paper_id);
        redirect(base_url('index.php/paper_controller/open_existing_review/' . $paper));
    }

    public function initialize_review($paper_id) {
        //retrieve details of selected paper
        $paper = $this->paper_service->get_paper_detail($paper_id);

        //create new review in db
        $review_data["pr_paper_fk"] = $paper_id;
        $new_review_id = $this->paper_service->insert_review($review_data, $paper_id);


        $paper["pr_id"] = $new_review_id;
        $view_data = array();
        $view_data["paper"] = $paper;
        $this->load->view('view_edit_review', $view_data);
    }

    public function open_existing_review($id = NULL){
        $paper = $this->paper_service->get_paper_detail($id);
        $view_data = array();
        $view_data["paper"] = $paper;
        $this->load->view('view_edit_review', $view_data);
    }

    public function submit_update_review(){
        $form = $this->input->post();
        $form["added_date"] = date("Y-m-d H:i:s");

        $id = $this->paper_service->update_review($form);
        redirect(base_url('index.php/paper_controller/view_paper/' . $id));
    }

}
