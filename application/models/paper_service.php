<?php
class Paper_Service extends CI_Model {
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

    //check if the citation is unique
    function check_unique_citation_key($cite_key) {
        $sql = "SELECT id FROM tbl_paper WHERE citation_key = ?";
        return $this->db->query($sql, array($cite_key))->result_array();
    }

    //insert new review of a paper
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

    //check if there is an existing review
    function is_paper_review_inserted($paper_id){
        $sql = "SELECT pr_id, pr_paper_fk 
                FROM tbl_paper_review 
                WHERE pr_paper_fk = ?";
        return $this->db->query($sql, array($paper_id))->result_array();
    }

    //get a single paper from bibliography
    function get_paper_detail($paper_id){
        $sql = "SELECT * FROM tbl_paper WHERE id = ?";
        $result = $this->db->query($sql, array($paper_id))->result_array();
        return $result[0];
    }

    //update review
    function update_review($data){
        $this->db->where('pr_id', $data["pr_id"]);
        $q = $this->db->update('tbl_paper_review', $data);
        return $q;
    }


    function get_review(){
        $sql = "SELECT pr_id, pr_added_date FROM tbl_paper_review";
        return $this->db->query($sql)->result_array();
    }

    //insert a new paper
    function insert_paper($data){
        $q = $this->db->insert('tbl_paper', $data);
        return $this->db->insert_id();
    }

    //update a per
    function update_paper($data){
        $this->db->where('id', $data["id"]);
        $q = $this->db->update('tbl_paper', $data);
        return $q;
    }

}