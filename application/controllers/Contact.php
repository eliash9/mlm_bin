<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	public function index(){
		if (isset($_POST['submit'])){
			$this->model_main->kirim_Pesan();
			redirect('contact');
		}else{
			$mp = $this->db->query("SELECT * FROM identitas")->row();
			$data['title'] = 'Hubungi Kami';
			$data['maps'] = $mp->maps;
			$this->template->load('phpmu-one/template','phpmu-one/view_contact',$data);
		}
	}
}
