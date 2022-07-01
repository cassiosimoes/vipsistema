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



//while (list ($key, $val) = a_each ($_POST;)) {
//$data[$key]=$val;

//}
//$idempresa=$_POST['idempresa'];
$idusuario=$_POST['idusuario'];
$nomeusuario=$_POST['nomeusuario'];
$loginusuario=$_POST['loginusuario'];
$tipousuario="EMPRESA";//$_POST['tipogrupo'];
$nivelusuario=$_POST['nivelusuario'];

if ($_POST['senhausuario']!=""){
$senhausuario=md5($_POST['senhausuario']);
$sql="UPDATE usuarios set nome=:nome,login=:login,nivel=:nivel,senha=:senha where idusuario=:idusuario";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nome'=>$nomeusuario,
    ':idusuario'=>$idusuario,
    ':login'=>$loginusuario,
    ':nivel'=>$nivelusuario,
    ':senha'=>$senhausuario


    ]);
}else {
    $sql="UPDATE usuarios set nome=:nome,login=:login,nivel=:nivel where idusuario=:idusuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome'=>$nomeusuario,
        ':idusuario'=>$idusuario,
        ':login'=>$loginusuario,
        ':nivel'=>$nivelusuario
        
    
        ]);

}
//$sql="INSERT into clientes VALUES(''";
//for ($b=1;$b<19;$b++){
//$sql .=",'$data[$b]'";
//}
//$sql.=")";


echo "MSG - Casdastrado com Sucesso!";


?>
