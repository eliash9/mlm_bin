  <p class='sidebar-title'> Input Kode Aktivasi</p> 

            <div class='alert alert-info'>Masukkan Kode aktivasi anda pada form dibawah ini,...</div>
            <br>
            <div class="logincontainer">
                <?php
                $attributes1 = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                echo form_open_multipart('auth/register',$attributes1); 
                ?>
                    <div class='form-group'>
                        <label for="inputEmail">Input Kode Aktivasi Pendaftaran :</label>
                        <input type='text' class='required form-control' name='kode' placeholder='********************'>
                        
                        <div align="center">
                        <button style='margin-top:5px' type='submit' name='kirim' class='btn btn-primary btn-sm'>Proses Kode</button>
                        &nbsp; &nbsp;  Belum Punya Kode? <a href='<?php echo base_url(); ?>auth/reg/order' title="Pesan Kode Aktivasi!!!">Order Disini</a>
                        </div>
                    </div>
                </form>
            </div>