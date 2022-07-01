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


$idempresa=$_POST['idempresa'];
$idgrupo=$_POST['idgrupo'];
$id=$_POST['idempresa'];
$cnpj=$_POST['cnpj'];
$cnae=$_POST['cnae'];
$risco=$_POST['risco'];
$nome=$_POST['nome'];
$fantasia=$_POST['fantasia'];
$email=$_POST['email'];
$bairro=$_POST['bairro'];
$cidade=$_POST['cidade'];
$estado=$_POST['estado'];
$telefone=$_POST['telefone'];
$endereco=$_POST['endereco'];
$obs=$_POST['obs'];

$sql="UPDATE empresa set cnpj=:cnpj,cnae=:cnae,risco=:risco,razaosocial=:nome,nomefantasia=:fantasia,email=:email,
    bairro=:bairro,cidade=:cidade,estado=:estado,telefone=:telefone,endereco=:endereco,futuro1=:futuro1 WHERE idempresa=:idempresa and idgrupo=:idgrupo";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'idgrupo'=>$idgrupo,
    'idempresa'=>$idempresa,
    'cnpj'=>$cnpj,
    'cnae'=>$cnae,
    'risco'=>$risco,
    'nome'=>$nome,
    'fantasia'=>$fantasia,
    'email'=>$email,
    'bairro'=>$bairro,
    'cidade'=>$cidade,
    'estado'=>$estado,
    'telefone'=>$telefone,
    'endereco'=>$endereco,
    'futuro1'=>$obs

    ]);


echo "MSG - Atualizado com Sucesso!";


?>
