<?php

class Members_area extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> approved();
	}

	function members_area() {
		$data['title'] 			= 'Members Page';
		$data['main_content'] 	= 'member/wellcome';
		$this -> load -> view('member/temp/template', $data);
	}

	function approved() {
		$approved = $this -> session -> userdata('approved');

		if (!isset($approved) || $approved != TRUE) {
			redirect('site');
			// kick users butt :D
		}
	}

	function logout() {
		$this -> session -> sess_destroy();
		redirect('site');
	}

//========================= AWAL CODING UNTUK DATA ANGGOTA =====================//

	function form_anggota() {
		$data['title'] 			= "Isi Data Anggota";
		$data['main_content'] 	= "member/anggota/data_anggota";
		$this -> load -> view('member/temp/template', $data);
	}

	function data_anggota() {
		$this -> load -> library('form_validation');
		//nama field, pesan eror, bentuk validasi.. adalah parameter dari set_rules

		$this -> form_validation -> set_rules('no_rek', 'Nomor Rekening', 'trim|required|exact_length[13]|callback_no_rek_check');
		$this -> form_validation -> set_rules('tanggal', 'Tanggal', 'trim|required');
		$this -> form_validation -> set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this -> form_validation -> set_rules('alamat', 'Alamat', 'trim|required|max_length[150]');
		$this -> form_validation -> set_rules('alamat_surat', 'Alamat Surat', 'trim|max_length[150]');
		$this -> form_validation -> set_rules('tmp_lahir', 'Tempat Lahir', 'trim|required|max_length[50]');
		$this -> form_validation -> set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$this -> form_validation -> set_rules('gender', 'Jenis Kelamin', 'trim|required|exact_length[1]');
		$this -> form_validation -> set_rules('telpon', 'Telpon', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('jenis_id', 'Jenis Kartu Pengenal', 'trim|max_length[20]');
		$this -> form_validation -> set_rules('no_id', 'Nomor Kartu Pengenal', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('agama', 'Agama', 'trim|max_length[30]');
		$this -> form_validation -> set_rules('pekerjaan', 'Pekerjaan', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('status', 'Status', 'trim|required|max_length[20]');
		$this -> form_validation -> set_rules('nama_psangan', 'Nama Pasangan', 'trim|max_length[100]');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> form_anggota();
		} else {
			$this -> load -> model('anggota_model');
			$query = $this -> anggota_model -> daftar_anggota();
			if ($query) {
				$detil 		= $this -> input -> post('no_rek');
				$fieldnya 	= "no_rek";
				$this -> load -> model('anggota_model');
		
				$data['detilanggota'] 	= $this -> anggota_model -> lihat_data($detil, $fieldnya);
				$data['title'] 			= "Data Berhasil Disimpan";
				$data['main_content'] 	= "member/anggota/detil_anggota";
				$this -> load -> view('member/temp/template', $data);
				
			} else {
				$this -> form_anggota();
			}
		}
	}

	function no_rek_check($str) {
		$this -> load -> model('anggota_model');
		$data['field'] = $this -> anggota_model -> periksa_duplikasi($str);
		$test = $data['field']['no_rek'];

		if ($str == $test) {
			$this -> form_validation -> set_message('no_rek_check', 'field %s sudah ada, silakan isi dengan data yang lain!');
			return FALSE;
		} else {
			return TRUE;
		}

	}


	function form_cetak_buku_tabungan($sort_by = 'no_rek', $sort_order = 'asc', $offset = 0) {
		$limit = 3;
		$data['fields'] = array('no_rek' => 'No Rekening', 'tanggal' => 'Tanggal', 'nama' => 'Nama');
		$this -> load -> model('anggota_model');
		$results = $this -> anggota_model -> cari($limit, $offset, $sort_by, $sort_order);
		$data['anggotabmt'] 	= $results['rows'];
		$data['num_results'] 	= $results['num_rows'];

		$this -> load -> library('pagination');
		$config = array();
		$config['base_url'] 	= site_url("system_site/form_cetak_buku_tabungan/$sort_by/$sort_order");
		$config['total_rows'] 	= $data['num_results'];
		$config['per_page'] 	= $limit;
		$config['uri_segment'] 	= 5;
		$this -> pagination -> initialize($config);
		$data['pagination'] 	= $this -> pagination -> create_links();

		$data['sort_by'] 		= $sort_by;
		$data['sort_order'] 	= $sort_order;

		$data['title'] 			= "Cetak Buku Tabungan";
		$data['main_content'] 	= "member/anggota/cetak_buku_tabungan";
		$this -> load -> view('member/temp/template', $data);
	}

	function form_cetak_buku_tabungan2() {
		$this -> load -> library('form_validation');

		$this -> form_validation -> set_rules('no_rek', 'Nomor Rekening', 'trim|required|exact_length[13]');
		
		if ($this -> form_validation -> run() == FALSE) {
			$this -> form_cetak_buku_tabungan();
		} else {
			$this -> cari_anggota();
			
		}

	}

	function detil_anggota(){
		$detil = $this -> uri -> segment(4);
		//print_r($detil); return;
		$fieldnya = $this -> uri -> segment(3);
		$this -> load -> model('anggota_model');

		$data['detilanggota'] 	= $this -> anggota_model -> lihat_data($detil, $fieldnya);
		$data['title'] 			= $detil;
		$data['main_content'] 	= "member/anggota/detil_anggota";
		$this -> load -> view('member/temp/template', $data);
		
	}

	function cari_anggota(){
		$detil 					= $this -> input -> post('no_rek');
		$fieldnya 				= "no_rek";
		redirect("system_site/detil_anggota/$fieldnya/$detil");
	}

	function edit_anggota(){
		$detil = $this -> uri -> segment(4);
		$fieldnya = $this -> uri -> segment(3);
		$this -> load -> model('anggota_model');
		$data['detilanggota'] 	= $this -> anggota_model -> lihat_data($detil, $fieldnya);
		$data['title'] 			= $detil;
		$data['main_content'] 	= "member/anggota/edit_anggota";
		$this -> load -> view('member/temp/template', $data);
	}

	function update_data_anggota() {
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('tanggal', 'Tanggal', 'trim|required');
		$this -> form_validation -> set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		$this -> form_validation -> set_rules('alamat', 'Alamat', 'trim|required|max_length[150]');
		$this -> form_validation -> set_rules('alamat_surat', 'Alamat Surat', 'trim|max_length[150]');
		$this -> form_validation -> set_rules('tmp_lahir', 'Tempat Lahir', 'trim|required|max_length[50]');
		$this -> form_validation -> set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
		$this -> form_validation -> set_rules('gender', 'Jenis Kelamin', 'trim|required|exact_length[1]');
		$this -> form_validation -> set_rules('telpon', 'Telpon', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('jenis_id', 'Jenis Kartu Identitas', 'trim|max_length[20]');
		$this -> form_validation -> set_rules('no_id', 'Nomor Kartu Identitas', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('agama', 'Agama', 'trim|max_length[30]');
		$this -> form_validation -> set_rules('pekerjaan', 'Pekerjaan', 'trim|max_length[50]');
		$this -> form_validation -> set_rules('status', 'Status', 'trim|required|max_length[20]');
		$this -> form_validation -> set_rules('nama_psangan', 'Nama Pasangan', 'trim|max_length[100]');

		if ($this -> form_validation -> run() == FALSE) {
			$detil 					= $this -> input -> post('no_rek');
			$fieldnya 				= "no_rek";
			redirect("system_site/edit_anggota/$fieldnya/$detil");
			//$this -> edit_anggota();
		} else {
			$this -> load -> model('anggota_model');
			$no_rek = $this -> input -> post('no_rek');
			
			$query = $this -> anggota_model -> update_daftar_anggota($no_rek);
			if ($query) {
				$detil 					= $this -> input -> post('no_rek');
				$fieldnya 				= "no_rek";
				$this -> load -> model('anggota_model');
				$data['detilanggota'] 	= $this -> anggota_model -> lihat_data($detil, $fieldnya);
				$data['title'] 			= "Data Berhasil Di Update";
				$data['main_content'] 	= "member/anggota/detil_anggota";
				$this -> load -> view('member/temp/template', $data);
			} else {
				$detil 					= $this -> input -> post('no_rek');
				$fieldnya 				= "no_rek";
				redirect("system_site/edit_anggota/$fieldnya/$detil");
				$this -> edit_anggota();
			}
		}
	}

	function form_hapus_anggota() {
		$detil = $this -> uri -> segment(4);
		$fieldnya = $this -> uri -> segment(3);
		$this -> load -> model('anggota_model');
		$data['detilanggota'] = $this -> anggota_model -> lihat_data($detil, $fieldnya);
		$data['title'] = "Hapus Anggota";
		$data['main_content'] = "member/anggota/hapus_anggota";
		$this -> load -> view('member/temp/template', $data);
	}


	function hapus_anggota(){
		$detil = $this -> input -> post('no_rek');
		$fieldnya = 'no_rek';
		$this -> load -> model('anggota_model');
		$this -> anggota_model -> hapus_data_anggota($detil, $fieldnya);
		redirect('system_site/form_cetak_buku_tabungan');		
	}

	//=============AKHIR CODING UNTUK DATA ANGGOTA=============//
	
	function form_simpanan() {
		$data['title'] 			= "Simpanan Anggota";
		$data['main_content'] 	= "member/simpanan_anggota";
		$this -> load -> view('member/temp/template', $data);
	}

	function form_sandi_transaksi() {
		$data['title'] 			= "Isi Sandi Transaksi";
		$data['main_content'] 	= "member/sandi_transaksi/sandi_transaksi";
		$this -> load -> view('member/temp/template', $data);
	}

	function sandi_transaksi() {
		$this -> load -> library('form_validation');
		//nama field, pesan eror, bentuk validasi.. adalah parameter dari set_rules

		$this -> form_validation -> set_rules('kode_sandi', 'Kode Sandi', 'trim|required|exact_length[2]|callback_kode_sandi_check');
		$this -> form_validation -> set_rules('nama_sandi', 'Nama Sandi', 'trim|required|max_length[20]');
		$this -> form_validation -> set_rules('kegiatan', 'Kegiatan', 'trim|required|max_length[10]');
		$this -> form_validation -> set_rules('nomor_akun', 'Nomor Akun', 'trim|required|max_length[6]');
		$this -> form_validation -> set_rules('keterangan', 'Keterangan', 'trim|max_length[100]');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> form_sandi_transaksi();
		} else {
			$this -> load -> model('sandi_transaksi_model');
			$query = $this -> sandi_transaksi_model -> daftar_sandi();
			if ($query) {
				$data['kode_sandi'] = $this -> input -> post('kode_sandi');
				$data['nama_sandi'] = $this -> input -> post('nama_sandi');
				$data['kegiatan'] = $this -> input -> post('kegiatan');
				$data['nomor_akun'] = $this -> input -> post('nomor_akun');
				$data['keterangan'] = $this -> input -> post('keterangan');
				$data['title'] = "Berhasil Disimpan";
				$data['main_content'] = "member/sandi_transaksi/sandi_transaksi_sukses";
				$this -> load -> view('member/temp/template', $data);
			} else {
				$this -> form_sandi_transaksi();
			}
		}
	}

	function kode_sandi_check($str) {
		$this -> load -> model('sandi_transaksi_model');
		$data['field'] = $this -> sandi_transaksi_model -> periksa_duplikasi($str);
		$test = $data['field']['kode_sandi'];

		if ($str == $test) {
			$this -> form_validation -> set_message('kode_sandi_check', 'field %s sudah ada, silakan isi dengan data yang lain!');
			return FALSE;
		} else {
			return TRUE;
		}

	}
}
