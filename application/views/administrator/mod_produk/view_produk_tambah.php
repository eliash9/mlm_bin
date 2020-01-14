<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Produk Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_produk',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='130px' scope='row'>Nama Produk</th>    <td><input type='text' class='form-control' name='a' required></td></tr>
                    <tr><th scope='row'>Harga Perwakilan</th>             <td><input type='number' class='form-control' name='dd'></td></tr>
                    <tr><th scope='row'>Harga Cabang</th>                 <td><input type='number' class='form-control' name='d'></td></tr>
                    <tr><th scope='row'>Harga Agen</th>                   <td><input type='number' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Harga Konsumen</th>               <td><input type='number' class='form-control' name='e'></td></tr>
                    <tr><th scope='row'>Stok Awal</th>                    <td><input type='number' class='form-control' name='g'></td></tr>
                    <tr><th scope='row'>Aktif</th>                        <td><input type='radio' name='f' value='Y' checked> Ya &nbsp; <input type='radio' name='f' value='N'> Tidak</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
