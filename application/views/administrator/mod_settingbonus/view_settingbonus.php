<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Setting Bonus</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/settingbonus',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$record[id_setting]'>
                    <tr><th width='150px' scope='row'>Bonus Level 1</th>                        <td><input type='number' class='form-control' name='a' value='$record[level_1]'></td></tr>
                    <tr><th scope='row'>Bonus Level 2</th>                        <td><input type='number' class='form-control' name='b' value='$record[level_2]'></td></tr>
                     <tr><th scope='row'>Bonus Sponsor</th>                        <td><input type='number' class='form-control' name='bb' value='$record[bonus_sponsor]'></td></tr>
                    <tr><th scope='row'>Harga Pin</th>                       <td><input type='number' class='form-control' name='c' value='$record[harga_pin]'></td></tr>
                    <tr><th scope='row'>Persen (%) PPN</th>                  <td><input type='text' class='form-control' name='d' value='$record[ppn]'></td></tr>

                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
