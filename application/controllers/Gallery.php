<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends CI_Controller {
	public function index(){
		$jumlah= $this->model_gallery->hitung_album()->num_rows();
		$config['base_url'] = base_url().'gallery/index';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}
		if (is_numeric($dari)) {
			$data['record'] = $this->model_gallery->public_album($config['per_page'], $dari);
		}else{
			redirect('gallery');
		}
		$this->pagination->initialize($config);
		$data['title'] = 'Gallery Foto';
		$this->template->load('phpmu-one/template','phpmu-one/view_gallery',$data);
	}

	function detail(){
		$row = $this->db->query("SELECT id_album, jdl_album, keterangan, hits_album FROM album where album_seo='".$this->uri->segment(3)."'")->row();
		$data['record'] = $this->model_gallery->public_gallery($row->id_album);
		$this->pagination->initialize($config);
		$data['title'] = $row->jdl_album;
		$data['rows'] = $this->db->query("SELECT * FROM album where album_seo='".$this->uri->segment(3)."'")->row_array();
		$this->model_gallery->album_dilihat($row->id_album, $row->hits_album);
		$this->template->load('phpmu-one/template','phpmu-one/view_gallery_detail',$data);
	}
}
