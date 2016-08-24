<?php
	$id = intval($_GET['id']);
	if (isset($_GET['confirmar'])):
		$sql = "
UPDATE produtos p SET p.quantidade = p.quantidade + (
SELECT sum(quantidade) FROM itens_venda WHERE vendas_id=$id AND produtos_id=p.id
) WHERE id=$id;";
		$res = $con->query($sql) or die(mysqli_error($con));
		$sql = "DELETE FROM vendas WHERE id=$id";
		$res = $con->query($sql) or die(mysqli_error($con));
		$sql = "DELETE FROM vendas WHERE id=$id";
		$res = $con->query($sql) or die(mysqli_error($con));
		if ($res) {
			header("location: index.php?pagina=vendas_listar");
		}
	endif;
	$sql = "SELECT id, nome FROM funcionarios WHERE id=$id";
	$res = $con->query($sql) or die(mysqli_error($con));
	include "voltar.php"
?>
<div class="formulario">
	<div class="texto-info">
		Deseja realmente excluir a venda?
	</div>
	<?php include "botoes_excluir.php"?>
</div>