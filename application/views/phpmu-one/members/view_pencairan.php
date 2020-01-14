  <p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> History Pencairan Bonus</p>                
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