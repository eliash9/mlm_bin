            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Bonus Konsumen Sudah diBayarkan</h3>
                  <a style='margin-left:7px' class='btn btn-sm btn-primary pull-right' href='<?php echo base_url(); ?>administrator/rekapkeuangan'><span class='glyphicon glyphicon-list'></span> Tagihan Pembayaran</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Bonus</th>
                        <th>Pajak 10%</th>
                        <th>Total Bayar</th>
                        <th>Waktu</th>
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
                              <td>$row[username]</td>
                              <td>Rp ".rupiah($row['nominal_bayar'])."</td>
                              <td>Rp ".rupiah($ppn)."</td>
                              <td style='font-weight:bold; color:red'>Rp ".rupiah($bonus_pajak)."</td>
                              <td>".tgl_indo($row['waktu_bayar'])."</td>
                              <td><center>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/bonushistory_delete/$row[id_pembayaran_bonus]' onclick=\"return confirm('Apa anda yakin data ini akan dihapus?')\"><span class='glyphicon glyphicon-trash'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>