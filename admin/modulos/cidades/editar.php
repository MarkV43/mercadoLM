<?php 

	//Resgatar o id da cidade a ser editada
	$id = intval($_GET['id']);
	
	//Verificar se o usuário clicou em enviar
	if(!empty($_POST)){
		//Resgatar os novos dados do formulário
		$novo_nome = $_POST['fnome'];
		$novo_uf = $_POST['fuf'];
		
		//Montar o script de update
		$sql = "UPDATE
					cidades
				SET
					nome='$novo_nome',
					uf='$novo_uf'
				WHERE
					id=$id";
		
		$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
		if($res==1){
			header('location: index.php?pagina=cidades_listar');
		}
		
		
		
	}
	
	
	
	//Script para selecionar o nome e o uf da cidade
	$sql = "SELECT nome, uf FROM cidades WHERE id=$id";
	
	//Executar o script na conexao e armazenar o resultado
	$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
	
	//Extrair uma linha do resultado
	$linha = mysqli_fetch_array($res);
	
	//Extrair para variáveis normais
	$nome = $linha['nome'];
	$uf = $linha['uf'];
	include "voltar.php"
?>


<form action="" method="post" class="formulario">

	<h1>Editando cidade de código <?php echo $_GET['id']; ?></h1>
	<a href="../../index.php?pagina=cidades_listar">Voltar</a>

	<div class="item-form">
		<label for="nome">Nome: </label>
		<input type="text" value="<?php echo $nome; ?>" name="fnome" id="nome" placeholder="Digite o nome da cidade" >
	</div>
	
	<div class="item-form">
		<label for="uf">Estado: </label>
		<input type="text" value="<?php echo $uf; ?>" name="fuf" id="uf" placeholder="Digite o UF do estado" maxlength="2" >
	</div>
	
	<?php include "formulario.php"?>
</form>