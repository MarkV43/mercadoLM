<?php
	$id = $_GET['id'];
	if (isset($_GET['confirmar'])) {
		$sql = "
UPDATE vendas v
SET total = (
	SELECT sum(valor)
	FROM itens_venda
	WHERE vendas_id = v.id
)";
		$con->query($sql) or die($con->error);
		$sql = "
UPDATE produtos p SET p.quantidade = p.quantidade + (
	SELECT i.quantidade FROM itens_venda i WHERE i.id = $id
) WHERE p.id = (
	SELECT i.produtos_id FROM itens_venda i WHERE i.id = $id
);";
		$con->query($sql) or die($con->error);
		$sql = "DELETE FROM itens_venda WHERE id=$id";
		$con->query($sql) or die($con->error);
		header("location: index.php?pagina=itens_listar&id=" . $_GET['v']);
	}
?>
<div class="formulario">
	<h1>Excluindo item de venda</h1>
	<div class='texto-info'>Deseja realmente excluir o item?</div>
	<?php include "botoes_excluir.php" ?>
</div>