<?php


	$id = intval($_GET['id']);


	if (isset($_GET['confirmar'])) {
		//Se o parametro existir, deletar do banco de dados
		$sql = "DELETE FROM clientes WHERE id=$id";

		$res = mysqli_query($con, $sql) or die(mysqli_error($con));

		if ($res == 1) {

			header('location: index.php?pagina=clientes_listar');
		}

	}


	$sql = "SELECT nome FROM clientes WHERE id='$id'";

	//Executar o script sql na conexão e armazenar a resposta
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));

	//Extrair a linha da variavel $res
	$linha = mysqli_fetch_array($res);


	include "voltar.php"
?>
<div class="formulario">
	<div class='text-info'>
		Deseja realmente excluir o cliente <b><?php echo $linha['nome']; ?></b>?
	</div>

	<?php include "botoes_excluir.php" ?>
</div>
