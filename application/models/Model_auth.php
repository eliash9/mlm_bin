<?php 
class Model_auth extends CI_model{
    function register(){
        $cek = $this->db->query("SELECT * FROM rb_konsumen where (foot1='' OR foot2='' OR foot3='') AND username!='' ORDER BY urutan ASC LIMIT 1")->row_array();
        $row = $this->db->query("SELECT max(urutan)+1 as urutan FROM `rb_konsumen`")->row_array();
        if ($row['urutan']==''){ $urutann = '1'; }else{ $urutann = $row['urutan']; }
        $datadbd = array('urutan'=>$urutann,
                        'upline'=>$cek['username'],
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

        if (trim($cek['foot1']) == ''){
            $dataupline = array('foot1'=>$this->db->escape_str(strip_tags($this->input->post('a'))));
        }elseif (trim($cek['foot2']) == ''){
            $dataupline = array('foot2'=>$this->db->escape_str(strip_tags($this->input->post('a'))));
        }elseif (trim($cek['foot3']) == ''){
            $dataupline = array('foot3'=>$this->db->escape_str(strip_tags($this->input->post('a'))));
        }
        $this->db->where('username',$cek['username']);
        $this->db->update('rb_konsumen',$dataupline); 

        $level=0; 
        $upline = $cek['username'];
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
        $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
        foreach ($bonus->result_array() as $rows) {
            if ($rows['level2']>=9){ $bonus = $set['level_2']; $level = 2; }elseif ($rows['level1']>=3){ $bonus = $set['level_1']; $level = 1; }
            $cekstatus = $this->db->query("SELECT * FROM rb_bonus where username='".$rows['username']."' AND status='$level'")->num_rows();
            if ($cekstatus<=0){
                $datadb1 = array('username' => $rows['username'],
                                'nominal'=>$bonus,
                                'status'=>$level,
                                'waktu_bonus'=>date('Y-m-d H:i:s'));
                $this->db->insert('rb_bonus',$datadb1);
            }
        }

        $ident = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
        $email_tujuan = strip_tags($this->input->post('d'));
        $tglaktif = date("d-m-Y H:i:s");
        $subject      = 'Pendaftaran Sukses...';
        $message      = "<html><body>Halooo! <b>".strip_tags($this->input->post('a'))."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda telah sukses mendaftar di $ident[nama_website],..
            <table style='width:100%; margin-left:25px'>
                <tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Informasi Anda : </b></td></tr>
                <tr><td><b>Nama Lengkap</b></td>        <td> : ".strip_tags($this->input->post('c'))."</td></tr>
                <tr><td><b>Alamat Email</b></td>        <td> : ".strip_tags($this->input->post('d'))."</td></tr>
                <tr><td><b>No Handphone</b></td>        <td> : ".strip_tags($this->input->post('l'))."</td></tr>
                <tr><td><b>Alamat</b></td>                <td> : ".strip_tags($this->input->post('h'))." </td></tr>
                <tr><td><b>Kota</b></td>                <td> : ".strip_tags($this->input->post('j'))." </td></tr>
                <tr><td><b>Provinsi</b></td>                <td> : ".strip_tags($this->input->post('k'))." </td></tr>
                <tr><td><b>Nama Bank</b></td>           <td> : ".strip_tags($this->input->post('m'))." </td></tr>
                <tr><td><b>No Rekening</b></td>         <td> : ".strip_tags($this->input->post('n'))." </td></tr>
                <tr><td><b>Pemilik Rekening</b></td>    <td> : ".strip_tags($this->input->post('o'))." </td></tr>

                <tr><td colspan='2'>Silahkan Login di $ident[url], salam sukses..</td></tr>
            </table><br>

            Admin, $ident[nama_website]
            </body></html> \n";
        
        $this->email->from($ident['email'], $ident['nama_website']);
        $this->email->to($email_tujuan);
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

    function order(){
        $datadb = array('jumlah'=>$this->db->escape_str(strip_tags($this->input->post('jml'))),
                        'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('a'))),
                        'alamat_email'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                        'no_hp'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                        'kota'=>$this->db->escape_str(strip_tags($this->input->post('d'))),
                        'nama_bank'=>$this->db->escape_str(strip_tags($this->input->post('e'))),
                        'no_rekening'=>$this->db->escape_str(strip_tags($this->input->post('f'))),
                        'pemilik_rekening'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                        'waktu_order'=>date('Y-m-d H:i:s'));
        $this->db->insert('rb_order_kode',$datadb);
    }
}