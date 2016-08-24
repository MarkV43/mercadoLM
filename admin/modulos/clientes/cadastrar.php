<?php
	if (!empty($_POST)) {
		$nome = $_POST['fnome'];
		$email = $_POST['femail'];
		$tel = $_POST['ftelefone'];
		$data = Conversor::dataUsuarioParaBanco($_POST['fdata']);
		$cep = $_POST['fcep'];
		$cid = $_POST['fcidade'];


		if ($nome != "" && $email != "") {

			$sql = "INSERT INTO clientes(nome, email, telefone, data_nascimento, cep, cidades_id) VALUES ('$nome', '$email', '$tel', '$data', '$cep', '$cid')";

			$res = mysqli_query($con, $sql) or die (mysqli_error($con));

			if ($res == 1) {
				header('location: index.php?pagina=clientes_listar');
			} else {
				echo "<h1>Erro ao cadastrar!</h1>";
			}
		} else {
			echo "<script>alert('Preencha todos os campos!');</script>";
		}
	}
	include "voltar.php" ?>
<form action="" method="post" class="formulario">
	<div class="item-form">
		<label for="nome">Nome: </label><br>
		<input type="text" name="fnome" id="nome" required>
	</div>

	<div class="item-form">
		<label for="email">Email: </label><br>
		<input type="email" name="femail" id="email" required>
	</div>

	<div class="item-form">
		<label for="telefone">Telefone: </label><br>
		<input type="text" class="mascaraTelefone" name="ftelefone" id="telefone" required>
	</div>

	<div class="item-form">
		<label for="data_nascimento">Data de nascimento: </label><br>
		<input type="text" class="mascaraData" name="fdata" id="data_nascimento" required>
	</div>

	<div class="item-form">
		<label for="cep">CEP: </label><br>
		<input type="text" class="mascaraCEP" name="fcep" id="cep" required>
	</div>

	<div class="item-form">
		<?php
			$sql = "SELECT id, nome FROM cidades ORDER BY nome";
			$resCidades = mysqli_query($con, $sql) or die(mysqli_error($con));
		?>

		<label for="Cidade">Cidade: </label><br>
		<select name="fcidade" id="Cidade" required>
			<option value="">Selecione uma cidade</option>
			<?php while ($cidade = mysqli_fetch_array($resCidades)) { ?>
				<option value="<?php echo $cidade['id']; ?>"><?php echo $cidade['nome']; ?></option>
			<?php } ?>
		</select>
	</div>
	<?php include "formulario.php" ?>
</form>
