<?php
defined('BASEPATH') or exit('No direct script access allowed');

include(APPPATH . 'libraries/GroceryCrudEnterprise/autoload.php');

use GroceryCrud\Core\GroceryCrud;

class Admin extends CI_Controller
{

	private function _getDbData()
	{
		$db = [];
		include(APPPATH . 'config/database.php');
		return [
			'adapter' => [
				'driver' => 'Pdo_Mysql',
				'host'     => $db['default']['hostname'],
				'database' => $db['default']['database'],
				'username' => $db['default']['username'],
				'password' => $db['default']['password'],
				'charset' => 'utf8'
			]
		];
	}
	private function _getGroceryCrudEnterprise($bootstrap = true, $jquery = true)
	{
		$db = $this->_getDbData();
		$config = include(APPPATH . 'config/gcrud-enterprise.php');
		$groceryCrud = new GroceryCrud($config, $db);
		return $groceryCrud;
	}

	function _example_output($output = null, $title = "")
	{
		if (isset($output->isJSONResponse) && $output->isJSONResponse) {
			header('Content-Type: application/json; charset=utf-8');
			echo $output->output;
			exit;
		}

		$output->title = $title;

		$this->load->view('gc.php', $output);
	}

	public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
    }

	public function kategori()
	{
		$title = "Data Kategori Menu";
		$crud = $this->_getGroceryCrudEnterprise();
		$crud->unsetSettings()->unsetFilters();
		$crud->setTable('kategori');
		$crud->setSubject('Kategori Menu', 'Administrasi Data');
		// $crud->unsetColumns(['created_at', 'updated_at']);
		// $crud->unsetFields(['created_at', 'updated_at']);
		// $crud->setRelation('validated_by', 'users', 'name');
		// $crud->requiredFields(['name', 'kode', 'gambar']);
		// $crud->uniqueFields(['kode']);
		// $crud->defaultOrdering(['name']);
		// $crud->setFieldUpload('gambar', 'assets/uploads/barang', base_url('assets/uploads/barang'));
		// $crud->callbackBeforeInsert(function ($s) {
		// 	$s->data['created_at'] = date('Y-m-d H:i:s');
		// 	$s->data['updated_at'] = date('Y-m-d H:i:s');

		// 	return $s;
		// });
		// $crud->callbackBeforeUpdate(function ($s) {
		// 	$s->data['updated_at'] = date('Y-m-d H:i:s');

		// 	return $s;
		// });
		$output = $crud->render();
		$this->_example_output($output, $title);
	}

	public function user()
	{
		$title = "Data User";
		$crud = $this->_getGroceryCrudEnterprise();
		$crud->unsetSettings()->unsetFilters();
		$crud->setTable('user');
		$crud->setSubject('User', 'Administrasi Data');
		$crud->setFieldUpload('image', 'assets/uploads', base_url('assets/uploads'));
		$crud->setRelation('role_id', 'user_role', 'role');
		$crud->uniqueFields(['email']);
		//password_hash($this->input->post("password"), PASSWORD_DEFAULT),
		$crud->unsetEditFields(['password']);
		$crud->callbackBeforeInsert(function ($s) {
			$s->data['password'] = password_hash($s->data['password'], PASSWORD_DEFAULT);

			return $s;
		});
		$crud->displayAs([
			'role_id' => 'Role'
		]);
		$output = $crud->render();
		$this->_example_output($output, $title);
	}

	public function menu()
	{
		$title = "Data Menu";
		$crud = $this->_getGroceryCrudEnterprise();
		$crud->unsetSettings()->unsetFilters();
		$crud->setTable('menu');
		$crud->setSubject('Menu', 'Administrasi Data');
		$crud->setRelation('id_kategori', 'kategori', 'nama_kategori');
		$crud->displayAs([
			'id_kategori' => 'Kategori'
		]);
		$crud->setFieldUpload('gambar_menu', 'assets/uploads', base_url('assets/uploads'));
		$output = $crud->render();
		$this->_example_output($output, $title);
	}

	public function member()
	{
		$title = "Data Member";
		$crud = $this->_getGroceryCrudEnterprise();
		$crud->unsetSettings()->unsetFilters();
		$crud->setTable('member');
		$crud->setSubject('Member', 'Administrasi Data');
		$crud->displayAs([
			'no_hp' => 'Nomor Handphone'
		]);
		$output = $crud->render();
		$this->_example_output($output, $title);
	}

	public function pembayaran()
	{
		$title = "Data Metode Pembayaran";
		$crud = $this->_getGroceryCrudEnterprise();
		$crud->unsetSettings()->unsetFilters();
		$crud->setTable('pembayaran');
		$crud->setSubject('Metode Pembayaran', 'Administrasi Data');
		$crud->displayAs([
			'no_hp' => 'Nomor Handphone'
		]);
		$output = $crud->render();
		$this->_example_output($output, $title);
	}

	public function event()
	{
		$title = "Data Event";
		$crud = $this->_getGroceryCrudEnterprise();
		$crud->unsetSettings()->unsetFilters();
		$crud->setTable('event');
		$crud->setSubject('Event', 'Administrasi Data');
		$crud->setFieldUpload('gambar_event', 'assets/uploads', base_url('assets/uploads'));
		$crud->setTexteditor(['tentang','cara_mendapatkan']);
		$output = $crud->render();
		$this->_example_output($output, $title);
	}

	public function reservasi()
	{
		$title = "Data Reservasi";
		$crud = $this->_getGroceryCrudEnterprise();
		$crud->unsetSettings()->unsetFilters();
		$crud->setTable('reservasi');
		$crud->setSubject('Reservasi', 'Administrasi Data');
		$crud->setRelation('id_bayar', 'pembayaran', 'nama_metode');
		$crud->displayAs([
			'id_bayar' => 'Metode Pembayaran',
			'tgl_rsv' => 'Tanggal Reservasi',
			'no_hp' => 'Nomor Handphone',
			'no_meja' => 'Nomor Meja',
			'jumlah_org' => 'Jumlah Orang'
		]);
		$output = $crud->render();
		$this->_example_output($output, $title);
	}

	public function role()
	{
		$title = "Data User Role";
		$crud = $this->_getGroceryCrudEnterprise();
		$crud->unsetSettings()->unsetFilters();
		$crud->setTable('user_role');
		$crud->setSubject('User Role', 'Administrasi Data');
		$output = $crud->render();
		$this->_example_output($output, $title);
	}

    

    // public function reservasi()
    // {
    //     $data['title'] = 'Reservasi';
    //     $data['user'] = $this->db->get_where('user', ['email' =>
    //     $this->session->userdata('email')])->row_array();

    //     $this->load->view('admin/reservasi', $data);
    // }
    
    // public function menu_create()
	// {
	// 	$data['title'] = "Tambah Daftar Menu";
        
    //     $this->load->model('MenuModel');
    //     $data['allkategori']=$this->MenuModel->get_kategori();

	// 	$this->load->view('admin/menu_create', $data);
	// }
	// public function simpanmenu()
	// {
    //     $this->load->model('MenuModel');
    //     $data = [
	// 		'id_menu' => $this->input->post('id_menu'),
	// 		'nama_menu' => $this->input->post('nama_menu'),
	// 		'harga_menu' => $this->input->post('harga_menu'),
	// 		'gambar_menu' => $this->input->post('gambar_menu'), 
    //         'id_kategori' => $this->input->post('id_kategori')
	// 	];
	// 	$this->db->insert('menu', $data);

	// 	redirect('admin/menu');
	// }
    // public function kategori()
    // {
    //     $data['title'] = 'Daftar Kategori';
    //     $data['user'] = $this->db->get_where('user', ['email' =>
    //     $this->session->userdata('email')])->row_array();

    //     $this->load->model('KategoriModel');
    //     $data['allkategori'] = $this->KategoriModel->get_all_data_kategori();

    //     $this->load->view('admin/kategori', $data);
    // }
    // public function kategori_create()
	// {
	// 	$data['title'] = "Tambah Daftar kategori";

	// 	$this->load->view('admin/kategori_create', $data);
	// }

	// public function simpankategori()
	// {
	// 	$data = [
	// 		'id_kategori' => $this->input->post('id_kategori'),
	// 		'nama_kategori' => $this->input->post('nama_kategori'),
	// 	];
	// 	$this->db->insert('kategori', $data);
	// 	redirect('admin');
	// }
    // public function member()
    // {
    //     $data['title'] = 'Daftar Member';
    //     $data['user'] = $this->db->get_where('user', ['email' =>
    //     $this->session->userdata('email')])->row_array();

    //     $this->load->model('MemberModel');
    //     $data['allmember'] = $this->MemberModel->get_all_data_member();

    //     $this->load->view('admin/member', $data);
    // }
    // public function event()
    // {
    //     $data['title'] = 'Daftar Event';
    //     $data['user'] = $this->db->get_where('user', ['email' =>
    //     $this->session->userdata('email')])->row_array();

    //     $this->load->model('EventModel');
    //     $data['allevent'] = $this->EventModel->get_all_data_event();

    //     $this->load->view('admin/event', $data);
    // }
    // public function reservation()
    // {
    //     $data['title'] = 'Daftar Reservasi';
    //     $data['user'] = $this->db->get_where('user', ['email' =>
    //     $this->session->userdata('email')])->row_array();

    //     $this->load->model('ReservasiModel');
    //     $data['allreservasi'] = $this->ReservasiModel->get_all_data_reservasi();

    //     $this->load->view('admin/reservation', $data);
    // }
    // public function pesanan()
    // {
    //     $data['title'] = 'Daftar Pesanan';
    //     $data['user'] = $this->db->get_where('user', ['email' =>
    //     $this->session->userdata('email')])->row_array();

    //     $this->load->model('PesananModel');
    //     $data['allpesanan'] = $this->PesananModel->get_all_data_pesanan();

    //     $this->load->view('admin/pesanan', $data);
    // }
}
