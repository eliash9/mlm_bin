<?php 
class Model_iklan extends CI_model{
    function iklan_tengah(){
        return $this->db->query("SELECT * FROM iklantengah");
    }

    function iklan_tengah_tambah(){
    	$config['upload_path'] = 'asset/foto_iklan/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'username'=>$this->session->username,
	                        'url'=>$this->input->post('b'),
	                        'tgl_posting'=>date('Y-m-d'));
	    }else{
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'username'=>$this->session->username,
	                        'url'=>$this->input->post('b'),
	                        'gambar'=>$hasil['file_name'],
	                        'tgl_posting'=>date('Y-m-d'));
	    }
        $this->db->insert('iklantengah',$datadb);
    }

    function iklan_tengah_edit($id){
        return $this->db->query("SELECT * FROM iklantengah where id_iklantengah='$id'");
    }

    function iklan_tengah_update(){
    	$config['upload_path'] = 'asset/foto_iklan/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'username'=>$this->session->username,
	                        'url'=>$this->input->post('b'),
	                        'tgl_posting'=>date('Y-m-d'));
	    }else{
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'username'=>$this->session->username,
	                        'url'=>$this->input->post('b'),
	                        'gambar'=>$hasil['file_name'],
	                        'tgl_posting'=>date('Y-m-d'));
	    }
        $this->db->where('id_iklantengah',$this->input->post('id'));
        $this->db->update('iklantengah',$datadb);
    }

    function iklan_tengah_delete($id){
        return $this->db->query("DELETE FROM iklantengah where id_iklantengah='$id'");
    }



    function iklan_sidebar(){
        return $this->db->query("SELECT * FROM pasangiklan");
    }

    function iklan_sidebar_tambah(){
    	$config['upload_path'] = 'asset/foto_iklan/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'username'=>$this->session->username,
	                        'url'=>$this->input->post('b'),
	                        'tgl_posting'=>date('Y-m-d'));
	    }else{
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'username'=>$this->session->username,
	                        'url'=>$this->input->post('b'),
	                        'gambar'=>$hasil['file_name'],
	                        'tgl_posting'=>date('Y-m-d'));
	    }
        $this->db->insert('pasangiklan',$datadb);
    }

    function iklan_sidebar_edit($id){
        return $this->db->query("SELECT * FROM pasangiklan where id_pasangiklan='$id'");
    }

    function iklan_sidebar_update(){
    	$config['upload_path'] = 'asset/foto_iklan/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'username'=>$this->session->username,
	                        'url'=>$this->input->post('b'),
	                        'tgl_posting'=>date('Y-m-d'));
	    }else{
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'username'=>$this->session->username,
	                        'url'=>$this->input->post('b'),
	                        'gambar'=>$hasil['file_name'],
	                        'tgl_posting'=>date('Y-m-d'));
	    }
        $this->db->where('id_pasangiklan',$this->input->post('id'));
        $this->db->update('pasangiklan',$datadb);
    }

    function iklan_sidebar_delete($id){
        return $this->db->query("DELETE FROM pasangiklan where id_pasangiklan='$id'");
    }
}