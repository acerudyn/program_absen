<?php
session_start();
if(session_destroy()) // Menghapus Sessions
{
	header("Location: login_dosen.php"); // Langsung mengarah ke Home index.php
}
?>