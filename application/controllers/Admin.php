<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('admin/index', $data);
    }
    public function reservasi()
    {
        $data['title'] = 'Reservasi';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('admin/reservasi', $data);
    }
    public function menu()
    {
        $data['title'] = 'Daftar Menu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('MenuModel');
        $data['allmenu'] = $this->MenuModel->get_all_data_menu();

        $this->load->view('admin/menu', $data);
    }
    public function menu_create()
	{
		$data['title'] = "Tambah Daftar Menu";
        
        $this->load->model('MenuModel');
        $data['allkategori']=$this->MenuModel->get_kategori();

		$this->load->view('admin/menu_create', $data);
	}
	public function simpanmenu()
	{
        $this->load->model('MenuModel');
        $data = [
			'id_menu' => $this->input->post('id_menu'),
			'nama_menu' => $this->input->post('nama_menu'),
			'harga_menu' => $this->input->post('harga_menu'),
			'gambar_menu' => $this->input->post('gambar_menu'), 
            'id_kategori' => $this->input->post('id_kategori')
		];
		$this->db->insert('menu', $data);

		redirect('admin/menu');
	}
    public function kategori()
    {
        $data['title'] = 'Daftar Kategori';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('KategoriModel');
        $data['allkategori'] = $this->KategoriModel->get_all_data_kategori();

        $this->load->view('admin/kategori', $data);
    }
    public function kategori_create()
	{
		$data['title'] = "Tambah Daftar kategori";

		$this->load->view('admin/kategori_create', $data);
	}

	public function simpankategori()
	{
		$data = [
			'id_kategori' => $this->input->post('id_kategori'),
			'nama_kategori' => $this->input->post('nama_kategori'),
		];
		$this->db->insert('kategori', $data);
		redirect('admin');
	}
    public function member()
    {
        $data['title'] = 'Daftar Member';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('MemberModel');
        $data['allmember'] = $this->MemberModel->get_all_data_member();

        $this->load->view('admin/member', $data);
    }
    public function event()
    {
        $data['title'] = 'Daftar Event';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('EventModel');
        $data['allevent'] = $this->EventModel->get_all_data_event();

        $this->load->view('admin/event', $data);
    }
    public function reservation()
    {
        $data['title'] = 'Daftar Reservasi';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('ReservasiModel');
        $data['allreservasi'] = $this->ReservasiModel->get_all_data_reservasi();

        $this->load->view('admin/reservation', $data);
    }
    public function pesanan()
    {
        $data['title'] = 'Daftar Pesanan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('PesananModel');
        $data['allpesanan'] = $this->PesananModel->get_all_data_pesanan();

        $this->load->view('admin/pesanan', $data);
    }
}
