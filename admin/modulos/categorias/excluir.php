<?php 

	//Resgatar o id da cidade a ser excluida
	$id = intval($_GET['id']);
	
	
	//Verificar se o parametro confirmar está na URL
	if(isset($_GET['confirmar'])){
		//Se o parametro existir, deletar do banco de dados
		$sql = "DELETE FROM categorias WHERE id=$id";
		
		//Executar o sql na conexao e armazenar a resposta
		$res = mysqli_query($con, $sql) or die(mysqli_error($con));
		
		//Verificar se deu certa a exclusao
		if($res==1){
			//Redirecionar para listagem de cidades
			header('location: index.php?pagina=categorias_listar');
		}
		
	}
	

	
	//Script para Selecionar o nome da cidade que será excluída
	$sql = "SELECT nome FROM categorias WHERE id=$id";
	
	//Executar o script sql na conexão e armazenar a resposta
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));
	
	//Extrair a linha da variavel $res
	$linha = mysqli_fetch_array($res);

	include "voltar.php"

?>

<div class="formulario">
	<h1>Excluindo categoria</h1>
	<div class='texto-info'>
		Deseja realmente excluir a categoria <b><?php echo $linha['nome']; ?></b>?
	</div>
	<?php include "botoes_excluir.php"?>
</div>














