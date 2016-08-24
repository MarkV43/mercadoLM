<?php 

	//Montagem do sql para selecao dos dados
	$sql = "SELECT id, nome FROM categorias ORDER BY id DESC";
	
	//Executar o sql na conexao
	$res = mysqli_query($con, $sql) or die(mysqli_error());
	include "voltar.php"
?>

<table class="listagem" cellspacing='0'>
	<thead>
		<tr>
			<th>Id</th>
			<th>Nome</th>
			<th width="100px">Editar</th>
			<th width="100px">Excluir</th>
		</tr>
	</thead>
	
	<tbody>
		<?php while($linha = mysqli_fetch_array($res)){ ?>
			<tr>
				<td><?php echo $linha['id']; ?></td>
				<td><?php echo $linha['nome']; ?></td>
				<?php include "botoes_listar.php"?>
			</tr>	
		
		<?php } ?>
	</tbody>
	
	<tfoot>
		<tr>
			<th colspan="4"><?php echo date('d/m/Y H:i:s'); ?></th>
		</tr>
	</tfoot>
	
</table>







