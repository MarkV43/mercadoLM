<?php

	//Resgatar o id da cidade a ser excluida
	$id = intval($_GET['id']);

	if (!empty($_POST['fnome'])) {
		$novo_nome = $_POST['fnome'];
		$novo_telefone = $_POST['ftelefone'];
		$novo_data = Conversor::dataUsuarioParaBanco($_POST['fdata']);
		$novo_cep = $_POST['fcep'];
		$novo_email = $_POST['femail'];
		$novo_cidade = $_POST['fcidade'];


		$sql = "UPDATE clientes SET nome='$novo_nome', telefone='$novo_telefone', data_nascimento='$novo_data', cep='$novo_cep', email='$novo_email', cidades_id='$novo_cidade' WHERE id='$id'";

		$res = mysqli_query($con, $sql) or die(mysqli_error($con));
		if ($res == 1) {
			header('location: index.php?pagina=clientes_listar');
		}
	}

	$sql = "SELECT nome, email, telefone, data_nascimento, cep, cidades_id FROM clientes WHERE id='$id'";

	//Executar o script na conexao e armazenar o resultado
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));

	//Extrair uma linha do resultado
	$linha = mysqli_fetch_array($res);

	//Extrair para variáveis normais
	$nome = $linha['nome'];
	$telefone = $linha['telefone'];
	$data = $linha['data_nascimento'];
	$cep = $linha['cep'];
	$email = $linha['email'];
	$cidade = $linha['cidades_id'];

	include "voltar.php"
?>

<form action="" method="post" class="formulario">

	<div class="item-form">
		<div>
			<label for="nome">Nome: </label><br>
			<input type="text" value="<?= $nome; ?>" name="fnome" id="nome"
			       placeholder="Digite o nome da cidade">
		</div>

		<div>
			<label for="telefone">Telefone: </label><br>
			<input type="text" value="<?= $telefone; ?>" name="ftelefone" id="telefone">
		</div>

		<div>
			<label for="data">Data de nascimento: </label><br>
			<input type="date" value="<?= Conversor::dataBancoParaUsuario($data) ?>" name="fdata" id="data">
		</div>

		<div>
			<label for="telefone">CEP: </label><br>
			<input type="text" value="<?= $cep; ?>" name="fcep" min="0" max="99999999" id="cep">
		</div>

		<div>
			<label for="cidade">Cidade: </label><br>
			<select name="fcidade" id="cidade" required>
				<?php
					$sql = "SELECT id,nome FROM cidades";
					$res = $con->query($sql) or die($con->error);
					while ($l = $res->fetch_array()):
						?>
						<option value="<?= $l['id'] ?>" <?= $l['id'] == $cidade ? 'selected' :
							'' ?>><?= $l['nome'] ?></option>
						<?php
					endwhile;
				?>
			</select>
		</div>

		<div>
			<label for="email">Email: </label><br>
			<input type="text" value="<?= $email; ?>" name="femail" id="email">
		</div>
	</div>
	<?php include "formulario.php" ?>
</form>