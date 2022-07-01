<?php
@include("seguser.php");
$inicio=0;
if (isset($_GET['valor'])) $nome = $_GET['valor'];
else $nome="";
if ( isset($_GET['inicio'])) $inicio=$_GET['inicio'];

?>
<script>
	function excluirdados(id) {
		var codigo = id;
		var r = confirm("Você tem certeza que deseja excluir esse usuario");
		if (r == true) {
			document.location = "excluiritens.php?tipo=1&codigo=" + codigo;

		}

	}

	
</script>

<head>

	<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
	<title>Usuários Listagem</title>

</head>




<script src="lightbox-form.js" type="text/javascript"></script>
<script type="text/javascript">
	function excluirdados(id) {
		var codigo = id;
		var r = confirm("Você tem certeza que deseja excluir esse Usuário");
		if (r == true) {
			document.location = "excluiritens.php?tipo=1&codigo=" + codigo;

		}

	}

	
</script>


<body>
	

	<body>

		
			<?php
			include ("mestrenew.php");
			 
			$sql = "SELECT A.*,B.razaosocial as razao from usuarios A  LEFT JOIN empresa B ON A.idempresa=B.idempresa where (A.nome like :nome1 or A.login like :nome2) and A.tipo <> 'grupo' and A.tipo <>'ADM' and A.idgrupo=:idgrupo  order by nome limit :inicio,30"; 

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':nome1', "%".$nome."%");
			$stmt->bindValue(':nome2', "%".$nome."%");
		    $stmt->bindParam(':idgrupo',$idgrupo,PDO::PARAM_INT);
			$stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);

			
            $stmt->execute();
			if ($stmt->rowCount()==0){
				echo "<center><h2>Não existem usuários cadastrados</h2></center>";
			}else {
			
			
				$pagina = 1;
				$nl = 0;
				$a = 0;
				$total = 0;

			?>
				<div class="table-responsive">
					<table class="table table-striped table-hover" >
						<thead>
							<tr>
								<th scope="col">Nome</th>
								<th scope="col">Login</th>
								
								<th scope="col">Empresa</th>
								<th scope="col">Tipo</th>
								<th scope="col">Nivel</th>
								
							</tr>
						</thead>

						<tbody>

						<?php
						while ($linhadb=$stmt->fetch(PDO::FETCH_ASSOC)){

							$a++;

							echo "<tr ";
							if ($a % 2 == 0)
								echo "bgcolor=#ffffff";
							else
								echo "bgcolor=#ffdb78";
							echo ">";
						//	if ($linhadb['idgrupo']==0) $linhadb['idgrupo']="--";
                          //  else $linhadb['idgrupo']=$linhadb['Nomegrupo'];
							if ($linhadb['idempresa']==0) $nomeempresa="--";
							else  $nomeempresa=$linhadb['razao'];
							//echo "<td><a href='#' onclick='excluirdados($linhadb[0])'><img src='../images/excluir.png' border='0' alt='Excluir'></a></td>"; 
                            echo "<td>".$linhadb['nome']."</td>";
                            echo "<td>".$linhadb['login']."</td>";
                        
                            echo "<td>".$nomeempresa."</td>";
                            echo "<td>".$linhadb['tipo']."</td>";   
                            echo "<td>".$linhadb['nivel']."</td>";
                            if ($linhadb['tipo']=="EMPRESA" )
							echo "<td><a href='usuarioempresa.php?tipo=".$linhadb['idusuario']."&tipoempresa=".$linhadb['idempresa']."' ><i class='fa fa-address-book-o fa-2x' aria-hidden='true'></i</a></td>";
                            else echo "<td><a href='cadastrarusuario.php?tipo=".$linhadb['idusuario']."'><i class='fa fa-address-book-o fa-2x' aria-hidden='true'></i</a></td>";
							echo "</tr>";
					}
              
						?>


					</table>
					</tbody>
					
				</div>
				<?php

$proximo = $inicio + 30;
$anterior = $inicio - 30;
if ($anterior < 0) $anterior = 0;
if ($a < 30) $proximo = $inicio;
echo "<div class='row'>
<div class='col-md-1 col-sm-1'><a class='btn' href='adminusuarios.php?nome=$nome&cnpj=$nome&telefone=$nome&inicio=$anterior'>Anterior</a></div>";
echo "<div class='col-md-1 col-sm-1'><a class='btn'  href='adminusuarios.php?nome=$nome&cnpj=$nome&telefone=$nome&inicio=$proximo'>Proximo</a></div></div>";
}
?>
		</div>


		<br>


	</body>

	</html>