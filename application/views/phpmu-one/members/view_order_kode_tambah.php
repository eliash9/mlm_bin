<?php 
  echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> $title</p>";                
                  $attributes = array('role'=>'form','id' => 'formku');
                  echo form_open_multipart('members/tambah_orderkode',$attributes); 
                  $usr = $this->db->query("SELECT * FROM rb_konsumen where kode_konsumen='".$this->session->kode_konsumen."'")->row_array();
                  echo "<table class='table table-hover'>
                        <thead>
                          <tr><td width='130px'><b>Nama Pemesan</b></td>     <td><input type='text' class='form-control' value='$usr[nama_lengkap]' disabled></td></tr>
                          <tr><td><b>Jumlah PIN</b></td>              <td><select class='required form-control' name='b'>
                                                                                      <option value=''>- Pilih -</option>";
                                                                                      for ($i = 1; $i <= 50; $i++){
                                                                                          echo "<option value='$i'>$i</option>";
                                                                                      }
                                                                                   echo "</select></td></tr>                                                     
                          <tr><td><b>Keterangan</b></td>                      <td><textarea class='form-control' style='height:100px' name='c' placeholder='Tuliskan Catatan / Pesan Tambahan Jika ada,...'></textarea></td></tr>                                                      
                          <tr><td></td>                                       <td><input class='btn btn-primary btn-sm' type='submit' value='Pesan Sekarang!' name='submit'></td></tr>   
                        </thead>
                    </table>";
                    echo form_close();
?>