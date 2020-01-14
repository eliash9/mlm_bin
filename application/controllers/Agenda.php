<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agenda extends CI_Controller {
	public function detail(){
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM agenda where tema_seo='$ids' OR id_agenda='$ids'");
	    $row = $dat->row();
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	redirect('main');
	        }
		$data['title'] = $row->tema;
		$data['record'] = $this->model_agenda->agenda_detail($ids)->row_array();
		$data['infoterbaru'] = $this->model_berita->info_terbaru(6);
		$this->model_agenda->agenda_dibaca_update($ids);
		$this->template->load('phpmu-one/template','phpmu-one/view_agenda',$data);
	}
}
