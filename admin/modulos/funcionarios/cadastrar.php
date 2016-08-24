<?php
	if (!empty($_POST)) {
		$nome = $_POST['fnome'];
		$salario = Conversor::realUsuarioParaBanco($_POST['fsalario']);
		$data = Conversor::dataUsuarioParaBanco($_POST['fdata']);
		$nasc = Conversor::dataUsuarioParaBanco($_POST['nasc']);
		$cargos = $_POST['fcargos'];
		$cidades = $_POST['fcidades'];
		$cep = $_POST['fcep'];
		$s1 = $_POST['senha1'];
		$s2 = $_POST['senha2'];
		$email = $_POST['email'];

		if($s1 === $s2) {
			if ($nome != "" && $cargos != "") {
				$s2 = str_repeat("0",128);

				$sql = "INSERT INTO funcionarios(nome, salario, data_admissao, cargos_id, cidades_id, cep, senha, email, data_nascimento) VALUES ('$nome','$salario', '$data', '$cargos', '$cidades', '$cep', '$s2', '$email', '$nasc')";

				$res = $con->query($sql) or die($con->error);

				$uId = $con->insert_id;

				$pass = criptograthPass($uId, $s1);

				$sql = "UPDATE funcionarios SET senha = '$pass' WHERE id = $uId";

				$con->query($sql) or die ($con->error);

				if ($_FILES['foto']['name']) {
					$foto_nome = md5(uniqid(microtime(1), 1)) . "." . pathinfo($_FILES['foto']['name'])['extension'];
					$sql = "UPDATE funcionarios SET foto='$foto_nome' WHERE id= $uId";
					$con->query($sql) or die($con->error);
					move_uploaded_file($_FILES['foto']['tmp_name'], "imagens/funcionarios/" . $foto_nome);
				}

				if ($res == 1) {
					header('location: index.php?pagina=funcionarios_listar');
				} else {
					echo "<h1>Erro ao cadastrar!</h1>";
				}
			} else {
				echo "<script>alert('Preencha todos os campos!');</script>";
			}
		} else
			echo "<script>alert('As senhas não coincidem')</script>";
	}
	include "voltar.php" ?>
<form action="" method="post" class="formulario" enctype="multipart/form-data">
	<div class="item-form">
		<label for="nome">Nome: </label><br>
		<input type="text" name="fnome" id="nome" placeholder="Digite o nome do funcionário" required>
	</div>

	<div class="item-form">
		<label for="salario">Salário: </label><br>
		<input type="text" name="fsalario" id="salario" class="mascaraReal" required>
	</div>

	<div class="item-form">
		<label for="data">Data de Admissão: </label><br>
		<input type="text" class="mascaraData" name="fdata" id="data">
	</div>

	<div class="item-form">
		<label for="nasc">Data de Nascimento: </label><br>
		<input type="text" class="mascaraData" name="nasc" id="nasc">
	</div>

	<div class="item-form">
		<label for="email">E-mail: </label><br>
		<input type="email" id="email" name="email">
	</div>

	<div class="item-form">
		<?php
			$sql = "SELECT id, nome FROM cargos ORDER BY nome";
			$resCargos = mysqli_query($con, $sql) or die(mysqli_error($con));
		?>

		<label for="cargos">Cargo: </label><br>
		<select name="fcargos" required>
			<option value="">Selecione um cargo</option>
			<?php while ($cargo = mysqli_fetch_array($resCargos)) { ?>
				<option value="<?php echo $cargo['id']; ?>"><?php echo $cargo['nome']; ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="item-form">
		<?php
			$sql = "SELECT id, nome FROM cidades ORDER BY nome";
			$resCidades = mysqli_query($con, $sql) or die(mysqli_error($con));
		?>

		<label for="Cidade">Cidade: </label><br>
		<select name="fcidades" required>
			<option value="">Selecione uma cidade</option>
			<?php while ($cidade = mysqli_fetch_array($resCidades)) { ?>
				<option value="<?php echo $cidade['id']; ?>"><?php echo $cidade['nome']; ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="item-form">
		<label for="cep">CEP: </label><br>
		<input type="text" class="mascaraCEP" name="fcep" id="cep" required>
	</div>

	<div class=item-form>
		<label for="senha1">Senha: </label><br>
		<input type="password" id="senha1" name="senha1" required onkeyup="confirmPass()" minlength="6" maxlength="128"><br>
		<label for="senha2">Confirmar senha: </label><br>
		<input type="password" id="senha2" name="senha2" required onkeyup="confirmPass()" minlength="6" maxlength="128">
	</div>

	<div class="item-form">
		<label for="foto">Foto: </label>
		<input type="file" name="foto" id="foto">
	</div>

	<?php include "formulario.php" ?>
	<script type="text/javascript">
		var s1 = document.getElementById("senha1"),
		    s2 = document.getElementById("senha2"),
			submit = document.getElementById("submit"),
			subText = submit.className;
		function confirmPass(){
			if(s1.value == s2.value){
				submit.className = subText;
				submit.setAttribute("type","submit");
			} else {
				submit.className = subText + " disabled";
				submit.setAttribute("type","button");
			}
		}
	</script>
</form>