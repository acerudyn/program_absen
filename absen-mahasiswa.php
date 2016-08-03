<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Absen Mahasiswa</title>
</head>

<body>
<?php 
date_default_timezone_set('Asia/Jakarta');
include "koneksi.php";
$tgl=date("Y-m-d");
session_start();

$tampil	= mysql_query("SELECT * FROM mahasiswa WHERE nim= '".$_SESSION['login_mahasiswa']."'"); 
$data 		= mysql_fetch_array($tampil);

$query	= mysql_query("select * from jurusan where kode_jurusan = '$data[kode_jurusan]' ");
$nama_jurusan	= mysql_fetch_array($query);

$query1	= mysql_query("select * from kelas where kode_kelas = '$data[kode_kelas]' ");
$nama_kelas	= mysql_fetch_array($query1);

?>

<table width="1129" height="250" border="0" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#0000FF;">
  <tr>
    <td width="515" rowspan="4" align="center" bgcolor="#E9E9E9">
    <img src="uploads/mahasiswa/<?php echo $data['photo']?>" width="199" height="199" style="border-radius:98px; border: #0000FF solid; " /><br/><br/><a href="logout.php"><div class="fa fa-power-off fa-1.5x"></div><span style="font-size:14px; font-weight:bold;">Log Out</span></a>
    </td>
    <td width="598" height="60" bgcolor="#E9E9E9"><div class="fa fa-lock fa-1.5x"></div> <strong><?php $nimku=$data['nim']; echo $nimku ?></strong></td>
  </tr>
  <tr>
    <td height="51" bgcolor="#E9E9E9"><div class="fa fa-user fa-1.5x"></div> <strong><?php echo $data['nama']; ?></strong></td>
  </tr>
  <tr>
    <td height="51" bgcolor="#E9E9E9"><div class="fa fa-star fa-1.5x"></div> <strong><?php echo $nama_jurusan['nama_jurusan']; ?></strong></td>
  </tr>
  <tr>
    <td height="51" bgcolor="#E9E9E9"><div class="fa fa-group fa-1.5x"></div> <strong><?php echo $nama_kelas['nama_kelas']; ?></strong></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<table width="1132" height="152" border="0" align="center">
  <tr>
    <td height="49" colspan="5" align="center" bgcolor="#0000FF"><strong style="font-family:Verdana, Geneva, sans-serif; font-size:27px; color:#CFF">JADWAL HARI INI</strong></td>
  </tr>   
  <tr style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;">
    <td width="168" height="30" align="center" bgcolor="#99FFFF">Tanggal</td>
    <td width="262" align="center" bgcolor="#99FFFF">Matakuliah</td>
    <td width="270" align="center" bgcolor="#99FFFF">Nama Dosen</td>
    <td width="233" align="center" bgcolor="#99FFFF">Jam mulai</td>
    <td width="165" align="center" bgcolor="#99FFFF">Absen</td>
  </tr>
<?php 
$tampil=mysql_query("select * from jadwal_kuliah where 
kode_jurusan='$data[kode_jurusan]' and kode_kelas='$data[kode_kelas]' ");

while($data=mysql_fetch_array($tampil)){	
		if($data['tanggal']!=$tgl){
			echo"";
		}elseif($data['tanggal']==$tgl){
if($tampil){
?>  
  <tr style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;" >
    <td height="38" align="center"><?php $tanggal= $data['tanggal'];echo $tanggal; ?></td>
    <td align="center"><?php 
	$query	= mysql_query("select * from mata_kuliah where kode_mata_kuliah = '$data[kode_mata_kuliah]' ");
$mata	= mysql_fetch_array($query);
	echo $mata['nama_mata_kuliah']; ?></td>
    <td align="center"><?php 
	$query	= mysql_query("select * from dosen where nid = '$data[nid]' ");
$dosen	= mysql_fetch_array($query);
	echo $dosen['nama']; ?></td>
    <td align="center"><?php $mulai=$data['jam_mulai']; echo $mulai;
	 $jam_sekarang=date("H:i:s");
	?></td>
    <td align="center"><form action="absen-save.php" method="post" name="form" target="_self">
    <input name="id_data" type="hidden"  value=""/>
    <input name="id_jadwal" type="hidden"  value="<?php $idjadwal=$data['id_jadwal']; echo $idjadwal; ?>" />
    <input name="nim" type="hidden" value="<?php echo $nimku ?>" />
    <input name="tanggal" type="hidden" value="<?php echo $tanggal; ?>" />
    <input name="jam" type="hidden" value="<?php echo $jam_sekarang ?>" />
    <input name="semester" type="hidden" value="<?php echo $data['semester'] ?>" />
    <input name="kode_matkul" type="hidden" value="<?php echo $data['kode_mata_kuliah'] ?>" />
    <input name="status" type="hidden" value="Sudah Absen" />
 
    <?php
	 $qry = mysql_query("SELECT * FROM data_absen_mhs_tmp WHERE id_jadwal='$idjadwal' and nim='$nimku' ");
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
    </form>    
    </td>
  </tr> <?php } 
  		}
	}		
   ?>			
  
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>