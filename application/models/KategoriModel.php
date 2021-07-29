<?php

Class KategoriModel extends CI_Model
{
    public $id_kategori;
    public $nama_kategori;

    public function get_all_data_kategori()
    {
        $query = "SELECT * from kategori";
        return $this->db->query($query)->result_array();
    }
}