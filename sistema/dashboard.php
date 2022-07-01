<?php
include("seguser.php");

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>



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
    if ($idgrupo==$iduser) $sql = "SELECT count(id) as total,status from servicos where idgrupo=:idgrupo group by status order by status";  
    else $sql = "SELECT count(id) as total,status from servicos where idusuario=:idusuario and idgrupo=:idgrupo group by status order by status";  
   
    
    $stmt = $pdo->prepare($sql);
    if ($idgrupo!=$iduser) $stmt->bindValue(':idusuario',$iduser);
    
    $stmt->bindParam(':idgrupo',$idgrupo,PDO::PARAM_INT);
    //$stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);
    $stmt->execute();
    $andamento=0;
    $abertos=0;
    $concluidos=0;
    $cancelados=0;
    while ($linhadb=$stmt->fetch(PDO::FETCH_ASSOC)){
      
    if ($linhadb['status']=="Aberto") $abertos = $linhadb['total'];
    if ($linhadb['status']=="Em Andamento") $andamento = $linhadb['total'];
    if ($linhadb['status']=="Concluído") $concluidos = $linhadb['total'];
    if ($linhadb['status']=="Cancelado") $cancelados = $linhadb['total'];
    }

    ?>

    <main class="app-content">

        <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-3 col-sm-2">
                            <div>
                                <h3><i class="fa fa-dashboard"></i> Dashboard</h3>
                                <p>Resumo dos serviços cadastrados</p>
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
                                            <div class="row">
                                              
                                            <div class="col-md-6 col-lg-3">
                                            <a href="servicosfiltro.php?filtro=1"> 
                                                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                                                        <div class="info">
                                                            <h4>Abertos</h4>
                                                            <p><b><?php echo $abertos; ?></b></p>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>
                                          
                                                <div class="col-md-6 col-lg-3">
                                                <a href="servicosfiltro.php?filtro=2"> 
                                                    <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                                                        <div class="info">
                                                            <h4>Em andamento</h4>
                                                            <p><b><?php echo $andamento; ?></b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-3">
                                                <a href="servicosfiltro.php?filtro=3"> 
                                                    <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
                                                        <div class="info">
                                                            <h4>Concluídos</h4>
                                                            <p><b><?php echo $concluidos; ?></b></p>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>
                                                <div class="col-md-6 col-lg-3">
                                                <a href="servicosfiltro.php?filtro=4"> 
                                                    <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
                                                        <div class="info">
                                                            <h4>Cancelados</h4>
                                                            <p><b><?php echo $cancelados; ?></b></p>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="tile">
                                                        <h3 class="tile-title">Serviços/Status</h3>
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- fim dashboard -->
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
    <script type="text/javascript" src="../js/plugins/chart.js"></script>
    <script type="text/javascript">
      
      var pdata = [
      	{
      		value: <?php echo $abertos;?>,
      		color: "#2E3191",
      		highlight: "#5E60AA",
      		label: "Abertos"
      	},
          {
      		value: <?php echo $andamento;?>,
      		color: "#FFC107",
      		highlight: "#FFD65B",
      		label: "Em andamento"
      	},
          {
      		value: <?php echo $concluidos;?>,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Concluídos"
      	},
      	{
      		value: <?php echo $cancelados;?>,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "Cancelados"
      	}
      ]
      
     
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>

    <script>

    </script>

</body>

</html>