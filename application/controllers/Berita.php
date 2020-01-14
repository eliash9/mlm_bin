<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Berita extends CI_Controller {
	public function index(){
		$data['title'] = 'Semua Berita';
		$data['berita'] = $this->model_berita->semua_berita(0,15);
		$this->template->load('phpmu-one/template','phpmu-one/view_semua_berita',$data);
	}

	public function detail(){
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM berita where judul_seo='$ids' OR id_berita='$ids'");
	    $row = $dat->row();
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	redirect('main');
	        }
		$data['title'] = $row->judul;
		$data['record'] = $this->model_berita->berita_detail($ids)->row_array();
		$data['infoterbaru'] = $this->model_berita->info_terbaru(6);
		$this->model_berita->berita_dibaca_update($ids);
		$this->template->load('phpmu-one/template','phpmu-one/view_berita',$data);
	}

	public function kategori(){
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM kategori where kategori_seo='$ids' OR id_kategori='$ids'");
	    $row = $dat->row();
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	redirect('main');
	        }
		$data['title'] = $row->nama_kategori;
		$data['kategori'] = $this->model_berita->detail_kategori($row->id_kategori, 9);
		$this->template->load('phpmu-one/template','phpmu-one/view_kategori',$data);
	}
}
