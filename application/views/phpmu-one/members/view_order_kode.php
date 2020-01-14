<?php
        echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> $title  
                <span class='pull-right'><a class='btn btn-xs btn-primary' href='".base_url()."members/tambah_orderkode'>Order Kode Aktivasi</a>
                                         <a class='btn btn-xs btn-warning' href='#' data-toggle='modal' data-target='#rekening'>Order No Rekening Perusahaan</a></span>
              </p>";
        echo "<table class='table table-hover table-condensed'>
              <tr bgcolor=#e3e3e3>
                <th>No</th>
                <th>Jumlah Pin</th>
                <th>Total Tagihan</th>
                <th>Tgl Order</th>
                <th></th>
                <th></th>
              </tr>";
              $no = 1;
              foreach ($record->result_array() as $row){
              $cekkirim = $this->db->query("SELECT * FROM rb_order_kode_kirim where id_order_kode_konsumen='$row[id_order_kode_konsumen]'")->num_rows();
              if ($cekkirim >= 1){ $status = "<span class='glyphicon glyphicon-ok'></span>"; }else{ $status = "<span class='glyphicon glyphicon-hourglass'></span>"; }
              $ex = explode(' ',$row['waktu_order']);
              echo "<tr>
                    <td>$no</td>
                    <td style='color:blue' align=center>$row[jumlah]</td>
                    <td>Rp ".rupiah($row['harga']*$row['jumlah'])."</td>
                    <td>".tgl_indo($ex[0]).", ".$ex[1]." WIB</td>
                    <td><a style='padding-left; 6px; padding-right:6px' class='btn btn-xs btn-success' href='".base_url()."members/detail_orderkode/$row[id_order_kode_konsumen]'><span class='glyphicon glyphicon-shopping-cart'></span> Pesanan</a></td>
                    <td>$status</td>
                  </tr>";
                $no++;
              }
            echo "</table>";
            echo $this->pagination->create_links();
      ?>