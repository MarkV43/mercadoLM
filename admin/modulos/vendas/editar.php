<?php
	$id = $_GET['id'];
	if(!empty($_POST)){
		$sql = "
		UPDATE
			vendas
		SET
			data_venda = '".Conversor::dataUsuarioParaBanco($_POST['data'])."',
			hora_venda = '".$_POST['hora']."',
			clientes_id = ".$_POST['cli'].",
			funcionarios_id = ".$_POST['fun'].",
			forma_pagamento_id = ".$_POST['for']."
		WHERE
			id = $id";
		$con->query($sql) or die($con->error);
		header("location: index.php?pagina=vendas_listar");
	}
	$sql = "
	SELECT
		data_venda,
		hora_venda,
		clientes_id,
		funcionarios_id,
		forma_pagamento_id
	FROM
		vendas
	WHERE
		id = $id;";
	$res = $con->query($sql) or die($con->error);
	$linha = $res->fetch_array();
	include "voltar.php"
?>
<form action="" method="post" class="formulario">
	<div class="item-form">
		<label for="data">Data: </label>
		<input type="text" value="<?=Conversor::dataBancoParaUsuario($linha['data_venda'])?>" class="mascaraData" id="data" name="data">
	</div>
	<div class="item-form">
		<label for="hora">Hora: </label>
		<input type="text" value="<?=$linha['hora_venda']?>" class="mascaraHora" id="hora" name="hora">
	</div>
	<div class="item-form">
		<label for="cli">Cliente:</label>
		<select name="cli" required id="cli">
			<option value="">Selecione um cliente</option>
			<?php
				$sql = "SELECT id,nome FROM clientes";
				$res = $con->query($sql) or die($con->error);
				while($l = $res->fetch_array()):?>
					<option value="<?=$l['id']?>" <?=$l['id']==$linha['clientes_id']?'selected':''?>><?=$l['nome']?></option>
				<?php endwhile?>
		</select>
	</div>
	<div class="item-form">
		<label for="fun">Funcionário: </label>
		<select name="fun" id="fun" required>
			<option value="">Selecione um funcionário</option>
			<?php
				$sql = "SELECT id,nome FROM funcionarios";
				$res = $con->query($sql) or die($con->error);
				while($l = $res->fetch_array()):?>
					<option value="<?=$l['id']?>" <?=$l['id']==$linha['funcionarios_id']?'selected':''?>><?=$l['nome']?></option>
				<?php endwhile?>
		</select>
	</div>
	<div class="item-form">
		<label for="for">Forma de pagamento: </label>
		<select name="for" id="for" required>
			<option value="">Selecione uma forma de pagamento: </option>
			<?php
				$sql = "SELECT id,nome FROM formas_pagamento";
				$res = $con->query($sql) or die($con->error);
				while($l = $res->fetch_array()):?>
					<option value="<?=$l['id']?>" <?=$l['id']==$linha['forma_pagamento_id']?'selected':''?>><?=$l['nome']?></option>
				<?php endwhile?>
		</select>
	</div>
	<?php include "formulario.php" ?>
</form>