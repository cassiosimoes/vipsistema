<?php
@include("seguser.php");
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
	<title>Empresas Listagem</title>

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
				$sql = "SELECT * from empresa where (razaosocial like :nome1 or cnpj like :nome2 or telefone like :nome3) and idgrupo=:idgrupo  order by razaosocial limit :inicio,30";

				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(':nome1', "%" . $nome . "%");
				$stmt->bindValue(':nome2', "%" . $nome . "%");
				$stmt->bindValue(':nome3', "%" . $nome . "%");
				$stmt->bindParam(':idgrupo',$idgrupo, PDO::PARAM_INT);
				$stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);
				} else {

				$sql = "SELECT * from empresa where (razaosocial like :nome1 or cnpj like :nome2 or telefone like :nome3) and idgrupo=:idgrupo and idusuario=:idusuario  order by razaosocial limit :inicio,30";
				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(':nome1', "%" . $nome . "%");
				$stmt->bindValue(':nome2', "%" . $nome . "%");
				$stmt->bindValue(':nome3', "%" . $nome . "%");
				$stmt->bindParam(':idgrupo',$idgrupo, PDO::PARAM_INT);
				$stmt->bindParam(':idusuario',$iduser, PDO::PARAM_INT);
				$stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);


				}

				$stmt->execute();
				if ($stmt->rowCount() == 0) {
					echo "<center><h2>Empresas não encontradas</h2></center>";
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
								
								<th scope="col">Nome</td>
								<th scope="col">Nome Fantasia</td>
								<th scope="col">Telefone1</td>
								<th scope="col">Email</td>
								<th scope="col">CNPJ</td>
								<th scope="col">Cidade</td>
								<th scope="col">Estado</td>
								<th scope="col">Operações</td>

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
							echo "<td>$linhadb[3]</td>";
							echo "<td>$linhadb[12]</td>";
							echo "<td>$linhadb[11]</td>";
							echo "<td>$linhadb[2]</td>";
							echo "<td>$linhadb[9]</td>";
							echo "<td>$linhadb[10]</td>";
							//echo "<td>$linhadb[4]</td>";
							//echo "<td>$linhadb[5]</td>";
							//echo "<td>$linhadb[6]</td>";
							//echo "<td>$linhadb[7]</td>";
							echo "<td><a href='cadastrarempresa.php?tipo=$linhadb[0]' ><i style=' margin-right: 30px;' class='fa fa-address-book-o fa-2x' aria-hidden='true'></i></a>";
							echo "</td>";
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