<?php session_start();
$loginuser=$_SESSION['login'];
$iduser=$_SESSION['id'];
$exibiruser=$_SESSION['nome'];
$tipouser=$_SESSION['tipo'];
$niveluser=$_SESSION['nivel'];
$idgrupo=$_SESSION['idgrupo'];
$idempresa=$_SESSION['idempresa'];
$vertudo=$_SESSION['vertudo'];





if (empty($loginuser)) echo("<script language='javascript'>parent.window.location.href='../index.php' </script>");
if (empty($iduser)) echo("<script language='javascript'>parent.window.location.href='../index.php' </script>");
if ($tipouser=="ADM") echo("<script language='javascript'>parent.window.location.href='erro.php' </script>");


?>
