<?php 
  echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Edit Data Profile Anda</p>
        <p>Berikut Informasi Data Profile anda.<br> 
           Pastikan data-data dibawah ini sudah benar, agar tidak terjadi kesalahan saat transaksi.</p>";                
                  if ($row['posisi']=='0'){ $penempatan = 'Kiri'; }elseif($row['posisi']=='1'){ $penempatan = 'Kanan'; }
                  $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                  echo form_open_multipart('members/edit_profile',$attributes); 
                  echo "<table class='table table-hover table-condensed'>
                        <thead>
                          <tr><td width='170px'><b>Username</b></td> <td><input class='required form-control' style='width:50%; display:inline-block' type='text' value='$row[username]' disabled> <small style='color:red'><i>Username Tidak Bisa ubah.</i></small></td></tr>
                          <tr><td><b>Password</b></td>               <td><input class='form-control' style='width:50%; display:inline-block' type='password' name='a'> <small style='color:red'><i>Kosongkan Saja JIka Tidak ubah.</i></small></td></tr>

                          <tr><td><b>Nama Lengkap</b></td>           <td><input class='required form-control' type='text' name='b' value='$row[nama_lengkap]'></td></tr>
                          <tr><td><b>Alamat Email</b></td>           <td><input class='required email form-control' type='email' name='c' value='$row[email]'></td></tr>
                          <tr><td><b>Jenis Kelamin</b></td>          <td>"; if ($row['jenis_kelamin']=='Laki-laki'){ echo "<input type='radio' value='Laki-laki' name='d' checked> Laki-laki <input type='radio' value='Perempuan' name='d'> Perempuan "; }else{ echo "<input type='radio' value='Laki-laki' name='d'> Laki-laki <input type='radio' value='Perempuan' name='d' checked> Perempuan "; } echo "</td></tr>
                          <tr><td><b>Tanggal Lahir</b></td>          <td><input style='width:50%' class='required datepicker form-control' type='text' name='e' value='$row[tanggal_lahir]' data-date-format='yyyy-mm-dd'></td></tr>
                          <tr><td><b>Nomor KTP</b></td>              <td><input style='width:60%' class='required number form-control' type='number' name='f' value='$row[no_ktp]'></td></tr>
                          <tr><td><b>Alamat Lengkap</b></td>         <td><input class='required form-control' type='text' name='g' value='$row[alamat_lengkap]'></td></tr>
                          <tr><td><b>Ahli Waris</b></td>             <td><input class='required form-control' type='text' name='h' value='$row[ahli_waris]'></td></tr>
                          <tr><td><b>Kota</b></td>                   <td><input class='required form-control' type='text' name='i' value='$row[kota]'></td></tr>
                          <tr><td><b>Provinsi</b></td>               <td><input class='required form-control' type='text' name='j' value='$row[provinsi]'></td></tr>
                          <tr><td><b>No Hp</b></td>                  <td><input style='width:40%' class='required number form-control' type='number' name='k' value='$row[no_hp]'></td></tr>
                          <tr><td><b>Nama Bank</b></td>              <td><input style='width:60%; color:red' class='required form-control' type='text' name='l' value='$row[nama_bank]' disabled></td></tr>
                          <tr><td><b>No Rekening</b></td>            <td><input style='width:60%; color:red' class='required number form-control' type='number' name='m' value='$row[no_rekening]' disabled></td></tr>
                          <tr><td><b>Atas Nama</b></td>              <td><input style='color:red' class='required form-control' type='text' name='n' value='$row[atas_nama]' disabled></td></tr></td></tr>
                          <tr class='danger'><td colspan='2'><p style='padding:6px'><i><b>Catatan :</b>  Khusus Untuk mengubah Informasi Rekening silahkan kontak Admin <a href='".base_url()."contact'>Disini</a> atau juga bisa via telpon. Saat ini kami tidak memberikan akses untuk mengubah Informasi rekening demi alasan keamanan konsumen yang tergabung di system ini, salam...</i></p></td></tr>
                          <tr><td></td><td><input class='btn btn-sm btn-primary' type='submit' name='submit' value='Simpan Perubahan'></td></tr>
                        </thead>
                    </table>";
                  echo form_close();
?>