  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Data Bonus Anda</p> 

          <div class='panel-body'>
            <ul id='myTabs' class='nav nav-tabs' role='tablist'>
              <li role='presentation' class='active'><a href='#spiritual' id='spiritual-tab' role='tab' data-toggle='tab' aria-controls='spiritual' aria-expanded='true'>Bonus Level </a></li>
              <li role='presentation' class=''><a href='#sosial' role='tab' id='sosial-tab' data-toggle='tab' aria-controls='sosial' aria-expanded='false'>Bonus Sponsor</a></li>
            </ul><br>
            <div id='myTabContent' class='tab-content'>
              <div role='tabpanel' class='tab-pane fade active in' id='spiritual' aria-labelledby='spiritual-tab'>
                  <table class='table table-hover table-condensed'>
                    <thead>
                      <tr>
                        <th width="20px">No</th>
                        <th>Bonus Pada</th>
                        <th>Waktu Bonus</th>
                        <th>Nominal Bonus</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $no = 1;
                      foreach ($bon->result_array() as $row){
                      $ex = explode(' ',$row['waktu_bonus']);
                      echo "<tr><td>$no</td>
                                <td>Level ".($row['status'])."</td>
                                <td>".tgl_indo($ex[0])." ".$ex[1]." WIB</td>
                                <td>Rp".rupiah($row['nominal'])."</td>
                            </tr>";
                        $no++;
                      }
                    ?>
                    <tr class='success'>
                      <td colspan=3>Total Bonus</td>
                      <td><b>Rp <?php echo rupiah($totbon['nominal']); ?></b></td>
                    </tr>
                    <tr class='danger'>
                      <td colspan=3>Pencairan Bonus</td>
                      <td><b>Rp <?php echo rupiah($totpen['nominal_bayar']); ?></b></td>
                    </tr>
                    </tbody>
                  </table>
              </div>

              <div role='tabpanel' class='tab-pane fade' id='sosial' aria-labelledby='sosial-tab'>
                  <table class='table table-hover table-condensed'>
                    <thead>
                    <tr>
                      <th width="20px">No</th>
                      <th>Username</th>
                      <th>Bonus Sponsor</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                    foreach ($bons->result_array() as $row){
                    $ex = explode(' ',$row['timer']);
                    echo "<tr><td>$no</td>
                              <td>$row[username]</td>
                              <td>Rp".rupiah($row['bonus_sponsor'])."</td>
                              <td>".tgl_indo($ex[0])." ".$ex[1]." WIB</td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  <tr class='success'>
                    <td colspan=3>Total Bonus</td>
                    <td><b>Rp <?php echo rupiah($totbons['nominal']); ?></b></td>
                  </tr>
                  <tr class='danger'>
                    <td colspan=3>Pencairan Bonus</td>
                    <td><b>Rp <?php echo rupiah($totpens['nominal_bayar']); ?></b></td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>