<?php

Class ReservasiModel extends CI_Model
{
    public $id_rsv;
    public $tgl_rsv;
    public $jumlah_org;
    public $no_meja;
    public $nama;
    public $no_hp;
    public $email;
    public $id_bayar;


    public function get_all_data_reservasi()
    {
        $query = "SELECT * from reservasi";
        return $this->db->query($query)->result_array();
    }
}