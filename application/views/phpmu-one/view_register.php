<?php
          echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Formulir Pendaftaran</p>
                  <p></p>
            <div style='clear:both'><br></div>
            <div class='col-md-12'>";
                if (isset($_POST['submit'])){
                    echo "<div class='alert alert-danger'>
                            <strong>GAGAL!</strong> - Kode Rahasia <b style='color:red'>".$this->input->post('id')."</b> Tidak Ditemukan...
                          </div>";
                }

                $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                echo form_open_multipart('auth/register',$attributes); 
                    echo "<input type='hidden' name='id' value='".$this->input->post('kode')."'>
                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Username</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-6'>
                            <input type='text' class='required form-control' name='a' minlength='5' onkeyup=\"nospaces(this)\">
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Password</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-6'>
                            <input type='password' class='required form-control' name='b' minlength='5'>
                        </div>
                        </div>
                    </div>

                    <div style='padding:8px; border-bottom:2px solid #337ab7' class='alert alert-info'>
                        <strong>DATA PEMOHON</strong>
                    </div>
                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Nama Lengkap</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='text' class='required form-control' name='c'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Alamat Email</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='email' class='required email form-control' name='d'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Jenis Kelamin</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='radio' name='e' value='Laki-laki'> Laki-laki &nbsp;
                            <input type='radio' name='e' value='Perempuan'> Perempuan
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Tanggal Lahir</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                                <select style='width:33%' name='af' class='form-control'><option value='' selected>- Tanggal -</option>";
                                                                    for($n=1; $n<=31; $n++){
                                                                            echo "<option value='$n'>$n</option>";
                                                                        }
                                echo "</select>
                                <select style='width:34%' name='bf' class='form-control'> <option value='' selected>- Bulan -</option>";
                                                                    $bln = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                                                                        for($n=1; $n<=12; $n++){
                                                                            echo "<option value='$n'>$bln[$n]</option>";
                                                                        }
                                echo "</select>
                                <select style='width:33%' name='cf' class='required form-control'> <option value='' selected>- Tahun -</option>";
                                                                        for($n=1955; $n<=date('Y')-5; $n++){ 
                                                                            echo "<option value='$n'>$n</option>";
                                                                        } 
                                                                        
                                echo "</select>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Nomor KTP</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-6'>
                            <input type='number' class='required number form-control' name='g'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputPassword3' class='col-sm-3 control-label'>Alamat Lengkap</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-lg-12'>
                            <textarea class='required form-control' name='h' style='height:60px' minlength='10'></textarea>
                        </div></div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Ahli Waris</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='text' class='required form-control' name='i'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Kota</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='text' class='required form-control' name='j'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Provinsi</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='text' class='required form-control' name='k'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>No Hp</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-6'>
                            <input type='number' class='required number form-control' name='l'  minlength='10'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Nama Bank</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required form-control' name='m'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>No Rekening</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required number form-control' name='n'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Atas Nama</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required form-control' name='o'>
                        </div>
                        </div>
                    </div>

                    <br>
                    <div class='form-group'>
                        <div class='col-sm-offset-2'>
                            <button type='submit' name='submit' class='btn btn-primary btn-sm'>Daftarkan</button>
                        </div>
                    </div>
                </form>
           </div>
            <div style='clear:both'><br></div>";
?>
