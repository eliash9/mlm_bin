<?php 
class Model_agenda extends CI_model{
    function agenda_terbaru($limit){
        return $this->db->query("SELECT * FROM agenda ORDER BY id_agenda DESC LIMIT $limit");
    }

    function agenda_detail($id){
        return $this->db->query("SELECT * FROM agenda where id_agenda='".$this->db->escape_str($id)."' OR tema_seo='".$this->db->escape_str($id)."'");
    }

    function agenda_dibaca_update($id){
        return $this->db->query("UPDATE agenda SET dibaca=dibaca+1 where id_agenda='".$this->db->escape_str($id)."' OR tema_seo='".$this->db->escape_str($id)."'");
    }

    function agenda(){
        return $this->db->query("SELECT * FROM agenda ORDER BY id_agenda DESC");
    }

    function agenda_tambah(){
            $config['upload_path'] = 'asset/foto_agenda/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            $ex = explode(' - ',$this->input->post('f'));
            $exx = explode('/',$ex[0]);
            $exy = explode('/',$ex[1]);
            $mulai = $exx[2].'-'.$exx[0].'-'.$exx[1];
            $selesai = $exy[2].'-'.$exy[0].'-'.$exy[1];
            if ($hasil['file_name']==''){
                    $datadb = array('tema'=>$this->db->escape_str($this->input->post('a')),
                                    'tema_seo'=>seo_title($this->input->post('a')),
                                    'isi_agenda'=>$this->input->post('b'),
                                    'tempat'=>$this->db->escape_str($this->input->post('d')),
                                    'pengirim'=>$this->db->escape_str($this->input->post('g')),
                                    'tgl_mulai'=>$mulai,
                                    'tgl_selesai'=>$selesai,
                                    'tgl_posting'=>date('Y-m-d'),
                                    'jam'=>$this->db->escape_str($this->input->post('e')),
                                    'dibaca'=>'0',
                                    'username'=>$this->session->username);
            }else{
                    $datadb = array('tema'=>$this->db->escape_str($this->input->post('a')),
                                    'tema_seo'=>seo_title($this->input->post('a')),
                                    'isi_agenda'=>$this->input->post('b'),
                                    'tempat'=>$this->db->escape_str($this->input->post('d')),
                                    'pengirim'=>$this->db->escape_str($this->input->post('g')),
                                    'gambar'=>$hasil['file_name'],
                                    'tgl_mulai'=>$mulai,
                                    'tgl_selesai'=>$selesai,
                                    'tgl_posting'=>date('Y-m-d'),
                                    'jam'=>$this->db->escape_str($this->input->post('e')),
                                    'dibaca'=>'0',
                                    'username'=>$this->session->username);
            }
        $this->db->insert('agenda',$datadb);
    }

    function agenda_edit($id){
        return $this->db->query("SELECT * FROM agenda where id_agenda='$id'");
    }

    function agenda_update(){
            $config['upload_path'] = 'asset/foto_agenda/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            $ex = explode(' - ',$this->input->post('f'));
            $exx = explode('/',$ex[0]);
            $exy = explode('/',$ex[1]);
            $mulai = $exx[2].'-'.$exx[0].'-'.$exx[1];
            $selesai = $exy[2].'-'.$exy[0].'-'.$exy[1];
            if ($hasil['file_name']==''){
                    $datadb = array('tema'=>$this->db->escape_str($this->input->post('a')),
                                    'tema_seo'=>seo_title($this->input->post('a')),
                                    'isi_agenda'=>$this->input->post('b'),
                                    'tempat'=>$this->db->escape_str($this->input->post('d')),
                                    'pengirim'=>$this->db->escape_str($this->input->post('g')),
                                    'tgl_mulai'=>$mulai,
                                    'tgl_selesai'=>$selesai,
                                    'jam'=>$this->db->escape_str($this->input->post('e')),
                                    'dibaca'=>'0',
                                    'username'=>$this->session->username);
            }else{
                    $datadb = array('tema'=>$this->db->escape_str($this->input->post('a')),
                                    'tema_seo'=>seo_title($this->input->post('a')),
                                    'isi_agenda'=>$this->input->post('b'),
                                    'tempat'=>$this->db->escape_str($this->input->post('d')),
                                    'pengirim'=>$this->db->escape_str($this->input->post('g')),
                                    'gambar'=>$hasil['file_name'],
                                    'tgl_mulai'=>$mulai,
                                    'tgl_selesai'=>$selesai,
                                    'jam'=>$this->db->escape_str($this->input->post('e')),
                                    'dibaca'=>'0',
                                    'username'=>$this->session->username);
            }
        $this->db->where('id_agenda',$this->input->post('id'));
        $this->db->update('agenda',$datadb);
    }

    function agenda_delete($id){
        return $this->db->query("DELETE FROM agenda where id_agenda='$id'");
    }
}