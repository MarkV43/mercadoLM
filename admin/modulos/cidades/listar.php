<?php 

	//Criar sql para seleção de todas as cidades
	$sql = "SELECT id, nome, uf FROM cidades ORDER BY id DESC";
	
	//Executar o sql na conexão $con
	$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
	include "voltar.php"
?>

<table class="listagem" cellspacing="0">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nome</th>
			<th>UF</th>
			<th width="100px">Editar</th>
			<th width="100px">Excluir</th>
		</tr>
	</thead>
	
	<tbody>
		<?php while($linha=mysqli_fetch_array($res)){ ?>
			<tr>
				<td><b> <?php echo $linha['id']; ?> </b></td>
				<td><?php echo $linha['nome']; ?></td>
				<td><?php echo $linha['uf']; ?></td>
				<?php include "botoes_listar.php"?>
			</tr>
		<?php } ?>
		
	</tbody>
	
	<tfoot>
		<tr>
			<th colspan="5"><?php echo date('d/m/Y H:i:s'); ?></th>
		</tr>
	</tfoot>
	
</table>







