      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Konsumen</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#profile' id='profile-tab' role='tab' data-toggle='tab' aria-controls='profile' aria-expanded='true'>Data Konsumen </a></li>
                      <li role='presentation' class=''><a href='#keuangan' role='tab' id='keuangan-tab' data-toggle='tab' aria-controls='keuangan' aria-expanded='false'>Data Keuangan</a></li>
                      <li role='presentation' class=''><a href='#pencairan' role='tab' id='pencairan-tab' data-toggle='tab' aria-controls='pencairan' aria-expanded='false'>Pencairan Bonus</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='profile' aria-labelledby='profile-tab'>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>Kode Konsumen</th> <td><?php echo $rows['kode_konsumen']?></td></tr>
                              <tr><th scope='row'>Username</th> <td><?php echo $rows['username']?></td></tr>
                              <tr><th scope='row'>Password</th> <td>xxxxxxxxxxxxxxx</td></tr>
                              <tr><th scope='row'>Nama Lengkap</th> <td><?php echo $rows['nama_lengkap']?></td></tr>
                              <tr><th scope='row'>Alamat Email</th> <td><?php echo $rows['email']?></td></tr>
                              <tr><th scope='row'>Jenis Kelamin</th> <td><?php echo $rows['jenis_kelamin']?></td></tr>
                              <tr><th scope='row'>Tanggal Lahir</th> <td><?php echo tgl_indo($rows['tanggal_lahir']); ?></td></tr>
                              <tr><th scope='row'>No KTP</th> <td><?php echo $rows['no_ktp']?></td></tr>
                              <tr><th scope='row'>Alamat Lengkap</th> <td><?php echo $rows['alamat_lengkap']?></td></tr>
                              <tr><th scope='row'>Ahli Waris</th> <td><?php echo $rows['ahli_waris']?></td></tr>
                            </tbody>
                            </table>
                          </div>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th scope='row'>Kota</th> <td><?php echo $rows['kota']?></td></tr>
                              <tr><th width='130px' scope='row'>Provinsi</th> <td><?php echo $rows['provinsi']?></td></tr>
                              <tr><th scope='row'>No Hp</th> <td><?php echo $rows['no_hp']?></td></tr>
                              <tr><th scope='row'>Nama Bank</th> <td><?php echo $rows['nama_bank']?></td></tr>
                              <tr><th scope='row'>No Rekening</th> <td><?php echo $rows['no_rekening']?></td></tr>
                              <tr><th scope='row'>No Rek Virtual</th> <td><?php echo $rows['rekning_virtual']?></td></tr>
                              <tr><th scope='row'>Atas Nama</th> <td><?php echo $rows['atas_nama']?></td></tr>
                              <tr><th scope='row'>Tanggal Daftar</th> <td><?php echo tgl_indo($rows['tanggal_daftar']); ?></td></tr>
                            </tbody>
                            </table>
                          </div>  
                          <div style='clear:both'></div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='keuangan' aria-labelledby='keuangan-tab'>
                          <div class='col-md-12'>
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
                      </div>


                      <div role='tabpanel' class='tab-pane fade' id='pencairan' aria-labelledby='pencairan-tab'>
                          <div class='col-md-12'>
                          <table class="table table-hover">
                            <thead>
                              <tr bgcolor='#cecece'>
                                <th style='width:20px'>No</th>
                                <th>Waktu Pencairan</th>
                                <th>Bonus</th>
                                <th>PPN 10%</th>
                                <th>Total Pencairan</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                          <?php 
                            $no = 1;
                            foreach ($record->result_array() as $row){
                              $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
                              $ppn = $set['ppn']/100*($row['nominal_bayar']);
                              $bonus_pajak = ($row['nominal_bayar'])-$ppn;
                              echo "<tr><td>$no</td>
                                        <td>".tgl_indo($row['waktu_bayar'])."</td>
                                        <td>Rp ".rupiah($row['nominal_bayar'])."</td>
                                        <td>Rp ".rupiah($ppn)."</td>
                                        <td style='font-weight:bold; color:red'>Rp ".rupiah($bonus_pajak)."</td>
                                        <td></td>
                                    </tr>";
                                $no++;
                            }
                          ?>
                          </tbody>
                        </table>
                          </div>
                      </div>


                    </div>
                  </div>
                </div>
            </div>
        </div>