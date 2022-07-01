<?php
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


function formatar_cpf_cnpj($doc) {
 
	$doc = preg_replace("/[^0-9]/", "", $doc);
	$qtd = strlen($doc);

	if($qtd >= 11) {

		if($qtd === 11 ) {

			$docFormatado = substr($doc, 0, 3) . '.' .
							substr($doc, 3, 3) . '.' .
							substr($doc, 6, 3) . '.' .
							substr($doc, 9, 2);
		} else {
			$docFormatado = substr($doc, 0, 2) . '.' .
							substr($doc, 2, 3) . '.' .
							substr($doc, 5, 3) . '/' .
							substr($doc, 8, 4) . '-' .
							substr($doc, -2);
		}

		return $docFormatado;

	} else {
		return 'Documento invalido';
	}
}

function formatar_cep($doc) {
 
	$doc = preg_replace("/[^0-9]/", "", $doc);

	

			$docFormatado = substr($doc, 0, 2) . '.' .
							substr($doc, 2, 3) . '-' .
							substr($doc, 5, 3) ;
							
		

		return $docFormatado;


}
function dataMysql($data){

    
    return implode("-",array_reverse(explode("/",$data)));


}



function dataPTBR($data){

    if ($data=="0000-00-00") return $data="--/--/----";
    return $data = implode("/",array_reverse(explode("-",$data)));
    
}





function validar_cnpj($cnpj) {

	if(empty($cnpj))
		return false;

	$cnpj = preg_replace('/[^0-9]/', '', $cnpj);

	if (strlen($cnpj) != 14)
		return false;

	if (preg_match('/(\d)\1{13}/', $cnpj))
		return false;

	$b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    for ($i = 0, $n = 0; $i < 12; $n += $cnpj[$i] * $b[++$i]);

    if ($cnpj[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
        return false;
    }

    for ($i = 0, $n = 0; $i <= 12; $n += $cnpj[$i] * $b[$i++]);

    if ($cnpj[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
        return false;
    }

	return true;
}


?>


