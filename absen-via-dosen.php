<?php  
include "koneksi.php";
$idjadwal = $_POST['idjadwal'];
  
if(isset($_POST['save'])){
	$query = mysql_query("INSERT INTO data_absen_mhs SELECT * FROM 
data_absen_mhs_tmp WHERE id_jadwal = '$idjadwal' "); 							
			
			$del = mysql_query("delete from data_absen_mhs_tmp where id_jadwal = '$idjadwal' ");
					if($query and $del)
		{
			?>
    <script type="text/javascript">
    	alert('Absen Berhasil Disimpan')
		document.location='ruang-dosen.php';
    </script>
    
    <?php } else {?>
    <script type="text/javascript">
	alert('Absen Gagal Disimpan')
	document.location='ruang-dosen.php';
	</script>
    
    <?php } 
}
?>