            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Pesanan Kode Aktivasi yang masuk.</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Jml Pin</th>
                        <th>Nama dan Email</th>
                        <th>No Handphone</th>
                        <th>Kota</th>
                        <th>Informasi Rekening</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    if ($row['id_paket']=='1'){ $color = 'red'; }elseif($row['id_paket']=='2'){ $color = 'orange'; }else{ $color = 'blue'; }
                    echo "<tr><td>$no</td>
                              <td>$row[jumlah] pin</td>
                              <td>$row[nama_lengkap] <br><span style='color:blue'>$row[alamat_email]</span></td>
                              <td>$row[no_hp]</td>
                              <td>$row[kota]</td>
                              <td><small>Bank $row[nama_bank], No rek : $row[no_rekening] <br>A/n : $row[pemilik_rekening]</small></td>
                              <td><center>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_orderkode/$row[id_order_kode]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>