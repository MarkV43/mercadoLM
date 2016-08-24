<?php 

	//Resgatar o id da cidade a ser editada
	$id = intval($_GET['id']);
	
	//Verificar se o usuário clicou em enviar
	if(!empty($_POST)){
		//Resgatar os novos dados do formulário
		$novo_nome = $_POST['fnome'];
		
		//Montar o script de update
		$sql = "UPDATE
					formas_pagamento
				SET
					nome='$novo_nome'
				WHERE
					id=$id";
		
		$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
		if($res==1){
			header('location: index.php?pagina=formas_pagamento_listar');
		}
		
		
		
	}
	
	
	
	//Script para selecionar o nome e o uf da cidade
	$sql = "SELECT nome FROM formas_pagamento WHERE id=$id";
	
	//Executar o script na conexao e armazenar o resultado
	$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
	
	//Extrair uma linha do resultado
	$linha = mysqli_fetch_array($res);
	
	//Extrair para variáveis normais
	$nome = $linha['nome'];
	include "voltar.php"
?>


<form action="" method="post" class="formulario">

	<div class="item-form">
		<label for="nome">Nome: </label>
		<input type="text" value="<?php echo $nome; ?>" name="fnome" id="nome" placeholder="Digite o nome da forma de pagamento" >
	</div>

	<?php include "formulario.php" ?>
</form>