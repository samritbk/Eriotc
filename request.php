<?php
include("functions.php");

if(isset($_POST['email'])){
  echo subscribe($_POST['email']);
}

if(isset($_POST['txtmail'],$_POST['txtarea'])){
  echo suggest($_POST['txtarea'],$_POST['txtmail']);
}

?>
