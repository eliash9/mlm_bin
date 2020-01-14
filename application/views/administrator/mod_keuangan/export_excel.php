<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data-keuangan-konsumen.xls");
$iden = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
?>
<html>
<head>
<title>Export Excel</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/printer.css">
</head>
<body onload="window.print()">
<center><table border=0>
  <tr><td colspan='10'><center><h1><?php echo $iden['nama_website']; ?><br><span style='font-size:12px'><?php echo $iden['alamat']; ?></span></h1></center></td></tr>
  <tr><td colspan='10'><center>DATA KEUANGAN KONSUMEN</center></td></tr>
  <tr><td colspan='10'><center><?php echo "Sampai saat ini (".tgl_indo(date('Y-m-d'))." ".date('H:i:s').")"; ?></center></td></tr>
</table></center><br>
                  <table width='100%' border='1'>
                      <tr>
                        <th>Kode Konsumen</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Bank</th>
                        <th>No Rekening</th>
                        <th>Rekening Virtual</th>
                        <th>Atas Nama</th>
                        <th>Bonus</th>
                        <th>Pajak 10%</th>
                        <th>Tagihan</th>
                      </tr>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $tots = $this->model_members->totbonus($row['username'])->row_array();
                    $cair = $this->model_members->totpencairan($row['username'])->row_array();
                    $ppn = 10/100*($tots['nominal']-$cair['nominal_bayar']);
                    $totalbonusbersih = ($tots['nominal']-$cair['nominal_bayar'])-$ppn;             
                    
                      if ($totalbonusbersih > 1){
                          echo "<tr><td><a href='".base_url()."administrator/detail_konsumen/$row[id_konsumen]'>$row[kode_konsumen]</a></td>
                                  <td>$row[username]</td>
                                  <td>$row[nama_lengkap]</td>
                                  <td>$row[nama_bank]</td>
                                  <td>$row[no_rekening]</td>
                                  <td>$row[rekning_virtual]</td>
                                  <td>$row[atas_nama]</td>
                                  <td>Rp ".rupiah($tots['nominal']-$cair['nominal_bayar'])."</td>
                                  <td>Rp ".rupiah($ppn)."</td>
                                  <td style='font-weight:bold; color:red'>Rp ".rupiah($totalbonusbersih)."</td>
                                  
                              </tr>";
                      }
                      $no++;
                    }
                  ?>
                </table>
</body>
</html>