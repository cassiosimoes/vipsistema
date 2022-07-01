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



$idgrupo=$_POST['idgrupo'];
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
$sql="INSERT INTO empresa (idgrupo,cnpj,cnae,risco,razaosocial,nomefantasia,email,bairro,cidade,estado,telefone,endereco,futuro1,idusuario)

 VALUES (:idgrupo,:cnpj,:cnae,:risco,:nome,:fantasia,:email,:bairro,:cidade,:estado,:telefone,:endereco,:futuro1,:idusuario)";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([

'idgrupo'=>$idgrupo,
'idusuario'=>$iduser,
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


echo "MSG - Casdastrada com Sucesso!";


?>
