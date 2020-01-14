  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Semua Video</p>                
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $tanggal = tgl_indo($row['tanggal']);
                    echo "<div class='col-md-6'>
                            <span style='margin-top:-10px' class='btn btn-success btn-xs'>$row[jdl_playlist]</span>
                            <small class='date pull-right'><span class='glyphicon glyphicon-time'></span> $row[hari], $tanggal, $row[dilihat] View</small>";
                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $row['youtube'], $match)) {
                      $video = $match[1];
                    } ?>
                          <p><iframe  id="ytplayer" type="text/html" width="100%" height="180px"
                                src="https://www.youtube.com/embed/<?php echo $video ?>?rel=0&showinfo=1&color=white&iv_load_policy=3"
                                frameborder="0" allowfullscreen></iframe>
                          </p>
                    <?php 
                        echo "<a href='".base_url()."video/detail/$row[video_seo]'>".$row['jdl_video']."</a>
                        </div>";
                        if ($no % 2 == 0){
                            echo "<div style='clear:both'><hr></div>";
                        }
                      $no++;
                    }
                    echo "<div style='clear:both'></div>";
                    echo $this->pagination->create_links();
                  ?>