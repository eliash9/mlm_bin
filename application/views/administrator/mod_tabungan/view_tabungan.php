            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Traveling Bonus Konsumen</h3>
                  <a class='btn btn-sm btn-primary pull-right' href='<?php echo base_url(); ?>administrator/bayartabungan'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
                  echo "<table id='example3' class='table table-bordered table-striped'>
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Username</th>
                        <th>Total Bayar</th>
                        <th>Tanggal Bayar</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>";

                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array(); 
                    $ex = explode(' ',$row['tanggal_bayar']);
                    $tgl_bayar = tgl_indo($ex[0]);
                    $cek = $this->db->query("SELECT id_konsumen FROM rb_konsumen where username='$row[username]'")->row_array();
                    echo "<tr><td>$no</td>
                              <td><a href='".base_url()."administrator/detail_konsumen/$cek[id_konsumen]'>$row[username]</a></td>
                              <td class='success'>Rp ".rupiah($row['total_bayar'])."</td>
                              <td>$tgl_bayar ".$ex[1]."</td>
                              <td>$row[keterangan]</td>
                              <td width='60px'>
                                  <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/edittabungan/$row[id_tabungan_bayar]'><span class='glyphicon glyphicon-edit'></span></a>
                                  <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/deletetabungan/$row[id_tabungan_bayar]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>