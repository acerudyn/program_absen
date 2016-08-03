
<form id="loginform" action="login_dosen.php?login_attempt=1" method="post">
    <p class="animate4 bounceIn"><input type="text" id="username" name="username" placeholder="Nomor Induk Dosen" /></p>
    <p class="animate5 bounceIn"><input type="password" id="password" name="password" placeholder="Tanggal Lahir [yyyymmdd]" /></p>
    <p class="animate6 bounceIn"><button class="btn btn-default btn-block">Masuk</button></p>
    
</form>
<?php
if(isset($_GET['login_attempt']))
{
	$spf=sprintf("Select * from dosen where nid='%s' and umur='%s'",$_POST['username'],($_POST['password']));
	$rs=mysql_query($spf);
	$rw=mysql_fetch_array($rs);
	$rc=mysql_num_rows($rs);
	
	if($rc==1)
	{
		$_SESSION['login_user']=$rw['nama'];
		$_SESSION['login_dosen']=$rw['nid'];
		echo "<script>window.location='ruang-dosen.php'</script>";
	}
}
?>