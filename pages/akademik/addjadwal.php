<script src="js/jquery-ui.js"></script>
<script>
$(function() {
$("#datepicker3").datepicker({        
		 dateFormat: "yy-mm-dd",
    });
});
</script>
<?php
ob_start();
?>
<form method="post" class="form-horizontal" name="form1" id="form1" enctype="multipart/form-data" onsubmit="return validateForm()"  />
<div class="control-group">
<label class="control-label">Tanggal</label>
<div class="controls">
<input type="text" name="tgl" id="datepicker3" class="input-small">
</div>
</div>
<div class="control-group">
<label class="control-label">Jam Mulai</label>
<div class="controls">
<input type="text" name="jam" id="jam" class="input-small">Ex. 15:45
</div>
</div>
<div class="control-group">
<label class="control-label">Jurusan</label>
<div class="controls">
<select name="jurusan" id="jurusan">
<option value="">--Pilih Jurusan--</option>
<?php 
$q=mysql_query("Select * from jurusan");
while($r=mysql_fetch_array($q))
{
echo "<option value='$r[kode_jurusan]'> $r[nama_jurusan]
</option>"; } ?>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Kelas</label>
<div class="controls">
<select name="kelas" id="kelas">
<option value="">--Pilih Kelas--</option>
<?php
$q=mysql_query("Select * from kelas");
while($r=mysql_fetch_array($q))
{
 echo "<option value='$r[kode_kelas]'> $r[nama_kelas]</option>"; } ?>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Dosen</label>
<div class="controls">
<select name="dosen" id="dosen">
<option value="">--Pilih Dosen--</option>
<?php
$q=mysql_query("Select * from dosen");
while($r=mysql_fetch_array($q))
{
 echo "<option value='$r[nid]'> $r[nama]</option>"; }?>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Mata Kuliah</label>
<div class="controls">
<select name="matkul" id="matkul">
<option value="">--Pilih Matakuliah--</option>
<?php
$q=mysql_query("Select * from mata_kuliah");
while($r=mysql_fetch_array($q))
{
 echo "<option value='$r[kode_mata_kuliah]'> $r[nama_mata_kuliah]</option>"; } ?>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label">Semester</label>
<div class="controls">
<input type="text" name="semester" id="semester" class="input-small">&nbsp;
</div>
</div>
<div class="control-group">
<div class="controls">
<input type="submit" name="simpan" class="btn btn-medium btn-primary" value="Simpan Data" />
</div>
</div>
<?php
if(isset($_POST['simpan']))
{
	$q=mysql_query("Select count(id_jadwal) as rw from jadwal_kuliah where tanggal='".$_POST['tgl']."' and jam_mulai='".$_POST['jam']."' and kode_kelas='".$_POST['kelas']."'");
	$r=mysql_fetch_array($q);
	$jml=$r['rw'];
	if($jml=="1")
	{
		echo "Jadwal ini sudah ada";
	}else{
		$q1=mysql_query("Insert into jadwal_kuliah (`tanggal`,`jam_mulai`,`kode_jurusan`,`kode_kelas`,`nid`,`semester`,`kode_mata_kuliah`) values 
		('".$_POST['tgl']."','".$_POST['jam']."','".$_POST['jurusan']."','".$_POST['kelas']."',
		'".$_POST['dosen']."','".$_POST['semester']."','".$_POST['matkul']."')");
		if($q1)
		{
			echo "<script>alert('Berhasil ditambahkan')</script>";
		}
	}
	
}
?>
<?php
ob_end_flush();
?>