<?php 
class Model_playlist extends CI_model{
    function playlist(){
        return $this->db->query("SELECT * FROM playlist ORDER BY id_playlist DESC");
    }

    function playlist_tambah(){
        $config['upload_path'] = 'asset/img_playlist/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('jdl_playlist'=>$this->db->escape_str($this->input->post('a')),
                            'username'=>$this->session->username,
                            'playlist_seo'=>seo_title($this->input->post('a')),
                            'aktif'=>'Y');
        }else{
            $datadb = array('jdl_playlist'=>$this->db->escape_str($this->input->post('a')),
                            'username'=>$this->session->username,
                            'playlist_seo'=>seo_title($this->input->post('a')),
                            'gbr_playlist'=>$hasil['file_name'],
                            'aktif'=>'Y');
        }
        $this->db->insert('playlist',$datadb);
    }

    function playlist_update(){
        $config['upload_path'] = 'asset/img_playlist/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('jdl_playlist'=>$this->db->escape_str($this->input->post('a')),
                            'username'=>$this->session->username,
                            'playlist_seo'=>seo_title($this->input->post('a')),
                            'aktif'=>$this->db->escape_str($this->input->post('f')));
        }else{
            $datadb = array('jdl_playlist'=>$this->db->escape_str($this->input->post('a')),
                            'username'=>$this->session->username,
                            'playlist_seo'=>seo_title($this->input->post('a')),
                            'gbr_playlist'=>$hasil['file_name'],
                            'aktif'=>$this->db->escape_str($this->input->post('f')));
        }
        $this->db->where('id_playlist',$this->input->post('id'));
        $this->db->update('playlist',$datadb);
    }

    function playlist_edit($id){
        return $this->db->query("SELECT * FROM playlist where id_playlist='$id'");
    }

    function playlist_delete($id){
        return $this->db->query("DELETE FROM playlist where id_playlist='$id'");
    }


    function video(){
        return $this->db->query("SELECT * FROM video a JOIN playlist b ON a.id_playlist=b.id_playlist ORDER BY a.id_video DESC");
    }

    function video_tambah(){
        $config['upload_path'] = 'asset/img_video/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('id_playlist'=>$this->input->post('aa'),
                            'username'=>$this->session->username,
                            'jdl_video'=>$this->input->post('a'),
                            'video_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'youtube'=>$this->input->post('d'),
                            'dilihat'=>'0',
                            'hari'=>hari_ini(date('w')),
                            'tanggal'=>date('Y-m-d'),
                            'jam'=>date('H:i:s'));
        }else{
            $datadb = array('id_playlist'=>$this->input->post('aa'),
                            'username'=>$this->session->username,
                            'jdl_video'=>$this->input->post('a'),
                            'video_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'gbr_video'=>$hasil['file_name'],
                            'youtube'=>$this->input->post('d'),
                            'dilihat'=>'0',
                            'hari'=>hari_ini(date('w')),
                            'tanggal'=>date('Y-m-d'),
                            'jam'=>date('H:i:s'));
        }
        $this->db->insert('video',$datadb);
    }

    function video_update(){
        $config['upload_path'] = 'asset/img_video/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('id_playlist'=>$this->input->post('aa'),
                            'username'=>$this->session->username,
                            'jdl_video'=>$this->input->post('a'),
                            'video_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'youtube'=>$this->input->post('d'));
        }else{
            $datadb = array('id_playlist'=>$this->input->post('aa'),
                            'username'=>$this->session->username,
                            'jdl_video'=>$this->input->post('a'),
                            'video_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'gbr_video'=>$hasil['file_name'],
                            'youtube'=>$this->input->post('d'));
        }
        $this->db->where('id_video',$this->input->post('id'));
        $this->db->update('video',$datadb);
    }

    function video_edit($id){
        return $this->db->query("SELECT * FROM video where id_video='$id'");
    }

    function video_delete($id){
        return $this->db->query("DELETE FROM video where id_video='$id'");
    }


    function public_video($sampai, $dari){
        return $this->db->query("SELECT * FROM video a JOIN playlist b ON a.id_playlist=b.id_playlist ORDER BY a.id_video DESC LIMIT $dari, $sampai");
    }

    function detail_video($id){
        return $this->db->query("SELECT * FROM video where id_video='$id'");
    }

    function hitung_video(){
        return $this->db->query("SELECT * FROM video");
    }

    function video_dilihat($id, $total){
        $totalupdate = $total+1;
        $datadb = array('dilihat'=>$totalupdate);
        $this->db->where('id_video',$id);
        $this->db->update('video',$datadb);
    }
}