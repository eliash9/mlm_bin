<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Setting Data Bonus Konsumen</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/settingbonus',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$record[id_setting]'>
                    <tr><th width='140px' scope='row'>Bonus Pasangan</th>   <td><input type='number' class='form-control' name='a' value='$record[bonus_pasangan]'></td></tr>
                    <tr><th scope='row'>Bonus Tabungan</th>                 <td><input type='number' class='form-control' name='b' value='$record[bonus_tabungan]'></td></tr>
                    <tr><th scope='row'>Generasi Tabungan</th>            <td><input type='number' class='form-control' name='c' value='$record[gen_tabungan]'></td></tr>
                    <tr><th scope='row'>Min R.O</th>                  <td><input type='number' class='form-control' name='d' value='$record[min_bonus_ro]'></td></tr>
                    <tr><th scope='row'>% R.O</th>                    <td><input type='text' class='form-control' name='e' value='$record[persen_ro]'></td></tr>
                    <tr><th scope='row'>Generasi R.O</th>                 <td><input type='number' class='form-control' name='f' value='$record[gen_ro]'></td></tr>
                    <tr><th scope='row'>% Auto Save</th>              <td><input type='text' class='form-control' name='g' value='$record[persen_auto_save]'></td></tr>
                    <tr><th scope='row'>Max Auto Save</th>            <td><input type='number' class='form-control' name='h' value='$record[max_auto_save]'></td></tr>
                    <tr><th scope='row'>% PPN</th>                      <td><input type='text' class='form-control' name='j' value='$record[ppn]'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
