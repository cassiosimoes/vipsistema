<?php
include("seguser.php");


?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
 
    <script>
function CriaRequest() {
     try{
         request = new XMLHttpRequest();        
     }catch (IEAtual){
          
         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");       
         }catch(IEAntigo){
          
             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");          
             }catch(falha){
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
     var valor  = x;
     var result = document.getElementById("tabelameio");
     var xmlreq = CriaRequest();
     result.innerHTML = 'Processando';
     xmlreq.open("GET", "listgrupo.php?valor="+valor, true);
     xmlreq.onreadystatechange = function(){
      
      if (xmlreq.readyState == 4) {
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
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

    ?>
    <main class="app-content">
    
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-3 col-sm-2">
							<div class="title">
								<h4>Relação de Empresas Cadastrados</h4>
							</div>
					  </div>
            <div class="col-md-2 col-sm-2">
            <a href="cadastrarempresa.php" class="btn btn-primary">Nova Empresa</a>
            </div>

          
            <div class="col-md-2 col-sm-2">
          
               
              
                 <input id="entrada" name="name"/>
                <img id="img1" width=32px height=32px src="../images/busca.png">
          </div>
					</div>
				</div>
        <br>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        	<div>
			
			    </div>
          <div id="container">
		
          <div id="tabelameio">
					<?php
                    
						include("listempresa.php");
					?>
             </div>   
							</code></pre>
						</div>
					</div>
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
    <script>

document.getElementById('entrada').addEventListener('input', updateValue);
</script>
   
  </body>
</html>