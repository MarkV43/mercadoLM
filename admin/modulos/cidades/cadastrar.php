<?php

	//Verificar se o POST não está vazio
	//Verificar se o usuário clicou em enviar
	if (!empty($_POST)) {

		//Resgatar dados do formulário
		$nome = $_POST['fnome'];
		$uf = $_POST['fuf'];

		if ($nome != "" && $uf != "") {
			//Montar o sql de insert
			$sql = "INSERT INTO cidades(nome, uf) VALUES('$nome', '$uf')";

			//Executar o sql na conexão
			$res = mysqli_query($con, $sql) or die(mysqli_error($con));

			//Verificar a resposta do insert
			if ($res == 1) {
				//Redirecionar para listagem de cidades
				header('location: index.php?pagina=cidades_listar');
			} else {
				echo "<h1>Erro ao cadastrar cidade</h1>";
			}

		} else {
			echo "<script>alert('Preencha todos os campos!');</script>";
		}

	}
	include "voltar.php" ?>
<form action="" method="post" class="formulario">

	<div class="item-form">
		<label for="nome">Nome: </label>
		<input type="text" name="fnome" id="nome" placeholder="Digite o nome da cidade" required>
	</div>

	<div class="item-form">
		<label for="uf">Estado: </label>
		<input type="text" name="fuf" id="uf" placeholder="Digite o UF do estado" minlength="2" maxlength="2" required>
	</div>

	<?php include "formulario.php" ?>
</form>