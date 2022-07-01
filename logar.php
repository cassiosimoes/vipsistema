<?php session_start();
ob_start();
include ("mestrenew.php");
$login=$_POST['login'];
$senha=md5($_POST['senha']);
$_SESSION['login']='';
$_SESSION['id']='';
$_SESSION['nome']='';
$_SESSION['nivel']='';
$_SESSION['tipo']='';
$_SESSION['idgrupo']="";
$_SESSION['idempresa']="";
$_SESSION['vertudo']="";
$sql= "SELECT * FROM usuarios WHERE login = :login AND senha = :senha"; 
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':login', $login, PDO::PARAM_STR);
$stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (empty($row)) {
	header("Location: erro.php");
}
else
{
	$_SESSION['login']=$login;
	$_SESSION['id']=$row['idusuario'];
	$_SESSION['nome']=$row['nome'];
	$_SESSION['nivel']=$row['nivel'];
	$_SESSION['tipo']=$row['tipo'];
	if ($row[$idgrupo=='']) $row['idgrupo']==$row['idusuario'];
	$_SESSION['idgrupo']=$row['idgrupo'];
	$_SESSION['idempresa']=$row['idempresa'];
	$_SESSION['vertudo']=$row['vertudo'];
	if ($row['tipo']=="ASSISTENTE" || $row['tipo']=="GRUPO" ) header("Location: sistema/dashboard.php");
	}
