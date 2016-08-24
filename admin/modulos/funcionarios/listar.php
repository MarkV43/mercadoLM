<?php
	$sql = "SELECT f.id, f.nome, salario, data_admissao, cep, coalesce(c.nome,'Erro') AS ca, a.nome AS ci, coalesce(foto,'../no-image.png') AS foto, email FROM
    cargos c RIGHT JOIN funcionarios f ON c.id = cargos_id LEFT JOIN cidades a ON a.id = cidades_id
     ORDER BY id DESC";
	$res = mysqli_query($con, $sql) or die (mysqli_error($con));
	include "voltar.php"
?>

<table class="listagem" cellspacing="0">
	<thead>
	<tr>
		<th>Id</th>
		<th>Nome/E-mail</th>
		<th>Salário</th>
		<th>Data Adm./CEP</th>
		<th>Cargo</th>
		<th>Cidade</th>
		<th>Senha</th>
		<th>Editar</th>
		<th>Excluir</th>
	</tr>
	</thead>

	<tbody>
	<?php while ($linha = $res->fetch_array()) {
		$id = $linha['id'] ?>
		<tr>

			<td><?= $id ?></td>
			<td title="Clique para mostrar a foto" onclick="expandir('imagens/funcionarios/<?= $linha['foto'] ?>')">
				<?= $linha['nome'] ?><br>
				<?= $linha['email'] ?></td>
			<td><?= Conversor::realBancoParaUsuario($linha['salario']) ?></td>
			<td><?= Conversor::dataBancoParaUsuario($linha['data_admissao']); ?><br>
				<?= $linha['cep'] ?></td>
			<td><?= $linha['ca'] ?></td>
			<td><?= $linha['ci'] ?></td>
			<td class="cellE"><a href="?pagina=funcionarios_alt_senha&id=<?= $id ?>">Alt. Senha</a></td>
			<?php include "botoes_listar.php" ?>
		</tr>
	<?php } ?>

	</tbody>

	<tfoot>
	<tr>
		<th colspan="5"><?= date('d/m/Y H:i:s') ?></th>
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
		exp.src           = src;
		div.style.display = "block";
	}
	function reduzir() {
		div.style.display = "none";
		exp.src           = "";
	}
</script>