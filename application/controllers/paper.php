<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paper extends CI_Controller {

    ////////////////////////////////////////////////////////////////
    ///// Constructor
    ////////////////////////////////////////////////////////////////
    function __construct(){
        parent::__construct();
        $this->load->model("paper_service");
    }

    ////////////////////////////////////////////////////////////////
    ///// Index
    ////////////////////////////////////////////////////////////////

    public function index()
    {
        redirect(base_url('index.php/paper/view_all_papers'));
    }

    ////////////////////////////////////////////////////////////////
    ///// View All Papers
    ////////////////////////////////////////////////////////////////
    public function view_all_papers(){
        $this->load->library('phpBibLib/Bibtex');
        $this->export_to_bibtex();

        $bibtex = new Bibtex(TEMP_BIBTEX);

        $bibtex->ResetBibliography();
        $bibtex->SetBibliographyStyle('numeric');
        $bibtex->SetBibliographyOrder('usg');
        $bibtex->display_all_papers();

        $view_data = array();
        $bib_result = $bibtex->getBibliography();
        $view_data['papers'] = $bib_result;

        $this->load->view('view_all_papers', $view_data);
    }

    ////////////////////////////////////////////////////////////////
    ///// Search papers
    ////////////////////////////////////////////////////////////////
    public function search(){
        $this->load->library('phpBibLib/Bibtex');
        $search_val = $this->input->post('search_val');

        $this->export_to_bibtex();

        $bibtex = new Bibtex(TEMP_BIBTEX);
        $bibtex->ResetBibliography();
        $bibtex->SetBibliographyStyle('numeric');
        $bibtex->SetBibliographyOrder('usg');
        $bibtex->Select(array('title' => $search_val));
        $bibtex->Select(array('author' => $search_val));
        $bibtex->Select(array('year' => $search_val));

        $jsonArr = array();

        $bib_result = $bibtex->getBibliography();
        $jsonArr['count'] = $bib_result["count"];
        $jsonArr['html'] = $bib_result["html"];

        echo(json_encode($jsonArr));
    }

    ////////////////////////////////////////////////////////////////
    ///// Import A Bibtex File to Db
    ////////////////////////////////////////////////////////////////
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

            //doi
            (array_key_exists("doi", $p))? ($data["doi"] = $p["doi"]):$data["doi"]="";

            //file
            (array_key_exists("file", $p))? ($data["file"] = $p["file"]):$data["file"]="";

            //abbreviation
            (array_key_exists("abbreviation", $p))? ($data["abbreviation"] = $p["abbreviation"]):$data["abbreviation"]="";
            
            //check if paper exists
            $is_paper_existed = $this->paper_service->check_unique_citation_key(trim($bib_key), trim($data["title"]));
            if (empty($is_paper_existed)) {
                $this->paper_service->insert_paper($data);
            } else {
                $paper_id = $is_paper_existed[0]["id"];
                $data["id"] = $paper_id;
                $paper = $this->paper_service->update_paper($data);
            }
        }
    }

    ////////////////////////////////////////////////////////////////
    ///// Export DB to BibTex
    ////////////////////////////////////////////////////////////////
    public function export_to_bibtex(){
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
                    $str .=  ($key_name) . " = {" . $key_val . "}, \n";
                }
            }
            $str .= "} \n";
        }

        file_put_contents($file, $str);
    }

    ////////////////////////////////////////////////////////////////
    ///// Create a Review
    ////////////////////////////////////////////////////////////////
    public function create_view($paper_id = NULL){
        $is_paper_review_inserted = $this->paper_service->is_paper_review_inserted($paper_id);
        $paper = $this->paper_service->get_paper_detail($paper_id);

        if (empty($is_paper_review_inserted)){
            //create new review in db
            $review_data["pr_paper_fk"] = $paper_id;
            $new_review_id = $this->paper_service->insert_review($review_data, $paper_id);
        }

        redirect(base_url('index.php/paper/open_review/' . $paper_id . '/' . $new_review_id));
    }

    ////////////////////////////////////////////////////////////////
    ///// Open a Review
    ////////////////////////////////////////////////////////////////
    public function open_review($paper_id = NULL, $review_id = NULL, $review_saved = FALSE){
        $paper = $this->paper_service->get_paper_detail($paper_id);
        $review = $this->paper_service->get_review($paper_id, $review_id);

        $view_data = array();
        $view_data["paper"] = $paper;
        $view_data["review"] = $review[0];
        $view_data["review_saved"] = $review_saved;

        $this->load->view('edit_review', $view_data);
    }

    ////////////////////////////////////////////////////////////////
    ///// Save a Review
    ////////////////////////////////////////////////////////////////
    public function submit_review(){
        $form = $this->input->post();
        $form["pr_added_date"] = date("Y-m-d H:i:s");

        $this->paper_service->update_review($form);

        $review_saved = 1;
        redirect(base_url('index.php/paper/open_review/' . $form["pr_paper_fk"] . '/' . $form["pr_id"] . '/' . $review_saved));
    }

}
