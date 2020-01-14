<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
			$username = $this->input->post('a');
			$password = hash("sha512", md5($this->input->post('b')));
			$cek = $this->db->query("SELECT * FROM users where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata('upload_image_file_manager',true);
				$this->session->set_userdata(array('username'=>$row['username'],
								   'level'=>$row['level'],
                                   'id_session'=>$row['id_session']));
				redirect('administrator/home');
			}else{
				$data['title'] = 'Administrator &rsaquo; Log In';
				$this->load->view('administrator/view_login',$data);
			}
		}else{
			$data['title'] = 'Administrator &rsaquo; Log In';
			$this->load->view('administrator/view_login',$data);
		}
	}

	function home(){
		$this->template->load('administrator/template','administrator/view_home');
	}

	function identitaswebsite(){
		cek_session_akses('identitaswebsite',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_main->identitas_update();
			redirect('administrator/identitaswebsite');
		}else{
			$data['record'] = $this->model_main->identitas()->row_array();
			$this->template->load('administrator/template','administrator/mod_identitas/view_identitas',$data);
		}
	}

	function keterangan(){
		cek_session_akses('keterangan',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_main->keterangan_update();
			redirect('administrator/keterangan');
		}else{
			$data['record'] = $this->model_main->keterangan()->row_array();
			$this->template->load('administrator/template','administrator/mod_keterangan/view_keterangan',$data);
		}
	}

	// Controller Modul Menu Website

	function menuwebsite(){
		cek_session_akses('menuwebsite',$this->session->id_session);
		$data['record'] = $this->model_menu->menu_website();
		$this->template->load('administrator/template','administrator/mod_menu/view_menu',$data);
	}

	function tambah_menuwebsite(){
		cek_session_akses('menuwebsite',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_menu->menu_website_tambah();
			redirect('administrator/menuwebsite');
		}else{
			$data['record'] = $this->model_menu->menu_utama();
			$this->template->load('administrator/template','administrator/mod_menu/view_menu_tambah',$data);
		}
	}

	function edit_menuwebsite(){
		cek_session_akses('menuwebsite',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_menu->menu_website_update();
			redirect('administrator/menuwebsite');
		}else{
			$data['record'] = $this->model_menu->menu_utama();
			$data['rows'] = $this->model_menu->menu_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_menu/view_menu_edit',$data);
		}
	}

	function delete_menuwebsite(){
		cek_session_akses('menuwebsite',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_menu->menu_delete($id);
		redirect('administrator/menuwebsite');
	}


	// Controller Modul Halaman Baru

	function halamanbaru(){
		cek_session_akses('halamanbaru',$this->session->id_session);
		$data['record'] = $this->model_halaman->halamanstatis();
		$this->template->load('administrator/template','administrator/mod_halaman/view_halaman',$data);
	}

	function tambah_halamanbaru(){
		cek_session_akses('halamanbaru',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_halaman->halamanstatis_tambah();
			redirect('administrator/halamanbaru');
		}else{
			$this->template->load('administrator/template','administrator/mod_halaman/view_halaman_tambah');
		}
	}

	function edit_halamanbaru(){
		cek_session_akses('halamanbaru',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_halaman->halamanstatis_update();
			redirect('administrator/halamanbaru');
		}else{
			$data['rows'] = $this->model_halaman->halamanstatis_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_halaman/view_halaman_edit',$data);
		}
	}

	function delete_halamanbaru(){
		cek_session_akses('halamanbaru',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_halaman->halamanstatis_delete($id);
		redirect('administrator/halamanbaru');
	}



	// Controller Modul Download

	function download(){
		cek_session_akses('download',$this->session->id_session);
		$data['record'] = $this->model_download->index();
		$this->template->load('administrator/template','administrator/mod_download/view_download',$data);
	}

	function tambah_download(){
		cek_session_akses('download',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_download->download_tambah();
			redirect('administrator/download');
		}else{
			$this->template->load('administrator/template','administrator/mod_download/view_download_tambah');
		}
	}

	function edit_download(){
		cek_session_akses('download',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_download->download_update();
			redirect('administrator/download');
		}else{
			$data['rows'] = $this->model_download->download_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_download/view_download_edit',$data);
		}
	}

	function delete_download(){
		cek_session_akses('download',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_download->download_delete($id);
		redirect('administrator/download');
	}




	// Controller Modul Image Slider

	function imagesslider(){
		cek_session_akses('imagesslider',$this->session->id_session);
		$data['record'] = $this->model_main->slide();
		$this->template->load('administrator/template','administrator/mod_slider/view_slider',$data);
	}

	function tambah_imagesslider(){
		cek_session_akses('imagesslider',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_main->slide_tambah();
			redirect('administrator/imagesslider');
		}else{
			$this->template->load('administrator/template','administrator/mod_slider/view_slider_tambah');
		}
	}

	function edit_imagesslider(){
		cek_session_akses('imagesslider',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_main->slide_update();
			redirect('administrator/imagesslider');
		}else{
			$data['rows'] = $this->model_main->slide_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_slider/view_slider_edit',$data);
		}
	}

	function delete_imagesslider(){
		cek_session_akses('imagesslider',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_main->slide_delete($id);
		redirect('administrator/imagesslider');
	}



	// Controller Modul Album

	function album(){
		cek_session_akses('album',$this->session->id_session);
		$data['record'] = $this->model_gallery->album();
		$this->template->load('administrator/template','administrator/mod_album/view_album',$data);
	}

	function tambah_album(){
		cek_session_akses('album',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_gallery->album_tambah();
			redirect('administrator/album');
		}else{
			$this->template->load('administrator/template','administrator/mod_album/view_album_tambah');
		}
	}

	function edit_album(){
		cek_session_akses('album',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_gallery->album_update();
			redirect('administrator/album');
		}else{
			$data['rows'] = $this->model_gallery->album_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_album/view_album_edit',$data);
		}
	}

	function delete_album(){
		cek_session_akses('album',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_gallery->album_delete($id);
		redirect('administrator/album');
	}


	// Controller Modul Gallery

	function gallery(){
		cek_session_akses('gallery',$this->session->id_session);
		$data['record'] = $this->model_gallery->gallery();
		$this->template->load('administrator/template','administrator/mod_gallery/view_gallery',$data);
	}

	function tambah_gallery(){
		cek_session_akses('gallery',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_gallery->gallery_tambah();
			redirect('administrator/gallery');
		}else{
			$data['row'] = $this->model_gallery->album();
			$this->template->load('administrator/template','administrator/mod_gallery/view_gallery_tambah',$data);
		}
	}

	function edit_gallery(){
		cek_session_akses('gallery',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_gallery->gallery_update();
			redirect('administrator/gallery');
		}else{
			$data['row'] = $this->model_gallery->album();
			$data['rows'] = $this->model_gallery->gallery_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_gallery/view_gallery_edit',$data);
		}
	}

	function delete_gallery(){
		cek_session_akses('gallery',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_gallery->gallery_delete($id);
		redirect('administrator/gallery');
	}


	// Controller Modul Playlist

	function playlist(){
		cek_session_akses('playlist',$this->session->id_session);
		$data['record'] = $this->model_playlist->playlist();
		$this->template->load('administrator/template','administrator/mod_playlist/view_playlist',$data);
	}

	function tambah_playlist(){
		cek_session_akses('playlist',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_playlist->playlist_tambah();
			redirect('administrator/playlist');
		}else{
			$this->template->load('administrator/template','administrator/mod_playlist/view_playlist_tambah');
		}
	}

	function edit_playlist(){
		cek_session_akses('playlist',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_playlist->playlist_update();
			redirect('administrator/playlist');
		}else{
			$data['rows'] = $this->model_playlist->playlist_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_playlist/view_playlist_edit',$data);
		}
	}

	function delete_playlist(){
		cek_session_akses('playlist',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_playlist->playlist_delete($id);
		redirect('administrator/playlist');
	}


	// Controller Modul Video

	function video(){
		cek_session_akses('video',$this->session->id_session);
		$data['record'] = $this->model_playlist->video();
		$this->template->load('administrator/template','administrator/mod_video/view_video',$data);
	}

	function tambah_video(){
		cek_session_akses('video',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_playlist->video_tambah();
			redirect('administrator/video');
		}else{
			$data['row'] = $this->model_playlist->playlist();
			$this->template->load('administrator/template','administrator/mod_video/view_video_tambah',$data);
		}
	}

	function edit_video(){
		cek_session_akses('video',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_playlist->video_update();
			redirect('administrator/video');
		}else{
			$data['row'] = $this->model_playlist->playlist();
			$data['rows'] = $this->model_playlist->video_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_video/view_video_edit',$data);
		}
	}

	function delete_video(){
		cek_session_akses('video',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_playlist->video_delete($id);
		redirect('administrator/video');
	}


	// Controller Modul Testimoni

	function testimoni(){
		cek_session_akses('testimoni',$this->session->id_session);
		$data['record'] = $this->model_testimoni->testimoni();
		$this->template->load('administrator/template','administrator/mod_testimoni/view_testimoni',$data);
	}

	function edit_testimoni(){
		cek_session_akses('testimoni',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_testimoni->testimoni_update();
			redirect('administrator/testimoni');
		}else{
			$data['rows'] = $this->model_testimoni->testimoni_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_testimoni/view_testimoni_edit',$data);
		}
	}

	function delete_testimoni(){
		cek_session_akses('testimoni',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_testimoni->testimoni_delete($id);
		redirect('administrator/testimoni');
	}


	// Controller Modul List Berita

	function listberita(){
		cek_session_akses('listberita',$this->session->id_session);
		$data['record'] = $this->model_berita->list_berita();
		$this->template->load('administrator/template','administrator/mod_berita/view_berita',$data);
	}

	function tambah_listberita(){
		cek_session_akses('listberita',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_berita->list_berita_tambah();
			redirect('administrator/listberita');
		}else{
			$data['tag'] = $this->model_berita->tag_berita();
			$data['record'] = $this->model_berita->kategori_berita();
			$this->template->load('administrator/template','administrator/mod_berita/view_berita_tambah',$data);
		}
	}

	function cepat_listberita(){
		cek_session_akses('listberita',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_berita->list_berita_cepat();
			redirect('administrator/listberita');
		}else{
			redirect('administrator/listberita');
		}
	}

	function edit_listberita(){
		cek_session_akses('listberita',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_berita->list_berita_update();
			redirect('administrator/listberita');
		}else{
			$data['tag'] = $this->model_berita->tag_berita();
			$data['record'] = $this->model_berita->kategori_berita();
			$data['rows'] = $this->model_berita->list_berita_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_berita/view_berita_edit',$data);
		}
	}

	function delete_listberita(){
		cek_session_akses('listberita',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_berita->list_berita_delete($id);
		redirect('administrator/listberita');
	}


	// Controller Modul Kategori Berita

	function kategoriberita(){
		cek_session_akses('kategoriberita',$this->session->id_session);
		$data['record'] = $this->model_berita->kategori_berita();
		$this->template->load('administrator/template','administrator/mod_kategori/view_kategori',$data);
	}

	function tambah_kategoriberita(){
		cek_session_akses('kategoriberita',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_berita->kategori_berita_tambah();
			redirect('administrator/kategoriberita');
		}else{
			$this->template->load('administrator/template','administrator/mod_kategori/view_kategori_tambah');
		}
	}

	function edit_kategoriberita(){
		cek_session_akses('kategoriberita',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_berita->kategori_berita_update();
			redirect('administrator/kategoriberita');
		}else{
			$data['rows'] = $this->model_berita->kategori_berita_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_kategori/view_kategori_edit',$data);
		}
	}

	function delete_kategoriberita(){
		cek_session_akses('kategoriberita',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_berita->kategori_berita_delete($id);
		redirect('administrator/kategoriberita');
	}



	// Controller Modul Tag Berita

	function tagberita(){
		cek_session_akses('tagberita',$this->session->id_session);
		$data['record'] = $this->model_berita->tag_berita();
		$this->template->load('administrator/template','administrator/mod_tag/view_tag',$data);
	}

	function tambah_tagberita(){
		cek_session_akses('tagberita',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_berita->tag_berita_tambah();
			redirect('administrator/tagberita');
		}else{
			$this->template->load('administrator/template','administrator/mod_tag/view_tag_tambah');
		}
	}

	function edit_tagberita(){
		cek_session_akses('tagberita',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_berita->tag_berita_update();
			redirect('administrator/tagberita');
		}else{
			$data['rows'] = $this->model_berita->tag_berita_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_tag/view_tag_edit',$data);
		}
	}

	function delete_tagberita(){
		cek_session_akses('tagberita',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_berita->tag_berita_delete($id);
		redirect('administrator/tagberita');
	}



	// Controller Modul Iklan Home

	function iklanhome(){
		cek_session_akses('iklanhome',$this->session->id_session);
		$data['record'] = $this->model_iklan->iklan_tengah();
		$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome',$data);
	}

	function tambah_iklanhome(){
		cek_session_akses('iklanhome',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_iklan->iklan_tengah_tambah();
			redirect('administrator/iklanhome');
		}else{
			$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome_tambah');
		}
	}

	function edit_iklanhome(){
		cek_session_akses('iklanhome',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_iklan->iklan_tengah_update();
			redirect('administrator/iklanhome');
		}else{
			$data['rows'] = $this->model_iklan->iklan_tengah_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome_edit',$data);
		}
	}

	function delete_iklanhome(){
		cek_session_akses('iklanhome',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_iklan->iklan_tengah_delete($id);
		redirect('administrator/iklanhome');
	}



	// Controller Modul Iklan Sidebar

	function iklansidebar(){
		cek_session_akses('iklansidebar',$this->session->id_session);
		$data['record'] = $this->model_iklan->iklan_sidebar();
		$this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar',$data);
	}

	function tambah_iklansidebar(){
		cek_session_akses('iklansidebar',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_iklan->iklan_sidebar_tambah();
			redirect('administrator/iklansidebar');
		}else{
			$this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar_tambah');
		}
	}

	function edit_iklansidebar(){
		cek_session_akses('iklansidebar',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_iklan->iklan_sidebar_update();
			redirect('administrator/iklansidebar');
		}else{
			$data['rows'] = $this->model_iklan->iklan_sidebar_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar_edit',$data);
		}
	}

	function delete_iklansidebar(){
		cek_session_akses('iklansidebar',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_iklan->iklan_sidebar_delete($id);
		redirect('administrator/iklansidebar');
	}



	// Controller Modul Logo

	function logowebsite(){
		cek_session_akses('logowebsite',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_main->logo_update();
			redirect('administrator/logowebsite');
		}else{
			$data['record'] = $this->model_main->logo();
			$this->template->load('administrator/template','administrator/mod_logowebsite/view_logowebsite',$data);
		}
	}


	// Controller Modul Template Website

	function templatewebsite(){
		cek_session_akses('templatewebsite',$this->session->id_session);
		$data['record'] = $this->model_main->template();
		$this->template->load('administrator/template','administrator/mod_template/view_template',$data);
	}

	function tambah_templatewebsite(){
		cek_session_akses('templatewebsite',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_main->template_tambah();
			redirect('administrator/templatewebsite');
		}else{
			$this->template->load('administrator/template','administrator/mod_template/view_template_tambah');
		}
	}

	function edit_templatewebsite(){
		cek_session_akses('templatewebsite',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_main->template_update();
			redirect('administrator/templatewebsite');
		}else{
			$data['rows'] = $this->model_main->template_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_template/view_template_edit',$data);
		}
	}

	function delete_templatewebsite(){
		cek_session_akses('templatewebsite',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_main->template_delete($id);
		redirect('administrator/templatewebsite');
	}




	// Controller Modul Agenda

	function agenda(){
		cek_session_akses('agenda',$this->session->id_session);
		$data['record'] = $this->model_agenda->agenda();
		$this->template->load('administrator/template','administrator/mod_agenda/view_agenda',$data);
	}

	function tambah_agenda(){
		cek_session_akses('agenda',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_agenda->agenda_tambah();
			redirect('administrator/agenda');
		}else{
			$this->template->load('administrator/template','administrator/mod_agenda/view_agenda_tambah');
		}
	}

	function edit_agenda(){
		cek_session_akses('agenda',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_agenda->agenda_update();
			redirect('administrator/agenda');
		}else{
			$data['rows'] = $this->model_agenda->agenda_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_agenda/view_agenda_edit',$data);
		}
	}

	function delete_agenda(){
		cek_session_akses('agenda',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_agenda->agenda_delete($id);
		redirect('administrator/agenda');
	}




	// Controller Modul YM

	function ym(){
		cek_session_akses('ym',$this->session->id_session);
		$data['record'] = $this->model_main->ym();
		$this->template->load('administrator/template','administrator/mod_ym/view_ym',$data);
	}

	function tambah_ym(){
		cek_session_akses('ym',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_main->ym_tambah();
			redirect('administrator/ym');
		}else{
			$this->template->load('administrator/template','administrator/mod_ym/view_ym_tambah');
		}
	}

	function edit_ym(){
		cek_session_akses('ym',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_main->ym_update();
			redirect('administrator/ym');
		}else{
			$data['rows'] = $this->model_main->ym_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_ym/view_ym_edit',$data);
		}
	}

	function delete_ym(){
		cek_session_akses('ym',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_main->ym_delete($id);
		redirect('administrator/ym');
	}




	// Controller Modul Pesan Masuk

	function pesanmasuk(){
		cek_session_akses('pesanmasuk',$this->session->id_session);
		$data['record'] = $this->model_main->pesan_masuk();
		$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk',$data);
	}

	function detail_pesanmasuk(){
		cek_session_akses('pesanmasuk',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->db->query("UPDATE hubungi SET dibaca='Y' where id_hubungi='$id'");
		if (isset($_POST['submit'])){
			$this->model_main->pesan_masuk_kirim();
			$data['rows'] = $this->model_main->pesan_masuk_view($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk_detail',$data);
		}else{
			$data['rows'] = $this->model_main->pesan_masuk_view($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk_detail',$data);
		}
	}




	// Controller Modul User

	function manajemenuser(){
		cek_session_akses('manajemenuser',$this->session->id_session);
		$data['record'] = $this->model_app->view_ordering('users','username','DESC');
		$this->template->load('administrator/template','administrator/mod_users/view_users',$data);
	}

	function tambah_manajemenuser(){
		cek_session_akses('manajemenuser',$this->session->id_session);
		$id = $this->session->username;
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>'N',
                                    'id_session'=>md5($this->input->post('a')).'-'.date('YmdHis'));
            }else{
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>'N',
                                    'id_session'=>md5($this->input->post('a')).'-'.date('YmdHis'));
            }
            $this->model_app->insert('users',$data);

              $mod=count($this->input->post('modul'));
              $modul=$this->input->post('modul');
              $sess = md5($this->input->post('a')).'-'.date('YmdHis');
              for($i=0;$i<$mod;$i++){
                $datam = array('id_session'=>$sess,
                              'id_modul'=>$modul[$i]);
                $this->model_app->insert('users_modul',$datam);
              }

			redirect('administrator/edit_manajemenuser/'.$this->input->post('a'));
		}else{
            $proses = $this->model_app->view_where_ordering('modul', array('publish' => 'Y','status' => 'user'), 'id_modul','DESC');
            $data = array('record' => $proses);
			$this->template->load('administrator/template','administrator/mod_users/view_users_tambah',$data);
		}
	}

	function edit_manajemenuser(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']=='' AND $this->input->post('b') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']=='' AND $this->input->post('b') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }
            $where = array('username' => $this->input->post('id'));
            $this->model_app->update('users', $data, $where);

              $mod=count($this->input->post('modul'));
              $modul=$this->input->post('modul');
              for($i=0;$i<$mod;$i++){
                $datam = array('id_session'=>$this->input->post('ids'),
                              'id_modul'=>$modul[$i]);
                $this->model_app->insert('users_modul',$datam);
              }

			redirect('administrator/edit_manajemenuser/'.$this->input->post('id'));
		}else{
            if ($this->session->username==$this->uri->segment(3) OR $this->session->level=='admin'){
                $proses = $this->model_app->edit('users', array('username' => $id))->row_array();
                $akses = $this->model_app->view_join_where('users_modul','modul','id_modul', array('id_session' => $proses['id_session']),'id_umod','DESC');
                $modul = $this->model_app->view_where_ordering('modul', array('publish' => 'Y','status' => 'user'), 'id_modul','DESC');
                $data = array('rows' => $proses, 'record' => $modul, 'akses' => $akses);
    			$this->template->load('administrator/template','administrator/mod_users/view_users_edit',$data);
            }else{
                redirect('administrator/edit_manajemenuser/'.$this->session->username);
            }
		}
	}

	function delete_manajemenuser(){
        cek_session_akses('manajemenuser',$this->session->id_session);
		$id = array('username' => $this->uri->segment(3));
        $this->model_app->delete('users',$id);
		redirect('administrator/manajemenuser');
	}

    function delete_akses(){
        cek_session_admin();
        $id = array('id_umod' => $this->uri->segment(3));
        $this->model_app->delete('users_modul',$id);
        redirect('administrator/edit_manajemenuser/'.$this->uri->segment(4));
    }

	


	// Controller Modul Modul

	function manajemenmodul(){
		cek_session_akses('manajemenmodul',$this->session->id_session);
		$data['record'] = $this->model_modul->modul();
		$this->template->load('administrator/template','administrator/mod_modul/view_modul',$data);
	}

	function tambah_manajemenmodul(){
		cek_session_akses('manajemenmodul',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_modul->modul_tambah();
			redirect('administrator/manajemenmodul');
		}else{
			$this->template->load('administrator/template','administrator/mod_modul/view_modul_tambah');
		}
	}

	function edit_manajemenmodul(){
		cek_session_akses('manajemenmodul',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_modul->modul_update();
			redirect('administrator/manajemenmodul');
		}else{
			$data['rows'] = $this->model_modul->modul_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_modul/view_modul_edit',$data);
		}
	}

	function delete_manajemenmodul(){
		cek_session_akses('manajemenmodul',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_modul->modul_delete($id);
		redirect('administrator/manajemenmodul');
	}



	// Controller Modul keuangan


	function rekapkeuangan(){
		cek_session_akses('rekapkeuangan',$this->session->id_session);
		$data['record'] = $this->model_members->konsumen();
		$this->template->load('administrator/template','administrator/mod_keuangan/view_keuangan',$data);
	}

	function exportexcel(){
		cek_session_akses('rekapkeuangan',$this->session->id_session);
		$data['record'] = $this->model_members->konsumen();
		$this->load->view('administrator/mod_keuangan/export_excel',$data);
	}

	function bayarrekapkeuangan(){
		cek_session_akses('rekapkeuangan',$this->session->id_session);
		$tot = $this->model_members->totbonus($this->uri->segment(3))->row_array();
		$cair = $this->model_members->totpencairan($this->uri->segment(3))->row_array();

		$totpens = $this->model_members->totpencairans($this->uri->segment(3))->row_array();
        $totbons = $this->model_members->totbonuss($this->uri->segment(3))->row_array();

		$ppn = 10/100*(($tot['nominal']-$cair['nominal_bayar'])+($totbons['nominal']-$totpens['nominal_bayar']));
		$totalbonusbersih = (($tot['nominal']-$cair['nominal_bayar'])+($totbons['nominal']-$totpens['nominal_bayar']))-$ppn;
		
		$total = $tot['nominal']-$cair['nominal_bayar'];
		$totals = $totbons['nominal']-$totpens['nominal_bayar'];

        if ($totalbonusbersih > 1){
	        $datadb = array('username'=>$this->uri->segment(3),
	                        'nominal_bayar'=>$total,
	                        'bonus_sponsor'=>$totals,
	                        'waktu_bayar'=>date('Y-m-d'));
	        $this->db->insert('rb_pembayaran_bonus',$datadb);
	    }

        redirect('administrator/rekapkeuangan');
	}

	function bonushistory(){
		cek_session_akses('bonushistory',$this->session->id_session);
		$data['record'] = $this->model_members->bonushistory();
		$this->template->load('administrator/template','administrator/mod_keuangan/view_bonus_history',$data);
	}

	function bonushistory_delete(){
		cek_session_akses('bonushistory',$this->session->id_session);
		$this->model_members->bonushistory_delete($id);
		redirect('administrator/bonushistory');
	}

	function keuanganbayarmanual(){
		cek_session_akses('rekapkeuangan',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_members->keuanganbayarmanual_tambah();
			redirect('administrator/rekapkeuangan');
		}else{
			$this->template->load('administrator/template','administrator/mod_keuangan/view_keuangan_bayar');
		}
	}


	// Controller Modul Konsumen

	function konsumen(){
		cek_session_akses('konsumen',$this->session->id_session);
		$data['record'] = $this->model_members->konsumen();
		$this->template->load('administrator/template','administrator/mod_konsumen/view_konsumen',$data);
	}

	function tambah_konsumen(){
		cek_session_akses('konsumen',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_members->konsumen_tambah();
			redirect('administrator/konsumen');
		}else{
			$data['record'] = $this->model_members->paket();
			$this->template->load('administrator/template','administrator/mod_konsumen/view_konsumen_tambah',$data);
		}
	}

	function edit_konsumen(){
		cek_session_akses('konsumen',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_members->konsumen_update($id);
			redirect('administrator/konsumen');
		}else{
			$data['rows'] = $this->model_members->profile_view($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_konsumen/view_konsumen_edit',$data);
		}
	}

	
	function detail_konsumen(){
		cek_session_akses('konsumen',$this->session->id_session);
		$id = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen='$id'")->row_array();
		$set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();

		$idk = $dat['username'];
		$data['idk'] = $dat['username'];
		$data['rows'] = $this->model_members->profile_view($id)->row_array();
		$data['bon'] = $this->model_members->bonus_detail($idk);
		$data['totpen'] = $this->model_members->totpencairan($idk)->row_array();
		$data['totbon'] = $this->model_members->totbonus($idk)->row_array();
		$data['record'] = $this->model_members->pencairan_detail($idk);
		$this->template->load('administrator/template','administrator/mod_konsumen/view_konsumen_detail',$data);
	}

	function delete_konsumen(){
		cek_session_akses('konsumen',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_members->konsumen_delete($id);
		redirect('administrator/koderahasia');
	}

	function koderahasia(){
		cek_session_akses('koderahasia',$this->session->id_session);
		if (isset($_POST['submit'])){
			$kode = $this->input->post('kode');
			$this->model_members->kode_konsumen_tambah();
			redirect('administrator/koderahasia');
		}else{
			$data['record'] = $this->model_members->kode_konsumen();
			$this->template->load('administrator/template','administrator/mod_konsumen/view_kode',$data);
		}
	}

	function orderkode(){
		cek_session_akses('orderkode',$this->session->id_session);
		$data['record'] = $this->model_members->orderkode();
		$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkode',$data);
	}

	function orderkodekonsumen(){
		cek_session_akses('orderkodekonsumen',$this->session->id_session);
		$data['record'] = $this->model_members->konsumen_orderkode();
		$data['title']  = 'Pesanan Kode Aktivasi Dari Konsumen.';
		$data['level']  = 'konsumen';
		$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkodekonsumen',$data);
	}


	function kirim_orderkodekonsumen(){
		cek_session_akses('orderkodekonsumen',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_members->kode_konsumen_insert();
			redirect('administrator/kirim_orderkodekonsumen/'.$this->input->post('id'));
		}else{
			$data['record'] = $this->model_members->konsumen_orderkode_terkirim($this->uri->segment(3));
			$this->template->load('administrator/template','administrator/mod_orderkode/view_orderkodekonsumen_kirim',$data);
		}
	}


	function delete_orderkode(){
		cek_session_akses('orderkode',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_members->orderkode_delete($id);
		redirect('administrator/orderkode');
	}

	function delete_orderkodekonsumen(){
		cek_session_akses('orderkodekonsumen',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_members->orderkodekonsumen_delete($id);
		redirect('administrator/kirim_orderkodekonsumen/'.$this->uri->segment(4));
	}


	// Controller Modul Produk

	function produk(){
		cek_session_akses('produk',$this->session->id_session);
		$data['record'] = $this->model_produk->produk();
		$this->template->load('administrator/template','administrator/mod_produk/view_produk',$data);
	}

	function tambah_produk(){
		cek_session_akses('produk',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_produk->produk_tambah();
			redirect('administrator/produk');
		}else{
			$this->template->load('administrator/template','administrator/mod_produk/view_produk_tambah');
		}
	}

	function edit_produk(){
		cek_session_akses('produk',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_produk->produk_update();
			redirect('administrator/produk');
		}else{
			$data['rows'] = $this->model_produk->produk_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_produk/view_produk_edit',$data);
		}
	}

	function delete_produk(){
		cek_session_akses('produk',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_produk->produk_delete($id);
		redirect('administrator/produk');
	}


	// Controller Modul Rekening

	function rekening(){
		cek_session_akses('rekening',$this->session->id_session);
		$data['record'] = $this->model_rekening->rekening();
		$this->template->load('administrator/template','administrator/mod_rekening/view_rekening',$data);
	}

	function tambah_rekening(){
		cek_session_akses('rekening',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_rekening->rekening_tambah();
			redirect('administrator/rekening');
		}else{
			$this->template->load('administrator/template','administrator/mod_rekening/view_rekening_tambah');
		}
	}

	function edit_rekening(){
		cek_session_akses('rekening',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_rekening->rekening_update();
			redirect('administrator/rekening');
		}else{
			$data['rows'] = $this->model_rekening->rekening_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_rekening/view_rekening_edit',$data);
		}
	}

	function delete_rekening(){
		cek_session_akses('rekening',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_rekening->rekening_delete($id);
		redirect('administrator/rekening');
	}


	// Controller Modul Setting Bonus

	function settingbonus(){
		cek_session_akses('settingbonus',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_main->settingbonus_update();
			redirect('administrator/settingbonus');
		}else{
			$data['record'] = $this->model_main->settingbonus()->row_array();
			$this->template->load('administrator/template','administrator/mod_settingbonus/view_settingbonus',$data);
		}
	}

	function tabungan(){
		cek_session_admin();
		$data['record'] = $this->model_members->tabungan();
		$this->template->load('administrator/template','administrator/mod_tabungan/view_tabungan',$data);
	}

	function bayartabungan(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$cek = $this->db->query("SELECT * FROM rb_konsumen where username='".$this->input->post('a')."'")->num_rows();
			if ($cek >= 1){
				$this->model_members->bayar_tabungan();
				redirect('administrator/tabungan');
			}else{
				echo "<script>window.alert('Maaf, Data Konsumen Tidak Ditemukan!');
                                  window.location=('".base_url()."administrator/tabungan')</script>";
			}
			
		}else{
			$this->template->load('administrator/template','administrator/mod_tabungan/view_tabungan_bayar');
		}
	}

	function edittabungan(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_members->tabungan_update();
			redirect('administrator/tabungan');
		}else{
			$data['rows'] = $this->model_members->tabungan_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_tabungan/view_tabungan_edit',$data);
		}
	}

	function deletetabungan(){
		$id = $this->uri->segment(3);
		$this->model_members->tabungan_delete($id);
		redirect('administrator/tabungan');
	}


	function logout(){
		$this->session->sess_destroy();
		redirect('main');
	}
}
