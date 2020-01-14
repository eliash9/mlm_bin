  <p class='sidebar-title'> Login Users</p> 

            <div class='alert alert-info'>Masukkan username dan password pada form berikut untuk login,...</div>
            <br>
            <div class="logincontainer">
                <form method="post" action="<?php echo base_url(); ?>auth/login" role="form" id='formku'>
                    <div class="form-group">
                        <label for="inputEmail">Username</label>
                        <input type="text" name="a" class="required form-control" placeholder="Masukkan Username" autofocus=""  minlength='5' onkeyup="nospaces(this)">
                    </div>

                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" name="b" class="form-control required" placeholder="Masukkan Password" autocomplete="off">
                    </div>

                    <div align="center">
                        <input name='login' type="submit" class="btn btn-primary" value="Login"> 
                        <a href="#" class="btn btn-default" data-toggle='modal' data-target='#lupass'>Lupa Password Anda?</a> 
                    </div>
                </form>
            </div>