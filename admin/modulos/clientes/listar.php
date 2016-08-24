<?php

	$sql = "SELECT
              c.id, c.nome, email, telefone, data_nascimento, cep, coalesce(a.nome,'Erro') AS ci
            FROM
              clientes c LEFT JOIN cidades a ON a.id=cidades_id 
            ORDER BY id DESC";

	$res = mysqli_query($con, $sql) or die (mysqli_error($con));
	include "voltar.php"
?>

<table class="listagem" cellspacing="0">
	<thead>
	<tr>
		<th>Id</th>
		<th>Nome</th>
		<th>Email</th>
		<th>Telefone</th>
		<th>Data de Nascimento</th>
		<th>CEP</th>
		<th>Cidade</th>
		<th>Editar</th>
		<th>Excluir</th>

	</tr>
	</thead>

	<tbody>
	<?php while ($linha = mysqli_fetch_array($res)) { ?>
		<tr>
			<td><?= $linha['id'] ?></td>
			<td><?= $linha['nome'] ?></td>
			<td><?= $linha['email'] ?></td>
			<td><?= $linha['telefone'] ?></td>
			<td><?= Conversor::dataBancoParaUsuario($linha['data_nascimento']) ?></td>
			<td><?= $linha['cep'] ?></td>
			<td><?= $linha['ci'] ?></td>
			<?php include "botoes_listar.php" ?>
		</tr>
	<?php } ?>

	</tbody>

	<tfoot>
	<tr>
		<th colspan="4"><?= date('d/m/Y H:i:s') ?></th>
	</tr>
	</tfoot>
</table>