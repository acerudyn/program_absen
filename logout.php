<?php
session_start();

if(session_destroy()) // Menghapus Sessions
{
	header("Location: login_mahasiswa.php"); // Langsung mengarah ke Home index.php
}
?>