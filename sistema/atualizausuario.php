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
$tipousuario="ASSISTENTE";//$_POST['tipogrupo'];
$nivelusuario=$_POST['nivelusuario'];
$acesso="";
if (isset($_POST['acesso'])) $acesso="1";



if ($_POST['senhausuario']!=""){
$senhausuario=md5($_POST['senhausuario']);
$sql="UPDATE usuarios set nome=:nome,login=:login,nivel=:nivel,senha=:senha,vertudo=:acesso where idusuario=:idusuario";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nome'=>$nomeusuario,
    ':idusuario'=>$idusuario,
    ':login'=>$loginusuario,
    ':nivel'=>$nivelusuario,
    ':acesso'=>$acesso,
    ':senha'=>$senhausuario


    ]);
}else {
    $sql="UPDATE usuarios set nome=:nome,login=:login,nivel=:nivel,vertudo=:acesso where idusuario=:idusuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome'=>$nomeusuario,
        ':idusuario'=>$idusuario,
        ':login'=>$loginusuario,
        ':acesso'=>$acesso,
        ':nivel'=>$nivelusuario
        
    
        ]);

}



echo "MSG - Atualizado com Sucesso!";


?>
