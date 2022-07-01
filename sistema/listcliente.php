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
	<title>Listagem Clientes</title>

</head>




<script src="lightbox-form.js" type="text/javascript"></script>
<script type="text/javascript">
	function excluirdados(id) {
		var codigo = id;
		var r = confirm("Você tem certeza que deseja excluir esse Clientes");
		if (r == true) {
			document.location = "excluiritens.php?tipo=6&codigo=" + codigo;

		}

	}

	
</script>


<body>
	

	<body>

		
			<?php
		
			include ("mestrenew.php");
			include('../include/funcoes.php');
			$sql = "SELECT * from clientes where nome like :nome1  and idempresa=:idempresa and idgrupo=:idgrupo order by nome limit :inicio,30"; 

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':nome1', "%".$nome."%");
			$stmt->bindParam(':idgrupo',$idgrupo,PDO::PARAM_INT);
		    $stmt->bindParam(':idempresa',$idempresa,PDO::PARAM_INT);
			$stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);

			
            $stmt->execute();
			if ($stmt->rowCount()==0){
				echo "<center><h2>Clientes não encontrados</h2></center>";
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
								<th scope="col">CPF</th>
							
                                <th scope="col">Celular</th>
                                <th scope="col">Email</th>
								<th scope="col">Data Nascimento</th>
                                
								
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
						//	if ($linhadb['idempresa']==0) $linhadb['idempresa']="--";
							//echo "<td><a href='#' onclick='excluirdados($linhadb[0])'><img src='../images/excluir.png' border='0' alt='Excluir'></a></td>"; 
                            echo "<td>".$linhadb['Nome']."</td>";
                            echo "<td>".$linhadb['cpf']."</td>";
                           
                            echo "<td>".$linhadb['celular']."</td>";
                            echo "<td>".$linhadb['email']."</td>"; 
							echo "<td>".dataPTBR($linhadb['dtanascimento'])."</td>";    
                            echo "<td><a href='servicos.php?dados=".$linhadb['id']."' ><i class='fa fa-plus fa-2x' aria-hidden='true'></i></a>
							<a href='cadastrocliente.php?tipo=".$linhadb['id']."' ><i class='fa fa-address-book-o fa-2x' aria-hidden='true'></i></a></td>";
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
<div class='col-md-1 col-sm-1'><a class='btn' href='clientes.php?nome=$nome&cnpj=$nome&telefone=$nome&inicio=$anterior'>Anterior</a></div>";
echo "<div class='col-md-1 col-sm-1'><a class='btn'  href='clientes.php?nome=$nome&cnpj=$nome&telefone=$nome&inicio=$proximo'>Proximo</a></div></div>";
}
?>
		</div>


		<br>


	</body>

	</html>