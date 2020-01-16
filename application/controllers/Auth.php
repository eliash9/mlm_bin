<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function register(){
		if (isset($_POST['submit'])){
			$idk = strip_tags($this->input->post('id'));
			$dat = $this->db->query("SELECT * FROM rb_konsumen where kode_konsumen='$idk'");
			$datt = $this->db->query("SELECT * FROM rb_konsumen where kode_konsumen='$idk' AND username=''");
			$total = $datt->num_rows();
			$rows = $dat->row_array();

			if ($total == 0){
			    $data['title'] = 'Formulir Pendaftaran';
				$this->template->load('phpmu-one/template','phpmu-one/view_register',$data);
			}else{
				$cekakun = $this->db->query("SELECT * FROM rb_konsumen where username='".strip_tags($this->input->post('a'))."' OR email='".strip_tags($this->input->post('d'))."' OR no_ktp='".strip_tags($this->input->post('g'))."'")->num_rows();
				if ($cekakun >= 1){
					echo "<script>window.alert('Maaf, Akun dengan Username : ".$this->input->post('a').", No KTP : ".$this->input->post('g').", Email : ".$this->input->post('d')." sudah Terdaftar,..!');
	                              window.location=('".base_url()."')</script>";
				}else{
					$this->model_auth->register();
					$this->session->set_userdata(array('id_konsumen'=>$rows['id_konsumen'], 
				                                        'kode_konsumen'=>$this->input->post('id'), 
				                                        'username'=>$this->input->post('a'),
				                                        'sponsor'=>''));
					redirect('members/profile');
				}
			}
		}else{
			$idk = $this->input->post('kode');
			$dat = $this->db->query("SELECT * FROM rb_konsumen a where a.kode_konsumen='$idk' AND a.username='' AND a.password=''");
		    $row = $dat->row();
		    $total = $dat->num_rows();
		        if ($total == 0){
                    redirect('main');
		        }
			$data['title'] = 'Formulir Pendaftaran';
			$this->template->load('phpmu-one/template','phpmu-one/view_register',$data);
		}
	}


	public function order(){
		if (isset($_POST['submit'])){
			$data['title'] = 'Success Order Kode Aktivasi';
			$cek = $this->db->query("SELECT * FROM rb_order_kode where alamat_email='".$this->input->post('b')."' AND waktu_order LIKE '".date('Y-m-d H:i')."%'")->num_rows();
			$identitass = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
			$rekeninggg = $this->db->query("SELECT * FROM rb_rekening");
			if ($cek >= 1){
				redirect('main');
			}
				$this->model_auth->order();
				$set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
				$harga = $this->input->post('jml') * $set['harga_pin'];

				$email_tujuan = strip_tags($this->input->post('b'));
				$tglaktif = date("d-m-Y H:i:s");
				$subject      = 'Pemesanan Kode Aktivasi ...';
				$message      = "<html><body>Halooo! <b>".strip_tags($this->input->post('a'))."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda Mengirimkan Permohonan Untuk Pembelian Kode Aktivasi di $identitass[nama_website],..
					<table style='width:100%; margin-left:25px'>
		   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Informasi Anda : </b></td></tr>
						<tr><td><b>Jumlah Pin</b></td>			<td> : ".strip_tags($this->input->post('jml'))." Pin * $set[harga_pin]</td></tr>
						<tr><td><b>Nama Lengkap</b></td>		<td> : ".strip_tags($this->input->post('a'))."</td></tr>
						<tr><td><b>Alamat Email</b></td>		<td> : ".strip_tags($this->input->post('b'))."</td></tr>
						<tr><td><b>No Handphone</b></td>		<td> : ".strip_tags($this->input->post('c'))."</td></tr>
						<tr><td><b>Kota</b></td>				<td> : ".strip_tags($this->input->post('d'))." </td></tr>
						<tr><td><b>Nama Bank</b></td>			<td> : ".strip_tags($this->input->post('e'))." </td></tr>
						<tr><td><b>No Rekening</b></td>			<td> : ".strip_tags($this->input->post('f'))." </td></tr>
						<tr><td><b>Pemilik Rekening</b></td>	<td> : ".strip_tags($this->input->post('g'))." </td></tr>
						<tr><td colspan='2'>Silahkan Transfer : <b style='color:red'>Rp ".rupiah($harga)." </b>
											<br>dan selanjutnya orderran anda segera kami proses, salam success..</td></tr>
					</table><br>

					<table style='width:100%; margin-left:25px'>
	                  		<tr><td style='background:#337ab7; color:#fff; pading:20px' colspan='2'><b>Rekening Perusahaann : </b></td></tr>";
	                  		foreach ($rekeninggg->result_array() as $rows){
			                   $message .= "<tr bgcolor=#e3e3e3><td width=150px><b>Nama Bank</b></td> <td>$rows[nama_bank]</td></tr>
					                  <tr><td><b>No Rekening</b></td>       					<td>$rows[no_rekening]</td></tr>
					                  <tr><td><b>Pemilik Rekening</b></td>  					<td>$rows[pemilik_rekening]</td></tr>
					                  <tr><td colspan='2'><br></td></tr>";
		                    	}
	                		$message .= "</table><br>

					Admin, $identitass[nama_website]
					</body></html> \n";
					
				
				$this->email->from($identitass['email'], $identitass['nama_website']);
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

			$data['email'] = $this->input->post('b');
			$this->template->load('phpmu-one/template','phpmu-one/view_order_success',$data);
		}else{
			$data['jml'] = $this->input->post('jml');
			$data['title'] = 'Formulir Order Kode Aktivasi';
			$this->template->load('phpmu-one/template','phpmu-one/view_order',$data);
		}
	}

	public function login(){
		if (isset($_POST['login'])){

			$secutity_code = $this->input->post('secutity_code');
   			$mycaptcha = $this->session->userdata('mycaptcha');
   			



			if ($this->input->post('a') == '' OR $this->input->post('b') == ''){
				echo "<script>window.alert('Maaf, Inputan Tidak Boleh Kosong!!');
                                  window.location=('".base_url()."')</script>";
			}else{
				
					$username = strip_tags($this->input->post('a'));
					$password = hash("sha512", md5(strip_tags($this->input->post('b'))));
					$cek = $this->db->query("SELECT * FROM rb_konsumen where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
				    $row = $cek->row_array();
				    $total = $cek->num_rows();
					if ($total > 0 && ($secutity_code == $mycaptcha)){
						$this->session->set_userdata(array('id_konsumen'=>$row['id_konsumen'],
										   'kode_konsumen'=>$row['kode_konsumen'], 
										   'username'=>$row['username'],
										   'sponsor'=>$row['sponsor']));
						redirect('members/profile');
					}else{
						$data['title'] = 'Gagal Login';
						$this->template->load('phpmu-one/template','phpmu-one/view_login_error',$data);
					}

				
			}

		}else{
			$this->load->helper(array('captcha','url','form'));
			$config_captcha = array(
			    'img_path'  => './captcha/',
			    'img_url'  => base_url().'captcha/',
			    'img_width'  => '200',
			    'img_height' => 60,
			    'border' => 0, 
			    'font_path'     => base_url().'asset/fonts/glyphicons-halflings-regular.ttf',
			    'word_length'   => 4,
        		'font_size'     => 24,
			    'expiration' => 7200,
			    'pool'          => '0123456789',
			    'colors'        => array(
		                'background' => array(255, 255, 255),
		                'border' => array(255, 255, 255),
		                'text' => array(0, 0, 0),
		                'grid' => array(255, 40, 40)
		        )
			   );

						// create captcha image
			   $cap = create_captcha($config_captcha);
			  
			   // store image html code in a variable
			   $data['img'] = $cap['image'];
			  
			   // store the captcha word in a session
			   $this->session->set_userdata('mycaptcha', $cap['word']);


			$data['title'] = 'User Login';
			$this->template->load('phpmu-one/template','phpmu-one/view_login',$data);
		}
	}

	public function reg(){
		if ($this->uri->segment(3)=='order'){
			$data['title'] = 'Order Kode Aktivasi';
			$this->template->load('phpmu-one/template','phpmu-one/view_order_code',$data);
		}else{
			$data['title'] = 'Input Kode Aktivasi';
			$this->template->load('phpmu-one/template','phpmu-one/view_reg',$data);
		}
	}

	public function lupass(){
		if (isset($_POST['lupa'])){
			$email = strip_tags($this->input->post('a'));
			$username = strip_tags($this->input->post('username'));
			$cek = $this->db->query("SELECT * FROM rb_konsumen where email='".$this->db->escape_str($email)."' AND username='$username'");
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$identitas = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
				$randompass = generateRandomString(10);
				$passwordbaru = hash("sha512", md5($randompass));
				$this->db->query("UPDATE rb_konsumen SET password='$passwordbaru' where email='".$this->db->escape_str($email)."' AND username='$username'");

				if ($row['jenis_kelamin']=='Laki-laki'){ $panggill = 'Bpk.'; }else{ $panggill = 'Ibuk.'; }
				$email_tujuan = $row['email'];
				$tglaktif = date("d-m-Y H:i:s");
				$subject      = 'Permintaan Reset Password ...';
				$message      = "<html><body>Halooo! <b>$panggill ".$row['nama_lengkap']."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda Mengirimkan Permintaan untuk Reset Password
					<table style='width:100%; margin-left:25px'>
		   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Informasi akun Anda : </b></td></tr>
						<tr><td><b>Kode Konsumen</b></td>			<td> : ".$row['kode_konsumen']."</td></tr>
						<tr><td><b>Nama Lengkap</b></td>			<td> : ".$row['nama_lengkap']."</td></tr>
						<tr><td><b>Alamat Email</b></td>			<td> : ".$row['email']."</td></tr>
						<tr><td><b>No Telpon</b></td>				<td> : ".$row['no_hp']."</td></tr>
						<tr><td><b>Jenis Kelamin</b></td>			<td> : ".$row['jenis_kelamin']." </td></tr>
						<tr><td><b>Tanggal Lahir</b></td>			<td> : ".$row['tanggal_lahir']." </td></tr>
						<tr><td><b>Nomor KTP</b></td>				<td> : ".$row['no_ktp']." </td></tr>
						<tr><td><b>Alamat Lengkap</b></td>			<td> : ".$row['alamat_lengkap']." </td></tr>
						<tr><td><b>Ahli Waris</b></td>				<td> : ".$row['ahli_waris']." </td></tr>
						<tr><td><b>Kota</b></td>					<td> : ".$row['kota']." </td></tr>
						<tr><td><b>Provinsi</b></td>				<td> : ".$row['provinsi']." </td></tr>
						<tr><td><b>Nama Bank</b></td>				<td> : ".$row['nama_bank']." </td></tr>
						<tr><td><b>No Rekening</b></td>				<td> : ".$row['no_rekening']." </td></tr>
						<tr><td><b>Atas Nama</b></td>				<td> : ".$row['atas_nama']." </td></tr>
						<tr><td><b>Waktu Daftar</b></td>			<td> : ".$row['tanggal_daftar']."</td></tr>
					</table>
					<br> Username Login : <b style='color:red'>$row[username]</b>
					<br> Password Login : <b style='color:red'>$randompass</b>
					<br> Silahkan Login di : <a href='https://phpmu.com/demo/mlm/'>$identitas[url]</a> <br>
					Admin, $identitas[nama_website] </body></html> \n";
				
				$this->email->from($identitas['email'], $identitas['nama_website']);
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

				$data['email'] = $email;
				$data['title'] = 'Permintaan Reset Password Sudah Terkirim...';
				$this->template->load('phpmu-one/template','phpmu-one/view_lupass_success',$data);
			}else{
				$data['email'] = $email;
				$data['title'] = 'Email Tidak Ditemukan...';
				$this->template->load('phpmu-one/template','phpmu-one/view_lupass_error',$data);
			}
		}
	}
}
