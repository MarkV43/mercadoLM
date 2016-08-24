<?php
	if (!empty($_POST)) {
		date_default_timezone_set("America/Sao_Paulo");
		$sql = "
		INSERT INTO vendas (
			data_venda,
			hora_venda,
			total,
			clientes_id,
			funcionarios_id,
			forma_pagamento_id
		) VALUE (
			'" . date("Y-m-d") . "',
			'" . date("H:i:s") . "',
			0,
			" . $_POST['cli'] . ",
			" . $_POST['fun'] . ",
			" . $_POST['for'] . "
		)";
		$con->query($sql) or die($con->error);
		header("location: index.php?pagina=itens_listar&id=".$con->insert_id);
	}
	include "voltar.php"
?>
<form action="" method="POST" class="formulario">
	<div class="item-form">
		<label for="cli">Cliente:</label>
		<select name="cli" required id="cli">
			<option value="">Selecione um cliente</option>
			<?php
				$sql = "SELECT id,nome FROM clientes";
				$res = $con->query($sql) or die($con->error);
				while ($l = $res->fetch_array()):?>
					<option value="<?= $l['id'] ?>"><?= $l['nome'] ?></option>
				<?php endwhile ?>
		</select>
	</div>
	<div class="item-form">
		<label for="fun">Funcionário: </label>
		<select name="fun" id="fun" required>
			<option value="">Selecione um funcionário</option>
			<?php
				$sql = "SELECT id,nome FROM funcionarios";
				$res = $con->query($sql) or die($con->error);
				while ($l = $res->fetch_array()):?>
					<option value="<?= $l['id'] ?>"><?= $l['nome'] ?></option>
				<?php endwhile ?>
		</select>
	</div>
	<div class="item-form">
		<label for="for">Forma de pagamento: </label>
		<select name="for" id="for" required>
			<option value="">Selecione uma forma de pagamento:</option>
			<?php
				$sql = "SELECT id,nome FROM formas_pagamento";
				$res = $con->query($sql) or die($con->error);
				while ($l = $res->fetch_array()):?>
					<option value="<?= $l['id'] ?>"><?= $l['nome'] ?></option>
				<?php endwhile ?>
		</select>
	</div>
	<?php include "formulario.php" ?>
</form>
