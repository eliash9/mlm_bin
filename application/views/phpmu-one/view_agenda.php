<?php
        $isi_berita = strip_tags($record['isi_agenda']); 
        $isi = substr($isi_berita,0,120); 
        $isi = substr($isi_berita,0,strrpos($isi," "));
        $tgl1 = tgl_indo($record['tgl_mulai']);
        $tgl2 = tgl_indo($record['tgl_selesai']);
        $tgl_posting = tgl_indo($record['tgl_posting']);

          echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> $record[tema]</p>
                  <small class='date'><span class='glyphicon glyphicon-user'></span> Oleh : Administrator, $record[dibaca] View, Pada : $tgl_posting</small><hr>
            <div class='col-md-12'>";
                if ($record['gambar'] != ''){
                    echo "<img width='100%' src='".base_url()."asset/foto_agenda/".$record['gambar']."'>";
                }
                echo "<p>$record[isi_agenda]</p>
                      <table class='table table-condensed table-bordered'>
                        <tr><th width='120px'>Waktu</th>  <td>$record[tempat]</td></tr>
                        <tr><th width='120px'>Tempat</th>  <td>$tgl1 s/d $tgl2, $record[jam] Wib</td></tr>
                        <tr><th width='120px'>Pengirim</th>  <td>$record[pengirim]</td></tr>
                      </table>
            </div><div style='clear:both'><br></div>

            <p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; INFORMASI TERBARU</p><hr>";
                $no = 1;
                foreach ($infoterbaru->result_array() as $row){
                    $isi_berita = strip_tags($row['isi_berita']); 
                    $isi = substr($isi_berita,0,150); 
                    $isi = substr($isi_berita,0,strrpos($isi," "));
                    $tanggal = tgl_indo($row['tanggal']);
                    if ($row['gambar'] == ''){ $foto = 'small_no-image.jpg'; }else{ $foto = $row['gambar']; }
                    echo "<div class='col-md-4'>
                            <small class='date pull-right'><span class='glyphicon glyphicon-time'></span> $row[hari], $tanggal</small>
                            <img width='100%' height='110px' src='".base_url()."asset/foto_berita/".$foto."'>
                            <a href='".base_url()."berita/detail/$row[judul_seo]'>".$row['judul']."</a>
                        </div>";
                        if ($no % 3 == 0){
                            echo "<div style='clear:both'><hr></div>";
                        }
                    $no++;
                }
            ?>
