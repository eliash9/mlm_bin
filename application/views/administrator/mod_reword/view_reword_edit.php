<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Bonus Reword</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_reword',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_reword]'>
                    <tr><th width='120px' scope='row'>Posisi</th>    <td><input type='text' class='form-control' name='a' value='$rows[posisi]' required></td></tr>
                    <tr><th scope='row'>Kanan</th>              <td><input type='text' class='form-control' value='$rows[ket_kanan]' name='c'></td></tr>
                    <tr><th scope='row'>Kiri</th>               <td><input type='text' class='form-control' value='$rows[ket_kiri]' name='e'></td></tr>
                    <tr><th scope='row'>Reword</th>                  <td><input type='text' class='form-control' value='$rows[reword]' name='f'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
