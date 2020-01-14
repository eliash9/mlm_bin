<?php 
  $usr = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen='".$this->session->id_konsumen."'")->row_array();
  if (trim($usr['foto'])==''){
    $foto_user = 'users.gif'; 
  }else{
    $foto_user = $usr['foto']; 
  }

  $tentang = strip_tags($usr['alamat_lengkap']); 
  echo "<table class='table'>
          <tr>
            <td><img style='border:1px solid #cecece' width='85px' src='".base_url()."asset/foto_user/$foto_user' class='img-circle'> <br><br>
              <a class='btn btn-block btn-xs btn-primary' href='#uploadfoto' data-toggle='modal' data-target='#uploadfoto'>Ganti Foto</a>
              <a class='btn btn-block btn-xs btn-success' href='".base_url()."members/profile'>View Profile</a>
            </td>

            <td><b>$usr[nama_lengkap]</b> <br><small style='color:red'>$usr[kode_konsumen]</small><br> <hr>
              <span class='glyphicon glyphicon-heart'></span> $usr[jenis_kelamin]<br>
              <span class='glyphicon glyphicon-phone-alt'></span> $usr[no_hp]<br>
              $tentang,..
            </td>
          </tr>
        </table>";
 ?>
            
            <p class='sidebar-title'><span class='glyphicon glyphicon-tags'></span> &nbsp; AGENDA TERBARU</p>
            <?php 
                $agenda = $this->model_agenda->agenda_terbaru(3);
                foreach ($agenda->result_array() as $row){
                    $isi_berita = strip_tags($row['isi_agenda']); 
                    $isi = substr($isi_berita,0,120); 
                    $isi = substr($isi_berita,0,strrpos($isi," "));
                    $tgl1 = tgl_indo($row['tgl_mulai']);
                    $tgl2 = tgl_indo($row['tgl_selesai']);
                    echo "<small class='date'><span class='glyphicon glyphicon-time'></span> $tgl1 s/d $tgl2, $row[jam]</small>
                          <a href='".base_url()."agenda/detail/$row[tema_seo]'>$row[tema]</a>
                          <small style='color:green' class='date'><span class='glyphicon glyphicon-home'></span> $row[tempat]</small>
                          <p>$isi...</p> <a class='btn btn-xs btn-primary btn-block' href='".base_url()."agenda/detail/$row[tema_seo]'>Lihat Detail Agenda</a><hr>";
                }


                $iklansidebar = $this->model_iklan->iklan_sidebar();
                foreach ($iklansidebar->result_array() as $row){
                  $hitung = $this->model_main->iklan_sidebar()->num_rows();
                    if ($hitung >= 1){
                      if(preg_match("/swf\z/i", $row['gambar'])) {
                          echo "<div><a target='_BLANK' title='".$row['judul']."' href='".$row['url']."'><embed class='img-thumbnail' src='".base_url()."asset/foto_iklan/".$row['gambar']."' width='100%' quality='high' type='application/x-shockwave-flash'></a></div>";
                      }else {
                           echo "<div><a target='_BLANK' title='".$row['judul']."' href='".$row['url']."'><img class='img-thumbnail' width='100%' src='".base_url()."asset/foto_iklan/".$row['gambar']."'></a></div>";
                      }
                    }
                }
            ?>
