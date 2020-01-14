<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function index(){
		$data['title'] = 'Selamat Datang di System Multi Level Marketing';
		$data['infoterbaru'] = $this->model_berita->info_terbaru(3);
		$data['iklantengah'] = $this->model_iklan->iklan_tengah();
		$data['kategori_utama'] = $this->model_berita->kategori_utama();
		$this->template->load('phpmu-one/template','phpmu-one/view_home',$data);
	}
}
