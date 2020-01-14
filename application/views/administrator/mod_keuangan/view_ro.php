<?php 
  if (isset($_POST['a'])){
    $bulan = tgl_indoos($this->input->post('a'));
      $konsumen = $this->db->query("SELECT * FROM rb_konsumen WHERE username!=''");
      foreach ($konsumen->result_array() as $row){
      $cek = $this->db->query("SELECT * FROM `rb_bonus_ro` where username='$row[username]' AND bulan_bonus='$bulan'")->num_rows();
        $d1 = $this->db->query("SELECT sum(a.jumlah*b.konsumen) as belanja, a.waktu_order as timer, a.id_konsumen_order as id_transaksi FROM   
                          `rb_konsumen_order` a JOIN rb_produk b ON a.id_produk=b.id_produk where id_pembeli='$row[id_konsumen]' AND substring(a.waktu_order,1,7)='$bulan' AND (a.pembeli='konsumen' OR a.pembeli is NULL)")->row_array();                  
        if ($d1['belanja'] > 300000){
          $r = $this->db->query("SELECT sum(if (c.belanja is null, 0, c.belanja)) as totbelanja, sum(2.5/100 * if (c.belanja is null, 0, c.belanja)) as persen
                  FROM 
                  (SELECT a.*, b.sponsor as sponsor_asli, b.tanggal_daftar as tglmasuk, b.id_konsumen 
                    FROM rb_struktur_sponsor_level a JOIN rb_konsumen b ON a.username=b.username where a.sponsor='$row[username]' ORDER BY a.level ASC) as a
                  left join 
                  (SELECT x.id_pembeli, x.pembeli, sum(x.jumlah) as jumlah, sum(y.konsumen) as konsumen, sum(x.jumlah*y.konsumen) as belanja, x.waktu_order 
                    from rb_konsumen_order x JOIN rb_produk y ON x.id_produk=y.id_produk 
                    GROUP BY x.id_pembeli HAVING COUNT(x.id_pembeli)) as c on a.id_konsumen=c.id_pembeli 
                    where c.pembeli='konsumen' AND substring(c.waktu_order,1,7)='$bulan' AND a.level <= 10 ORDER BY a.level")->row_array();
          $bonus = (2.5/100*$d1['belanja'])+$r['persen'];
          if ($cek <= 0){
            $this->db->query("INSERT INTO rb_bonus_ro VALUES('','$row[username]','$bonus','$bulan','".date('Y-m-d H:i:s')."')");
          }else{
            $this->db->query("UPDATE rb_bonus_ro SET jumlah_bonus='$bonus', waktu_masuk='".date('Y-m-d H:i:s')."' where username='$row[username]' AND substring(waktu_masuk,1,7)='2016-12'");
          }
        }
      }
  }else{
    $bulan = date('Y-m');
  }
?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Bonus RO Konsumen pada : <span style='color:red'><?php echo tgl_indoo($bulan); ?></span></h3>
                  <?php 
                    echo "<form style='margin-right:5px; margin-top:0px' class='pull-right' action='".base_url()."administrator/bonusro' method='POST'>
                            <input style='padding:3px' id='datepicker1' type='text' name='a' value='".tgl_indoose($bulan)."'>
                            <input type='submit' name='submit' style='margin-top:-4px' class='btn btn-primary btn-sm' value='Hitung RO'>
                          </form>";
                  ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width='20px'>No</th>
                        <th>Username</th>
                        <th>Bulan Belanja</th>
                        <th>Bonus Total</th>
                        <th>Waktu Proses</th>
                        <th width='50px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no = 1;
                      foreach ($record->result_array() as $row){
                          echo "<tr>
                                  <td>$no</td>
                                  <td>$row[username]</td>
                                  <td>".tgl_indoo($row['bulan_bonus'])."</td>
                                  <td>Rp ".rupiah($row['jumlah_bonus'])."</td>
                                  <td>$row[waktu_masuk]</td>
                                  <td><center>
                                    <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_bonusro/$row[id_bonus_ro]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                                  </center></td>
                              </tr>";
                        $no++;
                      }
                    ?>
                    </tbody>
                  </table>

              </div>