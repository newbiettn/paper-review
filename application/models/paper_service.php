<?php
class Paper_Service extends CI_Model {
    function insert_paper_review($data) {
        $q = $this->db->insert('tbl_paper_review', $data);
        return $this->db->insert_id();
    }
    function get_list_paper(){
        $sql = "SELECT pr_id, pr_added_date FROM tbl_paper_review";
        return $this->db->query($sql)->result_array();
    }
    function get_paper_detail($p_id){
        $sql = "SELECT * FROM tbl_paper_review WHERE p_id = ?";
        return $this->db->query($sql, array($p_id))->result_array();
    }
    function update_paper($data){
        $this->db->where('pr_id', $data["pr_id"]);
        $q = $this->db->update('tbl_paper_review', $data);
        return $q;
    }
    function insert_paper($data){
        $q = $this->db->insert('tbl_paper', $data);
        return $this->db->insert_id();
    }
    function insert_author($data) {
        $q = $this->db->insert('tbl_author', $data);
        return $this->db->insert_id();
    }
    function lookup_paper_type($paper_type) {
        $sql = "SELECT * FROM tbl_paper_type WHERE pt_name = ?";
        return $this->db->query($sql, array($paper_type))->result_array();
    }
    function check_unique_citation_key($cite_key) {
        $sql = "SELECT id FROM tbl_paper WHERE citation_key = ?";
        return $this->db->query($sql, array($cite_key))->result_array();
    }
    function get_paper_from_bib(){
        $sql = "SELECT p.* FROM tbl_paper AS p";
        return $this->db->query($sql)->result_array();
    }
}