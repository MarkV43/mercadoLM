<?php
	$sql = "SELECT produtos.id AS id,
				produtos.nome AS nome,
				coalesce(foto,'../no-image.png') AS foto,
				valor,
				quantidade,
				coalesce(categorias.nome,'Erro') AS categorias
			FROM
				produtos LEFT JOIN categorias ON categorias_id = categorias.id
			ORDER BY id DESC";

	$res = $con->query($sql) or die($con->error);
	include "voltar.php"
?>

<table class="listagem" cellspacing="0">
	<thead>
	<tr>
		<th>ID</th>
		<th>Foto</th>
		<th>Nome</th>
		<th>Valor</th>
		<th>Quantidade</th>
		<th>Categoria</th>
		<th>Editar</th>
		<th>Excluir</th>
	</tr>
	</thead>

	<tbody>
	<?php while ($linha = mysqli_fetch_array($res)) { ?>
		<tr>
			<td><?= $linha['id'] ?></td>
			<td class="img"><img onclick="expandir(this.src)" src="imagens/produtos/<?= $linha['foto']==""?"../no-image.png":$linha['foto'] ?>" width="100"></td>
			<td><?= $linha['nome'] ?></td>
			<td><?= Conversor::realBancoParaUsuario($linha['valor']) ?></td>
			<td><?= $linha['quantidade'] ?></td>
			<td><?= $linha['categorias'] ?></td>
			<?php include "botoes_listar.php" ?>
		</tr>
	<?php } ?>
	</tbody>
	<tfoot>
	<tr>
		<th colspan="7"><?= date("d/m/Y H:i:s") ?></th>
	</tr>
	</tfoot>
</table>
<div id="divExp" onclick="reduzir()">
	<img src="" id="expandido">
</div>
<script>
	var div = document.getElementById("divExp");
	var exp = document.getElementById("expandido");
	function expandir(src) {
		exp.src = src;
		div.style.display = "block";
	}
	function reduzir() {
		div.style.display = "none";
		exp.src = "";
	}
</script>
