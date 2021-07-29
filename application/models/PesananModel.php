<?php

Class PesananModel extends CI_Model
{
    public $id_pesanan;
    public $id_user;
    public $shipment;
    public $id_menu;
    public $total_harga;
    public $alamat;
    public $keterangan;


    public function get_all_data_pesanan()
    {
        $query = "SELECT menu.*, pesanan.*, user.* from pesanan
        left join menu on menu.id_menu = pesanan.id_menu
        left join user on user.id_user = pesanan.id_user";
        return $this->db->query($query)->result_array();
    }
}