<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

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
        redirect(base_url('index.php/paper/manage/show_all_papers'));
    }

    ////////////////////////////////////////////////////////////////
    ///// View All Papers without Edit View
    ////////////////////////////////////////////////////////////////
    public function show_all_papers(){
        $this->load->library('phpBibLib/Bibtex');
        $this->create_temp_file_for_processed();

        $bibtex = new Bibtex(TEMP_BIBTEX);

        $bibtex->ResetBibliography();
        $bibtex->SetBibliographyStyle('numeric');
        $bibtex->SetBibliographyOrder('usg');
        $bibtex->display_all_papers();

        $view_data = array();
        $bib_result = $bibtex->getBibliography();

        $view_data['papers'] = $bib_result;
        $view_data['head'] = $this->load->view('head', NULL, TRUE);
        $view_data['header'] = $this->load->view('header', NULL, TRUE);
        $view_data['footer'] = $this->load->view('footer', NULL, TRUE);
        $this->load->view('paper/simple_all_papers', $view_data);
    }

    ////////////////////////////////////////////////////////////////
    ///// Search papers Simple
    ////////////////////////////////////////////////////////////////
    public function search(){
        $this->load->library('phpBibLib/Bibtex');
        $search_val = $this->input->post('search_val');

        $this->create_temp_file_for_processed();

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

            //address of the publisher
            (array_key_exists("address", $p))? ($data["address"] = $p["address"]):$data["address"]= "";

            //series
            (array_key_exists("series", $p))? ($data["series"] = $p["series"]):$data["series"]= "";

            //booktitle or the name of the conference
            (array_key_exists("booktitle", $p))? ($data["booktitle"] = $p["booktitle"]):$data["booktitle"]="";

            //location of the conference
            (array_key_exists("venue", $p))? ($data["venue"] = $p["venue"]):$data["venue"]="";

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

            //abbreviation
            (array_key_exists("isbn", $p))? ($data["isbn"] = $p["isbn"]):$data["isbn"]="";

            //beautify first before import
            $data = $this->paper_service->beautify($data);

            //check if paper exists
            $is_paper_existed = $this->paper_service->is_paper_existed(trim($bib_key), trim($data["title"]));
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
    ///// Validate bibtex
    ////////////////////////////////////////////////////////////////
    public function validate_bibtex($p){
        $papers = $this->paper_service->get_paper_from_bib();

        $required_list =
            array("article" => ["author", "title", "journal", "month", "year", "publisher", "address"],
                "inproceedings" => ["author", "title", "publisher", "year", "month", "address", "booktitle"]
                  );


        //get all fields of a paper
        $current_fields = array_keys($p);

        //get all required fields of a matching type
        $type = $p["type"];
        $required_fields = $required_list[$type];

        //compare if the required field existed
        $diff_arr = array_diff($required_fields, $current_fields);

        //the field exists but empty is still invalidated
        foreach($required_fields as $f) {
            $field_content = $p[$f];
            if ($field_content == '') {
                array_push($diff_arr, $f);
            }
        }
        $str = "";
        if (!empty($diff_arr)){
            foreach($diff_arr as $field) {
                $str .= "<span style='display:inline-block; background: #f1f1f1; border: 1px solid #dddddd; margin: 3px; padding: 3px 5px;font-size: 12px;'>" . $field . "</span>";
            }
        }

        return $str;
    }

    ////////////////////////////////////////////////////////////////
    ///// Create a temp text file for displaying
    ////////////////////////////////////////////////////////////////
    public function create_temp_file_for_processed(){
        $papers = $this->paper_service->get_paper_from_bib();
        $file = TEMP_BIBTEX;

        $str = "";
        foreach($papers as $p) {
            //check field first
            $validation = $this->validate_bibtex($p);

            $type = $p["type"];
            $citation_key = $p["citation_key"];
            $abstract = $p["abstract"];
            $author = $p["author"];
            $title = $p["title"];
            $journal = $p["journal"];
            $year = $p["year"];
            $volume = $p["volume"];
            $number = $p["number"];
            $pages = $p["pages"];
            $month = $p["month"];
            $editor = $p["editor"];
            $publisher = $p["publisher"];
            $address = $p["address"];
            $series = $p["series"];
            $booktitle = $p["booktitle"];
            $edition = $p["edition"];
            $tags = $p["tags"];
            $doi = $p["doi"];
            $file_path = $p["file"];
            $abbreviation = $p["abbreviation"];
            $venue = $p["venue"];
            $isbn = $p["isbn"];

            $str .= "@" . $p["type"] . "{" . $citation_key . ", \n";

            //compulsory parts
            $str .= "author = {" . $author . "},";
            $str .= "title = {" . $title . "},";
            $str .= "year = {" . $year . "},";
            $str .= "month = {" . $month . "},";

            //tailored
            if ($type == "inproceedings") {
                $str .= "booktitle = {Proceedings of " . $booktitle . "(" . $abbreviation . ", " . $venue . ")" ."},";
                $str .= "pages = {" . $pages . "},";
                $str .= "publisher = {" . $publisher . "},";
                $str .= "address = {" . $address . "}";
                $str .= "volume = {" . $volume . "},";
                $str .= "editor = {" . $editor . "},";

            } else if ($type == "article") {
                $str .= "journal = {" . $journal . "},";
                $str .= "pages = {" . $pages . "},";
                $str .= "publisher = {" . $publisher . "},";
                $str .= "address = {" . $address . "}";
                $str .= "volume = {" . $volume . "},";
                $str .= "series = {" . $series . "},";
            }

            $str .= "id = {" . $p["id"] . "},";
            $str .= "review_fk = {" . $p["review_fk"] . "},";
            $str .= "validation = {" . $validation . "}";

            $str .= "}\n";
        }

        file_put_contents($file, $str);
    }
    ////////////////////////////////////////////////////////////////
    ///// Export to BibTex
    ////////////////////////////////////////////////////////////////
    public function export_to_bibtex(){
        
    }

    ////////////////////////////////////////////////////////////////
    ///// Generate a single BibTex string
    ////////////////////////////////////////////////////////////////
    public function generate_a_single_bibtex($p){
        $papers = $this->paper_service->get_paper_from_bib();
        $file = TEMP_BIBTEX;

        $type = $p["type"];
        $citation_key = $p["citation_key"];
        $abstract = $p["abstract"];
        $author = $p["author"];
        $title = $p["title"];
        $journal = $p["journal"];
        $year = $p["year"];
        $volume = $p["volume"];
        $number = $p["number"];
        $pages = $p["pages"];
        $month = $p["month"];
        $editor = $p["editor"];
        $publisher = $p["publisher"];
        $address = $p["address"];
        $series = $p["series"];
        $booktitle = $p["booktitle"];
        $edition = $p["edition"];
        $tags = $p["tags"];
        $doi = $p["doi"];
        $file_path = $p["file"];
        $abbreviation = $p["abbreviation"];
        $venue = $p["venue"];
        $isbn = $p["isbn"];

        $str = "";
        $str .= "@" . $p["type"] . "{" . $citation_key . ", \n";

        //compulsory parts
        $str .= "author = {" . $author . "},";
        $str .= "title = {" . $title . "},";
        $str .= "year = {" . $year . "},";
        $str .= "month = {" . $month . "},";

        //tailored
        if ($type == "inproceedings") {
            $str .= "booktitle = {Proceedings of " . $booktitle . "(" . $abbreviation . ", " . $venue . ")" ."},";
            $str .= "pages = {" . $pages . "},";
            $str .= "publisher = {" . $publisher . "},";
            $str .= "address = {" . $address . "}";
            $str .= "volume = {" . $volume . "},";
            $str .= "editor = {" . $editor . "},";

        } else if ($type == "article") {
            $str .= "journal = {" . $journal . "},";
            $str .= "pages = {" . $pages . "},";
            $str .= "publisher = {" . $publisher . "},";
            $str .= "address = {" . $address . "}";
            $str .= "volume = {" . $volume . "},";
            $str .= "series = {" . $series . "},";
        }

        $str .= "note = {" . $volume . "}";
        $str .= "}\n";

        return $str;
    }

    ////////////////////////////////////////////////////////////////
    ///// Generate all papers to BibTex string
    ////////////////////////////////////////////////////////////////
    public function generate_bibtex_for_all_papers(){
        $papers = $this->paper_service->get_paper_from_bib();
        $file = TEMP_BIBTEX;

        $str = "";
        foreach($papers as $p) {
            $str .= $this->generate_a_single_bibtex($p);
        }
        return $str;
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

    ////////////////////////////////////////////////////////////////
    ///// Save a Review
    ////////////////////////////////////////////////////////////////

}
