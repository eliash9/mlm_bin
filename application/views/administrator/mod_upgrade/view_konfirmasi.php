            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Konfirmasi Pembayaran Tabungan</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Lengkap</th>
                        <th>Bukti Transfer</th>
                        <th>Total Bayar</th>
                        <th>Tgl Bayar</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th style='width:80px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    echo "<tr><td>$no</td>
                              <td><a href='".base_url()."administrator/detail_konsumen/$row[id_konsumen]'>$row[nama_lengkap]</a></td>
                              <td><a href='".base_url()."administrator/downloadkonfirmasitabungan/$row[bukti_transfer]'>$row[bukti_transfer]</a></td>
                              <td>$row[total_bayar]</td>
                              <td>$row[tanggal_bayar]</td>
                              <td>$row[status]</td>
                              <td>$row[keterangan]</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/proses_konfirmasitabungan/$row[id_tabungan_konfirmasi]' onclick=\"return confirm('Apa anda yakin untuk Proses Data ini?')\"><span class='glyphicon glyphicon-thumbs-up'></span> Proses</a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_konfirmasitabungan/$row[id_tabungan_konfirmasi]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>