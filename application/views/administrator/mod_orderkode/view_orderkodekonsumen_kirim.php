            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Kirim Kode Konsumen</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
        <?php
          $rows = $this->db->query("SELECT a.*, c.nama_lengkap, c.no_hp, c.email, c.alamat_lengkap FROM rb_order_kode_konsumen a 
                                      JOIN rb_konsumen c ON a.id_konsumen=c.id_konsumen
                                        where a.id_order_kode_konsumen='".$this->uri->segment(3)."'")->row_array();
            echo "<div class='col-md-12'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th width='130px' scope='row'>Nama Lengkap</th> <td>$rows[nama_lengkap]</td></tr>
                              <tr><th scope='row'>No Handphone</th> <td>$rows[no_hp]</td></tr>
                              <tr><th scope='row'>Alamat Email</th> <td>$rows[email]</td></tr>
                              <tr><th scope='row'>Alamat Lengkap</th> <td>$rows[alamat_lengkap]</td></tr>
                              <tr class='alert alert-danger'><th scope='row'><b>Pesan Tambahan</b></th>              <td>$rows[keterangan]</td></tr> 
                            </tbody>
                            </table>";
                $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                echo form_open_multipart('administrator/kirim_orderkodekonsumen',$attributes); 

          echo "<table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_order_kode_konsumen]'>
                    <tr><th width='130px'><b>Jumlah PIN</b></th>              <td><select class='required form-control' name='a'>
                                                                                      <option value=''>- Pilih -</option>";
                                                                                      for ($i = 1; $i <= 50; $i++){
                                                                                        if ($rows['jumlah']==$i){
                                                                                          echo "<option value='$i' selected>$i</option>";
                                                                                        }else{
                                                                                          echo "<option value='$i'>$i</option>";
                                                                                        }
                                                                                      }
                                                                                   echo "</select></td></tr>

                  </tbody>
                  </table>

                <div class='box-footer'>
                    <button type='submit' name='submit' class='pull-right btn btn-info'>Kirimkan Kode</button>
                </div>

                <table class='table table-hover table-condensed'>
                  <tr bgcolor=#e3e3e3>
                    <th>No</th>
                    <th>Kode Aktivasi</th>
                    <th>Nama Paket</th>
                    <th>Waktu Kirim</th>
                    <th></th>
                    <th></th>
                  </tr>";
                  $no = 1;
                  foreach ($record->result_array() as $row){
                  $cek = $this->db->query("SELECT * FROM rb_konsumen where kode_konsumen='$row[kode_aktivasi]' AND username=''")->num_rows();
                  if ($cek <= 0){ $status = '<i style="color:green">Sudah Didaftarkan</i>'; }else{ $status = '<i style="color:red">Belum Didaftarkan</i>'; }
                  $ex = explode(' ',$row['waktu_kirim']);
                  echo "<tr>
                        <td>$no</td>
                        <td>$row[kode_aktivasi]</td>
                        <td>$row[nama_paket]</td>
                        <td>".tgl_indo($ex[0]).", ".$ex[1]." WIB</td>
                        <td>$status</td>
                        <td><center>
                            <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_orderkodekonsumen/$row[id_order_kode_kirim]/".$this->uri->segment(3)."' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                        </center></td>
                      </tr>";
                    $no++;
                  }
                echo "</table>
                </div>";

            ?>
        </div>
