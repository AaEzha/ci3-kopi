<?php

Class MemberModel extends CI_Model
{
    public $id_member;
    public $nama_member;
    public $tgl_lahir;
    public $jenis_kelamin;
    public $no_hp;
    public $email;


    public function get_all_data_member()
    {
        $query = "SELECT * from member";
        return $this->db->query($query)->result_array();
    }
}