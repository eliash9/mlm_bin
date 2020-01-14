            <a style='color:#000' href='<?php echo base_url(); ?>administrator/konsumen'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-key"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Kode Aktivasi</span>
                  <?php $jmla = $this->db->query("SELECT * FROM rb_konsumen where status='free'")->num_rows(); ?>
                  <span class="info-box-number"><?php echo $jmla; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='<?php echo base_url(); ?>administrator/koderahasia'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Konsumen</span>
                  <?php $jmlb = $this->db->query("SELECT * FROM rb_konsumen")->num_rows(); ?>
                  <span class="info-box-number"><?php echo $jmlb; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='<?php echo base_url(); ?>administrator/orderkode'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-tower"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Order Umum</span>
                  <?php $jmlc = $this->db->query("SELECT * FROM rb_order_kode")->num_rows(); ?>
                  <span class="info-box-number"><?php echo $jmlc; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='<?php echo base_url(); ?>administrator/orderkodekonsumen'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Order Konsumen</span>
                  <?php $jmld = $this->db->query("SELECT * FROM rb_order_kode_konsumen")->num_rows(); ?>
                  <span class="info-box-number"><?php echo $jmld; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <section class="col-lg-7 connectedSortable">
                <?php include "home_grafik.php"; ?>
            </section><!-- /.Left col -->

            <section class="col-lg-5 connectedSortable">
                <?php include "home_berita.php"; ?>

            </section><!-- right col -->
            