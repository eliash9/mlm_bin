<?php  
        echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Data Downline Anda </p>";
        echo "<table class='table table-hover table-condensed'>
              <tr bgcolor=#e3e3e3>
                <th>No</th>
                <th width='120px'>Generasi</th>
                <th>Username</th>
                <th>Tgl Daftar</th>
                <th>Upline</th>
                <th></th>
              </tr>";
              $no = $this->uri->segment(4) + 1;
              foreach ($record->result_array() as $row){
              echo "<tr>
                    <td>$no</td>
                    <td> Generasi $row[level]</td>
                    <td> $row[username]</td>
                    <td> ".tgl_indo($row['tanggal_daftar'])."</td>
                    <td><a href='".base_url()."members/downline/$row[downline]'>$row[downline]</a></td>
                    <td><a style='padding-left; 6px; padding-right:6px' class='btn btn-xs btn-success' href='".base_url()."members/downline/$row[downline]'><span class='glyphicon glyphicon-menu-down'></span></a></td>
                  </tr>";
                $no++;
              }
            echo "</table>";
            echo $this->pagination->create_links();
      ?>