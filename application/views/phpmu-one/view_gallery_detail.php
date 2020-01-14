<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Gallery Foto - <?php echo $title; ?></p>                
                  <?php 
                    $no = 1;
                    echo "<small class='date'><span class='glyphicon glyphicon-time'></span> $rows[hari], ".tgl_indo($rows['tgl_posting']).", $rows[jam] WIB, $rows[hits_album] View</small><hr>
                          <p>$rows[keterangan]</p>";
                  if ($this->uri->segment(4) != ''){
                    $det = $this->db->query("SELECT * FROM gallery where id_gallery='".$this->uri->segment(4)."'")->row_array();
                    echo "<p><img class='img-thumbnail' width='100%' src='".base_url()."asset/img_galeri/$det[gbr_gallery]'></p>";
                  }
                    foreach ($record->result_array() as $row){
                    echo "<div class='col-md-4'>
                              <div style='overflow:hidden; height:110px'>
                                <a href='".base_url()."gallery/detail/$rows[album_seo]/$row[id_gallery]'><img class='img-thumbnail' width='100%' src='".base_url()."asset/img_galeri/$row[gbr_gallery]'></a>
                              </div>
                        </div>";
                        if ($no % 3 == 0){
                            echo "<div style='clear:both'><hr></div>";
                        }
                      $no++;
                    }
                    echo "<div style='clear:both'></div>";
                    echo $this->pagination->create_links();
                  ?>