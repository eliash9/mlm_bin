  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Gallery Foto</p>                
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $total = $this->db->query("SELECT id_gallery FROM gallery where id_album='".$row['id_album']."'")->num_rows();
                    $tanggal = tgl_indo($row['tgl_posting']);
                    echo "<div class='col-md-4'>
                            <small class='date pull-right'><span class='glyphicon glyphicon-time'></span> $row[hari], $tanggal, $row[hits_album] View</small>
                              <a href='".base_url()."gallery/detail/$row[album_seo]'>
                                <img width='100%' height='110px' src='".base_url()."asset/img_album/$row[gbr_album]'>
                              </a>
                              
                              <small><center>Ada $total Foto</center></small>
                              <a href='".base_url()."gallery/detail/$row[album_seo]'>".$row['jdl_album']."</a>
                        </div>";
                        if ($no % 3 == 0){
                            echo "<div style='clear:both'><hr></div>";
                        }
                      $no++;
                    }
                    echo "<div style='clear:both'></div>";
                    echo $this->pagination->create_links();
                  ?>