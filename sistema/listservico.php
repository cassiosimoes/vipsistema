<?php
@include("seguser.php");
include("../include/funcoes.php");
$inicio=0;
$a=0;
if (isset($_GET['valor'])) $nome = $_GET['valor'];
else $nome="";
if ( isset($_GET['inicio'])) $inicio=$_GET['inicio'];

?>
<script>
	function excluirdados(id) {
		var codigo = id;
		var r = confirm("Você tem certeza que deseja excluir essa empresa");
		if (r == true) {
			document.location = "excluiritens.php?tipo=3&codigo=" + codigo;

		}

	}

	function abrirfoto() {

		openbox("Enviar nova Foto do Usuário", 0);

	}
</script>

<head>

	<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
	<title>Listagem Serviços</title>

</head>



<link type="text/css" rel="stylesheet" href="lightbox-form.css">
<LINK rel="stylesheet"  href="src/styles/style.css" type="text/css">
<script src="lightbox-form.js" type="text/javascript"></script>
<script type="text/javascript">
	function excluirdados(id) {
		var codigo = id;
		var r = confirm("Você tem certeza que deseja excluir essa empresa");
		if (r == true) {
			document.location = "excluiritens.php?tipo=3&codigo=" + codigo;

		}

	}

	
</script>


<body>
	

	<body>

		
			<?php
				include("mestrenew.php");
				if ($vertudo=="1"){
				if($iduser==$idgrupo)
					
				$sql = "SELECT A.*,B.nome from servicos A  LEFT JOIN usuarios B ON A.idusuario=B.idusuario where (razao like :nome1 or descricao like :nome2) and A.idgrupo=:idgrupo  order by descricao limit :inicio,30";
					else 
				if ($idempresa!=0)
					$sql = "SELECT A.*,B.nome from servicos A  LEFT JOIN usuarios B ON A.idusuario=B.idusuario where (razao like :nome1 or descricao like :nome2) and A.idgrupo=:idgrupo and A.idempresa=:idempresa order by descricao limit :inicio,30";	
				else $sql = "SELECT A.*,B.nome from servicos A  LEFT JOIN usuarios B ON A.idusuario=B.idusuario where (razao like :nome1 or descricao like :nome2) and A.idgrupo=:idgrupo and A.idusuario=:idusuario order by descricao limit :inicio,30";	
					$stmt = $pdo->prepare($sql);
				$stmt->bindValue(':nome1', "%" . $nome . "%");
				$stmt->bindValue(':nome2', "%" . $nome . "%");
				if($iduser!=$idgrupo)	{
					if ($idempresa!=0)	$stmt->bindParam(':idempresa',$codigoempresa, PDO::PARAM_INT);
					else $stmt->bindParam(':idusuario',$iduser, PDO::PARAM_INT);
				} 
				$stmt->bindParam(':idgrupo',$idgrupo, PDO::PARAM_INT);
				$stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);
				} else {
					if ($idempresa!=0)
					$sql = "SELECT A.*,B.nome as NomeUsuario from servicos A  LEFT JOIN usuarios B ON A.idusuario=B.idusuario where (razao like :nome1 or descricao like :nome2) and A.idgrupo=:idgrupo and A.idusuario=:idusuario and A.idempresa=:idempresa   order by descricao limit :inicio,30";	
				else $sql = "SELECT A.*,B.nome from servicos A  LEFT JOIN usuarios B ON A.idusuario=B.idusuario where (razao like :nome1 or descricao like :nome2) and A.idgrupo=:idgrupo and A.idusuario=:idusuario order by descricao limit :inicio,30";		
				
				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(':nome1', "%" . $nome . "%");
				$stmt->bindValue(':nome2', "%" . $nome . "%");
				if ($idempresa!=0)	$stmt->bindParam(':idempresa',$codigoempresa, PDO::PARAM_INT);
				
				$stmt->bindParam(':idusuario',$iduser, PDO::PARAM_INT);
				
		        $stmt->bindParam(':idgrupo',$idgrupo, PDO::PARAM_INT);
			
				$stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);


				}

				$stmt->execute();
				if ($stmt->rowCount() == 0) {
					echo "<center><h2>Serviços não cadastrados</h2></center>";
				} else {


					$pagina = 1;
					$nl = 0;



					$a = 0;
					$total = 0;

			?>
				<div class="table-responsive">
					<table class="table table-striped table-hover" >
						<thead>
							<tr>
								
								<th scope="col">Descricao</td>
								<th scope="col">Empresa</td>
								<th scope="col">Status</td>
								<th scope="col">Assistente</td>
								<th scope="col">Data Abertura</td>
								

							</tr>
						</thead>

						<tbody>

						<?php
						while ($linhadb=$stmt->fetch(PDO::FETCH_NUM)){

							$a++;

							echo "<tr ";
							if ($a % 2 == 0)
								echo "bgcolor=#ffffff";
							else
								echo "bgcolor=#ffdb78";
							echo ">";

							//echo "<td><a href='#' onclick='excluirdados($linhadb[0])'><img src='img/excluir.png' border='0' alt='Editar'></a></td>";
							echo "<td>$linhadb[1]</td>";
							echo "<td>$linhadb[8]</td>";
							echo "<td>$linhadb[2]</td>";
							echo "<td>$linhadb[9]</td>";
							echo "<td>".dataPTBR($linhadb[6])."</td>";
							
							echo "<td><a href='cadastrarservico.php?tipo=$linhadb[0]&dados=$linhadb[3]' ><i style=' margin-right: 30px;' class='fa fa-address-book-o fa-2x' aria-hidden='true'></i></a>";
							echo "</tr>";
						}
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
				<div class='col-md-1 col-sm-1'><a class='btn' href='adminempresas.php?nome=$nome&cnpj=$nome&telefone=$nome&inicio=$anterior'>Anterior</a></div>";
				echo "<div class='col-md-1 col-sm-1'><a class='btn'  href='adminempresas.php?nome=$nome&cnpj=$nome&telefone=$nome&inicio=$proximo'>Proximo</a></div></div>";
				?>
		</div>


		<br>


	</body>

	</html>