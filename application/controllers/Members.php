<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Members extends CI_Controller {
	function foto(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$this->model_members->modupdatefoto();
			redirect('members/profile');
		}else{
			redirect('members/profile');
		}
	}

	function tabungan(){
		cek_session_members();
		$data['title'] = 'Tabungan Anda Saat ini';
		$data['record'] = $this->model_members->tabungankonsumen($this->session->username);
		$data['rekening'] = $this->model_members->rekening();
		$data['total'] = $this->model_members->total_tabungan($this->session->username)->row_array();
		$this->template->load('phpmu-one/template','phpmu-one/members/view_tabungan',$data);
	}

	function downline(){
		cek_session_members();
		if ($this->uri->segment(3) != ''){
			$username = $this->uri->segment(3);
		}else{
			$username = $this->session->username;
		}
		$jumlah= $this->model_members->totaldownline($username)->num_rows();
		$config['base_url'] = base_url().'members/downline/'.$username;
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 25; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['record'] = $this->model_members->downline($username, $config['per_page'], $dari);
		}else{
			redirect('members/downline');
		}
		$this->pagination->initialize($config);
		$data['title'] = 'Downline Anda Saat ini';
		$this->template->load('phpmu-one/template','phpmu-one/members/view_downline',$data);
	}

	function keuangan(){
		cek_session_members();
		$data['title'] = 'Data Keuangan Anda';
		$data['ket'] = $this->model_members->keterangan(1)->row_array();
		$data['bon'] = $this->model_members->bonus_detail($this->session->username);
		$data['totpen'] = $this->model_members->totpencairan($this->session->username)->row_array();
		$data['totbon'] = $this->model_members->totbonus($this->session->username)->row_array();

		$data['bons'] = $this->model_members->bonus_details($this->session->username);
		$data['totpens'] = $this->model_members->totpencairans($this->session->username)->row_array();
		$data['totbons'] = $this->model_members->totbonuss($this->session->username)->row_array();
		$this->template->load('phpmu-one/template','phpmu-one/members/view_keuangan',$data);
	}

	function orderkode(){
		cek_session_members();
		$jumlah= $this->model_members->hitung_orderkodekonsumen($this->session->id_konsumen)->num_rows();
		$config['base_url'] = base_url().'members/orderkode';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 6; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}
		if (is_numeric($dari)) {
			$data['record'] = $this->model_members->orderkodekonsumen($this->session->id_konsumen, $config['per_page'], $dari);
		}else{
			redirect('orderkode');
		}
		$this->pagination->initialize($config);
		$data['rekening'] = $this->model_members->rekening();
		$data['title'] = 'List Order Kode Aktivasi Anda';
		$this->template->load('phpmu-one/template','phpmu-one/members/view_order_kode',$data);
	}

	function tambah_orderkode(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
			$this->model_members->insert_orderkodekonsumen($this->session->id_konsumen,$set['harga_pin']);
			redirect('members/orderkode');
		}else{
			$data['title'] = 'Tambah Order Kode Aktivasi Anda';
			$this->template->load('phpmu-one/template','phpmu-one/members/view_order_kode_tambah',$data);
		}
	}

	function detail_orderkode(){
		cek_session_members();
		$data['record'] = $this->model_members->konsumen_orderkode_terkirim($this->uri->segment(3));
		$data['title'] = 'Berikut Pesanan Kode Aktivasi Anda';
		$this->template->load('phpmu-one/template','phpmu-one/members/view_order_kode_detail',$data);
	}


	function delete_pembayaran(){
		cek_session_members();
		$id = $this->uri->segment(3);
		$row = $this->db->query("SELECT * FROM rb_tabungan_bayar where id_tabungan_bayar='$id'")->row();
		if ($row->id_konsumen == $this->session->id_konsumen){
			$this->model_members->delete_tabungan($id);
			redirect('members/tabungan');
		}else{
			echo "<script>window.alert('Maaf, Anda Tidak Memiliki akses');
                                  window.location=('".base_url()."members/tabungan')</script>";
		}
	}

	function jaringan(){
		cek_session_members();
		$data['title'] = 'Jaringan Anda Saat ini';
		$this->template->load('phpmu-one/template','phpmu-one/members/view_jaringan',$data);
	}

	
	function tambah_jaringan(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$kode = strip_tags($this->input->post('id'));
			$cek = $this->db->query("SELECT * FROM rb_konsumen where kode_konsumen='$kode' AND username=''")->num_rows();
			if ($cek >= 1){
					$this->model_members->jaringan_tambah();
					redirect('members/jaringan');
			}else{
				$data['title'] = 'Tambahkan Jaringan Baru';
				$data['error'] = 'Maaf, Kode Konsumen yang anda masukkan salah!';
				$this->template->load('phpmu-one/template','phpmu-one/members/view_jaringan_tambah',$data);
			}
		}else{
			if ($this->uri->segment(3) == '' OR $this->uri->segment(4) == ''){
				redirect('members/jaringan');
			}
			$data['title'] = 'Tambahkan Jaringan Baru';
			$this->template->load('phpmu-one/template','phpmu-one/members/view_jaringan_tambah',$data);
		}
	}

	function pencairan(){
		cek_session_members();
		$data['title'] = 'Data History Pencairan Dana';
		$data['record'] = $this->model_members->pencairan_detail($this->session->username);
		$this->template->load('phpmu-one/template','phpmu-one/members/view_pencairan',$data);
	}

	function profile(){
		cek_session_members();
		$data['title'] = 'Profile Anda';
		$data['row'] = $this->model_members->profile_view($this->session->id_konsumen)->row_array();
		$this->template->load('phpmu-one/template','phpmu-one/members/view_profile',$data);
	}

	function edit_profile(){
		cek_session_members();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_members->profile_update($this->session->id_konsumen);
			redirect('members/profile');
		}else{
			$data['title'] = 'Edit Profile Anda';
			$data['row'] = $this->model_members->profile_view($this->session->id_konsumen)->row_array();
			$this->template->load('phpmu-one/template','phpmu-one/members/view_profile_edit',$data);
		}
	}

	public function username_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $username = $this->input->post('a');

            if(!$this->form_validation->is_unique($username, 'rb_konsumen.username')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('messageusername' => 'Maaf, Username ini sudah terdaftar,..')));
            }

        }
    }

    public function email_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $email = $this->input->post('d');

	        if(!$this->form_validation->is_unique($email, 'rb_konsumen.email')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'Maaf, Email ini sudah terdaftar,..')));
            }
        }
    }

    public function ktp_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $ktp = $this->input->post('g');

            if(!$this->form_validation->is_unique($ktp, 'rb_konsumen.no_ktp')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('messagektp' => 'Maaf, No KTP ini sudah terdaftar,..')));
            }
        }
    }

	function logout(){
		cek_session_members();
		$this->session->sess_destroy();
		redirect('main');
	}
}
