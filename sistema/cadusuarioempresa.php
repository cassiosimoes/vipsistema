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
$senhausuario=md5($_POST['senhausuario']);
$nomeusuario=$_POST['nomeusuario'];
$loginusuario=$_POST['loginusuario'];
$tipousuario="EMPRESA";//$_POST['tipogrupo'];
$nivelusuario=$_POST['nivelusuario'];
$sql="INSERT INTO usuarios (nome,login,tipo,nivel,senha,idempresa,idgrupo) VALUES (:nome,:login,:tipo,:nivel,:senha,:idempresa,:idgrupo)";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([
        ':nome'=>$nomeusuario,
        ':idgrupo'=>$idgrupo,
        ':idempresa'=>$idempresa,
        ':login'=>$loginusuario,
        ':tipo'=>$tipousuario,
        ':nivel'=>$nivelusuario,
        ':senha'=>$senhausuario


    ]);
//$sql="INSERT into clientes VALUES(''";
//for ($b=1;$b<19;$b++){
//$sql .=",'$data[$b]'";
//}
//$sql.=")";


echo "MSG - Casdastrado com Sucesso!";


?>
