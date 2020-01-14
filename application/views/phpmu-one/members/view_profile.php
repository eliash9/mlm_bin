<?php 
  echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Data Profile Anda 
        <a class='btn btn-success btn-xs pull-right' href='".base_url()."members/edit_profile'><span class='glyphicon glyphicon-edit'></span> Edit Profile</a></p>
        <p>Berikut Informasi Data Profile anda.<br> 
           Pastikan data-data dibawah ini sudah benar, agar tidak terjadi kesalahan saat transaksi.</p>";                
                  echo "<table class='table table-hover table-condensed'>
                        <thead>
                          <tr><td width='170px'><b>Username</b></td> <td><b style='color:red'>$row[username]</b></td></tr>
                          <tr><td><b>Nama Lengkap</b></td>           <td>$row[nama_lengkap]</td></tr>
                          <tr><td><b>Alamat Email</b></td>           <td>$row[email]</td></tr>
                          <tr><td><b>Jenis Kelamin</b></td>          <td>$row[jenis_kelamin]</td></tr>
                          <tr><td><b>Tanggal Lahir</b></td>          <td>".tgl_indo($row['tanggal_lahir'])."</td></tr>
                          <tr><td><b>Nomor KTP</b></td>              <td>$row[no_ktp]</td></tr>
                          <tr><td><b>Alamat Lengkap</b></td>         <td>$row[alamat_lengkap]</td></tr>
                          <tr><td><b>Ahli Waris</b></td>             <td>$row[ahli_waris]</td></tr>
                          <tr><td><b>Kota</b></td>                   <td>$row[kota]</td></tr>
                          <tr><td><b>Provinsi</b></td>               <td>$row[provinsi]</td></tr>
                          <tr><td><b>No Hp</b></td>                  <td>$row[no_hp]</td></tr>
                          <tr><td><b>Nama Bank</b></td>              <td>$row[nama_bank]</td></tr>
                          <tr><td><b>No Rekening</b></td>            <td>$row[no_rekening]</td></tr>
                          <tr><td><b>Atas Nama</b></td>              <td>$row[atas_nama]</td></tr>
                        </thead>
                    </table>";
?>