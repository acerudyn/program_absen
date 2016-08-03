<?php
$server="localhost";
$usr="root";
$pswd="";
$konek=mysql_connect("$server","$usr","$pswd") or die (mysql_error());
mysql_select_db("absenkampusdb");
?>