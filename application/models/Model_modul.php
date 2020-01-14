<?php 
class Model_modul extends CI_model{
	function modul(){
		return $this->db->query("SELECT * FROM modul");
	}

    function users_modul(){
        return $this->db->query("SELECT * FROM modul");
    }

	function modul_tambah(){
        $datadb = array('nama_modul'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'link'=>$this->db->escape_str($this->input->post('b')),
                        'static_content'=>'',
                        'gambar'=>'',
                        'publish'=>$this->db->escape_str($this->input->post('c')),
                        'status'=>$this->db->escape_str($this->input->post('e')),
                        'aktif'=>$this->db->escape_str($this->input->post('d')),
                        'urutan'=>'0',
                        'link_seo'=>'');
        $this->db->insert('modul',$datadb);
    }

    function modul_update(){
        $datadb = array('nama_modul'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'link'=>$this->db->escape_str($this->input->post('b')),
                        'static_content'=>'',
                        'gambar'=>'',
                        'publish'=>$this->db->escape_str($this->input->post('c')),
                        'status'=>$this->db->escape_str($this->input->post('e')),
                        'aktif'=>$this->db->escape_str($this->input->post('d')),
                        'urutan'=>'0',
                        'link_seo'=>'');
        $this->db->where('id_modul',$this->input->post('id'));
        $this->db->update('modul',$datadb);
    }

    function modul_edit($id){
        return $this->db->query("SELECT * FROM modul where id_modul='$id'");
    }

    function modul_delete($id){
        return $this->db->query("DELETE FROM modul where id_modul='$id'");
    }

}