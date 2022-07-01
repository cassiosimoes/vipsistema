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




$descricao=$_POST['descricao'];
//$razao=$_POST['razao'];
$status=$_POST['status'];
//$idempresa=$_POST['idempresa'];
$historico=$_POST['historico'];
$idservico=$_POST['idservico'];

$sql="UPDATE servicos set descricao=:descricao,status=:status,historico=:historico where id=:idservico";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    
'historico'=>$historico,
'descricao'=>$descricao,
'idservico'=>$idservico,
'status'=>$status

    ]);



echo "MSG - Atualizado com Sucesso!";


?>
