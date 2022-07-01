<?php
include("seguser.php");
include('mestrenew.php');
function a_each(&$arr){
    $key = key($arr);
    if (!$key)
        return false;
    $val = current($arr);
    next($arr);
    return array($key, $val);
}


$hoje=date("Y-m-d");

$descricao=$_POST['descricao'];
$razao=$_POST['razao'];
$status=$_POST['status'];
$idempresa=$_POST['idempresa'];
$historico=$_POST['historico'];

$sql="INSERT INTO servicos (idgrupo,idempresa,idusuario,historico,razao,descricao,status,data)

 VALUES (:idgrupo,:idempresa,:idusuario,:historico,:razao,:descricao,:status,:hoje)";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([

'idgrupo'=>$idgrupo,
'idusuario'=>$iduser,
'idempresa'=>$idempresa,
'razao'=>$razao,
'historico'=>$historico,
'descricao'=>$descricao,
'status'=>$status,
'hoje'=>$hoje

    ]);


echo "MSG - Casdastrado com Sucesso!";


?>
