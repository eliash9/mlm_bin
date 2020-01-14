<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Video</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_video',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_video]'>
                    <tr><th width='120px' scope='row'>Playlist</th>    <td><select name='aa' class='form-control'>
                                                                        <option value='' selected>- Pilih -</option>"; 
                                                                      foreach ($row->result_array() as $r) {
                                                                        if ($rows['id_playlist']==$r['id_playlist']){
                                                                          echo "<option value='$r[id_playlist]' selected>$r[jdl_playlist]</option>";
                                                                        }else{
                                                                          echo "<option value='$r[id_playlist]'>$r[jdl_playlist]</option>";
                                                                        }
                                                                      }
                                                                  echo "</select></td></tr>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='a' value='$rows[jdl_video]' required></td></tr>
                    <tr><th width='120px' scope='row'>Keterangan</th>   <td><textarea class='ckeditor form-control' name='b' style='height:250px'>$rows[keterangan]</textarea></td></tr>
                    <tr><th scope='row'>Ganti Gambar</th>               <td><input type='file' class='form-control' name='c'>";
                                                                        if ($rows['gbr_video'] != ''){ echo "<i style='color:red'>Lihat Foto Saat ini : </i><a target='_BLANK' href='".base_url()."asset/img_video/$rows[gbr_video]'>$rows[gbr_video]</a>"; } echo "</td></tr>
                    <tr><th scope='row'>Youtube</th>          <td><input type='text' class='form-control' name='d' value='$rows[youtube]' required></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
