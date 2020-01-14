<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Paket Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_paket',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                   <tr><th width='140px' scope='row'>Nama paket</th>         <td><input type='text' class='form-control' name='a' required></td></tr>
                        <input type='hidden' value='0' class='form-control' name='b'>
                        <tr><th scope='row'>Members Kiri</th>                   <td><input type='number' class='form-control' name='c'></td></tr>
                        <tr><th scope='row'>Members Kanan</th>                   <td><input type='number' class='form-control' name='d'></td></tr>
                        <tr><th scope='row'>Nilai Produk</th>                 <td><input type='number' class='form-control' name='e'></td></tr>
                        <tr><th scope='row'>Bonus Traveling</th>               <td><input type='text' class='form-control' name='f'></td></tr>
                        <input type='hidden' value='0' class='form-control' name='g'>
                        <input type='number' class='form-control' value='0' name='h'>
                        <tr><th scope='row'>Keterangan</th>                  <td><textarea class='form-control' name='i' style='height:160px'></textarea></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
