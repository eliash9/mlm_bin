            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Form Pembayaran Bonus Traveling Konsumen</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
        <?php
            echo "<div class='col-md-12'>";
                $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                echo form_open_multipart('administrator/bayartabungan',$attributes); 
                echo "<input type='hidden' value='$tot[level]' name='bns'>
                <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Username</th>    <td><input type='text' class='required number form-control' name='a' placeholder='Input Username Konsumen...'></td></tr>
                    <tr><th>Total Bayar</th>    <td><input type='number' class='required number form-control' name='b' value='0'></td></tr>
                    <tr><th scope='row'>Tanggal Bayar</th>                 <td><input type='text' class='datepicker required form-control' data-date-format='dd-mm-yyyy' name='c' value='".date('d-m-Y')."'></td></tr>
                    <tr><th scope='row'>Keterangan</th>                   <td><textarea class='form-control' name='d' style='height:130px' placeholder='Tulis Keterangan Jika ada,..'></textarea></td></tr>
                    
                  </tbody>
                  </table>

                <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url()."administrator/tabungan'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                </div>
                </div>";

            ?>
        </div>
