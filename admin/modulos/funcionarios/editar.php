<?php
	//Resgatar o id da cidade a ser excluida
	$id = intval($_GET['id']);
	if (!empty($_POST['fnome'])) {
		$novo_nome = $_POST['fnome'];
		$novo_salario = Conversor::realUsuarioParaBanco($_POST['fsalario']);
		$novo_data = Conversor::dataUsuarioParaBanco($_POST['fdata']);
		$nova_nasc = Conversor::dataUsuarioParaBanco($_POST['nasc']);
		$novo_cargos = $_POST['fcargos'];
		$novo_cidades = $_POST['fcidades'];
		$novo_cep = $_POST['fcep'];
		$nova_foto_cracha = $_FILES['ffoto']['tmp_name'];
		$nova_foto_cracha_nome = $_FILES ['ffoto']['name'];
		$novo_email = $_POST['email'];
		$sql = "UPDATE funcionarios SET nome='$novo_nome', salario='$novo_salario', data_admissao='$novo_data', cargos_id='$novo_cargos', cidades_id='$novo_cidades', cep='$novo_cep', email='$novo_email', data_nascimento='$nova_nasc'";
		if ($nova_foto_cracha != '') {
			$sql2 = "SELECT foto FROM funcionarios WHERE id='$id'";
			$res = $con->query($sql2) or die ($con->error);
			unlink($res->fetch_array()['foto']);
			$nova_foto_cracha_nome = md5(uniqid(microtime(1), 1)) . "." . pathinfo($nova_foto_cracha_nome)['extension'];
			$sql .= ", foto='$nova_foto_cracha_nome'";
		}
		$sql .= " WHERE id=$id";
		if ($_SESSION['id'] == $id)
			$_SESSION['usuar'] = $novo_nome;
		$res = mysqli_query($con, $sql) or die(mysqli_error($con));
		if ($res == 1) {
			if ($nova_foto_cracha != '') {
				move_uploaded_file($nova_foto_cracha, "imagens/funcionarios/" . $nova_foto_cracha_nome);
			}
			header('location: index.php?pagina=funcionarios_listar');
		}
	}
	$sql = "SELECT nome, salario, data_admissao, cargos_id, cidades_id, cep, email,data_nascimento FROM funcionarios WHERE id='$id'";
	//Executar o script na conexao e armazenar o resultado
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));
	//Extrair uma linha do resultado
	$linha = mysqli_fetch_array($res);
	//Extrair para variáveis normais
	$nome = $linha['nome'];
	$salario = $linha['salario'];
	$data = $linha['data_admissao'];
	$cargos = $linha['cargos_id'];
	$cidades = $linha['cidades_id'];
	$cep = $linha['cep'];
	$email = $linha['email'];
	$nasc = $linha['data_nascimento'];
	include "voltar.php"
?>

<form action="" method="post" class="formulario" enctype="multipart/form-data">

	<div class="item-form">
		<label for="nome">Nome: </label><br>
		<input type="text" name="fnome" id="nome" value="<?= $nome ?>" required>
	</div>

	<div class="item-form">
		<label for="salario">Salário: </label><br>
		<input type="text" name="fsalario" id="salario" value="<?= Conversor::realBancoParaUsuario($salario) ?>"
		       required class="mascaraReal">
	</div class="item-form">

	<div class="item-form">
		<label for="data">Data de Admissão: </label><br>
		<input type="text" name="fdata" id="data" value="<?= Conversor::dataBancoParaUsuario($data) ?>"
		       class="mascaraData">
	</div>

	<div class="item-form">
		<label for="nasc">Data de Nascimento: </label><br>
		<input type="text" class="mascaraData" name="nasc" id="nasc"
		       value="<?= Conversor::dataBancoParaUsuario($nasc) ?>">
	</div>

	<div class="item-form">
		<label for="email">E-mail: </label><br>
		<input type="email" id="email" name="email" value="<?= $email ?>" required>
	</div>

	<div class="item-form">
		<label for="cargos">Cargo: </label><br>
		<select name="fcargos" id="cargos" required>
			<?php
				$sql = "SELECT id,nome FROM cargos";
				$res = $con->query($sql) or die($con->error);
				while ($l = $res->fetch_array()):
					?>
					<option value="<?= $l['id'] ?>" <?= $l['id'] == $cargos ? 'selected' :
						'' ?>><?= $l['nome'] ?></option>
					<?php
				endwhile;
			?>
		</select>
	</div>

	<div class="item-form">
		<label for="cidades">Cidade: </label><br>
		<select name="fcidades" id="cidades" required>
			<?php
				$sql = "SELECT id,nome FROM cidades";
				$res = $con->query($sql) or die($con->error);
				while ($l = $res->fetch_array()):
					?>
					<option value="<?= $l['id'] ?>" <?= $l['id'] == $cidades ? 'selected' :
						'' ?>><?= $l['nome'] ?></option>
					<?php
				endwhile;
			?>
		</select>
	</div>

	<div class="item-form">
		<label for="cep">CEP: </label><br>
		<input type="text" name="fcep" id="cep" value="<?= $cep ?>" required class="mascaraCEP">
	</div>

	<?php
		$sql = "SELECT foto FROM funcionarios WHERE id=$id";
		$res = $con->query($sql) or die($con->error);
		$foto = $res->fetch_array()['foto'];
	?>
	<div>
		<?php
			if ($foto) {
				?>
				<label>Foto Antiga:</label><br>
				<img src="imagens/funcionarios/<?= $foto ?>" style="max-width: 100%"><br>
			<?php } ?>
		<label for="foto">Foto do crachá: </label>
		<input type="file" name="ffoto" id="foto">
	</div>
	<?php include "formulario.php" ?>
</form>
