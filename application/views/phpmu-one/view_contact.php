<?php
          echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Hubungi Kami</p>
                  <iframe width='100%' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='$maps'></iframe>
                  <div style='clear:both'></div>
                  <p>Siahkan meninggalkan Pesan / Komentar / Masukan dari anda agar kami bisa memberikan pelayanan yang lebih baik lagi, Terima kasih.</p>
            <div style='clear:both'><br></div>
            <div class='col-md-12'>";
                $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                $ip         = $_SERVER['REMOTE_ADDR'];
                echo form_open_multipart('contact',$attributes); 
                    echo "<div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Nama Lengkap</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span>
                            <input type='text' class='required form-control' name='a'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Alamat Email</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <span class='input-group-addon'><i class='glyphicon glyphicon-envelope'></i></span>
                            <input type='text' class='required form-control' name='b'>
                        </div>
                        </div>
                    </div>

                    <input type='hidden' class='required form-control' name='c' value='$ip'>

                    <div class='form-group'>
                        <label for='inputPassword3' class='col-sm-3 control-label'>Isi Pesan</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-lg-12'>
                            <span class='input-group-addon'><i class='glyphicon glyphicon-book'></i></span>
                            <textarea class='required form-control' name='d' style='height:130px' minlength='10'></textarea>
                        </div></div>
                    </div>

                    <br>
                    <div class='form-group'>
                        <div class='col-sm-offset-2'>
                            <button type='submit' name='submit' class='btn btn-primary btn-sm'>Kirimkan</button>
                        </div>
                    </div>
                </form>
           </div>
            <div style='clear:both'><br></div>";
