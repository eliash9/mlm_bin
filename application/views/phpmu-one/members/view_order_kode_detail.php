<?php
echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> $title</p>";
$cekkirim = $this->db->query("SELECT * FROM rb_order_kode_kirim where id_order_kode_konsumen='".$this->uri->segment(3)."'")->num_rows();
if ($cekkirim >= 1){
        echo "<table class='table table-hover table-condensed'>
                  <tr bgcolor=#cecece>
                    <th>No</th>
                    <th>Kode Aktivasi</th>
                    <th>Waktu Kirim</th>
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
                        <td>".tgl_indo($ex[0]).", ".$ex[1]." WIB</td>
                        <td>$status</td>
                      </tr>";
                    $no++;
                  }
                echo "</table>";
}else{
    echo "<center style='margin-top:13%'>Orderan ini masih dalam Proses,..</center>";
}
      ?>