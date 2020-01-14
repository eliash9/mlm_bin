<?php
          echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Formulir Pendaftaran</p>";
                if ($error != ''){
                  echo "<p><div class='alert alert-danger'>$error</div></p>";
                }
            
            echo "<div style='clear:both'><br></div>
            <div class='col-md-12'>";
            echo validation_errors();
            $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
            $username = $this->uri->segment(3);
            $posisi = $this->uri->segment(4);
            echo form_open_multipart('members/tambah_jaringan/'.$username.'/'.$posisi,$attributes); 
              echo "<div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Sponsor</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required form-control' name='sps' id='sponsor' value='".$this->session->username."' readonly>
                            <span generated='true' style='font-size:12px' id='messagesponsor'></span>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Upline</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required form-control' name='upl' value='".$this->uri->segment(3)."' readonly>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Kode Aktivasi</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-6'>
                            <input type='text' class='required form-control' id='kodeaktivasi' name='id' minlength='5' value='".$this->input->post('kode')."'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Username</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required form-control' id='username' name='a' minlength='5' value='".$this->input->post('a')."' onkeyup=\"nospaces(this)\">
                            <label generated='true' class='error' id='messageusername'></label>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Password</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='password' class='required form-control' name='b' value='".$this->input->post('b')."' minlength='5'>
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
                            <input type='text' class='required form-control' name='c' value='".$this->input->post('c')."'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Alamat Email</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='email' class='required email form-control' id='email' name='d' value='".$this->input->post('d')."'>
                            <label generated='true' class='error' id='message'></label>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Jenis Kelamin</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>";
                        if ($this->input->post('e')=='Laki-laki'){
                            echo "<input type='radio' name='e' value='Laki-laki' checked> Laki-laki &nbsp;
                                  <input type='radio' name='e' value='Perempuan'> Perempuan";
                        }else{
                            echo "<input type='radio' name='e' value='Laki-laki'> Laki-laki &nbsp;
                                  <input type='radio' name='e' value='Perempuan' checked> Perempuan";
                        }
                        echo "</div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Tanggal Lahir</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                                <select style='width:33%' name='af' class='form-control'><option value='' selected>- Tanggal -</option>";
                                                                    for($n=1; $n<=31; $n++){
                                                                        if ($this->input->post('af')==$n){
                                                                            echo "<option value='$n' selected>$n</option>";
                                                                        }else{
                                                                            echo "<option value='$n'>$n</option>";
                                                                        }
                                                                    }
                                echo "</select>
                                <select style='width:34%' name='bf' class='form-control'> <option value='' selected>- Bulan -</option>";
                                                                    $bln = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                                                                        for($n=1; $n<=12; $n++){
                                                                            if ($this->input->post('bf')==$n){
                                                                                echo "<option value='$n' selected>$bln[$n]</option>";
                                                                            }else{
                                                                                echo "<option value='$n'>$bln[$n]</option>";
                                                                            }
                                                                        }
                                echo "</select>
                                <select style='width:33%' name='cf' class='required form-control'> <option value='' selected>- Tahun -</option>";
                                                                        for($n=1955; $n<=date('Y')-5; $n++){ 
                                                                            if ($this->input->post('cf')==$n){
                                                                                echo "<option value='$n' selected>$n</option>";
                                                                            }else{
                                                                                echo "<option value='$n'>$n</option>";
                                                                            }
                                                                        } 
                                                                        
                                echo "</select>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Nomor KTP</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='number' class='required number form-control' id='ktp' name='g' value='".$this->input->post('g')."'>
                            <label generated='true' class='error' id='messagektp'></label>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputPassword3' class='col-sm-3 control-label'>Alamat Lengkap</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-lg-12'>
                            <textarea class='required form-control' name='h' style='height:60px' minlength='10'>".$this->input->post('h')."</textarea>
                        </div></div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Ahli Waris</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='text' class='required form-control' name='i' value='".$this->input->post('i')."'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Kota</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='text' class='required form-control' name='j' value='".$this->input->post('j')."'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Provinsi</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-12'>
                            <input type='text' class='required form-control' name='k' value='".$this->input->post('k')."'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>No Hp</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-6'>
                            <input type='number' class='required number form-control' name='l'  minlength='10' value='".$this->input->post('l')."'>
                        </div>
                        </div>
                    </div>

                    <div style='padding:8px; border-bottom:2px solid #337ab7' class='alert alert-info'>
                        <strong>DATA BANK</strong>
                    </div>
                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Nama Bank</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required form-control' name='m' value='".$this->input->post('m')."'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>No Rekening</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required number form-control' name='n' value='".$this->input->post('n')."'>
                        </div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-3 control-label'>Atas Nama</label>
                        <div class='col-sm-9'>
                        <div style='background:#fff;' class='input-group col-sm-8'>
                            <input type='text' class='required form-control' name='o' value='".$this->input->post('o')."'>
                        </div>
                        </div>
                    </div>

                    <input type='hidden' name='q' value='".$this->uri->segment(4)."'>

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
