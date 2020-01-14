<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Konsumen</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_konsumen',$attributes); 
              if ($rows['id_penempatan'] == '1'){ $penempatan = "Kiri"; }else{ $penempatan = "Kanan"; }
          echo "<div class='col-md-12'>
                  <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <input type='hidden' value='".$this->uri->segment(3)."' name='id'>
                              <tr><th width='130px' scope='row'>Kode Konsumen</th>  <td><input class='form-control' type='text' name='aa' value='$rows[kode_konsumen]' disabled></td></tr>
                              <tr><th scope='row'>Username</th>                     <td><input class='form-control' type='text' name='bb' value='$rows[username]' disabled></td></tr>
                              <tr><th scope='row'>Password</th>                     <td><input class='form-control' type='password' name='a'></td></tr>
                              <tr><th scope='row'>Nama Lengkap</th>                 <td><input class='form-control' type='text' name='b' value='$rows[nama_lengkap]'></td></tr>
                              <tr><th scope='row'>Alamat Email</th>                 <td><input class='form-control' type='email' name='c' value='$rows[email]'></td></tr>
                              <tr><th scope='row'>Jenis Kelamin</th>                <td>"; if ($row['jenis_kelamin']=='Laki-laki'){ echo "<input type='radio' value='Laki-laki' name='d' checked> Laki-laki <input type='radio' value='Perempuan' name='d'> Perempuan "; }else{ echo "<input type='radio' value='Laki-laki' name='d'> Laki-laki <input type='radio' value='Perempuan' name='d' checked> Perempuan "; } echo "</td></tr>
                              <tr><th scope='row'>Tanggal Lahir</th>                <td><input class='datepicker form-control' type='text' name='e' value='$rows[tanggal_lahir]' data-date-format='yyyy-mm-dd'></td></tr>
                              <tr><th scope='row'>No KTP</th>                       <td><input class='form-control' type='number' name='f' value='$rows[no_ktp]'></td></tr>
                              <tr><th scope='row'>Alamat Lengkap</th>               <td><input class='form-control' type='text' name='g' value='$rows[alamat_lengkap]'></td></tr>
                              <tr><th scope='row'>Ahli Waris</th>                   <td><input class='form-control' type='text' name='h' value='$rows[ahli_waris]'></td></tr>
                            </tbody>
                            </table>
                          </div>
                          <div class='col-md-6'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <tr><th scope='row'>Kota</th>                         <td><input class='form-control' type='text' name='i' value='$rows[kota]'></td></tr>
                              <tr><th width='130px' scope='row'>Provinsi</th>       <td><input class='form-control' type='text' name='j' value='$rows[provinsi]'></td></tr>
                              <tr><th scope='row'>No Hp</th>                        <td><input class='form-control' type='number' name='k' value='$rows[no_hp]'></td></tr>
                              <tr><th scope='row'>Nama Bank</th>                    <td><input class='form-control' type='text' name='l' value='$rows[nama_bank]'></td></tr>
                              <tr><th scope='row'>No Rekening</th>                  <td><input class='form-control' type='number' name='m' value='$rows[no_rekening]'></td></tr>
                              <tr><th scope='row'>No Rek Virtual</th>                  <td><input class='form-control' type='number' name='mm' value='$rows[rekning_virtual]'></td></tr>
                              <tr><th scope='row'>Atas Nama</th>                    <td><input class='form-control' type='text' name='n' value='$rows[atas_nama]'></td></tr>
                              <tr><th scope='row'>Sponsor</th>                      <td><input class='form-control' type='text' name='o' value='$rows[sponsor]' disabled></td></tr>
                              <tr><th scope='row'>Penempatan</th>                   <td><input class='form-control' type='text' name='p' value='$penempatan' disabled></td></tr>
                              <tr><th scope='row'>Nama Paket</th>                   <td><input class='form-control' type='text' name='q' value='$rows[nama_paket]' disabled></td></tr>
                              <tr><th scope='row'>Tanggal Daftar</th>               <td><input class='form-control' type='text' name='r' value='$rows[tanggal_daftar]' disabled></td></tr>
                            </tbody>
                            </table>
                          </div> 
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
