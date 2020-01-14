<?php
          $tanggal = tgl_indo($record['tgl_posting']);
          echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> $record[judul]</p>
                  <small class='date'><span class='glyphicon glyphicon-user'></span> Oleh : Administrator, $record[dibaca] View</small><hr>
            <div class='col-md-12'>";
                if ($record['gambar'] != ''){
                    echo "<img width='100%' src='".base_url()."asset/foto_statis/".$record['gambar']."'>";
                }
                echo "<p>$record[isi_halaman]</p>
            </div><div style='clear:both'><br></div>

            <p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; INFORMASI UTAMA</p><hr>";
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
