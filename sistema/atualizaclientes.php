<?php
include("seguser.php");
include('mestrenew.php');
include('../include/funcoes.php');
function a_each(&$arr){
    $key = key($arr);
    if (!$key)
        return false;
    $val = current($arr);
    next($arr);
    return array($key, $val);
}


$idempresa=$_POST['idempresa'];
$nomecliente=$_POST['nomecliente'];
$cpf=$_POST['cpf'];
$rg=$_POST['rg'];
$dtacontratacao=$_POST['dtacontratacao'];
$dtanascimento=dataMysql($_POST['dtanascimento']);
$pis=$_POST['pis'];
$email=$_POST['email'];
$bairro=$_POST['bairro'];
$cidade=$_POST['cidade'];
$estado=$_POST['estado'];
$telefone=$_POST['telefone'];
$endereco=$_POST['endereco'];
$cargo=$_POST['cargo'];

$sql="UPDATE clientes set cpf=:cpf,rg=:rg,pis=:pis,Nome=:nome,dtacontratacao=:dtacontratacao,email=:email,
    bairro=:bairro,cidade=:cidade,estado=:estado,celular=:telefone,logradouro=:endereco,cargo=:cargo,dtanascimento=:nascimento WHERE  idgrupo=:idgrupo";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nome'=>$nomecliente,
    'idgrupo'=>$idgrupo,
    'nome'=>$nomecliente,
    'cpf'=>$cpf,
    'rg'=>$rg,
    'pis'=>$pis,
    'dtacontratacao'=>$dtacontratacao,
    'nascimento'=>$dtanascimento,
    'email'=>$email,
    'bairro'=>$bairro,
    'cidade'=>$cidade,
    'estado'=>$estado,
    'telefone'=>$telefone,
    'cargo'=>$cargo,
    'endereco'=>$endereco

    ]);


echo "MSG - Atualizado com Sucesso!";


?>
