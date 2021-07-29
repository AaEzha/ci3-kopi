<?php

Class MenuModel extends CI_Model
{
    public $id_menu;
    public $nama_menu;
    public $harga_menu;
    public $gambar_menu;
    public $id_kategori;


    public function get_all_data_menu()
    {
        $query = "SELECT * from menu";
        return $this->db->query($query)->result_array();
    }
    function get_kategori()
    {
        $query = $this->db->query("SELECT * FROM kategori ORDER BY nama_kategori ASC");

        return $query->result_array();
    }

}