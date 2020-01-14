            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Tagihan Bonus Konsumen Sampai Saat Ini</h3>
                  <a style='margin-left:7px' class='btn btn-sm btn-primary pull-right' href='<?php echo base_url(); ?>administrator/bonushistory'><span class='glyphicon glyphicon-list'></span> History Pembayaran</a>
                  <a target='_BLANK' class='btn btn-sm btn-success pull-right' href='<?php echo base_url(); ?>administrator/exportexcel'><span class='glyphicon glyphicon-book'></span> Export Data Ke Excel</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode Konsumen</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Bonus</th>
                        <th>Bonus Sponsor</th>
                        <th>Pajak 10%</th>
                        <th>Tagihan</th>
                        <th width='150px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $tots = $this->model_members->totbonus($row['username'])->row_array();
                    $cair = $this->model_members->totpencairan($row['username'])->row_array();
                    $totpens = $this->model_members->totpencairans($row['username'])->row_array();
                    $totbons = $this->model_members->totbonuss($row['username'])->row_array();

                    $ppn = 10/100*(($tots['nominal']-$cair['nominal_bayar'])+($totbons['nominal']-$totpens['nominal_bayar']));
                    $totalbonusbersih = (($tots['nominal']-$cair['nominal_bayar'])+($totbons['nominal']-$totpens['nominal_bayar']))-$ppn;             
                    echo "<tr><td><a href='".base_url()."administrator/detail_konsumen/$row[id_konsumen]'>$row[kode_konsumen]</a></td>
                              <td>$row[username]</td>
                              <td>$row[nama_lengkap]</td>
                              <td>Rp ".rupiah($tots['nominal']-$cair['nominal_bayar'])."</td>
                              <td>Rp ".rupiah($totbons['nominal']-$totpens['nominal_bayar'])."</td>

                              <td>Rp ".rupiah($ppn)."</td>
                              <td style='font-weight:bold; color:red'>Rp ".rupiah($totalbonusbersih)."</td>
                              <td><center>
                                <a style='margin-right:3px' class='btn btn-primary btn-xs' title='Detail' href='".base_url()."administrator/detail_konsumen/$row[id_konsumen]'><span class='glyphicon glyphicon-search'></span></a>";
                                  if ($totalbonusbersih > 1){
                                    echo "<a class='btn btn-info btn-xs' title='Bayarkan Secara Manual' href='".base_url()."administrator/keuanganbayarmanual/$row[username]'><span class='glyphicon glyphicon-pencil'></span> Manual</a>
                                          <a class='btn btn-success btn-xs' title='Sudah dibayarkan Semuanya' href='".base_url()."administrator/bayarrekapkeuangan/$row[username]' onclick=\"return confirm('Apa anda yakin data ini sudah dibayarkan?')\"><span class='glyphicon glyphicon-ok'></span> Lunas</a>";
                                  }else{
                                    echo "<a class='btn btn-default btn-xs' title='Bayarkan Secara Manual' href='#' onclick=\"return confirm('Maaf, Tidak ada tagihan pada data ini.!!!')\"><span class='glyphicon glyphicon-pencil'></span> Manual</a>
                                          <a class='btn btn-default btn-xs' title='Sudah dibayarkan Semuanya' href='#' onclick=\"return confirm('Maaf, Tidak ada tagihan pada data ini.!!!')\"><span class='glyphicon glyphicon-ok'></span> Lunas</a>";
                                  }
                              echo "</center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>