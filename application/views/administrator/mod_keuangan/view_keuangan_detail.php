      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Konsumen : <?php echo "$row[username]"; ?></h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#profile' id='profile-tab' role='tab' data-toggle='tab' aria-controls='profile' aria-expanded='true'>Data Konsumen </a></li>
                      <li role='presentation' class=''><a href='#jaringan' role='tab' id='jaringan-tab' data-toggle='tab' aria-controls='jaringan' aria-expanded='false'>Data Sponsorisasi</a></li>
                      <li role='presentation' class=''><a href='#tabungan' role='tab' id='tabungan-tab' data-toggle='tab' aria-controls='tabungan' aria-expanded='false'>Data Tabungan</a></li>
                      <li role='presentation' class=''><a href='#keuangan' role='tab' id='keuangan-tab' data-toggle='tab' aria-controls='keuangan' aria-expanded='false'>Data Keuangan</a></li>
                      <li role='presentation' class=''><a href='#pencairan' role='tab' id='pencairan-tab' data-toggle='tab' aria-controls='pencairan' aria-expanded='false'>Pencairan Bonus</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='profile' aria-labelledby='profile-tab'>
                          <div class='col-md-12'>
                            <?php 
                                $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
                                $kecil = min($sponsor['totfoot_left']-$cairan['bonus_pasangan'], $sponsor['totfoot_right']-$cairan['bonus_pasangan']);
                                $sisakiri = $sponsor['totfoot_left']-$cairan['bonus_pasangan'];
                                $sisakanan = $sponsor['totfoot_right']-$cairan['bonus_pasangan'];
                                $bonuspasangan = $kecil*$set['bonus_pasangan'];
                                $bonussponsor = $bonus['bonussponsor']-$cairan['bonus_sponsor'];
                                $totalbonus = $bonuspasangan+$bonussponsor;
                                $ppn = $set['ppn']/100*($totalbonus);
                                $bonus_pajak = $totalbonus - $ppn;
                                $autosave = $set['persen_auto_save']/100*($bonus_pajak);

                                $cekautosave = $cairan['auto_save']+$autosave;
                                if ($cekautosave > $set['max_auto_save']){
                                  $sisa = $set['max_auto_save'] - $cairan['auto_save'];
                                  $sisain = $cekautosave - $set['max_auto_save'];
                                  $totalbonusbersih = $bonus_pajak - $autosave + $sisain;
                                }else{
                                  $sisa = $autosave;
                                  $totalbonusbersih = $bonus_pajak - $autosave;
                                }
                                echo "<table class='table table-hover'>
                                      <thead>
                                        <tr><td width='170px'><b>Sisa Kiri</b></td> <td>".rupiah($sisakiri)." Paket</td></tr>
                                        <tr><td><b>Sisa Kanan</b></td>              <td>".rupiah($sisakanan)." Paket</td></tr>
                                        <tr><td><b>Bonus Pasangan</b></td>            <td>Rp ".rupiah($bonuspasangan)." </td></tr>
                                        <tr class='warning'><td><b>Bonus Sponsor</b></td>             <td>Rp ".rupiah($bonussponsor)." <a class='btn btn-warning btn-xs pull-right' href='".base_url()."members/sponsorisasi'>Lihat Detail</a></td></tr>
                                        <tr class='info'><td><b>Bonus Reword</b></td>              <td>$reword <a class='btn btn-info btn-xs pull-right' href='".base_url()."members/reword'>Lihat Detail</a></td></tr>
                                        <tr><td><b>Total Bonus</b></td>               <td style='color:red; font-weight:bold'>Rp ".rupiah($totalbonus)."</td></tr>
                                        <tr><td><b>Pajak 10%</b></td>                 <td style='color:red; font-weight:bold'>Rp ".rupiah($ppn)."</td></tr>
                                        <tr><td><b>Total Bonus - Pajak</b></td>       <td style='color:red; font-weight:bold'>Rp ".rupiah($bonus_pajak)."</td></tr>
                                        <tr class='success'><td><b>Auto Save 20%</b> <br><small><i>Untuk Bonus Reward sampai mencapai 1 Juta</i></small></td>  <td><b style='color:red; font-weight:bold'>Rp ".rupiah($sisa)."</b> <a class='btn btn-success btn-xs pull-right' href='".base_url()."members/autosave'>Lihat Detail</a></td></tr>
                                        <tr class='danger'><td><b>Total Bonus Bersih</b></td>       <td style='color:red; font-weight:bold'>Rp ".rupiah($totalbonusbersih)."</td></tr>
                                      </thead>
                                  </table>";
                            ?>
                          </div> 
                          <div style='clear:both'></div>
                      </div>



                      <div role='tabpanel' class='tab-pane fade' id='jaringan' aria-labelledby='jaringan-tab'>
                          <div class='col-md-12'>
                              
                          </div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='tabungan' aria-labelledby='tabungan-tab'>
                          <div class='col-md-12'>
                            
                          </div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='keuangan' aria-labelledby='keuangan-tab'>
                          <div class='col-md-12'>

                          </div>
                      </div>


                      <div role='tabpanel' class='tab-pane fade' id='pencairan' aria-labelledby='pencairan-tab'>
                          <div class='col-md-12'>
                          
                          </div>
                      </div>


                    </div>
                  </div>
                </div>
            </div>
        </div>