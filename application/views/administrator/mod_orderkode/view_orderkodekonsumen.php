            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $title; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Nama Konsumen</th>
                        <th>Jml Pin</th>
                        <th>Total Tagihan</th>
                        <th>Waktu Order</th>
                        <th>Status</th>
                        <th style='width:140px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $cekkirim = $this->db->query("SELECT * FROM rb_order_kode_kirim where id_order_kode_konsumen='$row[id_order_kode_konsumen]'")->num_rows();
                    if ($cekkirim >= 1){ $status = "<i style='color:green'>Proses</i>"; }else{ $status = "<i style='color:red'>Pending</i>"; }
                    $ex = explode(' ',$row['waktu_order']);
                    echo "<tr><td>$no</td>
                              <td><a href='".base_url()."administrator/detail_konsumen/$row[id_konsumen]'>$row[nama_lengkap]</a></td>
                              <td>$row[jumlah] pin</td>
                              <td>Rp ".rupiah($row['harga']*$row['jumlah'])."</td>
                              <td>".tgl_indo($ex[0]).", ".$ex[1]." WIB</td>
                              <td>$status</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Kirim Kode' href='".base_url()."administrator/kirim_orderkode$level/$row[id_order_kode_konsumen]'><span class='glyphicon glyphicon-send'></span> Kirim Kode</a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_orderkode$level/$row[id_order_kode_konsumen]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>