<?php

	//Verificar se clicou em enviar
	if (!empty($_POST)) {

		//Resgatar os dados do form
		$nome = $_POST['fnome'];

		//Montar o script sql
		$sql = "INSERT INTO cargos(nome) VALUES('$nome')";

		//Executar no banco de dados e armazenar a resposta
		$res = mysqli_query($con, $sql) or die(mysqli_error($con));
		if ($res == 1) {
			//Redirecionar para listagem
			header('location: index.php?pagina=cargos_listar');
		} else {
			echo "Erro ao cadastrar";
		}

	}
	include "voltar.php" ?>
<form action="" method="post" class="formulario">

	<div class="item-form">
		<label for="nome">Nome: </label>
		<input type="text" name="fnome" id="nome" placeholder="Digite o nome do cargo" autofocus>
	</div>

	<?php include "formulario.php" ?>

</form>