<?php
          echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Order PIN Aktivasi</p>
          <p>Silahkan melengkapi data dibawah ini untuk melakukan pemesanan kode aktivasi. <br>
             pastikan semua data yang di inputkan sudah benar.</p>
                  <p></p>
            <div style='clear:both'><br></div>
            <div class='col-md-12'>";
                $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                echo form_open_multipart('auth/order',$attributes); 
                $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
                    echo "<input type='hidden' name='id' value='".$this->input->post('kode')."'>
                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Jumlah Pin</label>
                        <div class='col-sm-9'>
                            $jml Pin
                            <input type='hidden' value='$jml' name='jml'>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Total Harga</label>
                        <div class='col-sm-9'>
                            Rp ".rupiah($jml*$set['harga_pin'])."
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Nama Lengkap</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='text' class='required form-control' name='a'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Alamat Email</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='email' class='required email form-control' name='b'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>No Handphone</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-6'>
                            <input type='number' class='required number form-control' name='c'  minlength='10'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Kota</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-6'>
                            <input type='text' class='required form-control' name='d'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Nama Bank</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required form-control' name='e'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>No Rekening</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='number' class='required number form-control' name='f'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Pemilik Rekening</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required form-control' name='g'>
                        </div>
                        </div>
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
?>
