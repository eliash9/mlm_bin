<?php 
class Model_main extends CI_model{
    function iklan_tengah(){
        return $this->db->query("SELECT * FROM iklantengah");
    }

    function iklan_sidebar(){
        return $this->db->query("SELECT * FROM pasangiklan");
    }

    function ym(){
        return $this->db->query("SELECT * FROM ym");
    }

    function logo(){
        return $this->db->query("SELECT * FROM logo");
    }

    function logo_update(){
        $config['upload_path'] = 'asset/images/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '2000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('logo');
        $hasil=$this->upload->data();
            $datadb = array('gambar'=>$hasil['file_name']);
        $this->db->where('id_logo',$this->input->post('id'));
        $this->db->update('logo',$datadb);
    }

    function template(){
        return $this->db->query("SELECT * FROM templates");
    }

    function template_tambah(){
        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'pembuat'=>$this->db->escape_str($this->input->post('b')),
                        'folder'=>$this->db->escape_str($this->input->post('c')),
                        'aktif'=>$this->db->escape_str($this->input->post('d')));
        $this->db->insert('templates',$datadb);
    }

    function template_update(){
        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'pembuat'=>$this->db->escape_str($this->input->post('b')),
                        'folder'=>$this->db->escape_str($this->input->post('c')),
                        'aktif'=>$this->db->escape_str($this->input->post('d')));
        $this->db->where('id_templates',$this->input->post('id'));
        $this->db->update('templates',$datadb);
    }

    function template_edit($id){
        return $this->db->query("SELECT * FROM templates where id_templates='$id'");
    }

    function template_delete($id){
        return $this->db->query("DELETE FROM templates where id_templates='$id'");
    }



    function slide(){
        return $this->db->query("SELECT * FROM slide ORDER BY id_slide DESC");
    }

    function slide_tambah(){
        $config['upload_path'] = 'asset/foto_slide/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('keterangan'=>$this->db->escape_str($this->input->post('a')),
                            'waktu'=>date('Y-m-d H:i:s'));
        }else{
            $datadb = array('keterangan'=>$this->db->escape_str($this->input->post('a')),
                            'gambar'=>$hasil['file_name'],
                            'waktu'=>date('Y-m-d H:i:s'));
        }
        $this->db->insert('slide',$datadb);
    }

    function slide_update(){
        $config['upload_path'] = 'asset/foto_slide/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('keterangan'=>$this->db->escape_str($this->input->post('a')));
        }else{
            $datadb = array('keterangan'=>$this->db->escape_str($this->input->post('a')),
                            'gambar'=>$hasil['file_name']);
        }
        $this->db->where('id_slide',$this->input->post('id'));
        $this->db->update('slide',$datadb);
    }

    function slide_edit($id){
        return $this->db->query("SELECT * FROM slide where id_slide='$id'");
    }

    function slide_delete($id){
        return $this->db->query("DELETE FROM slide where id_slide='$id'");
    }


    function identitas(){
        return $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1");
    }

    function identitas_update(){
            $config['upload_path'] = 'asset/images/';
            $config['allowed_types'] = 'gif|jpg|png|ico';
            $config['max_size'] = '500'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('i');
            $hasil=$this->upload->data();

            if ($hasil['file_name']==''){
                    $datadb = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                    'email'=>$this->db->escape_str($this->input->post('b')),
                                    'url'=>$this->db->escape_str($this->input->post('c')),
                                    'facebook'=>$this->db->escape_str($this->input->post('d')),
                                    'rekening'=>$this->db->escape_str($this->input->post('e')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('f')),
                                    'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                                    'meta_deskripsi'=>$this->db->escape_str($this->input->post('g')),
                                    'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                                    'maps'=>$this->db->escape_str($this->input->post('j')));
            }else{
                    $datadb = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                    'email'=>$this->db->escape_str($this->input->post('b')),
                                    'url'=>$this->db->escape_str($this->input->post('c')),
                                    'facebook'=>$this->db->escape_str($this->input->post('d')),
                                    'rekening'=>$this->db->escape_str($this->input->post('e')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('f')),
                                    'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                                    'meta_deskripsi'=>$this->db->escape_str($this->input->post('g')),
                                    'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                                    'favicon'=>$hasil['file_name'],
                                    'maps'=>$this->db->escape_str($this->input->post('j')));
            }
            $this->db->where('id_identitas',1);
            $this->db->update('identitas',$datadb);
    }

    function keterangan(){
        return $this->db->query("SELECT * FROM rb_keterangan ORDER BY id_keterangan DESC LIMIT 1");
    }

    function keterangan_update(){
        $datadb = array('keterangan'=>$this->input->post('a'),
                        'tanggal_posting'=>date('Y-m-d'));
        $this->db->where('id_keterangan',1);
        $this->db->update('rb_keterangan',$datadb);
    }

    function settingbonus(){
        return $this->db->query("SELECT * FROM rb_setting where aktif='Y' ORDER BY id_setting DESC LIMIT 1");
    }

    function settingbonus_update(){
                    $datadb = array('level_1'=>$this->db->escape_str($this->input->post('a')),
                                    'level_2'=>$this->db->escape_str($this->input->post('b')),
                                    'bonus_sponsor'=>$this->db->escape_str($this->input->post('bb')),
                                    'harga_pin'=>$this->db->escape_str($this->input->post('c')),
                                    'ppn'=>$this->db->escape_str($this->input->post('d')));
            $this->db->where('id_setting',$this->input->post('id'));
            $this->db->update('rb_setting',$datadb);
    }

    function pesan_masuk(){
        return $this->db->query("SELECT * FROM hubungi ORDER BY id_hubungi DESC");
    }

    function pesan_baru($limit){
        return $this->db->query("SELECT * FROM hubungi ORDER BY id_hubungi DESC LIMIT $limit");
    }

    function pesan_masuk_view($id){
        return $this->db->query("SELECT * FROM hubungi where id_hubungi='$id'");
    }

    function pesan_masuk_kirim(){
        $nama           = $this->input->post('a');
        $email           = $this->input->post('b');
        $subject         = $this->input->post('c');
        $message         = $this->input->post('isi')." <br><hr><br> ".$this->input->post('d');
        
        $this->email->from('robby.prihandaya@gmail.com', 'PHPMU.COM');
        $this->email->to($email);
        $this->email->cc('');
        $this->email->bcc('');

        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype("html");
        $this->email->send();
        
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

    }

    function grafik_kunjungan(){
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
    }

    function kunjungan(){
        $ip      = $_SERVER['REMOTE_ADDR'];
        $tanggal = date("Y-m-d");
        $waktu   = time(); 
        $cekk = $this->db->query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
        $rowh = $cekk->row_array();
        if($cekk->num_rows() == 0){
            $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>'1', 'online'=>$waktu);
            $this->db->insert('statistik',$datadb);
        }else{
            $hitss = $rowh['hits'] + 1;
            $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>$hitss, 'online'=>$waktu);
            $array = array('ip' => $ip, 'tanggal' => $tanggal);
            $this->db->where($array);
            $this->db->update('statistik',$datadb);
        }
    }

    function kirim_Pesan(){
        $nama           = $this->input->post('a');
        $email           = $this->input->post('b');
        $subjek         = $this->input->post('c');
        $pesan         = $this->input->post('d');
            $datadb = array('nama'=>$nama,
                            'email'=>$email,
                            'subjek'=>$subjek,
                            'pesan'=>$pesan,
                            'tanggal'=>date('Y-m-d'),
                            'jam'=>date('H:i:s'),
                            'dibaca'=>'N');
        $this->db->insert('hubungi',$datadb);
    }

    function ym_tambah(){
        $datadb = array('nama'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->db->escape_str($this->input->post('b')),
                        'ym_icon'=>seo_title($this->input->post('c')));
        $this->db->insert('ym',$datadb);
    }

    function ym_edit($id){
        return $this->db->query("SELECT * FROM ym where id='$id'");
    }

    function ym_update(){
        $datadb = array('nama'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->db->escape_str($this->input->post('b')),
                        'ym_icon'=>seo_title($this->input->post('c')));
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('ym',$datadb);
    }

    function ym_delete($id){
        return $this->db->query("DELETE FROM ym where id='$id'");
    }
}