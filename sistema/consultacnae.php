<?php
$riscos[0]="";
$riscos[1]="Muito baixo";
$riscos[2]="Baixo";
$riscos[3]="Médio";
$riscos[4]="Alto";
$riscos[5]="";

function pegarisco($numero){

    include("mestrenew.php");

 $sql = "SELECT * FROM cnae_risco where cnae=:numero";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':numero', $numero);
$stmt->execute();
$campo=$stmt->fetch(PDO::FETCH_NUM);

if ($stmt->rowCount()>0){
return($campo[2]);
} else return "";
}
$cnpj=$_GET['dado'];
$cnpj = str_replace( array( '\'', '"',
      ',' , ';', '<', '>','.',',','/','\\','-'), '', $cnpj);
$acesso = "https://www.receitaws.com.br/v1/cnpj/".$cnpj;

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $acesso);
$result = curl_exec($ch);

curl_close($ch);

$obj = json_decode($result);
if (!isset($obj->atividade_principal[0]->code)){
    echo "22";
    exit();

}


$cnae=$obj->atividade_principal[0]->code;
$cnaeresumido=substr($cnae,0,7);
$arrayriscos="";
foreach($obj->atividades_secundarias as $secundaria){
  $cnaer=substr($secundaria->code,0,7);
  $nrisco= pegarisco($cnaer);
  if($nrisco=="") {
      $nrisco=0;
      $arrayriscos=$arrayriscos."\n";
  } else $arrayriscos=$arrayriscos.$secundaria->code." -> ".$nrisco."-".$riscos[$nrisco]."\n";

}

echo $obj->cnpj.";";
echo $cnae.";";
$nrisco= pegarisco($cnaeresumido);
if($nrisco=="") {
    echo ";";
} else echo $nrisco."-".$riscos[$nrisco].";";
echo $obj->fantasia.";";
echo $obj->nome.";";
echo $obj->logradouro." ".$obj->numero." ".$obj->complemento.";";
echo $obj->bairro.";";
echo $obj->uf.";";
echo $obj->municipio.";";
echo $arrayriscos.";";

?>