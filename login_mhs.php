
<form id="loginform" action="login_mahasiswa.php?login_attempt=1" method="post">
    <p class="animate4 bounceIn"><input type="text" id="username" name="username" placeholder="Nomor Induk Mahisawa" /></p>
    <p class="animate5 bounceIn"><input type="password" id="password" name="password" placeholder="Tanggal Lahir [yyyymmdd]" /></p>
    <p class="animate6 bounceIn"><button class="btn btn-default btn-block">Masuk</button></p>
    
</form>
<?php
if(isset($_GET['login_attempt']))
{
	$spf=sprintf("Select * from mahasiswa where nim='%s' and umur='%s'",$_POST['username'],($_POST['password']));
	$rs=mysql_query($spf);
	$rw=mysql_fetch_array($rs);
	$rc=mysql_num_rows($rs);
	
	if($rc==1)
	{
		$_SESSION['login_user']=$rw['nama'];
		$mahasiswa=	$_SESSION['login_mahasiswa']=$rw['nim'];
		echo "<script>window.location='absen-mahasiswa.php'</script>";
	}
}
?>