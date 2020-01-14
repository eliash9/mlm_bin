            <p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; INFORMASI UTAMA</p><hr>
            <?php 
                foreach ($infoterbaru->result_array() as $row){
                    $isi_berita = strip_tags($row['isi_berita']); 
                    $isi = substr($isi_berita,0,140); 
                    $isi = substr($isi_berita,0,strrpos($isi," "));
                    $tanggal = tgl_indo($row['tanggal']);
                    if ($row['gambar'] == ''){ $foto = 'small_no-image.jpg'; }else{ $foto = $row['gambar']; }
                    echo "<div class='col-md-4'><br>
                            <small class='date pull-right'><span class='glyphicon glyphicon-time'></span> $row[jam], $tanggal</small>
                            <img class='img-thumbnail' width='100%' style='min-height:125px' src='".base_url()."asset/foto_berita/".$foto."'>
                            <small style='color:green' class='date'> Oleh : $row[nama_lengkap] <span class='pull-right'>$row[dibaca] Kali</span></small>
                            <a class='judul' href='".base_url()."berita/detail/$row[judul_seo]'>".$row['judul']."</a><hr>
                            <p>".$isi."...</p>
                        </div>";
                }
            ?>

            <div style="clear:both"><br></div>
            <?php 
                foreach ($iklantengah->result_array() as $row){
                  $hitung = $this->model_iklan->iklan_tengah()->num_rows();
                    if ($hitung >= 1){
                      if(preg_match("/swf\z/i", $row['gambar'])) {
                          echo "<div><a target='_BLANK' title='".$row['judul']."' href='".$row['url']."'><embed class='img-thumbnail' src='".base_url()."asset/foto_iklan/".$row['gambar']."' width='100%' quality='high' type='application/x-shockwave-flash'></a></div>";
                      }else {
                           echo "<div><a target='_BLANK' title='".$row['judul']."' href='".$row['url']."'><img class='img-thumbnail' width='100%' src='".base_url()."asset/foto_iklan/".$row['gambar']."'></a></div>";
                      }
                    }
                }
            ?>
              <div class='panel-body'>
                  <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <?php 
                          $no = 1;
                          foreach ($kategori_utama->result_array() as $row){
                              if ($no == 1){
                                echo "<li role='presentation' class='active'><a href='#$row[kategori_seo]' id='$row[kategori_seo]-tab' role='tab' data-toggle='tab' aria-controls='$row[kategori_seo]' aria-expanded='true'>$row[nama_kategori]</a></li>";
                              }else{
                                echo "<li role='presentation' class=''><a href='#$row[kategori_seo]' role='tab' id='$row[kategori_seo]-tab' data-toggle='tab' aria-controls='$row[kategori_seo]' aria-expanded='false'>$row[nama_kategori]</a></li>";
                              }
                            $no++;
                          }
                      ?>
                  </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <?php 
                          $nok = 1;
                          foreach ($kategori_utama->result_array() as $rowk){
                              if ($nok == 1){
                                echo "<div role='tabpanel' class='tab-pane fade active in' id='$rowk[kategori_seo]' aria-labelledby='$rowk[kategori_seo]-tab'>
                                        <div class='col-md-12'>
                                            <div class='col-md-6'>";
                                              $kategori_content = $this->model_berita->kategori_content($rowk['id_kategori'],0,1);
                                              foreach ($kategori_content->result_array() as $row){
                                                $isi_berita = strip_tags($row['isi_berita']); 
                                                $isi = substr($isi_berita,0,310); 
                                                $isi = substr($isi_berita,0,strrpos($isi," "));
                                                if ($row['gambar'] == ''){ $foto = 'no-image.jpg'; }else{ $foto = $row['gambar']; }
                                                echo "<a class='judul' href='".base_url()."berita/detail/$row[judul_seo]'>".$row['judul']."</a><hr>
                                                      <img class='img-thumbnail' width='100%' src='".base_url()."asset/foto_berita/$foto'>
                                                      <p>$isi...</p>
                                                      <a class='btn btn-block btn-xs btn-info' href='".base_url()."berita/detail/$row[judul_seo]'>Lihat Detail &raquo;</a>
                                                      <div style='clear:both'><br></div>";
                                              }
                                            echo "</div>

                                            <div class='col-md-6'>";
                                              $kategori_contendetail = $this->model_berita->kategori_content($rowk['id_kategori'],1,3);
                                              foreach ($kategori_contendetail->result_array() as $row){
                                                $isi_berita = strip_tags($row['isi_berita']); 
                                                $isi = substr($isi_berita,0,100); 
                                                $isi = substr($isi_berita,0,strrpos($isi," "));
                                                $tanggal = tgl_indo($row['tanggal']);
                                                echo "<small class='date'><span class='glyphicon glyphicon-time'></span> $row[hari], $tanggal, $row[jam] WIB</small>
                                                   <a class='judul' href='".base_url()."berita/detail/$row[judul_seo]'>".$row['judul']."</a>
                                                   <p>$isi...</p>
                                                   <hr>";
                                              } 
                                              echo "<a class='btn btn-block btn-xs btn-success' href='berita/kategori/$rowk[kategori_seo]'>Lihat Semuanya &raquo;</a>
                                              <div style='clear:both'><br></div>
                                            </div> 
                                        </div>  
                                      </div>";
                              }else{
                                echo "<div role='tabpanel' class='tab-pane fade' id='$rowk[kategori_seo]' aria-labelledby='$rowk[kategori_seo]-tab'>
                                        <div class='col-md-12'>
                                            <div class='col-md-6'>";
                                              $kategori_content = $this->model_berita->kategori_content($rowk['id_kategori'],0,1);
                                              foreach ($kategori_content->result_array() as $row){
                                                $isi_berita = strip_tags($row['isi_berita']); 
                                                $isi = substr($isi_berita,0,310); 
                                                $isi = substr($isi_berita,0,strrpos($isi," "));
                                                if ($row['gambar'] == ''){ $foto = 'no-image.jpg'; }else{ $foto = $row['gambar']; }
                                                echo "<a class='judul' href='".base_url()."berita/detail/$row[judul_seo]'>".$row['judul']."</a><hr>
                                                      <img class='img-thumbnail' width='100%' src='".base_url()."asset/foto_berita/$foto'>
                                                      <p>$isi...</p>
                                                      <a class='btn btn-xs btn-info btn-block' href='".base_url()."berita/detail/$row[judul_seo]'>Lihat Detail &raquo;</a>
                                                      <div style='clear:both'><br></div>";
                                              }
                                            echo "</div>

                                            <div class='col-md-6'>";
                                              $kategori_contendetail = $this->model_berita->kategori_content($rowk['id_kategori'],1,3);
                                              foreach ($kategori_contendetail->result_array() as $row){
                                                $isi_berita = strip_tags($row['isi_berita']); 
                                                $isi = substr($isi_berita,0,100); 
                                                $isi = substr($isi_berita,0,strrpos($isi," "));
                                                $tanggal = tgl_indo($row['tanggal']);
                                                echo "<small class='date'><span class='glyphicon glyphicon-time'></span> $row[hari], $tanggal, $row[jam] WIB</small>
                                                   <a class='judul' href='".base_url()."berita/detail/$row[judul_seo]'>".$row['judul']."</a>
                                                   <p>$isi...</p>
                                                   <hr>";
                                              } 
                                              echo "<a class='btn btn-xs btn-success btn-block' href='".base_url()."berita/kategori/$rowk[kategori_seo]'>Lihat Semuanya &raquo;</a>
                                              <div style='clear:both'><br></div>
                                            </div>
                                        </div>
                                    </div>";
                              }
                            $nok++;
                          }
                      ?>
                    </div>
              </div>