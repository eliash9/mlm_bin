  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Video - <?php echo $title; ?></p>                
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $tanggal = tgl_indo($row['tanggal']);
                    echo "<div class='col-md-12'>
                            <small><span class='glyphicon glyphicon-time'></span> $row[hari], $tanggal, $row[jam] WIB, $row[dilihat] View</small><hr>";
                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $row['youtube'], $match)) {
                      $video = $match[1];
                    } ?>
                          <p><iframe  id="ytplayer" type="text/html" width="100%" height="360px"
                                src="https://www.youtube.com/embed/<?php echo $video ?>?rel=0&showinfo=1&color=white&iv_load_policy=3"
                                frameborder="0" allowfullscreen></iframe>
                          </p>
                    <?php 
                        echo "<p>$row[keterangan]</p>
                        </div>";
                      $no++;
                    }
                    echo "<div style='clear:both'></div>";
                  ?>