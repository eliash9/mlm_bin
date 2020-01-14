<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Video extends CI_Controller {
	public function index(){
		$jumlah= $this->model_playlist->hitung_video()->num_rows();
		$config['base_url'] = base_url().'video/index';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 6; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}
		if (is_numeric($dari)) {
			$data['record'] = $this->model_playlist->public_video($config['per_page'], $dari);
		}else{
			redirect('video');
		}
		$this->pagination->initialize($config);
		$data['title'] = 'Semua Video';
		$this->template->load('phpmu-one/template','phpmu-one/view_video',$data);
	}

	function detail(){
		$row = $this->db->query("SELECT * FROM video where video_seo='".$this->uri->segment(3)."'")->row();
		$data['record'] = $this->model_playlist->detail_video($row->id_video);
		$data['title'] = $row->jdl_video;
		$this->model_playlist->video_dilihat($row->id_video, $row->dilihat);
		$this->template->load('phpmu-one/template','phpmu-one/view_video_detail',$data);
	}
}
