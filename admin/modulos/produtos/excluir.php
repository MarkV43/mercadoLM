<?php

	$id = intval($_GET['id']);
	if (isset($_GET['confirmar'])) {
		$sql = "SELECT foto FROM produtos WHERE id=$id";
		$foto = $con->query($sql)->fetch_array()['foto'];
		unlink($foto);
		$sql = "DELETE FROM produtos WHERE id=$id";
		$res = mysqli_query($con, $sql) or die(mysqli_error($con));

		if ($res == 1) {
			header('location: index.php?pagina=produtos_listar');
		}
	}

	$sql = "SELECT nome, valor, categorias_id FROM produtos WHERE id=$id";
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));
	$linha = mysqli_fetch_array($res);

	include "voltar.php"
?>
<div class="formulario">
	<div class="texto-info">
		Deseja realmente excluir o cargo <b><?php echo $linha['nome']; ?></b>?
	</div>
	<?php include "botoes_excluir.php"?>
</div>