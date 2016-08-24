<?php

	//Verificar se clicou em enviar
	if (!empty($_POST)) {

		//Resgatar os dados do form
		$nome = $_POST['fnome'];

		//Montar o script sql
		$sql = "INSERT INTO formas_pagamento(nome) VALUES('$nome')";

		//Executar no banco de dados e armazenar a resposta
		$res = mysqli_query($con, $sql) or die(mysqli_error($con));
		if ($res == 1) {
			//Redirecionar para listagem
			header('location: index.php?pagina=formas_pagamento_listar');
		} else {
			echo "Erro ao cadastrar";
		}

	}
	include "voltar.php" ?>
<form action="" method="post" class="formulario">

	<div class="item-form">
		<label for="nome">Nome: </label>
		<input type="text" name="fnome" id="nome" placeholder="Digite o nome da forma de pagamento" autofocus>
	</div>

	<?php include "formulario.php" ?>

</form>