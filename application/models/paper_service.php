<?php
class Paper_Service extends CI_Model {
    ////////////////////////////////////////////////////////////////
    ///// Paper
    ////////////////////////////////////////////////////////////////

    //get a paper
    function get_paper_detail($paper_id){
        $sql = "SELECT * FROM tbl_paper WHERE id = ?";
        $result = $this->db->query($sql, array($paper_id))->result_array();
        return $result[0];
    }

    //insert a new paper
    function insert_paper($data){
        $this->db->trans_start();
        $q = $this->db->insert('tbl_paper', $data);
        $this->db->trans_complete();

        return $this->db->insert_id();
    }

    //update a paper
    function update_paper($data){
        $this->db->where('id', $data["id"]);
        $q = $this->db->update('tbl_paper', $data);
        return $q;
    }

    //get all papers from bibliography
    function get_paper_from_bib(){
        $sql = "SELECT p.* FROM tbl_paper AS p";
        return $this->db->query($sql)->result_array();
    }

    //check what type of the paper
    function lookup_paper_type($paper_type) {
        $sql = "SELECT * FROM tbl_paper_type WHERE pt_name = ?";
        return $this->db->query($sql, array($paper_type))->result_array();
    }

    //check if the paper is imported
    function is_paper_existed($cite_key, $title) {
        $sql = "SELECT id 
                FROM tbl_paper 
                WHERE citation_key = ? OR title = ?";
        return $this->db->query($sql, array('citation_key' => $cite_key, 'title' => $title))->result_array();
    }

    ////////////////////////////////////////////////////////////////
    ///// Review
    ////////////////////////////////////////////////////////////////

    //get a review according to the paper
    function get_review($paper_id, $review_id){
        $sql = "SELECT *
                FROM tbl_paper_review 
                WHERE paper_fk = ? AND pr_id = ?";
        return $this->db->query($sql, array('paper_fk' => $paper_id, 'pr_id' => $review_id))->result_array();
    }

    //insert a review
    function insert_review($review_data, $paper_id) {
        //create new review record
        $q = $this->db->insert('tbl_paper_review', $review_data);
        $new_review_id = $this->db->insert_id();

        //update foregin key in tbl_paper
        $sql = "UPDATE tbl_paper
                SET review_fk = ?
                WHERE id = ?";
        $this->db->query($sql, array('review_fk' => $new_review_id, 'id' => $paper_id));

        return $new_review_id;
    }

    //update review
    function update_review($data){
        $this->db->where('pr_id', $data["pr_id"]);
        $q = $this->db->update('tbl_paper_review', $data);
        return $q;
    }

    //check if there is an existing review
    function is_paper_review_inserted($paper_id){
        $sql = "SELECT pr_id, paper_fk 
                FROM tbl_paper_review 
                WHERE paper_fk = ?";
        return $this->db->query($sql, array($paper_id))->result_array();
    }

    //auto matching between paper and review
//    function matching_review_and_paper(){
//        $sql = "SELECT id, title
//                FROM tbl_paper
//                WHERE paper_fk = -1";
//    }

    ////////////////////////////////////////////////////////////////
    ///// Misc Service
    ////////////////////////////////////////////////////////////////
    function beautify($p) {
        //trim all space
        $p = $this->trim_space($p);

        //generate citation key
//        $p = $this->generate_citation_key($p);

        //upper case author, title, journal, editor, address, booktitle, venue
//        (array_key_exists("author", $p))? $p["author"] = $this->uppercase($p["author"]): false;
//        (array_key_exists("title", $p))? $p["title"] = $this->uppercase($p["title"]): false;
//        (array_key_exists("journal", $p))? $p["journal"] = $this->uppercase($p["journal"]): false;
//        (array_key_exists("editor", $p))? $p["editor"] = $this->uppercase($p["editor"]): false;
//        (array_key_exists("address", $p))? $p["address"] = $this->uppercase($p["address"]): false;
//        (array_key_exists("booktitle", $p))? $p["booktitle"] = $this->uppercase($p["booktitle"]): false;
//        (array_key_exists("venue", $p))? $p["venue"] = $this->uppercase($p["venue"]): false;

        //retrieve the address of publishers
//        $p = $this->get_publisher_address($p);

        //repair month
//        $p = $this->repair_month($p);

        //remove dot at the end of the the tittle field
//        $p = $this->remove_dot($p);

        return $p;
    }

    /*
     * Automatically add the address of well-known publishers
     * Those publishers include: IEEE, ACM, Springer
     *
     */
    public function get_publisher_address($p){
        $publisher_list = array("IEEE", "ACM", "Springer");
        $address = "";

        if (array_key_exists("publisher", $p)) {
            $publisher = $p["publisher"];
            if ($publisher == "IEEE") {
                $address = "New Jersey, USA";
            } else if ($publisher == "ACM") {
                $address = "New York, USA";
            } else if ($publisher == "Springer") {
                $address = "Berlin, Germany";
            }
        }

        $p["address"] = $address;
        return $p;
    }
    /*
     * Uppercase the text with exceptions
     *
     */
    function uppercase($string){
        $delimiters = array(" ", "-", ".", "'", "O'", "Mc");
        $exceptions = array("on", "for", "to", "of", "in",
            "ANFIS", "IEEE", "ACM",
            "I", "II", "III", "IV", "V", "VI");
        /*
         * Exceptions in lower case are words you don't want converted
         * Exceptions all in upper case are any words you don't want converted to title case
         *   but should be converted to upper case, e.g.:
         *   king henry viii or king henry Viii should be King Henry VIII
         */
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
        foreach ($delimiters as $dlnr => $delimiter) {
            $words = explode($delimiter, $string);
            $newwords = array();
            foreach ($words as $wordnr => $word) {
                if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtoupper($word, "UTF-8");
                } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtolower($word, "UTF-8");
                } elseif (!in_array($word, $exceptions)) {
                    // convert to uppercase (non-utf8 only)
                    $word = ucfirst($word);
                }
                array_push($newwords, $word);
            }
            $string = join($delimiter, $newwords);
        }//foreach
        return $string;
    }

    /*
     * Generate citation key
     */
    public function generate_citation_key($p){
        if (array_key_exists("author", $p) && array_key_exists("doi", $p) && array_key_exists("year", $p)) {
            $arr = explode(' ',trim($p["author"]));
            $first_name = substr($arr[0], 0, -1);
            $p["citation_key"] = $first_name . ':' . $p["year"] . ":" . explode('/',trim($p["doi"]))[0];
        }
        return $p;
    }

    /*
     * Prepare Month
     */
    public function repair_month($p){
        $month = "";
        if (array_key_exists("month", $p)) {
            $month = $p["month"];

            if (strcasecmp($month, "jan") == 0) {
                $month = 1;
            } else if (strcasecmp($month, "feb") == 0) {
                $month = 2;
            } else if (strcasecmp($month, "mar") == 0) {
                $month = 3;
            } else if (strcasecmp($month, "apr") == 0) {
                $month = 4;
            } else if (strcasecmp($month, "may") == 0) {
                $month = 5;
            } else if (strcasecmp($month, "jun") == 0) {
                $month = 6;
            } else if (strcasecmp($month, "jul") == 0) {
                $month = 7;
            } else if (strcasecmp($month, "aug") == 0) {
                $month = 8;
            } else if (strcasecmp($month, "sep") == 0) {
                $month = 9;
            } else if (strcasecmp($month, "oct") == 0) {
                $month = 10;
            } else if (strcasecmp($month, "nov") == 0) {
                $month = 11;
            } else if (strcasecmp($month, "dec") == 0) {
                $month = 12;
            }
        }
        $p["month"] = $month;
        return $p;
    }

    /*
     * Remove dot at the end of the title
     *
     */
    public function remove_dot($p) {
        $title = $p["title"];
        $end = substr($title, -1);
        var_dump($end);
        if ($end == ".") {
            $title = substr($title, 0, -1);
        }
        $p["title"] = $title;
        return $p;
    }

    /*
     * Trim all space
     */
    public function trim_space($p) {
        return $p = array_map('trim', $p);
    }
}