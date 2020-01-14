<?php 
class Model_users extends CI_model{
	function users(){
		return $this->db->query("SELECT * FROM users");
	}

	function users_tambah(){
        $config['upload_path'] = 'asset/foto_user/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '1000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('f');
        $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')),
                                    'id_session'=>md5($this->input->post('a')));
            }else{
                    $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')),
                                    'id_session'=>md5($this->input->post('a')));
            }
        $this->db->insert('users',$datadb);
        $jml = $this->db->query("SELECT * FROM modul")->num_rows();
		    for ($i = 1; $i <= $jml; $i++){
		        $pilih = $this->input->post('i'.$i);
		        if ($pilih != ''){
			        $datamo = array('id_session'=>md5($this->input->post('a')),
		                            'id_modul'=>$pilih);
			        $this->db->insert('users_modul',$datamo);
			    }
		    }
    }

    function users_edit($id){
        return $this->db->query("SELECT * FROM users where username='$id'");
    }

    function users_update(){
        $config['upload_path'] = 'asset/foto_user/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '1000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('f');
        $hasil=$this->upload->data();
            if ($hasil['file_name']=='' AND $this->input->post('b') ==''){
                    $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') ==''){
                    $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']=='' AND $this->input->post('b') !=''){
                    $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') !=''){
                    $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }

        $this->db->where('username',$this->input->post('id'));
        $this->db->update('users',$datadb);
        $ids = $this->input->post('ids');
        $this->db->query("DELETE FROM users_modul where id_session='$ids'");
        $jml = $this->db->query("SELECT * FROM modul")->num_rows();
		    for ($i = 1; $i <= $jml; $i++){
		        $pilih = $this->input->post('i'.$i);
		        if ($pilih != ''){
			        $datamo = array('id_session'=>$this->input->post('ids'),
		                            'id_modul'=>$pilih);
			        $this->db->insert('users_modul',$datamo);
			    }
		    }
    }

    function users_delete($id){
        return $this->db->query("DELETE FROM users where username='$id'");
    }

}