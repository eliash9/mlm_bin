  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> File Download</p>                
                  <table class="table table-hover table-condensed">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Judul</th>
                        <th>Hits</th>
                        <th style='width:70px'></th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $tgl_posting = tgl_indo($row['tgl_posting']);
                    echo "<tr><td>$no</td>
                              <td>$row[judul]</td>
                              <td>$row[hits] Kali</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."download/file/$row[nama_file]'><span class='glyphicon glyphicon-download'></span> Download</a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>