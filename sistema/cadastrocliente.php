<?php
include("seguser.php");
$tipoempresa=$idempresa;

   
if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    $enderecobase="atualizacliente.php";
    $requersenha="";
}

else {
    $tipo = "";
    $enderecobase="cadcliente.php";
   
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <script>
        function submitForm(oFormElement)
{
  var xhr = new XMLHttpRequest();
  xhr.onload = function(){ 
    
    swal({
      		title: $.trim(xhr.responseText),
      		type: "warning",
      		showCancelButton: false,
      		confirmButtonText: "OK",
      		closeOnConfirm: true
      		
      	}, function(isConfirm) {
      		if (isConfirm) {
                window.location.replace("clientes.php");

      		} else {
      			
      		}
      	});
    }

    // success case
    xhr.onerror = function(){ 
    alert (xhr.responseText);
   } // failure case
  xhr.open (oFormElement.method,"<?php echo $enderecobase?>", true);
  xhr.send (new FormData (oFormElement));
  return false;  
}
        function CriaRequest() {
            try {
                request = new XMLHttpRequest();
            } catch (IEAtual) {

                try {
                    request = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (IEAntigo) {

                    try {
                        request = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (falha) {
                        request = false;
                    }
                }
            }

            if (!request)
                alert("Seu Navegador navegador não suporta Ajax!");
            else
                return request;
        }


        function enviarStatus(x) {
            var valor = x;
            var result = document.getElementById("tabelameio");
            var xmlreq = CriaRequest();
            result.innerHTML = 'Processando';
            xmlreq.open("GET", "listclientes.php?valor=" + valor, true);
            xmlreq.onreadystatechange = function() {

                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        result.innerHTML = xmlreq.responseText;
                    } else {
                        result.innerHTML = "Erro no servidor: " + xmlreq.statusText;

                    }
                }
            };
            xmlreq.send(null);
        }

        function updateValue() {

            enviarStatus(document.getElementById('entrada').value);

        }

      
    </script>

    <meta name="description" content="G12 Doc , saúde ocupacional , segurança do trabalho">
    <!-- Twitter meta-->

    <!-- Open Graph Meta-->

    <title>G12Doc</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="adminhome.php"><img src="../images/logop.png"></a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <li class="app-search">
                <button class="app-search__button"></button>
            </li>
            <!--Notification Menu-->

            <!-- User Menu-->
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php
    include("menu.php");


    if ($tipo != "") {


        include("mestrenew.php");

        $sql = "SELECT * from clientes where idempresa=:empresa and id=:idcliente";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':empresa', $idempresa, PDO::PARAM_INT);
        $stmt->bindParam(':idcliente', $tipo, PDO::PARAM_INT);
        $stmt->execute();
        $campo = $stmt->fetch(PDO::FETCH_NUM);
        $textobotao = "Atualizar";
        $action_form = "atualizacliente.php?tipo=$tipo";
        $cabecalho = "Edição Clientes";
    } else {
        for ($a = 0; $a < 30; $a++) {
            $campo[$a] = "";
        }

        $textobotao = "Cadastrar";
        $action_form = "cadcliente.php";
        $cabecalho = "Cadastro de Clientes";
    }
    ?>

    <main class="app-content">

        <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-3 col-sm-2">
                            <div class="title">
                                <h4><?php echo $cabecalho ?></h4>
                            </div>
                        </div>
           
                    </div>
                </div>
             
                <!-- Default Basic Forms Start -->



                <div id="tabelameio">




                    <br>
                    <!-- Default Basic Forms Start -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tile">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <form  onsubmit="return submitForm(this);" action="<?php echo $action_form; ?>" method="POST" name="cadastroform">
                                            <div class="form-group row disable">

                                                <div class="col-sm-2 col-md-2">
                                                    <label for="cnpj" style="font-size: 12px; font-weight: bold;">CPF
                                                    </label>
                                                  
                                                    
                                                        <input class="form-control"  name="cpf" id="cpf" maxlength="14" value="<?php echo $campo[4] ?>">
                                                    
                                                   
                                                </div>
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="rg" style="font-size: 12px; font-weight: bold;">RG
                                                    </label>

                                                    <input class="form-control" name="rg" id="rg" maxlength="14" value="<?php echo $campo[5] ?>">
                                                </div>
                                               

                                                    <input type="hidden" class="form-control" name="pis" id="pis" maxlength="15" value="<?php echo $campo[8] ?>">
                                               

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 col-md-6">
                                                    <label for="nomecliente" style="font-size: 12px; font-weight: bold;">Nome do Clientes
                                                    </label>
                                                    <input class="form-control" type="text" maxlength="70" name="nomecliente" id="nomecliente" value="<?php echo $campo[3] ?>">
                                                </div>


                                            </div>

                                            <div class="form-group row">
                                               <div class="col-sm-2 col-md-2">
                                                    <label style="font-size: 12px; font-weight: bold;">E-Mail
                                                    </label>
                                                    <input class="form-control" size="34" name="email" id="email" maxlength="40" value="<?php echo $campo[16] ?>">
                                                </div>
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="contratacao" style="font-size: 12px; font-weight: bold;">Data contratação
                                                    </label>
                                                    <input class="form-control" type="date" size="30" maxlength="70" name="dtacontratacao" id="contratacao" value="<?php echo $campo[6] ?>">
                                                </div>
                                              
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="nascimento" style="font-size: 12px; font-weight: bold;">Data nascimento
                                                    </label>
                                                    <input class="form-control" type="date" size="30" maxlength="70" name="dtanascimento" id="nascimento" value="<?php echo $campo[18] ?>">
                                                </div>
                                              

                                            </div>
                                            <div class="form-group row">


                                                <div class="col-sm-2 col-md-2">
                                                    <label for="cidade" style="font-size: 12px; font-weight: bold;">Bairro
                                                    </label>
                                                    <input class="form-control" size="20" name="bairro" id="bairro" maxlength="30" value="<?php echo $campo[12] ?>">
                                                </div>
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="cidade" style="font-size: 12px; font-weight: bold;">Cidade
                                                    </label>
                                                    <input class="form-control" size="20" name="cidade" id="cidade" maxlength="20" value="<?php echo $campo[13] ?>">
                                                </div>
                                                <div class="col-sm-1 col-md-1">
                                                    <label for="estado" style="font-size: 12px; font-weight: bold;">UF
                                                    </label>

                                                    <input class="form-control" size="6" name="estado" id="estado" maxlength="2" value="<?php echo $campo[14] ?>">
                                                </div>

                                                <div class="col-sm-1 col-md-1">
                                                    <label for="telefone" style="font-size: 12px; font-weight: bold;">Telefone
                                                    </label>
                                                    <input class="form-control" size="6" name="telefone" id="telefone" onKeyUp="javascript: validar_num(this)" value="<?php echo $campo[15] ?>">
                                                </div>


                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-5 col-md-5">
                                                    <label for="endereco" style="font-size: 12px; font-weight: bold;">Endereço
                                                    </label>
                                                    <input class="form-control" type="text" size="75" maxlength="50" name="endereco" id="endereco" value="<?php echo $campo[9] ?>">
                                                </div>
                                            </div>
                                            
                                                    <input type="hidden" class="form-control" type="text" size="75" maxlength="50" name="cargo" id="cargo" value="<?php echo $campo[17] ?>">
                                            
                                            <input type='hidden' value="<?php echo $idgrupo ?>" name="idgrupo">
                                            <input type='hidden' value="<?php echo $idempresa ?>" name="idempresa">
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-md-2">
                                                    <input class="btn btn-primary btn-lg btn-block" type=submit value="<?php echo $textobotao; ?>"></td>
                                                </div>
                                            </div>
                                            <form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div><!-- tabela meio -->
            </div>

        </div>


    </main>

    <!-- Essential javascripts for application to work-->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="../js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="../js/plugins/sweetalert.min.js"></script>
    
    <script>
        document.getElementById('entrada').addEventListener('input', updateValue);
    </script>

</body>

</html>