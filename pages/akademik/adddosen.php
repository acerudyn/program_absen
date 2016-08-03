<script>
function validateForm()
{
var x=document.forms["form1"]["nid"].value;
var x1=document.forms["form1"]["nama"].value;
var x2=document.forms["form1"]["umur"].value;
var x3=document.forms["form1"]["photo"].value;
if (x==null || x=="")
  {
  alert("Isi Nomor Induk Dosen");
  return false;
  }
if (x1==null || x1=="")
  {
  alert("Isi Nama Dosen");
  return false;
  }
  if (x2==null || x2=="")
  {
  alert("Isi Umur Dosen");
  return false;
  }
  if (x3==null || x3=="")
  {
  alert("Photo tidak ada,dipilih secara default");
  return true;
  x3="default";
  }
}
</script>
<?php
ob_start();

$cari_kd=mysql_query("select max(nid)as kode from dosen");
$id_cari=mysql_fetch_array($cari_kd);
$kode=substr($id_cari['kode'],6,2);
 
$a=date("y");
$b=date("m");
$c=date("d");
$adm=$kode;

$hsl=$adm+1;
$hitung=strlen($hsl);

if($hitung==1){
	$adm="0".$hsl;
}else if($hitung==2){
	$adm=$hsl;
}else{
	$adm="Data Error";
}

$id=$a.$b.$c.$adm;

?>
<form method="post" class="form-horizontal" name="form1" id="form1" enctype="multipart/form-data" onsubmit="return validateForm()"  />
<div class="control-group">
<label class="control-label">Nomor Induk Dosen</label>
<div class="controls">
<input type="text" name="nid" id="nid" value="<?php echo $id; ?>" readonly="readonly">
</div>
</div>
<div class="control-group">
<label class="control-label">Nama Dosen</label>
<div class="controls">
<input type="text" name="nama" id="nama" class="input-xlarge">
</div>
</div>
<div class="control-group">
<label class="control-label">Tanggal Lahir</label>
<div class="controls">
<?php
//array yang digunakan pada ComboBox bulan
$bln=array(1=>"Januari","Februari","Maret","April","Mei",
"Juni","July","Agustus","September","Oktober",
"November","Desember");

//membuat tanggal 1-31 pada ComboBox
echo"<select name=tanggal>
<option value=01 selected>01</option>";
for($tgl=2; $tgl<=31; $tgl++){
$tgl_leng=strlen($tgl);
if ($tgl_leng==1)
$i="0".$tgl;
else
$i=$tgl;
echo "<option value=$i>$i</option>";}
echo "</select>";

//membuat bulan ComboBox
echo "<select name=bulan>
<option value=Januari selected>Januari</option>";
for($bulan=2; $bulan<=12; $bulan++){
$bln_leng=strlen($bulan);
if ($bln_leng==1)
$i="0".$bulan;
else
$i=$bulan;
echo "<option value=$i>$bln[$bulan]</option>";}
echo "</select>";

//Membuat tahun 1900 sampai sekarang pada ComboBox
$now=date("Y");
echo "<select name=tahun>
<option value=1970 selected>1970</option>";
for($thn=1971; $thn<=$now; $thn++){
echo "<option value=$thn>$thn</option>";}
echo "</select>";
?>
</div>
</div>
<div class="control-group">
<label class="control-label">Photo</label>
<div class="controls">
<input type="text" name="photo" id="photo" value="" onClick="window.open('<?php echo $baseurl; ?>includes/imguploads/index.php','popuppage','width=600,toolbar=0,resizable=0,scrollbars=no,height=400,top=100,left=100');"/>
<input type="hidden" name="ext" id="ext" />
<input type="hidden" name="nfile" id="nfile" />
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
	$eks=$_POST['ext'];
	$namabaru=$_POST['nid'].".".$eks;		
	
	$upload_dir = $path_web."uploads/dosen/";

	if($_POST['photo']!="")
	{
		if (file_exists($upload_dir) && is_writable($upload_dir)) {
	file_put_contents($upload_dir.$namabaru,fopen($_POST['photo'], 'r'));	
		}else {
			echo 'Upload directory is not writable, or does not exist.';
		}
	}
	$tanggal	=$_POST['tanggal'];
	$bulan		=$_POST['bulan'];
	$tahun		=$_POST['tahun'];
	$umur		=$tahun.$bulan.$tanggal;
	
	$q=mysql_query("Insert into dosen values ('".$_POST['nid']."','".$_POST['nama']."','$umur','".$namabaru."')");
	if($q)
	{
		echo "<script>alert('Berhasil ditambahkan')</script>";
	}
}
?>
<?php
ob_end_flush();
?>
