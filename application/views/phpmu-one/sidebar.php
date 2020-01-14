            <p class='sidebar-title top'><span class='glyphicon glyphicon-envelope'></span> &nbsp; ONLINE SUPPORT</p>
            <?php 
                $ym = $this->model_main->ym();
                foreach ($ym->result_array() as $row){
                  $hitung = $this->model_main->ym()->num_rows();
                    if ($hitung >= 1){
                      echo "<div>
                              <center>
                                $row[nama]<br>
                                <a href='ymsgr:sendIM?".$row['username']."'><img src='".base_url()."asset/images/online.gif'></a>
                              </center>
                            </div><hr>";
                    }
                }
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
