<?php 
class Model_menu extends CI_model{
	function top_menu(){
		return $this->db->query("SELECT * FROM menu where position='Top' ORDER BY urutan ASC");
	}

    function bottom_menu(){
        return $this->db->query("SELECT * FROM menu where id_parent='0' AND position = 'Bottom' AND aktif='Ya' ORDER BY urutan ASC");
    }

    function dropdown_menu($id){
        return $this->db->query("SELECT * FROM menu WHERE id_parent='$id' AND aktif='Ya' ORDER BY urutan ASC");
    }

    function menu_website(){
		return $this->db->query("SELECT * FROM menu ORDER BY urutan");
	}

    function menu_utama(){
        return $this->db->query("SELECT * FROM menu where id_parent='0' ORDER BY urutan");
    }

    function menu_cek($id){
        return $this->db->query("SELECT * FROM menu where id_menu='$id'");
    }

    function menu_website_tambah(){
            $datadb = array('id_parent'=>$this->db->escape_str($this->input->post('b')),
                            'nama_menu'=>$this->db->escape_str($this->input->post('c')),
                            'link'=>$this->db->escape_str($this->input->post('a')),
                            'aktif'=>$this->db->escape_str('Ya'),
                            'position'=>$this->db->escape_str($this->input->post('d')),
                            'urutan'=>$this->db->escape_str($this->input->post('e')));
        $this->db->insert('menu',$datadb);
    }

    function menu_website_update(){
            $datadb = array('id_parent'=>$this->db->escape_str($this->input->post('b')),
                            'nama_menu'=>$this->db->escape_str($this->input->post('c')),
                            'link'=>$this->db->escape_str($this->input->post('a')),
                            'aktif'=>$this->db->escape_str($this->input->post('f')),
                            'position'=>$this->db->escape_str($this->input->post('d')),
                            'urutan'=>$this->db->escape_str($this->input->post('e')));
        $this->db->where('id_menu',$this->input->post('id'));
        $this->db->update('menu',$datadb);
    }

    function menu_edit($id){
        return $this->db->query("SELECT * FROM menu where id_menu='$id'");
    }

    function menu_delete($id){
        return $this->db->query("DELETE FROM menu where id_menu='$id'");
    }

}