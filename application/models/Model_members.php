<?php 
class Model_members extends CI_model{
    function jaringan($username){
        return $this->db->query("SELECT * FROM rb_konsumen WHERE username='$username'");
    }
    
    function totalkonsumen($username){
        return $this->db->query("SELECT * FROM rb_konsumen where username='$username'");
    }

    function bonushistory(){
        return $this->db->query("SELECT * FROM rb_pembayaran_bonus ORDER BY id_pembayaran_bonus DESC");
    }

    function konsumen_orderkode(){
        return $this->db->query("SELECT a.*, c.nama_lengkap as nama_lengkap FROM rb_order_kode_konsumen a 
                                      JOIN rb_konsumen c ON a.id_konsumen=c.id_konsumen where a.status='konsumen'
                                        ORDER BY a.id_order_kode_konsumen DESC");
    }

    function konsumen_orderkode_terkirim($ido){
        return $this->db->query("SELECT z.id_order_kode_kirim, z.kode_aktivasi, z.waktu_kirim FROM rb_order_kode_kirim z JOIN rb_order_kode_konsumen a ON z.id_order_kode_konsumen=a.id_order_kode_konsumen
                                    where z.id_order_kode_konsumen='$ido' AND a.status='konsumen'");
    }

    function orderkodekonsumen($idk, $sampai, $dari){
        return $this->db->query("SELECT * FROM rb_order_kode_konsumen where id_konsumen='$idk' AND status='konsumen' ORDER BY id_order_kode_konsumen DESC LIMIT $dari, $sampai");
    }

    function hitung_orderkodekonsumen($idk){
        return $this->db->query("SELECT * FROM rb_order_kode_konsumen where id_konsumen='$idk' AND status='konsumen'");
    }

    function insert_orderkodekonsumen($idk,$harga){
        $datadb = array('id_konsumen'=>$idk,
                        'jumlah'=>$this->input->post('b'),
                        'harga'=>$harga,
                        'keterangan'=>$this->input->post('c'),
                        'status'=>'konsumen',
                        'waktu_order'=>date('Y-m-d H:i:s'));
        $this->db->insert('rb_order_kode_konsumen',$datadb);

                $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
                $identitas = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
                $idm = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen='$idk'")->row_array();

                $harga = $this->input->post('b') * $set['harga_pin'];
                $tglaktif = date("d-m-Y H:i:s");
                $subject      = 'Pemesanan Kode Aktivasi ...';
                $message      = "<html><body>Halooo! <b>".strip_tags($this->input->post('a'))."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> $idm[nama_lengkap] memesan PIN Aktivasi di $identitas[nama_website],..
                    <table style='width:100%; margin-left:25px'>
                        <tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Informasi Anda : </b></td></tr>
                        <tr><td><b>Jumlah Pin</b></td>          <td> : ".strip_tags($this->input->post('b'))." Pin * $set[harga_pin]</td></tr>

                        <tr><td><b>Nama Lengkap</b></td>        <td> : $idm[nama_lengkap]</td></tr>
                        <tr><td><b>Alamat Email</b></td>        <td> : $idm[email]</td></tr>
                        <tr><td><b>No Handphone</b></td>        <td> : $idm[no_hp]</td></tr>
                        <tr><td><b>Alamat</b></td>              <td> : $idm[alamat_lengkap]</td></tr>

                        <tr><td colspan='2'>Total Harga : <b style='color:red'>Rp ".rupiah($harga)." </b>
                                            <br>Silahkan Cek $identitas[url]..</td></tr>
                    </table><br>
                    </body></html> \n";
                
                $this->email->from($idm['email'], 'Pemesanan Kode Aktivasi...');
                $this->email->to($identitas['email']);
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

    function kode_konsumen_insert(){
        for ($i = 1; $i <= $this->input->post('a'); $i++){
            $kode=acakangkahuruf(8);
            $datadb = array('kode_konsumen'=>$kode);
            $this->db->insert('rb_konsumen',$datadb);

            $datadbb = array('id_order_kode_konsumen' => $this->input->post('id'),
                            'kode_aktivasi'=>$kode,
                            'waktu_kirim'=>date('Y-m-d H:i:s'));
            $this->db->insert('rb_order_kode_kirim',$datadbb);
        }
    }

    function orderkodekonsumen_delete($id){
        return $this->db->query("DELETE FROM rb_order_kode_kirim where id_order_kode_kirim='$id'");
    }

    function bonushistory_delete($id){
        return $this->db->query("DELETE FROM rb_pembayaran_bonus where id_pembayaran_bonus='$id'");
    }

    function rekening(){
        return $this->db->query("SELECT * FROM rb_rekening ORDER BY id_rekening ASC");
    }

    function downline($username, $sampai, $dari){
        return $this->db->query("SELECT a.*, b.tanggal_daftar, b.id_konsumen, b.upline as downline FROM `rb_struktur_level` a JOIN rb_konsumen b ON a.username=b.username where a.upline='$username' ORDER BY a.level ASC LIMIT $dari, $sampai");
    }

    function totaldownline($username){
        return $this->db->query("SELECT * FROM `rb_struktur_level` a JOIN rb_konsumen b ON a.username=b.username where a.upline='$username'");
    }

    function jaringan_tambah(){
        $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
        $row = $this->db->query("SELECT max(urutan)+1 as urutan FROM `rb_konsumen`")->row_array();
        if ($row['urutan']==''){ $urutann = '1'; }else{ $urutann = $row['urutan']; }
        $datadbd = array('urutan'=>$urutann,
                        'upline'=>$this->input->post('upl'),
                        'username'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
                        'password'=>hash("sha512", md5($this->input->post('b'))),
                        'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                        'email'=>$this->db->escape_str(strip_tags($this->input->post('d'))),
                        'jenis_kelamin'=>$this->db->escape_str($this->input->post('e')),
                        'tanggal_lahir'=>$this->input->post('cf').'-'.$this->input->post('bf').'-'.$this->input->post('af'),
                        'no_ktp'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                        'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('h'))),
                        'ahli_waris'=>$this->db->escape_str(strip_tags($this->input->post('i'))),
                        'kota'=>$this->db->escape_str(strip_tags($this->input->post('j'))),
                        'provinsi'=>$this->db->escape_str(strip_tags($this->input->post('k'))),
                        'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('l'))),
                        'nama_bank'=>$this->db->escape_str(strip_tags($this->input->post('m'))),
                        'no_rekening'=>$this->db->escape_str(strip_tags($this->input->post('n'))),
                        'atas_nama'=>$this->db->escape_str(strip_tags($this->input->post('o'))),
                        'tanggal_daftar'=>date('Y-m-d'));
        $this->db->where('kode_konsumen',strip_tags($this->input->post('id')));
        $this->db->update('rb_konsumen',$datadbd);

        $datasponsor = array('username'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
                                'sponsor'=>$this->db->escape_str(strip_tags($this->input->post('sps'))),
                                'bonus_sponsor'=>$set['bonus_sponsor'],
                                'timer'=>date('Y-m-d H:i:s'));
        $this->db->insert('rb_struktur_sponsor',$datasponsor);

        if ($this->uri->segment('4') == '0'){
            $dataupline = array('foot1'=>$this->input->post('a'));
        }elseif ($this->uri->segment('4') == '1'){
            $dataupline = array('foot2'=>$this->input->post('a'));
        }
        /*
        elseif ($this->uri->segment('4') == '2'){
            $dataupline = array('foot3'=>$this->input->post('a'));
        }
        */
        $this->db->where('username',$this->input->post('upl'));
        $this->db->update('rb_konsumen',$dataupline); 

        $level=0; 
        $upline = $this->input->post('upl');
        do{
            $level++;
            $cekssl = $this->db->query("SELECT * FROM rb_struktur_level where username='".$this->input->post('a')."' AND upline='$upline' AND level='$level'")->num_rows();
            if ($cekssl <= 0){
              $datasponsorlevel = array('username'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
                                'upline'=>$upline,
                                'level'=>$level,
                                'timer'=>date('Y-m-d H:i:s'));
              $this->db->insert('rb_struktur_level',$datasponsorlevel);
            }
            $row = $this->db->query("SELECT * FROM rb_konsumen WHERE username='$upline'")->row_array();
            $upline=$row['upline'];
         }
        while(!empty($upline));

        $bonus = $this->db->query("SELECT a.username, b.level1, c.level2 FROM (SELECT username FROM rb_konsumen where username!='' AND username NOT IN (SELECT username FROM rb_bonus where status='1') OR username NOT IN (SELECT username FROM rb_bonus where status='2')) as a 
                                   LEFT JOIN (SELECT upline, COUNT(*) as level1 FROM rb_struktur_level where level='1' GROUP BY upline HAVING COUNT(upline)) as b on a.username=b.upline
                                   LEFT JOIN (SELECT upline, COUNT(*) level2 from rb_struktur_level where level='2' GROUP BY upline HAVING COUNT(upline)) as c on a.username=c.upline
                                   WHERE level1!='' OR level2!=''");
        
        foreach ($bonus->result_array() as $rows) {

                if ($rows['level2']>=4){ 
                    $bonus = $set['level_2']; 
                    $level = 2; 
                }elseif ($rows['level1']>=2){ 
                    $bonus = $set['level_1']; 
                    $level = 1; 
                }

            $cekstatus = $this->db->query("SELECT * FROM rb_bonus where username='".$rows['username']."' AND status='$level'")->num_rows();
            if ($cekstatus<=0){
                $datadb1 = array('username' => $rows['username'],
                                'nominal'=>$bonus,
                                'status'=>$level,
                                'waktu_bonus'=>date('Y-m-d H:i:s'));
                $this->db->insert('rb_bonus',$datadb1);
            }
        }
    }

    function pin_terjual($id,$status){
        $datadb = array('status'=>$status);
        $this->db->where('id_konsumen',$id);
        $this->db->update('rb_konsumen',$datadb);
    }

    function konsumen(){
        return $this->db->query("SELECT * FROM rb_konsumen where username != '' AND password != '' ORDER BY id_konsumen DESC");
    }

    function kode_konsumen(){
        return $this->db->query("SELECT * FROM rb_konsumen a where a.username = '' AND a.password = '' ORDER BY a.id_konsumen DESC");
    }

    function orderkode(){
        return $this->db->query("SELECT * FROM rb_order_kode a ORDER BY a.id_order_kode DESC");
    }

    function orderkode_delete($id){
        return $this->db->query("DELETE FROM rb_order_kode where id_order_kode='$id'");
    }

    function kode_konsumen_tambah(){
        for ($i = 1; $i <= $this->input->post('kode'); $i++){
            $kode=acakangkahuruf(8);
            $datadb = array('kode_konsumen'=>$kode);
            $this->db->insert('rb_konsumen',$datadb);
        }
    }

    function keterangan($id){
        return $this->db->query("SELECT * FROM `rb_keterangan` where id_keterangan='$id'");
    }

    function keuanganbayarmanual_tambah($idk){
        $datadb = array('username'=>$this->input->post('a'),
                        'nominal_bayar'=>$this->input->post('b'),
                        'bonus_sponsor'=>$this->input->post('bb'),
                        'waktu_bayar'=>date('Y-m-d'));
        $this->db->insert('rb_pembayaran_bonus',$datadb);
    }

    function totbonus($id){
        return $this->db->query("SELECT sum(nominal) as nominal FROM rb_bonus where username='$id'");
    }

    function bonus_detail($id){
        return $this->db->query("SELECT * FROM `rb_bonus` where username='$id' ORDER BY id_bonus DESC");
    }

    function totpencairan($id){
        return $this->db->query("SELECT sum(nominal_bayar) as nominal_bayar FROM rb_pembayaran_bonus where username='$id'");
    }


    function totbonuss($id){
        return $this->db->query("SELECT sum(bonus_sponsor) as nominal FROM rb_struktur_sponsor where sponsor='$id'");
    }

    function bonus_details($id){
        return $this->db->query("SELECT * FROM `rb_struktur_sponsor` where sponsor='$id' ORDER BY id DESC");
    }

    function totpencairans($id){
        return $this->db->query("SELECT sum(bonus_sponsor) as nominal_bayar FROM rb_pembayaran_bonus where username='$id'");
    }



    function pencairan_detail($id){
        return $this->db->query("SELECT * FROM `rb_pembayaran_bonus` where username='$id' ORDER BY id_pembayaran_bonus DESC");
    }

    function profile($id){
        return $this->db->query("SELECT totfoot_left, totfoot_right, harga_paket as total_rp, tanggal_daftar, rekning_virtual FROM `rb_konsumen` where id_konsumen='$id'");
    }

    function profile_view($id){
        return $this->db->query("SELECT * FROM `rb_konsumen` a where a.id_konsumen='$id'");
    }

    function profile_update($id){
        if (trim($this->input->post('a')) != ''){
            $datadbd = array('password'=>hash("sha512", md5($this->input->post('a'))),
                            'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                            'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                            'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                            'ahli_waris'=>$this->db->escape_str(strip_tags($this->input->post('h'))),
                            'kota'=>$this->db->escape_str(strip_tags($this->input->post('i'))),
                            'provinsi'=>$this->db->escape_str(strip_tags($this->input->post('j'))),
                            'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('k'))));
        }else{
           $datadbd = array('nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                            'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                            'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                            'ahli_waris'=>$this->db->escape_str(strip_tags($this->input->post('h'))),
                            'kota'=>$this->db->escape_str(strip_tags($this->input->post('i'))),
                            'provinsi'=>$this->db->escape_str(strip_tags($this->input->post('j'))),
                            'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('k'))));
        }
        $this->db->where('id_konsumen',$id);
        $this->db->update('rb_konsumen',$datadbd);
    }

    function konsumen_update($id){
        if (trim($this->input->post('a')) != ''){
            $datadbd = array('password'=>hash("sha512", md5($this->input->post('a'))),
                            'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                            'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                            'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                            'ahli_waris'=>$this->db->escape_str(strip_tags($this->input->post('h'))),
                            'kota'=>$this->db->escape_str(strip_tags($this->input->post('i'))),
                            'provinsi'=>$this->db->escape_str(strip_tags($this->input->post('j'))),
                            'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('k'))),
                            'nama_bank'=>$this->db->escape_str(strip_tags($this->input->post('l'))),
                            'no_rekening'=>$this->db->escape_str(strip_tags($this->input->post('m'))),
                            'rekning_virtual'=>$this->db->escape_str(strip_tags($this->input->post('mm'))),
                            'atas_nama'=>$this->db->escape_str(strip_tags($this->input->post('n'))));
        }else{
           $datadbd = array('nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                            'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                            'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                            'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                            'no_ktp'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                            'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                            'ahli_waris'=>$this->db->escape_str(strip_tags($this->input->post('h'))),
                            'kota'=>$this->db->escape_str(strip_tags($this->input->post('i'))),
                            'provinsi'=>$this->db->escape_str(strip_tags($this->input->post('j'))),
                            'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('k'))),
                            'nama_bank'=>$this->db->escape_str(strip_tags($this->input->post('l'))),
                            'no_rekening'=>$this->db->escape_str(strip_tags($this->input->post('m'))),
                            'rekning_virtual'=>$this->db->escape_str(strip_tags($this->input->post('mm'))),
                            'atas_nama'=>$this->db->escape_str(strip_tags($this->input->post('n'))));
        }
        $this->db->where('id_konsumen',$this->input->post('id'));
        $this->db->update('rb_konsumen',$datadbd);
    }

    function modupdatefoto(){
        $config['upload_path'] = 'asset/foto_user/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|gif|JPEG|jpeg';
        $config['max_size']     = '1000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $hasil=$this->upload->data();

        $config['image_library'] = 'gd2';
        $config['source_image'] = 'asset/foto_user/'.$hasil['file_name'];
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['height']       = 622;
        $this->load->library('image_lib', $config);
        $this->image_lib->crop();

        $datadb = array('foto'=>$hasil['file_name']);
        $this->db->where('id_konsumen',$this->session->id_konsumen);
        $this->db->update('rb_konsumen',$datadb);
  }

    function tabungankonsumen($idk){
        return $this->db->query("SELECT * FROM rb_tabungan_bayar where username='$idk' ORDER BY id_tabungan_bayar DESC");
    }

    function total_tabungan($id){
        return $this->db->query("SELECT sum(total_bayar) as total FROM `rb_tabungan_bayar` where username='$id' AND status='Lunas'");
    }

    function tabungan(){
        return $this->db->query("SELECT * FROM rb_tabungan_bayar ORDER BY id_tabungan_bayar DESC");
    }

    function bayar_tabungan($bonus,$gen){
        $tanggal_bayar = tgl_simpan($this->input->post('c'))." ".date("H:i:s");
        $datadb = array('username'=>$this->input->post('a'),
                        'total_bayar'=>$this->input->post('b'),
                        'tanggal_bayar'=>$tanggal_bayar,
                        'keterangan'=>$this->input->post('d'),
                        'status'=>'Lunas');
        $this->db->insert('rb_tabungan_bayar',$datadb);
        $idt = $this->db->insert_id();
    }

    function tabungan_edit($id){
        return $this->db->query("SELECT * FROM rb_tabungan_bayar where id_tabungan_bayar='$id'");
    }

    function tabungan_update(){
        $tanggal_bayar = tgl_simpan($this->input->post('c'))." ".date("H:i:s");
        $datadb = array('username'=>$this->input->post('a'),
                        'total_bayar'=>$this->input->post('b'),
                        'tanggal_bayar'=>$tanggal_bayar,
                        'keterangan'=>$this->input->post('d'),
                        'status'=>'Lunas');

        $this->db->where('id_tabungan_bayar',$this->input->post('id'));
        $this->db->update('rb_tabungan_bayar',$datadb);
    }

    function delete_tabungan($id){
        return $this->db->query("DELETE FROM rb_tabungan_bayar where id_tabungan_bayar='$id'");
    }
}