<?php
include("seguser.php");

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    $enderecobase = "atualizausuario.php";
    $requersenha = "";
} else {
    $tipo = "";
    $enderecobase = "cadusuario.php";
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
                        window.location.replace("usuarios.php");

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
    include("mestrenew.php");
    $estadocheck="";
    if ($tipo != "") {



        $sql = "SELECT * from usuarios where idusuario=:usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $tipo, PDO::PARAM_INT);
        $stmt->execute();
        $campo = $stmt->fetch(PDO::FETCH_NUM);
        $textobotao = "Atualizar";
        $action_form = "atualizausuario.php?tipo=$tipo";
        $cabecalho = "Edição Usuário ";
        
        if ($campo[8]=="1") $estadocheck='CHECKED';

    } else {
        for ($a = 0; $a < 30; $a++) {
            $campo[$a] = "";
        }

        $textobotao = "Cadastrar";
        $action_form = "cadusuario.php";
        $cabecalho = "Cadastrar Usuário - ASSISTENTE";
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
                                                    <label for="nomeusuario">Nome
                                                    </label>

                                                    <input class="form-control" name="nomeusuario" id="nomeusuario" maxlength="20" value="<?php echo $campo[1] ?>" required>

                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-sm-3 col-md-5">
                                                    <label for="loginusuario">Login
                                                    </label>

                                                    <input class="form-control" type="email" name="loginusuario" id="loginusuario" maxlength="30" value="<?php echo $campo[2] ?>" required>

                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="tiposelect">Tipo</label>
                                                    <select name="tipousuario" class="form-control" id="tiposelect" disabled="">
                                                        <option value="EMPRESA" <?php if ($campo[7] == "ASSISTENTE") echo "SELECTED" ?>>ASSISTENTE</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-3 col-md-5">
                                                    <label for="senhausuario">Senha
                                                    </label>

                                                    <input class="form-control" name="senhausuario" id="senhausuario" maxlength="15" <?php echo $requersenha; ?>>

                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-2 col-md-2">
                                                    <label for="nivelusuario">Tipo</label>
                                                    <select name="nivelusuario" class="form-control" id="nivelusuario">
                                                        <option value="1">Nível 1</option>
                                                        <option value="2">Nível 2</option>
                                                        <option value="3">Nível 3</option>
                                                        <option value="4">Nível 4</option>
                                                        <option value="5">Nível 5</option>

                                                    </select>
                                                </div>
                                            </div>

                                         
                                                        <?php if ($idgrupo==$iduser){
                                                        ?>
                                                     <div class="form-group row">
                                                         <div class="col-sm-2 col-md-2">
                                                        <p><b>Empresas</b></p>
                                                        <div class="toggle-flip">
                                                            <label>
                                                        <input type="checkbox" name="acesso"  <?php echo $estadocheck ?>><span class="flip-indecator" data-toggle-on="Todas" data-toggle-off="Restrito"></span>
                                                        </label>
                                                   </div>
                                                 </div></div>
                                                        <?php
                                                        } else {
                                                            if ($estadocheck=="CHECKED") echo "<input type='hidden' name='acesso' value='on'>";
                                                              

                                                        }
                                                        ?>
                                                    
                                                      
                                                <input type="hidden" value="<?php echo $tipo ?>" name="idusuario">

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