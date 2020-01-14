  <p class='sidebar-title'> Order Kode Aktivasi</p> 

            <div class='alert alert-info'>Pilih berapa banyak PIN yang akan di order.</div>
            <br>
            <div class="logincontainer">
                <?php
                $attributes1 = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                echo form_open_multipart('auth/order',$attributes1); 
                ?>
                    <div class='form-group'>
                        <label for="inputEmail">Jumlah Pin :</label>
                        <select class='required form-control' name='jml' required>
                        <?php 
                          for ($i = 1; $i <= 50; $i++){
                              echo "<option value='$i'>$i</option>";
                          }
                        ?>
                        </select>
                        <div align="center">
                            <button style='margin-top:5px' type="submit" name='order' class="btn btn-sm btn-primary">Selanjutnya <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
                        </div>
                    </div>
                </form>
            </div>