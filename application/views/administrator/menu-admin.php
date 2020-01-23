        <section class="sidebar">
          <!-- Sidebar user panel -->
          <?php
          $log = $this->model_users->users_edit($this->session->username)->row_array(); 
          if ($log['foto']==''){ $foto = 'users.gif'; }else{ $foto = $log['foto']; }
            echo "<div class='user-panel'>
              <div class='pull-left image'>
                <img src='".base_url()."/asset/foto_user/$foto' class='img-circle' alt='User Image'>
              </div>
              <div class='pull-left info'>
                <p>$log[nama_lengkap]</p>
                <a href=''><i class='fa fa-circle text-success'></i> Online</a>
              </div>
            </div>";
          ?>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" style='color:#fff; text-transform:uppercase; border-bottom:2px solid #00c0ef'>MENU ADMIN</li>
            <li><a href="<?php echo base_url(); ?>administrator/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-th-list"></i> <span>Menu Utama</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("identitaswebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/identitaswebsite'><i class='fa fa-circle-o'></i> Identitas Website</a></li>";
                }

                $cek=$this->model_app->umenu_akses("menuwebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/menuwebsite'><i class='fa fa-circle-o'></i> Menu Website</a></li>";
                }

                $cek=$this->model_app->umenu_akses("halamanbaru",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/halamanbaru'><i class='fa fa-circle-o'></i> Halaman Baru</a></li>";
                }

                $cek=$this->model_app->umenu_akses("imagesslider",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/imagesslider'><i class='fa fa-circle-o'></i> Images Slider</a></li>";
                }
              ?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-pencil"></i> <span>Modul Berita</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("listberita",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/listberita'><i class='fa fa-circle-o'></i> Berita</a></li>";
                }

                $cek=$this->model_app->umenu_akses("kategoriberita",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/kategoriberita'><i class='fa fa-circle-o'></i> Kategori Berita</a></li>";
                }

                $cek=$this->model_app->umenu_akses("tagberita",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/tagberita'><i class='fa fa-circle-o'></i> Tag Berita</a></li>";
                }
              ?>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-camera"></i> <span>Modul Gallery</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("album",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/album'><i class='fa fa-circle-o'></i> Berita Foto</a></li>";
                }

                $cek=$this->model_app->umenu_akses("gallery",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/gallery'><i class='fa fa-circle-o'></i> Gallery Berita Foto</a></li>";
                }
              ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-film"></i> <span>Modul Video</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("playlist",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/playlist'><i class='fa fa-circle-o'></i> Playlist Video</a></li>";
                }

                $cek=$this->model_app->umenu_akses("video",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/video'><i class='fa fa-circle-o'></i> Video</a></li>";
                }
              ?>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-blackboard"></i> <span>Modul Iklan</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("iklanhome",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/iklanhome'><i class='fa fa-circle-o'></i> Iklan Home</a></li>";
                }

                $cek=$this->model_app->umenu_akses("iklansidebar",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/iklansidebar'><i class='fa fa-circle-o'></i> Iklan Sidebar</a></li>";
                }
              ?>
              </ul>
            </li>

              <?php
                $cek=$this->model_app->umenu_akses("testimoni",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/testimoni'><i class='glyphicon glyphicon-volume-up'></i> <span>Testimoni</span></a></li>";
                }
              ?>
            
            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-object-align-left"></i> <span>Modul Web</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("logowebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/logowebsite'><i class='fa fa-circle-o'></i> Logo Website</a></li>";
                }

                $cek=$this->model_app->umenu_akses("agenda",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/agenda'><i class='fa fa-circle-o'></i> Agenda</a></li>";
                }

                $cek=$this->model_app->umenu_akses("ym",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/ym'><i class='fa fa-circle-o'></i> WA CS</a></li>";
                }

                $cek=$this->model_app->umenu_akses("pesanmasuk",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/pesanmasuk'><i class='fa fa-circle-o'></i> Pesan Masuk</a></li>";
                }

                $cek=$this->model_app->umenu_akses("download",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/download'><i class='fa fa-circle-o'></i> Download Area</a></li>";
                }


              ?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-cog"></i> <span>Modul Users</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("manajemenuser",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/manajemenuser'><i class='fa fa-circle-o'></i> Manajemen User</a></li>";
                }

                $cek=$this->model_app->umenu_akses("manajemenmodul",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/manajemenmodul'><i class='fa fa-circle-o'></i> Manajemen Modul</a></li>";
                }
              ?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-gears"></i> <span>Modul System</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("koderahasia",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/koderahasia'><i class='fa fa-circle-o'></i> Daftar Kode Aktivasi</a></li>";
                }

                $cek=$this->model_app->umenu_akses("orderkode",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/orderkode'><i class='fa fa-circle-o'></i> Pemesanan Kode Umum</a></li>";
                }

                $cek=$this->model_app->umenu_akses("orderkodekonsumen",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/orderkodekonsumen'><i class='fa fa-circle-o'></i> Pemesanan Kode Konsumen</a></li>";
                }

                $cek=$this->model_app->umenu_akses("konsumen",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/konsumen'><i class='fa fa-circle-o'></i> List Data Konsumen</a></li>";
                }

                $cek=$this->model_app->umenu_akses("rekening",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/rekening'><i class='fa fa-circle-o'></i> No Rekening Perusahaan</a></li>";
                }

                $cek=$this->model_app->umenu_akses("tabungan",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/tabungan'><i class='fa fa-circle-o'></i> Manajemen Tabungan</a></li>";
                }

                $cek=$this->model_app->umenu_akses("bonushistory",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/bonushistory'><i class='fa fa-circle-o'></i> History Pembayaran Bonus</a></li>";
                }

                $cek=$this->model_app->umenu_akses("rekapkeuangan",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/rekapkeuangan'><i class='fa fa-circle-o'></i> Rekap Laporan Keuangan</a></li>";
                }

                $cek=$this->model_app->umenu_akses("keterangan",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/keterangan'><i class='fa fa-circle-o'></i> Info/Keterangan</a></li>";
                }

                $cek=$this->model_app->umenu_akses("settingbonus",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url()."administrator/settingbonus'><i class='fa fa-circle-o'></i> Setting Bonus</a></li>";
                }
              ?>
              </ul>
            </li>
            <li><a href="<?php echo base_url(); ?>administrator/edit_manajemenuser/<?php echo $this->session->username; ?>"><i class="fa fa-user"></i> <span>Edit Profile</span></a></li>
            <li><a href="<?php echo base_url(); ?>administrator/logout"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
          </ul>
        </section>