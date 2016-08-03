<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Absen Dosen</title>
<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
</head>

<body>
<?php 
date_default_timezone_set('Asia/Jakarta');
include "koneksi.php";
$tgl=date("Y-m-d");
session_start();

$tampil	= mysql_query("SELECT * FROM dosen WHERE nid= '".$_SESSION['login_dosen']."'"); 
$data 		= mysql_fetch_array($tampil);

?>
<table width="938" height="306" border="0" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#0000FF;">
  <tr>
    <td width="428" rowspan="3" align="center" bgcolor="#E9E9E9"><img src="uploads/dosen/<?php echo $data['photo']?>" width="99" height="99" style="border-radius:51px; border: #0000FF solid; " /></td>
    <td width="527" height="41" bgcolor="#E9E9E9"><div class="fa fa-lock fa-1.5x"></div> <strong><?php $nidku=$data['nid']; echo $nidku ?></strong></td>
  </tr>
  <tr>
    <td height="41" bgcolor="#E9E9E9"><div class="fa fa-user fa-1.5x"></div> <strong><?php echo $data['nama']; ?></strong></td>
  </tr>
  <tr>
    <td height="25" bgcolor="#E9E9E9"><a href="logout-dosen.php"><div class="fa fa-power-off fa-1.5x"></div><span style="font-size:13px; font-weight:bold;"> Log Out</span></a></td>
  </tr>
  <tr>
    <td height="31" colspan="2" align="center" bgcolor="#0000FF"><strong style="font-family:Verdana, Geneva, sans-serif; font-size:21px; color:#CFF">JADWAL HARI INI</strong></td>
  </tr>
  <tr>
    <td height="111" colspan="2" align="center" valign="top" bgcolor="#E9E9E9">  
      
      <table width="930" height="70" border="0" align="center">
        <tr style="font-size:13px; color:#000; font-weight:bold;">
          <td width="106" height="29" align="center" bgcolor="#99FFFF">Tanggal</td>
          <td width="109" align="center" bgcolor="#99FFFF">Jam Mulai</td>
          <td width="131" align="center" bgcolor="#99FFFF">Jurusan</td>
          <td width="98" align="center" bgcolor="#99FFFF">Kelas</td>
          <td width="87" align="center" bgcolor="#99FFFF">Semester</td>
          <td width="181" align="center" bgcolor="#99FFFF">Mata Kuliah</td>
          <td width="172" align="center" bgcolor="#99FFFF">Absen</td>
        </tr>
<?php 
$tampil=mysql_query("select * from jadwal_kuliah where 
nid='$nidku' ");

while($data=mysql_fetch_array($tampil)){
	
	if($data['tanggal']!=$tgl){
			echo "";
		}elseif($data['tanggal']==$tgl){
if($tampil){
		
?>
        
        <tr style="font-size:14px; color:#000;" align="center">
          <td height="33"><?php $tanggal= $data['tanggal'];echo $tanggal; ?>
          </td>
          <td><?php $mulai=$data['jam_mulai']; echo $mulai;
	 $jam_sekarang=date("H:i:s");
	?></td>
          <td><?php 
		  $query	= mysql_query("select * from jurusan where kode_jurusan = '$data[kode_jurusan]' ");
$nama_jurusan	= mysql_fetch_array($query);
		  echo $nama_jurusan['nama_jurusan']; ?></td>
          <td><?php 
		  $query1	= mysql_query("select * from kelas where kode_kelas = '$data[kode_kelas]' ");
$nama_kelas	= mysql_fetch_array($query1);
		  echo $nama_kelas['nama_kelas']; ?></td>
          <td><?php echo $data['semester']; ?></td>
          <td><?php 
	$query	= mysql_query("select * from mata_kuliah where kode_mata_kuliah = '$data[kode_mata_kuliah]' ");
$mata	= mysql_fetch_array($query);
	echo $mata['nama_mata_kuliah']; ?>
    	  </td>
          <td valign="middle"> <form action="absen-dosen.php" method="post" name="form" target="_self">
    <input name="id_data" type="hidden"  value=""/>
    <input name="id_jadwal" type="hidden"  value="<?php $idjadwal= $data['id_jadwal']; echo $idjadwal; ?>" />
    <input name="nid" type="hidden" value="<?php echo $nidku ?>" />
    <input name="tanggal" type="hidden" value="<?php echo $tanggal; ?>" />
    <input name="jam" type="hidden" value="<?php echo $jam_sekarang ?>" />
    <input name="semester" type="hidden" value="<?php echo $data['semester'] ?>" />
    <input name="kode_matkul" type="hidden" value="<?php echo $data['kode_mata_kuliah'] ?>" />
 
    <?php
$qry = mysql_query("SELECT * FROM data_absen_dosen WHERE id_jadwal='$idjadwal' and nid='$nidku' ");
$data1			= mysql_fetch_array($qry);
$tanggal1		= $data1['tgl'];
$baris			= mysql_num_rows($qry);	
$batas_absen	= $jam_sekarang - $mulai;

	 if(($baris >= 1) and ($tanggal == $tanggal1)){
			echo "Sudah Absen";	
		}elseif($jam_sekarang > $mulai and $batas_absen < 1){
			echo "<input name='simpan' type='submit' value='Absen Masuk' id='edit' onclick='editabsen();' />";
		}elseif($batas_absen >= 1){
			echo "Waktu Absen Habis";	
		}else{
			echo"Belum Mulai";
		}		
	?>  
    </form>----------------------------------
    <form id="form1" name="form1" method="post" action="lihat-absen.php">
     <input name="id_jadwal" type="hidden"  value="<?php echo $data['id_jadwal'] ?>" />
          <input type="submit" name="send" id="button" value="Lihat Absen Mahasiswa" />
          </form></td>
        </tr>
 <?php } 
  		}
	}		
   ?>	        
      </table>
    </td>
    </tr>
  <tr>
    <td height="25" colspan="2" align="left" bgcolor="#0000FF">&nbsp;</td>
  </tr>
</table>
</body>
</html>