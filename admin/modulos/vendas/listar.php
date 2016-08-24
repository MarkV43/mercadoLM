<?php
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
			                           href="?pagina=itens_listar&id=<?= $id ?>">►</a></td>
			<td for="exp<?= $id ?>"><?= $id ?></td>
			<td for="exp<?= $id ?>"><?= Conversor::dataBancoParaUsuario($linha['data_venda']) ?></td>
			<td for="exp<?= $id ?>"><?= $linha['hora_venda'] ?></td>
			<td for="exp<?= $id ?>"><?= Conversor::realBancoParaUsuario($linha['total']) ?></td>
			<td for="exp<?= $id ?>"><?= $linha['cli'] ?></td>
			<td for="exp<?= $id ?>"><?= $linha['fun'] ?></td>
			<td for="exp<?= $id ?>"><?= $linha['for'] ?></td>
			<?php include "botoes_listar.php" ?>
		</tr>
	<?php } ?>
	</tbody>
	<tfoot>
	<tr>
		<th colspan="10">
			<?= date('d/m/Y H:i:s') ?>
		</th>
	</tr>
	</tfoot>
</table>
