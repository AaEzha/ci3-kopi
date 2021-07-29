<?php

Class EventModel extends CI_Model
{
    public $id_event;
    public $nama_event;
    public $tanggal_event;
    public $penyelenggara;
    public $tentang;
    public $cara_mendapatkan;
    public $gambar_event;

    public function get_all_data_event()
    {
        $query = "SELECT * from event";
        return $this->db->query($query)->result_array();
    }
}