<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Album</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_album',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_album]'>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='a' value='$rows[jdl_album]' required></td></tr>
                    <tr><th width='120px' scope='row'>Keterangan</th>   <td><textarea class='ckeditor form-control' name='b' style='height:250px'>$rows[keterangan]</textarea></td></tr>
                    <tr><th scope='row'>Ganti Gambar</th>               <td><input type='file' class='form-control' name='c'>";
                                                                        if ($rows['gbr_album'] != ''){ echo "<i style='color:red'>Lihat Cover Saat ini : </i><a target='_BLANK' href='".base_url()."asset/img_album/$rows[gbr_album]'>$rows[gbr_album]</a>"; } echo "</td></tr>
                    <tr><th scope='row'>Aktif</th>        <td>"; if ($rows['aktif']=='Y'){ echo "<input type='radio' name='f' value='Y' checked> Ya &nbsp; <input type='radio' name='f' value='N'> Tidak"; }else{ echo "<input type='radio' name='f' value='Y'> Ya &nbsp; <input type='radio' name='f' value='N' checked> Tidak"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
