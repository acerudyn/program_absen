<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lihat Absen</title>
<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
</head>

<body>
<?php 
date_default_timezone_set('Asia/Jakarta');
include "koneksi.php";
$tgl=date("Y-m-d");
$jam_sekarang=date("H:i:s");
session_start();

$tampil	= mysql_query("SELECT * FROM dosen WHERE nid= '".$_SESSION['login_dosen']."'"); 
$data 		= mysql_fetch_array($tampil);

$idjadwal		= $_POST['id_jadwal'];

$query = mysql_query("SELECT * FROM jadwal_kuliah WHERE id_jadwal='$idjadwal' ");
$data1 = mysql_fetch_array($query);
$mulai = $data1['jam_mulai'];

$query1 = mysql_query("SELECT * FROM kelas WHERE kode_kelas='$data1[kode_kelas]' ");
$nama_kelas = mysql_fetch_array($query1);

$query2 = mysql_query("SELECT * FROM jurusan WHERE kode_jurusan='$data1[kode_jurusan]' ");
$nama_jurusan = mysql_fetch_array($query2);

$query3 = mysql_query("SELECT * FROM mata_kuliah WHERE kode_mata_kuliah='$data1[kode_mata_kuliah]' ");
$nama_matkul = mysql_fetch_array($query3);

?>
<table width="938" height="322" border="0" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#0000FF;">
  <tr>
    <td width="428" rowspan="3" align="center" bgcolor="#E9E9E9"><img src="uploads/dosen/<?php echo $data['photo']?>" width="99" height="99" style="border-radius:51px; border: #0000FF solid; " /><br/><br/>
    <a href="logout-dosen.php"><div class="fa fa-power-off fa-1x"></div><span style="font-size:11px; font-weight:bold;"> Log Out</span></a></td>
    <td width="527" height="48" bgcolor="#E9E9E9"><div class="fa fa-lock fa-1.5x"></div> <strong><?php $nidku=$data['nid']; echo $nidku ?></strong></td>
    <td width="527" bgcolor="#E9E9E9"><div class="fa fa-star fa-1.5x"></div> <strong><?php echo $nama_jurusan['nama_jurusan']; ?></strong></td>
  </tr>
  <tr>
    <td height="51" bgcolor="#E9E9E9"><div class="fa fa-user fa-1.5x"></div> <strong><?php echo $data['nama']; ?></strong></td>
    <td bgcolor="#E9E9E9"><div class="fa fa-group fa-1.5x"></div> <strong><?php echo $nama_kelas['nama_kelas']; ?></strong></td>
  </tr>
  <tr>
    <td height="41" bgcolor="#E9E9E9"><div class="fa fa-calendar fa-1.5x"></div> <strong><?php echo $data1['tanggal']; ?></strong></td>
    <td bgcolor="#E9E9E9"><div class="fa fa-book fa-1.5x"></div> <strong><?php echo $nama_matkul['nama_mata_kuliah']; ?></strong></strong></td>
  </tr>
  <tr>
    <td height="42" colspan="3" align="center" bgcolor="#0000FF"><strong style="font-family:Verdana, Geneva, sans-serif; font-size:21px; color:#CFF">ABSENSI MAHASISWA HARI INI</strong></td>
  </tr>
  <tr>
    <td height="94" colspan="3" align="center" valign="top" bgcolor="#E9E9E9">  
      
      <table width="1000" height="107" border="0" align="center">
        <tr style="font-size:13px; color:#000; font-weight:bold;">
          <td width="48" align="center" bgcolor="#99FFFF">No</td>
          <td width="246" height="33" align="center" bgcolor="#99FFFF">NIM</td>
          <td width="437" align="center" bgcolor="#99FFFF">Nama</td>
          <td width="251" align="center" bgcolor="#99FFFF">Absen</td>
        </tr>
<?php 
$tampil=mysql_query("select * from mahasiswa where 
kode_jurusan='$nama_jurusan[kode_jurusan]' and kode_kelas='$nama_kelas[kode_kelas]' ");
$no=0;

while($data=mysql_fetch_array($tampil)){
$no++;
$nim   = $data['nim'];	
	
?>
        
        <tr style="font-size:14px; color:#000;" align="center">
          <td><?php echo $no; ?></td>
          <td height="33"><?php echo $data['nim']; ?>
          </td>
          <td><?php echo $data['nama'];?></td>
          <td valign="middle">
		  <form action="absen-via-dosen.php" method="post" name="form" target="_self">
          <input name="id_data" type="hidden"  value=""/>
    <input name="id_jadwal" type="hidden"  value="<?php echo $idjadwal; ?>" />
    <input name="nim" type="hidden" value="<?php echo $nim; ?>" />
    <input name="tanggal" type="hidden" value="<?php echo $tgl;  ?>" />
    <input name="jam" type="hidden" value="<?php echo $jam_sekarang ?>" />
    <input name="semester" type="hidden" value="<?php echo $data1['semester'] ?>" />
    <input name="kode_matkul" type="hidden" value="<?php echo $data1['kode_mata_kuliah'] ?>" />
 
          
		  <?php
		  $batas_absen= $jam_sekarang - $mulai;
		   $query = mysql_query("SELECT * FROM data_absen_mhs_tmp WHERE id_jadwal='$idjadwal' and nim='$nim' ");
$data1=mysql_fetch_array($query);
$baris=mysql_num_rows($query);
			?>
		  <input name="absen" type="radio" value="Sudah Absen" <?php if($baris >= 1){echo 'checked';}?> />Sudah Absen
			  
			  <input name="absen" type="radio" value="Belum Absen" <?php if($baris < 1){echo 'checked';}?> />Belum Absen
			</form>
          </td>
        </tr>
      
        <?php  
  	}		
   ?>	
        <tr style="font-size:14px; color:#000;" align="center">
          <td height="33" colspan="4" bgcolor="#99FFFF">
          <form action="absen-via-dosen.php" method="post" name="form" target="_self">
<?php 
$tampil1=mysql_query("select * from data_absen_mhs_tmp WHERE id_jadwal='$idjadwal' ");
while($data2=mysql_fetch_array($tampil1)){
?>
 <input name="idjadwal" type="hidden" value="<?php echo $idjadwal ?>" /> 
 
<?php
}
?>
          <input type="submit" name="save"  value="Simpan" />
          </form></td>
        </tr>
         
      </table>
    </td>
  </tr>
  <tr>
    <td height="25" colspan="3" align="left" bgcolor="#0000FF">&nbsp;</td>
  </tr>
</table>
</body>
</html>