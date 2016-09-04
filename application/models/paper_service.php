<?php
class Paper_Service extends CI_Model {
    function insert_paper($data) {
        $q = $this->db->insert('tbl_paper', $data);
        return $this->db->insert_id();
    }
    function get_list_paper(){
        $sql = "SELECT p_id, p_title, p_author, p_added_date FROM tbl_paper";
        return $this->db->query($sql)->result_array();
    }
    function get_paper_detail($p_id){
        $sql = "SELECT * FROM tbl_paper WHERE p_id = ?";
        return $this->db->query($sql, array($p_id))->result_array();
    }
    function update_paper($data){
        $this->db->where('p_id', $data["p_id"]);
        $q = $this->db->update('tbl_paper', $data);
        return $q;
    }
}