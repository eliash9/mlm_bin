<?php 
$set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
$tot = $this->model_members->totbonus($this->uri->segment(3))->row_array();
$cair = $this->model_members->totpencairan($this->uri->segment(3))->row_array();

$totpens = $this->model_members->totpencairans($this->uri->segment(3))->row_array();
$totbons = $this->model_members->totbonuss($this->uri->segment(3))->row_array();

$ppn = 10/100*(($tot['nominal']-$cair['nominal_bayar'])+($totbons['nominal']-$totpens['nominal_bayar']));
$totalbonusbersih = (($tot['nominal']-$cair['nominal_bayar'])+($totbons['nominal']-$totpens['nominal_bayar']))-$ppn;
?>
<script type="text/javascript">
    $(document).ready(function(){
        function addCommas(nStr){
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    $(".input").keyup(function(){
          var val1 = +$(".value1").val();
          var val11 = +$(".value11").val();

          $("#result").val(addCommas(<?php echo $set['ppn']; ?>/100*(val1+val11)));
          $("#result1").val(addCommas((val1+val11) - (<?php echo $set['ppn']; ?>/100*(val1+val11))));
   });
});
</script>
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Form Pembayaran Manual Bonus Konsumen </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
        <?php
            echo "<div class='col-md-12'>";
                $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                echo form_open_multipart('administrator/keuanganbayarmanual',$attributes); 
            echo "<table class='table table-condensed table-bordered'>
                      <tbody>
                        <input type='hidden' name='id' value=''>
                        <tr><th width='150px' scope='row'>Username</th>    <td><input type='text' value='".$this->uri->segment(3)."' class='required number form-control' name='a' readonly='on'></td></tr>
                        <tr><th>Bayar Bonus </th>    <td><input type='number' class='required number form-control input value1' name='b' value='".($tot['nominal']-$cair['nominal_bayar'])."'></td></tr>
                        <tr><th>Bayar Bonus Sponsor </th>    <td><input type='number' class='required number form-control input value11' name='bb' value='".($totbons['nominal']-$totpens['nominal_bayar'])."'></td></tr>
                        <input type='hidden' class='required number form-control input value3' name='d' value='0'>
                        
                        <tr><th>Pajak 10%</th>    <td><input type='text' class='required number form-control' name='f' id='result' value='".rupiah($ppn)."' disabled></td></tr>
                        <tr><th>Total Tagihan</th>    <td><input type='text' class='required number form-control' name='h' id='result1' value='".rupiah($totalbonusbersih)."' disabled></td></tr>
                      </tbody>
                  </table>

                <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-success'>Proses Pembayaran</button>
                    <a href='".base_url()."administrator/rekapkeuangan'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                </div>
                </div>";

            ?>
        </div>
