<?php  
include "koneksi.php";
  
if(isset($_POST['simpan'])){
	$q1=mysql_query("Insert into data_absen_mhs_tmp (`id_data`,`id_jadwal`,`nim`,`tgl`,`jam`,`semester`,`kode_mata_kuliah`, `status`) values 
		('".$_POST['id_data']."','".$_POST['id_jadwal']."','".$_POST['nim']."','".$_POST['tanggal']."',
		'".$_POST['jam']."','".$_POST['semester']."','".$_POST['kode_matkul']."','".$_POST['status']."')");
		if($q1)
		{
			?>
    <script type="text/javascript">
    	alert('Absen Berhasil')
		document.location='absen-mahasiswa.php';
    </script>
    
    <?php } else {?>
    <script type="text/javascript">
	alert('Absen Gagal')
	document.location='absen-mahasiswa.php';
	</script>
    
    <?php } 
}
?>