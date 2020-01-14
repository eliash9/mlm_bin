<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Produk Terpilih</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_produk',$attributes);
              $jual = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_konsumen_order where id_produk='$rows[id_produk]'")->row_array(); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_produk]'>
                    <tr><th width='130px' scope='row'>Nama Produk</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama_produk]' required></td></tr>
                    <tr><th scope='row'>Harga Perwakilan</th>             <td><input type='number' class='form-control' name='dd' value='$rows[cabang]'></td></tr>
                    <tr><th scope='row'>Harga Cabang</th>                 <td><input type='number' class='form-control' name='d' value='$rows[distributor]'></td></tr>
                    <tr><th scope='row'>Harga Agen</th>                   <td><input type='number' class='form-control' name='c' value='$rows[agen]'></td></tr>
                    <tr><th scope='row'>Harga Konsumen</th>               <td><input type='number' class='form-control' name='e' value='$rows[konsumen]'></td></tr>
                    <tr><th scope='row'>Stok</th>                         <td><input type='number' class='form-control' value='".($rows['stok']-$jual['jumlah'])."' disabled></td></tr>
                    <tr><th scope='row'>Tambah Stok</th>                  <td><input type='number' class='form-control' name='g'></td></tr>
                    <tr><th scope='row'>Aktif</th>                        <td>"; if ($rows['status']=='Y'){ echo "<input type='radio' name='f' value='Y' checked> Ya &nbsp; <input type='radio' name='f' value='N'> Tidak"; }else{ echo "<input type='radio' name='f' value='Y'> Ya &nbsp; <input type='radio' name='f' value='N' checked> Tidak"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
