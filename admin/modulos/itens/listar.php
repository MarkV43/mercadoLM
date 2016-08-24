<?php
	if (!isset($_GET['id']))
		header('location: ?pagina=vendas_listar');
	$sql = "SELECT
				v.id AS id,
				data_venda,
				hora_venda,
				total,
				coalesce(c.nome,'Erro') AS cli,
				coalesce(f.nome,'Erro') AS fun,
				coalesce(fp.nome,'Erro') AS `for`
			FROM
				vendas v LEFT JOIN clientes c ON clientes_id = c.id
				         LEFT JOIN funcionarios f ON funcionarios_id = f.id
				         LEFT JOIN formas_pagamento fp ON forma_pagamento_id = fp.id
	        ORDER BY v.id DESC";
	$res = $con->query($sql) or die(mysqli_error($con));
	if (!isset($_GET['id'])) $_GET['id'] = null;
	include "voltar.php"
?>
<table class="listagem" cellspacing="0">
	<thead>
	<tr>
		<th>+</th>
		<th>Id</th>
		<th>Data</th>
		<th>Hora</th>
		<th>Total</th>
		<th>Cliente</th>
		<th>Funcionario</th>
		<th>Forma de Pagamento</th>
		<th>Editar</th>
		<th>Excluir</th>
	</tr>
	</thead>
	<tbody>
	<?php while ($linha = $res->fetch_array()) {
		$id = $linha['id'] ?>
		<tr>
			<td for="exp<?= $id ?>"><a id="exp<?= $id ?>" class="expandir"
			                           href="../../index.php?pagina=<?php if ($id != $_GET['id']) { ?>itens_listar&id=<?= $id;
			                           } else { ?>vendas_listar<?php } ?>">
					<?php if ($id == $_GET['id'])
						echo '▼';
					else
						echo '►' ?></a></td>
			<td for="exp<?= $id ?>"><?= $id ?></td>
			<td for="exp<?= $id ?>"><?= Conversor::dataBancoParaUsuario($linha['data_venda']) ?></td>
			<td for="exp<?= $id ?>"><?= $linha['hora_venda'] ?></td>
			<td for="exp<?= $id ?>"><?= Conversor::realBancoParaUsuario($linha['total']) ?></td>
			<td for="exp<?= $id ?>"><?= $linha['cli'] ?></td>
			<td for="exp<?= $id ?>"><?= $linha['fun'] ?></td>
			<td for="exp<?= $id ?>"><?= $linha['for'] ?></td>
			<td for="edt<?= $id ?>"><a id="edt<?= $id ?>"
			                           href="../../index.php?pagina=vendas_editar&id=<?= $id ?>"
			                           class="btn btn-primary">Editar</a></td>
			<td for="exc<?= $id ?>"><a id="exc<?= $id ?>"
			                           href="../../index.php?pagina=vendas_excluir&id=<?= $id ?>"
			                           class="btn btn-danger">Excluir</a></td>
		</tr>
		<?php
		if ($id == $_GET['id']) {
			?>
			<tr class="desl">
				<th>+</th>
				<th colspan="1">Id</th>
				<th colspan="3">Produto</th>
				<th colspan="2">Valor</th>
				<th colspan="1">Quantidade</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
			<?php
			$sql = "SELECT iv.id AS id,coalesce(p.nome,'Erro') AS pro,iv.valor AS val,iv.quantidade AS qtd FROM itens_venda iv LEFT JOIN produtos p ON p.id=iv.produtos_id WHERE vendas_id=$id;";
			$res2 = $con->query($sql) or die(mysqli_error($con));
			while ($linha2 = $res2->fetch_array()) {
				?>
				<tr class="desl">
					<td></td>
					<td colspan="1"><?= $linha2['id'] ?></td>
					<td colspan="3"><?= $linha2['pro'] ?></td>
					<td colspan="2"><?= money($linha2['val']) ?></td>
					<td colspan="1"><?= $linha2['qtd'] ?></td>
					<td><a class="small btn btn-info"
					       href="../../index.php?pagina=itens_editar&id=<?= $linha2['id'] ?>">Editar</a></td>
					<td><a class="small btn btn-danger"
					       href="../../index.php?pagina=itens_excluir&id=<?= $linha2['id'] ?>&v=<?= $id ?>">Excluir</a>
					</td>
				</tr>
			<?php } ?>
			<tr class="desl">
				<td></td>
				<td colspan="9" class="button-large"><a class="btn btn-success"
				                                        href="../../index.php?pagina=itens_cadastrar&id=<?= $id ?>">Adicionar
						produto</a></td>
			</tr>
		<?php } ?>
	<?php } ?>
	</tbody>
	<tfoot>
	<tr>
		<th colspan="7"><?= date("d/m/Y H:i:s") ?></th>
	</tr>
	</tfoot>
</table>
