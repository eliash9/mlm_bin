<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Agenda Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_agenda',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                    <tbody>
                      <input type='hidden' name='id' value=''>
                      <tr><th width='120px' scope='row'>Tema</th>   <td><input type='text' class='form-control' name='a'></td></tr>
                      <tr><th scope='row'>Isi Agenda</th>           <td><textarea id='editor1' class='form-control' name='b' style='height:260px'></textarea></td></tr>
                      <tr><th scope='row'>Gambar</th>               <td><input type='file' class='form-control' name='c'></td></tr>
                      <tr><th scope='row'>Tempat</th>               <td><input type='text' class='form-control' name='d'></td></tr>
                      <tr><th scope='row'>Jam <small>s/d</small> Selesai</th><td><input type='text' class='form-control' name='e'></td></tr>
                      <tr><th scope='row'>Tgl <small>s/d</small> Selesai</th><td><input type='text' class='form-control' id='rangepicker' name='f'></td></tr>
                      <tr><th scope='row'>Pengirim</th>             <td><input type='text' class='form-control' name='g'></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
