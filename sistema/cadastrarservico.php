<?php
include("seguser.php");
include("mestrenew.php");

$nomeempresa="Geral";
if (isset($_GET['dados'])) {
$codigoempresa=$_GET['dados'];
$sql = "SELECT nome from clientes where id=:idempresa";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idempresa', $codigoempresa, PDO::PARAM_INT);
$stmt->execute();
$empresadados = $stmt->fetch(PDO::FETCH_NUM);
$nomeempresa=$empresadados[0]; 
}

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    $enderecobase = "atualizaservico.php";
    $requersenha = "";
} else {
    $tipo = "";
    $enderecobase = "cadservico.php";
    $requersenha = "required";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <script>

     
        function submitForm(oFormElement) {
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {

                swal({
                    title: $.trim(xhr.responseText),
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonText: "OK",
                    closeOnConfirm: true

                }, function(isConfirm) {
                    if (isConfirm) {
                        window.location.replace("dashboard.php?dados=<?php echo $codigoempresa;?>");

                    } else {

                    }
                });
            }

            // success case
            xhr.onerror = function() {
                alert(xhr.responseText);
            } // failure case
            xhr.open(oFormElement.method, "<?php echo $enderecobase ?>", true);
            xhr.send(new FormData(oFormElement));
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

        $sql = "SELECT * from servicos where id=:servico";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':servico', $tipo, PDO::PARAM_INT);
        $stmt->execute();
        $campo = $stmt->fetch(PDO::FETCH_NUM);
        $textobotao = "Atualizar";
        $action_form = "atualizaservico.php?tipo=$tipo";
        $cabecalho = "Edição Serviço - $nomeempresa";
       
        
    } else {
        for ($a = 0; $a < 30; $a++) {
            $campo[$a] = "";

        }
        $campo[8]=$nomeempresa;
        $textobotao = "Cadastrar";
        $action_form = "cadservico.php";
        $cabecalho = "Cadastrar Serviço - $nomeempresa";
    }
    ?>

    <main class="app-content">

        <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-3">
                            <div class="title">
                                <h4><?php echo $cabecalho ?></h4>
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <!-- Default Basic Forms Start -->



                <div id="tabelameio">




                    <br>
                    <!-- Default Basic Forms Start -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tile">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <form class="needs-validation" action="<?php echo $action_form; ?>" method="POST" name="cadastroform" onsubmit="return submitForm(this);">

                                            <div class="form-group row">

                                                <div class="col-sm-3 col-md-5">
                                                    <label for="descricao">Descrição do Serviço
                                                    </label>

                                                    <input class="form-control" name="descricao" id="descricao" maxlength="20" value="<?php echo $campo[1] ?>" required>

                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-sm-3 col-md-5">
                                                    <label for="razao">Cliente
                                                    </label>

                                                    <input readonly class="form-control" type="text" name="razao" id="razao" maxlength="70" value="<?php echo $campo[8] ?>" required>

                                                </div>

                                            </div>



                                            <div class="form-group row">
                                                <div class="col-sm-3 col-md-3">
                                                    <label for="status">Status</label>
                                                    <select name="status" class="form-control" id="nivelusuario">
                                                        <?php
                                                        $sql = "SELECT * from status";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute();
                                                        while ($linhadb=$stmt->fetch(PDO::FETCH_NUM)){
                                                           $textooption=""; 
                                                          if ($linhadb[1]==$campo[2]) $textooption="SELECTED";
                                                            echo"<option value='".$linhadb[1]."' ".$textooption.">".$linhadb[1]."</option>";
                                                        }
                                                        
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-4 col-md-4">
                                                    <label for="obs" style="font-size: 12px; font-weight: bold;">Histórico</label>
                                                    <textarea class="form-control" name="historico" cols="50" rows="10" id="obs" maxlength='500'><?php echo $campo[7] ?></textarea>

                                                </div>
                                                <div class="col-sm-5 col-md-5">

                                                        
                                                </div>

                                            </div>
                                                       
                                                      
                                                <input type="hidden" value="<?php echo $codigoempresa ?>" name="idempresa">
                                                <input type="hidden" value="<?php echo $tipo ?>" name="idservico">

                                                <div class="form-group row">
                                                    <div class="col-sm-2 col-md-2">
                                                        <input class="btn btn-primary btn-lg btn-block" type=submit value="<?php echo $textobotao; ?>"></td>
                                                    </div>
                                                </div>
                                        </form>
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
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="../js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="../js/plugins/sweetalert.min.js"></script>

    <script>
        document.getElementById('entrada').addEventListener('input', updateValue);
    </script>

</body>

</html>