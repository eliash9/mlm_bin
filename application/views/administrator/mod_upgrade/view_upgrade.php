            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Permhonan Upgrade dan Downgrade</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Lengkap</th>
                        <th>Paket Lama</th>
                        <th>Paket Baru</th>
                        <th>Upline</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th style='width:80px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                      if ($row['status']=='0'){ $stat = '<i style="color:red">Pending</i>'; }else{ $stat = '<i style="color:green">Success</i>'; }
                    echo "<tr><td>$no</td>
                              <td><a href='".base_url()."administrator/detail_konsumen/$row[id_konsumen]'>$row[nama_lengkap]</a></td>
                              <td>$row[lamad]</td>
                              <td>$row[baruc]</td>
                              <td>".($row[selisih]-1)."</td>
                              <td>$row[keterangan]</td>
                              <td>$stat</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/proses_upgrade/$row[id_upgrade]' onclick=\"return confirm('Apa anda yakin untuk Proses Data ini?')\"><span class='glyphicon glyphicon-thumbs-up'></span> Proses</a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_upgrade/$row[id_upgrade]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>