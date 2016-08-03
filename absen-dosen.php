<?php  
include "koneksi.php";
  
if(isset($_POST['simpan'])){
	$q1=mysql_query("Insert into data_absen_dosen (`id_data`,`id_jadwal`,`nid`,`tgl`,`jam`,`semester`,`kode_mata_kuliah`) values 
		('".$_POST['id_data']."','".$_POST['id_jadwal']."','".$_POST['nid']."','".$_POST['tanggal']."',
		'".$_POST['jam']."','".$_POST['semester']."','".$_POST['kode_matkul']."')");
		if($q1)
		{
			?>
    <script type="text/javascript">
    	alert('Absen Berhasil')
		document.location='ruang-dosen.php';
    </script>
    
    <?php } else {?>
    <script type="text/javascript">
	alert('Absen Gagal')
	document.location='ruang-dosen.php';
	</script>
    
    <?php } 
}
?>